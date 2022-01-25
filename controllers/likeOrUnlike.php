<?php

// on ajoute le dossier BD.php
require_once("../models/BD.php");

// la base de donnéecho
$connexion = new BD("fakebook");

// on se connecte à la base de donnée
$co = $connexion->connexion();

$aResult = array();

if ($co) {

    if (isset($_GET['idPost'])) {
        session_start();

        $idPost = $_GET['idPost'];
        $myId = $_SESSION['id'];

        $req = mysqli_query($co, "SELECT * FROM VOTE WHERE idPost='$idPost'");
        $row = mysqli_fetch_assoc($req);

        if (!$row) {
            $req = mysqli_query($co, "INSERT INTO VOTE(idPost, idAuteur, type) VALUES('$idPost', '$myId', '1')");
            $aResult['result'] = "like";
            //header('Location:../views/myPage.php?idPostFrom='.$_SESSION['login']);
        }
        else {
            $req = mysqli_query($co, "DELETE FROM VOTE WHERE idAuteur='$myId' AND idPost='$idPost'");
            $aResult['result'] = "unlike";
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
