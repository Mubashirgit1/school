<style type="text/css">
    @media print {
        .no-print, .no-print * {
            display: none !important;
        }
    }
</style>


<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
    <div class="box box-primary" >  
        <div class="box-header with-border">
            <div class="row">
                <div class="col-sm-6 col-md-4">
                    <h4><?= $title ?></h4>
                </div>
            </div>
        </div>
    </div>
    </section>
    
    
    <div class="col-md-12">
<div class="nav-tabs-custom">
    <div class="tab-content">
        <div class="tab-pane active" id="activity">
            <div class="row">
              <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-header with-border"> Mark leave </div>
                    <form id="form1" action="<?php echo site_url( 'admin/stuattendence/SaveAdvanceLeave' ) ?>" id="employeeform" name="employeeform" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                        <div class="box-body">
                            <?php echo $this->customlib->getCSRF(); ?>
                                <div class="form-group">
                                    <label>Select for leave </label>
                                    <select id="leave" name="leave" required class="form-control col-md-7 col-xs-12" >
                                        <option value="">select leave</option>
                                        <option value="teacher">Teacher/Staff</option>
                                        <option value="student">Student</option>
                                    </select>    
                                </div>
                                <input type="hidden" id="student_id" class="form-control" name="student_id">
                                <div class="form-group" id="admission"  style="display:none">
                                    <label><?= admission_text() ?></label>
                                    <input type="text" id="admission_no" class="form-control" name="admission_no">
                                </div>
                                <p id="student_name_in"  style="display:none" ></p>
                                <br>
                                <div class="form-group">
                                    <label>Reason for Leave</label>
                                    <input type="text"  class="form-control" name="reason">
                                </div>
                             
                                <div class="form-group" id="teacher" style="display:none">
                                    <label>Select Teacher</label>
                                    <select id="teacher_id" name="teacher_id" class="form-control col-md-7 col-xs-12">
                                    <option value="">Select Teacher</option>
                                        <?php foreach($teachers as $teacher){?>
                                            <option value="<?= $teacher['id']?>"><?= $teacher['name']?></option>
                                        <?php }?>                    
                                    </select>    
                                </div>
                                <div class="form-group">
                                    <label>Date From</label>
                                    <input type="text" id="message_date" class="form-control _date" name="date_from" value="<?= set_value( 'date', date( 'm/d/Y', now() ) ) ?>" readonly>
                                </div>
                               <div class="form-group">
                                    <label>Date To</label>
                                    <input type="text" id="message_date" class="form-control _date" name="date_to" value="<?= set_value( 'date', date( 'm/d/Y', now() ) ) ?>" readonly>
                                </div>
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line( 'save' ); ?> Advance Leave</button>
                                </div>
                            </form>
                               <br>
                               <div class="table-responsive mailbox-messages">
                               
                            <table class="table     table-bordered table-hover ">
                                <thead>
                                   
                                </thead>
                                <tbody>
                               
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
              <div class="col-md-8">
                <div class="box box-primary" id="tachelist">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix">Marked Advance Leave (s)</h3>
                    </div>
                    <br>
                    <br>
                    <div class="box-body">
                        <div class="mailbox-controls">
                        </div>
                        <div class="table-responsive mailbox-messages">
                            <table class="table table-bordered table-hover example">
                                <thead>
                                    <tr>
                                        <th>Sr no</th>
                                        <th>Name </th>
                                        <th>Designation</th>
                                        <th>Date From </th>
                                        <th>Date To</th>
                                        <th>Leave(s)</th>
                                        <th>Reason</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php  $count = 1;
                                    foreach ( $advanceLeave as $key => $advance ) {  ?>
                                        <tr>
                                        <?php 
                                        
                                        if($advance['student_id'] != 0){
                                            $teacher =  $advance['student']['firstname']." ".$advance['student']['lastname'];
                                            $designation = $advance['student']['class']." (".$advance['student']['section'].")";
                                        }else{
                                            $teacher = $advance['teacher']['name'];
                                            $designation = $advance['teacher']['designation'];
                                        }
                                        ?>
                                            <td class="mailbox-name"> <?= $key + 1 ?> </td>
                                            <td class="mailbox-name"> <?=  $teacher ?> </td>
                                            <td class="mailbox-name"> <?= $designation ?> </td>
                                            <td class="mailbox-name"> <?= date('Y-M-d', strtotime($advance['date_from'])) ?></td>
                                            <td class="mailbox-name"> <?= date('Y-M-d', strtotime($advance['date_to'])) ?></td>
                                            <td class="mailbox-name"> <?php echo $advance['days'] ?></td>
                                            <td class="mailbox-name"> <?php echo $advance['reason'] ?></td>
                                            
                                           <td class="mailbox-date  no-print text-center">
                                              <?php /*?>  <a href="<?php echo base_url(); ?>student/view_message/<?php echo $message['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line( 'show' ); ?>">
                                                    <i class="fa fa-reorder"></i>
                                                </a><?php */?>
                                               
                                                <a href="<?php echo base_url(); ?>admin/stuattendence/deleteleave/<?php echo $advance['id'] ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="<?php echo $this->lang->line( 'delete' ); ?>" onclick="return confirm('Are you sure you want to delete this item?')" ;>
                                                    <i class="fa fa-remove"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    $count++;

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
    
</div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#date').datepicker({
            format: "dd-mm-yyyy",
            autoclose: true
        });
        $("#btnreset").click(function () {           
            $("#form1")[0].reset();
        });

    });

</script>
<script>
   
	jQuery( function ( $ ) {
        $( "#leave" ).on( 'change', function ( e ) {
             var leave = $( this ).val();
            if ( leave == "student" ) {
                $("#admission").show();
                $("#teacher").hide();
            } else
            if ( leave == "teacher" ) {
                $("#teacher").show();
                $("#admission").hide();           
            }else{
                $("#teacher").hide();
                $("#admission").hide();
            }
        });
	});

</script>

<script type="text/javascript">
    $(document).on('change', '#admission_no', function () {
        $("#student_name").hide();  
        var base_url = '<?php echo base_url() ?>';
        var admission    = $(this).val();
        $.ajax({
            type: "post",
            url: base_url + "admin/stuattendence/getstudentdetails",
            data: {'admission': admission},
            dataType: "json",
            success: function (response) {

            student = response.student;
                if(student != null){
                    $("#student_name_in").show();
                    var details  = "Name " + student.firstname + " " + student.lastname + " <br> <br> Class(Section) " + student.class+ "(" + student.section + ")";   
                    $("#student_name_in").html(details); 
                    $("#student_id").val(student.id); 
                }else{
                    $("#student_id").val("");
                    $("#teacher_id").val("");
                    $("#leave").val("");
                    $("#student_name_in").show();
                    $("#student_name_in").html("Student not found"); 
                }
            }
        });
    });

</script>








<div id="scheduleModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <br>
                <h4 class="modal-title view_exam_model_title"></h4>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?></button>
            </div>
        </div>
    </div>
</div>