<?php 
	session_start();
	ini_set('display_errors','On');
	ini_set('html_errors',0);
	error_reporting(-1);

	if ($_SERVER["REQUEST_METHOD"] == "GET") 
    {
        // else render form
		header("Location: ../log-in.php");die();
    }
	elseif ($_SERVER["REQUEST_METHOD"] == "POST") 
	{
		$vehicle = 0;
		$phone = 0;
		$text = 0;
		$email = 0;
	
		if( isset($_POST["vehicle"])){
			echo($_POST["vehicle"]);
			$vehicle = 1;
		}

		if( isset($_POST["phone"])){
			echo($_POST["phone"]);
			$vehicle = 1;

		}

		if( isset($_POST["text"])){
			echo($_POST["text"]);
			$vehicle = 1;

		}

		if( isset($_POST["email"])){
			echo($_POST["email"]);
			$vehicle = 1;

		}

		$host = "olivialogs.mysql.database.azure.com";
		$username = "devenhurt@olivialogs";
		$password = "LongLiveMedKit!";
		$db_name = "patient";
		$conn = mysqli_init();
		mysqli_real_connect($conn, $host, $username, $password, $db_name, 3306);
		if (mysqli_connect_errno($conn)) {
		die('Failed to connect to MySQL: '.mysqli_connect_error());
		}

		$result = mysqli_query($conn,"SELECT * FROM patientHRA where date='{$_SESSION["loginTime"]}' and patientUsername='{$_SESSION["user"]}'")or die(mysql_error());
		if(!$result || mysqli_num_rows($result) <= 0)
		{
			//new Row
			$recordID = $_SESSION["user"] . ' ' . date('Y-m-d H:i:s');

			//Create an Insert prepared statement and run it
			if ($stmt = mysqli_prepare($conn, "INSERT INTO patientHRA (id, date,patientUsername, text,email,vehicle,phone) VALUES (?, ?, ?, ?, ?, ?, ?)")) {
				mysqli_stmt_bind_param($stmt, 'sssiiii', $recordID, $_SESSION["loginTime"], $_SESSION["user"],$text,$email,$vehicle,$phone);
				mysqli_stmt_execute($stmt);
				//printf("Insert: Affected %d rows\n", mysqli_stmt_affected_rows($stmt));
				mysqli_stmt_close($stmt);
			}

			// Close the connection
			mysqli_close($conn);

			header("Location: ../main-profile.html");
		}
		else
		{
			//update
			//Run the Update statement
			if ($stmt = mysqli_prepare($conn, "UPDATE patientHRA SET text = ?, email = ?, vehicle = ?, phone = ? WHERE date = ? and patientUsername = ?")) {
				mysqli_stmt_bind_param($stmt, 'bbbbss', $text, $email,$vehicle,$phone,$_SESSION["loginTime"], $_SESSION["user"]);
				mysqli_stmt_execute($stmt);
				printf("Update: Affected %d rows\n", mysqli_stmt_affected_rows($stmt));
					
				//Close the connection
				mysqli_stmt_close($stmt);
			}

			header("Location: ../main-profile.html");
		}

		//Close the connection
		mysqli_close($conn); 

	}

?>
