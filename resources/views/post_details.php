<html>
<head>
    <title>Platzi Blog in PHP!</title>
</head>
<body>
    <h1><?= $post->getTitle()?>
        <small><?= $post->getAuthor() ?></small>
    </h1>
    <p><?= $post->getBody()?></p>
</body>
</html>