<?php
    session_start();
    //si un modérateur essaie d'entrée dans cette espace par un lien
    if( isset($_SESSION["type"]) && strcmp($_SESSION["type"],"a")==0 ){
      header('location: ../Rendez-Vous/'.'$page=1'));
    }
?>


<!DOCTYPE html>
    <html lang="fr">
    <head>
      <meta charset="UTF-8">
      <title>Prise de rendez-vous</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="icon" sizes="144x144" href="../.././img/principale.ico">
      <link rel="stylesheet" type="text/css" href="../../framework/materialize.min.css">
      <link rel="stylesheet" type="text/css" href="../../assets/css/main.css">
      <link rel="stylesheet" type="text/css" href="../../assets/css/calendrier.css">
      <link rel="stylesheet" type="text/css" href="../../assets/css/breadcrumb.css">
      <link rel="stylesheet" type="text/css" href="../../assets/css/fontawesome-all.min.css">
      <link rel="stylesheet" type="text/css" href="../.././fonts/css/fontawesome-all.min.css">
      <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
      <script src="../../assets/js/calendrier.js"></script>
    </head>
    <body>
            <!--la page complète-->
        <div class="row" id="complete">

            <!--la barre de navigation-->
            <div id="slide-out" class="side-nav fixed col l3 s2 #eeeeee grey lighten-3"><!--style="background-color: #e6fffa "-->

                    <!--le logo de la biblio-->
                    <div id="logo">

                        <img src="../.././img/stro.jpg" class="responsive-img" alt="">
                    </div>

                    <!--le menu-->
                    <a class="btn_menu" href="../.././" >Accueil</a>
                    <a class="btn_menu" href="../.././Forum/" >Forum</a>
                    <a class="btn_menu" href="./prise_rdv.php">Rendez-Vous</a>
             
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

      

      
      <div class="slider col s12" id="slider" style="margin-bottom: -145px;">
              <div class="caption" style="background: linear-gradient(
 rgba(46,142,206, 0.28), 
 rgba(46,142,206, 0.38)
 ), url(../.././img/1.png) repeat, url(../.././img/2.jpg) no-repeat center; height: 250px;  margin: -50px auto auto -22px; opacity: 2.0;">
                <h1 class="center" style="padding-top: 50px; color: white; font-weight: bolder;">RENDEZ-VOUS</h1>
                <p class="center" style="color: white;">Prendre rendez-vous par Internet</p>
              </div>
      </div>



    </div>
     <?php
                //initialisé les variables
                $prenomErr = $nomErr = $emailErr = $telErr = $dateErr = $timeErr = $existe = "";
                $prenom = $nom = $email = $tel = $date = $time  = "";
                $prenomVal = $nomVal = $emailVal = $telVal = $dateVal = $timeVal = false;

                if ($_SERVER["REQUEST_METHOD"] == "POST") {

                      $telVal = true;
                      $dateVal=true;
                      $timeVal= true;
                      if (empty($_POST["prenom"])) {
                        $prenomErr = "prénom manquant";
                      } else {
                        $prenom=strtoupper($prenom);
                        $prenom = test_input($_POST["prenom"]);
                        // testé si les noms contients seulement des lettres et des blancs
                        if (!preg_match("/^[a-zA-ZéèîïÉÈÎÏ][a-zéèêàçîï]+([\-'\s][a-zA-ZéèîïÉÈÎÏ][a-zéèêàçîï]+)?$/",$prenom)) {
                          $prenomErr = "Format incorrect : juste des lettres";
                        }
                        else $prenomVal=true;
                      }

                      if (empty($_POST["nom"])) {
                        $nomErr = "nom manquant";
                      } else {
                        $nom=strtoupper($nom);
                        $nom = test_input($_POST["nom"]);
                        if (!preg_match("/^[a-zA-Z ]*$/",$nom)) {
                          $nomErr = "Format incorrect : juste des lettres";
                        }
                        else $nomVal=true;
                      }

                     if (empty($_POST["age"])) {
                        $ageErr = "age manquant";
                      } else {
                        $age = test_input($_POST["age"]);
                        if ( $age > 75 ){
                          $ageErr = "vous êtes trop vielleux";
                        }
                        else if($age < 14){ $ageErr = "vous êtes trop petit"; }
                             else $ageVal=true;
                      }

                      if (empty($_POST["email"])) {
                        $emailErr = "Email manquant";
                      } else {
                        $email = test_input($_POST["email"]);
                        // check if e-mail address is well-formed
                        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                          $emailErr = "format invalide";
                        }
                        else $emailVal=true;
                      }

                      

                      

                     

                      if ( $nomVal && $prenomVal && $emailVal && $telVal && $dateVal && $timeVal){
                          try{
                             $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                             $bdd = new PDO('mysql:host=localhost;dbname=biblio', 'root', '', $pdo_options);
                             $req = $bdd->prepare('SELECT email FROM rendez-vous WHERE email=? ');
                             $req->execute(array($email));
                             if ($donnees = $req->fetch()){
                                 $existe = $email.' vous êtes déjà inscrit';
                             }
                             else{
                                 $req->closeCursor();
                                 $reponse = $bdd->prepare('INSERT INTO `rendez-vous`(`id_rdv`, `prenom`, `nom`, `email`, `tel`, `daterdv`, `heurerdv`) VALUES (:id_rdv, :prenom,:nom, :email , :tel , :daterdv , :heurerdv)

                                  ');
                                 $reponse->execute(array(   'prenom' => $prenom,
                                                            'nom' => $nom,
                                                            'age' => $age,
                                                            'email' => $email,
                                                            'daterdv' => $date,
                                                            'heure-rdv' => $time));
                                 
                                 $prenom = $nom = $age = $email = $daterdv = $heureèrdv = $existe = "";
                                 $reponse->closeCursor();
                                 
                                 header('location: ../');
                             }

                          }
                          catch (Exception $e){
                                 die('Erreur : ' . $e->getMessage());
                          }
                      }
                }

                function test_input($data) {
                  $data = trim($data);
                  $data = stripslashes($data);
                  $data = htmlspecialchars($data);
                  return $data;
                }
            ?>
<div class="row" style="float: left; margin-left: 70px; margin-bottom: 100px;">
    <div class="col l4 m12 s12" >
      <img class=" vc_box_border_grey " src="../.././img/rdv.jpg" alt="Prendre-rendez-vous" width="300" height="320">
    </div>
    <div class="col l8 s12" >
      <!--<legend style="font-size: 20px;">Prendre rendez-vous</legend>-->
                    <form action="" method="post" id="form">

                        <div class="col l5 m5 s5 input-field">
                            <label for="fname" class="" >Prenom</label>
                            <input type="text" name="prenom" id="fname" class="col l9" value="" required><span class="col l3 erreur" id='missPrenom'><?php echo $prenomErr;?></span>
                        </div>
                        <div class="col l5 m5 s5 input-field">
                            <label for="lname" >Nom</label>
                            <input type="text" name="nom" id="lname" class="col l9" value="" required><span class="col l3 erreur" id='missNom'><?php echo $nomErr;?></span>
                        </div>
                        <div class="col l5 m5 s5 input-field">
                            <label for="email" >Email</label>
                            <input type="email" name="email"  id="email" class="col l9" value="" required><span class="col l3 erreur" id='missEmail'><?php echo $emailErr;?></span>
                        </div>
                        <div class="col l5 m5 s5 input-field">
                            <label for="tel" >tel</label>
                            <input type="text" name="tel" id="tel" class="col l9" value="" required><span class="col l3 erreur" id='missTel'><?php echo $telErr;?></span>
                        </div>
                        
                        <div class="col l5 m5 s5 input-field" >
                           <label for="date">rendez-vous le</label>
                            <input type="date" style="" value="" name="date"  id="date" class="col l9 wpcf7-form-control wpcf7-date hasDatepicker" required><?php echo $dateErr;?><span class="col l3 erreur" id='missDate'></span>
                        </div>
                        <div class="col l5 m5 s5 input-field" >
                           <label for="time">rendez-vous le</label>
                            <input type="time" style="" value="" name="time"  id="time" class="col l9 wpcf7-form-control wpcf7-date hasDatepicker" required><?php echo $timeErr;?><span class="col l3 erreur" id='missDate'></span>
                        </div>
                                            
                                                
                        <div  class="col s5 button right-align" >
                            <a href="#modal1"  class="btn darken-1 waves-effect waves-purple" id="btn" style="width: 120px; margin-left: 135%;">Envoyer</a>
                        </div>
                       <!--Boite dialogue réglement-->
                        <div id="modal1" class="modal modal-fixed-footer">
                          <div class="modal-content">

                                <!--Titre-->
                                

                                
                                <style>
                                    .titre{
                                        font-size: xx-large;
                                        margin-top: 35px;
                                    }
                                    #list{
                                        list-style-type:disc;
                                        padding: 14px 35px;
                                    }
                                    @media screen and (max-width:601px){
                                        #list{
                                            padding: 14px 0px;
                                        }
                                        .regle{
                                            margin-left: 20px;
                                        }
                                    }
                                    .gras{
                                        font-weight: 700;
                                        margin-bottom: 15px;
                                    }
                                    .gras:first-letter{
                                        margin-left: 10px;
                                    }

                                    @media screen and (min-width:601px){
                                        .regle{
                                            margin-left: 40px;
                                        }
                                    }
                                    .regle li{
                                        margin-bottom: 10px;
                                    }

                                </style>
                          </div>
                          <div class="modal-footer">
                            <button type="submit"  class="modal-action modal-close btn waves-effect waves-light">J'accepte</button>
                            <a href="#"  class="modal-action modal-close btn waves-effect waves-light" style="margin-right:6px;">Je décline</a>
                          </div>
                        </div>
                   </form>
    </div>
  
    
    
  

</div>
</div>

<script src="../.././framework/jquery-3.1.1.min.js" type="text/javascript"></script>
<script src="../.././framework/materialize.min.js" type="text/javascript"></script>
<script src="../.././assets/js/script.js" type="text/javascript"></script>


</div>
<footer style="">

                <div class="bg-color footer-copyright fixed-padding">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="copyright-section"><p class="center" >Memoire fin de cycle Licence| RÉALISÉ PAR <a href="http://gest-soft.com" target="_blank">Groupe Developpement L3</a></p></div>
            </div>
          </div>
        </div>
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
