<?php require_once('data/config.php'); ?>
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

mysql_select_db($database_config, $config);
$query_system = "SELECT * FROM sls_system";
$system = mysql_query($query_system, $config) or die(mysql_error());
$row_system = mysql_fetch_assoc($system);
$totalRows_system = mysql_num_rows($system);

mysql_select_db($database_config, $config);
$query_chapter = "SELECT * FROM sls_wz";
$chapter = mysql_query($query_chapter, $config) or die(mysql_error());
$row_chapter = mysql_fetch_assoc($chapter);
$totalRows_chapter = mysql_num_rows($chapter);

$maxRows_new_chapter = 6;
$pageNum_new_chapter = 0;
if (isset($_GET['pageNum_new_chapter'])) {
  $pageNum_new_chapter = $_GET['pageNum_new_chapter'];
}
$startRow_new_chapter = $pageNum_new_chapter * $maxRows_new_chapter;

mysql_select_db($database_config, $config);
$query_new_chapter = "SELECT * FROM sls_wz ORDER BY id DESC";
$query_limit_new_chapter = sprintf("%s LIMIT %d, %d", $query_new_chapter, $startRow_new_chapter, $maxRows_new_chapter);
$new_chapter = mysql_query($query_limit_new_chapter, $config) or die(mysql_error());
$row_new_chapter = mysql_fetch_assoc($new_chapter);

if (isset($_GET['totalRows_new_chapter'])) {
  $totalRows_new_chapter = $_GET['totalRows_new_chapter'];
} else {
  $all_new_chapter = mysql_query($query_new_chapter);
  $totalRows_new_chapter = mysql_num_rows($all_new_chapter);
}
$totalPages_new_chapter = ceil($totalRows_new_chapter/$maxRows_new_chapter)-1;
?><!DOCTYPE html>
<html lang = "zh-CN">
<head>
<meta property="qc:admins" content="55006674612160110510166375" />
    <meta charset = "utf-8">
    <title><?php echo $row_system['name']; ?>—<?php echo $row_system['Author']; ?></title>
    <meta name = "keywords" content = "一部爱情史，一首人生曲">
    <meta name = "description" content = "曾经也有一个笑容出现在我的生命里，可是最后还是如雾般消散，而那个笑容，就成为我心中深深埋藏的一条湍急河流，无法泅渡，那河流的声音，就成为我每日每夜绝望的歌唱。 一个人总要走陌生的路，看陌生的风景，听陌生的歌，然后在某个不经意的瞬间，你会发现，原本费尽心机想要忘记的事情真的就这么忘记了。">
    <meta name = "author" content = "ptcms.com">
    <link href = "common/css/bootstrap.min.css" rel = "stylesheet">
    <link href = "common/css/bootstrap-responsive.min.css" rel = "stylesheet">
    <link href = "common/css/ptcms.css" rel = "stylesheet">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
    <link rel = "shortcut icon" href="favicon.ico" type="image/x-icon" />
    <link rel = "apple-touch-icon-precomposed" sizes = "144x144" href = "__PUBLIC__/image/144.png">
    <link rel = "apple-touch-icon-precomposed" sizes = "114x114" href = "__PUBLIC__/image/114.png">
    <link rel = "apple-touch-icon-precomposed" sizes = "72x72" href = "__PUBLIC__/image/72.png">
    <link rel = "apple-touch-icon-precomposed" href = "__PUBLIC__/image/57.png">
    <link rel = "shortcut icon" href = "{$pt.PT_DIR}/favicon.ico">
    <script type="text/javascript">var URL='__URL__',APP='__APP__',MODULE='__MODULE__',SELF='__SELF__';</script>
    <script type = "text/javascript" src = "source/public/script/jquery.min.js"></script>
    <script type = "text/javascript" src = "source/public/script/jquery.cookie.js"></script>
</head>
<body>


<script type="text/javascript"> document.body.oncontextmenu=document.body.ondragstart= document.body.onselectstart=document.body.onbeforecopy=function(){return false;};
document.body.onselect=document.body.oncopy=document.body.onmouseup=function(){document.selection.empty();}; </script>
<a class="bshareDiv" href="http://www.bshare.cn/share">分享按钮</a><script type="text/javascript" charset="utf-8" src="http://static.bshare.cn/b/buttonLite.js#uuid=&amp;style=3&amp;fs=4&amp;textcolor=#fff&amp;bgcolor=#19D&amp;text=分享到"></script>
<?php
include "header.php"
?>
 <div class = "container-fluid">
    <div class = "chapterlist">
        <h2 class = "text-center"> <?php echo $row_system['name']; ?> 最新章节</h2>
<div class = "row-fluid">

              <?php do { ?>
                <div class = "span4 item"{if $i.col==1} style="margin-left:0"{/if}><a href="chapter.php?id=<?php echo $row_new_chapter['id']; ?>"><?php echo $row_new_chapter['name']; ?></a></div>
                <?php } while ($row_new_chapter = mysql_fetch_assoc($new_chapter)); ?></div>
      <div style="clear:both"></div>
        <h2 class = "text-center"> <?php echo $row_system['name']; ?> 章节目录</h2>
  <div class = "row-fluid">
    <?php do { ?>
      <div class = "span4 item"{if $i.col==1} style="margin-left:0"{/if}><a href="chapter.php?id=<?php echo $row_chapter['id']; ?>"><?php echo $row_chapter['name']; ?></a></div>
      <?php } while ($row_chapter = mysql_fetch_assoc($chapter)); ?></div>
    </div>
</div>
<?php
include "footer.php"
?>
</body>
</html>
<?php
mysql_free_result($system);

mysql_free_result($chapter);

mysql_free_result($new_chapter);
?>