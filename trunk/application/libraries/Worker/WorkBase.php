<?php
defined('BASEPATH') OR exit('No direct script access allowed');
define("WORKER_BASE", dirname(__FILE__));
define("WORKER_CACHE_PATH", WORKER_BASE . DIRECTORY_SEPARATOR . "Cache" . DIRECTORY_SEPARATOR);
define("WORKER_LIB_PATH", WORKER_BASE . DIRECTORY_SEPARATOR . "Lib" . DIRECTORY_SEPARATOR);
define("WORKER_APP_PATH", WORKER_BASE . DIRECTORY_SEPARATOR . "App" . DIRECTORY_SEPARATOR);
include (WORKER_LIB_PATH . "Memory.php");
include (WORKER_LIB_PATH . "Message.php");

class WorkBase {

	public static function callback(&$callback, $arguments = array()) {
		if (is_callable($callback)) {
			if (call_user_func_array($callback, $arguments) === false) {
				return false;
			}
			return true;
		}
		return false;
	}

	public static function createFork($callback) {
		$pid = pcntl_fork();
		if ($pid == 0) {
			umask(0);
			$pid = posix_getpid();
			self::callback($callback, array($pid));
			exit ;
		}
		return $pid;
	}

	public static function monitor($workers, $successCallback, $retry = false) {
		while (count($workers) > 0) {
			foreach ($workers as $key => $worker) {
				$res = pcntl_waitpid($worker->pid, $status);
				if ($retry) {
					if (pcntl_wifexited($status)) {
						if (pcntl_wexitstatus($status) == 255) {
							$workers[$key]->run();
							continue;
						}
					}
				}
				if ($res == -1 || $res > 0) {
					unset($workers[$key]);
				}
			}
			usleep(10000);
		}
		self::callback($successCallback);
	}

}

include (WORKER_APP_PATH . "/Worker.php");
