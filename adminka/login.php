<?php

session_start();

include ('../config/config.php');

if (isset($_GET['logout']))
{
	if (isset($_SESSION['user_id']))
		unset($_SESSION['user_id']);
		
	setcookie('login', '', 0, "/");
	setcookie('password', '', 0, "/");
	// и переносим его на главную
	header('Location: index.php');
	exit;
}

if (isset($_SESSION['user_id']))
{
	// юзер уже залогинен, перекидываем его отсюда на закрытую страницу
	
	header('Location: system_accounts/index.php');
	exit;

}



if (!empty($_POST))
{
	$login = (isset($_POST['login'])) ? mysql_real_escape_string($_POST['login']) : '';
	
    $password = md5($_POST['password']);

		$query = "SELECT `id_account`
					FROM `system_accounts`
					WHERE `name`='{$login}' AND `pass`='{$password}'
					LIMIT 1";
		$sql = mysql_query($query) or die(mysql_error());

		// если такой пользователь нашелся
		if (mysql_num_rows($sql) == 1)
		{
			// то мы ставим об этом метку в сессии (допустим мы будем ставить ID пользователя)

			$row = mysql_fetch_assoc($sql);
			$_SESSION['user_id'] = $row['id_account'];
			
			
			// если пользователь решил "запомнить себя"
			// то ставим ему в куку логин с хешем пароля
			
			$time = 86400; // ставим куку на 24 часа
			
			if (isset($_POST['remember']))
			{
				setcookie('login', $login, time()+$time, "/");
				setcookie('password', $password, time()+$time, "/");
			}
			
			// и перекидываем его на закрытую страницу
			header('Location: system_accounts/index.php');
			exit;

			// не забываем, что для работы с сессионными данными, у нас в каждом скрипте должно присутствовать session_start();
		}
		else
		{
			die('Такой логин с паролем не найдены в базе данных. — <a href="login.php">Вход</a>');
		}
	
}

print 
'<form action="#" method="post">
	<table width = "950" heidth = "600" border="1" align="middle">	
 
	   <tr><td align="center">
	   <table>
		<tr>
			<td>Логин:</td>
			<td><input type="text" name="login" /></td>
		</tr>
		<tr>
			<td>Пароль:</td>
			<td><input type="password" name="password" /></td>
		</tr>
		<tr>
			<td>Запомнить:</td>
			<td><input type="checkbox" name="remember" /></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="submit" value="Войти" /></td>
		</tr>		
	</table>
	</td></tr>
 
	</table>
</form>
';

?>