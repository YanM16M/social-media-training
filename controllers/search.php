<?php

// on ajoute le dossier BD.php
require_once("../models/BD.php");

// la base de donnéecho
$connexion = new BD("fakebook");

// on se connecte à la base de donnée
$co = $connexion->connexion();

$aResult = array();


if ($co) { // on a réussi à se connecter à la base de donnée

    if (isset($_GET['login'])) {

        $login = $_GET['login'];

        $req = mysqli_query($co, "SELECT login, id
                                  FROM USER
                                  WHERE login ='$login'");
        $row = mysqli_fetch_assoc($req);

        if ($row && $row['login'] == $login) {
            $aResult['result'] = $login;
            //header('Location:../views/myPage.php?idPostFrom='.$login);
        }
        else {
            $aResult['result'] = "Profil introuvable !";
        }

    }
    else {
        $aResult['error'] = "error";
    }

}
else { // on n'a pas réussi à se connecter à la base de donnée
    $connexion->deconnexion();
    echo "Echec de connexion à la base de donnée !";
    $aResult['error'] = "error";
    //exit;
}

echo json_encode($aResult);

 ?>
