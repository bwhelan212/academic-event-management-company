<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("location:index.php");
    exit();
}

if (isset($_GET['event_id']) && isset($_GET['user_id'])) {
    $event_id = $_GET['event_id'];
    $user_id = $_GET['user_id'];

    // Connect to database
    require_once "config.php"; // Include database connection config

    // Add the user to the event in the ATTENDS table
    $query = "INSERT INTO ATTENDS (User_ID, Event_ID) VALUES (?, ?)";
    $stmt = mysqli_prepare($db, $query);
    mysqli_stmt_bind_param($stmt, "ii", $user_id, $event_id);
    mysqli_stmt_execute($stmt);

    // Redirect back to the event page after adding the user to the event
    header("location:event-page.php");
    exit();
} else {
    // Redirect if event_id or user_id is not provided
    header("location:index.php");
    exit();
}
?>
