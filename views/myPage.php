<?php
    session_start();
    include("../controllers/getFriends.php");
    include("../controllers/getPosts.php");
    include("../controllers/getMyFriendsRequests.php");
    include("../controllers/getFriendsRequests.php");
    $foundFriend = false;
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
          <div class="row rowMyPage">
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
                            if ($name == $_GET['idPostFrom']) {
                                $foundFriend = true;
                            }
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
                  <?php
                      echo "<h1>Fil d'actualité de ".$_GET["idPostFrom"]." !</h1>";
                      if (!$foundFriend && $_SESSION['login'] != $_GET['idPostFrom']) {
                          echo "<a id='btnNewFriend' href='javascript:void(0);' onclick='newFriend()'><span class='glyphicon glyphicon-plus'></span> Ami</a><br>";
                      }
                      if ($foundFriend or $_SESSION['login'] == $_GET['idPostFrom']) {
                        echo "<a href='#statut'><span class='glyphicon glyphicon-plus'></span> Ajouter un statut</a>";
                      }
                      while($row = mysqli_fetch_assoc($posts)) {
                          $idPost = $row['id'];
                          $req = mysqli_query($co, "SELECT Count(*) as total FROM VOTE WHERE idPost='$idPost'");
                          $row2 = mysqli_fetch_assoc($req);
                          $total = $row2['total'];

                          $myId = $_SESSION['id'];
                          $req = mysqli_query($co, "SELECT Count(*) as total FROM VOTE WHERE idPost='$idPost' AND idAuteur='$myId'");
                          $row2 = mysqli_fetch_assoc($req);
                          $myVote = $row2['total'];

                          $nameAmi = "";
                          $avatarAmi = "";
                          if ($row['idAmi'] > 0) {
                              $idAmi = $row['idAmi'];
                              $req = mysqli_query($co, "SELECT login,avatar FROM USER WHERE id='$idAmi'");
                              $rowAmi = mysqli_fetch_assoc($req);
                              if ($rowAmi) {
                                  $nameAmi = $rowAmi['login'];
                                  $avatarAmi = $rowAmi['avatar'];
                              }
                          }

                          echo "<div id='post".$idPost."'class='postWall'>";

                              $nameAuteur = $_SESSION['login'];
                              $avatarAuteur = $_SESSION['avatar'];
                              if ($nameAmi != "") {
                                  $nameAuteur = $nameAmi;
                                  $avatarAuteur = $avatarAmi;
                              }

                              if ($avatarAuteur != "") {
                                  echo "<br><img style='max-width:64px;' src=".$avatarAuteur." alt=avatar>";
                              }
                              echo "<label>".$nameAuteur."</label>";

                              if ($row['idAmi'] > 0) {
                                  echo "<h3 class='wallTitle2'>".$row['titre']."</h3>";
                              }
                              else {
                                  echo "<h3 class='wallTitle'>".$row['titre']."</h3>";
                              }

                              echo "<p>".$row['contenu']."</p>";
                              if ($row['image'] != "") {
                                  $src = $row['image'];
                                  echo "<img style='max-width:400px;' src=".$src." alt=image><br><br>";
                              }

                              if ($myVote > 0) {
                                  $textLike = "Je n'aime plus";
                              }
                              else {
                                  $textLike = "J'aime";
                              }

                              echo "<button id='btnLike".$idPost."' class='btn btn-success btn-sm' onclick='like(".$idPost.")'><span class='glyphicon glyphicon-heart'></span></button> ";

                              echo "<label class='lblLike' id='lblLike".$idPost."'>".$total."</label>";

                              if ($_GET["idPostFrom"] == $_SESSION['login'] or $row['idAmi'] == $_SESSION['id']) {
                                echo "<button class='btn btn-danger btn-sm' onclick='supprimerPost(".$idPost.")'>X</button>";
                              }
                          echo "</div><br>";
                      }
                   ?>

                   <?php if ($foundFriend or $_SESSION['login'] == $_GET['idPostFrom']) { ?>
                   <?php echo "<form id='statut' class='postingForm' action='../controllers/newPost.php?login=".$_GET['idPostFrom']."' method='post'>" ?>
                        <label>Poster un nouveau statut :</label><br><br>

                        <label for="">Titre :</label>
                        <input type="text" class="form-control" id="titrePost" name="titre" placeholder="Titre du message" value="" required><br>

                        <label for="">Texte :</label>
                        <textarea class="form-control" name="message" rows="8" placeholder="Insérer un commentaire ici..."></textarea><br>

                        <label for="">Image :</label>
                        <input type="text" class="form-control" name="image" placeholder="Insérer l'URL d'une image" value=""><br>
                        <input type="submit" class="btn btn-info btn-lg" id="btnEnvoyer" name="" value="Envoyer">
                   </form>
                 <?php } ?>
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
                              echo "<p>".$name." en atttende d'une réponse...</p>";
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
