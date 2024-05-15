<!-- close all the connections -->
<?php
   error_reporting(E_ALL);
   ini_set('display_errors', 1);
    // server, username, password, and database name as constants
    define("DB_SERVER", "localhost");
    define("DB_USERNAME", "root");
    define("DB_PASSWORD", "");
    define("DB_NAME", "AEM2");
  
    //database connection
    $db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    if (mysqli_connect_errno()) {
        $error_msg = "Database connection unsuccessful: ";
        $error_msg .= mysqli_connect_error();
        $error_msg .= " (" . mysqli_connect_errno() . ")";
        exit($error_msg);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome!</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    <div class="container">
        <h1> Welcome to the Academic Event Management Company!</h1>
        <h2>Please log in or sign up to continue!</h2>
    </div>

    <div class="glass-container">
        <a href="login.php"><i class="fa-solid fa-right-to-bracket"></i></a>
        <br>
        <a href = "signup.php"><i class="fa-regular fa-registered"></i></a>
    </div>
<br>
</body>
</html>

<?php

?>