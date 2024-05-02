<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    //data from form post
    
    //validation

    //add password confirmation if we want

    //if valid insert the email and password into db
    if($isvalid) {
        define("DB_SERVER", "localhost");
        define("DB_USERNAME","root");
        define("DB_PASSWORD", "");
        define("DB_NAME", "company");

        $db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

        if (mysqli_connect_errno()) {
            $error_msg = "Database connection unsuccessful: ";
            $error_msg .= mysqli_connect_error();
            $error_msg .= " (" . mysqli_connect_errno() . ")";
            exit($error_msg);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add event</title>
</head>
<body>
    <div>
        <label for="event-name">Event name: </label>
        <input type="text" id="event-name" name = "event-name" required>
    </div>

    <div>
        <label for="description">Description: </label>
        <input type="text" id="description" name ="description">
    </div>

    <div>
        <label for="start-date">Start Date: </label>
        <input type="text" id="start-date" name = "start-date">
    </div>

    <div>
        <label for="end-date">End date: </label>
        <input type="text" id="end-date" name="end-date">
    </div>
  
    <div>
        <label for="start-time">Start time: </label>
        <input type="text" id="start-time" name="start-time">
    </div>

    <div>
        <label for="end-time">End time: </label>
        <input type="text" id="end-time" name = "end-time">
    </div>
    
    <div>
        <label for="max-capacity">Maximum capacity: </label>
        <input type="text" id="max-capacity" name="max-capacity">
    </div>

    <div>
        <label for="abstract-deadline">Abstract Deadline: </label>
        <input type="text" id="abstract-deadline" name="abstract-deadline">
    </div>

    <div>
        <label for="presenters">Presenters: </label>
        <input type="text" id="presenters" name="presenters">
    </div>

    <div>
        <label for="keynote-speakers">Keynote Speakers: </label>
        <input type="text" id="keynote-speakers" name="keynote-speakers">
    </div>
    
    <div>
        <label for="sponsors">Sponsors: </label>
        <input type="text" id="sponsors" name="sponsors">
    </div>

    <div>
        <label for="venue">Venue: </label>
        <input type="text" id="venue" name="venue">
    </div>

    <div>
        <label for="university">University: </label>
        <input type="text" id="university" name="university">
    </div>

    <div>
        <label for="address">Address: </label>
        <input type="text" id="address" name="address">
    </div>
</body>
</html>