<?php

$files_ans = glob("A/*ans");
$files_dat = glob("A/*dat");

$arr_ans = array();
$arr_input = array();
$numb = 0;

if (is_array($files_ans)) {
    foreach ($files_ans as $filename) {
        $ans_file = file($filename);
        array_push($arr_ans, $ans_file);
    }
}

if (is_array($files_dat)) {
    foreach ($files_dat as $filename) {
        $numb++;
        $dat_input = file($filename);
        array_push($arr_input, $dat_input);
    }
}
$end = $arr_input[0][0];
for ($i = 0; $i < $numb; ++$i) {
    $sum_all = 0;
    $sum_win = 0;
    for ($j = 0; $j < $end; ++$j) {
        $a_co = 0;
        $co = 0;
        $first = $arr_input[$i][$j];

        $a_rates = $arr_input[$i][$j+1];
        $a_rates = explode(" ", trim($a_rates));
        $num_elem_rates = count($arr_input[$i]);
        $start_games = $end + 2;


        for ($start_games; $start_games <= $num_elem_rates; ++$start_games) {
            $a_games = $arr_input[$i][$start_games];
            $a_games = explode(" ", trim($a_games));
            if ($a_rates[0] == $a_games[0]) {
                $a_co = $arr_input[$i][$start_games];
                $a_co = explode(" ", trim($a_co));
                break;
            }
        }
        $last = end($a_co);
        if ($last == "L") {
            $co = $a_co[1];
        } elseif ($last == "R") {
            $co = $a_co[2];
        } elseif ($last == "D") {
            $co = $a_co[3];
        }
        if (end($a_rates) == end($a_co)) {
            $sum_all += $a_rates[1];
            $sum_win += $a_rates[1] * $co;
        } else {
            $sum_all += $a_rates[1];
        }
    }
    $sum_all = $sum_win - $sum_all;
    $num_test = $i + 1;
    if ($sum_all == $arr_ans[$i][0]) {
        print ("Test $num_test : OK\n");
    } else {
        print("Test $num_test : NOT OK\n");
    }
    $end = $arr_input[$i+1][0];
}
