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
 $id = 1;
 $query_pindex = "SELECT * FROM sls_system where `id`='$id'";
 $pindex = mysql_query($query_pindex, $config) or die(mysql_error());
 $row_pindex = mysql_fetch_assoc($pindex);
 $totalRows_pindex = mysql_num_rows($pindex);
?>
<?php
  if($_POST['submit']){
  $name= str_replace(" ","", $_POST['name']);
  //echo $name."<br>";
  $Author= $_POST['Author'];
  //echo $Author."<br>";
  $Introduction= str_replace(" ","", $_POST['Introduction']);
  //echo $Introduction."<br>";
  $QQ= $_POST['QQ'];
  //echo $QQ."<br>";
  $websiteurl= $_POST['websiteurl'];
  //echo $websiteurl."<br>";
  if (empty($name)){
	  echo "<script>alert('请输入网站名称');location.href='admin_system_info.php'</script>";
	  exit();
    }else if(empty($Author)){
		     echo "<script>alert('请输入作者名称');location.href='admin_system_info.php'</script>";
	         exit();
	       }else if(empty($Introduction)){
			        echo "<script>alert('请输入网站简介');location.href='admin_system_info.php'</script>";
	                exit();
		          }else if(empty($QQ)){
			               echo "<script>alert('请输入作者QQ');location.href='admin_system_info.php'</script>";
	                       exit();
				         }else if(empty($websiteurl)){
							      echo "<script>alert('请输入作者官网');location.href='admin_system_info.php'</script>";
	                              exit();
						        }
  $sql = "update sls_system set `name`='$name',`Introduction`='$Introduction',`Author`='$Author',`QQ`='$QQ',`websiteurl`='$websiteurl' where `id`='$id'";
  $query = mysql_query($sql);
  //获得受影响的行数
  $row=mysql_affected_rows($config);
  if($row>0){
     echo "<script>alert('修改成功');location.href='admin_system_info.php'</script>";
	 exit();
  }else{
     echo "<script>alert('修改失败');location.href='admin_system_info.php'</script>";
	 exit;
   }  
  }
?>
<!DOCTYPE html>
<html lang = "zh-CN">
<head>
<meta charset = "utf-8">
<title>修改系统信息</title>
    <meta name = "keywords" content = "一部爱情史，一首人生曲">
    <meta name = "description" content = "曾经也有一个笑容出现在我的生命里，可是最后还是如雾般消散，而那个笑容，就成为我心中深深埋藏的一条湍急河流，无法泅渡，那河流的声音，就成为我每日每夜绝望的歌唱。 一个人总要走陌生的路，看陌生的风景，听陌生的歌，然后在某个不经意的瞬间，你会发现，原本费尽心机想要忘记的事情真的就这么忘记了。">
    <meta name = "author" content = "ShyComet">
    <link href = "../common/css/bootstrap.min.css" rel = "stylesheet">
    <link href = "../common/css/bootstrap-responsive.min.css" rel = "stylesheet">
    <link href = "../common/css/ptcms.css" rel = "stylesheet">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.STYLE1 {color: #0066FF}
-->
</style></head>
<script language="javascript" type="text/javascript" src="../source/My97DatePicker/WdatePicker.js"></script>
<body>
<?php
include "admin_header.php"
?>
<div class = "container-fluid">
    <div class = "chapterlist">
      <h2 class = "text-center">修改系统信息</h2>
        <div class = "row-fluid">
  <div align="center">
    <form action="" name="form1" method="POST">
      <table border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><div align="left">网站名称：<span class="STYLE1"></span></div></td>
          <td>
              <label>
              <input name="name" type="text" id="name" value="<?php echo $row_pindex['name']; ?>">
              </label>          </td>
        </tr>
        <tr>
          <td><div align="left">网站作者：<span class="STYLE1"></span></div></td>
          <td><label>
              <input name="Author" type="text" id="Author" value="<?php echo $row_pindex['Author']; ?>">
              </label>          </td>
        </tr>
        <tr>
          <td>网站简介：</td>
          <td><label>
            <textarea name="Introduction" id="Introduction" cols="45" rows="5"><?php echo $row_pindex['Introduction']; ?></textarea>
          </label></td>
        </tr>
		<tr>
          <td><div align="left">作者QQ：<span class="STYLE1"></span></div></td>
          <td>
              <label>
              <input name="QQ" type="text" id="QQ" value="<?php echo $row_pindex['QQ']; ?>">
              </label>          </td>
        </tr>
		<tr>
          <td><div align="left">作者官网：<span class="STYLE1"></span></div></td>
          <td>
              <label>
              <input name="websiteurl" type="text" id="websiteurl" value="<?php echo $row_pindex['websiteurl']; ?>">
              </label>          </td>
        </tr>
        <tr>
          <td colspan="2"><label>
            <div align="center">
              <input name="submit" type="submit" class="btn" id="button" value="修改信息">
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