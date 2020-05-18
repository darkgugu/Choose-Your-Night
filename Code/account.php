<?php
    session_start();
    $_SESSION['pseudo'] = [];
    $_SESSION['id'] = [];
?>

<html>
    <head>
        <title>CYN Account</title>
        <style>
            body{
                color:black;
                background-color:white;
                background-image:url("../Images/background2.png");
                background-repeat: round;
            }
            .center{
                text-align: center;
                margin-top: 50vh;
                transform: translateY(-50%);
            }
            input{
                border: 1px solid grey;
                border-radius: 10px;
                padding: 12px 20px;
                margin: 8px 0;
            }
        </style>
    </head>

    <body class="center">

        <h1>Création de compte</h1>

        <form action="" method="get">

            <div style="display: block;" id="part1">

                <input type="text" name="pseudo" placeholder="   Identifiant"><br>
                <input type="password" name="mdp" placeholder="   Mot de passe"><br>
            </div>
            <div style="display: none;" id="part2">

                <input type="text" name="nom" placeholder="   Nom"><br>
                <input type="text" name="prénom" placeholder="   Prénom"><br>
                <input type="email" name="email" placeholder="   Adresse Mail"><br>
            </div>
            <div style="display: none;" id="part3">
                <input type="text" name="rue" placeholder=" Rue et Numéro de rue"><br>
                <input type="text" name="ville" placeholder=" Ville"><br>
                <input type="number" name="ville" placeholder=" Code Postal"><br>
            </div>
            <div style="display: none;" id="part4">
                Attention, vous pouvez trouver les questions qui vont suivre trop personelles, <br>
                elles sont la pour améliorer votre expérience de Choose Your Night, 
                vous pouvez choisir de les ignorer. <br>
                Vous pourrez aussi les remplir ultérieurement depuis l'onglet Mon Compte
            </div>
            <div style="display: none;" id="part5">
                Genre : <br>
                Homme :<input type="radio" name="gender" value="Homme"><br>
                Femme :<input type="radio" name="gender" value="Femme"><br>
                <input type="text" name="other_gender" placeholder=" Si autre, préciser"><br>
            </div>


            <input id="next" type="button" name="next" value="Suivant" onclick="suivant()">
            <input id="prev" type="button" name="next" value="Précédent" onclick="precedent()">
        </form>


        <script>
            var count = 1;

            function suivant() {
                document.getElementById("part" + count).style.display = "none";
                document.getElementById("part" + (count + 1)).style.display = "block";
                count++;
            }
            function precedent() {
                document.getElementById("part" + count).style.display = "none";
                document.getElementById("part" + (count - 1)).style.display = "block";
                count--;
            }
        </script>  
    </body>
</html>    