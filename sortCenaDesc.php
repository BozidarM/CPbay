<?php
    include 'connection.php';
    include_once('changeHeader.php');
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
        <div class="column">
         <div id="filter-bar">
            <a id="link1" href="novo.php">SAMO NOVI PROIZVODI</a>
            <a id="link2" href="polovno.php">SAMO POLOVNI PROIZVODI</a>
            <a id="link3" href="sortNaziv.php">SORTIRAJ PO NAZIVU</a>
            <a id="link4" href="sortNazivDesc.php">SORTIRAJ PO NAZIVU - OPADAJUCE</a>
            <a id="link5" href="sortCena.php">SORTIRAJ PO CENI</a>
            <a id="link6" href="sortCenaDesc.php">SORTIRAJ PO CENI - OPADAJUCE</a>
            <?php 
                $sql = "SELECT COUNT(products.product_id) AS 'number_of_products' FROM products";
                $rez = $conn->query($sql);  

                while($red=$rez->fetch_assoc()){ 
                   $nproduct = $red['number_of_products'];
                }

                echo "<p>Prikazano: " . $nproduct . " rezultata </p>" 
            ?>
          </div>

          <div id="artikli">
           <?php
               $sql = "SELECT products.*, sellers.`name` AS 'seller_name'
                       FROM products
                       INNER JOIN sellers ON products.seller_id = sellers.seller_id
                       GROUP BY products.product_id
                       ORDER BY products.price DESC;";
                $rez = $conn->query($sql);  

                while($red=$rez->fetch_assoc()){ 
                    $id = $red['product_id'];
                    $name = $red['name'];
                    $price = $red['price'];
                    $description = $red['description'];
                    $sellerName = $red['seller_name'];
                    $condition = $red['condition'];
                    $img = $red['image'];
                    $quantity= $red['quantity'];
  
                 
                      echo '<div class="artikal">';
                        echo "<img src='$img' alt='Artikal'>";
                        echo "<div class='cena'>$price Eur</div>";
                        echo "<div class='naziv'>$name </br></div>";
                        echo "<div class='opis'>Opis: $description</div>";
                        echo "<div class='stanje'>Stanje: $condition</div>";
                        echo "<div class='prodavac'>Ime prodavca: $sellerName</div>";
                        echo "<div class='kolicina'>Na stanju: $quantity</div>";
                        echo "<form method='POST' action='cart.php'>";
                        echo "<input type='hidden' name='product_id' value='$id'>";
                        echo "<input type='number' id='quantity' name='quantity' placeholder='Kolicina...'>";
                        echo '<button type="submit" id="poruciBtn">PORUCI</button>';
                        echo "</form>";
                      echo " </div>";
                  }

                $conn->close();
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