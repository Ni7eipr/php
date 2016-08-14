<?php
$ROOTDIR = dirname($_SERVER['SCRIPT_NAME'])."/..";
include("../conf/dbconnect.php");
include("../public/header.php");
include("../public/function.php");

if (!isset($_SESSION['adminname']) /*&& isset($_COOKIE['admin'])*/){
    die(nomsg("呵呵呵呵！"));
}

# 获取参数页数
$id = get_value("id");

if (count($_POST) == 4) {
    $score = check_value($_POST["score"]);
    $text = check_value($_POST["text"]);
    $date = check_value($_POST["date"]);
    $critique = check_value($_POST["critique"]);
    $sql = "update score set score=\"$score\", text=\"$text\", date=\"$date\", critique=\"$critique\" where id = $id";
    $result = $conn->query($sql);
    if ($result) {
        okmsg("修改成功");
    } else {
        nomsg("不能为空");
    }
}

$sql = "SELECT * FROM score WHERE id=$id";
$row = get_sql_data($sql, array("score", "text", "date", "critique", "userid"));
$dataUser = $row[0];
?>
<form class="col-sm-3 col-sm-offset-4" action="" method="post" style="margin-top:15%;">
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon">分数</span>
            <input type="text" class="form-control" placeholder="请输入分数" name="score" value="<?php echo $dataUser["score"]; ?>" required autofocus/>
        </div>
    </div>
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon">内容</span>
            <input type="text" class="form-control" placeholder="请输入内容" name="text" value="<?php echo $dataUser["text"]; ?>" required/>
        </div>
    </div>
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon">日期</span>
            <input type="text" class="form-control" placeholder="请输入内容" name="date" value="<?php echo $dataUser["date"]; ?>" required/>
        </div>
    </div>
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon">点评</span>
            <input type="text" class="form-control" placeholder="请输入内容" name="critique" value="<?php echo $dataUser["critique"]; ?>" required/>
        </div>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary">修改</button>
    </div>
    <a href ="./detil.php?id=<?php echo $dataUser["userid"]; ?>" class="btn btn-info">返回</a>
</form>
<?php include("../public/footer.php");?>