<?php
if ($_POST) {
    $sjUsers = file_get_contents(__DIR__ . '/../data/users.json');
    $jUsers = json_decode($sjUsers);
    if (empty($_POST['loginEmail'])) {
        sendError('Please enter an email');
        exit;
    } else if (empty($_POST['loginPassword'])) {
        sendError('Please enter a password');
        exit;
    } else {
        foreach ($jUsers as $key => $user) {
            if ($user->email == $_POST['loginEmail'] && password_verify($_POST['loginPassword'], $user->password)) {
                $loggedInUser = $key;
                session_start();
                $_SESSION['loggedInUser'] = $key;
                echo '{"status":1}';
                exit;
            }
        }
        sendError('The email or password is not correct');
        exit;
    }
}

function sendError($message)
{
    echo '{"status": 0, "message": "' . $message . '"}';
}
