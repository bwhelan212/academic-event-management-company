<?php
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
        <label for="first-name">First name:</label>
        <input type="text" id="first-name" name="first-name">

        <label for="last-name">Last Name: </label>
        <input type="text" id="last-name" name="last-name">

        <label for="email"><span>*</span>Email:</label>
        <input type="text" name = "email" id = "email" placeholder='bob@gmail.com' required >

        <label for="password"><span>*</span>Password:</label>
        <input type="text" name = "password" id = "password" placeholder='Enter password' required>

         <button type="submit">Submit</button>
    </form>
    
</body>
</html>

<?php
