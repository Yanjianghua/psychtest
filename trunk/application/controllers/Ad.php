<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ad extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->loadService("Article");
	}

	public function get() {
		$uid = $this->input->get("uid");
		$typeid = $this->input->get("typeid");
		if (empty($uid) || empty($typeid)) {
			print_json(wrrong_msg(MSG_INVALID_ARGUMENTS));
		}
		$ad = $this->Article_service->get_ad($uid, $typeid);
		echo "jsonpcallback(" . json_encode(success_data($ad)) . ")";
	}

}
