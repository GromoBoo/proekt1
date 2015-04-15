<?php require_once ('templates/top.php');
if($_GET['id']) {
	$file = $_GET['id'];
}
else  {
$file = 'index';
}
$query = "SELECT * FROM $lbl_maintexts WHERE url = '".$file."'";

$cat = mysql_query($query);
	if(!$cat)
	exit($query);
	if(mysql_num_rows($cat)){
	
$tbl_text = mysql_fetch_array($cat);	
	}
?>
<h2><?php echo $tbl_text['name'];?> </h2>							
	<?php echo $tbl_text['body'];?>	
	<?php require_once ('templates/bottom.php');?>
	