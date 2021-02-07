<?php
    session_start();
    session_unset();
    $_SESSION["deconnect"]=0;
    // l'orientation l'hors de la deconnection
    if (isset($_GET["id_quest"])){
        header('location: ../Forum/Question/Reponse/?domaine='. $_GET['domaine'].'&id_quest='. $_GET["id_quest"].'&page=1');
    }
    else{
        if (isset($_GET["domaine"])){
            header('location: ../Forum/Question/?domaine='. $_GET["domaine"].'&page=1');
        }
        else{
                header('location: ../Forum/');
        }
    }


?>
