<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$DB_USER = 'root';
$DB_PWD = '123444';
$DB_HOST = 'localhost';
$DB_NAME = 'database';

$adminname = 'adminmin';
$adminpass = md5(md5('adminmin'));

@$con=mysqli_connect($DB_HOST,$DB_USER,$DB_PWD) or die("<font color='red'>连接失败</br></font>");
@!mysqli_select_db($con,$DB_NAME)               or die("<font color='red'>数据库已存在</br><a href ='../index.php'>确定</a></font>");
@mysqli_query($con,"CREATE DATABASE `database` CHARACTER SET `utf8`")     or die("<font color='red'>创建数据库失败</br></font>");
                                                echo "<font color='green'>创建数据库成功</br></font>";
$sql="CREATE TABLE `database`.`users`(
      `id` int(3)NOT NULL AUTO_INCREMENT,
      `username` varchar(30) NOT NULL,
      `password` varchar(32) NOT NULL,
      PRIMARY KEY (`id`))";
@mysqli_query($con,$sql) or die("<font color='red'>创建用户表失败</br></font>"); echo "<font color='green'>创建用户表成功</br></font>";

$sql="CREATE TABLE `database`.`admin`(
      `id` int(3)NOT NULL AUTO_INCREMENT,
      `adminname` varchar(30) NOT NULL,
      `password` varchar(32) NOT NULL,
      PRIMARY KEY (`id`))";
@mysqli_query($con,$sql) or die("<font color='red'>创建管理员表失败</br></font>"); echo "<font color='green'>创建管理员表成功</br></font>";


$sql="CREATE TABLE `database`.`news`(
      `id` int(3)NOT NULL AUTO_INCREMENT,
      `title` varchar(50) NOT NULL,
      `news` varchar(1000) NOT NULL,
      `date` char(18) NOT NULL,
      PRIMARY KEY (`id`))";
@mysqli_query($con,$sql) or die("<font color='red'>创建news表失败</br></font>"); echo "<font color='green'>创建news表成功</br></font>";

$sql="CREATE TABLE `database`.`img`(
      `id` int(3)NOT NULL AUTO_INCREMENT,
      `img` varchar(50) NOT NULL,
      `newsid` int(3) NOT NULL,
      PRIMARY KEY (`id`))";
@mysqli_query($con,$sql) or die("<font color='red'>创建img表失败</br></font>"); echo "<font color='green'>创建img表成功</br></font>";

$sql="CREATE TABLE `database`.`comm`(
      `id` int(3)NOT NULL AUTO_INCREMENT,
      `username` varchar(30) NOT NULL,
      `newsid` int(3) NOT NULL,
      `text` varchar(100) NOT NULL,
      `date` char(18) NOT NULL,
      PRIMARY KEY (`id`))";
@mysqli_query($con,$sql) or die("<font color='red'>创建comm表失败</br></font>"); echo "<font color='green'>创建comm表成功</br></font>";

$sql="INSERT INTO `database`.`admin` (adminname, password)
      VALUES (\"$adminname\", \"$adminpass\")";
@mysqli_query($con,$sql) or die("<font color='red'>插入初始管理员失败</br></font>"); echo "<font color='green'>插入初始管理员成功</br></font>";

$sql="INSERT INTO `database`.`news` (id,title, news)
      VALUES (999,\"例子标题\", \"欢迎欢迎欢迎欢迎欢迎欢迎欢迎\")";//var_dump(mysqli_error($con));
@mysqli_query($con,$sql) or die("<font color='red'>插入初始new失败</br></font>"); echo "<font color='green'>插入初始new成功</br></font>";

$sql="INSERT INTO `database`.`img` (newsid, img)
      VALUES (999, \"1111.jpg\")";
@mysqli_query($con,$sql) or die("<font color='red'>插入初始img失败</br></font>"); echo "<font color='green'>插入初始img成功</br></font>";


/*$sql = "ALTER TABLE `database`.`news` ADD FOREIGN KEY (id) REFERENCES `database`.`comm` (newsid)";
@mysqli_query($con,$sql) or die("<font color='red'>外键1失败</br></font>"); echo "<font color='green'>外键2成功</br></font>";

$sql = "ALTER TABLE `database`.`news` ADD FOREIGN KEY (id) REFERENCES `database`.`img` (newsid)";
@mysqli_query($con,$sql) or die("<font color='red'>外键1失败</br></font>"); echo "<font color='green'>外键2成功</br></font>";*/

@mysqli_close($conn);
?><a href ='../index.php'>确定</a>
