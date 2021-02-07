<!DOCTYPE html>
    <html lang="fr">
    <head>
      <meta charset="UTF-8">
      <title>Accueil</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="icon" sizes="144x144" href="./img/logo_bibliotheque_fr.ico">
      <link rel="stylesheet" type="text/css" href="framework/materialize.min.css">
      <link rel="stylesheet" type="text/css" href="assets/css/main.css">
      <link rel="stylesheet" type="text/css" href="assets/css/calendrier.css">
      <link rel="stylesheet" type="text/css" href="assets/css/breadcrumb.css">
      <link rel="stylesheet" type="text/css" href="assets/css/fontawesome-all.min.css">
      <link rel="stylesheet" type="text/css" href="./fonts/css/fontawesome-all.min.css">
      <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
      <script src="assets/js/calendrier.js"></script>
    </head>
    <body>
            <!--la page complète-->
        <div class="row" id="complete">

            <!--la barre de navigation-->
            <div id="slide-out" class="side-nav fixed col l3 s2 #eeeeee grey lighten-3">

                    <!--le logo de la clinique-->
                    <div id="logo">

                        <img src="./img/stro.jpg" class="responsive-img" alt="">
                        <i><p style="text-align: center; font-weight: bold; padding-left: 20px; font-size: 25px; font">Info<span style="color: blue;">Santé</span></p>
                    </i></div>

                    <!--le menu-->
                    <a class="btn_menu" href="./" >Accueil</a>
                    <a class="btn_menu" href="./Forum/">Forum</a>
                    <a class="btn_menu" href="./Rendez-Vous/">Rendez-Vous</a>
             
            </div>

            <!--principale-->
            <div id="principale" class="col s12">
              <nav id="topBar" class="#eeeeee grey lighten-3 hide-on-large-only" style="height: 50px; line-height: 46px;">
                  <div class="nav-wrapper">
                  </div>
              </nav>
    <!--image et boutton-->
    <div id="imageButton" class="col l12 s12">
      <!--boutton barre de navigation pour les petits moyens écrans-->
      <a href="#" data-activates="slide-out" id="bouttonMenu" class="button-collapse hide-on-large-only">☰</a>

      

      <!--image-->
      <div class="slider col s12" id="slider" style="width: 105%; margin:-20px -40px -10px -20px;">
              <ul class="slides">
                <li>
                  <img src="./img/santee.png" >
                  <div class="caption center-align">
                     
                  </div>
                </li>
                <li>
                  <img src="./img/sante.png" >
                  <div class="caption center-align">
                      
                  </div>
                </li>
                <li>
                  <img src="./img/imagese.png" >
                  <div class="caption center-align">
                      
                  </div>
                </li>
                <li>
                  <img src="./img/santeee.png" >
                  <div class="caption center-align">
                               
                  </div>
                </li>
              </ul>
            </div>



    </div>

    <!--annonce et calendrier-->
    <div id="annonceCalendrier" class="col l12 s12 row" style="height: auto;">

      <!--annonces-->
      <div id="annonces" class="col l7 m12 s12" style="height: auto;">
        <p style="font-size: 30px; font-weight: 200;">Evenement :</p>

<?php
    try{
     $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
     $bdd = new PDO('mysql:host=localhost;dbname=biblio', 'root', '', $pdo_options);
     $bdd->exec("set names utf8");
     $reponse = $bdd->query('SELECT annonce, DATE_FORMAT(date_annonce, "%d/%m/%Y à %H:%i:%s") AS date FROM annonce');
        while ($donnees = $reponse->fetch()){
            echo '<span class="annonce">
                    <p class="flow-text">' . nl2br(htmlspecialchars($donnees['annonce'])) .'</p>
                    <pre class="right-align">'. $donnees['date'] .'</pre>
                    <hr>
                  </span> <style>
                          .annonce p{
                            font-size : 20px;
                          } 
                  </style>';
        }
      $reponse->closeCursor();
    }
    catch (Exception $e){
         die('Erreur : ' . $e->getMessage());
    }
?>
        </div>

      <!--calendrier-->
      <div class="col l5 s12">
          <!--calendrier-->
          <div class="hide-on-med-and-down">
              <script type="text/javascript">
                  calendrier();
              </script>
          </div>

          <!--slider-->
          

      </div>
    </div>
        <!--le footer pour user simple-->
    

</div>
</div>

<script src="./framework/jquery-3.1.1.min.js" type="text/javascript"></script>
<script src="./framework/materialize.min.js" type="text/javascript"></script>
<script src="./assets/js/script.js" type="text/javascript"></script>


<script>

      //slider
      $( document ).ready(function(){
          $(".slider").slider({full_width: true});
      });

      //positionnement de div d'annonce et calendrier
      $( document ).ready(function(){
          if ($(window).width()<=992){
              var marge=$("#pic").height()+$("#topBar").height();
              $("#annonceCalendrier").css("margin-top",marge);
          }
      });

      //positionnement de div d\'annonce et calendrier lors du redimensions de l\'écran
      $(window).resize(function(){
         if ($(window).width()<=992){
              var marge=$("#pic").height()+$("#topBar").height();
              $("#annonceCalendrier").css("margin-top",marge);
          }
          else {
              $("#annonceCalendrier").css("margin-top","auto");
          }
      });

    </script>

     <footer class="page-footer" style="background-color: rgba(0,0,0,0.15);">
                <div class="container">
                  <div class="row">
                    <div class="col l4 s12" style="color: black;">
                       <h5 class="white-text">Notre site</h5>
                       <p class="grey-text text-lighten-5">Notre site dispose d'un forum medical, vous pouvez prendre des conseilles de n'importe qui.</p>
                    </div>
                    <div class="col l2 offset-l2 s12" >
                       <h5 class="white-text">Aller vers</h5>
                       <ul>
                        <li><a class="grey-text text-lighten-5" href="./Forum/">Forum</a></li>
                        <li><a class="grey-text text-lighten-5" href="./Rendez-Vous/">Rendez-Vous</a></li>
                           
                       </ul>
                    </div>
                     <div class="col l6 offset-l2 s12">
                       <h5 class="white-text">Contactez Nous</h5>
                       <ul>
                        <li class="grey-text text-lighten-5" >Tel: 0562363636</li>
                        <li class="grey-text text-lighten-5" >Email: kheris98@gmail.com</li>
                        
                           
                       </ul>
                    </div>
                  </div>
                </div>
          <div class="footer-copyright">
              <div class="container text-center">
<p class="center" style="color: black; font-weight: 200;" >Memoire fin de cycle Licence| RÉALISÉ PAR <a style="color: blue;">Groupe Developpement L3</a></p></div>
          </div>
        </footer>
                 <style type="text/css">
                   footer {
              

    background: #fafafa;
    color: #6c6c6c;

}
.fixed-padding {

    padding: 0 !important;

}
.footer-copyright {

    background: #f5f5f5;
    border-bottom: 1px solid #e6e6e6;

}
.bg-color {

    padding-top: 40px;
    padding-bottom: 40px;

}.container {

    margin-right: auto;
    margin-left: auto;
    padding-left: 15px;
    padding-right: 15px;

}.container::before, .container::after {

    content: " ";
    display: table;

}
.container::before, .container::after {

    content: " ";
    display: table;
  }
  .copyright-section {

    text-align: center;
    padding: 10px 0 0;

}.copyright-section p {

    color: #646464;

}
p {

    margin: 0 0 10px;

}
                 </style>
</body>
</html>

</body>
</html>
