<?php
  if ( isset($_GET["screen"]) && (strcmp($_GET["screen"],"large")==0) ){
    include("../../part/aideLargeScreen.php");
  }
  else{
    include("../../part/aideSmallScreen.php");
  }
?>
