<?php include './views/comps\header\header.php' ?>
<?php include './views/comps\navbar\nav.php' ?>

<div class="container">
    <div class="fw-bold">RANDOM</div>
</div>

<?php
include_once('./views/comps/footer/footer.php');
class Student {
    public function random() {
        echo Student::class;
    }
}

$class = "Student";
if (class_exists($class)) {
    echo "Existe";
    $ob = new $class();
    $ob->random();
}
?>
<div>
    <?= $some  ?>
</div>