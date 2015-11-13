<?php
/*
 *  This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */


//load pagination file to project
include '../Pagination.php';

//sample arrray of 64 items
$itemsList= array('as', 'bs', 'cs','ds', 'es', 'fs','gs', 'hs', 'is','js', 'ks', 'ls','ms', 'ns', 'os', 'ps',
    'aq', 'bq', 'cq','dq', 'eq', 'fq','gq', 'hq', 'iq','jq', 'kq', 'lq','mq', 'nq', 'oq', 'pq',
    'aw', 'bw', 'cw','dw', 'ew', 'fw','gw', 'hw', 'iw','jw', 'kw', 'lw','mw', 'nw', 'ow', 'pw', 
    'az', 'bz', 'cz','dz', 'ez', 'fz','gz', 'hz', 'iz','jz', 'kz', 'lz','mz', 'nz', 'oz', 'pz');

$page= filter_input(INPUT_GET, 'page'); //curent page. may be generated from form data.
$size= '5'; //number of items per page.
$pagesNumber= '10'; //total pages to show.

//instanciate pagination class
$pagination= new Pagination($itemsList, $page, $size, $pagesNumber);

//set custom skip text
$pagination->setSkip('<>');

//get pages count
$pages= $pagination->getPages();

//get pages list
$pagesList= $pagination->getPagesList();

//get items for the page
$items= $pagination->getPageItemsList();

//get next and previous pages
$next= $pagination->getNext();
$previous= $pagination->getPrevious();


?>
<html>
    <head>
        <title>Pagination example</title>
    </head>
    <body>
        <div>
            <!--print total page count -->
            The total page count is: <?php print $pages; ?>
        </div>
        <div>
            <ol>
                <?php
                //prin our sample list items
                foreach ($items as $value) {
                    print "<li>This is a list item value: ".$value."</li>";
                }
                ?>
            </ol>
        </div>
        <nav>
            <div>
                <?php
                //print previous icon
                print '<a href="?page='.$previous.'">&laquo;</a>'."\n";
                //loop around the pages list
                foreach($pagesList as $page){
                    print '<a href="?page='.$page.'">'.$page.'</a>'."\n";
                }
                //print next icon
                print '<a href="?page='.$next.'">&raquo;</a>'."\n";
                ?>
            </div>
        </nav>
    </body>
</html>
