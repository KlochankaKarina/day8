<?php
require "db.php";
$data=$_POST;
if(isset($data['do_signup'])){
$errors=array();
if(trim($data['login'])==""){
	$errors[]="Введіть логін";
}
if(trim($data['email'])==""){
	$errors[]="Введіть Email";
}
if($data['password']==""){
	$errors[]="Введіть пароль";
}
if($data['password_2']!=$data["password"]){
	$errors[]="Повторний пароль введений невірно";
}
if( R::count('users',"login= ?",array($data['login']))>0){
	$errors[]="Пользователь с таким логином существует";
}
if( R::count('users',"email= ?",array($data ['email']))>0){
	$errors[]="Пользователь с таким email существует";
}
if(empty($errors)){
$user=R::dispense('users');
$user->login=$data['login'];
$user->email=$data['email'];
$user->password=password_hash($data['password'],PASSWORD_DEFAULT);
R::store($user);
echo '<div style="color:green;">Ви успішно зареєстровані</div><hr>';
}else{
	echo '<div style="color:red;">'.array_shift($errors).'</div><hr>';
}
}
?>

<form action="./signup.php" method="POST">
	<p>
		<input type="text" name="login" placeholder="Login" value="<?php echo @$data["login"]; ?>">
	</p>
	<p>
		<input type="email" name="email" placeholder="email@com" value="<?php echo @$data["email"]; ?>">
	</p>
	<p>
		<input type="password" name="password" placeholder="password" value="<?php echo @$data["password"]; ?>">
	</p>
	<p>
		<p><strong>Повторіть ваш пароль:</strong></p>
		<input type="password" name="password_2" placeholder="password_2" value="<?php echo @$data["password_2"]; ?>">
	</p>
	<button type="submit" name="do_signup">Зареєструватися</button>
</form>