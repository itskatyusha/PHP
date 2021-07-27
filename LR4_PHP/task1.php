<?php

fwrite(STDOUT, "Enter expression: ");
$expr = trim(fgets(STDIN));

// изменение значения в кавычках
function func_expr($mark)
{
    $chosen_expr  = array($mark[1], $mark[2]*2, $mark[3]);
    $new_mark = implode("", $chosen_expr);
    return $new_mark;
}

// замена значения в кавычках с использованием функции
$new_expr = preg_replace_callback("/(')(\d+)(')/", 'func_expr', $expr);

fwrite(STDOUT, "Transformed expression: $new_expr" . PHP_EOL);
