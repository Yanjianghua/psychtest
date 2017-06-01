<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_Recovery extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->loadService("Article","Media");
		$this->loadModel("Article");
	}

	/**
	 * 加载主页面
	 */
	public function index() {
		$this->view("admin/article/recovery");
	}

	/**
	 * 获取列表
	 */
	public function get_list() {
		$input = $this->input->post(NULL, TRUE);
		if (empty($input['name'])) {
			print_json(wrrong_msg(MSG_INVALID_ARGUMENTS));
		}
		$user = $this->User_model->select("id")->where("username", $input['name'])->get_item();
		$input['uid'] = $user['id'];
		$input['format'] = TRUE;
		$input['admin'] = TRUE;
		$input['status'] = "-2";
		print_json($this->Article_service->get_list($input));
	}

	/**
	 * 彻底删除
	 */
	public function del() {
		$id = $this->input->post("id");
		print_json($this->Article_service->delete($id));
	}
	/**
	 * 恢复
	 */
	public function recovery() {
		$options = $this->input->post("options");
		parse_alert($this->Article_service->delete($options, TRUE), "JSON");
	}

}
