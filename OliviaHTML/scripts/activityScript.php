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
			$quest1 = trim($_POST["Q1"]);
			$quest2 = trim($_POST["Q2"]);
			$quest3 = trim($_POST["Q3"]);
			$quest4 = trim($_POST["Q4"]);
			$quest5 = trim($_POST["Q5"]);

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

			$quest1 = mysqli_real_escape_string($conn,$quest1);
			$quest2 = mysqli_real_escape_string($conn,$quest2);
			$quest3 = mysqli_real_escape_string($conn,$quest3);
			$quest4 = mysqli_real_escape_string($conn,$quest4);
			$quest5 = mysqli_real_escape_string($conn,$quest5);

			echo($quest1);
			echo($quest2);
			echo($quest3);
			echo($quest4);
			echo($quest5);


			$result = mysqli_query($conn,"SELECT * FROM patientHRA where date='{$_SESSION["loginTime"]}' and patientUsername='{$_SESSION["user"]}'")or die(mysql_error());
			if(!$result || mysqli_num_rows($result) <= 0)
			{
				//new Row
				$recordID = $_SESSION["user"] . ' ' . date('Y-m-d H:i:s');

				//Create an Insert prepared statement and run it
				if ($stmt = mysqli_prepare($conn, "INSERT INTO patientHRA (id, date, patientUsername,question1,question2,question3,question4,question5) VALUES (?, ?, ?, ?, ?, ?, ?, ?)")) {
					mysqli_stmt_bind_param($stmt, 'sssiiiii', $recordID, $_SESSION["loginTime"], $_SESSION["user"],$quest1,$quest2,$quest3,$quest4,$quest5);
					mysqli_stmt_execute($stmt);
					//printf("Insert: Affected %d rows\n", mysqli_stmt_affected_rows($stmt));
					mysqli_stmt_close($stmt);
				}

				// Close the connection
				mysqli_close($conn);

				header("Location: ../nutritionquestions.html");
			}
			else
			{
				//update
				//Run the Update statement
				$new_product_price = 15.1;
				if ($stmt = mysqli_prepare($conn, "UPDATE patientHRA SET question1 = ?, question2 = ?, question3 = ?, question4 = ?, question5 = ?, WHERE date = ? and patientUsername = ?")) {
					if($stmt === FALSE){ die(mysqli_error($db_conx)); }
					mysqli_stmt_bind_param($stmt, 'iiiiiss', $quest1, $quest2,$quest3,$quest4,$quest5,$_SESSION["loginTime"], $_SESSION["user"]);
					if($stmt === FALSE){ die(mysqli_error($db_conx)); }
					mysqli_stmt_execute($stmt);
					printf("Update: Affected %d rows\n", mysqli_stmt_affected_rows($stmt));

				}
					//Close the connection
				mysqli_stmt_close($stmt);

					//header("Location: ../nutritionquestions.html");
			}

			//Close the connection
			mysqli_close($conn); 
		}

?>
