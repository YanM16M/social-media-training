<?php

    if (isset($_GET['login'])) {
      $name = $_GET['login'];

      // on redirige l'Utilisateur
      header('Location:../views/myPage.php?idPostFrom='.$name);
    }
    else {
      // on redirige l'Utilisateur
      header('Location:../views/myPage.php?idPostFrom='.$_SESSION['login']);
    }

 ?>
