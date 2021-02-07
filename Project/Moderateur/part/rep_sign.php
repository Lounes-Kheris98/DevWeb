<?php
    $_SESSION["dest"]=0;
    $vide=true;
        echo'<div class="col s12 row">
            <!--   inclure les boites!-->';
            try{
                $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                $bdd = new PDO('mysql:host=localhost;dbname=project', 'root', '', $pdo_options);
                $bdd->exec("set names utf8");
                $reponse = $bdd->query('SELECT DISTINCT(i.id_rep), rep, DATE_FORMAT(date_rep, "%d/%m/%Y à %H:%i:%s") AS date, pseudo,bloquer, i.email FROM reponse AS i INNER JOIN signaler_rep AS s ON i.id_rep=s.id_rep INNER JOIN user AS u ON i.email=u.email');

                $i=3;

               while ($donnees_msg_sign = $reponse->fetch()){
                $vide=false;
                echo'<!--les messages-->
                    <div class="col s12 card-panel">
                        <!--auteur&image-->
                        <div class="col l3 m3 s4 offset-s4 center-align card-panel" id="author">
                            <div class="col s12">
                                <img src="../../img/person-icon.png" width="70%" class="responsive-img" alt="" style="margin-top:15px">
                                <p class="center-align">'.$donnees_msg_sign["pseudo"].'</p>
                            </div>
                        </div>

                        <!--date&réponse-->
                        <div class="col l9 m9 s12 answer">
                            <div class="col s12 row" style="margin-top:20px;">
                                <span>'.nl2br(htmlspecialchars($donnees_msg_sign["rep"])).'</span>
                                <pre class="col s12 row"> '.$donnees_msg_sign["date"].'</pre>
                            </div>
                        </div>
                        <div class="col s12 row">
                            <div class="right-align row">';
                            $i++;
                            $bloque= $donnees_msg_sign["bloquer"];
                            echo'<a class=" waves-effect waves-orange btn #4dd0e1 cyan lighten-2" href="#modal'.$i.'">';
                            if ($bloque==0){
                                echo 'Bloquer';
                            }else{ echo 'Débloquer'; }
                            echo '</a>
                            <!-- Modal Structure -->
                            <div id="modal'.$i.'" class="modal">
                                <div class="modal-content">
                                    <h4>Voulez vous vraiment bloquer le contacte  ?</h4>
                                </div>
                                <div class="modal-footer">
                                    <a  class=" modal-action modal-close waves-effect waves-green btn-flat #4dd0e1 cyan lighten-2 white-text" href="../part/sql_rep.php?val=';
                                    if ($bloque==0){ echo '1'; }else{ echo '0'; }
                                    echo '&ps='.$donnees_msg_sign["email"].'&dest=0">valider</a>
                                    <a href="" class="modal-action modal-close waves-effect waves-green btn-flat #4dd0e1 cyan lighten-2 white-text" style="margin-right:6px">annuler</a>
                                </div>
                            </div> ';

                            echo'<a class="waves-effect waves-orange btn #4dd0e1 cyan lighten-2" href="#modale'.$i.'" >supprimer</a>
                                <div id="modale'.$i.'" class="modal">
                                    <div class="modal-content">
                                        <h4>Voulez vous vraiment supprimer le message ?</h4>
                                    </div>
                                    <div class="modal-footer">
                                        <a class=" modal-action modal-close waves-effect waves-green btn-flat #4dd0e1 cyan lighten-2 white-text" href="../part/sql_rep.php?sup=1&id='.$donnees_msg_sign["id_rep"].'"  >valider</a>
                                        <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat #4dd0e1 cyan lighten-2 white-text" style="margin-right:6px">annuler</a>
                                    </div>
                                </div>
                                <a  class="waves-effect waves-orange btn #4dd0e1 cyan lighten-2" href="../part/sql_rep.php?id='.$donnees_msg_sign["id_rep"].'">Ignorer</a>
                            </div>
                        </div>
                    </div>';
                }
                if ($vide){
                    echo '<div class="col s12 row #e0e0e0 grey lighten-2" style="margin-top:64px;">
                            <h4 class="center-align">Aucune réponse signalée</h4>
                        </div>';
                }
                $reponse->closeCursor();
            }
            catch (Exception $e){
                die('Erreur : ' . $e->getMessage());
            }

        echo '</div>';

?>
