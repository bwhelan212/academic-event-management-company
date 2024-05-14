<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    //data from form post
    
    //validation

    //add password confirmation if we want

    //if valid insert the email and password into db
    if($isvalid) {
        define("DB_SERVER", "localhost");
        define("DB_USER", "root");
        define("DB_PWD", "");
        define("DB_NAME", "AEM2");

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
        <input type="text" id="description" name ="description" required>
    </div>

    <div>
        <label for="start-date">Start Date: </label>
        <input type="text" id="start-date" name = "start-date" required>
    </div>

    <div>
        <label for="end-date">End date: </label>
        <input type="text" id="end-date" name="end-date" required>
    </div>
  
    <div>
        <label for="start-time">Start time: </label>
        <input type="text" id="start-time" name="start-time" required>
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
        <input type="text" id="abstract-deadline" name="abstract-deadline" required>
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
</body>
</html>