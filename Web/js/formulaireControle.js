function validateForm() {
    let identifiant = document.getElementById("identifiant").value;
    let nom = document.getElementById("nom").value;
    let prenom = document.getElementById("prenom").value;
    let mail = document.getElementById("mail").value;
    let mdp = document.getElementById("mdp").value;
    let mdpConfirm = document.getElementById("mdpConfirm").value;

    let regexEmail = /\S+@\S+\.\S+/;

    if (identifiant.length < 3) {
        alert("Votre identifiant doit comporter au moins 3 caractères.");
        return false;
    }

    if (nom.length < 1) {
        alert("Votre nom doit comporter au moins 1 caractère.");
        return false;
    }

    if (prenom.length < 1) {
        alert("Votre prénom doit comporter au moins 1 caractère.");
        return false;
    }

    if (!regexEmail.test(mail)) {
        alert("Le format de l'email n'est pas correct.");
        return false;
    }

    if (mdp == null || mdp == ""){
        alert("Votre mot de passe doit être renseigné.");
        return false;
    }

    if (mdp != mdpConfirm) {
        alert("Vos mot de passe ne sont pas identiques.");
        return false;
    }

    return true;
}