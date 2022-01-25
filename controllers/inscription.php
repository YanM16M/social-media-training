<?php

  // on ajoute le fichier BD.php
  require_once("../models/BD.php");

  // on ajoute le fichier Membre
  require_once("../models/User.php");

  // la base de donnéecho
  $connexion = new BD("fakebook");

  // on se connecte à la base de donnée
  $co = $connexion->connexion();

  if ($co) { // on a réussi à se connecter à la base de donnée

      // si l'utilisateur a bien rentré les coordonnées
      if (!empty($_POST["login"])  && !empty($_POST["mdp"]) && !empty($_POST["mdp2"])) {

          // on récupère les données du formulaire
          $login = $_POST["login"];
          $mdp = $_POST["mdp"];
          $mdp2 = $_POST["mdp2"];
          $verifier = false;

          // on inscrit l'utilisateur
          $user = new User($co, $login, $mdp, $mdp2);

          if ($user->getLogin() != "") {
              // on connecte l'Utilisateur
              $user->connexion();
              // on retourne à la première page
              header('Location:../views/myPage.php?idPostFrom='.$login);
          }
          else {
                echo "Erreur dans l'inscription !";
                exit;
          }
      }
      else { // Manque d'informations
        $connexion->deconnexion();
        echo "Il manque des informations !";
        exit;
      }

  }
  else { // on n'a pas réussi à se connecter à la base de donnée
      $connexion->deconnexion();
      echo "Echec de connexion à la base de donnée !";
      exit;
  }


 ?>
