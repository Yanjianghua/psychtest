<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ArticleTable extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->loadService("ArticleTable");
	}

	public function run(){
		$this->ArticleTable_service->run();
	}

	public function updata(){
		$this->ArticleTable_service->updata();
	}

	public function biao(){
		$this->ArticleTable_service->biao();
	}

}
