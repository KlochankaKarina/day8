<?php
require "db.php";
?>
<?php if(isset($_SESSION['logged_user'])):?>Авторизованo<br>
Привіт, <?php echo $_SESSION['logged_user']->login;?>!<hr>
<?php else: ?>
<a href="login.php">Авторизуватися</a><br>
<a href="signup.php">Зареєструватися</a>
<?php endif; ?>