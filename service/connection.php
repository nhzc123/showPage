<?php
$con = mysql_connect('www.jokeyt.tk','root','media1512');
if (!$con) {
	die('Could not connect to MySQL: ' . mysql_error());
}
mysql_query("SET NAMES 'utf8'");
mysql_select_db("qoe2", $con);


?>
