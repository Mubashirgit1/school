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
            <div class="box-header with-border" style="">
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <h4><?= $title ?></h4>
                    </div>
                    <div class="col-sm-6 col-md-8 ">
                    </div>
                     
                </div>
            </div>
        </div>
    </section>
    
    
    <div class="col-md-12">

    <div class="row">
            <!-- left column -->
            <div class="col-md-4">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"><?php echo $this->lang->line('exam_list'); ?></h3>
                            <br>
                        <div class="box-tools pull-right">
 
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="mailbox-controls">
                            <!-- Check all button -->

                            <div class="pull-right">

                            </div><!-- /.pull-right -->
                        </div>
                        <div class="table-responsive mailbox-messages">
                            <table class="table     table-bordered table-hover ">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('name'); ?></th>
                                        <th class="text-right"></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if (empty($examlist)) {
                                    ?>
                                      <?php
                                    } else {
                                        $count = 1;
                                        foreach ($examlist as $key => $exam) {
                                           
                                            ?>

                                            <tr>

                                                <td class="mailbox-name">
                                                    <a href="<?= site_url('student/send_message_exam')?>?exam_id=<?php echo $exam['id'] ?>" data-toggle="popover" id="<?php echo $exam['id'] ?>" class="detail_popover exams_all" <?= $exam['id'] == $exam_id?'style="color:#0084B4;font-size:15px;"':'style="color:#000;font-size:12px;"' ?> ><?php echo $exam['name'] ?></a>

                                                    <div class="fee_detail_popover" style="display: none">
                                                        <?php
                                                        if ($exam['note'] == "") {
                                                            ?>
                                                            <p class="text text-danger"><?php echo $this->lang->line('no_description'); ?></p>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <p class="text text-info"><?php echo $exam['note']; ?></p>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </td>
                                                <td class="mailbox-date pull-right">
                                                   
                                                  
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        $count++;
                                    }
                                    ?>
                                </tbody>
                            </table><!-- /.table -->
                        </div><!-- /.mail-box-messages -->
                        
                    </div><!-- /.box-body -->
                </div>
            </div>
            <!--/.col (left) -->
            <!--/.col (right) -->
            <div class="box-body">
            <?php if($exam_id != -1){?>
            <div class="col-md-8">
                <!-- Horizontal Form -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title classes_title">Exam Name () <?= $examname ?></h3>
                    </div><!-- /.box-header -->
                    <div class="table-responsive mailbox-messages">
                    
                         <form action="" method="post" >
                                 <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th class="text-center"><button type="submit" class="btn btn-primary btn-sm" formaction="<?= site_url( 'student/send_sms_to_date_sheet' ) ?>" >Send Date Sheet</button>  </th>
                                            <th class="text text-center">   <button type="submit" class="btn btn-primary btn-sm " formaction="<?= site_url( 'student/send_sms_to_result_card' ) ?>" >Send Result</button></th>
                                        </tr>
                                        <tr>
                                            <th>Class (Section)</th>
                                            <th class="text text-center">Exam Schedule</th>
                                            <th class="text text-center">Marks Sheet</th>
                                        </tr>
                                    </thead>
                                    <tbody class="exam_table">
                                    
                                    
                                    
                                        <?php 
									
										foreach ($class_sections as $key => $class_section): ?>
                                            <tr>
                                                <td class="mailbox-name">
                                                    <?= $class_section['class']['class'] . '/' . $class_section['section']['section'] ?>
                                                </td>
                                                <td  class="text text-center">
                                                    <a href="#"  class="schedule_modal" data-toggle="tooltip" title="<?php echo $this->lang->line('view'); ?>"  data-examid="<?php echo $exam_id; ?>" data-original-title="<?php echo $this->lang->line('view_detail'); ?>" data-sectionid="<?php echo $class_section['section_id'] ?>" data-classid="<?php echo $class_section['class_id'] ?>" data-classname="<?php echo $class_section['class']['class'] ?>"  data-sectionname="<?php echo $class_section['section']['section'] ?>">
                                                        <!-- <img style="max-width: 16px" src="<?php echo base_url(); ?>backend/images/view1.jpg" alt="view"/> -->
                                                        <i class="fa fa-print text-black"></i>
                                                    </a> <span style="font-size: 18px;">
                                
                                  <input type="hidden" name="exam_id"  class="exam_id" value="" >  
                                         
                                  <input type="checkbox" class="class" name="class_id[]" value="<?= $class_section['class_id']?>-<?= $class_section['section_id'] ?>" >
                          
                                  </span> 
                                                 
                                                   <?php /*?> <a href="<?= site_url('admin/examschedule/create')?>?class_id=<?php echo $class_section['class_id'] ?>&section_id=<?php echo $class_section['section_id'] ?>&save_exam=search"  class="schedule_modal_edit" data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>"  data-examid="<?php echo $clssection['exam_id']; ?>" data-original-title="<?php echo $this->lang->line('view_detail'); ?>" data-sectionid="<?php echo $class_section['section_id'] ?>" data-classid="<?php echo $class_section['class_id'] ?>" data-classname="<?php echo $class_section['class']['class'] ?>"  data-sectionname="<?php echo $class_section['section']['section'] ?>">
                                                        <i class="fas fa-pencil-alt text-black"></i>
                                                    </a><?php */?>
                                                </td>
                                                <td  class="text text-center">
                                                  <a href="<?= site_url('admin/mark')?>?class_id=<?php echo $class_section['class_id'] ?>&section_id=<?php echo $class_section['section_id'] ?>" class="mark_register_view" data-toggle="tooltip" title="<?php echo $this->lang->line('view'); ?>"  data-examid="<?php echo $clssection['exam_id']; ?>" data-original-title="<?php echo $this->lang->line('view_detail'); ?>" data-sectionid="<?php echo $class_section['section_id'] ?>" data-classid="<?php echo $class_section['class_id'] ?>" data-classname="<?php echo $class_section['class']['class'] ?>"  data-sectionname="<?php echo $class_section['section']['section'] ?>">
                                                        <!-- <img style="max-width: 16px" src="<?php echo base_url(); ?>backend/images/view1.jpg" alt="view"/> -->
                                                        <i class="fa fa-print text-black"></i>
                                                    </a> <span style="font-size: 18px;">
                                                    
                                                    <input type="checkbox" class="class" name="class_id2[]" value="<?= $class_section['class_id']?>-<?= $class_section['section_id'] ?>" >
                                                    </span>
                                                    
                                                  <?php /*?>  <a href="<?= site_url('admin/mark/create')?>?class_id=<?php echo $class_section['class_id'] ?>&section_id=<?php echo $class_section['section_id'] ?>"  class="mark_register_edit" data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>"  data-examid="<?php echo $clssection['exam_id']; ?>" data-original-title="<?php echo $this->lang->line('view_detail'); ?>" data-sectionid="<?php echo $class_section['section_id'] ?>" data-classid="<?php echo $class_section['class_id'] ?>" data-classname="<?php echo $class_section['class']['class'] ?>"  data-sectionname="<?php echo $class_section['section']['section'] ?>">
                                                        <i class="fas fa-pencil-alt text-black"></i>
                                                    </a><?php */?>
                                                   <!-- <span class="label label-success"><?php echo $this->lang->line('yes'); ?></span>
                                                   <span class="label label-danger"><?php echo $this->lang->line('no'); ?></span> -->
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table><!-- /.table -->
                                <div class="not_alloted">
                                </div>
                              
                        </div>
                       
                      
                     
                
                </form>
                </div>
                
                
            </div>
            <?php }?>
            </div>
            <!-- right column -->
        </div>
</div>
</div>
<script type="text/javascript">


   $(document).on('click', '.exams_all', function (e) {
            

            var id = <?php echo $exam_id ?>;
            $(".exam_id").val(id);
  
    });
</script>
<script type="text/javascript">


	


    var examm_id = <?php echo $exam_id ?>;
    $(document).ready(function () {
        var id = <?php echo $exam_id ?>;
            $(".exam_id").val(id);
            
        if (examm_id != -1) {
            $(".schedule_modal_edit").each(function () {
                var href = $(this).attr('href');
                $(this).attr('href', href.replace(/&?exam_id=\d+/, ''));
            });

            $(".schedule_modal_edit").each(function() {
               var $this = $(this);       
               var _href = $this.attr("href"); 
               $this.attr("href", _href + '&exam_id='+examm_id);
            });

            $(".mark_register_view").each(function () {
                var href = $(this).attr('href');
                $(this).attr('href', href.replace(/&?exam_id=\d+/, ''));
            });

            $(".mark_register_view").each(function() {
               var $this = $(this);       
               var _href = $this.attr("href"); 
               $this.attr("href", _href + '&exam_id='+examm_id);
            });

            $(".mark_register_edit").each(function () {
                var href = $(this).attr('href');
                $(this).attr('href', href.replace(/&?exam_id=\d+/, ''));
            });

            $(".mark_register_edit").each(function() {
               var $this = $(this);       
               var _href = $this.attr("href"); 
               $this.attr("href", _href + '&exam_id='+examm_id);
            });
        }

        $('#date').datepicker({
            format: "dd-mm-yyyy",
            autoclose: true
        });
        $("#btnreset").click(function () {           
            $("#form1")[0].reset();
        });

        $(document).on('click', '.exams_all', function (e) {
            $('.view_exam_model_title').html("");
            $('.classes_title').html("");
            var exam_title  = $(this).html();
            
            $('.view_exam_model_title').html(exam_title);
            $('.view_mark_model_title').html(exam_title);
            $('.classes_title').html(exam_title);
            $('.exams_all').css({ 'color': '#000','font-size': '12px' });
            var id = $(this).attr('id');
            $(".schedule_modal").attr('data-examid',id);
            $(".mark_register_view").attr('data-examid',id);
            $(".mark_register_edit").attr('data-examid',id);
            $(this).css({ 'color': '#0084B4','font-size': '15px' });

            $(".schedule_modal_edit").each(function () {
                var href = $(this).attr('href');
                $(this).attr('href', href.replace(/&?exam_id=\d+/, ''));
            });

            $(".schedule_modal_edit").each(function() {
               var $this = $(this);       
               var _href = $this.attr("href"); 
               $this.attr("href", _href + '&exam_id='+id);
            });

            $(".mark_register_view").each(function () {
                var href = $(this).attr('href');
                $(this).attr('href', href.replace(/&?exam_id=\d+/, ''));
            });

            $(".mark_register_view").each(function() {
               var $this = $(this);       
               var _href = $this.attr("href"); 
               $this.attr("href", _href + '&exam_id='+id);
            });

            $(".mark_register_edit").each(function () {
                var href = $(this).attr('href');
                $(this).attr('href', href.replace(/&?exam_id=\d+/, ''));
            });

            $(".mark_register_edit").each(function() {
               var $this = $(this);       
               var _href = $this.attr("href"); 
               $this.attr("href", _href + '&exam_id='+id);
            });


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
				if(response[0] == null){
                    alert('Subject not assign');
                    return false;
                }
             
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