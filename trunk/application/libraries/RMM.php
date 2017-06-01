<?php
/**
 * RMM逆向分割字符串
 * **/
class RMM {
	//数据库中最大词长度
	public $maxWordSize = 10;
	//匹配最小字长度
	public $minWordSize = 2;
	//查找精度 如果为1 那么肯定能查询到所有词 精度大于5效果可能会很差
	public $precision = 1;
	//生成数据文件位置
	public $dataPath;
	private $CI;

	const MSG_ERROR_DIR_NOT_WRITABLE = "'%s' 目录不可写";

	public function __construct() {
		$this->CI = &get_instance();
		$this->CI->loadModel("Word");
		$this->dataPath = dirname(SELF) . DIRECTORY_SEPARATOR . "data" . DIRECTORY_SEPARATOR . "RMMData";
	}

	public function splitWord($content) {
		$len = mb_strlen($content);
		$result = array();
		$key = array();
		for ($j = $len - $this->maxWordSize; $j > 0; $j -= $this->precision) {
			for ($i = $this->maxWordSize; $i >= $this->minWordSize; $i--) {
				$str = mb_substr($content, $j, $i);
				$strLen = mb_strlen($str);

				if (!(preg_match("/^[\x{4e00}-\x{9fa5}]+?$/u", $str) && $strLen >= $this->minWordSize)) {
					continue;
				}

				//如果在缓存中，直接追加缓存
				if (in_array($str, $key)) {
					$result[array_search($str, $key)]['count']++;
					$result[array_search($str, $key)]['map'][] = array(
						$j,
						$i
					);
					$i -= $strLen;
					continue;
				}

				$word = $this->read($str);
				if (!empty($word)) {
					$word = unserialize($word);
					array_push($result, array(
						"name" => $str,
						"attr" => $word['attr'],
						"count" => 1,
						"synonyms" => $word['synonyms'],
						"map" => array( array(
								$j,
								$i
							))
					));
					$i -= $strLen;
					array_push($key, $str);
				}
			}
		}

		return $result;
	}

	public function make() {
		if (!is_dir($this->dataPath)) {
			mkdirs($this->dataPath);
		}
		if (!is_really_writable($this->dataPath)) {
			exit(sprintf($this->MSG_ERROR_DIR_NOT_WRITABLE, $this->dataPath));
		}
		$page = 1;
		$limit = 10000;
		$total = $this->CI->Word_model->count();
		$count = 0;
		while (true) {
			$offset = ($page - 1) * $limit;
			$list = $this->CI->Word_model->limit($limit, $offset)->order_by("id", "ASC")->get_list();
			if (empty($list)) {
				break;
			}
			$page++;
			foreach ($list as $v) {
				$filename = $this->getFile($v['name']);
				if (!is_dir(dirname($filename))) {
					mkdirs(dirname($filename));
				}
				$fileHandler = fopen($filename, "w+");
				fwrite($fileHandler, serialize($v));
				fclose($fileHandler);
				$count++;
			}
			system_clear();
			echo((sprintf("%.2f", ($count / $total) * 100)) . "%");
		}
		system_clear();
		echo "done\n";
	}

	public function read($name) {
		$filename = $this->getFile($name);
		if (is_file($filename)) {
			$fileHandler = fopen($filename, FOPEN_READ);
			if (!is_null($fileHandler)) {
				$data = fread($fileHandler, filesize($filename));
				fclose($fileHandler);
				if (!empty($data)) {
					return $data;
				}
			}
		}
		return false;
	}

	public function getFile($name) {
		$name = md5($name);
		$filename = $this->dataPath . DIRECTORY_SEPARATOR . substr($name, 0, 2) . DIRECTORY_SEPARATOR . substr($name, 2, 2) . DIRECTORY_SEPARATOR . substr($name, 4, 2) . DIRECTORY_SEPARATOR . $name;
		return $filename;
	}

	public function clean($path = "") {
		$path = $path ? $path : $this->dataPath;
		if (!is_dir($path))
			return;

		$files = scandir($path);
		$noscan = array(
			".",
			".."
		);
		foreach ($files as $filename) {
			if (in_array($filename, $noscan)) {
				continue;
			}
			$full_name = $path . DIRECTORY_SEPARATOR . $filename;
			if (is_dir($full_name)) {
				$this->clean($full_name);
				rmdir($full_name);
			} else {
				unlink($full_name);
			}
			echo ".";
		}
	}

}
?>