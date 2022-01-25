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

    if (isset($_POST['titre']) && isset($_POST['message']) && isset($_GET['login'])) {

        $image = "";
        $titre = $_POST['titre'];
        $message = $_POST['message'];
        if (!empty($_POST['image'])) {
            $image = $_POST['image'];
        }

        $date = date('d-m-y h:i:s');
        $login = $_GET['login'];

        if ($login == $_SESSION['login']) {
            mysqli_query($co, "INSERT INTO POST(titre, contenu, dateEcrit, image, idAuteur) VALUES('$titre', '$message', '$date', '$image', '$myId')");
            echo $login;
        }
        else {
            $req = mysqli_query($co, "SELECT id FROM USER WHERE login='$login'");
            $row = mysqli_fetch_assoc($req);
            if ($row) {
                $id = $row['id'];
                $req = mysqli_query($co, "INSERT INTO POST(titre, contenu, dateEcrit, image, idAuteur, idAmi) VALUES('$titre', '$message', '$date', '$image', '$id', '$myId')");
            }
        }

        header('Location:../views/myPage.php?idPostFrom='.$login);
    }
}


 ?>
