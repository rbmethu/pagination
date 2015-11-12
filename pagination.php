<?php

class Pagination {
    
    var $itemsList;     //full items list
    var $count;         //total number of items in the item list
    var $pagesList;     //list of pages to display
    var $pageItemsList; //items for current page
    var $page;          //current page
    var $size;          //number of items for a page
    var $pages;         //total number of pages
    var $pagesNumber;    //maximum number of pages to show;
    var $skip= ' ... '; // value for page breakdown
    
    function __construct($itemsList, $page, $size, $pagesNumber) {
        $this->itemsList= $itemsList;
        $this->page= $page;
        $this->size= $size;
        $this->pagesNumber= $pagesNumber;
        
        $this->CalculatePages();
        $this->setPagesList();
    }
    function CalculatePages (){
        $this->count= count($this->itemsList);
        $pages= ceil($this->count/$this->size);
        $this->pages= $pages;
    }
    function setPagesList() {
        $list= array();
        if ($this->pages>$this->pagesNumber) {
            $list= $this->setList();
        } else {
            for ($i= 1; $i<=$this->pages; $i++) {
                $list[]= $i;
            }
        }
        $this->pagesList= $list;
    }
    function setList() {
        $list= array();
        $middle= ($this->pagesNumber-1)/2;
        $upper= ceil($middle);
        $lower= floor($middle);
        if ($this->page<=$upper) {
            for ($i=1; $i<=$this->pagesNumber-2; $i++){
                $list[]= $i;
            }
            $list[]= $this->skip;
            $list[]= $this->pages;
        } elseif (($this->page+$upper)>=$this->pages) {
            $list[]= 1;
            $list[]= $this->skip;
            for ($i=$this->pages-($this->pagesNumber-3); $i<=$this->pages; $i++){
                $list[]= $i;
            }
        } else {
            $list= $this->center($upper, $lower);
        }
        return $list;
    }
    function center($upper, $lower) {
        $list= array();
        $i= $this->page-($lower-2);
        $list[]= 1;
        if (($i-2)==1) {
            $list[]= 2;
        } else {
            $list[]= $this->skip;
        }
        for ($i; $i<=$this->page+($upper-2); $i++) {
            $list[]= $i;
        }
        if ($i+1==$this->pages) {
            $list[]= $this->page-1;
        } else {
            $list[]= $this->skip;
        }
        $list[]= $this->pages;
        return $list;
    }
    //return total number of pages 
    function getPages() {
        return $this->pages;
    }
    // return the pages list to be displayed
    function getPagesList() {
        return $this->pagesList;
    }
    // return list items for the gien page
    function getPageItemsList() {
        return $this->pageItemsList;
    }
}
