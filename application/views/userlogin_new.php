<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<?php
$domain = base_url();
$domain = str_replace("https://", "", $domain);
$domain = str_replace("http://", "", $domain);
$domain = str_replace("/", "", $domain);
$domain = str_replace("www", "", $domain);


$url  = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
$name = str_replace(' ', '-', strtolower($setting_result['name']));
function containsWord1($str, $word)
{
    return !!preg_match('#\\b' . preg_quote($word, '#') . '\\b#i', $str);
}

if (containsWord1($url, "lls.schoolsuite.online")) {
    $android_app = 'LLS-WCC.apk';
} elseif (containsWord1($url, "alis.schoolsuite.online")) {
    $android_app = 'American Lyceum.apk';
}
?>


<style>
    .mycontainer {
        height: 100vh;
        position: relative;
        background: #e0e0e0;
    }

    .vertical-center {
        margin: 0;
        position: absolute;
        top: 50%;
        left: 10%;
        right: 10%;
        -ms-transform: translateY(-50%);
        transform: translateY(-50%);
        /*-ms-transform: translateX(-50%);*/
        /*transform: translateX(-50%);*/
    }


    .login-page {
        height: auto !important;
        background: #d2d6de !important;
    }

    .login-box {
        width: 340px !important;
        margin: 2% auto !important;
    }

    /* Extra small devices (phones, 600px and down) */
    @media only screen and (max-width: 600px) {
        .login-box {
            margin: 10% auto !important;
            width: 320px !important;
        }
    }


</style>


<div class='login-box'>


    <div class="text-center ">


        <div class='box' style='padding:20px;margin-left: auto;margin-right: auto;'>

            <!--<div class='box-header'>-->
            <!--<row>-->
            <!--    <h5><?php //echo $setting_result['name'] ?></h5>-->

            <!--</row>-->

            <!--    <h5 style='margin-bottom:40px'><?php //echo $setting_result['address'] ?></h5>-->

            <!--</div>-->


            <div class='box-body'>

                <?php if (empty($setting_result)): ?>
                    <img src="<?php echo base_url() ?>uploads/school_content/logo/images.png" class="img-thumbnail"
                         alt="Cinque Terre">
                <?php else: ?>
                    <img src="<?php echo base_url() ?><?php echo $setting_result['image']; ?>" alt="Cinque Terre"
                         style="height: 80px; width: 80px;">
                <?php endif; ?>

                <h5 style="margin-top: 20px;"><?php echo $setting_result['name'] ?></h5>
                <h5 style='margin-bottom:20px'><?php echo $setting_result['address'] ?></h5>


                <!--</div>-->
                <div style="border: 1px solid lightgrey; padding: 10px; margin-top: 50px;">
                    <h5 style='margin-top:20px'>Sign In</h5>

                    <?php
                    if (isset($error_message)) {
                        echo "<div class='alert alert-danger'>" . $error_message . "</div>";
                    }


                    ?>

                    <form action="<?php echo site_url('site/userlogin') ?>" method="post">
                        <?php echo $this->customlib->getCSRF(); ?>
                        <div class="form-group">
                            <label class="sr-only"
                                   for="form-username"><?php echo $this->lang->line('username'); ?></label>
                            <input required type="text" name="username"
                                   placeholder="<?php echo $this->lang->line('username'); ?>"
                                   class="form-username form-control" id="email">
                            <span class="text-danger"><?php echo form_error('username'); ?></span>
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="form-password">Password</label>
                            <input required type="password" name="password"
                                   placeholder="<?php echo $this->lang->line('password'); ?>"
                                   class="form-password form-control" id="password">
                            <span class="text-danger"><?php echo form_error('password'); ?></span>
                        </div>
                        <button type="submit" class="btn btn-default btn-block"><?php echo 'Login'; ?></button>
                    </form>


                    <p style='margin-top:5px; margin-bottom:25px;'>
                        <a class="android" style='float:left'
                           href="<?php echo base_url(); ?>uploads/<?= $domain ?>/<?= $android_app ?>"><img height="25px"
                                                                                                          src="<?php echo base_url(); ?>/uploads/school_content/google.png"></a>

                        <a href='#' id="forgetPassUrl" style='float:right;margin-bottom:20px'>
                            Forgot Password ?
                        </a>
                    </p>

                </div>


                <div class="ourInfo" style='margin-top:20px;clear:both'>


                    <p>&copy; Copyright 2016-<?= date('Y') ?> IDS Technologies</p>
                    <p>All rights reserved</p>
                    <p>Powered By <img src='<?= base_url() ?>uploads/company/logo3.jpeg' alt='schoolsuite'
                                       height='10px'/></p>

                </div>


            </div>
        </div>

    </div>

    <script>


        $(function () {

            $('body').addClass('login-page');

            $("#forgetPassUrl").on("click", function (e) {
                e.preventDefault();
                swal({
                    button: false,
                    text: "Please Contact School Administration!",
                    timer: 3000,
                });
            });

            $(".ourInfo").on("click", function (e) {
                e.preventDefault();
                swal({
                    button: false,
                    text: "For Product & Services!\n\nUrwatilWusqa\nIDS Technologies\nCall or WhatsApp: 0333 348 4848\nurwatilwusqa@gmail.com",
                });
            });

        })

    </script>


    <!-- <style>

    @media (max-width: 767px) {
        .container .userlogin
         {
           min-height: 500px;
         }
    }


    </style> -->

    <!-- <div class="container" style="height: 100%;" style="min-height: 946px;">

        <div class="row" style="height: 100%;">

            <div class="col-sm-4 col-sm-offset-4 userlogin" style="height: 510px">

                <div class="new_form_container vertical_center_content" style="margin-top:90px">
                <div class="text-center">
                        <?php if (empty($setting_result)): ?>
                            <img src="<?php echo base_url() ?>uploads/school_content/logo/images.png" class="img-thumbnail" alt="Cinque Terre">
                        <?php else: ?>
                            <img src="<?php echo base_url() ?>uploads/school_content/logo/<?php echo $setting_result['image']; ?>" class="img-thumbnail" alt="Cinque Terre" style="height: 170px; width: 170px;">
                        <?php endif; ?>
                    </div>

                    <h3 class="text-center">Login</h3>
             

                    <?php
    if (isset($error_message)) {
        echo "<div class='alert alert-danger'>" . $error_message . "</div>";
    }
    ?>
    <div class="col-sm-offset-3 col-sm-6" style="    padding-right: 27px;
    padding-left: 27px;">
                    <form action="<?php echo site_url('site/userlogin') ?>" method="post">
                        <?php echo $this->customlib->getCSRF(); ?>
                        <div class="form-group">
                            <label class="sr-only" for="form-username"><?php echo $this->lang->line('username'); ?></label>
                            <input type="text" name="username" placeholder="<?php echo $this->lang->line('username'); ?>" class="form-username form-control" id="email">
                            <span class="text-danger"><?php echo form_error('username'); ?></span>
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="form-password">Password</label>
                            <input type="password" name="password" placeholder="<?php echo $this->lang->line('password'); ?>" class="form-password form-control" id="password">
                            <span class="text-danger"><?php echo form_error('password'); ?></span>
                        </div>
                        <div class="form-group">
                            <button type="submit"  style="background-color:#DCDCDC" class="btn text-center form-control"><?php echo $this->lang->line('sign_in'); ?></button>
                        </div>
                        <a href="" style="color:black;font-size: 8pt;" class="forgot">Note: Incase of forgot password , Contact admin</a>
                    </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

<footer class="main-footer">
    <div class="col-sm-12">
        <h5  height="8%" width="9%" class="pull-left" style="margin-top:10px;display:flex;margin-left: 40px;">Powered by &nbsp&nbsp&nbsp&nbsp</h5>
        <img class="pull-left" src="<?= base_url('backend/images/school-suite.png') ?>" height="15px" width="100px" style="margin-right:15px;margin-top:9px">
    </div>
  </footer> -->

