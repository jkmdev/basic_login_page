	
<?php

	if (isset($_POST['exit'])) {
		header("Location: login.php");
	}

	class DB {
	    private $server = "host";
	    private $database = "database";
	    private $username = "username";
	    private $password = "password";
	    private $conn;
	  function __construct () {
	    $this->conn = mysqli_connect($this->server, $this->username, $this->password, $this->database) or die ("Connection failed:" . mysqli_error($conn));
	  }
	  function runQuery($query) {
	    $result = mysqli_query($this->conn, $query) or die ("Query failed: " . mysqli_error($conn));
	    return $result;
	  }
	  function __destruct () {
	    mysql_close($this->link);
	  }
	}

	class DBinsert extends DB {
	  function insertQuery () {
	    echo "It works!";
	  }
	}
	

	class validEntry {
	    private $valid = false;
	    public $user;
	    public $pass;
	    public $error;
	  function __construct() {
	    if (preg_match('/^[a-zA-Z0-9\*&\$-_]{1,10}$/', $_POST['userName'])) {
		$this->valid = true;
		$this->user = $_POST['userName'];
	    } 
	    else {
		$this->valid = false;
	    }
	    if (preg_match('/^[a-zA-Z0-9\*&\$-_]{1,10}$/', $_POST['passWord'])) {
		$this->valid = true;
		$this->pass = crypt($_POST['passWord'], 'poppy');
		echo $this->pass;
	    } 
	    else {
		$this->valid = false;
	    }
	  }
	  function allValid() {		
		//$this->valid = true;
		return $this->valid;
	  }
	  function __toString() {
		if ($this->valid == true) {
			return "true";
		}
		else {
			return "false";
		}
	  }
	}


	$validEntry = new validEntry();
	$db = new DB();
	//$db2 = new DBinsert();
	//echo $db2->insertQuery();

	if ($validEntry->allValid()) {
	  $query = "INSERT INTO users (username, password, role, passwordHint) values ('$validEntry->user','$validEntry->pass','user','null')";
	  $db->runQuery($query);
	  header("Location: login.php");
	}
	else {
	  $validEntry->error = "Invalid credentials";
	}

?>


<html>

  <body>
	
    <form method = "POST" action = "" >

        Username: <input type = "text" name = "userName" value = "<?php echo $_POST['userName']?>" ><br>
	Password: <input type = "text" name = "passWord" value = "<?php echo $_POST['passWord']?>" ><br>
<br>

	<input type = "submit" name = "register" value = "REGISTER"><br>
	<input type = "SUBMIT" name = "exit" value = "EXIT">

     </form>


    <?php
	echo $validEntry->error;
    ?>

   </body>

</html>


