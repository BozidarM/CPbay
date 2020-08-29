<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

    include_once('header1.php');

} else{

    header("Location: login.php");
}

?>