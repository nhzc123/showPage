<?php
session_start();
if($_SESSION['access']==1)
{
require_once (dirname(__FILE__) . '/app.php');
$device=$_SESSION['deviceContext'];

$s1=$_SESSION['s1Context'];

$s2=$_SESSION['s2Context'];
$s3=$_SESSION['s3Context'];
$s4=$_SESSION['s4Context'];
$s5=$_SESSION['s5Context'];
$s6=$_SESSION['s6Context'];
$s7=$_SESSION['s7Context'];

$videoType=$_SESSION['videoTypeContext'];
$videoNum=$_SESSION['videoNumContext'];



$switchTime=$_SESSION['switchTimeContext'];
$switchNum=$_SESSION['switchNumContext'];


$userISP=$_SESSION['userISPContext'];


$serverISP=$_SESSION['serverISPContext'];



include template('contextSnapshot');




}
else
{
	echo " userName or password error!";
	require('index.php');


}
?>
