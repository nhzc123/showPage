<?php

session_start();

$_SESSION['abcd']=1;

echo $_SESSION['abcd'];

if($_SESSION['aa']==null)
	echo "hehe";
else
	echo "haha";


$_SESSION['abcd']=null;


if($_SESSION['abcd']==null)
	echo "hehe";
else
	echo "haha";

?>
