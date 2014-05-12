<?php


	session_start();



//一次访问，将数据保存
//查询的时候先进入type=2的查询 将其他查询结果存入到session当中

	//type=1 engagement type=2 number type=3 0~20% type=4 20~40% type=5 40~60% type=6 60~80% type=7 80~100%
	$type=$_GET['type'];
  $totalNum=array();
  $num020 = array();
  $num2040 = array();
  $num4060 = array();
  $num6080 = array();
  $num80100 = array();
  $checkDashLoad = array();
  $checkOtherLoad = array();

  $s1DashLoad = array();
  $s2DashLoad = array();
  $s3DashLoad = array();
  $s4DashLoad = array();
  $s5DashLoad = array();
  $s6DashLoad = array();
  $s7DashLoad = array();
  $oDashLoad = array();

  $s1OtherLoad = array();
  $s2OtherLoad = array();
  $s3OtherLoad = array();
  $s4OtherLoad = array();
  $s5OtherLoad = array();
  $s6OtherLoad = array();
  $s7OtherLoad = array();
  $oOtherLoad = array();
switch ($type)
{
  case 2:
		{

		$area = $_POST['areas'];
		$isp = $_POST['isp'];
		$name = $_POST['name'];

		//有八个小时误差 注意这里取得是系统时间 所以要根据系统时间来判断具体时候有小时误差
    //测试机不需要减掉28800秒
		$timeLoad =strtotime( $_POST['time']);
		$timeLoadEnd = $timeLoad+3600*24;
	//	echo $area." ".$isp." ".$name." ".$time;
		$sql="select startTime,rate from summary where startTime between ".$timeLoad." and ".$timeLoadEnd." and sLocation = '".$area."'";





		if($isp !="all")
			$sql = $sql." and sISP ='".$isp."'";
		if($name !="all")
			$sql = $sql." and cdn = '".$name."'";

		$sql = $sql." order by startTime";
	//		echo $sql;
		//
		//
		//查询dash 与非dash负载
    //有3种查询情况 第一种是只有地区信息，第二种是有地区和ISP信息，第三种是有cdn信息

    include "connection.php";
//获得cdn的isp和areas信息
		$sqlCdn = "select cdnName,cdnISP from cdnInfo where cdnLocation = '".$area."'";
		$re = mysql_query($sqlCdn,$con);

		$i=0;
		$dataList = array();
		while($row = mysql_fetch_array($re,MYSQL_ASSOC))
		{
			$dataList[$i]=$row;
      $i=$i+1;
    }

    $sqlLoad="";

    if($name !="all")
        $sqlLoad = "select timeStamp,dashLoad,otherLoad,s1Dash,s2Dash,s3Dash,s4Dash,s5Dash,s6Dash,s7Dash,oDash,s1Other,s2Other,s3Other,s4Other,s5Other,s6Other,s7Other,oOther from `".$name."` where timeStamp between ".$timeLoad." and ".$timeLoadEnd;
    else if($isp !="all"){

        $sqlLoad="select timeStamp,sum(dashLoad),sum(otherLoad),sum(s1Dash),sum(s2Dash),sum(s3Dash),sum(s4Dash),sum(s5Dash),sum(s6Dash),sum(s7Dash),sum(oDash),sum(s1Other),sum(s2Other),sum(s3Other),sum(s4Other),sum(s5Other),sum(s6Other),sum(s7Other),sum(oOther) from (";

        $flag = 0;

        for($j=0;$j<$i;$j++){

          if($dataList[$j]['cdnISP']==$isp){
            if($flag != 0)
              $sqlLoad =$sqlLoad." union all";
            $sqlLoad=$sqlLoad." select timeStamp,dashLoad,otherLoad , s1Dash,s2Dash,s3Dash,s4Dash,s5Dash,s6Dash,s7Dash,oDash,s1Other,s2Other,s3Other,s4Other,s5Other,s6Other,s7Other,oOther from `".$dataList[$j]['cdnName']."` where timeStamp between ".$timeLoad." and ".$timeLoadEnd;

            $flag = 1;
          }


        }

        $sqlLoad = $sqlLoad." ) as total group by timestamp ";


    } else {


        $sqlLoad="select timeStamp,sum(dashLoad),sum(otherLoad),sum(s1Dash),sum(s2Dash),sum(s3Dash),sum(s4Dash),sum(s5Dash),sum(s6Dash),sum(s7Dash),sum(oDash),sum(s1Other),sum(s2Other),sum(s3Other),sum(s4Other),sum(s5Other),sum(s6Other),sum(s7Other),sum(oOther) from (";

            $sqlLoad=$sqlLoad." select timeStamp,dashLoad,otherLoad ,s1Dash,s2Dash,s3Dash,s4Dash,s5Dash,s6Dash,s7Dash,oDash,s1Other,s2Other,s3Other,s4Other,s5Other,s6Other,s7Other,oOther from `".$dataList[0]['cdnName']."` where timeStamp between ".$timeLoad." and ".$timeLoadEnd;
        for($j=1;$j<$i;$j++){

            $sqlLoad=$sqlLoad." union all ";

            $sqlLoad=$sqlLoad." select timeStamp,dashLoad,otherLoad,s1Dash,s2Dash,s3Dash,s4Dash,s5Dash,s6Dash,s7Dash,oDash,s1Other,s2Other,s3Other,s4Other,s5Other,s6Other,s7Other,oOther  from `".$dataList[$j]['cdnName']."` where timeStamp between ".$timeLoad." and ".$timeLoadEnd;



        }

        $sqlLoad = $sqlLoad." ) as total  group by timestamp ";
    }



 // echo $sqlLoad;





		$reLoad = mysql_unbuffered_query($sqlLoad,$con);
	//	echo $sqlLoad;
		while($row = mysql_fetch_row($reLoad))
		{
		//	echo "fsdf";
			$time = $row[0];
			$dash = $row[1];
			$other = $row[2];
			$s1D = $row[3];
			$s2D = $row[4];
			$s3D = $row[5];
			$s4D = $row[6];
			$s5D = $row[7];
			$s6D = $row[8];
			$s7D = $row[9];
			$oD = $row[10];
			$s1O =$row[11];
			$s2O =$row[12];
			$s3O =$row[13];
			$s4O =$row[14];
			$s5O =$row[15];
			$s6O =$row[16];
			$s7O =$row[17];
			$oO =$row[18];
		//	echo "abcd";

	//		echo $time." ".$dash." ".$other;
			$temTime=(float)(($time+28800)."000");
			$tem =array($temTime,(float)$dash);
			$checkDashLoad[]=$tem;

			$tem =array($temTime,(float)$other);
			$checkOtherLoad[]=$tem;

			$tem = array($temTime,(float)$s1D);
			$s1DashLoad[]=$tem;
			$tem = array($temTime,(float)$s2D);
			$s2DashLoad[]=$tem;
			$tem = array($temTime,(float)$s3D);
			$s3DashLoad[]=$tem;
			$tem = array($temTime,(float)$s4D);
			$s4DashLoad[]=$tem;
			$tem = array($temTime,(float)$s5D);
			$s5DashLoad[]=$tem;
			$tem = array($temTime,(float)$s6D);
			$s6DashLoad[]=$tem;
			$tem = array($temTime,(float)$s7D);
			$s7DashLoad[]=$tem;
			$tem = array($temTime,(float)$oD);
			$oDashLoad[]=$tem;


			$tem = array($temTime,(float)$s1O);
			$s1OtherLoad[]=$tem;
			$tem = array($temTime,(float)$s2O);
			$s2OtherLoad[]=$tem;
			$tem = array($temTime,(float)$s3O);
			$s3OtherLoad[]=$tem;
			$tem = array($temTime,(float)$s4O);
			$s4OtherLoad[]=$tem;
			$tem = array($temTime,(float)$s5O);
			$s5OtherLoad[]=$tem;
			$tem = array($temTime,(float)$s6O);
			$s6OtherLoad[]=$tem;
			$tem = array($temTime,(float)$s7O);
			$s7OtherLoad[]=$tem;
			$tem = array($temTime,(float)$oO);
			$oOtherLoad[]=$tem;
		}

	//	echo "hehe";













//查询engagement
		$re=mysql_unbuffered_query($sql,$con);
      	$arr=array();
      	$arrCount=array();


      	$timestamp="";


      	//2012年12月31日下午11点的时间戳为1356922800
      	//计算一个小时内的平均CDF
        $startTime = $timeLoad;
        $endTime =   $timeLoad+3600;
        $countTotal = 0;
        $count020 = 0;
        $count2040 = 0;
        $count4060 = 0;
        $count6080 = 0;
        $count80100 = 0;
        $timeStamp =($timeLoad+28800)."000";
      while($row = mysql_fetch_array($re))
         {
        		$time=$row['startTime'];
        		$rate=$row['rate'];

            while($endTime <$time)
            {
                $timeStamp = ($startTime+28800)."000";
                $startTime = $startTime+3600;
                $endTime = $endTime+3600;

                $tem = array((float)$timeStamp,$countTotal);
                $totalNum[]=$tem;
                $countTotal=0;


                $tem = array((float)$timeStamp,$count020);
                $num020[]=$tem;
                $count020=0;

                $tem = array((float)$timeStamp,$count2040);
                $num2040[]=$tem;
                $count2040=0;

                $tem = array((float)$timeStamp,$count4060);
                $num4060[]=$tem;
                $count4060=0;

                $tem = array((float)$timeStamp,$count6080);
                $num6080[]=$tem;
                $count6080=0;

                $tem = array((float)$timeStamp,$count80100);
                $num80100[]=$tem;
                $count80100=0;



            }

            $countTotal=$countTotal+1;

            if($rate >=0 &&$rate<0.2)
                $count020=$count020+1;
            else if($rate>=0.2&&$rate<0.4)
                $count2040=$count2040+1;
            else if($rate>=0.4&&$rate<0.6)
                $count4060=$count4060+1;
            else if($rate>=0.6&&$rate<0.8)
                $count6080=$count6080+1;
            else
                $count80100=$count80100+1;

        	}


                $startTime = $startTime+3600;
                $timeStamp = ($startTime+28800)."000";
                $tem = array((float)$timeStamp,$countTotal);
                $totalNum[]=$tem;
                $countTotal=0;


                $tem = array((float)$timeStamp,$count020);
                $num020[]=$tem;
                $count020=0;

                $tem = array((float)$timeStamp,$count2040);
                $num2040[]=$tem;
                $count2040=0;

                $tem = array((float)$timeStamp,$count4060);
                $num4060[]=$tem;
                $count4060=0;

                $tem = array((float)$timeStamp,$count6080);
                $num6080[]=$tem;
                $count6080=0;

                $tem = array((float)$timeStamp,$count80100);
                $num80100[]=$tem;
                $count80100=0;




          mysql_close($con);

      $_SESSION['num020Load']=json_encode($num020);
      $_SESSION['num2040Load']=json_encode($num2040);
      $_SESSION['num4060Load']=json_encode($num4060);
      $_SESSION['num6080Load']=json_encode($num6080);
	  $_SESSION['num80100Load']=json_encode($num80100);
	  $_SESSION['dashLoad'] = json_encode(array("s1DashLoad"=>$s1DashLoad,"s2DashLoad"=>$s2DashLoad,"s3DashLoad"=>$s3DashLoad,"s4DashLoad"=>$s4DashLoad,"s5DashLoad"=>$s5DashLoad,"s6DashLoad"=>$s6DashLoad,"s7DashLoad"=>$s7DashLoad,"oDashLoad"=>$oDashLoad));
	  $_SESSION['otherLoad']=json_encode(array("s1OtherLoad"=>$s1OtherLoad,"s2OtherLoad"=>$s2OtherLoad,"s3OtherLoad"=>$s3OtherLoad,"s4OtherLoad"=>$s4OtherLoad,"s5OtherLoad"=>$s5OtherLoad,"s6OtherLoad"=>$s6OtherLoad,"s7OtherLoad"=>$s7OtherLoad,"oOtherLoad"=>$oOtherLoad));
			$result=json_encode($totalNum);
      $callback=$_GET['callback'];
			echo $callback."($result)";
      break;
		}
  case 3:
		{
      $result=$_SESSION['num020Load'];
    	$callback=$_GET['callback'];
			echo $callback."($result)";
      break;
		}

  case 4:
  {

			$result=$_SESSION['num2040Load'];
    	$callback=$_GET['callback'];
			echo $callback."($result)";
      break;
		}

  case 5:
		{

			$result=$_SESSION['num4060Load'];
    	$callback=$_GET['callback'];
			echo $callback."($result)";
      break;
		}

  case 6:
		{
			$result=$_SESSION['num6080Load'];
    	$callback=$_GET['callback'];
			echo $callback."($result)";
      break;
		}

  case 7:
		{
			$result=$_SESSION['num80100Load'];
    	$callback=$_GET['callback'];
			echo $callback."($result)";
      break;
		}
  case 8:
	  {

			$result=$_SESSION['dashLoad'];
    		$callback=$_GET['callback'];
			echo $callback."($result)";
			break;
 		 }
  case 9:
  {

			$result=$_SESSION['otherLoad'];
	    	$callback=$_GET['callback'];
			echo $callback."($result)";
			break;
  }

}

?>
