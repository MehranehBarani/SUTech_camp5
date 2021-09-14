<?php 
    session_start();
    if(!isset($_SESSION['islogin']) || !isset($_SESSION['role']) || $_SESSION['role'] != 1){
        header("Location:../login.php");
    }
?>