<?php
/*
echo $_SERVER['SERVER_NAME'] ."<br>";
echo $_SERVER['REMOTE_ADDR'] . "<br>";
echo $_SERVER['HTTP_HOST'] . "<br>";
*/
error_reporting(E_ALL);
ini_set('display_errors', 1);


if(!isset($_GET['email'])) {
    header("location:index.php");
}
$email = $_GET['email'];


//configuration
define("DB_SERVER", "localhost");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "");
define("DB_NAME", "AEM2");

//database connection
$db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if(!$db) {
    die ("Failed to connect to MySQL: " . mysqli_connect_error());
}


//query to select all columns from event_details table and unique rows
$sql = "SELECT DISTINCT ED.* ";
$sql .= "FROM EVENT_DETAILS ED ";
$sql .= "LEFT JOIN ORGANIZES O ON ED.Event_ID = O.Event_ID ";
$sql .= "LEFT JOIN USER_DETAILS UDO ON O.User_ID = UDO.User_ID ";
$sql .= "LEFT JOIN ATTENDS A ON ED.Event_ID = A.Event_ID ";
$sql .= "LEFT JOIN USER_DETAILS UDA ON A.User_ID = UDA.User_ID ";
$sql .= "WHERE (UDO.Email = '$email' OR UDA.Email = '$email') ";

//execute query
$result = mysqli_query($db, $sql);

//validate query
if (!$result) {
    exit("Database query failed.");
}

//display query
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Events</title>
</head>
<body>
    <h3>Events page</h3>
    <div>
        Add events or sign up for other Events
        <a href="event-signup.php"><button>Event sign up</button></a>
    </div>
    <a href="add-event.php"><button>Add event</button></a>
        <table>

            <tr>
                <th>Event ID</th>
                <th>Event_name</th>
                <th>Event Description</th>
                <th>Event type</th>
                <th>Publish datetime</th>
                <th>Start datetime</th>
                <th>End datetime</th>
                <th>Maximum Capacity</th>
                <th>Timestamp</th>
            </tr>
            <?php // loop through tasks
            while ($event = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $event['Event_ID']; ?></td>
                    <td><?php echo $event['Event_name']; ?></td>
                    <td><?php echo $event['Event_description']; ?></td>
                    <td><?php echo $event['Event_type']; ?></td>
                    <td><?php echo $event['Publish_datetime']; ?></td>
                    <td><?php echo $event['Start_datetime']; ?></td>
                    <td><?php echo $event['End_datetime']; ?></td>
                    <td><?php echo $event['Maximum_capacity']; ?></td>
                    <td><?php echo $event['Last_timestamp_event']; ?></td>
                </tr>
            <?php } // end loop ?>
        </table>

</body>
</html>

<?php
//free memeory
mysqli_free_result($result);
//close connection
mysqli_close($db);
?>