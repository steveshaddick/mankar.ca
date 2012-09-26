<?php

class TradeshowsEditor extends SimpleCMSEditor {

	public function __construct() {
		parent::__construct();

		$this->title = 'Tradeshows';
		$this->id = 'show_id';
		$this->table = 'tradeshows';
		$this->listOrderBy = 'showstart DESC';

		$this->editPage = 'tradeshows-edit.php';
		$this->listViewItems = array(
									array('Name', 'showname', 500)
								);
	}

	public function save($action) {
		
		$this->lastAction = $action;

		if ($action == 'insert') {
			$query = "INSERT INTO tradeshows SET ";
		} else {
			$query = "UPDATE tradeshows SET ";
		}
		
		foreach ($_POST as $key=>$value)
		{
			switch ($key)
			{
				case 'show_id':
				case 'MAX_FILE_SIZE':
				case 'photofile':
				case 'deletephoto':
					break;

				case 'supertype_id':
					$query .= "$key='" . str_replace(' ', '', $value) . "',";
					break;
				
				case 'website':
					$value = trim($value);
					if ($value != '') {
						if (substr($value,0,7) != "http://") {
							$value = "http://".$value;
						}
						$query .= "$key='".$value."',";
					}
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
					exec("convert $targetPath  -resize 100x100  -quality 80% ".dirname(__FILE__).'/..'.TRADESHOW_LOGO_LOCATION."$filename");
			
					$query .= "logo='$filename',";
					//echo "uploaded file";
					
				} else{
					echo "There was an error uploading ".$_FILES['photofile']['name']."<br />";
				}
			}
		}

		
		$query = substr($query, 0, strlen($query)-1);

		if ($action != 'insert') {
			$query .= " WHERE show_id=$this->actionData";
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