  <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

  <script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
  <script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

  <?php  @session_start(); 
  mysql_connect('localhost', 'root', 'bj123456'); // mysql -uroot -proot
  mysql_select_db('thingMysql'); // USE testMysql;

  if($_SESSION['login']==false||$_SESSION['login']==NULL)
  {
  ?>  
  <script type=text/javascript>window.location.href="login.php";</script>
  <?php
  }

  if($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['doit']!=0)
  {
    mysql_query('UPDATE `thing` SET `done` = 1 WHERE `uid` = '.$_POST['doit'].';');
  }


  if($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['moredetails']!="")
  {

         mysql_query('UPDATE `thing` SET `details` = "'.$_POST['moredetails'].'" WHERE `uid` = '.$_POST['changeit'].';');
         echo 'UPDATE `thing` SET `details` = "'.$_POST['moredetails'].'" WHERE `uid` = '.$_POST['changeit'].';';
  }

  if($_SERVER['REQUEST_METHOD'] === 'POST'  && $_POST['title']!="") {
    $title = $_POST['title'];
    $details = $_POST['details'];
    $import=$_POST['import'];
    $user=$_SESSION['name'];
    mysql_query('INSERT INTO `thing` (`user`, `title`,`details`,`createtime`,`importance`,`done`) VALUES ("'.$user.'","'.$title.'", "'.$details.'", now(),"'.$import.'",0);');
  }
  $sqlThing = mysql_query('SELECT * FROM `thing`;');
  ?>  

  <html>

    <script>
  setInterval(function() {
     $("#content").load(location.href+" #content>*","");
  }, 5000);
  </script>

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

          <a class="navbar-brand" href="done.php">done</a>
          <a class="navbar-brand" href="login.php">logout</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->  
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li></li>
          </ul>

          <ul class="nav navbar-nav navbar-right">

            <li>
              <button type="button" style="margin-top:7px;" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg" >添加</button>

            </li>

          </ul>
        </div>
        <!-- /.navbar-collapse --> </div>
      <!-- /.container-fluid --> </nav>

    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <form method="post" action="meno.php">
            标题
            <input type="text" name="title">  
            详细
            <input type="text" name="details">  

            <div class="btn-group" role="group">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                重要性
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu" name="im">
                <li>
                  <input type="radio" name="import" value="3">非常重要</li>
                <li>
                  <input type="radio" name="import" value="2">挺重要的</li>
                <li>
                  <input type="radio" name="import" value="1">就那回事</li>
              </ul>
            </div>
            <input type="submit" value="register"></form>
        </div>
      </div>
    </div>

    <?php
  // var_dump($sqlUser);
  $data = [];
  while(($_SESSION['login']==true)&&($data = mysql_fetch_assoc($sqlThing)) !== false) {
  if($_SESSION['name']==$data['user'] && $data['done']== 0 ){ ?>  

    <div class="jumbotron">

      <div class="container">
        <form method="post" action="meno.php">
          <h1 class="red">
            <?php $i=1;for($i=1;$i<=$data['importance'];$i++) {echo("!");} ?></h1>
          <h3>
            <div>
              <?php echo $data['title']; ?>  
              <small>
                <?php echo $data['details']; ?></small>

              <button class="btn btn-default" type="submit" name="doit" value="<?php echo $data[uid]; ?>">完成</button>

              <button   type="button" style="float:right;" class="btn btn-default" type="submit" data-toggle="modal"  data-target=".moredetails" >More</button>
              <div class="modal fade moredetails" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    details
                    <input type="text" name="moredetails">  
                    <button class="btn btn-default" type="submit" name="changeit" value="<?php echo $data[uid]; ?>">Enter</button>

                  </div>
                </div>
              </div>
            </div>
          </h3>

        </form>
      </div>

    </div>

    <?php } 
  }?></div>

  </html>