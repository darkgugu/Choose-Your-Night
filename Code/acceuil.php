<?php
    session_start();
?>

<html>
    <head>
        <title>CYN Connection</title>
        <link rel="stylesheet" type="text/css" href="stylesheet.css">
    </head>
        <body>

        <form style="position: fixed; right: 0; top: -5;" action="" method="GET">            
            <select name="order">
                <option value="prix_asc">Prix (Croissant)</option>
                <option value="prix_desc">Prix (Décroissant)</option>
            </select>
            <input type="submit" value="Trier">
        </form>
            
        <a href="account_infos.php"><img class="account" src="../Images/Ressources/account.jpg"></img></a>

        <div id="main" class="center_tile">

            <?php
            
                $bdd = new PDO('mysql:host=localhost;dbname=CYN;charset=utf8', 'root', '');

                $req = $bdd->query('SELECT COUNT(ID) as total from soirees WHERE statut = "approved"');
                $donnees = $req->fetch();
                $nb_soirees = $donnees['total'];

                if(isset($_GET['order'])){    
                    switch($_GET['order']){
                        case 'prix_asc':

                            $req = $bdd->query('SELECT * from soirees WHERE statut = "approved" ORDER BY Prix DESC');
                        break;
                        case 'prix_desc':

                            $req = $bdd->query('SELECT * from soirees WHERE statut = "approved" ORDER BY Prix ASC');
                        break;
                    }
                }
                else{

                    $req = $bdd->query('SELECT * from soirees WHERE statut = "approved"');
                }           
                $donnees = $req->fetchAll();
                $soirees = $donnees;

                for($count = 0;$count != $nb_soirees;$count++){
                    $count2 = 1;
                    $soiree_ID = $soirees[$count][0];

                    $req = $bdd->query('SELECT Nom FROM ecoles WHERE ID IN (SELECT ecoles_ID FROM ecoles_has_associations WHERE ID IN (SELECT ecoles_has_associations_ID FROM organisateurs WHERE soirees_ID = "'.$soiree_ID.'"))');
                    $donnees = $req->fetchAll();
                    $orga = $donnees;

                    $req = $bdd->query('SELECT COUNT(ID) FROM ecoles WHERE ID IN (SELECT ecoles_ID FROM ecoles_has_associations WHERE ID IN (SELECT ecoles_has_associations_ID FROM organisateurs WHERE soirees_ID = "'.$soiree_ID.'"))');
                    $donnees = $req->fetch();
                    $orga_count = $donnees[0];
            ?>

            <div style="display: inline-block;" class="tile"> 
                <form action="display_tile.php" method="get">
                    <input class="name_button" type="submit" name="soiree" value="<?php echo $soirees[$count][1];?>">
                </form>
                <?php echo $soirees[$count]["Lieu_nom"];?><br>
                <?php echo $soirees[$count]["Date"];?><br>
                <?php echo $soirees[$count]["Heure_début"];?> - <?php echo $soirees[$count]["Heure_fin"];?><br>
                Prix : <?php echo $soirees[$count]["Prix"];?>€
                Nombre de places restantes : <?php echo $soirees[$count]["Places"];?><br> Organisée par : <?php for($i = 0;$i != $orga_count;$i++){echo $orga[$i][0]; if($i != $orga_count-1){echo ", ";}}?>    
            </div>
                
            <?php }?>

            <?php include 'sidebar.php';?>

        </body>
</html>