<div class="limiter">
    <div class="container-login100" style="background-image: url('<?= base_url('assets/Login_v4/') ?>images/bg-01.jpg');">
        <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
            <form class="login100-form validate-form" method="POST" action="<?= base_url('auth/registration') ?>">
                <span class="login100-form-title p-b-49">
                    Sign Up Account
                </span>
                <?= $this->session->flashdata('flash');
                ?>
                <div class="wrap-input100 validate-input m-b-23" data-validate="Username is reauired">
                    <span class="label-input100">FullName</span>
                    <input class="input100" type="text" id="name" name="name" placeholder="Enter Your Email" value="<?= set_value('name') ?>">
                    <span class="focus-input100" data-symbol="&#xf206;"></span>
                </div>
                <div class="wrap-input100 validate-input m-b-23" data-validate="email is reauired">
                    <span class="label-input100">Email</span>
                    <input class="input100" type="text" id="email" name="email" placeholder="Enter Your Email" value="<?= set_value('email') ?>">
                    <span class="focus-input100" data-symbol="&#xf206;"></span>
                </div>

                <div class="wrap-input100 validate-input m-b-23" data-validate="Password is required">
                    <span class="label-input100">Password</span>
                    <input class="input100" type="password" name="password1" placeholder="Enter Your Password">
                    <span class="focus-input100" data-symbol="&#xf190;"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Password is required">
                    <span class="label-input100">Repeat Password</span>
                    <input class="input100" type="password" name="password2" placeholder="Enter Your Password">
                    <span class="focus-input100" data-symbol="&#xf190;"></span>
                </div>

                <div class="container-login100-form-btn p-t-32">
                    <div class="wrap-login100-form-btn">
                        <div class="login100-form-bgbtn"></div>
                        <button class="login100-form-btn " type="submit">
                            Sign Up
                        </button>
                    </div>
                </div>
            </form>

            <div class="flex-col-c p-t-15">
                <span class="txt1 p-b-17">
                    Ready Account ?
                </span>

                <a href="<?= base_url('auth/index') ?>" class="txt2">
                    Login
                </a>
            </div>
        </div>
    </div>
</div>