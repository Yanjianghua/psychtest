<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Channel_service extends MY_Service {
	const WRRONG_MSG_DIR_ILLEGAL = "栏目dir包含非法字符";
	const WRRONG_MSG_DIR_UNEDITABLE = "栏目dir有文章，不可编辑";

	public function __construct() {
		parent::__construct();
		$this->loadModel("Channel", "Article");
	}

	public function get_list($options = array()) {
		$optionsKeys = array(
			"hasArticle",
			"limit"
		);
		$options = formatOptions($options, $optionsKeys);
		extract($options);
		if (optionExists($limit)) {
			$this->Channel_model->limit($limit);
		}
		$list = $this->Channel_model->get_list();
		if (optionExists($hasArticle) && $hasArticle) {
			foreach ($list as $k => $channel) {
				$list[$k]['url'] = formatUrl('channel', $channel['dir'], '');
				$list[$k]['hasArticle'] = false;
				$hasArticle = $this->Article_model->select("id")->where("channelid", $channel['id'])->get_item();
				if (!empty($hasArticle)) {
					$list[$k]['hasArticle'] = true;
				}
			}
		}
		return $list;
	}

	public function update($options = array()) {
		//整理选项
		$optionsKeys = array(
			"id",
			"name",
			"dir"
		);
		$options = formatOptions($options, $optionsKeys);
		extract($options);
		$data = array();
		if ($id) {
			$channel = $this->Channel_model->where("id", $id)->get_item();
			if (empty($channel)) {
				return wrrong_msg(MSG_INVALID_ARGUMENTS);
			}
		}
		if (optionExists($name)) {
			$data['name'] = $name;
		}
		if (optionExists($dir)) {
			if (!preg_match("/^[0-9a-zA-Z]*$/", $dir)) {
				return wrrong_msg(self::WRRONG_MSG_DIR_ILLEGAL);
			}
			$hasArticle = $this->Article_model->select("id")->where("channelid", $id)->get_item();
			if (!empty($hasArticle)) {
				return wrrong_msg(self::WRRONG_MSG_DIR_UNEDITABLE);
			}
			$data['dir'] = $dir;
		}
		if (!empty($id)) {
			$success = $this->Channel_model->set($data)->where("id", $id)->update();
		} else {
			$success = $this->Channel_model->set($data)->insert();
		}
		if (!$success) {
			return wrrong_msg(MSG_SERVICE_BUSY);
		}
		return $id ? success_msg(MSG_EDIT_SUCCESS) : success_msg(MSG_ADD_SUCCESS);
	}

}
?>