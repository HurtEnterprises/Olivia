<?php 
	// add in error reporting
	ini_set('display_errors','On');
	ini_set('html_errors',0);
	error_reporting(-1);
	//require('form_process.php');
	//require('../vendor/autoload.php');
	//use WindowsAzure\Common\ServicesBuilder;

	if ($_SERVER["REQUEST_METHOD"] == "GET") //Switch to get
    {
        // else render form
		header("Location: ../log-in.php");die();

    }  
	elseif ($_SERVER["REQUEST_METHOD"] == "POST")  //switch to post
	{
		//header("Location: ../question-explanation.html");die();
		if (empty($_POST["email"]) or empty($_POST["password"]))
        {
            header("Location: ../log-in.php");die();
        }
        else 		
		{
			$loginname = trim($_POST["email"]);
			$loginpassword = trim($_POST["password"]);
			//Verify login input
			//Establishes the connection
			$host = "olivialogs.mysql.database.azure.com";
			$username = "devenhurt@olivialogs";
			$password = "LongLiveMedKit!";
			$db_name = "patient";
			$conn = mysqli_init();
			mysqli_real_connect($conn, $host, $username, $password, $db_name, 3306);
			if (mysqli_connect_errno($conn)) {
			die('Failed to connect to MySQL: '.mysqli_connect_error());
			}

			//Run the Select query
			/*printf("Reading data from table: \n");
			$res = mysqli_query($conn, 'SELECT * FROM logins');
			while ($row = mysqli_fetch_assoc($res)) {
			var_dump($row);
			}*/
			//$loginname = mysqli_real_escape_string($loginname);
			//$loginpassword = mysqli_real_escape_string($loginpassword);
			//echo($loginname);
			//echo($loginpassword);
			$result = mysqli_query($conn,'SELECT name FROM logins where name=' . $loginname . ' and password=' . $loginpassword);
			echo($result);
			if(!$result || mysql_num_rows($result) <= 0)
			{
				echo("invalid user");
			}
			else
			{
				echo("successful login");
				session_start();
				$_SESSION["user"] = $loginname;
				//header("Location: ../question-explanation.html");
			}

			//Close the connection
			mysqli_close($conn); 
		}
	}
     
?>
