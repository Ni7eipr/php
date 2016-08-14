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
</style>
<?php
  session_start();
  if (!isset($_SESSION['adminname']) /*&& isset($_COOKIE['admin'])*/){
    diemsg("呵呵呵呵！","../index.php");
  }
  include("../../conf/dbconnect.php");
  include("../../conf/msg.php");
  if ($_POST) {
    //var_dump($_FILES);
    if ($_FILES["file"]["name"]) {
      if ((($_FILES["file"]["type"] == "image/gif")
      || ($_FILES["file"]["type"] == "image/jpeg")
      || ($_FILES["file"]["type"] == "image/pjpeg"))
      && ($_FILES["file"]["size"] < 400000)) {
        if ($_FILES["file"]["error"] > 0) {
          echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
        } else {
          if (file_exists("upload/" . $_FILES["file"]["name"])) {
            echo $_FILES["file"]["name"] . " already exists. ";
          } else {
            $imgs = date("Ymdhisa").substr($_FILES["file"]["name"],strripos($_FILES["file"]["name"],"."));
            move_uploaded_file($_FILES["file"]["tmp_name"], "../../uploads/images/" . $imgs);
          }
        }
      } else {
        echo "Invalid file";
      }
    }
    if (empty($_GET["news"])) {
      diemsg("呵呵呵呵！","../index.php");
    } elseif (!is_numeric($_GET["news"])) {
      diemsg("呵呵呵呵！","../chenews.php?news=$newsid");
    } else {
      $newsid = htmlspecialchars(mysqli_real_escape_string($con,$_GET["news"]));
    }
    $title = htmlspecialchars(mysqli_real_escape_string($con,$_POST["title"]));
    $news = htmlspecialchars(mysqli_real_escape_string($con,$_POST["news"]));
    $date = htmlspecialchars(mysqli_real_escape_string($con,$_POST["date"]));
    $sqlc = "select count(*) from news where date = '$date'";
    $resc = mysqli_query($con,$sqlc);
    $rowc = mysqli_fetch_row($resc);
    if ($rowc[0]>0) {
        diemsg("请勿重复提交","../chenews.php?news=$newsid");
    }
    $sql = "update news set  title=\"$title\", news=\"$news\",date=\"$date\" where id = $newsid";

    $aa = mysqli_query($con,$sql) or diemsg('修改失败.',"../chenews.php?news=$newsid");

    reoutmsg("修改成功","green","../editnews.php");
  }else { diemsg("数据错误","../chenews.php?news=$newsid"); }
?>