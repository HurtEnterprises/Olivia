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
			$quest11 = trim($_POST["Q11"]);
			$quest12 = trim($_POST["Q12"]);
			$quest13 = trim($_POST["Q13"]);
			$quest14 = trim($_POST["Q14"]);
			$quest15 = trim($_POST["Q15"]);

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

			$quest11 = mysqli_real_escape_string($conn,$quest11);
			$quest12 = mysqli_real_escape_string($conn,$quest12);
			$quest13 = mysqli_real_escape_string($conn,$quest13);
			$quest14 = mysqli_real_escape_string($conn,$quest14);
			$quest15 = mysqli_real_escape_string($conn,$quest15);

			$result = mysqli_query($conn,"SELECT * FROM patientHRA where date='{$_SESSION["loginTime"]}' and patientUsername='{$_SESSION["user"]}'")or die(mysql_error());
			if(!$result || mysqli_num_rows($result) <= 0)
			{
				//new Row
				$recordID = $_SESSION["user"] . ' ' . date('Y-m-d H:i:s');

				//Create an Insert prepared statement and run it
				if ($stmt = mysqli_prepare($conn, "INSERT INTO patientHRA (id, date, patientUsername,question11,question12,question13,question14,question15) VALUES (?, ?, ?, ?, ?, ?, ?, ?)")) {
					mysqli_stmt_bind_param($stmt, 'sssiiiii', $recordID, $_SESSION["loginTime"], $_SESSION["user"],$quest11,$quest12,$quest13,$quest14,$quest15);
					mysqli_stmt_execute($stmt);
					//printf("Insert: Affected %d rows\n", mysqli_stmt_affected_rows($stmt));
					mysqli_stmt_close($stmt);
				}
				// Close the connection
				mysqli_close($conn);

				header("Location: ../safetyquestions.html");
			}
			else
			{
				//update
				//Run the Update statement
				if ($stmt = mysqli_prepare($conn, "UPDATE patientHRA SET question11 = ?, question12 = ?, question13 = ?, question14 = ?, question15 = ? WHERE date = ? and patientUsername = ?")) {
					mysqli_stmt_bind_param($stmt, 'iiiiiss', $quest11, $quest12,$quest13,$quest14,$quest15,$_SESSION["loginTime"], $_SESSION["user"]);
					mysqli_stmt_execute($stmt);
					printf("Update: Affected %d rows\n", mysqli_stmt_affected_rows($stmt));
					
					//Close the connection
					mysqli_stmt_close($stmt);
				}

				header("Location: ../safetyquestions.html");
			}

			//Close the connection
			mysqli_close($conn); 
		}

?>
