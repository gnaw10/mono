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
	
	
	<form method="post" action="register.php">
		
	
	
	<div class="jumbotron cen" >
	<div class="container">
	<?php
	mysql_connect('localhost', 'root', 'bj123456'); // mysql -uroot -proot
	mysql_select_db('testMysql'); // USE testMysql;
	if($_SERVER['REQUEST_METHOD'] === 'POST')
	 {
		$username = $_POST['username'];
		$password = MD5($_POST['password']);
		$sql = "select * from user where username='$username'";
		$rs = mysql_query($sql);
		if(mysql_fetch_row($rs))
		{
			echo "username used";
		}
		else
		{
			mysql_query('INSERT INTO `user` (`username`, `password`) VALUES ("'.$username.'", "'.$password.'");');
	?>
	<script type=text/javascript>window.location.href="login.php";</script>
	<?php
		}
	}
		// $uid = mysql_insert_id();

	$sqlUser = mysql_query('SELECT * FROM `user`;');
	// var_dump($sqlUser);
	$list = [];
	$data = [];
	while(($data = mysql_fetch_assoc($sqlUser)) !== false) {
		array_push($list, $data);
	}
	// var_dump($data);
	?>
		<div class="Absolute-Center">
			<table width="500px" border="0">
				
					<tr >
					<form  method="post" action="register.php">
						<td  colspan="2" style="text-align:center;">
							账号
							<input type="text" name="username">
							<br>
							密码
							<input type="password" name="password">
						</td>
					</tr>
					<tr>
						<td style="width:250px;">
							<div style="float:right;"><input type="submit" value="register" style="color:black;"></div></td>
						<td style="width:250px;">
							<div style="float:left;"><a href="login.php" style='text-decoration:none;color:black;'>
								<input type="button" name="login" value="login"></a>
						</div></td>
					</tr>
				</form>
			</table>
		</div>
	</div>
</div>
</form>
	<pre>

	<?php print_r($list);?></pre>