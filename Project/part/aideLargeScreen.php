<!--page d'aide pour les larges écrans-->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Aide</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" sizes="144x144" href="../../img/logo_bibliotheque_fr.ico">
    <link rel="stylesheet" type="text/css" href="../../framework/materialize.min.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/main.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/breadcrumb.css">
</head>
<body>
<?php
    include("../../part/barNav.html");
?>
            <!--chemin-->
            <nav id="breadcrumb" class="#eeeeee grey lighten-3" style="height: 44px;line-height: 24px;">
                <div class="nav-wrapper">
                  <div class="col s12 chemin">
                    <a href="../" class="breadcrumb black-text">Forum</a>
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
            <div class="row  s12 conteneur" style="margin-top:50px">

                <!--aide pour quelqu'un déconnecter-->
                <div id="deconnecter" class="card-panel row">
                    <legend>Si vous êtes déconnecté</legend>
                    <div class="col s12 row">
                        <div class="card-panel col l4 offset-l1" id="forum">
                            <img class="materialboxed responsive-img" data-caption="Surfer dans le forum"  src="../../img/large/aideforum.PNG">
                        </div>

                        <div class="card-panel col l4 offset-l1" id="questDeconnect">
                            <img class="materialboxed responsive-img" data-caption="Surfer dans les questions"  src="../../img/large/aidequestion.PNG">
                        </div>
                    </div>

                    <div class="col s12 row">
                        <div class="card-panel col l4 offset-l1" id="repDeconnect">
                            <img class="materialboxed responsive-img" data-caption="Surfer dans les réponses"  src="../../img/large/aidemessage.PNG">
                        </div>

                        <div class="card-panel col l4 offset-l1" id="inscription">
                            <img class="materialboxed responsive-img" data-caption="Inscription"  src="../../img/large/aideinscription.PNG">
                        </div>
                    </div>

                    <div class="col s12 row">
                        <div class="card-panel col l4 offset-l1" id="connexion">
                            <img class="materialboxed responsive-img" data-caption="Se connecter"  src="../../img/large/aideconnexion.PNG">
                        </div>
                    </div>
                </div>

                <!--aide pour quelqu'un connecter-->
                <div id="connecter" class="card-panel row">
                    <legend>Si vous êtes connecté</legend>
                    <div class="col s12 row">
                        <div class="card-panel col l4 offset-l1" id="posterQuest">
                            <img class="materialboxed responsive-img" data-caption="Poster une question"  src="../../img/large/aidequestconnect.PNG">
                        </div>

                        <div class="card-panel col l4 offset-l1" id="posterRep">
                            <img class="materialboxed responsive-img" data-caption="Poster un message"  src="../../img/large/aidemsgconnect.PNG">
                        </div>
                    </div>
                    <div class="col s12 row">
                        <div class="card-panel col l4 offset-l1" id="compte">
                            <img class="materialboxed responsive-img" data-caption="Modifier compte"  src="../../img/large/aidecompte.PNG">
                        </div>
                    </div>
                </div>
            </div>

            <style>
                #connecter{
                    margin-top: 60px;
                }
                legend{
                    font-size: 1.4em;
                    margin-bottom: 20px;
                    font-weight: 700;
                }
            </style>

<?php include("../../part/footer.html"); ?>
</body>
</html>
