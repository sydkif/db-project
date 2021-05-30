<?php
    session_start();
    include('../DB.php');

    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    $sql = "UPDATE " . $_SESSION['usertable'] . " SET password = '$password' WHERE admin.id = '" . $_SESSION['userid']."'";
    if ($conn->query($sql) === TRUE) {
        echo "<script>console.log('Table: ". $_SESSION['usertable']. "');</script>" ;
        echo "<script>console.log('pass: ". $password. "');</script>" ; 
        echo "<script>console.log('id: ". $_SESSION['userid']. "');</script>" ;
        header("Location: ../admin-dashboard/index.php?id=".$_SESSION['userid']."&name=". $_SESSION['usersname'] . ""); 
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }



?>