<!DOCTYPE html>
<head>
<meta charset="UTF-8">
<title>注册</title>
<link rel="stylesheet" type="text/css" href="../look/css/bootstrap.min.css">
<style>
    body { background: url(../look/images/background.jpg) fixed center center no-repeat; background-size: cover; }
</style>
</head>
<?PHP
session_start();
include("../conf/msg.php");
if (isset($_SESSION['username']) //&& isset($_COOKIE['Auth'])
  ){
   header('Location:./logged.php');
}
include("../conf/dbconnect.php");
if (!empty($_POST)) {
  $username = htmlspecialchars(mysqli_real_escape_string($con,$_POST["username"]));
  $password = md5(htmlspecialchars(mysqli_real_escape_string($con,$_POST["password"])));
  $rpassword = md5(htmlspecialchars(mysqli_real_escape_string($con,$_POST["rpassword"])));
  if ($_POST["password"] == $_POST["rpassword"]) {
    $sql = "select count(*) from users where username='$username'";
    $res = mysqli_query($con,$sql);
    $row = mysqli_fetch_row($res);
    if ($row[0] == 0) {
      $sql = "insert into users ( username, password) values(\"$username\", \"$password\")";
      mysqli_query($con,$sql) or die('创建用户失败.');
      reoutmsg("注册成功","green","../index.php");
      exit();
      }else{
        diemsg("用户已存在,请重新注册","./register.php");
      }
  } else {
    diemsg("两次密码输入不一致，请重新填写","./register.php");
  }
}
?>

<body>
  <div class="container-fluid">
    <div style="margin-top: 15%" class="row">
      <div class="col-md-3 col-md-offset-6">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel">
          注册
          </h4>
        </div>
        <div class="modal-body">
          <form class="" action="" method="post">
            <div class="form-group">
              <div class="input-group">
                  <span class="input-group-addon">账号</span>
                  <input type="text" class="form-control" placeholder="请输入您的账号" name="username"required autofocus/>
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                  <span class="input-group-addon">密码</span>
                  <input type="password" class="form-control" placeholder="请输入您的密码" name="rpassword"required/>
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                  <span class="input-group-addon">密码</span>
                  <input type="password" class="form-control" placeholder="请再次输入您的密码" name="password"required/>
              </div>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary">注册</button>
              <a href ="../index.php" class="btn btn-info">主页</a>
              <a class="btn" href="#userModal" data-toggle="modal">已有账号</a>
            </div>
          </form>
        </div>
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-top: 15%">
   <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times; </button>
            <h4 class="modal-title" id="myModalLabel"> 用户登录 </h4>
         </div>
        <div class="modal-body">
          <form class="" action="../user/userlogin.php" method="post">
            <div class="form-group">
              <div class="input-group">
                  <span class="input-group-addon">账号</span>
                  <input type="text" class="form-control" placeholder="请输入您的账号" name="username"required autofocus/>
              </div>
            </div>
            <div class="form-group">
              <div class="input-group">
                  <span class="input-group-addon">密码</span>
                  <input type="password" class="form-control" placeholder="请输入您的密码" name="password"required/>
              </div>
            </div>
        </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            <button type="submit" class="btn btn-primary">登录</button>
            <a href ="./user/register.php" class="btn btn-info">注册</a>
          </form>
         </div>
      </div><!-- /.modal-content -->
</div><!-- /.modal -->
</div>
    <script src="../bootstrap/js/jquery.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
</body>
</html>