<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_Article extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->loadService("Media", "Article");
		$this->loadModel("Article");
	}

	//文章管理
	public function index() {
		$this->view('admin/article/index');
	}

	//文章添加
	public function add() {
		$input = $this->input->post();
		if (!empty($input)) {
			print_json($this->Article_service->insertorupdate($input));
		}
		$channel=$this->Channel_service->get_list();
		$this->assign("channel", $channel);
		$this->view('admin/article/add');
	}

	public function get_list() {
		$input = $this->input->post(NULL, TRUE);
		$type = $this->input->post("type");
		$input['format'] = TRUE;
		$input['admin'] = TRUE;
		$input['limit'] = $input['rows'];
		if ($type == "csv") {
				$input['page'] = 1;
				$input['rows'] = 1000;
				$input['status'] = 1;
				$csv = iconv("utf-8", "GBK", "关键词,标题,文章网址,手机网址\n");
				while (true) {
					$list = $this->Article_service->get_list($input);
					if (empty($list['rows'])) {
						break;
					}
					foreach ($list['rows'] as $k => $v) {
						$data = array();
						$data[] = csvFormat($v['keywords']);
						$data[] = csvFormat($v['title']);
						$data[] = csvFormat($v['url']);
						$data[] = csvFormat($v['wap_url']);
						$csv .= implode(",", $data) . "\n";
					}
					$input['page']++;
				}
				export_csv($csv);
		} else {
			$rows = $this->Article_service->get_list($input);
			$rows['rows']=$rows['list'];
			foreach($rows['rows'] as $k=>$v){
				$rows['rows'][$k]['addtime'] = date("Y-m-d H:i:s", $v['addtime']);
			}
			print_json($rows);
		}
	}

	public function recommand() {
		$id = $this->input->post("id");
		$uid = $this->input->post("uid");
		$status = $this->input->post("status");
		print_json($this->Article_service->recommand($id, $uid, $status));
	}

	//文章修改
	public function edit() {
		$input = $this->input->post();
		if (!empty($input)) {
			print_json($this->Article_service->insertorupdate($input));
		}
		$id = $this->input->get("id");
		if (empty($id)) {
			alert(MSG_INVALID_ARGUMENTS);
		}
		$query = $this->db->where("id", $id)->limit(1)->get(Article_model::$_table);
		$article = $query->result_array();

		$article['add'] = $this->ArticleAdd_model->where(array(
			"pid" => $id
		))->get_item();
		$channel=$this->Channel_service->get_list();
		$this->assign("channel", $channel);
		$this->assign("article", $article);
		$this->view('admin/article/edit');
	}

	//文章删除
	public function delete() {
		$options = $this->input->post("options");
		parse_alert($this->Article_service->delete($options[0]['id'], TRUE), "JSON");
	}

}
