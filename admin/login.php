<?php
  include("../data/config.php");
  if($_POST[submit]){
  $username=str_replace(" ","","$_POST[username]");
  $sql="select * from sls_admin where `username`='$username'";
  $query=mysql_query($sql);
  $us=is_array($row=mysql_fetch_array($query));
  $ps=$us ? md5($_POST[password].ALL_PS)==$row[password] : FALSE;
  if($ps){
	$_SESSION[uid]=$row[uid];
	$_SESSION[user_shell]=md5($row[username].$row[password].ALL_PS);
	$_SESSION[times]=mktime();//取得登录时忘该的时间
	echo "<script>alert('登陆成功');location.href='index.php'</script>";
  }else{
	echo "<script>alert('用户名或密码错误');location.href='login.php'</script>";
	session_destroy();//密码错误时消除所有的session
  }
 }
?>
<!DOCTYPE html>
<html lang = "zh-CN">
<head>
    <meta charset = "utf-8">
    <title>管理登录</title>
    <meta name = "keywords" content = "一部爱情史，一首人生曲">
    <meta name = "description" content = "曾经也有一个笑容出现在我的生命里，可是最后还是如雾般消散，而那个笑容，就成为我心中深深埋藏的一条湍急河流，无法泅渡，那河流的声音，就成为我每日每夜绝望的歌唱。 一个人总要走陌生的路，看陌生的风景，听陌生的歌，然后在某个不经意的瞬间，你会发现，原本费尽心机想要忘记的事情真的就这么忘记了。">
    <meta name = "author" content = "<?php echo $row_header_system['Author']; ?>">
    <link href = "../common/css/bootstrap.min.css" rel = "stylesheet">
    <link href = "../common/css/bootstrap-responsive.min.css" rel = "stylesheet">
    <link href = "../common/css/ptcms.css" rel = "stylesheet">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"><style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.STYLE1 {
	font-size: 18px;
	color: #0066FF;
}
-->
</style></head>
<body>
<?php
include("admin_header.php");
?>
<div class = "container-fluid">
    <div class = "chapterlist">
        <h2 class = "text-center">管理登录<?php //echo md5("admin".ALL_PS); ?></h2>
<div class = "row-fluid">
<form method="POST" action="">
  <div align="center">
    <table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><div align="left" class="STYLE1">用户名</div></td>
        <td><input type="text" name="username" ></td>
      </tr>
      <tr>
        <td><div align="left" class="STYLE1">密&nbsp;&nbsp;&nbsp;码</div></td>
        <td><input type="password" name="password"></td>
      </tr>
        <td colspan="2"><div class = "text-center"><input class="btn btn-success btn-large" type="submit" name="submit" value="登录"></div></td>
        </tr>
    </table>
    </div>
</form></div>
      <div style="clear:both"></div>
      <div class = "row-fluid"> </div>
    </div>
</div>
<?php
include("../footer.php");
?>
</body>
</html>