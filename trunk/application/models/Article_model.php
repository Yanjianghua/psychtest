<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Article_model extends MY_Model {
	const STATUS_WAIT = 0;
	const STATUS_DONE = 1;
	const STATUS_EDITED = 2;
	const STATUS_WRRONG = -1;
	const STATUS_DELETE = -2;
	const STATUS_DOING = -4;
	const STATUS_BADWORD = -3;
	const RECOMMAND_YES = 1;
	const RECOMMAND_NO = 0;
	const INCLUDED_YES = 1;
	const INCLUDED_WAIT = 0;
	const INCLUDED_NO = -1;
	const REDO_YES = 1;
	const REDO_NO = 0;
	const REDOMARK_YES = 1;
	const REDOMARK_NO = 0;
	const REDO_MAX = 3;
	const ISPIC_YES = 1;
	const ISPIC_NO = 0;

	public static $_table = 'article';

	public function __construct() {
		parent::__construct();
	}

}
