<?php
class User_service extends MY_Service {

	public function __construct() {
		parent::__construct();
		$this->loadModel("User", "Article", "CoinLog");
	}

	public function get_info() {
		$data = array();
		$data['added_num'] = $this->db->where(array("redo" => Article_model::REDO_NO))->count_all_results(Article_model::$_table . "_{$this->login_user['id']}");
		$data['num'] = $this->login_user['coin'] + $data['added_num'];
		//已添加
		$data['published'] = $this->db->where(array(
			"status" => Article_model::STATUS_DONE,
			"redo" => Article_model::REDO_NO
		))->count_all_results(Article_model::$_table . "_{$this->login_user['id']}");
		//已发布
		$data['remain'] = $data['num'] - $data['added_num'];
		//剩余可发布
		return $data;
	}

	public function useCoin($number) {
		return $this->addCoin(-$number);
	}

	public function addCoin($number) {
		return $this->User_model->set('coin', "coin+{$number}", FALSE)->where("id", $this->login_user['id'])->update();
	}

	//用户info
	public function get_lists($options = array()) {
		$optionsKeys = array(
			"page",
			"rows",
			"admin",
			"usertype",
			"name"
		);
		$options = formatOptions($options, $optionsKeys);
		extract($options);
		$where = array();

		if ($usertype == "") {
			$where['oauser'] = User_model::OAUSER_NO;
		} elseif ($usertype == "oauser") {
			$where['oauser'] = User_model::OAUSER_YES;
		} elseif ($usertype == "inneruser") {
			$where['inneruser'] = User_model::INNERUSER_YES;
		} elseif ($usertype == "gooduser") {
			$where['gooduser'] = User_model::GOODUSER_YES;
		} elseif ($usertype == "normal") {
			$where['inneruser'] = User_model::INNERUSER_NO;
			$where['oauser'] = User_model::OAUSER_NO;
		}
		if (!$admin) {
			$where['status'] = User_model::STATUS_ACTIVE;
		}
		if (optionExists($name)) {
			$where['username'] = $name;
		}
		if (optionExists($page) && optionExists($rows)) {
			$total = $this->User_model->where($where)->count();
			$offset = ($page - 1) * $rows;
			$this->User_model->limit($rows, $offset);
		}

		$list = $this->User_model->where($where)->order_by("id", "DESC")->get_list();

		foreach ($list as $k => $v) {
			$code = cms_auth_code();
			$added_num = $this->db->where(array("redo" => Article_model::REDO_NO))->count_all_results(Article_model::$_table . "_{$v['id']}");
			//已添加
			$num = $v['coin'] + $added_num;
			//总充值
			$published = $this->db->where(array(
				"status" => Article_model::STATUS_DONE,
				"redo" => Article_model::REDO_NO
			))->count_all_results(Article_model::$_table . "_{$v['id']}");
			//已发布
			$remain = $num - $added_num;
			//剩余可发布

			$list[$k]['added_num'] = $added_num;
			$list[$k]['num'] = $num;
			$list[$k]['published'] = $published;
			$list[$k]['remain'] = $remain;
			$list[$k]['time'] = date("Y-m-d H:i", $v['logintime']);
			if ($admin) {
				$list[$k]['loginurl'] = "/Login/normal/?username={$v['username']}&secret={$code['secret']}&secret_time={$code['secret_time']}";
			}
		}

		return array(
			"rows" => $list,
			"total" => isset($total) ? $total : ""
		);
	}

	public function add($da) {
		$inputdata = array();
		$data['username'] = trim($da['username']);
		$data['truename'] = trim($da['truename']);
		$data['password'] = password($da['password']);
		$data['tables'] = 1;
		$data['logintime'] = time();

		$id = $this->User_model->insert($data);
		if (!$id) {
			return wrrong_msg(MSG_SERVICE_BUSY);
		}
		$this->createTable($id);
		return $id ? success_msg(MSG_EDIT_SUCCESS) : success_msg(MSG_ADD_SUCCESS);
	}

	public function createTable($id) {
		$this->db->query("CREATE TABLE `article_{$id}_1` LIKE article_template");
		$this->db->query("CREATE TABLE `article_{$id}` LIKE article_template");
		$this->db->query("ALTER TABLE article_{$id} ENGINE=MERGE DEFAULT CHARSET=utf8 UNION=(article_{$id}_1) INSERT_METHOD=LAST");
	}

	public function edit_coin($options = array()) {
		$optionsKeys = array(
			"coin",
			"id"
		);
		$options = formatOptions($options, $optionsKeys);
		extract($options);
		$inputdata = array();
		$coin = intval($coin);
		if ($coin <= 0) {
			return wrrong_msg(MSG_INVALID_ARGUMENTS);
		}
		$success = $this->User_model->where("id", $id)->set("`coin`", "`coin`+{$coin}", FALSE)->update();
		$data = array();
		$data['num'] = $coin;
		$data['time'] = time();
		$data['uid'] = $id;
		$success = $this->CoinLog_model->insert($data);
		if (!$success) {
			return wrrong_msg(MSG_SERVICE_BUSY);
		}
		return success_msg(MSG_EDIT_SUCCESS);
	}

	//充值记录
	public function log_list($id, $page = 1, $limit = 10) {
		$count = $this->CoinLog_model->where("uid", $id)->count();
		$list = $this->CoinLog_model->where("uid", $id)->order_by("id", "DESC")->get_list();
		foreach ($list as $k => $v) {
			$list[$k]['time'] = date("Y-m-d H:i:s", $v['time']);
		}
		return array(
			"rows" => $list,
			"total" => $count
		);
	}

	public function setInneruser($uid, $status) {
		if (empty($uid) || !in_array($status, array(
			User_model::INNERUSER_YES,
			User_model::INNERUSER_NO
		))) {
			return wrrong_msg(MSG_INVALID_ARGUMENTS);
		}
		$success = $this->User_model->set(array("inneruser" => $status))->where("id", $uid)->update();
		if (!$success) {
			return wrrong_msg(MSG_SERVICE_BUSY);
		}
		return success_msg(MSG_METHOD_SUCCESS);
	}

	public function setGooduser($uid, $status) {
		if (empty($uid) || !in_array($status, array(
			User_model::GOODUSER_YES,
			User_model::GOODUSER_NO
		))) {
			return wrrong_msg(MSG_INVALID_ARGUMENTS);
		}
		$success = $this->User_model->set(array("gooduser" => $status))->where("id", $uid)->update();
		if (!$success) {
			return wrrong_msg(MSG_SERVICE_BUSY);
		}
		return success_msg(MSG_METHOD_SUCCESS);
	}

	public function setUseLink($uid, $status) {
		if (empty($uid) || !in_array($status, array(
			User_model::USELINK_YES,
			User_model::USELINK_NO
		))) {
			return wrrong_msg(MSG_INVALID_ARGUMENTS);
		}
		$success = $this->User_model->set(array("uselink" => $status))->where("id", $uid)->update();
		if (!$success) {
			return wrrong_msg(MSG_SERVICE_BUSY);
		}
		return success_msg(MSG_METHOD_SUCCESS);
	}

	//密码修改
	public function update_pwd($da) {
		$data = array();
		$id = $da['id'];
		$data['password'] = password($da['password']);
		$success = $this->User_model->where("id = $id")->update($data);

		if (!$success) {
			return wrrong_msg(MSG_SERVICE_BUSY);
		}
		return success_msg(MSG_EDIT_SUCCESS);
	}

	//广告修改
	public function update_ad($da) {
		$data = array();
		$id = $da['id'];
		if (!empty($da['ad'])) {
			$data['thardparty'] = trim($da['ad']);
		} else {
			$data['thardparty'] = User_model::STATUS_FROZEN;
		}
		$success = $this->User_model->where("id = $id")->update($data);

		if (!$success) {
			return wrrong_msg(MSG_SERVICE_BUSY);
		}
		return success_msg(MSG_EDIT_SUCCESS);
	}

	//设置媒体
	public function set_media($da) {
		$data['auth'] = compress($da['channel']);

		$success = $this->User_model->where("id", $da['id'])->update($data);
		if (!$success) {
			return wrrong_msg(MSG_SERVICE_BUSY);
		}
		return success_msg(MSG_EDIT_SUCCESS);
	}

	//第三方广告设置
	public function setUseAdv($uid, $Third_adv) {
		if (empty($uid) || !in_array($Third_adv, array(
				User_model::USELINK_YES,
				User_model::USELINK_NO
			))) {
			return wrrong_msg(MSG_INVALID_ARGUMENTS);
		}
		$success = $this->User_model->set(array("Third_adv" => $Third_adv))->where("id", $uid)->update();
		if (!$success) {
			return wrrong_msg(MSG_SERVICE_BUSY);
		}
		return success_msg(MSG_METHOD_SUCCESS);
	}

	//获取第三方广告信息
	public function getUseAdv($uid) {
		$success = $this->User_model->select("Third_adv")->where("id", $uid)->get_list();
		if (!$success) {
			return wrrong_msg(MSG_SERVICE_BUSY);
		}
		return $success;
	}
}
?>