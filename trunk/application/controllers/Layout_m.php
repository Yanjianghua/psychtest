<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Layout_m extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->loadService("View");
	}

	public function index() {
		$data = $this->View_service->getData("m_index");

		$this->assign("data", $data);
		$this->view(config_item("style") . '/m/layout/index');
	}

}
