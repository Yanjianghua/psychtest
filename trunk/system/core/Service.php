<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class CI_Service {
	private static $instance;
	public function __construct() {
		self::$instance =& $this;
		log_message('debug', "Service Class Initialized");
	}

	function __get($key) {
		return get_instance()->$key;
	}

}
