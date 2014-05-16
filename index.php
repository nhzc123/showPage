
<?php

$userName=$_POST['userName'];
$password=$_POST['password'];
session_start();

if($_SESSION['access']==1)
{
	require('main.php');

}

?>


<div>from 2013.09.10 to 2013.09.30</div>

<form action="check.php" method="post" class="formit">
		 <a>userName:  </a> <input type="text" name="userName" />
		 <a>password:  </a><input type="password" name="password" />

		</br>




		<input type="submit"  class="button_submit" value="send " />
		</form>


