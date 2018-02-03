<?php 
	// add in error reporting
	ini_set('display_errors','On');
	ini_set('html_errors',0);
	error_reporting(-1);
	//require('form_process.php');
	//require('../vendor/autoload.php');
	//use WindowsAzure\Common\ServicesBuilder;

	if ($_SERVER["REQUEST_METHOD"] == "GET") 
    {
        // else render form
		header("Location: ../log-in.php");die();

    }  
	elseif ($_SERVER["REQUEST_METHOD"] == "POST") 
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

			$loginname = mysqli_real_escape_string($conn,$loginname);
			$loginpassword = mysqli_real_escape_string($conn,$loginpassword);
            $passwordhashed = password_hash($loginpassword, PASSWORD_DEFAULT);
			$result = mysqli_query($conn,"SELECT * FROM logins where name='$loginname'")or die(mysql_error());
			if(!$result || mysqli_num_rows($result) <= 0)
			{
				echo($passwordhashed);
				echo("invalid user");
			}
			else 
			{
				$row = mysqli_fetch_assoc($result);
				if(password_verify($password,$row['password'])){
					echo "Password verified";
					session_start();
					$_SESSION["user"] = $loginname;
					$_SESSION["loginTime"] = date('Y-m-d H:i:s');
				header("Location: ../question-explanation.html");
				} else {
					echo "Wrong password";
				}
			}

			//Close the connection
            mysqli_close($conn);
		}
	}
     
?>
