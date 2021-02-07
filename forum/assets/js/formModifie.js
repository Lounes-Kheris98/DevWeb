// les controles de la page compte.php

var formValid = document.getElementById('form'),
    prenom = document.getElementById('fname'),
    nom = document.getElementById('lname'),
    missPrenom = document.getElementById('missPrenom'),
    missNom = document.getElementById('missNom'),
    prenomValid = /^[a-zA-ZéèîïÉÈÎÏ][a-zéèêàçîï]+([\-\s][a-zA-ZéèîïÉÈÎÏ][a-zéèêàçîï]+)?$/,
    age = document.getElementById('age'),
    missAge = document.getElementById('missAge'),
    pseudo = document.getElementById('pseudo'),
    pseudoValid = /^[\w]{10,30}$/,
    missPseudo = document.getElementById('missPseudo'),
    mdp = document.getElementById('mdp'),
    mdp1 = document.getElementById('mdp1'),
    mdp2 = document.getElementById('mdp2'),
    missMdp = document.getElementById('missMdp'),
    missMdp = document.getElementById('missMdp'),
    missMdp1 = document.getElementById('missMdp1'),
    missMdp2 = document.getElementById('missMdp2'),
    mdpValid = /[\w\!\#\$\?\.]{8,25}/;

//ajouter des événnements à éxécuter en blur
prenom.addEventListener('blur' , validPrenom );
nom.addEventListener('blur' , validNom );
age.addEventListener('blur' , validAge );
pseudo.addEventListener('blur' , validPseudo );
mdp.addEventListener('blur' , validMdp );
mdp1.addEventListener('blur' , validMdp1 );
mdp2.addEventListener('blur' , validMdp2 );
formValid.addEventListener('submit', validForm );


//les evenement on blur
function validPrenom() {
    if (prenomValid.test(prenom.value) == false) {
            missPrenom.textContent = 'Format incorrect';
            missPrenom.style.color = 'orange';
            return false;
        }
        else
            missPrenom.textContent = '';
}

function validNom() {
    //Si le champ est vide
    if (prenomValid.test(nom.value) == false) {
            missNom.textContent = 'Format incorrect';
            missNom.style.color = 'orange';
            return false;
        }
        else missNom.textContent = '';
}

function validAge() {
    if (age.value < 14) {
            missAge.textContent = 'vous êtes trop petit';
            missAge.style.color = 'red';
            return false;
        }
        else if (age.value > 99) {
                missAge.textContent = 'vous êtes trop grand';
                missAge.style.color = 'red';
                return false;
            }
            else missAge.textContent = '';
}

function validPseudo() {
    missPseudo.textContent = '';
    if (pseudo.value.length<5) {
            missPseudo.textContent = 'Trop court minimum 5 caractères';
            missPseudo.style.color = 'red';
            return false;
        }
        else if (pseudoValid.test(pseudo.value) == false) {
                missPseudo.textContent = 'Format " abc125 "';
                missPseudo.style.color = 'orange';
                return false;
            }
            else missPseudo.textContent = '';
}

function validMdp() {
    missMdp.textContent = '';
    if (mdp.value.length<8) {
            missMdp.textContent = 'Trop court minimum 8 caractères';
            missMdp.style.color = 'red';
            return false;
        }
    else if (mdpValid.test(mdp.value) == false) {
                missMdp.textContent = 'Format incorrect';
                missMdp.style.color = 'orange';
                return false;
            }
        else missMdp.textContent = '';
}


function validMdp1() {
    missMdp1.textContent = '';
    if (mdp1.value.length<8) {
            missMdp1.textContent = 'Trop court minimum 8 caractères';
            missMdp1.style.color = 'red';
            return false;
        }
       else if (mdpValid.test(mdp1.value) == false) {
                missMdp1.textContent = 'Format incorrect';
                missMdp1.style.color = 'orange';
                return false;
            }
        else missMdp1.textContent = '';
}

function validMdp2() {
    missMdp2.textContent = '';
    if (mdp1.value != mdp2.value) {
                    missMdp2.textContent = 'confirmation differente';
                    missMdp2.style.color = 'red';
                    return false;
                }
                else missMdp2.textContent = '';
}

function vide(element){
    if ( element.value == "" ) return true;
    else return false;
}

function validForm(event){
    if (vide(nom) && vide(prenom) && vide(age) && vide(pseudo) && (vide(mdp) && vide(mdp1) && vide(mdp2))){
        event.preventDefault();
        Materialize.toast("Aucune donnée saisie", 4000);
    }
}
