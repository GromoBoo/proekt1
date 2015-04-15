<?php
 function enter($name,$pass){
	 global $tbl_user;
	 $query = "SELECT * FROM $tbl_user WHERE name = '$name' and password = '$pass' AND blockunblock = 'unblock' LIMIT 1" ;
	 $usr = mysql_query($query);
	 if(!$usr){
		 exit($query);
	 }
	 if(mysql_num_rows($usr)){
		 
		 $log = mysql_fetch_array($usr);
		 $_SESSION['id_usr_position'] = $log['id'];
	$query = "update $tbl_user SET lastvisit = NOW() WHERE id = ".$log['id'];
	$cat = mysql_query($query);
	if(!$cat){
		exit($query);
	}
		 
		 
		 
		 
		 return true;
	 } else{
		 return false;
	 }
 }
 ?>