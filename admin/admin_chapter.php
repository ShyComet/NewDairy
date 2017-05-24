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
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_admin_chapter = 10;
$pageNum_admin_chapter = 0;
if (isset($_GET['pageNum_admin_chapter'])) {
  $pageNum_admin_chapter = $_GET['pageNum_admin_chapter'];
}
$startRow_admin_chapter = $pageNum_admin_chapter * $maxRows_admin_chapter;

mysql_select_db($database_config, $config);
$query_admin_chapter = "SELECT * FROM `sls_wz` ORDER BY id DESC";
$query_limit_admin_chapter = sprintf("%s LIMIT %d, %d", $query_admin_chapter, $startRow_admin_chapter, $maxRows_admin_chapter);
$admin_chapter = mysql_query($query_limit_admin_chapter, $config) or die(mysql_error());
$row_admin_chapter = mysql_fetch_assoc($admin_chapter);

if (isset($_GET['totalRows_admin_chapter'])) {
  $totalRows_admin_chapter = $_GET['totalRows_admin_chapter'];
} else {
  $all_admin_chapter = mysql_query($query_admin_chapter);
  $totalRows_admin_chapter = mysql_num_rows($all_admin_chapter);
}
$totalPages_admin_chapter = ceil($totalRows_admin_chapter/$maxRows_admin_chapter)-1;

$queryString_admin_chapter = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_admin_chapter") == false && 
        stristr($param, "totalRows_admin_chapter") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_admin_chapter = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_admin_chapter = sprintf("&totalRows_admin_chapter=%d%s", $totalRows_admin_chapter, $queryString_admin_chapter);
?>
<!DOCTYPE html>
<html lang = "zh-CN">
<head>
<meta charset = "utf-8">
<title>查看所有章节</title>
    <meta name = "keywords" content = "一部爱情史，一首人生曲">
    <meta name = "description" content = "曾经也有一个笑容出现在我的生命里，可是最后还是如雾般消散，而那个笑容，就成为我心中深深埋藏的一条湍急河流，无法泅渡，那河流的声音，就成为我每日每夜绝望的歌唱。 一个人总要走陌生的路，看陌生的风景，听陌生的歌，然后在某个不经意的瞬间，你会发现，原本费尽心机想要忘记的事情真的就这么忘记了。">
    <meta name = "author" content = "ptcms.com">
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
.STYLE2 {color: #FF0000}
.STYLE3 {color: #0066FF}
-->
</style></head>
<script language="javascript" type="text/javascript" src="../source/My97DatePicker/WdatePicker.js"></script>
<body>
<?php
include "admin_header.php"
?>
<div class = "container-fluid">
    <div class = "chapterlist">
      <h2 class = "text-center">查看所有章节</h2>
        <div class = "row-fluid">
  <div align="center">
    <form name="form1" method="POST">
      <table border="0" align="center" cellpadding="0" cellspacing="3">
        <tr>
          <td width="131"><div align="center">章节序号</div></td>
          <td width="157"><div align="center">章节名称</div></td>
          <td width="149"><div align="center">发表时间</div></td>
          <td width="46"><div align="center">修改</div></td>
        </tr>
        <?php do { ?>
          <table border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td>          <td width="131"><div align="center" class="STYLE3"><?php echo $row_admin_chapter['id']; ?></div></td>
              <td width="157"><div align="center" class="STYLE3"><a href="../chapter.php?id=<?php echo $row_admin_chapter['id']; ?>" target="_blank"><?php echo $row_admin_chapter['name']; ?></a></div></td>
              <td width="149"><div align="center" class="STYLE3"><?php echo $row_admin_chapter['date']; ?></div></td>
              <td width="46"><div align="center"><a href="admin_chapter_editor.php?id=<?php echo $row_admin_chapter['id']; ?>" class="STYLE2">修改</a></div></td></td>
      </tr>
              </table>
          <?php } while ($row_admin_chapter = mysql_fetch_assoc($admin_chapter)); ?></table>
      
        <p>&nbsp;
          <?php if ($pageNum_admin_chapter > 0) { // Show if not first page ?>
            <a class="btn" href="<?php printf("%s?pageNum_admin_chapter=%d%s", $currentPage, 0, $queryString_admin_chapter); ?>">第一页</a>
            <?php } // Show if not first page ?>
          <?php if ($pageNum_admin_chapter > 0) { // Show if not first page ?>
            <a class="btn" href="<?php printf("%s?pageNum_admin_chapter=%d%s", $currentPage, max(0, $pageNum_admin_chapter - 1), $queryString_admin_chapter); ?>">前一页</a>
            <?php } // Show if not first page ?>
          <?php if ($pageNum_admin_chapter < $totalPages_admin_chapter) { // Show if not last page ?>
            <a class="btn" href="<?php printf("%s?pageNum_admin_chapter=%d%s", $currentPage, min($totalPages_admin_chapter, $pageNum_admin_chapter + 1), $queryString_admin_chapter); ?>">下一页</a>
            <?php } // Show if not last page ?>
          <?php if ($pageNum_admin_chapter < $totalPages_admin_chapter) { // Show if not last page ?>
  <a class="btn" href="<?php printf("%s?pageNum_admin_chapter=%d%s", $currentPage, $totalPages_admin_chapter, $queryString_admin_chapter); ?>">最后一页</a>
  <?php } // Show if not last page ?>
</p>
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
<?php
mysql_free_result($admin_chapter);
?>