<?php
    session_start();
    // si un utilisateur essaie d'entrée dans l'espace de moderateur par un lien
    if(isset($_SESSION["type"]) && (strcmp($_SESSION["type"],"u")==0)){
      header('location: ../Forum.php');
    }
    else{ if(!isset($_SESSION["type"])){
          header('location: ../Forum.php');
        }
    }
 ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Aide</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" sizes="144x144" href="../img/logo_bibliotheque_fr.ico">
    <link rel="stylesheet" type="text/css" href="../framework/materialize.min.css"k >
    <link rel="stylesheet" type="text/css" href="../assets/css/main.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/breadcrumb.css">
</head>
<body>
<?php

      include("part_mod/menu_mod.php");
?>
            <!--chemin-->
            <nav id="breadcrumb" class="#eeeeee grey lighten-3" style="height: 44px;line-height: 24px;">
                <div class="nav-wrapper">
                  <div class="col s12 chemin">
                    <a href="./forum.php" class="breadcrumb black-text" style="margin-left:40px;">Forum</a>
                    <a href="" class="breadcrumb black-text">Aide</a>
                  </div>
                </div>
            </nav>
            <!--image et boutton-->
            <div id="imageButton" class="col l12 s12 hide-on-large-only">
                <!--bouton menu large-->
                <a href="#" data-activates="slide-out" id="bouttonMenu" class="button-collapse">☰</a>
            </div>

            <!--conteneur photo aide-->
            <div class="row  s12 conteneur">

                <div class="card-panel row">

                    <div class="col s12 row">
                        <div class="card-panel col l4 offset-l1">
                            <img class="materialboxed responsive-img" data-caption="Réponses supprimées"  src="../img/aideMod/Image1.png">
                        </div>

                        <div class="card-panel col l4 offset-l1">
                            <img class="materialboxed responsive-img" data-caption="Réponses signalées"  src="../img/aideMod/Image2.png">
                        </div>
                    </div>

                    <div class="col s12 row">
                        <div class="card-panel col l4 offset-l1">
                            <img class="materialboxed responsive-img" data-caption="Listes des utilisateurs bloqués"  src="../img/aideMod/Image3.jpg">
                        </div>

                        <div class="card-panel col l4 offset-l1">
                            <img class="materialboxed responsive-img" data-caption="Questions signalées"  src="../img/aideMod/Image4.jpg">
                        </div>
                    </div>

                    <div class="col s12 row">
                        <div class="card-panel col l4 offset-l1">
                            <img class="materialboxed responsive-img" data-caption="Questions supprimées"  src="../img/aideMod/Image5.png">
                        </div>

                        <div class="card-panel col l4 offset-l1">
                            <img class="materialboxed responsive-img" data-caption="Afficher détails et notifications"  src="../img/aideMod/Image6.png">
                        </div>
                    </div>
                </div>
            </div>

<?php include("./part_mod/footer.html"); ?>
</body>
</html>
