<?php
  //la page d'orientation
  session_start();
  if (isset($_SESSION["type"]) && (strcmp($_SESSION["type"],"a")==0)){
    header("location: ./Moderateur/Forum/");
  }
  else{
    include("./Accueil.php");
  }
?>
