<?php
class Permission_service extends MY_Service {
	private $CI;

	const REFRESH_FAIL = "更新权限失败";

	public function __construct() {
		parent::__construct();
		$this->load->helper("cookie");
		$this->load->config("system", TRUE);
		$this->loadService("Login","Users");
		$this->loadModel("User","Menu", "AdminUser","Roles");
		$this->CI = &get_instance();
	}

	/**
	 * @param $cookiename
	 * @return bool|int
     */
	public function authority_check($cookiename) {
		$login_info = $this->input->post("COOKIE_LOGIN");
		if ($login_info) {
			$_COOKIE[config_item("cookie_prefix") . $cookiename] = $login_info;
		}
		$this->CI->COOKIE_LOGIN = $this->input->cookie(config_item("cookie_prefix") . $cookiename);
		$auth = get_cookie($cookiename);
		$smartoa_auth = get_cookie(Login_service::SMARTOA_USER);
		$normal_other_auth = get_cookie(Login_service::NORMAL_USER_OTHER);
		if (empty($this->uri->rsegments)) {
			return false;
		}
		$c = $this->uri->rsegments[1];
		$a = $this->uri->rsegments[2];
		if (($c == "Login" && ($a == "index" || $a == "code")) || ($c == "Login" && $a == "smartoa") || ($c == "Login" && $a == "normal") || ($c == "Admin_Login" && $a == "index") || preg_match("/^noauth_/", $a) || $c == "API")
			return true;
		if ($this->input->is_cli_request())
			return true;
		//是否登录
		if (!$auth && !$smartoa_auth && !$normal_other_auth)
			return 0;
		$encrypt = $this->config->item("authcode");
		if ($auth) {
			$auth = authcode($auth, $encrypt);
		} else if ($smartoa_auth) {
			$auth = authcode($smartoa_auth, $encrypt);
		} else if ($normal_other_auth) {
			$auth = authcode($normal_other_auth, $encrypt);
		}
		if (!$auth)
			return false;
		$auth = explode("\t", $auth);
		if (empty($auth) || !isset($auth[0], $auth[1]))
			return false;
		if ($cookiename == Login_service::NORMAL_USER || $cookiename == Login_service::SMARTOA_USER || $cookiename == Login_service::NORMAL_USER_OTHER) {
			$user = $this->User_model->where(array(
				"id" => intval($auth[0]),
				"status" => User_model::STATUS_ACTIVE
			))->get_item();
			$user['admin'] = false;
		} else {
			$user = $this->Users_service->get_list(array(
				"id" => intval($auth[0]),
				"status" => AdminUser_model::STATUS_ACTIVE
			));
			if (empty($user['rows']))
				return false;
			$user = $user['rows']['0'];
			if(!empty($user)){
				if ($c != "Admin_Layout") {
					$menu = $this->Menu_model->where(array(
						"controller" => $c,
						"method" => $a
					))->get_item();
					if (empty($menu)) {
						return false;
					}
					if (!$this->isAuth($menu, $user['role'])) {
						return false;
					}
				}
			}
		}
		if (empty($user))
			return false;
		if ($cookiename != Login_service::ADMIN_USER && ($user['oauser'] || $cookiename == Login_service::NORMAL_USER_OTHER)) {
			if (!isset($auth[2])) {
				return false;
			}
			if ($auth[1] < microtime(TRUE) - (3 * 60 * 60)) {
				return false;
			}
			$result = cms_auth_code($auth[1]);
			if ($result['secret'] != $auth[2]) {
				return false;
			}
		} else {
			$password = password($auth[1]);
			if (!isset($user['password']) || $password != $user['password']) {
				return false;
			}
		}
		return $user;
	}

	public function isAuth($menu, $role) {
		if ($role['id'] == Roles_model::BUILT_ID) {
			return true;
		}
		if (!empty($role['auth']) && in_array($menu['id'], $role['auth'])) {
			return true;
		}
		return false;
	}

}
?>