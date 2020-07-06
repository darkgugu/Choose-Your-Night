<?php
    session_start();
?>
<html>
    <head>
        <title></title>
        <link rel="stylesheet" type="text/css" href="stylesheet.css">
        <style>
            div{
                height: 100%;
                width: 33.3%;
                display: inline-block;
                padding: 0;
            }
            .images{
                width: 30px;
                length: 30px;
            }
            .bouton2 {
                padding:16px 0 6px 0;
                font:bold 30px Arial;
                background: lime;
                color:#fff;
                border-radius:2px;
                width:200px;
            }
        </style>
    </head>
        <body onload="myalert()">
            <?php
                $bdd = new PDO('mysql:host=localhost;dbname=CYN;charset=utf8', 'root', '');

                if(isset($_FILES['affiche'])){
                    //var_dump($_POST);
                    //var_dump($_FILES);
                    $dossier = 'C:\wamp64\www\GitHub\Choose-Your-Night\Images\Affiches\\affiche_'.$_POST['nom'];
                    move_uploaded_file($_FILES['affiche']['tmp_name'], $dossier.".png");

                    $count = 0;
                    foreach ($_POST as $key => $value) {
                        $infos[$count] = $value;
                        $count++;
                    }
                }
                if(isset($_POST['pending'])){

                    //var_dump($_POST);
                    $infos = $_POST;

                    $infos['affiche'] = "../Images/Affiches/affiche_".$infos['nom'].".png";
                    //var_dump($infos);

                    $req = $bdd->query('INSERT INTO soirees (Nom, Adresse, Lieu_nom, Date, Heure_début, Heure_fin, Theme, Prix, Affiche, Places, Billeterie, Lieu_type, DJ, DJ_lien, Etat, statut, latitude, longitude, Details) VALUES ("'.$infos['nom'].'","'.$infos['adresse'].'", "'.$infos['nom_lieu'].'", "'.$infos['date'].'", "'.$infos['debut'].'", "'.$infos['fin'].'", "'.$infos['theme'].'", "'.$infos['prix'].'" , "'.$infos['affiche'].'","'.$infos['places'].'" ,"'.$infos['billeterie'].'" ,"'.$infos['type_lieu'].'" ,"'.$infos['DJ'].'" ,"'.$infos['DJ_lien'].'" ,"coming" ,"'.$infos['pending'].'", "'.$infos['lat'].'", "'.$infos['lng'].'", "'.$infos['details'].'")');

                    $req = $bdd->query('SELECT ID FROM soirees WHERE Nom = "'.$infos['nom'].'"');
                    $donnees = $req->fetch();
                    $id_soiree = $donnees[0];

                    //var_dump($_SESSION);

                    $req = $bdd->query('SELECT ID FROM ecoles_has_associations WHERE associations_ID = (SELECT partnership FROM utilisateurs WHERE ID = "'.$_SESSION['id'].'")');
                    $donnees = $req->fetch();
                    $id_has_asso = $donnees[0];

                    $req = $bdd->query('INSERT INTO organisateurs (soirees_ID, ecoles_has_associations_ID) VALUES ("'.$id_soiree.'", "'.$id_has_asso.'")');

                    header('Location: partenaires.php');
                    exit();
                }
            ?>

            <?php

                $soiree = $_POST;

                $req = $bdd->query('SELECT Nom FROM associations WHERE ID IN (SELECT partnership FROM utilisateurs WHERE ID = "'.$_SESSION['id'].'")');
                $donnees = $req->fetch();
                $orga = $donnees;

                $req = $bdd->query('SELECT longitude, latitude from utilisateurs WHERE ID = "'.$_SESSION['id'].'" ');
                $donnees = $req->fetch();
                $place = $donnees;
            ?>

            <div class="center_tile" style="float:left;">

                <h1><?php echo $soiree["nom"];?></h1></br>

                <?php echo $soiree["date"];?> / <?php echo $soiree["debut"];?> - <?php echo $soiree["fin"];?></br>
                
                Organisée par : <a href="ecole_tile.php"><?php echo $orga[0];?></a></br>
                Prix : <?php echo $soiree["prix"];?>€ -
                Nombre de places restantes : <?php echo $soiree["places"];?><br>
                Billeterie : <a href="<?php echo $soiree["billeterie"];?>"><?php echo $soiree["billeterie"];?></a><br>

                <h2>Détails :</h2>

                    <?php echo $soiree['details']?>

                    <h3>DJ</h3>
                    <?php echo $soiree["DJ"];?></br>
                    <a href="<?php echo $soiree["DJ_lien"];?>"><?php echo $soiree["DJ_lien"];?></a><br>
                </div>

                <div>
                    <p id="map" style="height: 50%;"></p>
                    <div class="center_tile " style="background-color:AntiqueWhite; border-radius: 10px; height: 41%; width: 100%">
                        
                        Itinéraire depuis chez vous <br><br>
                        <img class="images" id="1"><img class="images" id="2"><img class="images" id="3"><img class="images" id="4"><img class="images" id="5">
                        <img class="images" id="6"><img class="images" id="7"><img class="images" id="8"><img class="images" id="9">
                        <span id="display"></span>
                        <br><br>

                        <?php //var_dump($soiree)?>
                        <form id="soirees_form" action="apercu.php" method="post" enctype="multipart/form-data">

                            <?php foreach ($soiree as $key => $value) {?>

                                <input hidden type="text" name="<?php echo $key;?>" value="<?php echo $value;?>">
                            <?php }?>
                            <input hidden type="text" name="pending" value="pending">
                            <input class="bouton2" type="submit" name="Valider" value="Valider l'aperçu">
                        </form>
                    </div>
                </div>

                <div style="float:right">

                    <?php $image = "../Images/Affiches/affiche_".$soiree['nom'];?>
                    <img style="height: inherit;" src="<?php echo $image;?>">
                </div>

                    <script>

                        var latS = <?php echo $_POST['lat'];?>;
                        var lngS = <?php echo $_POST['lng'];?>;
                        var lat_user = <?php echo $place[1];?>;
                        var lng_user = <?php echo $place[0];?>;

                        function initMap(){

                            var place = {lat: <?php echo $_POST['lat'];?>, lng: <?php echo $_POST['lng'];?>};
                            var map = new google.maps.Map(document.getElementById('map'), {zoom: 18, center: place});
                            var marker = new google.maps.Marker({position: place, map: map});
                        }

                        var display = document.getElementById("display");
                        var array;
                        var headers = new Headers();
                        headers.append('Authorization', 'Basic ' + btoa('947fc96b-fbba-47d7-894d-be9dd87e93e8:'));
                        var url = "https://api.navitia.io/v1/coverage/fr-idf/journeys?from=" + lng_user + "%3B" + lat_user + "&to=" + lngS + "%3B" + latS;
                        
                        fetch(url, {headers: headers})
                        .then(function(response){
                                    
                            return response.json();
                        })
                        .then(function(json){

                            array = json;
                            add();
                            
                        });
                    </script>

                    <script>
                        function add(){
                        
                            var url_0 = "../Images/picto_svg_ok/";
                            var url_1 = "genRVB.svg";
                            var duration = array.journeys[0].duration / 60;
                            var nb_sections = array.journeys[0].sections.length;
                            var transport = [];
                            var lines = [];
                            var output = "";

                            for(var count = 0;count != nb_sections;count++){

                                if(array.journeys[0].sections[count].type == "public_transport"){

                                    lines[count] = array.journeys[0].sections[count].display_informations.network[0] + array.journeys[0].sections[count].display_informations.code;
                                }
                                if(array.journeys[0].sections[count].type == "street_network"){

                                    transport[count] = "Marche";
                                }
                                else if(array.journeys[0].sections[count].type == "transfer"){

                                    transport[count] = "Changement";
                                }else if(array.journeys[0].sections[count].type == "waiting"){

                                    transport[count] = Math.round(array.journeys[0].sections[count].duration / 60) + "mn";
                                }else{

                                    transport[count] = array.journeys[0].sections[count].type
                                }
                            }

                            console.log(transport);
                            console.log(lines);
                            var count2 = 1;

                            for(var count = 0;count != nb_sections;count++){

                                if(transport[count] == "public_transport"){
                                    document.getElementById(count2).setAttribute('src',url_0 + lines[count] + url_1);
                                    document.getElementById(count2 + 1).setAttribute('src',url_0 + "fleche.png");
                                }
                                else{
                                    document.getElementById(count2).setAttribute('src',url_0 + "Marche.png");
                                    if(count != nb_sections - 1){
                                        document.getElementById(count2 + 1).setAttribute('src',url_0 + "fleche.png");
                                    }
                                }
                                count2 = count2 + 2;
                            }

                            output = output + "Total: " + Math.round(duration) + "mn"
                            display.textContent = output;
                        }
                    </script>

                    <script>
                        function myalert(){
                            alert("Ceci est un aperçu");
                        }
                    </script>

            <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDpY0dUuM8dzwPD5dt4gcGjmi1b3rOJK3s&callback=initMap"></script>
        </body>
</html>