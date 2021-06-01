<?php
session_start();

if (isset($_SESSION['usertable'])) {
    if ($_SESSION['usertable'] == "admin") {
        header("Location:/admin/dashboard.php");
    } elseif ($_SESSION['usertable'] == "student") {
        header("Location:/student/dashboard.php");
    } elseif ($_SESSION['usertable'] == "lecturer") {
        header("Location:/lecturer/dashboard.php");
    }
} else
    header("Location:/login.php");
