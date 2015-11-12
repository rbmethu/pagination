<?php

class Pagination {
    
    var $count;		//total count of items
    var $page;		//current page
    var $size;		//number of items in each page
    var $pages;		//total number of pages
    var $list;		//list of pages to display
	var $number;	//number of pages to show
    var $skip= ' ... ';
    
    function __construct($count, $page, $size, $number) {
        $this->count= $count;
        $this->page= $page;
        $this->link= $link;
        $this->size= $size;
        $this->CalculatePages();
        $this->setPagesList();
        $this->showPagination();
    }
    function CalculatePages (){
        $pages= ceil($this->count/$this->size);
        $this->pages= $pages;
        return $pages;
    }
    public function getPages() {
        return $this->pages;
    }
	public function getList(){
		return $this->list;
	}
    function setPagesList() {
        $list= array();
        if ($this->pages>11) {
            $list= $this->setList();
        } else {
            for ($i= 1; $i<=$this->pages; $i++) {
                $list[]= $i;
            }
        }
        $this->list= $list;
        return $list;
    }
    function setList() {
        $list= array();
        if ($this->page<=5) {
            for ($i=1; $i<=8; $i++){
                $list[]= $i;
            }
            $list[]= $this->skip;
            $list[]= $this->pages;
        } elseif (($this->page+5)>=$this->pages) {
            $list[]= 1;
            $list[]= $this->skip;
            for ($i= ($this->pages-8); $i<=$this->pages; $i++){
                $list[]= $i;
            }
        } else {
            $list[]= 1;
            $list[]= $this->skip;
            for ($i=($this->page-3); $i<=($this->page+3); $i++){
                $list[]= $i;
            }
            $list[]= $this->skip;
            $list[]= $this->pages;
        }
        return $list;
	}
}
