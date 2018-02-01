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
			$quest31 = trim($_POST["Q31"]);
			$quest32 = trim($_POST["Q32"]);
			$quest33 = trim($_POST["Q33"]);
			$quest34 = trim($_POST["Q34"]);
			$quest35 = trim($_POST["Q35"]);

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

			$quest31 = mysqli_real_escape_string($conn,$quest31);
			$quest32 = mysqli_real_escape_string($conn,$quest32);
			$quest33 = mysqli_real_escape_string($conn,$quest33);
			$quest34 = mysqli_real_escape_string($conn,$quest34);
			$quest35 = mysqli_real_escape_string($conn,$quest35);

			$result = mysqli_query($conn,"SELECT * FROM patientHRA where date='{$_SESSION["loginTime"]}' and patientUsername='{$_SESSION["user"]}'")or die(mysql_error());
			if(!$result || mysqli_num_rows($result) <= 0)
			{
				//new Row
				$recordID = $_SESSION["user"] . ' ' . date('Y-m-d H:i:s');

				//Create an Insert prepared statement and run it
				if ($stmt = mysqli_prepare($conn, "INSERT INTO patientHRA (id, date, patientUsername,question31,question32,question33,question34,question35) VALUES (?, ?, ?, ?, ?, ?, ?, ?)")) {
					mysqli_stmt_bind_param($stmt, 'sssiiiii', $recordID, $_SESSION["loginTime"], $_SESSION["user"],$quest31,$quest32,$quest33,$quest34,$quest35);
					mysqli_stmt_execute($stmt);
					//printf("Insert: Affected %d rows\n", mysqli_stmt_affected_rows($stmt));
					mysqli_stmt_close($stmt);
				}

				// Close the connection
				mysqli_close($conn);

				header("Location: ../identityquestions.html");
			}
			else
			{
				//update
				//Run the Update statement
				if ($stmt = mysqli_prepare($conn, "UPDATE patientHRA SET question31 = ?, question32 = ?, question33 = ?, question34 = ?, question35 = ? WHERE date = ? and patientUsername = ?")) {
					mysqli_stmt_bind_param($stmt, 'iiiiiss', $quest31, $quest32,$quest33,$quest34,$quest35,$_SESSION["loginTime"], $_SESSION["user"]);
					mysqli_stmt_execute($stmt);
					printf("Update: Affected %d rows\n", mysqli_stmt_affected_rows($stmt));
				
					//Close the connection
					mysqli_stmt_close($stmt);
				}

				header("Location: ../identityquestions.html");
			}

			//Close the connection
			mysqli_close($conn); 
		}

?>
