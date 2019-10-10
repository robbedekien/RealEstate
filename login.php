<?php
require_once(__DIR__ . './components/top.php');
?>
<div class="d-flex justify-content-center">
    <form class="border border-light p-5 w-50 d-block" method="POST" action="javascript:void(0);">
        <p class="h4 mb-4 text-center">Sign in</p>

        <input type="email" id="defaultLoginFormEmail" class="form-control mb-4" placeholder="E-mail" name="loginEmail">
        <input type="password" id="defaultLoginFormPassword" class="form-control mb-4" placeholder="Password" name="loginPassword">
        <p class="error" style="text-align: center;"></p>

        <div class="d-flex justify-content-between">
            <div>
                <p>Not a member?
                    <a href="register">Register</a>
                </p>
            </div>
            <div>
                <a href="">Forgot password?</a>
            </div>
        </div>

        <button class="btn btn-info btn-block my-4" id="btnLogin">Sign in</button>
    </form>
</div>
<?php
require_once(__DIR__ . './components/bottom.php');
?>