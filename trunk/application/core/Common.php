<?php
function HTTP404() {
	header('HTTP/1.1 404 Not Found');
	header("status: 404 Not Found");
	exit ;
}

function cut_str($str, $length, $start = 0, $charset = "utf-8", $suffix = true) {
	$str = trim(strip_tags($str));
	if (function_exists("mb_substr"))
		return mb_substr($str, $start, $length, $charset);
	elseif (function_exists('iconv_substr')) {
		return iconv_substr($str, $start, $length, $charset);
	}
	$re['utf-8'] = "/[/x01-/x7f]|[/xc2-/xdf][/x80-/xbf]|[/xe0-/xef][/x80-/xbf]{2}|[/xf0-/xff][/x80-/xbf]{3}/";
	$re['gb2312'] = "/[/x01-/x7f]|[/xb0-/xf7][/xa0-/xfe]/";
	$re['gbk'] = "/[/x01-/x7f]|[/x81-/xfe][/x40-/xfe]/";
	$re['big5'] = "/[/x01-/x7f]|[/x81-/xfe]([/x40-/x7e]|/xa1-/xfe])/";
	preg_match_all($re[$charset], $str, $match);
	$slice = join("", array_slice($match[0], $start, $length));
	if ($suffix)
		return $slice . "…";
	return $slice;
}

function wrrong_msg($msg) {
	return array(
		"success" => FALSE,
		"msg" => $msg
	);
}

function success_msg($msg) {
	return array(
		"success" => TRUE,
		"msg" => $msg
	);
}

function success_data($data) {
	return array(
		"success" => TRUE,
		"data" => $data
	);
}

function parse_alert($data, $method = "ALERT") {
	if (!is_null($data) && !empty($data) && isset($data['success'])) {
		if ($data['success'] === TRUE) {
			if (isset($data['data'])) {
				return $data['data'];
			}
			$method == "JSON" ? print_json(success_msg($data['msg'])) : alert($data['msg']);
		}
		if (isset($data['msg'])) {
			$method == "JSON" ? print_json(wrrong_msg($data['msg'])) : alert($data['msg'], "BACK");
		}
	}
	$method == "JSON" ? print_json(wrrong_msg(MSG_INVALID_ARGUMENTS)) : alert(MSG_INVALID_ARGUMENTS);
}

function parse_data($data) {
	if (!is_null($data) && !empty($data) && isset($data['success'])) {
		if ($data['success'] === TRUE) {
			if (isset($data['data'])) {
				return $data['data'];
			}
			return true;
		}
		return false;
	}
}

//js消息弹窗
function alert($data = "", $goto = "", $close = "", $windowperfix = "") {
	header("Content-Type: text/html;charset=utf-8");
	if (is_array($data)) {
		$msg = isset($data['msg']) ? $data['msg'] : "";
		$goto = isset($data['goto']) ? $data['goto'] : "";
		$close = isset($data['close']) ? $data['close'] : "";
	} else {
		$msg = $data;
	}
	echo "<script language='javascript'>";
	if ($msg != "") {
		if (!is_array($msg)) {
			echo "alert('" . $msg . "');";
		} else {
			echo "alert('" . $msg['msg'] . "');";
		}
	}
	if ($goto != "") {
		if ($goto == "BACK") {
			echo "window{$windowperfix}.history.back();";
		} else if ($goto == "PARENT") {
			echo "window{$windowperfix}.parent.location.reload();";
		} else {
			echo "window{$windowperfix}.location.href='" . $goto . "';";
		}
	} else {
		$goto = "window{$windowperfix}.document.referrer";
		echo "window{$windowperfix}.location.href=" . $goto . ";";
	}
	if ($close) {
		echo "window{$windowperfix}.close();";
	}
	echo "</script>";
	exit ;
}

function print_json($data, $exit = true) {
	header("Content-type: application/json;charset=utf-8");
	echo json_encode($data);
	$exit && exit ;
}

function pages($total, $limit, $rule = "") {
	$pageHandler = &load_class("Pagination");
	$CI = &get_instance();
	$CI->load->config("url", TRUE);
	$config['base_url'] = $rule;
	$config['reuse_query_string'] = FALSE;
	$config['use_page_numbers'] = TRUE;
	$config['prefix'] = $CI->config->config['url']['page_prefix'];
	$config['suffix'] = $CI->config->config['url']['page_suffix'] . $CI->config->config['url']['suffix'];
	$config['num_links'] = 5;
	$config['total_rows'] = $total;
	$config['per_page'] = $limit;
	$config['full_tag_open'] = "<div class='fy'><div class='pagelist'>";
	$config['full_tag_close'] = "</div></div>";
	$config['next_link'] = "&gt;";
	$config['prev_link'] = "&lt;";
	$config['first_link'] = "&lt;&lt;";
	$config['last_link'] = "&gt;&gt;";
	$config['cur_tag_open'] = "<a class='thisclass'>";
	$config['cur_tag_close'] = "</a>";
	return $pageHandler->initialize($config)->create_links();
}

function pages_m($total, $limit, $rule = "") {
	$pageHandler = &load_class("Pagination");
	$CI = &get_instance();
	$CI->load->config("url", TRUE);
	$config['base_url'] = $rule;
	$config['reuse_query_string'] = FALSE;
	$config['use_page_numbers'] = TRUE;
	$config['prefix'] = $CI->config->config['url']['page_prefix'];
	$config['suffix'] = $CI->config->config['url']['page_suffix'] . $CI->config->config['url']['suffix'];
	$config['num_links'] = 5;
	$config['total_rows'] = $total;
	$config['per_page'] = $limit;
	$config['full_tag_open'] = '<div class="fenye">';
	$config['full_tag_close'] = "</div>";
	$config['next_link'] = "下一页";
	$config['prev_link'] = "上一页";
	$config['first_link'] = '首页';
	$config['last_link'] = '尾页';
	$config['cur_tag_open'] = "<a class='thisclass'>";
	$config['cur_tag_close'] = "</a>";
	return $pageHandler->initialize($config)->create_links();
}

function str_random($length = "6") {
	$rand = "";
	for ($i = 0; $i < $length; $i++) {
		$rand .= chr(mt_rand(33, 126));
	}
	return $rand;
}

function password($pwd) {
	if (!$pwd) {
		return "";
	}
	return md5(md5($pwd));
}
function ip() {
	$ip_arr = array();
	$invalid_arr = array(
		'10',
		'127',
		'172',
		'192',
		'255'
	);
	if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$for_arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
		foreach ($for_arr as $for_ip) {
			$for_ip = trim($for_ip);
			if (ip2long($for_ip) === false)
				continue;
			array_push($ip_arr, $for_ip);
		}
	}
	if (isset($_SERVER['HTTP_CLIENT_IP'])) {
		$client_ip = trim($_SERVER['HTTP_CLIENT_IP']);
		if (ip2long($client_ip) !== false)
			array_push($ip_arr, $client_ip);
	}
	if (isset($_SERVER['REMOTE_ADDR'])) {
		$remote_ip = trim($_SERVER['REMOTE_ADDR']);
		if (ip2long($remote_ip) !== false)
			array_push($ip_arr, $remote_ip);
	}

	foreach ($ip_arr as $ip) {
		$ip_item = explode('.', $ip);
		if (!in_array($ip_item[0], $invalid_arr))
			return $ip;
	}
	return '0.0.0.0';
}

function date2time($date, $method = "START") {
	if (!$date)
		return false;
	$time = "";
	if ($method == "START") {
		$time = strtotime($date . " 00:00:00");
	} else {
		$time = strtotime($date . " 23:59:59");
	}
	return $time;
}

function getBackUrl() {
	$CI = &get_instance();
	$backurl = $CI->input->get("HTTP_REFERER");
	if (!$backurl) {
		$c = $CI->uri->rsegments[1];
		$a = $CI->uri->rsegments[2];
		$backurl = '/' . $c . '/' . $a . '/?' . $_SERVER['QUERY_STRING'];
		$HTTP_REFERER = $CI->input->server("HTTP_REFERER");
		if (!$HTTP_REFERER) {
			$HTTP_REFERER = "/";
		}
		header("location: " . $backurl . "&HTTP_REFERER=" . urlencode($HTTP_REFERER));
	}
	return $backurl;
}

function trims($string) {
	if (!is_array($string)) {
		return is_string($string) ? trim($string) : $string;
	}
	foreach ($string as $key => $val)
		$string[$key] = trims($val);
	return $string;
}

function authcode($string, $key = '', $operation = 'DECODE', $expiry = 0) {
	// 动态密匙长度，相同的明文会生成不同密文就是依靠动态密匙
	$ckey_length = 4;

	// 密匙
	$key = md5($key);

	// 密匙a会参与加解密
	$keya = md5(substr($key, 0, 16));
	// 密匙b会用来做数据完整性验证
	$keyb = md5(substr($key, 16, 16));
	// 密匙c用于变化生成的密文
	$keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length) : substr(md5(microtime()), -$ckey_length)) : '';
	// 参与运算的密匙
	$cryptkey = $keya . md5($keya . $keyc);
	$key_length = strlen($cryptkey);
	// 明文，前10位用来保存时间戳，解密时验证数据有效性，10到26位用来保存$keyb(密匙b)，
	//解密时会通过这个密匙验证数据完整性
	// 如果是解码的话，会从第$ckey_length位开始，因为密文前$ckey_length位保存 动态密匙，以保证解密正确
	$string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0) . substr(md5($string . $keyb), 0, 16) . $string;
	$string_length = strlen($string);
	$result = '';
	$box = range(0, 255);
	$rndkey = array();
	// 产生密匙簿
	for ($i = 0; $i <= 255; $i++) {
		$rndkey[$i] = ord($cryptkey[$i % $key_length]);
	}
	// 用固定的算法，打乱密匙簿，增加随机性，好像很复杂，实际上对并不会增加密文的强度
	for ($j = $i = 0; $i < 256; $i++) {
		$j = ($j + $box[$i] + $rndkey[$i]) % 256;
		$tmp = $box[$i];
		$box[$i] = $box[$j];
		$box[$j] = $tmp;
	}
	// 核心加解密部分
	for ($a = $j = $i = 0; $i < $string_length; $i++) {
		$a = ($a + 1) % 256;
		$j = ($j + $box[$a]) % 256;
		$tmp = $box[$a];
		$box[$a] = $box[$j];
		$box[$j] = $tmp;
		// 从密匙簿得出密匙进行异或，再转成字符
		$result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
	}
	if ($operation == 'DECODE') {
		// 验证数据有效性，请看未加密明文的格式
		if ((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26) . $keyb), 0, 16)) {
			return substr($result, 26);
		} else {
			return '';
		}
	} else {
		// 把动态密匙保存在密文里，这也是为什么同样的明文，生产不同密文后能解密的原因
		// 因为加密后的密文可能是一些特殊字符，复制过程可能会丢失，所以用base64编码
		return $keyc . str_replace('=', '', base64_encode($result));
	}
}

function getPrimeryKeys($list, $key = "id") {
	if (!$list)
		return array();
	if (isset($list[$key])) {
		return $list[$key];
	}
	$result = array();
	foreach ($list as $k => $v) {
		if (!$v[$key])
			return array();
		$result[] = $v[$key];
	}
	return $result;
}

function mkdirs($dir) {
	return is_dir($dir) or (mkdirs(dirname($dir)) and mkdir($dir, 0777));
}

function repeat($callback, $times = 0) {
	for ($i = 0; $i < $times; $i++) {
		$success = $callback($i);
		if ($success) {
			return $success;
		}
	}
	return false;
}

function mb_substr_replace($str, $replacement, $start, $length) {
	$len = mb_strlen($str);
	$str1 = mb_substr($str, 0, $start);
	$str2 = mb_substr($str, $start + $length);
	return $str1 . $replacement . $str2;
}

function get_extension($filename) {
	$arr = explode('.', $filename);
	return end($arr);
}

function upload($file, $folder = "/tmp") {
	if (empty($file) || $file['error'] > 0) {
		return false;
	}
	$ext = get_extension($file['name']);
	$key = md5($file['name']);

	$folder = preg_replace("/[\\\\\/]/", DIRECTORY_SEPARATOR, $folder);
	$folder .= DIRECTORY_SEPARATOR . substr($key, 0, 2) . DIRECTORY_SEPARATOR . substr($key, 2, 2) . DIRECTORY_SEPARATOR . substr($key, 4, 2) . DIRECTORY_SEPARATOR;
	$path = "data" . $folder;
	if (!is_dir(FCPATH . $path)) {
		mkdirs($path);
	}
	if (!is_really_writable(FCPATH . $path)) {
		return false;
	}
	$name = rand() . "." . $ext;
	$filename = $path . $name;
	if (!move_uploaded_file($file["tmp_name"], FCPATH . $filename)) {
		return false;
	}
	return DIRECTORY_SEPARATOR . $filename;
}

function br2nl($text) {
	return preg_replace('/<br\\s*?\/??>/i', '', $text);
}

function compress($array) {
	if (empty($array)) {
		return "";
	}
	return utf8_encode(gzcompress(base64_encode(serialize($array))));
}

function decompress($blob) {
	if (empty($blob)) {
		return "";
	}
	return unserialize(base64_decode(gzuncompress(utf8_decode($blob))));
}

function useCache(&$cache, $key, $noCacheCallback) {
	if (empty($key)) {
		return false;
	}
	if (empty($cache) || !isset($cache[$key])) {
		$cache[$key] = $noCacheCallback($key);
	}
	return $cache[$key];
}

function optionExists($arg) {
	return $arg !== "";
}

function formatOptions($options, $keys) {
	$options = trims($options);
	$temp = array();
	if (empty($options) || empty($keys)) {
		$options = array();
	}
	foreach ($keys as $k => $v) {
		$key = $v;
		if (!is_numeric($k)) {
			$key = $k;
		}
		$temp[$v] = isset($options[$key]) ? $options[$key] : "";
	}
	return $temp;
}

function nonl($str) {
	return str_replace(array(
		"\r\n",
		"\r",
		"\n"
	), '', $str);
}

function array_search_multi($arr, $column, $findstring) {
	foreach ($arr as $key => $value) {
		if (isset($value[$column]) && $value[$column] == $findstring) {
			return $value;
		}
		if (is_array($value)) {
			if ($v = array_search_multi($value, $column, $findstring)) {
				return $v;
			}
		}
	}
	return false;
}

function formatUrl($type) {
	$CI = &get_instance();
	$CI->load->config("url", TRUE);
	$args = array();
	foreach (func_get_args() as $k => $v) {
		if ($k > 0)
			$args[] = $v;
	}
	if (!$type)
		return "";
	$url_config = $CI->config->config['url'][$type];
	if (empty($url_config))
		return "";
	if (!is_array($url_config))
		return $url_config;
	$originalUrl = $url_config['url'];
	$null = $url_config['none'];
	$showAll = $url_config['all'] ? $url_config['all'] : false;
	$matched = preg_match_all("/(\\[.*?\\$([0-9]+?).*?\\])/", $originalUrl, $matches);
	if (!$matched)
		return $originalUrl;
	$matches = $matches[2];
	if (count($matches) > 0) {
		if (!$showAll) {
			$tempMatches = array_reverse($matches);
			foreach ($tempMatches as $v) {
				if (!$args[$v - 1]) {
					array_pop($args);
				} else {
					break;
				}
			}
		}
		sort($matches);
		$max = end($matches);
		$result = $originalUrl;
		for ($i = 0; $i < $max; $i++) {
			$argIndex = $matches[$i];
			$pattern = "/\\[([^\\$" . $argIndex . "]*?)\\$" . $argIndex . "([^\\$" . $argIndex . "]*?)\\]/im";
			$argValue = isset($args[$i]) ? $args[$i] : (isset($args[$i]) ? $null : "");
			$result = preg_replace_callback($pattern, function($matches) use ($argValue) {
				if ($argValue == "") {
					return "";
				}
				return $matches[1] . $argValue . $matches[2];
			}, $result);
		}
	}
	return $result;
}

function cms_auth_code($time = false) {
	$CI = &get_instance();
	$time = $time ? $time : microtime(TRUE);
	$str = str_split(md5($time));
	$sec = "";
	foreach ($str as $v) {
		$sec .= $v ^ $CI->config->config['authcode'];
	}
	return array(
		"secret_time" => $time,
		"secret" => base64_encode(trim($sec))
	);
}

function getServer($name) {
	if ($name == "REMOTE_HOST") {
		return formatUrl("oldomain");
	}
	return $_SERVER[$name];
}

function request_uri() {
	if (empty($_SERVER['REQUEST_URI'])) {
		// IIS Mod-Rewrite
		if (isset($_SERVER['HTTP_X_ORIGINAL_URL'])) {
			$_SERVER['REQUEST_URI'] = $_SERVER['HTTP_X_ORIGINAL_URL'];
		}// IIS Isapi_Rewrite
		else if (isset($_SERVER['HTTP_X_REWRITE_URL'])) {
			$_SERVER['REQUEST_URI'] = $_SERVER['HTTP_X_REWRITE_URL'];
		} else {
			// Use ORIG_PATH_INFO if there is no PATH_INFO
			if (!isset($_SERVER['PATH_INFO']) && isset($_SERVER['ORIG_PATH_INFO']))
				$_SERVER['PATH_INFO'] = $_SERVER['ORIG_PATH_INFO'];
			// Some IIS + PHP configurations puts the script-name in the
			// path-info (No need to append it twice)
			if (isset($_SERVER['PATH_INFO'])) {
				if ($_SERVER['PATH_INFO'] == $_SERVER['SCRIPT_NAME'])
					$_SERVER['REQUEST_URI'] = $_SERVER['PATH_INFO'];
				else
					$_SERVER['REQUEST_URI'] = $_SERVER['SCRIPT_NAME'] . $_SERVER['PATH_INFO'];
			}
			// Append the query string if it exists and isn't null
			if (isset($_SERVER['QUERY_STRING']) && !empty($_SERVER['QUERY_STRING'])) {
				$_SERVER['REQUEST_URI'] = $_SERVER['QUERY_STRING'];
			}
		}
	}
}
?>