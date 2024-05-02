
<?php
   
    // server, username, password, and database name as constants
    define("DB_SERVER", "localhost");
    define("DB_USERNAME","root");
    define("DB_PASSWORD", "");
    define("DB_NAME", "company");
  
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
</head>
<body>
    <h3> Welcome to the Academic Event Management Company! <br>Log in or Sign up to continue!</h3>
    <a href="login.php">Log in </a>
    <br>
    <a href = "signup.php">Sign up</a>
<br>
</body>
</html>
