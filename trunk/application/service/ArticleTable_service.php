<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ArticleTable_service extends MY_Service {

	public function __construct() {
		parent::__construct();
		$this->loadModel("Article", "Table");
		$this->load->library("Worker/Lib/FileLock", array("key" => "table"), "table_lock");
		$this->sizelimit = 100000;
	}

	public function run() {
		$count = $this->db->count_all_results("article_tmp");
		echo "total: {$count}\n";
		echo "insert article_add\n";
		$this->db->query("INSERT INTO article_add(pid,thumb,content,keywords,description,editor) SELECT id,thumb,content,keywords,description,editor FROM article_tmp");
		$size = ceil($count / $this->sizelimit);
		$tables = array();
		for ($page = 0; $page < $size; $page++) {
			$offset = $page * $this->sizelimit;
			$tablename = $tables[] = "`" . Article_model::$_table . "_" . ($page + 1) . "`";
			echo "creating table {$tablename}\n";
			$this->db->query("CREATE TABLE {$tablename} LIKE article_template");
			$this->Table_model->insert(array("name" => $tablename));
			echo "insert table {$tablename}\n";
			$this->db->query("INSERT INTO {$tablename}(id,uid,utype,channelid,dir,title,`addtime`,recommand) SELECT id,uid,utype,channelid,dir,title,`addtime`,recommand FROM article_tmp limit {$offset},{$this->sizelimit}");
		}
		echo "creating merge table\n";
		$this->db->query("CREATE TABLE `article` LIKE article_template");
		$this->db->query("ALTER TABLE article ENGINE=MERGE DEFAULT CHARSET=utf8 UNION=(" . implode(",", $tables) . ") INSERT_METHOD=LAST");
		echo "update pic\n";
		$this->db->query("UPDATE article LEFT JOIN article_add ON article.id=article_add.pid SET ispic=1 WHERE thumb!=''");
	}

	public function autoCreateTable() {
		$this->table_lock->lock();
		$count = $this->Article_model->count();
		if ($count == 0) {
			return false;
		}
		if ($count % $this->sizelimit == 0) {
			$count = $this->Table_model->count();
			$tablename = "`" . Article_model::$_table . "_" . ($count + 1) . "`";
			$this->Table_model->insert(array("name" => $tablename));
			$this->db->query("CREATE TABLE {$tablename} LIKE article_template");
			$tables = array();
			for ($i = 1; $i <= $count + 1; $i++) {
				$tables[] = "`" . Article_model::$_table . "_" . ($i) . "`";
			}
			$this->db->query("ALTER TABLE " . Article_model::$_table . " UNION=(" . implode(",", $tables) . ")");
			return true;
		}
		$this->table_lock->unlock();
		return false;
	}

	public function updata(){
		if($this->db->table_exists('article')){
			$this->db->query("DROP TABLE `article`");
		}else{
			return wrrong_msg("数据库没有article表");
		}
		//article_tmp表结构修改
		if ($this->db->field_exists('status', 'article_tmp')){
			echo "article_tmp表的status字段已添加";
		}else{
			$this->db->query("ALTER TABLE `article_tmp` ADD COLUMN `status` tinyint(1) DEFAULT '0' NOT NULL AFTER `recommand`;");
		}
		//article_template表结构修改
		if ($this->db->field_exists('status', 'article_template')){
			echo "article_template表的status字段已添加";
		}else {
			$this->db->query("ALTER TABLE `article_template` ADD COLUMN `status` tinyint(1) DEFAULT '0' NOT NULL AFTER `recommand`;");
		}
		//article_1等附表的修改表结构
		$count = $this->db->count_all_results("`table`");
		echo "更新过程可能需要几分钟，请您耐心等待!";
		for ($page = 0; $page < $count; $page++) {
			$tablename = $tables[] = "`" . Article_model::$_table . "_" . ($page + 1) . "`";
			echo "alter table {$tablename}\n";
			if ($this->db->field_exists('status', "{$tablename}")){
				echo "{$tablename}表的status字段已添加";
			}else {
				$this->db->query("ALTER TABLE {$tablename} ADD COLUMN `status` tinyint(1) DEFAULT '0' NOT NULL AFTER `recommand`;");
			}
		}
			//合并article表修改
			$tablename=$this->Table_model->get_list();
			$tname = getPrimeryKeys($tablename, "name");
			$tname = implode(",", $tname);
		if($this->db->table_exists('article')) {
			echo "creating table article\n";
			$this->db->query("CREATE TABLE `article` LIKE article_template");
			$this->db->query("ALTER TABLE article ENGINE=MERGE DEFAULT CHARSET=utf8 UNION=(" . $tname . ") INSERT_METHOD=LAST");
			echo "updata article OK\n";
			$this->db->query("UPDATE `article` SET `status`=1;");
			echo "updata article status=1 !";
		}else{
			echo "修改article 结构失败!（@_@）";
		}
	}

}
?>