<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="Assets/style.css">
    <link rel="stylesheet" href="Assets/purecookie.css"/>
    <title>Clavardage</title>
</head>
<body>

    <div id="container">
        <div id="left">
            <div id="logo"></div>
            <div id="text">
                <p>Utilisez " /msg + pseudo + votreMessage " pour envoyer un message privé[WIP]</p>
                <p>Appuyer sur " Enter " pour envoyer votre message</p>
                <p>Ce site permet de discuter instantanément avec n'importe qui. Soyez respectueux</p>
            </div>
        </div>
        <div id="messageAndInput">
            <div id="containerMessage"></div>
            <div id="post">
                <form>
                    <textarea name="message" id="message" cols="50" rows="5" placeholder="Ecrivez votre message ici"></textarea>
                </form>
            </div>
        </div>
        <div id="right">
            <input type="text" id="changeUsername" placeholder="Changer de pseudo">
            <button id="valid">Valider</button>

            <div id="divCreate">
                <input type="text" id="createUser" placeholder="Créer un pseudo">
                <button id="create">Valider</button>
            </div>
        </div>
    </div>

    <script src="Assets/purecookie.js"></script>
    <script src="Assets/app.js"></script>
</body>
</html>