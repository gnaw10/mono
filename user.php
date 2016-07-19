<link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<?php  @session_start(); 
mysql_connect('localhost', 'root', 'bj123456'); // mysql -uroot -proot
mysql_select_db('testMysql'); // USE testMysql;

if($_SESSION['login']==false||$_SESSION['login']==NULL)
{
?>
<script type=text/javascript>window.location.href="login.php";</script>
<?php
}
if($_SERVER['REQUEST_METHOD'] === 'POST') {
	$pre=MD5($_POST['pre']);
	$after=MD5($_POST['after']);
	$sqlWord = mysql_query('SELECT `password` FROM `user` WHERE `username`="'.$_SESSION['name'].'";');
	if($pre  === mysql_fetch_assoc($sqlWord)['password'] ) {
		echo('UPDATE `user` SET `password` = "'.$after.'" WHERE `username` = '.$_SESSION['name'].';');
		mysql_query('UPDATE `user` SET `password` = "'.$after.'" WHERE `username` = "'.$_SESSION['name'].'";');
	}
	else {
		echo "Wrong Password";
	}
}?>

<html>

	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">

					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="user.php">
					<?php echo($_SESSION[name]); ?></a>
				<a class="navbar-brand" href="meno.php">doing</a>
				<a class="navbar-brand" href="done.php">done</a>
				<a class="navbar-brand" href="login.php">logout</a>
			</div>
		</div>
		<!-- /.container-fluid -->
	</nav>
	<div class="jumbotron">
		<div class="container">
			<form method="post" action="user.php">

				<input  type= "password" name="pre" placeholder="old password">
				<input  type= "password" name="after" placeholder="new password">
				<input type="submit" value="Enter" ></form>
		</div>
	</div>

</html>