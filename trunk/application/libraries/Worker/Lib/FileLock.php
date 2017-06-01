<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class FileLock {
	private $key;
	private $file;
	private $fp;

	public function __construct($options = array()) {
		$this->key = $options['key'];
		$this->file = APPPATH . "libraries/Worker/Cache/" . $this->key . ".cache";
		if (!file_exists($this->file)) {
			touch($this->file);
		}
	}

	public function lock() {
		$this->fp = fopen($this->file, "w+");
		flock($this->fp, LOCK_EX);
	}

	public function unlock() {
		flock($this->fp, LOCK_UN);
		fclose($this->fp);
	}

}
