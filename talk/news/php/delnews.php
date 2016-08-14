  <head>
    <title>提示</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <link href="../../look/css/bootstrap.min.css" rel="stylesheet" media="screen">
  </head>
  <style>
    body {
    background: url(../../look/images/background.jpg) fixed center center no-repeat;
    background-size: cover;
    width: 100%;
    }
</style><?php
  session_start();
  if (!isset($_SESSION['adminname']) /*&& isset($_COOKIE['admin'])*/){
    diemsg("呵呵呵呵！","../index.php");
  }
  include("../../conf/dbconnect.php");
  include("../../conf/msg.php");
    if (empty($_GET["news"])) {
    diemsg("呵呵呵呵！","../index.php");
  } elseif (!is_numeric($_GET["news"])) {
    diemsg("呵呵呵呵！","../index.php");
  } else {
    $news = mysqli_real_escape_string($con,$_GET["news"]);
  }
  $sqln = "delete from news  where id=".$news;
  $resn = mysqli_query($con,$sqln);
  $sqln = "delete from comm  where newsid=".$news;
  mysqli_query($con,$sqln);
  $sqln = "delete from img  where newsid=".$news;
  mysqli_query($con,$sqln);
  if ($resn) {
    reoutmsg("删除成功","green","../editnews.php");
  } else {
    diemsg("删除失败","../editnews.php");
  }
?>