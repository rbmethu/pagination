# pagination
Php code to generate pagination and pagination page items list

##How to use
Include the file pagination.php to your project.
```php
include 'path_to_source/Pagination.php';
```

Instanciate class pagination;
```php
$pagination= new Pagination($itemsList, $page, $size, $pagesNumber);
```

Param `$itemList` is the full list you want to genetate pages from.
 Pass an array here. if you set it to **null**, set list size by `setCount()` method.
 
 ```php
 $pagination->setCount($count); //$count int parameter is number of items in the full list.
 ```
 
 Param `$page` int is the current page to output.
 
 
 Param `$size` int number of list items per page.
 
 
 Param `$pagesNumber` int total items to put in output pagination list.

Public methods
------------------

 `setSkip($skip)` this method sets a custom text to show when preaking page count continuation. 
 `$skip` string value to replace the default **' ... '**
 ```php
 $pagination->setSkip('skiped'); //not a must a default exists
 ```
 
 `setCount($count)` set total number of items in the list if a list was not provided.
 `$count` int the number of items.
 ```php
 $pagination->setCount(56); //not a must if you provided a list
 ```
 
 `getPages()` return the total number of pages the list will have.
 ```php
 $pages= $pagination->getPages(); 
 ```
 
 `getPagesList()` return an array of integer page numbers to be displayed in pagination area 
 including text to show area has skiped pages.
 ```php
 $list= $pagination->getPagesList(); 
 ```
 
 `getPageItemsList()` return an array of your items list sliced for the current page.
 ```php
 $itemsList= $pagination->getPageItemsList(); //null if no list was provided
 ```
 
 `getNext()` return integer value of next page. return same value as current if current page is the last
 ```php
 $next= $pagination->getNext();
 ```
 
 `getPrevious()` return integer previous page. return same value as current page if curent page is first
 ```php
 $previous= $pagination->getPrevious();
 ```
 
