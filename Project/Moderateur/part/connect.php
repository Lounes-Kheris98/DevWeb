<?php
  // la barre de  menu horizontale pour un utilisateur connecté
  echo '<!--barre de menu-->
        <nav id="" class="#eeeeee grey lighten-3" style="height: 50px;line-height: 46px;">
            <div class="nav-wrapper">
                <div class="col s12 right-align">
                    <div id="connect">';
                    echo '<a  class="hide-on-small-only btn waves-effect waves-light" href="#modal2" style="margin-right:4px">deconnecter</a>
                          <a href="../Compte/"  class="hide-on-small-only btn waves-effect waves-light">compte</a>
                          <a href="../Aide/" class="hide-on-small-only aide btn waves-effect waves-light waves-effect waves-light">?</a>
                          <button id="paramaitre" class="hide-on-med-and-up btn waves-effect waves-light">&#128315;</button>
                            <div id="listParamaitre" class="card-panel">
                              <p id="fleche">&#128314;</p>
                              <a href="../Compte/" >Compte</a>
                              <a href="#modal2" >Deconnecter</a>
                              <a href="../Aide/" class="aide" >Aide</a>
                            </div>
                    </div>
                </div>
            </div>
        </nav>';
        //la boite de dialogue de deconnection
        echo '<div id="modal2" class="modal">
                <div class="modal-content" style="border-bottom:1px solid gray;">
                    <h4 class="black-text left-align">Voulez-vous vraiment vous déconnecter?</h4>
                </div>
                <div class="modal-footer">';
                  echo '<a href="../../fonction/deconnection.php" class="white-text modal-action modal-close waves-effect waves-light btn">deconnecter</a>';
                  echo '<a href="" class="white-text modal-action modal-close waves-effect waves-light btn" style="margin-right:6px">Annuler</a>
                </div>
            </div>';
?>
