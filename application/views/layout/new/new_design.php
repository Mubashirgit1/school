<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title><?= ( !empty( $title ) ? $title : "PLUGEDIN" ) ?></title>

        <link href="<?= base_url( 'backend/bootstrap/css/bootstrap.min.css' ) ?>" rel="stylesheet">

        <link href="<?= base_url( 'backend/dist/css/new-landing-design.css' ) ?>" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    </head>
    <body>

        <div class="logo_container">
            <div class="container-fluid">
                <div class="logo_container_inner">
                    <a href="<?= site_url() ?>"><img src="<?= site_url( 'backend/images/plugedin-logo.png' ) ?>" alt="Plugedin" width="200" height="20"></a>
                </div>
            </div>
        </div>

        <div class="menu_container">
            <div class="container-fluid">
                <div class="menu_container_inner">
                    <ul class="menu_container_inner_left">
                        <li>
                            <a href="<?= site_url() ?>">Home</a>
                        </li>
                        <li>
                            <a href="<?= site_url('home/app_features') ?>">App Features</a>
                        </li>
                        <li>
                            <a href="<?= site_url('home/web_features') ?>">Web Features</a>
                        </li>
                        <li>
                            <a href="<?= site_url('home/benefits') ?>">Benifits</a>
                        </li>
                        <li>
                            <a href="<?= site_url('home/pricing') ?>">Pricing</a>
                        </li>
                        <li>
                            <a href="#">Support</a>
                        </li>
                        <li>
                            <a href="#">Contact</a>
                        </li>
                    </ul>

                    <ul class="menu_container_inner_right">
                        <li>
                            <a href="<?= site_url('site/login') ?>">Login</a>
                        </li>
                        <li>
                            <a href="http://plug.tecnogat.com/site/login">Free Demo</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Bootstrap JavaScript -->
        <script src="<?= base_url( 'backend/bootstrap/js/bootstrap.min.js' ) ?>"></script>
    </body>
</html>