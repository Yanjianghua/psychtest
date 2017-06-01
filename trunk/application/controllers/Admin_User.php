<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_User extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->loadService("User", "Media");
		$this->loadModel("User");
	}

	//用户管理
	public function index() {
		$this->view('admin/user/index');
	}

	public function get_list() {
		$input = $this->input->post(NULL, TRUE);
		$input['admin'] = true;
		print_json($this->User_service->get_lists($input));
	}

	//添加用户
	public function add() {
		$post = $this->input->post(NULL);
		if (!empty($post)) {
			parse_alert($this->User_service->add($post), "JSON");
		}
		$id = $this->input->get("id", TRUE);
		$this->assign("id", $id);
		$this->view("admin/user/add");
	}

	//生成密码
	public function create_password() {
		print_json(create_password());
	}

	//充值
	public function add_coin() {
		$post = $this->input->post(NULL);
		if (!empty($post)) {
			parse_alert($this->User_service->edit_coin($post), "JSON");
		}
		$id = $this->input->get("id", TRUE);
		$this->assign("id", $id);
		$this->view("admin/user/coin");
	}

	//充值记录
	public function add_log() {
		$id = $this->input->get("id", TRUE);
		$this->assign("id", $id);
		$this->view("admin/user/log");
	}

	public function log() {
		$id = $this->input->post("id");
		$page = $this->input->post("page");
		$limit = $this->input->post("rows");
		$data = $this->User_service->log_list($id, $page, $limit);
		print_json($data);
	}

	public function status() {
		$id = $this->input->post("id");
		$status = $this->input->post("status");
		$data['status'] = $status;
		$success = $this->User_model->where("id", $id)->set($data)->update();
		if (!$success) {
			parse_alert(wrrong_msg(MSG_SERVICE_BUSY), "JSON");
		}
		parse_alert(success_msg(MSG_METHOD_SUCCESS), "JSON");
	}

	public function reset() {
		$post = $this->input->post(NULL);
		if (!empty($post)) {
			parse_alert($this->User_service->update_pwd($post), "JSON");
		}
		$id = $this->input->get("id", TRUE);
		$this->assign("id", $id);
		$this->view("admin/user/reset");
	}

	//媒体
	public function media() {
		$post = $this->input->post(NULL);
		if (!empty($post)) {
			parse_alert($this->User_service->set_media($post), "JSON");
		}
		$id = $this->input->get("id", TRUE);
		$user = $this->User_model->where("id=$id")->get_item();
		$auth = decompress($user['auth']);
		$media = $this->Media_service->get_media_list(array("format" => TRUE,"ace" => TRUE));
		$this->assign("id", $id);
		$this->assign("auth", $auth);
		$this->assign("media", $media['list']);
		$this->view("admin/user/media");
	}

	public function ad() {
		$post = $this->input->post(NULL);
		if (!empty($post)) {
			parse_alert($this->User_service->update_ad($post), "JSON");
		}
		$id = $this->input->get("id", TRUE);
		$user = $this->User_model->where("id=$id")->get_item();
		$this->assign("user", $user);
		$this->assign("id", $id);
		$this->view("admin/user/ad");
	}

	public function setInneruser() {
		$id = $this->input->post("id");
		$status = $this->input->post("status");
		parse_alert($this->User_service->setInneruser($id, $status), "JSON");
	}

	public function setGooduser() {
		$id = $this->input->post("id");
		$status = $this->input->post("status");
		parse_alert($this->User_service->setGooduser($id, $status), "JSON");
	}

	public function setUseLink() {
		$id = $this->input->post("id");
		$status = $this->input->post("status");
		parse_alert($this->User_service->setUseLink($id, $status), "JSON");
	}

	//第三方广告设置
	public function setUseAdv() {
		$id = $this->input->post("id");
		$Third_adv = $this->input->post("Third_adv");
		parse_alert($this->User_service->setUseAdv($id, $Third_adv), "JSON");
	}

}
