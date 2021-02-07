<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title >Inscription</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" sizes="144x144" href="../../img/logo_bibliotheque_fr.ico">
    <link rel="stylesheet" type="text/css" href="../../framework/materialize.min.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/main.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/Inscription.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/breadcrumb.css">
</head>
<body>
        <?php include("../../part/barNav.html"); ?>

            <!--chemin-->
            <nav id="breadcrumb" class="#eeeeee grey lighten-3" style="height: 44px;line-height: 24px;">
                <div class="nav-wrapper">
                  <div class="col s12 chemin">
                    <a href="../" class="breadcrumb black-text">Forum</a>
                    <a href="" class="breadcrumb black-text">Inscription</a>
                  </div>
                </div>
            </nav>
            <style>
                @media screen and (max-width:993px){
                    .breadcrumb:first-child{
                        margin-left: 45px;
                    }
                }
            </style>

            <!--image et boutton-->
            <div id="imageButton" class="col l12 s12 hide-on-large-only">
                <!--bouton menu large-->
                <a href="#" data-activates="slide-out" id="bouttonMenu" class="button-collapse">☰</a>
            </div>


            <?php
                //initialisé les variables
                $nomErr = $prenomErr = $ageErr = $emailErr = $pseudoErr = $mdp1Err = $mdp2Err = $existe = "";
                $nom = $prenom = $age = $email = $pseudo = $mdp1 = $mdp2 = "";
                $nomVal = $prenomVal = $ageVal = $emailVal = $pseudoVal = $mdp1Val = $mdp2Val = false;

                if ($_SERVER["REQUEST_METHOD"] == "POST") {

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
                        $nomErr = "prénom manquant";
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






                      if (empty($_POST["pseudo"])) {
                        $pseudoErr = "peudo manquant";
                      } else {
                        $pseudo = test_input($_POST["pseudo"]);
                        if (!preg_match("/^[a-zA-Z0-9_]{5,30}$/",$pseudo)) {
                          $pseudoErr = "format invalid ABC123 , minimum 5 caractères";
                        }
                        else $pseudoVal=true;
                      }




                      if (empty($_POST["mdp1"])) {
                        $mdp1Err = "mot de passe manquant";
                      } else {
                            $mdp1 = test_input($_POST["mdp1"]);
                            if (!preg_match("/[\w\!\#\$\?\.]{8,25}/",$mdp1)){
                                $mdp1Err = "mot de passe invalide , minimum 8 caractères";
                            }
                            else $mdp1Val=true;
                        }


                      if (empty($_POST["mdp2"])) {
                        $mdp2Err = "confirmation manquante";
                      } else {
                        $mdp2 = test_input($_POST["mdp2"]);
                        if ($mdp1!=$mdp2){
                            $mdp2Err = "confirmation différente";
                        }
                        else $mdp2Val=true;
                      }




                      if ( $nomVal && $prenomVal && $ageVal && $emailVal && $pseudoVal && $mdp1Val && $mdp2Val){
                          try{
                             $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                            $bdd = new PDO('mysql:host=localhost;dbname=project', 'root', '', $pdo_options);
                             $req = $bdd->prepare('SELECT email FROM user WHERE email=? OR pseudo=?');
                             $req->execute(array($email,$pseudo));
                             if ($donnees = $req->fetch()){
                                 $existe = $pseudo.' vous êtes déjà inscrit';
                             }
                             else{
                                 $req->closeCursor();
                                 $reponse = $bdd->prepare('INSERT INTO user( nom, prenom, age, email, pseudo, mdp) VALUES(:nom, :prenom, :age, :email, :pseudo, :mdp)');
                                 $reponse->execute(array(   'nom' => $nom,
                                                            'prenom' => $prenom,
                                                            'age' => $age,
                                                            'email' => $email,
                                                            'pseudo' => $pseudo,
                                                            'mdp' => $mdp1));
                                 $_SESSION["pseudo"]=$pseudo;
                                 $_SESSION["email"]=$email;
                                 $_SESSION["type"]="u";
                                 $nom = $prenom = $age = $email = $pseudo = $mdp1 = $mdp2 = $existe = "";
                                 $reponse->closeCursor();
                                 $_SESSION['inscrit']=0;
                                 $_SESSION['connect']=2;
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

            <!--inscription-->
            <div class="row" id="inscription" style="margin-top:50px">
                <?php
                    if ( $existe != "" ){
                        echo '<h5 class="center-align grey darken-3 row col s8 panel-card offset-s2 white-text">'. $existe .'</h5>';
                    }
                ?>
                <div class="col l10 m10 s12 offset-l1 offset-m1 card-panel">

                    <legend>Inscription</legend>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" id="form">

                        <div class="col l9 m10 s12 input-field">
                            <label for="fname" >Prenom</label>
                            <input type="text" name="prenom" id="fname" class="col l9" value="<?php echo $prenom;?>"><span class="col l3 erreur" id='missPrenom'><?php echo $prenomErr;?></span>
                        </div>
                        <div class="col l9 m10 s12 input-field">
                            <label for="lname" >Nom</label>
                            <input type="text" name="nom" id="lname" class="col l9" value="<?php echo $nom;?>"><span class="col l3 erreur" id='missNom'><?php echo $nomErr;?></span>
                        </div>
                        <div class="col l9 m10 s12 input-field">
                            <label for="age" >Age:</label>
                            <input type="number" name="age" max="99" min="14" id="age" class="col l9" value="<?php echo $age;?>"><span class="col l3 erreur" id='missAge'><?php echo $ageErr;?></span>
                        </div>
                        <div class="col l9 m10 s12 input-field">
                            <label for="mail" >E-mail</label>
                            <input type="text" name="email" id="mail" class="col l9" value="<?php echo $email;?>"><span class="col l3 erreur" id='missMail'><?php echo $emailErr;?></span>
                        </div>
                        <div class="col l9 m10 s12 input-field">
                            <label for="pseudo" >Pseudo</label>
                            <input type="text" name="pseudo" id="pseudo" class="col l9" value="<?php echo $pseudo;?>"><span class="col l3 erreur" id='missPseudo'><?php echo $pseudoErr;?></span>
                        </div>
                        <div class="col l9 m10 s12 input-field">
                            <label for="mdp1" >Mot de passe</label>
                            <input type="password" name="mdp1" id="mdp1" class="col l9" value="<?php echo $mdp1;?>"><span class="col l3 erreur" id='missMdp1'><?php echo $mdp1Err;?></span>
                        </div>
                        <div class="col l9 m10 s12 input-field">
                            <label for="mdp2" >Confirmer mot de passe</label>
                            <input type="password" name="mdp2" id="mdp2" class="col l9" value="<?php echo $mdp2;?>"><span class="col l3 erreur" id='missMdp2'><?php echo $mdp2Err;?></span>
                        </div>
                        <div  class="col s12 button right-align">
                            <a href="#modal1"  class="btn waves-effect waves-light" id="btn">S'inscrire</a>
                        </div>

                        <!--Boite dialogue réglement-->
                        <div id="modal1" class="modal modal-fixed-footer">
                          <div class="modal-content">

                                <!--Titre-->
                                <div class="col s12 row">
                                    <h3 class="titre" >Règlement</h3>
                                </div>

                                <!--Le règlement-->
                                <div class="col s12 row card-panel">
                                    <ul id="list">
                                        <li class="gras" >Bienvenue sur ce forum ayant pour but un échange d'expériences, d'opinions et de permettre aux étudiants de trouver toutes l’aide dont ils ont besoin auprès de leur camarades ou toute autres personne inscrite sur ce forum.</li>
                                        <li class="gras" >Si vous ne respectez pas les règles décrites ci-dessous, vous encourez le risque d'être banni du forum voire d'obtenir la suppression définitive de votre compte.</li>
                                        <div class="regle">
                                            <li style="list-style-type: disc;" >L'équipe du forum se réserve le droit de déplacer, éditer ou supprimer tout message non conforme à la charte du forum.</li>
                                            <li style="list-style-type: disc;" >Ce forum est modéré a posteriori, les messages que vous postez sont directement publiés sans aucun contrôle préalable. Il est de votre responsabilité de veiller à ce que vos contributions ne portent pas préjudice à autrui et soient conforment à la réglementation en vigueur. Les organisateurs du forum et les modérateurs se réservent le droit de retirer toute contribution qu’ils estimeraient déplacée, inappropriée, contraire aux lois et règlements, à cette charte d’utilisation ou susceptible de porter préjudice directement ou non à des tiers.</li>
                                            <li style="list-style-type: disc;" >Tout contenu illicite, diffamatoire, illégal, ou inadapté sera immédiatement supprimé sans préavis. Nous rappelons également que les agressions verbales, moqueries gratuites et vulgarités ne sont pas acceptées sur ce forum.</li>
                                            <li style="list-style-type: disc;" >Toutes insultes seront immédiatement sanctionnées et le responsable réprimandé. Nous, les modérateurs et administrateurs de ce forum, tenons à avoir et maintenir une ambiance saine et des comportements adultes et respectables.</li>
                                            <li style="list-style-type: disc;" >Le flood est interdit, les messages composés juste d'un seul mot comme "Ok", "Cool", "lol" sont interdit. Vous savez faire des phrases avec verbes, sujets, compléments alors montrez le! Pareil, si vous remerciez une personne, ne mettez pas juste "Merci".</li>
                                            <li style="list-style-type: disc;" >Il est interdit de poster des liens publicitaires ou vulgaires. Les seuls liens autorisés dans vos messages sont ceux qui permettent de comprendre votre problème ou suggestion. De même pour les liens vers des jeux faisant gagner de l'argent ou des sites faisant gagner de l'argent sont formellement interdit .</li>
                                            <li style="list-style-type: disc;" >Attention à votre écriture. Vous devez écrire un français compréhensible, on ne vous demande pas des phrases irréprochables, mais faites un effort! Le langage sms est donc à proscrire.</li>
                                            <li style="list-style-type: disc;" >N'écrivez pas TOUT EN MAJUSCULES, votre message paraîtra agressif, et on aura moins envie de répondre à votre message avec gentillesse. Il est tout de même à préciser que notre équipe de modérateur ne peut pas tout voir. Si donc un message vous semble choquant ou autre, vous avez la possibilité de le signaler en cliquant sur le bouton signaler à cotés de celui-ci, les modérateur s’en chargeront.</li>
                                            <li style="list-style-type: disc;" >Pensez à aérer vos messages en y insérant des retours à la ligne permettant une bonne lecture.</li>
                                            <li style="list-style-type: disc;" >Avant de poser une question effectuez une recherche pour vérifier si le sujet n’a pas été déjà traité.</li>
                                            <li style="list-style-type: disc;" >Lorsque vous posez une nouvelle question, pensez à choisir le domaine correspondant.</li>
                                            <li style="list-style-type: disc;" >Si le domaine que vous cherchez n’existe pas dans la liste des domaines prédéfinis par les modérateurs, vous avez la possibilité de poser votre question dans le domaine « AUTRE ».</li>
                                            <li style="list-style-type: disc;" >Les organisateurs du forum se réservent le droit d’exclure du forum, de façon temporaire ou définitive, toute personne dont les contributions sont en contradiction avec les règles mentionnées ci-dessus.</li>
                                        </div>
                                    </ul>
                                </div>
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


    <?php include("../../part/footer.html"); ?>
    <script src="../../assets/js/formulaire.js" type="text/javascript"></script>

</body>
</html>
