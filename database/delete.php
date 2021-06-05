<?php 
include ('DB.php');

$id = $_POST['del_id'];
$sql = "DELETE FROM assignment WHERE id = '$id'";

if ($conn->query($sql) === TRUE) {
    $_SESSION['msg'] = "Record deleted successfully";
    $_SESSION['status'] = "Success";
    $conn->close();
} else {
    $_SESSION['msg'] = "Error deleting record: " . $conn->error;
    $_SESSION['status'] = "Fail";
}
?>