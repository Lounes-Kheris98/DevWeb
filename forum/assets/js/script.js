//barre de navigation latérale
$( document ).ready(function(){
    $('.button-collapse').sideNav({
        menuWidth: 220,
        edge: 'left',
        closeOnClick: false,
        draggable: true
    });
});

//boutton d"options pour la barre de manu horizontale pour les petits écrans
$(document).ready(function(){
    $("#paramaitre").click(function(){
        $("#listParamaitre").slideToggle("fast","linear");
    });
});
// listes des options
window.onclick = function(event) {
  if(!event.target.matches('#paramaitre')){
    var list = document.getElementById("listParamaitre");
    if(list.style.display=="block"){
      list.style.display="none";
    }
  }
}

//faire apparaitre et disparaitre le boutton scroll en haut en bas de page
$(window).scroll(function(){
    var scroll=$(window).scrollTop();
    var height=$(window).height();
    if ( scroll > height ){
        $("#scrollTop").removeClass("hide");
    }
    else $("#scrollTop").addClass("hide");
});

$(document).ready(function(){
    $("#scrollTop").addClass("hide");
});

$(document).ready(function(){
    $('#scrollTop').click(function() {
        $('html, body').animate({scrollTop: 0}, 800);
        return false;
    });
});

//positionner le footer en bas du page
  $(document).ready(function(){
    var position = $("#footer").position();
    var screen = $(window).height();
    if ( ( position.top + 150 ) < screen ){
      var pos = screen-150;
      $("#footer").offset({top:pos});
    }
  });

//// le lien de l'aide selon la taille de l'écran de l'utilisateur
//$(document).ready(function(){
//    var taille = $(window).width();
//    if( taille > 992 ){
//        $(".aide").attr("href","./aideForumPC.php");
//    }
//    else{
//        $(".aide").attr("href","./aideForumMobile.php");
//    }
//});
