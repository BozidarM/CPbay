<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>CPbay</title>
</head>
<body>

    <?php 
       include_once('mustLogin.php');
    ?>
    
    <div id="main">

<?php
    include 'connection.php';

    $id = $_SESSION['id'];

    $userQuan = $_POST['quantity'];
    $pid = $_POST['product_id'];
    
    if($userQuan > 0){

    $sql = "SELECT products.quantity, products.price FROM products WHERE product_id = '$pid'";
    $rez = $conn->query($sql);
    while($red=$rez->fetch_assoc()){ 
        $quantity = $red['quantity'];
        $price = $red['price'];
        }

    $timestamp = date("Y-m-d H:i:s");

    $sql = "SELECT `user_order_id` FROM `user_orders` WHERE `user_id` = '$id'";
    $rez = $conn->query($sql);

    $row_cnt = $rez->num_rows;

    if($row_cnt > 0){

    while($red=$rez->fetch_assoc()){ 
        $ouid = $red['user_order_id'];
        }
        if($userQuan <= $quantity){
            $oprice = $price * $userQuan;

            $left = $quantity - $userQuan;
            $sql = "UPDATE `products` SET `quantity` = '$left' WHERE `product_id` = '$pid'";
            $conn->query($sql);

            $sql = "INSERT INTO `user_orders_products` VALUES ('','$ouid','$pid' , '$userQuan', '$oprice')";
            $conn->query($sql) or die("Slog nije upisan" . $conn->error);

            echo '<div id="comment">';
            echo '<p>Uspesno ste dodali proizvod u korpu.</p>';
            echo '</div>';

            

        }else{
            echo '<div id="comment">';
            echo '<p> Nema toliko proizvoda na stanju!</p>';
            echo '</div>';
        }
       
    }else{
        
        $sql = "INSERT INTO `user_orders` VALUES ('', '$id', '$timestamp')";
        $conn->query($sql) or die("Slog nije upisan");

        $sql = "SELECT `user_order_id` FROM `user_orders` WHERE `user_id` = '$id'";
        $rez = $conn->query($sql);
    
        while($red=$rez->fetch_assoc()){ 
            $ouid = $red['user_order_id'];
            }
            if($userQuan <= $quantity){
                $oprice = $price * $userQuan;

                $left = $quantity - $userQuan;
                $sql = "UPDATE `products` SET `quantity` = '$left' WHERE `product_id` = '$pid'";
                $conn->query($sql);

                $sql = "INSERT INTO `user_orders_products` VALUES ('','$ouid','$pid' , '$userQuan', '$oprice')";
                $conn->query($sql) or die("Slog nije upisan");
    
                echo '<div id="comment">';
                echo '<p>Uspesno ste dodali proizvod u korpu.</p>';
                echo '</div>';

               
            }else{
                echo '<div id="comment">';
                echo '<p> Nema toliko proizvoda na stanju!</p>';
                echo '</div>';
            }
           
    }   
}else{
    echo "<div id='comment'>";
    echo "<p>Morate da uneseste kolicinu!</p>";
    echo "</div>";
}
    
?> 
    </div> 

    <div class="footer">
        <div class="column">
        <p> CPbay &copy; 2020</p>

        <div class="social-links">
                <a href="https://www.facebook.com/" target="_blank">
                    <img src="assets/social-icons/facebook.svg" alt="FB">
                </a>
                <a href="https://www.instagram.com/" target="_blank">
                    <img src="assets/social-icons/instagram.svg" alt="IG">
                </a>
                <a href="https://www.twitter.com/" target="_blank">
                    <img src="assets/social-icons/twitter.svg" alt="FB">
                </a>
            </div>
            </div>
        </div>
    </div>
</body>
</html>

<?php 
    $conn->close();
?>