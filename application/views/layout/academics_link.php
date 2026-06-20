    <section class="content-header">
                       
        <div class="box box-primary" style="margin-bottom: 0px;">
            <div class="box-header with-border" style="text-align: center;">
                <div class="btn-group" role="group" aria-label="#">
                
                 <?php  $admind = $this->session->userdata( 'admin' ); 
                  $this->load->helper('menu_helper');
                  $permission = admin_permission($admind['id']);?>
                    <?php if($permission->class == 1){ ?>
                    <a href="<?= site_url( 'classes' ) ?>" class="btn btn-default" <?= current_url() == 'https://localhost/smart_school_src/classes'?'style="background-color: #fff;"':'' ?> >Class</a>                    
                    <?php }?>
                    <?php if($permission->section == 1){ ?>
                    <a href="<?= site_url( 'sections' ) ?>" class="btn btn-default" <?= current_url() == 'https://localhost/smart_school_src/sections'?'style="background-color: #fff;"':'' ?> >Sections</a>
                    <?php }
                    if($permission->class_group == 1){ ?>
                    <a href="<?= site_url( 'classes/classgroup' ) ?>" class="btn btn-default" <?= current_url() == 'https://localhost/smart_school_src/sections'?'style="background-color: #fff;"':'' ?> >Class Group</a>
                    <?php }?>
                    <?php if($permission->subject == 1){ ?>
                    <a href="<?= site_url( 'admin/subject' ) ?>" class="btn btn-default" <?= current_url() == 'https://localhost/smart_school_src/admin/subject'?'style="background-color: #fff;"':'' ?> >Subjects</a>
                    <?php }?>
                    <?php if($permission->assign_subject == 1){ ?>
                    <a href="<?= site_url( 'admin/teacher/assignteacher' ) ?>" class="btn btn-default" <?= current_url() == 'https://localhost/smart_school_src/admin/teacher/assignteacher'?'style="background-color: #fff;"':'' ?> >Asign Subjects</a>
                    <?php }?>
                    <?php if($permission->assign_class_incharge == 1){ ?>
                    <a href="<?= site_url( 'classes/assign_class_incharge' ) ?>" class="btn btn-default" <?= current_url() == 'https://localhost/smart_school_src/classes/assign_class_incharge'?'style="background-color: #fff;"':'' ?> >Asign Class Incharge</a>
                    <?php }?>
                    <?php if($permission->class_wise_timtable == 1){ ?>
                    <a href="<?= site_url( 'admin/timetable' ) ?>" class="btn btn-default" <?= current_url() == 'https://localhost/smart_school_src/admin/timetable' || current_url() == 'https://localhost/smart_school_src/admin/timetable/index' ?'style="background-color: #fff;"':'' ?> >Class Wise Timetable</a>
                    <?php }?>
                    <?php if($permission->daily_timetable == 1){ ?>
                    <a href="<?= site_url( 'admin/timetable/day_timetable' ) ?>" class="btn btn-default" <?= current_url() == 'https://localhost/smart_school_src/admin/timetable/day_timetable'?'style="background-color: #fff;"':'' ?> >Daily Timetable</a>
                    <?php }?>
                    <?php if($permission->teacher_wise_table == 1){ ?>
                    <a href="<?= site_url( 'admin/timetable/teacher_timetable' ) ?>" class="btn btn-default" <?= current_url() == 'https://localhost/smart_school_src/admin/timetable/teacher_timetable'?'style="background-color: #fff;"':'' ?> >Teacher Wise Timetable</a>
                    <?php }?>
                    <?php if($permission->classes_fee_history == 1){ ?>
                    <a href="<?= site_url( 'classes/class_fee' ) ?>" class="btn btn-default" <?= current_url() == 'https://localhost/smart_school_src/classes/class_fee'?'style="background-color: #fff;"':'' ?> >Class Fee Change</a>
                    <?php }?>
                    <?php if($permission->date_sheet_all == 1){ ?>
                    <a href="<?= site_url( 'classes/all_date_sheet' ) ?>" class="btn btn-default" <?= current_url() == 'https://localhost/smart_school_src/classes/class_fee'?'style="background-color: #fff;"':'' ?> >All Date Sheet</a>
                    <?php }if($permission->award == 1){ ?>
                    <a href="<?= site_url( 'admin/exam/award' ) ?>" class="btn btn-default" <?= current_url() == 'https://localhost/smart_school_src/classes/class_fee'?'style="background-color: #fff;"':'' ?> >Award List</a>
                    <?php } ?>
                                    
                </div>
            </div>
        </div>
        
    </section>