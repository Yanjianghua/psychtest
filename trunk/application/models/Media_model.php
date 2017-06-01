<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Media_model extends MY_Model {
	const STATUS_ACTIVE = 1;
	const STATUS_FROZEN = 0;
	const VISIBLE_ACTIVE = 0;
	const VISIBLE_FROZEN = 1;

	public static $_table = 'channel';

	public function __construct() {
		parent::__construct();
	}

}
