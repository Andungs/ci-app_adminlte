<div class="limiter">
    <div class="container-login100" style="background-image: url('<?= base_url('assets/Login_v4/') ?>images/bg-01.jpg');">
        <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
            <form class="login100-form validate-form" method="POST" action="<?= base_url('auth') ?>">
                <span class="login100-form-title p-b-49">
                    Login
                </span>
                <?= $this->session->flashdata('flash');
                ?>
                <div class="wrap-input100 validate-input m-b-23" data-validate="Username is reauired">
                    <span class="label-input100">Email</span>
                    <input class="input100" type="text" id="email" name="email" placeholder="Enter Your Email" value="<?= set_value('email') ?>">
                    <span class="focus-input100" data-symbol="&#xf206;"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Password is required">
                    <span class="label-input100">Password</span>
                    <input class="input100" type="password" name="password" placeholder="Enter Your Password">
                    <span class="focus-input100" data-symbol="&#xf190;"></span>
                </div>

                <div class="text-right p-t-8 p-b-31">
                    <a href="<?= base_url('auth/forgotPassword') ?>">
                        Forgot password?
                    </a>
                </div>

                <div class="container-login100-form-btn">
                    <div class="wrap-login100-form-btn">
                        <div class="login100-form-bgbtn"></div>
                        <button class="login100-form-btn " type="submit">
                            Login
                        </button>
                    </div>
                </div>

                <div class="flex-col-c p-t-15">
                    <span class="txt1 p-b-17">
                        Or Sign Up Using
                    </span>

                    <a href="<?= base_url('auth/registration') ?>" class="txt2">
                        Sign Up
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>