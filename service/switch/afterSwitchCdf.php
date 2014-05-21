<?php

session_start();


	  //-------------提取搜索条件----------------------------------

$reResult = $_POST['selectResult'];
$reUserResult = $_POST['userResult'];
$reServerResult = $_POST['serverResult'];
$scopeTop = $_POST['scopeTop'];
$scopeEnd = $_POST['scopeEnd'];
$uLo = explode(" ",$reUserResult);
$sLo = explode(" ",$reServerResult);
$reR = explode(" ",$reResult);

$condition="";

if ($reResult != null)
{

	//$re 0表示device 1表示video type  2表示userISP 3表示serverISP

	if($reR[0]!="all")
	{
		$condition.=" deviceType ='".$reR[0]."'";
	}
//	$condition = "where device = ' ".$re[0]. "'  and  videoType = ' " .$re[1]."'  and switchingTime = ' ".$re[3]."'  ";

	if($reR[1]!="all")
	{
		if($condition !="")
			$condition .=" and videoType = '".$reR[1]."'";
		else
			$condition .=" videoType = '".$reR[1]."'";
	}


	if($reR[2]!="all")
	{
		if($condition !="")
			$condition .=" and uISP = '".$reR[2]."'";
		else
			$condition .=" uISP = '".$reR[2]."'";
	}

	if($reR[3]!="all")
	{
		if($condition !="")
			$condition .=" and sISP = '".$reR[3]."'";
		else
			$condition .=" sISP = '".$reR[3]."'";
	}

	if($reR[4]!="all")
	{
		if($condition !="")
			$condition .=" and switchType = '".$reR[4]."'";
		else
			$condition .=" switchType = '".$reR[4]."'";
	}
		if($condition !="")
			$condition .=" and switchPercent between ".$scopeTop." and ".$scopeEnd;
		else
			$condition .="switchPercent between ".$scopeTop." and ".$scopeEnd;
//如果uLocation有参数
	if($reUserResult!="all")
	{
		$uLeng = count($uLo);

		if($condition !="")
				$condition .=" and uLocation in ('".$uLo[0]."'";
		else

				$condition .="uLocation in ('".$uLo[0]."'";
		for($i=1;$i<$uLeng;$i++)
			$condition .=",'".$uLo[$i]."'";

		$condition .=") ";

	}

//如果sLocation有参数
	if($reServerResult!="all")
	{
		$sLeng = count($sLo);

		if( $condition !="")
			$condition .=" and sLocation in ('".$sLo[0]."'";
		else
			$condition .=" sLocation in ('".$sLo[0]."'";

		for($i=1;$i<$sLeng;$i++)
			$condition .=",'".$sLo[$i]."'";

		$condition .=") ";

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
