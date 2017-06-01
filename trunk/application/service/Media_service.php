<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Media_service extends MY_Service {

	public function __construct() {
		parent::__construct();
		$this->loadService("Channel");
		$this->loadModel("Media", "User", "Channel");
		$this->load->library("Curl");
	}

	public function format_select($list) {
		$result = array();
		$result[0]['id'] = "";
		$result[0]['text'] = "不限制";
		$result[0]['selected'] = true;
		$key = 1;
		foreach ($list as $k => $v) {
			$result[$key] = array();
			$result[$key]['id'] = json_encode(array($k => getPrimeryKeys($v['channel'])));
			$result[$key]['text'] = $v['media']['name'];
			foreach ($v['channel'] as $vk => $val) {
				$result[$key]['children'][] = array(
					"id" => json_encode(array($k => array($val['id']))),
					"text" => $val['name']
				);
			}
			$key++;
		}
		return $result;
	}

	private function makeData() {
		return array(
			"recommand" => array(),
			"attr" => array()
		);
	}

	public function setAttr($id, $mid, $key, $value) {
		if (empty($id) || empty($mid) || empty($key) || empty($value)) {
			return wrrong_msg(MSG_INVALID_ARGUMENTS);
		}
		$data = $this->getAttr();
		if (!isset($data[$mid])) {
			$data[$mid] = $this->makeData();
		}
		$data[$mid][$key][$id] = $value;
		$this->writeAttr($data);
		return success_msg(MSG_METHOD_SUCCESS);
	}

	public function getAttr() {
		if (file_exists(APPPATH . "cache/channel_setting.cache")) {
			$data = json_decode(file_get_contents(APPPATH . "cache/channel_setting.cache"), TRUE);
		}
		if (empty($data)) {
			$data = array();
		}
		return $data;
	}

	public function delAttr($id, $mid) {
		if (empty($id) || empty($mid)) {
			return wrrong_msg(MSG_INVALID_ARGUMENTS);
		}
		$data = $this->getAttr();
		unset($data[$mid]['recommand'][$id]);
		unset($data[$mid]['attr'][$id]);
		$this->writeAttr($data);
		return success_msg(MSG_METHOD_SUCCESS);
	}

	public function writeAttr($value) {
		file_put_contents(APPPATH . "cache/channel_setting.cache", json_encode($value));
	}

	public function autoWriteAttr() {
		$this->writeAttr(array());
		$today = date("Y-m-d 00:00:00");
		$query = $this->db->query("SELECT cid,mid,COUNT(*) AS t FROM statistics WHERE `time` IN (" . strtotime($today . " -2 days") . "," . strtotime($today . " -3 days") . ") AND calc > 50 GROUP BY mid,cid HAVING t = 2");
		$recommand = $query->result_array();
		$data = array();
		foreach ($recommand as $v) {
			$this->setAttr($v['cid'], $v['mid'], "recommand", true);
		}

		$new = $this->Mycmsadmin_Media_model->where(array("status"=>Mycmsadmin_Media_model::STATUS_ACTIVE, "addtime >=" => strtotime($today . " -30 days")))->get_list();
		foreach ($new as $v) {
			$channels = $this->Channel_service->getChannel($v);
			foreach ($channels as $v1) {
				$this->setAttr($v1['id'], $v['id'], "attr", "new");
			}
		}

		$query = $this->db->query("SELECT cid,mid,sum(total) as t FROM statistics WHERE `time` IN (" . strtotime($today . " -1 days") . "," . strtotime($today . " -2 days") . "," . strtotime($today . " -3 days") . ") group by cid,mid order by t DESC limit 10");
		$hot = $query->result_array();
		foreach ($hot as $v) {
			$this->setAttr($v['cid'], $v['mid'], "attr", "hot");
		}

		$query = $this->db->query("SELECT cid,mid FROM statistics WHERE `time` IN (" . strtotime($today . " -2 days") . ") AND calc=0");
		$zero = $query->result_array();
		foreach ($zero as $v) {
			$this->setAttr($v['cid'], $v['mid'], "attr", "zero");
		}
	}

	public function get_media_list($options = array()) {
		$optionsKeys = array(
			"id",
			"page",
			"rows",
			"name"
		);
		extract(formatOptions($options, $optionsKeys));
		$where =array();
		if (optionExists($id)) {
			$where['id'] = $id;
		}
		if (optionExists($name)) {
			$where['name like'] = "%$name%";
		}

		if (optionExists($rows) && optionExists($page)) {
			$count = $this->Channel_model->where($where)->count();
			$result['total'] = $count;
			$pmix = ($page - 1) * $rows;
			$this->Channel_model->limit($rows, $pmix);
		}

		$list = $this->Channel_model->where($where)->get_list();
		$result['list'] = $list;
		return $result;
	}

	public function addoredit($options = array()) {
		$optionsKeys = array(
				"id",
				"name",
				"dir"
		);
		extract(formatOptions($options, $optionsKeys));
		$where =array();
		$data =array();
		if (optionExists($id)) {
			$where['id'] = $id;
		}
		if (optionExists($name)) {
			$data['name'] = $name;
		}
		if (optionExists($dir)) {
			$data['dir'] = $dir;
		}
		$success = $this->db->set($data)->where($where)->update(Channel_model::$_table);
		return success_msg($success);
	}

}
