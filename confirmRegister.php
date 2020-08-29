<?php
    include 'connection.php';
    
    $fname = $lname = $email = $username = $password = $pwd = $phone = $cnumber = '';

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $pwd = $_POST['password'];
    $password = MD5($pwd);
    $phone = $_POST['phone'];
    $cnumber = $_POST['cnumber'];
   
    $sql = "INSERT INTO `users` VALUES ('','$fname', '$lname', '$email', '$username', '$password', '$phone', '$cnumber');";

    $result = $conn->query($sql);

    if($result){
 
        header("Location: login.php");

    }else{

        echo "Error :" . $sql;

    }

    
    $conn->close();
?>