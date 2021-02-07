<?php
    session_start();
    // si un utilisateur essaie d'entrée dans l'espace de moderateur par un lien
    if(isset($_SESSION["type"]) && (strcmp($_SESSION["type"],"u")==0)){
      header('location: ../../');
    }
    else{ if(!isset($_SESSION["type"])){
          header('location: ../../');
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
    <link rel="stylesheet" type="text/css" href="../../../../framework/materialize.min.css">
    <link rel="stylesheet" type="text/css" href="../../../../assets/css/main.css">
    <link rel="stylesheet" type="text/css" href="../../../../assets/css/Question.css">
    <link rel="stylesheet" type="text/css" href="../../../../assets/css/breadcrumb.css">
    <link rel="stylesheet" type="text/css" href="../../../../assets/css/editeurQuestMod.css">
    <link rel="stylesheet" href="../../../../fonts/roboto/material-icons.css">
</head>
<body>
<?php
    try{
      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
      $bdd = new PDO('mysql:host=localhost;dbname=project', 'root', '', $pdo_options);
      $reponse = $bdd->query('SELECT
        (SELECT COUNT(*) FROM user WHERE type="u") AS nb_user,
        (SELECT COUNT(*) FROM user WHERE bloquer=1) AS nb_user_b,
        (SELECT COUNT(*) FROM question WHERE supprime=1) AS nb_quest_sup,
        (SELECT COUNT(DISTINCT id_question) FROM signaler_quest ) AS nb_quest_sign  ,
        (SELECT COUNT(DISTINCT id_rep) FROM signaler_rep ) AS nb_rep_sign ,
        (SELECT COUNT(*) FROM reponse WHERE supprime=1) AS nb_rep_sup');
        if($donnees = $reponse->fetch()){

          echo'<div class="row" id="complete">

              <!--la barre de navigation-->
              <div id="slide-out" class="side-nav fixed #eeeeee grey lighten-3">

                    <!--le logo de la biblio-->
                    <div id="logo" style="margin-bottom: 50px;">
                        <img src="../../../../img/logo_bibliotheque_fr.png" class="responsive-img" alt="">
                    </div>

                    <a href="../../" class="btn_menu">Forum</a>

                    <a href="../../../ReponseSignaler/" class="btn_menu"><span class="badge new">'.$donnees["nb_rep_sign"].'</span>Réponses signalées</a>

                    <a href="../../../ReponseSupprimer/" class="btn_menu"><span class="badge new">'.$donnees["nb_rep_sup"].'</span>Réponses supprimées</a>

                    <a href="../../../QuestionSignaler/" class="btn_menu"><span class="badge new ">'.$donnees["nb_quest_sign"].'</span>Questions signalées</a>
                    <a href="../../../QuestionSupprimer/" class="btn_menu"><span class="badge new">'.$donnees["nb_quest_sup"].'</span>Questions supprimées</a>

                    <a href="../../../UtilisateurBloquer/" class="btn_menu"><span class="badge new">'.$donnees["nb_user_b"].'</span>Utilisateurs bloqués</a>
                    <a href="../../../ListeUtilisateur/" class="btn_menu"><span class="new badge" data-badge-caption="">'.$donnees["nb_user"].'</span>Liste utilisateurs</a>
              </div>

                <!--principale-->
                <div id="principale" class="col s12">
                    <style>
                        #slide-out .btn_menu{
                            font-size:1em;
                            z-index:2;
                        }
                        .new.badge{
                            opacity:0.4;
                        }
                        .new.badge:hover{
                            z-index:100;
                        }
                        @media screen and (min-width:993px){
                            /*principale*/
                            #principale{
                                margin-left: 320px;
                            }
                    </style>';

         }
         $reponse->closeCursor();
      }
        catch (Exception $e){
            die('Erreur : ' . $e->getMessage());
        }

          // la barre de  menu horizontale pour un utilisateur connecté
          echo '<!--barre de menu-->
                <nav id="" class="#eeeeee grey lighten-3" style="height: 50px;line-height: 46px;">
                    <div class="nav-wrapper">
                        <div class="col s12 right-align">
                            <div id="connect">';
                            echo '<a  class="hide-on-small-only btn  waves-effect waves-light" href="#modal2" style="margin-right:4px">deconnecter</a>
                                  <a href="../../../Compte/"  class="hide-on-small-only btn  waves-effect waves-light">compte</a>
                                  <a href="../../../Aide/" class="hide-on-small-only aide btn  waves-effect waves-light waves-effect waves-purple">?</a>
                                  <button id="paramaitre" class="hide-on-med-and-up btn waves-effect waves-light">&#128315;</button>
                                    <div id="listParamaitre" class="card-panel">
                                      <p id="fleche">&#128314;</p>
                                      <a href="../../../Compte/" >Compte</a>
                                      <a href="#modal2" >Deconnecter</a>
                                      <a href="../../../Aide/" class="aide" >Aide</a>
                                    </div>
                            </div>
                        </div>
                    </div>
                </nav>';
                //la boite de dialogue de deconnection
                echo '<div id="modal2" class="modal">
                        <div class="modal-content" style="border-bottom:1px solid gray;">
                            <h4 class="black-text left-align">Voulez-vous vraiment vous déconnecter?</h4>
                        </div>
                        <div class="modal-footer">';
                          echo '<a href="../../../../fonction/deconnection.php?domaine='. htmlspecialchars($_GET["domaine"]) .'&id_quest='. htmlspecialchars($_GET["id_quest"]) .'&page='.$_GET["page"].'" class="white-text modal-action modal-close waves-effect waves-green btn-flat #f4511e deep-orange darken-1">deconnecter</a>';
                          echo '<a href="" class="white-text modal-action modal-close waves-effect waves-green btn-flat #f4511e deep-orange darken-1" style="margin-right:6px">Annuler</a>
                        </div>
                    </div>';
    echo '<div class="chemin">
             <a href="../../" class="breadcrumb black-text">Forum</a>
             <a href="../?domaine='. htmlspecialchars($_GET["domaine"]) .'&page=1" class="breadcrumb black-text">'. htmlspecialchars($_GET["domaine"]) .'</a>';
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
              </div>';
          include("../../../../fonction/listQuestConnectMod.php");
    echo '<!--ajouter une question/réponse-->
    <div class="col l10 offset-l1 m11 s12 row" style="margin-top: 50px;">

        <ul class="collapsible" data-collapsible="accordion">
            <li>
              <div class="collapsible-header">Ecrire un message</div>
              <div class="collapsible-body">
                <iframe src="../../../../part/editeur.php" id="editor" width="100%" sandbox="allow-same-origin allow-scripts allow-forms"></iframe>
              </div>
            </li>
          </ul>

    </div>';
        echo '<!--image de scroll en haut-->
              <img src="../../../../img/scroll-to-top.png" alt="" id="scrollTop">';
        echo '<!--le footer -->
            <footer id="footer" class="page-footer #9e9e9e grey col l12 m12 s12">
                <div class="container">
                    <div class="row">
                        <div class="col l6 s12">
                            <p class="grey-text text-lighten-4">Vous pouvez aussi accéder à :</p>
                        </div>
                        <div class="col l4 offset-l2 s12">
                            <ul>
                                <li><a class="grey-text text-lighten-3" href="../../../Aide/">Aide moderateur</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="footer-copyright">
                    <div class="container">
                        <p>© 2017 Copyright Right</p>
                    </div>
                </div>
            </footer>
          </div>
        </div>
        <script type="text/javascript" src="../../../../framework/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="../../../../framework/materialize.min.js"></script>
        <script type="text/javascript">

            //barre de navigation pour les pages de modérateurs
            $(document).ready(function(){
                $(".button-collapse").sideNav({
                    menuWidth: 330,
                    edge: "left",
                    closeOnClick: false,
                    draggable: true
                });
            });

            //boutton d"option pour les petits écrans
            $(document).ready(function(){
                $("#paramaitre").click(function(){
                    $("#listParamaitre").slideToggle("slow");
                });
            });

            window.onclick = function(event) {
              if(!event.target.matches("#paramaitre")){
                var list = document.getElementById("listParamaitre");
                if(list.style.display=="block"){
                  list.style.display="none";
                }
              }
            }
        </script>
        <script type="text/javascript">
          $(document).ready(function(){
              $(".modal").modal();
          });
          $(document).ready(function(){
            var position = $("#footer").position();
            var screen = $(window).height();
            if ( ( position.top + 123 ) < screen ){
              var marge = screen-123;
              $("#footer").offset({top:marge});
            }
          });
        </script>';
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
              function getMessage(){
                $.post("../../../../fonction/getLastRep.php?domaine=<?php echo htmlspecialchars($_GET['domaine']).'&id_quest='.htmlspecialchars($_GET['id_quest']).'&page='.htmlspecialchars($_GET["page"]); ?>",function(data){
                  $('#listRep').append(data);
                },"text");
                return false;
              }
              <?php
                //la fonction de rafraichissement
                if (($pageActuelle == $nombreDePages) || ($nombreDePages==0)){
                  echo '$(function(){
                      setInterval(function(){
                        getMessage();
                      }, 1000);
                  });';
                }
              ?>
      </script>
      <?php
          include("../../../../fonction/toast.php");
          $rep->closeCursor();
        }
        else{
          header('location: ../../../../Erreur.html');
        }
      }
      catch (Exception $e){
        die('Erreur : ' . $e->getMessage());
      }
    }
    else{
      header('location: ../../../../Erreur.html');
    }
?>
