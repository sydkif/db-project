<?php

include "../DB.php";

$id = $_GET['id'];
$table = $_GET['table'];
$name = $_GET['name'];

$sql = "UPDATE $table SET name='$name' WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
    $conn->close();
    if ($table == "admin")
        header("location:register/admin.php");
    else if ($table == "lecturer")
        header("location:register/lecturer.php");
    else if ($table == "student")
        header("location:register/student.php");
    else
        header("location:/index.php");
} else {
    echo "Error updating record: " . $conn->error;
}
