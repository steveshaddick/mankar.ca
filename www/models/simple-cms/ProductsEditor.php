<?php

class ProductsEditor extends SimpleCMSEditor {

	public function __construct() {
		parent::__construct();

		$this->title = 'Products';
		$this->id = 'product_id';
		$this->table = 'products';
		$this->listOrderBy = 'name';

		$this->editPage = 'products-edit.php';
		$this->listViewItems = array(
									array('Name', 'name', 500)
								);
	}

	public function getEdit($insert = false) {
		
		$product = array();

		if ($insert) {

			$product = $this->getFields('products');
			$product['photoStrip'] = array();
			$product['selectedParts'] = array();
			$product['otherParts'] = $product['otherParts'] = $this->mySQL->sendQuery("SELECT part_id, part_code,name FROM parts ORDER BY part_code");
			$product['metaTags'] = array();

		} else {
			
			$product = $this->mySQL->getSingleRow("SELECT * FROM products WHERE product_id = $this->actionData");
			$product['photoStrip'] = $this->mySQL->sendQuery("SELECT * FROM product_photos WHERE product_id=$this->actionData ORDER BY `order`");
			$product['selectedParts'] = $this->mySQL->sendQuery("SELECT part_id, part_code,name FROM parts WHERE part_id IN (SELECT part_id FROM parts_to_products WHERE product_id=$this->actionData) ORDER BY part_code");
			$product['otherParts'] = $this->mySQL->sendQuery("SELECT part_id, part_code,name FROM parts WHERE part_id NOT IN (SELECT part_id FROM parts_to_products WHERE product_id=$this->actionData) ORDER BY part_code");
			$product['metaTags'] = $this->mySQL->getSingleRow("SELECT meta_title, meta_description, meta_keywords, meta_title_fr, meta_description_fr, meta_keywords_fr, meta_title_sp, meta_description_sp, meta_keywords_sp FROM site_pages WHERE pretty_url = '{$product['pretty_url']}'");
		}
		
		return $product;
	}

	public function save($action) {

		$this->lastAction = $action;

		if ($action == 'insert') {
			$query = "INSERT INTO products SET ";
		} else {
			$query = "UPDATE products SET ";
		}

		$_SESSION['errorMessage'] = '';
		
		foreach ($_POST as $key=>$value)
		{
			if (!(substr($key,0,11) == "photoStrip_")) {
				switch ($key)
				{
					case 'product_id':
					case 'cancel':
					case 'active':
					case 'deletephoto':
					case 'MAX_FILE_SIZE':
					case 'photofile':
					case 'deletephoto':
					case 'savePhotoStrip';
					case 'uploadPhotoStrip';
					case 'manualfile':
					case 'deletemanual':
					case 'removepart':
					case 'addpart':
					case 'saveParts':
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
		}
		if (isset($_POST['deletephoto'])) {
			//unlink();
			$query .= "photo_page='',photo_list='',";
			//echo "deleting photo";
		} else if (isset($_FILES['photofile'])) {
			if ($_FILES['photofile']['name'] != "") {
				$filename = strtolower(ereg_replace("[^A-Za-z0-9.\\-]", "", basename( $_FILES['photofile']['name'])));
				$filename = substr($filename, 0 , strrpos($filename,"."));
				$filename .= ".jpg";
				
				$targetPath = UPLOAD_LOCATION.$filename;
				
				if(move_uploaded_file($_FILES['photofile']['tmp_name'], $targetPath)) {
					exec("convert $targetPath  -resize 150x150  -quality 80% ".dirname(__FILE__).'/../..'.PICTURES_LOCATION."list_$filename");
					exec("convert $targetPath  -resize 200x375  -quality 80% ".dirname(__FILE__).'/../..'.PICTURES_LOCATION."page_$filename");
			
					$query .= "photo_list='list_$filename',";
					$query .= "photo_page='page_$filename',";
					//echo "uploaded file";
					
				} else{
					$this->error = true;
					$this->errorMessage .= "There was an error uploading ".$_FILES['photofile']['name']."<br />";
				}
			}
		}
		if (isset($_POST['deletemanual'])) {
			//unlink();
			$query .= "manual='',";
			//echo "deleting photo";
		} else if (isset($_FILES['manualfile'])) {
			if ($_FILES['manualfile']['name'] != "") {
				$filename = ereg_replace("[^A-Za-z0-9.\\-]", "", basename( $_FILES['manualfile']['name']));
				
				$targetPath = MANUALS_UPLOAD_LOCATION.$filename;
				
				if(move_uploaded_file($_FILES['manualfile']['tmp_name'], $targetPath)) {
					$query .= "manual='$filename',";
					//echo "uploaded file";
				} else{
					$this->error = true;
					$this->errorMessage .= "There was an error uploading ".$_FILES['manualfile']['name']."<br />";
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
			$query .= " WHERE product_id=$this->actionData";
		}

		$result = $this->mySQL->sendQuery($query);

		if ($action == 'insert') {
			$this->actionData = $this->mySQL->getInsertID();
		}

		if ($result !== true) {
			$this->error = true;
		}

		
		if ($action == 'insert') {
			$query = "INSERT INTO site_pages SET ";
			
			$query .= "pagetype_id = 5,";
			$query .= "redirect_supertype = 1,";
			$query .= "content_file = 'products-product.php',";

		} else {
			$query = "UPDATE site_pages SET ";
		}
		$query .= "pretty_url='".trim($this->mySQL->cleanString($_POST['pretty_url']))."',";
		$query .= "location = 'products/".trim($this->mySQL->cleanString($_POST['type_id']))."/$this->actionData',";
		$query .= "supertype_id = '".trim($this->mySQL->cleanString($_POST['supertype_id']))."',";
		$query .= "meta_title='".trim($this->mySQL->cleanString($_POST['meta_title']))."',";
		$query .= "meta_description='".trim($this->mySQL->cleanString($_POST['meta_description']))."',";
		$query .= "meta_keywords='".trim($this->mySQL->cleanString($_POST['meta_keywords']))."',";
		$query .= "meta_title_fr='".trim($this->mySQL->cleanString($_POST['meta_title_fr']))."',";
		$query .= "meta_description_fr='".trim($this->mySQL->cleanString($_POST['meta_description_fr']))."',";
		$query .= "meta_keywords_fr='".trim($this->mySQL->cleanString($_POST['meta_keywords_fr']))."',";
		$query .= "meta_title_sp='".trim($this->mySQL->cleanString($_POST['meta_title_sp']))."',";
		$query .= "meta_description_sp='".trim($this->mySQL->cleanString($_POST['meta_description_sp']))."',";
		$query .= "meta_keywords_sp='".trim($this->mySQL->cleanString($_POST['meta_keywords_sp']))."'";

		if ($action != 'insert') {
			$query .= " WHERE location LIKE 'products/%/$this->actionData'";
		}

		$result = $this->mySQL->sendQuery($query);
		if ($result !== true) {
			$this->error = true;
		}

		//photostrip
		if (isset($_POST['savePhotoStrip']))
		{
			//save edited data
			$photoStrip = $this->mySQL->sendQuery("SELECT * FROM product_photos WHERE product_id=$this->actionData ORDER BY `order`");
			
			foreach ($photoStrip as $photo)
			{
				if (isset($_POST['photoStrip_deletephoto'][$photo['photo_id']])) {
					$this->mySQL->sendQuery("DELETE FROM product_photos WHERE photo_id=".$photo['photo_id']);
				} else {
					
					$query = "UPDATE product_photos SET ";
					$query .= "`order`=".$_POST['photoStrip_order'][$photo['photo_id']].",";
					$query .= "photo_description='".removeQuotes($_POST['photoStrip_photo_description'][$photo['photo_id']])."',";
					$query .= "photo_description_fr='".removeQuotes($_POST['photoStrip_photo_description_fr'][$photo['photo_id']])."',";
					$query .= "photo_description_sp='".removeQuotes($_POST['photoStrip_photo_description_sp'][$photo['photo_id']])."'";
					$query .= " WHERE photo_id=".$photo['photo_id'];
					
					$result = $this->mySQL->sendQuery($query);
					if ($result !== true) {
						$this->error = true;
						$this->errorMessage .= "--------------------------------ERROR SAVING PHOTO------------------------------------------<br />";
					}
				}
			}
		}
		if (isset($_POST['uploadPhotoStrip']))
		{
			foreach ($_FILES['photoStrip_files']['name'] as $key=>$file)
			{
				$filename = strtolower(ereg_replace("[^A-Za-z0-9.]", "", basename( $_FILES['photoStrip_files']['name'][$key])));
				$filename = substr($filename, 0 , strrpos($filename,"."));
				$filename .= ".jpg";
				
				$targetPath = UPLOAD_LOCATION.$filename;
				
				//make this only upload if the file doesn't exist
				//and delete old file, if not used anywhere else
				
				if(move_uploaded_file($_FILES['photoStrip_files']['tmp_name'][$key], $targetPath)) {
					exec("convert $targetPath  -resize 1000x1000  -quality 100% $targetPath");
					//echo $targetPath;
					$image = imagecreatefromjpeg($targetPath);
					$imageSize = getimagesize($targetPath);
					$ratio = $imageSize[0] / $imageSize[1];
					$newHeight = 100;
					$newWidth = 100 * $ratio;
					$thumb = imagecreatetruecolor($newWidth,$newHeight);
					imagecopyresampled($thumb, $image, 0, 0, 0, 0, $newWidth, $newHeight,  $imageSize[0],  $imageSize[1]);
					imagejpeg($thumb, dirname(__FILE__).'/../..'.THUMBS_LOCATION."$filename");
					imagedestroy($image);
					exec("convert $targetPath -resize 500x500 -quality 80% ".dirname(__FILE__).'/../..'.PICTURES_LOCATION."$filename");
			
					$query = "INSERT INTO product_photos (product_id, photo) VALUES ($this->actionData,'$filename')";
					
					$result = $this->mySQL->sendQuery($query);
					if ($result !== true) {
						$this->error = true;
						$this->errorMessage .= "--------------------------------ERROR ADDING PHOTO------------------------------------------<br />";
					}
					
				} else{
					echo "There was an error uploading ".$_FILES['photoStrip_files']['name'][$key]."<br />";
				}
			}
		}
		
		
		//parts
		if (isset($_POST['saveParts']))
		{

			if (isset($_POST['removepart'])){
				$query = "DELETE FROM parts_to_products WHERE product_id=$this->actionData AND part_id IN (".implode(',',$_POST['removepart']).")";
				$this->mySQL->sendQuery($query);
			}
			if (isset($_POST['addpart'])){

				foreach ($_POST['addpart'] as $part)
				{
					$query = "INSERT INTO parts_to_products SET product_id=$this->actionData,part_id=$part";
					$this->mySQL->sendQuery($query);
				}
			}
		}

		$_SESSION['errorMessage'] = $this->errorMessage;
		return $this->error;
	}

	public function delete() {

		$product = $this->mySQL->getSingleRow("SELECT type_id FROM products WHERE product_id = $this->actionData");
		$this->mySQL->sendQuery("DELETE FROM products WHERE product_id = $this->actionData");
		$this->mySQL->sendQuery("DELETE FROM site_pages WHERE location = 'products/{$product['type_id']}/$this->actionData'");
		$this->mySQL->sendQuery("DELETE FROM product_photos WHERE product_id = $this->actionData");
		$this->mySQL->sendQuery("DELETE FROM parts_to_products WHERE product_id = $this->actionData");
	}

}

?>