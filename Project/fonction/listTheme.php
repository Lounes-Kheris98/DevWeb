<?php
    $vide=true;
    echo '<!--liste des objets-->
    <div id="listObjet" class="col l12 s12 row card-panel">
        <!--objets de la question-->
        <div id="titleTheme" class="col s4 row">
            <h1>'. htmlspecialchars($_GET["domaine"]) .'</h1>
        </div>';
    try{
         $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
         $bdd = new PDO('mysql:host=localhost;dbname=project', 'root', '', $pdo_options);
         $bdd->exec('set names utf8');
         $msgParPage=10;
         $rep = $bdd->query('SELECT COUNT(id_question) AS nbquest FROM question WHERE supprime=0 AND nom_domaine="'.htmlspecialchars($_GET["domaine"]).'"');
         $result = $rep->fetch(); $total=intval($result["nbquest"]);
         $nombreDePages=ceil($total/$msgParPage);
         $pageActuelle=intval($_GET['page']);
         if($total==0){
           goto label;
         }
        if($pageActuelle>$nombreDePages){
                $pageActuelle=$nombreDePages;
        }
        $premiereEntree=($pageActuelle-1)*$msgParPage; // On calcul la première entrée à lire

         $req = $bdd->prepare('SELECT q.id_question, q.supprime, titre_quest, DATE_FORMAT(date_quest, "%d/%m/%Y %H:%i:%s") AS date_q, pseudo FROM question q,user u WHERE q.email=u.email AND nom_domaine=? AND q.supprime=0 ORDER BY date_quest ASC LIMIT '.$premiereEntree.', '.$msgParPage.'');
         $req->execute(array(htmlspecialchars($_GET["domaine"])));
            echo '<div id="listQuest">';
            while ($donnees = $req->fetch()){
                $vide=false;  //s'il ya des questions poser
                echo '<!--question-->
                <div class="col s12 row question">
                    <div class="col s9">
                    <a href="./Reponse/?domaine='. htmlspecialchars($_GET["domaine"]) .'&id_quest='. $donnees["id_question"] .'&page=1">';
                      echo '<h3>'. htmlspecialchars($donnees["titre_quest"]) .'</h3>
                            <p>Par <strong>'. $donnees["pseudo"].'</strong> '. $donnees["date_q"] .'</p>
                        </a>
                    </div>
                    <div class="col s3 nbMessage">';
                    $reponse = $bdd->prepare('SELECT id_question, COUNT(DISTINCT id_rep) AS nbrep FROM reponse r WHERE id_question=? AND supprime=0 GROUP BY id_question');
                    $reponse->execute(array($donnees["id_question"]));
                    if ($data = $reponse->fetch()){
                        if ($data["nbrep"]>1){
                            echo '
                                <pre>'. ($data["nbrep"]+1) .' messages </pre>';
                        }
                        else{
                            echo '<pre>'. ($data["nbrep"]+1) .' messages</pre>';
                        }
                    }
                    else { echo '<pre>1 message </pre>'; }

                echo '</div>
                </div>';
                $reponse->closeCursor();
            }
            echo '</div>';
            $req->closeCursor();
            //pagination
            if(!$vide && ($nombreDePages>1)){
              echo '<ul class="pagination center-align">
                    <li class="waves-effect"><a href="./?domaine='.htmlspecialchars($_GET["domaine"]).'&page=1"><i class="material-icons">fast_rewind</i></a></li>';
              if ($pageActuelle==1){
                echo '<li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>';
              }else{
                echo '<li class="waves-effect"><a href="./?domaine='.htmlspecialchars($_GET["domaine"]).'&page='.($pageActuelle-1).'"><i class="material-icons">chevron_left</i></a></li>';
              }
            if($nombreDePages>=3){
              switch ($pageActuelle) {
                  case 1:
                        for($i=1; $i<=$pageActuelle+2; $i++){
                          if($i==$pageActuelle){
                               echo '<li class="active black"><a href="">'.$i.'</a></li>';
                           }
                           else{
                                echo '<li class="waves-effect"><a href="./?domaine='.htmlspecialchars($_GET["domaine"]).'&page='.$i.'">'.$i.'</a></li>';
                           }
                        }
                    break;
                  case $nombreDePages:
                      for($i=$nombreDePages-2; $i<=$nombreDePages; $i++){
                        if($i==$pageActuelle){
                             echo '<li class="active black"><a href="">'.$i.'</a></li>';
                         }
                         else{
                              echo '<li class="waves-effect"><a href="./?domaine='.htmlspecialchars($_GET["domaine"]).'&page='.$i.'">'.$i.'</a></li>';
                         }
                      }
                    break;
                  default:
                      for($i=$pageActuelle-1; $i<=$pageActuelle+1; $i++){
                        if($i==$pageActuelle){
                             echo '<li class="active black"><a href="">'.$i.'</a></li>';
                         }
                         else{
                              echo '<li class="waves-effect"><a href="./?domaine='.htmlspecialchars($_GET["domaine"]).'&page='.$i.'">'.$i.'</a></li>';
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
                          echo '<li class="waves-effect"><a href="./?domaine='.htmlspecialchars($_GET["domaine"]).'&page='.$i.'">'.$i.'</a></li>';
                     }
                   }
              }
              if($pageActuelle==$nombreDePages){
                echo '<li class="disabled"><a href="#!"><i class="material-icons">chevron_right</i></a></li>';
              }else {
                echo '<li class="waves-effect"><a href="./?domaine='.htmlspecialchars($_GET["domaine"]).'&page='.($pageActuelle+1).'"><i class="material-icons">chevron_right</i></a></li>';
              }
              echo '
                    <li class="waves-effect"><a href="./?domaine='.htmlspecialchars($_GET["domaine"]).'&page='.$nombreDePages.'"><i class="material-icons">fast_forward</i></a></li>
                </ul>';
            }
            label :
            if ($vide){
                echo '<div id="listQuest" class="col s12 row question">
                        <h4 id="msgVide" class="center-align" >Aucune question posez dans ce forum</h4>
                    </div>';
            }

            //recuperer le dernier id
            $sql = $bdd->prepare('SELECT id_question FROM question WHERE nom_domaine=? AND supprime=0 ORDER BY date_quest DESC LIMIT 1');
            $sql->execute(array(htmlspecialchars($_GET["domaine"])));
            if ($data = $sql->fetch()){
              $_SESSION["lastIdQuest"]=$data['id_question'];
            }
            else{
              $_SESSION["lastIdQuest"]=0;
            }
            $sql->closeCursor();
        }
        catch (Exception $e){
             die('Erreur : ' . $e->getMessage());
        }
    echo '</div>';

?>
