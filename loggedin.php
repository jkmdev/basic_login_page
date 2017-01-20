<?php

//cookies and sessions

	session_start();

	if (isset($_SESSION['User'])) {
		echo "Welcome, " . $_SESSION['User'] . "!";
	}
	else {
		header("Location: login.php");
	}

	if (isset($_POST['exit'])) {
		session_destroy();
		header("Location: login.php");
		setcookie("PHPSESSID", "", time()-61200, "/");
	}

?>

<html>

  <body>

	<h1>Session Stats</h1>

	<p> 

	<?php
		
		echo "Variables in current session: ";
		print_r($_SESSION);

		echo "<br>Content in session cookie: ";
		$array = explode("-", $_COOKIE['PHPSESSID']);  
		echo $array[0];
		
	?>

	</p>

	<form method = "POST" action = "" >
		<input type = "SUBMIT" name = "exit" value = "EXIT">
	 </form>

   </body>

</html>

