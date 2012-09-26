<?php

class SimpleCMSEditor {

	protected $pageSize = 50;

	public $page = '';
	public $action = '';
	public $actionData = '';
	public $lastListPage = 0;

	public $lastAction = '';
	public $error = false;
	public $errorMessage = '';

	public $currentDataPage = 1;
	public $totalDataPages = 1;

	public $title;
	public $id;
	public $table;
	public $listOrderBy;
	public $listViewItems;
	public $editPage;
	public $showDelete = true;

	protected $mySQL = null;

	public function __construct() {
		$this->mySQL = new MySQLUtility(DB_USERNAME, DB_PASSWORD, DB_HOST, DB_NAME);

		$get = explode('/', $_GET['page']);
		$this->page = isset($get[0]) ? $get[0] : '';
		$this->action = isset($get[1]) ? $get[1] : '';
		$this->actionData = isset($get[2]) ? $get[2] : '';

		if ($this->action == 'list') {
			$_SESSION['lastListPage'] = $this->actionData;
		} 

		if (!isset($_SESSION['saving'])) {
			$_SESSION['saving'] = false;
		}
		if (!isset($_SESSION['errorMessage'])) {
			$_SESSION['errorMessage'] = '';
		} else {
			$this->errorMessage = $_SESSION['errorMessage'];
		}
		
		$this->lastListPage = (isset($_SESSION['lastListPage'])) ? $_SESSION['lastListPage'] : 0;
	}

	public function getStates() {
		return $this->mySQL->sendQuery("SELECT state_id,state FROM state ORDER BY state");
	}

	public function getProductTypes() {

		return $this->mySQL->sendQuery("SELECT type_id,name FROM product_types ORDER BY name");

	}



	public function getList($listOnly = false) {

		$this->currentDataPage = $this->actionData;
		$this->totalDataPages = $this->getTotalPages($this->table);

		return $this->mySQL->sendQuery("SELECT * FROM $this->table ORDER BY $this->listOrderBy LIMIT ".($this->currentDataPage * $this->pageSize).", $this->pageSize");
	}

	public function getEdit($insert = false) {
		if ($insert) {
			return $this->getFields($this->table);
		} else {
			return $this->mySQL->getSingleRow("SELECT * FROM $this->table WHERE $this->id = $this->actionData");
		}
	}


	public function delete() {
		$this->mySQL->sendQuery("DELETE FROM $this->table WHERE $this->id = $this->actionData");

	}




	protected function getFields($table) {
		
		$result = $this->mySQL->sendQuery("SHOW COLUMNS from $table");
		if ($result === false) return false;
		
		$ret = array();
		foreach ($result as $column) {
			$ret[$column['Field']] = "";
		}

		return $ret;
	}


	protected function getTotalPages($table, $extra = '') {
		$result = $this->mySQL->getSingleRow("SELECT COUNT(*) as totalRows FROM $table $extra");

		return ceil($result['totalRows'] / $this->pageSize);
	}

}


?>