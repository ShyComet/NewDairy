<?php require_once('data/config.php'); ?>
<?php
     include("counter.php")
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

mysql_select_db($database_config, $config);
$query_sls_system = "SELECT * FROM sls_system";
$sls_system = mysql_query($query_sls_system, $config) or die(mysql_error());
$row_sls_system = mysql_fetch_assoc($sls_system);
$totalRows_sls_system = mysql_num_rows($sls_system);
?><footer class = "footer">
    <div class = "container">
        <p>                                                                    <!--下划线-->
         <font>你是第</font>
        <B>
             <font>
             <?php Counter() ?>                                                 <!--调用函数-->
            </font>
       </B>
        <font>个访问者</font>
         </p>
        <p>Copyright © 2014-2014  <a href="index.php"><?php echo $row_sls_system['name']; ?></a> All Rights Reserved .版权所有 <a href="http://www.xiahuixin.com"><?php echo $row_sls_system['Author']; ?></a>。</p>
    </div>
</footer>
<div style="display:none">{$pt.getad.tongji}</div>
<div id = "backTop"><a href = "#top" title = "返回顶部"></a></div>
<script type = "text/javascript" src = "source/public/plugin/layer/layer.js"></script>
<script type = "text/javascript" src = "source/public/script/pt.common.js"></script>
<script type = "text/javascript">
    function sign(){
        $.get(MODULE+'/ajax/sign',function(data){
            if (data.status==1){
                layer.msg(data.info, 2, 1);
            }else{
                layer.msg(data.info, 2, 3);
            }
        })
    }
</script>
<?php
mysql_free_result($sls_system);
?>
