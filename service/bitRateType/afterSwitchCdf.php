<?php

session_start();


	  //-------------提取搜索条件----------------------------------

$reResult = $_POST['selectResult'];
$scopeTop = $_POST['scopeTop'];
$scopeEnd = $_POST['scopeEnd'];
$reR = explode(",",$reResult);


$condition="";

if ($reResult != null)
{

	//$re 0表示device 1表示video type

	if($reR[0]!="all")
	{
		$condition.=" device ='".$reR[0]."'";
	}

	if($reR[1]!="all")
	{
		if($condition !="")
			$condition .=" and video_type = '".$reR[1]."'";
		else
			$condition .=" video_type = '".$reR[1]."'";
	}




if($condition !="")
{
  $condition ="where ".$condition;

}


}

	  //------------提取结束------------------------------------

	      $sql="select switchPercent from switchingData  ".$condition;
//echo $sql;

      	include "../../connection.php";
      	$re=mysql_unbuffered_query($sql,$con);
      	$totalNum=array();
		$sum = 0;

		for($i=0;$i<11;$i++)
			$totalNum[$i]=0;


      while($row = mysql_fetch_array($re))
         {
			 	$sum++;
        	//	$time=$row['startTime'];
        		$rate=(float)$row['switchPercent']/100;

				if($rate >1)
					$rate = 1;

				if($rate==0)
					$totalNum[0]++;
				else if($rate>0&&$rate<=0.1)
					$totalNum[1]++;
				else if($rate>0.1 && $rate<=0.2)
					$totalNum[2]++;
				else if($rate>0.2 && $rate<=0.3)
					$totalNum[3]++;
				else if($rate>0.3 && $rate<=0.4)
					$totalNum[4]++;
				else if($rate>0.4 && $rate<=0.5)
					$totalNum[5]++;
				else if($rate>0.5 && $rate<=0.6)
					$totalNum[6]++;
				else if($rate>0.6 && $rate<=0.7)
					$totalNum[7]++;
				else if($rate>0.7 && $rate<=0.8)
					$totalNum[8]++;
				else if($rate>0.8 && $rate<=0.9)
					$totalNum[9]++;
				else if($rate>0.9 && $rate<=1)
					$totalNum[10]++;


		 }

	  for($i=0;$i<10;$i++)
		  $totalNum[$i+1]+=$totalNum[$i];

//	  echo $totalNum[10]."///".$sum."///";
	  if($sum!=0)
	  for($i=0;$i<11;$i++)
		  $totalNum[$i]=($totalNum[$i]/$sum)*100;
//	$totalNum=array(0,15 , 24 , 38 , 50 , 52 , 67 , 78 , 82 , 98 , 100);

	$result=json_encode($totalNum);
    $callback=$_GET['callback'];
	echo $callback."($result)";



?>
