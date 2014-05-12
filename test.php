<?php
session_start();
$_SESSION['hehe']="fdfds";
if($_SESSION['hehe']==NULL)
	echo "hehe";
else
	echo "haha";
?>
