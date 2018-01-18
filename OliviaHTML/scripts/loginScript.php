<?php 
	require('form_process.php');
	require('../vendor/autoload.php');
	use WindowsAzure\Common\ServicesBuilder;

	$host = 'olivialogs.mysql.database.azure.com';
	$username = 'devenhurt@olivialogs';
	$password = 'LongLiveMedKit!';
	$db_name = 'patient';

	echo($_POST["email"]);
	echo($_POST["password"]);

	if ($_SERVER["REQUEST_METHOD"] == "POST") //Switch to get
    {
        // else render form
        //render("../log-in.php", ["title" => "Log In"]);
		header("Location: ../log-in.php");

    }  
	else if ($_SERVER["REQUEST_METHOD"] == "GET")  //switch to post
	{
		/*if (empty($_POST["email"]))
        {
            //
        }
        else if (empty($_POST["password"]))
        {
            //
        }*/

		//Verify login input
		//Establishes the connection
		$conn = mysqli_init();
		mysqli_real_connect($conn, $host, $username, $password, $db_name, 3306);
		if (mysqli_connect_errno($conn)) {
		die('Failed to connect to MySQL: '.mysqli_connect_error());
		}

		//Run the Select query
		printf("Reading data from table: \n");
		$res = mysqli_query($conn, 'SELECT * FROM logins');
		while ($row = mysqli_fetch_assoc($res)) {
		var_dump($row);
		}

		//Close the connection
		mysqli_close($conn);



		//to redirect:
		//header("Location: ../question-explanation.html");

	}
     
?>
