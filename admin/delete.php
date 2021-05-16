<?php

include "../DB.php";

$id = $_GET['id'];
$table = $_GET['table'];
echo ("<br> Table : " . $table);
echo ("<br> ID : " . $id);
echo ("<br>");
$sql = "DELETE FROM $table WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
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
    echo "Error deleting record: " . $conn->error;
}
