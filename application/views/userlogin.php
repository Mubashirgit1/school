<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#424242" />
        <title>Smart School : School Management System</title>
        <link href="<?php echo base_url(); ?>backend/images/s-favican.png" rel="shortcut icon" type="image/x-icon">      
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/usertemplate/assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/usertemplate/assets/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/usertemplate/assets/css/form-elements.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/usertemplate/assets/css/style.css">
        <style type="text/css">
            .ispace{ padding-right:5px;}
        </style>
    </head>
    <body>
        <!-- Top content -->
        <div class="top-content">
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <img src="<?php echo base_url(); ?>backend/images/s_logo.png">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                            <div class="form-top">
                                <div class="form-top-left">
                                    <h3><?php echo $this->lang->line('user_login'); ?></h3>
                                    
                                </div>
                                <div class="form-top-right">
                                    <i class="fa fa-key"></i>
                                </div>
                            </div>
                            <div class="form-bottom">
                                <?php
                                if (isset($error_message)) {
                                    echo "<div class='alert alert-danger'>" . $error_message . "</div>";
                                }
                                ?>
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
                                   <button type="submit" class="btn"><?php echo $this->lang->line('sign_in'); ?></button>
                                </form>
                            </div>                           
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>       
        <script src="<?php echo base_url(); ?>backend/usertemplate/assets/js/jquery-1.11.1.min.js"></script>
        <script src="<?php echo base_url(); ?>backend/usertemplate/assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>backend/usertemplate/assets/js/jquery.backstretch.min.js"></script>
        <!-- <script src="<?php echo base_url(); ?>backend/usertemplate/assets/js/scripts.js"></script> -->

        <!--[if lt IE 10]>
            <script src="<?php echo base_url(); ?>backend/usertemplate/assets/js/placeholder.js"></script>
        <![endif]-->
    </body>
</html>
<script type="text/javascript">
//    $(document).ready(function () {
//        var base_url = '<?php //echo base_url(); ?>//';
//        $.backstretch([
//            base_url + "backend/usertemplate/assets/img/backgrounds/2.jpg"
//                    , base_url + "backend/usertemplate/assets/img/backgrounds/3.jpg"
//                    , base_url + "backend/usertemplate/assets/img/backgrounds/1.jpg"
//        ], {duration: 3000, fade: 750});
//
//        $('.login-form input[type="text"], .login-form input[type="password"], .login-form textarea').on('focus', function () {
//            $(this).removeClass('input-error');
//        });
//        $('.login-form').on('submit', function (e) {
//            $(this).find('input[type="text"], input[type="password"], textarea').each(function () {
//                if ($(this).val() == "") {
//                    e.preventDefault();
//                    $(this).addClass('input-error');
//                } else {
//                    $(this).removeClass('input-error');
//                }
//            });
//        });
//    });
</script>

<script>
    function copy(email, password)
    {
        document.getElementById("email").value = email;
        document.getElementById("password").value = password;
    }
</script>