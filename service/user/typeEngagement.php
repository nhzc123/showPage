<?php









    include "../../connection.php";

	$userId = $_GET['userId'];

	$sql = "select videoType,count(videoType) as ct from summary where userId=".$userId." group by videoType order by videoType";

//	echo $sql;
	$videoType = array();
	$totalNum = array();
	$num020 = array();
	$num2040 = array();
	$num4060 = array();
	$num6080 = array();
	$num80100 = array();
//查询engagement
		$re=mysql_unbuffered_query($sql,$con);



	  $i=0;
      while($row = mysql_fetch_array($re))
	  {
			$vt = $row['videoType'];
			$ct = $row['ct'];
		//	echo $videoType."\n";
			$videoType[$i]=$vt;
			$totalNum[$i]=$ct;
			$num020[$i]=0;
			$num2040[$i]=0;
			$num4060[$i]=0;
			$num6080[$i]=0;
			$num80100[$i]=0;
			$i=$i+1;
		}
	//  echo $videoType;

	  $sql = "select videoType,count(videoType)as ct,rate  from summary where userId=".$userId." and rate between 0 and 0.2 group by videoType";
//	echo $sql;
	  $re = mysql_unbuffered_query($sql,$con);

	  while($row = mysql_fetch_array($re)){
		  $vt = $row['videoType'];
		  $ct =(float) $row['ct'];
		  for($j=0;$j<$i;$j++){
			  if($vt == $videoType[$j]){
				  $num020[$j]=round(100*$ct/$totalNum[$j],2);
				  break;
			  }


		  }

	  }

	  $sql = "select videoType,count(videoType) as ct,rate  from summary where userId=".$userId." and rate between 0.2 and 0.4 group by videoType";

	  $re = mysql_unbuffered_query($sql,$con);

	  while($row = mysql_fetch_array($re)){
		  $vt = $row['videoType'];
		  $ct =(float) $row['ct'];
		  for($j=0;$j<$i;$j++){
			  if($vt == $videoType[$j]){
				  $num2040[$j]=round(100*$ct/$totalNum[$j],2);
				  break;
			  }


		  }

	  }


	  $sql = "select videoType,count(videoType) as ct,rate from summary where userId=".$userId." and rate between 0.4 and 0.6 group by videoType";

	  $re = mysql_unbuffered_query($sql,$con);

	  while($row = mysql_fetch_array($re)){
		  $vt = $row['videoType'];
		  $ct =(float) $row['ct'];
		  for($j=0;$j<$i;$j++){
			  if($vt == $videoType[$j]){
				  $num4060[$j]=round(100*$ct/$totalNum[$j],2);
				  break;
			  }


		  }

	  }

	  $sql = "select videoType,count(videoType) as ct,rate  from summary where userId=".$userId." and rate between 0.6 and 0.8 group by videoType";

	  $re = mysql_unbuffered_query($sql,$con);

	  while($row = mysql_fetch_array($re)){
		  $vt = $row['videoType'];
		  $ct =(float) $row['ct'];
		  for($j=0;$j<$i;$j++){
			  if($vt == $videoType[$j]){
				  $num6080[$j]=round(100*$ct/$totalNum[$j],2);
				  break;
			  }


		  }

	  }

	  $sql = "select videoType,count(videoType) as ct ,rate from summary where userId=".$userId." and rate between 0.8 and 1 group by videoType";

	  $re = mysql_unbuffered_query($sql,$con);

	  while($row = mysql_fetch_array($re)){
		  $vt = $row['videoType'];
		  $ct =(float) $row['ct'];
		  for($j=0;$j<$i;$j++){
			  if($vt == $videoType[$j]){
				  $num80100[$j]=round(100*$ct/$totalNum[$j],2);
				  break;
			  }


		  }

	  }



	  echo json_encode(array("videoType"=>$videoType,"totalNum"=>$totalNum,"num020"=>$num020,"num2040"=>$num2040,"num4060"=>$num4060,"num6080"=>$num6080,"num80100"=>$num80100));


          mysql_close($con);




?>
