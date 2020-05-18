<?php
    session_start();
    $_SESSION['pseudo'] = [];
    $_SESSION['id'] = [];
?>

<html>
    <head>
        <title>CYN Account</title>
        <link rel="stylesheet" type="text/css" href="stylesheet.css">
    </head>

    <body class="background">

        <div class="center">

            <h1>Création de compte</h1>

            <form action="acceuil.php" method="get">

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
                    Homme <input type="radio" name="gender" value="Homme"><br>
                    Femme <input type="radio" name="gender" value="Femme"><br>
                    <input type="text" name="other_gender" placeholder=" Autre"><br>
                </div>
                <div style="display: none;" id="part6">
                    Vous êtes attirés par : <br>
                    Homme <input type="checkbox" name="attir" value="Homme"><br>
                    Femme <input type="checkbox" name="attir" value="Femme"><br>
                    <input type="text" name="other_attir" placeholder=" Autre"><br>
                </div>
                <div style="display: none;" id="part7">
                    Vous preferez : <br>
                    Les soirées chill <input type="radio" name="party_type" value="chill"><br>
                    Les grosses soirées <input type="radio" name="party_type" value="big"><br>
                    Les deux <input type="radio" name="party_type" value="both"><br><br>
                </div>
                <div style="display: none;" id="part8">
                    Vous êtes plus : <br>
                    Bar <input type="radio" name="place_type" value="bar"><br>
                    Boite <input type="radio" name="place_type" value="club"><br>
                    Peu importe <input type="radio" name="place_type" value="both"><br>
                </div>
                <div style="display: none;" id="part9">
                    A partir de quelle distance une soirée est trop loin pour vous (en km) <br>
                    <input type="number" name="distance"><br>
                </div>
                <div style="display: none;" id="part10">
                    A partir de quelle prix une soirée est trop chère pour vous (en €) <br>
                    <input type="number" name="price"><br>
                </div>
                <div style="display: none;" id="part11">
                    Merci d'avoir pris le temps de répondre à ces questions, <br>
                    vous pouvez vétifier ou changer vos réponses en cliquant sur "Précédent" <br>
                    ou valider en cliquant sur "Valider"<br>
                </div>
                
                <input id="validate" type="submit" name="Valider" value="Valider" hidden>
                <input id="next" type="button" name="next" value="Suivant" onclick="suivant()">
                <input id="prev" type="button" name="next" value="Précédent" onclick="precedent()" hidden>
            </form>
        </div>


        <script>
            var count = 1;

            function suivant() {

                if(count == 1){

                    document.getElementById("prev").removeAttribute("hidden");
                }
                if(count == 10){

                    document.getElementById("next").setAttribute("hidden", "true");
                    document.getElementById("validate").removeAttribute("hidden");
                }
                document.getElementById("part" + count).style.display = "none";
                document.getElementById("part" + (count + 1)).style.display = "block";
                count++;
            }
            function precedent() {

                if(count == 2){

                    document.getElementById("prev").setAttribute("hidden", "true");
                }                
                if(count == 11){

                    document.getElementById("validate").setAttribute("hidden", "true");
                    document.getElementById("next").removeAttribute("hidden");
                }
                document.getElementById("part" + count).style.display = "none";
                document.getElementById("part" + (count - 1)).style.display = "block";
                count--;
            }
        </script>  
    </body>
</html>    