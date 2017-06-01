<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Message_service extends MY_Service {

	public function __construct() {
		parent::__construct();
		$this->loadModel("Message");
		$this->load->library("Curl");
	}

	public function get_list($options) {
		$options = formatOptions($options, array(
			"id",
			"page",
			"limit",
			"rows",
		));
		extract($options);
		$where = array();

		if (optionExists($id)) {
			$where['id'] = $id;
		}

		if (optionExists($limit) && optionExists($page)) {
			$total = $this->Message_model->where($where)->count();
			if ($wap) {
				$pages = pages_m($total, $limit, formatUrl("channel_m", $dir, ''));
			} else {
				$pages = pages($total, $limit, formatUrl("channel", $dir, ''));
			}
			$offset = ($page - 1) * $limit;
		}

		if (optionExists($limit)) {
			$offset = isset($offset) ? $offset : 0;
			$this->Message_model->limit($limit, $offset);
		}

		$list = $this->Message_model->where($where)->order_by("id", "DESC")->get_list();

		return array(
			"list" => $list,
			"total" => isset($total) ? $total : "",
			"pages" => isset($pages) ? $pages : ""
		);
	}

	public function insertorupdate($data) {
		//整理选项
		$optionsKeys = array(
			"id",
			"username",
			"age",
			"qq",
			"content",
			"telephone",
			"addtime"
		);
		$data = formatOptions($data, $optionsKeys);
		extract($data);
		$data = array();

		if (optionExists($id)) {
			$data['id'] = $id;
		}
		if (optionExists($username)) {
			$data['username'] = $username;
		}
		if (optionExists($qq)) {
			$data['qq'] = $qq;
		}
		if (optionExists($age)) {
			$data['age'] = $age;
		}
		if (optionExists($content)) {
			$data['content'] = $content;
		}
		if (optionExists($telephone)) {
			$data['telephone'] = $telephone;
		}
		if (optionExists($addtime)) {
			$data['addtime'] = $addtime;
		}else{
			$data['addtime'] = time();
		}

		if ($id != "") {
			//update
			$success = $this->Message_model->set($data)->where("id", $id)->update();
			if (!$success) {
				return wrrong_msg(MSG_SERVICE_BUSY);
			}
		} else {
			//insert
			$success = $this->Message_model->set($data)->insert();
			if (!$success) {
				return wrrong_msg(MSG_SERVICE_BUSY);
			}
		}
		return $id ? success_msg($success) : 0;
	}

	public function delete($id) {
		$success = $this->Message_model->where("id", $id)->delete();
		if (!$success) {
			return wrrong_msg(MSG_SERVICE_BUSY);
		}
		return success_msg(MSG_METHOD_SUCCESS);
	}
}
?>