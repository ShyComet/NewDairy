<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_config = "";//数据库地址
$database_config = "";//数据库名称
$username_config = "";//数据库用户
$password_config = "";//数据库密码
$config = mysql_pconnect($hostname_config, $username_config, $password_config) or die ("你的数据库连接错误");
          mysql_select_db($database_config,$config);
          mysql_query("set names utf8");  // 解决中文乱码
		  include("User_Authentication.php");
?>