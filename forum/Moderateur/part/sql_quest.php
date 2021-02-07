<?php
    try{
      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
      $bdd = new PDO('mysql:host=localhost;dbname=project', 'root', '', $pdo_options);

      //bloquer l'utilisateur
      if (isset($_GET["val"]) && isset($_GET["ps"])){
          $reponse = $bdd->prepare(' UPDATE user SET bloquer=:n WHERE email=:e'); /*requete préparer */
          $reponse->execute(array(
            "n"=>(int)$_GET["val"],
            "e"=>$_GET["ps"]
        ));
        $reponse->closeCursor();
      }
        //supprimer la question et les réponses associés à la question
        if (isset($_GET["sup"]) && isset($_GET["id"])){
            $sup_quest =$bdd->prepare('UPDATE question SET supprime=:s WHERE id_question=:r');
            $sup_quest->execute(array(
              "s"=>(int)$_GET["sup"],
              "r"=>$_GET["id"]
            ));
            $sup_quest->closeCursor();

            $sup_rep=$bdd->prepare('UPDATE reponse SET supprime=:s WHERE id_question=:r');
            $sup_rep->execute(array(
              "s"=>(int)$_GET["sup"],
              "r"=>$_GET["id"]
            ));
            $sup_rep->closeCursor();
            //supprimer la question de la table des questions signalées
            $sup_quest_sign =$bdd->prepare(' DELETE FROM signaler_quest  WHERE id_question=?');
            $sup_quest_sign->execute(array($_GET["id"]));
            $sup_quest_sign->closeCursor();
            //supprimer les réponse de la table des réponses signalées
            $idrep = $bdd->prepare('SELECT id_rep , id_question FROM reponse WHERE id_question=?');
            $idrep->execute(array($_GET["id"]));
             while ($donnees = $idrep->fetch()){
                $sup_rep_sign =$bdd->prepare('DELETE FROM signaler_rep WHERE id_rep=? ');
                $sup_rep_sign->execute(array((int)$donnees["id_rep"]));
                $sup_rep_sign->closeCursor();
             }
            $idrep->closeCursor();

        }

        //supprimer la question de la table des questions signalées
        if ((!isset($_GET["sup"])) && isset($_GET["id"])){
            $ign_quest_sign=$bdd->prepare('DELETE FROM signaler_quest WHERE id_question=?');
            $ign_quest_sign->execute(array((int)$_GET["id"]));
            $ign_quest_sign->closeCursor();
        }
    }
        catch (Exception $e){
            die('Erreur : ' . $e->getMessage());
        }
        header('location: ../QuestionSignaler/');
 ?>
