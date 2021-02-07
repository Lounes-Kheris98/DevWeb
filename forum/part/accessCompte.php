<!--si un user essaie d'entrée dans l'espace compte sans qu'il de connecte par le lien-->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" sizes="144x144" href="../img/logo_bibliotheque_fr.ico">
    <title>Erreur de lien</title>
    <link rel="stylesheet" href="../framework/materialize.min.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/breadcrumb.css">
</head>
<body>
  <div class="col l8 offset-l2 m10 offset-m1 s12">
      <h4 class="center-align" >Erreur dans le lien</h4>
      <h4 class="center-align" >Vous n'êtes pas encore connecté</h4>
      <h4 class="center-align" >Veuillez vous connecter d'abord puis vous pouvez accéder à votre compte</h4>
      <style>
              div{
                margin-top: 25vh;
              }
              a{
                cursor: pointer;
              }
              body{
                background-image: url(./../img/point.jpg);
              }
      </style>
      <h4 class="center-align" >Cliquer ici <a href="../Inscription.php">Inscription</a> pour vous inscrire si vous n'êtes pas encore inscrit</h4>
      <h4 class="center-align" >Cliquer ici <a onclick="javascript:history.back();">retour</a> pour vous rendre à la page précédente</h4>
  </div>
</body>
</html>
