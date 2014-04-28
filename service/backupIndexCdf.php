<?php
session_start();
if($_SESSION['access']==1)
{


$type=$_GET['type'];



$boo=true;
$print=true;// print or no

 
//type 1 for home, 2 for user, 3 for content , 4 for context

if($type==1)
	$sql="select time,rate from user  order by time";
else if($type==2)
{
	$user=$_GET['userid'];
	$content=$_GET['contentid'];
	$device=$_GET['device'];
	$countTem=0;
	
	$sql="select time,rate from user ";
	
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
}



else if($type==3)
{
	$content=$_GET['contentid'];
	echo $content;
	$sql="select time,rate from user where contentid='$content' order by time";
	echo $sql;
	if($content=="")
		$boo=false;
}
else if($type==4)
{
	$device=$_GET['device'];
	$sql="select time,rate from user where device='$device' order by time";
	if($device=="")
		$boo=false;
}
	
if($boo){
	include "connection.php";
	$re=mysql_query($sql,$con);

	$arr=array();



	$timestamp="";
	
	//计算一个小时内的平均CDF
	$startTime=0;
	$count=1;
	$sumRate=0;
	$sTime="";

	while($row = mysql_fetch_array($re))
	{
		$time=$row['time'];
		$rate=$row['rate'];
		
		$leng2=strlen($rate);
			
			$fRate="";
			
			if($leng2>=5)
			{	
				$fRate=$rate[0].$rate[1].$rate[2].$rate[3].$rate[4];
			
			}
			else
				$fRate=$rate[0];
		
		
		if($startTime==0)
		{
		
			$leng=strlen($time);
			
			for($i=0;$i<$leng-2;$i++)
			{
				$sTime=$sTime.$time[$i];
			}
			$sTime=$sTime."000";
			$startTime=(float)$time+3600;
			$count=1;
			$sumRate=0;
		}
		
		
		if($time!=$timestamp)
		{
			$timestamp=$time;		
			$leng=strlen($time);
			
			
			$fTime="";
			
			for($i=0;$i<$leng-2;$i++)
			{
				$fTime=$fTime.$time[$i];
			}
			$fTime=$fTime."000";
			
			$leng2=strlen($rate);
			
			$fRate="";
			
			if($leng2>=5)
			{	
				$fRate=$rate[0].$rate[1].$rate[2].$rate[3].$rate[4];
			
			}
			else
				$fRate=$rate[0];
				
				
				
			if($startTime<(float)$time)
			{
				$tem=array((float)$sTime,(((float)$sumRate)/$count));
			
				$arr[]=$tem;
				$startTime=(float)$time+3600;
				$count=1;
				$sumRate=(float)$fRate;
				$sTime=$fTime;
			}
			else
			{
				$count=$count+1;
				$sumRate=$sumRate+(float)$fRate;
				
			}
			$print=false;

		}
		else
			continue;
		
		
		
		
		
		
	}	


		
		
	
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
