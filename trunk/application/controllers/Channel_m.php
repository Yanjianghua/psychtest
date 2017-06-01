<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Channel_m extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->loadService("View");
	}

	public function index() {
		$input['dir'] = $this->input->get("dir");
		$input['page'] = $this->input->get("page");
		$input['page'] = $input['page'] ? max($input['page'], 1) : 1;
		$input['limit'] = 15;
		$input['wap'] = TRUE;
		$input['info'] = "content";

		$channel = $this->Channel_model->get_by_dir($input['dir']);
		if (!$channel['success']) {
			HTTP404();
		}
		$list = $this->Article_service->get_list($input);
		$data = $this->View_service->getData("m_channel", $channel);

		$this->assign("data", $data);
		$this->assign("list", $list);
		$this->assign("channel", $channel['data']);

		$this->view(config_item("style") . '/m/channel/index');
	}

}
