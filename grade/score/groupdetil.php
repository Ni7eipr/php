<?php
$ROOTDIR = dirname($_SERVER['SCRIPT_NAME'])."/..";
include("../conf/dbconnect.php");
include("../public/function.php");
include("../public/header.php");

# 获取参数页数
$id = get_value("id");

$sql = "SELECT * FROM users WHERE `group`=$id GROUP BY id";
$res = get_page($sql);
$nowPage = $res["nowpage"];
$pageNum = $res["pagenum"];

# 读取数据库数据
$sql = "SELECT users.id,users.name,SUM(score.score) AS score FROM users,score WHERE users.id=score.userid and users.group=$id GROUP BY score.userid ORDER BY score DESC LIMIT ".strval(($nowPage-1)*10).",10";
$dataUser = get_sql_data($sql, array("id", "name", "score"));

# 页码
pageList(array('index' => array("id" => $id)), $nowPage, $pageNum);
?>

<div class="container">
  <table class="table table-hover">
     <caption>第 <?php echo $id; ?> 组 积分排行榜</caption>
     <thead>
        <tr>
           <th>姓名</th>
           <th>分数</th>
        </tr>
     </thead>
     <tbody>
  <?php
  foreach ($dataUser as $value) {
      echo "<tr><td><a href='../score/detil.php?id=".$value["id"]."' class='btn btn-default' role='button'>".$value["name"]."</a></td><td>".$value["score"]."</td></tr>";
  }
  ?>
     </tbody>
  </table>
</div>
<?php include("../public/footer.php"); ?>