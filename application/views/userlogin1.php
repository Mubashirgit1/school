<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title><?= (!empty($title) ? $title : "PLUGEDIN") ?></title>
    <meta name="description" content="Login page example"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

    <base href="<?php echo base_url() ?>">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>


    <link href="login/css/login.css" rel="stylesheet"
          type="text/css"/>

    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="login/css/plugins.bundle.css"
          rel="stylesheet" type="text/css"/>
    <link href="login/css/prismjs.bundle.css"
          rel="stylesheet" type="text/css"/>
    <link href="login/css/style.bundle.css" rel="stylesheet"
          type="text/css"/>
    <!--end::Global Theme Styles-->

    <!--begin::Layout Themes(used by all pages)-->

    <!--    <link href="login/css/light.css"-->
    <!--          rel="stylesheet" type="text/css"/>-->
    <!--    <link href="/metronic/themes/metronic/theme/html/demo1/dist/assets/css/themes/layout/header/menu/light.css"-->
    <!--          rel="stylesheet" type="text/css"/>-->
    <!--    <link href="/metronic/themes/metronic/theme/html/demo1/dist/assets/css/themes/layout/brand/dark.css"-->
    <!--          rel="stylesheet" type="text/css"/>-->
    <!--    <link href="/metronic/themes/metronic/theme/html/demo1/dist/assets/css/themes/layout/aside/dark.css"-->

    <!--    rel="stylesheet" type="text/css"/>-->
    <!--    end::Layout Themes-->
    <!---->
    <!--    <link rel="shortcut icon" href="/metronic/themes/metronic/theme/html/demo1/dist/assets/media/logos/favicon.ico"/>-->


</head>
<!--end::Head-->

<!--begin::Body-->
<body id="kt_body"
      class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">


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
} else {
    $android_app = null;
}
?>


<!--begin::Main-->
<div class="d-flex flex-column flex-root">
    <!--begin::Login-->


    <div class="login login-4 login-signin-on d-flex flex-column flex-lg-row flex-row-fluid bg-white" id="kt_login">
        <!--begin::Aside-->


        <div class="order-2 order-lg-1 flex-column-auto flex-lg-row-fluid d-flex flex-column p-7"
             style="background-image: url(<?php if (isset($setting_result['splash'])) echo $setting_result['splash']; else {echo 'login/img/pt_bg.jpeg';}?>);background-size: cover">
            <!--begin::Content body-->
            <div class="d-flex flex-column-fluid flex-lg-center">
                <div class="d-flex flex-column justify-content-center">
                    <!--                    <h3 class="display-3 font-weight-bold my-7 text-white">Welcome to Metronic!</h3>-->
                    <!--                    <p class="font-weight-bold font-size-lg text-white opacity-80">-->
                    <!--                        The ultimate Bootstrap, Angular 8, React & VueJS admin theme<br/>framework for next generation-->
                    <!--                        web apps.-->
                    <!--                    </p>-->
                </div>
            </div>
            <!--end::Content body-->
        </div>

        <div class="login-aside order-1 order-lg-2 d-flex flex-column-fluid flex-lg-row-auto bgi-size-cover bgi-no-repeat p-7 p-lg-10">
            <!--begin: Aside Container-->
            <div class="d-flex flex-row-fluid flex-column justify-content-between">
                <!--begin::Aside body-->
                <div class="d-flex flex-column-fluid flex-column flex-center mt-5 mt-lg-0">
                    <a class="mb-15 text-center">
                        <!--                        <img src="login/img/logo.png"-->
                        <!--                             class="max-h-75px" alt=""/>-->


                        <?php if (empty($setting_result)): ?>
                            <img src="<?php echo base_url() ?>uploads/school_content/logo/images.png" class="max-h-75px"
                                 alt="Cinque Terre">
                        <?php else: ?>
                            <img src="<?php echo base_url() ?><?php echo $setting_result['image']; ?>"
                                 alt="Cinque Terre" class="" style='height:130px;width:130px'>
                        <?php endif; ?>

                        <!--<h5 style="margin-top: 20px;"><?php echo $setting_result['name'] ?></h5>-->
                        <h5 style='margin-bottom:20px;border:none'
                            class='form-control'><?php echo $setting_result['address'] ?></h5>


                    </a>

                    <!--begin::Signin-->
                    <div class="login-form login-signin">
                        <div class="text-center mb-2">
                            <h2 class="font-weight-bold">Sign In</h2>
                            <!--                            <p class="text-muted font-weight-bold">Enter your username and password</p>-->
                        </div>

                        <!--begin::Form-->
                        <form class="form" action="<?php echo site_url('site/userlogin') ?>" method="post"
                              novalidate="novalidate" id="">
                            <div class="form-group py-3 m-0">
                                <input required class="form-control h-auto border-0 px-0 placeholder-dark-75"
                                       type="Email"
                                       placeholder="User ID" name="username" autocomplete="off"/>
                            </div>
                            <div class="form-group py-3 border-top m-0">
                                <input required class="form-control h-auto border-0 px-0 placeholder-dark-75"
                                       type="Password"
                                       placeholder="Password" name="password"/>
                            </div>

                            <div style='display:none !important'
                                 class="form-group d-flex flex-wrap justify-content-between align-items-center mt-3">
                                <label class="checkbox checkbox-outline m-0 text-muted">
                                    <input type="checkbox" name="remember"/> Remember me
                                    <span></span>
                                </label>
                                <!--                                <a href="javascript:;" id="kt_login_forgot" class="text-muted text-hover-primary">Forgot-->
                                <!--                                    Password ?</a>-->
                            </div>

                            <div class="form-group d-flex flex-wrap justify-content-between align-items-center mt-2">
                                <!--                                <div class="my-3 mr-2">-->
                                <!--                                    <span class="text-muted mr-2">Don't have an account?</span>-->
                                <!--                                    <a href="javascript:;" id="kt_login_signup" class="font-weight-bold">-->
                                <!--                                        Signup-->
                                <!--                                    </a>-->
                                <!--                                </div>-->
                                <button type="submit" id="kt_login_signin_submit"
                                        class="btn btn-primary btn-block font-weight-bold px-9 py-4 my-3">Log In
                                </button>
                            </div>
                        </form>


                        <p style='margin-top:5px; margin-bottom:25px;'>
                            <?php if ($android_app): ?>
                                <a class="android" style='float:left'
                                   href="<?php echo base_url(); ?>uploads/<?= $domain ?>/<?= $android_app ?>">
                                    <img height="25px"
                                            src="<?php echo base_url(); ?>/uploads/school_content/google.png"></a>
                            <?php endif; ?>
                            <a href='javascript:void(0)' id="forgetPassUrl" style='float:right;margin-bottom:20px'>
                                Forgot Password ?
                            </a>
                        </p>


                        <!--<p style='clear:both' class='d-sm-block d-md-none'>-->


                        <h5 style='border:none;clear:both;padding:.65rem 0rem;' class='form-control'>Copyright
                            2016-<?php echo date('Y') ?> IDS Technologies.<br> All rights reserved</h5>

                        <!--</p>-->


                        <!--end::Form-->
                    </div>
                    <!--end::Signin-->

                    <!--begin::Signup-->
                    <div class="login-form login-signup">
                        <div class="text-center mb-10 mb-lg-20">
                            <h3 class="">Sign Up</h3>
                            <p class="text-muted font-weight-bold">Enter your details to create your account</p>
                        </div>

                        <!--begin::Form-->
                        <form class="form" novalidate="novalidate" id="kt_login_signup_form">
                            <div class="form-group py-3 m-0">
                                <input class="form-control h-auto border-0 px-0 placeholder-dark-75" type="text"
                                       placeholder="Fullname" name="fullname" autocomplete="off"/>
                            </div>
                            <div class="form-group py-3 border-top m-0">
                                <input class="form-control h-auto border-0 px-0 placeholder-dark-75" type="password"
                                       placeholder="Email" name="email" autocomplete="off"/>
                            </div>
                            <div class="form-group py-3 border-top m-0">
                                <input class="form-control h-auto border-0 px-0 placeholder-dark-75" type="password"
                                       placeholder="Password" name="password" autocomplete="off"/>
                            </div>
                            <div class="form-group py-3 border-top m-0">
                                <input class="form-control h-auto border-0 px-0 placeholder-dark-75" type="password"
                                       placeholder="Confirm password" name="cpassword" autocomplete="off"/>
                            </div>
                            <div class="form-group mt-5">
                                <label class="checkbox checkbox-outline">
                                    <input type="checkbox" name="agree"/>I Agree the <a href="#">terms and
                                        conditions</a>.
                                    <span></span>
                                </label>
                            </div>
                            <div class="form-group d-flex flex-wrap flex-center">
                                <button id="kt_login_signup_submit"
                                        class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-2">Submit
                                </button>
                                <button id="kt_login_signup_cancel"
                                        class="btn btn-outline-primary font-weight-bold px-9 py-4 my-3 mx-2">Cancel
                                </button>
                            </div>
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Signup-->

                    <!--begin::Forgot-->
                    <div class="login-form login-forgot">
                        <!--                        <div class="text-center mb-10 mb-lg-20">-->
                        <!--                            <h3 class="">Forgotten Password ?</h3>-->
                        <!--                            <p class="text-muted font-weight-bold">Enter your email to reset your password</p>-->
                        <!--                        </div>-->

                        <!--begin::Form-->
                        <form class="form" novalidate="novalidate" id="kt_login_forgot_form">
                            <div class="form-group py-3 border-bottom mb-10">
                                <input class="form-control h-auto border-0 px-0 placeholder-dark-75" type="email"
                                       placeholder="Email" name="email" autocomplete="off"/>
                            </div>
                            <div class="form-group d-flex flex-wrap flex-center">
                                <button id="kt_login_forgot_submit"
                                        class="btn btn-primary  font-weight-bold px-9 py-4 my-3 mx-2">Submit
                                </button>
                                <button id="kt_login_forgot_cancel"
                                        class="btn btn-light-primary  font-weight-bold px-9 py-4 my-3 mx-2">Cancel
                                </button>
                            </div>
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Forgot-->
                </div>
                <!--end::Aside body-->

                <!--begin: Aside footer for desktop-->
                <!--                <div class="d-flex flex-column-auto justify-content-between mt-15">-->
                <!--                    <div class="text-dark-50 font-weight-bold order-2 order-sm-1 my-2">-->
                <!--                        &copy; 2020 Metronic-->
                <!--                    </div>-->
                <!--                    <div class="d-flex order-1 order-sm-2 my-2">-->
                <!--                        <a href="#" class="text-muted text-hover-primary">Privacy</a>-->
                <!--                        <a href="#" class="text-muted text-hover-primary ml-4">Legal</a>-->
                <!--                        <a href="#" class="text-muted text-hover-primary ml-4">Contact</a>-->
                <!--                    </div>-->
                <!--                </div>-->
                <!--end: Aside footer for desktop-->
            </div>
            <!--end: Aside Container-->
        </div>


        <!--begin::Aside-->

        <!--begin::Content-->


        <!--end::Content-->
    </div>
    <!--end::Login-->
</div>
<!--end::Main-->


<!--begin::Global Config(global config for global JS scripts)-->
<script>
    var KTAppSettings = {
        "breakpoints": {
            "sm": 576,
            "md": 768,
            "lg": 992,
            "xl": 1200,
            "xxl": 1200
        },
        "colors": {
            "theme": {
                "base": {
                    "white": "#ffffff",
                    "primary": "#6993FF",
                    "secondary": "#E5EAEE",
                    "success": "#1BC5BD",
                    "info": "#8950FC",
                    "warning": "#FFA800",
                    "danger": "#F64E60",
                    "light": "#F3F6F9",
                    "dark": "#212121"
                },
                "light": {
                    "white": "#ffffff",
                    "primary": "#E1E9FF",
                    "secondary": "#ECF0F3",
                    "success": "#C9F7F5",
                    "info": "#EEE5FF",
                    "warning": "#FFF4DE",
                    "danger": "#FFE2E5",
                    "light": "#F3F6F9",
                    "dark": "#D6D6E0"
                },
                "inverse": {
                    "white": "#ffffff",
                    "primary": "#ffffff",
                    "secondary": "#212121",
                    "success": "#ffffff",
                    "info": "#ffffff",
                    "warning": "#ffffff",
                    "danger": "#ffffff",
                    "light": "#464E5F",
                    "dark": "#ffffff"
                }
            },
            "gray": {
                "gray-100": "#F3F6F9",
                "gray-200": "#ECF0F3",
                "gray-300": "#E5EAEE",
                "gray-400": "#D6D6E0",
                "gray-500": "#B5B5C3",
                "gray-600": "#80808F",
                "gray-700": "#464E5F",
                "gray-800": "#1B283F",
                "gray-900": "#212121"
            }
        },
        "font-family": "Poppins"
    };
</script>


<!--end::Global Config-->

<!--begin::Global Theme Bundle(used by all pages)-->
<script src="login/js/plugins.bundle.js"></script>
<script src="login/js/prismjs.js"></script>
<script src="login/js/scripts.bundle.js"></script>
<!--end::Global Theme Bundle-->


<!--begin::Page Scripts(used by this page)-->
<script src="login/js/login.js"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


<script>


    $(function () {


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


<!--end::Page Scripts-->
</body>
<!--end::Body-->
</html>

  