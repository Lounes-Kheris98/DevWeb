<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title >Reglement</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" sizes="144x144" href="../../img/stro.ico">
    <link rel="stylesheet" type="text/css" href="../../framework/materialize.min.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/main.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/breadcrumb.css">
</head>
<body>

    <?php include("../../part/barNav.html"); ?>

            <!--chemin-->
            <nav id="breadcrumb" class="#eeeeee grey lighten-3" style="height: 44px;line-height: 24px;">
                <div class="nav-wrapper">
                  <div class="col s12 chemin">
                    <a href="../" class="breadcrumb black-text" >Forum</a>
                    <a href="" class="breadcrumb black-text" >Règlement</a>
                  </div>
                </div>
            </nav>
            <style>
                @media screen and (max-width:993px){
                    .breadcrumb:first-child{
                        margin-left: 45px;
                    }
                }
            </style>
            <div id="imageButton" class="col s12 hide-on-large-only">
                <!--bouton menu large-->
                <a href="#" data-activates="slide-out" id="bouttonMenu" class="button-collapse">☰</a>
            </div>


            <div class="col s12 row card-panel" style="margin-top:50px">

                <!--Titre-->
                <div class="col s12 row">
                    <h3 class="titre" >Règlement</h3>
                </div>

                <!--Le règlement-->
                <div class="col l10 offset-l1 s12 row card-panel">
                    <ul id="list">
                        <li class="gras" >Bienvenue sur ce forum ayant pour but d'échange d'expériences, d'opinions et de permettre au public de trouver toutes l’aide dont ils ont besoin auprès des inscrits sur ce forum dans le domaine de la médecine.</li>
                        <li class="gras" >Si vous ne respectez pas les règles décrites ci-dessous, vous encourez le risque d'être banni du forum voire d'obtenir la suppression définitive de votre compte.</li>
                        <div class="regle">
                            <h5 style="list-style-type: disc; color:#039be5;" >ATTENTION : L'administrateur n'est pas résponsable des réponses des utilisateurs de ce forum en cas de soupçon de mauvaise information veuillez signaler le message.</h5>
                            <li style="list-style-type: disc;" >L'équipe du forum se réserve le droit de déplacer, éditer ou supprimer tout message non conforme à la charte du forum.</li>
                            <li style="list-style-type: disc;" >Ce forum est modéré a posteriori, les messages que vous postez sont directement publiés sans aucun contrôle préalable. Il est de votre responsabilité de veiller à ce que vos contributions ne portent pas préjudice à autrui et soient conforment à la réglementation en vigueur. Les organisateurs du forum et les modérateurs se réservent le droit de retirer toute contribution qu’ils estimeraient déplacée, inappropriée, contraire aux lois et règlements, à cette charte d’utilisation ou susceptible de porter préjudice directement ou non à des tiers.</li>
                            <li style="list-style-type: disc;" >Tout contenu illicite, diffamatoire, illégal, ou inadapté sera immédiatement supprimé sans préavis. Nous rappelons également que les agressions verbales, moqueries gratuites et vulgarités ne sont pas acceptées sur ce forum.</li>
                            <li style="list-style-type: disc;" >Toutes insultes seront immédiatement sanctionnées et le responsable réprimandé. Nous, les modérateurs et administrateurs de ce forum, tenons à avoir et maintenir une ambiance saine et des comportements adultes et respectables.</li>
                            <li style="list-style-type: disc;" >Le flood est interdit, les messages composés juste d'un seul mot comme "Ok", "Cool", "lol" sont interdit. Vous savez faire des phrases avec verbes, sujets, compléments alors montrez le! Pareil, si vous remerciez une personne, ne mettez pas juste "Merci".</li>
                            <li style="list-style-type: disc;" >Il est interdit de poster des liens publicitaires ou vulgaires. Les seuls liens autorisés dans vos messages sont ceux qui permettent de comprendre votre problème ou suggestion. De même pour les liens vers des jeux faisant gagner de l'argent ou des sites faisant gagner de l'argent sont formellement interdit .</li>
                            <li style="list-style-type: disc;" >Attention à votre écriture. Vous devez écrire un français compréhensible, on ne vous demande pas des phrases irréprochables, mais faites un effort! Le langage sms est donc à proscrire.</li>
                            <li style="list-style-type: disc;" >N'écrivez pas TOUT EN MAJUSCULES, votre message paraîtra agressif, et on aura moins envie de répondre à votre message avec gentillesse. Il est tout de même à préciser que notre équipe de modérateur ne peut pas tout voir. Si donc un message vous semble choquant ou autre, vous avez la possibilité de le signaler en cliquant sur le bouton signaler à cotés de celui-ci, les modérateur s’en chargeront.</li>
                            <li style="list-style-type: disc;" >Pensez à aérer vos messages en y insérant des retours à la ligne permettant une bonne lecture.</li>
                            <li style="list-style-type: disc;" >Avant de poser une question effectuez une recherche pour vérifier si le sujet n’a pas été déjà traité.</li>
                            <li style="list-style-type: disc;" >Lorsque vous posez une nouvelle question, pensez à choisir le domaine correspondant.</li>
                            <li style="list-style-type: disc;" >Si le domaine que vous cherchez n’existe pas dans la liste des domaines prédéfinis par les modérateurs, vous avez la possibilité de poser votre question dans le domaine « AUTRE ».</li>
                            <li style="list-style-type: disc;" >Les organisateurs du forum se réservent le droit d’exclure du forum, de façon temporaire ou définitive, toute personne dont les contributions sont en contradiction avec les règles mentionnées ci-dessus.</li>
                        </div>
                    </ul>
                </div>
                <style>
                    .titre{
                        font-size: xx-large;
                        margin-top: 35px;
                    }
                    #list{
                        list-style-type:disc;
                        padding: 14px 35px;
                    }
                    @media screen and (max-width:601px){
                        #list{
                            padding: 14px 0px;
                        }
                        .regle{
                            margin-left: 20px;
                        }
                    }
                    .gras{
                        font-weight: 700;
                        margin-bottom: 15px;
                    }
                    .gras:first-letter{
                        margin-left: 10px;
                    }

                    @media screen and (min-width:601px){
                        .regle{
                            margin-left: 40px;
                        }
                    }
                    .regle li{
                        margin-bottom: 10px;
                    }

                </style>

            </div>


            <!--image de scroll en haut-->
            <img src="../../img/scroll-to-top.png" alt="" id="scrollTop">
            <?php include("../../part/footer.html") ?>
            <?php include("../../fonction/toast.php") ?>

</body>
</html>
