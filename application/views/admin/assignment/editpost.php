
<style>


.select2-container{
    width:100% !important;
}
</style>

<div class="content-wrapper">   
  
<section class="content-header">
    <div class="box box-primary" style="margin-bottom: 0px;">
            <div class="box-header with-border" style="text-align: center;">
                <div class="row">
                    <div class="col-sm-2">
                        <h4></h4>
                    </div>
                    <div class="col-sm-offset-1 col-sm-6 ">
                        <?php  $this->load->view('layout/download'); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>  
    <section class="content">
        <div class="row">
            <div class="col-md-4">                
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Assignment</h3>
                    </div>
                    <form id="form1" action="<?php echo site_url('admin/assignment/edit/'.$editpost['id']) ?>"  id="employeeform" name="employeeform" method="post"  enctype='multipart/form-data' accept-charset="utf-8">
                        <div class="box-body">
                            <?php if ($this->session->flashdata('msg')) { ?>
                                <?php echo $this->session->flashdata('msg') ?>
                            <?php } ?>      
                             <?php echo $this->customlib->getCSRF(); ?>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Title</label>
                                <input id="content_title" name="content_title" placeholder="" type="text" class="form-control"  value="<?php echo $editpost['title'] ?>" />
                                <input id="id" name="id" placeholder="" type="hidden" class="form-control"  value="<?php echo $editpost['id'] ?>" />
                                
                                <span class="text-danger"><?php echo form_error('content_title'); ?></span>
                            </div>

                       

                            
                            <div class="form-group">
                                <label for="exampleInputEmail1">Teacher</label>
                                <select  id="teacher_id" name="teacher_id" class="form-control" required  >
                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                    <?php
                                    foreach ($teacherlist as $teacher) {
                                        ?>
                                        <option value="<?php echo $teacher['id'] ?>" <?php if ($editpost['teacher_id'] == $teacher['id']) echo "selected=selected" ?>><?php echo $teacher['name'] ?></option>
                                        <?php
                                        $count++;
                                    }
                                    ?>
                                </select>
                                <span class="text-danger"><?php echo form_error('class_id'); ?></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Select Class </label>
                                <select  id="class_id" name="class_id" class="form-control" required  >
                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                    <option value="<?= $editpost['class_id']?>" <?php echo "selected=selected";?>><?= $editpost['class']?></option>
                                    
                                </select>
                                <span class="text-danger"><?php echo form_error('class_id'); ?></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Select Section </label>
                                <select  id="section_id" name="section_id" class="form-control" required  >
                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                    <option value="<?= $editpost['section_id']?>" <?php echo "selected=selected";?>><?= $editpost['section_name']?></option>
                                    
                                </select>
                                <span class="text-danger"><?php echo form_error('section_id'); ?></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Select Subject </label>
                                <select  id="subject_id" name="subject_id" class="form-control"  required >
                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                    <option value="<?= $editpost['subject_id']?>" <?php echo "selected=selected";?>><?php echo $editpost['subject'] ?></option>
                                    
                                </select>
                                <span class="text-danger"><?php echo form_error('subject_id'); ?></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Marks</label>
                                <input id="marks" name="marks" placeholder="" type="text" class="form-control" required  value="<?php echo $editpost['marks']; ?>" />
                                <span class="text-danger"><?php echo form_error('marks'); ?></span>
                            </div>
                            
                                                                       <div class="form-group">
                                <label for="exampleInputEmail1">Passing Marks</label>
                                <input id="passing_marks" name="passing_marks" placeholder="" type="text" class="form-control" required  value="<?php echo $editpost['passing_marks']; ?>" />
                                <span class="text-danger"><?php echo form_error('passing_marks'); ?></span>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Assignment Date</label>
                                        <input id="upload_date" name="upload_date" placeholder=""  required type="text" class="form-control"  value="<?php echo date('d/m/Y',strtotime($editpost['date'])) ?>" />
                                        <span class="text-danger"><?php echo form_error('upload_date'); ?></span>
                                    </div>
                                </div>
                            </div>
                           
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputFile">Assignment File </label>
                                        <input type='file' name='file' id="file" size='20' />
                                    </div>
                                    <span class="text-danger"><?php echo form_error('file'); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                        </div>
                    </form>
                </div>
            </div>            
            <div class="col-md-8">               
                <?php $this->load->view("admin/assignment/list"); ?>

            </div>
        </div>
        <div class="row">           
            <div class="col-md-12">
            </div>
        </div>
    </section>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        // var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';
        var date_format = "dd/mm/yyyy";
        $('#upload_date').datepicker({           
            format: date_format,
            autoclose: true
        });
        $("#btnreset").click(function () {
            $("#form1")[0].reset();
        });
    });
    $(document).ready(function () {

        $( document ).on( 'change', '#teacher_id', function ( e ) {
            $( '#class_id' ).html( "" );
            var teacher_id = $( this ).val();
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line( 'select' ); ?></option>';
            $.ajax( {
                type: "GET",
                url: base_url + "admin/content/getByTeacherCreate",
                data: {'teacher_id': teacher_id},
                dataType: "json",
                success: function ( data ) {
                 
                   
                    $.each( data.class, function ( i, obj ) {
                        div_data += "<option value=" + obj.class_id + ">" + obj.class + "</option>";
                    } );
                    $( '#class_id' ).append( div_data );
                }
            } );
        } );

        $( document ).on( 'change', '#class_id', function ( e ) {
            $( '#section_id' ).html( "" );
            var class_id = $( this ).val();
            var teacher_id = $( '#teacher_id' ).val();
            
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line( 'select' ); ?></option>';
            $.ajax( {
                type: "GET",
                url: base_url + "admin/content/getByClassCreate",
                data: {'class_id': class_id,'teacher_id': teacher_id},
                dataType: "json",
                success: function ( data ) {
                 
                   
                    $.each( data.sections, function ( i, obj ) {
                        div_data += "<option value=" + obj.section_id + ">" + obj.section + "</option>";
                    } );
                    $( '#section_id' ).append( div_data );
                }
            } );
        } );

        $( document ).on( 'change', '#section_id', function ( e ) {
            $( '#subject_id' ).html( "" );
            var class_id = $(  '#class_id' ).val();
            var section_id = $( this ).val();
            var teacher_id = $( '#teacher_id' ).val();
            
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line( 'select' ); ?></option>';
            $.ajax( {
                type: "GET",
                url: base_url + "admin/content/getSubjectByClsandSectionTeacher",
                data: {'class_id': class_id,'section_id': section_id,'teacher_id': teacher_id},
                dataType: "json",
                success: function ( data ) {
                  
                   if(data.subject){
                    $.each( data.subject, function ( i, obj ) {
                        div_data += "<option value=" + obj.subject_id + ">" + obj.name + "</option>";
                    } );
                    $( '#subject_id' ).append( div_data );
                   }
                    
                }
            } );
        } );

        $("#chk").click(function () {
            if ($(this).is(":checked")) {
                $("#class_id").prop("disabled", true);
            } else {
                $("#class_id").prop("disabled", false);
            }
        });
        if ($("#chk").is(":checked")) {
            $("#class_id").prop("disabled", true);
        } else {
            $("#class_id").prop("disabled", false);
        }
    });
</script>
<script>
    $(document).ready(function () {
        $('.detail_popover').popover({
            placement: 'right',
            trigger: 'hover',
            container: 'body',
            html: true,
            content: function () {
                return $(this).closest('td').find('.fee_detail_popover').html();
            }
        });
    });
</script>