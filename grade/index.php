<?php
$ROOTDIR = dirname($_SERVER['SCRIPT_NAME']);
include("conf/dbconnect.php");
include("public/function.php");
include("public/header.php");
# 页数
$sql = "SELECT * FROM users";
$res = get_page($sql);
$nowPage = $res["nowpage"];
$pageNum = $res["pagenum"];

# 读取数据库数据
$sql = "SELECT users.id,users.group,users.name,SUM(score.score) AS score FROM users,score WHERE users.id=score.userid GROUP BY score.userid ORDER BY score DESC LIMIT ".strval(($nowPage-1)*10).",10";
$dataUser = get_sql_data($sql, array("id", "name", "score", "group"));

$sql = "SELECT users.group,SUM(score.score) AS score FROM users,score WHERE users.id=score.userid GROUP BY users.group ORDER BY score DESC";
$dataGroup = get_sql_data($sql, array("group", "score"));

$arrayName = array('index' => array());
pageList($arrayName, $nowPage, $pageNum);
?>
<div class="container">
   <div class="col-sm-9">
      <table class="table table-hover">
         <caption>个人积分排行榜</caption>
         <thead>
            <tr>
               <th>姓名</th>
               <th>分数</th>
               <th>小组</th>
            </tr>
         </thead>
         <tbody>
      <?php
      foreach ($dataUser as $value) {
          echo "<tr><td><a href='./score/detil.php?id=".$value["id"]."' class='btn btn-default' role='button'>".$value["name"]."</a></td><td>".$value["score"]."</td><td width='10%'>".$value["group"]."</td></tr>";
      }
      ?>
         </tbody>
      </table>
   </div>
   <div class="col-sm-2 col-sm-offset-1">
        <table class="table table-hover">
         <caption>小组积分排行榜</caption>
         <thead>
            <tr>
               <th>分数</th>
               <th>小组</th>
            </tr>
         </thead>
         <tbody>
      <?php
      foreach ($dataGroup as $value) {
          echo "<tr><td>".$value["score"]."</td><td width='10%'><a href='./score/groupdetil.php?id=".$value["group"]."' class='btn btn-default' role='button'>".$value["group"]."</a></td></tr>";
      }
      ?>
         </tbody>
      </table>
   </div>
</div>
<?php include("public/footer.php"); ?>