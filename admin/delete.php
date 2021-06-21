<?php
session_start();
include "../database/DB.php";

$id = $_GET['id'];
$table = $_GET['table'];
$sql = "DELETE FROM $table WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    $_SESSION['msg'] = "Record deleted successfully";
    $_SESSION['status'] = "Success";
    $conn->close();
} else {
    if ($conn->errno == '1451') {
        if ($table == "subject")
            $_SESSION['msg'] = "Subject ID (" . $id . ") currently assigned to a lecturer.";
        if ($table == "lecturer")
            $_SESSION['msg'] = "Lecturer ID (" . $id . ") currently assigned to a subject.";
        if ($table == "student")
            $_SESSION['msg'] = "Student ID (" . $id . ") currently assigned to a subject.";
    } else
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
