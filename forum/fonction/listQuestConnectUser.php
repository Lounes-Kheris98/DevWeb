<?php
        //la question pour user simple
        $vide=true;
        echo '<!--discussion-->
            <div id="discussion" class="col l12 s12 row card-panel">

                <!--Titre de théme-->
                <div id="titleDiscussion" class="col s12 row">';
        try{
         $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
         $bdd = new PDO('mysql:host=localhost;dbname=project', 'root', '', $pdo_options);
         $bdd->exec('set names utf8');
         $reponse = $bdd->prepare('SELECT id_question, titre_quest FROM question WHERE id_question=?');
         $reponse->execute(array($_GET["id_quest"]));
            $donnees = $reponse->fetch();
                echo '<h1>'. htmlspecialchars($donnees["titre_quest"]) .'</h1>';
                $reponse->closeCursor();
        }
        catch (Exception $e){
             die('Erreur : ' . $e->getMessage());
        }

        echo '</div>';

      if (strcmp($_GET["page"],"1")==0){
        // la question
        try{
         $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
         $bdd = new PDO('mysql:host=localhost;dbname=project', 'root', '', $pdo_options);
         $bdd->exec('set names utf8');
         $reponse = $bdd->prepare('SELECT id_question, supprime, question, DATE_FORMAT(date_quest, "%d/%m/%Y à %H:%i:%s") AS date_q, pseudo FROM question q,user u WHERE q.email=u.email AND nom_domaine=? AND id_question=? AND supprime=0');
         $reponse->execute(array($_GET["domaine"],$_GET["id_quest"]));
            while ($donnees = $reponse->fetch()){
                    $vide=false;
                    echo "<!--Discussion-->
                    <div class='col s12 message'>
                        <!--auteur&image-->
                        <div class='col l2 m2 s12 auteur'>
                            <p>". $donnees["pseudo"] ."</p>
                            <div class='col s12 center-align'>
                              <img src='../../../img/avatar_defaut.png' class='responsive-img' alt=''>
                            </div>
                        </div>
                        <!--date&réponse-->
                        <div class='col l9 m9 s11 answer'>
                            <div class='col s12 row'>
                                <span class='reponse'>". nl2br($donnees["question"]) ."</span>
                            </div>
                            <pre class='col s12 row'>". $donnees["date_q"] ."</pre>
                        </div>";
                        //boutton signaler une question
                          echo "<form action='../../../fonction/signalerQuest.php' method='post' class='col s1 right-align'>
                                <input type='submit' style='font-size:20px; border:none; background-color:transparent' title='Signaler' value='&#9888;'>
                                <input type='hidden' name='id_quest' value='". $donnees["id_question"] ."'>
                                <input type='hidden' name='domaine' value='". htmlspecialchars($_GET["domaine"]) ."'>
                                <input type='hidden' name='page' value='".htmlspecialchars($_GET["page"])."'>
                            </form>";
                    echo "</div>";

            }
            if ($vide){
                echo '<div class="col s12 row #e0e0e0 grey lighten-2" style="margin-top:64px;">
                        <h4  class="center-align">Cette discussion a été supprimée</h4>
                    </div>';
            }
            $reponse->closeCursor();
        }
        catch (Exception $e){
             die('Erreur : ' . $e->getMessage());
        }
      }
      else{
        $vide=false;
      }
        //le liste des réponses associés à la question
        try{
         $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
         $bdd = new PDO('mysql:host=localhost;dbname=project', 'root', '', $pdo_options);
         $bdd->exec('set names utf8');
         echo "<div id='listRep'>";
         $msgParPage=5;
         $rep = $bdd->prepare('SELECT COUNT(id_rep) AS nbrep FROM reponse r, question q WHERE r.id_question=? AND r.id_question=q.id_question AND nom_domaine=? AND r.supprime=0');
         $rep->execute(array($_GET["id_quest"],$_GET["domaine"]));
         $result = $rep->fetch();
         $total=intval($result["nbrep"]);
         $nombreDePages=ceil($total/$msgParPage);
         $pageActuelle=intval($_GET['page']);
         if($pageActuelle>$nombreDePages){
            $pageActuelle=$nombreDePages;
          }
          if($pageActuelle<=0){
            $pageActuelle=1;
          }
          if ($total == 0){
            goto label;
          }
        $premiereEntree=($pageActuelle-1)*$msgParPage; // On calcul la première entrée à lire

         $reponse = $bdd->prepare('SELECT id_question ,id_rep,rep, supprime, DATE_FORMAT(date_rep, "%d/%m/%Y à %H:%i:%s") AS date_r, pseudo FROM user u,reponse r WHERE r.email=u.email AND id_question=? AND supprime=0 ORDER BY date_rep ASC LIMIT '.$premiereEntree.', '.$msgParPage.'');
         $reponse->execute(array($_GET["id_quest"]));

            while ($donnees = $reponse->fetch()){
                    echo "<!--Discussion-->
                    <div class='col s12 message'>
                        <!--auteur&image-->
                        <div class='col l2 m2 s12 auteur'>
                            <p>". $donnees["pseudo"] ."</p>
                            <div class='col s12 center-align'>
                              <img src='../../../img/avatar_defaut.png' class='responsive-img' alt=''>
                            </div>
                        </div>
                        <!--date&réponse-->
                        <div class='col l9 m9 s11 answer'>
                            <div class='col s12 row'>
                                <span class='reponse'>". nl2br($donnees["rep"]) ."</span>
                            </div>
                            <pre class='col s12 row'>". $donnees["date_r"] ."</pre>
                        </div>";
                        //boutton signaler une réponse

                        echo "<form action='../../../fonction/signalerRep.php' method='post' class='col s1 right-align'>
                                <input type='submit' title='Signaler' value='&#9888;' style='font-size:20px; border:none; background-color:transparent'>
                                <input type='hidden' name='id_rep' value='". $donnees["id_rep"] ."'>
                                <input type='hidden' name='domaine' value='". htmlspecialchars($_GET["domaine"]) ."'>
                                <input type='hidden' name='id_quest' value='". htmlspecialchars($_GET["id_quest"]) ."'>
                                <input type='hidden' name='page' value='".htmlspecialchars($_GET["page"])."'>
                            </form>";

                    echo "</div>";
                }
                label :
                echo '</div>';
            echo '</div>';
          $reponse->closeCursor();

          //pagination
          if(!$vide && ($nombreDePages>1)){
            echo '<ul class="pagination center-align">
                  <li class="waves-effect"><a href="./?domaine='.htmlspecialchars($_GET["domaine"]).'&id_quest='.htmlspecialchars($_GET["id_quest"]).'&page=1"><i class="material-icons">fast_rewind</i></a></li>';
            if ($pageActuelle==1){
              echo '<li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>';
            }else{
              echo '<li class="waves-effect"><a href="./?domaine='.htmlspecialchars($_GET["domaine"]).'&id_quest='.htmlspecialchars($_GET["id_quest"]).'&page='.($pageActuelle-1).'"><i class="material-icons">chevron_left</i></a></li>';
            }
          if($nombreDePages>=3){
            switch ($pageActuelle) {
                case 1:
                      for($i=1; $i<=$pageActuelle+2; $i++){
                        if($i==$pageActuelle){
                             echo '<li class="active black"><a href="">'.$i.'</a></li>';
                         }
                         else{
                              echo '<li class="waves-effect"><a href="./?domaine='.htmlspecialchars($_GET["domaine"]).'&id_quest='.htmlspecialchars($_GET["id_quest"]).'&page='.$i.'">'.$i.'</a></li>';
                         }
                      }
                  break;
                case $nombreDePages:
                    for($i=$nombreDePages-2; $i<=$nombreDePages; $i++){
                      if($i==$pageActuelle){
                           echo '<li class="active black"><a href="">'.$i.'</a></li>';
                       }
                       else{
                            echo '<li class="waves-effect"><a href="./?domaine='.htmlspecialchars($_GET["domaine"]).'&id_quest='.htmlspecialchars($_GET["id_quest"]).'&page='.$i.'">'.$i.'</a></li>';
                       }
                    }
                  break;
                default:
                    for($i=$pageActuelle-1; $i<=$pageActuelle+1; $i++){
                      if($i==$pageActuelle){
                           echo '<li class="active black"><a href="">'.$i.'</a></li>';
                       }
                       else{
                            echo '<li class="waves-effect"><a href="./?domaine='.htmlspecialchars($_GET["domaine"]).'&id_quest='.htmlspecialchars($_GET["id_quest"]).'&page='.$i.'">'.$i.'</a></li>';
                       }
                    }
                  break;
              }
            }
            else{
                for($i=1; $i<=$nombreDePages; $i++){
                  if($i==$pageActuelle){
                       echo '<li class="active black"><a href="">'.$i.'</a></li>';
                   }
                   else{
                        echo '<li class="waves-effect"><a href="./?domaine='.htmlspecialchars($_GET["domaine"]).'&id_quest='.htmlspecialchars($_GET["id_quest"]).'&page='.$i.'">'.$i.'</a></li>';
                   }
                 }
            }
            if($pageActuelle==$nombreDePages){
              echo '<li class="disabled"><a href="#!"><i class="material-icons">chevron_right</i></a></li>';
            }else {
              echo '<li class="waves-effect"><a href="./?domaine='.htmlspecialchars($_GET["domaine"]).'&id_quest='.htmlspecialchars($_GET["id_quest"]).'&page='.($pageActuelle+1).'"><i class="material-icons">chevron_right</i></a></li>';
            }
            echo '
                  <li class="waves-effect"><a href="./?domaine='.htmlspecialchars($_GET["domaine"]).'&id_quest='.htmlspecialchars($_GET["id_quest"]).'&page='.$nombreDePages.'"><i class="material-icons">fast_forward</i></a></li>
              </ul>';
          }
          $last = $bdd->query('SELECT id_rep FROM reponse WHERE id_question='.$_GET["id_quest"].' AND supprime=0 ORDER BY date_rep DESC LIMIT 1');
          if($data = $last->fetch()){
            $_SESSION["lastIdRep"]=$data["id_rep"];
          }
          else{
            $_SESSION["lastIdRep"]=0;
          }
          $last->closeCursor();
        }
        catch (Exception $e){
             die('Erreur : ' . $e->getMessage());
        }
?>
