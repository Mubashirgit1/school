<style type="text/css">
    @media print {
        .no-print, .no-print * {
            display: none !important;
        }
    }
</style>

<style type="text/css">
    .radio {
        padding-left: 20px;
    }

    .radio label {
        display: inline-block;
        vertical-align: middle;
        position: relative;
        padding-left: 5px;
    }

    .radio label::before {
        content: "";
        display: inline-block;
        position: absolute;
        width: 17px;
        height: 17px;
        left: 0;
        margin-left: -20px;
        border: 1px solid #cccccc;
        border-radius: 50%;
        background-color: #fff;
        -webkit-transition: border 0.15s ease-in-out;
        -o-transition: border 0.15s ease-in-out;
        transition: border 0.15s ease-in-out;
    }

    .radio label::after {
        display: inline-block;
        position: absolute;
        content: " ";
        width: 11px;
        height: 11px;
        left: 3px;
        top: 3px;
        margin-left: -20px;
        border-radius: 50%;
        background-color: #555555;
        -webkit-transform: scale(0, 0);
        -ms-transform: scale(0, 0);
        -o-transform: scale(0, 0);
        transform: scale(0, 0);
        -webkit-transition: -webkit-transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33);
        -moz-transition: -moz-transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33);
        -o-transition: -o-transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33);
        transition: transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33);
    }

    .radio input[type="radio"] {
        opacity: 0;
        z-index: 1;
    }

    .radio input[type="radio"]:focus + label::before {
        outline: thin dotted;
        outline: 5px auto -webkit-focus-ring-color;
        outline-offset: -2px;
    }

    .radio input[type="radio"]:checked + label::after {
        -webkit-transform: scale(1, 1);
        -ms-transform: scale(1, 1);
        -o-transform: scale(1, 1);
        transform: scale(1, 1);
    }

    .radio input[type="radio"]:disabled + label {
        opacity: 0.65;
    }

    .radio input[type="radio"]:disabled + label::before {
        cursor: not-allowed;
    }

    .radio.radio-inline {
        margin-top: 0;
    }

    .radio-primary input[type="radio"] + label::after {
        background-color: #337ab7;
    }

    .radio-primary input[type="radio"]:checked + label::before {
        border-color: #337ab7;
    }

    .radio-primary input[type="radio"]:checked + label::after {
        background-color: #337ab7;
    }

    .radio-danger input[type="radio"] + label::after {
        background-color: #d9534f;
    }

    .radio-danger input[type="radio"]:checked + label::before {
        border-color: #d9534f;
    }

    .radio-danger input[type="radio"]:checked + label::after {
        background-color: #d9534f;
    }

    .radio-info input[type="radio"] + label::after {
        background-color: #5bc0de;
    }

    .radio-info input[type="radio"]:checked + label::before {
        border-color: #5bc0de;
    }

    .radio-info input[type="radio"]:checked + label::after {
        background-color: #5bc0de;
    }
	
	
.disabledbutton {
    pointer-events: none;
    opacity: 0.4;
}

</style>

<div class="content-wrapper" style="min-height: 946px;">

    <section class="content-header">
     <div class="box box-primary" style="margin-bottom: 0px;">
    <div class="box-header with-border" >
        <h4 class="pull-left">
            Teacher/Staff Attendance Mark
        </h4>

        <form action="" method="get" class="pull-right form-inline">
            <div class="form-group">
                <label>Attendance Date</label>
                <input id="attendance_for" type="text" name="attendance_for" class="form-control" value="<?= $attendance_date ?>" placeholder="YYYY-MM-DD" readonly>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-sm pull-right checkbox-toggle">
                    <i class="fa fa-search"></i> Search
            
                </button>
            </div>
        </form>

        <div class="clearfix"></div>
        
        </div>
        </div>
    </section>

    <section class="content">
        <div class="row">

            <div class="col-md-12">

                <?php
	
                echo validation_errors( '<div class="alert alert-danger">', '</div>' );
                ?>

                <div class="box box-primary" id="tachelist">
                    <div class="box-header ptbnull">
                  
                        <h3 class="box-title titlefix"><?php echo $this->lang->line( 'teacher_list' ); ?></h3>
                  <br>
<br>

                    </div>
                    <div class="box-body">
                        <div class="mailbox-controls">
                        </div>

                        <div class=" mailbox-messages">

                            <form method="post" action="<?= site_url( 'admin/teacher/attendance_process' ) ?>">
                                <table class="table     table-bordered table-hover ">
                                    <thead>
                                        <tr>
                                                <th>Teacher ID</th>
                                            <th><?php echo $this->lang->line( 'teacher_name' ); ?></th>
                                            <th><?php echo $this->lang->line( 'email' ); ?></th>
                                            <th><?php echo $this->lang->line( 'phone' ); ?></th>
                                      <th><?php echo $this->lang->line( 'gender' ); ?></th>
                                            <th class="text-center">Attendance</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        $count = 1;
                                        foreach ( $teacherlist as $teacher ) {
                                            $teacher_type_details = $this->teacher_type_model->get( $teacher['teacher_type_id'] );
                                            ?>
                                            
                                            
                                            
                                            <tr>
 <td class="mailbox-name"> <?php echo $teacher['teacher_id'] ?></td>
                                                <td class="mailbox-name"> <?php echo $teacher['name'] ?></td>
                                                <td class="mailbox-name"> <?php echo $teacher['email'] ?></td>
                                              
                                                <td class="mailbox-name"> <?php echo $teacher['phone'] ?></td>
                                                <td class="mailbox-name"> <?php echo $teacher['sex'] ?></td>
                                                <td class="text-center">

                                                    <input type="hidden" name="teacher[<?= $count ?>][id]" value="<?= $teacher['id'] ?>">
                                                    <input type="hidden" name="teacher[<?= $count ?>][type]" value="<?= $teacher_type_details['teacher_type_name'] ?>">

                                                    <?php
                                                    // if teacher type is NOT permanent
                                                    if ( strpos( $teacher_type_details['teacher_type_name'], "permanent" ) === FALSE ) {

                                                        // getting total number of lectures
                                                        $teacher_lecture_number = $this->timetable_model->calculateTeacherLectures( $teacher['id'], date( 'l', strtotime( $attendance_date ) ) );
                                                        $teacher_lecture_number = intval( $teacher_lecture_number );

                                                        ?>
                                                        <input type="hidden" name="teacher[<?= $count ?>][total_lectures]" value="<?= $teacher_lecture_number ?>">
                                                        <?php

                                                        // starting from 0 and going till the number because we are adding 0 for absent
                                                        for ( $i = 0; $i <= $teacher_lecture_number; $i++ ) {
                                                            $_attended_lectures = $this->teacher_attendance_model->search_attendance( $teacher['id'], $attendance_date );

                                                            if ( $_attended_lectures !== false ) {
                                                                $_attended_lectures = intval( $_attended_lectures['attended_lectures'] );
                                                            }

                                                            ?>
                                                            <div class="radio radio-info radio-inline">
                                                                <input type="radio" id="lectures-<?= $count . '-' . $teacher['id'] . '-' . $i ?>" name="teacher[<?= $count ?>][number_of_lectures]" value="<?= $i ?>" <?= set_radio( "teacher[{$count}][number_of_lectures]", $i, ( $_attended_lectures !== false && $_attended_lectures == $i ) ) ?>>
                                                                <label for="lectures-<?= $count . '-' . $teacher['id'] . '-' . $i ?>"><?= ( $i == 0 ? "Absent" : $i ) ?></label>
                                                            </div>
                                                            <?php
                                                        }

                                                    } else { // if teacher is permanent
                                                        $_teacher_attendance = $this->teacher_attendance_model->search_attendance( $teacher['id'], $attendance_date );
                                                        if ( $_teacher_attendance !== false ) {
                                                            $_teacher_attendance_type = $this->teacher_attendence_type_model->get( $_teacher_attendance['teacher_attendence_type_id'] );
                                                            $_teacher_attendance_type_name = $_teacher_attendance_type['teacher_attendence_type_name'];
                                                        } else {
                                                            $_teacher_attendance_type = null;
                                                            $_teacher_attendance_type_name = null;
                                                        }



                                                        ?>
                                                        
                                                        <div class="radio radio-info radio-inline time">
                                                            <input type="radio" id="teacher-present-<?= $teacher['id'] . '-' . $count ?>" name="teacher[<?= $count ?>][attendance]" value="present" <?= set_radio( "teacher[{$count}][attendance]", 'present', ( $_teacher_attendance_type_name === null ? true : ( "present" == $_teacher_attendance_type_name ) ) ) ?>>
                                                            <label for="teacher-present-<?= $teacher['id'] . '-' . $count ?>">Present</label>
                                                        </div>


<div class="radio radio-info radio-inline">
                                                            <input type="radio" id="teacher-absent-<?= $teacher['id'] . '-' . $count ?>" name="teacher[<?= $count ?>][attendance]" value="absent" <?= set_radio( "teacher[{$count}][attendance]", 'absent', ( "absent" == $_teacher_attendance_type_name ) ) ?>>
                                                            <label for="teacher-absent-<?= $teacher['id'] . '-' . $count ?>">Absent</label>
                                                        </div>
<div class="radio radio-info radio-inline">
                                                            <input type="radio" id="teacher-leave-<?= $teacher['id'] . '-' . $count ?>" name="teacher[<?= $count ?>][attendance]" value="leave" <?= set_radio( "teacher[{$count}][attendance]", 'leave', ( "leave" == $_teacher_attendance_type_name ) ) ?>>
                                                            <label for="teacher-leave-<?= $teacher['id'] . '-' . $count ?>">Leave</label>
                                                        </div>
    
                                                       
                                                       
                                                       <div class="radio radio-info radio-inline">
                                                            <input type="radio" id="teacher-half-<?= $teacher['id'] . '-' . $count ?>" name="teacher[<?= $count ?>][attendance]" value="half" <?= set_radio( "teacher[{$count}][attendance]", 'half', ( "half" == $_teacher_attendance_type_name ) ) ?>>
                                                            <label for="teacher-absent-<?= $teacher['id'] . '-' . $count ?>">Late</label>
                                                        </div>
                                                       
                                                        <?php
                                                    }
                                                    ?>

                                                </td>
                                                
                                                <td>
                                                
                                              <?php /*?>   <button type="submit" class="btn btn-danger pull-right"   formaction="<?= site_url( "admin/teacher/teacher_exit/{$teacher['id']}" ) ?>">Exit</button><?php */?>
                                                
                                                </td>
                                                
                                            </tr>
                                            <?php
                                            $count++;
                                        }

                                        ?>
                                    </tbody>
                                </table>
		
 <input type="hidden" name="restrict_attendance_after" id="restrict_attendance_after" value="<?= $restrict_attendance_after['value'] ?>">
                               
                                <input type="hidden" name="attendance_for" value="<?= $attendance_date ?>">

                                <button type="submit" class="btn btn-primary pull-right">Save</button>
                            </form>
            
                        </div>
                    </div>
                    <div class="">
                        <div class="mailbox-controls">
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">

<div class="col-md-12">

                <?php
                echo validation_errors( '<div class="alert alert-danger">', '</div>' );
                ?>

                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Staff List</h3>
                    </div>

                    <div class="box-body">

                        <?php
                        if ( $staff_members === false ):
                            echo '<h3 class="text-center text-danger">No staff member found!</h3>';
                        else:
                            ?>
                         
                                <form action="<?= site_url( 'admin/staff/attendance_process' ) ?>" method="post">
                                    <input type="hidden" name="attendance_date" value="<?= date( 'Y-m-d', strtotime( $attendance_date ) ) ?>">

                                    <table class="table     table-bordered ">
                                        <thead>
                                            <tr>
                                              <th>Staff ID</th>
                                                <th width="220px">Staff Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Gender</th>
                                                <th class="text-center">Attendance</th>
                                                
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            $count = 0;
                                            foreach ( $staff_members as $staff_member ):
  $staff_attendance = $this->staff_attendance_model->get( null, $staff_member['id'], date( 'Y-m-d', strtotime( $attendance_date ) ) );



                                                $staff_attendance_default = ['present' => false, 'absent' => false];

                                                if ( $staff_attendance === false ) {

                                                    $staff_attendance_default['present'] = true;
                                                    $staff_attendance_default['absent'] = false;
                                                    $staff_attendance_default['leave'] = false;
	                                               
                                                } else {

                                                    if ( $staff_attendance['attendance'] == 'present' ) {
                                                        $staff_attendance_default['present'] = true;
                                                        $staff_attendance_default['absent'] = false;
														$staff_attendance_default['leave'] = false;
														$staff_attendance_default['half'] = false;	
														
                                                    } elseif($staff_attendance['attendance'] == 'leave') {
                                                        $staff_attendance_default['present'] = false;
                                                        $staff_attendance_default['absent'] = false;
                                                    	$staff_attendance_default['leave'] = true;
														$staff_attendance_default['half'] = false;	
													
													}elseif($staff_attendance['attendance'] == 'absent'){
														
													  $staff_attendance_default['present'] = false;
                                                        $staff_attendance_default['absent'] = true;
                                                    	$staff_attendance_default['leave'] = false;
														$staff_attendance_default['half'] = false;	
														
														
														}else{
															
														$staff_attendance_default['present'] = false;
                                                        $staff_attendance_default['absent'] = false;
                                                    	$staff_attendance_default['leave'] = false;
														$staff_attendance_default['half'] = true;	
															}

                                                }

                                                ?>

                                                <tr>
                                                   <td><?= $staff_member['id'] ?></td>
                                                    <td><?= $staff_member['name'] ?></td>
                                                    <td><?= $staff_member['email'] ?></td>
                                                    <td><?= $staff_member['phone'] ?></td>
                                                    <td><?= $staff_member['sex'] ?></td>
                                                    <td class="text-center">

                                                        <input type="hidden" name="staff[<?= $count ?>][id]" value="<?= $staff_member['id'] ?>">

                                                        <div class="radio radio-info radio-inline time2">
                                                            <input type="radio" id="staff-present-<?= $staff_member['id'] . '-' . $count ?>" name="staff[<?= $count ?>][attendance]" value="present" <?= set_radio( "staff[{$count}][attendance]", 'present', $staff_attendance_default['present'] ) ?>>
                                                            <label for="staff-present-<?= $staff_member['id'] . '-' . $count ?>">Present</label>
                                                        </div>
<div class="radio radio-info radio-inline">
                                                            <input type="radio" id="staff-absent-<?= $staff_member['id'] . '-' . $count ?>" name="staff[<?= $count ?>][attendance]" value="absent" <?= set_radio( "staff[{$count}][attendance]", 'absent', $staff_attendance_default['absent'] ) ?>>
                                                            <label for="staff-absent-<?= $staff_member['id'] . '-' . $count ?>">Absent</label>
                                                        </div>
 <div class="radio radio-info radio-inline">
                                                            <input type="radio" id="staff-leave-<?= $staff_member['id'] . '-' . $count ?>" name="staff[<?= $count ?>][attendance]" value="leave" <?= set_radio( "staff[{$count}][attendance]", 'leave', $staff_attendance_default['leave'] ) ?>>
                                                            <label for="staff-leave-<?= $staff_member['id'] . '-' . $count ?>">Leave</label>
                                                        </div>
                                                        
                         <div class="radio radio-info radio-inline">
                                                            <input type="radio" id="staff-half-<?= $staff_member['id'] . '-' . $count ?>" name="staff[<?= $count ?>][attendance]" value="half" <?= set_radio( "staff[{$count}][attendance]", 'half', $staff_attendance_default['half'] ) ?>>
                                                            <label for="staff-half-<?= $staff_member['id'] . '-' . $count ?>">Late</label>
                                                        </div>                               
                                                        

                                                    </td>
                                                    
                                                    <td>
                                                   <?php /*?> <button type="submit" class="btn btn-danger pull-right"   formaction="<?= site_url( "admin/teacher/staff_exit/{$staff_member['id']}" ) ?>">Exit</button><?php */?>
                                                    </td>
                                                </tr>

                                                <?php
                                                $count++;
                                            endforeach;
                                            ?>
                                        </tbody>
                                    </table>
                                    
                   
<input type="hidden" name="restrict_attendance_after_staff" id="restrict_attendance_after_staff" value="<?= $restrict_attendance_after_staff['value'] ?>">
                                    <button type="submit" class="btn btn-primary pull-right">Save</button>
                                </form>
                         
                            <?php
                        endif;
                        ?>

                    </div>
                </div>

            </div>        
        </div>
        
    </section>

</div>

<script type="text/javascript">
    jQuery( function ( $ ) {
        $( "#attendance_for" ).datepicker( {
            format: "mm/dd/yyyy"
        } );
    } );
	
	 $(".time2").on('mouseover', function(){
		 var dt = new Date();
         var time = dt.getHours() + ":" + dt.getMinutes() ;
		 var staff = $( '#restrict_attendance_after_staff' ).val();
		   if( time <= staff){
			
			$(".time2").addClass("disabledbutton"); 
		  
		  }else{
					$(".time2").removeClass("disabledbutton");

	}
		 });
	
		 $(".time").on('mouseover', function(){
	     var late = $( '#restrict_attendance_after' ).val();

		 var dt = new Date();
         var time = dt.getHours() + ":" + dt.getMinutes() ;
		 
		 if( time <= late){
			
			$(".time").addClass("disabledbutton"); 
		  
		  }else{
			  
		$(".time").removeClass("disabledbutton");

	}
	});
	
	
	
	
</script>