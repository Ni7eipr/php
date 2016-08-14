<?php
session_start();
if (!empty($_POST["adminname"]) and !empty($_POST["password"])) {
    $adminname = check_value($_POST["adminname"]);
    $password = md5(md5(check_value($_POST["password"])));
    $sql = "select count(*) from admin where adminname='$adminname'and password='$password'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $_SESSION["adminname"] = $adminname;
        //setcookie("admin", md5($adminname), time()+3600);
        okmsg("管理员登陆成功");
    } else {
        nomsg("用户名或密码错误");
    }
}
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <title>index</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?php echo $ROOTDIR; ?>/look/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $ROOTDIR; ?>/look/css/end.css" rel="stylesheet">
    <script src="<?php echo $ROOTDIR; ?>/look/js/jquery.min.js"></script>
    <script src="<?php echo $ROOTDIR; ?>/look/js/bootstrap.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#example-navbar-collapse">
                <span class="sr-only">切换导航</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo $ROOTDIR; ?>/index.php">
            <span class="glyphicon glyphicon-home"></span> SCORE BOARD</a>
        </div>

        <div class="collapse navbar-collapse" id="example-navbar-collapse">
            <ul class="nav navbar-nav">
              <li><a href="<?php echo $ROOTDIR; ?>/index.php">
              <span class="glyphicon glyphicon-folder-open"></span> 主页</a></li>
<?php
    if (isset($_SESSION['adminname']) /*&& isset($_COOKIE['admin'])*/){
        echo "<li><a href='$ROOTDIR/score/add.php'>
        <span class='glyphicon glyphicon-folder-open'></span> 添加</a></li>";
    }
?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
<?php
    if (isset($_SESSION['adminname']) /*&& isset($_COOKIE['admin'])*/){
        echo "
                <li><a class='btn'><kbd class='btn-sm'>你好:管理员</kbd></a></li>
                <li><a href='$ROOTDIR/users/logout.php' class='btn'><kbd class='btn-sm'>退出</kbd></a></li>";
    } elseif (isset($_SESSION['username']) /*&& isset($_COOKIE['Auth'])*/){
        echo "
                <li><a class='btn'><kbd class='btn-sm'>你好:{$_SESSION['username']}</kbd></a></li>
                <li><a href='$ROOTDIR/users/logout.php' class='btn'><kbd class='btn-sm'>退出</kbd></a></li>";
    } else {
        echo "
                <li><a class='btn' href='#userModal' data-toggle='modal'><kbd class='btn-sm'>用户</kbd></a></li>
                <li><a class='btn' href='#admModal1' data-toggle='modal'><kbd class='btn-sm'>管理员</kbd></a></li>";
    }
?>

            </ul>
        </div>
    </nav>