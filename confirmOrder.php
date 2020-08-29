<?php 
include_once('header1.php');
include 'connection.php';

session_start();
$id = $_SESSION['id'];

$uopid = $_POST['uop_id'];
$pay = $_POST['pay'];

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

<div id="main">
   <div class="confirmOrders">
     <div id="confirmOrder">
       <?php

            $sql = "SELECT addresses.country, addresses.city, addresses.postcode, addresses.street_name
                    FROM addresses
                    INNER JOIN users_addresses ON addresses.address_id = users_addresses.address_id
                    INNER JOIN users ON users_addresses.user_id = users.user_id
                    WHERE users.user_id = '$id'
                    GROUP BY addresses.address_id";
                    $rez = $conn->query($sql);      
                    
                    $row_cnt = $rez->num_rows;

            if($row_cnt > 0){

                while($red=$rez->fetch_assoc()){ 
                    $country = $red['country'];
                    $city = $red['city'];
                    $postc = $red['postcode'];
                    $street = $red['street_name'];

                    echo '<p>Potvrda porudzbine: </p>';
                    echo "</br>";
                    echo '<p>Adresa na koju ce porudzbina stici: ';
                    echo "<p>Drzava: " . $country . "</p>";
                    echo "<p>Grad: " . $city . "</p>";
                    echo "<p>Postanski broj: " . $postc . "</p>";
                    echo "<p>Naziv ulice: " . $street . "</p>";
                    echo "</br>";
                
                }
        
                 $sql = "SELECT users.first_name, users.last_name, users.card_number,
                           user_orders.user_order_id, user_orders.ordered_at
                         FROM user_orders
                         INNER JOIN users ON user_orders.user_id = users.user_id
                         WHERE user_orders.user_id = $id
                         GROUP BY user_orders.user_order_id"; 
                         $rez = $conn->query($sql);

                    while($red=$rez->fetch_assoc()){ 
                        $fname = $red['first_name'];
                        $lname = $red['last_name'];
                        $cnum = $red['card_number'];
                        $uoid= $red['user_order_id'];
                        $orderAt = $red['ordered_at'];


                        echo '<p>Ostale informacije: ';
                        echo "<p>Ime: " . $fname . "</p>";
                        echo "<p>Prezime: " . $lname . "</p>";
                        echo "<p>Broj kreditne kartice: " . $cnum . "</p>";
                        echo "<p>Broj porudzbine: " . $uoid . "</p>";
                        echo "<p>Porudzbina postavljena: " . $orderAt . "</p>";
                        echo "<p>Nacin placanja: " . $pay . "</p>";
                    }

                      $sql = "DELETE FROM `user_orders_products` WHERE user_order_id ='$uoid'";
                      $conn->query($sql);

                      $sql = "DELETE FROM `products` WHERE products.quantity = 0 ";
                      $conn->query($sql);

                    
            }else{
                header("Location: myAcc.php");
            }
       ?>
       </div>
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