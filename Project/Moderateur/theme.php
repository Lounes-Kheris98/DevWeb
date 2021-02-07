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
  if (isset($_GET["domaine"])){
    try{
        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
        $bdd = new PDO('mysql:host=localhost;dbname=project', 'root', '', $pdo_options);
        $bdd->exec('set names utf8');
        $rep = $bdd->prepare('SELECT nom_domaine FROM domaine WHERE nom_domaine=?');
        $rep->execute(array(htmlspecialchars($_GET["domaine"])));
        if ($data = $rep->fetch()){
          $_SESSION["domaine"]=$data["nom_domaine"];
          $_SESSION["pageCourante"]="theme";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?php echo $data["nom_domaine"]; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" sizes="144x144" href="../img/logo_bibliotheque_fr.ico">
    <link rel="stylesheet" type="text/css" href="../framework/materialize.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/main.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/Theme.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/breadcrumb.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/editeurThemeMod.css">
</head>
<body>
<?php
      include("part_mod/menu_mod.php");
    include("../part/connect.php");
    echo '<div class="chemin">
                <a href="forum.php" class="breadcrumb black-text">Forum</a>
                <a href="" class="breadcrumb black-text">'. htmlspecialchars($_GET["domaine"]) .'</a>
            </div>

            <!--image et boutton-->
            <div id="imageButton" class="col l12 s12 hide-on-large-only">
                <!--bouton menu large-->
                <a href="#" data-activates="slide-out" id="bouttonMenu" class="button-collapse">☰</a>
            </div>';

    echo '<div id="objet">';
        include("../part/listTheme.php");
    echo '</div>';
    echo '<!--ajouter une question-->
        <div class="col l10 offset-l1 m11 s12 row" style="margin-top: 50px;">

            <ul class="collapsible" data-collapsible="accordion">
                <li>
                  <div class="collapsible-header">Poser une question</div>
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

              //pliante (ajout d\'une question)
              $(document).ready(function(){
                  $(".collapsible").collapsible();
              });
              // la fonction de rafraichissement
              $(function(){
                  setInterval(function() {
                      $('#objet').load('../part/listTheme.php?<?php echo 'domaine='.$_GET["domaine"]; ?>');
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
