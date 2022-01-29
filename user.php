<?php
session_start();

include 'db_conn.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link href="/listing/style.css" rel="stylesheet">

    <title>User</title>
</head>
<body>
    <nav class="navbar navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="/search.php">
            <img src="/uploads/logo.png" alt="" />
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
      
    
  <!-- Ending navbar -->
    
    

    <div>
        <h3 class="mes_reservations">Mes Réservations</h3>
    </div>

    <div class = "container col col-md-auto col-sm">
        <table class="table">
            <thead class="table-dark">
                <tr>
                <th scope="col col-md-auto col-sm">Arrivée</th>
                <th scope="col col-md-auto col-sm">Départ</th>
                <th scope="col col-md-auto col-sm">Prix</th>
                <th scope="col col-md-auto col-sm">Client</th>
                <th scope="col col-md-auto col-sm" colspan="2">Options</th>
                
                </tr>
            </thead>

            <?php

                $sql = "SELECT booking.id, checkin, checkout, booking.price, client_id, `lastname` FROM `booking` JOIN `rental` ON booking.rental_id = rental.id JOIN `client` ON booking.client_id = client.id";
                $result = mysqli_query($conn, $sql);

                if ($result) {
                    while ($row= mysqli_fetch_assoc($result)) {
                        $id = $row['id'];
                        $arr_date = $row['checkin'];
                        $dep_date = $row['checkout'];
                        $price = $row['price'];
                        $nom = $row['lastname'];

                        echo '<tr>
                                <td> '.$arr_date.' </td>
                                <td> '.$dep_date.'</td>
                                <td> '.$price.' €</td> 
                                <td> '.$nom.' </td>
                                <td width=100px>
                                    <button class="btn btn-secondary"><a href="update.php?updateid='.$row['id'].'" class="text-dark">Modifier</a></button>
                                    
                                 </td>
                                 <td width=100px><button class="btn btn-outline-dark"><a href="delete.php?id='.$row['id'].'" class="text-dark">Annuler</a></button></td>
                            </tr>';
                    }
                }

            ?>

           
        </table>
        
    </div>

    <a href="javascript:history.go(-1)" class="previous">&laquo; Précédent</a>

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

</body>
</html>