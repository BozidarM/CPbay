<?php
    include 'connection.php';
    include_once('Header1.php');
    
    $pname = $price = $desc = $sname = $cond = $img = $quan = '';

    $pname = $_POST['pname'];
    $price = $_POST['price'];
    $desc = $_POST['desc'];
    $sname = $_POST['sname'];
    $cond = $_POST['cond'];
    $quan = $_POST['quan'];

    define("imgFolder","C:\\xampp\\htdocs\\Projekat za drugi kolokvijum\\assets\\products\\");
        if(isset($_FILES['file'])){
            if(is_uploaded_file($_FILES['file']['tmp_name'])){
                if(!($_FILES['file']['type']!='image/png' || $_FILES['file']['type']!='image/jpg' || $_FILES['file']['type']!='image/jpeg')){
                    echo "<script> alert('slika moze da bude samo u jpg, jpeg ili png formatu') </script>";
                }
                else{
                    $rezultat=move_uploaded_file($_FILES['file']['tmp_name'],imgFolder . $_FILES['file']['name']);
                    if($rezultat==1) echo "<script> alert('Fajl je uspesno uploadovan')</script>";
                    else echo "<script> alert('Fajl nije uploadovan, pokusajte ponovo') </script>";
                }   
            }
            else echo "<script> alert('Greska!!!') </script>";
        }   
        else echo "<script> alert('Greska!!!') </script>";
   
    
    $sql = "SELECT `seller_id` FROM `sellers` WHERE `name` = '$sname'";
    $result = $conn->query($sql) or die("Slog nije selektovan");
    $row_cnt = $result->num_rows;

    if($row_cnt > 0)
    {
        while($red=$result->fetch_assoc()){ 
        $sid = $red['seller_id'];
        }

        $sql = "INSERT INTO `products` VALUES ('', '$pname', '$price', '$desc', '$sid', '$cond', '".$conn->real_escape_string('assets/products/' . $_FILES['file']['name'])."', '$quan')";
        $conn->query($sql) or die("Slog nije upisan");
    }
    else
    {
        $sql = "INSERT INTO `sellers` VALUES ('', '$sname')";
        $conn->query($sql) or die("Slog nije upisan");
        
        $sql = "SELECT `seller_id` FROM `sellers` WHERE `name` = '$sname'";
        $result = $conn->query($sql) or die("Slog nije selektovan");
        
        while($red=$result->fetch_assoc()){ 
        $sid = $red['seller_id'];
        }

        $sql = "INSERT INTO `products` VALUES ('', '$pname', '$price', '$desc', '$sid', '$cond', '".$conn->real_escape_string('assets/products/' . $_FILES['file']['name'])."', '$quan')";
        $conn->query($sql) or die("Slog nije upisan");
    }

    
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
           <p>Vas proizvod je postavljen na prodaju, vratite se na stranicu "proizvodi" kako bi videli ponudu.</p>
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
