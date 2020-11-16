<?php
require 'functions.php';
$zinute = $_POST;
unset($zinute['submit']);
$p = 'Dekui, Jusu zinute gavome :)';
foreach ($zinute as $tekstas){
    if ($tekstas === ''){
        $zinute = [];
        $p = 'Uzpildykite teksta';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Contact us</title>
</head>
<body class="contact">
<nav>
    <ul>
        <?php foreach ($nav['links'] as $name => $link): ?>
            <li><a href="<?php print $link ?>"><?php print $name ?></a></li>
        <?php endforeach; ?>
    </ul>
</nav>
<section>
    <h1>Siuskite mums zinute</h1>
    <form method="post">
        <input type="text" name="name" placeholder="Vardas">
        <input type="email" name="email" placeholder="Pastas">
        <textarea name="zinute" placeholder="Zinute"></textarea>
        <input type="submit" name="submit">
    </form>
    <?php if (isset($_POST['submit'])) :?>
        <p class="sms"><?php print $p; ?></p>
    <?php endif; ?>
</section>
</body>
</html>
