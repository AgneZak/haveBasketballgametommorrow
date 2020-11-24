<?php
require 'constants.php';

function rand_array_value($array)
{
    $max = count($array) - 1;
    return $array[rand(0, $max)];
}

function generate_player()
{
    return [
        'name' => rand_array_value(NAMES),
        'surname' => rand_array_value(SURNAMES),
        'age' => rand(18, 36),
        'height' => rand(175, 230),
        'position' => rand_array_value(POSITION_TYPES)
    ];
}

function generate_team()
{
    $team = [
        'name' => ucfirst(rand_array_value(TEAM_ADJECTIVES)) . ' ' . ucfirst(rand_array_value(TEAM_NOUNS)),
        'coach' => rand_array_value(NAMES) . ' ' . rand_array_value(SURNAMES),
        'team_logo' => rand(1, 120),
        'players' => [

        ]
    ];
    for ($i = 0; $i <= rand(7, 12); $i++) {
        $team['players'][] = generate_player();
    }

    foreach ($team['players'] as &$player) {
        $shirts = generate_rand_num_arr(count($team['players']));
        foreach ($shirts as $shirt_number) {
            $player['shirt_number'] = $shirt_number;

        }
    }

    return $team;
}

function generate_rand_num_arr($count)
{
    $numbers = range(1, 100);
    shuffle($numbers);
    return array_slice($numbers, 0, $count);
}

function generate_rand_date($start_date, $end_date)
{
    $time = rand(strtotime($start_date), strtotime($end_date));
    return date("Y-m-d", $time);
}

function generate_rand_time()
{
    $time = rand(strtotime('18:00'), strtotime('22:30'));
    return date('H:i', ceil($time / (30 * 60)) * (30 * 60));
}

function generate_score()
{
    $one_score = rand(50, 160);
    $scnd_score = rand(50, 160);
    return $one_score . ':' . $scnd_score;
}

function generate_match()
{
    $match = [
        'date' => $date = generate_rand_date('2020-10-11', '2020-12-01'),
        'time' => generate_rand_time(),
        'location' => rand_array_value(LOCATIONS),
        'teams' => [],
        'result' => $date <= (date("Y-m-d")) ? generate_score() : '0:0'

    ];
    for ($i = 0; $i < 2; $i++) {
        $match['teams'][] = generate_team();
    }
    return $match;
}

$match = generate_match();

function teams_scores($score)
{
    $scores = [];

    $scores[] = substr($score, 0, strrpos($score, ":"));
    $scores[] = substr($score, strrpos($score, ":") + 1);

    return $scores;

}

teams_scores($match['result']);

function generate_teams($number)
{
    for ($i = 0; $i < $number; $i++) {
        $teams[] = generate_team();
    }

    return $teams;
}

function one_team_player_count($team)
{
    return count($team['players']);
}

function all_teams_player_count($teams)
{
    $count = 0;
    foreach ($teams as $team) {
        $count += one_team_player_count($team);
    }
    return $count;
}

function average_players_per_team($teams)
{
    return round(all_teams_player_count($teams) / count($teams));
}

function filter_teams_by_player_count($teams, $count)
{
    $by_count = [];

    foreach ($teams as $team) {
        if (one_team_player_count($team) === $count) {
            $by_count[] = $team;
        }
    }

    return $by_count;
}

function count_players_by_position(array $team, $position)
{
    $players_count = 0;
    foreach ($team['players'] as $player) {
        if ($player['position'] === $position) {
            $players_count++;
        }
    }
    return $players_count;
}

function return_players_by_position(array $team, $position)
{
    $position_players = [];

    foreach ($team['players'] as $player) {
        if ($player['position'] === $position) {
            $position_players[] = $player['name'] . ' ' . $player['surname'];
        }
    }

    return $position_players;
}

function filters_teams_by_position_count($teams, $count, $position)
{
    $teams_by_position_count = [];
    foreach ($teams as $team) {
        if (count_players_by_position($team, $position) === $count) {
            $teams_by_position_count[] = $team;
        }
    }

    return $teams_by_position_count;
}

function count_position_players($teams, $position)
{

    $teams_by_position_count = 0;
    foreach ($teams as $team) {
        $teams_by_position_count += count_players_by_position($team, $position);
    }

    return $teams_by_position_count;
}

function array_position_count($teams)
{
    $positions = [];
    foreach (POSITION_TYPES as $position) {
        $positions[$position] = count_position_players($teams, $position);
    }

    return $positions;
}

function max_position_count($array_position_count)
{
    return array_search(max($array_position_count), $array_position_count);
}

function sort_team_by_player_height($a, $b)
{
    if ($a['height'] === $b['height']) {
        return 0;
    }

    return ($a['height'] < $b['height']) ? -1 : 1;
}

function sort_teams_by_players_count($a, $b)
{
    if (one_team_player_count($a) === one_team_player_count($b)) {
        return 0;
    }

    return (one_team_player_count($a) < one_team_player_count($b)) ? 1 : -1;
}

function generate_matches($count): array
{
    $matches = [];
    for ($i = 0; $i < $count; $i++) {
        $matches[] = generate_match();
    }

    return $matches;
}

function first_match_happened($matches): string
{
    $dates_array = [];

    foreach ($matches as $match) {
        $dates_array[] = $match['date'];
    }

    return min($dates_array);
}

function last_match_happened($matches): string
{
    $dates_array = [];

    foreach ($matches as $match) {
        $dates_array[] = $match['date'];
    }

    return max($dates_array);
}

function filter_past_matches($matches)
{
    foreach ($matches as $match) {
        if ($match['result'] !== '0:0') {
            $past_matches [] = $match;
        }
    }
    return $past_matches;
}

function assign_scores_to_players(&$match)
{
    $scores = teams_scores($match['result']);

    foreach ($scores as $key => $score) {
        for ($i = 0; $i < $score; $i++) {

            $player = &$match['teams'][$key]['players'][rand(0, count($match['teams'][$key]['players']) - 1)];

            if (isset($player['points'])) {
                $player['points'] += 1;
            } else {
                $player['points'] = 1;
            }
        }
    }
}

function generate_scoreboard_array($matches)
{
    $scoreboard_array = [];

    foreach ($matches['teams'] as $key => $match) {
        $scoreboard_array[$key]['name'] = $match['name'];

        foreach ($match['players'] as &$player) {
            unset($player['age'], $player['height'], $player['position'], $player['shirt_number']);
        }

        $scoreboard_array[$key]['players'] = $match['players'];
    }

    return $scoreboard_array;
}



function form_position_players_array($team){
    foreach (POSITION_TYPES as $position) {
        $array[$position] = return_players_by_position($team, $position);
    }

    return $array;
}


function highest_player($players): string
{
    $players_height = [];

    foreach ($players as $player) {
        $players_height[] = $player['height'];
    }

    return max($players_height);
}

function count_teams($matches){
    $count = 0;
    foreach ($matches as $match){
        $count += 2;
    }

    return $count;
}