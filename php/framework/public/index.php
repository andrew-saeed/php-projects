<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./base.css">
</head>
<body>
    <?
        use App\Core\App;

        require '../vendor/autoload.php';

        $app = new App();
        var_dump($app);
    ?>
</body>
</html>