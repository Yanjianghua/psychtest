<?php
class Roles_service extends MY_Service {
	const MSG_BUILT = "内置用户组不可进行此操作";
	const MSG_NAME_NOT_NULL = "用户组名不能为空";

	public function __construct() {
		parent::__construct();
		$this->loadModel("Roles");
	}

	/**
	 *添加信息
	 */
	public function addoredit($options = array()) {
		$optionsKeys = array(
			"id",
			"name",
			"status",
			"auth"
		);
		extract(formatOptions($options, $optionsKeys));

		$data = array();

		if (optionExists($name)) {
			$data['name'] = $name;
		}

		if (optionExists($status)) {
			$data['status'] = $status;
		}
		if (optionExists($id)) {
			if (!$this->editable($id)) {
				return wrrong_msg(self::MSG_BUILT);
			}
			$success = $this->Roles_model->where("id", $id)->set($data)->update();
		} else {
			if (empty($name)) {
				return wrrong_msg(self::MSG_NAME_NOT_NULL);
			}
			$success = $this->Roles_model->set($data)->insert();
		}

		if (!$success) {
			return wrrong_msg(MSG_SERVICE_BUSY);
		}
		return success_msg(MSG_EDIT_SUCCESS);
	}

	/**
	 *	判断是否为内置用户组
	 * @param $id
	 * @return bool
	 */
	public function editable($id) {
		if ($id == Roles_model::BUILT_ID) {
			return false;
		}
		return true;
	}

	/**
	 * 启用——禁用
	 * @param $id		用户组ID
	 * @param $status	是否启用
	 * @return array|multitype
	 */
	public function setStatus($id, $status) {
		if (empty($id) || !is_bool($status)) {
			return wrrong_msg(MSG_INVALID_ARGUMENTS);
		}
		$options = array(
			"id" => $id,
			"status" => $status ? Roles_model::STATUS_ACTIVE : Roles_model::STATUS_FROZEN
		);
		return $this->addoredit($options);
	}

	/**
	 * 获取列表
	 * @param unknown $options	数组
	 * @return multitype:NULL string
	 */
	public function get_list($options = array()) {
		$optionsKeys = array(
			"status",
			"name",
			"rows",
			"page"
		);
		extract(formatOptions($options, $optionsKeys));

		$where = array();
		$result = array();
		//是否启用
		if (optionExists($status)) {
			$where['status'] = $status;
		}
		if (optionExists($name)) {
			$where['name like'] = "%{$name}%";
		}

		//分页
		if ($rows && $page) {
			$result['total'] = $this->Roles_model->where($where)->count();
			$page = max($page, 1);
			$offset = ($page - 1) * $rows;
			$this->Roles_model->limit($rows, $offset);
		}
		//获取列表
		$list = $this->Roles_model->where($where)->get_list();
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
		$success = $this->Roles_model->where("id", $id)->delete();
		if (!$success) {
			return wrrong_msg(MSG_SERVICE_BUSY);
		}
		return success_msg(MSG_DELETE_SUCCESS);

	}

	/**
	 * 设置权限内容
	 * @param array $options	用户rid与权限pid对应关系
	 * @return array|multitype
	 */
	public function auth($options = array()) {
		$optionsKeys = array(
			"rid",
			"pid"
		);
		extract(formatOptions($options, $optionsKeys));
		if (empty($rid)) {
			return wrrong_msg(MSG_INVALID_ARGUMENTS);
		}
		$success = $this->Roles_model->where("id", $rid)->set(array("auth" => compress(explode(",", $pid))))->update();
		if ($success) {
			return success_msg(MSG_METHOD_SUCCESS);
		}
		return wrrong_msg(MSG_SERVICE_BUSY);
	}

}
?>