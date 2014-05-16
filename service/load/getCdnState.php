<?php
$areas = $_POST['areas'];
//echo $areas;

$type = $_POST['type'];

include "../../connection.php";

switch ($type)
{
	case 1:
	{
		$sql = "select cdnName,cdnISP from cdnInfo where cdnLocation = '".$areas."'";
		$re = mysql_query($sql,$con);

		$i=0;
		$dataList = array();
		while($row = mysql_fetch_array($re,MYSQL_ASSOC))
		{
			$dataList[$i]=$row;
			$i=$i+1;
		}

		echo json_encode(array('dataList'=>$dataList));
		break;
	}

}



?>
