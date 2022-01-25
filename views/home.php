<!DOCTYPE html>
<html lang="fr" dir="ltr">

  <?php
      session_start();
      include("../controllers/redirection.controller.php");
   ?>

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

            <!-- Introduction -->
            <div class="homeContainer container-lg-12">
                <h1>Bienvenue sur FakeBook</h1><br><br>
                <h3>FakeBook est un nouveau réseau social</h3>
                <h3>Rejoins-nous !</h3><br><br><br>

                <a class="btn btn-dark btn-lg" href="./log_in.php">Se connecter</a> </button>
                <a  class="btn btn-info btn-lg" href="./sign_up.php" style="color:white">S'inscrire</a> </button>
            </div>

      </div>

  </body>

</html>
