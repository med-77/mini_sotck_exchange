<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="index.css">
    <title>Sign-in</title>
</head>
<body>

    <div class="head">
        CAPITAL POUR DES START-UPS
    </div>
    <list>
        <ul>
            <li><a href="welcome.html">ACCUEIL</a></li>
            <li><a href="">ABOUT US</a></li> 
            <li><a href="">CONTACTE</a></li>  
        </ul>
    </list>

    <marquee height="70" behavior="scroll" direction="left"><h2>Bienvenue dans notre site</h2></marquee>
    <div class="container mt-4" style="background-color: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        <h1 class="text-center mb-4" style="color: #007bff;">Sign Up</h1>
        <form action="sign-in-startuper.php" method="post" enctype="multipart/form-data" class="w-75 mx-auto">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom:</label>
                <input type="text" class="form-control" id="nom" name="nom">
            </div>
            <div class="mb-3">
                <label for="Prenom" class="form-label">Prenom:</label>
                <input type="text" class="form-control" id="Prenom" name="Prenom">
            </div>
            <div class="mb-3">
                <label for="num_CIN" class="form-label">Numero CIN:</label>
                <input type="text" class="form-control" id="num_CIN" name="CIN">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">E-mail:</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="mb-3">
                <label for="nom_entreprise" class="form-label">Nom d'entreprise:</label>
                <input type="text" class="form-control" id="nom_entreprise" name="nom_entreprise">
            </div>
            <div class="mb-3">
                <label for="adresse_entreprise" class="form-label">Adresse d'entreprise</label>
                <input type="text" class="form-control" id="adresse_entreprise" name="adresse_entreprise">
            </div>
            <div class="mb-3">
                <label for="num_registre_comm" class="form-label">Numero du registre de commerce:</label>
                <input type="text" class="form-control" id="num_registre_comm" name="num_registre_comm">
            </div>
            <div class="mb-3">
                <label for="Photo_id" class="form-label">Photo d'identite:</label>
                <input type="file" class="form-control" id="Photo" name="Photo">
            </div>
            <div class="mb-3">
                <label for="pseudo" class="form-label">Pseudo:</label>
                <input type="text" class="form-control" id="pseudo" name="pseudo">
            </div>
            <div class="mb-3">
                <label for="mdp" class="form-label">Mot de passe:</label>
                <input type="password" class="form-control" id="mdp" name="mdp">
            </div>
            <button type="submit" class="btn btn-primary" style="background-color: #007bff; border-color: #007bff;">Sign Up</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"
        integrity="sha384-wMDR26X5l2crHcF4LmSK3ef9aqW7Wq6Bbh57bZv4vC2A6C26j3zu3tfjzWDPqvt"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js"
        integrity="sha384-pzjw8YWNpNiSoK0eKNSi1Vl75T7hjqXhc5TqFEN5e4MfsR5KpZwT+8p+NOpiKDfD"
        crossorigin="anonymous"></script>
        <script src="form.js"></script>
</body>
</html>
