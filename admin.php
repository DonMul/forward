<?php
    session_start();

    $sessionMessage = $_SESSION['message'] ?? [];
    $message = $sessionMessage['message'] ?? '';
    $style = $sessionMessage['type'] ?? '';

    $file = __DIR__ . DIRECTORY_SEPARATOR . 'url.txt';
    $url = '';

    if (file_exists($file)) {
        $url = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'url.txt');
    }

    $_SESSION['message'] = [];
?>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Setup URL</title>
</head>
<body>
<div class="container">
    <h1 class="text-center">Change forward URL</h1>
    <div class="text-center">Current URL: <?=$url?></div>
    <?php if ($message != ''): ?>
        <div class="alert alert-<?=$style?>">
            <?=$message?>
        </div>
    <?php endif ?>
    <form method="post" action="configure.php">
        <div class="form-group">
            <label for="url">URL</label>
            <input id="url" class="form-control" type="text" name="url" value="<?$url?>"/>
        </div>
        <div class="form-group">
            <label for="password">Wachtwoord</label>
            <input id="password" class="form-control" type="text" name="password" value=""/>
        </div>
        <button class="btn btn-success" type="submit">
            Save
        </button>
    </form>
</div>
</body>
</html>