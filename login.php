<?php
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    //data from form post
    $email= $_POST['email'] ?? '';
    $password= $_POST['password'] ?? '';

    //validation

    $isvalid = true;
    if(!isset($email) || trim($email) === '') {
        echo "Email is required.";
        $isvalid = false;
    }

    if(!isset($password) || trim($password) === '') {
        echo "Password is required.";
        $isvalid = false;
    }

    //add password confirmation if we want

   // retrieve query from db for login and if in db go to event-page
    if($isvalid) {
        define("DB_SERVER", "localhost");
        define("DB_USERNAME", "root");
        define("DB_PASSWORD", "");
        define("DB_NAME", "AEM2");

        $db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

        if (mysqli_connect_errno()) {
            $error_msg = "Database connection unsuccessful: ";
            $error_msg .= mysqli_connect_error();
            $error_msg .= " (" . mysqli_connect_errno() . ")";
            exit($error_msg);
        }

        $query = "SELECT Email, User_password FROM USER_DETAILS WHERE Email=? and User_password=?";
        $stmt = mysqli_prepare($db, $query);
        mysqli_stmt_bind_param($stmt, "ss", $email, $password);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_num_rows($result);
        $count = mysqli_num_rows($result);

        if($count == 1) {
            $_SESSION['email_user'] = $email;
            header('location: event-page.php');
        } else {
            $error = "Your Email or Password is invalid";
            echo "invalid email or pass";
        }

    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
</head>
<body>
    <form action="" method ='post'>
        <label for="email"><span>*</span>Email:</label>
        <input type="text" name = "email" id = "email" placeholder='bob@gmail.com' required >

        <label for="password"><span>*</span>Password:</label>
        <input type="text" name = "password" id = "password" placeholder='Enter password' required>

         <button type="submit">Submit</button>
    </form>
    
</body>
</html>


