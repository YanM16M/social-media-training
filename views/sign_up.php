<?php
    session_start();
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
      <div class="container" height="100%">

          <div class="logBox row col-mid-1">
              <form class="DarkBox" action="../controllers/inscription.php" method="post">
                  <h1>Création d'un compte</h1><br>
                  <label for="login">Pseudo :</label>
                  <input class="form-control" type="text" name="login" placeholder="Pseudo" required><br>
                  <label for="mdp">Mot de passe :</label>
                  <input class="form-control" type="password" name="mdp" placeholder="Mot de passe" required><br>
                  <label for="mdp2">Confirmer mot de passe :</label>
                  <input class="form-control" type="password" name="mdp2" placeholder="Confirmer Mot de passe" required><br>

                  <label for="">...</label><br><br>

                  <button class="btn btn-info btn-lg" type="submit" name="button">Procéder à l'inscription</button>
              </form>
          </div>

      </div>

  </body>

</html>
