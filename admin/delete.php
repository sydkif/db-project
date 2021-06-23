<?php
session_start();
include "../database/DB.php";

$id = $_GET['id'];
$table = $_GET['table'];
$sql = "DELETE FROM $table WHERE id='$id'";

// To check if has modified something or not, if yes then prevent from being deleted.
if ($table == 'admin') {
    $admin = $conn->query("SELECT name FROM $table WHERE id='$id'")->fetch_assoc();
    $adminName = $admin['name'];

    $lecturer = $conn->query("SELECT modiBy FROM lecturer WHERE modiBy = '$adminName'")->fetch_assoc();
    $student = $conn->query("SELECT modiBy FROM student WHERE modiBy = '$adminName'")->fetch_assoc();
    $subject = $conn->query("SELECT modiBy FROM subject WHERE modiBy = '$adminName'")->fetch_assoc();
    if (($lecturer['modiBy'] != NULL) || ($student['modiBy'] != NULL) || ($subject['modiBy'] != NULL) || ($id == '1')) {
        $conn->close();
        $_SESSION['msg'] = "Delete Unsuccessful <br> Admin ('$adminName') is being used at other tables";
        if ($id == '1')
            $_SESSION['msg'] = "Bruh, you can't delete Super Admin la..";
        $_SESSION['status'] = "Fail";
        header("location:register/admin.php");
        die(); 
    }
}

if ($conn->query($sql) === TRUE) {
    $_SESSION['msg'] = "Record ('$table, $id')  deleted successfully";
    $_SESSION['status'] = "Success";
    $conn->close();
} else {
    if ($conn->errno == '1451') {
        $_SESSION['msg'] = ucfirst($table) . " ID ($id) is being used at other tables.";
    } else
        $_SESSION['msg'] = "$sql  <br> $conn->error <br> $conn->errno";
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
