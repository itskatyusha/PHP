<?php

function str_to_sql($xml_text, $link_sql){
    // Проверяем, что xml соответствует стандарту
    if (file_exists($xml_text)) {
        // Преобразовываем в SimpleXMLElement
        $xml_salary = simplexml_load_file($xml_text);
        // Проходим по всем record
        foreach ($xml_salary as $xml) {
            $name = (string)$xml -> name;
            $company = (string)$xml -> company;
            $city = (string)$xml -> city;
            $salary = (integer)$xml -> salary;
            // Формируем запрос
            $insert_sql = "INSERT INTO salary_table (name, company, city, salary) VALUES ('$name', '$company', '$city', '$salary')";
            pg_query($link_sql, $insert_sql);
        }
    } else {
        exit('Не удалось открыть файл salary.xml.');
    }
}

