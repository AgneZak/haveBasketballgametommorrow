<?php
require 'functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>About</title>
</head>
<body class="about">
<?php require 'navigation.php';?>
<main>
    <?php foreach ($match['teams'] as $team): ?>
        <section class="team-info">
            <div>
                <h2><?php print $team['name']; ?></h2>
                <h3>Coach: <?php print $team['coach']; ?></h3>
                <img src="https://st4.depositphotos.com/7738644/26690/v/600/depositphotos_266903480-stock-video-funny-male-sports-coach-with.jpg" alt="coach">
            </div>
            <?php foreach ($team['players'] as $player): ?>
            <div>
                <h4>Player: <?php print $player['name'] . ' ' . $player['surname']; ?></h4>
                <p>Age:<?php print $player['age'];?></p>
                <p>Height:<?php print $player['height']; ?></p>
                <p>Position:<?php print $player['position']; ?></p>
                <p>Number:<?php print $player['shirt_number']; ?></p>
            </div>
            <?php endforeach; ?>
        </section>
    <?php endforeach; ?>
</main>
</body>
</html>