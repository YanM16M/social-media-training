<?php

// on ajoute le dossier BD.php
require_once("../models/BD.php");

// la base de donnéecho
$connexion = new BD("fakebook");

// on se connecte à la base de donnée
$co = $connexion->connexion();

$aResult = array();

if ($co) {

    if (!empty($_GET['pseudo'])) {
        session_start();

        $friendPseudo = $_GET['pseudo'];
        $myId = $_SESSION['id'];

        $req = mysqli_query($co, "SELECT id
                                  FROM user
                                  WHERE login = '$friendPseudo'");
        $row = mysqli_fetch_assoc($req);

        $idFriend = $row['id'];

        if ($idFriend != $myId && $idFriend != 0) {

            $req = mysqli_query($co, "SELECT id FROM LIEN WHERE idUtilisateur1='$myId' AND idUtilisateur2='$idFriend'");

            if($req) {
              if ($row = mysqli_fetch_assoc($req)) {
                  $aResult['result'] = "Une demande est déjà en cours !";
              }
              else {
                  $req = mysqli_query($co, "SELECT id FROM LIEN WHERE idUtilisateur2='$idFriend' AND idUtilisateur1='$myId'");
                  if ($row = mysqli_fetch_assoc($req)) {
                      $aResult['result'] = "Une demande est déjà en cours !";
                  }
                  else {
                      $req = mysqli_query($co, "INSERT INTO LIEN(idUtilisateur1, idUtilisateur2, etat) VALUES('$myId', '$idFriend', 'en attente')");
                      $aResult['result'] = "Demande envoyée !";
                  }
              }
            }
            else {
                $req = mysqli_query($co, "INSERT INTO LIEN(idUtilisateur1, idUtilisateur2, etat) VALUES('$myId', '$idFriend', 'en attente')");
                $aResult['result'] = "Demande envoyée !";
            }

        }
        else {
            $aResult['error'] = "error";
        }

    }
    else {
        $aResult['error'] = "error";
    }

}
else {
    $aResult['error'] = "error";
}

echo json_encode($aResult);

?>
