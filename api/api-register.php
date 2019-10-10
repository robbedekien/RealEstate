<?php
if ($_POST) {
    $sjUsers = file_get_contents(__DIR__ . '/../data/users.json');
    $jUsers = json_decode($sjUsers);
    if (empty($_POST['registerFirstName'])) {
        sendError('Please enter a first name');
        exit;
    } else if (empty($_POST['registerName'])) {
        sendError('Please enter a name');
        exit;
    } else if (empty($_POST['registerEmail'])) {
        sendError('Please enter an email');
        exit;
    } else if (empty($_POST['registerRole'])) {
        sendError('Please enter a Role');
        exit;
    } else if (empty($_POST['registerPhoneNumber'])) {
        sendError('Please enter a phone number');
        exit;
    } else if (empty($_POST['registerPassword'])) {
        sendError('Please enter a password');
        exit;
    }
    foreach ($jUsers as $user) {
        if ($user->email == $_POST['registerEmail']) {
            sendError('Email already exists');
            exit;
        }
    }
    if (!preg_match('/(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/', $_POST['registerPassword'])) {
        sendError('Password must contain at least one uppercase and one number');
        exit;
    }
    if (!($_POST['registerPassword'] == $_POST['registerPasswordConfirmation'])) {
        sendError('Passwords are not the same');
        exit;
    }
    
    $uniqId = uniqid();
    $jUsers->$uniqId = new stdClass();
    $jUsers->$uniqId->firstName = $_POST['registerFirstName'];
    $jUsers->$uniqId->name = $_POST['registerName'];
    $jUsers->$uniqId->email = $_POST['registerEmail'];
    $jUsers->$uniqId->phone = $_POST['registerPhoneNumber'];
    $jUsers->$uniqId->role = $_POST['registerRole'];
    $jUsers->$uniqId->validated = 0;

    $jUsers->$uniqId->password = password_hash($_POST['registerPassword'], PASSWORD_DEFAULT);
    $sjUsers = json_encode($jUsers, JSON_PRETTY_PRINT);
    file_put_contents(__DIR__ . '/../data/users.json', $sjUsers);
    echo '{"status": 1, "message": "'.$uniqId.'"}';
}

function sendError($message){
    echo '{"status": 0, "message": "'.$message.'"}';
}
