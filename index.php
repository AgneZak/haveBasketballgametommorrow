<?php
require 'functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Konsultacijos</title>
</head>
<body>
<?php require 'navigation.php';?>
    <section class="banner">
        <div class="date-info">
            <p><?php print $match['date']; ?></p>
            <p><?php print $match['time']; ?></p>
            <p><?php print $match['location']; ?></p>
        </div>
        <h2 class="index-h2">TEAMS</h2>
            <div class="back">
            </div>
        <div class="teams">
            <?php foreach ($match['teams'] as $team): ?>
                <div class="team">
                <p class="team-p"><?php print $team['name']; ?></p>
                <img class="team-logo" src="/logos/img-<?php print $team['team_logo'] ;?>.svg" alt="">
                </div>
            <?php endforeach; ?>
        </div>
        <p class="score"><?php print $match['result']; ?></p>
    </section>
</body>
</html>