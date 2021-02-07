<?php
  session_start();

    try{
         $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
         $bdd = new PDO('mysql:host=localhost;dbname=project', 'root', '', $pdo_options);
         $bdd->exec('set names utf8');
         if (!isset($_SESSION["pseudo"])){
           $reponse = $bdd->query('SELECT id_question ,id_rep,rep, supprime, DATE_FORMAT(date_rep, "%d/%m/%Y à %H:%i:%s") AS date_r, pseudo FROM user u,reponse r WHERE id_rep>'.$_SESSION["lastIdRep"].' AND r.email=u.email AND id_question='.$_GET["id_quest"].' AND supprime=0 ORDER BY date_rep ASC');
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
                          </div>
                      </div>";
                  $_SESSION["lastIdRep"]=$donnees["id_rep"];
                }
                $reponse->closeCursor();
         }
         else{
           $reponse = $bdd->query('SELECT id_question ,id_rep,rep, supprime, DATE_FORMAT(date_rep, "%d/%m/%Y à %H:%i:%s") AS date_r, pseudo FROM user u,reponse r WHERE id_rep>'.$_SESSION["lastIdRep"].' AND r.email=u.email AND id_question='.$_GET["id_quest"].' AND supprime=0 ORDER BY date_rep ASC');
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
                          </div>

                              <form action='../../../fonction/signalerRep.php' method='post' class='col s1 right-align'>
                                  <input type='submit' title='Signaler' value='&#9888;' style='font-size:20px; border:none; background-color:transparent'>
                                  <input type='hidden' name='id_rep' value='". $donnees["id_rep"] ."'>
                                  <input type='hidden' name='domaine' value='". htmlspecialchars($_GET["domaine"]) ."'>
                                  <input type='hidden' name='id_quest' value='". htmlspecialchars($_GET["id_quest"]) ."'>
                                  <input type='hidden' name='page' value='".htmlspecialchars($_GET["page"])."'>
                              </form>

                      </div>";
                      $_SESSION["lastIdRep"]=$donnees["id_rep"];
                  }
           $reponse->closeCursor();
         }
    }
    catch (Exception $e){
         die('Erreur : ' . $e->getMessage());
    }

 ?>
