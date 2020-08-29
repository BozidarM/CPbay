<?php
    class Osoba{
        public $fname;
        public $lname;
        public $email;
        public $username;
        public $phone;
        public $city;
        public $country;
        public $postcode;
        public $street;

        function __construct($fname, $lname, $email, $username, $phone, $city, $country, $postcode, $street){
            $this->ime=$fname;
            $this->prezime=$lname;
            $this->email=$email;
            $this->korisnickoIme=$username;
            $this->telefon=$phone;
            $this->grad=$city;
            $this->drzava=$country;
            $this->postanskiBroj=$postcode;
            $this->ulica=$street;
        }

        public function __toString()
        {
          try 
          {
            return (string) "<br/> Ime: " . $this->ime . " <br/> Prezime: " .  $this->prezime . " <br/> Email: " . $this->email . " <br/> Korisnicko ime: " . $this->korisnickoIme . 
                            " <br/> Telefon: " . $this->telefon . " <br/> Grad: " . $this->grad . " <br/> Drzava: " . $this->drzava . " <br/> Postanski broj:" . $this->postanskiBroj . 
                            " <br/> Naziv ulice: " . $this->ulica;
          } 
          catch (Exception $exception) 
          {
            return '';
        }
        }
    }
?>

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
        include_once('Header1.php');
    ?>

    <div id="main">
        <div id="user-wrapper">
        <div class="user-details">
        <?php 
        
        session_start();
        $id = $_SESSION['id'];
        $sql = "SELECT users.user_id, users.first_name, users.last_name, users.email, users.username, users.phone,
                       addresses.city, addresses.country, addresses.postcode, addresses.street_name
                FROM users
                LEFT JOIN users_addresses ON
                users.user_id = users_addresses.user_id
                LEFT JOIN addresses ON
                users_addresses.address_id = addresses.address_id
                WHERE users_addresses.user_id = '$id'
                GROUP BY users.user_id";
                $rez = $conn->query($sql);  

               while($red=$rez->fetch_assoc()){ 
                   $fname = $red['first_name'];
                   $lname = $red['last_name'];
                   $email = $red['email'];
                   $username = $red['username'];
                   $phone = $red['phone'];
                   $city = $red['city'];
                   $country = $red['country'];
                   $postcode = $red['postcode'];
                   $street = $red['street_name'];

                   $korisnik = new Osoba($fname, $lname, $email, $username, $phone, $city, $country, $postcode, $street);
                   echo "<p>Podaci korisnika: </br> $korisnik</p>";
                   
               }
        ?> 
        </div>
        <div class="addres-form">
             <form method="POST" action="confirmAdr.php">
                <div class="input-group">
                   <label for="city">Grad:</label>
                   <input type="text" id="city" name="city" required>
                </div>

                <div class="input-group">
                   <label for="postcode">Postanski broj:</label>
                   <input type="text" id="postcode" name="postcode" required>
                </div>

                <div class="input-group">
                   <label for="country">Drzava:</label>
                   <input type="text" id="coutnry" name="country" required>
                </div>

                <div class="input-group">
                   <label for="street">Naziv ulice:</label>
                   <input type="text" id="street" name="street" required>
                </div>
    
                <div class="btn-group">
                <button type="submit">Potvrdi</button>
                <button type="reset">Resetuj</button>
                </div>
            </form>
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
