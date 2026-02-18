<div class="container">
    <div class="fw-bold">RANDOM</div>
</div>

<?php

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