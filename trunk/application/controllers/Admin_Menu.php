<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_Menu extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->loadService("Menu", "Roles");
	}

	/**
	 * 加载主页面
	 */
	public function index() {
		$this->view("admin/menu/index");
	}

	/**
	 * 获取列表
	 */
	public function get_list() {
		$input = $this->input->post(NULL);
		print_json($this->Menu_service->get_list($input));
	}

	/**
	 *	获取用户菜单
	 */
	public function get_menu() {
		$input['usermenu'] = TRUE;
		print_json($this->Menu_service->get_list($input));
	}

	/**
	 * 修改
	 */
	public function edit() {
		$input = $this->input->post(NULL);
		if (!empty($input)) {
			parse_alert($this->Menu_service->addoredit($input), "JSON");
		}
		$this->assign("edit", TRUE);
		$father = $this->Menu_service->get_list(array("select" => TRUE));
		$this->assign("father", $father);
		$this->view("admin/menu/edit");
	}

	/**
	 * 添加
	 */
	public function add() {
		$input = $this->input->post(NULL);
		if (!empty($input)) {
			parse_alert($this->Menu_service->addoredit($input), "JSON");
		}
		$father = $this->Menu_service->get_list(array("select" => TRUE));
		$this->assign("father", $father);
		$this->view("admin/menu/add");
	}

	/**
	 * 删除
	 */
	public function del() {
		$input = $this->input->get(NULL);
		parse_alert($this->Menu_service->delete($input), "JSON");
	}

}
