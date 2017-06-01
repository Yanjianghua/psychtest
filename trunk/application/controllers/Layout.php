<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Layout extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->loadService("View");
	}

	public function index() {
		$data = $this->View_service->getData("index");

		$this->assign("data", $data);
		$this->view(config_item("style") . '/layout/index');
	}

}
