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

        $req = mysqli_query($co, "SELECT * FROM POST WHERE idAuteur='$myId' AND id='$idPost'");
        $row = mysqli_fetch_assoc($req);

        if ($row['id'] == $idPost) {
            $req = mysqli_query($co, "DELETE FROM POST WHERE idAuteur='$myId' AND id='$idPost'");
            $req = mysqli_query($co, "DELETE FROM VOTE WHERE idPost='$idPost'");
            $req = mysqli_query($co, "DELETE FROM COMMENTAIRE WHERE idPost='$idPost'");
            $aResult['result'] = "true";
            //header('Location:../views/myPage.php?idPostFrom='.$_SESSION['login']);
        }
        else {

            $req = mysqli_query($co, "SELECT * FROM POST WHERE idAmi='$myId' AND id='$idPost'");
            $row = mysqli_fetch_assoc($req);

            if ($row['id'] == $idPost) {
                $req = mysqli_query($co, "DELETE FROM POST WHERE idAmi='$myId' AND id='$idPost'");
                $req = mysqli_query($co, "DELETE FROM VOTE WHERE idPost='$idPost'");
                $req = mysqli_query($co, "DELETE FROM COMMENTAIRE WHERE idPost='$idPost'");
                $aResult['result'] = "true";
                //header('Location:../views/myPage.php?idPostFrom='.$_SESSION['login']);
            }
            else {
                $aResult['error'] = "error";
            }

        }
    }

}
else {
    $aResult['error'] = "error";
}

echo json_encode($aResult);


?>
