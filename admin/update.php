<?php
session_start();
include "../DB.php";

$id = $_GET['id'];
$table = $_GET['table'];
$name = $_GET['name'];

$sql = "UPDATE $table SET name='$name' WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    $_SESSION['msg'] = "Record updated successfully";
    $_SESSION['status'] = "Success";
    $conn->close();
} else {
    $_SESSION['msg'] = "Error updating record: " . $conn->error;
    $_SESSION['status'] = "Fail";
}

if ($table == "admin")
    header("location:register/admin.php");
else if ($table == "lecturer")
    header("location:register/lecturer.php");
else if ($table == "student")
    header("location:register/student.php");
else if ($table == "subject")
    header("location:register/subject.php");
else
    header("location:/index.php");
