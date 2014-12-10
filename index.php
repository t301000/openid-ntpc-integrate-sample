<?php
session_start();
require_once 'conn.php';

if( isset($_SESSION['id']) ){

	echo "id：".$_SESSION['id']."<br />";
	echo "姓名：".$_SESSION['cname']."<br />";
	echo "<a href='logout.php'>登出</a>";

	exit();

}

?>

<!-- local登入 -->
<form action="login.php" method="post">
	<input type="text" name="uname" required placeholder="帳號">
	<input type="password" name="passwd" required placeholder="密碼">
	<input type="submit" value="登入">
</form>

<!-- NTPC OpenID登入 -->
<form action="login.php" method="post">
	<input type="submit" value="OpenID登入">
	<input type="hidden" name="type" value="ntpc">
</form>