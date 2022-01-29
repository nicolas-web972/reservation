<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Main CSS-->
    <link href="/listing/style.css" rel="stylesheet" media="all">
    <title>Login</title>
</head>
<body class="bg-img"> 
  <main>
    <nav class="navbar navbar-light bg-light">
      <div class="container">
        <a class="navbar-brand" href="#">
          <img src="/uploads/logo.png" alt="" />
        </a>
      </div>
    </nav>
    <!-- Ending navbar -->
    <div class="cover">
      <div class="container-login content" >
        <div class="login-form">
          <form 
            action="login.php" 
            method="post" 
            class="login_form"
          >
              <div class="modal-dialog">
            
                  <div class="modal-content">
                      <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Se connecter</h5>
                      <?php if (isset($_GET['error'])) { ?>
                      <p class="error"><?php echo $_GET['error']; ?></p>
                      <?php }
                      ?>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                      <form>
                          <div class="mb-3">
                          <label for="login-name" class="col-form-label">Login:</label>
                          <input type="text" class="form-control" id="login-name" name="lastname"/>
                          </div>
                          <div class="mb-3">
                          <label for="message-text" class="col-form-label">Mot de passe:</label>
                          <input type="password" class="form-control" id="login-name" name="password" />
                          </div>
                      </form>
                      </div>
                      <div class="modal-footer">
                      <button type="button submit" class="btn btn-primary">Connexion</button>
                      </div>
                  </div>
              </div>
          </form>
        </div>
      </div>
    </div>
  </main> 

 
</body>

</html>