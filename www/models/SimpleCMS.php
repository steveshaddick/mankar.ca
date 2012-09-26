<?php


class SimpleCMS {
	
	public $contentFile = '';
	public $page = '';
	public $action = '';
	public $actionData = '';
	public $lastListPage = 0;

	public $lastAction = '';
	public $error = false;
	public $errorMessage = '';

	public $totalDataPages = 0;
	public $currentDataPage = 0;	

	private $mySQL = null;
	private $pageSize = 50;

	public function __construct() {

	}




	private function getFields($table) {
		
		$result = $this->mySQL->sendQuery("SHOW COLUMNS from $table");
		if ($result === false) return false;
		
		$ret = array();
		foreach ($result as $column) {
			$ret[$column['Field']] = "";
		}

		return $ret;
	}

	private function getTotalPages($table, $extra = '') {
		$result = $this->mySQL->getSingleRow("SELECT COUNT(*) as totalRows FROM $table $extra");

		return ceil($result['totalRows'] / $this->pageSize);
	}

}


?>