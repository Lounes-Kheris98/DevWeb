<?php
    $vide=true;
    echo'<div class="col s12 row">
        <!--inclure les boites!-->';
    try{
        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
        $bdd = new PDO('mysql:host=localhost;dbname=project', 'root', '', $pdo_options);
        $bdd->exec("set names utf8");
        $reponse = $bdd->query('SELECT DATE_FORMAT(date_quest, "%d/%m/%Y à %H:%i:%s") AS date, date_signal,pseudo, titre_quest, question,bloquer, i.id_question, i.email FROM question AS i INNER JOIN signaler_quest AS s ON i.id_question=s.id_question INNER JOIN user  AS u ON i.email=u.email ORDER BY date_signal');
        $i=3;
        while ($donnees_quest = $reponse->fetch()){
            $vide=false;
            echo'<div class="col s12 card-panel">
                    <!--auteur&image-->
                    <div class="col l3 m3 s4 offset-s4 center-align card-panel" id="author">
                        <div class="col s12 center-align" >
                            <img src="../../img/person-icon.png" width="70%" class="responsive-img" alt="" style="margin-top:15px;">
                            <p class="center-align">'.$donnees_quest["pseudo"].'</p>
                        </div>
                    </div>
                    <!--date&réponse-->
                    <div class="col l9 m9 s12 answer">
                        <div class="col s12 row" style="margin-top:20px;">
                            <p>'.$donnees_quest["titre_quest"].'</p>
                            <span>'. nl2br(htmlspecialchars($donnees_quest["question"])) .'</span>
                            <pre class="col s12 row"> '.$donnees_quest["date"].'</pre>
                        </div>
                    </div>
                    <div class="col s12 row">
                        <div class="right-align row">';
                            $i++;
                            echo '<a class="waves-effect waves-orange btn #4dd0e1 cyan lighten-2" href="#modal'.$i.'">';
                                if ($donnees_quest["bloquer"]==0){echo 'Bloquer';}else{ echo 'Débloquer';}
                                echo '</a>
                                    <!-- Modal Structure -->
                                    <div id="modal'.$i.'" class="modal">
                                        <div class="modal-content">
                                        <h4>Voulez vous vraiment bloquer le contacte  ?</h4>
                                    </div>
                                    <div class="modal-footer">
                                        <a  class=" modal-action modal-close waves-effect waves-green btn-flat #4dd0e1 cyan lighten-2 white-text" href="../part/sql_quest.php?val=';
                                        if ($donnees_quest["bloquer"]==0) { echo '1';}else{ echo '0';}
                                        echo '&ps='.$donnees_quest["email"].'">Valider</a>
                                        <a href="" class="#4dd0e1 cyan lighten-2 modal-action modal-close waves-effect waves-green btn-flat white-text" style="margin-right:6px">Annuler</a>
                                    </div>
                                </div> ';
                                echo '<a class="waves-effect waves-orange btn #4dd0e1 cyan lighten-2" href="#modale'.$i.'" >supprimer</a>
                                    <div id="modale'.$i.'" class="modal">
                                        <div class="modal-content">
                                            <h4>Voulez vous vraiment supprimer le message ?</h4>
                                        </div>
                                        <div class="modal-footer">
                                            <a class="modal-action modal-close waves-effect waves-green btn-flat #4dd0e1 cyan lighten-2 white-text" href="../part/sql_quest.php?sup=1&id='.$donnees_quest["id_question"].'">Valider</a>
                                            <a href="" class=" modal-action modal-close waves-effect waves-green btn-flat #4dd0e1 cyan lighten-2 white-text" style="margin-right:6px">Annuler</a>
                                        </div>
                                    </div>
                                    <a  class="waves-effect waves-orange btn #4dd0e1 cyan lighten-2" href="../part/sql_quest.php?id='.$donnees_quest["id_question"].'">Ignorer</a>
                                </div>
                            </div>
                        </div>';
                    }
                    if ($vide){
                        echo '<div class="col s12 row #e0e0e0 grey lighten-2" style="margin-top:64px; ">
                                <h4 class="center-align">Aucune question signalée</h4>
                            </div>';
                    }
                    $reponse->closeCursor();
                }
                catch (Exception $e){
                    die('Erreur : ' . $e->getMessage());
                }

            echo '</div>';

?>
