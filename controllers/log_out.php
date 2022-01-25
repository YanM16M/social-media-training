<?php

    session_start();
    session_unset();
    session_destroy();

    // on redirige l'Utilisateur
    header('Location:../views/home.php');

 ?>
