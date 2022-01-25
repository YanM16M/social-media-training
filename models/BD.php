<?php

class Bd {
      private $co;
      private $host;
      private $user;
      private $passwd;
      private $bdd;

      public function __construct($bdd) {
          $this->host = "localhost";
          $this->user = "root";
          $this->passwd = "";
          $this->bdd = $bdd;
      }

      public function connexion() {
          $this->co = mysqli_connect($this->host, $this->user, $this->passwd, $this->bdd) or die("Erreur de connexion");
          return $this->co;
      }

      public function deconnexion() {
          mysqli_close($this->co);
      }

}


 ?>
