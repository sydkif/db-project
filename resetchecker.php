<?php
session_start();
include('./database/DB.php');

$password = $_POST['password'];
$password_confirm = $_POST['password_confirm'];

$sql = "UPDATE " . $_SESSION['usertable'] . " SET password = '$password' WHERE id = '" . $_SESSION['userid'] . "'";
if ($conn->query($sql) === TRUE) {
  $_SESSION['status'] = "Success";
  $_SESSION['msg'] = "Password updated. You need to use the new password for next login.";
  header("Location: index.php");
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
