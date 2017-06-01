<?php
class Menu_service extends MY_Service {
	const MSG_NAME_NOT_NULL = "菜单名称不能为空";
	const MSG_CONTROLLER_NOT_NULL = "控制器不能为空";
	const MSG_METHOD_NOT_NULL = "方法名不能为空";
	const MSG_MENU_EXISTS = "此菜单已存在";
	const MSG_BUILT = "内置菜单不可执行此操作";

	public function __construct() {
		parent::__construct();
		$this->loadModel("Menu", "Roles");
		$this->loadService("Permission");
	}

	/**
	 *添加信息
	 */
	public function addoredit($options = array()) {
		$optionsKeys = array(
			"id",
			"name",
			"pid",
			"controller",
			"method",
			"hide"
		);
		extract(formatOptions($options, $optionsKeys));

		$data = array();

		if (optionExists($name)) {
			$data['name'] = $name;
		} else {
			return wrrong_msg(self::MSG_NAME_NOT_NULL);
		}

		if (optionExists($pid)) {
			$data['pid'] = $pid;
		} else {
			return wrrong_msg(MSG_INVALID_ARGUMENTS);
		}

		if (optionExists($controller)) {
			$data['controller'] = $controller;
		} else {
			if ($pid != 0) {
				return wrrong_msg(self::MSG_CONTROLLER_NOT_NULL);
			}
		}

		if (optionExists($method)) {
			$data['method'] = $method;
		} else {
			if ($pid != 0) {
				return wrrong_msg(self::MSG_METHOD_NOT_NULL);
			}
		}

		if (optionExists($hide)) {
			$data['hide'] = $hide;
		} else {
			$data['hide'] = Menu_model::HIDE_NO;
		}

		if ($pid > 0) {
			$m = $this->Menu_model->where(array(
				"controller" => $controller,
				"method" => $method,
				"id !=" => $id
			))->get_item();
			if (!empty($m)) {
				return wrrong_msg(self::MSG_MENU_EXISTS);
			}
		}

		if (optionExists($id)) {
			if (!$this->editable($id)) {
				return wrrong_msg(self::MSG_BUILT);
			}
			$success = $this->Menu_model->where("id", $id)->set($data)->update();
		} else {
			$success = $this->Menu_model->set($data)->insert();
		}

		if (!$success) {
			return wrrong_msg(MSG_SERVICE_BUSY);
		}
		return success_msg(MSG_EDIT_SUCCESS);
	}

	public function editable($id) {
		$m = $this->Menu_model->where(array("id" => $id))->select("built")->get_item();
		if (empty($m)) {
			return false;
		}
		if ($m['built'] == Menu_model::BUILT_YES) {
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
			"select",
			"usermenu",
			"rid"
		);
		extract(formatOptions($options, $optionsKeys));
		if ($rid) {
			$role = $this->Roles_model->where("id", $rid)->get_item();
			$role['auth'] = decompress($role['auth']);
		} else {
			$role = $this->login_user['role'];
		}
		$get = function($pid) use (&$get, &$ischecked, &$select, &$usermenu, &$role) {
			if ($usermenu) {
				$this->Menu_model->where("hide", Menu_model::HIDE_NO);
			}
			$list = $this->Menu_model->where("pid", $pid)->get_list();
			$temp = array();
			foreach ($list as $k => $v) {
				if ($this->Permission_service->isAuth($v, $role)) {
					$v['checked'] = true;
				} else if ($usermenu) {
					continue;
				}
				$v['text'] = $v['name'];
				$v['children'] = $get($v['id']);
				$temp[] = $v;
			}
			return $temp;
		};
		//获取列表
		$list = $get(0);
		if ($select) {
			array_unshift($list, array(
				"id" => 0,
				"text" => "顶级分类"
			));
		}
		return $list;
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

		$success = $this->Menu_model->where("id", $id)->delete();
		if (!$success) {
			return wrrong_msg(MSG_SERVICE_BUSY);
		}
		return success_msg(MSG_DELETE_SUCCESS);

	}

}
?>