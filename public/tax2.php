<?php

// Define recursive function to extract nested values
function printValues($arr)
{
    global $count;
    global $values;

    // Check input is an array
    if (!is_array($arr)) {
        die('ERROR: Input is not an array');
    }

    // $arr = explode('>', $txt_file);

    /*
    Loop through array, if value is itself an array recursively call the
    function else add the value found to the output items array,
    and increment counter by 1 for each value found
    */
    foreach ($arr as $key=>$value) {
        if (is_array($value)) {
            printValues($value);
        } else {
            $values[] = $value;
            $count++;
        }
    }

    // Return total count and values found in array
    return ['total' => $count, 'values' => $values];
}

$txt_file = file_get_contents('tax.txt');
$rows = explode("\n", $txt_file);
$tmp = [];
foreach ($rows as $row => $data) {
    if ($data != '') {
        $tmp[] = $data;
    }
}
$rows = $tmp;

$arr = $tmp;
// $json =  json_encode($rows);

 // echo $arr;

// // Decode JSON data into PHP associative array format
// $arr = json_decode($json, true);

// // Call the function and print all the values
$result = printValues($arr);
echo '<h3>'.$result['total'].' value(s) found: </h3>';
echo implode('<br>', $result['values']);

echo '<hr>';

// Print a single value
echo $arr['book']['author'].'<br>';  // Output: J. K. Rowling
echo $arr['book']['characters'][0].'<br>';  // Output: Harry Potter
echo $arr['book']['price']['hardcover'].'<br>';  // Output: $20.32
