<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Articlea_service extends MY_Service {
	const MSG_ERROR_CHANNELID = "Argument 'channelid' can't be empty";
	const MSG_ERROR_TITLE = "Argument 'title' can't be empty";
	const MSG_ERROR_CONTENT = "Argument 'content' can't be empty";
	const MSG_ERROR_UID = "Argument 'uid' can't be empty";
	const MSG_EDIT_SUCCESS = "Edit article success";
	const MSG_ADD_SUCCESS = "Add article success";
	const MSG_DELETE_SUCCESS = "Delete article success";

	public function __construct() {
		parent::__construct();
		$this->loadService("ArticleTable");
		$this->loadModel("Article", "Channel", "ArticleAdd");
		$this->load->library("Curl");
	}

	/**
	 * ajax获取
	 */
	public function read_addoredit_ajax($options = array()){
		$result = Curl::post(config_item("server_url")."API/read_addoredit_ajax/", $options);
		echo $result;
	}

	/**
	 * 获取数量
	 */
	public function get_num($options = array(), $get = false){
		$optionsKeys = array(
			"pid",
			"uid",
			"readreal"
		);
		extract(formatOptions($options, $optionsKeys));
		$postdata = cms_auth_code();
		if (optionExists($pid)) {
			$postdata['pid'] = $pid;
		}else{
			return wrrong_msg(MSG_INVALID_ARGUMENTS);
		}
		if (optionExists($uid)) {
			$postdata['uid'] = $uid;
		}
		if (optionExists($readreal)) {
			$postdata['readreal'] = $readreal;
		}
		$postdata['olurl'] = $this->config->config['url']['oldomain'].$this->config->config['url']['home'];
		if($get){
			$postdata['serverurl'] = config_item("server_url")."API/read_addoredit/";
			return $postdata;
		}else{
			$result = Curl::post(config_item("server_url")."API/read_addoredit/", $postdata);
		}

		return $result;
	}

	public function get_by_dir($dir) {
		if (!$dir) {
			return array();
		}
		$article = $this->format($this->Article_model->select("article.*")->join($this->Channel_model, "{this}.channelid={other}.id", "LEFT")->where("channel.dir", $dir)->get_item());
		return $article;
	}

	public function get_prev($article) {
		return $this->format($this->Article_model->select("article.*")->join($this->Channel_model, "{this}.channelid={other}.id", "LEFT")->where(array(
			"article.id <" => $article['id'],
			"channel.dir" => $article['dir']
		))->order_by("article.id", "DESC")->get_item());
	}

	public function get_next($article) {
		return $this->format($this->Article_model->select("article.*")->join($this->Channel_model, "{this}.channelid={other}.id", "LEFT")->where(array(
			"article.id >" => $article['id'],
			"channel.dir" => $article['dir']
		))->order_by("article.id", "ASC")->get_item());
	}

	public function get_rand($limit = 1, $where = "1=1") {
		$sql = "SELECT t1.* FROM `article` AS t1 JOIN (SELECT ROUND(RAND() * ((SELECT MAX(id) FROM `article`) - {$limit} - (SELECT MIN(id) FROM `article`)) + (SELECT MIN(id) FROM `article`)) AS id) AS t2 WHERE t1.id >= t2.id AND {$where} LIMIT {$limit}";
		$query = $this->db->query($sql);
		return $this->format($query->result_array());
	}

	public function get_list($options) {
		$options = formatOptions($options, array(
			"id",
			"page",
			"limit",
			"dir",
			"recommand",
			"thumb",
			"uid",
			"wap",
			"info",
			"title",
			"status"
		));
		extract($options);

		$where = array();

		if (optionExists($id)) {
			$where['article.id'] = $id;
		}

		if (optionExists($dir)) {
			$where['channel.dir'] = $dir;
		}

		if (optionExists($recommand)) {
			$where['recommand'] = $recommand;
		}
		if (optionExists($uid)) {
			$where['uid'] = $uid;
		}
		if (optionExists($title)) {
			if ($title != "") {
				$where['title like'] = "%{$title}%";
			}
		}

		if (optionExists($status)) {
			if($status==0){
				$where['status >='] = $status;
			}elseif($status==1){
				$where['status'] = $status;
			}else{
				$where['status'] = $status;
			}
		}

		if (optionExists($thumb)) {
			if ($thumb) {
				$where['ispic'] = Article_model::ISPIC_YES;
			} else {
				$where['ispic'] = Article_model::ISPIC_NO;
			}
		}
		if (optionExists($limit) && optionExists($page)) {
			$total = $this->Article_model->join($this->Channel_model, "{this}.channelid={other}.id", "LEFT")->where($where)->count();
			if ($wap) {
				$pages = pages_m($total, $limit, formatUrl("channel_m", $dir, ''));
			} else {
				$pages = pages($total, $limit, formatUrl("channel", $dir, ''));
			}
			$offset = ($page - 1) * $limit;
		}

		if (optionExists($limit)) {
			$offset = isset($offset) ? $offset : 0;
			$this->Article_model->limit($limit, $offset);
		}

		$list = $this->Article_model->select("article.*,channel.name as cname")->join($this->Channel_model, "{this}.channelid={other}.id", "LEFT")->where($where)->order_by("article.id", "DESC")->get_list();
		$list = $this->format($list);
		if ($info) {
			$list = $this->info($list, $info);
		}
		return array(
			"list" => $list,
			"total" => isset($total) ? $total : "",
			"pages" => isset($pages) ? $pages : ""
		);
	}

	public function info($list, $select) {
		if (empty($list)) {
			return $list;
		}
		foreach ($list as $k => $v) {
			$add = $this->ArticleAdd_model->select($select)->where("pid", $v['id'])->get_item();
			$list[$k] = array_merge($v, $add);
		}
		return $list;
	}

	public function format($list = array()) {
		if (empty($list)) {
			return $list;
		}
		$one = false;
		if (empty($list[0])) {
			$one = true;
			$list = array($list);
		}
		foreach ($list as $k => $v) {
			$list[$k]['truedir'] = $v['dir'];
			if ($v['utype'] == 2) {
				$list[$k]['dir'] = $v['uid'];
			}
			$list[$k]['pc_url'] = formatUrl("article", $v['dir'], $v['id']);
			$list[$k]['m_url'] = formatUrl("article_m", $v['dir'], $v['id']);
		}
		return $one ? $list[0] : $list;
	}

	public function insertorupdate($data) {
		//整理选项
		$optionsKeys = array(
			"id",
			"title",
			"content",
			"channelid",
			"uid",
			"editor",
			"keywords",
			"description",
			"utype",
			"recommand",
			"status"
		);
		$data = formatOptions($data, $optionsKeys);
		extract($data);
		$data = array();
		$data_add = array();

		if (optionExists($title)) {
			$data['title'] = $title;
		} else {
			return wrrong_msg(self::MSG_ERROR_TITLE);
		}

		if (optionExists($content)) {
			$data_add['content'] = $content;
		} else {
			return wrrong_msg(self::MSG_ERROR_CONTENT);
		}

		if (optionExists($channelid)) {
			$data['channelid'] = $channelid;
		} else {
			return wrrong_msg(self::MSG_ERROR_CHANNELID);
		}

		if (optionExists($uid)) {
			$data['uid'] = $uid;
		}else{
			$data['uid'] = 0;
		}

		if (optionExists($utype)) {
			$data['utype'] = $utype;
		} else {
			$data['utype'] = 1;
		}

		if (optionExists($recommand)) {
			$data['recommand'] = $recommand;
		} else {
			$data['recommand'] = Article_model::RECOMMAND_NO;
		}
		if (optionExists($status)) {
			$data['status'] = $status;
		} else {
			$data['status'] = 0;
		}
		if (optionExists($keywords)) {
			$data_add['keywords'] = $keywords;
		}else{
			$data_add['keywords'] = "";
		}

		if (optionExists($editor)) {
			$data_add['editor'] = $editor;
		}else{
			$data_add['editor'] = "";
		}

		if (optionExists($description)) {
			$data_add['description'] = $description;
		}else{
			$data_add['description'] = "";
		}

		$hasImg = preg_match("/\<img.*?src\=[\"'](.*?)[\"'][^>]*>/i", $content, $image);
		if ($hasImg) {
			$data['ispic'] = 1;
			$data_add['thumb'] = $image[1];
		} else {
			$data['ispic'] = 0;
			$data_add['thumb'] = "";
		}

		$channel = $this->Channel_model->where("id", $data['channelid'])->get_item();
		$data['dir'] = $channel['dir'];
		if ($id != "") {
			//update
			$success = $this->Article_model->set($data)->where("id", $id)->update();
			if (!$success) {
				return wrrong_msg(MSG_SERVICE_BUSY);
			}
			$success = $this->ArticleAdd_model->set($data_add)->where("pid", $id)->update();
			if (!$success) {
				return wrrong_msg(MSG_SERVICE_BUSY);
			}
		} else {
			//insert
			$this->ArticleTable_service->autoCreateTable();
			$data['addtime'] = time();
			$pid = $this->Article_model->insert($data);
			if (!$pid) {
				return wrrong_msg(MSG_SERVICE_BUSY);
			}
			$data_add['pid'] = $pid;
			$success = $this->ArticleAdd_model->insert($data_add);
			if (!$success) {
				return wrrong_msg(MSG_SERVICE_BUSY);
			}
		}
		return $id ? success_msg($success) : success_msg(array(
			"cname" => $channel['name'],
			"aid" => $pid,
			"pc" => formatUrl('article', $data['utype'] == 1 ? $channel['dir'] : $data['uid'], $pid),
			"wap" => formatUrl('article_m', $data['utype'] == 1 ? $channel['dir'] : $data['uid'], $pid)
		));
	}

	public function get_ad($uid, $typeid) {
		$secret = cms_auth_code();
		$result = Curl::post($this->config->config['server_url'] . "Ad/noauth_getAdData/", array(
			"uid" => $uid,
			"typeid" => $typeid,
			"secret" => $secret['secret'],
			"secret_time" => $secret['secret_time']
		), array("saveCookie" => false));
		if ($result) {
			$result = json_decode($result, TRUE);
			if ($result && $result['success'] && !empty($result['data'])) {
				$tmp = $result['data'];
				$list = array();
				$list["data"] = array();
				foreach ($tmp as $k => $v) {
					$list["data"][$v['apid']] = decompress($v['content']);
				}
				$list['typeid'] = $result['typeid'];
			}
		}
		if (!empty($list)) {
			return $list;
		}
		return array();
	}

	public function recommand($id, $status) {
		if (empty($id) || $status == "") {
			return wrrong_msg(MSG_INVALID_ARGUMENTS);
		}
		$success = $this->Article_model->set(array("recommand" => $status))->where("id", $id)->update();
		if (!$success) {
			return wrrong_msg(MSG_SERVICE_BUSY);
		}
		return success_msg(MSG_METHOD_SUCCESS);
	}

	public function delete($id) {
		$success = $this->Article_model->where("id", $id)->delete();
		if (!$success) {
			return wrrong_msg(MSG_SERVICE_BUSY);
		}
		$this->ArticleAdd_model->where("pid", $id)->delete();
		return success_msg(MSG_METHOD_SUCCESS);
	}

	/**
	 * 审核通过
	 * @param $data
	 * @return array|multitype
	 */
	public function examine($data){
		$optionsKeys = array(
			"id",
			"status"
		);
		$data = formatOptions($data, $optionsKeys);
		extract($data);
		$data = array();
		$data_add = array();
		if (optionExists($status)) {
			$data['status'] = $status;
			$data_add['status'] = $status;
		}
		$success = $this->Article_model->set($data)->where("id", $id)->update();
		if (!$success) {
			return wrrong_msg(MSG_SERVICE_BUSY);
		}
		$success = $this->ArticleAdd_model->set($data_add)->where("pid", $id)->update();
		if (!$success) {
			return wrrong_msg(MSG_SERVICE_BUSY);
		}
		return success_msg(MSG_EDIT_SUCCESS);
	}

	/**
	 * 删除、恢复
	 * @param array $options
	 * @return array|multitype
	 */
	public function undel($options=array()){
		$optionsKeys = array(
			"id",
			"status",
		);
		extract(formatOptions($options, $optionsKeys));
		if (!$id) {
			return wrrong_msg(MSG_INVALID_ARGUMENTS);
		}
		if (optionExists($status)) {
			$data['status'] = $status;
		}
		$success = $this->Article_model->set($data)->where("id", $id)->update();
		if ($success) {
			return wrrong_msg(MSG_SERVICE_BUSY);
		}
		return success_msg(MSG_EDIT_SUCCESS);
	}


	public function get_adv($uid){
		$secret = cms_auth_code();
		$result = Curl::post($this->config->config['server_url'] . "API/getUseAdv/", array(
			"id" => $uid,
			"secret" => $secret['secret'],
			"secret_time" => $secret['secret_time']
		));
		if (!$result) {
			return wrrong_msg(MSG_SERVICE_BUSY);
		}
		return json_decode($result, TRUE);
	}

}
?>