<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Article_API extends MY_Controller {
	const MSG_AUTH_FAILED = "AUTH FAILED";
	const MSG_INVALID_ARGUMENTS = "INVALID ARGUMENTS";

	private $php_path='';

	public function __construct() {
		parent::__construct();
		$this->loadService("Article", "Channel", "Upgrade", "Link");
		$this->loadModel("Article");
		$secret = $this->input->post_get('secret');
		$secret_time = $this->input->post_get('secret_time');
		if (empty($secret) || empty($secret_time)) {
			print_json(wrrong_msg(self::MSG_INVALID_ARGUMENTS));
		}
		if ($secret_time < microtime(TRUE) - 300) {
			print_json(wrrong_msg(self::MSG_INVALID_ARGUMENTS));
		}
		$res = cms_auth_code($secret_time);
		if ($res['secret'] != $secret) {
			print_json(wrrong_msg(self::MSG_AUTH_FAILED));
		}
	}

	public function get() {
		$id = $this->input->post("id");
		if (!$id) {
			print_json(wrrong_msg(MSG_INVALID_ARGUMENTS));
		}
		$item = $this->article_model->where("id", $id)->get_item();
		if (empty($item)) {
			print_json(wrrong_msg(MSG_INVALID_ARGUMENTS));
		}
		print_json(success_data($item));
	}

	public function lists() {
		$input = $this->input->post(NULL);
		$list = $this->Article_service->get_list($input);
		print_json(success_data(array(
			"rows" => $list['list'],
			"total" => $list['total']
		)));
	}

	public function add() {
		$input = $this->input->post(NULL);
		parse_alert($this->Article_service->insertorupdate($input), "JSON");
	}

	public function edit() {
		$id = $this->input->post("id");
		if (empty($id)) {
			print_json(wrrong_msg(MSG_INVALID_ARGUMENTS));
		}
		$this->add();
	}
	
	public function delete(){
		$id = $this->input->post("id");
		if(empty($id)){
			print_json(wrrong_msg(MSG_INVALID_ARGUMENTS));
		}
		parse_alert($this->Article_service->delete($id));
	}

	public function examine(){
		$input = $this->input->post(NULL);
		if(empty($input)){
			print_json(wrrong_msg(MSG_INVALID_ARGUMENTS));
		}
		parse_alert($this->Article_service->examine($input));
	}
	public function undel(){
		$input = $this->input->post(NULL);
		if(empty($input)){
			print_json(wrrong_msg(MSG_INVALID_ARGUMENTS));
		}
		parse_alert($this->Article_service->undel($input));
	}

	public function getChannel() {
		$list = $this->Channel_service->get_list(array("hasArticle" => true));
		print_json($list);
	}

	public function editChannel() {
		$input = $this->input->post(NULL);
		parse_alert($this->Channel_service->update($input), "JSON"); 
	}

	public function editWebname() {
		$name = $this->input->post("name");
		if (!$name) {
			print_json(wrrong_msg(MSG_INVALID_ARGUMENTS));
		}
		$this->Upgrade_service->update_config("system", "web_name", "\"{$name}\"");
		print_json(success_msg(MSG_EDIT_SUCCESS));
	}

	public function getMediaInfo() {
		$this->load->config("system");
		$data = array(
			"web_name" => config_item("web_name"),
			"version" => config_item("system_version"),
			"mplink" => formatUrl('rollnews', ''),
			"style" => config_item('style')
		);
		print_json(success_data($data));
	}

	public function recommand() {
		$id = $this->input->post("id");
		$status = $this->input->post("status");
		parse_alert($this->Article_service->recommand($id, $status), "JSON");
	}

	public function upgradeconfig() {
		if (!isset($_FILES['config'])) {
			print_json(wrrong_msg(MSG_INVALID_ARGUMENTS));
		}
		$config = $_FILES['config'];
		if (empty($config) || $config['error'] > 0) {
			print_json(wrrong_msg(MSG_INVALID_ARGUMENTS));
		}
		$f = fopen($config['tmp_name'], "r");
		while ($line = fgets($f)) {
			if ($line !== FALSE) {
				$command = explode("{|}", $line);
				if ($command[0] == "edit") {
					$this->Upgrade_service->update_config(trim($command[1]), trim($command[2]), trim($command[3]));
				}
				if ($command[0] == "add") {
					$this->Upgrade_service->add_config(trim($command[1]), trim($command[2]));
				}
			}
		}
		fclose($f);
		print_json(success_msg(true));
	}

	public function upgradefile() {
		if (!isset($_FILES['trunk'])) {
			print_json(wrrong_msg(MSG_INVALID_ARGUMENTS));
		}
		$trunk = $_FILES['trunk'];
		if (empty($trunk) || $trunk['error'] > 0) {
			print_json(wrrong_msg(MSG_INVALID_ARGUMENTS));
		}
		$zip = zip_open($trunk['tmp_name']);
		if (!$zip) {
			print_json(wrrong_msg(MSG_INVALID_ARGUMENTS));
		}
		while ($zip_entry = zip_read($zip)) {
			if (zip_entry_open($zip, $zip_entry, "r")) {
				$buf = zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));
				$filename = zip_entry_name($zip_entry);
				if (substr($filename, -1) == "/") {
					mkdirs(FCPATH . $filename);
				} else {
					file_put_contents(FCPATH . $filename, $buf);
				}
				zip_entry_close($zip_entry);
			}
		}
		zip_close($zip);
		print_json(success_msg(true));
	}

	public function upgradedatabase() {
		if (!isset($_FILES['database'])) {
			print_json(wrrong_msg(MSG_INVALID_ARGUMENTS));
		}
		$database = $_FILES['database'];
		if (empty($database) || $database['error'] > 0) {
			print_json(wrrong_msg(MSG_INVALID_ARGUMENTS));
		}
		$data = decompress(file_get_contents($database['tmp_name']));
		file_put_contents($database['tmp_name'], $data);
		$f = fopen($database['tmp_name'], "r");
		while ($line = fgets($f)) {
			if ($line !== FALSE) {
				$this->db->query($line);
			}
		}
		fclose($f);
		print_json(success_msg(true));
	}

	public function upgradescript() {
		$cmd=$this->real_path();
		//命令行执行???   D:\wamp\bin\php\php5.5.12\php index.php ArticleTable updata
		system("cd ".FCPATH);
		system('d:');
		system($cmd.' index.php ArticleTable updata' , $output);
		print_json(success_msg(true));
	}
	
	public function link_add(){
		$input = $this->input->post(NULL);
		parse_alert($this->Link_service->add($input), "JSON");
	}

	public function link_edit(){
		$id = $this->input->post("id");
		if (empty($id)) {
			print_json(wrrong_msg(MSG_INVALID_ARGUMENTS));
		}
		$this->link_add();
	}
	
	public function link_get_list(){
		$input = $this->input->post(NULL);
		$list = $this->Link_service->get_list($input);
		
		print_json(success_data($list));
	}
	
	public function link_delete(){
		$id = $this->input->post("id");
		if(empty($id)){
			print_json(wrrong_msg(MSG_INVALID_ARGUMENTS));
		}
		parse_alert($this->Link_service->delete($id));
	}


	function real_path() {
		if ($this->php_path != '') {
			return $this->php_path;
		}
		if (substr(strtolower(PHP_OS), 0, 3) == 'win') {
			$ini = ini_get_all();
			$path = $ini['extension_dir']['local_value'];
			$php_path = str_replace('\\', '/', $path);
			$php_path = str_replace(array('/ext/', '/ext'), array('/', '/'), $php_path);
			$real_path = $php_path . 'php.exe';
		} else {
			$real_path = PHP_BINDIR . '/php';
		}
		if (strpos($real_path, 'ephp.exe') !== FALSE) {
			$real_path = str_replace('ephp.exe', 'php.exe', $real_path);
		}
		$this->php_path = $real_path;
		return $this->php_path;
	}


}
