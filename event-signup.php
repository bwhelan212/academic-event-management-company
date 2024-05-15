<?php
// make it so page reloads when they add an event and do dummy data + views
    session_start();
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    if(!isset($_SESSION['user_id'])) {
        header("location:index.php");
    }
    $user_id = $_SESSION['user_id'];
    // echo $user_id;


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
    
    //query evnent nanes
    $query ="SELECT ED.Event_ID, Event_name, Event_description, Event_type, Start_datetime, End_datetime
            FROM EVENT_DETAILS ED
            LEFT JOIN ORGANIZES O ON ED.Event_ID = O.Event_ID
            LEFT JOIN USER_DETAILS UDO ON O.User_ID = UDO.User_ID
            LEFT JOIN ATTENDS A ON ED.Event_ID = A.Event_ID
            LEFT JOIN USER_DETAILS UDA ON A.User_ID = UDA.User_ID
            WHERE (UDO.User_ID IS NULL OR UDO.Email <> 'user_email') AND (UDA.User_ID IS NULL OR UDA.Email <> 'user_email')";
    
    //  "SELECT Event_ID, Event_name, Event_description, Event_type, Start_datetime, End_datetime, Organizer_ID
    //     FROM EVENT_DETAILS, ORGANIZES 
    //     WHERE Event_ID NOT IN (
    //         SELECT Event_ID FROM ATTENDS WHERE user_id = '$user_id'
    //     ) AND organizer_id != '$user_id'";

    $result = mysqli_query($db, $query);

    if (!$result) {
        exit("Database query failed.");
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Events</title>
</head>
<body>
    <h3>Event sign up</h3>
    <div>
        Sign up for events here
    </div>
        <table>

            <tr>
                <th>Event_name</th>
                <th>Event Description</th>
                <th>Event type</th>
                <th>Start datetime</th>
                <th>End datetime</th>
            </tr>
            <?php // loop through tasks
            while ($event = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $event['Event_name']; ?></td>
                    <td><?php echo $event['Event_description']; ?></td>
                    <td><?php echo $event['Event_type']; ?></td>
                    <td><?php echo $event['Start_datetime']; ?></td>
                    <td><?php echo $event['End_datetime']; ?></td>
                    <td>
                        <td><?php echo ("<a href='event-signup.php?event_id=" .$event['Event_ID']. "'>Add</a>") ?></td>

                    </td>
                </tr>
            <?php } // end loop ?>
        </table>

</body>
</html>
<?php
      mysqli_free_result($result);
      // //close connection
      mysqli_close($db);
?>