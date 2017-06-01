<?php
class Curl {
	private static $cookieJar = "cache/cookieJar/";
	private static $timeout = 120;

	static public function get($url) {
		$timeout = isset($options['timeout']) ? intval($options['timeout']) : self::$timeout;
		$connect_timeout = isset($options['connect_timeout']) ? intval($options['connect_timeout']) : self::$timeout;
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $connect_timeout);
		curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
		curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
		$result = curl_exec($ch);
		return $result;
	}

	static public function post($url, $data = array(), $options = array()) {
		if (!$url || !parse_url($url)) {
			return false;
		}
		if (!function_exists("curl_init")) {
			echo "不支持CURL";
			return false;
		}
		$timeout = isset($options['timeout']) ? intval($options['timeout']) : self::$timeout;
		$connect_timeout = isset($options['connect_timeout']) ? intval($options['connect_timeout']) : self::$timeout;
		$cookieJar = isset($options['cookieJar']) ? $options['cookieJar'] : APPPATH . self::$cookieJar;
		$useCookie = isset($options['useCookie']) ? $options['useCookie'] : TRUE;
		$saveCookie = isset($options['saveCookie']) ? $options['saveCookie'] : FALSE;

		if (!is_dir($cookieJar)) {
			mkdirs($cookieJar);
		}
		$ch = curl_init();
		if (is_array($data) && $data) {
			$formdata = http_build_query($data);
			curl_setopt($ch, CURLOPT_POST, TRUE);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $formdata);
		}
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_BINARYTRANSFER, TRUE);
		//连接服务器超时时间
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $connect_timeout);
		//输出缓冲超时时间
		curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
		curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);

		$cookieFile = self::getCookieFile($url);
		if ($useCookie) {
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_COOKIEFILE, $cookieFile);
		}

		if ($saveCookie) {
			curl_setopt($ch, CURLOPT_COOKIEJAR, $cookieFile);
		}

		$result = curl_exec($ch);

		return $result;
	}

	static function getCookieFile($url, $cookieJar = "") {
		$urlParse = parse_url($url);
		$urlParse['path'] = isset($urlParse['path']) ? $urlParse['path'] : "";
		$cookieJar = $cookieJar ? $cookieJar : self::$cookieJar;
		return APPPATH . $cookieJar . md5($urlParse['host'] . dirname($urlParse['path'])) . ".cookie";
	}

	static function deleteCookieFile($url, $cookieJar = "") {
		$file = self::getCookieFile($url, $cookieJar);
		return @unlink($file);
	}

}
?>