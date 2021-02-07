<?php
    $vide=true;
    $_SESSION["dest"]=2;
    echo '<div class="col s12 row">
    <!--   inclure les boites!-->';
    try{
        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
        $bdd = new PDO('mysql:host=localhost;dbname=project', 'root', '', $pdo_options);
        $bdd->exec("set names utf8");
        $reponse = $bdd->query('SELECT * FROM user WHERE bloquer=1');
        $i=3;
        while ($donnees_util = $reponse->fetch()){
            $vide=false;
            echo'<ul class="collapsible col l8 m10 offset-l2 s12 offset-m1" data-collapsible="accordion">
                    <li>
                        <div class="collapsible-header">
                            <div class="col s8">
                                <span class="col s2">
                                    <img src="../../img/user1.png" height="20" width="20" class="responsive-img">
                                </span>
                                <span>'.$donnees_util["pseudo"].'</span>
                            </div>
                            <div>
                                <span class="badge">Détailler</span>
                            </div>
                        </div>
                        <div class="collapsible-body">
                            <div class="col l9 m12 s12">
                                <div class="col s4">
                                    <h6 style="margin-top:20px;">Nom :</h6>
                                    <h6>Prenom :</h6>
                                    <h6>Age :</h6>
                                    <h6>Pseudo :</h6>
                                    <h6 style="margin-bottom:20px;">Email :</h6>
                                </div>
                                <div>
                                    <h6 style="margin-top:20px;">'.$donnees_util["nom"].'</h6>
                                    <h6>'.$donnees_util["prenom"].'</h6>
                                    <h6>'.$donnees_util["age"].'</h6>
                                    <h6>'.$donnees_util["pseudo"].'</h6>
                                    <h6 style="margin-bottom:20px;">'.$donnees_util["email"].'</h6>
                                </div>
                            </div>
                            <div class="row col s12 right-align">';
                            $i++;
                            if ($donnees_util["bloquer"]==0) {
                                echo'<a class="waves-effect waves-orange btn #4dd0e1 cyan lighten-2 white-text" href="#modal'.$i.'">Bloquer</a>
                            </div>
                        </div>
                    </li>
                </ul>
                <!-- Modal Structure -->
                <div id="modal'.$i.'" class="modal">
                    <div class="modal-content">
                        <h4>Voulez vous vraiment bloquer cet utilisateur ?</h4>
                    </div>
                    <div class="modal-footer">
                        <a href="../part/sql_rep.php?val=1&ps='.$donnees_util["email"].'&dest=2" class=" modal-action modal-close waves-effect waves-green btn-flat #4dd0e1 cyan lighten-2 white-text">Valider</a>
                        <a href="" class=" modal-action modal-close waves-effect waves-green btn-flat #4dd0e1 cyan lighten-2 white-text" style="margin-right:6px">Annuler</a>
                    </div>
                </div>';
            }
            else {
                    echo'<a class="waves-effect waves-orange btn #4dd0e1 cyan lighten-2 white-text" href="#modal'.$i.'">Débloquer</a>
                    <!-- Modal Structure -->
                   <div id="modal'.$i.'" class="modal">
                     <div class="modal-content">
                       <h4>Voulez vous vraiment débloquer cet utilisateur ?</h4>
                     </div>
                     <div class="modal-footer">
                       <a href="../part/sql_rep.php?val=0&ps='.$donnees_util["email"].'&dest=2" class="#4dd0e1 cyan lighten-2 white-text modal-action modal-close waves-effect waves-green btn-flat">Valider</a>
                       <a href="" class="modal-action modal-close waves-effect waves-green btn-flat #4dd0e1 cyan lighten-2 white-text" style="margin-right:6px">Annuler</a>
                     </div>
                   </div>
                </li>
            </ul>';
            }
        }
        if ($vide){
            echo '<div class="col s12 row #e0e0e0 grey lighten-2" style="margin-top:64px">
                    <h4 class="center-align">Aucun utilisateur bloqué</h4>
                </div>';
        }
        $reponse->closeCursor();
    }
    catch (Exception $e){
        die('Erreur : ' . $e->getMessage());
    }
    echo'</div>';


?>
