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
			$quest6 = trim($_POST["Q6"]);
			$quest7 = trim($_POST["Q7"]);
			$quest8 = trim($_POST["Q8"]);
			$quest9 = trim($_POST["Q9"]);
			$quest10 = trim($_POST["Q10"]);

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

			$quest6 = mysqli_real_escape_string($conn,$quest6);
			$quest7 = mysqli_real_escape_string($conn,$quest7);
			$quest8 = mysqli_real_escape_string($conn,$quest8);
			$quest9 = mysqli_real_escape_string($conn,$quest9);
			$quest10 = mysqli_real_escape_string($conn,$quest10);

			$result = mysqli_query($conn,"SELECT * FROM patientHRA where date='{$_SESSION["loginTime"]}' and patientUsername='{$_SESSION["user"]}'")or die(mysql_error());
			if(!$result || mysqli_num_rows($result) <= 0)
			{
				//new Row
				$recordID = $_SESSION["user"] . ' ' . date('Y-m-d H:i:s');

				//Create an Insert prepared statement and run it
				if ($stmt = mysqli_prepare($conn, "INSERT INTO patientHRA (id, date, patientUsername,question6,question7,question8,question9,question10) VALUES (?, ?, ?, ?, ?, ?, ?, ?)")) {
					mysqli_stmt_bind_param($stmt, 'sssiiiii', $recordID, $_SESSION["loginTime"], $_SESSION["user"],$quest6,$quest7,$quest8,$quest9,$quest10
					mysqli_stmt_execute($stmt);
					//printf("Insert: Affected %d rows\n", mysqli_stmt_affected_rows($stmt));
					mysqli_stmt_close($stmt);
				}

				// Close the connection
				mysqli_close($conn);

				header("Location: ../generalquestions.html");
			}
			else
			{
				//update
				//Run the Update statement
				$new_product_price = 15.1;
				if ($stmt = mysqli_prepare($conn, "UPDATE patientHRA SET question6 = ?, question7 = ?, question8 = ?, question9 = ?, question10 = ?, WHERE date = ? and patientUsername = ?")) {
					mysqli_stmt_bind_param($stmt, 'ds', $quest6, $quest7,$quest8,$quest9,$quest10,$_SESSION["loginTime"], $_SESSION["user"]);
					mysqli_stmt_execute($stmt);
					printf("Update: Affected %d rows\n", mysqli_stmt_affected_rows($stmt));

				}
					//Close the connection
					mysqli_stmt_close($stmt);

					header("Location: ../generalquestions.html");
			}

			//Close the connection
			mysqli_close($conn); 
		}
	}

?>
