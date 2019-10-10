<?php
if ($_GET) {
    $sjUsers = file_get_contents(__DIR__ . './data/users.json');
    $jUsers = json_decode($sjUsers);
    $userId = $_GET['id'];
    $jUsers->$userId->validated = 1;
    $sjUsers = json_encode($jUsers, JSON_PRETTY_PRINT);
    file_put_contents(__DIR__ . './data/users.json', $sjUsers);
    session_start();
    $_SESSION['loggedInUser'] = $userId;
}
require_once(__DIR__ . './components/top.php');
?>

<div style="text-align: center;">
    <h1>Validation Succesfull!</h1>
    <a href="index"><button class="btn btn-info">Return home</button></a>
</div>


<?php
require_once(__DIR__ . './components/bottom.php');
?>