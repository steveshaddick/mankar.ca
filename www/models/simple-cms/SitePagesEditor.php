<?php

class SitePagesEditor extends SimpleCMSEditor {

	public function __construct() {
		parent::__construct();
		
		$this->title = 'Site Pages';
		$this->id = 'pretty_url';
		$this->table = 'site_pages';
		//$this->listOrderBy = 'name';

		$this->showDelete = false;
		$this->editPage = 'site-pages-edit.php';
		$this->listViewItems = array(
									array('Pretty Url', 'pretty_url', 500)
								);
	}

	public function getList() {
		$this->currentDataPage = $this->actionData;

		$result = $this->mySQL->getSingleRow("SELECT COUNT(DISTINCT pretty_url) as totalRows FROM site_pages WHERE redirect_supertype=0");
		$this->totalDataPages = ceil($result['totalRows'] / $this->pageSize);

		return $this->mySQL->sendQuery("SELECT site_page_id, pretty_url FROM site_pages WHERE redirect_supertype=0 GROUP BY pretty_url ORDER BY pretty_url LIMIT ".($this->currentDataPage * $this->pageSize).", $this->pageSize");
	}

	public function getEdit() {
		return $this->mySQL->sendQuery("SELECT * FROM site_pages WHERE pretty_url = '$this->actionData' AND redirect_supertype = 0 ORDER BY supertype_id");
	}

	public function save() {


		$superTypes = array();

		//default to disable, if active is checked it'll override this
		$superTypes[1] = array('has_nav'=>0);
		$superTypes[2] = array('has_nav'=>0);
		$superTypes[3] = array('has_nav'=>0);
		$superTypes[4] = array('has_nav'=>0);

		foreach ($_POST as $key=>$value)
		{
			$superTypeId = substr($key, -1, 1);

			if (!isset($superTypes[$superTypeId])) {
				$superTypes[$superTypeId] = array();
			}

			$key = str_replace('__' . $superTypeId, '', $key);
			$superTypes[$superTypeId][$key] = $value;
			
			if ($key == 'has_nav') {
				$superTypes[$superTypeId][$key] = 1;
			} else {
				$superTypes[$superTypeId][$key] = $value;
			}
		}

		foreach ($superTypes as $superTypeId=>$superType) 
		{
			$query = "UPDATE site_pages SET ";

			foreach ($superType as $key=>$value)
			{
				$query .= "$key='".trim($this->mySQL->cleanString($value))."',";
			}
			$query = substr($query, 0, strlen($query)-1);

			$query .= " WHERE pretty_url = '$this->actionData' AND supertype_id = $superTypeId";

			$result = $this->mySQL->sendQuery($query);

			if ($result !== true) {
				$this->error = true;
			}

		}
		return $this->error;

	}

	public function delete() {
		echo "CANNOT DELETE";
	}

}

?>