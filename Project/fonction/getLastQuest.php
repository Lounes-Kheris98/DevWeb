<?php
  session_start();
    try{
         $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
         $bdd = new PDO('mysql:host=localhost;dbname=project', 'root', '', $pdo_options);
         $bdd->exec('set names utf8');
         $sql = $bdd->query('SELECT q.id_question, q.supprime, nom_domaine,titre_quest, DATE_FORMAT(date_quest, "%d/%m/%Y %H:%i:%s") AS date_q, pseudo FROM question q,user u WHERE q.id_question>'.$_SESSION["lastIdQuest"].' AND q.email=u.email AND nom_domaine="'.$_GET["domaine"].'" AND q.supprime=0 ORDER BY date_quest');
         while ($data = $sql->fetch()){
          echo '<!--question-->
          <div class="col s12 row question">
              <div class="col s9">
                <a href="./Reponse/?domaine='. htmlspecialchars($_GET["domaine"]) .'&id_quest='. $data["id_question"] .'&page=1">
                  <h3>'. htmlspecialchars($data["titre_quest"]) .'</h3>
                  <p>Par <strong>'. $data["pseudo"].'</strong> '. $data["date_q"] .'</p>
                </a>
              </div>
              <div class="col s3 nbMessage">';
              $reponse = $bdd->query("SELECT id_question, COUNT(DISTINCT id_rep) AS nbrep FROM reponse r WHERE id_question=".$data['id_question']." AND supprime=0 GROUP BY id_question");
                  if ($dat = $reponse->fetch()){
                      if ($dat["nbrep"]>1){
                          echo "
                              <pre>". ($dat["nbrep"]+1) ." messages </pre>";
                      }
                      else{
                          echo "<pre>". ($dat["nbrep"]+1) ." messages</pre>";
                      }
                      $reponse->closeCursor();
                  }
                  else { echo "<pre>1 message </pre>"; }

          echo '</div>
          </div>';
          $_SESSION["lastIdQuest"]=$data["id_question"];
        }
        $sql->closeCursor();
    }
    catch (Exception $e){
         die('Erreur : ' . $e->getMessage());
    }

 ?>
