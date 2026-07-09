<?php include './views/comps/header/header.php' ?>
<?php include './views/comps/navbar/nav.php' ?>
    <h1>Layout prueba</h1>
    <?php foreach($users as $user): ?>
    <p>Username: <?= $user->user ?></p>
    <?php endforeach; ?>
    <?php include './views/docs/index.php' ?>
    
</body>
</html>