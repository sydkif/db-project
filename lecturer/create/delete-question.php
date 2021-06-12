<?php
session_start();
include "../../database/DB.php";

$id = $_GET['id'];
$table = $_GET['table'];
$sql = "DELETE FROM $table WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    $_SESSION['msg'] = "Record deleted successfully";
    $_SESSION['status'] = "Success";
    $conn->close();
} else {
    $_SESSION['msg'] = "Error deleting record: " . $conn->error;
    $_SESSION['status'] = "Fail";
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
