<?php


	session_start();




//一次访问，将数据保存
//查询的时候先进入type=2的查询 将其他查询结果存入到session当中

	//type=1 engagement type=2 number type=3 0~20% type=4 20~40% type=5 40~60% type=6 60~80% type=7 80~100%
	$type=$_GET['type'];
  $iPadEngagement=array();
  $iPhoneEngagement = array();
  $otherEngagement = array();
  $pcEngagement = array();
  $TVEngagement = array();

switch ($type)
{
  case 2:
		{


    include "../../connection.php";

	$userId = $_POST['userId'];

	$sql = "select device,startTime,rate from summary where userId=".$userId." order by startTime";

//:while	echo $sql;

//查询engagement
		$re=mysql_unbuffered_query($sql,$con);




      while($row = mysql_fetch_array($re))
         {
        		$time=$row['startTime'];
				$device=$row['device'];
				$rate = (float)$row['rate'];
				$timeStamp=($time+28800)."000";
				$tem = array((float)$timeStamp,$rate);

				if($device =="iPad"){
					$iPadEngagement[]=$tem;
				}
				else if($device == "iPhone"){
				$iPhoneEngagement[]=$tem;
				}
				else if($device == "other"){
					$otherEngagement[]=$tem;
				}
				else if($device == "PC"){

					$pcEngagement[]=$tem;
				}
				else if($device =="TV"){
					$TVEngagement[]=$tem;
				}
		}




          mysql_close($con);


      $_SESSION['iPhoneEngagement']=json_encode($iPhoneEngagement);
      $_SESSION['otherEngagement']=json_encode($otherEngagement);
      $_SESSION['pcEngagement']=json_encode($pcEngagement);
      $_SESSION['TVEngagement']=json_encode($TVEngagement);
			$result=json_encode($iPadEngagement);
      $callback=$_GET['callback'];
			echo $callback."($result)";
      break;
		}
  case 3:
		{
      $result=$_SESSION['iPhoneEngagement'];
    	$callback=$_GET['callback'];
			echo $callback."($result)";
      break;
		}

  case 4:
  {

			$result=$_SESSION['otherEngagement'];
    	$callback=$_GET['callback'];
			echo $callback."($result)";
      break;
		}

  case 5:
		{

			$result=$_SESSION['pcEngagement'];
    	$callback=$_GET['callback'];
			echo $callback."($result)";
      break;
		}

  case 6:
		{
			$result=$_SESSION['TVEngagement'];
    	$callback=$_GET['callback'];
			echo $callback."($result)";
      break;
		}


}

?>
