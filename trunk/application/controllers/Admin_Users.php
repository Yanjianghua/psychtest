<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_Users extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->loadService("Users", "Roles");
		$this->loadModel("AdminUser");
	}


	/**
	 * 加载主页面
	 */
	public function index() {
		$Users = $this->Users_service->get_list(array("status" => User_model::STATUS_ACTIVE));
		$this->assign("Users", $Users['rows']);
		$this->view("admin/users/index");
	}

	/**
	 * 获取列表
	 */
	public function get_list() {
		$input = $this->input->post(NULL);
		print_json($this->Users_service->get_list($input));
	}

	/**
	 * 修改
	 */
	public function edit() {
		$input = $this->input->post(NULL);
		if (!empty($input)) {
			parse_alert($this->Users_service->addoredit($input), "JSON");
		}
		$get = $this->input->get(NULL);
		$Users = $this->Users_service->get_list($get);
		$this->assign("Users", $Users['rows']);
		$Roles = $this->Roles_service->get_list();
		$this->assign("roles", $Roles['rows']);
		$this->view("admin/users/edit");
	}

	/**
	 * 添加
	 */
	public function add() {
		$input = $this->input->post(NULL);
		if (!empty($input)) {
			parse_alert($this->Users_service->addoredit($input), "JSON");
		}
		$Roles = $this->Roles_service->get_list();
		$this->assign("roles", $Roles['rows']);
		$this->view("admin/users/add");
	}

	/**
	 * 删除
	 */
	public function del() {
		$input = $this->input->get(NULL);
		parse_alert($this->Users_service->delete($input), "JSON");
	}

	/**
	 * 禁用
	 */
	public function disable() {
		$input = $this->input->post(NULL);
		$input['status'] = FALSE;
		parse_alert($this->Users_service->addoredit($input), "JSON");
	}

	/**
	 * 启用
	 */
	public function enable() {
		$input = $this->input->post(NULL);
		$input['status'] = TRUE;
		parse_alert($this->Users_service->addoredit($input), "JSON");
	}


}
