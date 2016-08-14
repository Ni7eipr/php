<?php
function outmsg($msg,$collor){
  echo <<<end
  <center>
    <h1 style="font-size: 65px;text-shadow: $collor 5px 3px 3px;margin-top: 15%">$msg</h1>
  </center>
end;
}

function reoutmsg($msg,$collor,$url){
  echo <<<end
  <center>
    <h1 style="font-size: 65px;text-shadow: $collor 5px 3px 3px;margin-top: 15%">$msg</h1><br>
    <a href =$url class="btn btn-info btn-lg">确定</a>
  </center>
end;
}

function diemsg($msg,$url){
  echo <<<end
  <center>
      <h1 style="font-size: 65px;text-shadow: red 5px 3px 3px;margin-top: 15%">$msg</h1><br>
      <a href =$url class="btn btn-danger btn-lg">确定</a>
   </center>
end;
die();
}
?>