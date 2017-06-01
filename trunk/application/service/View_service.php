<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class View_service extends MY_Service {

	public function __construct() {
		parent::__construct();
		$this->load->model(config_item("style") . "_template_model", "view_model");
	}

	public function getData() {
		$arg = func_get_args();
		if (empty($arg[0])) {
			return array();
		}
		$name = $arg[0];
		unset($arg[0]);
		return call_user_func_array(array(
			$this->view_model,
			$name
		), $arg);
	}

}
?>