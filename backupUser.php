<?php
session_start();
if($_SESSION['access']==1)
{
require_once (dirname(__FILE__) . '/app.php');


$user=$_POST['user'];
$content=str_replace("%","%25",$_POST['content']);
$device=$_POST['device'];




include "connection.php";

$sql="SELECT COUNT( * ) , userid
FROM user
GROUP BY userid
ORDER BY COUNT( * ) DESC
LIMIT 0 , 10";
$re=mysql_query($sql,$con);

$topUser=array();
while($row = mysql_fetch_array($re))
{
	$topUser[]=$row['userid'];

}

$sql="SELECT COUNT( * ) , contentid
FROM user
GROUP BY contentid
ORDER BY COUNT( * ) DESC
LIMIT 0 , 10";
$re=mysql_query($sql,$con);

$topContent=array();
while($row = mysql_fetch_array($re))
{
	$topContent[]=$row['contentid'];

}


mysql_close($con);
//include template('user');

echo $user;


}
else
{
	echo " userName or password error!";
	require('index.php');


}
?>
