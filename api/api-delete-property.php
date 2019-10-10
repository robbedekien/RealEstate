<?php
session_start();
if ($_POST) {
    $sproperties = file_get_contents(__DIR__ . '/../data/properties.json');
    $properties = json_decode($sproperties);
    $propertyId = $_POST['id'];

    $property = $properties->$propertyId;
    if($property->poster == $_SESSION['loggedInUser'])
    {
        unset($properties->$propertyId);
    } else {
        sendError('User not logged in');
    }   
    
    $sproperties = json_encode($properties, JSON_PRETTY_PRINT);
    file_put_contents(__DIR__ . '/../data/properties.json', $sproperties);
    echo '{"status": 1}';
}

function sendError($message)
{
    echo '{"status": 0, "message": "' . $message . '"}';
}
