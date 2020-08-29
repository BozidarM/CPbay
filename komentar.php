<?php
    include_once('mustLogin.php');
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
        <div class="forms">
             <form method="POST" action="confirmComment.php">
                <div class="input-group">
                    <label for="title">Naslov:</label>
                    <input type="text" id="title" name="title" required>
                </div>

                <div class="input-group">
                    <label for="message">Poruka:</label>
                    <textarea name="message" id="message" rows="10" required></textarea>
                </div>
    
                <div class="btn-group">
                <button type="submit">Postavi</button>
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
