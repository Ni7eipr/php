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
<?php
  if (empty($_GET["page"])) {
      $nowpage = 1;
    } elseif (!is_numeric($_GET["page"])) {
      diemsg("呵呵呵呵！","../index.php");
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
        echo "<li><a href='./editnews.php?page=$prpagenum'>&laquo;</a></li>";
      }

      for ($i=1; $i <= $pagenum; $i++) {
        if ($nowpage==$i) {
          echo "<li class='active'><a href='./editnews.php?page=$i'>$i</a></li>";
        } else {
          echo "<li><a href='./editnews.php?page=$i'>$i</a></li>";
        }
      }

      if ($nowpage==$pagenum || $pagenum==0) {
        echo "<li class='disabled'><a>&raquo;</a></li>";
      } else {
        echo "<li><a href='./editnews.php?page=$afpagenum'>&raquo;</a></li>";
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
        <a href='./detil.php?news={$rown['0']}'>
end;
    if (isset($rowi)) {
      echo <<<end
          <pre style="height:10%"><img src=../uploads/images/{$rowi[0]}
          style="max-height:100%" class="img-thumbnail">{$rown[2]}</pre>
end;
    } else {
      echo "<pre style='height:10%''>{$rown[2]}</pre>";
    }
echo <<<end
        </a><a href='./chenews.php?news={$rown[0]}' class='btn btn-info btn-xs'>编辑</a>
        <button onclick="document.getElementById('delbutton').href='./php/delnews.php?news={$rown[0]}'"
        class='btn btn-danger btn-xs' href='#delModal1' data-toggle='modal'>删除</button>
        </a>
      </blockquote>
end;
    echo '</div>';
  }
?>
    </div>
  </div>

        <!-- 删除框 -->
  <div class="modal fade" id="delModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-top: 15%">
     <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times; </button>
              <h3 class="modal-title" id="myModalLabel"> 删除 </h3>
           </div>
            <div class="modal-body">
              <center><h1 style="font-size: 65px;text-shadow: red 5px 3px 3px;">确定删除吗？</h1></center>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
              <a id="delbutton" class="btn btn-danger">删除</a>
           </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal -->
  </div><!-- 模态框（Modal） -->

    <script src="../look/js/jquery.min.js"></script>
    <script src="../look/js/bootstrap.min.js"></script>
  </body>
</html>