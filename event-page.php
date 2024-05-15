
<!-- add edit event, cancel event -->
<?php
/*
echo $_SERVER['SERVER_NAME'] ."<br>";
echo $_SERVER['REMOTE_ADDR'] . "<br>";
echo $_SERVER['HTTP_HOST'] . "<br>";
*/
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);


if(!isset($_GET['email'])) {
    header("location:index.php");
}
$email = $_GET['email'];

if(!isset($_SESSION['user_id'])) {
    header("location:index.php");
}
$user_id = $_SESSION['user_id'];



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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="output.css">
    <title>Your Events</title>
</head>
<body class="bg-gray-50 p-4">
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base font-semibold leading-6 text-gray-900">Events</h1>
                <p class="mt-2 text-sm text-gray-700">Add events or sign up for other Events</p>
            </div>
            <div class=" sm:ml-16 sm:mt-0 sm:flex-none flex flex-row gap-x-2 mt-4">
            <a href="event-signup.php">
                    <button type="button" class="my-auto block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Event sign up</button>
                </a>
                <a href="add-event.php">
                    <button type="button" class="my-auto block rounded-md bg-indigo-600 px-3 py-2  text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add event</button>
                </a>
            </div>
        </div>
        <div class="mt-8 flow-root">
            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Event ID</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Event Name</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Event Description</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Event Type</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Publish Datetime</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Start Datetime</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">End Datetime</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Maximum Capacity</th>
                                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">Timestamp</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                <!-- Example row (replace or repeat this block with actual data) -->
                                <tr>
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">1</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">Sample Event</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">Description of the sample event.</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">Type A</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">2024-05-15 10:00 AM</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">2024-06-01 09:00 AM</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">2024-06-01 05:00 PM</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">100</td>
                                    <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                        <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit<span class="sr-only">, Sample Event</span></a>
                                    </td>
                                </tr>
                                <!-- More rows... -->
                                <?php // loop through tasks
                                while ($event = mysqli_fetch_assoc($result)) { ?>
                                    <tr>
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6"><?php echo $event['Event_ID']; ?></td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"><?php echo $event['Event_name']; ?></td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"><?php echo $event['Event_description']; ?></td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"><?php echo $event['Event_type']; ?></td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"><?php echo $event['Publish_datetime']; ?></td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"><?php echo $event['Start_datetime']; ?></td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"><?php echo $event['End_datetime']; ?></td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"><?php echo $event['Maximum_capacity']; ?></td>
                                        <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6"><?php echo $event['Last_timestamp_event']; ?></td>
                                        <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                            <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit<span class="sr-only">, Sample Event</span></a>
                                        </td>
                                    </tr>
                                <?php } // end loop ?> 
                            </tbody>
                        </table>
                    </div>
                </div>
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
</html> -->

<?php
//free memeory
mysqli_free_result($result);
//close connection
mysqli_close($db);
?>