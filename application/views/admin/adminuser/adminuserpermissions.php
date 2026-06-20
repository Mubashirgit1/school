
<style type="text/css">
    @media print
    {
        .no-print, .no-print *
        {
            display: none !important;
        }
    }
    .outerDivFull { margin:50px; }

    .switchToggle input[type=checkbox]{height: 0; width: 0; visibility: hidden; position: absolute; }
    .switchToggle label {cursor: pointer; text-indent: -9999px; width: 70px; max-width: 70px; height: 30px; background: #d1d1d1; display: block; border-radius: 100px; position: relative; }
    .switchToggle label:after {content: ''; position: absolute; top: 2px; left: 2px; width: 26px; height: 26px; background: #fff; border-radius: 90px; transition: 0.3s; }
    .switchToggle input:checked + label, .switchToggle input:checked + input + label  {background: #3e98d3; }
    .switchToggle input + label:before, .switchToggle input + input + label:before {content: 'No'; position: absolute; top: 5px; left: 35px; width: 26px; height: 26px; border-radius: 90px; transition: 0.3s; text-indent: 0; color: #fff; }
    .switchToggle input:checked + label:before, .switchToggle input:checked + input + label:before {content: 'Yes'; position: absolute; top: 5px; left: 10px; width: 26px; height: 26px; border-radius: 90px; transition: 0.3s; text-indent: 0; color: #fff; }
    .switchToggle input:checked + label:after, .switchToggle input:checked + input + label:after {left: calc(100% - 2px); transform: translateX(-100%); }
    .switchToggle label:active:after {width: 60px; }
    .toggle-switchArea { margin: 10px 0 10px 0; }



    .panel.with-nav-tabs .panel-heading{
    padding: 5px 5px 0 5px;
}
.panel.with-nav-tabs .nav-tabs{
	border-bottom: none;
}
.panel.with-nav-tabs .nav-justified{
	margin-bottom: -1px;
}


    .with-nav-tabs.panel-default .nav-tabs > li > a,
.with-nav-tabs.panel-default .nav-tabs > li > a:hover,
.with-nav-tabs.panel-default .nav-tabs > li > a:focus {
    color: #777;
}
.with-nav-tabs.panel-default .nav-tabs > .open > a,
.with-nav-tabs.panel-default .nav-tabs > .open > a:hover,
.with-nav-tabs.panel-default .nav-tabs > .open > a:focus,
.with-nav-tabs.panel-default .nav-tabs > li > a:hover,
.with-nav-tabs.panel-default .nav-tabs > li > a:focus {
    color: #777;
	background-color: #ddd;
	border-color: transparent;
}
.with-nav-tabs.panel-default .nav-tabs > li.active > a,
.with-nav-tabs.panel-default .nav-tabs > li.active > a:hover,
.with-nav-tabs.panel-default .nav-tabs > li.active > a:focus {
	color: #555;
	background-color: #fff;
	border-color: #ddd;
	border-bottom-color: transparent;
}
.with-nav-tabs.panel-default .nav-tabs > li.dropdown .dropdown-menu {
    background-color: #f5f5f5;
    border-color: #ddd;
}
.with-nav-tabs.panel-default .nav-tabs > li.dropdown .dropdown-menu > li > a {
    color: #777;   
}
.with-nav-tabs.panel-default .nav-tabs > li.dropdown .dropdown-menu > li > a:hover,
.with-nav-tabs.panel-default .nav-tabs > li.dropdown .dropdown-menu > li > a:focus {
    background-color: #ddd;
}
.with-nav-tabs.panel-default .nav-tabs > li.dropdown .dropdown-menu > .active > a,
.with-nav-tabs.panel-default .nav-tabs > li.dropdown .dropdown-menu > .active > a:hover,
.with-nav-tabs.panel-default .nav-tabs > li.dropdown .dropdown-menu > .active > a:focus {
    color: #fff;
    background-color: #555;
}
/********************************************************************/
/*** PANEL PRIMARY ***/
.with-nav-tabs.panel-primary .nav-tabs > li > a,
.with-nav-tabs.panel-primary .nav-tabs > li > a:hover,
.with-nav-tabs.panel-primary .nav-tabs > li > a:focus {
    color: #fff;
}
.with-nav-tabs.panel-primary .nav-tabs > .open > a,
.with-nav-tabs.panel-primary .nav-tabs > .open > a:hover,
.with-nav-tabs.panel-primary .nav-tabs > .open > a:focus,
.with-nav-tabs.panel-primary .nav-tabs > li > a:hover,
.with-nav-tabs.panel-primary .nav-tabs > li > a:focus {
	color: #fff;
	background-color: #3071a9;
	border-color: transparent;
}
.with-nav-tabs.panel-primary .nav-tabs > li.active > a,
.with-nav-tabs.panel-primary .nav-tabs > li.active > a:hover,
.with-nav-tabs.panel-primary .nav-tabs > li.active > a:focus {
	color: #428bca;
	background-color: #fff;
	border-color: #428bca;
	border-bottom-color: transparent;
}
.with-nav-tabs.panel-primary .nav-tabs > li.dropdown .dropdown-menu {
    background-color: #428bca;
    border-color: #3071a9;
}
.with-nav-tabs.panel-primary .nav-tabs > li.dropdown .dropdown-menu > li > a {
    color: #fff;   
}
.with-nav-tabs.panel-primary .nav-tabs > li.dropdown .dropdown-menu > li > a:hover,
.with-nav-tabs.panel-primary .nav-tabs > li.dropdown .dropdown-menu > li > a:focus {
    background-color: #3071a9;
}
.with-nav-tabs.panel-primary .nav-tabs > li.dropdown .dropdown-menu > .active > a,
.with-nav-tabs.panel-primary .nav-tabs > li.dropdown .dropdown-menu > .active > a:hover,
.with-nav-tabs.panel-primary .nav-tabs > li.dropdown .dropdown-menu > .active > a:focus {
    background-color: #4a9fe9;
}
/********************************************************************/
/*** PANEL SUCCESS ***/
.with-nav-tabs.panel-success .nav-tabs > li > a,
.with-nav-tabs.panel-success .nav-tabs > li > a:hover,
.with-nav-tabs.panel-success .nav-tabs > li > a:focus {
	color: #3c763d;
}
.with-nav-tabs.panel-success .nav-tabs > .open > a,
.with-nav-tabs.panel-success .nav-tabs > .open > a:hover,
.with-nav-tabs.panel-success .nav-tabs > .open > a:focus,
.with-nav-tabs.panel-success .nav-tabs > li > a:hover,
.with-nav-tabs.panel-success .nav-tabs > li > a:focus {
	color: #3c763d;
	background-color: #d6e9c6;
	border-color: transparent;
}
.with-nav-tabs.panel-success .nav-tabs > li.active > a,
.with-nav-tabs.panel-success .nav-tabs > li.active > a:hover,
.with-nav-tabs.panel-success .nav-tabs > li.active > a:focus {
	color: #3c763d;
	background-color: #fff;
	border-color: #d6e9c6;
	border-bottom-color: transparent;
}
.with-nav-tabs.panel-success .nav-tabs > li.dropdown .dropdown-menu {
    background-color: #dff0d8;
    border-color: #d6e9c6;
}
.with-nav-tabs.panel-success .nav-tabs > li.dropdown .dropdown-menu > li > a {
    color: #3c763d;   
}
.with-nav-tabs.panel-success .nav-tabs > li.dropdown .dropdown-menu > li > a:hover,
.with-nav-tabs.panel-success .nav-tabs > li.dropdown .dropdown-menu > li > a:focus {
    background-color: #d6e9c6;
}
.with-nav-tabs.panel-success .nav-tabs > li.dropdown .dropdown-menu > .active > a,
.with-nav-tabs.panel-success .nav-tabs > li.dropdown .dropdown-menu > .active > a:hover,
.with-nav-tabs.panel-success .nav-tabs > li.dropdown .dropdown-menu > .active > a:focus {
    color: #fff;
    background-color: #3c763d;
}
/********************************************************************/
/*** PANEL INFO ***/
.with-nav-tabs.panel-info .nav-tabs > li > a,
.with-nav-tabs.panel-info .nav-tabs > li > a:hover,
.with-nav-tabs.panel-info .nav-tabs > li > a:focus {
	color: #31708f;
}
.with-nav-tabs.panel-info .nav-tabs > .open > a,
.with-nav-tabs.panel-info .nav-tabs > .open > a:hover,
.with-nav-tabs.panel-info .nav-tabs > .open > a:focus,
.with-nav-tabs.panel-info .nav-tabs > li > a:hover,
.with-nav-tabs.panel-info .nav-tabs > li > a:focus {
	color: #31708f;
	background-color: #bce8f1;
	border-color: transparent;
}
.with-nav-tabs.panel-info .nav-tabs > li.active > a,
.with-nav-tabs.panel-info .nav-tabs > li.active > a:hover,
.with-nav-tabs.panel-info .nav-tabs > li.active > a:focus {
	color: #31708f;
	background-color: #fff;
	border-color: #bce8f1;
	border-bottom-color: transparent;
}
.with-nav-tabs.panel-info .nav-tabs > li.dropdown .dropdown-menu {
    background-color: #d9edf7;
    border-color: #bce8f1;
}
.with-nav-tabs.panel-info .nav-tabs > li.dropdown .dropdown-menu > li > a {
    color: #31708f;   
}
.with-nav-tabs.panel-info .nav-tabs > li.dropdown .dropdown-menu > li > a:hover,
.with-nav-tabs.panel-info .nav-tabs > li.dropdown .dropdown-menu > li > a:focus {
    background-color: #bce8f1;
}
.with-nav-tabs.panel-info .nav-tabs > li.dropdown .dropdown-menu > .active > a,
.with-nav-tabs.panel-info .nav-tabs > li.dropdown .dropdown-menu > .active > a:hover,
.with-nav-tabs.panel-info .nav-tabs > li.dropdown .dropdown-menu > .active > a:focus {
    color: #fff;
    background-color: #31708f;
}
/********************************************************************/
/*** PANEL WARNING ***/
.with-nav-tabs.panel-warning .nav-tabs > li > a,
.with-nav-tabs.panel-warning .nav-tabs > li > a:hover,
.with-nav-tabs.panel-warning .nav-tabs > li > a:focus {
	color: #8a6d3b;
}
.with-nav-tabs.panel-warning .nav-tabs > .open > a,
.with-nav-tabs.panel-warning .nav-tabs > .open > a:hover,
.with-nav-tabs.panel-warning .nav-tabs > .open > a:focus,
.with-nav-tabs.panel-warning .nav-tabs > li > a:hover,
.with-nav-tabs.panel-warning .nav-tabs > li > a:focus {
	color: #8a6d3b;
	background-color: #faebcc;
	border-color: transparent;
}
.with-nav-tabs.panel-warning .nav-tabs > li.active > a,
.with-nav-tabs.panel-warning .nav-tabs > li.active > a:hover,
.with-nav-tabs.panel-warning .nav-tabs > li.active > a:focus {
	color: #8a6d3b;
	background-color: #fff;
	border-color: #faebcc;
	border-bottom-color: transparent;
}
.with-nav-tabs.panel-warning .nav-tabs > li.dropdown .dropdown-menu {
    background-color: #fcf8e3;
    border-color: #faebcc;
}
.with-nav-tabs.panel-warning .nav-tabs > li.dropdown .dropdown-menu > li > a {
    color: #8a6d3b; 
}
.with-nav-tabs.panel-warning .nav-tabs > li.dropdown .dropdown-menu > li > a:hover,
.with-nav-tabs.panel-warning .nav-tabs > li.dropdown .dropdown-menu > li > a:focus {
    background-color: #faebcc;
}
.with-nav-tabs.panel-warning .nav-tabs > li.dropdown .dropdown-menu > .active > a,
.with-nav-tabs.panel-warning .nav-tabs > li.dropdown .dropdown-menu > .active > a:hover,
.with-nav-tabs.panel-warning .nav-tabs > li.dropdown .dropdown-menu > .active > a:focus {
    color: #fff;
    background-color: #8a6d3b;
}
/********************************************************************/
/*** PANEL DANGER ***/
.with-nav-tabs.panel-danger .nav-tabs > li > a,
.with-nav-tabs.panel-danger .nav-tabs > li > a:hover,
.with-nav-tabs.panel-danger .nav-tabs > li > a:focus {
	color: #a94442;
}
.with-nav-tabs.panel-danger .nav-tabs > .open > a,
.with-nav-tabs.panel-danger .nav-tabs > .open > a:hover,
.with-nav-tabs.panel-danger .nav-tabs > .open > a:focus,
.with-nav-tabs.panel-danger .nav-tabs > li > a:hover,
.with-nav-tabs.panel-danger .nav-tabs > li > a:focus {
	color: #a94442;
	background-color: #ebccd1;
	border-color: transparent;
}
.with-nav-tabs.panel-danger .nav-tabs > li.active > a,
.with-nav-tabs.panel-danger .nav-tabs > li.active > a:hover,
.with-nav-tabs.panel-danger .nav-tabs > li.active > a:focus {
	color: #a94442;
	background-color: #fff;
	border-color: #ebccd1;
	border-bottom-color: transparent;
}
.with-nav-tabs.panel-danger .nav-tabs > li.dropdown .dropdown-menu {
    background-color: #f2dede; /* bg color */
    border-color: #ebccd1; /* border color */
}
.with-nav-tabs.panel-danger .nav-tabs > li.dropdown .dropdown-menu > li > a {
    color: #a94442; /* normal text color */  
}
.with-nav-tabs.panel-danger .nav-tabs > li.dropdown .dropdown-menu > li > a:hover,
.with-nav-tabs.panel-danger .nav-tabs > li.dropdown .dropdown-menu > li > a:focus {
    background-color: #ebccd1; /* hover bg color */
}
.with-nav-tabs.panel-danger .nav-tabs > li.dropdown .dropdown-menu > .active > a,
.with-nav-tabs.panel-danger .nav-tabs > li.dropdown .dropdown-menu > .active > a:hover,
.with-nav-tabs.panel-danger .nav-tabs > li.dropdown .dropdown-menu > .active > a:focus {
    color: #fff; /* active text color */
    background-color: #a94442; /* active bg color */
}

.nav-tabs li{
    font-size: 24px;
    padding: 0px 11px;
}

.p_font{
    font-size: 20px;
    color:#007eff;
    padding-bottom: 15px !important;
}

</style>


<div class="content-wrapper" style="min-height: 946px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">

    <div class="box box-primary" style="margin-bottom:0px">
                    <div class="box-header with-border" style="padding:20px">
                        <h2 class="box-title" style="display: block;">
                        User Permissions
                            <small><?php echo $this->lang->line( 'student1' ); ?></small>
                            <span class="pull-right">
                            Name (<?php echo $admin['username'] ?>)
                                - Email (<?php echo $admin['email'] ?>)
                                - Role (<?php echo $admin['role'] ?>)
                            </span>
                        </h2>
                    </div>
                    </div>
    
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- Horizontal Form -->
                <div class="box box-primary">



                <div class="panel with-nav-tabs panel-default">
                <div class="panel-heading">
                        <ul class="nav nav-tabs">
                            <li title="New Registration" data-toggle="tooltip" data-placement="bottom" class="active"><a href="#tab1default" data-toggle="tab"><i class="fa fa-user-plus"></i></a></li>
                            <li title="Academics " data-toggle="tooltip" data-placement="bottom" ><a href="#tab2" data-toggle="tab"><i class="glyphicon glyphicon-education"></i></a></li>
                            <li title="Holiday" data-toggle="tooltip" data-placement="bottom" ><a href="#tab3" data-toggle="tab"><i class="glyphicon glyphicon-bell"></i></a></li>
                            <li title="Student ID Card" data-toggle="tooltip" data-placement="bottom" ><a href="#tab4" data-toggle="tab"><i class="fas fa-id-card"></i></a></li>
                            <li title="Session Access" data-toggle="tooltip" data-placement="bottom" ><a href="#tab5" data-toggle="tab"><i class="far fa-calendar-alt"></i></a></li>
                            <li title="Graphs " data-toggle="tooltip" data-placement="bottom" ><a href="#tab6" data-toggle="tab"><i class="glyphicon glyphicon-signal"></i></a></li>
                            <li title="Exams " data-toggle="tooltip" data-placement="bottom" ><a href="#tab7" data-toggle="tab"><i class="glyphicon glyphicon-duplicate"></i></a></li>
                            <li title="Voucher generation " data-toggle="tooltip" data-placement="bottom" ><a href="#tab8" data-toggle="tab"><i class="glyphicon glyphicon-qrcode"></i></a></li>
                            <li title=" Media center" data-toggle="tooltip" data-placement="bottom" ><a href="#tab9" data-toggle="tab"><i class="fa fa-envelope"></i></a></li>
                            <li title="Expense heads " data-toggle="tooltip" data-placement="bottom" ><a href="#tab10" data-toggle="tab"><i class="fa fa-list-alt"></i></a></li>
                            <li title=" Banking" data-toggle="tooltip" data-placement="bottom" ><a href="#tab12" data-toggle="tab"><i class="fas fa-university"></i></a></li>
                            <li title=" Daily Cash" data-toggle="tooltip" data-placement="bottom" ><a href="#tab13" data-toggle="tab"><i class="fa fa-briefcase"></i></a></li>
                            <li title="Staff | Teacher Payroll " data-toggle="tooltip" data-placement="bottom" ><a href="#tab14" data-toggle="tab"><i class="glyphicon glyphicon-paperclip"></i></a></li>
                            <li title="Fee Management" data-toggle="tooltip" data-placement="bottom" ><a href="#tab15" data-toggle="tab"><i class="fas fa-chart-line"></i></a></li>
                            <li title="Transactions delete/update" data-toggle="tooltip" data-placement="bottom" ><a href="#tab16" data-toggle="tab"><i class=" fas fa-exchange-alt"></i></a></li>
                            <li title="Balance sheet" data-toggle="tooltip" data-placement="bottom" ><a href="#tab17" data-toggle="tab"><i class="fas fa-tasks"></i></a></li>
                            <li title="Balance sheet" data-toggle="tooltip" data-placement="bottom" ><a href="#tab18" data-toggle="tab"><i class="fas fa-cog"></i></a></li>
                        </ul>
                </div>
                <form action="<?php echo site_url('admin/adminuser/permission') ?>"  id="permission_form" name="permission_form" method="post" accept-charset="utf-8">
                   
                   <input type="hidden" value="<?= $admin['admin_id']?>" name="admin_id">
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="tab1default">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="p_font">Permission Type</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Staff & Teacher Registration</td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox" name="admission_teacher" value="1" <?= $admin['admission_teacher'] == 1  ?' checked="checked"':'' ?> id="switch1">
                                                <label for="switch1">Toggle</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Student Admission</td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox" name="admission_student" value="1" <?= $admin['admission_student'] == 1  ?' checked="checked"':'' ?> id="switch2">
                                                <label for="switch2">Toggle</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Edition/Deletion/Withdrawl/Login Student</td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox" name="student_access" value="1" <?= $admin['student_access'] == 1  ?' checked="checked"':'' ?> id="switch3">
                                                <label for="switch3">Toggle</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Edition/Deletion/Login Teacher/Staff </td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox" name="teacher_access" value="1" <?= $admin['teacher_access'] == 1  ?' checked="checked"':'' ?> id="switch4">
                                                <label for="switch4">Toggle</label>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="tab2">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th class="p_font">Permission Type</th>
                                    <th>View</th>
                                    <th>Update</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Academics</td>
                                    <td>
                                        <div class="switchToggle">
                                            <input type="checkbox" name="academics" value="1" <?= $admin['academics'] == 1  ?' checked="checked"':'' ?> id="switch5">
                                            <label for="switch5">Toggle</label>
                                        </div>
                                    </td>
                                    <td>
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td>Class</td>
                                    <td>
                                        <div class="switchToggle">
                                            <input type="checkbox" name="class" value="1" <?= $admin['class'] == 1  ?' checked="checked"':'' ?> id="switch6">
                                            <label for="switch6">Toggle</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="switchToggle">
                                            <input type="checkbox" name="class_u" value="1" <?= $admin['class_u'] == 1  ?' checked="checked"':'' ?> id="switch7">
                                            <label for="switch7">Toggle</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Class Group</td>
                                    <td>
                                        <div class="switchToggle">
                                            <input type="checkbox" name="class_group" value="1" <?= $admin['class_group'] == 1  ?' checked="checked"':'' ?> id="switch75">
                                            <label for="switch75">Toggle</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Section</td>
                                    <td>
                                        <div class="switchToggle">
                                            <input type="checkbox" name="section" value="1" <?= $admin['section'] == 1  ?' checked="checked"':'' ?> id="switch8">
                                            <label for="switch8">Toggle</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="switchToggle">
                                            <input type="checkbox" name="section_u" value="1" <?= $admin['section_u'] == 1  ?' checked="checked"':'' ?> id="switch9">
                                            <label for="switch9">Toggle</label>
                                        </div>
                                    </td>
                                </tr><tr>
                                    <td>Subject</td>
                                    <td>
                                        <div class="switchToggle">
                                            <input type="checkbox" name="subject" value="1" <?= $admin['subject'] == 1  ?' checked="checked"':'' ?> id="switch10">
                                            <label for="switch10">Toggle</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="switchToggle">
                                            <input type="checkbox" name="subject_u" value="1" <?= $admin['subject_u'] == 1  ?' checked="checked"':'' ?> id="switch11">
                                            <label for="switch11">Toggle</label>
                                        </div>
                                    </td>
                                </tr><tr>
                                    <td>Assign Subject</td>
                                    <td>
                                        <div class="switchToggle">
                                            <input type="checkbox" name="assign_subject" value="1" <?= $admin['assign_subject'] == 1  ?' checked="checked"':'' ?> id="switch12">
                                            <label for="switch12">Toggle</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="switchToggle">
                                            <input type="checkbox" name="assign_subject_u" value="1" <?= $admin['assign_subject_u'] == 1  ?' checked="checked"':'' ?> id="switch13">
                                            <label for="switch13">Toggle</label>
                                        </div>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td>Assign Class in charge</td>
                                    <td>
                                        <div class="switchToggle">
                                            <input type="checkbox" name="assign_class_incharge" value="1" <?= $admin['assign_class_incharge'] == 1  ?' checked="checked"':'' ?> id="switch14">
                                            <label for="switch14">Toggle</label>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="switchToggle">
                                            <input type="checkbox" name="assign_class_incharge_u" value="1" <?= $admin['assign_class_incharge_u'] == 1  ?' checked="checked"':'' ?> id="switch15">
                                            <label for="switch15">Toggle</label>
                                        </div>
                                    </td>
                                </tr><tr>
                                    <td>Class wise Time table</td>
                                    <td>
                                        <div class="switchToggle">
                                            <input type="checkbox" name="class_wise_timtable" value="1" <?= $admin['class_wise_timtable'] == 1  ?' checked="checked"':'' ?> id="switch16">
                                            <label for="switch16">Toggle</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="switchToggle">
                                            <input type="checkbox" name="class_wise_timtable_u" value="1" <?= $admin['class_wise_timtable_u'] == 1  ?' checked="checked"':'' ?> id="switch17">
                                            <label for="switch17">Toggle</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Daily Timetable</td>
                                    <td>
                                        <div class="switchToggle">
                                            <input type="checkbox" name="daily_timetable" value="1" <?= $admin['daily_timetable'] == 1  ?' checked="checked"':'' ?> id="switch18">
                                            <label for="switch18">Toggle</label>
                                        </div>
                                    </td>
                                    <td>
                                    <div class="switchToggle">
                                            <input type="checkbox" name="daily_timetable_u" value="1" <?= $admin['daily_timetable_u'] == 1  ?' checked="checked"':'' ?> id="switch19">
                                            <label for="switch19">Toggle</label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Teacher wise Timetable	</td>
                                    <td>
                                        <div class="switchToggle">
                                            <input type="checkbox" name="teacher_wise_table" value="1" <?= $admin['teacher_wise_table'] == 1  ?' checked="checked"':'' ?> id="switch20">
                                            <label for="switch20">Toggle</label>
                                        </div>
                                    </td>
                                    <td>
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td>Classes Fee History</td>
                                    <td>
                                        <div class="switchToggle">
                                            <input type="checkbox" name="classes_fee_history" value="1" <?= $admin['classes_fee_history'] == 1  ?' checked="checked"':'' ?> id="switch21">
                                            <label for="switch21">Toggle</label>
                                        </div>
                                    </td>
                                    <td>
                                       
                                    </td>
                                </tr>
                                <tr>
                                    <td>Exam wise All Classes Date sheet</td>
                                    <td>
                                        <div class="switchToggle">
                                            <input type="checkbox" name="date_sheet_all" value="1" <?= $admin['date_sheet_all'] == 1  ?' checked="checked"':'' ?> id="switch22">
                                            <label for="switch22">Toggle</label>
                                        </div>
                                    </td>
                                    <td>
                                        
                                    </td>
                                </tr>
                                <tr>
                                <?php   $text_admission = $this->custom_option_model->get( 'text_admission' );?>
                                    <td>  
                                      <?= admission_text() ?> = Roll No</td>
                                    <td>
                                        <div class="switchToggle">
                                            <input type="checkbox" name="admission_roll" value="1" <?= $admin['admission_roll'] == 1  ?' checked="checked"':'' ?> id="switch80">
                                            <label for="switch80">Toggle</label>
                                        </div>
                                    </td>
                                    <td>
                                        
                                    </td>
                                </tr>
                             
                            </tbody>
                         </table>
                        </div>
                        <div class="tab-pane fade" id="tab3">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="p_font">Permission Type</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Holiday</td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox"  name="holiday" value="1" <?= $admin['holiday'] == 1  ?' checked="checked"':'' ?> id="switch23">
                                                <label for="switch23">Toggle</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Advance Leave</td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox"  name="advance_leave" value="1" <?= $admin['advance_leave'] == 1  ?' checked="checked"':'' ?> id="switch78">
                                                <label for="switch78">Toggle</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Saturday ON | OFF</td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox"  name="saturday" value="1" <?= $admin['saturday'] == 1  ?' checked="checked"':'' ?> id="switch24">
                                                <label for="switch24">Toggle</label>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="tab4">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="p_font">Permission Type</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Student ID Card</td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox" name="student_card" value="1" <?= $admin['student_card'] == 1  ?' checked="checked"':'' ?> id="switch25">
                                                <label for="switch25">Toggle</label>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="tab5">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="p_font">Permission Type</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Session Access</td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox"  name="session" value="1" <?= $admin['session'] == 1  ?' checked="checked"':'' ?> id="switch26">
                                                <label for="switch26">Toggle</label>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="tab6">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="p_font">Permission Type</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Graphs</td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox" name="graphs" value="1" <?= $admin['graphs'] == 1  ?' checked="checked"':'' ?> id="switch27">
                                                <label for="switch27">Toggle</label>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="tab7">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="p_font">Permission Type</th>
                                        <th>View</th>
                                        <th>Update</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Exams</td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox" name="exams" value="1" <?= $admin['exams'] == 1  ?' checked="checked"':'' ?> id="switch28">
                                                <label for="switch28">Toggle</label>
                                            </div>
                                        </td>
                                        <td>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Date Sheet</td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox" name="date_sheet" value="1" <?= $admin['date_sheet'] == 1  ?' checked="checked"':'' ?> id="switch29">
                                                <label for="switch29">Toggle</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox" name="date_sheet_u" value="1" <?= $admin['date_sheet_u'] == 1  ?' checked="checked"':'' ?> id="switch30">
                                                <label for="switch30">Toggle</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Award List</td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox" name="award" value="1" <?= $admin['award'] == 1  ?' checked="checked"':'' ?> id="switch76">
                                                <label for="switch76">Toggle</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox" name="date_sheet_u" value="1" <?= $admin['date_sheet_u'] == 1  ?' checked="checked"':'' ?> id="switch77">
                                                <label for="switch77">Toggle</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Result Card</td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox" name="mark_sheet" value="1" <?= $admin['mark_sheet'] == 1  ?' checked="checked"':'' ?> id="switch31">
                                                <label for="switch31">Toggle</label>
                                            </div>
                                        </td>
                                        <td>
                                        <div class="switchToggle">
                                                <input type="checkbox" name="mark_sheet_u" value="1" <?= $admin['mark_sheet_u'] == 1  ?' checked="checked"':'' ?> id="switch32">
                                                <label for="switch32">Toggle</label>
                                            </div>
                                        
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="tab8">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="p_font">Permission Type</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Voucher Generation</td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox"  name="voucher_generation" value="1" <?= $admin['voucher_generation'] == 1  ?' checked="checked"':'' ?> id="switch33">
                                                <label for="switch33">Toggle</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Voucher Expiry Date</td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox" name="expiry_date" value="1" <?= $admin['expiry_date'] == 1  ?' checked="checked"':'' ?> id="switch34">
                                                <label for="switch34">Toggle</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Voucher Due Date</td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox" name="due_date" value="1" <?= $admin['due_date'] == 1  ?' checked="checked"':'' ?> id="switch84">
                                                <label for="switch84">Toggle</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td> Voucher Fee Details</td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox"  name="voucher_details" value="1" <?= $admin['voucher_details'] == 1  ?' checked="checked"':'' ?> id="switch35">
                                                <label for="switch35">Toggle</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Unpaid Voucher Deletion</td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox" name="delete_fee" value="1" <?= $admin['delete_fee'] == 1  ?' checked="checked"':'' ?> id="switch36">
                                                <label for="switch36">Toggle</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Fine Add in Arrears</td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox" name="fine_arrears" value="1" <?= $admin['fine_arrears'] == 1  ?' checked="checked"':'' ?> id="switch72">
                                                <label for="switch72">Toggle</label>
                                            </div>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td>Voucher Search Bar</td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox" name="vr_search" value="1" <?= $admin['vr_search'] == 1  ?' checked="checked"':'' ?> id="switch37">
                                                <label for="switch37">Toggle</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Voucher Fine After Due Date</td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox" name="vr_due_fine" value="1" <?= $admin['vr_due_fine'] == 1  ?' checked="checked"':'' ?> id="switch79">
                                                <label for="switch79">Toggle</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Voucher Reprint Fee </td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox" name="vr_reprint_fee" value="1" <?= $admin['vr_reprint_fee'] == 1  ?' checked="checked"':'' ?> id="switch81">
                                                <label for="switch81">Toggle</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Other Voucher Fine</td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox" name="other_voucher_fine" value="1" <?= $admin['other_voucher_fine'] == 1  ?' checked="checked"':'' ?> id="switch82">
                                                <label for="switch82">Toggle</label>
                                            </div>
                                        </td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="tab9">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="p_font">Permission Type</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Messaging and communication center</td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox" name="message" value="1" <?= $admin['message'] == 1  ?' checked="checked"':'' ?> id="switch38">
                                                <label for="switch38">Toggle</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>School Name in sms | Template</td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox" name="school_message" value="1" <?= $admin['school_message'] == 1  ?' checked="checked"':'' ?> id="switch39">
                                                <label for="switch39">Toggle</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Student Fee collection sms to Admin</td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox" name="admin_fee_message" value="1" <?= $admin['admin_fee_message'] == 1  ?' checked="checked"':'' ?> id="switch40">
                                                <label for="switch40">Toggle</label>
                                            </div>
                                        </td>
                                    </tr>
                                   

                                    <tr>
                                        <td>Student Fee collection sms to Parents</td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox" name="fee_collection_message" value="1" <?= $admin['fee_collection_message'] == 1  ?' checked="checked"':'' ?> id="switch41">
                                                <label for="switch41">Toggle</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Daily cash flow sms to Admin</td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox" name="admin_daily_message" value="1" <?= $admin['admin_daily_message'] == 1  ?' checked="checked"':'' ?> id="switch42">
                                                <label for="switch42">Toggle</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Absent students sms to Parents</td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox" name="parent_att_msg" value="1" <?= $admin['parent_att_msg'] == 1  ?' checked="checked"':'' ?> id="switch43">
                                                <label for="switch43">Toggle</label>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="tab10">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="p_font">Permission Type</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tr>
                                        <td>Expense</td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox" name="expense" value="1" <?= $admin['expense'] == 1  ?' checked="checked"':'' ?> id="switch44">
                                                <label for="switch44">Toggle</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>New Entry Area</td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox" name="expense_u" value="1" <?= $admin['expense_u'] == 1  ?' checked="checked"':'' ?> id="switch45">
                                                <label for="switch45">Toggle</label>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="tab12">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="p_font">Permission Type</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Bank Transactions</td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox" name="bank" value="1" <?= $admin['bank'] == 1  ?' checked="checked"':'' ?> id="switch46">
                                                <label for="switch46">Toggle</label>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="tab13">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="p_font">Permission Type</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Daily Transactions</td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox"  name="daily_transactions" value="1" <?= $admin['daily_transactions'] == 1  ?' checked="checked"':'' ?> id="switch47">
                                                <label for="switch47">Toggle</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Daily Cash  Date Filters</td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox"  name="daily_filter" value="1" <?= $admin['daily_filter'] == 1  ?' checked="checked"':'' ?> id="switch48">
                                                <label for="switch48">Toggle</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Fee Collection  Date Filters</td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox"  name="fee_collect_filter" value="1" <?= $admin['fee_collect_filter'] == 1  ?' checked="checked"':'' ?> id="switch49">
                                                <label for="switch49">Toggle</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Left Sided Fee Collection Area</td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox"  name="daily_left" value="1" <?= $admin['daily_left'] == 1  ?' checked="checked"':'' ?> id="switch50">
                                                <label for="switch50">Toggle</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Right Sided Expense Recording Area</td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox"  name="daily_right" value="1" <?= $admin['daily_right'] == 1  ?' checked="checked"':'' ?> id="switch51">
                                                <label for="switch51">Toggle</label>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="tab14">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="p_font">Permission Type</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Teacher Staff Salary</td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox"  name="salary" value="1" <?= $admin['salary'] == 1  ?' checked="checked"':'' ?> id="switch52">
                                                <label for="switch52">Toggle</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Register/Teacher</td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox"  name="register_t" value="1" <?= $admin['register_t'] == 1  ?' checked="checked"':'' ?> id="switch53">
                                                <label for="switch53">Toggle</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Register/Staff</td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox"  name="register_s" value="1" <?= $admin['register_s'] == 1  ?' checked="checked"':'' ?> id="switch54">
                                                <label for="switch54">Toggle</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Salary Status</td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox"  name="salary_status" value="1" <?= $admin['salary_status'] == 1  ?' checked="checked"':'' ?> id="switch55">
                                                <label for="switch55">Toggle</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Active A/c</td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox"  name="active_t" value="1" <?= $admin['active_t'] == 1  ?' checked="checked"':'' ?> id="switch56">
                                                <label for="switch56">Toggle</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>In-Active A/c</td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox"  name="inactive_t" value="1" <?= $admin['inactive_t'] == 1  ?' checked="checked"':'' ?> id="switch57">
                                                <label for="switch57">Toggle</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Teacher Trans History</td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox"  name="transaction_t" value="1" <?= $admin['transaction_t'] == 1  ?' checked="checked"':'' ?> id="switch58">
                                                <label for="switch58">Toggle</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Staff Trans History</td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox"  name="transaction_s" value="1" <?= $admin['transaction_s'] == 1  ?' checked="checked"':'' ?> id="switch59">
                                                <label for="switch59">Toggle</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Heads Due</td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox"  name="heads_due" value="1" <?= $admin['heads_due'] == 1  ?' checked="checked"':'' ?> id="switch60">
                                                <label for="switch60">Toggle</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Heads History</td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox"  name="heads_history" value="1" <?= $admin['heads_history'] == 1  ?' checked="checked"':'' ?> id="switch61">
                                                <label for="switch61">Toggle</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Add heads</td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox"  name="add_heads" value="1" <?= $admin['add_heads'] == 1  ?' checked="checked"':'' ?> id="switch62">
                                                <label for="switch62">Toggle</label>
                                            </div>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td>Teacher/Staff  Account</td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox"  name="account_ts" value="1" <?= $admin['account_ts'] == 1  ?' checked="checked"':'' ?> id="switch63">
                                                <label for="switch63">Toggle</label>
                                            </div>
                                        </td>
                                    </tr>  
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="tab15">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="p_font">Permission Type</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Fee Adjustment (Due/Arrears/Advance/Waive)</td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox" name="arrears_adjust" value="1" <?= $admin['arrears_adjust'] == 1  ?' checked="checked"':'' ?> id="switch64">
                                                <label for="switch64">Toggle</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Fee Waive</td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox" name="waive" value="1" <?= $admin['waive'] == 1  ?' checked="checked"':'' ?> id="switch73">
                                                <label for="switch73">Toggle</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Fee Fine</td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox"  name="fine" value="1" <?= $admin['fine'] == 1  ?' checked="checked"':'' ?> id="switch65">
                                                <label for="switch65">Toggle</label>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Fee Submission Date</td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox" name="submission" value="1" <?= $admin['submission'] == 1  ?' checked="checked"':'' ?> id="switch66">
                                                <label for="switch66">Toggle</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Combine Fee</td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox" name="combine_fee" value="1" <?= $admin['combine_fee'] == 1  ?' checked="checked"':'' ?> id="switch83">
                                                <label for="switch83">Toggle</label>
                                            </div>
                                        </td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="tab16">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="p_font">Permission Type</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Transaction delete</td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox" name="payment_delete" value="1" <?= $admin['payment_delete'] == 1  ?' checked="checked"':'' ?> id="switch67">
                                                <label for="switch67">Toggle</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Daily Transactions Delete</td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox"  name="daily_delete" value="1" <?= $admin['daily_delete'] == 1  ?' checked="checked"':'' ?> id="switch68">
                                                <label for="switch68">Toggle</label>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="tab17">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="p_font">Permission Type</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Balance sheet Figures/Menu</td>
                                        <td>
                                        <div class="switchToggle">
                                                <input type="checkbox" name="balancesheet_figures" value="1" <?= $admin['balancesheet_figures'] == 1  ?' checked="checked"':'' ?> id="switch69">
                                                <label for="switch69">Toggle</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Balance sheet Summary</td>
                                        <td>
                                        <div class="switchToggle">
                                                <input type="checkbox" name="summary" value="1" <?= $admin['summary'] == 1  ?' checked="checked"':'' ?> id="switch74">
                                                <label for="switch74">Toggle</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Student Balance Sheet</td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox"  name="student_balance_sheet" value="1" <?= $admin['student_balance_sheet'] == 1  ?' checked="checked"':'' ?> id="switch70">
                                                <label for="switch70">Toggle</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Attendence Status on Balance Sheet</td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox"  name="attendance_balance_sheet" value="1" <?= $admin['attendance_balance_sheet'] == 1  ?' checked="checked"':'' ?> id="switch71">
                                                <label for="switch71">Toggle</label>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="tab18">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="p_font">Permission Type</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Download</td>
                                        <td>
                                        <div class="switchToggle">
                                                <input type="checkbox" name="download" value="1" <?= $admin['download'] == 1  ?' checked="checked"':'' ?> id="switch85">
                                                <label for="switch85">Toggle</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Menu Bar</td>
                                        <td>
                                        <div class="switchToggle">
                                                <input type="checkbox" name="menu_bar" value="1" <?= $admin['menu_bar'] == 1  ?' checked="checked"':'' ?> id="switch86">
                                                <label for="switch86">Toggle</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Users Info</td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox"  name="users" value="1" <?= $admin['users'] == 1  ?' checked="checked"':'' ?> id="switch87">
                                                <label for="switch87">Toggle</label>
                                            </div>
                                        </td>
                                    </tr> 
                                    <tr>
                                        <td>Fee Columns in Reports</td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox"  name="fee_columns" value="1" <?= $admin['fee_columns'] == 1  ?' checked="checked"':'' ?> id="switch88">
                                                <label for="switch88">Toggle</label>
                                            </div>
                                        </td>
                                    </tr> 
                                    <tr>
                                        <td>Student Portal Fee History </td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox"  name="s_fee" value="1" <?= $admin['s_fee'] == 1  ?' checked="checked"':'' ?> id="switch89">
                                                <label for="switch89">Toggle</label>
                                            </div>
                                        </td>
                                    </tr> 
                                    <tr>
                                        <td>Student Portal  Graph</td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox"  name="s_graph" value="1" <?= $admin['s_graph'] == 1  ?' checked="checked"':'' ?> id="switch90">
                                                <label for="switch90">Toggle</label>
                                            </div>
                                        </td>
                                    </tr> 
                                    <tr>
                                        <td>Student Portal  Due Fee 
                                </td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox"  name="s_due_fee" value="1" <?= $admin['s_due_fee'] == 1  ?' checked="checked"':'' ?> id="switch91">
                                                <label for="switch91">Toggle</label>
                                            </div>
                                        </td>
                                    </tr> 
                                    <tr>
                                        <td>Student Portal  Date Sheet </td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox"  name="s_date_sheet" value="1" <?= $admin['s_date_sheet'] == 1  ?' checked="checked"':'' ?> id="switch92">
                                                <label for="switch92">Toggle</label>
                                            </div>
                                        </td>
                                    </tr> 
                                    <tr>
                                        <td>Student Portal Subjects</td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox"  name="s_subjects" value="1" <?= $admin['s_subjects'] == 1  ?' checked="checked"':'' ?> id="switch93">
                                                <label for="switch93">Toggle</label>
                                            </div>
                                        </td>
                                    </tr> 
                                    <tr>
                                        <td>Student Portal Timetable</td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox"  name="s_timetable" value="1" <?= $admin['s_timetable'] == 1  ?' checked="checked"':'' ?> id="switch94">
                                                <label for="switch94">Toggle</label>
                                            </div>
                                        </td>
                                    </tr> 
                                    
                                    <tr>
                                        <td>Student Portal Youtube</td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox"  name="s_youtube" value="1" <?= $admin['s_youtube'] == 1  ?' checked="checked"':'' ?> id="switch95">
                                                <label for="switch95">Toggle</label>
                                            </div>
                                        </td>
                                    </tr> 
                                    <tr>
                                        <td>Student Portal Assignment</td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox"  name="s_assignment" value="1" <?= $admin['s_assignment'] == 1  ?' checked="checked"':'' ?> id="switch96">
                                                <label for="switch96">Toggle</label>
                                            </div>
                                        </td>
                                    </tr> 
                                    <tr>
                                        <td>Student Portal Exam</td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox"  name="s_exam" value="1" <?= $admin['s_exam'] == 1  ?' checked="checked"':'' ?> id="switch97">
                                                <label for="switch97">Toggle</label>
                                            </div>
                                        </td>
                                    </tr> 
                                    <tr>
                                        <td>Student Portal Homework</td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox"  name="s_homework" value="1" <?= $admin['s_homework'] == 1  ?' checked="checked"':'' ?> id="switch98">
                                                <label for="switch98">Toggle</label>
                                            </div>
                                        </td>
                                    </tr> 
                                    <tr>
                                        <td>Student Portal Vacation/Note</td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox"  name="s_vacation" value="1" <?= $admin['s_vacation'] == 1  ?' checked="checked"':'' ?> id="switch99">
                                                <label for="switch99">Toggle</label>
                                            </div>
                                        </td>
                                    </tr> 
                                    <tr>
                                        <td>Student Portal Syllabus</td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox"  name="s_syllabus" value="1" <?= $admin['s_syllabus'] == 1  ?' checked="checked"':'' ?> id="switch100">
                                                <label for="switch100">Toggle</label>
                                            </div>
                                        </td>
                                    </tr> 
                                    <tr>
                                        <td>Student Portal Discount</td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox"  name="s_discount" value="1" <?= $admin['s_discount'] == 1  ?' checked="checked"':'' ?> id="switch101">
                                                <label for="switch101">Toggle</label>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Student Portal Attandence</td>
                                        <td>
                                            <div class="switchToggle">
                                                <input type="checkbox"  name="s_attendance" value="1" <?= $admin['s_attendance'] == 1  ?' checked="checked"':'' ?> id="switch101">
                                                <label for="switch101">Toggle</label>
                                            </div>
                                        </td>
                                    </tr>  
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


                    <!-- form start -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                        </div>
                    </form>
                </div>            
            </div><!--/.col (right) -->
            <!-- left column -->
           
        </div>   <!-- /.row -->
    </section><!-- /.content -->
</div>