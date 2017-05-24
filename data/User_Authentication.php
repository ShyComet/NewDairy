<?php
  session_start();
  //定义常量
  define(ALL_ps,"WLYUN2015");
  //查看登录状态与权限
  function user_shell($uid,$shell,$m_id){
	  $sql="select * from sls_admin where `uid`='$uid'";
	  $query=mysql_query($sql);
	  $us=is_array($row=mysql_fetch_array($query));
	  $shell=$us ? $shell==md5($row[username].$row[password].ALL_PS):FALSE;
	  if($shell){
		if($row[m_id]<=$m_id){//$row[m_id]越小权限越高，为1时权限最高
		  return $row;
		}else{
			echo "<script>alert('你的权限不足,不能查看该页面');location.href='../index.php'</script>";
			exit();
			}
	  }else{
		  echo "<script>alert('登录后才能查看该页');location.href='../admin/login.php'</script>";
		  exit();
	   }
	  }
	  //设置登录超时
	  function user_mktime($onlinetime){
		  $new_time=mktime();
		  //echo $new_time-$onlinetime."秒未操作该页面"."<br>";
		  if($new_time-$onlinetime>'900'){//设置超时时间为10秒，测试用
    		echo "<script>alert('登录超时,请重新登录');location.href='../admin/login.php'</script>";
			exit();
			session_destroy();
		  }else{
			$_SESSION[times]=mktime();
		  }
		}
?>