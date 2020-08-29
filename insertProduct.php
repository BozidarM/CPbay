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
             <form method="POST" action="confirmInsertP.php" enctype="multipart/form-data">
                <div class="input-group">
                <label for="pname">Naziv proizvoda:</label>
                <input type="text" id="pname" name="pname" required>
                </div>
        
                <div class="input-group">
                <label for="price">Cena u (EUR):</label>
                <input type="number" id="price" name="price" min="0" required>
                </div>
        
                <div class="input-group">
                    <label for="desc">Opis:</label>
                    <textarea name="desc" id="desc" rows="10" required></textarea>
                </div>
    

                <div class="input-group">
                <label for="sname">Naziv prodavnice (Prodavca):</label>
                <input type="text" id="sname" name="sname" required>
                </div>
        
                <div class="input-group">
                <label for="cond">Stanje:</label>
                <select class="inputi" name="cond" id="cond">
                    <option value="novo">Novo</option>
                    <option value="polovno">Polovno</option>
                </select>
                </div>
                
                <div class="input-group">
                <label for="file">Slika:</label>
                <input type="file" name="file" id="file">
                </div>

                <div class="input-group">
                <label for="quan">Kolicina:</label>
                <input type="number" id="quan" name="quan" step="1" min="1" required>
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
