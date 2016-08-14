<?php
  session_start();
  include("./conf/dbconnect.php");
  include("./conf/msg.php");
?>
<!DOCTYPE html>
<html>
  <head>
    <title>新闻发布</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <link href="./look/css/bootstrap.min.css" rel="stylesheet" media="screen">
  </head>
  <style>
    body {
    background: url(./look/images/background.jpg) fixed center center no-repeat;
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
      <a class="navbar-brand" href="./index.php">Home</a>
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
            <li><a href="./news/editnews.php">删除修改</a></li>
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <form class="navbar-form navbar-left" role="search" action = "./news/searchnews.php">
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
        <li><a href='./users/logout.php' class='btn'><kbd class='btn-sm'>退出</kbd></a></li>
      </ul>
    </div>
  </nav>
end;
  } elseif (isset($_SESSION['username']) /*&& isset($_COOKIE['Auth'])*/){
    echo <<<end
      <ul class="nav navbar-nav navbar-right">
         <form class="navbar-form navbar-left" role="search" action = "./news/searchnews.php">
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
        <li><a href='./users/logout.php' class='btn'><kbd class='btn-sm'>退出</kbd></a></li>
      </ul>
    </div>
  </nav>
end;
  } else {
    echo <<<end
      <ul class="nav navbar-nav navbar-right">
        <form class="navbar-form navbar-left" role="search" action = "./news/searchnews.php">
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
  if (empty($_GET["page"])) {
    $nowpage = 1;
  } elseif (!is_numeric($_GET["page"])) {
    diemsg("呵呵呵呵！","./index.php");
  } else {
    $nowpage = htmlspecialchars(mysqli_real_escape_string($con,$_GET["page"]));
  }
  $sqlpn = "SELECT count(*) FROM news";
  $respn = mysqli_query($con,$sqlpn);
  $rowpn = mysqli_fetch_row($respn);
  $pagenum=ceil($rowpn[0]/10);
?>
  <div class="container-fluid">
    <div class="row">
  <center>
    <ul class="pagination">
    <?php
      $prpagenum = $nowpage-1;
      $afpagenum = $nowpage+1;
      if ($nowpage==1) {
        echo "<li class='disabled'><a>&laquo;</a></li>";
      } else {
        echo "<li><a href='index.php?page=$prpagenum'>&laquo;</a></li>";
      }

      for ($i=1; $i <= $pagenum; $i++) {
        if ($nowpage==$i) {
          echo "<li class='active'><a href='index.php?page=$i'>$i</a></li>";
        } else {
          echo "<li><a href='index.php?page=$i'>$i</a></li>";
        }
      }

      if ($nowpage==$pagenum || $pagenum==0) {
        echo "<li class='disabled'><a>&raquo;</a></li>";
      } else {
        echo "<li><a href='index.php?page=$afpagenum'>&raquo;</a></li>";
      }
    ?>
    </ul>
  </center>
<?php
  for ($i=($nowpage-1)*12; $i < ($nowpage*12) && $i < $rowpn[0]; $i++) {
    echo '<div class="col-md-4">';
    $sqln = "SELECT id,title,SUBSTRING(news,1,50) FROM news LIMIT $i,1";
    $resn = mysqli_query($con,$sqln);
    $rown = mysqli_fetch_row($resn);
    $sqli = "SELECT img FROM img where newsid = $rown[0] limit 0,1";
    $resi = mysqli_query($con,$sqli);
    $rowi = mysqli_fetch_row($resi);
    echo <<<end
      <blockquote>
        {$rown[1]}:<br>
        <a href='./news/detil.php?news={$rown['0']}'>
end;
    if (isset($rowi)) {
      echo <<<end
          <pre style="height:13%"><img src=./uploads/images/{$rowi[0]}
          style="max-height:100%" class="img-thumbnail">{$rown[2]}</pre>
end;
    } else {
      echo "<pre style='height:13%''>{$rown[2]}</pre>";
    }
echo <<<end
        </a>
      </blockquote>
end;
    echo '</div>';
  }
?>
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
            <form class="" action="./users/userlogin.php" method="post">
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
              <input hidden  type="text" name="referer" value="../index.php" />
              <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
              <button type="submit" class="btn btn-primary">登录</button>
              <a href ="./users/register.php" class="btn btn-info">注册</a>
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
            <form class="" action="./users/adminlogin.php" method="post">
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
              <input hidden  type="text" name="referer" value="../index.php" />
              <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
              <button type="submit" class="btn btn-primary">登录</button>
            </form>
           </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal -->
  </div><!-- 模态框（Modal） -->

  <script src="./look/js/jquery.min.js"></script>
  <script src="./look/js/bootstrap.min.js"></script>
  </body>
</html>