<style>



@media print {
  #printPageButton {
    display: none;
  }

  .remove_print{
    display: none;
  }
}



</style>





<!------ Include the above in your HEAD tag ---------->
<div class="content-wrapper" style="min-height: 946px;">
  
  
  
    <!-- Content Header (Page header) -->
    <!-- <section class="content-header">
        <h1>
            <?php echo $this->lang->line('examinations'); ?>

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
                    </div>
                    <form action="<?php echo site_url('admin/mark/create') ?>"  method="post" accept-charset="utf-8" id="schedule-form">
                        <div class="box-body">
                            <?php if ($this->session->flashdata('msg')) { ?>
                                <?php echo $this->session->flashdata('msg') ?>
                            <?php } ?>
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
if (isset($examSchedule)) {
    ?>


                    <div class="box box-primary">
                        <div class="box-header ">
                                <div class="col-md-2 col-md-offset-1" >
                                    <img src="<?= base_url( "uploads/school_content/logo/{$school_logo}" ) ?>" title="<?= $school_name ?>" style="height:150px; width:130px;" >
                                </div>
                                <div class="col-md-8" >
                                    <h2>    <?= $school_name ?> </h2>
                                    <h4>Award List <?php  echo $examlist['name']." ".$this->lang->line('fill_mark')." (".$class_sections['class']['class']."/".$class_sections['section']['section'].")"; ?></h4>
                                </div> 
                                <div class="col-md-1">
                                    <h2 class="text-right">
                                        <a href="" id="printPageButton" onclick=""  class="btn btn-info btn-xs" style="padding: 4px 10px; margin-top: 12px;"><i class="fa fa-print "></i>
                                        </a>
                                    </h2>
                                </div>   
                        </div>
                        <div class="box-body">
    <?php
    if (!empty($examSchedule)) {       
        ?>
                                        <?php echo $this->customlib->getCSRF(); ?>
                                    <input type="hidden" name="class_id" value="<?php echo $class_id; ?>">
                                    <input type="hidden" name="section_id" value="<?php echo $section_id; ?>">
                                    <input type="hidden" name="exam_id" value="<?php echo $exam_id; ?>">
                                    <div class="table-responsive">
                                        <table class="table     table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        Ad No
                                                    </th>
                                                    <th>Roll No</th>
                                                    <th>
                                                    <?php echo $this->lang->line('student'); ?>
                                                    </th>
                                                    <?php
                                                    $s = 0;
                                                    foreach ($examSchedule as $key => $student) {
                                               
                                                        if (!empty($student['exam_array'])) {
                                                            if ($s == 0) {
                                                                foreach ($student['exam_array'] as $key => $exam_schedule) {
                                                                   ?>
                                                                    <th class="text-center schedule_<?= $exam_schedule['exam_schedule_id'] ?>" >

                                                                    <input type="checkbox" class="student_checkbox select_checkbox remove_print" name="student_ids[]" value="<?= $exam_schedule['exam_schedule_id'] ?>">

                                                                    <?php                                                                   
                                                                    echo $exam_schedule['exam_name'] . " (" . substr($exam_schedule['exam_type'], 0, 2) . ": " . $exam_schedule['passing_marks'] . "/" . $exam_schedule['full_marks'] . ") ";
                                                                    ?>
                                                                    <br>
                                                                    <?php                                                                   
                                                                    echo 'Teacher' . " (".$exam_schedule['teacher']['name']. ") ";
                                                                    ?>

                                                                    </th>
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

                                                </tr>
                                            </thead>
                                            <tbody>
        <?php
        $s = 0;
        foreach ($examSchedule as $key => $student) {
            ?>
                                                <input type="hidden" name="student[]" value="<?php echo $student['student_id'] ?>">

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

        <?php foreach ($examSchedule as $key => $student) {
			
            ?>

                                                <tr >
                                                    <td>     <?php echo $student['admission_no'] ?></td>
                                                    <td>     <?php echo $student['roll_no'] ?></td>
                                                    <td>        <?php echo $student['firstname'] . " " . $student['lastname']; ?> </td>
                                                    <?php
                                                    if (!empty($student['exam_array'])) {                                                      
                                                        foreach ($student['exam_array'] as $key => $exam_schedule) {
                                                            ?>
                                                            <td class="schedule_<?= $exam_schedule['exam_schedule_id'] ?>">
                                                                <input type="text" name="" class="form-control input-sm" id=" value="" placeholder="">
                                                           
                
                                                            </td>
                                                            <?php
                                                        }
                                                    }else {
                                                        ?>

                                                    <?php
                                                }
                                                ?>

                                  </tr>
            <?php
        }
        ?>
                                            </tbody>
                                        </table>
                                    </div>
                            
        <?php
    } else {
        ?>
                                    <div class="col-md-12">
                                    <div class="alert alert-info">
                                <?php echo $this->lang->line('no_record_found'); ?>
                                    </div>
                                </div>
                               
        <?php
    }
    ?>
                        </div><!---./end box-body--->
                    </div>
                </div>            

            </div>   <!-- /.row -->
            <?php
        } else {

        }
        ?>

    </section><!-- /.content -->
</div>
<script type="text/javascript">
    $(document).ready(function () {


        
        $(document).on('click', '#printPageButton', function (e) {
            $(".select_checkbox").each(function(){
                if ($(this).prop('checked')==false){ 
                    var schedule_id = $(this).val();
                    $(".schedule_"+schedule_id).hide();
                }
            });

      
        window.print();

        });
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
<script src="<?php echo base_url(); ?>backend/custom/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>backend/custom/bootstrap-datepicker.js"></script>
<script>
    $('.sandbox-container').datepicker({
        autoclose: true,
        format: "dd-mm-yyyy"
    });
    $(function () {
        $('.addmarks-form').validate({

            submitHandler: function (form) {
                form.submit();
            }
        });

        $('input[id^="subject_"]').each(function () {
            $(this).rules('add', {
                required: true,
                messages: {
                    required: "Required"
                }
            });
        });
    });
    var class_id = $('#class_id').val();
    var section_id = '<?php echo set_value('section_id') ?>';
    getSectionByClass(class_id, section_id);
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
</script>
