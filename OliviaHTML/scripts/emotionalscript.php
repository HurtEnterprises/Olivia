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
			$quest26 = trim($_POST["Q26"]);
			$quest27 = trim($_POST["Q27"]);
			$quest28 = trim($_POST["Q28"]);
			$quest29 = trim($_POST["Q29"]);
			$quest30 = trim($_POST["Q30"]);

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

			$quest26 = mysqli_real_escape_string($conn,$quest26);
			$quest27 = mysqli_real_escape_string($conn,$quest27);
			$quest28 = mysqli_real_escape_string($conn,$quest28);
			$quest29 = mysqli_real_escape_string($conn,$quest29);
			$quest30 = mysqli_real_escape_string($conn,$quest30);

			$result = mysqli_query($conn,"SELECT * FROM patientHRA where date='{$_SESSION["loginTime"]}' and patientUsername='{$_SESSION["user"]}'")or die(mysql_error());
			if(!$result || mysqli_num_rows($result) <= 0)
			{
				//new Row
				$recordID = $_SESSION["user"] . ' ' . date('Y-m-d H:i:s');

				//Create an Insert prepared statement and run it
				if ($stmt = mysqli_prepare($conn, "INSERT INTO patientHRA (id, date, patientUsername,question26,question27,question28,question29,question30) VALUES (?, ?, ?, ?, ?, ?, ?, ?)")) {
					mysqli_stmt_bind_param($stmt, 'sssiiiii', $recordID, $_SESSION["loginTime"], $_SESSION["user"],$quest26,$quest27,$quest28,$quest29,$quest30);
					mysqli_stmt_execute($stmt);
					//printf("Insert: Affected %d rows\n", mysqli_stmt_affected_rows($stmt));
					mysqli_stmt_close($stmt);
				}

				// Close the connection
				mysqli_close($conn);

				header("Location: ../mentalquestions.html");
			}
			else
			{
				//update
				//Run the Update statement
				$new_product_price = 15.1;
				if ($stmt = mysqli_prepare($conn, "UPDATE patientHRA SET question26 = ?, question27 = ?, question28 = ?, question29 = ?, question30 = ?, WHERE date = ? and patientUsername = ?")) {
					mysqli_stmt_bind_param($stmt, 'ds', $quest26, $quest27,$quest28,$quest29,$quest30,$_SESSION["loginTime"], $_SESSION["user"]);
					mysqli_stmt_execute($stmt);
					printf("Update: Affected %d rows\n", mysqli_stmt_affected_rows($stmt));

				}
					//Close the connection
					mysqli_stmt_close($stmt);

					header("Location: ../mentalquestions.html");
			}

			//Close the connection
			mysqli_close($conn); 
		}
	}

?>
