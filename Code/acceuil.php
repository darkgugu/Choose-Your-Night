<?php
    session_start();
    $_SESSION['pseudo'] = [];
    $_SESSION['id'] = [];
?>

<html>
    <head>
        <title>CYN Connection</title>
        <link rel="stylesheet" type="text/css" href="stylesheet.css">
    </head>
        <body>
          <div id="main" class="center_tile">

            <?php
            
                $bdd = new PDO('mysql:host=localhost;dbname=CYN;charset=utf8', 'root', '');

                $req = $bdd->query('SELECT COUNT(ID) as total from soirees');
                $donnees = $req->fetch();
                $nb_soirees = $donnees['total'];

                $req = $bdd->query('SELECT * from soirees');
                $donnees = $req->fetchAll();
                $soirees = $donnees;

                for($count = 0;$count != $nb_soirees;$count++){
                    $count2 = 1;
                    $soiree_ID = $count + 1;

                    $req = $bdd->query('SELECT Nom FROM ecoles WHERE ID IN (SELECT ecoles_ID FROM ecoles_has_associations WHERE ID IN (SELECT ecoles_has_associations_ID FROM organisateurs WHERE soirees_ID = "'.$soiree_ID.'"))');
                    $donnees = $req->fetchAll();
                    $orga = $donnees;

                    $req = $bdd->query('SELECT COUNT(ID) FROM ecoles WHERE ID IN (SELECT ecoles_ID FROM ecoles_has_associations WHERE ID IN (SELECT ecoles_has_associations_ID FROM organisateurs WHERE soirees_ID = "'.$soiree_ID.'"))');
                    $donnees = $req->fetch();
                    $orga_count = $donnees[0];
           ?>


                <button class="openbtn" onclick="openNav()">&#9776;</button>

                <div style="display: inline-block;" class="tile"> 
                    <form action="display_tile.php" method="get">
                        <input class="name_button" type="submit" name="soiree" value="<?php echo $soirees[$count][1];?>">
                    </form>
                    <?php echo $soirees[$count]["Lieu_nom"];?><br>
                    <?php echo $soirees[$count]["Date"];?><br>
                    <?php echo $soirees[$count]["Heure_début"];?> - <?php echo $soirees[$count]["Heure_fin"];?><br>
                    Prix : <?php echo $soirees[$count]["Prix"];?>€
                    Nombre de places restantes : <?php echo $soirees[$count]["Places"];?><br>
                    Organisée par : <?php for($i = 0;$i != $orga_count;$i++){echo $orga[$i][0]; if($i != $orga_count-1){echo ", ";}}?>
                </div>
                <?php }?>

            </div>
                

            <div id="mySidebar" class="sidebar">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                <a href="#">Nos écoles partenaires</a>
                <a href="#">Nos associations partenaires</a>
                <a href="#">Devenir partenaire</a>
                <a href="#">Nous contacter</a>
                <a href="#">A propos</a>
            </div>
            

            <script>

                function openNav() {
                    document.getElementById("mySidebar").style.width = "250px";
                    document.getElementById("main").style.marginLeft = "250px";
                }


                function closeNav() {
                    document.getElementById("mySidebar").style.width = "0";
                    document.getElementById("main").style.marginLeft = "0";
                }
            </script>
        </body>
</html>