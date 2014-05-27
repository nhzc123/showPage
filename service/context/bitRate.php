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
	  $result=$_SESSION['bitRateContext'];
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

//查询bitRate种类

//查询s1,s2,s3,s4,s5,s6,s7


if($reR[2]=="s7" || $reR[2] =="all")
{


  $sql = "select count(*) from summary where s7 != 0";

  if($conditionBitRate!="")
    $sql = $sql." and ".$conditionBitRate;


  $re = mysql_query($sql,$conn);
  $s7="";
  while($row = mysql_fetch_row($re))
  {
   $s7=$row[0];
  }
}
else
{
  $s7="0";
}
//-----------------------
if($reR[2]=="s6" || $reR[2] =="all")
{


  $sql = "select count(*) from summary where s6 != 0";

  if($conditionBitRate!="")
    $sql = $sql." and ".$conditionBitRate;


  $re = mysql_query($sql,$conn);
  $s6="";
  while($row = mysql_fetch_row($re))
  {
   $s6=$row[0];
  }
}
else
{
  $s6="0";
}
//-----------------------
if($reR[2]=="s5" || $reR[2] =="all")
{


  $sql = "select count(*) from summary where s5 != 0";

  if($conditionBitRate!="")
    $sql = $sql." and ".$conditionBitRate;


  $re = mysql_query($sql,$conn);
  $s5="";
  while($row = mysql_fetch_row($re))
  {
   $s5=$row[0];
  }
}
else
{
  $s5="0";
}
//-----------------------
if($reR[2] =="s4"|| $reR[2]=="all")
{

  $sql = "select count(*) from summary where s4 != 0";

  if($conditionBitRate!="")
    $sql = $sql." and ".$conditionBitRate;

  $re = mysql_query($sql,$conn);

  $s4="";

  while($row = mysql_fetch_row($re))

  {
    $s4=$row[0];
  }

}
else
{
  $s4 ="0";
}

if($reR[2]=="s3" ||$reR[2]=="all")
{

  $sql = "select count(*) from summary where s3 != 0";

  if($conditionBitRate!="")
    $sql = $sql." and ".$conditionBitRate;


  $re = mysql_query($sql,$conn);
  $s3="";
  while($row = mysql_fetch_row($re))
  {
   $s3=$row[0];
  }
}
else
{
  $s3="0";
}

if($reR[2]=="s2" ||$reR[2]=="all")
{

  $sql = "select count(*) from summary where s2 != 0";

  if($conditionBitRate!="")
    $sql = $sql." and ".$conditionBitRate;


  $re = mysql_query($sql,$conn);
  $s2="";
  while($row = mysql_fetch_row($re))
  {
   $s2=$row[0];
  }
}
else
{
  $s2="0";
}

if($reR[2]=="s1" || $reR[2] =="all")
{


  $sql = "select count(*) from summary where s1 != 0";

  if($conditionBitRate!="")
    $sql = $sql." and ".$conditionBitRate;


  $re = mysql_query($sql,$conn);
  $s1="";
  while($row = mysql_fetch_row($re))
  {
   $s1=$row[0];
  }
}
else
{
  $s1="0";
}
//-----------------------

$bitRateArray=array();
$count=0;
$tem=array("value"=>$s1,"name"=>"s1");
$bitRateArray[$count++]=$tem;
$tem=array("value"=>$s2,"name"=>"s2");
$bitRateArray[$count++]=$tem;
$tem=array("value"=>$s3,"name"=>"s3");
$bitRateArray[$count++]=$tem;
$tem=array("value"=>$s4,"name"=>"s4");
$bitRateArray[$count++]=$tem;
$tem=array("value"=>$s5,"name"=>"s5");
$bitRateArray[$count++]=$tem;
$tem=array("value"=>$s6,"name"=>"s6");
$bitRateArray[$count++]=$tem;
$tem=array("value"=>$s7,"name"=>"s7");
$bitRateArray[$count++]=$tem;
			$result=json_encode(array("bitRateArray"=>$bitRateArray));
      $callback=$_GET['callback'];
	  $_SESSION['bitRateContext']=$result;
			echo $callback."($result)";
}
?>
