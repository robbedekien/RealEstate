<?php
require_once(__DIR__ . './components/top.php');
if ($_SESSION) {
    $agentSelected = 0;
    $userSelected = 0;
    $sjUsers = file_get_contents(__DIR__ . './data/users.json');
    $jUsers = json_decode($sjUsers);
    $loggedInUser = $_SESSION['loggedInUser'];
    $user = $jUsers->$loggedInUser;
    if ($user->role == 'agent') {
        $agentSelected = 1;
    } else {
        $userSelected = 1;
    }
} else {
    header('Location: login');
}
?>
<div class="alert alert-success w-75 m-auto disabled" style="text-align: center;" id="updateBanner" role="alert">
    Profile updated succesfuly!
</div>
<div class="d-flex justify-content-center">

    <form class="border border-light p-5 w-50 d-block" method="POST" action="javascript:void(0);" id="profileForm">
        <p class="h4 mb-4 text-center">Profile</p>
        <div class="d-flex">
            <div class="w-50 mr-2 mb-2">
                <input type="text" id="profileFirstName" class="form-control mb-1" placeholder="First name" value="<?= $user->firstName ?>" name="profileFirstName">
            </div>
            <div class="w-50 ml-2 mb-2">
                <input type="text" id="profileName" class="form-control mb-1" placeholder="Name" value="<?= $user->name ?>" name="profileName">
            </div>
        </div>
        <div>
            <input type="email" id="profileFormEmail" class="form-control mb-2" placeholder="Email" value="<?= $user->email ?>" name="profileEmail">
        </div>
        <div class="d-flex">
            <div class="w-50 mr-2 mb-2">
                <select name="profileRole" id="profileFormRole" class="browser-default custom-select">
                    <option value="user" <?php if ($userSelected == 1) {
                                                echo 'selected';
                                            } else echo ''; ?>>User</option>
                    <option value="agent" <?php if ($agentSelected == 1) {
                                                echo 'selected';
                                            } else echo ''; ?>>Agent</option>
                </select>
            </div>
            <div class="w-50 ml-2 mb-2">
                <input type="number" id="profileFormPhoneNumber" class="form-control mb-1" placeholder="Phone number" value="<?= $user->phone ?>" name="profilePhoneNumber">
            </div>
        </div>
        <div style="text-align: center">
            <p class="error"></p>
        </div>
        <button class="btn btn-info btn-block my-4" id="btnProfile">Update</button>
    </form>
</div>

<?php
require_once(__DIR__ . './components/bottom.php');
?>