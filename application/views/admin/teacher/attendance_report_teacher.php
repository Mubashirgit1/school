<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
    
    <div class="box box-primary">
    <div class="box-header with-border">
        <h4 class="pull-left"> <?= $title ?></h4>

        <div class="pull-right">
            <form action="<?= site_url( 'admin/teacher/attendance_report_teacher' ) ?>" method="get" class="form-inline">
                <div class="form-group">
                    <label>Year</label>
                    
                      <input type="hidden" class="teacher_id" name="teacher_id"  value="<?= $teachers1['id'] ?>">
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
                    <button type="submit" class="btn btn-primary btn-sm pull-right">Filter</button>
                </div>
       

     
            </form>
        </div>
</div>
        <div class="clearfix"></div>
    </section>

    <section class="content">
        <div class="row">

            <div class="col-sm-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                 
                <div class="pull-right">
                
                            <h4><?php  $total_working = 365 - $total ?>

                        Today Working Day No: <?= $total_working ?></h4>
                                            </div>
                        </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table     table-bordered table-hover dataTable">
                                <thead>
                                <tr>
                                <?php    
								
								
								    $total_present_ann =0;
                                    $total_absent_ann = 0;
									$total_leave_ann = 0;
									$total_late_ann = 0;
								
								
								for ( $i = 1; $i < 13; $i++ ): 
								    $total_present =0;
                                    $total_absent = 0;
									$total_leave = 0;
									$total_late = 0;
									
									
								  foreach ( $teachers[$i]['day_attendance'] as $day_attendance ):
								 
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
								  
								  
								  $total_absent_ann  += $total_absent;
								  $total_present_ann +=  $total_present;
								  $total_leave_ann +=$total_leave; 
								  $total_late_ann +=$total_late;
								endfor;
								
								
								
								
								      ?>
                                      <td></td>
                                      <td  class="text-success text-center"><?= $total_present_ann ?></td>
                                            <td class="text-danger text-center"><?= $total_absent_ann ?></td>
                                            <td class="text-blue text-center"><?= $total_leave_ann ?></td>
                                            <td class="text-blue text-center"><?= $total_late_ann ?></td>
                                
                                </tr>
                                    <tr>
                                    
                                    
                                        <th><?= $teachers1['name'] ?></th>
                                        
                                           <th class="text-success text-center">P</th>
                                        <th class="text-danger text-center">A</th>
                                        <th class="text-blue text-center">L</th>
                                        <th class="text-center">Lt</th>
                                        <?php
                                        foreach ( $attendance_dates as $attendance_date ):
                                            echo "<th class='text-center " . ( strtolower( date( "D", strtotime( $attendance_date ) ) ) == 'sun' ? 'bg-danger' : '' ) . "'>" . mdate( "%d<br>%D", strtotime( $attendance_date ) ) . "</th>";
                                        endforeach;
                                        ?>
                                    </tr>
                                </thead>

                                <tbody>
                                        <tr>
                                            <?php
										  for ( $i = 1; $i < 13; $i++ ):
										  $annual = str_pad($i,2,0,STR_PAD_LEFT);
										$monthNum  = $annual;
                                        $dateObj   = DateTime::createFromFormat('!m', $monthNum);
                                        $monthName = $dateObj->format('F');
										  ?> 
								         
											 <th><?= $monthName ?></th> 
                                             
                                             
                                             <?php 
							        $total_present =0;
                                    $total_absent = 0;
									$total_leave = 0;
									$total_late = 0;
									
									
								  foreach ( $teachers[$i]['day_attendance'] as $day_attendance ):
								 
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
                                            <td  class="text-success text-center"><?= $total_present ?></td>
                                            <td class="text-danger text-center"><?= $total_absent ?></td>
                                            <td class="text-blue text-center"><?= $total_leave ?></td>
                                            <td class=" text-center"><?= $total_late ?></td>
                                             
                                             
                                    	   <?php	
								           foreach ( $teachers[$i]['day_attendance'] as $day_attendance ):
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
                                                                echo( $day_attendance['attendance_time'] !== null ? "<small>" . date( 'g:i', strtotime( $day_attendance['attendance_time'] ) ) . "</small>" : "" );
																
															
																
																
                                                            } elseif($attLetter == 'A') {
                                                                echo  "<span style='color:red;'>".$attLetter."</span>";
                                                            }elseif($attLetter == 'L'){
																echo  $attLetter;
																}elseif($attLetter == 'H'){
																echo "<span style='color:red;'>".( $day_attendance['attendance_time'] !== null ? "<small>" . date( 'g:i', strtotime( $day_attendance['attendance_time'] ) ) . "</small>" : "" )."</span>" ;
																	
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
                              endfor;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
