<?php
session_start();
$type = $_GET['type'];

if ($type == 1){
	$area = $_POST['areas'];
	$isp = $_POST['isp'];
	$name = $_POST['name'];


	//timeline calculation
	$timeLine = strtotime($_POST['time']);
	$timeLineJson = array();

	for ($i = 0; $i < 24; $i ++){
		$timeLineJson[] = date('Y-m-d H:i:s',$timeLine);
		$timeLine = $timeLine + 3600;
	}
	//end

	//swithTime calculation
	//format
	//$series0 = array();
	//$series0[] = array("value"=>130, "name"=>'Chrome');

	$timeLoad = strtotime($_POST['time']);
	$timeLoadEnd = $timeLoad + 3600 * 24;
	$timeLoadEnd2 = $timeLoad + 3600 * 25;
	$sql = "select startTime, switchingTime from summary where startTime between ".$timeLoad." and ". $timeLoadEnd2." and sLocation = '".$area."'";
	if ($isp != "all")
		$sql = $sql." and sISP = '".$isp."'";
	if ($name != "all")
		$sql = $sql." and cdn = '".$name."'";
	$sql = $sql." order by startTime";

	include "../../connection.php";
	$re = mysql_unbuffered_query($sql, $con);
	$startTime = $timeLoad;
	$endTime = $timeLoad + 3600;
	$countSwitching = array(0, 0, 0, 0, 0, 0, 0, 0,0);//计算每个小时内切换总数
	//$countSwitching = array(1, 1, 1, 1, 1, 1, 1, 1,1);//计算每个小时内切换总数
	$series = array();
	$countTime = 0;
	while ($row = mysql_fetch_array($re)){
		$time = $row['startTime'];
		$switchingTime = $row['switchingTime'];

		while ($endTime < $time){
			$endTime = $endTime + 3600;
			$flag = 0;
			for ($i = 0; $i < 9; $i ++)
				if ($countSwitching[$i] != 0){
					$flag = 1;
				}
			for ($i = 0; $i < 8; $i ++){
				$series[$countTime][] = array("value"=>$countSwitching[$i], "name"=>$i);
			}
				if ($flag == 1)
					$series[$countTime][] = array("value"=>$countSwitching[8], "name"=>"other");
				else{
					$series[$countTime][] = array("value"=>1, "name"=>"other");
				}

			$countTime ++;
			$countSwitching = array(0, 0, 0, 0, 0, 0, 0, 0, 0);//计算每个小时内切换总数
			//$countSwitching = array(1, 1, 1, 1, 1, 1, 1, 1,1);//计算每个小时内切换总数
		}

		if ($switchingTime > 7)
			$countSwitching[8] ++;

		$countSwitching[$switchingTime] ++;


	}

			$flag = 0;
			for ($i = 0; $i < 9; $i ++)
				if ($countSwitching[$i] != 0){
					$flag = 1;
				}
			for ($i = 0; $i < 8; $i ++){
				$series[$countTime][] = array("value"=>$countSwitching[$i], "name"=>$i);
			}
				if ($flag == 1)
					$series[$countTime][] = array("value"=>$countSwitching[8], "name"=>"other");
				else{
					$series[$countTime][] = array("value"=>1, "name"=>"other");
				}
	mysql_close($con);
	//end


	//json输出
	$result=json_encode(array("timeLine"=>$timeLineJson,"series"=>$series));
	$_SESSION['loadSwitchTime'] = $result;
	$callback=$_GET['callback'];
	echo $callback."($result)";
}
else{
	//echo "hehe";
	//echo $_SESSION['distribution'];
	$result = $_SESSION['loadSwitchTime'];
	$callback=$_GET['callback'];
	echo $callback."($result)";
}
?>
