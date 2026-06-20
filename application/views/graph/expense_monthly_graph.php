<!DOCTYPE HTML>
<html>
<head>  
</head>
<body>
<div class="content-wrapper" style="min-height: 946px;">
   <section class="content-header">
   <h1>Graphs</h1>    
   </section>
   <section class="content">
   <div class="col-md-12">
       <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
                        <li class="active"><a href="#Teacher" data-toggle="tab" aria-expanded="true" style="color:#666666;" >Teachers Graph</a></li>
                        <li class=""><a href="#student" data-toggle="tab" aria-expanded="true" style="color:#666666">Students Graphs</a></li>
                        <li class=""><a href="#cash" data-toggle="tab" aria-expanded="true" style="color:#666666">Cash Flow Graph</a></li>
                        <li class=""><a href="#comparison" data-toggle="tab" aria-expanded="true" style="color:#666666">Comparison Graph</a></li>
                        <li class=""><a href="#exam" data-toggle="tab" aria-expanded="true" style="color:#666666">Exams Result Graph</a></li>
                    </ul>
          <div class="tab-content">
              <div class="tab-pane active" id="Teacher">
                       <div class="box box-primary" id="tachelist">
                          <div class="box-header with-border">
                           <h4 class="pull-left" style="margin-top: 0px;">
       Teacher Attendance Report (Daily Wise)
                </h4>
            
                           <div class="pull-right">
                          <form action="" method="post" class="form-inline">
                                <div class="form-group">
                                    <label>Year</label>
                                    <select class="form-control" name="year" id="year_teacher_daily">
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
                                    <select name="month" class="form-control" id="month_teacher_daily">
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
            <input type="button" id="fetch_teacher_daily" class="btn btn-primary" value="Get Graph">
            </div>
                          </div>
                         </form>
                    
                    </div>     
                    
                          <div class="box-body"> 
               
          <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>                    
        <canvas id="Chart_teacher_daily" width="200" height="70" class=""></canvas>
        
               
                </div>  
                      
                    </div>     
                       <div class="box box-primary" >
                     <div class="box-header with-border">
                     
                     <h4 class="pull-left" style="margin-top: 0px;">
                   Teacher Attendance Report (Monthly Wise)
                </h4>
            
                <div class="pull-right">
                    <form action="" method="post" class="form-inline">
                                <div class="form-group">
                         <label>Session</label>
                                 <select id="session_id" name="session_id" class="form-control ">
                                        <option value=""><?php echo $this->lang->line( 'select' ); ?></option>
                                        <?php
                                        foreach ( $sessionlist as $session ) {
                                            ?>
                                            <option value="<?php echo $session['session'] ?>" <?php
                                            if ( $setting['session_id'] == $session['id'] ) {
                                                echo "selected =selected";
                                            }
                                            ?>><?php echo $session['session'] ?></option>
                                            <?php
                                            $count++;
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
            <input type="button" id="fetch_teacher_monthly" class="btn btn-primary" value="Get Graph">
            </div>
                </div>
                
                </form>
                     </div>
                          <div class="box-body"> 
                     
          <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>                    
        <canvas id="Chart_teacher_monthly" width="200" height="70" class=""></canvas>
        
                          </div>
                     
                     </div> 
                       <div class="box box-primary" >
                     <div class="box-header with-border">
                     
                <h4 class="pull-left" style="margin-top: 0px;">
                   Teacher Attendance Report (Teacher Wise)
                </h4>
            
                       <div class="pull-right">
                    <form action="" method="post" class="form-inline">
                                <div class="form-group">
                                    <label>Year</label>
                                    <select class="form-control" name="year" id="year_teacher_wise">
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
                                    <select name="month" class="form-control" id="month_teacher_wise">
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
           
            <input type="button" id="fetch_teacher_wise" class="btn btn-primary" value="Get Graph">
                    
                    
            </div>
                    </form>
                </div>
                     </div>
                     
                         <div class="box-body">
                     
                     
           
          <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>                    
        <canvas id="Chart_teacher_wise" width="200" height="70" class=""></canvas>
        
                         </div>
                     
                     
                     </div>
              </div>
              <div class="tab-pane" id="comparison">   
                       
                       <div class="box box-primary" >
               <div class="box-header with-border">
                <h4 class="pull-left" style="margin-top: 0px;" ><span id="month_name" ></span>.. Collection and Expense Report</h4>
                <div class="pull-right">
                    <form action="" method="post" class="form-inline">
                                <div class="form-group">
                                    <label>Year</label>
                                    <select class="form-control" name="year" id="year_comparison">
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
                                    <select name="month" class="form-control" id="month_comparison">
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
             <input type="button" id="fetch_comparison" class="btn btn-primary" value="Get Graph">
                                </div>
                   </form>
                </div>
              </div>        
                  <div class="box-body"> 
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>            <canvas id="comparison_chart" width="200" height="70" class=""></canvas>    
                    </div>
            </div>
                       <div class="box box-primary">
                               <div class="box-header with-border">
                <h4 class="pull-left" style="margin-top: 0px;"  ><span id="month_name2" ></span> Collection and Expense Report</h4>
                 <?php /*?> <div class="pull-right">
                    <form action="" method="post" class="form-inline">
                                <div class="form-group">
                                    <label>Year</label>
                                    <select class="form-control" name="year" id="year_current_month_expense">
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
                                    <select name="month" class="form-control" id="month_current_month_expense">
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
            <input type="button" id="fetch_current_month_expense" class="btn btn-primary" value="Get Graph">
                                </div>
                    </form>
                   </div><?php */?>
                </div>
                                <div class="box-body"> 
                 <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>                 <canvas id="Chart_current_month_expense" width="200" height="70" class=""></canvas>
                 </div>
              </div>
              </div>
              <div class="tab-pane" id="student">
                        <div class="box box-primary" >
                        <div class="box-header with-border">
                 <h4 class="pull-left" style="margin-top: 0px;">
                Student Attendance Report (Daily Wise)
                </h4>
            
               <div class="pull-right">
                    <form action="" method="post" class="form-inline">
                                <div class="form-group">
                                    <label>Year</label>
                                    <select class="form-control" name="year" id="year_student_daily">
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
                                    <select name="month" class="form-control" id="month_student_daily">
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
              
            <input type="button" id="fetch_student_daily" class="btn btn-primary" value="Get Graph">
            </div>
                    </form>
                </div>
                        </div>
                        <div class="box-body"> 
           
               <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>                    
               <canvas id="student_daily_chart" width="200" height="70" class=""></canvas>
        
               </div>
               
                      </div>
                        <div class="box box-primary" >
                        <div class="box-header with-border">
                      
                      <h4 class="pull-left" style="margin-top: 0px;">
                      Student Attendance Report (Monthly Wise)
                      </h4>
            
                      <div class="pull-right">
                    <form action="" method="post" class="form-inline">
                        <div class="form-group">
                            <label>Session</label>
                            <select id="session_id_student" name="session_id_student" class="form-control ">
                                <option value=""><?php echo $this->lang->line( 'select' ); ?></option>
                                <?php
                                foreach ( $sessionlist as $session ) {
                                    ?>
                                    <option value="<?php echo $session['session'] ?>" <?php
                                    if ( $setting['session_id'] == $session['id'] ) {
                                        echo "selected =selected";
                                    }
                                    ?>><?php echo $session['session'] ?></option>
                                    <?php
                                    $count++;
                                }
                                ?>
                            </select>
                        </div>

                                <div class="form-group">
                                  
            <input type="button" id="fetch_student_monthly" class="btn btn-primary" value="Get Graph">
           
            </div>
                </form>
                </div>
                
                      </div>
                          <div class="box-body"> 
                      
          <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>                    
          <canvas id="Chart_student_monthly" width="200" height="70" class=""></canvas>
        
                          </div>
                      
                      </div>
                        <div class="box box-primary" >
                        <div class="box-header with-border">
                     
                <h4 class="pull-left" style="margin-top: 0px;">
              Student Attendance Report (Class Wise)
                </h4>
            
                <div class="pull-right">
                    <form action="" method="post" class="form-inline">
                                <div class="form-group">
                                    <label>Year</label>
                                    <select class="form-control" name="year" id="year_class_wise">
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
                                    <select name="month" class="form-control" id="month_class_wise">
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
                                  
                                
                           
            <input type="button" id="fetch_class_wise" class="btn btn-primary" value="Get Graph">
            </div>
                </div>
                </form>
                        </div>
                     
                         <div class="box-body"> 
                   <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>                    
                  <canvas id="Chart_class_wise" width="200" height="70" class=""></canvas>
        
                         
                         </div>
                        
                        </div>
              </div> 
              <div class="tab-pane" id="cash">
                        <div class="box box-primary" >
                            
                               <div class="box-header with-border">
                               
                             <h4 class="pull-left" style="margin-top: 0px;">
                           Daily Collection and Expense Report
                             </h4>
            
                <div class="pull-right">
                    <form action="" method="post" class="form-inline">
                                <div class="form-group">
                                    <label>Year</label>
                                    <select class="form-control" name="year" id="year_daily_expense">
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
                                    <select name="month" class="form-control" id="month_daily_expense">
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
                                  
                                
                           
            <input type="button" id="fetch_daily_expense" class="btn btn-primary" value="Get Graph">
            
            </div>
            </form>
                </div>
                               
                               </div>
                               
                               <div class="box-body"> 
             
                <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>                    
                <canvas id="Chart_daily_expense" width="200" height="70" class=""></canvas>
             
                               </div>
                               
                               </div>
                        <div class="box box-primary" >
                               <div class="box-header with-border">
                     
                               <h4 class="pull-left" style="margin-top: 0px;">
                               Monthly Collection and Expense Report
                               </h4>
                              <div class="pull-right">
                              <form action="" method="post" class="form-inline">
                                     <div class="form-group">
                                <label>Session</label>
                                 <select id="session_id_expense" name="session_id" class="form-control ">
                                        <option value=""><?php echo $this->lang->line( 'select' ); ?></option>
                                        <?php
                                        foreach ( $sessionlist as $session ) {
                                            ?>
                                            <option value="<?php echo $session['session'] ?>" <?php
                                            if ( $setting['session_id'] == $session['id'] ) {
                                                echo "selected =selected";
                                            }
                                            ?>><?php echo $session['session'] ?></option>
                                            <?php
                                            $count++;
                                        }
                                        ?>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                               <input type="button" id="fetch" class="btn btn-primary" value="Get Graph">
                               </div>
           
                  </form>
                </div>
                  
                              </div>
                      
                               <div class="box-body"> 
          <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>                    
        <canvas id="myChart" width="200" height="70" class=""></canvas>     
           
                </div>
                               </div>
              </div>
              <div class="tab-pane" id="exam">
                        <div class="box box-primary" >
                              <div class="box-header with-border">
                     
                <h4 class="pull-left" style="margin-top: 0px;">
                Student Exam Report (Class Wise)
                                </h4>
            
                <div class="pull-right">
                    <form action="" method="post" class="form-inline">
                     <div class="form-group">  
                                <?php
								
								 if ( $exams !== false ): ?>
                                    <?php $count = 2; ?>
                                    <?php foreach ( $exams as $exam ): ?>
                                                <label>
                        <input type="checkbox"  class="exam_id" name="exam[]" value="<?= $exam['id'] ?>">
                         <?= $exam['name'] ?>
                                                </label>
                                        <?php $count++; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                             </div>
                                <div class="form-group">
                           
            <input type="button" id="fetch_exam_class_wise" class="btn btn-primary" value="Get Graph">
           
            
            </div>
                </div>
                </form>
                        </div>
                     
                         <div class="box-body"> 
                   <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>                    
                  <canvas id="Chart_exam_class_wise" width="200" height="70" class=""></canvas>
        
                         
                         </div>
                        
                        </div>
                        <div class="box box-primary" >
                        <div class="box-header with-border">
                     
                <h4 class="pull-left" style="margin-top: 0px;">
                Percentage of Class Exam Report
                                </h4>
            
                <div class="pull-right">
                    <form action="" method="post" class="form-inline">
               
<div class="form-group">  
                                <?php
								
								 if ( $exams !== false ): ?>
                                    <?php $count = 2; ?>
                                    <?php foreach ( $exams as $exam ): ?>
                                                <label>
                        <input type="checkbox"  class="percentage_exam_id" name="exam[]" value="<?= $exam['id'] ?>">
                         <?= $exam['name'] ?>
                                                </label>
                                        <?php $count++; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                             </div>
                                <div class="form-group">
                           
            <input type="button" id="fetch_percentage_class_wise" class="btn btn-primary" value="Get Graph">
      
            
            </div>
                </div>
                </form>
                        </div>
                     
                         <div class="box-body"> 
                   <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>                    
                  <canvas id="Chart_percentage_class_wise" width="200" height="70" class=""></canvas>
        
                         
                         </div>
                        
                        </div>
                        <div class="box box-primary" >
                        <div class="box-header with-border">
                     
                <h4 class="pull-left" style="margin-top: 0px;">
                Percentage of Class Exam Report(Combine Exam)
                                </h4>
            
                <div class="pull-right">
                    <form action="" method="post" class="form-inline">
               
                     <div class="form-group">  
                               <?php if ( $exams !== false ): ?>
                                    <?php $count = 2; 
									?>
                                    
                                    <?php foreach ( $exams as $exa ): ?>
                                    
                                       
                                            <div class="checkbox">
                                                <label>
               
                                <input type="hidden" name="fee[<?= $count ?>][name]" value="<?= $exa['name'] ?>">
                                
     <input type="checkbox" id="other_fee" class="other_fee" name="fee[<?= $count ?>][check]" value="<?= $exa['id'] ?>"> <?= $exa['name'] ?>
                                     
                                                </label>
                                            </div>
                                    
                                        <?php $count++; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                           
                             </div>
                             
                             
                                <div class="form-group">
                           
            <input type="button" id="fetch_percentage_exam_class_wise" class="btn btn-primary" value="Get Graph">
          <?php /*?>    <a href="<?= site_url( 'transactions/class_wise_graph' ) ?>" title="Graph" class="btn btn-primary">class wise</a><?php */?>
            
            </div>
                </div>
                </form>
                        </div>
                     
                         <div class="box-body"> 
                   <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>                    
                  <canvas id="Chart_percentage_exam_class_wise" width="200" height="70" class=""></canvas>
                         </div>
                        
                        </div>                                   
                        <div class="box box-primary" >
                        <div class="box-header with-border">
                     
                <h4 class="pull-left" style="margin-top: 0px;">
             Percentage of Class Exam Report(Teacher Wise)
                                </h4>
                <div class="pull-right">
                    <form action="" method="post" class="form-inline">
               
                     <div class="form-group">  
                               <?php if ( $exams !== false ): ?>
                                    <?php $count = 2; 
									?>
                                    
                                    <?php foreach ( $exams as $exa ): 
									?>
                                    
                                       
                                            <div class="checkbox">
                                                <label>
               
                                <input type="hidden" name="fee[<?= $count ?>][name]" value="<?= $exa['name'] ?>">
                                
     <input type="checkbox" id="other_fee" class="percentage_exam_id" name="fee[<?= $count ?>][check]" value="<?= $exa['id'] ?>"> <?= $exa['name'] ?>
                                     
                                                </label>
                                            </div>
                                    

                                        

                                        
                                        <?php $count++; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                           
                             </div>
                             
                             
                                <div class="form-group">
                           
            <input type="button" id="fetch_percentage_exam_teacher_wise" class="btn btn-primary" value="Get Graph">
            
            </div>
                </div>
                </form>
                        </div>
                     
                         <div class="box-body"> 
                   <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>                    
                  <canvas id="Chart_percentage_exam_teacher_wise" width="200" height="70" class=""></canvas>
                         </div>
                        
                        </div>
               </div>
          </div>
       </div>
    <!-- Main content -->
   </div>   
</div>    
    
<script>
var teacher = [];
var teacher1 = [];
var dates = [];
var total1 = [];
 $("#fetch").on('click', function(){
    $(this).prop('disabled', true);
    var year =  $("#year").val();
    var session_id =  $("#session_id_expense").val();
    $.ajax({  
    method: 'POST',  
    url: '<?php echo base_url() ?>transactions/expense_line_monthly2',
    data: { 'year': year,'session_id': session_id },
    success: function(data){
	obj  = JSON.parse(data);

	$.each(obj['collection'],function(i,item){
	var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December','January', 'February'];

		 month_name  = months[i - 1];
	 dates.push(month_name);
	teacher.push(item['amount']);
	})
	 $.each(obj['expense'],function(j,item){
	 teacher1.push(item['amount']);
	})
var ctx = document.getElementById('myChart').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'line',
    // The data for our dataset
    data: {
        labels: dates,
        datasets: [{
			fill: false,
			lineTension:0.1,
            label: "Collection",
            backgroundColor: 'green',
			pointBorderWidth:6,
            borderColor: 'green',
            data:teacher,
        },{
			fill: false,
			lineTension:0.1,
            label: "Expense",
            backgroundColor: 'red',
			pointBorderWidth:6,
            borderColor: 'red',
            data:teacher1,
        }]
    },
    // Configuration options go here
    options: {}
});
},
});
});
</script>

<script>
var expense_comparison = [];
var collection_comparison = [];
var dates_comparison = [];
var total1_comparison = [];
 $("#fetch_comparison").on('click', function(){
	 $(this).prop('disabled', true);
	 var year =  $("#year_comparison").val();
     var month = $("#month_comparison").val();
	 var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October',     'November', 'December'];

	     month_name  = months[month - 1];
	 
	     $('#month_name').text(month_name);
if(month == '01'){
	month = 12;
    year = year - 1;
}else{
year = year;	
month = month - 1;
}
  month_name2  = months[month - 1];
  $('#month_name2').text(month_name2);
  $.ajax({  
    method: 'POST',  
    url: '<?php echo base_url() ?>transactions/expense_line_graph2',
    data: { 'year': year,'month': month },
    success: function(data){
	obj  = JSON.parse(data);
	
    $.each(obj['collection'],function(i,item){
	 dates_comparison.push(i);
 	 collection_comparison.push(item['amount']);
	})
	    $.each(obj['expense'],function(j,item){
    	expense_comparison.push(item['amount']);
	})
var ctx = document.getElementById('comparison_chart').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'line',
    // The data for our dataset
    data: {
        labels: dates_comparison,
        datasets: [{
			fill: false,
			lineTension:0.1,
            label: "Collection",
            backgroundColor: 'green',
			pointBorderWidth:6,
            borderColor: 'green',
            data:collection_comparison,
        },{
			fill: false,
			lineTension:0.1,
            label: "Expense",
            backgroundColor: 'red',
			pointBorderWidth:6,
            borderColor: 'red',
            data: expense_comparison,
        }]
    },
    // Configuration options go here
    options: {}
});

},

});


// $.ajax({  
//    method: 'POST',  
//    url: '<?php echo base_url() ?>transactions/expense_comparison_graph2',
//    data: { 'year': year,'month': month },
//    success: function(data){
//	obj  = JSON.parse(data);
//    $.each(obj['collection'],function(i,item){
//	$.each(item,function(j,item){
//	dates_comparison.push(j);
//	 collection_comparison.push(item['amount']);
//	})
//	})
//	  $.each(obj['expense'],function(j,item){
//	  $.each(item,function(j,item){
//	 
//	expense_comparison.push(item['amount']);
//
//	})
//	})
//
//
//var ctx = document.getElementById('comparison_chart').getContext('2d');
//var chart = new Chart(ctx, {
//    // The type of chart we want to create
//    type: 'line',
//
//    // The data for our dataset
//    data: {
//        labels: dates_comparison,
//        datasets: [{
//			fill: false,
//			lineTension:0.1,
//            label: "Collection",
//            backgroundColor: 'green',
//			pointBorderWidth:6,
//            borderColor: 'green',
//            data:collection_comparison,
//        },{
//			fill: false,
//			lineTension:0.1,
//            label: "Expense",
//            backgroundColor: 'red',
//			pointBorderWidth:6,
//            borderColor: 'red',
//            data:expense_comparison,
//        }]
//    },
//
//
//    // Configuration options go here
//    options: {}
//});
//
//},
//
//});

});

</script>

<script>

var student_daily = [];
var student_daily1 = [];
var student_daily2 = [];
var student_daily3 = [];
var student_daily4 = [];
var dates_student_daily = [];
var total_student_daily = [];
 $("#fetch_student_daily").on('click', function(){
	 $(this).prop('disabled', true);
	 
	 var year =  $("#year_student_daily").val();
	 var month = $("#month_student_daily").val();
	 


 $.ajax({  
    method: 'POST',  
    url: '<?php echo base_url() ?>transactions/student_month_graph2',
    data: { 'year': year, 'month': month },
    success: function(data){
obj  = JSON.parse(data);

$.each(obj,function(i,item){

 
 dates_student_daily.push(i)
	
 var count = 0;
 var count1 = 0;
 var count2 = 0;
 var count3 = 0;
 var count4 = 0;
 
var total = 0;
$.each(item,function(j,item){


total = j++;
  
  
if(item != null){
	
if(item.attendence_type_id == 1  ){
	
	count++;
}
if(item.attendence_type_id == 2  ){
	
	count1++;
}
if(item.attendence_type_id == 3  ){
	
	count2++;
}
if(item.attendence_type_id == 4  ){
	
	count3++;
}
if(item.attendence_type_id == 5  ){
	
	count4++;
}

  }
	})
	
	
	
	var count = parseInt(count) * 100 / parseInt(total+1);
	var count1 = parseInt(count1) * 100 / parseInt(total+1);
	var count2 = parseInt(count2) * 100 / parseInt(total+1);
	var count3 = parseInt(count3) * 100 / parseInt(total+1);
	var count4 = parseInt(count4) * 100 / parseInt(total+1);
	
	student_daily.push(count)
	student_daily1.push(count1)
	student_daily2.push(count2)
	student_daily3.push(count3)
	student_daily4.push(count4)
		 
	})

var ctx = $("#student_daily_chart");
var color = dates_student_daily;

var vertical = student_daily;
var vertical1 = student_daily1;
var vertical2 = student_daily2;
var vertical3 = student_daily3;
var vertical4 = student_daily4;


var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: color,
        datasets: [{
    label: "Absent",
    backgroundColor: "red",
    data: vertical1,
  }, {
    label: "Present",
    backgroundColor: "green",
    data: vertical,
  },{
    label: "Late",
    backgroundColor: "purple",
    data: vertical3,
  },{
    label: "Leave",
    backgroundColor: "blue",
    data: vertical2
  }, {
	label: "Holiday",
    backgroundColor: "Black",
	data: vertical4,  
    
  }]

    },
    options: {
        scales: {
           yAxes: [{
       ticks: {
           min: 0,
           max: 100,
           callback: function(value) {
               return value + "%"
           }
       },
       scaleLabel: {
           display: true,
           labelString: "Percentage"
       }
   }]
   
        }
    }
});

},

});

});

</script>

<script>

var teacher_daily = [];
var teacher_daily1 = [];
var teacher_daily2 = [];
var teacher_daily3 = [];
var teacher_daily4 = [];
var dates_daily = [];
var total_daily_teacher = [];





 $("#fetch_teacher_daily").on('click', function(){
	$(this).prop('disabled', true); 
	 
	 var year =  $("#year_teacher_daily").val();
	 var month = $("#month_teacher_daily").val();
	 


 $.ajax({  
    method: 'POST',  
    url: '<?php echo base_url() ?>transactions/teacher_graph2',
    data: { 'year': year, 'month': month },
    success: function(data){
obj  = JSON.parse(data);




$.each(obj,function(i,item){

 
 dates_daily.push(i)
	
 var count = 0;
 var count1 = 0;
 var count2 = 0;
 var count3 = 0;
 var count4 = 0;
 
var total = 0;
$.each(item,function(j,item){


total = j++;
  
if(item != false){
	
if(item.teacher_attendence_type_id == 1  ){
	
	count++;
}
if(item.teacher_attendence_type_id == 2  ){
	
	count1++;
}
if(item.teacher_attendence_type_id == 3  ){
	
	count2++;
}
if(item.teacher_attendence_type_id == 4  ){
	
	count3++;
}
if(item.teacher_attendence_type_id == 5  ){
	
	count4++;
}

  }
	})
	
	
	
	var count = parseInt(count) * 100 / parseInt(total+1);
	var count1 = parseInt(count1) * 100 / parseInt(total+1);
	var count2 = parseInt(count2) * 100 / parseInt(total+1);
	var count3 = parseInt(count3) * 100 / parseInt(total+1);
	var count4 = parseInt(count4) * 100 / parseInt(total+1);
	
	teacher_daily.push(count)
	teacher_daily1.push(count1)
	teacher_daily2.push(count2)
	teacher_daily3.push(count3)
	teacher_daily4.push(count4)
		 
	})

var ctx = $("#Chart_teacher_daily");
var color = dates_daily;

var vertical = teacher_daily;
var vertical1 = teacher_daily1;
var vertical2 = teacher_daily2;
var vertical3 = teacher_daily3;
var vertical4 = teacher_daily4;


var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: color,
        datasets: [{
    label: "Absent",
    backgroundColor: "red",
    data: vertical1,
  }, {
    label: "Present",
    backgroundColor: "green",
    data: vertical,
  },{
    label: "Late",
    backgroundColor: "purple",
    data: vertical3,
  },{
    label: "Leave",
    backgroundColor: "blue",
    data: vertical2
  }, {
	label: "Holiday",
    backgroundColor: "Black",
	data: vertical4,  
    
  }]

    },
    options: {
        scales: {
           yAxes: [{
       ticks: {
           min: 0,
           max: 100,
           callback: function(value) {
               return value + "%"
           }
       },
       scaleLabel: {
           display: true,
           labelString: "Percentage"
       }
   }]
   
        }
    }
});

},

});

});

</script>

<script>
var teacher_monthly = [];
var teacher_monthly1 = [];
var teacher_monthly2 = [];
var teacher_monthly3 = [];
var teacher_monthly4 = [];
var dates_teacher_monthly = [];
var total1_monthly = [];
 $("#fetch_teacher_monthly").on('click', function(){
	 $(this).prop('disabled', true);
	 var year =  $("#year_teacher_monthly").val();
	 var session_id =  $("#session_id").val();
     $.ajax({  
    method: 'POST',  
    url: '<?php echo base_url() ?>transactions/teacher_graph_month2',
    data: { 'session_id': session_id },
    success: function(data){
    console.log(data);
	obj  = JSON.parse(data);
    $.each(obj,function(i,item){
		var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October',     'November', 'December','January', 'February'];
		console.log(i);
		month_name  = months[i - 1];
  	dates_teacher_monthly.push(month_name)
	var count_month = 0
	var count_month_absent = 0
	var count_month_leave = 0
	var count_month_late = 0
	var count_month_holiday = 0
	var total = 0;
	var total_teacher = 0;
$.each(item,function(j,item){
	var count = 0;
	var count_absent = 0;
	var count_leave = 0;
	var count_late = 0;
	var count_holiday = 0;
	total = j++;
$.each(item,function(k,item){
total_teacher = k++;
if(item != false){
if(item.teacher_attendence_type_id == 1  ){
	count++;
}
if(item.teacher_attendence_type_id == 2  ){
	count_absent++;
}
if(item.teacher_attendence_type_id == 3  ){
	count_leave++;
}
if(item.teacher_attendence_type_id == 4  ){
	count_late++;
}
if(item.teacher_attendence_type_id == 5  ){
	count_holiday++;
}
}
 	})
 count_month = count_month + count;
 count_month_absent = count_month_absent + count_absent;
 count_month_leave = count_month_leave  + count_leave;
 count_month_late = count_month_late + count_late;
 count_month_holiday = count_month_late + count_holiday;
	})
	var count_percent = parseInt(count_month) * 100 / parseInt(total);
	var count_percent_absent = parseInt(count_month_absent) * 100 / parseInt(total);
	var count_percent_leave = parseInt(count_month_leave) * 100 / parseInt(total);
	var count_percent_late = parseInt(count_month_late) * 100 / parseInt(total);
	var count_percent_holiday = parseInt(count_month_holiday) * 100 / parseInt(total);
	 total_teacher_to =total_teacher+1
	 total_percent =count_percent/total_teacher_to;
	 total_percent_absent =count_percent_absent/total_teacher_to;
	 total_percent_leave =count_percent_leave/total_teacher_to;
	 total_percent_late =count_percent_late/total_teacher_to;
	 total_percent_holiday =count_percent_holiday/total_teacher_to;
	teacher_monthly.push(total_percent);
	teacher_monthly1.push(total_percent_absent);
	teacher_monthly2.push(total_percent_leave);
	teacher_monthly3.push(total_percent_late);
	teacher_monthly4.push(total_percent_holiday);
 	})
var ctx = $("#Chart_teacher_monthly");
var color = dates_teacher_monthly;
var vertical = teacher_monthly;
var vertical1 = teacher_monthly1;
var vertical2 = teacher_monthly2;
var vertical3 = teacher_monthly3;
var vertical4 = teacher_monthly4;
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: color,
        datasets: [{
    label: "Absent",
    backgroundColor: "red",
    data: vertical1,
  }, {
    label: "Present",
    backgroundColor: "green",
    data: vertical,
  },{
    label: "Late",
    backgroundColor: "purple",
    data: vertical3,
  },{
    label: "Leave",
    backgroundColor: "blue",
    data: vertical2
  }, {
	label: "Holiday",
    backgroundColor: "Black",
	data: vertical4,  
  }]
    },
    options: {
        scales: {
           yAxes: [{
       ticks: {
           min: 0,
           max: 100,
           callback: function(value) {
               return value + "%"
           }
       },
       scaleLabel: {
           display: true,
           labelString: "Percentage"
       }
   }]
        }
    }
});
},
});
});
</script>

<script>

var teacher_wise = [];
var teacher_wise1 = [];
var teacher_wise2 = [];
var teacher_wise3 = [];
var teacher_wise4 = [];
var dates_teacher_wise = [];
var total1_teacher_wise = [];



 $("#fetch_teacher_wise").on('click', function(){
	 
	 $(this).prop('disabled', true);
	 var year =  $("#year_teacher_wise").val();
	 var month = $("#month_teacher_wise").val();
	 


 $.ajax({  
    method: 'POST',  
    url: '<?php echo base_url() ?>transactions/teacher_wise_graph2',
    data: { 'year': year, 'month': month },
    success: function(data){
obj  = JSON.parse(data);




$.each(obj,function(i,item){

 
 dates_teacher_wise.push(item.name)
	
 var count = 0;
 var count1 = 0;
 var count2 = 0;
 var count3 = 0;
 var count4 = 0;
 
var total = 0;

$.each(item.day_attendance,function(j,item){

total = j++;

if(item != false){
    if(item.teacher_attendence_type_id == 1){
	
	count++;
	}
	if(item.teacher_attendence_type_id == 2){
	
	count1++;
	}
	if(item.teacher_attendence_type_id == 3){
	
	count2++;
	}
	if(item.teacher_attendence_type_id == 4){
	
	count3++;
	}
	if(item.teacher_attendence_type_id == 5){
	
	count4++;
	}
	
	
}
	})
	var count = parseInt(count) * 100 / parseInt(total+1);
	var count1 = parseInt(count1) * 100 / parseInt(total+1);
	var count2 = parseInt(count2) * 100 / parseInt(total+1);
	var count3 = parseInt(count3) * 100 / parseInt(total+1);
	var count4 = parseInt(count4) * 100 / parseInt(total+1);

	
	
	teacher_wise.push(count)
	teacher_wise1.push(count1)
	teacher_wise2.push(count2)
	teacher_wise3.push(count3)
	teacher_wise4.push(count4)
		 
	})



var ctx = $("#Chart_teacher_wise");
var color = dates_teacher_wise;

var vertical = teacher_wise;
var vertical1 = teacher_wise1;
var vertical2 = teacher_wise2;
var vertical3 = teacher_wise3;
var vertical4 = teacher_wise4;


var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: color,
        datasets: [{
    label: "Absent",
    backgroundColor: "red",
    data: vertical1,
  }, {
    label: "Present",
    backgroundColor: "green",
    data: vertical,
  },{
    label: "Late",
    backgroundColor: "purple",
    data: vertical3,
  },{
    label: "Leave",
    backgroundColor: "blue",
    data: vertical2
  }, {
	label: "Holiday",
    backgroundColor: "Black",
	data: vertical4,  
    
  }]

    },
    options: {
        scales: {
           yAxes: [{
       ticks: {
           min: 0,
           max: 100,
           callback: function(value) {
               return value + "%"
           }
       },
       scaleLabel: {
           display: true,
           labelString: "Percentage"
       }
   }]
   
        }
    }
});

},

});

});

</script>

<script>

var student_monthly = [];
var student_monthly1 = [];
var student_monthly2 = [];
var student_monthly3 = [];
var student_monthly4 = [];
var dates_student_monthly = [];
var total1_student_monthly = [];

 $("#fetch_student_monthly").on('click', function(){
	$(this).prop('disabled', true);
	 var year =  $("#session_id_student").val();

 $.ajax({  
    method: 'POST',  
    url: '<?php echo base_url() ?>transactions/student_all_month2',
    data: { 'year': year },
    success: function(data){
obj  = JSON.parse(data);


$.each(obj,function(i,item){

    var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December','January', 'February'];

    month_name  = months[i - 1];
    dates_student_monthly.push(month_name);
	var count_month = 0
	var count_month_absent = 0
	var count_month_leave = 0
	var count_month_late = 0
	var count_month_holiday = 0
	
	 var total = 0;
	 var total_teacher = 0;
$.each(item,function(j,item){
	 var count = 0;
	 var count_absent = 0;
	 var count_leave = 0;
	 var count_late = 0;
	 var count_holiday = 0;
	 
	 
	total = j++;
$.each(item,function(k,item){
total_teacher = k++;
if(item != false){
if(item.attendence_type_id == 1  ){
	
	count++;
}
if(item.attendence_type_id == 2  ){
	
	count_absent++;
}
if(item.attendence_type_id == 3  ){
	
	count_leave++;
}
if(item.attendence_type_id == 4  ){
	
	count_late++;
}
if(item.attendence_type_id == 5  ){
	
	count_holiday++;
}


}

 	})

 count_month = count_month + count;
 count_month_absent = count_month_absent + count_absent;
 count_month_leave = count_month_leave  + count_leave;
 count_month_late = count_month_late + count_late;
 count_month_holiday = count_month_late + count_holiday;
	
	})
	
	var count_percent = parseInt(count_month) * 100 / parseInt(total);
	var count_percent_absent = parseInt(count_month_absent) * 100 / parseInt(total);
	var count_percent_leave = parseInt(count_month_leave) * 100 / parseInt(total);
	var count_percent_late = parseInt(count_month_late) * 100 / parseInt(total);
	var count_percent_holiday = parseInt(count_month_holiday) * 100 / parseInt(total);
	
	
	
	total_teacher_to =total_teacher+1
	
	
	 total_percent =count_percent/total_teacher_to;
	 total_percent_absent =count_percent_absent/total_teacher_to;
	 total_percent_leave =count_percent_leave/total_teacher_to;
	 total_percent_late =count_percent_late/total_teacher_to;
	 total_percent_holiday =count_percent_holiday/total_teacher_to;
	
	
	
	student_monthly.push(total_percent);
	student_monthly1.push(total_percent_absent);
	student_monthly2.push(total_percent_leave);
	student_monthly3.push(total_percent_late);
	student_monthly4.push(total_percent_holiday);
	

	
 	})


var ctx = $("#Chart_student_monthly");


var color = dates_student_monthly;

var vertical = student_monthly;
var vertical1 = student_monthly1;
var vertical2 = student_monthly2;
var vertical3 = student_monthly3;
var vertical4 = student_monthly4;


var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: color,
        datasets: [{
    label: "Absent",
    backgroundColor: "red",
    data: vertical1,
  }, {
    label: "Present",
    backgroundColor: "green",
    data: vertical,
  },{
    label: "Late",
    backgroundColor: "purple",
    data: vertical3,
  },{
    label: "Leave",
    backgroundColor: "blue",
    data: vertical2
  }, {
	label: "Holiday",
    backgroundColor: "Black",
	data: vertical4,  
    
  }]

    },
    options: {
        scales: {
           yAxes: [{
       ticks: {
           min: 0,
           max: 100,
           callback: function(value) {
               return value + "%"
           }
       },
       scaleLabel: {
           display: true,
           labelString: "Percentage"
       }
   }]
   
        }
    }
});

},

});

});

</script>

<script>

var student_class_wise = [];
var student_class_wise1 = [];
var student_class_wise2 = [];
var student_class_wise3 = [];
var student_class_wise4 = [];
var dates_student_class_wise = [];
var total1_student_class_wise = [];
 $("#fetch_class_wise").on('click', function(){
	$(this).prop('disabled', true);
	 
	 var year =  $("#year_class_wise").val();
     var month = $("#month_class_wise").val();

 $.ajax({  
    method: 'POST',  
    url: '<?php echo base_url() ?>transactions/class_graph_month2',
    data: { 'year': year,'month': month },
    success: function(data){
    
	obj  = JSON.parse(data);

    $.each(obj,function(i,item){
	 
	 var total_days =0; 
	 	
	dates_student_class_wise.push(item.class['class']+item.section['section']);

    var count_month= 0; 
    var count_month_absent= 0; 
    var count_month_leave= 0; 
    var count_month_holiday= 0; 

    $.each(item.monthly,function(j,item){

    total_days = j++;
 
    var count= 0;
	var count_absent= 0;
	var count_leave= 0;
	var count_holiday= 0;
	
    var total_student =0;  

	$.each(item,function(k,item){
   
    total_student  = k++;
	
	if(item.attendence_type_id != null){
	
	if(item.attendence_type_id == 1){
    count++;
	}
	if(item.attendence_type_id == 3){
    count_leave++;
	}
	if(item.attendence_type_id == 4){
    count_absent++;
	}
	if(item.attendence_type_id == 5){
    count_holiday++;
	}

	}
	})

	
	
	
	  student  =total_student+1
	
	count1 = count/student;
    count2 = count_leave/student;
    count3 = count_absent/student;
    count4 = count_holiday/student;

	
	
	count_month += count1; 
	count_month_absent += count2; 
	count_month_leave += count3; 
	count_month_holiday += count4; 
	
	
	
	})
	
	

var count_percent = parseInt(count_month) * 100 / parseInt(total_days);
var count_percent1 = parseInt(count_month_absent) * 100 / parseInt(total_days);
var count_percent2 = parseInt(count_month_leave) * 100 / parseInt(total_days);
var count_percent3 = parseInt(count_month_holiday) * 100 / parseInt(total_days);


student_class_wise.push(count_percent);
student_class_wise1.push(count_percent1);
student_class_wise2.push(count_percent2);
student_class_wise3.push(count_percent3);
	
	
	})


var ctx = $("#Chart_class_wise");


var color = dates_student_class_wise;

var vertical = student_class_wise;
var vertical1 = student_class_wise1;
var vertical2 = student_class_wise2;
var vertical3 = student_class_wise3;
var vertical4 = student_class_wise4;


var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: color,
        datasets: [{
    label: "Absent",
    backgroundColor: "red",
    data: vertical1,
  }, {
    label: "Present",
    backgroundColor: "green",
    data: vertical,
  },{
    label: "Leave",
    backgroundColor: "blue",
    data: vertical2
  }, {
	label: "Holiday",
    backgroundColor: "Black",
	data: vertical3,  
    
  }]

    },
    options: {
        scales: {
           yAxes: [{
       ticks: {
           min: 0,
           max: 100,
           callback: function(value) {
               return value + "%"
           }
       },
       scaleLabel: {
           display: true,
           labelString: "Percentage"
       }
   }]
   
        }
    }
});

},

});

});

</script>

<script>
var daily_expense = [];
var daily_collection = [];
var dates_daily_expense = [];
var total_daily_expense = [];
 $("#fetch_daily_expense").on('click', function(){
	 $(this).prop('disabled', true);
	 var year =  $("#year_daily_expense").val();
     var month = $("#month_daily_expense").val();
 $.ajax({  
    method: 'POST',  
    url: '<?php echo base_url() ?>transactions/expense_line_graph2',
    data: { 'year': year,'month': month },
    success: function(data){
	obj  = JSON.parse(data);
    $.each(obj['collection'],function(i,item){
	 dates_daily_expense.push(i);
 	 daily_collection.push(item['amount']);
	})
    $.each(obj['expense'],function(j,item){
 	daily_expense.push(item['amount']);
	})
var ctx = document.getElementById('Chart_daily_expense').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'line',
    // The data for our dataset
    data: {
        labels: dates_daily_expense,
        datasets: [{
			fill: false,
			lineTension:0.1,
            label: "Collection",
            backgroundColor: 'green',
			pointBorderWidth:6,
            borderColor: 'green',
            data:daily_collection,
        },{
			fill: false,
			lineTension:0.1,
            label: "Expense",
            backgroundColor: 'red',
			pointBorderWidth:6,
            borderColor: 'red',
            data:daily_expense,
        }]
    },
    // Configuration options go here
    options: {}
});
},
});
});
</script>

<script>
var current_month_expense = [];
var current_month_collection = [];
var dates_current_month_expense = [];
var total_current_month_expense = [];
 $("#fetch_comparison").on('click', function(){
	 $(this).prop('disabled', true);
	 var year =  $("#year_comparison").val();
     var month = $("#month_comparison").val();
 $.ajax({  
    method: 'POST',  
    url: '<?php echo base_url() ?>transactions/expense_line_graph2',
    data: { 'year': year,'month': month },
    success: function(data){
	obj  = JSON.parse(data);
    $.each(obj['collection'],function(i,item){
		
	 dates_current_month_expense.push(i);
	current_month_collection.push(item['amount']);
	})
     $.each(obj['expense'],function(j,item){
   	 current_month_expense.push(item['amount']);
	})
var ctx = document.getElementById('Chart_current_month_expense').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'line',
    // The data for our dataset
    data: {
        labels: dates_current_month_expense,
        datasets: [{
			fill: false,
			lineTension:0.1,
            label: "Collection",
            backgroundColor: 'green',
			pointBorderWidth:6,
            borderColor: 'green',
            data:current_month_collection,
        },{
			fill: false,
			lineTension:0.1,
            label: "Expense",
            backgroundColor: 'red',
			pointBorderWidth:6,
            borderColor: 'red',
            data:current_month_expense,
        }]
    },
    // Configuration options go here
    options: {}
});
},
});
});

</script>

<script>

var class_exam_pass = [];
var class_exam_fail = [];
var class_exam = [];
var total1 = [];



 $("#fetch_exam_class_wise").on('click', function(){
	 $(this).prop('disabled', true);
	 var exam_id = $('.exam_id:checked').val();
	
 $.ajax({  
    method: 'POST',  
    url: '<?php echo base_url() ?>transactions/class_graph_month3',
    data: { 'exam_id': exam_id },
    success: function(data){
    
	obj  = JSON.parse(data);
	
    $.each(obj,function(i,item){
	 
	class_exam.push(i);
	
        var total_pass = 0; 
	    var total_fail = 0; 
      
	  var total_student = 0;
	     	      
	    $.each(item,function(j,item){


       total_student = j++;

        var total = 0;		
     	var get_marks = 0;
    	var  passing_marks =0;
		$.each(item['exam_array'],function(k,item){
	
	    total =   Number(total)+ Number(item['full_marks']);		
	    get_marks =   Number(get_marks)+ Number(item['get_marks']);		
	    passing_marks = Number(passing_marks) + Number(item['passing_marks']);
		
		
			})
     
	 
	 
/// console.log(get_marks);
//	 console.log(passing_marks);
	// console.log(total);
	 
	  
		if(get_marks < passing_marks){    // 30 < 60
	
			total_fail++
			
				}
				
			if(get_marks > passing_marks){
			
			total_pass++	
			
					}


			})
			

//console.log(total_fail);
//console.log(total_pass);


var count_fail = parseInt(total_fail) * 100 / parseInt(total_student+1);
var count_pass = parseInt(total_pass) * 100 / parseInt(total_student+1);


  

class_exam_pass.push(count_pass);
class_exam_fail.push(count_fail);
	
	
	})


var ctx = $("#Chart_exam_class_wise");


var color = class_exam;

var vertical = class_exam_pass;
var vertical1 = class_exam_fail;


var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: color,
        datasets: [{
    label: "Fail",
    backgroundColor: "red",
    data: vertical1,
  }, {
    label: "Pass",
    backgroundColor: "green",
    data: vertical,
  }]

    },
    options: {
        scales: {
           yAxes: [{
       ticks: {
           min: 0,
           max: 100,
           callback: function(value) {
               return value + "%"
           }
       },
       scaleLabel: {
           display: true,
           labelString: "Percentage"
       }
   }]
   
        }
    }
});

},

});

});

</script>

<script>

var class_percentage_exam_pass = [];
var class_percentage_exam = [];
var total1 = [];



 $("#fetch_percentage_class_wise").on('click', function(){
	 $(this).prop('disabled', true);
	 var exam_id = $('.percentage_exam_id:checked').val();
	
 $.ajax({  
    method: 'POST',  
    url: '<?php echo base_url() ?>transactions/class_graph_month3',
    data: { 'exam_id': exam_id },
    success: function(data){
    
	obj  = JSON.parse(data);
	
    $.each(obj,function(i,item){
	 
	class_percentage_exam.push(i);
	
      
	     var total_student = 0;
	     var class_percentage = 0	     	      
	    $.each(item,function(j,item){


       total_student = j++;

        var total = 0;		
     	var get_marks = 0;
    	var  passing_marks =0;
		$.each(item['exam_array'],function(k,item){
	
	    total =   Number(total)+ Number(item['full_marks']);		
	    get_marks =   Number(get_marks)+ Number(item['get_marks']);		
	    passing_marks = Number(passing_marks) + Number(item['passing_marks']);
		
		
			})
	 
/// console.log(get_marks);
//	 console.log(passing_marks);
	// console.log(total);
	 
	  var student_percentage = parseInt(get_marks) * 100 / parseInt(total);

 class_percentage = Number(class_percentage) + Number(student_percentage) 



			})
			

//console.log(total_fail);
//console.log(total_pass);



var percentage = parseInt(class_percentage) / parseInt(total_student+1);

  

class_percentage_exam_pass.push(percentage);
	
	
	})


var ctx = $("#Chart_percentage_class_wise");


var color = class_percentage_exam;

var vertical = class_percentage_exam_pass;

var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: color,
        datasets: [{
    label: "Class Percentage",
    backgroundColor: "blue",
    data: vertical,
  }]

    },
    options: {
        scales: {
           yAxes: [{
       ticks: {
           min: 0,
           max: 100,
           callback: function(value) {
               return value + "%"
           }
       },
       scaleLabel: {
           display: true,
           labelString: "Percentage"
       }
   }]
   
        }
    }
});

},

});

});

</script>

<script>

var exam_percentage = [];
var class_exam = [];
var total1 = [];



 $("#fetch_percentage_exam_class_wise").on('click', function(){
	 $(this).prop('disabled', true);
	var exam_id = [];
	$("input[name^='fee']:checked").each(function() {
	exam_id.push($(this).val());
	
	
	});	 
	
 $.ajax({  
    method: 'POST',  
    url: '<?php echo base_url() ?>transactions/class_graph_month4',
    data: { 'exam_id': exam_id },
    success: function(data){
    obj  = JSON.parse(data);
	$.each(obj,function(i,item){
		class_exam.push(i);
	
	 var total_exam = 0;
	 
	var percentage = 0
	$.each(item,function(j,item){
	
	     total_exam++;
	  	 total_student = 0;
		var class_percentage = 0;
	
      
		$.each(item,function(k,item){
				
			total_student = k++; 
			
			var total = 0;
					
     	var get_marks = 0;
    	var  passing_marks =0;

	   $.each(item['exam_array'],function(l,item){

        total =   Number(total)+ Number(item['full_marks']);		
	    get_marks =   Number(get_marks)+ Number(item['get_marks']);		
	    passing_marks = Number(passing_marks) + Number(item['passing_marks']);
	    })
	
	     var student_percentage = parseInt(get_marks) * 100 / parseInt(total);
	     if(isNaN(student_percentage)){
		 student_percentage = 0;
	  	 }
	 	 class_percentage = Number(class_percentage) + Number(student_percentage); 
	 	 
		
	    })
	 
	   var percentage2 = parseInt(class_percentage) / parseInt(total_student+1);
	
  	   percentage = Number(percentage) + Number(percentage2); 
	

	
	   })
	
		
	 
	 var perce = parseInt(percentage) / parseInt(total_exam);
	
	exam_percentage.push(perce);


	})
	
	

	
var ctx = $("#Chart_percentage_exam_class_wise");


var color = class_exam;

var vertical = exam_percentage ;


var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: color,
        datasets: [{
    label: "percentage",
    backgroundColor: "green",
    data: vertical,
  }]

    },
    options: {
        scales: {
           yAxes: [{
       ticks: {
           min: 0,
           max: 100,
           callback: function(value) {
               return value + "%"
           }
       },
       scaleLabel: {
           display: true,
           labelString: "Percentage"
       }
   }]
   
        }
    }
});

},

});

});

</script>

<script>

var teacher_exam_teacher_wise = [];
var dates_exam_teacher_wise = [];
var total1 = [];

 $("#fetch_percentage_exam_teacher_wise").on('click', function(){
	 $(this).prop('disabled', true);
	 var exam_id = $('.percentage_exam_id:checked').val();
	 
 $.ajax({  
    method: 'POST',  
    url: '<?php echo base_url() ?>transactions/teacher_exam_result',
    data: { 'exam_id': exam_id },
    success: function(data){
    obj  = JSON.parse(data);
	
  
 
	$.each(obj,function(i,item){
		dates_exam_teacher_wise.push(item['name']);
	  var total_subject = 0;	
	  var total_marks_total = 0;
	  var get_marks_total = 0;
	  var passing_marks_total = 0;
	  $.each(item['subject'],function(j,item){
	   total_subject++;
	   var passing_marks = 0;	
	   var total_marks = 0;
	   var get_marks = 0;
		$.each(item['exam'],function(k,item){
		total_marks  =   Number(get_marks)+ Number(item['full_marks']);		
	    passing_marks = Number(passing_marks) + Number(item['passing_marks']);
		get_marks =  Number(get_marks) + Number(item['result']['get_marks']);        
		  })
		  total_marks_total  =   Number(total_marks_total)+ Number(total_marks);	
		  get_marks_total     =   Number(get_marks_total )+ Number(get_marks);
		  passing_marks_total =   Number(passing_marks_total)+ Number(passing_marks);
		  })
		 
           var  total_get =  parseInt( get_marks_total) / parseInt(total_subject);
           var  total =  parseInt( total_marks_total) / parseInt(total_subject);    
           var percentage = parseInt( total_get) * 100 / parseInt(total );
           teacher_exam_teacher_wise.push(percentage)

	})

var ctx = $("#Chart_percentage_exam_teacher_wise");

var color = dates_exam_teacher_wise;

var vertical = teacher_exam_teacher_wise;

var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: color,
        datasets: [{
    label: "percentage",
    backgroundColor: "green",
    data: vertical,
  }]

    },
    options: {
        scales: {
           yAxes: [{
       ticks: {
           min: 0,
           max: 100,
           callback: function(value) {
               return value + "%"
           }
       },
       scaleLabel: {
           display: true,
           labelString: "Percentage"
       }
   }]
   
        }
    }
});

},

});

});

</script>

    </section>
</div>



 





</body>
</html>          