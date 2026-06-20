
<div class="content-wrapper" style="min-height: 946px;">
    <!-- <section class="content-header">
        <h1>
            <?php echo $this->lang->line('examinations'); ?> <small><?php echo $this->lang->line('student_fee1'); ?></small> 
        </h1>
    </section> -->
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
          <div class="col-md-12">
                <!-- general form elements -->
                <!-- <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?></h3>
                        <div class="box-tools pull-right">
                            <a href="<?php echo base_url(); ?>admin/mark/create" class="btn btn-primary btn-sm"  data-toggle="tooltip" title="<?php echo $this->lang->line('add'); ?>" >
                                <i class="fa fa-plus"> <?php echo $this->lang->line('add'); ?></i>
                            </a>
                        </div>
                    </div>
                    <form action="<?php echo site_url('admin/mark') ?>"  method="post" accept-charset="utf-8" id="schedule-form">
                        <div class="box-body">
                            <div class="row">
                                <input type="hidden" name="save_exam" value="search" >                               
                                <?php echo $this->customlib->getCSRF(); ?>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('exam_name'); ?></label>

                                        <select  id="exam_id" name="exam_id" class="form-control" >
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                            <?php
                                            foreach ($examlist as $exam) {
                                                ?>
                                                <option value="<?php echo $exam['id'] ?>" <?php
                                                if ($exam_id == $exam['id']) {
                                                    echo "selected =selected";
                                                }
                                                ?>><?php echo $exam['name'] ?></option>
                                                        <?php
                                                        $count++;
                                                    }
                                                    ?>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('exam_id'); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('class'); ?></label>
                                        <select  id="class_id" name="class_id" class="form-control" >
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                            <?php
                                            foreach ($classlist as $class) {
                                                ?>
                                                <option value="<?php echo $class['id'] ?>" <?php
                                                if ($class_id == $class['id']) {
                                                    echo "selected =selected";
                                                }
                                                ?>><?php echo $class['class'] ?></option>

                                                <?php
                                                $count++;
                                            }
                                            ?>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('class_id'); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line('section'); ?></label>
                                        <select  id="section_id" name="section_id" class="form-control" >
                                            <option value=""><?php echo $this->lang->line('select'); ?></option>
                                        </select>
                                        <span class="text-danger"><?php echo form_error('section_id'); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div> -->
                <?php
                if (isset($examSchedule['status'])) {
                    ?>

                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                <?php  
                                    echo $examlist['name']." Marks Sheet (".$class_sections['class']['class']."/".$class_sections['section']['section'].")"; 
                                ?>
                            </h3>
                            <div class="pull-right">
                                </a>
                                <a href="<?php echo site_url('admin/exam?exam_id=').$exam_id ?>" class="btn btn-info btn-sm" style="padding: 4px 10px;">Back
                                </a>
                            </div>
                        </div>
                        <div class="box-body">
                            <?php
                            if ($examSchedule['status'] == "yes") {
                                ?>

                                <form role="form" id="" class="" method="post" action="<?php echo site_url('admin/mark/create') ?>">
                                    <?php echo $this->customlib->getCSRF(); ?>
                                    <input type="hidden" name="class_id" value="<?php echo $class_id; ?>">
                                    <input type="hidden" name="section_id" value="<?php echo $section_id; ?>">
                                    <input type="hidden" name="exam_id" value="<?php echo $exam_id; ?>">
                                    <div class="table-responsive">
                                        <table class="table     table-bordered table-hover example">
                                            <thead>
                                                <tr>
                                                    <th >
                                                        Ad No
                                                    </th>
                                                    <th>
                                                        Roll No
                                                    </th>
                                                    <th>
                                                        <?php echo $this->lang->line('student'); ?>
                                                    </th>
                                                    <th>
                                                        <?php echo $this->lang->line('father_name'); ?>
                                                    </th>
                                                    <?php
                                                    $s = 0;
                                                    if ($examSchedule['status'] == "yes") {
                                                        foreach ($examSchedule['result'] as $key => $st) {
                                                            if ($s == 0) {
                                                                foreach ($st['exam_array'] as $key => $exam_schedule) {   $teacher = $this->teacher_model->get($exam_schedule['teacher_id']); 
																
                                                                    ?>
                                                                    <th>
                                                                        <?php
                                                                        echo $exam_schedule['exam_name']."<br/>
" .$teacher['name']  ."<br/> (" . substr($exam_schedule['exam_type'], 0, 2) . ": " . $exam_schedule['passing_marks'] . "/" . $exam_schedule['full_marks'] . ") ";
                                                                        ?>
                                                                    </th>
                                                                    <?php
                                                                }
                                                            }
                                                            $s++;
                                                        }
                                                    } else {
                                                        ?>

                                                        <?php
                                                    }
                                                    ?>
                                                    <th><?php echo $this->lang->line('grand_total'); ?></th>
                                                    <th><?php echo $this->lang->line('percent').' (%)'; ?></th>
                                                    <th>Grade</th>
                          <th style="width:60px; margin:0px 0px" align="center"><?php echo $this->lang->line('result'); ?></th>
                                                    <th>Result Card </th>
                      <th> 
                     
                     
                               <input type="checkbox" class="class_section_checkbox select_checkbox" data-target=".student_checkbox_<?= $class_id . '_' . $section_id ?>">
                                          

                     
           <?php /*?>  <?php        foreach ($examSchedule['result'] as $key => $student) {
		 ?> <?php }?><?php */?>
                      
                      <button type="submit" class="btn btn-default btn-sm pull-right" formaction="<?php echo site_url('admin/mark/result_card_custom?exam_id=').$exam_id.'&class_id='.$class_id.'&section_id='.$section_id ?>">Custom</button>
                      
                        <button type="submit" class="btn btn-default btn-sm pull-right" formaction="<?php echo site_url('admin/mark/result_card_all?exam_id=').$exam_id.'&class_id='.$class_id.'&section_id='.$section_id ?>"><i class="fa fa-print "></i></button>
                        
                       </th>
                      </tr>
                                     </thead>
                                      <tbody>
                                                <?php
                                                $s = 0;
                                                foreach ($examSchedule['result'] as $key => $student) {
													
													 
                                                    ?>
                                                    
                                        <input type="hidden" name="student_ids[]" value="<?php echo $student['student_id'] ?>">

                                                <?php
                                                if (!empty($student['exam_array'])) {
                                                    if ($s == 0) {
                                                        foreach ($student['exam_array'] as $key => $exam_schedule) {
                                                            ?>
                                                            <input type="hidden" name="exam_schedule[]" value="<?php echo $exam_schedule['exam_schedule_id'] ?>">
                                                            <?php
                                                        }
                                                    }
                                                } else {
                                                    ?>

                                                    <?php
                                                }
                                                $s++;
                                            }
                                            ?>
                                            <?php
                                            foreach ($examSchedule['result'] as $key => $student) {
                                                $total_marks = "";
                                                $obtain_marks = "0";
                                                $result = "Pass";
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $student['admission_no'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $student['roll_no'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $student['firstname'] . " " . $student['lastname']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $student['father_name'] ?>
                                                    </td>
                                                    <?php
                                                    if (!empty($student['exam_array'])) {
                                                        count($student['exam_array']);
                                                        $s = 0;
                                                        foreach ($student['exam_array'] as $key => $exam_schedule) {
                                                            $total_marks = $total_marks + $exam_schedule['full_marks'];
                                                            ?>
                                                            <td>
                                                                <?php
                                                             if (!isset($exam_schedule['attendence'])) {
                                                                    echo "N/A";
                                                                    $result = "N/A";
                                                                } // not attendence
																 else {
                                                                    if ($exam_schedule['attendence'] == "pre") {
                                                                       echo $get_marks_student = $exam_schedule['get_marks'];
																	   
																	    $passing_marks_student = $exam_schedule['passing_marks'];
                                                                        if ($result == "Pass") {
                                                                            if ($get_marks_student < $passing_marks_student) {
                                                                                $result = "Fail";
                                                                            }
                                                                        }// result pass declare above
                                                                    $obtain_marks = $obtain_marks + $exam_schedule['get_marks']; 
																	 
                                                                    } //present
																	
																	else {
                                                                        $result = "Fail";
                                                                        $s++;
                                                                        echo ($exam_schedule['attendence']);
                                                                    } //not present
																	
                                                                } //attendence
                                                                ?>
                                                            </td>
                                                            <?php
                                                        }
                                                        if ($s == count($student['exam_array'])) {
                                                            $obtain_marks = 0;
                                                        }
                                                        ?>
                                                        <td> <?php echo $obtain_marks . " /" . $total_marks; ?> 
                                                        </td>
                                                        <td>
                                                         <?php
                                                            $per = $obtain_marks * 100 / $total_marks;
                                                            echo number_format($per, 2, '.', '') ;
                                                            ?>

                                                        </td>
                                                        
                                                     
                                                        <?php
                                                    }  //close exam array
													else {
                                                        ?>


                                                        <?php } ?>
                                             <td>

                                        <?php  foreach ($listgrade as $grade) { ?>
                                          <?php if ($per >= $grade['mark_from'] && $per <= $grade['mark_upto'] ): ?>
                                                    <?php echo $grade['name'] ?>
                                                <?php endif ?>
                                                
                                            <?php
                                            }
                                            ?>

                                        </td>
                                      

<td align="left">
             <?php         

    
   $failed_marks   = ($listgradelast[0]['mark_upto']);
   
   if($per < $failed_marks){
	   
	   echo "<label class='text-danger' style='width:70px;'>Fail</label>";
	   
	   }else{
		   
		 echo "<label class='text-success' style='width:70px;'>Pass</label>"; 
		   }	
		   ?>
</td>

<td align="left">
 <a  href="<?php echo site_url('admin/mark/result_card?exam_id=').$exam_id.'&class_id='.$class_id.'&section_id='.$section_id.'&student_id='.$student['student_id'] ?>" class="text-black" > <i class="fa fa-print"></i></a></td>

  <td align="left">
<input type="checkbox" class="student_checkbox_<?= $class_id. '_'  .$section_id; ?> select_checkbox" name="student_ids[]" value="<?= $student['student_id'] ?>">
</td>
 </tr>
                                                <?php
                                            }
                                            ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </form>
                                <?php
                            } else {
                                ?>
                                <div class="alert alert-info"><?php echo $this->lang->line('no_record_found'); ?></div>
                                <?php
                            }
                            ?>

                        </div><!---./end box-body--->
                    </div>
                </div>
                <!-- right column -->
            </div>   <!-- /.row -->
            <?php
        } else {
            
        }
        ?>
        
         
    </section><!-- /.content -->
</div>



<?php /*?><script language="JavaScript">
function toggle(source) {
  checkboxes = document.getElementsByName('student_ids[]');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
}
</script>
<?php */?>


<script type="text/javascript">

 
$(document).on('change', '.select_checkbox', function (e) {
        
	var target = $( this ).data( 'target' ),
                current_checked = $( this ).prop( 'checked' );

            if ( current_checked === true ) {
                $( target ).prop( 'checked', true ).change();
            } else {
                $( target ).prop( 'checked', false ).change();
            }
    });

    function getSectionByClass(class_id, section_id) {
        if (class_id != "" && section_id != "") {
            $('#section_id').html("");
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            $.ajax({
                type: "GET",
                url: base_url + "sections/getByClass",
                data: {'class_id': class_id},
                dataType: "json",
                success: function (data) {
                    $.each(data, function (i, obj)
                    {
                        var sel = "";
                        if (section_id == obj.section_id) {
                            sel = "selected";
                        }
                        div_data += "<option value=" + obj.section_id + " " + sel + ">" + obj.section + "</option>";
                    });
                    $('#section_id').append(div_data);
                }
            });
        }
    }

    $(document).ready(function () {
        $(document).on('change', '#class_id', function (e) {
            $('#section_id').html("");
            var class_id = $(this).val();
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            $.ajax({
                type: "GET",
                url: base_url + "sections/getByClass",
                data: {'class_id': class_id},
                dataType: "json",
                success: function (data) {
                    $.each(data, function (i, obj)
                    {
                        div_data += "<option value=" + obj.section_id + ">" + obj.section + "</option>";
                    });
                    $('#section_id').append(div_data);
                }
            });
        });
        var class_id = $('#class_id').val();
        var section_id = '<?php echo set_value('section_id') ?>';
        getSectionByClass(class_id, section_id);
        $(document).on('change', '#feecategory_id', function (e) {
            $('#feetype_id').html("");
            var feecategory_id = $(this).val();
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
            $.ajax({
                type: "GET",
                url: base_url + "feemaster/getByFeecategory",
                data: {'feecategory_id': feecategory_id},
                dataType: "json",
                success: function (data) {
                    $.each(data, function (i, obj)
                    {
                        div_data += "<option value=" + obj.id + ">" + obj.type + "</option>";
                    });
                    $('#feetype_id').append(div_data);
                }
            });
        });
    });
    $(document).on('change', '#section_id', function (e) {
        $("form#schedule-form").submit();
    });
	
	
</script>
