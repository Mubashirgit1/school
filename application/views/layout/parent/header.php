<!DOCTYPE html>
<html <?php echo $this->customlib->getRTL();?>>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $this->customlib->getAppName(); ?></title>      
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="theme-color" content="#424242" />
    <link href="<?php echo base_url(); ?>backend/images/s-favican.png" rel="shortcut icon" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo base_url(); ?>backend/bootstrap/css/bootstrap.min.css?v=0.2">
    <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/ss-main.css?v=0.127">
<!--    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">-->
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">

    <?php
    if($this->customlib->getRTL() != ""){
        ?>
        <!-- Bootstrap 3.3.5 RTL -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/rtl/bootstrap-rtl/css/bootstrap-rtl.min.css"/>  
        <!-- Theme RTL style -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/rtl/dist/css/AdminLTE-rtl.min.css" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/rtl/dist/css/ss-rtlmain.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/rtl/dist/css/skins/_all-skins-rtl.min.css" />

        <?php 

    }else{

    }

    ?>
    <link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/font-awesome.min.css">      
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
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and me/
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <![endif]-->
            
        </head>
        <?php 
            $admind = $this->admin_model->get(null,1);
            $this->load->helper('menu_helper');
            $permission = admin_permission($admind[0]['admin_id']);
           
        ?>
        <body class="hold-transition skin-blue fixed sidebar-mini">
            <div class="wrapper">
                <header class="main-header">            
                    <a href="<?php echo base_url(); ?>parent/parents/dashboard" class="logo">                   
                        <span class="logo-mini">S S</span>                  
                        <?php  $school_logo  = $this->setting_model->getCurrentImage(); ?>
                        <span class="logo-lg"><img src="<?= base_url( "{$school_logo}" ) ?>" alt="<?php echo $this->customlib->getAppName() ?>" /></span>
                    </a>              
                    <nav class="navbar navbar-static-top" role="navigation">                  
                        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </a>
                    <div class="col-md-5 col-sm-3 col-xs-5">     
                        <span href="#" class="sidebar-session">
                            <!--<?php echo $this->setting_model->getCurrentSchoolName(); ?>-->
                            <a style='font-size:15px' class='text-black' href="<?php echo base_url(); ?>parent/parents/dashboard">
                                
                                <i class="fa fa-desktop"></i>
                            </a>
                            
                        </span>
                    </div>    
                    <div class="col-md-7 col-sm-9 col-xs-7">
                      <div class="pull-right">    

                    <a href="<?php echo base_url(); ?>parent/notification" class="las la-bell text-black" style="font-size: 20px;margin-top: 15px;">
                        <!--<span class="fa fa-comment"></span>-->
                        <?php
                                    $ntf = $this->customlib->getParentunreadNotification();

                                    if ($ntf) {
                                        ?>
                                         <span class="num"><?php echo $ntf; ?></span>
                                        
                                        <?php
                                    }
                                    ?>
                       
                    </a>
                            <a href="<?php echo base_url(); ?>parent/notification">
                             
                            
                                  
                                </a>
                      
                        <div class="navbar-custom-menu" style='width:auto'>
                       
                            <ul class="nav navbar-nav"> 
                             
                                <li class="dropdown">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-user">
                                        <li><a href="#"><i class="fa fa-user"></i><?php echo $this->customlib->getStudentSessionUserName();
                                        ?></a>
                                        </li>
                                        <li><a href="<?php echo base_url(); ?>parent/parents/changepass"><i class="fa fa-key"></i><?php echo $this->lang->line('change_password'); ?></a>
                                        </li>
                                        
                                        
                                        <li class="divider"></li>
                                        <li><a href="<?php echo base_url(); ?>site/logout"><i class="fa fa-sign-out fa-fw"></i> <?php echo $this->lang->line('logout'); ?></a>
                                        </li>
                                    </ul>                              
                                </li>  
                            </ul>
                            
                        </div>
                        <div></div>
                       </div>
                      </div>  
                    </nav>
                </header>
                
                
                <aside class="main-sidebar">              
                    <section class="sidebar" id="sibe-box">                   
                        <ul class="sidebar-menu">
                       
                        <!-- <li class="removehover">
                            < ?php echo $this->lang->line('current_session').": " . $this->setting_model->getCurrentSessionName(); ?>
                        </li> -->
                            <li class="treeview <?php echo set_Topmenu('My Children'); ?>">
                                <a href="#">
                                 <span>
                                    Children</span> 
                                </a>
                                <ul class="treeview-menu ">
                                    <?php
                                    $ch = $this->session->userdata('parent_childs');
                                    foreach ($ch as $key_ch => $value_ch) {
                                        ?>
                                        <li class="<?php echo set_Submenu('parent/parents/getStudent'); ?>" ><a href="<?php echo base_url(); ?>parent/parents/getstudent/<?php echo $value_ch['student_id'] ?>"><i class="fa fa-angle-double-right"></i> <?php echo $value_ch['name'] ?></a></li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </li>
                            <li class="treeview <?php echo set_Topmenu('Examination'); ?>">
                                <a href="#">
                               <span>Exam</span> 
                                </a>
                                <ul class="treeview-menu ">
                                    <?php
                                    $ch = $this->session->userdata('parent_childs');
                                    foreach ($ch as $key_ch => $value_ch) {
                                        ?>
                                        <li class="<?php echo set_Submenu('parent/parents/getexams'); ?>"><a href="<?php echo base_url(); ?>parent/parents/getexams/<?php echo $value_ch['student_id'] ?>"><i class="fa fa-angle-double-right"></i> <?php echo $value_ch['name'] ?></a></li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </li>
                            <!--<li class="treeview <?php echo set_Topmenu('My Children'); ?>">-->
                            <!--    <a href="#">-->
                                
                            <!--        Document</span> -->
                            <!--    </a>-->
                            <!--    <ul class="treeview-menu ">-->
                            <!--        <?php
                                   $ch = $this->session->userdata('parent_childs');
                                   foreach ($ch as $key_ch => $value_ch) {
                                        ?>-->
                            <!--            <li class="<?php echo set_Submenu('parent/parents/getdocuments'); ?>" ><a href="<?php echo base_url(); ?>parent/parents/getdocuments/<?php echo $value_ch['student_id'] ?>"><i class="fa fa-angle-double-right"></i> <?php echo $value_ch['name'] ?></a></li>-->
                            <!--            <?php        }
                            ?>-->
                            <!--    </ul>-->
                            <!--</li>-->
                            <li class="treeview ">
                                <a href="#">
                                <span>Attendance</span>
                                </a>
                                <ul class="treeview-menu">
                                    <?php
                                    $ch = $this->session->userdata('parent_childs');
                                    foreach ($ch as $key_ch => $value_ch) {
                                        ?>
                                        <li class="<?php echo set_Submenu('parent/parents/getattendence'); ?>"><a href="<?php echo base_url(); ?>parent/parents/getattendence/<?php echo $value_ch['student_id'] ?>"><i class="fa fa-angle-double-right"></i> <?php echo $value_ch['name'] ?></a></li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </li>
                            <li class="treeview ">
                                <a href="#">
                                 Discount</span> 
                                </a>
                                <ul class="treeview-menu">
                                    <?php
                                    $ch = $this->session->userdata('parent_childs');
                                    foreach ($ch as $key_ch => $value_ch) {
                                        ?>
                                        <li class="<?php echo set_Submenu('parent/parents/getdiscount'); ?>"><a href="<?php echo base_url(); ?>parent/parents/getdiscount/<?php echo $value_ch['student_id'] ?>"><i class="fa fa-angle-double-right"></i> <?php echo $value_ch['name'] ?></a></li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </li>
                            <li class="treeview  ">
                                <a href="#">
                                 Graph</span> 
                                </a>
                                <ul class="treeview-menu">
                                    <?php
                                    $ch = $this->session->userdata('parent_childs');
                                    foreach ($ch as $key_ch => $value_ch) {
                                        ?>
                                        <li class="<?php echo set_Submenu('parent/parents/getgraph'); ?>"><a href="<?php echo base_url(); ?>parent/parents/getgraph/<?php echo $value_ch['student_id'] ?>"><i class="fa fa-angle-double-right"></i> <?php echo $value_ch['name'] ?></a></li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </li>
                            <li class="treeview  ">
                                <a href="#">
                             Fee History</span>    
                                </a>
                                <ul class="treeview-menu">
                                    <?php
                                    $ch = $this->session->userdata('parent_childs');
                                    foreach ($ch as $key_ch => $value_ch) {
                                        ?>
                                        <li class="<?php echo set_Submenu('parent/parents/getfeehistory'); ?>"><a href="<?php echo base_url(); ?>parent/parents/getfeehistory/<?php echo $value_ch['student_id'] ?>"><i class="fa fa-angle-double-right"></i> <?php echo $value_ch['name'] ?></a></li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </li>
                            <li class="treeview  ">
                                <a href="<?php echo base_url(); ?>parent/parents/getduefee">
                                 Due Fee</span> 
                                </a>
                              
                            </li>
                            <li class="treeview  ">
                                <a href="<?php echo base_url(); ?>parent/parents/dateSheet">

                               Date Sheet</span> <i class="fa fa-angle-left pull-right"></i>
                                </a>
                               
                            </li>
                            <!-- <li class="treeview <?php echo set_Topmenu('Fees'); ?>">
                                <a href="#">
                                    <i class="fa fa-money"></i> <span><?php echo $this->lang->line('fees'); ?></span> <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <?php
                                    $ch = $this->session->userdata('parent_childs');
                                    foreach ($ch as $key_ch => $value_ch) {
                                        ?>
                                        <li class="<?php echo set_Submenu('parent/parents/getFees'); ?>" ><a href="<?php echo base_url(); ?>parent/parents/getfees/<?php echo $value_ch['student_id'] ?>"><i class="fa fa-angle-double-right"></i> <?php echo $value_ch['name'] ?></a></li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </li> -->
                            <li class="treeview <?php echo set_Topmenu('Subjects'); ?>">
                                <a href="#">
                                    <i class="fa fa-language"></i> <span><?php echo $this->lang->line('subjects'); ?></span> <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <?php
                                    $ch = $this->session->userdata('parent_childs');
                                    foreach ($ch as $key_ch => $value_ch) {
                                        ?>
                                        <li class="<?php echo set_Submenu('parent/parents/getsubject'); ?>"><a href="<?php echo base_url(); ?>parent/parents/getsubject/<?php echo $value_ch['student_id'] ?>"><i class="fa fa-angle-double-right"></i> <?php echo $value_ch['name'] ?></a></li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </li>
                            <li class="treeview <?php echo set_Topmenu('Time Table'); ?>">
                                <a href="#">
                                    <i class="fa fa-calendar-times-o"></i> <span>Timetable</span> <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <?php
                                    $ch = $this->session->userdata('parent_childs');
                                    foreach ($ch as $key_ch => $value_ch) {
                                        ?>
                                        <li class="<?php echo set_Submenu('parent/parents/gettimetable'); ?>"><a href="<?php echo base_url(); ?>parent/parents/gettimetable/<?php echo $value_ch['student_id'] ?>"><i class="fa fa-angle-double-right"></i> <?php echo $value_ch['name'] ?></a></li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </li>
                            <li class="treeview <?php echo set_Topmenu('OnlineClass'); ?>">
                                <a href="#">
                                     <span>Online Class</span> <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <?php
                                    $ch = $this->session->userdata('parent_childs');
                                    foreach ($ch as $key_ch => $value_ch) {
                                        ?>
                                        <li class="<?php echo set_Submenu('parent/parents/getonlineclass'); ?>"><a href="<?php echo base_url(); ?>parent/parents/getonlineclass/<?php echo $value_ch['student_id'] ?>"><i class="fa fa-angle-double-right"></i> <?php echo $value_ch['name'] ?></a></li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </li>
                            <li class="treeview <?php echo set_Topmenu('Youtube'); ?>">
                                <a href="#">
                                     <span>Youtube</span> <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <?php
                                    $ch = $this->session->userdata('parent_childs');
                                    foreach ($ch as $key_ch => $value_ch) {
                                        ?>
                                        <li class="<?php echo set_Submenu('parent/parents/getyoutube'); ?>"><a href="<?php echo base_url(); ?>parent/parents/getyoutube/<?php echo $value_ch['student_id'] ?>"><i class="fa fa-angle-double-right"></i> <?php echo $value_ch['name'] ?></a></li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </li>
                            <li class="treeview <?php echo set_Topmenu('Homework'); ?>">
                                <a href="#">
                                     <span>Homework</span> <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <?php
                                    $ch = $this->session->userdata('parent_childs');
                                    foreach ($ch as $key_ch => $value_ch) {
                                        ?>
                                        <li class="<?php echo set_Submenu('parent/parents/homework'); ?>"><a href="<?php echo base_url(); ?>parent/parents/getHomework/<?php echo $value_ch['student_id'] ?>"><i class="fa fa-angle-double-right"></i> <?php echo $value_ch['name'] ?></a></li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </li>
                            <li class="treeview <?php echo set_Topmenu('Assignment'); ?>">
                                <a href="#">
                                     <span>Assignment</span> <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <?php
                                    $ch = $this->session->userdata('parent_childs');
                                    foreach ($ch as $key_ch => $value_ch) {
                                        ?>
                                        <li class="<?php echo set_Submenu('parent/parents/assignment'); ?>"><a href="<?php echo base_url(); ?>parent/parents/getAssignment/<?php echo $value_ch['student_id'] ?>"><i class="fa fa-angle-double-right"></i> <?php echo $value_ch['name'] ?></a></li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </li>
                            <li class="treeview <?php echo set_Topmenu('Vocation'); ?>">
                                <a href="#">
                                     <span>Vacation/Note</span> <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <?php
                                    $ch = $this->session->userdata('parent_childs');
                                    foreach ($ch as $key_ch => $value_ch) {
                                        ?>
                                        <li class="<?php echo set_Submenu('parent/parents/vocation'); ?>"><a href="<?php echo base_url(); ?>parent/parents/getVocation/<?php echo $value_ch['student_id'] ?>"><i class="fa fa-angle-double-right"></i> <?php echo $value_ch['name'] ?></a></li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </li>
                            <li class="treeview <?php echo set_Topmenu('Syllabus'); ?>">
                                <a href="#">
                                     <span>Syllabus</span> <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <?php
                                    $ch = $this->session->userdata('parent_childs');
                                    foreach ($ch as $key_ch => $value_ch) {
                                        ?>
                                        <li class="<?php echo set_Submenu('parent/parents/Syllabus'); ?>"><a href="<?php echo base_url(); ?>parent/parents/getSyllabus/<?php echo $value_ch['student_id'] ?>"><i class="fa fa-angle-double-right"></i> <?php echo $value_ch['name'] ?></a></li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </li>
                            
                            <!-- <li class="<?php echo set_Submenu('teacher/index'); ?>"><a href="<?php echo base_url(); ?>parent/teacher"><i class="fa fa-user-secret"></i> <?php echo $this->lang->line('teachers'); ?></a></li>
                            <li class="<?php echo set_Topmenu('Library'); ?>"><a href="<?php echo base_url(); ?>parent/book"><i class="fa fa-book"></i> <?php echo $this->lang->line('library_books'); ?></a></li> -->
                            <!-- <li class="treeview <?php echo set_Topmenu('Transport'); ?>"><a href="<?php echo base_url(); ?>parent/route"><i class="fa fa-bus"></i> <?php echo $this->lang->line('transport_routes'); ?></a></li> -->
                            <!-- <li class="<?php echo set_Submenu('hostel/index'); ?>"><a href="<?php echo base_url(); ?>parent/hostel"><i class="fa fa-building-o"></i> <?php echo $this->lang->line('hostel'); ?></a></li> -->
                        </ul>
                    </section>              
                </aside>  
                
                
                <!--<style>-->
                
                <!--    @media (max-width:767px)-->
                <!--        .main-header .navbar-custom-menu{-->
                <!--         width:auto !importmant;   -->
                <!--        }-->
                <!--</style>-->
                
                
                <style>
                    
                    /*.sidebar{*/
                    /*    overflow:scroll !important;*/
                    /*}*/
                </style>
                
                <script>
                    
                    $(function(){
                        
                        $('.slimScrollDiv').slimScroll({
                            height:'250px'
                        });
                        $('.sidebar').slimScroll({
                            height:'250px'
                        });
                        
                        
                    })
                </script>
                
                
                