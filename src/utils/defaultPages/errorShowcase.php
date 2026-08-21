<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $_ENV['APP_NAME'] ?></title>
</head>
<body>
    <div>
        <h1>An error ocurred</h1>
    <?php 
        if (isset($th) && $th instanceof Throwable) {
            echo "<p><b>Message:</b> {$th->getMessage()} <br/><b>File:</b> {$th->getFile()} on the line <b>{$th->getLine()}</b></p>";
        }
    ?>
    </div>
</body>
</html>