<?php
class Users_service extends MY_Service {
	const MSG_USERNAME_NOT_NULL = "用户名不能为空";
	const MSG_PASSWORD_NOT_NULL = "密码不能为空";
	const MSG_RID_NOT_NULL = "用户组不能为空";
	const MSG_BUILT = "内置用户不可进行此操作";

	public function __construct() {
		parent::__construct();
		$this->loadModel("AdminUser", "Roles");
	}

	public function addoredit($options = array()) {
		$optionsKeys = array(
			"id",
			"username",
			"password",
			"rid",
			"status"
		);
		extract(formatOptions($options, $optionsKeys));

		$data = array();

		if (optionExists($username)) {
			$data['username'] = $username;
		}

		if (optionExists($password)) {
			$data['password'] = password($password);
		}

		if (optionExists($rid)) {
			$data['rid'] = $rid;
		}
		if (optionExists($status)) {
			if ($status) {
				$data['status'] = AdminUser_model::STATUS_ACTIVE;
			} else {
				$data['status'] = AdminUser_model::STATUS_FROZEN;
			}
		}
		if ($id) {
			if (!$this->editable($id)) {
				return wrrong_msg(self::MSG_BUILT);
			}
			$success = $this->AdminUser_model->where("id", $id)->set($data)->update();
		} else {
			if (empty($username)) {
				return wrrong_msg(self::MSG_USERNAME_NOT_NULL);
			}
			if (empty($password)) {
				return wrrong_msg(self::MSG_PASSWORD_NOT_NULL);
			}
			if (empty($rid)) {
				return wrrong_msg(self::MSG_RID_NOT_NULL);
			}
			$success = $this->AdminUser_model->set($data)->insert();
		}

		if (!$success) {
			return wrrong_msg(MSG_SERVICE_BUSY);
		}
		return success_msg(MSG_EDIT_SUCCESS);
	}

	/**
	 * 检测是否为内置用户
	 * @param $id	用户ID
	 * @return bool
	 */
	public function editable($id) {
		if ($id == AdminUser_model::BUILT_ID) {
			return false;
		}
		return true;
	}

	/**
	 * 获取列表
	 * @param unknown $options	数组
	 * @return multitype:NULL string
	 */
	public function get_list($options = array()) {
		$optionsKeys = array(
			"id",
			"status",
			"username",
			"rows",
			"page"
		);
		extract(formatOptions($options, $optionsKeys));

		$where = array();
		$result = array();

		if (optionExists($id)) {
			$where['id'] = $id;
		}
		//是否启用
		if (optionExists($status)) {
			$where['status'] = $status;
		}
		//username模糊查询
		if (optionExists($username)) {
			$where['username like'] = "%{$username}%";
		}

		//分页
		if (optionExists($rows) && optionExists($page)) {
			$result['total'] = $this->AdminUser_model->where($where)->count();
			$page = max($page, 1);
			$offset = ($page - 1) * $rows;
			$this->AdminUser_model->limit($rows, $offset);
		}
		//获取列表
		$list = $this->AdminUser_model->where($where)->get_list();
		//获取用户组
		$rolenameCache = array();
		foreach ($list as $k => $v) {
			$role = useCache($rolenameCache, $v['rid'], function($key) {
				$role = $this->Roles_model->where(array("id" => $key))->get_item();
				$role['auth'] = decompress($role['auth']);
				if ($role['auth'] == "") {
					$role['auth'] = array();
				}
				return $role;
			});
			if (!empty($role)) {
				$list[$k]['role'] = $role;
				$list[$k]['rolename'] = $role['name'];
				$list[$k]['logintime'] = date("Y-m-d H:i:s",$v['logintime']);
			}
		}
		$result['rows'] = $list;
		return $result;
	}

	/**
	 *	删除内容
	 */
	public function delete($options = array()) {
		$optionsKeys = array("id");
		extract(formatOptions($options, $optionsKeys));
		if (!$id) {
			return wrrong_msg(MSG_INVALID_ARGUMENTS);
		}
		if (!$this->editable($id)) {
			return wrrong_msg(self::MSG_BUILT);
		}

		$success = $this->AdminUser_model->where("id", $id)->delete();
		if (!$success) {
			return wrrong_msg(MSG_SERVICE_BUSY);
		}
		return success_msg(MSG_DELETE_SUCCESS);

	}

}
?>