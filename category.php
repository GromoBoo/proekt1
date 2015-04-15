<?php require_once ('templates/top.php');
$query = "SELECT * FROM $tbl_catalog
				WHERE id = " .$_GET['id'];
	$cat = mysql_query($query);
	if(!$cat){
		exit($query);
	}
$category = mysql_fetch_array($cat);
	echo "<h2>".$category['name']."</h2>";

$query = "SELECT * FROM $tbl_tavar
				WHERE cat_id = " .$_GET['id'];
	$tov = mysql_query($query);
	if(!$tov){
		exit($tov);
	}
	while($tavar = mysql_fetch_array($tov)){
	if($tavar['picturesmall']){
	$picture = "<a href ='#' data = ".$tavar['id']." class ='pict'> <img src = 'media/images/".$tavar['picturesmall']."'> </a>";
}
	else{
		$picture ="-";
	}
	
	{
		echo "<div class = 'tov'>";
		echo $picture."</br>";
		echo $tavar['name']."<br>";
		echo $tavar['price'];
		echo "</div>";
	}


	}

 require_once ('templates/bottom.php');?>




