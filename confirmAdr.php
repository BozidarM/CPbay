<?php
    include 'connection.php';
    include_once('Header1.php');

    session_start();
    $id = $_SESSION['id'];
    
    $city = $postcode = $country = $street ='';

    $city = $_POST['city'];
    $postcode = $_POST['postcode'];
    $country = $_POST['country'];
    $street = $_POST['street'];

   
    $sql = "INSERT INTO `addresses` VALUES ('', '$city', '$postcode', '$country', '$street')";
    $conn->query($sql) or die("Slog nije upisan");

    $sql = "SELECT `address_id` FROM `addresses` WHERE `street_name` = '$street'";
    $result = $conn->query($sql) or die("Slog nije selektovan");

    while($red=$result->fetch_assoc()){ 
        $aid = $red['address_id'];
    }

    $sql = "INSERT INTO `users_addresses` VALUES ('', $id, $aid)";
    $conn->query($sql) or die("Slog nije upisan");

    
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
    <div id="comment">
           <p>Vasa adresa je dodata, idite na stranicu "Moj Nalog" kako bi je videli.</p>
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