                <!--la barre de menu horizontale pour user déconnecter-->
                <nav class="#eeeeee grey lighten-3" style="height: 50px; line-height: 46px;">
                    <div class="nav-wrapper">
                        <div class="col s12 right-align">
                            <div id="connect">
                                <a href="#modal1"  class="hide-on-small-only btn #f4511e deep-orange darken-1 waves-effect waves-purple">Se connecter</a>
                                <a href="Inscription.php"  class="hide-on-small-only btn #f4511e deep-orange darken-1 waves-effect waves-purple">S'inscrire</a>
                                <a href="" class="hide-on-small-only btn aide #f4511e deep-orange darken-1 waves-effect waves-purple">?</a>
                                <button id="paramaitre" class="hide-on-med-and-up btn #f4511e deep-orange darken-1 waves-effect waves-purple">&#128315;</button>
                                  <div id="listParamaitre" class="card-panel">
                                    <p id="fleche">&#128314;</p>
                                    <a href="#modal1">Se connecter</a>
                                    <a href="Inscription.php">S'inscrire</a>
                                    <a href=""  class="aide">Aide</a>
                                  </div>
                            </div>
                        </div>
                    </div>
                </nav>
                <!--la boite de dialogue de connection-->
                <div id="modal1" class="modal modal-fixed-footer">
                    <form method="post" action="part/connection.php">
                        <div class="modal-content">
                            <div class="col s12 center-align">
                                <img src="img/avatar_defaut.png" id="imagelogin" alt="avatar">
                            </div>
                            <div class="col s12">
                                <div class="col s12 input-field">
                                    <label >Pseudo</label>
                                    <input type="text" name="pseudo">
                                </div>
                                <div class="col s12 input-field">
                                    <label >Mot de passe</label>
                                    <input type="password" name="password">
                                </div>
                                <style>
                                    .input-field input[type=text]:focus {
                                         border-bottom: 1px solid #039be5;
                                         box-shadow: 0 1px 0 0 #039be5;
                                    }

                                    .input-field input[type=password]:focus{
                                        border-bottom: 1px solid #039be5;
                                        box-shadow: 0 1px 0 0 #039be5;
                                    }
                                </style>
                                <?php
                                    if (isset($_GET["domaine"])){
                                        echo '<input type="hidden" name="domaine" value="'. htmlspecialchars($_GET["domaine"]) .'">';
                                    }
                                    if (isset($_GET["id_quest"])){
                                        echo '<input type="hidden" name="id_quest" value="'. htmlspecialchars($_GET["id_quest"]) .'">';
                                    }
                                ?>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <a href="./Inscription.php"  class="left-align" style="margin-left:15px;position:relative;top: 29%;">S'inscrire</a>
                            <button type="submit"  class="login white-text modal-action modal-close waves-effect waves-green btn-flat #f4511e deep-orange darken-1">Connecter</button>
                            <a href=""  class="cancel #f4511e deep-orange darken-1 white-text modal-action modal-close waves-effect waves-green btn-flat" style="margin-right:6px;">Annuler</a>
                        </div>
                    </form>
                </div>
