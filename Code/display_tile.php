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

                $req = $bdd->query('SELECT Nom, ID FROM ecoles WHERE ID IN (SELECT ecoles_ID FROM ecoles_has_associations WHERE ID IN (SELECT ecoles_has_associations_ID FROM organisateurs WHERE soirees_ID = "'.$soiree["ID"].'"))');
                $donnees = $req->fetchAll();
                $orga = $donnees;

                $req = $bdd->query('SELECT COUNT(ID) FROM ecoles WHERE ID IN (SELECT ecoles_ID FROM ecoles_has_associations WHERE ID IN (SELECT ecoles_has_associations_ID FROM organisateurs WHERE soirees_ID = "'.$soiree["ID"].'"))');
                $donnees = $req->fetch();
                $orga_count = $donnees[0];

                $req = $bdd->query('SELECT longitude, latitude from utilisateurs WHERE ID = "'.$_SESSION['id'].'" ');
                $donnees = $req->fetch();
                $place = $donnees;

                //var_dump($soiree);
                function str_date($date){

                    $string = "";

                    if($date[8] != '0'){$string .= $date[8];}
                    $string .= $date[9];

                    switch($date[6]){
                        case '0':

                            $string .= ' Octobre';
                        break;
                        case '1':

                            if($date[5] == 0){$string .= ' Janvier';}
                            else{$string .= ' Novembre';}
                        break;
                        case '2':

                            if($date[5] == 0){$string .= ' Février';}
                            else{$string .= ' Décembre';}
                        break;
                        case '3':

                            $string .= ' Mars';
                        break;
                        case '4':

                            $string .= ' Avril';
                        break;
                        case '5':

                            $string .= ' Mai';
                        break;
                        case '6':

                            $string .= ' Juin';
                        break;
                        case '7':

                            $string .= ' Juillet';
                        break;
                        case '8':

                            $string .= ' Aout';
                        break;
                        case '9':

                            $string .= ' Septembre';
                        break;     
                    }

                    if($date[2] != '2' || $date[3] != '0'){$string .= ' 20'.$date[2].$date[3];}

                    return $string;
                }
            ?>

            <div class="center_tile" style="float:left;">

                <h1><?php echo $soiree["Nom"];?></h1></br>
                <?php echo str_date($soiree["Date"]);?> / <?php echo $soiree["Heure_début"];?> - <?php echo $soiree["Heure_fin"];?></br>
                Organisée par : 
                
                <form action="ecole_infos.php" method="get">                
                    <?php 
                        for($i = 0;$i != $orga_count;$i++){
                    ?>        
                            <input class="link_button" type="submit" name="ecole" value="<?php echo $orga[$i][0];?>">
                            <input type="text" hidden name="id" value="<?php echo $orga[$i][1];?>">
                    <?php
                            if($i != $orga_count-1){
                                echo ", ";
                            }
                        }
                    ?></br>
                    Prix : <?php echo $soiree["Prix"];?>€ -
                    Nombre de places : <?php echo $soiree["Places"];?><br>
                    Billeterie : <a href="https://www.<?php echo $soiree["Billeterie"];?>"><?php echo $soiree["Billeterie"];?></a><br>
                </form>

                <h2>Détails :</h2>

                <?php echo $soiree["Details"]?>

                <h3>DJ</h3>
                <?php echo $soiree["DJ"];?></br>
                <a href="https://www.<?php echo $soiree["DJ_lien"];?>"><?php echo $soiree["DJ_lien"];?></a><br>
            </div>

            <div>
                <p id="map" style="height: 50%;"></p>
                <div class="center_tile " style="background-color:AntiqueWhite; border-radius: 10px; height: 41%; width: 100%">
                    
                    Itinéraire depuis chez vous <br><br>
                    <img class="images" id="1"><img class="images" id="2"><img class="images" id="3"><img class="images" id="4"><img class="images" id="5">
                    <img class="images" id="6"><img class="images" id="7"><img class="images" id="8"><img class="images" id="9">
                    <span id="display"></span>
                    <br>
                    <?php
                        $req = $bdd->query('SELECT * FROM noted WHERE utilisateurs_ID = "'.$_SESSION['id'].'" AND soirees_ID = "'.$soiree['ID'].'"');
                        $donnees = $req->fetch();
                        if($donnees == NULL && $soiree['Etat'] == "notation"){

                            ?>
                            
                                <form action="acceuil.php" method="post">

                                    <input type="number" id="note" name="note" min="0" max="5" style="width: 180;" placeholder="Notez entre 0 et 5">
                                    <input type="text" name="id" value="<?php echo $soiree['ID'];?>" hidden>
                                    <input id="validate" type="submit" name="Valider" value="Valider">
                                </form>
                            <?php
                        }
                        else if($soiree['Etat'] == "notation"){

                            echo "Vous avez déjà noté cette soirée";
                        }
                    ?>
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