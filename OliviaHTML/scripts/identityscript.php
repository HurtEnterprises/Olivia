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
			$quest36 = trim($_POST["Q36"]);
			$quest37 = trim($_POST["Q37"]);
			$quest38 = trim($_POST["Q38"]);
			$quest39 = trim($_POST["Q39"]);
			$quest40 = trim($_POST["Q40"]);

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

			$quest36 = mysqli_real_escape_string($conn,$quest36);
			$quest37 = mysqli_real_escape_string($conn,$quest37);
			$quest38 = mysqli_real_escape_string($conn,$quest38);
			$quest39 = mysqli_real_escape_string($conn,$quest39);
			$quest40 = mysqli_real_escape_string($conn,$quest40);

			$result = mysqli_query($conn,"SELECT * FROM patientHRA where date='{$_SESSION["loginTime"]}' and patientUsername='{$_SESSION["user"]}'")or die(mysql_error());
			if(!$result || mysqli_num_rows($result) <= 0)
			{
				//new Row
				$recordID = $_SESSION["user"] . ' ' . date('Y-m-d H:i:s');

				//Create an Insert prepared statement and run it
				if ($stmt = mysqli_prepare($conn, "INSERT INTO patientHRA (id, date, patientUsername,question36,question37,question38,question39,question40) VALUES (?, ?, ?, ?, ?, ?, ?, ?)")) {
					mysqli_stmt_bind_param($stmt, 'sssiiiii', $recordID, $_SESSION["loginTime"], $_SESSION["user"],$quest36,$quest37,$quest38,$quest39,$quest40);
					mysqli_stmt_execute($stmt);
					//printf("Insert: Affected %d rows\n", mysqli_stmt_affected_rows($stmt));
					mysqli_stmt_close($stmt);
				}


				// Close the connection
				mysqli_close($conn);

				header("Location: ../occupationalquestions.html");
			}
			else
			{
				//update
				//Run the Update statement
				if ($stmt = mysqli_prepare($conn, "UPDATE patientHRA SET question36 = ?, question37 = ?, question38 = ?, question39 = ?, question40 = ? WHERE date = ? and patientUsername = ?")) {
					mysqli_stmt_bind_param($stmt, 'iiiiiss', $quest36, $quest37,$quest38,$quest39,$quest40,$_SESSION["loginTime"], $_SESSION["user"]);
					mysqli_stmt_execute($stmt);
					printf("Update: Affected %d rows\n", mysqli_stmt_affected_rows($stmt));
					
					//Close the connection
					mysqli_stmt_close($stmt);
				}

				header("Location: ../occupationalquestions.html");
			}

			//Close the connection
			mysqli_close($conn); 
		}

?>
