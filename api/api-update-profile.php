<?php
session_start();
if ($_POST && $_SESSION) {
    $userKey = $_SESSION['loggedInUser'];
    $sjUsers = file_get_contents(__DIR__ . '/../data/users.json');
    $jUsers = json_decode($sjUsers);
    if (empty($_POST['profileFirstName'])) {
        sendError('Please enter a first name');
        exit;
    } else if (empty($_POST['profileName'])) {
        sendError('Please enter a name');
        exit;
    } else if (empty($_POST['profileEmail'])) {
        sendError('Please enter an email');
        exit;
    } else if (empty($_POST['profileRole'])) {
        sendError('Please enter a Role');
        exit;
    } else if (empty($_POST['profilePhoneNumber'])) {
        sendError('Please enter a phone number');
        exit;
    }
    $jUsers->$userKey->firstName = $_POST['profileFirstName'];
    $jUsers->$userKey->name = $_POST['profileName'];
    $jUsers->$userKey->email = $_POST['profileEmail'];
    $jUsers->$userKey->role = $_POST['profileRole'];
    $jUsers->$userKey->phone = $_POST['profilePhoneNumber'];
    $sjUsers = json_encode($jUsers, JSON_PRETTY_PRINT);
    file_put_contents(__DIR__ . '/../data/users.json', $sjUsers);
    echo '{"status": 1}';
}

function sendError($message)
{
    echo '{"status": 0, "message": "' . $message . '"}';
}
