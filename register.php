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
             <form method="POST" action="confirmRegister.php">
                <div class="input-group">
                <label for="fname">Ime:</label>
                <input type="text" id="fname" name="fname" pattern="^[A-Z]{1}[a-z]+$" title="Ime mora poceti sa velikim slovom." required>
                </div>
        
                <div class="input-group">
                <label for="lname">Prezime:</label>
                <input type="text" id="lname" name="lname" pattern="^[A-Z]{1}[a-z]+$" title="Prezime mora poceti sa velikim slovom." required>
                </div>
        
                <div class="input-group">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" required>
                </div>

                <div class="input-group">
                <label for="username">Korisnicko ime:</label>
                <input type="username" id="username" name="username" required>
                </div>
        
                <div class="input-group">
                <label for="password">Sifra:</label>
                <input type="password" id="password" name="password" pattern=".{8,}[0-9]+" title="Sifra mora da ima 8 ili vise karaktera i barem jedan broj." required>
                </div>
        
                <div class="input-group">
                <label for="phone">Broj telefona:</label>
                <input type="tel" id="phone" name="phone" pattern="^\+\d{10,}$" title="Broj teledona mora dad pocinje sa pozivnim brojem neke drzave pr: +381" required>
                </div>

                <div class="input-group">
                <label for="cnumber">Broj kreditne kartice:</label>
                <input type="text" id="cnumber" name="cnumber" pattern="^\d{16}$" title="Broj kreditne kartice sadrzi 16 brojeva i mora biti bez razmaka." required>
                </div>
                
                <div class="btn-group">
                <button type="submit">Registruj se</button>
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
