<?php session_start() ?>
<?php require_once('config/config.php')?>
<?php require_once('config/class.config.php')?>
<!Doctype html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Прект 1</title>
    <meta name="description">
    <meta name="keywords">
    <link type="text/css" rel="stylesheet" href="media/bootstrap/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="style.css">
	<script src='/media/js/jquery.min.js'></script>
	<script>
	$(function(){
		$('.topmenu a:eq(0)').bind('mouseover',function(){
						$('#header').css({'background':'url(media/img/fon1.jpg)'
										});
														});	
		$('.topmenu a:eq(1)').bind('mouseover',function(){
						$('#header').css({'background':'url(media/img/fon2.jpg)'
										});
														});
		$('.topmenu a:eq(2)').bind('mouseover',function(){
						$('#header').css({'background':'url(media/img/fon3.jpg)'
										});
														});
		$('.topmenu a:eq(3)').bind('mouseover',function(){
						$('#header').css({'background':'url(media/img/fon4.jpg)'
										});
														});
	$('.topmenu').bind('mouseout',function(){
						$('#header').css({'background':'url(media/img/fon.jpg)'
										});	
											});
											
		

		
	});
	</script>
  </head>
    <body>
     <div id="header">
       <div id="logo">
         <img src="media/img/logo.png" height="140px">
       </div>
       <div id="headlink">
        
		<?php 
		if($_SESSION ['id_usr_position']){
			?>
			<a href="logout.php">Выход</a>
			<a href="cabinet.php">Кабинет</a>
			<?php
		} else{
			?>
			Добро пожаловать!
		<a href="login.php">Войти</a> или
        <a href="reg.php">Зарегистрироваться</a>
		<?php
		} 
		?>
       </div>
      </div>
	  <div class="topmenu">
	  <?php 
		if($_SESSION ['id_usr_position']){
			?>
     
       <a href="index.php?url=index">Главная</a>
       <a href="index.php?url=comp">О компании</a>
       <a href="index.php?url=vacan">Вакансии </a>
       <a href="comments/comments.php">Оставить отзыв</a>
     
	<?php
		} else{
			
	?>		
       <a href="index.php?url=index">Главная</a>
       <a href="index.php?url=comp">О компании</a>
       <a href="index.php?url=vacan">Вакансии </a>
       <a href="index.php?url=contakt">Оставить отзыв</a>
		<?php
		}
		?>
     </div>
       <div>
        <div class="col-md-2">
        <div a class="menu">
<?php
$query = "SELECT * FROM $tbl_catalog
			WHERE showhide = 'show'";
			$cat = mysql_query($query);
			if (!$cat){
			exit($query);
			}
			while($category=mysql_fetch_array($cat))
		
				echo "<a href = 'category.php?id=".$category['id']."'class='btn btn-success'>".$category ['name']."</a>"
?>
      
           </div>
        </div>
		</div>
        <div class="col-md-8">
		<br>