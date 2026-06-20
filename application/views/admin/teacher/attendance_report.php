

<div class="content-wrapper" style="min-height: 946px;">


<section class="content-header">
        <div class="box box-primary" style="margin-bottom: 0px;">
            <div class="box-header with-border">
                <h4 class="pull-left" style="margin-top: 0px;">
                   Teacher/Staff Attendance Report
                </h4>
            
                <div class="pull-right">
                    <form action="<?= site_url( 'admin/teacher/attendance_report' ) ?>" method="get" class="form-inline">
                                <div class="form-group">
                                    <label>Year</label>
                                    <select class="form-control" name="year">
                                        <?php
                                        $date = new DateTime( date( 'Y-m-d', now() ) );
                                        $date->sub( new DateInterval( 'P6Y' ) );
                                        for ( $i = 0; $i <= 6; $i++ ):
                                            ?>
                                            <option value="<?= $date->format( 'Y' ) ?>" <?= ( $year == $date->format( 'Y' ) ? "selected" : "" ) ?>><?= $date->format( 'Y' ) ?></option>
                                            <?php
                                            $date->add( new DateInterval( 'P1Y' ) );
                                        endfor;
                                        ?>
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label>Month</label>
                                    <select name="month" class="form-control">
                                        <?php
                                        $date = new DateTime( date( 'Y-01-d', now() ) );
                                        for ( $i = 0; $i < 12; $i++ ):
                                            ?>
                                            <option value="<?= $date->format( 'm' ) ?>" <?= $month == $date->format( 'm' ) ? "selected" : "" ?>><?= $date->format( 'F' ) ?></option>
                                            <?php
                                            $date->add( new DateInterval( 'P1M' ) );
                                        endfor;
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-sm pull-right">Filter</button>
                                </div>
                            </form>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </section>

    <section class="content">
    
   
	  
        <div class="row">

            <div class="col-sm-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"> <?= $title ?></h3>
                        <div class="pull-right">
                            <h4><?php  $total_working = 365 - $total ?>

                    Today Working Day No: <?= $total_working ?></h4>
                        </div>
                    </div>

                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table     table-bordered table-hover example2 dataTable">
                                <thead>
                                <tr>
                                <?php
                        
									$late  = 0;
									$leave  = 0;
									$absent  = 0;
									$present  = 0;
									
									
                            foreach ( $sum_teacher_attendance as $key=>$sta_item ):
                                
								if( $sta_item['name'] == 'half' ){   
                                        $late   =      $sta_item['cnt'];
                                             }
								if( $sta_item['name'] == 'leave' ){   
                                        $leave   =      $sta_item['cnt'];
                                             }
								if( $sta_item['name'] == 'absent' ){   
                                        $absent   =      $sta_item['cnt'];
                                             }
								if( $sta_item['name'] == 'present' ){   
                                        $present   =      $sta_item['cnt'];
                                             }
											 
											    endforeach; ?>
                                               
                                       <th  class="text-success"><?= $present  ?></th>
                                        <th class="text-danger"><?= $absent  ?></th>
                                        <th class="text-blue"><?= $leave  ?></th>
                                        <th><?= $late  ?></th>
                                </tr>
                                    <tr>
                                   <th class="text-success">P</th>
                                        <th class="text-danger">A</th>
                                        <th class="text-blue">L</th>
                                        <th>Lt</th>
                                        <th>Teacher/Date</th>
                                        <?php
                                        foreach ( $attendance_dates as $attendance_date ):
                                            echo "<th class='text-center " . ( strtolower( date( "D", strtotime( $attendance_date ) ) ) == 'sun' ? 'bg-danger' : '' ) . "'>" . mdate( "%d<br>%D", strtotime( $attendance_date ) ) . "</th>";
                                        endforeach;
                                        ?>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
									
                                    foreach ( $teachers as $teacher ):
                                        
										?>
                                        <tr>
                                        
                                        
                         <?php      $total_present =0;
                                    $total_absent = 0;
									$total_leave = 0;
									$total_late = 0;
									
									
								  foreach ( $teacher['day_attendance'] as $day_attendance ):
								 
								  $attLetter = strtoupper( substr( $day_attendance['teacher_attendence_type']['teacher_attendence_type_name'], 0, 1 ) );
								  
								 if ( $attLetter == 'P' ) {
							     
								 $total_present += 1;
								 
								 }
								 if ( $attLetter == 'A' ) {
							     
								 $total_absent += 1;
								 
								 }
								 if ( $attLetter == 'L' ) {
							     
								 $total_leave += 1;
								 
								 }
								 if ( $attLetter == 'H' ) {
							     
								 $total_late += 1;
								 
								 }
								
								  endforeach;
								
								
								      ?>
                                        
                                       <td  class="text-success"><?= $total_present ?></td>
                                            <td class="text-danger"><?= $total_absent ?></td>
                                            <td class="text-blue"><?= $total_leave ?></td>
                                            <td class="text-blue"><?= $total_late ?></td>
                                        
                                            <th>
                                                <a href="<?= site_url( 'admin/teacher/attendance_report_teacher'."?teacher_id={$teacher['id']}" ) ?>">
                                                    <?= $teacher['name'] ?>
                                                </a>
                                            </th>
                                            <?php
				
											
                                            foreach ( $teacher['day_attendance'] as $day_attendance ):
                                        
                                           
                                             ?>
                                                <td class="text-center">
                                                    <?php
                                                    if ( $day_attendance !== false ) {

                                                        if ( $day_attendance['attendance_lecture_based'] == 1 ) {
                                                            if ( $day_attendance['attended_lectures'] == 0 ) {
                                                                echo strtoupper( substr( $day_attendance['teacher_attendence_type']['teacher_attendence_type_name'], 0, 1 ) );
                                                                echo( $day_attendance['attendance_time'] !== null ? "<br><small>" . date( 'g:i', strtotime( $day_attendance['attendance_time'] ) ) . "</small>" : "" );
                                                            } else {
                                                                echo "{$day_attendance['attended_lectures']}/{$day_attendance['total_lectures']}";
                                                            }
                                                        } else {
                                                            $attLetter = strtoupper( substr( $day_attendance['teacher_attendence_type']['teacher_attendence_type_name'], 0, 1 ) );
															
															
                                                            if ( $attLetter == 'P' ) {
                                                                echo( $day_attendance['attendance_time'] !== null ? "<small>&nbsp;&nbsp;" . date( 'g:i', strtotime( $day_attendance['attendance_time'] ) ) . "</small>" : "" );
																

																echo( $day_attendance['exit_time'] !== '00:00:00' ? "<small><br>
                                                                    <span style='color:red;'>e</span>" . date( 'g:i', strtotime( $day_attendance['exit_time'] ) ) . "</small>" : "" );
																
															
																
                                                            } elseif($attLetter == 'A') {
                                                                echo  "<span style='color:red;'>".$attLetter."</span>";
                                                            }elseif($attLetter == 'L'){
																echo  $attLetter;
																}elseif($attLetter == 'H'){
																echo "<span style='color:red;'>".( $day_attendance['attendance_time'] !== null ? "<small>&nbsp;&nbsp;" . date( 'g:i', strtotime( $day_attendance['attendance_time'] ) ) . "</small>" : "" )."</span>" ;
																echo( $day_attendance['exit_time'] !== '00:00:00' ? "<small><br>
                                                                <span style='color:red;'>e</span>" . date( 'g:i', strtotime( $day_attendance['exit_time'] ) ) . "</small>" : "" );
																	
															}
                                                        }
                                                    }
                                                    ?>
                                                </td>
                                                <?php
                                            endforeach;
                                            ?>
                                            
                                            
                                        </tr>
                                        <?php
                                    endforeach;
                                    ?>
                                </tbody>
                           
                                
                            </table>
                        </div>
                    </div>
                    
                    
                </div>
           
      
                <div class="box box-primary">
                    <div class="box-header">
                        <h4 class="box-title">Staff Attendance Report</h4>
                        <div class="pull-right"><h4><?php  $total_working = 365 - $total ?>
                            Today Working Day No: <?= $total_working ?></h4>
                            </div>
                        
                    </div>

                    <div class="box-body">

                        <?php
                        if ( $staff_members === false ):
                            echo '<h3 class="text-center text-danger">No staff member was found!</h3>';
                        else:
                            ?>


                            <div class="table-responsive">
                                <table class="table table-bordered     example_print">
                                    <thead>
                                      
                                         <?php

                                $list = $sum_staff_attendance;
                                $present_s = 'present';
                                $leave_s = 'leave';
                                $absent_s = 'absent';
                                $late_s = 'half';

                                $satff_present =  array_count_values(array_column($sum_staff_attendance, 'attendance'))[$present_s]; // outputs: 2
                                if($satff_present==null){$satff_present =0;}else{$satff_present=$satff_present;}
                                $satff_leave = array_count_values(array_column($sum_staff_attendance, 'attendance'))[$leave_s];
                                if($satff_leave==null){$satff_leave =0;}else{$satff_leave=$satff_leave;}
                                $satff_absent = array_count_values(array_column($sum_staff_attendance, 'attendance'))[$absent_s];
                                if($satff_absent==null){$satff_absent =0;}else{$satff_absent=$satff_absent;}
                                $satff_late = array_count_values(array_column($sum_staff_attendance, 'attendance'))[$late_s];
                                if($satff_late==null){$satff_late =0;}else{$satff_late=$satff_late;}

                                    ?>
                                           <tr>
                                
                                               
                                       <th  class="text-success"><?= $satff_present  ?></th>
                                        <th class="text-danger"><?= $satff_leave  ?></th>
                                        <th class="text-blue"><?= $satff_absent  ?></th>
                                        <th><?= $satff_late   ?></th>
                                </tr>
                                    <tr >
                                   <th class="text-success" style="">P</th>
                                        <th class="text-danger">A</th>
                                        <th class="text-blue">L</th>
                                        <th>Lt</th>
                                        
                                        
                                            <th>Staff/Date</th>
                                            <?php
                                         
                                            foreach ( $month_dates as $month_date_v ):
                                                ?>
                                                <th class="<?= ( strtolower( date( "D", strtotime( $month_date_v ) ) ) == 'sun' ? 'bg-danger' : '' ) ?>"><?= mdate( '%d<br>%D', strtotime( $month_date_v ) ) ?></th>
                                                <?php
                                            endforeach;
                                            ?>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
									
                                        foreach ( $staff_members as $staff_member ):
                                            ?>
                                            <tr>
                                            
                                            <?php      $total_present_s =0;
                                    $total_absent_s = 0;
									$total_leave_s = 0;
									$total_late_s = 0;
									
									
								    foreach ( $staff_member['attendance'] as $staff_member_attendance ):
								 
								 $attLetter_s = strtoupper( substr( $staff_member_attendance['attendance'], 0, 1 ) );
								 
								 
								  
								 if ( $attLetter_s == 'P' ) {
							     
								 $total_present_s += 1;
								 
								 }
								 if ( $attLetter_s == 'A' ) {
							     
								 $total_absent_s += 1;
								 
								 }
								 if ( $attLetter_s == 'L' ) {
							     
								 $total_leave_s += 1;
								 
								 }
								 if ( $attLetter_s == 'H' ) {
							     
								 $total_late_s += 1;
								 
								 }
								
								  endforeach;
								
								
								      ?>
                                            
                                            <td><?= $total_present_s ?></td>
                                            <td><?= $total_absent_s?></td>
                                            <td><?= $total_leave_s?></td>
                                            <td><?= $total_late_s?></td>
                                            
                                            
                                                <td>
												
												<a href="<?= site_url( 'admin/staff/attendance_report_staff'."?staff_id={$staff_member['id']}" ) ?>">
                                                    <?= $staff_member['name'] ?>
                                                </a>
												
												</td>

                                                <?php
                                                foreach ( $staff_member['attendance'] as $staff_member_attendance ):

                                                    echo "<td>";
													
                                                    if ( $staff_member_attendance !== false ):
                                                    
													$attLetter = strtoupper( substr( $staff_member_attendance['attendance'], 0, 1 ) );
													
													
										  if ( $attLetter == 'P' ) {
                                                                echo( $staff_member_attendance['attendance_time'] !== null ? "<small> &nbsp;&nbsp;" . date( 'g:i', strtotime( $staff_member_attendance['attendance_time'] ) ) . "</small>" : "" );
																
                                                                    echo( $staff_member_attendance['exit_time'] !== '00:00:00' ? "<small><br>
                                            <span style='color:red;'>e</span>" . date( 'g:i', strtotime( $staff_member_attendance['exit_time'] ) ) . "</small>" : "" );	
                                                                                                            
                                                                                                        } elseif($attLetter == 'A') {
                                                                                                            echo  "<span style='color:red;'>".$attLetter."</span>";
                                                                                                        }elseif($attLetter == 'L'){
                                                                                                            echo  $attLetter;
                                                                                                            }elseif($attLetter == 'H'){
                                                                                                            echo "<span style='color:red;'>".( $staff_member_attendance['attendance_time'] !== null ? "<small>&nbsp;&nbsp;" . date( 'g:i', strtotime( $staff_member_attendance['attendance_time'] ) ) . "</small>" : "" )."</span>" ;													
                                                                                                            echo( $staff_member_attendance['exit_time'] !== '00:00:00' ? "<small><br>
                                            <span style='color:red;'>e</span>" . date( 'g:i', strtotime( $staff_member_attendance['exit_time'] ) ) . "</small>" : "" );
                                                                                            }
                                                                            endif;
                                                                            
													echo "</td>";

                                                endforeach;
                                                ?>
                                            </tr>
                                            <?php
                                        endforeach;
                                        ?>
                                    </tbody>
                                </table>
                            </div>

                            <?php
                        endif;
                        ?>

                    </div>
                </div>
            
            </div>
        
    </section>
</div>
