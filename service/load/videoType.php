<?php
session_start();
$snapType = $_GET['type'];

if ($snapType == 1){
	$area = $_POST['areas'];
	$isp = $_POST['isp'];
	$name = $_POST['name'];


	//timeline calculation
	$timeLine = strtotime($_POST['time']);
	$timeLineJson = array();

	for ($i = 0; $i < 24; $i ++){
		$timeLineJson[] = date('H:i:s',$timeLine);
		$timeLine = $timeLine + 3600;
	}
	//end

	//videoType calculation
	//format
	//$series0 = array();
	//$series0[] = array("value"=>130, "name"=>'Chrome');

	$timeLoad = strtotime($_POST['time']);
	$timeLoadEnd = $timeLoad + 3600 * 24;
	$timeLoadEnd2 = $timeLoad + 3600 * 25;
	$sql = "select startTime, videoType from summary where startTime between ".$timeLoad." and ". $timeLoadEnd2." and sLocation = '".$area."'";
	if ($isp != "all")
		$sql = $sql." and sISP = '".$isp."'";
	if ($name != "all")
		$sql = $sql." and cdn = '".$name."'";
	$sql = $sql." order by startTime";

	include "../../connection.php";
	$re = mysql_unbuffered_query($sql, $con);
	$startTime = $timeLoad;
	$endTime = $timeLoad + 3600;
	$dataPie = array();
	$videoType = array();
	$count = 0;
	$hourType = array();
	$temType = array();
	while ($row = mysql_fetch_array($re)){
		$time = $row['startTime'];
		$type = $row['videoType'];

		while ($endTime < $time){
			$endTime = $endTime + 3600;
			$hourType[] = $temType;
			$temType = array();
		}

		//count the total videoType
		if (array_key_exists($type, $videoType)){
			$videoType[$type] ++;
		}
		else{
			$videoType[$type] = 1;
		}

		//count the hour videoType
		if (array_key_exists($type, $temType)){
			$temType[$type] ++;
		}
		else{
			$temType[$type] = 1;
		}

	}

		$hourType[] = $temType;

	//calculate the numbers of videotype
	$typeName = array_keys($videoType);
	$totalType = array();
	$series = array();
	$data = array();
	foreach ($videoType as $key => $value){
		$totalType[] = array("value"=>$value,"name"=>$key);
		$data[$key] = array();
		for ($i = 0; $i < count($hourType); $i ++){
			if (array_key_exists($key, $hourType[$i])){
				$data[$key][$i] = $hourType[$i][$key];
			}
			else{
				$data[$key][$i] = 0;
			}
		}
		$series[] = array("name" => $key, "type" => "bar", "stack" => "sum","data" =>$data[$key]);
	}



	mysql_close($con);
	//end


	//json输出
	$result=json_encode(array("timeLine"=>$timeLineJson,"typeName"=>$typeName,"totalType"=>$totalType,"series"=>$series));
	$_SESSION['loadVideoType'] = $result;
	$callback=$_GET['callback'];
	echo $callback."($result)";
}
else{
	$result = $_SESSION['loadVideoType'];
	$callback=$_GET['callback'];
	echo $callback."($result)";
}
?>
