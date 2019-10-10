<?php
session_start();
if ($_SESSION) {
    $userKey = $_SESSION['loggedInUser'];
    $sjUsers = file_get_contents(__DIR__ . '/../data/users.json');
    $jUsers = json_decode($sjUsers);
    $sproperties = file_get_contents(__DIR__ . '/../data/properties.json');
    $properties = json_decode($sproperties);
    
    unset($jUsers->$userKey);
    session_destroy();

    foreach($properties as $key => $property)
    {
        if($property->poster == $userKey)
        {
            unset($properties->$key);
        }
    }

    $sjUsers = json_encode($jUsers, JSON_PRETTY_PRINT);
    file_put_contents(__DIR__ . '/../data/users.json', $sjUsers);
    $sproperties = json_encode($properties, JSON_PRETTY_PRINT);
    file_put_contents(__DIR__ . '/../data/properties.json', $sproperties);
    echo '{"status": 1}';
}

function sendError($message)
{
    echo '{"status": 0, "message": "' . $message . '"}';
}
