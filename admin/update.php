<?php
session_start();
include "../database/DB.php";

$id = $_GET['id'];
$table = $_GET['table'];
$name = $_GET['name'];
$currentUser = $_SESSION['usersname'];
date_default_timezone_set("Asia/Kuala_Lumpur");
$currentTime = date("Y-m-d h:i:s");

if ($table == 'admin' && $id == '1') {
    $conn->close();
    $_SESSION['msg'] = "Bruh, you can't edit Super Admin la..";
    $_SESSION['status'] = "Fail";
    header("location:register/admin.php");
    die();
}

if ($table == 'lecturer' || $table == 'student'  || $table == 'subject')
    $sql = "UPDATE $table SET name='$name', modiBy='$currentUser', modiOn='$currentTime' WHERE id='$id'";
else
    $sql = "UPDATE $table SET name='$name' WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    $_SESSION['msg'] = "Record updated successfully";
    $_SESSION['status'] = "Success";
    $conn->close();
} else {
    $_SESSION['msg'] = $sql . "<br>" . $conn->error . "<br>" . $conn->errno;
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
