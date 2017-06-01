<?php
if (!defined("BASEPATH"))
	exit('No direct script access allowed');

class MY_Model extends CI_Model {

	public $CI;
	public $database;
	public $rollback = array();
	private $force_index = "";
	protected $model_method_list = array(
		"get_item",
		"get_list",
		"count",
		"insert",
		"insert_batch",
		"update",
		"update_batch",
		"delete",
		"join",
		"rollback",
		"commit",
		"primary_key",
		"force_index"
	);

	public function __construct($database = null) {
		parent::__construct();
		$this->CI = &get_instance();
		if ($database == null) {
			$this->database = $this->db;
		} else {
			$this->database = $database;
		}
	}

	public function __call($name, $param_arr) {
		if (method_exists($this->database, $name) || in_array($name, $this->model_method_list)) {
			$model = get_called_class();
			if (isset($model::$_table)) {
				$_table = "`" . $model::$_table . "`";
			}
			$this->database->reconnect();
			if ($name == "get_item" || $name == "get_list") {
				if ($name == "get_item") {
					$this->database->limit(1);
				}
				$query = call_user_func(array(
					$this->database,
					"get"
				), $_table . $this->_force_index());
				$result = $query->result_array();
				$query->free_result();
				return !empty($result) && count($result) > 0 ? ($name == "get_item" ? $result[0] : $result) : array();
			} else if ($name == "count") {
				$result = call_user_func(array(
					$this->database,
					"count_all_results"
				), $_table . $this->_force_index());
				return $result;
			} else if ($name == "insert" || $name == "insert_batch") {
				$result = call_user_func(array(
					$this->database,
					$name
				), $_table . $this->_force_index(), isset($param_arr[0]) ? $param_arr[0] : NULL);
				if ($result) {
					$insert_id = call_user_func(array(
						$this->database,
						"insert_id"
					));
					if ($insert_id) {
						return $insert_id;
					}
					return true;
				}
				return false;
			} else if ($name == "update" || $name == "update_batch") {
				$success = call_user_func(array(
					$this->database,
					$name
				), $_table . $this->_force_index(), isset($param_arr[0]) ? $param_arr[0] : NULL, isset($param_arr[1]) ? $param_arr[1] : NULL);
				return $success;
			} else if ($name == "delete") {
				$success = call_user_func(array(
					$this->database,
					"delete"
				), $_table . $this->_force_index());
				return $success;
			} else if ($name == "rollback") {
				foreach ($this->rollback as $func) {
					$func();
				}
			} else if ($name == "commit") {
				$this->rollback = array();
			} else if ($name == "primary_key") {
				return call_user_func(array(
					$this->database,
					"primary"
				), $_table);
			} else if ($name == "join") {
				if (count($param_arr) < 2) {
					_error_handler(E_ERROR, get_called_class() . "->" . $name . " Need two arguments", __DIR__, __LINE__);
					exit ;
				}
				$param = array();
				$other_model = get_class($param_arr[0]);
				$param[0] = $other_model::$_table;
				$param[1] = str_replace("{this}", $model::$_table, $param_arr[1]);
				$param[1] = str_replace("{other}", $other_model::$_table, $param[1]);
				isset($param_arr[2]) ? $param[2] = $param_arr[2] : false;
				isset($param_arr[3]) ? $param[3] = $param_arr[3] : false;
				isset($param_arr[4]) ? $param[4] = $param_arr[4] : false;
				call_user_func_array(array(
					$this->database,
					"join"
				), $param);
				return $this;
			} else if ($name == "force_index") {
				$this->force_index = $param_arr[0];
				return $this;
			} else {
				if (method_exists($this->database, $name)) {
					call_user_func_array(array(
						$this->database,
						$name
					), $param_arr);
					return $this;
				}
			}
			return;
		} else {
			_error_handler(E_ERROR, get_called_class() . "->" . $name . " Method Not Exists", __DIR__, __LINE__);
			exit ;
		}
	}

	public function addRollback($func) {
		array_push($this->rollback, $func);
	}

	public function _force_index() {
		$result = "";
		$index = array();
		if (is_array($this->force_index) && !empty($this->force_index)) {
			foreach ($this->force_index as $v) {
				$index[] = "`{$v}`";
			}
			$index = implode(",", $index);
		} else if ($this->force_index) {
			$index = "`{$this->force_index}`";
		}
		if (!empty($index)) {
			$result = " FORCE INDEX(" . $index . ")";
		}
		$this->force_index = "";
		return $result;
	}

	public function loadModel($model) {
		$models = func_get_args();
		if (count($models) > 1) {
			foreach ($models as $k => $v) {
				$this->load->model($v . "_model");
			}
			return;
		}
		$this->load->model($model . "_model");
	}

	public function loadService($service) {
		$services = func_get_args();
		if (count($services) > 1) {
			foreach ($services as $k => $v) {
				$this->load->service($v . "_service");
			}
			return;
		}
		$this->load->service($service . "_service");
	}

}
