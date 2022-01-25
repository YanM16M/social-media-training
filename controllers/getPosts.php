<?php

// on ajoute le dossier BD.php
require_once("../models/BD.php");

// la base de donnéecho
$connexion = new BD("fakebook");

// on se connecte à la base de donnée
$co = $connexion->connexion();

if ($co) {

    $id = $_GET['idPostFrom'];

    if ($id != "") {

        $reqPost = mysqli_query($co, "SELECT id
                                     FROM USER
                                     WHERE login = '$id'");
        $row = mysqli_fetch_assoc($reqPost);

        $id = $row['id'];
        $posts = mysqli_query($co,  "SELECT *
                                     FROM POST
                                     WHERE idAuteur = '$id'");

    }

}


?>
