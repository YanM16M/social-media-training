<?php

// on ajoute le dossier BD.php
require_once("../models/BD.php");

// la base de donnéecho
$connexion = new BD("fakebook");

// on se connecte à la base de donnée
$co = $connexion->connexion();

if ($co) {

    $id = $_SESSION['id'];

    if ($id != "") {


      // on récupère les membres
      $friends = mysqli_query($co, "SELECT idUtilisateur2
                                    FROM lien
                                    WHERE idUtilisateur1 = '$id'
                                    AND   etat = 'Ami'
                                    UNION SELECT idUtilisateur1 FROM LIEN WHERE idUtilisateur2='$id' AND etat='Ami'");
    }

}


?>
