<?php

class SimpleCMSListView {

	public $title;
	public $section;
	public $items;
	public $data;
	public $showDelete;
	
	public function __construct($cms) {
		
		$this->title = $cms->title;
		$this->section = $cms->table;
		$this->id = $cms->id;
		
		$this->items = $cms->listViewItems;
		$this->data = $cms->getList();

		$this->showDelete = $cms->showDelete;
	}

}

?>