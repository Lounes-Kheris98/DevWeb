<?php
    $vide=true;
    echo'<div class="boite col s12 row">
    <!--   inclure les boites!-->';
    try{
      $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
      $bdd = new PDO('mysql:host=localhost;dbname=project', 'root', '', $pdo_options);
      $bdd->exec("set names utf8");
      $reponse = $bdd->query('SELECT pseudo, q.email, titre_quest, question, DATE_FORMAT(date_quest, "%d/%m/%Y à %H:%i:%s") AS date FROM question AS q INNER JOIN user AS u ON q.email=u.email WHERE q.supprime=1');
         while ($donnees_quest_sup = $reponse->fetch()){
            $vide=false;
           echo '<div class="col s12 card-panel">
                    <!--auteur&image-->
                    <div class="col l3 m3 s4 offset-s4 center-align card-panel" id="author">
                        <div class="col l12 m12 s12 center-align">
                            <img src="../../img/person-icon.png" width="70%" class="responsive-img" alt="" style="margin-top:15px">
                            <p class="center-align">'.$donnees_quest_sup["pseudo"].' </p>
                        </div>
                    </div>
                    <!--date&réponse-->
                    <div class="col l9 m9 s12 answer">
                        <div class="col s12 row">
                            <p>'.$donnees_quest_sup["titre_quest"].'</p>
                            <span>'. nl2br(htmlspecialchars($donnees_quest_sup["question"])) .'</span>
                            <pre class="col s12 row">'.$donnees_quest_sup["date"].'</pre>
                        </div>
                    </div>
                </div>';
        }
        if ($vide){
            echo '<div class="col s12 row #e0e0e0 grey lighten-2" style="margin-top:64px;">
                    <h4 class="center-align">Aucune question supprimée</h4>
                </div>';
        }
        $reponse->closeCursor();
    }
    catch (Exception $e){
        die('Erreur : ' . $e->getMessage());
    }
    echo '</div>';
?>
