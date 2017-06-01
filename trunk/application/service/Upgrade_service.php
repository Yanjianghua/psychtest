<?php
class Upgrade_service extends MY_Service {
	const VERSION = "1.0.0";

	public function __construct() {
		parent::__construct();
		$this->load->library("Curl");
		$this->configPath = APPPATH . "config/";
	}

	public function update_config($file, $ini, $value) {
		$file = $this->configPath . $file . ".php";
		if (!file_exists($file))
			return false;
		$str = file_get_contents($file);
		$str2 = preg_replace_callback('/(\\$[a-zA-Z0-9]*?\[["\']?' . preg_quote($ini) . '["\']?\]\s*=\s*)([\s\S]*?);/', function($matches) use (&$value) {
			return $matches[1] . $value . ";";
		}, $str);
		file_put_contents($file, $str2);
	}

	public function add_config($file, $value) {
		$file = $this->configPath . $file . ".php";
		if (!file_exists($file))
			return false;
		$str = file_get_contents($file);
		$str .= $value . ";\n";
		file_put_contents($file, $str);
	}

}
?>