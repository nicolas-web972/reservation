<?php
include "db_conn.php"; // Using database connection file here
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['lastname'])) {
?>     
  <nav class="navbar navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="/search.php">
          <img src="/uploads/logo.png" alt="logo"/>
        </a> 
<!-- Start modal login -->
        <div class="btn-group" role="group" aria-label="Basic example">
            <a href="user.php" class="booking">Mes réservations</a> 
            <p class="hello">Bonjour, <?php echo "M. ". $_SESSION['lastname']?> </p>
            <a href="logout.php" class="logout">Deconnexion</a> 
        </div> 
    </div>   
<!-- Ending modal login -->
  </nav> 
    
    <?php
} else {
    header("Location: form_login.php");
    exit();
    }

$sql = "SELECT rental.id, rental.title, rental.description, rental.price, rental.image_id, image.image_url, rental.type_id, rental.location_id, location.district, type.type FROM rental
        JOIN image ON rental.image_id = image.id 
        JOIN type ON rental.type_id = type.id
        JOIN location on rental.location_id = location.id";
$result = $conn->query($sql);

require('vendor/autoload.php');
$faker = 'Faker\Factory'::create()
?><!DOCTYPE html>
<html>
<head> 
  <title>Nos logements disponibles</title>    
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css"
        integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
        crossorigin=""/>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1 class="tab-list__link">Tous nos logements disponibles : à vos dates</h1>
    <div class="info">
      <div><?php echo "Départ : " . $_GET['check-in'];?></div>
      <div><?php echo " &nbsp; • &nbsp; Arrivée : " . $_GET['check-out'];?></div>
      <div><?php echo " &nbsp; • &nbsp; Nb de personnes : " . $_GET['traveller'];?></div>
    </div>
  <div class="container-bis">
    <div class="list">
 <?php
      if (isset($_GET['submit-search'])) {
        $_SESSION['traveller'] =  $_GET['traveller'];
        $district = mysqli_real_escape_string($conn, $_GET['address']);
        $checkin = mysqli_real_escape_string($conn, $_GET['check-in']);
        $checkout = mysqli_real_escape_string($conn, $_GET['check-out']);
        $traveller = mysqli_real_escape_string($conn, $_GET['traveller']);

        $sql = "SELECT rental.id, rental.title, rental.description, rental.price, rental.adult, rental.image_id, image.image_url, rental.type_id, rental.location_id, location.district, type.type FROM rental
                JOIN image ON rental.image_id = image.id 
                JOIN type ON rental.type_id = type.id
                JOIN location on rental.location_id = location.id
                WHERE `district` LIKE '%$district%' or `city` LIKE '%$district%'  AND rental.adult >= $traveller ";
            
        $result = mysqli_query($conn, $sql);
        $queryResult = mysqli_num_rows($result);
            
        if ($queryResult > 0) {
          if (!empty($checkin)) {
              while ($row = mysqli_fetch_assoc($result)) {
                  $dateformat_in = explode('/', $checkin);
                  $tab_in = $dateformat_in[2] . '-' . $dateformat_in[1] . '-' . $dateformat_in[0];

                  $dateformat_out = explode('/', $checkout);
                  $tab_out = $dateformat_out[2] . '-' . $dateformat_out[1] . '-' . $dateformat_out[0];

                  $_SESSION['check-in'] =  $tab_in;
                  $_SESSION['check-out'] =  $tab_out;
                  $sql_date= "SELECT booking.checkin, booking.checkout, booking.rental_id from booking 
                          JOIN rental ON booking.rental_id = rental.id
                          WHERE rental_id = " .$row['id']. " AND  booking.checkin <= '$tab_in' AND booking.checkout >= '$tab_out'";

                  $result2 = mysqli_query($conn, $sql_date);
                  $queryResult2 = mysqli_num_rows($result2);

                  if (empty($queryResult2)) { ?>
                          <div class="item js-marker" data-lat="<?= $faker->latitude(48.86325, 48.86852) ?>" data-lng="<?= $faker->longitude(2.26993, 2.40441) ?>" data-price="<?= $row["price"] ?>">
                            <a href="<?php echo "/rooms.php?id=" . $row["id"]; ?>"><img src="uploads/<?=$row['image_url']?>"></a>
                            <h4><?php echo $row["type"] . ' • ' . $row["price"] . ' € / nuit'; ?></h4>
                            <p><?php echo $row["description"] ?></p>
                            <p><?php echo $row["district"] ?></p>
                          </div>
                        <?php
                        }
              }
          }
        }
          if ($queryResult > 0) { 
            if (empty($checkin)) {
              while ($row = mysqli_fetch_assoc($result)) {?>
                <div class="item js-marker" data-lat="<?= $faker->latitude(48.86325, 48.86852) ?>" data-lng="<?= $faker->longitude(2.26993, 2.40441) ?>" data-price="<?= $row["price"] ?>">
                  <a href="<?php echo "/rooms.php?id=" . $row["id"]; ?>"><img src="uploads/<?=$row['image_url']?>"></a>
                  <h4><?php echo $row["type"] . ' | ' . $row["price"] . ' € / nuit'; ?></h4>
                  <p><?php echo $row["description"] ?></p>
                  <p><?php echo $row["district"] ?></p>
                </div>
              <?php
              }
            }
          } ?>
    </div>
      <div class="map" id="map"></div>
      </div>

      <footer>
        <div class=container-foo>
          <div>    
            <a href="javascript:history.go(-1)" class="previous">&laquo; Précédent</a>
          </div>  
          <div class=copyright>
            <p>© 2021 DonkeyStay</p>
          </div>
          <div>    
                <a href="#" class="previous">Mentions légales</a>
          </div> 
        </div>
      </footer>

<script src="vendor.js"></script>   
<script src="app.js"></script>
<?php
} else { ?>
  <p> Il y n'y a pas de résultats correspondant à votre recherche</p>
  <?php }
  $conn->close();
?>
</body>
</html>
