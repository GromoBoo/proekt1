<?php
// Error reporting:
error_reporting(E_ALL^E_NOTICE);

include "connect.php";
include "comment.class.php";
$comments = array();
$result = mysql_query("SELECT * FROM comments ORDER BY id ASC");

while($row = mysql_fetch_assoc($result))
{
	$comments[] = new Comment($row);
}

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Комментарии</title>

<link rel="stylesheet" type="text/css" href="styles.css" />

</head>

<body>
<h1>Комментарии</h1>
<h2><a href="../index.php">GO &raquo;</a></h2>

<div id="main">

<?php

/*
/	Output the comments one by one:
*/

foreach($comments as $c){
	echo $c->markup();
}

?>
<div id="addCommentContainer">
	<p>Добавить комментарий</p>
	<form id="addCommentForm" method="post" action="">
    	<div>
        	<label for="name">Ваше имя</label>
        	<input type="text" name="name" id="name" />
            
            <label for="email">Ваш Email</label>
            <input type="text" name="email" id="email" />
            
            <label for="body">Comment</label>
            <textarea name="body" id="body" cols="20" rows="5"></textarea>
            
            <input type="submit" id="submit" value="Отправить" />
        </div>
    </form>
</div>

</div>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>

</body>
</html>
