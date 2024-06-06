<header>
    <div class="Tango">
        <a href="Glist.php">Main</a>
        <a href="#">Sain</a>
        <?php if(isset($user_id)):  ?>
        <a id="ADDPhoto" href="#">Pain</a>
        <?php endif;?>
        <a href="User.php">User</a>
        <div class="icon"><img src="icons.png" alt="Icon"></div>
    <?php if(isset($user_id)):  ?>
        <a href="logout.php">Выйти</a>
        <?php endif;?>
    </div>
</header>