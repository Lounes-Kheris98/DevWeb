<?php
    session_start();
    //si un modérateur essaie d'entrée dans cette espace par un lien
    if( isset($_SESSION["type"]) && strcmp($_SESSION["type"],"a")==0 ){
      header('location: ../Moderateur/Forum/');
    }
    //si l'utilistaeur est bloquer durant sa connexion
    if (isset($_SESSION["email"])){
      try{
          $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
          $bdd = new PDO('mysql:host=localhost;dbname=project', 'root', '', $pdo_options);
          $bdd->exec('set names utf8');
          $reponse = $bdd->prepare('SELECT email, bloquer FROM user WHERE email=?');
          $reponse->execute(array($_SESSION["email"]));
          $donnees = $reponse->fetch();
          if ($donnees["bloquer"]==1){
            session_unset();
            $_SESSION["connect"]=0;
            $_SESSION["deconnect"]=0;
          }
          $reponse->closeCursor();
        }
        catch (Exception $e){
            die('Erreur : ' . $e->getMessage());
        }
      }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title >Forum</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" sizes="144x144"  href="../img/stro.ico">
    <link rel="stylesheet" type="text/css" href="../framework/materialize.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/main.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/Forum.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/breadcrumb.css">
</head>
<body>
<?php
echo '<!--la page complète-->
    <div class="row" id="complete">

        <!--la barre de navigation-->
        <div id="slide-out" class="side-nav fixed col l3 s2 #eeeeee grey lighten-3">

                <!--le logo de la biblio-->
                <div id="logo">

                        <img src="../img/stro.jpg" class="responsive-img" alt="">
                        <i><p style="text-align: center; font-weight: bold; padding-left: 20px; font-size: 25px; font">Info<span style="color: blue;">Santé</span></p>
                    </i>

                    
                    </div>

                <!--le menu-->
                <a class="btn_menu" href="../">Accueil</a>
                <a class="btn_menu" href="./" >Forum</a>
                <a class="btn_menu" href="../Rendez-Vous/">Rendez-Vous</a>

                

        </div>

        <!--principale-->
        <div id="principale" class="col s12">
';
  if (isset($_SESSION["pseudo"])){
        echo '<!--barre de menu-->
        <nav id="topBar" class="#eeeeee grey lighten-3" style="height: 50px;line-height: 46px;">
            <div class="nav-wrapper">
                <div class="col s12 right-align">
                    <div id="connect">
                        <a  class="hide-on-small-only waves-effect waves-light btn" href="#modal2" style="margin-right:4px">deconnecter</a>
                        <a href="./Compte/"  class="hide-on-small-only waves-effect waves-light btn">compte</a>
                        <a href="./Aide/" class="aide hide-on-small-only waves-effect waves-light btn">?</a>
                        <button id="paramaitre" class="hide-on-med-and-up waves-effect waves-light btn">&#128315;</button>
                        <div id="listParamaitre" class="card-panel">
                            <p id="fleche">&#128314;</p>
                            <a href="./Compte/" >Compte</a>
                            <a href="#modal2" >Deconnecter</a>
                            <a href="./Aide/" class="aide" >Aide</a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <div id="modal2" class="modal">
            <div class="modal-content" style="border-bottom:1px solid gray;">
                <h4 class="black-text left-align">Voulez-vous vraiment vous déconnecter?</h4>
            </div>
            <div class="modal-footer">
                <a href="../fonction/deconnection.php" class="white-text modal-action modal-close waves-effect waves-green btn light deep-light lighten-1">deconnecter</a>
                <a href="" class="white-text modal-action modal-close waves-effect waves-green btn deep-light lighten-1" style="margin-right:6px">Annuler</a>
            </div>
        </div>';

  }
  else{
        echo '<!--la barre de menu horizontale pour user déconnecter-->
                <nav id="topBar" class="#eeeeee grey lighten-3" style="height: 50px; line-height: 46px;">
                    <div class="nav-wrapper">
                        <div class="col s12 right-align">
                            <div id="connect">
                                <a href="#modal1"  class="hide-on-small-only waves-effect waves-light btn">Se connecter</a>
                                <a href="./Inscription/"  class="hide-on-small-only waves-effect waves-light btn">S\'inscrire</a>
                                <a href="./Aide/" class="hide-on-small-only aide waves-effect waves-light btn">?</a>
                                <button id="paramaitre" class="hide-on-med-and-up waves-effect waves-light btn">&#128315;</button>
                                  <div id="listParamaitre" class="card-panel">
                                    <p id="fleche">&#128314;</p>
                                    <a href="#modal1">Se connecter</a>
                                    <a href="./Inscription/">S\'inscrire</a>
                                    <a href="./Aide/" class="aide">Aide</a>
                                  </div>
                            </div>
                        </div>
                    </div>
                </nav>
                <!--la boite de dialogue de connection-->
                <div id="modal1" class="modal modal-fixed-footer" style="width=300px">
                    <form method="post" action="../fonction/connection.php">
                        <div class="modal-content">
                            <div class="col s12 center-align">
                                <img src="../img/avatar_defaut.png" id="imagelogin" alt="avatar">
                            </div>
                            <div class="col s12">
                                <div class="col s12 input-field">
                                    <label >Pseudo</label>
                                    <input type="text" name="pseudo">
                                </div>
                                <div class="col s12 input-field">
                                    <label >Mot de passe</label>
                                    <input type="password" name="password">
                                </div>
                                

                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="./Inscription/"  class="left-align" style="margin-left:15px;position:relative;top: 29%;">S\'inscrire</a>
                            <button type="submit"  class="login white-text modal-action modal-close waves-effect waves-light btn deep-light lighten-1">Connecter</button>
                            <a href=""  class="cancel deep-light darken-1 white-text modal-action modal-close waves-effect waves-light btn" style="margin-right:6px;">Annuler</a>
                        </div>
                    </form>
                </div>';
      }
    echo   '<!--chemin-->
            <div class="chemin">
                <a href="./" class="breadcrumb black-text" >Forum</a>
            </div>';
    echo '<!--image et boutton-->
            <div id="imageButton" class="col l12 s12 hide-on-large-only">
                <!--bouton menu large-->
                <a href="#" data-activates="slide-out" id="bouttonMenu" class="button-collapse">☰</a>
            </div>

            <!--conteneur des forums-->
            <div class="col s12 row card-panel" id="contenerForum">

                <!--grand titre-->
                <div class="row col s12 bigTitle">
                    <h1 >Liste des forums</h1>
                </div>';
        include("../fonction/listForum.php");

        echo '</div>
                        <!--le footer pour user simple-->
                <footer id="footer" class="page-footer col l12 m12 s12" style="rgba(0,0,0,0.35);">
                    <div class="container">
                        <div class="row">
                            <div class="col l6 s12">
                                <p class="grey-text text-lighten-4" >Vous pouvez aussi accéder à :</p>
                            </div>
                            <div class="col l4 offset-l2 s12">
                                <ul>
                                    <li style="margin-bottom:5px;"><a class="grey-text text-lighten-3" href="./Reglement/" >Reglement forum</a></li>
                                    <li><a class="grey-text text-lighten-3 aide" href="">Aide forum</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="footer-copyright">
                        <div class="container">
                            <p>© 2017 Copyright Text</p>
                        </div>
                    </div>
                </footer>

            </div>
            </div>

            <script src="../framework/jquery-3.1.1.min.js" type="text/javascript"></script>
            <script src="../framework/materialize.min.js" type="text/javascript"></script>
            <script src="../assets/js/script.js" type="text/javascript"></script>
            <script>
                $(document).ready(function(){
                    var taille = $(window).width();
                   if( taille > 992 ){
                       $(".aide").attr("href","./Aide/?screen=large");
                   }
                   else{
                       $(".aide").attr("href","./Aide/?screen=small");
                   }
                });
            </script>';
        include("../fonction/toast.php");

?>
