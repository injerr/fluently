<?php
include_once('./views/comps/header/header.php');
include_once('./views/comps/navbar/nav.php');
?>

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

echo "<br/>";
echo $some; 

echo '<pre>';
