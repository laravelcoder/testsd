<?php

header('Content-Type: application/json');
// error_reporting(E_ALL);
// ini_set("display_errors", 0);

if (!function_exists('dd')) {
    function dd()
    {
        echo '<pre>';
        array_map(function ($x) {
            var_dump($x);
        }, func_get_args());
        die;
    }
}

// $file = fopen("tax.txt", "r");
// $i = 0;
// while (!feof($file)) {

// $line_of_text = fgets($file);
// $members = explode('\n', $line_of_text);
// fclose($file);

// $txt_file    = file_get_contents('tax.txt');

// $rows = explode("\n", $txt_file);
// $tmp = [];
// foreach($rows as $row => $data)
// {
// 	if ($data != "")
// 	{
// 		$tmp[] = $data;
// 	}
// }
// $rows = $tmp;

// print json_encode($rows);

// $row_data = explode('>', $txt_file);

// $json = json_encode ( $tmp, JSON_FORCE_OBJECT | JSON_PRETTY_PRINT );
// $json = json_encode ( $tmp, JSON_PRETTY_PRINT );
// print_r ( $json );

// dd($rows);

// $input = new Input();

// print jason_encode($rows);

// $array = explode("\n", file_get_contents('tax.txt'));

// dd($array);

$lines = file_get_contents('tax.txt');

foreach ($lines as $line) {
    $parts = explode('>', $line); // decompose a line into individual sections
    $cat = mysql_real_escape_string(trim($parts[0])); // prepare sections for SQL
    $subcat = mysql_real_escape_string(trim($parts[1]));
    $subsubcat = mysql_real_escape_string(trim($parts[2]));
}

// dd($lines);

$json = json_encode($tmp, JSON_PRETTY_PRINT);
 print_r($json);
