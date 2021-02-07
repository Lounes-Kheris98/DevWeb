// les controles de formulaire d'inscription

var formValid = document.getElementById('btn'),
    prenom = document.getElementById('fname'),
    nom = document.getElementById('lname'),
    missPrenom = document.getElementById('missPrenom'),
    missNom = document.getElementById('missNom'),
    prenomValid = /^[a-zA-ZéèîïÉÈÎÏ][a-zA-Zéèêàçîï]+([\-\s][a-zA-ZéèîïÉÈÎÏ][a-zA-Zéèêàçîï]+)?$/,
    age = document.getElementById('age'),
    missAge = document.getElementById('missAge'),
    email = document.getElementById('mail'),
    emailValid = /^[\w\.-]+@[a-z0-9\._\-]{2,}\.[a-z]{2,4}$/,
    missMail = document.getElementById('missMail'),
    pseudo = document.getElementById('pseudo'),
    pseudoValid = /^[\w]{5,30}$/,
    missPseudo = document.getElementById('missPseudo'),
    mdp1 = document.getElementById('mdp1'),
    mdp2 = document.getElementById('mdp2'),
    missMdp1 = document.getElementById('missMdp1'),
    missMdp2 = document.getElementById('missMdp2'),
    mdpValid = /[\w\!\#\$\?\.]{8,25}/;

//ajouter des événnements à éxécuter on blur
prenom.addEventListener('blur' , validPrenom );
nom.addEventListener('blur' , validNom );
age.addEventListener('blur' , validAge );
email.addEventListener('blur' , validEmail );
pseudo.addEventListener('blur' , validPseudo );
mdp1.addEventListener('blur' , validMdp1 );
mdp2.addEventListener('blur' , validMdp2 );


//for event on blur
function validPrenom(event) {
    //Si le champ est vide
    if (prenom.value == "") {
        missPrenom.textContent = 'Prénom manquant';
        missPrenom.style.color = 'red';
        return false;
        //Si le format de données est incorrect
    }
    else if (prenomValid.test(prenom.value) == false) {
            missPrenom.textContent = 'Format incorrect';
            missPrenom.style.color = 'orange';
            return false;
        }
        else // si tout est ok on enleve le message d'erreur
            missPrenom.textContent = '';
}

function validNom(event) {
    //Si le champ est vide
    if (nom.value == "") {
        missNom.textContent = 'Nom manquant';
        missNom.style.color = 'red';
        return false;
    }
    //Si le format de données est incorrect
    else if (prenomValid.test(nom.value) == false) {
            missNom.textContent = 'Format incorrect';
            missNom.style.color = 'orange';
            return false;
        }
        else missNom.textContent = '';
}

function validAge(event) {
    //Si le champ est vide
    if (age.value == "") {
        missAge.textContent = 'Age manquant';
        missAge.style.color = 'red';
        return false;
    }
    //si la valeur est inf 14
    else if (age.value < 14) {
            missAge.textContent = 'vous êtes trop petit';
            missAge.style.color = 'red';
            return false;
        }
        //si la valeur est sup 99
        else if (age.value > 99) {
                missAge.textContent = 'vous êtes trop grand';
                missAge.style.color = 'red';
                return false;
            }
            else missAge.textContent = '';
}

function validEmail(event) {
    //Si le champ est vide
    if (email.value == "") {
        missMail.textContent = 'Email manquant';
        missMail.style.color = 'red';
        return false;
    }
    //Si le format de données est incorrect
    else if (emailValid.test(email.value) == false) {
            missMail.textContent = 'Format incorrect';
            missMail.style.color = 'orange';
            return false;
        }
        else missMail.textContent = '';
}

function validPseudo(event) {
    missPseudo.textContent = '';
    //Si le champ est vide
    if (pseudo.value == "") {
        missPseudo.textContent = 'Pseudo manquant';
        missPseudo.style.color = 'red';
        return false;
    }
    //si la longeur du pseudo inf 5
    else if (pseudo.value.length<5) {
            missPseudo.textContent = 'Trop court minimum 5 caractères';
            missPseudo.style.color = 'red';
            return false;
        }
        //Si le format de données est incorrect
        else if (pseudoValid.test(pseudo.value) == false) {
                missPseudo.textContent = 'Format " abc125 "';
                missPseudo.style.color = 'orange';
                return false;
            }
            else missPseudo.textContent = '';
}

function validMdp1(event) {
    missMdp1.textContent = '';
    if (mdp1.value == "") {
        missMdp1.textContent = 'Mot de Passe manquant';
        missMdp1.style.color = 'red';
        return false;
    }
    //si la longeur du mot de passe < 8
    else if (mdp1.value.length<8) {
            missMdp1.textContent = 'Trop court minimum 8 caractères';
            missMdp1.style.color = 'red';
            return false;
        }
        else missMdp1.textContent = '';
}

function validMdp2(event) {
    missMdp2.textContent = '';
    if (mdp1.value != mdp2.value) {
                    missMdp2.textContent = 'confirmation differente';
                    missMdp2.style.color = 'red';
                    return false;
                }
                else missMdp2.textContent = '';
}

//la boite de dialogue de reglement
$('.modal').modal({
    dismissible: false,
    opacity: .5,
    inDuration: 300,
    outDuration: 200,
    startingTop: '4%',
    endingTop: '10%',
});

$("#form").on('submit',function(event){
  event.preventDefault;
  $('#modal1').modal({
      dismissible: false,
      opacity: .5,
      inDuration: 300,
      outDuration: 200,
      startingTop: '4%',
      endingTop: '10%',
  });
});
