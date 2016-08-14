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
    include("../../conf/dbconnect.php");
    include("../../conf/msg.php");
    if ($_POST) {
        if (isset($_SESSION['adminname'])){
            $username = $_SESSION['adminname'];
        } elseif (isset($_SESSION['username'])) {
            $username = $_SESSION['username'];
        } else {
            diemsg("请先登录",$_SERVER['HTTP_REFERER']);
        }

        $newsid = htmlspecialchars(mysqli_real_escape_string($con,$_POST["newsid"]));
        $comm  = htmlspecialchars(mysqli_real_escape_string($con,$_POST["comm"]));
        $date = htmlspecialchars(mysqli_real_escape_string($con,$_POST["date"]));
        $sqlc = "select count(*) from comm where date = '$date'";
        $resc = mysqli_query($con,$sqlc);
        $rowc = mysqli_fetch_row($resc);
        if ($rowc[0]>0) {
            diemsg("请勿重复提交","../detil.php?news=$newsid");
        }
        $sql = "insert into comm ( newsid, text,username,date) values(\"$newsid\", \"$comm\", \"$username\", \"$date\")";
        $aa = mysqli_query($con,$sql) or diemsg('评论失败.',"../../index.php");
        reoutmsg("评论成功","green","../detil.php?news=".$newsid);
    } else { diemsg("数据错误","../../index.php"); }


?>