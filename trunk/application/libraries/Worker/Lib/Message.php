<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Message {
	private $message_queue;
	private $key;

	public function __construct($options = array()) {
		$defaults = array("key" => "msg");
		$options = array_merge($defaults, $options);
		$this->key = $options["key"];
		$this->message_queue = $this->getQueue();
	}

	private function getKey($key) {
		return hexdec($key);
	}

	private function getQueue() {
		$message_queue_key = $this->getKey($this->key);
		$message_queue = msg_get_queue($message_queue_key, 0666);
		if (!$message_queue) {
			return false;
		}
		return $message_queue;
	}

	public function send($msg, $type = 1) {
		if (!$this->message_queue)
			return false;
		return msg_send($this->message_queue, $type, $msg);
	}

	public function recive($callback) {
		if (!$this->message_queue || !is_callable($callback))
			return false;
		msg_receive($this->message_queue, 0, $message_type, 1024, $message, true, MSG_IPC_NOWAIT);
		return call_user_func($callback, $message, $message_type);
	}

}
