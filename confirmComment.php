<?php
    include 'connection.php';
    include_once('Header1.php');
    
    $title = $message = '';
    
    session_start();
    $username = $_SESSION['username'];
    $id = $_SESSION['id'];
    $title = $_POST['title'];
    $message = $_POST['message'];

    
   
    $sql = "INSERT INTO `shop_comments` VALUES ('','$id', '$title', '$message')";
    $result = $conn->query($sql) or die("Slog nije upisan" . $conn->error);

    $file=fopen("komentari.txt","a+") or die ("Fajl nije kreiran!");
    fwrite($file, "KOMENTAR Korisnika: " . $username . "\r\n");
    fwrite($file,  "Naslov:  " . $title . ", Tekst: ". $message ."\r\n");
    fwrite($file, "\r\n");
    fclose($file);
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
           <p>Hvala na komentaru, vas komentar je evidentiran.</p>
           <br>
           <p>Ovde su prikazani svi komentari: </p>
           <br>
           <?php
               
               $homepage = file_get_contents('komentari.txt');
               echo "<p>";
               echo '<PRE>' . $homepage . '</PRE>';
               echo "</p>";
               
           ?>
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