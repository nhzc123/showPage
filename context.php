<?php
session_start();
if($_SESSION['access']==1)
{
require_once (dirname(__FILE__) . '/app.php');

//$boo 为0 第一次访问 $boo 为1 已经有参数传递过来了

$boo = 0;
$reResult = $_POST['selectResult'];
$reUserResult = $_POST['userResult'];
$reServerResult = $_POST['serverResult'];
$uLo = explode(" ",$reUserResult);
$sLo = explode(" ",$reServerResult);
$reR = explode(" ",$reResult);

$condition="";

//如果是第一次进入则$reResult为空
if ($reResult != null)
{

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
	if($reUserResult!=null)
	{
		$uLeng = count($uLo);

		if($condition !="")
				$condition .=" and uLocation in ('".$uLo[0]."'";
		else

				$condition .="uLocation in ('".$uLo[0]."'";
		for($i=1;$i<$uLeng;$i++)
			$condition .=",' ".$uLo[$i]."'";

		$condition .=") ";

	}

//如果sLocation有参数
	if($reServerResult!=null)
	{
		$sLeng = count($sLo);

		if( $condition !="")
			$condition .=" and sLocation in ('".$sLo[0]."'";
		else
			$condition .=" sLocation in ('".$sLo[0]."'";

		for($i=1;$i<$sLeng;$i++)
			$condition .=",' ".$sLo[$i]."'";

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


//将条件储存到session中去，可以让在查engagement的时候提取条件

$_SESSION['condition'] = $condition;
$_SESSION['conExit'] = 1;


include "connection.php";
//查询device信息
$sql ="select device,count(*) from summary ".$condition."  group by device";

$re = mysql_query($sql,$con);
$device ="";
while($row = mysql_fetch_row($re))
{
  $name = $row[0];
  $num = $row[1];
  $device =$device. "[' ".$name."' , ".$num." ],";
}

	$_SESSION['deviceContext']=$device;
//----------------

//查询s1,s2,s3,s4
if($reR[2] =="s4"|| $reR[2]=="all")
{

  $sql = "select count(*) from summary where s4 != 0";

  if($conditionBitRate!="")
    $sql = $sql." and ".$conditionBitRate;

  $re = mysql_query($sql,$con);

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


  $re = mysql_query($sql,$con);
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


  $re = mysql_query($sql,$con);
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


  $re = mysql_query($sql,$con);
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

$_SESSION['s1Context']=$s1;
$_SESSION['s2Context']=$s2;
$_SESSION['s3Context']=$s3;
$_SESSION['s4Context']=$s4;

//查询video种类
$sql ="select videoType,count(*) from summary ".$condition."  group by videoType";

$re = mysql_query($sql,$con);
$videoType =" ";
$videoNum ="";
while($row = mysql_fetch_row($re))
{
  $name = $row[0];
  $num = $row[1];
  $videoType =$videoType. "' ".$name."' , ";
  $videoNum = $videoNum.$num.",";
}

//----------------
$_SESSION['videoTypeContext']=$videoType;
$_SESSION['videoNumContext']=$videoNum;


//查询dashTime种类
$sql ="select switchingTime,count(*) from summary " .$condition."  group by switchingTime order by switchingTime limit 0,7 ";
$re = mysql_query($sql,$con);
$swithTime =" ";
$switchNum ="";
while($row = mysql_fetch_row($re))
{
  $name = $row[0];
  $num = $row[1];
  $switchTime =$switchTime. "' ".$name."' , ";
  $switchNum = $switchNum.$num.",";
}
//----------------

$_SESSION['switchTimeContext']=$switchTime;
$_SESSION['switchNumContext']=$switchNum;

//查询userISP
$sql = "select uISP,count(*) from summary ".$condition." group by uISP";
$re = mysql_query($sql,$con);
$userISP="";

while($row = mysql_fetch_row($re))
{
  $name = $row[0];
  $num = $row[1];

  $userISP = $userISP." ['".$name."',".$num."],";

}

$_SESSION['userISPContext']=$userISP;

//查询serverISP
$sql = "select sISP,count(*) from summary ".$condition." group by sISP";
$re = mysql_query($sql,$con);
$serverISP="";

while($row = mysql_fetch_row($re))
{
  $name = $row[0];
  $num = $row[1];

  $serverISP = $serverISP." ['".$name."',".$num."],";

}

$_SESSION['serverISPContext']=$serverISP;






mysql_close($con);







}
else
{
  $reResult ="all all all all all all";

  $_SESSION['conExit'] = 0;
}





include template('context');




}
else
{
	echo " userName or password error!";
	require('index.php');


}
?>
