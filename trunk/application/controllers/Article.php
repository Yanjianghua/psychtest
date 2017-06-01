<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Article extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->loadService("View");
		$this->load->library("Curl");

	}

	public function index() {
		$dir = $this->input->get("dir");
		if (empty($dir)) {
			HTTP404();
		}

		$id = $this->input->get("id");
		if (empty($id)) {
			HTTP404();
		}

		$article = $this->Article_service->get_list(array(
			"id" => $id,
			"limit" => 1
		));
		if (empty($article['list'])) {
			HTTP404();
		}
		$article = $this->Article_service->info($article['list'], "content,keywords,description,editor,option1,content1,option2,content2,option3,content3,option4,content4");
		$article = $article[0];

		$channel = parse_alert($this->Channel_model->get_by_dir($article['truedir']));
		$prevArticle = $this->Article_service->get_prev($article);
		$nextArticle = $this->Article_service->get_next($article);

		$data = $this->View_service->getData("article", $article, $channel);
		foreach ($data as $k => $v) {
			$this->assign($k, $v);
		}

		$ad = $this->Article_service->get_ad($article['uid'], 1);
		if (isset($ad['typeid']) && $ad['typeid'] == 2) {
			$this->assign("addata", $ad);
		}
		//阅读量开关
		$readnumswich = FALSE;
		if($readnumswich){
			//阅读量
			$options = array("pid"=>$article['id'],"uid"=>$article['uid']);
			$readnum = $this->Article_service->get_num($options);
			$this->assign("readnum", $readnum);
		}
		//$readnumclass = $this->Article_service->get_num($options, TRUE);
		//$readnumclass['serverurl'] = $this->config->config['url']['oldomain']."/Article/read_addoredit_ajax/";
		//$this->assign("readnumclass", $readnumclass);

		//第三方广告
		$adv = $this->Article_service->get_adv($article['uid']);
		if(!$adv){
			foreach($adv as $v){
				$get_adv = $v['Third_adv'];
			}
			if(!$get_adv){
				$get_adv = NULL;
			}
			$this->assign("adv", $get_adv);
		}


//print_r($article);die;
		$this->assign("ad", $ad);
		$this->assign("readnumswich", $readnumswich);
		$this->assign("article", $article);
		$this->assign("prevArticle", $prevArticle);
		$this->assign("nextArticle", $nextArticle);
		$this->assign("channel", $channel);

		$this->view(config_item("style") . '/article/index');
	}

	public function read_addoredit_ajax(){
		$input = $this->input->post_get(NULL);
		echo $this->Article_service->read_addoredit_ajax($input);
	}

}
