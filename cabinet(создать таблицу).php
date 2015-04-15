<?php
require_once ("templates/top.php");
require_once ("utils/utils.resizeimg.php");

$pol = new field_selekt("pol","Выбрать пол",array("М" => "Муж.", "Ж" => "Жен." ),$_REQUEST['pol']);
$familia = new field_text("familia", "Фамилия", true, $_REQUEST['familia']);
$imya = new field_text("imya", "Имя", true, $_REQUEST['imya']);
$otchestvo = new field_text("otchestvo", "Отчество", true, $_REQUEST['otchestvo']);
$familia2 = new field_text("familia2", "Фамилия при рождении", true, $_REQUEST['familia2']);
$mesto = new field_text("mesto", "Место жительства (город)", true, $_REQUEST['mesto']);
$date = new field_text("date", "Дата рождения", true, $_REQUEST['date']);
$zanyatie = new field_text("zanyatie", "Основное занятие", true, $_REQUEST['zanyatie']);
$email = new field_text("email", "E-mail", true, $_REQUEST['email']);
$name = new field_text("name", "Ник", true, $_REQUEST['name']);
$pass = new field_text("pass", "Пароль", true, $_REQUEST['pass']);
$passagain = new field_text("passagain", "Повтор", true, $_REQUEST['passagain']);
@mkdir("files/users/$_REQUEST[name]/",0777);
$urlpict =  new field_file("urlpict", "Фото", false, $_FILES,"files/users/$_REQUEST[name]/");
$form = new form(array("pol" => $pol, "email" => $email,"name" => $name,"pass" => $pass,"passagain" => $passagain,"familia" => $familia,
                       "imya" => $imya,"otchestvo" => $otchestvo,"familia2" => $familia2,"mesto" => $mesto,"zanyatie" => $zanyatie,
					   "date" => $date,"urlpict" => $urlpict),
					   "Создать", "main_text", "", "in_input");
if(!empty($_POST))
{
$error = $form->check();
if($form->fields['pass']->value !=$form->fields['passagain']->value)
{
	$error[] = "Пароли не равны";
}
$query = "SELECT COUNT(*) FROM $tbl_user WHERE name = '{$form->fields[name]->value}'";
$usr = mysql_query($query);
if(!$usr)
{
	throw new ExceptionMySQL(mysql_error(),$query,"Ошибка добавления нового пользователя");
}
if(mysql_result($usr, 0))
{
	$error[] = "Пользователь с таким именем уже существует";
}
$var = $form->fields['urlpict']->get_filename();
if(!empty($var))
{
	$picture = $_REQUEST[name]."/".date("y_m_d_h_i_").$var;
	$picturesmall= $_REQUEST[name]."/s_".date("y_m_d_h_i_").$var;
	resizeimg($picture,$picturesmall, 250, 200);
}
if(empty($error))
{
	$query = "INSERT INTO $tbl_user VALUES (
	NULL,
	'{$form->fields[name]->value}','{$form->fields[pass]->value}','{$form->fields[email]->value}','{$form->fields[pol]->value}',
	'{$form->fields[familia]->value}',
	'{$form->fields[imya]->value}','{$form->fields[otchestvo]->value}','{$form->fields[familia2]->value}','{$form->fields[mesto]->value}',
	'{$form->fields[date]->get_mysql_format()}','{$form->fields[zanyatie]->value}','$picture','$picturesmall','unblock',NOW(),NOW())";
	if(!mysql_query($query))
	{
		throw new ExceptionMySQL(mysql_error(),
		$query,"Ошибка добавления нового пользователя");
	}
		?>
		<script>
		document.location.href="index.php";
		</script>
		<?php
	}
}
if(empty($error))
{
	echo "<br>";
	foreach($error as $err)
	{
	echo "<span style=\"color:red\" class=main_txt>$err</span><br>";
	}
}
$form->print_form();
require_once ("templates/bottom.php");?>
