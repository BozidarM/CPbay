<?php
    include 'connection.php';
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
         include_once('header.php');
     ?>    

    <div id="main">
        <div class="forms">
             <form method="POST" action="confirmLogin.php">
                <div class="input-group">
                <label for="username">Korisnicko ime:</label>
                <input type="username" id="username" name="username" <?php if(isset($_COOKIE['username'])){echo "value='{$_COOKIE['username']}'";} ?> require>
                </div>
        
                <div class="input-group">
                <label for="password">Sifra:</label>
                <input type="password" id="password" name="password" <?php if(isset($_COOKIE['password'])){echo "value='{$_COOKIE['password']}'";} ?> require>
                </div>

                <div class="input-group">
                <label for="remember_me">Zapamti me:</label>
                <input type="checkbox" name="remember_me" id="remember_me"> 
                </div>

                <div class="btn-group">
                <button type="submit">Prijavi se</button>
                <button type="reset">Resetuj</button>
                </div>
            </form>
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