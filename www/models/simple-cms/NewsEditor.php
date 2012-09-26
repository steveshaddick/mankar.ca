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

}

?>