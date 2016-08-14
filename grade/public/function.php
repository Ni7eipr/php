<?php
function nomsg($msg) {
  echo <<<end
<div id="myAlert" class="alert alert-warning container">
   <a href="#" class="close" data-dismiss="alert">&times;</a>
   <strong>警告！</strong>{$msg}。
</div>
end;
}

function okmsg($msg) {
  echo <<<end
<div id="myAlert" class="alert alert-success container">
   <a href="#" class="close" data-dismiss="alert">&times;</a>
   <strong>成功！</strong>{$msg}。
</div>
end;
}

function check_value($value) {
    global $conn;
    return htmlspecialchars($conn->real_escape_string($value));
}

function checkPost($arrayName) {
    foreach ($arrayName as $value) {
        if (isset($_POST[$value])) {
            $data[$value] = check_value($_POST[$value]);
        } else {
            die(nomsg("呵呵呵呵！"));
        }
    }
    return $data;
}

function get_value($getValue) {
    if (!isset($_GET[$getValue]) or !is_numeric($_GET[$getValue])) {
        die(nomsg("呵呵呵呵！"));
    } else {
        $getValue = check_value($_GET[$getValue]);
    }
    return $getValue;
}

function get_page($sql) {
    global $conn;
    global $ROOTDIR;
    $result = $conn->query($sql);
    $totalnum = $result->num_rows;
    if ($totalnum == 0) {
      include($_SERVER["DOCUMENT_ROOT"].$ROOTDIR."/public/footer.php");
      die(nomsg("暂无数据"));
    }
    $pagenum=ceil($totalnum/10);

    if (empty($_GET["page"])) {
        $_GET["page"] = 1;
    }
    $nowpage = check_value($_GET["page"]);
    if (!is_numeric($nowpage) or $nowpage > $pagenum) {
        die(nomsg("呵呵呵呵！"));
    }
    return array("nowpage" => $nowpage, "pagenum" => $pagenum);
}

function get_sql_data($sql,$arrayName) {
    global $conn;
    $data = array();
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) {
        foreach ($arrayName as $value) {
          $dataValue[$value] = $row[$value];
        }
        array_push($data, $dataValue);
    }
    return $data;
}

function pageList($arrayName,$nowPage,$pageNum) {
  $dataKey = key($arrayName);
  $getValue1 = $dataKey.".php?page=";
  $getValue2 = "";
  foreach ($arrayName[$dataKey] as $key => $value) {
      $getValue2 = "&".$key."=".$value;

  }
  echo "<center><ul class=\"pagination\">";
      $prPageNum = $nowPage-1;
      $afPageNum = $nowPage+1;
      if ($nowPage==1) {
        echo "<li class='disabled'><a>&laquo;</a></li>";
      } else {
        echo "<li><a href='".$getValue1.$prPageNum.$getValue2."'>&laquo;</a></li>";
      }

      for ($i=1; $i <= $pageNum; $i++) {
        if ($nowPage==$i) {
          echo "<li class='active'><a href='".$getValue1.$i.$getValue2."'>$i</a></li>";
        } else {
          echo "<li><a href='".$getValue1.$i.$getValue2."'>$i</a></li>";
        }
      }

      if ($nowPage==$pageNum || $pageNum==0) {
        echo "<li class='disabled'><a>&raquo;</a></li>";
      } else {
        echo "<li><a href='".$getValue1.$afPageNum.$getValue2."'>&raquo;</a></li>";
      }
  echo "</ul></center>";
}
?>