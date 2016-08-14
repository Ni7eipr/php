<meta charset="UTF-8">
<?php
$DB_USER = 'root';
$DB_PWD = '123444';
$DB_HOST = 'localhost';
$DB_NAME = 'database';
$con=mysqli_connect($DB_HOST,$DB_USER,$DB_PWD) or die("<font color='red'>连接失败</br></font>");
mysqli_select_db($con,$DB_NAME)               or die("<font color='red'>数据连接失败<br><a href ='./conf/dbsetup.php'>创建数据库</a></font>");

?>