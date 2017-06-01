<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User_model extends MY_Model {
	const STATUS_ACTIVE = 1;
	const STATUS_FROZEN = 0;
	const OAUSER_YES = 1;
	const OAUSER_NO = 0;
	const THARDPARTY_YES = 1;
	const THARDPARTY_NO = 0;
	const BILLING_METHOD_EFFECT = 1;
	const BILLING_METHOD_KEYWORD = 2;
	const INNERUSER_YES = 1;
	const INNERUSER_NO = 0;
	const GOODUSER_YES = 1;
	const GOODUSER_NO = 0;
	const USELINK_YES = 1;
	const USELINK_NO = 0;

	public static $_table = 'user';

	public function __construct() {
		parent::__construct();
	}

}
