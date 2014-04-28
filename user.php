<?php
session_start();
if($_SESSION['access']==1)
{
require_once (dirname(__FILE__) . '/app.php');






include template('user');




}
else
{
	echo " userName or password error!";
	require('index.php');


}
?>
