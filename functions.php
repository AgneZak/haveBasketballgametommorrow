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
        'team_logo' => rand( 1, 120 ),
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
    return $one_score. ':' . $scnd_score;
}

function generate_match(){
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

function teams_scores($score){
    $scores = [];

    $scores['team1_score'] = substr($score, 0, strrpos($score, ":"));
    $scores['team2_score'] = substr($score, strrpos($score, ":")+1);

    return $scores;

}
teams_scores($match['result']);