

<!DOCTYPE html>
<html <?php echo $this->customlib->getRTL(); ?>>

 <?php  $admind = $this->session->userdata( 'admin' ); 
   $this->load->helper('menu_helper');
    $permission = admin_permission($admind['id']);?>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <?php
            $baseurl= base_url();
        ?>
        <title>
            <?php if (current_url() == $baseurl."student/search") {
                echo $title." (".$report_month.")";
            }else{ ?>
            <?= ( !empty( $title ) ? $title . ' - ' : '' ) ?><?php echo $this->customlib->getAppName(); ?>
            <?php } ?>
        </title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="theme-color" content="#424242"/>
        <link href="<?php echo base_url(); ?>backend/images/s-favican.png" rel="shortcut icon" type="image/x-icon">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/bootstrap/css/bootstrap.min.css?v=0.2">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/skins/_all-skins.min.css">
<!--        <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">-->
<!--        <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/font-awesome-line-awesome/css/all.min.css">-->
        <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/ss-main.css?v=0.127">
        <link href="<?php echo base_url(); ?>backend/select2/dist/css/select2.min.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/fixedheader/3.1.6/css/fixedHeader.dataTables.min.css" rel="stylesheet">
                


        <?php
        if ( $this->customlib->getRTL() != "" ) {
            ?>
            <!-- Bootstrap 3.3.5 RTL -->
            <link rel="stylesheet" href="<?php echo base_url(); ?>backend/rtl/bootstrap-rtl/css/bootstrap-rtl.min.css"/>
            <!-- Theme RTL style -->
            <link rel="stylesheet" href="<?php echo base_url(); ?>backend/rtl/dist/css/AdminLTE-rtl.min.css"/>
            <link rel="stylesheet" href="<?php echo base_url(); ?>backend/rtl/dist/css/ss-rtlmain.css">
            <link rel="stylesheet" href="<?php echo base_url(); ?>backend/rtl/dist/css/skins/_all-skins-rtl.min.css"/>
            <?php
        }
        ?>
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/font-latest/css/all.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/ionicons.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/iCheck/flat/blue.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/morris/morris.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/datepicker/datepicker3.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/daterangepicker/daterangepicker-bs3.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/sweet-alert/sweetalert2.css">

        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/custom_style.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/datepicker/css/bootstrap-datetimepicker.css">
        <!--print table-->
        <link href="<?php echo base_url(); ?>backend/dist/cssdata/dataTables.bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>backend/dist/cssdata/buttons.bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>backend/dist/cssdata/semantic.min.css">
        <!--./print table -->

        <script src="<?php echo base_url(); ?>backend/custom/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>backend/dist/js/moment.min.js"></script>
        <script src="<?php echo base_url(); ?>backend/datepicker/js/bootstrap-datetimepicker.js"></script>
        <script src="<?php echo base_url(); ?>backend/datepicker/date.js"></script>
        <script src="<?php echo base_url(); ?>backend/dist/js/jquery-ui.min.js"></script>

        <style>
            .group {
                background: lightgrey;
            }
        </style>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/rowgroup/1.1.1/js/dataTables.rowGroup.min.js" ></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/rowgroup/1.1.1/css/rowGroup.dataTables.min.css">

        <style>
            table.dataTable tr.dtrg-group.dtrg-level-2 td {
                padding-left: 3em;
            }
        </style>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and me/
        [if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>


        <![endif]-->
        <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>backend/jquery-confirm/jquery-confirm-min.css">
        <script src="<?php echo base_url(); ?>backend/jquery-confirm/jquery-confirm-min.js"></script> -->
        <style>

.fixed .content-wrapper,
    .fixed .right-side {
         padding-top: 80px !important;
        
    }
</style>
    </head>
    <body class="hold-transition skin-blue fixed sidebar-mini _sidebar_menu_hidden " style="background-color:#f5f5f5 !important">
        
        <!-- _sidebar_menu_hidden || Class to hide menu -->
        <!-- hold-transition skin-blue fixed sidebar-mini sidebar-expanded-on-hover sidebar-collapse -->
        <div class="wrapper" style="background-color:#f5f5f5 !important" >
           <?php
        $admind = $this->session->userdata( 'admin' );
        ?>
            <header class="main-header" style="">
               <?php if ($permission->menu_bar == 1) {	?>
                <span class="logo-menu-button hidden-xs"><i class="fa fa-bars"></i></span>
                <?php } ?>
             <?php  $school_logo  = $this->setting_model->getCurrentImage(); ?>
                <a href="<?php echo base_url(); ?>balance_sheet" class="logo">
                    <span class="logo-mini">S S</span>
                    <span class="logo-lg"><img style="width: 50px; height:50px; " src="<?= base_url( "{$school_logo}" ) ?>" alt="<?php echo $this->customlib->getAppName() ?>"/></span>
                </a>

                <nav class="navbar navbar-static-top" role="navigation">
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                 
                    <div class="col-md-3 col-sm-3 col-xs-3" style="width:10% !important">
                        <span href="#" class="sidebar-session">
                            <?php echo $this->setting_model->getCurrentSchoolName(); ?>
                        </span>
                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-9" style="width:90% !important">
                        <div class="pull-right">

                            <!-- <form class="navbar-form navbar-left search-form" style="padding-left:0px;" role="search" action="<?php echo site_url( 'student/all_students?gender=' ); ?>" method="post">

                            <a type="button" name="" value="" id="" style="padding: 3px 5px !important;border-radius: 0px 30px 30px 0px; color:#484848 !important;  font-size:15px" href="<?= site_url( 'student/all_students' ) . "?gender=" ?>" class="btn btn-flat table_link"><i class="fa fa-street-view" aria-hidden="true" style="color:#666666 !important;"></i></a>
                                < ?php echo $this->customlib->getCSRF(); ?>
                                <div class="input-group" style="padding-top:3px;">
                                    <input type="text" name="search_text" class="form-control search-form search-form3" placeholder="Students" style="padding:0px; width: 64px;">
                                    <span class="input-group-btn">
                                        <button type="submit" name="search" value="search_full"  style="padding: 3px 5px !important;border-radius: 0px 30px 30px 0px; background: #fff;" class="btn btn-flat"><i class="fa fa-search" style="color:#666666 !important;"></i></button>
                                    </span>
                                </div>
                            </form> -->
                            <form class="navbar-form navbar-left search-form" role="search" style="padding:0px" action="<?php echo site_url( 'family/children_summary' ); ?>" method="post"  >
                                <a type="button" name="" value="" id="" style="padding: 7px 5px !important;border-radius: 0px 30px 30px 0px; background: #fff; " data-placement="bottom" title="Parents" data-toggle="tooltip" href="<?php echo site_url( 'family/index' ); ?>" class="btn btn-flat table_link" ><i class="las la-user-friends icons_header"></i></a>
                                <!-- < ?php echo $this->customlib->getCSRF(); ?>
                                <div class="input-group" style="padding-top:3px;">
                                    <input type="text" name="phone" class="form-control search-form search-form3" placeholder="Parents" style="padding:0px; width: 50px;">
                                    <span class="input-group-btn">
                                        <button type="submit" name="search" value="search_full" id="search-btn" style="padding: 3px 5px !important;border-radius: 0px 30px 30px 0px; background: #fff;" class="btn btn-flat"><i class="fa fa-search" style="color:#666666 !important;"></i></button>
                                    </span>
                                </div> -->
                            </form>

                           <div class="navbar-custom-menu"  >
                                <ul class="nav navbar-nav">
                                            <?php  $date = date("m/d/Y", now()) ?>

                                    <?php   if ($permission->session == 1) {?>
                                   <li><a href="<?php echo base_url(); ?>schsettings" title="Session" data-toggle="tooltip" data-placement="bottom"> <i class="las la-calendar icons_header"  ></i></a>
                                    </li>
                                    <?php }  if ($permission->session == 1) {?>
                                   <li><a href="<?php echo base_url(); ?>admin/stdtransfer" title="transfer / promotion" data-toggle="tooltip" data-placement="bottom"> <i class="las la-random icons_header"  ></i></a>
                                    </li>
                                    <?php } if ($permission->daily_transactions == 1) { ?>
                                     <li><a href="<?= site_url( 'transactions/daily' ). "?date_from=" . urlencode( "$date" ) . "&date_to=" . urlencode( "$date" ) ?>" title="Daily Cash" data-toggle="tooltip" data-placement="bottom" > <i class="las la-briefcase icons_header"  ></i></a>
                                    </li>
                                    <?php } if ($permission->salary == 1) { ?>
                                    <!-- <li><a href="<?= site_url( 'admin/teacher/salary' ) ?>" title="Payroll" data-toggle="tooltip" data-placement="bottom"> <i class="las la-users-cog icons_header"  ></i></a>
                                    </li> -->
                                    <?php } if ($permission->voucher_generation == 1) { ?>
                                    <li><a href="<?= site_url( 'fee_management/fee_voucher' ) ?>" title="Voucher" data-toggle="tooltip" data-placement="bottom"><i class="las la-qrcode icons_header"  ></i> </a>
                                    </li>
                                    <?php }  if ($permission->expense == 1) { ?>
                                     <li><a href="<?= site_url( 'admin/expense' ) ?>" title="Expense" data-toggle="tooltip" data-placement="bottom"><i class="las la-calculator icons_header"  ></i> </a>
                                    </li>
                                    <?php  }  if ($permission->download == 1) { ?>
                                     <!-- <li><a href="<?= site_url( 'admin/content/sylabus' ) ?>" title="Download" data-toggle="tooltip" data-placement="bottom"><i class="las la-file-download icons_header"  ></i></a>
                                    </li> -->
                                    <?php } if ($permission->advance_leave == 1) { ?>
                                     <li><a href="<?= site_url( 'admin/stuattendence/advanceAttendance' ) ?>" title="Advance Leave" data-toggle="tooltip" data-placement="bottom"><i class="las la-user-edit icons_header"  ></i> </a>
                                    </li>
                                    <?php }  if ($permission->award == 1) { ?>
                                     <li><a href="<?= site_url( 'admin/notification' ) ?>" title="Notification" data-toggle="tooltip" data-placement="bottom"><i class="las la-comment icons_header"  ></i> </a>
                                    </li>
                                    <?php }  if ($permission->award == 1) { ?>
                                     <li><a href="<?= site_url( 'admin/InventoryItems' ) ?>" title="inventory" data-toggle="tooltip" data-placement="bottom"> <i class="las la-warehouse icons_header"  ></i></a>
                                    </li>
                                    <?php }?>
                                    <li><a href="<?= site_url( 'admin/stuattendence/marking' ) ?>" title="Attendence" data-toggle="tooltip" data-placement="bottom"> <i class="las la-user-check icons_header"  ></i></a>
                                    </li>
                                    <?php  if ($permission->graphs == 1) { ?>
                                    <li><a href="<?= site_url( 'transactions/graph1' ) ?>" title="Graph" data-toggle="tooltip" data-placement="bottom"> <i class="las la-chart-bar icons_header"  ></i></a>
                                    </li>
                                    <?php } if ($permission->holiday == 1) { ?>
                                    <li>
                                  <a href="<?= site_url( 'admin/stuattendence/holiday' ) ?>" style="color:#666666;" title="Holiday"  data-toggle="tooltip" data-placement="bottom"><i class="las la-mug-hot icons_header"  ></i> </a>
                                    </li>
                                    <?php }  if ($permission->academics == 1) {	?>
                                    <li> <a href="<?= site_url( 'admin/timetable/day_timetable' ) ?>" style="color:#666666;" title="Accademics" data-toggle="tooltip" data-placement="bottom" >
                                    <i class="las la-graduation-cap icons_header"  ></i></a> </li>
                                    <?php }  if ($permission->exams == 1) {	?>
                                    <li><a href="<?php echo base_url(); ?>admin/exam" style="color:#666666;" title="Exam" data-toggle="tooltip" data-placement="bottom"><i class="las la-clipboard-list icons_header"  ></i></a>
                                    </li>
                                    <?php }  if ($permission->message == 1) {	?>
                                     <li><a href="<?= site_url( 'student/send_message' ). "?date_from=" . urlencode( "$date" ) . "&date_to=" . urlencode( "$date" ) ?>" title="Messaging Center" data-toggle="tooltip" data-placement="bottom"><i class="las la-envelope icons_header"  ></i></a>
                                    </li>
                                    <?php }  if ($permission->student_card == 1) {	?>
                                     <li> <a href="<?= site_url( 'student/student_card' ). "?date_from=" . urlencode( "$date" ) . "&date_to=" . urlencode( "$date" ) ?>" title="Student Card" data-toggle="tooltip" data-placement="bottom"> <i class="las la-money-check icons_header"  ></i></a>
                                    </li>
                                    <?php }  if ($permission->bank == 1) {	?>
                                    <li> <a href="<?= site_url( 'transactions/bank' ). "?date_from=" . urlencode( "$date" ) . "&date_to=" . urlencode( "$date" ) ?>" title="Banking"  data-toggle="tooltip" data-placement="bottom"> <i class="las la-university icons_header"  ></i></a>
                                    </li>
                                    <?php } ?>
                                    <li class="dropdown">
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                                            <span class="las la-user-plus" style="font-size:23px; color:#666666 !important;" ></span> <i class="fa fa-caret-down" style="color:#666666 !important;"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-user">
                                        <?php if($permission->admission_student ==1){ ?>
                                            <li>
                                                <a href="<?= site_url( 'student/create' ) ?>">Admission</a>
                                            </li>
                                        <?php }?>
                                        <?php if($permission->admission_teacher ==1){ ?>
                                            <li class="divider"></li>

                                            <li>
                                                <a href="<?php echo base_url(); ?>admin/teacher?teacher_type=active&search=search_filter">
                                                    Register Teacher
                                                </a>
                                            </li>
                                          
                                        <?php }?>
                                        </ul>
                                       
                                    </li>

                                    <li class="dropdown">
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false"><?php echo $this->customlib->getAdminSessionUserName(); ?>
                                            <i class="las la-user" style=" font-size:23px; color:#666666 !important;"></i> <i class="fa fa-caret-down" style="color:#666666 !important;"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-user">
                                            <li>
                                                <a href="<?php echo base_url(); ?>admin/admin/changepass"><i class="fa fa-key"></i> <?php echo $this->lang->line( 'change_password' ); ?>
                                                </a>
                                            </li>
                                            <?php

                                            if ($permission->academics == 1) {  ?>
                                            <li class="divider"></li>
                                            <li>

                                           <a href="<?php echo base_url(); ?>admin/adminuser"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line( 'admin_users' ); ?>
                                        </a>
                                            </li>
                                           <li class="divider"></li>
                                          
                                            <li>
                                                <a href="<?php echo base_url(); ?>options"><i class="fa fa-angle-double-right"></i> Options </a>               
                                            </li>
                                            <li class="divider"></li>
                                           
                                                <?php }
                                                
                                                if($admind['role'] == "admin_main"){
                                                    ?>
                                                <li>
                                                <a href="<?php echo base_url(); ?>schsettings"><i class="fa fa-angle-double-right"></i> General Setting </a>               
                                            </li>
                                            <li class="divider"></li>
                                                <?php  }?>
                                            <?php if ($permission->users == 1) {  ?>
                                                <li>
                                                    <a href="<?php echo base_url(); ?>admin/users"><i class="fa fa-angle-double-right"></i> Users
                                                    </a>
                                                </li>
                                                <li class="divider"></li>
                                            <?php  }?>
                                            <li>
                                                <a href="<?php echo base_url(); ?>site/logout"><i class="fas fa-sign-out-alt"></i> <?php echo $this->lang->line( 'logout' ); ?>
                                                </a>



                                            </li>

                                        </ul>
                                    </li>
                                     </ul>
                             
                            </div>
                        </div>
                        
                    </div>
                   <div>
                        
                        <div class="col-md-2 col-sm-2 col-xs-2" style="margin:0px 0px">
                        <!-- <div id="custom-search-input">
                        <div class="input-group col-md-12">
                            <input type="text" class="form-control input-sm" style="height: 24px;" placeholder="Buscar" />
                            <span class="input-group-btn">
                                <button class="btn btn-info btn-lg" type="button">
                                    <i style="    top: 0px; " class="glyphicon glyphicon-search"></i>
                                </button>
                            </span>
                        </div>
                    </div> -->

                            <form autocomplete="off" role="search" action="<?php echo site_url( 'fee_management/admission_voucher_t' ); ?>" method="post">
                            <input type="text" name="admission_no" class="form-control form-control-sm" placeholder="Tuition Vr by Ad no" >
                                 
                            </form>
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-2" style="margin:0px 0px">
                            <form autocomplete="off" role="search" action="<?php echo site_url( 'fee_management/admission_voucher_other' ); ?>" method="post">
                            <input type="text" name="admission_no" class="form-control form-control-sm" placeholder="Other Vr by Ad No" >
                                
                            </form>
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-2"  style="margin:0px 0px" >
                            <input type="hidden" autocomplete="off" class="student_search" name="search"  value="search_full">
                            <input type="hidden" autocomplete="off" class="student_redirect" name="redirect" value="<?= urlencode( current_url() ) ?>">
                            <input type="hidden" autocomplete="off" class="voucher_redirect" name="redirect" value="<?= urlencode( current_url() ) ?>">
                            <?php if($permission->vr_search == 1){?>
                            <input type="text"   class="form-control form-control-sm voucher_id balance_sheet_input_submit" name="voucher_id" value="" placeholder="Voucher by Vr No" autocomplete="off" data-url="<?= site_url( 'fee_management/fee_voucher_receive' ) ?>" data-values=".voucher_redirect, .voucher_id">
                            <?php }else{?>
                            <input type="text"  class="form-control form-control-sm voucher_id balance_sheet_input_submit" name="voucher_id" value="" placeholder="Voucher by Vr No" data-url="" autocomplete="off" data-values=".voucher_redirect, .voucher_id">
                            <?php }?>
                        </div>

                        <div class="col-md-2 col-sm-2 col-xs-2" style="margin:0px 0px">
                            <form autocomplete="off" role="search" action="<?php echo site_url( 'student/all_students?gender=' ); ?>" method="post">
                            <input type="text" name="search_text" class="form-control form-control-sm" placeholder="Search by Name/Ad no" >
                            <span class="input-group-btn">
                                        <button type="submit" name="search" value="search_full" id="search-btn" style="padding: 0px 0px !important; height:0px !important; background: #fff;" class="btn btn-flat"></button>
                                    </span>
                            </form>
                        </div>

                        <div class="col-md-2 col-sm-2 col-xs-2" style="margin:0px 0px" >
                        <form autocomplete="off" role="search"  action="<?php echo site_url( 'family/children_summary' ); ?>" method="post">
                                <?php echo $this->customlib->getCSRF(); ?>
                          
                                    <input type="text" name="phone" class="form-control form-control-sm " placeholder="Search Parents" >
                                    <span class="input-group-btn" style="display:none">
                                        <button type="submit" name="search" value="search_full"  ></button>
                                    </span>
                             
                            </form>
                        </div>
                        
                        <div class="col-md-2 col-sm-2 col-xs-2" style="margin:0px 0px">
                        
                                <input type="text" autocomplete="off" id="student_account"  class="form-control  form-control-sm search_text balance_sheet_input_submit" name="search_text" value="" placeholder="Search Student A/c by Ad no" data-url="<?= site_url( 'fee_management/student_account' ) ?>" data-values=".search_text">
                        </div>
                    </div>
                </nav>
                        
            </header>
            <?php if ($permission->menu_bar == 1) {	?>
            <aside class="main-sidebar">
                <section class="sidebar" id="sibe-box">
                    <form class="navbar-form navbar-left search-form2" role="search" action="<?php echo site_url( 'admin/admin/search' ); ?>" method="POST">
                        <?php echo $this->customlib->getCSRF(); ?>
                        <div class="input-group ">
                            <input type="text" name="search_text" class="form-control  form-control-sm search-form" placeholder="<?php echo $this->lang->line( 'search_by_name,_roll_no,_enroll_no,_national_identification_no,_local_identification_no_etc..' ); ?>">
                            <span class="input-group-btn">
                                <button type="submit" name="search" style="padding: 3px 12px !important;border-radius: 0px 30px 30px 0px; background: #fff;" class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>

                    <ul class="sidebar-menu">

                        <li class="treeview <?php echo set_Topmenu( 'Dashboard' ); ?>">
                            <a href="<?= site_url( 'admin/admin/dashboard' ) ?>">
                                <i class="fa fa-mortar-board"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="treeview <?php echo set_Topmenu( 'DailyTask' ); ?>">
                            <a href="#">
                                <i class="fa fa-pencil-square-o"></i>
                                <span>Daily Task</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">

                                <li class="<?php echo set_Submenu( 'stuattendence/index' ); ?>">
                                    <a href="<?php echo base_url(); ?>fee_management/collect_fee"><i class="fa fa-angle-double-right"></i> Fee Collection</a>
                                </li>

                                <li class="<?php echo set_Submenu( 'stuattendence/index' ); ?>">
                                    <a href="<?php echo base_url(); ?>student/search"><i class="fa fa-angle-double-right"></i> Student Search</a>
                                </li>

                                <li class="<?php echo set_Submenu( 'stuattendence/index' ); ?>">
                                    <a href="<?php echo base_url(); ?>balance_sheet"><i class="fa fa-angle-double-right"></i> Balance Sheet</a>
                                </li>

                                <li class="<?php echo set_Submenu( 'stuattendence/index' ); ?>">
                                    <a href="<?php echo base_url(); ?>fee_management/fee_reports"><i class="fa fa-angle-double-right"></i> Fee Reports</a>
                                </li>

                                <li class="<?php echo set_Submenu( 'stuattendence/index' ); ?>">
                                    <a href="<?php echo base_url(); ?>fee_management/pending_fee_report"><i class="fa fa-angle-double-right"></i> Pending Fee</a>
                                </li>

                                <li class="<?php echo set_Submenu( 'stuattendence/index' ); ?>">
                                    <a href="<?php echo base_url(); ?>admin/stuattendence/index"><i class="fa fa-angle-double-right"></i> Student Attendance</a>
                                </li>

                                <li class="<?php echo set_Submenu( 'stuattendence/index' ); ?>">
                                    <a href="<?php echo base_url(); ?>admin/teacher/attendance"><i class="fa fa-angle-double-right"></i> Teacher Attendance</a>
                                </li>

                                <li class="<?php echo set_Submenu( 'stuattendence/index' ); ?>">
                                    <a href="<?php echo base_url(); ?>admin/staff/attendance"><i class="fa fa-angle-double-right"></i> Staff Attendance</a>
                                </li>

                                <li class="<?php echo set_Submenu( 'family/index' ); ?>">
                                    <a href="<?php echo base_url(); ?>family"><i class="fa fa-angle-double-right"></i>Family List</a>
                                </li>

                                <li class="<?php echo set_Submenu( 'admin/inventory' ); ?>">
                                    <a href="<?php echo base_url(); ?>admin/inventory"><i class="fa fa-angle-double-right"></i>Inventory Head</a>
                                </li>

                                <li class="<?php echo set_Submenu( 'admin/inventoryItems' ); ?>">
                                    <a href="<?php echo base_url(); ?>admin/InventoryItems"><i class="fa fa-angle-double-right"></i>Inventory Items</a>
                                </li>

                                <li class="<?php echo set_Submenu( 'admin/inventoryItemIssue' ); ?>">
                                    <a href="<?php echo base_url(); ?>admin/InventoryItemIssue"><i class="fa fa-angle-double-right"></i>Issue Inventory Items</a>
                                </li>
                            </ul>
                        </li>

                        <li class="treeview <?php echo set_Topmenu( 'Attendance' ); ?>">
                            <a href="#">
                                <i class="fa fa-calendar-check-o"></i>
                                <span><?php echo $this->lang->line( 'attendance' ); ?></span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?php echo set_Submenu( 'stuattendence/index' ); ?>">
                                    <a href="<?php echo base_url(); ?>admin/stuattendence"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line( 'student_attendance' ); ?>
                                    </a>
                                </li>

                                <li class="<?php echo set_Submenu( 'teacher/attendance' ); ?>">
                                    <a href="<?php echo base_url(); ?>admin/teacher/attendance"><i class="fa fa-angle-double-right"></i> Teacher Attendance</a>
                                </li>

                                <li class="<?php echo set_Submenu( 'staff/attendance' ); ?>">
                                    <a href="<?php echo base_url(); ?>admin/staff/attendance"><i class="fa fa-angle-double-right"></i> Staff Attendance</a>
                                </li>
                            </ul>
                        </li>

                        <li class="treeview <?php echo set_Topmenu( 'FeeManagement' ); ?>">
                            <a href="#">
                                <i class="fa fa-money"></i>
                                <span>Fee</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                <!--                                <li class="--><?php //echo set_Submenu( 'fee_management/collect_fee' ); ?><!--">-->
                <!--                                    <a href="--><?php //echo base_url(); ?><!--fee_management/collect_fee"><i class="fa fa-angle-double-right"></i> Collect fee</a>-->
                <!--                                </li>-->

                                <li class="<?php echo set_Submenu( 'fee_management/student_fee_types' ); ?>">
                                    <a href="<?php echo base_url(); ?>fee_management/student_fee_types"><i class="fa fa-angle-double-right"></i> Student fee types</a>
                                </li>

                                <li class="<?php echo set_Submenu( 'fee_management/fee_voucher' ); ?>">
                                    <a href="<?php echo base_url(); ?>fee_management/fee_voucher"><i class="fa fa-angle-double-right"></i> Fee vouchers</a>
                                </li>
                            </ul>
                        </li>

                        <li class="treeview <?php echo set_Topmenu( 'Expenses' ); ?>">
                            <a href="#">
                                <i class="fa fa-credit-card"></i>
                                <span>Accounts</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?php echo set_Submenu( 'expense/index' ); ?>">
                                    <a href="<?php echo base_url(); ?>admin/expense"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line( 'add_expense' ); ?>
                                    </a>
                                </li>

                                <li class="<?php echo set_Submenu( 'expense/expensesearch' ); ?>">
                                    <a href="<?php echo base_url(); ?>admin/expense/expensesearch"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line( 'search_expense' ); ?>
                                    </a>
                                </li>

                                <li class="<?php echo set_Submenu( 'expenseshead/index' ); ?>">
                                    <a href="<?php echo base_url(); ?>admin/expensehead"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line( 'expense_head' ); ?>
                                    </a>
                                </li>

                                <li class="<?php echo set_Submenu( 'teacher/salary' ); ?>">
                                    <a href="<?php echo base_url(); ?>admin/teacher/salary"><i class="fa fa-angle-double-right"></i> Teacher Salary</a>
                                </li>

                                <li class="<?php echo set_Submenu( 'staff/salary' ); ?>">
                                    <a href="<?php echo base_url(); ?>admin/staff/salary"><i class="fa fa-angle-double-right"></i> Staff Salary</a>
                                </li>

                            </ul>
                        </li>

                        <li class="treeview <?php echo set_Topmenu( 'Examinations' ); ?>">
                            <a href="#">
                                <i class="fa fa-map-o"></i>
                                <span><?php echo $this->lang->line( 'examinations' ); ?></span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?php echo set_Submenu( 'exam/index' ); ?>">
                                    <a href="<?php echo base_url(); ?>admin/exam"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line( 'exam_list' ); ?>
                                    </a></li>
                                <li class="<?php echo set_Submenu( 'examschedule/index' ); ?>">
                                    <a href="<?php echo base_url(); ?>admin/examschedule"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line( 'exam_schedule' ); ?>
                                    </a></li>
                                <li class="<?php echo set_Submenu( 'mark/index' ); ?>">
                                    <a href="<?php echo base_url(); ?>admin/mark"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line( 'marks_register' ); ?>
                                    </a></li>
                                <li class="<?php echo set_Submenu( 'grade/index' ); ?>">
                                    <a href="<?php echo base_url(); ?>admin/grade"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line( 'marks_grade' ); ?>
                                    </a></li>
                            </ul>
                        </li>

                        <li class="treeview <?php echo set_Topmenu( 'Academics' ); ?>">
                            <a href="#">
                                <i class="fa fa-mortar-board"></i>
                                <span><?php echo $this->lang->line( 'academics' ); ?></span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?php echo set_Submenu( 'sections/index' ); ?>">
                                    <a href="<?php echo base_url(); ?>sections"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line( 'sections' ); ?>
                                    </a></li>
                                <li class="<?php echo set_Submenu( 'classes/index' ); ?>">
                                    <a href="<?php echo base_url(); ?>classes"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line( 'class' ); ?>
                                    </a></li>

                                <li class="<?php echo set_Submenu( 'subject/index' ); ?>">
                                    <a href="<?php echo base_url(); ?>admin/subject"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line( 'subjects' ); ?>
                                    </a></li>
                                <li class="<?php echo set_Submenu( 'teacher/assignTeacher' ); ?>">
                                    <a href="<?php echo base_url(); ?>admin/teacher/assignteacher"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line( 'assign_subjects' ); ?>
                                    </a></li>
                                <li class="<?php echo set_Submenu( 'timetable/index' ); ?>">
                                    <a href="<?php echo base_url(); ?>admin/timetable"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line( 'class_timetable' ); ?>
                                    </a>
                                </li>

                                <li class="<?php echo set_Submenu( 'timetable/teacher_timetable' ); ?>">
                                    <a href="<?php echo base_url(); ?>admin/timetable/teacher_timetable">
                                        <i class="fa fa-angle-double-right"></i> Teacher Timetable
                                    </a>
                                </li>

                                <li class="<?php echo set_Submenu( 'timetable/day_timetable' ); ?>">
                                    <a href="<?php echo base_url(); ?>admin/timetable/day_timetable">
                                        <i class="fa fa-angle-double-right"></i> Day Timetable
                                    </a>
                                </li>

                                <li class="<?php echo set_Submenu( 'classes/assign_class_incharge' ); ?>">
                                    <a href="<?php echo base_url(); ?>classes/assign_class_incharge"><i class="fa fa-angle-double-right"></i> Assign Class Incharge
                                    </a></li>
                            </ul>
                        </li>

                        <li class="treeview <?php echo set_Topmenu( 'Communicate' ); ?>">
                            <a href="#">
                                <i class="fa fa-bullhorn"></i>
                                <span>Media</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?php echo set_Submenu( 'notification/index' ); ?>">
                                    <a href="<?php echo base_url(); ?>admin/notification"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line( 'notice_board' ); ?>
                                    </a></li>
                                <li class="<?php echo set_Submenu( 'notification/add' ); ?>">
                                    <a href="<?php echo base_url(); ?>admin/notification/add"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line( 'send_message' ); ?>
                                    </a></li>
                            </ul>
                        </li>

                        <li class="treeview <?php echo set_Topmenu( 'Student Information' ); ?>">
                            <a href="#">
                                <i class="fa fa-user-plus"></i>
                                <span>Student</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?php echo set_Submenu( 'student/search' ); ?>">
                                    <a href="<?php echo base_url(); ?>student/search"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line( 'student_details' ); ?>
                                    </a></li>
                                <li class="<?php echo set_Submenu( 'student/create' ); ?>">
                                    <a href="<?php echo base_url(); ?>student/create"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line( 'student_admission' ); ?>
                                    </a></li>
                                <li class="<?php echo set_Submenu( 'category/index' ); ?>">
                                    <a href="<?php echo base_url(); ?>category"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line( 'student_categories' ); ?>
                                    </a></li>
                                <li class="<?php echo set_Submenu( 'stdtransfer/index' ); ?>">
                                    <a href="<?php echo base_url(); ?>admin/stdtransfer"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line( 'promote_students' ); ?>
                                    </a></li>
                            </ul>
                        </li>

                        <li class="treeview <?php echo set_Topmenu( 'TeacherAttendance' ); ?>">
                            <a href="#">
                                <i class="fa fa-calendar-check-o"></i>
                                <span>Staff</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?php echo set_Submenu( 'teacher/index' ); ?>">
                                    <a href="<?php echo base_url(); ?>admin/teacher/create?teacher_type=active&search=search_filter"><i class="fa fa-angle-double-right"></i> Teacher</a>
                                </li>

                                <li class="<?php echo set_Submenu( 'staff/index' ); ?>">
                                    <a href="<?php echo base_url(); ?>admin/staff/create?search=search_filter&staff_type=active"><i class="fa fa-angle-double-right"></i> Staff</a>
                                </li>

                                <li class="<?php echo set_Submenu( 'staff/staff_departments' ); ?>">
                                    <a href="<?php echo base_url(); ?>admin/staff/staff_departments"><i class="fa fa-angle-double-right"></i> Staff departments</a>
                                </li>
                            </ul>
                        </li>

                        <li class="treeview <?php echo set_Topmenu( 'Reports' ); ?>">
                            <a href="#">
                                <i class="fa fa-line-chart"></i>
                                <span><?php echo $this->lang->line( 'reports' ); ?></span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu" style="top: -180px;">
                                <li class="<?php echo set_Submenu( 'balance_sheet/index' ); ?>">
                                    <a href="<?php echo base_url(); ?>balance_sheet"><i class="fa fa-angle-double-right"></i>Balance Sheet</a>
                                </li>

                                <li class="<?php echo set_Submenu( 'transactions/daily' ); ?>">
                                    <a href="<?php echo base_url(); ?>transactions/daily"><i class="fa fa-angle-double-right"></i>Daily Transactions</a>
                                </li>

                                <!--<li class="<?php echo set_Submenu( 'student/studentreport' ); ?>">
                                    <a href="<?php echo base_url(); ?>student/studentreport"><i class="fa fa-angle-double-right"></i>
                                        <?php echo $this->lang->line( 'student_report' ); ?></a></li>-->

                                <li class="<?php echo set_Submenu( 'student/new_students' ); ?>">
                                    <a href="<?php echo base_url(); ?>student/new_students">
                                        <i class="fa fa-angle-double-right"></i> New Students
                                    </a>
                                </li>

                                <li class="<?php echo set_Submenu( 'student/gender_statistics' ); ?>">
                                    <a href="<?php echo base_url(); ?>student/gender_statistics">
                                        <i class="fa fa-angle-double-right"></i> Gender Statistics
                                    </a>
                                </li>

                                <li class="<?php echo set_Submenu( 'stuattendence/classattendencereport' ); ?>">
                                    <a href="<?php echo base_url(); ?>admin/stuattendence/classattendencereport"><i class="fa fa-angle-double-right"></i> Student Attendance Report</a>
                                </li>

                                <li class="<?php echo set_Submenu( 'stuattendence/attendenceReport' ); ?>">
                                    <a href="<?php echo base_url(); ?>admin/stuattendence/attendencereport"><i class="fa fa-angle-double-right"></i> Student <?php echo $this->lang->line( 'attendance_by_date' ); ?>
                                    </a>
                                </li>

                                <li class="<?php echo set_Submenu( 'fee_management/fee_reports' ); ?>">
                                    <a href="<?php echo base_url(); ?>fee_management/fee_reports"><i class="fa fa-angle-double-right"></i> Fee Reports</a>
                                </li>

                                <li class="<?php echo set_Submenu( 'fee_management/pending_fee_report' ); ?>">
                                    <a href="<?php echo base_url(); ?>fee_management/pending_fee_report"><i class="fa fa-angle-double-right"></i> Pending Fee Report</a>
                                </li>

                                <li class="<?php echo set_Submenu( 'fee_management/other_fee_report' ); ?>">
                                    <a href="<?php echo base_url(); ?>fee_management/other_fee_report"><i class="fa fa-angle-double-right"></i> Other Fee Report</a>
                                </li>

                                <li class="<?php echo set_Submenu( 'family/index' ); ?>">
                                    <a href="<?php echo base_url(); ?>family"><i class="fa fa-angle-double-right"></i>Family List</a>
                                </li>

                                <li class="<?php echo set_Submenu( 'admin/teacher/attendance_report' ); ?>">
                                    <a href="<?php echo base_url(); ?>admin/teacher/attendance_report"><i class="fa fa-angle-double-right"></i> Teacher Attendance Report</a>
                                </li>

                                <li class="<?php echo set_Submenu( 'admin/teacher/salary_report' ); ?>">
                                    <a href="<?php echo base_url(); ?>admin/teacher/salary_report"><i class="fa fa-angle-double-right"></i> Teacher Salary Report</a>
                                </li>

                                <li class="<?php echo set_Submenu( 'admin/staff/attendance_report' ); ?>">
                                    <a href="<?php echo base_url(); ?>admin/staff/attendance_report"><i class="fa fa-angle-double-right"></i> Staff Attendance Report</a>
                                </li>

                                <li class="<?php echo set_Submenu( 'admin/staff/salary_report' ); ?>">
                                    <a href="<?php echo base_url(); ?>admin/staff/salary_report"><i class="fa fa-angle-double-right"></i> Staff Salary Report</a>
                                </li>

                                <li class="<?php echo set_Submenu( 'mark/index' ); ?>">
                                    <a href="<?php echo base_url(); ?>admin/mark"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line( 'exam_marks_report' ); ?>
                                    </a></li>
                            </ul>
                        </li>

                        <li class="treeview <?php echo set_Topmenu( 'Library' ); ?>">
                            <a href="#">
                                <i class="fa fa-book"></i> <span><?php echo $this->lang->line( 'library' ); ?></span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">

                                <li class="<?php echo set_Submenu( 'book/index' ); ?>">
                                    <a href="<?php echo base_url(); ?>admin/book"><i class="fa fa-angle-double-right"></i><?php echo $this->lang->line( 'add_book' ); ?>
                                    </a></li>
                                <li class="<?php echo set_Submenu( 'book/getall' ); ?>">
                                    <a href="<?php echo base_url(); ?>admin/book/getall"><i class="fa fa-angle-double-right"></i><?php echo $this->lang->line( 'book_list' ); ?>
                                    </a></li>
                                <li class="<?php echo set_Submenu( 'member/index' ); ?>">
                                    <a href="<?php echo base_url(); ?>admin/member"><i class="fa fa-angle-double-right"></i><?php echo $this->lang->line( 'issue_return' ); ?>
                                    </a></li>
                                <li class="<?php echo set_Submenu( 'member/student' ); ?>">
                                    <a href="<?php echo base_url(); ?>admin/member/student"><i class="fa fa-angle-double-right"></i><?php echo $this->lang->line( 'add_student' ); ?>
                                    </a></li>
                                <li class="<?php echo set_Submenu( 'member/teacher' ); ?>">
                                    <a href="<?php echo base_url(); ?>admin/member/teacher"><i class="fa fa-angle-double-right"></i><?php echo $this->lang->line( 'add_teacher' ); ?>
                                    </a></li>
                                <li class="<?php echo set_Submenu( 'librarian/index' ); ?>">
                                    <a href="<?php echo base_url(); ?>admin/librarian"><i class="fa fa-angle-double-right"></i>Create Librarians' Account
                                    </a></li>
                            </ul>
                        </li>

                        <li class="treeview <?php echo set_Topmenu( 'Download Center' ); ?>">
                            <a href="#">
                                <i class="fa fa-download"></i>
                                <span>Download</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?php echo set_Submenu( 'content/index' ); ?>">
                                    <a href="<?php echo base_url(); ?>admin/content"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line( 'upload_content' ); ?>
                                    </a></li>
                                <li class="<?php echo set_Submenu( 'content/assignment' ); ?>">
                                    <a href="<?php echo base_url(); ?>admin/content/assignment"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line( 'assignments' ); ?>
                                    </a></li>
                                <li class="<?php echo set_Submenu( 'content/studymaterial' ); ?>">
                                    <a href="<?php echo base_url(); ?>admin/content/studymaterial"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line( 'study_material' ); ?>
                                    </a></li>
                                <!-- <li class="<?php echo set_Submenu( 'content/syllabus' ); ?>">
                                    <a href="<?php echo base_url(); ?>admin/content/syllabus"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line( 'syllabus' ); ?>
                                    </a></li> -->
                                <li class="<?php echo set_Submenu( 'content/other' ); ?>">
                                    <a href="<?php echo base_url(); ?>admin/content/other"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line( 'other_downloads' ); ?>
                                    </a></li>
                            </ul>
                        </li>

                        <li class="treeview <?php echo set_Topmenu( 'Transport' ); ?>">
                            <a href="#">
                                <i class="fa fa-bus"></i> <span><?php echo $this->lang->line( 'transport' ); ?></span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?php echo set_Submenu( 'route/index' ); ?>">
                                    <a href="<?php echo base_url(); ?>admin/route"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line( 'routes' ); ?>
                                    </a></li>
                                <li class="<?php echo set_Submenu( 'vehicle/index' ); ?>">
                                    <a href="<?php echo base_url(); ?>admin/vehicle"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line( 'vehicles' ); ?>
                                    </a></li>
                                <li class="<?php echo set_Submenu( 'vehroute/index' ); ?>">
                                    <a href="<?php echo base_url(); ?>admin/vehroute"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line( 'assign_vehicle' ); ?>
                                    </a></li>
                            </ul>
                        </li>

                        <li class="treeview <?php echo set_Topmenu( 'Hostel' ); ?>">
                            <a href="#">
                                <i class="fa fa-building-o"></i>
                                <span><?php echo $this->lang->line( 'hostel' ); ?></span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?php echo set_Submenu( 'hostelroom/index' ); ?>">
                                    <a href="<?php echo base_url(); ?>admin/hostelroom"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line( 'hostel_rooms' ); ?>
                                    </a></li>

                                <li class="<?php echo set_Submenu( 'roomtype/index' ); ?>">
                                    <a href="<?php echo base_url(); ?>admin/roomtype"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line( 'room_type' ); ?>
                                    </a></li>

                                <li class="<?php echo set_Submenu( 'hostel/index' ); ?>">
                                    <a href="<?php echo base_url(); ?>admin/hostel"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line( 'hostel' ); ?>
                                    </a></li>
                            </ul>
                        </li>

                        <li class="treeview <?php echo set_Topmenu( 'System Settings' ); ?>">
                            <a href="#">
                                <i class="fa fa-gears"></i>
                                <span>Settings</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?php echo set_Submenu( 'schsettings/index' ); ?>">
                                    <a href="<?php echo base_url(); ?>schsettings"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line( 'general_settings' ); ?>
                                    </a></li>

                                <li class="<?php echo set_Submenu( 'options/index' ); ?>">
                                    <a href="<?php echo base_url(); ?>options"><i class="fa fa-angle-double-right"></i> Options</a>
                                </li>

                                <li class="<?php echo set_Submenu( 'sessions/index' ); ?>">
                                    <a href="<?php echo base_url(); ?>sessions"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line( 'session_setting' ); ?>
                                    </a></li>
                                <li class="<?php echo set_Submenu( 'smsconfig/index' ); ?>">
                                    <a href="<?php echo base_url(); ?>smsconfig"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line( 'sms_setting' ); ?>
                                    </a></li>
                                <li class="<?php echo set_Submenu( 'emailconfig/index' ); ?>">
                                    <a href="<?php echo base_url(); ?>emailconfig"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line( 'email_setting' ); ?>
                                    </a></li>
                                <li class="<?php echo set_Submenu( 'admin/paymentsettings' ); ?>">
                                    <a href="<?php echo base_url(); ?>admin/paymentsettings"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line( 'paypal_setting' ); ?>
                                    </a></li>
                                <li class="<?php echo set_Submenu( 'admin/backup' ); ?>">
                                    <a href="<?php echo base_url(); ?>admin/admin/backup"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line( 'backup / restore' ); ?>
                                    </a></li>
                                <!--<li class="--><?php //echo set_Submenu( 'language/index' ); ?><!--">-->
                                <!--    <a href="--><?php //echo base_url(); ?><!--admin/language"><i class="fa fa-angle-double-right"></i> --><?php //echo $this->lang->line( 'languages' ); ?>
                                <!--    </a></li>-->
                                <?php
                                if ($this->customlib->getAdminSessionUserRole() == 'admin_main') {
                                ?>

                                    <li class="<?php echo set_Submenu( 'uses/index' ); ?>">
                                        <a href="<?php echo base_url(); ?>admin/adminuser"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line( 'admin_users' ); ?>
                                        </a></li>
                                <?php
                                }
                                ?>
                                <li class="<?php echo set_Submenu( 'uses/index' ); ?>">
                                    <a href="<?php echo base_url(); ?>admin/users"><i class="fa fa-angle-double-right"></i> <?php echo $this->lang->line( 'users' ); ?>
                                    </a></li>
                            </ul>
                        </li>
                    </ul>
                </section>
            </aside>
            <?php }?>
            <script>
            $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
            });
            </script>
            <script type="text/javascript">
                jQuery( function ( $ ) {
                    var sidebar_menu_list_item = $( ".sidebar-menu > li" );
//                    sidebar_menu_list_item.each( function ( i, d ) {
//                        var last = sidebar_menu_list_item.length - 1,
//                            sec_last = sidebar_menu_list_item.length - 2,
//                            third_last = sidebar_menu_list_item.length - 3;
//
//                        if ( last == i || sec_last == i || third_last == i ) {
//                            var submenu = $( d ).find( '.treeview-menu' ),
//                                submenu_height = submenu.height();
//
//                            submenu.css( 'top', -(submenu_height - $( d ).height() + 10) );
//                        }
//                    } );

                    sidebar_menu_list_item.each( function ( i, d ) {
                        $( d ).on( 'hover mousein mouseout', function () {
                            var last = sidebar_menu_list_item.length - 1,
                                sec_last = sidebar_menu_list_item.length - 2,
                                third_last = sidebar_menu_list_item.length - 3;

                            if ( last == i || sec_last == i || third_last == i ) {
                                var submenu = $( d ).find( '.treeview-menu' ),
                                    submenu_height = submenu.height();

                                submenu.css( 'top', -(submenu_height - $( d ).height()) );
                            }
                        } );
                    } );
                } );
            </script>