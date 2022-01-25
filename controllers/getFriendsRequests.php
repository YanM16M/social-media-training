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


      // on récupère les membres du groupe
      $waitingRequests = mysqli_query($co, "SELECT *
                                    FROM lien
                                    WHERE idUtilisateur2 = '$id'
                                    AND   etat = 'en attente'");
    }

}


?>
