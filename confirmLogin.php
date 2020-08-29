<?php
    include 'connection.php';

    $username = $password = $pwd = '';

    $username = $_POST['username'];
    $pwd = $_POST['password'];
    $password = MD5($pwd);

    $sql = "SELECT * FROM `users` WHERE `username` = '$username' AND `password_hash` = '$password'";

    $result = $conn->query($sql);
    $row_cnt = $result->num_rows;

    if($row_cnt > 0){
        
        while($red=$result->fetch_assoc()){
            $id = $red['user_id'];
            $username = $red['username'];

            if($_POST["remember_me"]=='1' || $_POST["remember_me"]=='on'){
                setcookie('username', $username, time()+86400, '/');
                setcookie('password', $pwd, time()+86400, '/');
             }

            session_start();
            $_SESSION['id'] = $id;
            $_SESSION['username'] = $username;
            $_SESSION['loggedin'] = true;

            
        }
       

        header("Location: myAcc.php");

    }else{
        echo '<link rel="stylesheet" href="main.css">';
        echo '<div id="invalid">';
            echo '<h2>Pogresan username ili password!</h2> ';
        echo '</div>';
    }
?>