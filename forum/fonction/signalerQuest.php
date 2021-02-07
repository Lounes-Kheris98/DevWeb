<?php
    session_start();
?>
<?php
    try{
        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
        $bdd = new PDO('mysql:host=localhost;dbname=project', 'root', '', $pdo_options);
        $bdd->exec('set names utf8');
        $req = $bdd->prepare('SELECT email, id_question FROM signaler_quest WHERE id_question=? AND email=?');
        $req->execute(array($_POST["id_quest"],$_SESSION["email"]));
        if ($donnees = $req->fetch()){
            //si l'user à déjà signaler cette question
            $_SESSION["signalerQuest"]=1;
            if(strcmp($_SESSION["type"],"a")==0){
                header('location: ../Moderateur/Forum/Question/Reponse/?domaine='. $_POST["domaine"] .'&id_quest='.$_POST["id_quest"].'&page='.$_POST["page"]);
            }
            else{ header('location: ../Forum/Question/Reponse/?domaine='. $_POST["domaine"] .'&id_quest='.$_POST["id_quest"].'&page='.$_POST["page"]); }
            $req->closeCursor();
        }
        else{
            try{
                $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                $bdd = new PDO('mysql:host=localhost;dbname=project', 'root', '', $pdo_options);
                $bdd->exec('set names utf8');
                $reponse = $bdd->prepare('INSERT INTO signaler_quest(email, id_question, date_signal) VALUES ( ?, ?,NOW())');
                $reponse->execute(array($_SESSION["email"], $_POST["id_quest"]));
                $_SESSION["signalerQuest"]=2;
                if(strcmp($_SESSION["type"],"a")==0){
                    header('location: ../Moderateur/Forum/Question/Reponse/?domaine='. $_POST["domaine"] .'&id_quest='.$_POST["id_quest"].'&page='.$_POST["page"]);
                }
                else{ header('location: ../Forum/Question/Reponse/?domaine='. $_POST["domaine"] .'&id_quest='.$_POST["id_quest"].'&page='.$_POST["page"]); }
                $reponse->closeCursor();
            }
            catch (Exception $e){
                die('Erreur : ' . $e->getMessage());
            }
        }

    }
    catch (Exception $e){
        die('Erreur : ' . $e->getMessage());
    }


?>
