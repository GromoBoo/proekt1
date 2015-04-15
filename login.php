<?php require_once ('utils/utils.user.php') ?>
<?php require_once ('templates/top.php');
$name = new field_text('name','login',true,$_POST['name']);
$pass = new field_password('pass','Password',true,$_REQUEST['pass']);
$form = new form(array ('name'=>$name,'pass'=>$pass,),'Вход','field');
if ($_POST){
	$error = $form->check();
	if(!$error){
		enter($form->fields['name']->value, 
		      $form->fields['pass']->value);
?>
	<script>
	document.location.href = 'cabinet.php';
	</script>
	
	
	
<?php
	} 
}
$form->print_form();
	 require_once ('templates/bottom.php');?>