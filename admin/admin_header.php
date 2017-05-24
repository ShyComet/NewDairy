<?php require_once('../data/config.php'); ?>
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
$query_header_system = "SELECT * FROM sls_system ORDER BY id DESC";
$header_system = mysql_query($query_header_system, $config) or die(mysql_error());
$row_header_system = mysql_fetch_assoc($header_system);
$totalRows_header_system = mysql_num_rows($header_system);

mysql_select_db($database_config, $config);
$query_header_chapter = "SELECT * FROM sls_wz ORDER BY id DESC";
$header_chapter = mysql_query($query_header_chapter, $config) or die(mysql_error());
$row_header_chapter = mysql_fetch_assoc($header_chapter);
$totalRows_header_chapter = mysql_num_rows($header_chapter);
?>
<header class = "jumbotron subhead ">
      <p class = "lead"><script language="javascript">
var week; 
if(new Date().getDay()==0)          week="星期日"
if(new Date().getDay()==1)          week="星期一"
if(new Date().getDay()==2)          week="星期二" 
if(new Date().getDay()==3)          week="星期三"
if(new Date().getDay()==4)          week="星期四"
if(new Date().getDay()==5)          week="星期五"
if(new Date().getDay()==6)          week="星期六"
document.write("今天是"+new Date().getFullYear()+"年"+(new Date().getMonth()+1)+"月"+new Date().getDate()+"日 "+week);
</script><script type="text/javascript" src="http://ext.weather.com.cn/87973.js"></script></p>
    <div class = "container">
        <h1 class = "text-center"><a href="index.php" title="<?php echo $row_header_system['name']; ?>"><?php echo $row_header_system['name']; ?></a></h1>
      <p class = "lead hidden-phone"><?php echo $row_header_system['Introduction']; ?><br/><br/></p>

  <p class="text-center hidden-phone">
            <a href = "index.php" class = "btn btn-success btn-large">系统信息</a>&nbsp;&nbsp;&nbsp;&nbsp;
            <a href = "admin_system_info.php" class = "btn btn-primary btn-large">系统设置</a>&nbsp;&nbsp;&nbsp;&nbsp;
            <a href = "admin_user.php" class = "btn btn-success btn-large">管理列表</a>&nbsp;&nbsp;&nbsp;&nbsp;
            <a href = "admin_user_add.php" class = "btn btn-primary btn-large">增加管理</a>&nbsp;&nbsp;&nbsp;&nbsp;
			<a href = "admin_chapter.php" class = "btn btn-success btn-large">修改章节</a>&nbsp;&nbsp;&nbsp;&nbsp;
            <a href = "admin_chapter_add.php" class = "btn btn-primary btn-large">发表章节</a>
      <br/>
            <br/>
作者最新心情：      <?php echo $row_header_chapter['mood']; ?></p>
  </div>
</header>
<?php
mysql_free_result($header_system);

mysql_free_result($header_chapter);
?>
