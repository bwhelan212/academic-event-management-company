<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    session_start();

   
    if (!isset($_SESSION['email_user'])) {
        // Redirect user if session email is not set
        header("location:index.php");
        exit();
    }
    $email = $_SESSION['email_user'];
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    //data from form post
    
        // Get data from form post
    $eventName = $_POST['event-name'];
    $description = $_POST['description'];
    $eventType = $_POST['event-type'];
    $publishDate = $_POST['publish-date'];
    $startDateTime = $_POST['start-date'];
    $endDateTime = $_POST['end-date'];
    $abstractDeadline = $_POST['abstract-deadline'];
    $maxCapacity = $_POST['max-capacity'];
    $presenters = $_POST['presenters'];
    $keynoteSpeakers = $_POST['keynote-speakers'];
    $sponsors = $_POST['sponsors'];
    $venue = $_POST['venue'];
    $university = $_POST['university'];
    $address = $_POST['address'];

    
    //validation
    $isvalid = !empty($eventName) && !empty($description) && !empty($startDateTime) &&
    !empty($endDateTime) && !empty($abstractDeadline) && !empty($maxCapacity) &&
    !empty($presenters) && !empty($keynoteSpeakers) && !empty($sponsors) &&
    !empty($venue) && !empty($university) && !empty($address);
    //add password confirmation if we want

    //if valid insert the email and password into db
    if($isvalid) {
        define("DB_SERVER", "localhost");
        define("DB_USER", "root");
        define("DB_PWD", "");
        define("DB_NAME", "AEM2");

        $db = mysqli_connect(DB_SERVER, DB_USER, DB_PWD, DB_NAME);

        if (mysqli_connect_errno()) {
            $error_msg = "Database connection unsuccessful: ";
            $error_msg .= mysqli_connect_error();
            $error_msg .= " (" . mysqli_connect_errno() . ")";
            exit($error_msg);
        }

        $query = "INSERT INTO EVENT_DETAILS (Event_name, Event_description, Event_type, Publish_datetime, Start_datetime, End_datetime, Maximum_capacity, Last_timestamp_event) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())";
        $stmt = mysqli_prepare($db, $query);
        mysqli_stmt_bind_param($stmt, "ssssssi", $eventName, $description, $eventType, $publishDate, $startDateTime, $endDateTime, $maxCapacity);
        $isInserted =mysqli_stmt_execute($stmt);
        //$result = mysqli_stmt_get_result($stmt);
                //check update
        if($isInserted) {
            //if success redirect to index
             header("location:event-page.php?=email" . $email);
          } else {
            // UPDATE failed
            echo mysqli_error($db);
          }

      

        mysqli_stmt_close($stmt);
        mysqli_close($db);
    }



}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="output.css">
    <title>Add Event</title>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen py-5">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-gray-900 text-center">Add Event</h2>
        <form action = '' class="space-y-6" method = 'post'>
            <div>
                <label for="event-name" class="block text-sm font-medium text-gray-700">*Event name</label>
                <div class="mt-2">
                    <input type="text" id="event-name" name="event-name" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">*Description</label>
                <div class="mt-2">
                    <input type="text" id="description" name="description" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>
            <div>
                <label for="start-date" class="block text-sm font-medium text-gray-700">*Start Date + time</label>
                <div class="mt-2">
                    <input type="text" id="start-date" name="start-date" placeholder = "2024-06-03 12:40:00" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>
            <div>
                <label for="end-date" class="block text-sm font-medium text-gray-700">*End date + time</label>
                <div class="mt-2">
                    <input type="text" id="end-date" name="end-date" placeholder = "2024-06-03 12:40:00" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>
            <div>
                <label for="event-type" class="block text-sm font-medium text-gray-700" >Event type</label>
                <div class="mt-2">
                    <input type="text" id="event-type" name="event-type" placeholder = "Poster" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>
            <div>
                <label for="publish-date" class="block text-sm font-medium text-gray-700">Publish date time</label>
                <div class="mt-2">
                    <input type="text" id="publish-date" name="publish-date" placeholder = "2024-03-01 03:00:00" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>
            <div>
                <label for="max-capacity" class="block text-sm font-medium text-gray-700">*Maximum capacity</label>
                <div class="mt-2">
                    <input type="text" id="max-capacity" name="max-capacity" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>
            <div>
                <label for="abstract-deadline" class="block text-sm font-medium text-gray-700">*Abstract Deadline</label>
                <div class="mt-2">
                    <input type="text" id="abstract-deadline" name="abstract-deadline" placeholder = "2024-06-03 12:40:00" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>
            <div>
                <label for="presenters" class="block text-sm font-medium text-gray-700">*Presenters</label>
                <div class="mt-2">
                    <input type="text" id="presenters" name="presenters" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>
            <div>
                <label for="keynote-speakers" class="block text-sm font-medium text-gray-700">*Keynote Speakers</label>
                <div class="mt-2">
                    <input type="text" id="keynote-speakers" name="keynote-speakers" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>
            <div>
                <label for="sponsors" class="block text-sm font-medium text-gray-700">*Sponsors</label>
                <div class="mt-2">
                    <input type="text" id="sponsors" name="sponsors" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>
            <div>
                <label for="venue" class="block text-sm font-medium text-gray-700">*Venue</label>
                <div class="mt-2">
                    <input type="text" id="venue" name="venue" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>
            <div>
                <label for="university" class="block text-sm font-medium text-gray-700">*University</label>
                <div class="mt-2">
                    <input type="text" id="university" name="university" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>
            <div>
                <label for="address" class="block text-sm font-medium text-gray-700">*Address</label>
                <div class="mt-2">
                    <input type="text" id="address" name="address" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
            </div>
            <div>
                <button type="submit" class="w-full py-2 px-4 bg-indigo-600 text-white font-medium rounded-md shadow-sm hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Submit Event</button>
            </div>
        </form>
    </div>
</body>
</html>

<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add event</title>
</head>
<body>
    <form action="" method = 'post'>
        <div>
            <label for="event-name">Event name: </label>
            <input type="text" id="event-name" name = "event-name" required>
        </div>

        <div>
            <label for="description">Description: </label>
            <input type="text" id="description" name ="description" required>
        </div>

        <div>
            <label for="event-type">Event type: </label>
            <input type="text" id="description" name ="description" required>
        </div>

        <div>
            <label for="start-date">Start Date + time: </label>
            <input type="text" id="start-date" name = "start-date" placeholder = "2024-05-01 11:00:00" required>
        </div>

        <div>
            <label for="end-date">End date + time: </label>
            <input type="text" id="end-date" name="end-date" placeholder = "2024-05-01 11:00:00" required>
        </div>
    
       // <div>
        //    <label for="start-time">Start time: </label>
            <input type="text" id="start-time" name="start-time" placeholder = "2024-05-01 11:00:00"  required>
        </div>

        <div>
            <label for="end-time">End time: </label>
            <input type="text" id="end-time" name = "end-time" required>
        </div>
    
        <div>
            <label for="max-capacity">Maximum capacity: </label>
            <input type="text" id="max-capacity" name="max-capacity" required>
        </div>

        <div>
            <label for="abstract-deadline">Abstract Deadline: </label>
            <input type="text" id="abstract-deadline" name="abstract-deadline" placeholder = "2024-06-03 12:40:00" required>
        </div>

        <div>
            <label for="presenters">Presenters: </label>
            <input type="text" id="presenters" name="presenters" required>
        </div>

        <div>
            <label for="keynote-speakers">Keynote Speakers: </label>
            <input type="text" id="keynote-speakers" name="keynote-speakers" required>
        </div>
        
        <div>
            <label for="sponsors">Sponsors: </label>
            <input type="text" id="sponsors" name="sponsors" required>
        </div>

        <div>
            <label for="venue">Venue: </label>
            <input type="text" id="venue" name="venue" required>
        </div>

        <div>
            <label for="university">University: </label>
            <input type="text" id="university" name="university" required>
        </div>

        <div>
            <label for="address">Address: </label>
            <input type="text" id="address" name="address" required>
        </div>
        <button>Submit Event</button>
    </form>
    <a href="event-page.php"> home</a>
</body>
</html> -->