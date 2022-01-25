<?php

// on ajoute le dossier BD.php
require_once("../models/BD.php");

// la base de donnéecho
$connexion = new BD("fakebook");

// on se connecte à la base de donnée
$co = $connexion->connexion();

if ($co) {
    session_start();

    $myId = $_SESSION['id'];

    if (isset($_POST['avatar'])) {
        $avatar = $_POST['avatar'];
        mysqli_query($co, "UPDATE USER SET avatar='$avatar' WHERE id='$myId'");
        echo "Votre avatar a été changé correctement !<br>";
        $_SESSION['avatar'] = $avatar;
    }

    if ((isset($_POST['mdp']) AND isset($_POST['mdp2']))) {
        $mdp = $_POST['mdp'];
        $mdp2 = $_POST['mdp2'];

        if($mdp == $mdp2 && $mdp != "") {
          mysqli_query($co, "UPDATE USER SET mdp='$mdp' WHERE id='$myId'");
          echo "Votre mot de passe a été changé correctement !<br>";
        }
    }


}



 ?>
