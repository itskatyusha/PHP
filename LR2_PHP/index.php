<?php

require_once 'to_db.php';
require_once 'from_db.php';

$salary_xml = 'salary.xml';

$db_connect = pg_connect("host=127.0.0.1 port=5432 dbname=lr2 user=postgres password=");
// Проверяем, что подключились к БД 
if ((@$link_sql = $db_connect))
{
	/* Парсинг xml-файла
	и сохранение его информации в базу данных */
    str_to_sql($salary_xml, $link_sql);
}

/* Считываем сохранённые данные из базы данных
и генерируем на их основе JSON-файл */
$result = pg_query("SELECT * FROM salary_table");
from_db($result);





