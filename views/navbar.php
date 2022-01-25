<nav class="navbar navbar-light" style="background-color: #e3f2fd;">
      <div class="navLogo">
        <?php
            echo "<a class='navbar-brand' href='./home.php'>FakeBook</a>";
         ?>
      </div>
      <div class="">
          <?php
              if (empty($_SESSION['login'])) {
                  echo "<ul class='nav navbar-nav navbar-right'>";
                      echo "<li><a href='./log_in.php'>Connexion</a></li>";
                      echo "<li><a href='./sign_up.php'>Inscription</a></li>";
                  echo "</ul>";
              }
              else {
                  echo "<ul class='nav navbar-nav navbar-right'>";
                      $login = $_SESSION['login'];
                      echo "<li><a href='./myPage.php?idPostFrom=".$login."'>Ma page</a></li>";
                      echo "<li><a href='./myProfile.php'>Mes informations</a></li>";
                      echo "<li><a href='../controllers/log_out.php'>Se déconnecter</a></li>";
                  echo "</ul>";
              }
           ?>
      </div>
</nav>
