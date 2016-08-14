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
<?PHP
session_start();
if (!empty($_POST)) {
    include("../conf/dbconnect.php");
    var_dump($_POST);
    $adminname = htmlspecialchars(mysqli_real_escape_string($con,$_POST["username"]));
    $password = md5(md5(htmlspecialchars(mysqli_real_escape_string($con,$_POST["password"]))));
    $referer = htmlspecialchars(mysqli_real_escape_string($con,$_POST["referer"]));
    $sql = "select count(*) from admin where adminname='$adminname'and password='$password'";
    $res = mysqli_query($con,$sql);
    $row = mysqli_fetch_row($res);
    if ($row[0]>0) {
        $_SESSION["adminname"] = $adminname;
        setcookie("admin", md5($username), time()+3600);
        //var_dump($_SESSION);
        header('Location:'.$referer);
    } else {
        include("../conf/msg.php");
        reoutmsg("用户名或密码错误","red",$referer);
    }
}
?>