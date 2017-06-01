<?php
class SocketServer {
	const ERROR = 0;
	const LOG = 1;
	const DEBUG = 2;

	private $socket_server = NULL;
	private $clients = array();
	private $iStartTime = 0;
	private $config;

	public function __construct() {
		$this->CI = &get_instance();
		$this->CI->load->model("PublishedArticle_model");
		$this->CI->config->load("socket", TRUE);
		$this->config = $this->CI->config->config['socket'];
		if (!($this->socket_server = socket_create(AF_INET, SOCK_STREAM, SOL_TCP))) {
			$this->log('Could not create main socket ( ' . socket_strerror(socket_last_error()) . ' ).', self::ERROR);
		} else if (socket_set_option($this->socket_server, SOL_SOCKET, SO_REUSEADDR, 1) === FALSE) {
			$this->log('Could not set SO_REUSEADDR flag ( ' . socket_strerror(socket_last_error()) . ' ).', self::ERROR);
		}
	}

	public function __destruct() {
		if ($this->socket_server) {
			$this->log('Shutting down ...', self::LOG);
			foreach ($this->clients as $client) {
				if ($client) {
					stream_socket_shutdown($client, STREAM_SHUT_RDWR);
				}
			}
		}
	}

	private function processCmd($client, $data) {
		$data = json_decode($data, TRUE);
		$cmd = $data["cmd"];
		$args = isset($data['msg']) ? $data['msg'] : "";
		switch($cmd) {
			case "setArticle" :
				if ($args['included'] == 1 && $args['id']) {
					$this->CI->PublishedArticle_model->set(array("included" => 1))->where(array(
						"id" => $args['id'],
						"addtime" => $args['addtime']
					))->update();
				}
				break;
			case "getArticle" :
				$port = $this->getRemotePort($client);
				if (!$port) {
					$this->send($client, json_encode(array(
						"success" => false,
						"msg" => "invalid arguments",
						"cmd" => "getArticle"
					)));
					return;
				}
				$twoDaysLater = strtotime("-2 days");
				$eightDaysLater = strtotime("-8 days");
				$time = time();
				$overtime = $time - 10;
				$success = $this->CI->PublishedArticle_model->set(array(
					"included_select" => $port,
					"included_select_time" => $time
				))->set("included_orders", "`included_orders`+1", FALSE)->where(array(
					"status" => 2,
					"addtime >" => $twoDaysLater,
					"addtime >" => $eightDaysLater
				))->where("(`included_select`=0 OR (`included_select`<>0 AND `included_select_time`<{$overtime}))")->order_by("included_orders", "ASC")->limit(20, 0)->update();
				if (!$success) {
					$this->send($client, json_encode(array(
						"success" => false,
						"msg" => "service busy",
						"cmd" => "getArticle"
					)));
					return;
				}
				$list = $this->CI->PublishedArticle_model->select("id,pc")->where(array(
					"included_select" => $port,
					"included" => 0,
					"included_select_time" => $time
				))->get_list();
				if (empty($list)) {
					$this->send($client, json_encode(array(
						"success" => false,
						"msg" => "empty list",
						"cmd" => "getArticle"
					)));
					return;
				}
				$this->send($client, json_encode(array(
					"list" => $list,
					"time" => $time,
					"success" => true,
					"cmd" => "getArticle"
				)));
				break;
		}
	}

	private function onMessage($client) {
		$write = "";
		while ($data = stream_socket_recvfrom($client, 8092)) {
			if (!$data) {
				break;
			}
			$write .= $data;
		}
		if (!$write) {
			return false;
		}
		$write = explode("\n", $write);
		foreach ($write as $data) {
			$this->processCmd($client, $data);
		}
	}

	private function getName($client, $fullname = false) {
		$name = stream_socket_get_name($client, TRUE);
		return $fullname ? $name : explode(":", $name);
	}

	private function getRemotePort($client) {
		$data = $this->getName($client);
		return $data[1];
	}

	private function log($sMessage, $iType) {
		$sTimeStamp = @strftime('%c');

		if ($iType == self::ERROR) {
			$aBacktrace = debug_backtrace();
			$aBacktrace = $aBacktrace[1];
			$sMessage = sprintf('[%s] [E] %s%s%s [%d] : %s', $sTimeStamp, $aBacktrace['class'], $aBacktrace['type'], $aBacktrace['function'], $aBacktrace['line'], $sMessage);

			if ($this->config['verbosity']['echo_errors'])
				printf("$sMessage\n");
		} else if ($iType == self::DEBUG && $this->config['verbosity']['echo_debug']) {
			echo sprintf('[%s] [D] : %s', $sTimeStamp, $sMessage) . "\n";
		} else if ($iType == self::LOG && $this->config['verbosity']['echo_log']) {
			echo sprintf('[%s] [L] : %s', $sTimeStamp, $sMessage) . "\n";
		}
	}

	private function disconnect($i) {
		socket_close($this->clients[$i]);
		$this->clients[$i] = NULL;
	}

	private function connect() {
		$this->socket_server = stream_socket_server($this->config['main']['protocol'] . "://{$this->config['main']['address']}:{$this->config['main']['port']}", $errno, $errstr);
		//$this->noblock($this->socket_server);
	}

	private function send($client, $str) {
		stream_socket_sendto($client, $str, 8092);
	}

	private function noblock($client) {
		if (function_exists('socket_import_stream')) {
			$socket = socket_import_stream($client);
			@socket_set_option($socket, SOL_SOCKET, SO_KEEPALIVE, 1);
			@socket_set_option($socket, SOL_SOCKET, TCP_NODELAY, 1);
		}
		if (!stream_set_blocking($client, 0)) {
			$this->log('Could not bind on ' . $this->config['main']['address'] . ':' . $this->config['main']['port'], self::ERROR);
		}
	}

	private function add() {
		$client = @stream_socket_accept($this->socket_server);
		$this->noblock($client);
		if (is_resource($client)) {
			$port = $this->getRemotePort($client);
			$this->clients[$port] = $client;
			$this->log('New incoming connection ' . $this->getName($client, TRUE), self::DEBUG);
			$this->log('Total connection ' . count($this->clients), self::DEBUG);
		}
	}

	public function start() {
		$this->connect();
		while (true) {
			//$read = array_merge(array($this->socket_server), $this->clients);
			$read = array($this->socket_server);
			$write = $this->clients;
			$except = NULL;
			if ($n = stream_select($read, $write, $except, 0)) {
				if ($n > 0) {
					if ($read) {
						$this->add();
					}
					if ($write) {
						foreach ($write as $v) {
							$this->onMessage($v);
						}
					}
				}
			}

			//continue;

			foreach ($this->clients as $port => $v) {
				//$this->onMessage($v, $port);
			}

			$this->clients = array_filter($this->clients, function($v) {
				$name = $this->getName($v, TRUE);
				$results = exec("netstat -apn | grep '{$name}' | awk '{print $5}'");
				if (empty($results) || $results == "DGRAM") {
					@fclose($v);
					return false;
				} else {
					return true;
				}
			});
		}
		return;
		if (!socket_bind($this->socket_server, $this->config['main']['address'], $this->config['main']['port'])) {
			$this->log('Could not bind on ' . $this->config['main']['address'] . ':' . $this->config['main']['port'] . ' ( ' . socket_strerror(socket_last_error()) . ' ).', self::ERROR);
		} else if (!socket_listen($this->socket_server, $this->config['main']['backlog'])) {
			$this->log('Could not put main socket in listening mode ( ' . socket_strerror(socket_last_error()) . ' ).', self::ERROR);
		} else if (!socket_set_nonblock($this->socket_server)) {
			$this->log('Could not set main socket in non-blocking mode ( ' . socket_strerror(socket_last_error()) . ' ).', self::ERROR);
		} else {
			$this->iStartTime = time();

			$this->log('Server started on ' . $this->config['main']['address'] . ':' . $this->config['main']['port'] . ' .', self::LOG);

			while (true) {
				$aRead = array_merge(array($this->socket_server), $this->clients);

				if (socket_select($aRead, $aWrite, $aExcept, $this->config['main']['select_timeout'])) {
					if (in_array($this->socket_server, $aRead)) {
						if (($client = @socket_accept($this->socket_server))) {
							$port = socket_getpeername($client, $addr, $port) ? $port : FALSE;
							$this->clients[$port] = $client;
							$this->log('New incoming connection ' . self::getName($client), self::DEBUG);
							$this->log('Total connection ' . count($this->clients), self::DEBUG);
						} else
							$this->log('Could not accept a new connection ( ' . socket_strerror(socket_last_error()) . ' ).', self::ERROR);
					}
				}

				foreach ($this->clients as $i => $client) {
					if (in_array($client, $aRead)) {
						$this->handleClientRequest($client, $i);
					}
				}

				$this->clients = array_filter($this->clients, function($v) {
					$name = $this->getName($v);
					$results = exec("netstat -apn | grep '{$name}' | awk '{print $5}'");
					if ($results != "") {
						return true;
					} else {
						return false;
					}
				});
			}
		}
	}

}
?>