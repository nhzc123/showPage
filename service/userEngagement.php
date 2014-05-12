<?php


	session_start();

if($_SESSION['conExit']!=0)
{
  $condition = $_SESSION['condition'];



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

switch ($type)
{
  case 2:
		{



      	$sql="select startTime,rate from summary ".$condition." order by startTime ";
      	include "connection.php";
      	$re=mysql_unbuffered_query($sql,$con);
      	$arr=array();
      	$arrCount=array();

//        echo $sql;
      	$timestamp="";


        //2013年9月9号下午11点时间戳1378738800
      	//2012年12月31日下午11点的时间戳为1356922800
      	//计算一个小时内的平均CDF
        $startTime = 1378738800;
        $endTime =   1378742400;
        $countTotal = 0;
        $count020 = 0;
        $count2040 = 0;
        $count4060 = 0;
        $count6080 = 0;
        $count80100 = 0;
        $timeStamp =(1378738800+28800)."000";
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

	  $_SESSION['totalNumContext']=json_encode($totalNum);
      $_SESSION['num020Context']=json_encode($num020);
      $_SESSION['num2040Context']=json_encode($num2040);
      $_SESSION['num4060Context']=json_encode($num4060);
      $_SESSION['num6080Context']=json_encode($num6080);
      $_SESSION['num80100Context']=json_encode($num80100);
			$result=json_encode($totalNum);
      $callback=$_GET['callback'];
			echo $callback."($result)";
      break;
		}
  case 3:
		{
      $_SESSION['conExit']=$_SESSION['conExit']+1;
      $result=$_SESSION['num020Context'];
    	$callback=$_GET['callback'];
			echo $callback."($result)";
      break;
		}

  case 4:
  {

      $_SESSION['conExit']=$_SESSION['conExit']+1;
			$result=$_SESSION['num2040Context'];
    	$callback=$_GET['callback'];
			echo $callback."($result)";
      break;
		}

  case 5:
		{

      $_SESSION['conExit']=$_SESSION['conExit']+1;
			$result=$_SESSION['num4060Context'];
    	$callback=$_GET['callback'];
			echo $callback."($result)";
      break;
		}

  case 6:
		{
      $_SESSION['conExit']=$_SESSION['conExit']+1;
			$result=$_SESSION['num6080Context'];
    	$callback=$_GET['callback'];
			echo $callback."($result)";
      break;
		}

  case 7:
		{
      $_SESSION['conExit']=$_SESSION['conExit']+1;
			$result=$_SESSION['num80100Context'];
    	$callback=$_GET['callback'];
			echo $callback."($result)";
      break;
		}

}

  if($_SESSION['conExit']==6)
    	$_SESSION['conExit']=0;

}
?>
