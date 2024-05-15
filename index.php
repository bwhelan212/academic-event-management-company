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
    <link rel="stylesheet" href="output.css">
</head>
<body>
    <div class="bg-white">
        <div class="mx-auto max-w-7xl py-24 sm:px-6 sm:py-32 lg:px-8">
            <div class="relative isolate overflow-hidden bg-gray-900 px-6 py-24 text-center shadow-2xl sm:rounded-3xl sm:px-16">
                <h2 class="mx-auto max-w-2xl text-3xl font-bold tracking-tight text-white sm:text-4xl">Welcome to the Academic Event Management Company!</h2>
                <p class="mx-auto mt-6 max-w-xl text-lg leading-8 text-gray-300">Please log in or sign up to continue!</p>
                <div class="mt-10 flex items-center justify-center gap-x-6">
                    <a href="login.php" class="rounded-md bg-white px-3.5 py-2.5 text-sm font-semibold text-gray-900 shadow-sm hover:bg-gray-100 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white">
                        <i class="fa-solid fa-right-to-bracket"></i> Log In
                    </a>
                    <a href="signup.php" class="rounded-md bg-white px-3.5 py-2.5 text-sm font-semibold text-gray-900 shadow-sm hover:bg-gray-100 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-white">
                        <i class="fa-regular fa-registered"></i> Sign Up
                    </a>
                </div>
                <svg viewBox="0 0 1024 1024" class="absolute left-1/2 top-1/2 -z-10 h-[64rem] w-[64rem] -translate-x-1/2 [mask-image:radial-gradient(closest-side,white,transparent)]" aria-hidden="true">
                    <circle cx="512" cy="512" r="512" fill="url(#827591b1-ce8c-4110-b064-7cb85a0b1217)" fill-opacity="0.7" />
                    <defs>
                        <radialGradient id="827591b1-ce8c-4110-b064-7cb85a0b1217">
                            <stop stop-color="#7775D6" />
                            <stop offset="1" stop-color="#E935C1" />
                        </radialGradient>
                    </defs>
                </svg>
            </div>
        </div>
    </div>
</body>
</html>
<!-- 
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
</html> -->

<?php

?>