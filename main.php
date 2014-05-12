<?php

session_start();
if($_SESSION['access']==1)
{
require_once (dirname(__FILE__) . '/app.php');



include "connection.php";


//查询device信息
$sql ="select device,count(id) from summary group by device";

$re = mysql_query($sql,$con);
$device ="";
while($row = mysql_fetch_row($re))
{
  $name = $row[0];
  $num = $row[1];
  $device =$device. "[' ".$name."' , ".$num." ],";
}
//----------------

//查询s1,s2,s3,s4,s5,s6,s7

$sql = "select count(id) from summary where s7 != 0";

$re = mysql_query($sql,$con);
$s7="";
while($row = mysql_fetch_row($re))
{
  $s7=$row[0];
}
$sql = "select count(id) from summary where s6 != 0";

$re = mysql_query($sql,$con);
$s6="";
while($row = mysql_fetch_row($re))
{
  $s6=$row[0];
}
$sql = "select count(id) from summary where s5 != 0";

$re = mysql_query($sql,$con);
$s5="";
while($row = mysql_fetch_row($re))
{
  $s5=$row[0];
}
$sql = "select count(id) from summary where s4 != 0";

$re = mysql_query($sql,$con);
$s4="";
while($row = mysql_fetch_row($re))
{
  $s4=$row[0];
}
$sql = "select count(id) from summary where s3 != 0";

$re = mysql_query($sql,$con);
$s3="";
while($row = mysql_fetch_row($re))
{
  $s3=$row[0];
}
$sql = "select count(id) from summary where s2 != 0";

$re = mysql_query($sql,$con);
$s2="";
while($row = mysql_fetch_row($re))
{
  $s2=$row[0];
}
$sql = "select count(id) from summary where s1 != 0";

$re = mysql_query($sql,$con);
$s1="";
while($row = mysql_fetch_row($re))
{
  $s1=$row[0];
}
//-----------------------


//查询video种类
$sql ="select videoType,count(id) from summary group by videoType";
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



//查询dashTime种类
$sql ="select switchingTime,count(id) from summary group by switchingTime order by switchingTime limit 0,7 ";
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


//查询serverAreas信息
$sql ="select sLocation,count(id) from summary group by sLocation";
$re = mysql_query($sql,$con);
$sLocation ="";
$scount=0;
$smin=10000000;
$smax=-1;
while($row = mysql_fetch_row($re))
{
  $scount=$scount+1;
  $name = $row[0];
  $num = $row[1];

  if($smin>$num)
    $smin=$num;
  if($smax<$num)
    $smax=$num;
  $sLocation =$sLocation. "{ name :'".$name."' , value:".$num."},";
}
//----------------

//查询userAreas信息
$sql ="select uLocation,count(id) from summary group by uLocation";

$re = mysql_query($sql,$con);
$uLocation ="";
$umin=10000000;
$umax=-1;
$uName = "";
$uSelectedName ="";
$uSelectedLocation ="";
$uCount=0;
while($row = mysql_fetch_row($re))
{
  $name = $row[0];
  $num = $row[1];

  if($umin>$num)
    $umin=$num;
  if($umax<$num)
    $umax=$num;


 // $uSelected =$uSelected."{name:'".$name."',value:".$num."},";
  if($uCount==0)
{
  $uName="'".$name."',";
  $uSelectedName="{ name:'".$name."',value:".$num."},";

 $uLocation = "{ name :'".$name."' , value:".$num.",selected:true},";
$uCount=2;
continue;
}
 $uLocation =$uLocation. "{ name :'".$name."' , value:".$num."},";
}
//----------------


//查询userISP
$sql = "select uISP,count(*) from summary group by uISP";
$re = mysql_query($sql,$con);
$userISP="";

while($row = mysql_fetch_row($re))
{
  $name = $row[0];
  $num = $row[1];

  $userISP = $userISP." ['".$name."',".$num."],";

}


//查询serverISP
$sql = "select sISP,count(*) from summary group by sISP";
$re = mysql_query($sql,$con);
$serverISP="";

while($row = mysql_fetch_row($re))
{
  $name = $row[0];
  $num = $row[1];

  $serverISP = $serverISP." ['".$name."',".$num."],";

}









	include template('index');

}
else
{
	echo " userName or password error!";
	require('index.php');


}

?>
