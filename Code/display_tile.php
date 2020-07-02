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
        </style>
    </head>
        <body>
            <?php
            
                $name = $_GET["soiree"];

                $bdd = new PDO('mysql:host=localhost;dbname=CYN;charset=utf8', 'root', '');

                $req = $bdd->query('SELECT * from soirees WHERE Nom = "'.$name.'" ');
                $donnees = $req->fetch();
                $soiree = $donnees;

                $req = $bdd->query('SELECT Nom FROM ecoles WHERE ID IN (SELECT ecoles_ID FROM ecoles_has_associations WHERE ID IN (SELECT ecoles_has_associations_ID FROM organisateurs WHERE soirees_ID = "'.$soiree["ID"].'"))');
                $donnees = $req->fetchAll();
                $orga = $donnees;

                $req = $bdd->query('SELECT COUNT(ID) FROM ecoles WHERE ID IN (SELECT ecoles_ID FROM ecoles_has_associations WHERE ID IN (SELECT ecoles_has_associations_ID FROM organisateurs WHERE soirees_ID = "'.$soiree["ID"].'"))');
                $donnees = $req->fetch();
                $orga_count = $donnees[0];

                $req = $bdd->query('SELECT longitude, latitude from utilisateurs WHERE ID = "'.$_SESSION['id'].'" ');
                $donnees = $req->fetch();
                $place = $donnees;

                //var_dump($soiree);
            ?>

            <div class="center_tile" style="float:left;">

                <h1><?php echo $soiree["Nom"];?></h1></br>
                <?php echo $soiree["Date"];?> / <?php echo $soiree["Heure_début"];?> - <?php echo $soiree["Heure_fin"];?></br>
                Organisée par : 
                
                <form action="ecole_infos.php" method="get">                
                    <?php 
                        for($i = 0;$i != $orga_count;$i++){
                    ?>        
                            <input class="link_button" type="submit" name="ecole" value="<?php echo $orga[$i][0];?>">
                    <?php
                            if($i != $orga_count-1){
                                echo ", ";
                            }
                        }
                    ?></br>
                    Prix : <?php echo $soiree["Prix"];?>€ -
                    Nombre de places restantes : <?php echo $soiree["Places"];?><br>
                    Billeterie : <a href="<?php echo $soiree["Billeterie"];?>"><?php echo $soiree["Billeterie"];?></a><br>
                </form>

                <h2>Détails :</h2>

                Salut à toutes et à toutes !

                La fameuse fête familiale américaine Thanksgiving arrive bientôt !
                Et comme l'Esiea est une histoire de famille, on vous convie le 28 novembre 2019 pour un afterwork chez notre bar partenaire pour célébrer Thanksgiving avec nous !

                Le Lizard Lounge
                18 rue du Bourg Tibourg
                75004 Paris

                Accès: 
                Hôtel de Ville (métro ligne 1) 
                Pont-Marie (métro ligne 7)

                N'oubliez pas que les 30 premières pintes sont à 1€ ! 

                Et si vous préférez insta, on vous invite à follow notre page @assointer.esiea !

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

                </div>
            </div>

            <div style="float:right">

                <img style="height: inherit;" src="<?php echo $soiree['Affiche'];?>">
            </div>

            <?php include 'sidebar.php';?>

            <script>

                var lat = <?php echo $soiree['latitude'];?>;
                var lng = <?php echo $soiree['longitude'];?>;

                var lat_user = <?php echo $place[1];?>;
                var lng_user = <?php echo $place[0];?>;

                function initMap(){

                    var place = {lat: <?php echo $soiree['latitude'];?>, lng: <?php echo $soiree['longitude'];?>};
                    var map = new google.maps.Map(document.getElementById('map'), {zoom: 18, center: place});
                    var marker = new google.maps.Marker({position: place, map: map});
                }

                var display = document.getElementById("display");
                var array;
                var headers = new Headers();
                headers.append('Authorization', 'Basic ' + btoa('947fc96b-fbba-47d7-894d-be9dd87e93e8:'));
                var url = "https://api.navitia.io/v1/coverage/fr-idf/journeys?from=" + lng_user + "%3B" + lat_user + "&to=" + lng + "%3B" + lat;
                
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

                            lines[count] = array.journeys[0].sections[count].display_informations.commercial_mode[0] + array.journeys[0].sections[count].display_informations.code;
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

            <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDpY0dUuM8dzwPD5dt4gcGjmi1b3rOJK3s&callback=initMap"></script>            
        </body>
</html>