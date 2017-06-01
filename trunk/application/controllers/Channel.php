<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Channel extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->loadService("View");
	}

	public function index() {
		$input['dir'] = $this->input->get("dir");
		$input['page'] = $this->input->get("page");
		$input['page'] = $input['page'] ? max($input['page'], 1) : 1;
		$input['info'] = "content";

		$channel = $this->Channel_model->get_by_dir($input['dir']);
		if (!$channel['success']) {
			HTTP404();
		}

		$result = $this->View_service->getData("channel", $channel, $input);
		$list = $result['list'];
		$data = $result['data'];

		$this->assign("list", $list);
		$this->assign("data", $data);
		$this->assign("channel", $channel['data']);

		$this->view(config_item("style") . '/channel/index');
	}

}
