<!doctype html>
<html>

    <head>
        <meta charset="UTF-8">
        <title>Directory Contents</title>
        <style>
            * {
                padding:0;
                margin:0;
            }

            body {
                color: #333;
                font: 14px Sans-Serif;
                padding: 50px;
                background: #eee;
            }

            h1 {
                text-align: center;
                padding: 20px 0 12px 0;
                margin: 0;
            }
            h2 {
                font-size: 16px;
                text-align: center;
                padding: 0 0 12px 0; 
            }

            #container {
                box-shadow: 0 5px 10px -5px rgba(0,0,0,0.5);
                position: relative;
                background: white; 
                margin-left: auto;
                margin-right: auto;
                padding-left: 15px;
                padding-right: 15px;
                padding-bottom: 15px;
            }

            table {
                background-color: #F3F3F3;
                border-collapse: collapse;
                width: 100%;                            
            }
            .table-bordered > tbody > tr > td, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > td, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > thead > tr > th {
                border: 1px solid #ddd;
            }

            th {
                background-color: #FE4902;
                color: #FFF;                
                padding: 5px 10px;
            }

            th small {
                font-size: 9px; 
            }

            td, th {
                text-align: left;
            }

            a {
                text-decoration: none;
            }

            td a {
                color: #663300;
                display: block;
                padding: 5px 10px;
            }
            th a {
                padding-left: 0
            }            
            th:first-of-type {
                padding-left: 35px;
            }

            td:not(:first-of-type) a {
                background-image: none !important;
            } 

            tr:nth-of-type(odd) {
                background-color: #E6E6E6;
            }

            tr:hover td {
                background-color:#CACACA;
            }

            tr:hover td a {
                color: #000;
            }
            .col1{
                width: 8.33333%;
            }
            .col2{
                width: 16.6667%
            }
            .col4{
                width: 33.3333%;
            }
            .col6{
                width: 40%;
            }
            .text-center{
                text-align: center
            }
            .well{
                margin: 10px;
            }
            ul.pagination {
                display: inline-block;
                padding: 0;
                margin: 0;
            }

            ul.pagination li {display: inline;}

            ul.pagination li a {
                color: black;
                float: left;
                padding: 8px 16px;
                text-decoration: none;
                transition: background-color .3s;
                border: 1px solid #ddd;
            }

            .pagination li:first-child a {
                border-top-left-radius: 5px;
                border-bottom-left-radius: 5px;
            }

            .pagination li:last-child a {
                border-top-right-radius: 5px;
                border-bottom-right-radius: 5px;
            }

            ul.pagination li a.active {
                background-color: #4CAF50;
                color: white;
                border: 1px solid #4CAF50;
            }
            ul.pagination li a {
                margin: 0 4px; /* 0 is for top and bottom. Feel free to change it */
            }

            ul.pagination li a:hover:not(.active) {background-color: #ddd;}

        </style>
        <script type="text/javascript">

            function Pager(tableName, itemsPerPage) {

                this.tableName = tableName;

                this.itemsPerPage = itemsPerPage;

                this.currentPage = 1;

                this.pages = 0;

                this.inited = false;

                this.showRecords = function (from, to) {

                    var rows = document.getElementById(tableName).rows;

// i starts from 1 to skip table header row

                    for (var i = 1; i < rows.length; i++) {

                        if (i < from || i > to)
                            rows[i].style.display = 'none';

                        else
                            rows[i].style.display = '';

                    }

                }

                this.showPage = function (pageNumber) {

                    if (!this.inited) {

                        alert("not inited");

                        return;

                    }

                    var oldPageAnchor = document.getElementById('pg' + this.currentPage);

                    oldPageAnchor.className = '';

                    this.currentPage = pageNumber;

                    var newPageAnchor = document.getElementById('pg' + this.currentPage);

                    newPageAnchor.className = 'active';

                    var from = (pageNumber - 1) * itemsPerPage + 1;

                    var to = from + itemsPerPage - 1;

                    this.showRecords(from, to);

                }

                this.prev = function () {

                    if (this.currentPage > 1)
                        this.showPage(this.currentPage - 1);

                }

                this.next = function () {

                    if (this.currentPage < this.pages) {

                        this.showPage(this.currentPage + 1);

                    }

                }

                this.init = function () {

                    var rows = document.getElementById(tableName).rows;

                    var records = (rows.length - 1);

                    this.pages = Math.ceil(records / itemsPerPage);

                    this.inited = true;

                }

                this.showPageNav = function (pagerName, positionId) {

                    if (!this.inited) {

                        alert("not inited");

                        return;

                    }

                    var element = document.getElementById(positionId);

                    var pagerHtml = '<ul class="pagination">';
                    pagerHtml += '<li><a href="#" onclick="' + pagerName + '.prev();"> « </a></li>';

                    for (var page = 1; page <= this.pages; page++)
                        pagerHtml += '<li><a href="#" id="pg' + page + '" onclick="' + pagerName + '.showPage(' + page + ');">' + page + '</a></li>';

                    pagerHtml += '<li><a href="#" onclick="' + pagerName + '.next();">»</a></li>';
                    pagerHtml += '</ul>';
                    element.innerHTML = pagerHtml;

                }

            }

        </script>
    </head>

    <body>
        <div id="container">    
            <h1>Directory Contents</h1>
            <input type="search" class="light-table-filter" data-table="order-table" placeholder="Filter Directory Name">

            <table id="tablepaging" class="sortable table-bordered order-table table">
                <thead>
                    <tr>
                        <th class="col6">Directory Name</th>
                        <th class="col1 text-center">Type</th>
                        <th class="col2 text-center">Size <small>(bytes)</small></th>
                        <th class="col2 text-center">Date Created</th>
                        <th class="text-center">Date Modified</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include_once 'inc/class.index.php';
                    $Dir = new Dicrectory();
                    $directories = $Dir->finals();
                    $int = 1;
                    foreach ($directories as $key => $directory):
                        ?>
                        <tr>                            
                            <td><strong><?php echo '<a target="_blank" title="' . $directory['file'] . '" href="' . $directory['file'] . '">' . $int++ . '. ' . $directory['name'] . '</a>'; ?></strong></td>                                
                            <td class="text-center"><?php echo $directory['type']; ?></td>                                
                            <td class="text-center"><?php echo $directory['size']; ?></td>                                
                            <td class="text-center"><?php echo $directory['created']; ?></td>                                
                            <td class="text-center"><?php echo $directory['modified']; ?></td>                                
                        </tr>  
                        <?php
                    endforeach;
                    ?>
                </tbody> 
            </table>

            <div  class="pagination loop-pagination" id="pageNavPosition" style="padding-top: 20px" align="center">
            </div>
            <script type="text/javascript">
                var pager = new Pager('tablepaging', 15);
                pager.init();
                pager.showPageNav('pager', 'pageNavPosition');
                pager.showPage(1);
            </script>

            <div class="well">
                <?php echo "HostIP : " . $_SERVER['REMOTE_ADDR']; ?>
                <br/>
                <?php echo "HostName : " . gethostbyaddr($_SERVER['REMOTE_ADDR']); ?>

            </div>
        </div>

        <script>
            (function (document) {
                'use strict';

                var LightTableFilter = (function (Arr) {

                    var _input;

                    function _onInputEvent(e) {
                        _input = e.target;
                        var tables = document.getElementsByClassName(_input.getAttribute('data-table'));
                        Arr.forEach.call(tables, function (table) {
                            Arr.forEach.call(table.tBodies, function (tbody) {
                                Arr.forEach.call(tbody.rows, _filter);
                            });
                        });
                    }

                    function _filter(row) {
                        var text = row.textContent.toLowerCase(), val = _input.value.toLowerCase();
                        row.style.display = text.indexOf(val) === -1 ? 'none' : 'table-row';
                    }

                    return {
                        init: function () {
                            var inputs = document.getElementsByClassName('light-table-filter');
                            Arr.forEach.call(inputs, function (input) {
                                input.oninput = _onInputEvent;
                            });
                        }
                    };
                })(Array.prototype);

                document.addEventListener('readystatechange', function () {
                    if (document.readyState === 'complete') {
                        LightTableFilter.init();
                    }
                });

            })(document);
        </script>


    </body>    
</html>
