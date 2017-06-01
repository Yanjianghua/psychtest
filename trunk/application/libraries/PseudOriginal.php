<?php
class PseudOriginal {

	const PLACEHOLDER = "占";
	const STR_COMMA = "，";
	const STR_STOP = "。";
	const STR_BLANK = "　";

	public function __construct() {
		$this->CI = &get_instance();
		$this->CI->load->library("RMM");
	}

	public function addKeyword($ocontent, $keyword) {
		$temp = $ocontent;
		$poses = array(
			"。",
			"！",
			"；",
			"？"
		);
		$result = array();
		foreach ($poses as $k => $pos) {
			while ($strpos = mb_strpos($temp, $pos)) {
				$temp = mb_substr_replace($temp, self::PLACEHOLDER, $strpos, 1);
				$result[] = $strpos;
			}
		}
		if (empty($result)) {
			return $ocontent;
		}
		//打乱数组
		$number = min(rand(3, 5), count($result));
		if (!is_numeric($number)) {
			return $ocontent;
		}
		$rand = array_rand($result, $number);
		if (!$rand) {
			return $ocontent;
		}

		$tempResult = array();
		foreach ($rand as $k) {
			$tempResult[] = $result[$k];
		}

		if (empty($tempResult)) {
			return $ocontent;
		}

		rsort($tempResult);

		//开始替换
		$content = $ocontent;
		foreach ($tempResult as $k => $strpos) {
			//随机是在符号前还是符号后
			$before = rand(1, 100);
			$str = mb_substr($content, $strpos, 1);
			//符号前
			$replacement = self::STR_COMMA . $keyword . $str;
			if ($before > 50) {
				//符号后
				$replacement = $str . $keyword;
				//去掉空格
				$endstr = trim(mb_substr($content, $strpos + 1, 1));
				//去掉全角空格
				$endstr = str_replace(self::STR_BLANK, "", $endstr);
				if ($endstr == "") {
					$replacement .= self::STR_STOP;
				} else if ($endstr == "<") {
					//取后十个字符串比较
					$matchstr = trim(mb_substr($content, $strpos + 1, 10));
					$matched = preg_match("/^<[^a-zA-Z]*?([a-zA-Z]*?)[^a-zA-Z]*?>/", $matchstr, $matches);
					if ($matched && in_array(strtolower($matches[1]), array(
						"div",
						"p",
						"br"
					))) {
						//如果是换行标签
						$replacement .= self::STR_STOP;
					} else {
						//如果不是换行标签
						$replacement .= self::STR_COMMA;
					}
				} else {
					$replacement .= self::STR_COMMA;
				}
			}

			$content = mb_substr_replace($content, $replacement, $strpos, 1);

		}

		return $content;
	}

	public function synonymsReplace($ocontent, $words, $rate = 30) {
		if (empty($ocontent) || empty($words)) {
			return $ocontent;
		}
		//先找到有近义词的词,并将坐标存到新数组
		$coordinates = array();
		foreach ($words as $v) {
			$word = unserialize($this->CI->RMM->read($v['name']));
			if (empty($word) || empty($word['synonyms']) || $word['synonyms'] == "")
				continue;
			foreach ($v['map'] as $map) {
				$map['name'] = $v['name'];
				$map['replace'] = $v['synonyms'];
				$coordinates[] = $map;
			}
		}
		if (empty($coordinates)) {
			return $ocontent;
		}
		//随机取出
		$number = min(ceil(($rate / 100) * count($coordinates)), count($coordinates));
		if (!is_numeric($number) || $number < 0) {
			return $ocontent;
		}
		$rand = array_rand($coordinates, $number);
		if (!empty($rand)) {
			return $ocontent;
		}

		//用随机出来的k组成新的坐标
		$newcoordinates = array();
		foreach ($rand as $k) {
			$newcoordinates[] = $coordinates[$k];
		}

		//对新坐标进行排序
		usort($newcoordinates, function($a, $b) {
			if ($a[0] == $b[0] && $a[1] == $b[1]) {
				return 0;
			}
			if ($a[0] == $b[0]) {
				return $a[1] > $b[1] ? -1 : 1;
			}
			return $a[0] > $b[0] ? -1 : 1;
		});
		//开始替换
		$content = $ocontent;
		foreach ($newcoordinates as $v) {
			$content = mb_substr_replace($content, $v['replace'], $v[0], $v[1]);
		}
		return $content;
	}

}
?>