<?php
    session_start();
    // si un utilisateur essaie d'entrée dans l'espace de moderateur par un lien
    if(isset($_SESSION["type"]) && (strcmp($_SESSION["type"],"u")==0)){
      header('location: ../Forum/');
    }
    else{ if(!isset($_SESSION["type"])){
          header('location: ../Forum/');
        }
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Réponses supprimées</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" sizes="144x144" href="../../img/logo_bibliotheque_fr.ico">
    <link rel="stylesheet" type="text/css" href="../../framework/materialize.min.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/main.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/Forum.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/breadcrumb.css">
</head>
<body>
<?php
    include("../part/menu_mod.php");
    include("../part/connect.php");
    echo '<!--image et boutton-->
            <div id="imageButton" class="col l12 s12 hide-on-large-only">
                <!--bouton menu large-->
                <a href="#" data-activates="slide-out" id="bouttonMenu" class="button-collapse">☰</a>
            </div>

            <div class="col s12 row ">
                <!--grand titre-->
                <div class="row col s12 bigTitle">
                    <h1>Réponses supprimées</h1>
                </div>';
    include("../part/rep_sup.php");
    echo '</div>';
    include("../part/footer.html");
    include("../../fonction/toast.php");
?>
