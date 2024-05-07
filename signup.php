<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    //data from form post
    $first_name = $_POST['first_name'] ?? '';
    $last_name = $_POST['last_name'] ?? '';
    $email= $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $password= $_POST['password'] ?? '';

    //validation

    $isvalid = true;
    if(!isset($first_name) || trim($first_name) === '') {
        echo "First name is required.";
        $isvalid = false;
    }

    if(!isset($last_name) || trim($last_name) === '') {
        echo "Last name is required.";
        $isvalid = false;
    }


    if(!isset($email) || trim($email) === '') {
        echo "Email is required.";
        $isvalid = false;
    }

    if(!isset($password) || trim($password) === '') {
        echo "Password is required.";
        $isvalid = false;
    }

    //add password confirmation if we want

    //if valid insert the email, password, user, pass into db
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
       
        $query = "INSERT INTO USER_DETAILS (User_first_name, User_last_name, User_password, Last_timestamp_user, Email, Phone) values('" . $first_name . "','" . $last_name . "','" . $password . "',NOW(),'" . $email . "','" .  $phone . "')";
        echo $query;
        $isInserted = mysqli_query($db, $query);
        //check update
        if($isInserted) {
            //if success redirect to index
             header("location:login.php");
          } else {
            // UPDATE failed
            echo mysqli_error($db);
          }
        echo $query;
        //free memeory
        mysqli_free_result($isInserted);
        // //close connection
        mysqli_close($db);
    }

    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
</head>
<body>
    <form action="" method ='post'>
        

        <div>
            <label for="first_name">First name:</label>
            <input type="text" id="first_name" name="first_name" required>
        </div>
        
        <div>
            <label for="last_name">Last Name: </label>
            <input type="text" id="last_name" name="last_name" required>
        </div>
        
        <div>
            <label for="email"><span>*</span>Email:</label>
            <input type="text" name = "email" id = "email" placeholder='bob@gmail.com' required >
        </div>

        <div>
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" required>
        </div>
     
        <div>
            <label for="password"><span>*</span>Password:</label>
            <input type="text" name = "password" id = "password" placeholder='Enter password' required>
        </div>
         <button type="submit">Submit</button>
    </form>
    
</body>
</html>

