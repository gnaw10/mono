<html>
<link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<style type="text/css">
	.cen
	{
		position: fixed;
		top:0;
		right:0;
		bottom:0;
		left:0;
		background-size: cover;
	}
	.Absolute-Center {  
  width: 50%;  
  height: 50%;  
  overflow: auto;  
  margin: auto;  
  position: absolute;  
  top: 0; left: 0; bottom: 0; right: 0;  
}  
</style>
<?php
@session_start();
$_SESSION[name]="";
$_SESSION[login]="";

if($_SERVER['REQUEST_METHOD'] === 'POST') {
	mysql_connect('localhost', 'root', 'bj123456'); // mysql -uroot -proot
	mysql_select_db('testMysql'); // USE testMysql;
	$username = $_POST['username'];
	$password = MD5($_POST['password']);
	$sqlUser = mysql_query('SELECT * FROM `user` WHERE `username`="'.$username.'";');
	if($password === mysql_fetch_assoc($sqlUser)['password']) {
		$_SESSION['login'] = true;
		$_SESSION['name'] = $username;
	}
	else {
		$_SESSION['login'] = false;
	}
}

// $_GET $_POST $_SERVER $_SESSION
if(isset($_SESSION['login']) && $_SESSION['login'] === true) {
	echo 'login successfully!';
?>
<script type=text/javascript>window.location.href="meno.php";</script>
<?php
}
else {
	echo 'not login';
}
?>

<div class="jumbotron cen" >
	<div class="container">
		<div class="Absolute-Center">
			<table width="500px" border="0">
				<form  method="post" action="login.php">
					<tr>
						<td colspan="2" style="text-align:center;">
							账号
							<input type="text" name="username">
							<br>
							密码
							<input type="password" name="password">
						</td>
					</tr>
					<tr>
						<td style="width:250px;">
							<div style="float:right;"><input type="submit" value="login" style="color:black;"></div></td>
						<td style="width:250px;">
							<div style="float:left;"><a href="register.php" style='text-decoration:none;color:black;'>
								<input type="button" name="register" value="register"></a>
						</div></td>
					</tr>
				</form>
			</table>
		</div>
	</div>
</div>
	</html>