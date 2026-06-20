
<div class="content-wrapper" style="min-height: 946px;">
    <!-- Content Header (Page header) -->
    <?php
                if ( $this->session->flashdata( 'msg' ) ) { 
                echo "<div class='alert alert-danger'>" . $this->session->flashdata( 'msg' ) . "</div>";
                    } ?>
    <section class="content-header">
        <div class="box box-primary" style="margin-bottom: 0px;">
            <div class="box-header with-border">
                <h4 class="pull-left" style="margin-top: 0px;">
                    Student Attendance Mark
                    <!-- <small><?php echo $this->lang->line( 'by_date1' ); ?></small> -->
                </h4>
                    <form action="<?= site_url( 'admin/stuattendence/bulk_student_attendance' ) ?>" method="get">
                <div class="form-group">
                <input type="hidden" id="bulk_student_attendance" name="bulk_student_attendance[]" value="">
                <input type="hidden" id="class_id_a" name="class_id_a" value="">
                <input type="hidden" id="section_id_a" name="section_id_a" value="">
                
                <a href="<?= site_url('admin/stuattendence/advanceAttendance') ?>"   style="margin: 0px 10px;"  class="btn btn-primary btn-sm pull-right">
                        <i class="fa fa-clock-o"></i> Advance Leave Marking</a>
               
                    <button type="submit" name="search" id="proceed" value="search"  style="margin: 0px 10px;"  class="btn btn-primary btn-sm pull-right">
                        <i class="fa fa-clock-o"></i> Proceed School Attendence</button>
                        <button type="submit" name="search" id="proceed" value="search"   class="btn btn-primary btn-sm pull-right">
                        <i class="fa fa-clock-o"></i> Proceed Class Attendence</button>
                           
                </div>
                </form>
                <form id='form1' class="form-inline  assign_teacher_form" action="<?php echo site_url( 'admin/stuattendence/marking_student' ) ?>" method="post" accept-charset="utf-8" style="margin: 50px 14px 5px 27px;">
                   
                <div class="form-group">
                <label ><?php echo $this->lang->line( 'class' ); ?></label>
                                            <select  id="class_id" name="class_id" class="form-control">
                                                <option value=""><?php echo $this->lang->line( 'select' ); ?></option>
                                                <?php
                                                foreach ( $classlist as $class ) {
                                                    ?>
                                                    <option value="<?php echo $class['id'] ?>" <?php if ( set_value( 'class_id' ) == $class['id'] ) echo "selected=selected" ?>><?php echo $class['class'] ?></option>
                                                    <?php
                                                    $count++;
                                                }
                                                ?>
                                            </select>
                                            <span class="text-danger"><?php echo form_error( 'class_id' ); ?></span>
                             </div>

                    <div class="form-group">
                    <label ><?php echo $this->lang->line( 'section' ); ?></label>
                        <select id="section_id" name="section_id" class="form-control">
                                                <option value=""><?php echo $this->lang->line( 'select' ); ?></option>
                                            </select>
                                            <span class="text-danger"><?php echo form_error( 'section_id' ); ?></span>
                    </div>

       
                    <div class="form-group">
                        <label for="exampleInputEmail1"> Search Absent Students by Ad.No</label>
                        <input  name="student" id="student" placeholder="" type="text" class="form-control"  />
                    </div>

                    <div class="form-group" style="margin-right: 170px;">
                        <button type="submit" name="search" value="search" class="btn btn-primary btn-sm pull-right">
                            <i class="fa fa-search"></i> <?php echo $this->lang->line( 'search' ); ?></button>
                    </div>
                    
                </form>
                
                
            
            </div>
              
        </div>
        <div class="clearfix"></div>
    </section>
    
    <!-- Main content -->
    <section class="content">
        <div class="row">
        <div class="col-sm-5 col-md-5">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            Classes
                        </h3>
                        
                    </div>
                    <div class="box-body">
                        <?php if ( $class_sections === false ): ?>
                            <p class="text-center text-danger">No Class Sections found.</p>
                        <?php else: ?>
                            <table class="table">
                                <?php
                                    $total_p = 0;
                                    $total_l = 0;
                                    $total_a = 0;
									
									
                                    foreach ( $class_sections as $class_section ):
                                        $total_p  += $class_section['attendance_cus']['p'];
                                        $total_l  += $class_section['attendance_cus']['l'];
                                        $total_a  += $class_section['attendance_cus']['a'];
                                    endforeach;
                                ?>
                                <thead>
                                    <tr>
                                        <th>Total</th>
                                        <th width="12%" class="text-success">
                                            <a href="<?= site_url( 'admin/stuattendence/classattendencereport' ) ?>" class="text-success">
                                                <?= $total_p ?>
                                            </a>
                                        </th>
                                        <th width="12%" class="text-danger">
                                            <a href="<?= site_url( 'student/total_absent_report' ) ?>" class="text-danger">
                                                <?= $total_a ?>
                                            </a>
                                        </th>
                                        <th width="12%" class="text-blue">
                                            <a href="<?= site_url( 'student/total_leave_report' ) ?>" class="text-blue" >
                                                <?= $total_l ?>
                                            </a>
                                        </th>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        <th>Classes</th>
                                        <th class="text-success">P</th>
                                        <th class="text-danger">A</th>
                                        <th class="text-blue">L</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ( $class_sections as $class_section ): ?>
                                        <tr>
                                            <td>
                                                <a href="#"><?= $class_section['class']['class'] ?> / <?= $class_section['section']['section'] ?></a>
                                            </td>
                                            <td class="text-success"><?= $class_section['attendance_cus']['p'] ?></td>
                                            <td class="text-danger"><?= $class_section['attendance_cus']['a'] ?></td>
                                            <td class="text-blue"><?= $class_section['attendance_cus']['l'] ?></td>
                                            <td>
                                                <span style="<?= intval( $class_section['attendance']['total_attendance'] ) > 0 ? "color: green;" : "color: #ccc;" ?>"><i class="fa fa-check"></i></span>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <div class="col-sm-7">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">List of Absent Student</h3>
                    </div>

                    <div class="box-body no-padding">
                        
                            <table  class="table  table-bordered table-hover " cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">Sr.No</th>
                                        <th class="text-center">Ad.No</th>
                                        <th class="text-center"><?php echo $this->lang->line( 'class' )."(".$this->lang->line( 'section' ).")"; ?></th>
                                        <th class="text-center">Roll No</th>
                                        <th >Student Name</th>
                                        <th>Father name</th>
                                        <th>Mobile Number</th>
                                        <th class="d-print-none">Action</th>
                                    </tr>
                                </thead>
                             <tbody id="table">
                             
                             </tbody>
                                <tfoot style="display: table-footer-group;">
                                <tr>
                                     
                                    </tr>
                                </tfoot>
                            </table>
           
                    </div>
                </div>
            </div>
        </div> 
    </section>
</div>
<style type="text/css">
    .sweet-alert{
        max-height: 310px;
        max-width: 385px;

    }
    .sweet-alert h2{
        font-size: 20px !important;
    }
    .sweet-alert p {
        font-size: 14px !important;
    }
    .sweet-alert hr {
        margin-top: 20px !important;
        margin-bottom: 0px !important;
    }
    .sweet-alert button {
        padding: 6px 20px !important;
    }
    
    .sweet-alert .icon.warning .body{
        height:30px !important;
    }

    .sweet-alert .icon.warning{
        border-color:#f27474 !important;
    }
    .sweet-alert .icon {
        height:60px !important;
        width:60px !important;
        
    }
</style>
<script type="text/javascript">
    $( document ).ready( function () {
        $( '#btnAdd' ).hide();
        $( ".assign_teacher_form" ).submit( function ( e ) {
 
            var admission_no = $( '#student' ).val();
            var class_id = $( '#class_id' ).val();
            var section_id =$( '#section_id' ).val(); 
      
            var multi = $('.student_list');
            var winners_array = [];
            $.each(multi, function (index, item) {
                winners_array.push($(item).data('ad') );  
            });


            var found = false;
            for (var i = 0; i < winners_array.length && !found; i++) {
                if (winners_array[i] == admission_no) {
              
                    found = true;
                    break;
                }
            }

            var formURL = $( this ).attr( "action" );
            if(found == true){
                sweetAlert({
                    title: "Alert",
                    text : " Searched Student is Already in List",
                    type: 'warning',
                    showConfirmButton: false,
                    timer: 2000,
                });
            }else{  
            $.ajax(
                {
                    url: formURL,
                    type: "POST",
                    data: {
                        'admission_no': admission_no,
                        'class_id': class_id,
                        'section_id': section_id
                    },
                    dataType: 'json',
                    success: function ( data ) {
         
                        if(data.student.length > 0){
                            $( '#student' ).val('');
                            if(data.student[0]['struck_off'] != 1){
                                appendRow(data.student);
                            }else{
                            sweetAlert({
                                title: "Alert",
                                text : " Searched Student has been Withdrawn",
                                type: 'warning',
                                showConfirmButton: false,
                                timer: 2000000,
                            });
                            }                           
                        
                        }else{
                            sweetAlert({
                                title: "Alert",
                                text : " Searched Student is Invalid",
                                type: 'warning',
                                showConfirmButton: false,
                                timer: 2000000,
                            });
                            
                  
                        }

                    },
                    error: function ( jqXHR, textStatus, errorThrown ) {
                    }
                } );
            }



            e.preventDefault();


        } );

    } );


    function appendRow( student ) {
		var value = $( '#table tr' ).length + 1;
        var row = "";
        $.each( student, function ( i, obj ) {
        row += "<tr class='voucher_"+obj['admission_no']+" student_list' data-ad='"+obj['admission_no']+"' >";
        row += "<td class='text-center' >"+value+"</td>";
        row += "<td class='text-center'>"+obj['admission_no']+"</td>";
        row += "<td class='text-center'>"+obj['class']+ '('+obj['section']+')'+"</td>";
        row += "<td class='text-center'>"+obj['roll_no']+"</td>";
        row += "<td >"+obj['firstname']+' '+obj['lastname']+"</td>";
        row += "<td >"+obj['father_name']+"</td>";
        row += "<td >"+obj['father_phone']+"</td>";
        row += "<td class='text-center'><button id='btnRemove' class='btn btn-sm btn-default' onClick='remove("+obj['admission_no']+")' type='button'><i class='fa fa-trash-alt'></i></button></td>";
        row += "</tr>";
        } );

        $( "#table" ).append( row );
    }

    function remove(id) {
        $('.voucher_'+id).closest('tr').remove();
    }
    function resetForm() {
        $( '#TextBoxContainer' ).html( "" );
        $( '#btnAdd' ).hide();
        $( '.save_button' ).hide();
    }
    $( document ).on( 'click', '#proceed', function (e) {
       
        var multi = $('.student_list');
        var winners_array = [];
        $.each(multi, function (index, item) {
            winners_array.push($(item).data('ad') );  
        });

        $( '[name="bulk_student_attendance[]"]' ).val(winners_array);
     
    
    } );

    function getSectionByClass( class_id, section_id ) {

        if ( class_id != "" && section_id != "" ) {
            class_id    =   $( '#class_id_a' ).val(class_id);
            section_id  =   $( '#section_id_a' ).val(section_id); 
            $( '#section_id' ).html( "" );
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line( 'select' ); ?></option>';
            $.ajax( {
                type: "GET",
                url: base_url + "sections/getByClass",
                data: {'class_id': class_id},
                dataType: "json",
                success: function ( data ) {
                    $.each( data, function ( i, obj ) {
                        var sel = "";
                        if ( section_id == obj.section_id ) {
                            sel = "selected";
                        }
                        div_data += "<option value=" + obj.section_id + " " + sel + ">" + obj.section + "</option>";
                    } );
                    $( '#section_id' ).append( div_data );
                }
            } );
        }
    }

    $( document ).ready( function () {
        var class_id = $( '#class_id' ).val();
        var section_id = '<?php echo set_value( 'section_id' ) ?>';
        getSectionByClass( class_id, section_id );
        $( document ).on( 'change', '#class_id', function ( e ) {
            $( '#section_id' ).html( "" );
            var class_id = $( this ).val();
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line( 'select' ); ?></option>';
            $.ajax( {
                type: "GET",
                url: base_url + "sections/getByClass",
                data: {'class_id': class_id},
                dataType: "json",
                success: function ( data ) {
                    $.each( data, function ( i, obj ) {
                        div_data += "<option value=" + obj.section_id + ">" + obj.section + "</option>";
                    } );
                    $( '#section_id' ).append( div_data );
                }
            } );
        } );
    } );
</script>