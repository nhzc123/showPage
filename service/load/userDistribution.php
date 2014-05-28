<?php


	session_start();



//一次访问，将数据保存
//查询的时候先进入type=2的查询 将其他查询结果存入到session当中

	//type=1 engagement type=2 number type=3 0~20% type=4 20~40% type=5 40~60% type=6 60~80% type=7 80~100%
	$type=$_GET['type'];

		$area = $_POST['areas'];
		$isp = $_POST['isp'];
		$name = $_POST['name'];


    include "../../connection.php";

if($type ==2){
	$sql = "select uLocation,count(id) as ct from summary where sLocation='".$area."'";

	if($isp !="all")
		$sql = $sql." and sISP='".$isp."'";

	if($name !="all")
		$sql = $sql." and cdn='".$name."'";

	$sql = $sql." group by uLocation order by ct desc";


		$reLoad = mysql_unbuffered_query($sql,$con);

	$distribution=array();
	$count=0;
	$top10Sum=array();
	$top10Detail=array();
	$MAXSIZE=0;
		while($row = mysql_fetch_row($reLoad))
		{
			$uLocation = $row[0];
			$ct = $row[1];
			$tem = array(array("name"=>$area),array("name"=>$uLocation));
			$distribution[$count]=$tem;

			if($MAXSIZE<$ct)
				$MAXSIZE=$ct;
			if($count  < 10){
				$temDetail=array("name"=>$uLocation,"value"=>$ct);
				$top10Detail[$count]=$temDetail;

				$temSum=array(array("name"=>$area),$temDetail);
				$top10Sum[$count]=$temSum;


			}
			$count++;
		}








          mysql_close($con);


			$result=json_encode(array("MAXSIZE"=>(int)$MAXSIZE,"distribution"=>$distribution,"top10Sum"=>$top10Sum,"top10Detail"=>$top10Detail));
			$_SESSION['distribution']=$result;
      $callback=$_GET['callback'];
			echo $callback."($result)";

}
else{

	$result=$_SESSION['distribution'];
      $callback=$_GET['callback'];
			echo $callback."($result)";


}

?>
