<?php
    session_start();
?>
<?php
    //les questions sont envoyée par la page editeur.php qui se situe dans iframe de page question
    if ((isset($_POST["titre_quest"])) && (isset($_POST["question"])) && !empty($_POST["question"]) && !empty($_POST["titre_quest"]) ){
        $titre = test($_POST["titre_quest"]);
        $question = test($_POST["question"]);
        try{
            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            $bdd = new PDO('mysql:host=localhost;dbname=project', 'root', '', $pdo_options);
            $bdd->exec('set names utf8');
            $reponse = $bdd->prepare('INSERT INTO `question`( `nom_domaine`, `email`, `titre_quest`, `question`, `date_quest`) VALUES (:nom_domaine, :email, :titre_quest, :question, NOW())');
            $reponse->execute(array('nom_domaine' => $_POST["domaine"],
                                    'email' => $_SESSION["email"],
                                    'titre_quest' => $titre,
                                    'question' => $question
                                    ));
            header('location: ../part/editeur.php');
        }
        catch (Exception $e){
            die('Erreur : ' . $e->getMessage());
        }
    }
    else{
        $_SESSION["question"]=1;
        header('location: ../part/editeur.php');
      }

    function test($data){
      $data = trim($data);
      $data = stripslashes($data);
      return $data;
    }
?>
