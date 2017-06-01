<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mp_m extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->loadService("Channel", "Article", "Link", "View");
		$this->loadModel("Channel", "Article");
		$this->channels = $this->Channel_service->get_list();
		$this->assign("channels", $this->channels);
	}

	public function index() {
		$input = array();
		$limit = 100;
		$count = $this->Article_model->count();
		$page = $this->input->get("page");
		$page = max(1, $page);
		$offset = ($page - 1) * $limit;
		$list = $this->Article_service->format($this->Article_model->force_index("PRIMARY")->select("dir,id,title,utype,uid,addtime")->limit($limit, $offset)->order_by("id", "DESC")->get_list());
		$allChannel = $this->Channel_service->get_list();
		$linklist = $this->Link_service->get_list();
		$data = array(
			"newstitle" => $this->Article_service->get_list(array(
				"limit" => 1
			)),
			"newstitles" => $this->Article_service->get_list(array(
				"limit" => 4
			)),
			"bigimg" => $this->Article_service->get_list(array(
				"recommand" => Article_model::RECOMMAND_YES,
				"limit" => 2,
				"thumb" => TRUE,
				"info" => "thumb"
			)),
		);


		$this->assign("data", $data);
		$this->assign("linklist", $linklist);
		$this->assign("allChannel", $allChannel);
		$this->assign("list", $list);
//		print_r($list);die;
		$this->assign("pages", ceil($count / $limit));
		$this->view(config_item("style") . '/m/mp/index');
	}

}
