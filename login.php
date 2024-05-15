<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    session_start();
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
            header('location: event-page.php?email=' .$email);
            exit();
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
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="login.css">
    <title>Log in</title>
</head>
<body>

<div class="wrapper">
    <form action="">
        <h1>Login</h1>
        <div class="input-box">
            <input type="email" placeholder="Email" required>
            <i class='bx bx-user-pin'></i>
        </div>
        <div class="input-box">
            <input type="password" placeholder="Password" required>
            <i class='bx bxs-lock-alt' ></i>
        </div>
        <div class="remember-forgot">
            <label><input type="checkbox" placeholder="Remember Me">Remember Me</label>
            <a href="#"> Forgot Password?</a>
        </div>
        <button type="Submit" class="btn">Log in</button>
    </form>





</div>

</body>
</html>
<!-- event page
print the events that the user organizes or attends
-->

