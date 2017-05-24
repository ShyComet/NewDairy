<?php
include("data/config.php");
$lockfile = "data/install.lock";
if(file_exists($lockfile)){    
  exit("已经安装过了，如果要重新安装请先删除install.lock");    
  }   
$sql=file_get_contents("data/diary.sql"); //把SQL语句以字符串读入$sql 
$a=explode(";",$sql); //用explode()函数把?$sql字符串以“;”分割为数组 

foreach($a as $b){ //遍历数组 
$c=$b.";"; //分割后是没有“;”的，因为SQL语句以“;”结束，所以在执行SQL前把它加上 
mysql_query($c); //执行SQL语句 
  $fp2 = fopen($lockfile, 'w');   
  fwrite($fp2,'1212');    
  fclose($fp2);   
}
  $username='theone';
  $sql="select * from sls_admin where `username`='$username'";
  $query=mysql_query($sql);
  $us=is_array($row=mysql_fetch_array($query));
  $ps=$us ? md5('theone'.ALL_PS)==$row[password] : FALSE;
  if($ps){
	$_SESSION[uid]=$row[uid];
	$_SESSION[user_shell]=md5($row[username].$row[password].ALL_PS);
	$_SESSION[times]=mktime();//取得登录时忘该的时间
	echo "<script>alert('请设置系统信息');location.href='admin/index.php'</script>";
  }else{
	echo "数据库导入错误";
	exit();
	session_destroy();//密码错误时消除所有的session
  }
?>