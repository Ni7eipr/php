<?php
$DB_USER = 'root';
$DB_PWD = '123444';
$DB_HOST = 'localhost';
$DB_NAME = 'SC0RE_B0ARD';
$conn=new mysqli($DB_HOST,$DB_USER,$DB_PWD) or die("<meta charset=\"UTF-8\"><font color='red'>连接失败</br></font>");
$conn->select_db($DB_NAME)               or die("<meta charset=\"UTF-8\"><font color='red'>数据连接失败<br><a href ='$ROOTDIR/conf/dbsetup.php'>创建数据库</a></font>");
@$conn->query("SET NAMES 'utf8'") or die("<meta charset=\"UTF-8\"><font color='red'>设置字符失败</br></font>");
?>