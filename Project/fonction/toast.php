            <script>
                // la boite de dialogue de connexion
                $(document).ready(function(){
                    $("#modal1").modal();
                });
                // la boite de dialogue de déconnection
                $(document).ready(function(){
                    $("#modal2").modal();
                  });
            </script>
            <script>
            <?php
              // les boites de message d'informations
              if ((isset($_SESSION["connect"])) && ($_SESSION["connect"]==0)){
                 echo 'Materialize.toast("Votre compte a été bloquer !", 4000);';
                 unset($_SESSION["connect"]);
              }
              if ((isset($_SESSION["connect"])) && ($_SESSION["connect"]==1)){
                 echo 'Materialize.toast("Erreur: pseudo ou mot de passe incorrect !", 4000);';
                 unset($_SESSION["connect"]);
              }
              if ((isset($_SESSION["connect"])) && ($_SESSION["connect"]==2)){
                 echo 'Materialize.toast("Vous êtes connecté", 4000);';
                 unset($_SESSION["connect"]);
              }
              if ((isset($_SESSION["deconnect"])) && ($_SESSION["deconnect"]==0)){
                 echo 'Materialize.toast("Vous êtes deconnecté", 4000);';
                 unset($_SESSION["deconnect"]);
              }
              if ((isset($_SESSION["inscrit"])) && ($_SESSION["inscrit"]==0)){
                 echo 'Materialize.toast("Vous êtes inscrit", 4000);';
                 unset($_SESSION["inscrit"]);
              }
              if ((isset($_SESSION["question"])) && ($_SESSION["question"]==1)){
                 echo 'Materialize.toast("Veillez remplir les deux champs titre et question", 4000);';
                 unset($_SESSION["question"]);
              }
              if ((isset($_SESSION["reponse"])) && ($_SESSION["reponse"]==1)){
                 echo 'Materialize.toast("Veillez remplir le champ réponse", 4000);';
                 unset($_SESSION["reponse"]);
              }
              if ((isset($_SESSION["signalerQuest"])) && ($_SESSION["signalerQuest"]==1)){
                 echo 'Materialize.toast("Vous avez déjà signaler cette question", 4000);';
                 unset($_SESSION["signalerQuest"]);
              }
              if ((isset($_SESSION["signalerQuest"])) && ($_SESSION["signalerQuest"]==2)){
                 echo 'Materialize.toast("Question signaler", 4000);';
                 unset($_SESSION["signalerQuest"]);
              }
              if ((isset($_SESSION["signalerRep"])) && ($_SESSION["signalerRep"]==1)){
                 echo 'Materialize.toast("Vous avez déjà signaler cette réponse", 4000);';
                 unset($_SESSION["signalerRep"]);
              }
              if ((isset($_SESSION["signalerRep"])) && ($_SESSION["signalerRep"]==2)){
                 echo 'Materialize.toast("Réponse signaler", 4000);';
                 unset($_SESSION["signalerRep"]);
              }
            ?>
            </script>

        </body>
        </html>
