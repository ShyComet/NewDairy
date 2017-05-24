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
$query_header_system = "SELECT * FROM sls_system ORDER BY id DESC";
$header_system = mysql_query($query_header_system, $config) or die(mysql_error());
$row_header_system = mysql_fetch_assoc($header_system);
$totalRows_header_system = mysql_num_rows($header_system);

mysql_select_db($database_config, $config);
$query_header_chapter = "SELECT * FROM sls_wz ORDER BY id DESC";
$header_chapter = mysql_query($query_header_chapter, $config) or die(mysql_error());
$row_header_chapter = mysql_fetch_assoc($header_chapter);
$totalRows_header_chapter = mysql_num_rows($header_chapter);
?><header class = "jumbotron subhead ">
      <link rel = "shortcut icon" href="favicon.ico" type="image/x-icon" />
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
<style> 
p#socialicons img{ /* 1st set of icons. Rotate them 360deg onmouseover and out */ 
-moz-transition: all 0.8s ease-in-out; 
-webkit-transition: all 0.8s ease-in-out; 
-o-transition: all 0.8s ease-in-out; 
-ms-transition: all 0.8s ease-in-out; 
transition: all 0.8s ease-in-out; 
} 
p#socialicons img:hover{ 
-moz-transform: rotate(360deg); 
-webkit-transform: rotate(360deg); 
-o-transform: rotate(360deg); 
-ms-transform: rotate(360deg); 
transform: rotate(360deg); 
} 
</style>

<div class = "container">
          <div class = "text-center"><p id="socialicons"><img class="img-circle" src="../images/images_header.jpg" alt="Generic placeholder image" width="220" height="220"></p></div>
        <h1 class = "text-center"><a href="index.php" title="<?php echo $row_header_system['name']; ?>" target="_blank"><?php echo $row_header_system['name']; ?></a></h1>
    <p class = "lead hidden-phone"><?php echo $row_header_system['Introduction']; ?><br/><br/></p>
  <p class="text-center">
            <a href = "<?php echo $row_header_system['websiteurl']; ?>" class = "btn btn-primary btn-large"><?php echo $row_header_system['Author']; ?> 官网</a>&nbsp;&nbsp;&nbsp;&nbsp;
            <a href = "http://<?php echo $row_header_system['QQ']; ?>.qzone.qq.com" class = "btn btn-success btn-large"><?php echo $row_header_system['Author']; ?> QQ空间</a>
            <br/>
            <br/>
作者最新心情：      <?php echo $row_header_chapter['mood']; ?></p>
  </div>
</header>
<?php
mysql_free_result($header_system);

mysql_free_result($header_chapter);
?>
