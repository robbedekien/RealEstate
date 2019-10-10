<?php
require_once(__DIR__ . './components/top.php');
?>

<div class="d-flex justify-content-center" style="height: calc(100vh - 60px);">
    <form class="border border-light p-5 w-50 d-block" method="POST" action="javascript:void(0);" id="registerForm">
        <p class="h4 mb-4 text-center">Register</p>
        <div class="d-flex">
            <div class="w-50 mr-2 mb-2">
                <input type="text" id="registerFirstName" class="form-control mb-1" placeholder="First name" name="registerFirstName">
            </div>
            <div class="w-50 ml-2 mb-2">
                <input type="text" id="registerName" class="form-control mb-1" placeholder="Name" name="registerName">
            </div>
        </div>
        <div>
            <input type="email" id="registerFormEmail" class="form-control mb-2" placeholder="E-mail" name="registerEmail">
        </div>
        <div class="d-flex">
            <div class="w-50 mr-2 mb-2">
                <select name="registerRole" id="registerFormRole" class="browser-default custom-select">
                    <option selected disabled>Please select a role</option>
                    <option value="user">User</option>
                    <option value="agent">Agent</option>
                </select>
            </div>
            <div class="w-50 ml-2 mb-2">
                <input type="number" id="registerFormPhoneNumber" class="form-control mb-1" placeholder="Phone number" name="registerPhoneNumber">
            </div>
        </div>
        <div>
            <div class="d-flex">
                <input type="password" id="registerFormPassword" class="form-control mb-1 mr-2" placeholder="Password" name="registerPassword">
                <input type="password" id="registerFormPasswordConfirmation" class="form-control mb-1 ml-2" placeholder="Password Confirmation" name="registerPasswordConfirmation">
            </div>
        </div>
        <div style="text-align: center">
            <p class="error"></p>
        </div>
        <button class="btn btn-info btn-block my-4" id="btnRegister">Register</button>
    </form>
    <div id="validateDiv" class="disabled" style="display: grid; justify-content: center; align-items: center;">
        <div class="text-center">
            <h4>A validation email has been sent</h4>
            <h5>Please check your inbox</h5>
        </div>
    </div>
</div>

<?php
require_once(__DIR__ . './components/bottom.php');
?>