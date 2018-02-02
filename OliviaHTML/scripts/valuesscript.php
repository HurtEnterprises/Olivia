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
			$quest46 = trim($_POST["Q46"]);
			$quest47 = trim($_POST["Q47"]);
			$quest48 = trim($_POST["Q48"]);
			$quest49 = trim($_POST["Q49"]);
			$quest50 = trim($_POST["Q50"]);

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

			$quest46 = mysqli_real_escape_string($conn,$quest46);
			$quest47 = mysqli_real_escape_string($conn,$quest47);
			$quest48 = mysqli_real_escape_string($conn,$quest48);
			$quest49 = mysqli_real_escape_string($conn,$quest49);
			$quest50 = mysqli_real_escape_string($conn,$quest50);

			$result = mysqli_query($conn,"SELECT * FROM patientHRA where date='{$_SESSION["loginTime"]}' and patientUsername='{$_SESSION["user"]}'")or die(mysql_error());
			if(!$result || mysqli_num_rows($result) <= 0)
			{
				//new Row
				$recordID = $_SESSION["user"] . ' ' . date('Y-m-d H:i:s');

				//Create an Insert prepared statement and run it
				if ($stmt = mysqli_prepare($conn, "INSERT INTO patientHRA (id, date, patientUsername,question46,question47,question48,question49,question50) VALUES (?, ?, ?, ?, ?, ?, ?, ?)")) {
					mysqli_stmt_bind_param($stmt, 'sssiiiii', $recordID, $_SESSION["loginTime"], $_SESSION["user"],$quest46,$quest47,$quest48,$quest49,$quest50);
					mysqli_stmt_execute($stmt);
					//printf("Insert: Affected %d rows\n", mysqli_stmt_affected_rows($stmt));
					mysqli_stmt_close($stmt);
				}

				// Close the connection
				mysqli_close($conn);

				header("Location: ../finish.html");
			}
			else
			{
				//update
				//Run the Update statement
				if ($stmt = mysqli_prepare($conn, "UPDATE patientHRA SET question46 = ?, question47 = ?, question48 = ?, question49 = ?, question50 = ? WHERE date = ? and patientUsername = ?")) {
					mysqli_stmt_bind_param($stmt, 'iiiiiss', $quest46, $quest47,$quest48,$quest49,$quest50,$_SESSION["loginTime"], $_SESSION["user"]);
					mysqli_stmt_execute($stmt);
					printf("Update: Affected %d rows\n", mysqli_stmt_affected_rows($stmt));

					//Close the connection
					mysqli_stmt_close($stmt);

				}


					header("Location: ../finish.html");
			}

			//Close the connection
			mysqli_close($conn); 
		}

?>
