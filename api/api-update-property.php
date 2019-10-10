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
    }

    $sproperties = file_get_contents(__DIR__ . '/../data/properties.json');
    $properties = json_decode($sproperties);
    $propertyId = $_POST['propertyId'];
    $property = $properties->$propertyId;

    if (!(empty($_FILES['propertyImages']) || $_FILES['propertyImages']['name'][0] == '')) {
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
            array_push($images, $sUniqueImageName . '.' . $fileExtention);
        }
        $property->images = $images;
    }

    $property->street = $_POST['propertyStreet'];
    $property->number = $_POST['propertyNumber'];
    $property->postal = $_POST['propertyPostal'];
    $property->city = $_POST['propertyCity'];
    $property->price = $_POST['propertyPrice'];
    $property->bedrooms = $_POST['propertyBedrooms'];
    $property->bathrooms = $_POST['propertyBathrooms'];
    $property->size = $_POST['propertySize'];
    $property->latitude = $_POST['propertyLatitude'];
    $property->longtitude = $_POST['propertyLongtitude'];

    $sproperties = json_encode($properties, JSON_PRETTY_PRINT);
    file_put_contents(__DIR__ . '/../data/properties.json', $sproperties);
    echo '{"status": 1}';
}

function sendError($message)
{
    echo '{"status": 0, "message": "' . $message . '"}';
}
