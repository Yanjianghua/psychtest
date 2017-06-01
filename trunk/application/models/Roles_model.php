<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Roles_model extends MY_Model {
	const STATUS_ACTIVE = 1;
	const STATUS_FROZEN = 0;
	const BUILT_ID = 1;

	public static $_table = 'roles';

	public function __construct() {
		parent::__construct();
	}

}
