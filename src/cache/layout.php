<?php include './views/comps\header\header.php' ?>
<?php include './views/comps\navbar\nav.php' ?>
    <h1>Layout prueba</h1>
    <ul>
    <?php foreach($users as $user): ?>
        <?php if($user->user == 'Valeria'): ?>
        <li><b><?= $user->user ?></b></li>
        <?php elseif($user->user == 'Jeremy'): ?>
        <li><b><?= $user->user ?></b></li>
        <?php else: ?>
        <li><?= $user->user ?></li>
        <?php endif; ?>
    <?php endforeach; ?>
    </ul>
    
</body>
</html>