<?php
    session_start();
?>
<?php
    //les réponses sont poster à partir de la page editeur.php qui se situe dans la page question
    if ((isset($_POST["reponse"])) && !empty($_POST["reponse"]) ){
        $reponse = test($_POST["reponse"]);
        $rep = (string)$reponse;
        try{
            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            $bdd = new PDO('mysql:host=localhost;dbname=project', 'root', '', $pdo_options);
            $bdd->exec('set names utf8');
            $reponse = $bdd->prepare('INSERT INTO reponse( id_question, email, rep, date_rep) VALUES (?, ?, ?, NOW())');
            $reponse->execute(array($_POST["id_quest"], $_SESSION["email"],$rep));
            header('location: ../part/editeur.php');
            $reponse->closeCursor();
        }
        catch (Exception $e){
            die('Erreur : ' . $e->getMessage());
        }
    }
    else{
        $_SESSION["reponse"]=1;
        header('location: ../part/editeur.php');
    }

    function test($data){
      $data = trim($data);
      $data = stripslashes($data);
      return $data;
    }
?>
