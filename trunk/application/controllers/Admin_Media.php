<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_Media extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->loadService("Media");
	}

	//文章管理
	public function index() {
		$this->view('admin/media/index');
	}

	public function get_list() {
		$post = $this->input->post();
		$channels = array();
		$list = $this->Media_service->get_media_list($post);
		foreach ($list['list'] as $k => $v) {
			$channels[] = array(
					"id" => $v['id'],
					"name" => $v['name'],
					"dir" => $v['dir']
			);
		}
		print_json(array(
			"rows" => $channels,
			"total" => $list['total']
		));
	}

	public function recommand() {
		$id = $this->input->post("id");
		$mid = $this->input->post("mid");
		print_json($this->Media_service->setAttr($id, $mid, "recommand", true));
	}

	public function hot() {
		$id = $this->input->post("id");
		$mid = $this->input->post("mid");
		print_json($this->Media_service->setAttr($id, $mid, "attr", "hot"));
	}

	public function news() {
		$id = $this->input->post("id");
		$mid = $this->input->post("mid");
		print_json($this->Media_service->setAttr($id, $mid, "attr", "new"));
	}

	public function del_attr() {
		$id = $this->input->post("id");
		$mid = $this->input->post("mid");
		print_json($this->Media_service->delAttr($id, $mid));
	}

	/**
	 * 修改
	 */
	public function set_attr() {
		$input = $this->input->post(NULL);
		if (!empty($input)) {
			print_json($this->Media_service->addoredit($input));
		}
		$father = $this->Media_service->get_media_list(array("id" => $_GET['id']));
		$this->assign("id", $_GET['id']);
		$this->assign("father", $father);
		$this->view("admin/media/edit");
	}

}
