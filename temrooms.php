<?php session_start(); 

include "db_conn.php"; // Using database connection file here

var_dump($_SESSION, $_GET);?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Icons library -->
    <script src="https://kit.fontawesome.com/e22d016fbe.js" crossorigin="anonymous"></script>
    <!-- Main CSS-->
  <link href="css/main.css" rel="stylesheet" media="all">
</head>

<body>
  <!-- Start navbar -->
  <nav class="navbar navbar-light bg-light">
    <div class="container">
      <a class="navbar-brand" href="/search.php">
        <img src="/listing/uploads/logo" alt="" />
      </a>
    </div>
  </nav>
  <!-- Ending navbar -->
  <img src="/listing/uploads/IMG-619bb9da89b966.03316005.png" class="img-rooms" alt="...">
  <div class="container">
  <div class="row g-1">
    <div class="col-12">
    <h1>Studio Paris 8</h1><br><hr><br>
    </div>
    </div>
    </div>

  <div class="container">
  <div class="row g-5">
    <div class="col-12">
    <i class="fas fa-home fa-2x"></i>
  <h3>Logement entier</h3>
  <p>Vous aurez le logement (appartement avec services hôteliers) rien que pour vous.</p>
    </div>
    </div>
    </div>
    

    <div class="container">
  <div class="row g-1">
    <div class="col-12">
    <i class="fas fa-star fa-2x"></i>
  <h3>Nettoyage renforcé</h3>
  <p>Cet hôte s'engage à appliquer le processus de nettoyage renforcé</p><br>
    </div>
    </div>
    </div>

    <div class="container">
  <div class="row g-1">
    <div class="col-12">
    <h3>Description</h3>
    <p>Studio au 5 pièces duplex aux prestations haut de gamme</p>
    </div>
    </div>
    </div>

  <!-- Starting footer-->
  <footer>
      <hr>
      <center>
        <p><b> © 2021 DonkeyStay</b></p>
      </center>
      <!-- Starting legal mention modal-->
      <!-- Button trigger modal -->
      <p type="text" class="mention_légales" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
        Mention légales
      </p>
      <!-- Modal -->
      <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">Mention légales</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              Ces mentions légales sont à distinguer des conditions générales de vente (CGV) également obligatoires sur les sites e-commerce, mais également des conditions générales d’utilisation (CGU – conseillées mais non obligatoires) dans lesquelles elles peuvent cependant être intégrées.
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
      </div>
      <script
      type="text/javascript"
      src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"
    ></script>
    <script type="text/javascript">
      var fromDate;
      $("#chekin-date").on("change", function (event) {
        fromDate = $(this).val();
        $("#chekout-date").prop("min", function () {
          return fromDate;
        });
      });
      var toDate;
      $("#chekout-date").on("change", function (event) {
        toDate = $(this).val();
        $("#chekin-date").prop("max", function () {
          return fromDate;
        });
      });
    </script>
    </footer>
     <!-- Ending footer-->
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </body>
</html>