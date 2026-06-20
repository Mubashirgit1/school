<div class="content-wrapper" style="min-height: 946px;"> 
    <section class="content-header">
        <h1>
            Teacher Profile <small><?php echo $this->lang->line('student_fees1'); ?></small>
       
       
       <div class="pull-right">
            <a href="<?= site_url( 'admin/teacher/salary_payment/'.$teacher['id'] ) ?>" class="btn btn-primary btn-sm">
                <i class="fa fa-chevron-left"></i> 
            </a>
        </div>
        </h1>
        
        
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">          
            <div class="col-md-3">              
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url() . $teacher['image'] ?>" alt="User profile picture">
                        <h3 class="profile-username text-center"><?php echo $teacher['name'] ?></h3>
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b><?php echo $this->lang->line('gender'); ?></b> <a class="pull-right text-aqua"><?php echo $teacher['sex'] ?></a>
                            </li>
                            <li class="list-group-item">
                                <b><?php echo $this->lang->line('date_of_birth'); ?></b> <a class="pull-right text-aqua"><?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($teacher['dob'])); ?></a>
                            </li>
                            <li class="list-group-item">
                                <b><?php echo $this->lang->line('phone'); ?></b> <a class="pull-right text-aqua"><?php echo $teacher['phone'] ?></a>
                            </li>
                            <li class="list-group-item">
                                <b><?php echo $this->lang->line('email'); ?></b> <a class="pull-right text-aqua"><?php echo $teacher['email'] ?></a>
                            </li>
                            <li class="list-group-item">
                                <b><?php echo $this->lang->line('address'); ?></b> <a class="pull-right text-aqua"><?php echo $teacher['address'] ?></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9">              
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#activity" data-toggle="tab" aria-expanded="true">Teacher Subject</a></li>
                                <li class=""><a href="#annual" data-toggle="tab" aria-expanded="true">Attendendance </a></li>
                                
                                <li class="pull-right">
                                <?php  $admind = $this->session->userdata( 'admin' );
                                $this->load->helper('menu_helper');
                                $permission = admin_permission($admind['id']); ?>
                                <?php if($permission->teacher_access == 1){ ?>
                                    <a href="#"  class="schedule_modal text-green " data-toggle="tooltip" title="<?php echo $this->lang->line('login_detail'); ?>"><i class="fa fa-key"></i>
                                        <?php echo $this->lang->line('login_details'); ?>
                                    </a>
                                <?php }?>
                                </li>                    
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="activity">
                                    <div class="box-body">
                                        <div class="table-responsive mailbox-messages">
                                            <table class="table     table-bordered table-hover example">                          
                                                <thead>
                                                    <tr>
                                                        <th><?php echo $this->lang->line('class'); ?></th>
                                                        <th class="text-right"><?php echo $this->lang->line('subject'); ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>                                     
                                                        <?php                                   
                                                        $count = 1;
                                                        foreach ($teachersubject as $subject) {                                          
                                                            ?>
                                                            <tr>
                                                                <td class="mailbox-name"><?php echo $subject->class . "(" . $subject->section . ")" ?></td>
                                                                <td class="mailbox-name text-right"> <?php echo $subject->name; ?></td>
                                                            </tr>
                                                            <?php
                                                        }                                    
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="annual">
              
                
                   
         
                        <div class="table-responsive">
                        
                        <div class="pull-right">
                            <h4><?php  $total_working = 365 - $total ?>
                            Today Working Day No: <?= $total_working ?></h4>
                        </div>
              
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
								endfor;?>
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
                </div>
            </div>
        </div> 
    </section>
</div>

<script type="text/javascript">
    $(document).on('click', '.schedule_modal', function () {
        $('.modal-title').html("");
        $('.modal-title').html("<?php echo $this->lang->line('login_details'); ?>");
        var base_url = '<?php echo base_url() ?>';
        var teacher_id = '<?php echo $teacher["id"] ?>';
        var teacher_name = '<?php echo $teacher["name"] ?>';
        $.ajax({
            type: "post",
            url: base_url + "admin/teacher/getlogindetail",
            data: {'teacher_id': teacher_id},
            dataType: "json",
            success: function (response) {         
                var data = "";
                data += '<div class="table-responsive">';
                data += '<p class="lead text text-center">' + teacher_name + '</p>';
                data += '<table class="table table-hover">';
                data += '<thead>';
                data += '<tr>';
                data += '<th>'+"<?php echo $this->lang->line('user_type'); ?>"+'</th>';
                data += '<th class="text text-center">'+"<?php echo $this->lang->line('username'); ?>"+'</th>';
                data += '<th class="text text-center">'+"<?php echo $this->lang->line('password'); ?>"+'</th>';
                data += '</tr>';
                data += '</thead>';
                data += '<tbody>';
                $.each(response, function (i, obj)
                {
                    console.log(obj);
                    data += '<tr>';
                    data += '<td><b>' + firstToUpperCase(obj.role) + '</b></td>';
                    data += '<td class="text text-center">' + obj.username + '</td> ';
                    data += '<td class="text text-center">' + obj.password + '</td> ';
                    data += '</tr>';
                });
                data += '</tbody>';
                data += '</table>';
                data += '<b class="lead text text-danger" style="font-size:14px;"> '+"<?php echo $this->lang->line('login_url'); ?>"+': ' + base_url + 'site/userlogin</b>';
                data += '</div>  ';              
                $('.modal-body').html(data);
                $("#scheduleModal").modal('show');
            }
        });
    });

    function firstToUpperCase(str) {
        return str.substr(0, 1).toUpperCase() + str.substr(1);
    }
</script>

<div id="scheduleModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?></button>
            </div>
        </div>
    </div>
</div>