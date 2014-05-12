<?php


	session_start();


	$type=$_GET['type'];
//	echo $type;

switch ($type)
{
  case 2:
		{



			$result=$_SESSION['totalNumContext'];
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


?>
