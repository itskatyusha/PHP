<?php

function from_db($result)
{
    $table = array();
    while ($row = pg_fetch_array($result, null,PGSQL_ASSOC)) {
        $table[] = $row;
}
$json_data = json_encode($table,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_NUMERIC_CHECK);
file_put_contents('salary.json', $json_data);
}