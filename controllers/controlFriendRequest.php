<?php

// on ajoute le dossier BD.php
require_once("../models/BD.php");

// la base de donnéecho
$connexion = new BD("fakebook");

// on se connecte à la base de donnée
$co = $connexion->connexion();

$aResult = array();

if ($co) {

    if (isset($_GET['response']) && isset($_GET['pseudoFriend'])) {
        session_start();
        $response = $_GET['response'];
        $friendPseudo = $_GET['pseudoFriend'];
        $myId = $_SESSION['id'];

        $req = mysqli_query($co, "SELECT id
                                  FROM USER
                                  WHERE login = '$friendPseudo'");
        $row = mysqli_fetch_assoc($req);

        $idFriend = $row['id'];

        if ($response == "Oui") {
            $req = mysqli_query($co, "UPDATE lien SET etat='Ami' WHERE idUtilisateur1='$idFriend' AND idUtilisateur2='$myId'");
            $aResult['result'] = "true";
            //header('Location:../views/myPage.php?idPostFrom='.$_SESSION['login']);
        }
        else {
            $req = mysqli_query($co, "DELETE FROM lien WHERE idUtilisateur1='$idFriend' AND idUtilisateur2='$myId'");
            $aResult['result'] = "true";
            //header('Location:../views/myPage.php?idPostFrom='.$_SESSION['login']);
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
