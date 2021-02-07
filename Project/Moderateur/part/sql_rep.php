<?php
    session_start();
?>
<?php
try{
  $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
  $bdd = new PDO('mysql:host=localhost;dbname=project', 'root', '', $pdo_options);

    //bloquer l'utilisateur
    if(isset($_GET["val"]) && isset($_GET["ps"])){
        $reponse = $bdd->prepare(' UPDATE user SET bloquer=:n WHERE email=:e'); /*requete préparer */
        $reponse->execute(array(
          "n"=>(int)$_GET["val"],
          "e"=>$_GET["ps"]
        ));

        $reponse->closeCursor();
    }

    //supprimer la réponse de la table reponse et la supprimer de la table des réponse signaler si elle existe
    if(isset($_GET["sup"]) && isset($_GET["id"])){
        $sup =$bdd->prepare(' UPDATE reponse SET supprime=:s WHERE id_rep=:r');
        $sup->execute(array(
          "s"=>(int)$_GET["sup"],
          "r"=>$_GET["id"]
        ));
        $sup->closeCursor();


            $supp =$bdd->prepare(' DELETE FROM signaler_rep   WHERE id_rep=?');
            $supp->execute(array($_GET["id"]));
            $supp->closeCursor();

    }

    //supprimer la réponse de la table des réponse signalées
    if(!isset($_GET["sup"]) && isset($_GET["id"])){
        $supp =$bdd->prepare(' DELETE FROM signaler_rep   WHERE id_rep=?');
        $supp->execute(array($_GET["id"]));
        $supp->closeCursor();
    }
}
catch (Exception $e){
    die('Erreur : ' . $e->getMessage());
}
    if(isset($_SESSION["dest"])){
        if ($_SESSION["dest"]==0){
            unset($_SESSION["dest"]);
            header('location: ../ReponseSignaler/');
        }
        if($_SESSION["dest"]==1){
            unset($_SESSION["dest"]);
            header('location: ../ListeUtilisateur/');
        }
        if($_SESSION["dest"]==2){
            unset($_SESSION["dest"]);
            header('location: ../UtilisateurBloquer/');
        }
    }
 ?>
