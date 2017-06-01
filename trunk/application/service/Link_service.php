<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Link_service extends MY_Service {
	const MSG_ERROR_PARAMETER = "参数无效";
	const MSG_ERROR_TITLE = "标题不能为空";
	const MSG_ERROR_URL = "链接不能为空";

	public function __construct() {
		parent::__construct();
		$this->loadModel("Link");
	}

	//友情链接添加和修改
	public function add($options = array()){
		$optionsKeys = array(
			"id",
			"title",
			"url",
			"comment"
		);
		$options = formatOptions($options, $optionsKeys);
		extract($options);
		$data = array();
		if($id){
			$item = $this->Link_model->where("id", $id)->get_item();
			if(empty($item)){
				return wrrong_msg(MSG_INVALID_ARGUMENTS);
			}
		}
		if(empty($title)){
			return wrrong_msg(self::MSG_ERROR_TITLE);
		}
		if(empty($url)){
			return wrrong_msg(self::MSG_ERROR_URL);
		}

		$data['title'] = $title;
		$data['url'] = $url;
		$data['comment'] = $comment;

		if(!empty($id)){
			$success = $this->Link_model->set($data)->where("id", $id)->update();
		}else{
			$success = $this->Link_model->set($data)->insert();
		}
		if(!$success){
			return wrrong_msg(MSG_SERVICE_BUSY);
		}
		return $id ? success_msg(MSG_EDIT_SUCCESS) : success_msg(MSG_ADD_SUCCESS);
	}

	//友情链接查看
	public function get_list($options = array()){
		$optionsKeys = array(
			"id"
		);
		$options = formatOptions($options, $optionsKeys);
		extract($options);

		if($id){
			$list = $this->Link_model->where("id", $id)->get_item();
			if(empty($list)){
				return wrrong_msg(MSG_ERROR_PARAMETER);
			}
		}else{
			$list = $this->Link_model->order_by("id", "DESC")->get_list();
		}
		return $list;
	}

	//友情链接删除
	public function delete($id){
		$success = $this->Link_model->where("id", $id)->delete();
		if(!$success){
			return wrrong_msg(MSG_SERVICE_BUSY);
		}
		return success_msg(MSG_DELETE_SUCCESS);
	}

}
?>