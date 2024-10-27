document.addEventListener("DOMContentLoaded", function () {
    let signUpForm = document.querySelector("form");

    signUpForm.addEventListener("submit", function (event) {
        if (!validateNomPrenom() || !validateNumCIN() || !validateEmail() || !validateNumRegistreComm() || !validatePassword()) {
            event.preventDefault();
        }
    });

    function validateNomPrenom() {
        let nomInput = document.getElementById("nom");
        let prenomInput = document.getElementById("Prenom");
        let regExNom = /^[a-zA-Z\s]+$/;

        if (!regExNom.test(nomInput.value) || !regExNom.test(prenomInput.value)) {
            alert("Resaisir le nom et le prenom.");
            return false;
        }

        return true;
    }

    function validateNumCIN() {
        let numCINInput = document.getElementById("num_CIN");
        let regExNumCIN = /^\d{8}$/;

        if (!regExNumCIN.test(numCINInput.value)) {
            alert("Num CIN doit etre compose de 8 chiffres.");
            return false;
        }
        return true;
    }

    function validateEmail() {
        let emailInput = document.getElementById("email");
        let regExEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

        if (!regExEmail.test(emailInput.value)) {
            alert("address e-mail invalide.");
            return false;
        }

        return true;
    }

    function validateNumRegistreComm() {
        let numRegistreCommInput = document.getElementById("num_registre_comm");
        let regExNumRegistreComm = /^[A-Z]\d*$/;

        if (!regExNumRegistreComm.test(numRegistreCommInput.value)) {
            alert("numéro du registre de commerce doit etre formé par une lettre majuscule suivie de 10 chiffres");
            return false;
        }

        return true;
    }

    function validatePassword() {
        let passwordInput = document.getElementById("mdp");
        let regExPassword = /^(?=.*[A-Za-z0-9])(?=.*[$#])[A-Za-z0-9$#]{8,}$/;

        if (!regExPassword.test(passwordInput.value)) {
            alert(" mot de passe doit etre composé d'au moins 8 lettres ou chiffres et finissant par un symbole $ ou #");
            return false;
        }

        return true;
    }
});
