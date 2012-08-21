<?php


class SimpleCMS {
	
	public $contentFile = '';
	public $page = '';
	public $action = '';
	public $actionData = '';
	public $lastListPage = 0;

	public $lastAction = '';
	public $error = false;

	public $totalDataPages = 0;
	public $currentDataPage = 0;	

	private $mySQL = null;
	private $pageSize = 25;

	public function __construct() {
		$this->mySQL = new MySQLUtility(DB_USERNAME, DB_PASSWORD, DB_HOST, DB_NAME);

		$get = explode('/', $_GET['page']);
		$this->page = isset($get[0]) ? $get[0] : '';
		$this->action = isset($get[1]) ? $get[1] : '';
		$this->actionData = isset($get[2]) ? $get[2] : '';

		if ($this->action == 'list') {
			$_SESSION['lastListPage'] = $this->actionData;
		} 
		
		$this->lastListPage = (isset($_SESSION['lastListPage'])) ? $_SESSION['lastListPage'] : 0;
	}

	public function getStates() {
		return $this->mySQL->sendQuery("SELECT state_id,state FROM state ORDER BY state");
	}

	

	public function getDealersTable() {

		$this->currentDataPage = $this->actionData;
		$this->totalDataPages = $this->getTotalPages('dealers');

		return $this->mySQL->sendQuery("SELECT dealer_id,name FROM dealers ORDER BY name LIMIT ".($this->currentDataPage * $this->pageSize).",25");

	}

	public function getDealer($fieldsOnly = false) {
		if ($fieldsOnly) {
			return $this->getFields('dealers');
		} else {
			return $this->mySQL->getSingleRow("SELECT * FROM dealers WHERE dealer_id = $this->actionData");
		}
	}

	public function saveDealer($action) {
		
		$this->lastAction = $action;

		if ($action == 'insert') {
			$query = "INSERT INTO dealers SET ";
		} else {
			$query = "UPDATE dealers SET ";
		}
		
		foreach ($_POST as $key=>$value)
		{
			switch ($key)
			{
				case 'dealer_id':
				case 'cancel':
				case 'active':
				case 'MAX_FILE_SIZE':
				case 'photofile':
				case 'deletephoto':
					break;

				case 'supertype_id':
					$query .= "$key='" . str_replace(' ', '', $value) . "',";
					break;
				
				case 'website':
					$value = trim($value);
					if (substr($value,0,7) != "http://") {
						$value = "http://".$value;
					}
					$query .= "$key='".$value."',";
				break;
				
				default:
					$query .= "$key='".trim($value)."',";
					break;
			}
		}
		if (isset($_POST['deletephoto'])) {
			//unlink();
			$query .= "logo='',";
			//echo "deleting photo";
		} else if (isset($_FILES['photofile'])) {
			if ($_FILES['photofile']['name'] != "") {
				$filename = strtolower(ereg_replace("[^A-Za-z0-9.]", "", basename( $_FILES['photofile']['name'])));
				$filename = substr($filename, 0 , strrpos($filename,"."));
				$filename .= ".jpg";
				
				$targetPath = UPLOAD_LOCATION.$filename;
				
				//make this only upload if the file doesn't exist
				//and delete old file
				
				if(move_uploaded_file($_FILES['photofile']['tmp_name'], $targetPath)) {
					exec("convert $targetPath  -resize 75x75  -quality 80% ".DEALER_LOGO_LOCATION."$filename");
			
					$query .= "logo='$filename',";
					//echo "uploaded file";
					
				} else{
					echo "There was an error uploading ".$_FILES['photofile']['name']."<br />";
				}
			}
		}

		if (!isset($_POST['active'])) {
			$query .= "active=0,";
		} else {
			$query .= "active=1,";
		}
		$query = substr($query, 0, strlen($query)-1);
		
		if ($action != 'insert') {
			$query .= " WHERE dealer_id=$this->actionData";
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

	public function deleteDealer() {
		$this->mySQL->sendQuery("DELETE FROM dealers WHERE dealer_id = $this->actionData");
		
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

	private function getTotalPages($table) {
		$result = $this->mySQL->getSingleRow("SELECT COUNT(*) as totalRows FROM $table");

		return ceil($result['totalRows'] / $this->pageSize);
	}

}


?>