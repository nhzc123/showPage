<?php


include "../../connection.php";

    $sql = "SELECT userId, COUNT( userId ) AS ct
      FROM summary
      GROUP BY userId
      ORDER BY ct DESC
      LIMIT 0 , 10";
		$re = mysql_query($sql,$con);

		$i=0;
		$dataList = array();
		while($row = mysql_fetch_array($re,MYSQL_ASSOC))
		{
			$dataList[$i]=$row;
			$i=$i+1;
		}

		echo json_encode(array('dataList'=>$dataList));



?>
