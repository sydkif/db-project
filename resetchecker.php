<?php
    session_start();
    include('./database/DB.php');

    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    $sql = "UPDATE " . $_SESSION['usertable'] . " SET password = '$password' WHERE id = '" . $_SESSION['userid']."'";
    if ($conn->query($sql) === TRUE) {
        echo "<script>console.log('Table: ". $_SESSION['usertable']. "');</script>" ;
        echo "<script>console.log('pass: ". $password. "');</script>" ; 
        echo "<script>console.log('id: ". $_SESSION['userid']. "');</script>" ;
        header("Location: index.php");
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }



?>