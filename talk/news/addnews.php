<?php
  include("../conf/dbconnect.php");
  include("../conf/msg.php");
  session_start();
  if (!isset($_SESSION['adminname']) /*&& isset($_COOKIE['admin'])*/){
    diemsg("呵呵呵呵！","../index.php");
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <title>添加新闻</title>
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
            <li><a class='btn'><kbd class='btn-sm'>管理员<?php echo $_SESSION['adminname']; ?></kbd></a></li>
            <li><a href='../users/logout.php' class='btn'><kbd class='btn-sm'>退出</kbd></a></li>
      </ul>
    </div>
  </nav>
  <div class="container">
    <div class="row">
      <form action="./php/addnews.php" enctype="multipart/form-data" method="post">
        <div class="form-group">
          <div class="input-group">
              <span class="input-group-addon">标题</span>
              <input type="text" class="form-control" placeholder="请输入新闻标题" name="title"required autofocus/>
          </div>
        </div>
        <div class="form-group">
          正文：<textarea class="form-control" rows="20" name="news" required></textarea>
        </div>
        <div class="form-group">
          <input type="file" name="file" />
        </div>
        <input hidden  type="text" name="date" value="<?php echo date("Y-m-dhisa") ?>" />
        <button type="submit" class="btn btn-primary">添加</button>
      </form>
    </div>
  </div>
    <script src="../look/js/jquery.min.js"></script>
    <script src="../look/js/bootstrap.min.js"></script>
  </body>
</html>