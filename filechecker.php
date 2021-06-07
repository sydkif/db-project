<?php
session_start();
include('./database/DB.php');

$username = $_POST['user'];
$password = $_POST['pass'];
$table = $_POST['usertype'];
//to prevent from mysqli injection  
$sql = "select * from $table where id = '$username' and password = '$password'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$count = mysqli_num_rows($result);

$query = "SELECT name FROM $table WHERE id='$username'";
$results = mysqli_query($conn, $query);
$row = mysqli_fetch_array($results);
$_SESSION['usersname'] = $row['name'];

if ($table == "admin" && $count == 1) {

    $_SESSION["userid"] = $username;
    $_SESSION["userpassword"] = $password;
    $_SESSION['usertable'] = $table;

    if ($username == $password) {
        header("Location:resetpassword.php?id=$username");
    } else {
        header("Location: index.php");
    }
} else if ($table == "lecturer" && $count == 1) {

    $_SESSION["userid"] = $username;
    $_SESSION["userpassword"] = $password;
    $_SESSION['usertable'] = $table;

    if ($username == $password) {
        header("Location:resetpassword.php?id=$username");
    } else {
        header("Location: index.php");
    }
} else if ($table == "student" && $count == 1) {

    $_SESSION["userid"] = $username;
    $_SESSION["userpassword"] = $password;
    $_SESSION['usertable'] = $table;

    if ($username == $password) {
        header("Location:resetpassword.php?id=$username");
    } else {
        header("Location: index.php");
    }
} else {
    // $_SESSION['loginErr'] = "error";
    $_SESSION['status'] = "Fail";
    $_SESSION['msg'] = "Invalid User ID or Password";
    header("Location: index.php");
}

