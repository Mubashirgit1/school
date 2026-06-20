<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
    
    <div class="box box-primary">
    <div class="box-header with-border">
                
                    
        <h4 class="pull-left"> <?= $title ?></h4>
<?php 

  ?>
        <div class="pull-right">
            <form action="<?= site_url( 'admin/staff/attendance_report_staff' ) ?>" method="get" class="form-inline">
                <div class="form-group">
                    <label>Year</label>
                    
                      <input type="hidden" class="teacher_id" name="staff_id"  value="<?= $staff1['id'] ?>">
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
                <h4>
                <div class="pull-right">
                            <h4><?php  $total_working = 365 - $total ?>

Today Working Day No: <?= $total_working ?></h4>
                        </div>
                        </h4>
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
                                <?php    
								
								
								    $total_present_ann =0;
                                    $total_absent_ann = 0;
									$total_leave_ann = 0;
									$total_late_ann = 0;
								
								
								for ( $i = 1; $i < 13; $i++ ): 
								    
									
									
							        $total_present_s =0;
                                    $total_absent_s = 0;
									$total_leave_s = 0;
									$total_late_s = 0;
								    foreach ( $staff_members[$i]['attendance'] as $staff_member_attendance ):
								 
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
								
								
								     
								  
								  
								  $total_absent_ann  += $total_absent_s;
								  $total_present_ann +=  $total_present_s;
								  $total_leave_ann +=$total_leave_s; 
								  $total_late_ann +=$total_late_s;
								endfor;
								
								      ?>
                                   <td></td>
                                      <td  class="text-success text-center"><?= $total_present_ann ?></td>
                                            <td class="text-danger text-center"><?= $total_absent_ann ?></td>
                                            <td class="text-blue text-center"><?= $total_leave_ann ?></td>
                                            <td class="text-blue text-center"><?= $total_late_ann ?></td>
                                
                                </tr>
                                       
                                    <tr >
                                     <th><?= $staff1['name'] ?></th>
                                   <th class="text-success" style="">P</th>
                                        <th class="text-danger">A</th>
                                        <th class="text-blue">L</th>
                                        <th>Lt</th>
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
									
                                      for ( $i = 1; $i < 13; $i++ ): 
                                            ?>
                                            <tr>
                                            
                                            <?php      $total_present_s =0;
                                    $total_absent_s = 0;
									$total_leave_s = 0;
									$total_late_s = 0;
									
									
								    foreach ( $staff_members[$i]['attendance'] as $staff_member_attendance ):
								 
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
                                         <td>
												
										<?php
                                         $annual = str_pad($i,2,0,STR_PAD_LEFT);
										$monthNum  = $annual;
                                        $dateObj   = DateTime::createFromFormat('!m', $monthNum);
                                        $monthName = $dateObj->format('F');
										  ?> 
										
									                <?= $monthName ?>
                                        		
												</td>
                                            
                                            <td class="text-success"><?= $total_present_s ?></td>
                                            <td  class="text-danger"><?= $total_absent_s?></td>
                                            <td class="text-blue"><?= $total_leave_s?></td>
                                            <td><?= $total_late_s?></td>
                                            
                                            
                                             

                                                <?php
												
											
                                                foreach ( $staff_members[$i]['attendance'] as $staff_member_attendance ):

                                                    echo "<td>";
													
                                                    if ( $staff_member_attendance !== false ):
                                                    
													$attLetter = strtoupper( substr( $staff_member_attendance['attendance'], 0, 1 ) );
													
												
										  if ( $attLetter == 'P' ) {
                                                                echo( $staff_member_attendance['attendance_time'] !== null ? "<small>" . date( 'g:i', strtotime( $staff_member_attendance['attendance_time'] ) ) . "</small>" : "" );
                                                            } elseif($attLetter == 'A') {
                                                                echo  "<span style='color:red;'>".$attLetter."</span>";
                                                            }elseif($attLetter == 'L'){
																echo  $attLetter;
																}elseif($attLetter == 'H'){
																echo "<span style='color:red;'>".( $staff_member_attendance['attendance_time'] !== null ? "<small>" . date( 'g:i', strtotime( $staff_member_attendance['attendance_time'] ) ) . "</small>" : "" )."</span>" ;													
																	}
                            						endif;
                                                    
													echo "</td>";

                                                endforeach;
                                                ?>
                                            </tr>
                                            <?php
                                  endfor;
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
        </div>
    </section>
</div>
