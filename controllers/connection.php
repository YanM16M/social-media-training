<?php

// si l'utilisateur est déjà connecté alors on l'envoie sur l'espace membre
if (!empty($_SESSION['login'])) {
    header('Location:../views/myPage.php?idPostFrom='.$_SESSION['login']);
    exit;
}

// on ajoute le dossier BD.php
require_once("../models/BD.php");

// on ajoute le fichier Utilisateur
require_once("../models/User.php");

// la base de donnéecho
$connexion = new BD("fakebook");

// on se connecte à la base de donnée
$co = $connexion->connexion();

if ($co) { // on a réussi à se connecter à la base de donnée

    // si l'utilisateur a bien rentré les coordonnées
    if (!empty($_POST["login"]) && !empty($_POST["mdp"])) {

        // on récupère les données
        $login = $_POST['login'];
        $mdp = $_POST['mdp'];

        // on connecte l'utilisateur
        $user = new User($co, $login, $mdp);

        if ($user->getLogin() == "") {
            echo "Votre identifiant ou votre mot de passe ne correspond pas !";
            header('Location:../views/home.php');
            exit;
        }

        // on redirige l'Utilisateur
        $user->connexion();
        header('Location:../views/myPage.php?idPostFrom='.$login);
        exit;
    }

}
else { // on n'a pas réussi à se connecter à la base de donnée
    $connexion->deconnexion();
    echo "Echec de connexion à la base de donnée !";
    exit;
}


 ?>
