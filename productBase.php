<?php
//"Product database"
$products = [
    ["name" => "Sledgehammer", "price" => 125.75],
    ["name" => "Axe",          "price" => 190.50],
    ["name" => "Bandsaw",      "price" => 562.131],
    ["name" => "Chisel",       "price" => 12.9],
    ["name" => "Hacksaw",      "price" => 18.45],
];

function console_log($output, $with_script_tags = true)
{
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) .
        ');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}


//Dummy function to mimic getting products from "database"
function getProducts()
{
    global $products;
    return $products;
}
