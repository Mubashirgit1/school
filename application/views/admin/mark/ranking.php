<div class="content-wrapper" style="min-height: 946px;">
  
       

     
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              
<?php
if (isset($examRank)) {
    ?>


                    <div class="box box-primary">
                        <div class="box-header ptbnull">
                            <h3 class="box-title titlefix">
                                <?php 
                                    echo $examlist['name']." Fill Ranking (".$class_sections['class']['class']."/".$class_sections['section']['section'].")";
                                ?>
                            </h3>
                            <div class="pull-right">
                                <a href="<?php echo site_url('admin/exam?exam_id=').$exam_id ?>" class="btn btn-info btn-xs" style="padding: 4px 10px; margin-top: 12px;">Back
                                </a>
                            </div>
                        </div>
                        <div class="box-body">
    <?php
    if (!empty($examRank)) {       
        ?>
            <form role="form" id=""  class="addmarks-form"  method="post" action="<?php echo site_url('admin/mark/create') ?>">
                                        <?php echo $this->customlib->getCSRF(); ?>
                                    <input type="hidden" name="class_id" value="<?php echo $class_id; ?>">
                                    <input type="hidden" name="section_id" value="<?php echo $section_id; ?>">
                                    <input type="hidden" name="exam_id" value="<?php echo $exam_id; ?>">
                                    <div class="table-responsive">
                                        <table class="table     table-bordered table-hover example">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        Ad No
                                                    </th>
                                                    <th>Roll No</th>
                                                    <th>
                                                    <?php echo $this->lang->line('student'); ?>
                                                    </th>
                                                    <?php  foreach ($rankinglist as $key => $rank) { ?>
                                                        <th><?= $rank['name']?></th>
                                                    <?php }?>
                                                    <th>Remarks</th>    
                                                </tr>
                                            </thead>
                                            <tbody>


                                            <?php

                                            foreach ($examRank as $key => $student) {
                                                
                                                ?>

                                                <tr>
                                                    <td>     <?php echo $student['admission_no'] ?></td>
                                                    <td>     <?php echo $student['roll_no'] ?></td>
                                                    <td>        <?php echo $student['firstname'] . " " . $student['lastname']; ?> </td>
                                                    <?php
                                                    
                                                    if (!empty($student['rank_array'])) {
                                                        $outputString = '';
                                                        foreach ($student['rank_array'] as $key => $rank) { ?>
                                                            <td>
                                                                <div class="form-group">
                                                                <?php $count = 0; ?>
                                                                        <ul class="list-inline"  onMouseLeave="mouseOutRating( <?=  $rank['rank_id'] ?>,<?= $rank['rating'] ?>)"> 
                                                                    
                                                                    <?php  
                                                                        for ($count = 1; $count <= 5; $count ++) {
                                                                            $starRatingId = $rank['rank_id'] . '_' . $count;
                                                                          if ($count <= $rank['rating']) {  // 1 <= 0 ?>
                                                                                <li value="<?php $count ?>" id="<?php $starRatingId ?>" class="star selected"> <i class="fas fa-star"></i> </li>
                                                                            <?php }else{ ?>                                                                            
                                                                                <li value="<?= $count ?>"  id="<?= $starRatingId ?>" class="star" onclick="addRating(<?= $rank['id'] ?>,<?= $count ?>);" onMouseOver="mouseOverRating(<?= $rank['id'] ?>,<?= $count ?>);"><i class="far fa-star"></i></li>
                                                                            <?php
                                                                            }
                                                                        } 
                                                                        ?>
                                                                        </ul>
                                                                </div>
                                                            </td>
                                                            <?php
                                                        }
                                                    }else {
                                                        ?>

                                                    <?php
                                                }
                                                ?>
                                    <td></td>
                                  </tr>
            <?php
        }
        ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <button type="submit" class="btn btn-primary pull-right" name="save_exam" value="save_exam"><?php echo $this->lang->line('save'); ?></button>
                                </form>
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
