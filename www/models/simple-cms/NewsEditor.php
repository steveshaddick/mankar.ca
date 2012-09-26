<?php

class NewsEditor extends SimpleCMSEditor {

	public function __construct() {
		parent::__construct();
		
		$this->title = 'News';
		$this->id = 'news_id';
		$this->table = 'news';
		$this->listOrderBy = 'newsDate DESC';

		$this->editPage = 'news-edit.php';
		$this->listViewItems = array(
									array('Title', 'title', 500)
								);
	}

	public function save($action) {
		
		$this->lastAction = $action;

		if ($action == 'insert') {
			$query = "INSERT INTO $this->table SET ";
		} else {
			$query = "UPDATE $this->table SET ";
		}
		
		foreach ($_POST as $key=>$value)
		{
			switch ($key)
			{
				case 'news_id':
				case 'active':
					break;

				case 'supertype_id':
					$query .= "$key='" . str_replace(' ', '', $value) . "',";
					break;
				
				default:
					$query .= "$key='".trim($value)."',";
					break;
			}
		}

		if (!isset($_POST['active'])) {
			$query .= "active=0,";
		} else {
			$query .= "active=1,";
		}
		$query = substr($query, 0, strlen($query)-1);
		
		if ($action != 'insert') {
			$query .= " WHERE $this->id = $this->actionData";
		}

		$result = $this->mySQL->sendQuery($query);

		if ($action == 'insert') {
			$this->actionData = $this->mySQL->getInsertID();
		}

		if ($result !== true) {
			$this->error = true;
		}

		return $this->error;
	}

}

?>