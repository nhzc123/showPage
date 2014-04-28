<?php


include "../connection.php";

$userId = $_GET['userId'];

$sql ="select uLocation,count(id) from summary where userId = ".$userId." group by uLocation";
//echo $sql."\n";
$re = mysql_query($sql,$con);
$uLocation=array();
$scount=0;
$smin=100000000;
$smax=-1;
while($row = mysql_fetch_row($re))
{
  $name =  urlencode ($row[0]);
  $num =(int) $row[1];
//echo $name."\n";
  if($smin>$num)
    $smin=$num;
  if($smax<$num)
    $smax=$num;
	$uLo = array('name'=>$name,'value'=>$num);
	$uLocation[$scount]=$uLo;

  $scount=$scount+1;
}
//----------------


		$dataList = array();
//		echo $uLocation;
		echo urldecode(json_encode(array('uLocation'=>$uLocation,'smax'=>$smax,'smin'=>$smin)));


mysql_close($con);







?>
