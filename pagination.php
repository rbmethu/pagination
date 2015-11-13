<?php
/*
 * Copyright (C) <2015>

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
 
 * 
 */

/*
 * A simple php oop class to generate pagination 
 * list and page content of each page
 */

class Pagination {
    
    private $itemsList;     //full items list
    private $count;         //total number of items in the item list
    private $pagesList;     //list of pages to display
    private $pageItemsList; //items for current page
    private $page;          //current page
    private $size;          //number of items for a page
    private $pages;         //total number of pages
    private $pagesNumber;    //maximum number of pages to show;
    private $skip= ' ... '; // value for page breakdown
    
    /*
     * @param Array $itemList full array of items
     * @param int $page current page to output
     * @param int $size maxmum number of items per page
     * @param int $pagesNumber expected pagination size
     */
    public function __construct($itemsList, $page, $size, $pagesNumber) {
        $this->itemsList= $itemsList;
        $this->page= $page;
        $this->size= $size;
        $this->pagesNumber= $pagesNumber;
        
        $this->calculateCount();
    }
    //@todo calculate number of iems in main list
    private function calculateCount() {
        $this->count= count($this->itemsList);
        $this->CalculatePages();
    }
    //@todo calculate pages for he list
    private function CalculatePages (){
        $pages= ceil($this->count/$this->size);
        $this->pages= $pages;
    }
    //@todo pages generating
    private function setPagesList() {
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
    //@todo generate list for more pages than page number
    //@return pages list
    private function setList() {
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
    //@todo generate page list for center pages
    //@return pages list
    private function center($upper, $lower) {
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
    //@todo page list generation
    private function sliceList() {
        $start= ($this->page-1)*$this->size;
        $newList = array_splice($this->itemsList, $start, 20);
        $this->pageItemsList= $newList;
    }
    //@todo set skip text to custom
    public function setSkip($skip) {
        $this->skip= $skip;
    }
    //@todo set list size
    public function setCount($count) {
        $this->count= $count;
        $this->CalculatePages();
    }
    //@return total number of pages 
    public function getPages() {
        return $this->pages;
    }
    //@return the pages list to be displayed
    public function getPagesList() {
        $this->setPagesList();
        return $this->pagesList;
    }
    //@return list items for the gien page
    public function getPageItemsList() {
        $this->sliceList();
        return $this->pageItemsList;
    }
}
