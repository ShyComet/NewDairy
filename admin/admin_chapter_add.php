﻿<?php
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
  $name= str_replace(" ","", $_POST['name']);
  //echo $name."<br>";
  $content= $_POST['content'];
  //echo $content."<br>";
  $date= date('Y-m-d H:i:s',time());
  //echo $date."<br>";
  $mood= str_replace(" ","", $_POST['mood']);
  //echo $mood."<br>";
  if (empty($name)){
	  echo "<script>alert('请输入章节名称');location.href='admin_chapter_add.php'</script>";
	  exit();
	}else if(empty($content)){
		     echo "<script>alert('请输入章节内容');location.href='admin_chapter_add.php'</script>";
	         exit();
	       }else if(empty($mood)){
			        echo "<script>alert('请输入今日心情');location.href='admin_chapter_add.php'</script>";
	                exit();
		   }
  $sql = "insert  into sls_wz(id,name,content,date,mood)  values('', '$name', '$content', '$date', '$mood' ) ";
  $query = mysql_query($sql);
  //获得受影响的行数
  $row=mysql_affected_rows($config);
  if($row>0){
     echo "提交成功<a href='admin_chapter.php'>返回管理</a>";
	 exit();
  }else{
     echo "提交失败<a href='admin_chapter_add.php'>继续发布</a>";
	 exit;
   }  
  }
?>
<!DOCTYPE html>
<html lang = "zh-CN">
<head>
    <meta charset = "utf-8">
    <title>发表新的章节</title>
    <meta name = "keywords" content = "一部爱情史，一首人生曲">
    <meta name = "description" content = "曾经也有一个笑容出现在我的生命里，可是最后还是如雾般消散，而那个笑容，就成为我心中深深埋藏的一条湍急河流，无法泅渡，那河流的声音，就成为我每日每夜绝望的歌唱。 一个人总要走陌生的路，看陌生的风景，听陌生的歌，然后在某个不经意的瞬间，你会发现，原本费尽心机想要忘记的事情真的就这么忘记了。">
    <meta name = "author" content = "ShyComet">
    <link href = "../common/css/bootstrap.min.css" rel = "stylesheet">
    <link href = "../common/css/bootstrap-responsive.min.css" rel = "stylesheet">
    <link href = "../common/css/ptcms.css" rel = "stylesheet">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
    <script type = "text/javascript" src = "../source/public/script/jquery.min.js"></script>
    <script type = "text/javascript" src = "../source/public/script/jquery.cookie.js"></script>
	<link rel="stylesheet" href="../source/themes/default/default.css" />
	<link rel="stylesheet" href="../source/plugins/code/prettify.css" />
	<script charset="utf-8" src="../source/plugins/code/prettify.js"></script>
	<script charset="utf-8" src="../editor/kindeditor-min.js"></script>
		<script charset="utf-8" src="../editor/lang/zh_CN.js"></script>
		<script>
		KindEditor.ready(function(K) {
			var editor1 = K.create('textarea[name="content"]', {
				cssPath : '../source/plugins/code/prettify.css',
				uploadJson : '../editor/php/upload_json.php',
				fileManagerJson : '../editor/php/file_manager_json.php',
				allowFileManager : true,
				afterCreate : function() {
					var self = this;
					K.ctrl(document, 13, function() {
						self.sync();
						K('form[name=example]')[0].submit();
					});
					K.ctrl(self.edit.doc, 13, function() {
						self.sync();
						K('form[name=example]')[0].submit();
					});
				}
			});
			prettyPrint();
		});
	</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"><style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style></head>
<script language="javascript" type="text/javascript" src="../source/My97DatePicker/WdatePicker.js"></script>
<body>
<?php
include("admin_header.php");
?>
<div class = "container-fluid">
    <div class = "chapterlist">
        <h2 class = "text-center">发表新章节</h2>
<div class = "row-fluid">	<?php echo $htmlData; ?>
	<form name="example" method="POST" action="">
	  <p>章节名称
		  <label>
		  <input type="text" name="name" id="name">
		  </label>
		</p>
		<p>章节内容</p>
		<p>
		<textarea name="content" style="width:700px;height:200px;visibility:hidden;"><?php echo htmlspecialchars($htmlData); ?></textarea>
		</p>
		<p>今日心情
          <label>
		  <input type="text" name="mood" id="mood">
		  </label>
		</p>
		  <input class="btn" type="submit" name="submit" value="提交内容" />   
		</p>
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