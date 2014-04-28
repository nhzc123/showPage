<?php





	$sql="select startTime,rate from summary  order by startTime limit 0,100000 ";
	echo date('Y-m-d H:i:s',time());
	include "connection.php";
	$re=mysql_query($sql,$con);
	echo date('Y-m-d H:i:s',time());
	$arr=array();



	$timestamp="";

	//计算一个小时内的平均CDF
	$startTime=0;
	$count=1;
	$sumRate=0;
  $endTime=0;
	$boo = 1;
	while($row = mysql_fetch_array($re))
	{
		$time=$row['startTime'];
		$rate=$row['rate'];

    if($boo ==1)
    {
      $boo =0;
      $count=1;
      $startTime = $time."000";
      $endTime =(float)($time+3600);
	  $sumRate = (float)$rate;
    }
    else
    {
      if($time > $endTime)
	  {
       	$tem = array((float)$startTime,$sumRate/$count);
	   	$arr[]=$tem;
		$count=1;
		$startTime = $time."000";
		$endTime =(float)($time+3600);
		$sumRate = (float)$rate;
	  }
	  else
	  {
		$count++;
		$sumRate = (float)$rate+$sumRate;
	  }

    }


	}

		$tem = array((float)$startTime,$sumRate/$count);
		$arr[]=$tem;

	echo date('Y-m-d H:i:s',time());


	mysql_close($con);

		$result=json_encode($arr);
		//echo $_GET['callback'].'("Hello,World!")';
		//echo $_GET['callback']."($result)";
		//动态执行回调函数
		$callback=$_GET['callback'];
		echo $callback."($result)";


	echo date('Y-m-d H:i:s',time());
?>
