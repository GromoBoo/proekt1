<?php
$dblocatior='localhost';
$dbname='boom';
$dbuser='root';
$dbpasswordrd='';
$tbl_catalog='catalogs';
$tbl_tavar='tovars';
$tbl_accounts='system_accounts';
$lbl_maintexts='boom';
$tbl_user = 'users';


//таблицы
$dbcnx=mysql_connect($dblocatior,$dbuser,$dbpasswordrd);
if (!$dbcnx){
exit('no connect to server MySQL ');}
$dbuse=mysql_select_db($dbname,$dbcnx);
if(!$dbuse){
exit('no DB');}
@mysql_query("set names='utf8'");