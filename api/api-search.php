<?php
if ($_POST) {
    $value = $_POST['searchValue'];
    $value = strtolower($value);
    $sproperties = file_get_contents(__DIR__ . '/../data/properties.json');
    $properties = json_decode($sproperties);
    $resultProperties = [];
    if ($value == null) {
        foreach ($properties as $key => $property) {
            array_push($resultProperties, $key);
        }
        echo json_encode($resultProperties, JSON_PRETTY_PRINT);
        exit;
    }
    foreach ($properties as $key => $property) {
        if (strpos(strtolower($property->street), $value) !== false || strpos(strtolower($property->city), $value) !== false || strpos(strtolower($property->postal), $value) !== false) {
            array_push($resultProperties, $key);
        }
    }
    echo json_encode($resultProperties, JSON_PRETTY_PRINT);
}
