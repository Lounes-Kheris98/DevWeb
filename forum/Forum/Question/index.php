<?php
    session_start();
    //si un modérateur essaie d'entrée dans cette espace par un lien
    if( isset($_SESSION["type"]) && strcmp($_SESSION["type"],"a")==0 ){
      header('location: ../Moderateur/Forum/Question/?domaine='. htmlspecialchars($_GET["domaine"].'$page=1'));
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
          //si ce domaine existe dans la BDD
          $_SESSION["domaine"]=$data["nom_domaine"]; //pour l'éditeur
          $_SESSION["pageCourante"]="theme"; //pour l'éditeur

          //si l'utilistaeur n'est pas bloquer entrain de se connecter
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
            <title><?php echo $data["nom_domaine"]; ?></title>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="icon" sizes="144x144" href="../../img/stro.ico">
            <link rel="stylesheet" type="text/css" href="../../framework/materialize.min.css">
            <link rel="stylesheet" type="text/css" href="../../assets/css/main.css">
            <link rel="stylesheet" type="text/css" href="../../assets/css/Theme.css">
            <link rel="stylesheet" type="text/css" href="../../assets/css/breadcrumb.css">
            <link rel="stylesheet" href="../../assets/css/editeurThemeUser.css">
            <link rel="stylesheet" href="../../fonts/roboto/material-icons.css">
        </head>
        <body>

<?php
    echo '    <!--la page complète-->
    <div class="row" id="complete">

        <!--la barre de navigation-->
        <div id="slide-out" class="side-nav fixed col l3 s2 #eeeeee grey lighten-3">

                <!--le logo de la biblio-->
                <div id="logo">
                    <img src="../../img/stro.jpg" class="responsive-img" alt="">
                </div>

                <!--le menu-->
                <a class="btn_menu" href="../../" >Accueil</a>
                <a class="btn_menu" href="../" >Forum</a>
                <a class="btn_menu" href="../../Rendez-Vous/">Rendez-Vous</a>
               

        </div>

        <!--principale-->
        <div id="principale" class="col s12">';
    if (isset($_SESSION["pseudo"])){
        echo '<!--barre de menu-->
        <nav id="topBar" class="#eeeeee grey lighten-3" style="height: 50px;line-height: 46px;">
            <div class="nav-wrapper">
                <div class="col s12 right-align">
                    <div id="connect">';
                    echo '<a  class="hide-on-small-only btn  waves-effect waves-light" href="#modal2" style="margin-right:4px">deconnecter</a>';
                    echo '<a href="../Compte/"  class="hide-on-small-only btn waves-effect waves-light">compte</a>
                        <a href="../Aide/" class="aide hide-on-small-only btn waves-effect waves-light">?</a>
                        <button id="paramaitre" class="hide-on-med-and-up btn waves-effect waves-light">&#128315;</button>
                            <div id="listParamaitre" class="card-panel">
                                <p id="fleche">&#128314;</p>
                                <a href="../Compte/" >Compte</a>
                                <a href="#modal2" >Deconnecter</a>
                                <a href="../Aide/" class="aide" >Aide</a>
                            </div>';
                echo '</div>
                </div>
            </div>
        </nav>';
        //la boite de dialogue de deconnection
        echo '<div id="modal2" class="modal">
                <div class="modal-content" style="border-bottom:1px solid gray;">
                    <h4 class="black-text left-align">Voulez-vous vraiment vous déconnecter?</h4>
                </div>
                <div class="modal-footer">';
                    echo '<a href="../../fonction/deconnection.php?domaine='. htmlspecialchars($_GET["domaine"]) .'" class="white-text modal-action modal-close waves-effect waves-green btn deep-light lighten-1">deconnecter</a>';
                    echo '<a href="" class="white-text modal-action modal-close waves-effect waves-light btn deep-light lighten-1" style="margin-right:6px">Annuler</a>
                </div>
            </div>';
    }
  else{
    echo '<!--la barre de menu horizontale pour user déconnecter-->
                <nav id="topBar" class="#eeeeee grey lighten-3" style="height: 50px; line-height: 46px;">
                    <div class="nav-wrapper">
                        <div class="col s12 right-align">
                            <div id="connect">
                                <a href="#modal1"  class="hide-on-small-only btn waves-effect waves-light">Se connecter</a>
                                <a href="../Inscription/"  class="hide-on-small-only btn waves-effect waves-light">S\'inscrire</a>
                                <a href="../Aide/" class="hide-on-small-only btn aide waves-effect waves-light">?</a>
                                <button id="paramaitre" class="hide-on-med-and-up btn waves-effect waves-light">&#128315;</button>
                                  <div id="listParamaitre" class="card-panel">
                                    <p id="fleche">&#128314;</p>
                                    <a href="#modal1">Se connecter</a>
                                    <a href="../Inscription/">S\'inscrire</a>
                                    <a href="../Aide/" class="aide">Aide</a>
                                  </div>
                            </div>
                        </div>
                    </div>
                </nav>
                <!--la boite de dialogue de connection-->
                <div id="modal1" class="modal modal-fixed-footer">
                    <form method="post" action="../../fonction/connection.php">
                        <div class="modal-content">
                            <div class="col s12 center-align">
                                <img src="../../img/avatar_defaut.png" id="imagelogin" alt="avatar">
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
                                <style>
                                    .input-field input[type=text]:focus {
                                         border-bottom: 1px solid #039be5;
                                         box-shadow: 0 1px 0 0 #039be5;
                                    }

                                    .input-field input[type=password]:focus{
                                        border-bottom: 1px solid #039be5;
                                        box-shadow: 0 1px 0 0 #039be5;
                                    }
                                </style>
                                <input type="hidden" name="domaine" value="'. htmlspecialchars($_GET["domaine"]) .'">

                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="../Inscription/"  class="left-align" style="margin-left:15px;position:relative;top: 29%;">S\'inscrire</a>
                            <button type="submit"  class="login white-text modal-action modal-close waves-effect waves-green btn deep-light lighten-1">Connecter</button>
                            <a href=""  class="cancel deep-light lighten-1 white-text modal-action modal-close waves-effect waves-light btn" style="margin-right:6px;">Annuler</a>
                        </div>
                    </form>
                </div>';
  }
    echo '<div class="chemin">
                <a href="../" class="breadcrumb black-text" >Forum</a>
                <a href="" class="breadcrumb black-text">'. htmlspecialchars($_GET["domaine"]) .'</a>
            </div>';
    echo '<!--image et boutton-->
            <div id="imageButton" class="col l12 s12 hide-on-large-only">
                <!--bouton menu large-->
                <a href="#" data-activates="slide-out" id="bouttonMenu" class="button-collapse">☰</a>
            </div>';
    include("../../fonction/listTheme.php");
    if (isset($_SESSION["pseudo"])){
        echo '<!--ajouter une question-->
            <div class="col l10 offset-l1 m11 s12 row" style="margin-top: 50px;">

                <ul class="collapsible" data-collapsible="accordion">
                    <li>
                      <div class="collapsible-header" >Poser une question</div>
                      <div class="collapsible-body">
                          <iframe src="../../part/editeur.php" id="editor" width="100%" sandbox="allow-same-origin allow-scripts allow-forms"></iframe>
                      </div>
                    </li>
                  </ul>

            </div>';
    }
    else{
            echo '<div class="col s12" style="margin-top:60px;margin-bottom:30px;">
                    <a href="#modal1" class="center-align white black-text " style="display:flex; flex-direction:row; justify-content:center;">
                      <img src="../../img/alerte.png" style="width: 30px;vertical-align: middle;">
                      <span class="center-align tooltipped" data-position="bottom" data-delay="50" data-tooltip="Cliquer pour vous connecter">Veuillez vous connecter pour ajouter une question</span>
                    </a>
                  </div>';
        }
  ?>
    <!--image de scroll en haut-->
   <img src="../../img/scroll-to-top.png" alt="" id="scrollTop">
   <!--le footer pour user simple-->
    <footer id="footer" class="page-footer #9e9e9e grey col l12 m12 s12">
        <div class="container">
            <div class="row">
                <div class="col l6 s12">
                    <p class="grey-text text-lighten-4">Vous pouvez aussi accéder à :</p>
                </div>
                <div class="col l4 offset-l2 s12">
                    <ul>
                        <li style="margin-bottom:5px;"><a class="grey-text text-lighten-3" href="../Reglement/" >Reglement forum</a></li>
                        <li><a class="grey-text text-lighten-3 aide" href="../Aide/" >Aide forum</a></li>
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

<script src="../../framework/jquery-3.1.1.min.js" type="text/javascript"></script>
<script src="../../framework/materialize.min.js" type="text/javascript"></script>
<script src="../../assets/js/script.js" type="text/javascript"></script>
<script>
    $(document).ready(function(){
        var taille = $(window).width();
       if( taille > 992 ){
           $(".aide").attr("href","../Aide/?screen=large");
       }
       else{
           $(".aide").attr("href","../Aide/?screen=small");
       }
    });
    function getMessage(){
      $.post("../../fonction/getLastQuest.php?domaine=<?php echo htmlspecialchars($_GET['domaine']); ?>",function(data){
        if(data){
          if(document.getElementById('msgVide')){
            $("#msgVide").remove();
            $('#listQuest').removeClass();
          }
          $('#listQuest').append(data);
        }
      },"text");
      return false;
    }
    <?php
      if (($pageActuelle == $nombreDePages) || ($nombreDePages==0)){
          echo "$(function(){
                    setInterval(function() {
                      getMessage();
                    }, 1000);
                  });";
      }
    ?>
</script>
<script>
        //pliante (ajout d'une question)
        $(document).ready(function(){
            $(".collapsible").collapsible();
        });
</script>

<?php
            include("../../fonction/toast.php");
            $rep->closeCursor();
        }
        else{
            header('location: ../../Erreur.html');
        }

    }
    catch (Exception $e){
         die('Erreur : ' . $e->getMessage());
    }
  }
  else{
      header('location: ../../Erreur.html');
  }
?>
