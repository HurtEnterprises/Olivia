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
			$quest41 = trim($_POST["Q41"]);
			$quest42 = trim($_POST["Q42"]);
			$quest43 = trim($_POST["Q43"]);
			$quest44 = trim($_POST["Q44"]);
			$quest45 = trim($_POST["Q45"]);

			//Verify login input
			//Establishes the connection
			$host = "olivialogs.mysql.database.azure.com";
			$username = "devenhurt@olivialogs";
			$password = "LongLiveMedKit!";
			$db_name = "patient";
			$conn = mysqli_init();
			mysqli_real_connect($conn, $host, $username, $password, $db_name, 3456);
			if (mysqli_connect_errno($conn)) {
			die('Failed to connect to MySQL: '.mysqli_connect_error());
			}

			$quest41 = mysqli_real_escape_string($conn,$quest41);
			$quest42 = mysqli_real_escape_string($conn,$quest42);
			$quest43 = mysqli_real_escape_string($conn,$quest43);
			$quest44 = mysqli_real_escape_string($conn,$quest44);
			$quest45 = mysqli_real_escape_string($conn,$quest45);

			$result = mysqli_query($conn,"SELECT * FROM patientHRA where date='{$_SESSION["loginTime"]}' and patientUsername='{$_SESSION["user"]}'")or die(mysql_error());
			if(!$result || mysqli_num_rows($result) <= 0)
			{
				//new Row
				$recordID = $_SESSION["user"] . ' ' . date('Y-m-d H:i:s');

				//Create an Insert prepared statement and run it
				if ($stmt = mysqli_prepare($conn, "INSERT INTO patientHRA (id, date, patientUsername,question41,question42,question43,question44,question45) VALUES (?, ?, ?, ?, ?, ?, ?, ?)")) {
					mysqli_stmt_bind_param($stmt, 'sssiiiii', $recordID, $_SESSION["loginTime"], $_SESSION["user"],$quest41,$quest42,$quest43,$quest44,$quest45);
					mysqli_stmt_execute($stmt);
					//printf("Insert: Affected %d rows\n", mysqli_stmt_affected_rows($stmt));
					mysqli_stmt_close($stmt);
				}

				// Close the connection
				mysqli_close($conn);

				header("Location: ../valuesquestions.html");
			}
			else
			{
				//update
				//Run the Update statement
				$new_product_price = 15.1;
				if ($stmt = mysqli_prepare($conn, "UPDATE patientHRA SET question41 = ?, question42 = ?, question43 = ?, question44 = ?, question45 = ?, WHERE date = ? and patientUsername = ?")) {
					mysqli_stmt_bind_param($stmt, 'ds', $quest41, $quest42,$quest43,$quest44,$quest45,$_SESSION["loginTime"], $_SESSION["user"]);
					mysqli_stmt_execute($stmt);
					printf("Update: Affected %d rows\n", mysqli_stmt_affected_rows($stmt));

				}
					//Close the connection
					mysqli_stmt_close($stmt);

					header("Location: ../valuesquestions.html");
			}

			//Close the connection
			mysqli_close($conn); 
		}
	}

?>
