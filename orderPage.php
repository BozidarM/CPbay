<?php 
include_once('mustLogin.php');
include 'connection.php';

$id = $_SESSION['id'];

define("DIN", 117);

$sql = "SELECT products.image, products.`name`, products.product_id, products.quantity AS 'product_quantity',
               user_orders_products.user_order_product_id, user_orders_products.quantity, user_orders_products.order_price, user_orders_products.user_order_id,
               user_orders.user_order_id, user_orders.user_id
 FROM user_orders_products
 INNER JOIN products ON  user_orders_products.product_id = products.product_id
 INNER JOIN user_orders ON  user_orders_products.user_order_id = user_orders.user_order_id
 WHERE user_orders.user_id = '$id'
 GROUP BY user_orders_products.user_order_product_id";
$rez = $conn->query($sql);

$row_cnt = $rez->num_rows;

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
    <?php
    if($row_cnt > 0){
    ?>
       <div class="orders">
    <?php
    while($red=$rez->fetch_assoc()){ 
        $pid = $red['product_id'];
        $img = $red['image'];
        $name = $red['name'];
        $quantity = $red['quantity'];
        $price = $red['order_price'];
        $uopid = $red['user_order_product_id'];
        $uoid = $red['user_order_id'];
        $pquan = $red['product_quantity'];

        $dinprice = $price * DIN;
        echo '<div class="order">';
        echo "<img src='$img' alt='Porudzbina'>";
        echo "<div class='naziv'>Naziv: $name </br></div>";
        echo "<div class='kolicina'>Kolicina: $quantity</div>";
        echo "<div class='cena'>Cena: $price Eur, $dinprice Din</div>";
        echo "<form method='POST' action='deleteOrder.php'>";
        echo "<input type='hidden' name='pid_id' value='$pid'>";
        echo "<input type='hidden' name='uop_id' value='$uopid'>";
        echo '<button type="submit" id="ukloniBtn">UKLONI</button>';
        echo "</form>";
        echo " </div>";
      }
        
        $sql = "SELECT SUM(user_orders_products.order_price) AS 'total' FROM user_orders_products WHERE user_orders_products.user_order_id = '$uoid'";
        $rez = $conn->query($sql);

        while($red=$rez->fetch_assoc()){ 
             $total = $red['total'];           
        }
        
        $dintotal = $total * DIN;
        
        echo'<div id="totalPrice">';
        echo "<p> Totalna cena: " . $total . " EUR, " . $dintotal . " DIN. </p>";
        echo'</div>';

        echo'<div class="cOrder">';
        echo"<form method='POST' action='confirmOrder.php'>";
        echo"<input type='hidden' name='uop_id' value='$uopid'>";
        ?>
        <div class="input-group">
           <label for="pay">Nacin placanja:</label>
           <select class="inputi" name="pay" id="pay">
                    <option value="karticom">Kreditnom karticom</option>
                    <option value="pouzecem">Pouzecem</option>
           </select>
        </div>
         
        <div class="btn-group">
        <button type="submit" id="cOrderBtn">POTVRDI KUPOVINU</button>
        </div>
        </form>
        </div>
        
         </div> 
        <?php 
   }else{
        echo '<div id="comment">';
        echo '<p> Vasa korpa je prazna!</p>';
        echo '</div>';
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


