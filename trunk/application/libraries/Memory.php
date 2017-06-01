<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Memory {
	private $key;
	private $shmid;
	private $semid;
	private $size;

	public function __construct($options = array()) {
		$defaults = array(
			"key" => "shm",
			"size" => 1024 * 1024
		);
		$options = array_merge($defaults, $options);
		$this->key = $options["key"];
		$this->size = $options['size'];
		$this->shmid = $this->getShmid();
	}

	private function getShmid() {
		$shmid = shm_attach($this->getKey($this->key), $this->size);
		if (!$shmid) {
			return false;
		}
		return $shmid;
	}

	private function getKey($key) {
		return hexdec($key);
	}

	public function write($key, $value) {
		$shmkey = $this->getKey($key);
		return shm_put_var($this->shmid, $shmkey, $value);
	}

	public function merge($key, $value) {
		if (!is_array($value))
			return false;
		$shmkey = $this->getKey($key);
		$data = $this->read($key);
		$data = array_merge($data, $value);
		return shm_put_var($this->shmid, $shmkey, $data);
	}

	public function push($key, $value) {
		if (!$value)
			return false;
		$shmkey = $this->getKey($key);
		$data = $this->read($key);
		if (!$data) {
			$data = array();
		}
		$data[] = $value;
		$data = array_unique($data);
		return shm_put_var($this->shmid, $shmkey, $data);
	}

	public function pop($key, $value) {
		if (!$value)
			return false;
		$shmkey = $this->getKey($key);
		$data = $this->read($key);
		if (!$data) {
			return false;
		}
		$key = array_search($value, $data);
		if ($key !== false) {
			unset($data[$key]);
		}
		return shm_put_var($this->shmid, $shmkey, $data);
	}

	public function search($key, $value) {
		if (!$value)
			return false;
		$shmkey = $this->getKey($key);
		$data = $this->read($key);
		if (!$data) {
			return false;
		}
		$key = array_search($value, $data);
		if ($key !== false) {
			return $data[$key];
		}
		return false;
	}

	public function read($key) {
		$shmkey = $this->getKey($key);
		if (!shm_has_var($this->shmid, $shmkey)) {
			return false;
		}
		return shm_get_var($this->shmid, $shmkey);
	}

	public function remove($key) {
		$shmkey = $this->getKey($key);
		if (!shm_has_var($this->shmid, $shmkey)) {
			return false;
		}
		return shm_remove_var($this->shmid, $shmkey);
	}

	public function clean() {
		return shm_remove($this->shmid);
	}

	public function close() {
		shm_detach($this->shmid);
	}

	public function lock() {
		$this->semid = sem_get($this->getKey($this->key));
		sem_acquire($this->semid);
	}

	public function unlock() {
		sem_release($this->semid);
	}

}
