<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title><?= ( !empty( $title ) ? $title : "PLUGEDIN" ) ?></title>

        <link href="<?= base_url( 'backend/bootstrap/css/bootstrap.min.css' ) ?>" rel="stylesheet">

        <link href="<?= base_url( 'backend/dist/css/new-layout.css' ) ?>" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    </head>
    <body>

        <div class="new_header">
            <div class="container-fluid">
                <div class="row new_header_container">
                    <div class="col-sm-3 new_header_left_container"></div>

                    <div class="col-sm-9 new_header_right_container">
                        <div class="pull-right links">
                            <a href="<?= site_url('home/app_features') ?>">App Features</a>

                            <span style="color: #999999; font-size: 1.1em;"> | </span>

                            <a href="<?= site_url('home/web_features') ?>">Web Features</a>

                            <span style="color: #999999; font-size: 1.1em;"> | </span>

                            <a href="<?= site_url('home/benefits') ?>">Benefits</a>

                            <span style="color: #999999; font-size: 1.1em;"> | </span>

                            <a href="<?= site_url('home/pricing') ?>">Pricing</a>

                            <span style="color: #999999; font-size: 1.1em;"> | </span>

                            <a href="<?= site_url( 'site/login' ) ?>">SIGN IN</a>

                            <span style="color: #999999; font-size: 1.1em;"> | </span>

                            <a href="http://plug.tecnogat.com/site/login">FREE DEMO
                                <span class="glyphicon glyphicon-chevron-right"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>