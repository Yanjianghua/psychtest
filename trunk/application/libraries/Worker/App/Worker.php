<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Worker extends WorkBase {
	public $callback;
	public $pid;

	public function __construct($callback) {
		$this->callback = $callback;
	}

	public function run() {
		$this->pid = self::createFork(function($pid) {
			self::callback($this->callback, array($pid));
		});
	}

}
