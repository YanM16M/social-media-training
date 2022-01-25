<?php
    session_start();
    // si l'utilisateur est déjà connecté alors on l'envoie sur l'espace membre
    if (!empty($_SESSION['login'])) {
        header('Location:../views/myPage.php?idPostFrom='.$_SESSION['login']);
        exit;
    }
 ?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">

  <head>
      <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8">
      <title>FakeBook</title>
      <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
      <link rel="stylesheet" href="../css/style.css">
      <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>


  <body>

    <?php
        include('./navbar.php');
     ?>

      <!-- Middle -->
      <div class="container-fluid">

          <div class="logBox container-lg-12">
              <form class="DarkBox" action="../controllers/connection.php" method="post">
                  <h1>Connexion</h1><br>
                  <label class="form-label" for="login">Pseudo :</label>
                  <input class="form-control" type="text" name="login" placeholder="Pseudo" required><br>
                  <label class="form-label" for="pseudo">Mot de passe :</label>
                  <input class="form-control" type="password" name="mdp" placeholder="Mot de passe" required><br><br>

                  <input type="checkbox" name="" value="chkRemember">
                  <label for="chkRemember">Se souvenir de moi ?</label><br><br>
                  <input width="25" class="btn btn-info btn-lg" type="submit" name="button" value="Se connecter">
              </form><br>
          </div>

      </div>

  </body>

</html>
