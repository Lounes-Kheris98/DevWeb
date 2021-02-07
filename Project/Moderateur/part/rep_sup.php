<?php
    $vide=true;
    echo'<div class="col s12 row">
    <!--   inclure les boites!-->';
    try{
        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
        $bdd = new PDO('mysql:host=localhost;dbname=project', 'root', '', $pdo_options);
        $bdd->exec("set names utf8");
        $reponse = $bdd->query('SELECT pseudo, rep, DATE_FORMAT(date_rep, "%d/%m/%Y à %H:%i:%s") AS date FROM reponse AS r INNER JOIN user AS u ON r.email=u.email  WHERE r.supprime=1');
        while ($donnees_sup = $reponse->fetch()){
            $vide=false;
               echo '<div class="col s12 card-panel  ">
                        <!--auteur&image-->
                        <div class="col l3 m3 s4 offset-s4 center-align card-panel" id="author">
                            <div class="col s12 center-align">
                               <img src="../../img/person-icon.png" width="70%" class="responsive-img" alt="" style="margin-top:15px">
                               <p class="center-align">'.$donnees_sup["pseudo"].' </p>
                           </div>
                       </div>
                       <!--date&réponse-->
                       <div class="col l9 m9 s12" style="margin-top:20px">
                            <div class="col s12 m12 l12 row">
                                <span>'. nl2br(htmlspecialchars($donnees_sup["rep"])) .'</span>
                                <pre class="col s12 row">'.$donnees_sup["date"].'</pre>
                            </div>
                        </div>
                    </div>';
       }
        if ($vide){
            echo '<div class="col s12 row #e0e0e0 grey lighten-2">
                <h4 class="center-align">Aucune réponse supprimée</h4>
            </div>';
        }
     $reponse->closeCursor();
    }
    catch (Exception $e){
        die('Erreur : ' . $e->getMessage());
    }
    echo '</div>';
?>
