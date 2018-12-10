<!-- Font Icon -->
<link rel="stylesheet" href="<?php echo e(asset('reg_form/fonts/material-icon/css/material-design-iconic-font.min.css')); ?>">

<!-- Main css -->
<link rel="stylesheet" href="<?php echo e(asset('reg_form/css/style.css')); ?>">
<!-- JS -->

<script src="<?php echo e(asset('reg_form/js/main.js')); ?>"></script>

<div class="main">
    <!-- Sign up form -->
    <section class="signup">
        <div class="container">
            <div class="signup-content">
                <div class="signup-form">
                    <h2 class="form-title"><?php echo e(__('Register')); ?></h2>
                    <form method="POST" class="register-form" id="register-form">
                        <div class="form-group d-none"><label class="d-inline-block" for="name">Your Name</label><input type="text" name="" id=""type="hidden" disabled="true" >                            
                        </div>
                        <div class="form-group">
                            <input type="text" name="first_name" id="first_name" placeholder="First Name"/>
                            <input type="text" name="middle_name" id="middle_name" placeholder="Middle Name"/>
                            <input type="text" name="last_name" id="last_name" placeholder="Last Name"/>
                            <?php if($errors->has('last_name')): ?>
                            <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($errors->first('last_name')); ?></strong>
                            </span>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="email"><i class="zmdi zmdi-email"></i></label>
                            <input type="email" name="email" id="email" placeholder="Your Email"/>
                        </div>
                        <div class="form-group">
                            <label for="email"><i class="zmdi zmdi-email"></i></label>
                            <input type="email" name="email" id="email" placeholder="Your Email"/>
                        </div>
                        <div class="form-group">
                            <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                            <input type="password" name="pass" id="pass" placeholder="Password"/>
                        </div>
                        <div class="form-group">
                            <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                            <input type="password" name="re_pass" id="re_pass" placeholder="Repeat your password"/>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                            <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                        </div>
                        <div class="form-group form-button">
                            <input type="submit" name="signup" id="signup" class="form-submit" value="Register"/>
                        </div>
                    </form>
                </div>
                <div class="signup-image">
                    <figure><img src="<?php echo e(asset('reg_form/images/signup-image.jpg')); ?>" alt="sing up image"></figure>
                    <a href="#" class="signup-image-link">I am already member</a>
                </div>
            </div>
        </div>
    </section>

    

</div>


