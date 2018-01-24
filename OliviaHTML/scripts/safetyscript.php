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
			$quest16 = trim($_POST["Q16"]);
			$quest17 = trim($_POST["Q17"]);
			$quest18 = trim($_POST["Q18"]);
			$quest19 = trim($_POST["Q19"]);
			$quest20 = trim($_POST["Q20"]);

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

			$quest16 = mysqli_real_escape_string($conn,$quest16);
			$quest17 = mysqli_real_escape_string($conn,$quest17);
			$quest18 = mysqli_real_escape_string($conn,$quest18);
			$quest19 = mysqli_real_escape_string($conn,$quest19);
			$quest20 = mysqli_real_escape_string($conn,$quest20);

			$result = mysqli_query($conn,"SELECT * FROM patientHRA where date='{$_SESSION["loginTime"]}' and patientUsername='{$_SESSION["user"]}'")or die(mysql_error());
			if(!$result || mysqli_num_rows($result) <= 0)
			{
				//new Row
				$recordID = $_SESSION["user"] . ' ' . date('Y-m-d H:i:s');

				//Create an Insert prepared statement and run it
				if ($stmt = mysqli_prepare($conn, "INSERT INTO patientHRA (id, date, patientUsername,question16,question17,question18,question19,question20) VALUES (?, ?, ?, ?, ?, ?, ?, ?)")) {
					mysqli_stmt_bind_param($stmt, 'sssiiiii', $recordID, $_SESSION["loginTime"], $_SESSION["user"],$quest16,$quest17,$quest18,$quest19,$quest20);
					mysqli_stmt_execute($stmt);
					//printf("Insert: Affected %d rows\n", mysqli_stmt_affected_rows($stmt));
					mysqli_stmt_close($stmt);
				}

				// Close the connection
				mysqli_close($conn);

				header("Location: ../socialquestions.html");
			}
			else
			{
				//update
				//Run the Update statement
				$new_product_price = 15.1;
				if ($stmt = mysqli_prepare($conn, "UPDATE patientHRA SET question16 = ?, question17 = ?, question18 = ?, question19 = ?, question20 = ?, WHERE date = ? and patientUsername = ?")) {
					mysqli_stmt_bind_param($stmt, 'ds', $quest16, $quest17,$quest18,$quest19,$quest20,$_SESSION["loginTime"], $_SESSION["user"]);
					mysqli_stmt_execute($stmt);
					printf("Update: Affected %d rows\n", mysqli_stmt_affected_rows($stmt));

				}
					//Close the connection
					mysqli_stmt_close($stmt);

					header("Location: ../socialquestions.html");
			}

			//Close the connection
			mysqli_close($conn); 
		}
	}

?>
