<?php
    session_start();
    // si un utilisateur essaie d'entrée dans l'espace de moderateur par un lien
    if(isset($_SESSION["type"]) && (strcmp($_SESSION["type"],"u")==0)){
      header('location: ../../Forum/');
    }
    else{ if(!isset($_SESSION["type"])){
          header('location: ../../Forum/');
        }
    }
?>
<?php
    // si un utilisateur essaie d'entrée dans l'espace de moderateur par un lien et il n'est pas connecté
    if (isset($_SESSION["pseudo"])){
        try{
            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            $bdd = new PDO('mysql:host=localhost;dbname=project', 'root', '', $pdo_options);
            $bdd->exec('set names utf8');
            $reponse = $bdd->prepare('SELECT email, bloquer FROM user WHERE email=?');
            $reponse->execute(array($_SESSION["email"]));
            $donnees = $reponse->fetch();
            //si le modoerateur et bloquer ou pas
            if ($donnees["bloquer"]==1){
              session_unset();
              $_SESSION["connect"]=0;
              $_SESSION["deconnect"]=0;
              header('location: ../../Forum/');
            }
            $reponse->closeCursor();
          }
          catch (Exception $e){
              die('Erreur : ' . $e->getMessage());
          }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Paramaitre compte</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" sizes="144x144" href="../../img/logo_bibliotheque_fr.ico">
    <link rel="stylesheet" type="text/css" href="../../framework/materialize.min.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/main.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/breadcrumb.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/compte.css">
</head>
<?php
      include("../part/menu_mod.php");
?>

            <!--chemin-->
            <nav id="breadcrumb" class="#eeeeee grey lighten-3" style="height: 44px;line-height: 24px;">
                <div class="nav-wrapper">
                  <div class="col s12 chemin">
                    <a href="../Forum/" class="breadcrumb black-text">Forum</a>'
                    <a href="" class="breadcrumb black-text">Paramaitre compte</a>
                  </div>
                </div>
            </nav>

            <!--image et boutton-->
            <div id="imageButton" class="col l12 s12 hide-on-large-only">
                <!--bouton menu large-->
                <a href="#" data-activates="slide-out" id="bouttonMenu" class="button-collapse">☰</a>
            </div>

            <style>
                @media screen and (max-width:993px){
                    .breadcrumb:first-child{
                        margin-left: 45px;
                    }
                }
            </style>

            <?php
                try{
                    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                    $bdd = new PDO('mysql:host=localhost;dbname=project', 'root', '', $pdo_options);
                    $bdd->exec('set names utf8');
                    $reponse = $bdd->prepare('SELECT nom, prenom, pseudo, mdp,age, email FROM user WHERE pseudo=? AND email=?');
                    $reponse->execute(array( $_SESSION["pseudo"], $_SESSION["email"]));
                    $donnees = $reponse->fetch();

                //initialisé les variables
                $nomErr = $prenomErr = $ageErr = $pseudoErr = $mdpErr = $mdp1Err = $mdp2Err = "";
                $nom = $prenom = $age = $pseudo = $mdp = $mdp1 = $mdp2 = "";
                $nomVal = $prenomVal = $ageVal = $pseudoVal = $mdpVal = $mdp1Val = $mdp2Val = false;

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        function test_input($data){
                          $data = trim($data);
                          $data = stripslashes($data);
                          $data = htmlspecialchars($data);
                          return $data;
                        }
                      if (!empty($_POST["prenom"])) {
                        $prenom = test_input($_POST["prenom"]);
                        // tester si les noms contients seulement des lettres et des blancs
                        if (!preg_match("/^[a-zA-ZéèîïÉÈÎÏ][a-zéèêàçîï]{1,50}([\-'\s][a-zA-ZéèîïÉÈÎÏ][a-zéèêàçîï]+)?$/",$prenom)) {
                          $prenomErr = "Format incorrect : juste des lettres";
                        }
                        else $prenomVal=true;
                      }

                      if (!empty($_POST["nom"])) {
                        $nom = test_input($_POST["nom"]);
                        if (!preg_match("/^[a-zA-Z ]{1,50}$/",$nom)) {
                          $nomErr = "Format incorrect : juste des lettres";
                        }
                        else $nomVal=true;
                      }

                      if (!empty($_POST["age"])) {
                        $age = test_input($_POST["age"]);
                        if ( $age > 75 ){
                          $ageErr = "Vous êtes trop vielleux";
                        }
                        else if($age < 14){ $ageErr = "Vous êtes trop petit"; }
                             else $ageVal=true;
                      }

                      if (!empty($_POST["pseudo"])) {
                        $pseudo = test_input($_POST["pseudo"]);
                        //si le pseudo est valide
                        if (!preg_match("/^[a-zA-Z0-9_]{5,30}$/",$pseudo)) {
                          $pseudoErr = "Format invalid ABC123 , minimum 5 caractères";
                        }
                        else $pseudoVal=true;
                      }

                      if (!empty($_POST["mdp"])) {
                        $mdp = test_input($_POST["mdp"]);
                        if (!preg_match("/[\w\!\#\$\?\.]{8,25}/",$mdp)){
                            $mdpErr = "Mot de passe invalide , minimum 8 caractères";
                        }
                        else{
                            if ($mdp!=$donnees["mdp"]){
                                $mdpErr = "Erreur mot de passe incorrect";
                            }else $mdpVal=true;
                        }

                      }

                      if (!empty($_POST["mdp1"])) {
                        $mdp1 = test_input($_POST["mdp1"]);
                        if (!preg_match("/[\w\!\#\$\?\.]{8,25}/",$mdp1)){
                            $mdp1Err = "Mot de passe invalide , minimum 8 caractères";
                        }
                        else $mdp1Val=true;
                      }

                      if (!empty($_POST["mdp2"])) {
                        $mdp2 = test_input($_POST["mdp2"]);
                        if ($mdp1!=$mdp2){
                            $mdp2Err = "Confirmation différente";
                        }
                        else $mdp2Val=true;
                      }

                      // si les controles sont satisfaits
                      if ( $nomVal || $prenomVal || $ageVal || $pseudoVal || ($mdpVal && $mdp1Val && $mdp2Val)){
                          try{
                             $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                             $cdd = new PDO('mysql:host=localhost;dbname=project', 'root', '', $pdo_options);
                             $cdd->exec('set names utf8');
                             if ($nomVal){
                                $req = $cdd->prepare('UPDATE user SET nom=? WHERE email=?');
                                $req->execute(array($nom,$donnees["email"]));
                                $_SESSION["nomModifier"]=1;
                             }
                             if ($prenomVal){
                                $req = $cdd->prepare('UPDATE user SET prenom=? WHERE email=?');
                                $req->execute(array($prenom,$donnees["email"]));
                                $_SESSION["prenomModifier"]=1;
                             }
                             if ($ageVal){
                                $req = $cdd->prepare('UPDATE user SET age=? WHERE email=?');
                                $req->execute(array($age,$donnees["email"]));
                                $_SESSION["ageModifier"]=1;
                             }
                             if ($pseudoVal){
                                $req = $cdd->prepare('UPDATE user SET pseudo=? WHERE email=?');
                                $req->execute(array($pseudo,$donnees["email"]));
                                $_SESSION["pseudo"]=$pseudo;
                                $_SESSION["pseudoModifier"]=1;

                             }
                             if ($mdp1Val && $mdp2Val && $mdpVal){
                                $req = $cdd->prepare('UPDATE user SET mdp=? WHERE email=?');
                                $req->execute(array($mdp1,$donnees["email"]));
                                $_SESSION["mdpModifier"]=1;
                             }
                             $nom = $prenom = $age = $pseudo = $mdp = $mdp1 = $mdp2 = "";
                             $nomVal = $prenomVal = $ageVal = $mdpVal = $mdp1Val = $mdp2Val = false;
                             $req->closeCursor();
                             header("Refresh:1");
                          }
                          catch (Exception $e){
                                 die('Erreur : ' . $e->getMessage());
                          }

                    }

                }

            ?>
            <!-- pour afficher et modifier les infos d'un user -->
            <div id=info_user>
                <div class="col l10 m10 s12 offset-l1 offset-m1 card-panel">
                    <legend>Votre compte</legend>
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id="form">

                        <ul class="collapsible col l10 m10 s12 offset-l1 offset-m1" data-collapsible="accordion">
                          <li>
                            <div class="collapsible-header<?php if(strcmp($nomErr,'')!=0){echo ' active';} ?>"><span id="champNom">Nom: <?php echo $donnees["nom"]; ?></span><span class="badge" style="color:#039be5;">modifier<img src="../../img/pencil.png" style="width: 20px;" alt=""></span></div>
                            <div class="collapsible-body">
                                <div class="col l10 m10 s12 offset-l1 offset-m1 input-field">
                                    <label for="lname">Nom</label>
                                    <input type="text" name="nom" value="<?php echo $nom;?>" id="lname">
                                    <span class="erreur" id='missNom'><?php echo $nomErr;?></span>
                                </div>
                            </div>
                          </li>
                        </ul>

                        <ul class="collapsible col l10 m10 s12 offset-l1 offset-m1" data-collapsible="accordion">
                          <li>
                            <div class="collapsible-header<?php if(strcmp($prenomErr,'')!=0){echo ' active';} ?>"><span id="champPrenom">Prenom: <?php echo $donnees["prenom"]; ?></span><span class="badge" style="color:#039be5;">modifier<img src="../../img/pencil.png" style="width: 20px;" alt=""></span></div>
                            <div class="collapsible-body">
                                <div class="col l10 m10 s12 offset-l1 offset-m1 input-field">
                                    <label for="fname">Prenom</label>
                                    <input type="text" name="prenom" value="<?php echo $prenom;?>" id="fname">
                                    <span class="erreur" id='missPrenom'><?php echo $prenomErr;?></span>
                                </div>
                            </div>
                          </li>
                        </ul>

                        <ul class="collapsible col l10 m10 s12 offset-l1 offset-m1" data-collapsible="accordion">
                          <li>
                            <div class="collapsible-header<?php if(strcmp($ageErr,'')!=0){echo ' active';} ?>"><span id="champAge">Age: <?php echo $donnees["age"]; ?></span><span class="badge" style="color:#039be5;">modifier<img src="../../img/pencil.png" style="width: 20px;" alt=""></span></div>
                            <div class="collapsible-body">
                                <div class="col l10 m10 s12 offset-l1 offset-m1 input-field">
                                    <label for="age">Age:</label>
                                    <input type="number" name="age" max="99" min="14" id="age" value="<?php echo $age;?>">
                                    <span class="erreur" id='missAge'><?php echo $ageErr;?></span>
                                </div>
                            </div>
                          </li>
                        </ul>

                        <ul class="collapsible col l10 m10 s12 offset-l1 offset-m1" data-collapsible="accordion">
                          <li>
                            <div class="collapsible-header<?php if(strcmp($pseudoErr,'')!=0){echo ' active';} ?>"><span id="champPseudo">Pseudo: <?php echo $donnees["pseudo"]; ?></span><span class="badge" style="color:#039be5;">modifier<img src="../../img/pencil.png" style="width: 20px;" alt=""></span></div>
                            <div class="collapsible-body">
                                <div class="col l10 m10 s12 offset-l1 offset-m1 input-field">
                                    <label for="pseudo">Pseudo</label>
                                    <input type="text" name="pseudo" id="pseudo" value="<?php echo $pseudo;?>">
                                    <span class="erreur" id='missPseudo'><?php echo $pseudoErr;?></span>
                                </div>
                            </div>
                          </li>
                        </ul>

                        <ul class="collapsible col l10 m10 s12 offset-l1 offset-m1" data-collapsible="accordion">
                          <li>
                            <div class="collapsible-header<?php if((strcmp($mdpErr,'')!=0)||(strcmp($mdp1Err,'')!=0)||(strcmp($mdp2Err,'')!=0) ){echo ' active';} ?>"><span>Changer mot de passe</span><span class="badge" style="color:#039be5;">modifier<img src="../../img/pencil.png" style="width: 20px;" alt=""></span></div>
                            <div class="collapsible-body">
                                <div class="col l10 m10 s12 offset-l1 offset-m1 input-field">
                                    <label for="mdp">Ancien mot de passe</label>
                                    <input type="password" name="mdp" id="mdp" value="<?php echo $mdp;?>">
                                    <span class="erreur" id='missMdp'><?php echo $mdpErr;?></span>
                                </div>
                                <div class="col l10 m10 s12 offset-l1 offset-m1 input-field">
                                    <label for="mdp1">Nouveau mot de passe</label>
                                    <input type="password" name="mdp1" id="mdp1" value="<?php echo $mdp1;?>">
                                    <span class="erreur" id='missMdp1'><?php echo $mdp1Err;?></span>
                                </div>
                                <div class="col l10  m10 s12 offset-l1 offset-m1 input-field">
                                    <label for="">Confirmation mot de passe</label>
                                    <input type="password" name="mdp2" id="mdp2" value="<?php echo $mdp2;?>">
                                    <span class="erreur" id='missMdp2'><?php echo $mdp2Err;?></span>

                                </div>
                            </div>
                          </li>
                        </ul>
                        <div class="right-align button">
                            <button type="reset" class="btn waves-effect waves-light">annuler</button>
                            <a href="#modal3" class="btn waves-effect waves-light">valider</a>
                        </div>
                        <!--la boite de dialogue de confirmation des modification-->
                        <div id="modal3" class="modal">
                            <div class="modal-content" style="border-bottom:1px solid gray;">
                                <h5 class="black-text left-align">Vous êtes sur le point de modifier vos informations, voulez-vous continuer?</h5>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="modal-action white-text modal-close waves-effect waves-light btn" id="btn">Oui</button>
                                <a href="" class="modal-action modal-close white-text waves-effect waves-light btn" style="margin-right:6px;">Annuler</a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

        <?php
                    $reponse->closeCursor();
                }
                catch (Exception $e){
                     die('Erreur : ' . $e->getMessage());
                }
                  include("../part/footer.html");
        ?>
                <script>
                     $(document).ready(function(){
                            $("#modal3").modal();
                      });
                      <?php
                        if ((isset($_SESSION["nomModifier"])) && ($_SESSION["nomModifier"]==1)){
                           echo 'Materialize.toast("Nom modifié", 4000);';
                           unset($_SESSION["nomModifier"]);

                        }
                        if ((isset($_SESSION["prenomModifier"])) && ($_SESSION["prenomModifier"]==1)){
                           echo 'Materialize.toast("Prenom modifié", 4000);';
                           unset($_SESSION["prenomModifier"]);
                        }
                        if ((isset($_SESSION["ageModifier"])) && ($_SESSION["ageModifier"]==1)){
                           echo 'Materialize.toast("Age modifié", 4000);';
                           unset($_SESSION["ageModifier"]);
                        }
                        if ((isset($_SESSION["pseudoModifier"])) && ($_SESSION["pseudoModifier"]==1)){
                           echo 'Materialize.toast("Pseudo modifié", 4000);';
                           unset($_SESSION["pseuodModifier"]);
                        }
                        if ((isset($_SESSION["mdpModifier"])) && ($_SESSION["mdpModifier"]==1)){
                           echo 'Materialize.toast("Mot de passe modifié", 4000);';
                           unset($_SESSION["mdpModifier"]);
                        }
                      ?>
                </script>
            <script src="../../assets/js/formModifie.js" type="text/javascript"></script>
        </body>
        </html>
<?php
    }
    else{
        header('location: ../../part/accessCompte.php');
    }
?>
