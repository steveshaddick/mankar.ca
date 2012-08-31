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

	public function getSitePagesList() {
		$this->currentDataPage = $this->actionData;

		$result = $this->mySQL->getSingleRow("SELECT COUNT(DISTINCT pretty_url) as totalRows FROM site_pages WHERE redirect_supertype=0");
		$this->totalDataPages = ceil($result['totalRows'] / $this->pageSize);

		return $this->mySQL->sendQuery("SELECT site_page_id, pretty_url FROM site_pages WHERE redirect_supertype=0 GROUP BY pretty_url ORDER BY pretty_url LIMIT ".($this->currentDataPage * $this->pageSize).", $this->pageSize");
	}

	public function getTradeshowsList($listOnly = false) {

		$this->currentDataPage = $this->actionData;
		$this->totalDataPages = $this->getTotalPages('tradeshows');

		return $this->mySQL->sendQuery("SELECT * FROM tradeshows ORDER BY showstart DESC LIMIT ".($this->currentDataPage * $this->pageSize).", $this->pageSize");

	}

	public function getSitePage() {
		return $this->mySQL->sendQuery("SELECT * FROM site_pages WHERE pretty_url = '$this->actionData' AND redirect_supertype = 0 ORDER BY supertype_id");
	}

	public function saveSitePage() {


		$superTypes = array();
		foreach ($_POST as $key=>$value)
		{
			$superTypeId = substr($key, -1, 1);

			if (!isset($superTypes[$superTypeId])) {
				$superTypes[$superTypeId] = array();
			}

			$key = str_replace('__' . $superTypeId, '', $key);
			$superTypes[$superTypeId][$key] = $value;
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

	public function getProductTypesList($listOnly = false) {

		if ($listOnly) {

			return $this->mySQL->sendQuery("SELECT type_id,name FROM product_types ORDER BY name");

		} else {

			$this->currentDataPage = $this->actionData;
			$this->totalDataPages = $this->getTotalPages('product_types');

			return $this->mySQL->sendQuery("SELECT type_id,name FROM product_types ORDER BY name LIMIT ".($this->currentDataPage * $this->pageSize).", $this->pageSize");
		}

	}

	public function getProductType($insert = false) {
		
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

	public function saveProductType($action = 'update') {

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

	public function deleteProductType() {
		
		$this->mySQL->sendQuery("DELETE FROM product_types WHERE type_id = $this->actionData");
		$this->mySQL->sendQuery("DELETE FROM site_pages WHERE location = 'products/$this->actionData'");
	}

	public function getPartsList() {
		$this->currentDataPage = $this->actionData;
		$this->totalDataPages = $this->getTotalPages('parts');

		return $this->mySQL->sendQuery("SELECT part_id,name,part_code FROM parts ORDER BY part_code LIMIT ".($this->currentDataPage * $this->pageSize).", $this->pageSize");
	}

	public function getPart($insert = false) {
		if ($insert) {
			return $this->getFields('parts');
		} else {
			return $this->mySQL->getSingleRow("SELECT * FROM parts WHERE part_id = $this->actionData");
		}
	}

	public function savePart($action) {
		
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
					exec("convert $targetPath  -resize 150x150  -quality 80% ".PARTS_LOCATION."$filename");
			
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

	public function deletePart() {

		$this->mySQL->sendQuery("DELETE FROM parts WHERE part_id = $this->actionData");

	}

	public function getProductsList() {

		$this->currentDataPage = $this->actionData;
		$this->totalDataPages = $this->getTotalPages('products');

		return $this->mySQL->sendQuery("SELECT product_id,name FROM products ORDER BY name LIMIT ".($this->currentDataPage * $this->pageSize).", $this->pageSize");

	}

	public function getProduct($insert = false) {
		
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

	public function saveProduct($action) {

		$this->lastAction = $action;

		if ($action == 'insert') {
			$query = "INSERT INTO products SET ";
		} else {
			$query = "UPDATE products SET ";
		}
		
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
				
				//make this only upload if the file doesn't exist
				//and delete old file
				
				if(move_uploaded_file($_FILES['photofile']['tmp_name'], $targetPath)) {
					exec("convert $targetPath  -resize 150x150  -quality 80% ".PICTURES_LOCATION."list_$filename");
					exec("convert $targetPath  -resize 200x375  -quality 80% ".PICTURES_LOCATION."page_$filename");
			
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
				$filename = preg_replace("/[^A-Za-z0-9.\\-\\+]/", "", basename( $_FILES['manualfile']['name']));
				
				$targetPath = MANUALS_LOCATION.$filename;
				
				//make this only upload if the file doesn't exist
				//and delete old file
				if (!file_exists(MANUALS_LOCATION.$filename)){
					if(move_uploaded_file($_FILES['manualfile']['tmp_name'], $targetPath)) {
						$query .= "manual='$filename',";
						//echo "uploaded file";
					} else{
						$this->error = true;
						$this->errorMessage .= "There was an error uploading ".$_FILES['manualfile']['name']."<br />";
					}
				} else {
					$query .= "manual='$filename',";
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
					exec("convert $targetPath  -resize 1000x1000\>  -quality 100% $targetPath");
					//echo $targetPath;
					$image = imagecreatefromjpeg($targetPath);
					$imageSize = getimagesize($targetPath);
					$ratio = $imageSize[0] / $imageSize[1];
					$newHeight = 100;
					$newWidth = 100 * $ratio;
					$thumb = imagecreatetruecolor($newWidth,$newHeight);
					imagecopyresampled($thumb, $image, 0, 0, 0, 0, $newWidth, $newHeight,  $imageSize[0],  $imageSize[1]);
					imagejpeg($thumb, THUMBS_LOCATION."$filename");
					imagedestroy($image);
					exec("convert $targetPath  -resize 500x500\>  -quality 80% ".PICTURES_LOCATION."$filename");
			
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

	public function deleteProduct() {

		$product = $this->mySQL->getSingleRow("SELECT type_id FROM products WHERE product_id = $this->actionData");
		$this->mySQL->sendQuery("DELETE FROM products WHERE product_id = $this->actionData");
		$this->mySQL->sendQuery("DELETE FROM site_pages WHERE location = 'products/{$product['type_id']}/$this->actionData'");
		$this->mySQL->sendQuery("DELETE FROM product_photos WHERE product_id = $this->actionData");
		$this->mySQL->sendQuery("DELETE FROM parts_to_products WHERE product_id = $this->actionData");
	}
	

	public function getDealersList() {

		$this->currentDataPage = $this->actionData;
		$this->totalDataPages = $this->getTotalPages('dealers');

		return $this->mySQL->sendQuery("SELECT dealer_id,name FROM dealers ORDER BY name LIMIT ".($this->currentDataPage * $this->pageSize).", $this->pageSize");

	}

	public function getDealer($insert = false) {
		if ($insert) {
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

	private function getTotalPages($table, $extra = '') {
		$result = $this->mySQL->getSingleRow("SELECT COUNT(*) as totalRows FROM $table $extra");

		return ceil($result['totalRows'] / $this->pageSize);
	}

}


?>