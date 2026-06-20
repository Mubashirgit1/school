<style type="text/css">
    @media print {
        .no-print, .no-print * {
            display: none !important;
        }
    }
</style>


<div class="content-wrapper" style="min-height: 946px;">
    <?php  $this->load->view('layout/message_link'); ?>
    <section class="content-header">
         <div class="box box-primary" >  
            <div class="box-header with-border" >
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <h4><?= $title ?></h4>
                    </div>
                    <div class="col-sm-6  col-md-8">
                        <form role="form" action="<?php echo site_url( 'student/send_message_other' ) ?>" method="get" class="form-horizontal">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6 col-md-3">
                                        <label><?php echo $this->lang->line( 'class' ); ?></label>
                                        <select id="class_id" name="class_id" class="form-control">
                                            <option value=""><?php echo $this->lang->line( 'select' ); ?></option>
                                            <?php
                                            foreach ( $classlist as $class ) { ?>
                                                <option value="<?php echo $class['id'] ?>" <?php if ( set_value( 'class_id' ) == $class['id'] ) echo "selected=selected" ?>><?php echo $class['class'] ?></option>
                                                <?php $count++;
                                            } ?>
                                        </select>
                                        <span class="text-danger"><?php echo form_error( 'class_id' ); ?></span>
                                    </div>
                                    <div class="col-sm-6 col-md-3">
                                        <label><?php echo $this->lang->line( 'section' ); ?></label>
                                        <select id="section_id" name="section_id" class="form-control">
                                            <option value=""><?php echo $this->lang->line( 'select' ); ?></option>
                                        </select>
                                        <span class="text-danger"><?php echo form_error( 'section_id' ); ?></span>
                                    </div>
                                    <div class="col-sm-6 col-md-2">
                                        <label>Fee Types</label>
                                        <select class="form-control" id="other_fee_types" name="other_fee_types">
                                            <option value="">All</option>
                                            <?php if ( $fee_types !== false ):
                                            foreach ( $fee_types as $fee_type ): ?>
                                                <option value="<?= $fee_type['name'] ?>" <?= set_select( 'other_fee_types', $other_fee_types1,  $other_fee_types1 ==  $fee_type['name']  ) ?>><?= $fee_type['name'] ?></option>
                                            <?php endforeach;
                                            endif; ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-6 col-md-2" >
                                        <label>Month Wise</label>
                                        <select class="form-control" id="month" name="month">
                                            <?php $select =  $month == null ? 'selected' : ' '; ?>
                                            <option class="other_fee2"   value=" " <?= $select ?>>ALL</option>
                                            <?php for ( $i = 0; $i < count( $month_names1 ); $i++ ):   ?>
                                                <option class="other_fee2"   value="<?= $i + 1 ?>" <?= set_select( 'month', ( $i + 1 ), ( $month == $month_names1[$i] ) ) ?>>
                                                    <?= $month_names1[$i] ?>
                                                </option>
                                            <?php  endfor; ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-6 col-md-2" >
                                        <label style="width: 100%;">&nbsp;</label>
                                        <button type="submit" name="search" value="search_filter" class="btn btn-primary btn-sm ">
                                            <i class="fa fa-search"></i> <?php echo $this->lang->line( 'search' ); ?>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="col-sm-12">
        <form action="" method="post" > 
            <div class="col-sm-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"> Unpaid Voucher (Other Fee) </h3>
                        <div class="checkbox pull-right">
                            <button type="submit" class="btn btn-primary btn-sm pull-right" formaction="<?= site_url( 'student/send_sms_to_student_with_other_fee' ) . '?redirect=' . urlencode( $redirect_url ) ?>">Send Message</button>  
                        </div>
                    </div>
                    <div class="box-body ">
                        <div class="table-responsive">
                            <table class="table     table-bordered table-hover " id="message_other" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">S. No.</th>
                                        <th class="text-center">Vr No</th>
                                        <th class="text-center">Ad No</th>
                                        <th class="text-center">Class(Section)</th>
                                        <th class="text-center">Roll No</th>
                                        <th class="text-left">Student Name</th> 
                                        <th class="text-left">Father Name</th> 
                                        <th class="text-center">Father Phone</th>
                                        <th class="text-center">Total Fee.</th> 
                                        <th class="text-center">Issue Date</th>
                                        <th class="text-center">Due Date</th>
                                        <th class="text-center"></th>
                                        <th class="text-right"> <input type="checkbox" class="select_checkbox_unpaid_other class_section_checkbox_all" data-target=".class_section_checkbox_teacher"> </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php         $count = 0;
                                    foreach ( $unpaid_students_other as $unpaid_student_other ): 
                                    $count++; 
                                    $date2  = $unpaid_student_other['student']['admission_date']; 
                                    $date = $unpaid_student_other['created_voucher'] ?>
                                    <tr>
                                        <td class="vertical_align_middle text-center"><?= $count ?></td>      
                                        <td class="vertical_align_middle text-center"><?php echo $unpaid_student_other['voucher_id']  ?></td>
                                      
                                        <td  class="vertical_align_middle text-center"><?php echo $unpaid_student_other['student']['admission_no']  ?></td>
                                        <td  class="vertical_align_middle text-center"><?php echo $unpaid_student_other['student']['class']."(" .$unpaid_student_other['student']['section'].")"  ?></td>
                                        <td  class="vertical_align_middle text-center"><?php echo $unpaid_student_other['student']['roll_no']  ?></td>
                                        <td  class="vertical_align_middle text-left"><a href="<?php echo base_url(); ?>student/view/<?php echo $unpaid_student_other['student']['id']; ?>" <?= $student['struck_off']==1?'style="color:red;"':''?> ><?php echo $unpaid_student_other['student']['firstname'].$unpaid_student_other['student']['lastname']  ?></a></td>
                                        <td  class="vertical_align_middle text-left"><a href="<?= site_url( "family/children/" . $unpaid_student_other['student']['id'] ) ?>" <?= $student['struck_off']==1?'style="color:red;"':''?> > <?php echo $unpaid_student_other['student']['father_name']  ?></a></td>
                                        <td  class="vertical_align_middle text-center"><?php echo $unpaid_student_other['student']['father_phone']  ?></td>
                                        <td>
                                            <table class="table table-bordered" style="margin-bottom: 0px;">                                                   
                                            <tbody>
                                                <?php if ( empty( $unpaid_student_other['voucher_fee_types'] ) ): ?>
                                                    <tr>
                                                        <td>N/A</td>
                                                    </tr>
                                                <?php else: 
                                                    foreach( $unpaid_student_other['voucher_fee_types'] as $other_fee ): 
                                                        if ($other_fee['name'] !== null) {  
                                                            if ($other_fee['amount'] > 0) {  ?>
                                                            <tr>
                                                                <?php if ( $other_fee_types === null ): ?>
                                                                <td class="text-left"><?= $other_fee['name'] ?></td>                                                         <?php endif; ?>
                                                                <td><?= number_format($other_fee['amount']) ?> </td>
                                                            </tr>
                                                                <?php    $total_others_fee =  $other_fee['amount']; 
                                                            }  
                                                        }
                                                    endforeach; 
                                                    endif; ?>
                                            </tbody>
                                            </table>
                                        </td>             
                                        <?php $total_other += $unpaid_student_other['total_fee']; 
                                        $total_other_security += $total_others_fee; 
                                        if($other_fee_types === null){ ?>
                                        <td class="vertical_align_middle text-center"><?php echo number_format($unpaid_student_other['total_fee'])  ?> </td>
                                        <?php }else{ ?>
                                        <td class="vertical_align_middle text-center"><?php echo number_format($total_others_fee)  ?> </td>
                                        <?php } ?>
                                        <td class="vertical_align_middle text-center"><?php echo  date('d-M-y',strtotime($date))   ?> </td>
                                        <td class="vertical_align_middle text-center"><?php echo  date( 'd-M-y',strtotime($unpaid_student_other['due_voucher']))  ?> </td>
                                        <td class="vertical_align_middle text-center"><input type="checkbox" class="class_section_checkbox_teacher select_checkbox_unpaid_other"  name="unpaid_other_voucher_ids[]" value="<?=$unpaid_student_other['voucher_id'] ?>" ></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="8" class="text-right"></th>
                                        <th class="text-center">TOTAL</th>
                                        <?php if($other_fee_types === null){ ?>
                                        <th class="text-center vertical_align_middle "> <?= number_format($total_other) ?></th>
                                        <?php }else{ ?>
                                        <th class="text-center vertical_align_middle "> <?= number_format($total_other_security) ?></th>
                                        <?php } ?>
                                        <th class="text-center"> </th>
                                        <th class="text-center"> </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </form>
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
	
	
	jQuery( function ( $ ) {
        $( ".select_checkbox_unpaid_other" ).on( 'change', function ( e ) {
            var target = $( this ).data( 'target' ),
                current_checked = $( this ).prop( 'checked' );

            if ( current_checked === true ) {
                $( target ).prop( 'checked', true ).change();
            } else {
                $( target ).prop( 'checked', false ).change();
            }
        } );
	} );
	

</script>

<script type="text/javascript">


function getSectionByClass( class_id, section_id ) {
        if ( class_id != "" && section_id != "" ) {
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

        $( '.date' ).datepicker( {
            format: 'mm/dd/yyyy',
            autoclose: true

        } );
    } );
$(document).on('click', '.schedule_modal', function () {
	
	 var exam_id     = $(this).attr('data-examid')
	$(".exam_id").val("1")
	
  });
  
  
    $(document).on('click', '.schedule_modal', function () {
        // var exam_id     = $('.schedule_modal').data('examid');
      
	    var exam_id     = $(this).attr('data-examid')
        var section_id  = $(this).data('sectionid');
        var class_id    = $(this).data('classid');
        var classname   = $(this).data('classname');
        var sectionname = $(this).data('sectionname');
        var base_url = '<?php echo base_url() ?>';
        $.ajax({
            type: "post",
            url: base_url + "student/getexamscheduledetail",
			
            data: {'exam_id': exam_id, 'section_id': section_id, 'class_id': class_id},
            dataType: "json",
            success: function (response) {
				
                var data = "";
			
                data += '<div class="table-responsive">';
                data += "<p class='lead titlefix pt0'><?php echo $this->lang->line('class'); ?>: " + classname + "(" + sectionname + ")</p><br><br>";
                data += '<table class="table table-hover sss">';
                data += '<thead>';
                data += '<tr>';
                data += "<th><?php echo $this->lang->line('subject'); ?></th>";
                data += "<th><?php echo $this->lang->line('date'); ?></th>";
                data += "<th class='text text-center'><?php echo $this->lang->line('start_time'); ?></th>";
                data += "<th class='text text-center'><?php echo $this->lang->line('end_time'); ?></th>";
                data += "<th class='text text-center'><?php echo $this->lang->line('room'); ?></th>";
                data += "<th class='text text-center'><?php echo $this->lang->line('full_marks'); ?></th>";
                data += "<th class='text text-center'><?php echo $this->lang->line('passing_marks'); ?></th>";
                data += '</tr>';
                data += '</thead>';
                data += '<tbody>';
                $.each(response, function (i, obj)
                {
					
			        data += '<tr>';
                    data += '<td class="">' + obj.name + ' (' + obj.type.substring(2, 0) + '.)</td>';
                    data += '<td class="">' + obj.date_of_exam + '</td> ';
                    data += '<td style="width:200px;" class="text text-center">' + obj.start_to + '</td> ';
                    data += '<td style="width:200px;" class="text text-center">' + obj.end_from + '</td> ';
                    data += '<td class="text text-center">' + obj.room_no + '</td> ';
                    data += '<td class="text text-center">' + obj.full_marks + '</td>';
                    data += '<td class="text text-center">' + obj.passing_marks + '</td>';
                    data += '</tr>';
                });
                data += '</tbody>';
                data += '</table>';
                data += '</div>  ';
                $('.modal-body').html(data);
				 $("#scheduleModal").modal('show');
                //===========

                var dtable = $('.sss').DataTable();
                $('div.dataTables_filter input').attr('placeholder', 'Search...');
                new $.fn.dataTable.Buttons( dtable, {
                    buttons: [
                       
                        {
                            extend: 'copyHtml5',
                            text:      '<i class="fa fa-files-o"></i>',
                            titleAttr: 'Copy',
                            exportOptions: {
                             columns: ':visible'
                            }
                        },

                        {
                            extend: 'excelHtml5',
                            text:      '<i class="fa fa-file-excel-o"></i>',
                            titleAttr: 'Excel',
                            exportOptions: {
                             columns: ':visible'
                            }
                        },

                        {
                            extend: 'csvHtml5',
                            text:      '<i class="fa fa-file-text-o"></i>',
                            titleAttr: 'CSV',
                            exportOptions: {
                             columns: ':visible'
                            }
                        },

                        {
                            extend: 'pdfHtml5',
                             text:      '<i class="fa fa-file-pdf-o"></i>',
                            titleAttr: 'PDF',
                            exportOptions: {
                             columns: ':visible'
                            }
                        },

                        {
                            extend: 'print',
                            text:      '<i class="fa fa-print"></i>',
                            titleAttr: 'Print',
                            exportOptions: {
                            columns: ':visible'
                            }
                        },

                       
                      {
                            extend: 'colvis',
                            text:      '<i class="fa fa-columns"></i>',
                            titleAttr: 'Columns',
                            postfixButtons: [ 'colvisRestore' ]
                        },
                        

                    ]
                } );
             
                dtable.buttons( 0, null ).container().prependTo(
                    dtable.table().container()
                );

               
            }
        });
    });

</script>



<script type="text/javascript">
    $( document ).ready( function () {
        var date_format = '<?php echo $result = strtr( $this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',] ) ?>';
        $( '#dob, #admission_date' ).datepicker( {
            format: date_format,
            autoclose: true
        } );
        $( "#btnreset" ).click( function () {
            $( "#form1" )[0].reset();
        } );
    } );
</script>

<script type="text/javascript">
    var base_url = '<?php echo base_url() ?>';

    function printDiv( elem ) {
        Popup( jQuery( elem ).html() );
    }

    function Popup( data ) {

        var frame1 = $( '<iframe />' );
        frame1[0].name = "frame1";
        frame1.css( {"position": "absolute", "top": "-1000000px"} );
        $( "body" ).append( frame1 );
        var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
        frameDoc.document.open();
        //Create a new HTML document.
        frameDoc.document.write( '<html>' );
        frameDoc.document.write( '<head>' );
        frameDoc.document.write( '<title></title>' );
        frameDoc.document.write( '<link rel="stylesheet" href="' + base_url + 'backend/bootstrap/css/bootstrap.min.css">' );
        frameDoc.document.write( '<link rel="stylesheet" href="' + base_url + 'backend/dist/css/font-awesome.min.css">' );
        frameDoc.document.write( '<link rel="stylesheet" href="' + base_url + 'backend/dist/css/ionicons.min.css">' );
        frameDoc.document.write( '<link rel="stylesheet" href="' + base_url + 'backend/dist/css/AdminLTE.min.css">' );
        frameDoc.document.write( '<link rel="stylesheet" href="' + base_url + 'backend/dist/css/skins/_all-skins.min.css">' );
        frameDoc.document.write( '<link rel="stylesheet" href="' + base_url + 'backend/plugins/iCheck/flat/blue.css">' );
        frameDoc.document.write( '<link rel="stylesheet" href="' + base_url + 'backend/plugins/morris/morris.css">' );


        frameDoc.document.write( '<link rel="stylesheet" href="' + base_url + 'backend/plugins/jvectormap/jquery-jvectormap-1.2.2.css">' );
        frameDoc.document.write( '<link rel="stylesheet" href="' + base_url + 'backend/plugins/datepicker/datepicker3.css">' );
        frameDoc.document.write( '<link rel="stylesheet" href="' + base_url + 'backend/plugins/daterangepicker/daterangepicker-bs3.css">' );
        frameDoc.document.write( '</head>' );
        frameDoc.document.write( '<body>' );
        frameDoc.document.write( data );
        frameDoc.document.write( '</body>' );
        frameDoc.document.write( '</html>' );
        frameDoc.document.close();
        setTimeout( function () {
            window.frames["frame1"].focus();
            window.frames["frame1"].print();
            frame1.remove();
        }, 500 );


        return true;
    }


    jQuery( function ( $ ) {
        $( ".select_checkbox" ).on( 'change', function ( e ) {
            var target = $( this ).data( 'target' ),
                current_checked = $( this ).prop( 'checked' );

            if ( current_checked === true ) {
                $( target ).prop( 'checked', true ).change();
            } else {
                $( target ).prop( 'checked', false ).change();
            }
        } );
		

  } );

    $( function ( $ ) {
        $( "#inputTeacherType" ).change( function () {
            var selectedValue = $( this ).find( 'option:selected' ).text();
            selectedValue = selectedValue.toLowerCase();
            var teacherSalaryLabel = $( "#inputTeacherSalaryLabel" );

            // if permanent is selected
            if ( selectedValue.search( "permanent" ) >= 0 ) {
                teacherSalaryLabel.text( "Monthly Salary" );
            } else {
                teacherSalaryLabel.text( "Per Lecture Payment" );
            }

            $( "#inputTeacherSalary" ).val( "" );
        } );
    } );
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