<?php
include("data/config.php");
$lockfile = "data/install.lock";
if(file_exists($lockfile)){    
  exit("�Ѿ���װ���ˣ����Ҫ���°�װ����ɾ��install.lock");    
  }   
$sql=file_get_contents("data/diary.sql"); //��SQL������ַ�������$sql 
$a=explode(";",$sql); //��explode()������?$sql�ַ����ԡ�;���ָ�Ϊ���� 

foreach($a as $b){ //�������� 
$c=$b.";"; //�ָ����û�С�;���ģ���ΪSQL����ԡ�;��������������ִ��SQLǰ�������� 
mysql_query($c); //ִ��SQL��� 
  $fp2 = fopen($lockfile, 'w');   
  fwrite($fp2,'1212');    
  fclose($fp2);   
}
  $username='theone';
  $sql="select * from sls_admin where `username`='$username'";
  $query=mysql_query($sql);
  $us=is_array($row=mysql_fetch_array($query));
  $ps=$us ? md5('theone'.ALL_PS)==$row[password] : FALSE;
  if($ps){
	$_SESSION[uid]=$row[uid];
	$_SESSION[user_shell]=md5($row[username].$row[password].ALL_PS);
	$_SESSION[times]=mktime();//ȡ�õ�¼ʱ���õ�ʱ��
	echo "<script>alert('������ϵͳ��Ϣ');location.href='admin/index.php'</script>";
  }else{
	echo "���ݿ⵼�����";
	exit();
	session_destroy();//�������ʱ�������е�session
  }
?>