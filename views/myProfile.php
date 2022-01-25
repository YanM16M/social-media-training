<?php
    session_start();
    include("../controllers/getFriends.php");
    include("../controllers/getMyFriendsRequests.php");
    include("../controllers/getFriendsRequests.php");
 ?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">

  <head>
      <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8">
      <title>FakeBook</title>
      <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
      <link rel="stylesheet" href="../css/style.css">
      <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <link rel="preconnect" href="https://fonts.gstatic.com">
      <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@500&family=Yusei+Magic&display=swap" rel="stylesheet">
  </head>


  <body>

    <?php
        include('./navbar.php');
     ?>

      <!--  -->
      <div class="container myPage">
          <div class="row">
              <div class="leftSide col-lg-2">
                <h3>Mes amis</h3><br><br>

                <ul>
                    <?php
                        while($row = mysqli_fetch_assoc($friends)) {
                            $idFriend = $row['idUtilisateur2'];
                            $req = mysqli_query($co, "SELECT login FROM user WHERE id='$idFriend'");
                            $row2 = mysqli_fetch_assoc($req);
                            $name = $row2['login'];
                            echo "<li>";
                                echo "<a href='./myPage.php?idPostFrom=".$name."'>".$name."</a>";
                            echo "</li><br>";
                        }
                     ?>
                </ul>


                <h3>Recherche :</h3>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" id="intLogin" placeholder="Tag" aria-label="Recipient's username" aria-describedby="button-addon2"/>
                    <button class="btn btn-outline-primary" type="button" id="button-addon2" onclick="search()" data-mdb-ripple-color="dark">Rechercher</button><br>
                    <label for="" id="searchResult"></label>
                </div>
              </div>

              <div class="mainSide col-lg-7">
                  <form class="DarkBox" action="../controllers/changeData.php" method="post">
                      <h1>Mes informations</h1>
                      <label for="">Pseudo :</label>
                      <?php $login = $_SESSION['login']; echo "<input readonly class='form-control' type='text' placeholder='Mon Pseudo' value='".$login."'>"; ?>

                      <br><label for="">Avatar :</label>
                      <?php echo "<input name='avatar' class='form-control' type='text' placeholder='Mon avatar' value='".$_SESSION['avatar']."'>"; ?>

                      <br><label for="">Nouveau mot de passe :</label>
                      <input name="mdp" class="form-control" type="password" placeholder="Entrez votre nouveau mot de passe..."><br>

                      <label for="">Confirmation nouveau mot de passe :</label>
                      <input name="mdp2" class="form-control" type="password" placeholder="Confirmez votre nouveau mot de passe..."><br>

                      <input class="btn btn-info btn-lg" type="submit" name="" value="Mettre à jour">
                  </form>
              </div>

              <div class="rightSide col-lg-2">
                  <h3>Mes demandes :</h3><br>
                  <?php
                      while($row = mysqli_fetch_assoc($myRequests)) {
                          $idFriend = $row['idUtilisateur2'];
                          $req = mysqli_query($co, "SELECT login FROM user WHERE id='$idFriend'");
                          $row2 = mysqli_fetch_assoc($req);
                          $name = $row2['login'];
                          echo "<li>";
                              echo "<p>".$name."</p>";
                          echo "</li><br>";
                      }
                  ?>
                  <h3>Demandes d'ami :</h3><br>
                  <?php
                      $idRequest = 0;
                      while($row = mysqli_fetch_assoc($waitingRequests)) {
                          $idFriend = $row['idUtilisateur1'];
                          $idRequest++;
                          $req = mysqli_query($co, "SELECT login FROM user WHERE id='$idFriend'");
                          $row2 = mysqli_fetch_assoc($req);
                          $name = $row2['login'];
                          echo "<li id='requestList".$idRequest."'>";
                              echo "<p id='requestName".$idRequest."'>".$name."</p>";
                              echo "<button id='btnAccept".$idRequest."' class='btn btn-primary' onclick='AcceptRequest(".$idRequest.")'>Accepter</button> ";
                              echo "<button id='btnDecline".$idRequest."' class='btn btn-primary' onclick='DeclineRequest(".$idRequest.")'>Refuser</button> ";
                          echo "</li><br>";
                      }
                  ?>
              </div>
          </div>
      </div>

        <script src="../js/script.js"></script>

  </body>

</html>
