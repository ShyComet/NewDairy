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
 $cid=1;
 $query_pindex = "SELECT * FROM sls_system where `id`='$cid'";
 $pindex = mysql_query($query_pindex, $config) or die(mysql_error());
 $row_pindex = mysql_fetch_assoc($pindex);
 $totalRows_pindex = mysql_num_rows($pindex);
 $query_wz = "SELECT * FROM sls_wz ORDER BY id DESC LIMIT 0,3";
 $wz = mysql_query($query_wz, $config) or die(mysql_error());
 $row_wz = mysql_fetch_assoc($wz);
 $totalRows_wz = mysql_num_rows($wz);
?>
<!DOCTYPE html>
<html lang = "zh-CN">
<head>
    <meta charset = "utf-8">
<title>系统信息</title>
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
include("admin_header.php");
?>
<div class = "container-fluid">
    <div class = "chapterlist">
      <h2 class = "text-center">系统信息</h2>
        <div class = "row-fluid">
  <div align="center">
    <table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><div align="left">小说名称：<span class="STYLE1"><?php echo $row_pindex['name']; ?></span></div></td>
        <td><div align="left">小说作者：<span class="STYLE1"><?php echo $row_pindex['Author']; ?></span></div></td>
        </tr>
      <tr>
        <td colspan="2"><div align="left">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td>小说简介：<span class="STYLE1"><?php echo $row_pindex['Introduction']; ?></span></td>
            </tr>
          </table>
        </div></td>
        </tr>
      <tr>
        <td><div align="left">管理编号：<span class="STYLE1"><?php echo $arr[uid];?></span></div></td>
        <td><div align="left">管理帐号：<span class="STYLE1"><?php echo $arr[username];?></span></div></td>
        </tr>
      <tr>
        <td colspan="2"><div align="left">最新三章：
            <?php do { ?>
              <a href="../chapter.php?id=<?php echo $row_wz['id']; ?>" target="_blank" class="STYLE1"><?php echo $row_wz['name']; ?></a>
            <?php } while ($row_wz = mysql_fetch_assoc($wz)); ?>
        </div></td>
        </tr>
    </table>
  </div>
</div>
    </div>
</div>
<?php
include("../footer.php");
?>
</body>
</html>
