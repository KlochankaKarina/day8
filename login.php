<?php
require "db.php";
$data=$_POST;
if(isset($data['do_login'])){
	$errors=array();
	$user=R::findOne('users', 'login= ?', array($data['login']));
if($user){
if(password_verify($data['password'],$user->password)){

	$_SESSION['logged_user']=$user;
	echo '<div style="color:green;">Ви авторизовані. Можете перейти на <a href="/">головну</a>сторінку</div><hr>';
}else{
	$errors[]="Невірно введений пароль";
}
}else{
	$errors[]='Пользователь с таким логином не найден';

}
if( !empty($errors)){

echo '<div style="color:green;">Ви успішно авторизовані</div><hr>';
}else{
	echo '<div style="color:red;">'.array_shift($errors).'</div><hr>';
}
}
?>

<form action="./login.php" method="POST">
	<p>
		<input type="text" name="login" placeholder="Login" value="<?php echo @$data["login"]; ?>">
	</p>
	<p>
		<input type="password" name="password" placeholder="Password" value="<?php echo @$data["password"]; ?>">
	</p>
	<button type="submit" name="do_login">Увійти</button>
</form>