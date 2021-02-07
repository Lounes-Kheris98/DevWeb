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
<?php
  if (isset($_GET["domaine"]) && isset($_GET["id_quest"])){
    try{
        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
        $bdd = new PDO('mysql:host=localhost;dbname=project', 'root', '', $pdo_options);
        $bdd->exec('set names utf8');
        $rep = $bdd->prepare('SELECT nom_domaine, id_question, titre_quest FROM question WHERE id_question=? AND nom_domaine=?');
        $rep->execute(array(htmlspecialchars($_GET["id_quest"]),htmlspecialchars($_GET["domaine"])));
        if ($data = $rep->fetch()){
          $_SESSION["domaine"]=$data["nom_domaine"];
          $_SESSION["id_quest"]=$data["id_question"];
          $_SESSION["pageCourante"]="question";
  ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?php echo $data["titre_quest"]; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" sizes="144x144" href="../img/logo_bibliotheque_fr.ico">
    <link rel="stylesheet" type="text/css" href="../framework/materialize.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/main.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/Question.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/breadcrumb.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/editeurQuestMod.css">
</head>
<body>
<?php
    include("part_mod/menu_mod.php");
    include("../part/connect.php");
    echo '<div class="chemin">
             <a href="forum.php" class="breadcrumb black-text">Forum</a>
             <a href="theme.php?domaine='. htmlspecialchars($_GET["domaine"]) .'" class="breadcrumb black-text">'. htmlspecialchars($_GET["domaine"]) .'</a>';
      try{
         $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
         $bdd = new PDO('mysql:host=localhost;dbname=project', 'root', '', $pdo_options);
         $bdd->exec('set names utf8');
         $reponse = $bdd->prepare('SELECT id_question, titre_quest FROM question WHERE id_question=?');
         $reponse->execute(array($_GET["id_quest"]));
            $donnees = $reponse->fetch();
                echo '<a href="" class="breadcrumb black-text hide-on-small-only">'. htmlspecialchars($donnees["titre_quest"]) .'</a>';
                $reponse->closeCursor();
        }
        catch (Exception $e){
             die('Erreur : ' . $e->getMessage());
        }
        echo  '</div>
              <!--image et boutton-->
              <div id="imageButton" class="col l12 s12 hide-on-large-only">
                  <!--bouton menu large-->
                  <a href="#" data-activates="slide-out" id="bouttonMenu" class="button-collapse">☰</a>
              </div>

              <div id="list">';
          include("../part/listQuestConnectMod.php");
          echo '</div>';
    echo '<!--ajouter une question/réponse-->
    <div class="col l10 offset-l1 m11 s12 row" style="margin-top: 50px;">

        <ul class="collapsible" data-collapsible="accordion">
            <li>
              <div class="collapsible-header">Ecrire un message</div>
              <div class="collapsible-body">
                <iframe src="../part/editeur.php" id="editor" width="100%" sandbox="allow-same-origin allow-scripts allow-forms"></iframe>
              </div>
            </li>
          </ul>

    </div>';
        echo '<!--image de scroll en haut-->
              <img src="../img/scroll-to-top.png" alt="" id="scrollTop">';
    include("./part_mod/footer.html");
  ?>
          <script>
              //faire apparaitre et disparaitre le boutton scrollTop
              $(window).scroll(function(){
                  var scroll=$(window).scrollTop();
                  var height=$(window).height();
                  if ( scroll > height ){
                      $("#scrollTop").removeClass("hide");
                  }
                  else $("#scrollTop").addClass("hide");
              });

              $(document).ready(function(){
                  $("#scrollTop").addClass("hide");
              });

              $(document).ready(function(){
                  $("#scrollTop").click(function() {
                      $("html, body").animate({scrollTop: 0}, 800);
                      return false;
                  });
              });

              //pliante (ajout d\'une réponse)
              $(document).ready(function(){
                  $(".collapsible").collapsible();
              });

              // la fonction de rafraichissement
              $(function(){
                  setInterval(function() {
                      $("#list").load("../part/listQuestConnectMod.php?<?php echo 'domaine='.$_GET["domaine"].'&id_quest='.$_GET["id_quest"];?>");
                    }, 1000);
                });

      </script>
      <?php
          include("../part/boite.php");
          $rep->closeCursor();
        }
        else{
          header('location: ../part/erreur.html');
        }
      }
      catch (Exception $e){
        die('Erreur : ' . $e->getMessage());
      }
    }
    else{
      header('location: ../part/erreur.html');
    }
?>
