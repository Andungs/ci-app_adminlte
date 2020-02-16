<div class="limiter">
    <div class="container-login100" style="background-image: url('<?= base_url('assets/Login_v4/') ?>images/bg-01.jpg');">
        <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
            <form class="login100-form validate-form" method="POST" action="<?= base_url('auth/forgotPassword') ?>">
                <span class="login100-form-title p-b-49">
                    Forgot Password
                </span>
                <?= $this->session->flashdata('flash');
                ?>
                <div class="wrap-input100 validate-input m-b-23" data-validate="Username is reauired">
                    <span class="label-input100">Email</span>
                    <input class="input100" type="text" id="email" name="findemail" placeholder="Enter Your Email">
                    <span class="focus-input100" data-symbol="&#xf206;"></span>
                </div>

                <div class="container-login100-form-btn">
                    <div class="wrap-login100-form-btn">
                        <div class="login100-form-bgbtn"></div>
                        <button class="login100-form-btn " type="submit">
                            Reset Password
                        </button>
                    </div>
                </div>

                <div class="flex-col-c p-t-15">
                    <span class="txt1 p-b-17">
                        Back to Login
                    </span>

                    <a href="<?= base_url('auth') ?>" class="txt2">
                        Login
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>