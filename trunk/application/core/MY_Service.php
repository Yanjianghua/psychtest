<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MY_Service extends CI_Service {

	public function __construct() {
		parent::__construct();
	}

	public function loadModel($model) {
		$models = func_get_args();
		if (count($models) > 1) {
			foreach ($models as $k => $v) {
				$this->load->model($v . "_model");
			}
			return;
		}
		$this->load->model($model . "_model");
	}

	public function loadService($service) {
		$services = func_get_args();
		if (count($services) > 1) {
			foreach ($services as $k => $v) {
				$this->load->service($v . "_service");
			}
			return;
		}
		$this->load->service($service . "_service");
	}

}
