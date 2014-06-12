<?php

session_start();


	  //-------------提取搜索条件----------------------------------

$reResult = $_POST['selectResult'];
$scopeTop = $_POST['scopeTop'];
$scopeEnd = $_POST['scopeEnd'];
$switchTop = $_POST['switchTop'];
$switchEnd = $_POST['switchEnd'];
$switchBefore = $_POST['switchBefore'];
$switchAfter = $_POST['switchAfter'];
$rateScope = $_POST['rateScope'];
$reR = explode(",",$reResult);


$condition="";

if ($reResult != null)
{

	//$re 0表示device 1表示video type 2表示switch type 3表示next switch type

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

	if($reR[2] != "all"){

		if( $condition !="")
			$condition .= " and bs_type = '".$reR[2]."'";
		else
			$condition .= " bs_type = '".$reR[2]."'";

	}
	if($reR[3] != "all"){

		if( $condition !="")
			$condition .= " and next_bs_type = '".$reR[3]."'";
		else
			$condition .= " next_bs_type = '".$reR[3]."'";

	}

	if($condition != "")
		$condition .=" and play_percents between ".$scopeTop." and ".$scopeEnd;
	else
		$condition .=" play_percents between ".$scopeTop." and ".$scopeEnd;

	if($condition != "")
		$condition .=" and bs_chunk_percent between ".$switchTop." and ".$switchEnd;
	else
		$condition .=" bs_chunk_percent between ".$switchTop." and ".$switchEnd;

	if($switchBefore !="all")
		$condition .=" and from_bitrate=".$switchBefore;

	if($switchAfter != "all")
		$condition .= " and to_bitrate=".$switchAfter;

	if($rateScope != "all")
		$condition .= " and bs_change_value=".$rateScope;




if($condition !="")
{
  $condition ="where ".$condition;

}


}

	  //------------提取结束------------------------------------

	      $sql="select play_percents from bitrate_type  ".$condition;
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
        		$rate=(float)$row['play_percents']/100;

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
