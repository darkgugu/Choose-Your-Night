<?php
    session_start();
    $_SESSION['nom'] = [];
    $_SESSION['id'] = [];
?>
<html>
    <head>
        <title>CYN Account</title>
        <link rel="stylesheet" type="text/css" href="stylesheet.css">
    </head>

    <body class="background">

    <?php
            $bdd = new PDO('mysql:host=localhost;dbname=cyn;charset=utf8', 'root', '');
            if(isset($_GET['pseudo'])){

                $infos[0] = $_GET['pseudo'];
                $infos[1] = $_GET['mdp'];
                $infos[2] = $_GET['nom'];
                $infos[3] = $_GET['prenom'];
                $infos[4] = $_GET['email'];
                $infos[5] = $_GET['rue'];
                $infos[6] = $_GET['ville'];
                $infos[7] = $_GET['cp'];
                $infos[8] = $_GET['gender'];
                $infos[9] = $_GET['attir'];
                $infos[10] = $_GET['party_type'];
                $infos[11] = $_GET['place_type'];
                $infos[12] = $_GET['distance'];
                $infos[13] = $_GET['price'];
                $infos[14] = "12331525";
                $infos[15] = $_GET['prenom']." ".$_GET['nom'];
                $infos[16] = $_GET['rue'].", ".$_GET['ville'];
                $infos[17] = $_GET['lat'];
                $infos[18] = $_GET['lng'];

                $req = $bdd->query('INSERT INTO utilisateurs (username, email, password, raison, nom, adresse, latitude, longitude, pref) VALUES ("'.$infos[0].'","'.$infos[4].'", "'.$infos[1].'", "user", "'.$infos[15].'", "'.$infos[16].'", "'.$infos[17].'", "'.$infos[18].'" ,"'.$infos[14].'")');

                $_SESSION['nom'] = $infos[2];
                header('Location: acceuil.php');
                exit();
            }

        ?>

        <div class="center">

            <h1>Création de compte</h1>

            <form action="account.php" method="get" id="account">

                <div style="display: block;" id="part1">

                    <input type="text" name="pseudo" placeholder="   Identifiant" ><br>
                    <input type="password" name="mdp" placeholder="   Mot de passe"><br>
                </div>
                <div style="display: none;" id="part2">

                    <input type="text" name="nom" placeholder="   Nom"><br>
                    <input type="text" name="prenom" placeholder="   Prénom"><br>
                    <input type="email" name="email" placeholder="   Adresse Mail"><br>
                </div>
                <div style="display: none;" id="part3">
                    <input id="rue" type="text" name="rue" placeholder=" Rue et Numéro de rue"><br>
                    <input id="ville" type="text" name="ville" placeholder=" Ville" onchange="coords()"><br>
                    <input type="number" name="cp" placeholder=" Code Postal"><br>
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
                    Ignorer <input type="radio" name="gender" value="ignore" checked><br>
                    <input type="text" name="other_gender" placeholder=" Autre"><br>
                </div>
                <div style="display: none;" id="part6">
                    Vous êtes attirés par : <br>
                    Homme <input type="checkbox" name="attir" value="Homme"><br>
                    Femme <input type="checkbox" name="attir" value="Femme"><br>
                    Ignorer <input type="checkbox" name="attir" value="ignore" checked><br>
                    <input type="text" name="other_attir" placeholder=" Autre"><br>
                </div>
                <div style="display: none;" id="part7">
                    Vous preferez : <br>
                    Les soirées chill <input type="radio" name="party_type" value="chill"><br>
                    Les grosses soirées <input type="radio" name="party_type" value="big"><br>
                    Les deux <input type="radio" name="party_type" value="both"><br>
                    Ignorer <input type="radio" name="party_type" value="ignore" checked><br><br>
                </div>
                <div style="display: none;" id="part8">
                    Vous êtes plus : <br>
                    Bar <input type="radio" name="place_type" value="bar"><br>
                    Boite <input type="radio" name="place_type" value="club"><br>
                    Peu importe <input type="radio" name="place_type" value="both"><br>
                    Ignorer <input type="radio" name="place_type" value="ignore" checked><br>
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
                
                <input id="lat" type="text" name="lat" value="" hidden>
                <input id="lng" type="text" name="lng" value="" hidden>
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
            
            function coords(){

                var rue = document.getElementById("rue").value;
                var ville = document.getElementById("ville").value;
                var lat = document.getElementById("lat");
                var lng = document.getElementById("lng");
                var address = rue + ", " + ville;
                address = address.replace(" ", "%20");
                url = "https://maps.googleapis.com/maps/api/geocode/json?address=" + address + "&key=AIzaSyDpY0dUuM8dzwPD5dt4gcGjmi1b3rOJK3s";
                var array = [];

                fetch(url)
                .then(function(response){
                            
                    return response.json();
                })
                .then(function(json){

                    lat.value = json.results[0].geometry.location.lat;
                    lng.value = json.results[0].geometry.location.lng;
                });
            }

            document.getElementById("account").addEventListener("keydown", function(e){if (e.keyCode==13) e.preventDefault()} );

        </script>  
    </body>
</html>