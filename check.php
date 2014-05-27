<?php

$userName=$_POST['userName'];
$password=$_POST['password'];
session_start();


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
