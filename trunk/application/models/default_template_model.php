<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class default_template_model extends MY_Model {

	public function __construct() {
		parent::__construct();
		$this->loadService("Channel", "Article", "Link");
		$this->loadModel("Channel", "Article");
	}

	function index() {
		$data = array(
			"head" => $this->Article_service->get_list(array(
				"limit" => 19,
				"info" => "thumb"
			)),
			"bigimg" => $this->Article_service->get_list(array(
				"limit" => 1,
				"info" => "thumb"
			)),
			"newest" => $this->Article_service->get_list(array(
				"limit" => 10
			)),
			"recommandimg" => $this->Article_service->get_list(array(
				"limit" => 4,
			)),
			"recommand" => $this->Article_service->get_list(array(
				"limit" => 10,
			)),
			"rollnews" => $this->Article_service->get_list(array("limit" => 100)),
			
			"linklist" =>$this->Link_service->get_list(),
		);

		foreach ($this->channels as $k => $v) {
			if ($k == count($this->channels) - 1) {
				$data['last'] = array(
					"name" => $v['name'],
					"dir" => $v['dir'],
					"list" => $this->Article_service->get_list(array(
						"dir" => $v['dir'],
						"limit" => 5,
						"info" => "thumb"
					))
				);
				continue;
			}
			$data['mod'][] = array(
				"name" => $v['name'],
				"dir" => $v['dir'],
				"head" => $this->Article_service->get_list(array(
					"dir" => $v['dir'],
					"limit" => 1,
					"info" => "thumb,content"
				)),
				"list" => $this->Article_service->get_list(array(
					"dir" => $v['dir'],
					"limit" => 6
				))
			);
		}
		return $data;
	}

	function m_index() {
		$data = array(
			"head" => $this->Article_service->get_list(array(
				"limit" => 17,
				"recommand" => Article_model::RECOMMAND_YES
			)),
			"new" => $this->Article_service->get_list(array(
				"limit" => 10,
				"recommand" => Article_model::RECOMMAND_YES
			))
		);
		foreach ($this->channels as $k => $v) {
			if ($k == count($this->channels) - 1) {
				$data['last'] = $this->Article_service->get_list(array(
					"dir" => $v['dir'],
					"recommand" => Article_model::RECOMMAND_YES,
					"limit" => 5,
					"thumb" => TRUE,
				));
				continue;
			}
			$data['mod'][] = array(
				"name" => $v['name'],
				"dir" => $v['dir'],
				"head" => $this->Article_service->get_list(array(
					"dir" => $v['dir'],
					"recommand" => Article_model::RECOMMAND_YES,
					"limit" => 1,
					"thumb" => TRUE,
					"info" => "thumb,content"
				)),
				"list" => $this->Article_service->get_list(array(
					"dir" => $v['dir'],
					"recommand" => Article_model::RECOMMAND_YES,
					"limit" => 4,
					"thumb" => FALSE
				))
			);
		}
		return $data;
	}

	function channel($channel, $input) {
		$input['limit'] = 10;
		$input['info'] = "content";
		$list = $this->Article_service->get_list($input);
		$data = array(
			"recommand" => $this->Article_service->get_list(array(
				"dir" => $channel['data']['dir'],
				"limit" => 10
			)),
			"focus" => $this->Article_service->get_list(array(
				"thumb" => TRUE,
				"dir" => $channel['data']['dir'],
				"limit" => 4,
				"info" => "thumb"
			)),
			"hot" => $this->Article_service->get_list(array(
				"dir" => $channel['data']['dir'],
				"limit" => 10
			))
		);
		return array(
			"list" => $list,
			"data" => $data
		);
	}

	function m_channel($channel) {
		$data = array(
			"img" => $this->Article_service->get_list(array(
				"limit" => 4,
				"thumb" => TRUE,
				"dir" => $channel['data']['dir'],
				"info" => "thumb"
			)),
			"hot" => $this->Article_service->get_list(array(
				"limit" => 10,
				"thumb" => FALSE,
				"dir" => $channel['data']['dir']
			)),
			"search" => $this->Article_service->get_list(array(
				"limit" => 6,
				"dir" => $channel['data']['dir']
			)),
			"newhotimg" => $this->Article_service->get_list(array(
				"limit" => 2,
				"thumb" => TRUE,
				"dir" => $channel['data']['dir'],
				"info" => "thumb"
			)),
			"readnews" => $this->Article_service->get_list(array(
				"limit" => 8,
				"thumb" => FALSE,
				"dir" => $channel['data']['dir']
			)),
			"newshot" => array(
				"img" => $this->Article_service->get_list(array(
					"limit" => 1,
					"thumb" => TRUE,
					"dir" => $channel['data']['dir'],
					"info" => "thumb"
				)),
				"list" => $this->Article_service->get_list(array(
					"limit" => 4,
					"thumb" => TRUE,
					"dir" => $channel['data']['dir']
				))
			)
		);
		return $data;
	}

	function article($article, $channel) {
		$randArticle = $this->Article_service->get_rand(10, "uid={$article['uid']}");
		$relateArticle = $this->Article_service->get_list(array(
			"uid" => $article['uid'],
			"limit" => 9
		));
		$channelArticle = $this->Article_service->get_list(array(
			"dir" => $channel['dir'],
			"limit" => 6
		));
		$channelRecommand = $this->Article_service->get_list(array(
			"dir" => $channel['dir'],
			"limit" => 10
		));
		$editorRecommand = $this->Article_service->get_list(array(
			"uid" => $article['uid'],
			"limit" => 6,
			"info" => "content"
		));
		$allArticle = $this->Article_service->get_list(array("limit" => 10));
		return array(
			"randArticle" => $randArticle,
			"relateArticle" => $relateArticle,
			"channelArticle" => $channelArticle,
			"channelRecommand" => $channelRecommand,
			"editorRecommand" => $editorRecommand,
			"allArticle" => $allArticle
		);
	}

	function m_article($article, $channel) {
		$relateArticle = $this->Article_service->get_list(array(
			"uid" => $article['uid'],
			"limit" => 5
		));
		$newArticle = $this->Article_service->get_list(array(
			"limit" => 10,
			"dir" => $channel['dir']
		));
		return array(
			"relateArticle" => $relateArticle,
			"newArticle" => $newArticle
		);
	}

}
