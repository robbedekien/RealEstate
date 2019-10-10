<?php
session_start();
if ($_POST) {
    if (empty($_POST['propertyStreet'])) {
        sendError('Please fill in the street');
        exit;
    } else if (empty($_POST['propertyNumber'])) {
        sendError('Please fill in the number');
        exit;
    } else if (empty($_POST['propertyPostal'])) {
        sendError('Please fill in the postal code');
        exit;
    } else if (empty($_POST['propertyCity'])) {
        sendError('Please fill in the city');
        exit;
    } else if (empty($_POST['propertyPrice'])) {
        sendError('Please fill in the price');
        exit;
    } else if (empty($_POST['propertyBedrooms'])) {
        sendError('Please fill in the amount of bedrooms');
        exit;
    } else if (empty($_POST['propertyBathrooms'])) {
        sendError('Please fill in the amount of bathrooms');
        exit;
    } else if (empty($_POST['propertySize'])) {
        sendError('Please fill in the size');
        exit;
    } else if (empty($_POST['propertyLatitude'])) {
        sendError('Please fill in the latitude');
        exit;
    } else if (empty($_POST['propertyLongtitude'])) {
        sendError('Please fill in the longtitude');
        exit;
    } else if (empty($_FILES['propertyImages']) || $_FILES['propertyImages']['name'][0] == '') {
        sendError('Please select at least one image');
        exit;
    }
    
    $images = [];

    for ($i = 0; $i < count($_FILES['propertyImages']['tmp_name']); $i++) {
        $sTempPathImage = $_FILES['propertyImages']['tmp_name'][$i];
        $sUniqueImageName = uniqid();
        $path = $_FILES['propertyImages']['name'][$i];
        $fileExtention = pathinfo($path, PATHINFO_EXTENSION);
        move_uploaded_file(
            $sTempPathImage,
            __DIR__ . "/../assets/images/$sUniqueImageName.$fileExtention"
        );
        array_push($images, $sUniqueImageName .'.'. $fileExtention);
    }

    $sproperties = file_get_contents(__DIR__ . '/../data/properties.json');
    $properties = json_decode($sproperties);
    $uniqId = uniqid();
    $properties->$uniqId = new stdClass();
    $properties->$uniqId->street = $_POST['propertyStreet'];
    $properties->$uniqId->number = $_POST['propertyNumber'];
    $properties->$uniqId->postal = $_POST['propertyPostal'];
    $properties->$uniqId->city = $_POST['propertyCity'];
    $properties->$uniqId->price = $_POST['propertyPrice'];
    $properties->$uniqId->bedrooms = $_POST['propertyBedrooms'];
    $properties->$uniqId->bathrooms = $_POST['propertyBathrooms'];
    $properties->$uniqId->size = $_POST['propertySize'];
    $properties->$uniqId->latitude = $_POST['propertyLatitude'];
    $properties->$uniqId->longtitude = $_POST['propertyLongtitude'];
    $properties->$uniqId->poster = $_SESSION['loggedInUser'];
    $properties->$uniqId->images = $images;

    $sproperties = json_encode($properties, JSON_PRETTY_PRINT);
    file_put_contents(__DIR__ . '/../data/properties.json', $sproperties);
    echo '{"status": 1}';
}

function sendError($message)
{
    echo '{"status": 0, "message": "' . $message . '"}';
}
