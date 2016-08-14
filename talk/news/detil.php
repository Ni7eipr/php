<?php
  session_start();
  include("../conf/dbconnect.php");
  include("../conf/msg.php");
  if (empty($_GET["news"])) {
    diemsg("呵呵呵呵！","../index.php");
  } elseif (!is_numeric($_GET["news"])) {
    diemsg("呵呵呵呵！","../index.php");
  } else {
    $news = mysqli_real_escape_string($con,$_GET["news"]);
  }
  $sqln = "Select id,title,news from news where id = $news";
  $resn = mysqli_query($con,$sqln);
  $rown = mysqli_fetch_row($resn);
  if (!$rown) {
    diemsg("无数据","../index.php");
  }
  $sqlc = "Select username,text from comm where newsid = $rown[0]";
  $resc = mysqli_query($con,$sqlc);
  while ($rowc = mysqli_fetch_row($resc)) {
    $rows[ ] = $rowc;
  };
?>
<!DOCTYPE html>
<html>
  <head>
    <title><?php echo $rown[1] ?></title>
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
<?php
  if (isset($_SESSION['adminname']) /*&& isset($_COOKIE['admin'])*/){
  echo <<<end
      <ul class="nav navbar-nav">
          <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">管理新闻<b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="./news/addnews.php">添加新闻</a></li>
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
        <li><a class='btn'><kbd class='btn-sm'>管理员{$_SESSION['adminname']}</kbd></a></li>
        <li><a href='../users/logout.php' class='btn'><kbd class='btn-sm'>退出</kbd></a></li>
      </ul>
    </div>
  </nav>
end;
  } elseif (isset($_SESSION['username']) /*&& isset($_COOKIE['Auth'])*/){
    echo <<<end
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
        <li><a class='btn'><kbd class='btn-sm'>你好{$_SESSION['username']}</kbd></a></li>
        <li><a href='../users/logout.php' class='btn'><kbd class='btn-sm'>退出</kbd></a></li>
      </ul>
    </div>
  </nav>
end;
  } else {
    echo <<<end
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
        <li><a class='btn' href='#userModal' data-toggle='modal'><kbd class='btn-sm'>用户</kbd></a></li>
        <li><a class='btn' href='#admModal1' data-toggle='modal'><kbd class='btn-sm'>管理员</kbd></a></li>
      </ul>
    </div>
  </nav>
end;
  }
?>
  <div class="container-fluid">
    <div class="row">
      <div class='col-md-2' style='word-break:break-all'>
        <form role="form" action="./php/addcomm.php" method="post">
          <div class="form-group">
            <textarea maxlength="100" class="form-control" rows="3" name="comm" required></textarea>
          </div>
          <input hidden  type="text" name="newsid" value="<?php echo $rown[0] ?>" />
          <input hidden  type="text" name="date" value="<?php echo date("Y-m-dhisa") ?>" />
          <div class="form-group">
<?php
  if (isset($_SESSION['adminname'])||isset($_SESSION['username']))
       echo "<button  type='submit' class='btn btn-primary'>添加评论</button>";
  else
       echo "<button  type='button' class='disabled btn btn-primary'>评论请先登录</button>";
?>
          <hr>
          </div>
        </form>
        <h3><strong>评论:</strong><br></h3>
<?php
if (!isset($rows))
  {
    echo "暂无评论";
  } else {
    foreach ($rows as $value) {
    echo "<p><div class='btn btn-default'>【{$value[0]}】: {$value[1]}</div></p>";
    }
  }
?>
      </div>
      <div class="col-md-6" style="word-break:break-all">
        <table class="table">
           <caption>新闻详情</caption>
           <thead>
              <tr>
                 <th class="text-center"><?php echo $rown[1] ?></th>
              </tr>
           </thead>
           <tbody>
            <tr>
             <th><?php echo $rown[2] ?></th>
            </tr>
           </tbody>
        </table>
      </div>
      <div class="col-md-4">
<?php
    $sqli = "SELECT img FROM img where newsid = $rown[0]";
    $resi = mysqli_query($con,$sqli);
    while ($rowi = mysqli_fetch_row($resi)) {
      $rowii[ ] = $rowi;
    }
    if (isset($rowii))
    {
      foreach ($rowii as $value) {
        echo "<pre><img src=../uploads/images/$value[0] style='max-height:100%' class='img-thumbnail'></pre>";
      }
    }
?>
      </div>
     </div>
  </div>

  <!-- 用户登录 -->
  <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-top: 15%">
     <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times; </button>
              <h4 class="modal-title" id="myModalLabel"> 用户登录 </h4>
           </div>
          <div class="modal-body">
            <form class="" action="../users/userlogin.php" method="post">
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
              <input hidden  type="text" name="referer" value="../news/detil.php?news=<?php echo $news ?>" />
              <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
              <button type="submit" class="btn btn-primary">登录</button>
              <a href ="../users/register.php" class="btn btn-info">注册</a>
            </form>
           </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal -->
  </div><!-- 模态框（Modal） -->


    <!-- 管理员登录 -->
  <div class="modal fade" id="admModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-top: 15%">
     <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times; </button>
              <h4 class="modal-title" id="myModalLabel"> 管理员登录 </h4>
           </div>
          <div class="modal-body">
            <form class="" action="../users/adminlogin.php" method="post">
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
              <input hidden  type="text" name="referer" value="../news/detil.php?news=<?php echo $news ?>" />
              <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
              <button type="submit" class="btn btn-primary">登录</button>
            </form>
           </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal -->
  </div><!-- 模态框（Modal） -->
    <script src="../look/js/jquery.min.js"></script>
    <script src="../look/js/bootstrap.min.js"></script>
  </body>
</html>