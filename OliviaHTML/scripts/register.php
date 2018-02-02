<?php
    // add in error reporting
    ini_set('display_errors','On');
    ini_set('html_errors',0);
    error_reporting(-1);
    //require('form_process.php');
    //require('../vendor/autoload.php');
    //use WindowsAzure\Common\ServicesBuilder;
    
    if ($_SERVER["REQUEST_METHOD"] == "GET") //Switch to get
    {
        // else render form
        header("Location: ../account-set-up.php");die();
        
    }

    elseif ($_SERVER["REQUEST_METHOD"] == "POST")  //switch to post
    {
        //header("Location: ../question-explanation.html");die();
        if (empty($_POST["email"]) or empty($_POST["password"]) or empty($_POST["confirmpassword"]))
        {
            header("Location: ../account-set-up.php");die();
        }
        else
        {
            $loginname = trim($_POST["email"]);
            $loginpassword = trim($_POST["password"]);
            $loginconfirmpassword = trim($_POST["confirmpassword"]);
            
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
            
            //Run the Select query
            /*printf("Reading data from table: \n");
             $res = mysqli_query($conn, 'SELECT * FROM logins');
             while ($row = mysqli_fetch_assoc($res)) {
             var_dump($row);
             }*/
            $loginname = mysqli_real_escape_string($conn,$loginname);
            $loginpassword = mysqli_real_escape_string($conn,$loginpassword);
            echo($loginname);
            echo($loginpassword);
            $result = mysqli_query($conn,"SELECT * FROM logins where name='$loginname' and password='$loginpassword'")or die(mysql_error());
            if($loginpassword != $loginconfirmpassword)
            {
                echo("passwords do not match");
            }
            else
            {
                $passwordhashed = password_hash($loginpassword, PASSWORD_BCRYPT);
                mysqli_query($conn,"INSERT INTO logins (name,password) VALUES ('$loginname','$passwordhashed')");
                session_start();
                $_SESSION["user"] = $loginname;
                header("Location: ../question-explanation.html");
            }
            
            //Close the connection
            mysqli_close($conn);
        }
    }
    
    ?>

