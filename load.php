<?php
session_start();
if($_SESSION['access']==1)
{
require_once (dirname(__FILE__) . '/app.php');


include "connection.php";



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





mysql_close($con);











include template('load');




}
else
{
	echo " userName or password error!";
	require('index.php');


}
?>
