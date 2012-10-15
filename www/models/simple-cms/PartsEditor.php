<?php

class PartsEditor extends SimpleCMSEditor {

	public function __construct() {
		parent::__construct();

		$this->title = 'Parts';
		$this->id = 'part_id';
		$this->table = 'parts';
		$this->listOrderBy = 'part_code';

		$this->editPage = 'parts-edit.php';
		$this->listViewItems = array(
									array('Name', 'name', 300),
									array('Code', 'part_code', 150)
								);
	}


	public function save($action) {
		
		if ($action == 'insert') {
			$query = "INSERT INTO parts SET ";
		} else {
			$query = "UPDATE parts SET ";
		}
		
		foreach ($_POST as $key=>$value)
		{
			switch ($key)
			{
				case 'part_id':
				case 'cancel':
				case 'active':
				case 'MAX_FILE_SIZE':
				case 'photofile':
				case 'deletephoto':
				break;
				
				default:
				$query .= "$key='".trim($this->mySQL->cleanString($value))."',";
				break;
			}
		}
		if (isset($_POST['deletephoto'])) {
			//unlink();
			$query .= "photo='',";
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
					exec("convert $targetPath  -resize 150x150  -quality 80% ".dirname(__FILE__).'/../..'.PARTS_LOCATION."$filename");
			
					$query .= "photo='$filename',";
					//echo "uploaded file";
					
				} else{
					$this->error = true;
					$this->errorMessage .= "There was an error uploading ".$_FILES['photofile']['name']."<br />";
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
			$query .= " WHERE part_id=$this->actionData";
		}

		$result = $this->mySQL->sendQuery($query);
		if ($result !== true) {
			$this->error = true;
		}
		if ($action == 'insert') {
			$this->actionData = $this->mySQL->getInsertID();
		}


		$_SESSION['errorMessage'] = $this->errorMessage;
		return $this->error;
	}

}

?>