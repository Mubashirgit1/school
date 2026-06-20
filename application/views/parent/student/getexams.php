<style>

.student-image{
    width: 100px !important;
    display: inline !important;
    margin:none !important;
}


</style>
<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <div class="box box-primary" style="margin-bottom: 0px;">
            <div class="box-body">
            <div class="col-xs-5 col-sm-3 col-md-2"  > 
            <?php  $url = $student['image'] != null ? $student['image'] : 'uploads/student_images/no_image.png';  ?>
                <img class="student-image profile-user-img img-responsive img-circle" src="<?= base_url().$url ?>" alt="User profile picture">
            </div> 
           
            <div class="col-xs-7 col-sm-9 col-md-10"> 
                <div class="card-body-right">
                    <h4 class="card-title"><?= $student['firstname'].' '.$student['lastname']?></h4>
                    <h5><?= $student['class'].' / '.$student['section']?></h5>
                    <p class="card-text"><?= admission_text() ?> <?= $student['admission_no'] ?>  </p>
                </div>
            </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <?php echo $this->lang->line('exam_list'); ?>
                        </h3>
                    </div>
                    <div class="box-body">
                        <?php
                        if (empty($examSchedule)) {
                            ?>
                            <div class="alert alert-danger">
                                No Exam Found.
                            </div>
                            <?php
                        } else {
                            foreach ($examSchedule as $key => $value) {
                                ?>
                                <h4 class="page-header"><?php echo $value['exam_name']; ?></h4>
                                <?php
                                if (empty($value['exam_result'])) {
                                    ?>
                                    <div class="alert alert-info"><?php echo $this->lang->line('no_result_prepare'); ?></div>
                                    <?php
                                } else {
                                    ?>
                                  <div class="table-responsive">  
                                    <table class="table table-bordered table-hover ">
                                        <thead >
                                            <tr >
                                                <th style='background:lightgrey'>
                                                    <?php echo $this->lang->line('subject'); ?>
                                                </th>
                                                <th style='background:lightgrey'>
                                                    <?php echo $this->lang->line('full_marks'); ?>
                                                </th>
                                                <th style='background:lightgrey'>
                                                    <?php echo $this->lang->line('passing_marks'); ?>
                                                </th>
                                                <th style='background:lightgrey'>
                                                    <?php echo $this->lang->line('obtain_marks'); ?>
                                                </th>
                                                <th style='background:lightgrey'>
                                                    Percentage
                                                </th>
                                                <th style='background:lightgrey'>
                                                    Grade
                                                </th>
                                                
                                                <th class="text text-right" style='background:lightgrey'>
                                                    <?php echo $this->lang->line('result'); ?>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $obtain_marks = "";
                                            $total_marks = "";
                                            $result = "Pass";
                                            $exam_results_array = $value['exam_result'];
                                            $s = 0;
                                            foreach ($exam_results_array as $result_k => $result_v) {
                                                $total_marks = $total_marks + $result_v['full_marks'];
                                                ?>
                                                <tr>
                                                    <td>  <?php                                                     
                                                        echo $result_v['exam_name'] . " (" . substr($result_v['exam_type'], 0, 2) . ".) ";
                                                        ?></td>
                                                        <?php 
                                                        
                                                        ?>
                                                    <td><?php echo $result_v['full_marks']; ?></td>
                                                    <td><?php echo $result_v['passing_marks']; ?></td>
                                                    <td>
                                                        <?php
                                                        if ($result_v['attendence'] == "pre") {
                                                            echo $get_marks_student = $result_v['get_marks'];
                                                            $passing_marks_student = $result_v['passing_marks'];
                                                            if ($result == "Pass") {
                                                                if ($get_marks_student < $passing_marks_student) {
                                                                    $result = "Fail";
                                                                }
                                                            }
                                                            $obtain_marks = $obtain_marks + $result_v['get_marks'];
                                                        } else {
                                                            $result = "Fail";
                                                            echo ($result_v['attendence']);
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        $per = $obtain_marks * 100 / $total_marks;
                                                        echo number_format($per, 2, '.', '') ;
                                                        ?>
                                                    </td>
                                                    <td>
                                                    <?php  foreach ($gradeList as $grade) { ?>
                                          <?php if ($per >= $grade['mark_from'] && $per <= $grade['mark_upto'] ): ?>
                                                    <?php echo $grade['name'] ?>
                                                <?php endif ?>
                                                
                                            <?php
                                            }
                                            ?>
                                                    </td>
                                                    <td class="text text-center">
                                                        <?php
                                                        if ($result_v['attendence'] == "pre") {
                                                            $passing_marks_student = $result_v['passing_marks'];
                                                            if ($get_marks_student < $passing_marks_student) {
                                                                echo "<span class='label pull-right' style='color:red;     font-size: 14px;'>".$this->lang->line('fail')."</span>";
                                                            } else {
                                                                echo "<span class='label pull-right' style='color:green;    font-size: 14px;'>".$this->lang->line('pass')."</span>";
                                                            }
                                                        } else {
                                                            echo "<span class='label pull-right ' style='color:red;    font-size: 14px;'>".$this->lang->line('fail')."</span>";
                                                            $s++;
                                                        }
                                                        ?>
                                                    </td>
                                                    
                                                </tr>
                                                <?php
                                                if ($s == count($exam_results_array)) {
                                                    $obtain_marks = 0;
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                  </div>  
                                    <div class="row">
                                        <?php
                                        $foo = "";
                                        ?>                                      
                                        <div class="col-sm-3 border-right">
                                            <div class="description-block">
                                                <h5 class="description-header"><?php echo $this->lang->line('grand_total'); ?> :
                                                    <span class="description-text"><?php echo $obtain_marks . "/" . $total_marks; ?></span>
                                                </h5>
                                            </div>                                           
                                        </div>  
                                        <div class="col-sm-3 border-right">
                                            <div class="description-block">
                                                <h5 class="description-header"><?php echo $this->lang->line('percentage'); ?>:
                                                    <span class="description-text"><?php
                                                        $foo = ($obtain_marks * 100) / $total_marks;
                                                        echo number_format((float) $foo, 2, '.', '');
                                                        ?>
                                                    </span>
                                                </h5>
                                            </div>                                          
                                        </div>                                     
                                        <div class="col-sm-3 pull">
                                            <div class="description-block">
                                                <h5 class="description-header"><?php echo $this->lang->line('result'); ?> :
                                                    <span class="description-text">
                                                        <?php
                                                        if ($result == "Pass") {
                                                            ?>
                                                            <b class='text text-success'><?php echo $result; ?></b>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <b class='text text-danger'><?php echo $result; ?></b>
                                                            <?php
                                                        }
                                                        ?>
                                                    </span>
                                                </h5>
                                            </div>                                          
                                        </div>
                                        <div class="col-sm-3 border-right">
                                            <div class="description-block">
                                                <h5 class="description-header">
                                                    <span class="description-text"><?php
                                                        if (!empty($gradeList)) {

                                                            foreach ($gradeList as $key => $value) {
                                                                if ($foo >= $value['mark_from'] && $foo <= $value['mark_upto']) {
                                                                    ?>
                                                                    <?php echo $this->lang->line('grade').": " . $value['name']; ?>
                                                                    <?php
                                                                    break;
                                                                }
                                                            }
                                                        }
                                                        ?></span>
                                                </h5>
                                            </div>                                            
                                        </div>                                     
                                    </div>
                                <?php }
                                ?>
                                <?php
                            }
                        }
                        ?>
                    </div>                  
                </div>
            </div>
        </div>
</div>
</section>
</div>


<script>
    
//     $(function(){
        
//             setTimeout(function () {
// $('.dt-buttons.btn-group.btn-group2').css('visibility','hidden');
//     },300);
        
        
        
        
//     })
    
</script>




