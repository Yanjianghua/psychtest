<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Channel_model extends MY_Model {

	public static $_table = 'channel';

	public function __construct() {
		parent::__construct();
	}

	public function get_by_dir($dir) {
		if (!$dir) {
			return wrrong_msg(MSG_INVALID_ARGUMENTS);
		}
		$channel = $this->where("dir", $dir)->get_item();
		if (empty($channel)) {
			return wrrong_msg(MSG_INVALID_ARGUMENTS);
		}
		return success_data($channel);
	}

}
