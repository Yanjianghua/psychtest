<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_Roles extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->loadService("Roles", "User", "Menu");
	}

	/**
	 * 加载主页面
	 */
	public function index() {
		$this->view("admin/roles/index");
	}

	/**
	 * 获取列表
	 */
	public function get_list() {
		$input = $this->input->post(NULL);
		print_json($this->Roles_service->get_list($input));
	}

	/**
	 * 修改
	 */
	public function edit() {
		$id = $this->input->get("id");
		$role = $this->Roles_model->where("id", $id)->get_item();
		$this->assign("item", $role);
		$this->add();
	}

	/**
	 * 添加
	 */
	public function add() {
		$post = $this->input->post(NULL);
		if (!empty($post)) {
			parse_alert($this->Roles_service->addoredit($post), "JSON");
		}
		$this->view("admin/roles/edit");
	}

	/**
	 * 删除
	 */
	public function del() {
		$input = $this->input->get(NULL);
		parse_alert($this->Roles_service->delete($input), "JSON");
	}

	/**
	 * 禁用
	 */
	public function disable() {
		$id = $this->input->post("id");
		parse_alert($this->Roles_service->setStatus($id, FALSE), "JSON");
	}

	/**
	 * 启用
	 */
	public function enable() {
		$id = $this->input->post("id");
		parse_alert($this->Roles_service->setStatus($id, TRUE), "JSON");
	}

	/**
	 * 更新权限
	 */
	public function per() {
		$input = $this->input->post(NULL);
		if (!empty($input)) {
			parse_alert($this->Roles_service->auth($input), "JSON");
		}
		$id = $this->input->get("id");
		if (empty($id)) {
			print_json(MSG_INVALID_ARGUMENTS);
		}
		$this->assign("id", $id);
		$this->view("admin/roles/roles_per");
	}

	/**
	 * 获取权限列表
	 */
	public function get_per_list() {
		$id = $this->input->get("id");
		if (empty($id)) {
			print_json(MSG_INVALID_ARGUMENTS);
		}
		$input['rid'] = $id;
		$menu = $this->Menu_service->get_list($input);
		print_json($menu);
	}

}
