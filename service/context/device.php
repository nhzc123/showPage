<?php


	session_start();






//获得搜索条件----------


$reResult = $_POST['selectResult'];
$reUserResult = $_POST['userResult'];
$reServerResult = $_POST['serverResult'];
$uLo = explode(" ",$reUserResult);
$sLo = explode(" ",$reServerResult);
$reR = explode(" ",$reResult);

$type=$_POST['type'];
$condition="";
//echo $reResult;



if($type ==2){

      $callback=$_GET['callback'];
	  $result=$_SESSION['deviceContext'];
			echo $callback."($result)";
}
else{
	//$re 0表示device 1表示video type 2表示bitrate 3表示TranslationTime 4表示userISP 5表示serverISP

	if($reR[0]!="all")
	{
		$condition.=" device ='".$reR[0]."'";
	}
//	$condition = "where device = ' ".$re[0]. "'  and  videoType = ' " .$re[1]."'  and switchingTime = ' ".$re[3]."'  ";

	if($reR[1]!="all")
	{
		if($condition !="")
			$condition .=" and videoType = '".$reR[1]."'";
		else
			$condition .=" videoType = '".$reR[1]."'";
	}

	if($reR[3]!="all")
	{
		if($condition !="")
			$condition .=" and switchingTime = '".$reR[3]."'";
		else
			$condition .=" switchingTime = '".$reR[3]."'";
	}

	if($reR[4]!="all")
	{
		if($condition !="")
			$condition .=" and uISP = '".$reR[4]."'";
		else
			$condition .=" uISP = '".$reR[4]."'";
	}

	if($reR[5]!="all")
	{
		if($condition !="")
			$condition .=" and sISP = '".$reR[5]."'";
		else
			$condition .=" sISP = '".$reR[5]."'";
	}

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

  $conditionBitRate = $condition;

	if($reR[2]!="all")
	{
	if($condition !="")
			$condition .= " and ".$reR[2]." != 0";
		else
			$condition .= $reR[2]." != 0 ";
}



if($condition !="")
{
  $condition ="where ".$condition;

}






//---------------------

      	include "../../connection.php";

//查询device信息
$sql ="select device,count(*) from summary ".$condition."  group by device";

$re = mysql_query($sql,$con);
$deviceName =array();
$count=0;
while($row = mysql_fetch_row($re))
{
  $name = $row[0];
  $num = $row[1];
  $deviceName[$count]=$name;
  $tem=array("value"=>$num,"name"=>$name);
  $deviceValue[$count]=$tem;
  $count++;
}
			$result=json_encode(array("name"=>$deviceName,"deviceValue"=>$deviceValue));
      $callback=$_GET['callback'];
	  $_SESSION['deviceContext']=$result;
			echo $callback."($result)";
}
?>
