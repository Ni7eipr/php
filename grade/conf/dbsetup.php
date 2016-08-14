<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
$DB_USER = 'root';
$DB_PWD = '123444';
$DB_HOST = 'localhost';
$DB_NAME = 'SC0RE_B0ARD';

$adminname = 'admin';
$adminpass = md5(md5('admin'));

@$conn =new mysqli($DB_HOST,$DB_USER,$DB_PWD) or die("<font color='red'>连接失败</br></font>");
@!$conn->select_db($DB_NAME)               or die("<font color='red'>数据库已存在</br><a href ='../index.php'>确定</a></font>");
@$conn->query("CREATE DATABASE `".$DB_NAME."`")     or die("<font color='red'>创建数据库失败</br></font>");
                                                echo "<font color='green'>创建数据库成功</br></font>";

$sql="CREATE TABLE `".$DB_NAME."`.`users`(
      `id` int(3)NOT NULL AUTO_INCREMENT,
      `name` varchar(100) NOT NULL,
      `group` int(2) NOT NULL,
      PRIMARY KEY (`id`))";
@$conn->query($sql) or die("<font color='red'>创建用户表失败</br></font>"); echo "<font color='green'>创建用户表成功</br></font>";

$sql="CREATE TABLE `".$DB_NAME."`.`score`(
      `id` int(3)NOT NULL AUTO_INCREMENT,
      `text` varchar(30) NOT NULL,
      `critique` varchar(500) NOT NULL,
      `date` varchar(10) NOT NULL,
      `score` int(3) NOT NULL,
      `userid` int(3) NOT NULL,
      PRIMARY KEY (`id`))";
@$conn->query($sql) or die("<font color='red'>创建分数表失败</br></font>"); echo "<font color='green'>创建分数表成功</br></font>";

$sql="CREATE TABLE `".$DB_NAME."`.`admin`(
      `id` int(3)NOT NULL AUTO_INCREMENT,
      `adminname` varchar(30) NOT NULL,
      `password` varchar(32) NOT NULL,
      PRIMARY KEY (`id`))";
@$conn->query($sql) or die("<font color='red'>创建管理员表失败</br></font>"); echo "<font color='green'>创建管理员表成功</br></font>";

$sql="INSERT INTO `".$DB_NAME."`.`admin` (adminname, password)
      VALUES (\"$adminname\", \"$adminpass\")";
@$conn->query($sql) or die("<font color='red'>插入初始管理员失败</br></font>"); echo "<font color='green'>插入初始管理员成功</br></font>";

@$conn->close($conn);
?><a href ='../index.php'>确定</a>
