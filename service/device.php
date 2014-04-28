<?php
session_start();
if($_SESSION['access']==1)
{


$boo=true;
$print=true;



	$user=$_GET['userid'];
	$content=$_GET['contentid'];
	$device=$_GET['device'];
	$countTem=0;
	
	$sql="select device,time from user ";
	
	//对于多个user进行查询
	if($user!="")
	{
		$userArr=explode(",",$user);
		$leng=count($userArr);
		$userSql=" ( userid='";
		
		for($i=0;$i<$leng-1;$i++)
		{
			$userSql=$userSql."$userArr[$i]' or userid='";
		}
		$i=$leng-1;
		
		$userSql=$userSql."$userArr[$i]' )";
		
		$sql=$sql.'where '.$userSql;
		
		$countTem=1;
		
	
	
	}
	
	//对于多个content进行查询
	if($content!="")
	{
		$contentArr=explode(",",$content);
		$leng=count($contentArr);
		$contentSql=" ( contentid='";
		
		for($i=0;$i<$leng-1;$i++)
		{
			$contentSql=$contentSql."$contentArr[$i]' or contentid='";
		}
		$i=$leng-1;
		
		$contentSql=$contentSql."$contentArr[$i]' )";
		
		if($countTem==0)
			$sql=$sql.'where '.$contentSql;
		else
			$sql=$sql.' and '.$contentSql;
	
	$countTem=1;
	
	}
	
	//对于多个device进行查询
	if($device!="")
	{
		$deviceArr=explode(",",$device);
		$leng=count($deviceArr);
		$deviceSql=" ( device='";
		
		for($i=0;$i<$leng-1;$i++)
		{
			$deviceSql=$deviceSql."$deviceArr[$i]' or device='";
		}
		$i=$leng-1;
		
		$deviceSql=$deviceSql."$deviceArr[$i]' )";
		
		if($countTem==0)
			$sql=$sql.'where '.$deviceSql;
		else
			$sql=$sql.' and '.$deviceSql;
	
	
	
	}
	
	
	
	
	
	$sql=$sql." order by time ";
	if($user=="" && $content=="" && $device=="" )
		$boo=false;

	
if($boo){
	
	include "connection.php";
	$re=mysql_query($sql,$con);

	$arr=array();



	$timestamp="";
	
	$num=array(0,0,0,0,0,0,0);//ipad iphone android ipod macos windows other
	

	$count=0;
	
	while($row = mysql_fetch_array($re))
	{
		$time=$row['time'];
		$device=$row['device'];
		
		
		
		
		if($time!=$timestamp)
		{
			$timestamp=$time;		
			$count=$count+1;
			$print=False;
			
			if($device=='ipad')
				$num[0]=$num[0]+1;
			else if($device=='iphone')
				$num[1]=$num[1]+1;
			else if($device=='android')
				$num[2]=$num[2]+1;
			else if($device=='ipod')
				$num[3]=$num[3]+1;
			else if($device=='macos')
				$num[4]=$num[4]+1;
			else if($device=='windows')
				$num[5]=$num[5]+1;
			else 
				$num[6]=$num[6]+1;
			
			
			
			
			

		}
		else
			continue;
		
		
		
		
		
		
	}	
	
	if($num[0]!=0)
				$arr[]=array('ipad',(float)$num[0]/(float)$count);
	if($num[1]!=0)
				$arr[]=array('iphone',(float)$num[1]/(float)$count);
	if($num[2]!=0)
				$arr[]=array('android',(float)$num[2]/(float)$count);
	if($num[3]!=0)
				$arr[]=array('ipod',(float)$num[3]/(float)$count);
	if($num[4]!=0)
				$arr[]=array('macos',(float)$num[4]/(float)$count);
	if($num[5]!=0)
				$arr[]=array('windows',(float)$num[5]/(float)$count);
	if($num[6]!=0)
				$arr[]=array('other',(float)$num[6]/(float)$count);
				


		
		
	
	mysql_close($con);

		
		
	
	
	if($print==false)
	{
		$result=json_encode($arr);
		//echo $_GET['callback'].'("Hello,World!")';
		//echo $_GET['callback']."($result)";
		//动态执行回调函数
		$callback=$_GET['callback'];
		echo $callback."($result)";
	}
}
}
?>
