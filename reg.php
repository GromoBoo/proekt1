<?php require_once ('templates/top.php');
$name = new field_text('name','login',true,$_POST['name']);
$email = new field_text_email('email','E-mail',true,$_POST['email']);
$pass = new field_password('pass','Password',true,$_REQUEST['pass']);
$pass2 = new field_password('pass2','Повтор Password',true,$_REQUEST['pass2']);
$form = new form(array ('name'=>$name,'email'=>$email,'pass'=>$pass,'pass2'=>$pass2),'Регистрация','field');
if ($_POST){
	$error = $form->check();
if( $form->fields['pass']->value!=$form->fields['pass2']->value){
	$error[] = 'пароли не совпадают';
}
$query = "SELECT COUNT(*) FROM $tbl_user WHERE name = '{$form->fields['name']->value}'";
$cat = mysql_query($query);
if(!$cat){
	exit($query);
}
if(mysql_result($cat,0)){
	$error[] = "Пльзователь с таким именем уже существует";
}
$query = "SELECT COUNT(*) FROM $tbl_user WHERE email = '{$form->fields['email']->value}'";
$cat = mysql_query($query);
if(!$cat){
	exit($query);
}
if(mysql_result($cat,0)){
	$error[] = "E-mail занят";
}
if(!$error){
	$query = "INSERT INTO $tbl_user VALUES(NULL,
	'{$form->fields['name']->value}',
	'{$form->fields['email']->value}',
	'{$form->fields['pass']->value}',
	'unblock',
	NOW(),
	NOW())";
$cat = mysql_query($query);
if(!$cat){
exit($query);
}	
?>
<script>
document.location.href="login.php";
</script>
<?php
}

	if ($error){
		foreach($error as $err){
			echo "<span style='color:red'>";
			echo $err;
			echo "</span><br>";
		}
	}
}
$form->print_form();
	 require_once ('templates/bottom.php');?>