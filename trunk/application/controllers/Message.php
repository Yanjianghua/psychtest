<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Message extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->loadService("Message");
		$this->load->library("Curl");

	}

	public function index() {
		$input = $this->input->post();
		if (!empty($input)) {
			$this->add($input);
			alert(array("msg"=>'留言成功'));
		}
		$this->view(config_item("style") . '/message/index');
	}

	public function lindex() {
		$input = $this->input->post();
		if (!empty($input)) {
			$this->add($input);
			alert(array("msg"=>'留言成功'));
		}
		$this->view('admin/message/index');
	}

	public function add($input) {
		if (!empty($input)) {
			alert($this->Message_service->insertorupdate($input));
		}
	}
	public function edit() {
		$input = $this->input->post();
		if (!empty($input)) {
			print_json($this->Message_service->insertorupdate($input));
		}
		$query = $this->db->where("id", $_GET['id'])->limit(1)->get(Message_model::$_table);
		$message = $query->result_array();
		$this->assign("message", $message);
		$this->view('admin/message/edit');
	}

	public function get_list() {
		$input = $this->input->post();
		if (!empty($input)) {
			$rows = $this->Message_service->get_list($input);
			$rows['rows']=$rows['list'];
			foreach($rows['rows'] as $k=>$v){
				$rows['rows'][$k]['addtime'] = date("Y-m-d H:i:s", $v['addtime']);
			}
			print_json($rows);
		}
		$this->view('admin/message/edit');
	}

	//删除
	public function delete() {
		$options = $this->input->post("options");
		parse_alert($this->Message_service->delete($options[0]['id'], TRUE), "JSON");
	}

}
