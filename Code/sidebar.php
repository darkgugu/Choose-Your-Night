</div>
      
<button class="openbtn" onclick="openNav()">&#9776;</button>

<div id="mySidebar" class="sidebar">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <?php if($_SESSION['perm'] == 'admin'){?><a style="color: red;" href="backend.php">BACKEND</a><?php }?>
            <a href="acceuil.php">Acceuil</a>
            <a href="ecole_tile.php">Nos écoles partenaires</a>
            <a href="asso_tile.php">Nos associations partenaires</a>
            <a href="partenaires.php">Espace Partenaires</a>
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