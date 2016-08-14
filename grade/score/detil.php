<?php
$ROOTDIR = dirname($_SERVER['SCRIPT_NAME'])."/..";
include("../conf/dbconnect.php");
include("../public/function.php");
include("../public/header.php");

# 删除
if (isset($_GET["delid"])) {
    if (!strpos($_SERVER['HTTP_REFERER'],dirname($_SERVER['SCRIPT_NAME']))) {
        die(nomsg("呵呵呵呵！"));
    }

    $id = get_value("delid");

    $sql = "SELECT userid FROM score WHERE id=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $userid = $row["userid"];

    $sql = "DELETE FROM score WHERE id=$id";
    $result = $conn->query($sql);
    if ($result) {
        okmsg("删除成功");
    }

    $sql = "SELECT * FROM score WHERE userid=$userid";
    $result = $conn->query($sql);
    if ($result and $result->num_rows == 0) {
        $sql = "DELETE FROM users WHERE id=$userid";
        $result = $conn->query($sql);
    }
}

# 获取参数
$id = get_value("id");

# 页数
$sql = "SELECT * FROM score WHERE userid=$id";
$res = get_page($sql);
$nowPage = $res["nowpage"];
$pageNum = $res["pagenum"];

# 读取数据库数据
$sql = "SELECT * FROM score WHERE userid=$id LIMIT ".strval(($nowPage-1)*10).",10";
$dataScore = get_sql_data($sql, array("id", "score", "text", "date", "critique", "userid"));

$sql = "SELECT id,name,`group` FROM users WHERE id=".$dataScore[0]["userid"];
$dataUser = get_sql_data($sql, array("id", "group", "name"));
$dataUser = $dataUser[0];

# 页码
pageList(array('detil' => array("id" => $id)), $nowPage, $pageNum);
?>
<div class="container">
<table class='table table-hover'>
   <caption>第 <?php echo $dataUser["group"]." 组 ".$dataUser["name"]; ?> 积分详情:</caption>
   <thead>
      <tr>
         <th>分数</th>
         <th>内容</th>
         <th>日期</th>
         <th>点评</th>
<?php
if (isset($_SESSION['adminname']) /*&& isset($_COOKIE['admin'])*/){
  echo "<th>操作</th>";
}
?>
      </tr>
   </thead>
   <tbody>
<?php
foreach ($dataScore as $value) {
  echo "<tr><td>".$value["score"]."</td><td>".$value["text"]."</td><td>".$value["date"]."</td><td>".$value["critique"]."</td>";
  if (isset($_SESSION['adminname']) /*&& isset($_COOKIE['admin'])*/){
    echo"<td width='15%'>
            <a href='./edit.php?id=".$value["id"]."' class='btn btn-info'>编辑</a>
            <button onclick=\"document.getElementById('delbutton').href='./detil.php?delid=".$value["id"]."&id=".$id."'\"
          class='btn btn-danger' href='#delModal1' data-toggle='modal'>删除</button>
          </td>
        </tr>";
    }
}
?>
   </tbody>
</table>
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
</div>
<?php include("../public/footer.php"); ?>
