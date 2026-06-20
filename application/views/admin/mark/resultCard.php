



<div class="content-wrapper" style="min-height: 946px;">
    <!-- Main content -->
<style>
@media print {
  #printPageButton {
    display: none;
  }
}

</style>
    <section class="content">
        <div class="col-md-12">
            
            <button class="pull-right" id="printPageButton" onclick="window.print()"><i class="fa fa-print"></i></button>
    
        </div>
        <div class="row">
            <div class="col-md-10 col-sm-offset-1" style="background-color: #fff; border:1px solid #000;">
                <h2 class="text-center">
                    <span>
                        <img src="<?= base_url( "uploads/school_content/logo/{$school_logo}" ) ?>" title="<?= $school_name ?>" style="height:70px; width:70px;" >
                    </span>
                    <?= $school_name ?></h2>
                <h3 class="text-center"><?= $exam['name'] ?><br>Progress Report</h3>
                <div class="col-md-12">
                     <table class="table">
                        <tbody>
                            <tr>
                                <td width="12%" style="border-top: 0px;">
                                    Name :
                                </td>
                                <td width="65%" style="border-top: 0px; border-bottom: 1px solid #000;">
                                    <?php echo $examSchedule['firstname'] . " " . $examSchedule['lastname']; ?>
                                </td>
                                <td width="25%" rowspan="6">
                                    <img src="<?= site_url('/').$examSchedule['image'] ?>" style="height: 160px;width: 140px; margin-top: 25px;margin-left: 16px;">
                                </td>
                            </tr>
                            <tr>
                                <td style="border-top: 0px;">
                                    Father Name :
                                </td>
                                <td style="border-top: 0px; border-bottom: 1px solid #000;">
                                    <?php echo $examSchedule['father_name'] ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="border-top: 0px;">
                                    Class : 
                                </td>
                                <td style="border-top: 0px; border-bottom: 1px solid #000;">
                                    <?= $class_sections['class']['class']?> / <?= $class_sections['section']['section'] ?>
                                </td>
                            </tr>
                            <tr>
                                <td width="10%" style="border-top: 0px;">
                                    Roll No :
                                </td>
                                <td style="border-top: 0px; border-bottom: 1px solid #000;">
                                    <?= $examSchedule['roll_no'] ?>
                                </td>
                            </tr>
                            <tr>
                                <td width="10%" style="border-top: 0px;">
                                    Ad No :
                                </td>
                                <td style="border-top: 0px; border-bottom: 1px solid #000;">
                                    <?= $examSchedule['admission_no'] ?>
                                </td>
                            </tr>
                            <tr>
                                <td width="10%" style="border-top: 0px;">
                                    Position :
                                </td>
                                <td style="border-top: 0px; border-bottom: 1px solid #000;">
                                  
                                <?php echo $position ?>
                                
                                    
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-3">
                </div>
                <div class="col-md-12" style="margin-bottom: 30px;">
                    <table class="table     table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Subject</th>
                                <th>Total Marks</th>
                                <th>Marks Obtained</th>
                                <th>Percentage</th>
                                <th>Grade</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $total_total = 0;
                                $total_get   = 0;
                                $total_per   = 0;
                                foreach ($examSchedule['exam_array'] as $key => $subjects) {
                                $per         = 0;
                                $total_total += $subjects['full_marks'];
                                $total_get   += $subjects['get_marks'];
                                
                                $per = $subjects['get_marks'] * 100 / $subjects['full_marks'];
                                $per = number_format($per, 2, '.', '') ;
                                $total_per   = ($total_get * 100) / $total_total;
                            ?>
                                    <tr>
                                        <td><?= $subjects['exam_name'] ?></td>
                                        <td><?= $subjects['full_marks'] ?></td>
                                        <td><?= $subjects['get_marks'] ?></td>
                                        <td>
                                            <?= $per ?>
                                        </td>
                                        <td>
                                            <?php
                                            foreach ($listgrade as $grade) {
                                            ?>
                                                <?php if ($per >= $grade['mark_from'] && $per <= $grade['mark_upto'] ): ?>
                                                    <?php echo $grade['name'] ?>
                                                <?php endif ?>
                                                
                                            <?php
                                            }
                                            ?>
                                        </td>
                                    </tr>
                            <?php
                                } 
                            ?>      
                                    <tr style="border-top: 2px solid #000;">
                                        <td>
                                            Total
                                        </td>
                                        <td>
                                            <?= $total_total ?>
                                        </td>
                                        <td>
                                            <?= $total_get ?>
                                        </td>
                                        <td>
                                            <?= number_format($total_per, 2, '.', '') ?>
                                        </td>
                                        <td>
                                            <?php
                                            foreach ($listgrade as $grade) {
                                            ?>
                                                <?php if ($total_per >= $grade['mark_from'] && $total_per <= $grade['mark_upto'] ): ?>
                                                    <?php echo $grade['name'] ?>
                                                <?php endif ?>
                                                
                                            <?php
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                                               <?php
          
		  
		   $i=0;
  
   $occurrences = array_count_values($total_get);
   
   $total_get = array_unique($total_get);
   foreach($total_get as $grade) {
   if($grade == end($total_get))$i += $occurrences[$grade]-1;
   echo str_repeat('<tr><td>'.$grade.': '.($i+1).'</td></tr>',$occurrences[$grade]);
   $i += $occurrences[$grade];
    }
  
                                
                                
                                
 ?>            </tr>
                                    
                                    
                        </tbody>
                    </table>
                </div>
                <div class="col-md-1">
                    <h4>Comments</h4>
                </div>
                <div class="col-md-11">
                    <div style="border-bottom: 1px solid #000;height:30px;"></div>
                </div><br>
                <div style="clear: both;"></div>
                <div class="col-md-12" style="margin-top: 50px;">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td width="16%">Class Teacher</td>
                                <td width="25%"></td>
                                <td width="15%">Principal</td>
                                <td width="25%"></td>
                                <td width="8%">Print Date : </td>
                                <td width="10%"><?= date('M-d-Y',now())?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section><!-- /.content -->
</div>
