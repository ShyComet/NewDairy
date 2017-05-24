<?php require_once('data/config.php'); ?><?php
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO `comment` (name, `date`, wzid, `comment`) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['pl_name'], "text"),
                       GetSQLValueString($_POST['pl_date'], "date"),
                       GetSQLValueString($_POST['pl_wzid'], "int"),
                       GetSQLValueString($_POST['pl_comment'], "text"));

  mysql_select_db($database_config, $config);
  $Result1 = mysql_query($insertSQL, $config) or die(mysql_error());

  $insertGoTo = "chapter.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_chapter = 1;
$pageNum_chapter = 0;
if (isset($_GET['pageNum_chapter'])) {
  $pageNum_chapter = $_GET['pageNum_chapter'];
}
$startRow_chapter = $pageNum_chapter * $maxRows_chapter;

$colname_chapter = "-1";
if (isset($_GET['id'])) {
  $colname_chapter = $_GET['id'];
}
mysql_select_db($database_config, $config);
$query_chapter = sprintf("SELECT * FROM sls_wz WHERE id = %s", GetSQLValueString($colname_chapter, "int"));
$query_limit_chapter = sprintf("%s LIMIT %d, %d", $query_chapter, $startRow_chapter, $maxRows_chapter);
$chapter = mysql_query($query_limit_chapter, $config) or die(mysql_error());
$row_chapter = mysql_fetch_assoc($chapter);

if (isset($_GET['totalRows_chapter'])) {
  $totalRows_chapter = $_GET['totalRows_chapter'];
} else {
  $all_chapter = mysql_query($query_chapter);
  $totalRows_chapter = mysql_num_rows($all_chapter);
}
$totalPages_chapter = ceil($totalRows_chapter/$maxRows_chapter)-1;

mysql_select_db($database_config, $config);
$query_system = "SELECT * FROM sls_system";
$system = mysql_query($query_system, $config) or die(mysql_error());
$row_system = mysql_fetch_assoc($system);
$totalRows_system = mysql_num_rows($system);

mysql_select_db($database_config, $config);
$query_new_mood = "SELECT * FROM sls_wz ORDER BY id DESC";
$new_mood = mysql_query($query_new_mood, $config) or die(mysql_error());
$row_new_mood = mysql_fetch_assoc($new_mood);
$totalRows_new_mood = mysql_num_rows($new_mood);

mysql_select_db($database_config, $config);
$query_new_chapter = "SELECT * FROM sls_wz ORDER BY id DESC";
$new_chapter = mysql_query($query_new_chapter, $config) or die(mysql_error());
$row_new_chapter = mysql_fetch_assoc($new_chapter);
$totalRows_new_chapter = mysql_num_rows($new_chapter);

$colname_pl = "-1";
if (isset($_GET['wzid'])) {
  $colname_pl = $_GET['wzid'];
}
mysql_select_db($database_config, $config);
$wzid =$row_chapter['id'];//是你当前文章的编号
$query_pl = sprintf("SELECT * FROM `comment` WHERE wzid = $wzid ORDER BY id DESC", GetSQLValueString($colname_pl, "int"));
$pl = mysql_query($query_pl, $config) or die(mysql_error());
$row_pl = mysql_fetch_assoc($pl);
$totalRows_pl = mysql_num_rows($pl);

$queryString_chapter = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_chapter") == false && 
        stristr($param, "totalRows_chapter") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_chapter = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_chapter = sprintf("&totalRows_chapter=%d%s", $totalRows_chapter, $queryString_chapter);
?>
<!DOCTYPE html>
<html lang = "zh-CN">
<head>
    <meta charset = "utf-8">
    <title><?php echo $row_chapter['name']; ?>—<?php echo $row_system['name']; ?>—<?php echo $row_system['Author']; ?></title>
<meta name = "keywords" content = "一部爱情史，一首人生曲">
    <meta name = "description" content = "一部爱情史，一首人生曲">
    <meta name = "author" content = "xiahuixin.com">
    <link href = "common/css/bootstrap.min.css" rel = "stylesheet">
    <link href = "common/css/bootstrap-responsive.min.css" rel = "stylesheet">
    <link href = "common/css/ptcms.css" rel = "stylesheet">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
    <link rel = "apple-touch-icon-precomposed" sizes = "144x144" href = "__PUBLIC__/image/144.png">
    <link rel = "apple-touch-icon-precomposed" sizes = "114x114" href = "__PUBLIC__/image/114.png">
    <link rel = "apple-touch-icon-precomposed" sizes = "72x72" href = "__PUBLIC__/image/72.png">
    <link rel = "apple-touch-icon-precomposed" href = "__PUBLIC__/image/57.png">
    <link rel = "shortcut icon" href = "{$pt.PT_DIR}/favicon.ico">
    <script type="text/javascript">var URL='__URL__',APP='__APP__',MODULE='__MODULE__',SELF='__SELF__';</script>
    <script type = "text/javascript" src = "public/script/jquery.min.js"></script>
    <script type = "text/javascript" src = "public/script/jquery.cookie.js"></script>
    <style type="text/css">
<!--
.STYLE3 {font-size: 20px}
.STYLE4 {color: #0066FF}
-->
    </style>
</head>
<script language="javascript" type="text/javascript" src="My97DatePicker/WdatePicker.js"></script>
<body>


<script type="text/javascript"> document.body.oncontextmenu=document.body.ondragstart= document.body.onselectstart=document.body.onbeforecopy=function(){return false;};
document.body.onselect=document.body.oncopy=document.body.onmouseup=function(){document.selection.empty();}; </script>
<?php
include "header.php"
?>
<div class = "container-fluid">
    <div class = "contentarea">
        <h2 class = "text-center red"><?php echo $row_chapter['name']; ?></h2>
        <div class = "adbox visible-phone">
        </div>
      <div class = "content">
      <?php echo $row_chapter['Content']; ?></div>
        <div class = "content">
          <div align="right">
              <table border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td>分享到：</td>
                  <td><div class="bshare-custom"><a title="分享到QQ空间" class="bshare-qzone"></a><a title="分享到新浪微博" class="bshare-sinaminiblog"></a><a title="分享到人人网" class="bshare-renren"></a><a title="分享到腾讯微博" class="bshare-qqmb"></a><a title="分享到网易微博" class="bshare-neteasemb"></a><a title="更多平台" class="bshare-more bshare-more-icon more-style-addthis"></a><span class="BSHARE_COUNT bshare-share-count">0</span></div><script type="text/javascript" charset="utf-8" src="http://static.bshare.cn/b/buttonLite.js#style=-1&amp;uuid=&amp;pophcol=2&amp;lang=zh"></script><script type="text/javascript" charset="utf-8" src="http://static.bshare.cn/b/bshareC0.js"></script></td>
                  <td><?php echo $row_chapter['date']; ?>更新</td>
                </tr>
            </table>
          </div>
        </div>
        <div class = "content">
          <div align="right">
              <table border="0" align="center" cellpadding="0" cellspacing="2">
                <tr>
                  <td>            <div>
 <?php
$cid =$row_chapter['id'];//是你当前文章的编号 
$sql_former = "select * from sls_wz where id<$cid order by id desc "; //上一篇文章sql语句。注意是倒序，因为返回结果集时只用了第一篇文章，而不是最后一篇文章 

$sql_later = "select * from sls_wz where id>$cid "; //下一篇文章sql语句 

$queryset_former = mysql_query($sql_former); //执行sql语句 

if(mysql_num_rows($queryset_former)){ //返回记录数，并判断是否为真，以此为依据显示结果 

$result = mysql_fetch_array($queryset_former); 

echo "<a class='btn' href='chapter.php?id=$result[id]'> ".上一章." ". $result['name']." </a><br>"; 

} else {echo "<a class='btn' href='chapter.php?id=$cid'> ".这里是第一章哦."</a><br>";} 
?>  </div></td>
                  <td>&nbsp;&nbsp;<a class="btn" href="index.php">回目录</a></td>
                  <td>&nbsp; <?php
$cid =$row_chapter['id'];//是你当前文章的编号 
$sql_former = "select * from sls_wz where id<$cid order by id desc "; //上一篇文章sql语句。注意是倒序，因为返回结果集时只用了第一篇文章，而不是最后一篇文章 

$sql_later = "select * from sls_wz where id>$cid "; //下一篇文章sql语句 

$queryset_later = mysql_query($sql_later); 

if(mysql_num_rows($queryset_later)){ 

$result = mysql_fetch_array($queryset_later); 

echo "<a class='btn' href='chapter.php?id=$result[id]'> ".下一章." ". $result['name']."</a><br>"; 

} 

else {echo "<a class='btn' href='chapter.php?id=$cid'> ".下一章还没写哦."</a><br>";} 
?> </td>
                </tr>
            </table>
          </div>
        </div>
    </div>
</div>
<div class = "container-fluid">
    <div class = "contentarea">
        <h2 class = "text-center red STYLE3">评论列表</h2>
        <div class = "adbox visible-phone">
        </div>
      <div class = "content">
<!-- UY BEGIN -->
<div id="uyan_frame"></div>
<script type="text/javascript" src="http://v2.uyan.cc/code/uyan.js?uid=1979039">
var uyan_config = {
     'title':'<?php echo $row_chapter['name']; ?>', 
     'url':'http://diary.xiahuixin.com/chapter.php?id=<?php echo $row_chapter['id']; ?>', 
};
</script>
<!-- UY END -->
</div>
        </div>
</div>
<?php
include "footer.php"
?>
</body>
</html>
<?php
mysql_free_result($chapter);

mysql_free_result($system);

mysql_free_result($new_mood);

mysql_free_result($new_chapter);

mysql_free_result($pl);
?>