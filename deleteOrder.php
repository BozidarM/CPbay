<?php 
include_once('header1.php');
include 'connection.php';

$uopid = $_POST['uop_id'];
$pid = $_POST['pid_id'];
?>

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
         $sql = "SELECT user_orders_products.quantity FROM `user_orders_products` WHERE user_order_product_id ='$uopid'";
         $rez = $conn->query($sql);

         while($red=$rez->fetch_assoc()){ 
            $quantity = $red['quantity'];
            }

         $sql = "UPDATE `products` SET `quantity` = `quantity` + '$quantity' WHERE `product_id` = '$pid'";
         $conn->query($sql);
         
         $sql = "DELETE FROM `user_orders_products` WHERE user_order_product_id ='$uopid'";
         $conn->query($sql);
    ?>

<div id="main">
       <div id="comment">
           <p>Jedna porudzbina je izbrisana.</p>
       </div>
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