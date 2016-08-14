<?php
$ROOTDIR = dirname($_SERVER['SCRIPT_NAME'])."/..";
include("../conf/dbconnect.php");
include("../public/header.php");
include("../public/function.php");

if (!isset($_SESSION['adminname']) /*&& isset($_COOKIE['admin'])*/){
    die(nomsg("呵呵呵呵！"));
}

if (!empty($_POST)) {
    $arrayName = array("name", "score", "text", "critique", "date", "group");
    $data = checkPost($arrayName);
    foreach ($data as $key => $value) {
        $$key = $value;
    }

    # 判断是否存在
    $sql = "SELECT id FROM users WHERE name=\"$name\"";
    $result = $conn->query($sql);
    if ($result and $result->num_rows == 0) {
        # 不存在添加姓名
        $sql_ = "INSERT INTO users (name, `group`) values(\"$name\", \"$group\")";
        $res = $conn->query($sql_);
    }

    # 获取id
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $id = $row["id"];

    # 插入数据
    $sql = "INSERT INTO score (text,score,critique,date,userid) values(\"$text\",\"$score\",\"$critique\",\"$date\",$id)";
    $result = $conn->query($sql);
    if ($result) {
        okmsg("为 ".$name." 添加积分成功");
    } else {
    nomsg("为 ".$name." 添加积分失败");
    }
}

$sql = "SELECT * FROM users";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
    $data[$row["id"]] = $row["name"];
}
?>
<form class="col-sm-3 col-sm-offset-4" action="" method="post" style="margin-top:10%;">
   <div class="form-group">
      <div class="input-group">
        <span class="input-group-addon">选择或输入姓名</span>
        <select class="form-control">
            <option onclick="document.getElementById('name').value=''">自定义</option>
        <?php
            foreach ($data as $key => $value) {
                echo "<option onclick=\"document.getElementById('name').value='$value'\">$value</option>";
            }
        ?>
        </select>
      </div>
   </div>
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon">姓名</span>
            <input id="name" type="text" class="form-control" placeholder="请输入姓名" name="name" required/>
        </div>
    </div>
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon">小组</span>
            <input type="text" class="form-control" placeholder="请输入组" name="group" required/>
        </div>
    </div>
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon">分数</span>
            <input type="text" class="form-control" placeholder="请输入分数" name="score" required/>
        </div>
    </div>

    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon">备注</span>
            <input type="text" class="form-control" placeholder="请输入内容" name="text" required/>
        </div>
    </div>
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon">点评</span>
            <input type="text" class="form-control" placeholder="请输入内容" name="critique" required/>
        </div>
    </div>
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon">日期</span>
            <input type="text" class="form-control" placeholder="请输入时间" name="date" required/>
        </div>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">添加</button>
    </div>
</form>
<?php include("../public/footer.php");?>