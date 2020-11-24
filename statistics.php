<?php
require 'functions.php';
$matches = generate_matches(5);
$past_matches = filter_past_matches($matches);
foreach ($past_matches as $key => $value) {
    assign_scores_to_players($past_matches[$key]);
}
$count_all_teams_players = 0;
$max_position = [];
foreach ($matches as $teams) {
    $count_all_teams_players += all_teams_player_count($teams['teams']);
    $average = average_players_per_team($teams['teams']);
    $max_position[] = max_position_count(array_position_count($teams['teams']));
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Statistics</title>
</head>
<body>
<header>
    <?php require 'navigation.php'; ?>
    <nav>
        <ul>
            <li><a href="#komandos">Komandos</a></li>
            <li><a href="#rungtynes">Rungtynes</a></li>
            <li><a href="#taskai">Tasku lenteles</a></li>
            <li><a href="#info">Bendra info</a></li>
        </ul>
    </nav>
</header>
<main>
    <section class="team-statistics">
        <h2 id="komandos">Komandos</h2>
        <?php foreach ($matches as $match): ?>
            <?php foreach ($match['teams'] as $team): ?>
                <div class="border">
                    <h3><?php print $team['name']; ?></h3>
                    <h4><?php print $team['coach']; ?></h4>
                    <p>Zaideju komadoje: <?php print one_team_player_count($team); ?></p>
                    <p>Pozicijose</p>
                    <?php foreach (form_position_players_array($team) as $position_key => $position_player): ?>
                        <?php foreach ($position_player as $player): ?>
                            <p><?php print $position_key . ' - ' . $player; ?></p>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                    <p>Auksciausias zaidejas <?php print highest_player($team['players']); ?></p>
                </div>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </section>
    <section class="team-matches">
        <h2 id="rungtynes">Rungtynes</h2>
        <?php foreach ($matches as $match): ?>
            <div class="border">
                <?php foreach ($match['teams'] as $team): ?>
                    <h3>Komanda: <?php print $team['name']; ?></h3>
                <?php endforeach; ?>
                <?php if ($match['result'] !== '0:0'): ?>
                    <p>Rezultatas <?php print $match['result']; ?></p>
                <?php else: ?>
                    <p>Zaidimas vyks <?php print $match['date']; ?></p>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </section>
    <section class="team-matches">
        <h2 id="taskai">Tasku lenteles</h2>
        <?php foreach ($past_matches as $match): ?>
            <div class="border table-head">
                <?php foreach ($match['teams'] as $team): ?>
                    <h3>Team: <?php print $team['name']; ?></h3>
                <?php endforeach; ?>
                <div>
                    <p>Rezultatas <?php print $match['result']; ?></p>
                    <p>Zaidimas vyko <?php print $match['date']; ?></p>
                </div>
            </div>
            <div class="tables">
                <?php foreach ($match['teams'] as $team): ?>
                    <table class="border">
                        <tr>
                            <th class="border">Team name:</th>
                            <th class="border"><?php print $team['name']; ?></th>
                        </tr>
                        <tr>
                            <th class="border">Points:</th>
                            <th class="border">Player name</th>
                        </tr>
                        <?php foreach ($team['players'] as $player): ?>
                            <tr>
                                <th class="border"><?php print $player['name'] . ' ' . $player['surname']; ?></th>
                                <th class="border"><?php print $player['points']; ?></th>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </section>
    <section class="team-info">
        <h2 id="info">Bendra informacija</h2>
        <div>
            <p>Is viso komandu zaidzia <?php print count_teams($matches); ?></p>
            <p>Is viso zaidzia zaideju <?php print $count_all_teams_players; ?></p>
            <p>Vidutinis zaideju skaicius <?php print $average; ?></p>
            <p>Zaidzia daugiausiai zaideju pozicijoje <?php print max($max_position); ?></p>
            <p>Vyks rungtyniu <?php print count($matches); ?></p>
            <p>Pirmos rungtynes ivyko <?php print first_match_happened($matches); ?></p>
            <p>Pakutines rungtynes ivyko <?php print last_match_happened($matches); ?></p>
        </div
    </section>
</main>
</body>
</html>
