<link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">



<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>


<?php  @session_start(); 
mysql_connect('localhost', 'root', 'bj123456'); // mysql -uroot -proot
mysql_select_db('thingMysql'); // USE testMysql;
$sqlThing = mysql_query('SELECT * FROM `thing`;');
if($_SESSION['login']==false||$_SESSION['login']==NULL)
{
?>
<script type=text/javascript>
window.location.href="login.php";
</script>
<?php
}
if($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['delete']!=0)
{
  mysql_query('DELETE `thing` FROM  `thing` WHERE `uid` = '.$_POST['delete'].';');
 ?>
<script type=text/javascript>
window.location.href="done.php";
</script>
<?php
} 

?>
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
      <a class="navbar-brand" href="user.php"> <?php echo($_SESSION[name]); ?> </a>
	<a class="navbar-brand" href="meno.php"> doing </a>
 <a class="navbar-brand" href="login.php"> logout </a>
    </div>
  </div>
</nav>

<?php
// var_dump($sqlUser);
$data = [];
while(($_SESSION['login']==true)&&($data = mysql_fetch_assoc($sqlThing)) !== false) {

if($_SESSION['name']==$data['user'] && $data['done']== 1 ){	?>

<div class="jumbotron">

  <div class="container">
<form method="post" action="done.php">
	<h1 class="red"> <?php $i=1;for($i=1;$i<=$data['importance'];$i++) {echo("!");} ?>  </h1>
	
	<h3>
		<?php echo $data['title']; ?><small><?php echo $data['details']; ?></small>
		 <button class="btn btn-default" type="submit" name="delete" value="<?php echo $data[uid]; ?>">删除</button>
              
	</h3>

</form>
	
	
</div>

</div>

<?php } 
}?>


</div>

        
</html>
