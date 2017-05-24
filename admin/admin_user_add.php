<?php
  include("../data/config.php");
  $arr=user_shell($_SESSION[uid],$_SESSION[user_shell],1);//设置该页面只有权限为1时即最高权限的才能访问
  user_mktime($_SESSION[times]);//判断是否超时10秒
  //echo $_SESSION[times]."<br>";//登录时该的时间
  //echo mktime()."<br>";//当前日期
  //echo $arr[username]."<br>";
  //echo $arr[uid]."<br>";    
?>
<?php
  if($_POST['submit']){
  $username= str_replace(" ","", $_POST['username']);
  //echo $username."<br>";
  $password = md5($_POST['password'].ALL_PS);
  //echo $password."<br>";
  $m_id= str_replace(" ","", $_POST['m_id']);
  //echo $m_id."<br>";
  if (empty($username)){
	  echo "<script>alert('请输入用户名');location.href='admin_user_add.php'</script>";
	  exit();
	}else if(empty($password)){
		     echo "<script>alert('请输入密码');location.href='admin_user_add.php'</script>";
	         exit();
	       }else if(empty($m_id)){
			        echo "<script>alert('请输入用户权限');location.href='admin_user_add.php'</script>";
	                exit();
		   }
  $sql = "insert  into sls_admin(uid,username,password,m_id)  values('', '$username', '$password', '$m_id' ) ";
  $query = mysql_query($sql);
  //获得受影响的行数
  $row=mysql_affected_rows($config);
  if($row>0){
     echo "<script>alert('增加成功');location.href='admin_user.php'</script>";
	 exit();
  }else{
     echo "<script>alert('增加失败');location.href='admin_user_add.php'</script>";
	 exit;
   }  
  }
?>
<!DOCTYPE html>
<html lang = "zh-CN">
<head>
    <meta charset = "utf-8">
<title>增加管理员信息</title>
    <meta name = "keywords" content = "一部爱情史，一首人生曲">
    <meta name = "description" content = "曾经也有一个笑容出现在我的生命里，可是最后还是如雾般消散，而那个笑容，就成为我心中深深埋藏的一条湍急河流，无法泅渡，那河流的声音，就成为我每日每夜绝望的歌唱。 一个人总要走陌生的路，看陌生的风景，听陌生的歌，然后在某个不经意的瞬间，你会发现，原本费尽心机想要忘记的事情真的就这么忘记了。">
    <meta name = "author" content = "<?php echo $row_header_system['Introduction']; ?>">
    <link href = "../common/css/bootstrap.min.css" rel = "stylesheet">
    <link href = "../common/css/bootstrap-responsive.min.css" rel = "stylesheet">
    <link href = "../common/css/ptcms.css" rel = "stylesheet">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
<style type="text/css">
</style></head>
<script language="javascript" type="text/javascript" src="../source/My97DatePicker/WdatePicker.js"></script>
<body>
<?php
include "admin_header.php"
?>
<div class = "container-fluid">
    <div class = "chapterlist">
      <h2 class = "text-center">增加管理员信息</h2>
        <div class = "row-fluid">
  <div align="center">
    <form name="form1" method="POST" action="">
      <table border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><div align="left">管理帐号：<span class="STYLE1"></span></div></td>
          <td>
              <label>
              <input name="username" type="text" id="username" value="">
              </label>          </td>
        </tr>
        <tr>
          <td><div align="left">管理密码：<span class="STYLE1"></span></div></td>
          <td><label>
              <input name="password" type="password" id="passwd" value="">
              </label>          </td>
        </tr>
		<tr>
          <td><div align="left">管理权限：<span class="STYLE1"></span></div></td>
          <td>
              <label>
              <input name="m_id" type="text" id="m_id" value="">（1为超级管理员，2为普通会员）
              </label>          </td>
        </tr>
        <tr>
          <td colspan="2"><label>
            <div align="center">
              <input name="submit" type="submit" class="btn" id="button" value="增加信息">
            </div>
            </label></td>
          </tr>
      </table>
        <input type="hidden" name="MM_update" value="form1">
    </form>
    </div>
</div>
    </div>
</div>
<?php
include "../footer.php"
?>
</body>
</html>