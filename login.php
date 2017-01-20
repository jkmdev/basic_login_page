<?php

session_start();

if (isset($_COOKIE['COUNT'])) {
	$newCount = $_COOKIE['COUNT'] += 1;
	setcookie("COUNT", $newCount);
}
else {
	setcookie("COUNT", 1);
}

$user = $_POST['userName'];
$pass = $_POST['passWord'];
$errorName = " No Errors";
$errorPass = " No Errors";
$error = false;

	if (!preg_match('/^[a-zA-Z0-9\*&\$-_]{1,10}$/', $user)) {
		$errorName = " Invalid Username";
		$error = true;
	}

	if (!preg_match('/^[a-zA-Z0-9\*&\$-_]{1,10}$/', $pass)) {
		$errorPass = " Invalid Password";
		$error = true;
	}

	if (isset($_POST['register'])) {
		header("Location: register.php");
	}

?>

<html>

  <head>
   
   </head>

  <body>

	<h1>Login Page</h1>
	<h4>Enter username and password</h4>
	<h4>Length between 1 and 10</h4>
	<h4>Characters, numbers, special characters (*&$-_)</h4>

    <form method = "POST" action = "" >

        <input type = "text" name = "userName" value = "<?php echo $_POST['userName']?>" ><?php echo "$errorName" ?><br>
	
	<input type = "text" name = "passWord" value = "<?php echo $_POST['passWord']?>" ><?php echo "$errorPass" ?><br>
<br>

	<input type = "submit" value = "LOGIN">
	<input type = "submit" name = "register" value = "REGISTER">

     </form>

   </body>

</html>

<?php

  if (!$error) {

	$_SESSION['User'] = $user;

	setcookie("User", $user, time()+1800);

	$conn = mysqli_connect("host","username","password","database") or die ('Connection failed: ' . mysqli_error($conn));

	$query = "SELECT * FROM users WHERE username LIKE '" . $_POST['userName'] .  "' AND password LIKE '" . crypt($_POST['passWord'], 'poppy') . "'";

	$execute = mysqli_query($conn, $query) or die ('Query failed: ' . mysqli_error($conn));

	if ($execute->num_rows > 0) {
		header("Location: loggedin.php");
		echo crypt($_POST['passWord'], 'poppy');
	}
	else {
		echo "Login unsuccessful.";
	}

	
  }


?>


