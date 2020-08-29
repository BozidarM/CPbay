<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>CPbay</title>
</head>
<body>
    <div class="first-page">
        <div id="welcome-title">
            <h1>Dobro došli na internet prodavnicu CPbay!</h1>
        </div>
        <div id="enter-btn">
            <a href="products.php">KRENITE U KUPOVINU</a>
        </div>
        <div id="database-info">
            <p>
                <?php

                   $db = 'cpbay_sii';
                   $host = 'localhost';
                   $user = 'bozidar';
                   $password = 'boza';

                   $objekat = new mysqli($host, $user, $password, $db);
                   if ($objekat->connect_error){
                       die("Konekcija nije uspela</br>" . $objekat->connect_error);
                   }else{
                       echo"Konekcija je uspela.</br>";
                   }
                
                   $sql = "SET foreign_key_checks = 0";
                   $objekat->query($sql);

                   $sql = 'DROP TABLE IF EXISTS `addresses`';
                   $objekat->query($sql) or die('Greška u prvoj drop naredbi! ');
                   
                   $sql = 'DROP TABLE IF EXISTS `sellers`';
                   $objekat->query($sql) or die('Greška u drugoj naredbi! ');
                   
                   $sql = 'DROP TABLE IF EXISTS `shop_comments`';
                   $objekat->query($sql) or die('Greška u trecoj drop naredbi! ');
                    
                   $sql = 'DROP TABLE IF EXISTS `products`';
                   $objekat->query($sql) or die('Greška u cetvrtoj drop naredbi! '); 

                   $sql = 'DROP TABLE IF EXISTS `user_orders`';
                   $objekat->query($sql) or die('Greška u petoj drop naredbi! '); 

                   $sql = 'DROP TABLE IF EXISTS `user_orders_products`';
                   $objekat->query($sql) or die('Greška u sestoj drop naredbi! '); 

                   $sql = 'DROP TABLE IF EXISTS `users`';
                   $objekat->query($sql) or die('Greška u sedmoj drop naredbi! '); 

                   $sql = 'DROP TABLE IF EXISTS `users_addresses`';
                   $objekat->query($sql) or die('Greška u osmoj drop naredbi! '); 
                   
                   $sql = "SET foreign_key_checks = 1";
                   $objekat->query($sql);

                   $sql = 'CREATE TABLE `addresses`  (
                    `address_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                    `city` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
                    `postcode` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
                    `country` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
                    `street_name` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
                    PRIMARY KEY (`address_id`) USING BTREE
                    )';
                    $objekat->query($sql) or die("Tabela ne može da se kreira. ");
                    echo"Tabela address je kreirana. ";

                   $sql = "CREATE TABLE `sellers`  (
                    `seller_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                    `name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
                    PRIMARY KEY (`seller_id`) USING BTREE
                    )";
                    $objekat->query($sql) or die("Tabela ne može da se kreira. ");
                    echo"Tabela sellers je kreirana. ";

                   $sql = "CREATE TABLE `users`  (
                     `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                     `first_name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
                     `last_name` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
                     `email` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
                     `username` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
                     `password_hash` varchar(128) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
                     `phone` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
                     `card_number` varchar(16) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
                     PRIMARY KEY (`user_id`) USING BTREE,
                     UNIQUE INDEX `uq_users_email`(`email`) USING BTREE,
                     UNIQUE INDEX `uq_users_username`(`username`) USING BTREE,
                     UNIQUE INDEX `uq_users_card_number`(`card_number`) USING BTREE
                     )";
                     $objekat->query($sql) or die("Tabela ne može da se kreira. ");
                     echo"Tabela users je kreirana. ";

                   $sql = "CREATE TABLE `shop_comments`  (
                    `shop_comment_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                    `user_id` int(10) UNSIGNED NOT NULL,
                    `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
                    `comment` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
                    PRIMARY KEY (`shop_comment_id`) USING BTREE,
                    INDEX `fk_products_user_id`(`user_id`) USING BTREE,
                    CONSTRAINT `fk_products_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
                    )";
                    $objekat->query($sql) or die("Tabela ne može da se kreira. ");
                    echo"Tabela shop_comments je kreirana. ";

                   $sql = "CREATE TABLE `products`  (
                    `product_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                    `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
                    `price` decimal(10, 2) UNSIGNED NOT NULL,
                    `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
                    `seller_id` int(10) UNSIGNED NOT NULL,
                    `condition` enum('novo','polovno') NOT NULL,
                    `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
                    `quantity` int(10) UNSIGNED NOT NULL,
                    PRIMARY KEY (`product_id`) USING BTREE,
                    INDEX `fk_products_seller_id`(`seller_id`) USING BTREE,
                    CONSTRAINT `fk_products_seller_id` FOREIGN KEY (`seller_id`) REFERENCES `sellers` (`seller_id`) ON DELETE CASCADE ON UPDATE CASCADE
                    )";
                    $objekat->query($sql) or die("Tabela ne može da se kreira. ");
                    echo"Tabela products je kreirana. ";

                   $sql = "CREATE TABLE `user_orders`  (
                    `user_order_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                    `user_id` int(10) UNSIGNED NOT NULL,
                    `ordered_at` timestamp(0) NOT NULL DEFAULT current_timestamp,
                    PRIMARY KEY (`user_order_id`) USING BTREE,
                    INDEX `fk_user_orders_user_id`(`user_id`) USING BTREE,
                    CONSTRAINT `fk_user_orders_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
                    )";
                    $objekat->query($sql) or die("Tabela ne može da se kreira. " . $objekat->error);
                    echo"Tabela user_orders je kreirana. ";

                   $sql = "CREATE TABLE `user_orders_products`  (
                    `user_order_product_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                    `user_order_id` int(10) UNSIGNED NOT NULL,
                    `product_id` int(10) UNSIGNED NOT NULL,
                    `quantity` int(10) UNSIGNED NOT NULL,
                    `order_price` decimal(10, 2) UNSIGNED NOT NULL,
                    PRIMARY KEY (`user_order_product_id`) USING BTREE,
                    INDEX `fk_user_orders_products_user_order_id`(`user_order_id`) USING BTREE,
                    INDEX `fk_user_orders_products_product_id`(`product_id`) USING BTREE,
                    CONSTRAINT `fk_user_orders_products_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
                    CONSTRAINT `fk_user_orders_products_user_order_id` FOREIGN KEY (`user_order_id`) REFERENCES `user_orders` (`user_order_id`) ON DELETE CASCADE ON UPDATE CASCADE
                    )";
                    $objekat->query($sql) or die("Tabela ne može da se kreira. ");
                    echo"Tabela user_orders_products je kreirana. ";

                   $sql = "CREATE TABLE `users_addresses`  (
                    `users_addresses_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
                    `user_id` int(10) UNSIGNED NOT NULL,
                    `address_id` int(10) UNSIGNED NOT NULL,
                    PRIMARY KEY (`users_addresses_id`) USING BTREE,
                    INDEX `fk_users_addresses_user_id`(`user_id`) USING BTREE,
                    INDEX `fk_users_addresses_address_id`(`address_id`) USING BTREE,
                    CONSTRAINT `fk_users_addresses_address_id` FOREIGN KEY (`address_id`) REFERENCES `addresses` (`address_id`) ON DELETE CASCADE ON UPDATE CASCADE,
                    CONSTRAINT `fk_users_addresses_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
                  ) ";
                    $objekat->query($sql) or die("Tabela ne može da se kreira. ");
                    echo"Tabela user_addresses je kreirana. </br>";

                    $sql = "INSERT INTO `addresses` VALUES (1, 'Beograd', '11000', 'Srbija', 'Kumodraska 303');";
                    
                    if ($objekat->query($sql) === TRUE) {
                        echo "1. Jedan slog je upisan! ";
                    } else {
                        echo "Greska: " . $sql . "<br>" . $objekat->error;
                    }
                
                    $sql = "INSERT INTO `sellers` VALUES (1, 'Prodavnica1');";
                    $objekat->query($sql) or die("Slog nije upisan");
                    $sql = "INSERT INTO `sellers` VALUES (2, 'Mika Mikic');";
                    $objekat->query($sql) or die("Slog nije upisan");
                    $sql = "INSERT INTO `sellers` VALUES (3, 'Prodavac1');";
                    $objekat->query($sql) or die("Slog nije upisan");
                    echo"2. Vise slogova je upisano! ";
                    

                    $sql = "INSERT INTO `users` VALUES (1, 'Bozidar', 'Mladenovic', 'neki@gmail.com', 'BozidarM', 'sifra123', '+3810606549871', '1122689545873256');";
                   
                    if ($objekat->query($sql) === TRUE) {
                        echo "4. Jedan slog je upisan! ";
                    } else {
                        echo "Greska: " . $sql . "<br>" . $objekat->error;
                    }

                    $sql = "INSERT INTO `shop_comments` VALUES (1, 1, 'Komentar1', 'Neki komentar o web shopu.')";
                    
                    if($objekat->query($sql) === TRUE)
                    {         
                       echo "3. Jedan slog je upisan! ";
                    }
                    else
                    {
                       echo "Greska: " . $sql . "<br>" . $objekat->error;
                    }

                    $sql = "INSERT INTO `products` VALUES (1, 'Laptop', 100.00, 'Laptop Aspire 5052 ANWXMi, AMDTurion64 mobile (2,2GHz 512kb cache L2), Ati Radeon Xpress 110, 80GB hard.', 2, 'polovno', 'assets/products/product1.jpg', 1),
                                (2, 'Gitara', 180.00, 'Hora SS300 spada u ECO seriju klasičnih gitara.', 1, 'novo', 'assets/products/product2.jpg', 10),
                                (3, 'Sat', 50.00, 'Muski rucni sat sa metalnom narukvicom,Nemacki brend Magnum, Svi hronometri su u funkcij.', 3, 'polovno', 'assets/products/product3.jpg', 1),
                                (4, 'Stolica', 200.00, 'Dugo sedenje zahteva bolju ventilaciju i udobno sedište.', 1, 'novo', 'assets/products/product4.jpg', 25),
                                (5, 'Mobilni telefon', 300.00, 'Na prodaju iphone 7, 32gb simfree. Lepo ocuvan telefon.', 2, 'polovno', 'assets/products/product5.jpg', 2),
                                (6, 'Elektricna gitara', 180.00, 'Elektricna gitara oblika Fender Stratocaster sa HSS magnetima, sa tremolom. Svirljiva gitara, pogodna za pocetnike.',2, 'novo', 'assets/products/product6.jpg', 15),
                                (7, 'Gaming laptop', 1500.00, 'Lenovo IdeaPad L340-15 gejmerski laptop 15.6 FHD Intel Quad Core i5 9300H 8GB 256GB SSD GeForce GTX1050 crni',1, 'novo', 'assets/products/product7.jpg', 5),
                                (8, 'Poslovna stolica', 95.00, 'Prodajem stolicu Snertinge. Kao sto se vidi na slikama, nema ostecenja, nije pocepana nigde i potpuno je funkcionalna.',3, 'polovno', 'assets/products/product8.jpg', 1),
                                (9, 'Pametni sat', 45.00, 'Suptilan izgled pametnog sata sa IPS ekranom u boji. Pored svih glavnih funkcija pametnog sata, SW102 poseduje dugotrajnu bateriju.',1, 'novo', 'assets/products/product9.jpg', 30),
                                (10, 'Skateboard', 85.00, 'Skateboard sa kvalitetnom daskom i dobrim točkovima. Skoro nekoriscen. Dimenzije (DxŠxV): 76x19,7x8cm.',3, 'polovno', 'assets/products/product10.jpg', 1),
                                (11, 'Naocare', 15.00, 'Modne polarizovane naočare, jedinstven dizajn , prelepe boje i kvalitetna izrada okvira samo su neke od osobina ovih naocara.',2, 'novo', 'assets/products/product11.jpg', 10),
                                (12, 'Bicikla', 250.00, 'Prodajem biciklu sa brzinama u ispravnom stanju. Bicikla je proizvedena u Norveskoj. Gume odlicne, veoma udobna. .. ',2, 'polovno', 'assets/products/bicikla.jpg', 1)";
                    $objekat->query($sql) or die("Slog nije upisan");
                    echo"5. Vise slogova je upisano! ";

                    $sql = "INSERT INTO `user_orders` VALUES (1, 1, '2020-05-10')";
                    
                    if($objekat->query($sql) === TRUE)
                    {         
                       echo "6. Jedan slog je upisan! ";
                    }
                    else
                    {
                       echo "Greska: " . $sql . "<br>" . $objekat->error;
                    }

                    $sql = "INSERT INTO `user_orders_products` VALUES (1, 1, 1, 1, 100.00)";
                    
                    if($objekat->query($sql) === TRUE)
                    {         
                       echo "7. Jedan slog je upisan! ";
                    }
                    else
                    {
                       echo "Greska: " . $sql . "<br>" . $objekat->error;
                    }

                    $sql = "INSERT INTO `users_addresses` VALUES (1, 1, 1);";
                    
                    if ($objekat->query($sql) === TRUE) {
                        echo "8. Jedan slog je upisan! ";
                    } else {
                        echo "Greska: " . $sql . "<br>" . $objekat->error;
                    }

                    session_start();
                    session_destroy();
                    
                    $objekat->close();
                ?>
            </p>
        </div>
    </div>
</body>
</html>