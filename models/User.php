<?php

class User {
    private $index; private $co;
    private $login;
    private $nom; private $prenom;
    private $mdp;
    private $verifier;

    public function __construct() {

        // on récupère le nombre d'arguments
        $cpt = func_num_args();
        // on récupère les arguments
        $args = func_get_args();

        switch($cpt) {
            case 3: // Connexion
                $co = $args[0];
                $login = $args[1];
                $mdp = $args[2];

                // on regarde si l'utilisateur existe
                $result = mysqli_query($co, "SELECT * FROM USER WHERE login='$login' AND mdp='$mdp'") or die("erreur requête !");

                // rien trouvé
                if (!$result) {
                    echo "Votre identifiant ou votre mot de passe ne correspond pas !";
                    exit;
                }

                // on récupère les données
                $row = mysqli_fetch_assoc($result);

                // rien trouvé
                if (!$row) {
                    echo "Votre identifiant ou votre mot de passe ne correspond pas !";
                    exit;
                }

                // on initialise les données
                $this->co = $co;
                $this->index = $row['id'];
                $this->login = $row['login'];
                $this->avatar = $row['avatar'];
                $this->remember = $row['remember'];
                //$this->connexion();

                break;
            case 4: // inscription
                $co = $args[0];
                $login = $args[1];
                $mdp = $args[2];
                $mdp2 = $args[3];
                $verifier = 0;

                if ($co) {

                    // on regarde si les mots de passes sont différents
                    if ($mdp != $mdp2) {
                        die("Les mots de passes entrées sont différents");
                        exit;
                    }
                    // on regarde si le login n'est pas déjà pris
                    $result = mysqli_query($co,"SELECT Count(*) as total FROM USER WHERE login='$login'");
                    $result = mysqli_fetch_assoc($result);
                    if ($result['total'] > 0) {
                        echo "Login déjà utilisé !";
                        exit;
                    }

                    // si il n'est pas déjà pris on inscrit l'Utilisateur
                    $result = mysqli_query($co, "INSERT INTO USER(login, mdp) VALUES('$login', '$mdp')")
                              or die("echec inscription");

                    // on connecte l'utilisateur
                    $this->co = $co;
                    $this->index = mysqli_insert_id($co);
                    $this->login = $login;
                    $this->avatar = "";
                    $this->remember = false;
                }
                else {
                    echo "echec connexion !";
                    exit;
                }

                break;
        }

    }

    public function getLogin() {
        return $this->login;
    }

    public function connexion() {
        session_start();
        $_SESSION['id'] = $this->index;
        $_SESSION['login'] = $this->login;
        $_SESSION['avatar'] = $this->avatar;
    }

    public function deconnexion() {
        session_close();
        mysqli_close($this->co);
    }
}

?>
