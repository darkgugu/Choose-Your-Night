<?php
    session_start();
?>

<html>
    <head>
        <title></title>
        <link rel="stylesheet" type="text/css" href="stylesheet.css">
        <style>        
            .third{
                height: 100%;
                width: 33.3%;
                display: inline-block;
                padding: 0;
                text-align: center;
            }
            table,
            td {
                border: 1px solid #333;
            }
        </style>
    </head>
        <body>
            <?php
                
                //var_dump($_SESSION);
                $bdd = new PDO('mysql:host=localhost;dbname=cyn;charset=utf8', 'root', '');

                if(isset($_GET['nom_asso'])){

                    //var_dump($_GET);
                    $infos = $_GET;
                    $infos['complete_adress'] = $_GET['rue'].", ".$_GET['ville'];

                    $req = $bdd->query('INSERT INTO associations (Nom, Adresse, Lien, statut) VALUES ("'.$infos['nom_asso'].'","'.$infos['complete_adress'].'", "'.$infos['lien_asso'].'", "pending")');
                    $req = $bdd->query('SELECT COUNT(*) FROM associations');
                    $donnees = $req->fetch();
                    $id_asso = $donnees[0];
                    $req = $bdd->query('UPDATE utilisateurs SET `partnership` = "'.$id_asso.'" WHERE ID = "'.$_SESSION['id'].'"');
                    $req = $bdd->query('INSERT INTO ecoles (Nom, Adresse, Numero, Responsable, Etudes, Lien, statut) VALUES ("'.$infos['nom_ecole'].'","'.$infos['complete_adress'].'", "'.$infos['numero_ecole'].'", "'.$infos['respo'].'", "'.$infos['etudes'].'", "'.$infos['lien_ecole'].'", "pending")');
                    $req = $bdd->query('SELECT COUNT(*) FROM ecoles');
                    $donnees = $req->fetch();
                    $id_ecole = $donnees[0];
                    $req = $bdd->query('INSERT INTO ecoles_has_associations (ecoles_ID, associations_ID) VALUES ("'.$id_ecole.'", "'.$id_asso.'")');

                    ?>
                        <div class="center">
                        
                            <h1>Votre demande à été prise en compte</h1>
                        </div>   
                    <?php
                }
                else{

                    if($_SESSION['perm'] == 'user'){

                        $req = $bdd->query('SELECT * FROM utilisateurs WHERE ID ="'.$_SESSION['id'].'"');
                        $donnees = $req->fetch();

                        if(isset($donnees['partnership'])){
                        ?>
                            <div class="center">
                            
                                <h1>Votre demande à été prise en compte</h1>
                            </div>
                        <?php
                        }else{
                        ?>
                            <div id="user" class="center">
                            
                                <h1>Vous n'êtes pas partenaire</h1>
                                <button onclick="display()">Devenir Partenaire</button>
                            </div>   
                        <?php
                        }
                    }  
                    if($_SESSION['perm'] != 'user'){
                        ?>
                            <div id="not_user" class="center">

                                <?php 
                                
                                    $req = $bdd->query('SELECT * FROM associations WHERE ID = (SELECT partnership FROM utilisateurs WHERE ID = "'.$_SESSION['id'].'")');
                                    $donnees = $req->fetch();
                                    $asso = $donnees;

                                    $req = $bdd->query('SELECT * FROM ecoles WHERE ID = (SELECT ecoles_ID FROM ecoles_has_associations WHERE associations_ID = (SELECT partnership FROM utilisateurs WHERE ID = "'.$_SESSION['id'].'"))');
                                    $donnees = $req->fetch();
                                    $ecole = $donnees;

                                    $req = $bdd->query('SELECT * FROM soirees WHERE ID IN (SELECT soirees_ID FROM organisateurs WHERE ecoles_has_associations_ID = (SELECT ID FROM ecoles_has_associations WHERE associations_ID = (SELECT partnership FROM utilisateurs WHERE ID = "'.$_SESSION['id'].'")))');
                                    $donnees = $req->fetchAll();
                                    $soirees = $donnees;
                                ?>

                                <div class="third" style="float:left;">
                                    
                                    <h1>ASSO</h1>
                                    <?php //var_dump($asso)?>

                                    Nom de l'association : <?php echo $asso[1];?><br>
                                    Adresse de l'association : <?php echo $asso[2];?><br>
                                    Lien du site de l'association : <a href="<?php echo $asso[4];?>"><?php echo $asso[4];?></a>

                                    <div class="center" style="font-size: 100px">
                                        
                                        Note : <?php echo $asso[3];?>/5
                                    </div>
                                </div>

                                <div class="third">
                                    
                                    <h1>ECOLE</h1>
                                    <?php //var_dump($ecole)?>

                                    Nom de l'école : <?php echo $ecole[1];?><br>
                                    Adresse de l'école : <?php echo $ecole[2];?><br>
                                    Lien du site de l'école : <a href="<?php echo $ecole[7];?>"><?php echo $ecole[7];?></a>
                                </div>

                                <div class="third" style="float:right;">

                                    <h1>SOIREES</h1>
                                    <?php //var_dump($soirees);?>

                                    <table style="text-align: center;">
                                        <tr>
                                            <th>Nom de la soirée</th>
                                            <th>Etat</th>
                                            <th>Statut</th>
                                            <th>Note</th>
                                        </tr>
                                        <?php for($count = 0;$count != count($soirees);$count++){?>
                                            <tr>
                                                <td><a href="display_tile.php?soiree=<?php echo $soirees[$count]['Nom'];?>"><?php echo $soirees[$count]['Nom'];?></a></td>
                                                <td><?php echo $soirees[$count]['Etat'];?></td>
                                                <td><?php echo $soirees[$count]['statut'];?></td>
                                                <td><?php if(isset($soirees[$count]['Note'])){ echo $soirees[$count]['Note'];}else{ echo "AD";};?></td>
                                            </tr>
                                        <?php }?>
                                    </table>
                                    <button onclick="add()">Ajouter une soirée</button>

                                    <form id="soirees_form" action="apercu.php" method="post" enctype="multipart/form-data" hidden>

                                        <input type="text" name="nom" placeholder="Nom de la soirée">
                                        <input type="text" name="adresse" placeholder="Adresse" onchange="coords()" id="address"><br>
                                        <input type="text" name="nom_lieu" placeholder="Nom du lieu">
                                        <input type="text" name="date" placeholder="Date (DD/MM/YY)"><br>
                                        <input type="text" name="debut" placeholder="Heure de début (HHhMM)">
                                        <input type="text" name="fin" placeholder="Heure de fin (HHhMM)"><br>
                                        <input type="text" name="theme" placeholder="Thème">
                                        <input type="text" name="prix" placeholder="Prix d'entrée"><br>
                                        <input type="text" name="places" placeholder="Nombre de places">
                                        <input type="text" name="billeterie" placeholder="Lien Billeterie"><br>
                                        <input type="text" name="type_lieu" placeholder="Type du lieu (Bar/Salle)">
                                        <input type="text" name="DJ" placeholder="DJ"><br>
                                        <input type="text" name="DJ_lien" placeholder="DJ lien"><br>
                                        Affiche: <input type="file" name="affiche">
                                        <input id="lat" type="text" name="lat" value="" hidden>
                                        <input id="lng" type="text" name="lng" value="" hidden>
                                        <input id="validate" type="submit" name="Valider" value="Valider">
                                    </form>
                                </div>
                            </div>   
                        <?php
                    }
                }
            ?>

            <div id="partner" class="center" hidden>

                Vous voulez que votre association étudiante puisse profiter gratuitement de <br>
                la plateforme Choose Your Night pour la promotion de ses évènements ? <br>
                Pas de problèmes, remplissez ce formulaire, <br>
                vous recevrez un mail lorsque votre demande auras été résolue <br><br>

                <form id="partner_form" action="" method="get" hidden>

                    Nom de l'association et numéro de téléphone<br>
                    <input type="text" name="nom_asso" placeholder="Nom de association">
                    <input type="text" name="numero_asso" placeholder="Numéro de téléphone"><br>

                    Nom de l'école et numéro de téléphone<br>
                    <input type="text" name="nom_ecole" placeholder="Nom de l'école">
                    <input type="text" name="numero_ecole" placeholder="Numéro de téléphone"><br>

                    Adresse <br>
                    <input id="rue" type="text" name="rue" placeholder="Rue et Numéro de rue">
                    <input id="ville" type="text" name="ville" placeholder=" Ville"><br>

                    Nom du responsable et type d'école<br>
                    <input type="text" name="respo" placeholder="Nom de la personne responsable">
                    <input type="text" name="etudes" placeholder="Type d'école (Ecole d'ingénieur, de commerce, ect)"><br>

                    Liens des sites <br>
                    <input type="text" name="lien_asso" placeholder="Association">
                    <input type="text" name="lien_ecole" placeholder="Ecole"><br>
                    <input id="validate" type="submit" name="Valider" value="Valider">

                </form>
            </div>

            <script>
                function display(){

                    document.getElementById("partner_form").removeAttribute("hidden");
                    document.getElementById("partner").removeAttribute("hidden");
                    document.getElementById("user").setAttribute("hidden", "true");
                }
                function coords(){

                    var lat = document.getElementById("lat");
                    var lng = document.getElementById("lng");
                    var address = document.getElementById("address").value;
                    address = address.replace(" ", "%20");
                    console.log(address);
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
                function add(){

                    document.getElementById("soirees_form").removeAttribute("hidden");
                }
            </script>
            <?php include "sidebar.php";?>
        </body>
</html>