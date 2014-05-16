<?php

$userName=$_POST['userName'];
$password=$_POST['password'];
session_start();

//2013年9月9号下午11点时间戳1378738800
//2012年12月31日下午11点的时间戳为1356922800
//计算一个小时内的平均CDF
//目前switchEngagement时间是1~5月份的 注意区别
//还需要改的地方有在loadEngagement里面的时间戳
$startTime = 1378738800;
$_SESSION['timeStamp']=$startTime;

if($_SESSION['access']==1)
{
	require('main.php');

}

else if($userName=="admin" && $password=="12345")
{
	$_SESSION['access']=1;
	require('main.php');


}
else if($userName=="BesTV" && $password=="BesTV")
{
	$_SESSION['access']=1;
	require('main.php');


}

else
{
	$_SESSION['access']=0;
	echo " userName or password error!";
	require('index.php');


}
?>
