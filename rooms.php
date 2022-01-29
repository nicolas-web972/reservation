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

    $rental_id = $_GET['id'];
    $sql = "SELECT * FROM `rental` 
    WHERE rental.id=$rental_id";

    $result=mysqli_query($conn, $sql);

    $row = mysqli_fetch_assoc($result);
        $checkin = $_SESSION['check-in'];
        $checkout = $_SESSION['check-out'];
        $rental_price = $row['price'];
        $date1 = new DateTime($checkin);
        $date2 = new DateTime($checkout);
        $diff = $date1->diff($date2);

        $booking_price = $diff->days * $rental_price;

        if (isset($_POST['update'])) {
            $checkin = $_POST['checkin'];
            $checkout = $_POST['checkout'];
      
            if ($result) {
                header('rooms.php');
            } ;
        }

    if (isset($_POST['submit'])) {
        $checkin = $_POST['checkin'];
        $checkout = $_POST['checkout'];
       
        $sql = "INSERT INTO booking(checkin, checkout, price, rental_id, client_id)
                VALUES ('$checkin','$checkout','$booking_price','$rental_id', '1')";
        $result = mysqli_query($conn, $sql);
    
        if ($result) {
            header('Refresh:3; URL = user.php');
        } else {
            die(mysqli_error($conn));
        }
    }
    // var_dump($_SESSION, $_GET);
    
    $sql1 = "SELECT rental.id, rental.title, rental.description, rental.price, rental.image_id, image.image_url, rental.type_id, rental.location_id, location.district, type.type FROM rental
        JOIN image ON rental.image_id = image.id 
        JOIN type ON rental.type_id = type.id
        JOIN location on rental.location_id = location.id
        WHERE rental.id=$rental_id";

    $result1 = $conn->query($sql1);
    $row2 = mysqli_fetch_assoc($result1);
    ?>
   
<!doctype html>
<html lang="fr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link href="/listing/style.css" rel="stylesheet">

    <title>Réservation</title>
  </head>
  <body>
  <div class=container> 
      <?php
      if ($row2) {
          ?>
        <div class="item js-marker"><br>
        <h1><?php echo $row2["title"] ?></h2> <br>
          <img class="img-prod" src="/listing/uploads/<?=$row2['image_url']?>"> <br>
          <h4><?php echo $row2["type"] . ' • ' . $rental_price . ' € / nuit'; ?></h4>
          <p><?php echo $row2["description"] ?></p>
          <p><?php echo $row2["district"] ?></p>


        </div>
      <?php
      }?>
  </div>


    <div class = "container">
        <form method = "post">
            <div class="mb-3">
                <label for="checkin" class="form-label">Arrivée</label>
                <input type="date" class="form-control datepicker-from" id="fromDate" placeholder="" name="checkin" autocomplete="off" value="<?php echo $_SESSION['check-in'];?>">
            </div>
            <div class="mb-3">
                <label for="checkout" class="form-label">Départ</label>
                <input type="date" class="form-control datepicker-to" id="toDate" placeholder="" name="checkout" autocomplete="off" value="<?php echo $_SESSION['check-out'];?>">
            </div>

            <label for="quantity">Nombre de Voyageurs:</label>
            <input type="number" id="quantity" name="quantity" min="1" max="6" value="<?php echo $_SESSION['traveller'];?>">

            <div class="mb-3">
                <label for="checkout" class="form-label">Détail :</label>
                <span id="nbNights"><?php echo $diff->days . " nuits x " . $rental_price . " €" ;?></span><br>
                <span>Prix total : <span id="priceTotal"><?php echo $booking_price . "</span> €";?></span>
            </div>


            <button type="submit" class="btn btn-primary" name="submit" id="liveToastBtn">Réserver</button>

            <div aria-live="polite" aria-atomic="true" class="d-flex justify-content-center align-items-center" style="min-height: 200px;">

                <!-- Then put toasts within -->
                <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-body border border-primary d-flex justify-content-center">
                    <strong>Un E-mail de confirmation vient d'être envoyé.</strong>
                    </div>
                </div>
                </div>
            

            <script src=index.js></script>

            <?php
                if (isset($_POST['submit'])) {
                    ini_set('display_errors', 1);
                    error_reporting(E_ALL);
                    $from = "oceanezara@yahoo.fr";
                    $to = "oceanezara@yahoo.fr";
                    $subject = "Essai de PHP Mail";
                    $message = "PHP Mail fonctionne parfaitement";
                    $headers = "De :" . $from;
                    mail($to, $subject, $message, $headers); ?> 
                    <script>
                        emailSentToast.show();
                        

                    </script>


                <?php
                }
            ?>
        </form>
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

    <script
      type="text/javascript"
      src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"
    ></script>
    <script type="text/javascript">
      var fromDate;
      $("#fromDate").on("change", function (event) {
        fromDate = $(this).val();
        $("#toDate").prop("min", function () {
          return fromDate;
        });
      });

      var toDate;
      $("#toDate").on("change", function (event) {
        toDate = $(this).val();
        $("#fromDate").prop("max", function () {
          return fromDate;
        });
      });

      jQuery('.datepicker-from, .datepicker-to').on('blur', (e) => {
        var rentalPrice = <?php echo $rental_price; ?>;
        var t2 = new Date($("#toDate").val()).getTime();
        var t1 = new Date($("#fromDate").val()).getTime();
        var nbDays = parseInt((t2-t1)/(24*3600*1000));

        $('#nbNights').text(nbDays + " nuits x <?php echo $rental_price; ?> €");
        $('#priceTotal').text(nbDays * rentalPrice);
      });
    </script>
</body>

</html>