<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_Layout extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->loadService("User", "Media", "Article");
		$this->loadModel("User");
	}

	public function index() {
		$this->view('admin/layout/index');
	}

}
