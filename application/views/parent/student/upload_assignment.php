<div class="content-wrapper">   
    <section class="content-header">
        <h1></h1>
    </section>   
    <section class="content">
        <div class="row">
            <div class="col-md-6">                
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Upload Assignment</h3>
                    </div>
                    <form id="form1" action="<?php echo site_url('parent/parents/upload_assignment/'.$student_id.'/'.$assignment_id) ?>"  id="employeeform" name="employeeform" method="post"  enctype='multipart/form-data' accept-charset="utf-8">
                        <div class="box-body">
                            <?php if ($this->session->flashdata('msg')) { ?>
                                <?php echo $this->session->flashdata('msg') ?>
                            <?php } ?>      
                             <?php echo $this->customlib->getCSRF(); ?>
                            
                            <input type="hidden" name="student_id" value="<?php echo $student_id; ?>" />
                            <input type="hidden" name="assignment_id" value="<?php echo $assignment_id; ?>" />
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Description</label>
                                        <textarea class="form-control" id="description"  name="description" placeholder="" rows="5" placeholder="Enter Description..."><?php echo set_value('description'); ?></textarea>
                                        <span class="text-danger"></span>
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


        $( document ).on( 'change', '#class_id', function ( e ) {
            $( '#section_id' ).html( "" );
            var class_id = $( this ).val();
            var teacher_id = $( '#teacher_id' ).val();
            
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line( 'select' ); ?></option>';
            $.ajax( {
                type: "GET",
                url: base_url + "teacher/content/getByClassCreate",
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
                url: base_url + "teacher/content/getSubjectByClsandSectionTeacher",
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