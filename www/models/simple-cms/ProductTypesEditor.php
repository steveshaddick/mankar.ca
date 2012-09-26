<?php

class ProductTypesEditor extends SimpleCMSEditor {

	public function __construct() {
		parent::__construct();

		$this->title = 'Product Types';
		$this->id = 'type_id';
		$this->table = 'product_types';
		$this->listOrderBy = 'name';

		$this->editPage = 'product-types-edit.php';
		$this->listViewItems = array(
									array('Name', 'name', 500)
								);
	}

	public function getEdit($insert = false) {
		
		$productType = array();

		if ($insert) {
			$productType = $this->getFields('product_types');
			$productType['metaTags'] = array();
		} else {
			$productType = $this->mySQL->getSingleRow("SELECT * FROM product_types WHERE type_id = $this->actionData");
			$productType['metaTags'] = $this->mySQL->getSingleRow("SELECT meta_title, meta_description, meta_keywords, meta_title_fr, meta_description_fr, meta_keywords_fr, meta_title_sp, meta_description_sp, meta_keywords_sp FROM site_pages WHERE pretty_url='{$productType['pretty_url']}'");
		}

		return $productType;
	}

	public function save($action = 'update') {

		if ($action == 'insert') {
			$query = "INSERT INTO product_types SET ";
		} else {
			$query = "UPDATE product_types SET ";
		}
		
		foreach ($_POST as $key=>$value)
		{
			switch ($key)
			{
				case 'product_type_id':
				case 'cancel':
				case 'active':
				case 'deletephoto':
				case 'MAX_FILE_SIZE':
				case 'photofile':
				case 'deletephoto':
				case 'meta_title':
				case 'meta_description':
				case 'meta_keywords':
				case 'meta_title_fr':
				case 'meta_description_fr':
				case 'meta_keywords_fr':
				case 'meta_title_sp':
				case 'meta_description_sp':
				case 'meta_keywords_sp':
					break;
				
				default:
					$query .= "$key='".trim($this->mySQL->cleanString($value))."',";
					break;
			}
		}
		if (isset($_POST['deletephoto'])) {
			//unlink();
			$query .= "thumbnail='',";
			//echo "deleting photo";
		} else if (isset($_FILES['photofile'])) {
			if ($_FILES['photofile']['name'] != "") {
				$extension = substr(strrchr(basename($_FILES['photofile']['name']), '.'), 1 );

				$filename = strtolower(ereg_replace("[^A-Za-z0-9.\\-]", "", basename( $_FILES['photofile']['name'])));
				$filename = substr($filename, 0 , strrpos($filename,"."));
				$filename .= '.png';

				$targetPath = UPLOAD_LOCATION.$filename;
				
				//make this only upload if the file doesn't exist
				//and delete old file
				
				if(move_uploaded_file($_FILES['photofile']['tmp_name'], $targetPath)) {
					
					exec("convert $targetPath -resize 150x150 -fuzz 3% -transparent white -quality 90% ".dirname(__FILE__).'/..'.THUMBS_LOCATION."$filename");
	
					$query .= "thumbnail='$filename',";
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
			$query .= " WHERE type_id=$this->actionData";
		}

		$result = $this->mySQL->sendQuery($query);
		if ($result !== true) {
			$this->error = true;
		}
		if ($action == 'insert') {
			$this->actionData = $this->mySQL->getInsertID();
		}
		
		if ($action == 'insert') {
			$query = "INSERT INTO site_pages SET ";
			
			$query .= "pagetype_id = 4,";
			$query .= "redirect_supertype = 1,";
			$query .= "content_file = 'products-type.php',";
			$query .= "location = 'products/$this->actionData',";
		} else {
			$query = "UPDATE site_pages SET ";
		}	
		$query .= "pretty_url='".$_POST['pretty_url']."',";
		$query .= "supertype_id='".$_POST['supertype_id']."',";
		$query .= "meta_title='".$_POST['meta_title']."',";
		$query .= "meta_description='".$_POST['meta_description']."',";
		$query .= "meta_keywords='".$_POST['meta_keywords']."',";
		$query .= "meta_title_fr='".$_POST['meta_title_fr']."',";
		$query .= "meta_description_fr='".$_POST['meta_description_fr']."',";
		$query .= "meta_keywords_fr='".$_POST['meta_keywords_fr']."',";
		$query .= "meta_title_sp='".$_POST['meta_title_sp']."',";
		$query .= "meta_description_sp='".$_POST['meta_description_sp']."',";
		$query .= "meta_keywords_sp='".$_POST['meta_keywords_sp']."'";
		
		if ($action != 'insert') {
			$query .= " WHERE location = 'products/$this->actionData'";
		}
		$result = $this->mySQL->sendQuery($query);
		if ($result !== true) {
			$this->error = true;
		}

		return $this->error;
	}

	public function delete() {
		
		$this->mySQL->sendQuery("DELETE FROM product_types WHERE type_id = $this->actionData");
		$this->mySQL->sendQuery("DELETE FROM site_pages WHERE location = 'products/$this->actionData'");
	}

}

?>