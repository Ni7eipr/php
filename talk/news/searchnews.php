
<!DOCTYPE html>
<html>
  <head>
    <title>删除修改</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <link href="../look/css/bootstrap.min.css" rel="stylesheet" media="screen">
  </head>
  <style>
    body {
    background: url(./images/1111.jpg) fixed center center no-repeat;
    background-size: cover;
    width: 100%;
    }
</style>
<?php
  include("../conf/dbconnect.php");
  include("../conf/msg.php");
  session_start();
  if (!isset($_SESSION['adminname']) /*&& isset($_COOKIE['admin'])*/){
    diemsg("请登录","../index.php");
  }

?>
<body>
  <nav class="navbar navbar-inverse" role="navigation">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="../index.php">Home</a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
          <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">管理新闻<b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="./addnews.php">添加新闻</a></li>
            <li><a href="./editnews.php">删除修改</a></li>
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <form class="navbar-form navbar-left" role="search" action = "./searchnews.php">
           <div class="input-group">
               <input type="text" class="form-control" placeholder="Search" name="text">
               <span class="input-group-btn">
                  <button class="btn btn-default" type="submit">
                     Go!
                  </button>
               </span>
            </div>
        </form>
        <li><a class='btn'><kbd class='btn-sm'>管理员<?php echo $_SESSION['adminname']; ?></kbd></a></li>
        <li><a href='../users/logout.php' class='btn'><kbd class='btn-sm'>退出</kbd></a></li>
      </ul>
    </div>
  </nav>

    <script src="../look/js/jquery.min.js"></script>
    <script src="../look/js/bootstrap.min.js"></script>
  </body>
</html>