

<style type="text/css">
.img-block{
    position: absolute;
    top:10%;
    right:10%;
    background-color: red;
    width: 500px;
    height: 500px;
}
.img1 img{
    width: 200px;
}

</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <?php 
          $admind = $this->session->userdata( 'admin' ); 
          $this->load->helper('menu_helper');
          $permission = admin_permission($admind['id']);
        ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <!-- Horizontal Form -->
        <div class="box box-primary" style="margin-bottom:0px;">
            <div class="box-header with-border">
                <div class="col-md-7">
                    <h1 class="box-title">
                   Award List
                    </h1>
                </div>
                <div class="col-md-5">
               
                </div><!-- /.box-body -->
            </div><!-- /.box-header -->
        </div>
        <?php if ($this->session->flashdata('msg')) { ?>
            <?php echo $this->session->flashdata('msg') ?>
        <?php } ?>
        <?php
        if (isset($error_message)) {
            echo "<div class='alert alert-danger'>" . $error_message . "</div>";
        }
        ?>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-4">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"><?php echo $this->lang->line('exam_list'); ?></h3>

                        <div class="box-tools pull-right " style="right:50px;top:6px">
                        <div class="row">

                        
                        
                        </div> 
                  
                          
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <br><br>
                    <br>
                    

                    <div class="box-body">
                        <div class="mailbox-controls">
                            <!-- Check all button -->
                        </div>
                        <div class="table-responsive mailbox-messages">
                            <table class="table     table-bordered table-hover ">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('name'); ?></th>
                                        <th class="text-right"><?php echo $this->lang->line('action'); ?></th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if (empty($examlist)) {
                                   
                                    } else {
                                        $count = 1;
                                        foreach ($examlist as $key => $exam) { ?>
                                            <tr>
                                                <td class="mailbox-name">
                                               
                                                    
                                                    <a href="<?= site_url('admin/exam/awardclass')?>?exam_id=<?php echo $exam['id'] ?>" data-toggle="popover" id="<?php echo $exam['id'] ?>" class="detail_popover exams_all" <?= $exam['id'] == $exam_id?'style="color:#0084B4;font-size:15px;"':'style="color:#000;font-size:12px;"' ?> ><?php echo $exam['name'] ?></a>

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
            <?php if($exam_id != -1){?>
            <div class="col-md-8">
                <!-- Horizontal Form -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h2 class="box-title classes_title">Exam Name <?= $examname ?></h2>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                    <div class="table-responsive mailbox-messages">
                                <table class="table table-hover    " id="example">
                                    <thead>
                                        <tr>
                                            <th>Class (Section) </th>
                                            <th class="text text-center">Exam Schedule</th>
                                            <th class="text text-right">Marks Sheet</th>
                                        </tr>
                                    </thead>
                                    <tbody class="exam_table">
                                        <?php foreach ($class_sections as $key => $class_section): ?>
                                            <tr>
                                                <td class="mailbox-name">
                                                    <?= $class_section['class']['class'] . '/' . $class_section['section']['section'] ?>
                                                </td>
                                                <td  class="text text-center">
                                               
                                                    
                                                
                                               
                                                </td>
                                                <td  class="text pull-right">
                                                 
                                                   
                                                     <?php if($permission->award == 1){  ?>
                                               
                                                    <a href="<?= site_url('admin/mark/award_list')?>?class_id=<?php echo $class_section['class_id'] ?>&section_id=<?php echo $class_section['section_id'] ?>"  class="mark_register_edit" data-toggle="tooltip" title=""  data-examid="" data-original-title="" data-sectionid="<?php echo $class_section['section_id'] ?>" data-classid="<?php echo $class_section['class_id'] ?>" data-classname="<?php echo $class_section['class']['class'] ?>"  data-sectionname="<?php echo $class_section['section']['section'] ?>">
                                                        <i class="fas fa-award text-black"></i>
                                                    </a>

                                                    <?php }?>  
                                               
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
                    </div>
                
                
                </div>
            </div>            
            <?php }?>
            <!-- right column -->
        </div>
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script type="text/javascript">
    var examm_id = <?php echo $exam_id ?>;
    $(document).ready(function () {
        
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
            url: base_url + "admin/examschedule/getexamscheduledetail",
            data: {'exam_id': exam_id, 'section_id': section_id, 'class_id': class_id},
            dataType: "json",
            success: function (response) {
		        if(response[0] == null){
                    alert('Subject not assign');
                    return false;
                }
                var data = "";
                data += '<div class="table-responsive">';
                data += "<p class='lead titlefix pt0'><?php echo $this->lang->line('class'); ?>: " + classname + "(" + sectionname + ")</p>";
                data += '<table class="table table-hover sss">';
                data += '<thead>';
			    data += '<tr>';
				data += "<th><?php echo $this->lang->line('subject'); ?></th>";
                data += "<th><?php echo $this->lang->line('date'); ?></th>";
                data += "<th class='text text-center'><?php echo $this->lang->line('start_time'); ?></th>";
                data += "<th class='text text-center'><?php echo $this->lang->line('end_time'); ?></th>";

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
                 
                    data += '<td class="text text-center">' + obj.full_marks + '</td>';
                    data += '<td class="text text-center">' + obj.passing_marks + '</td>';
                    data += '</tr>';
                });
                data += '</tbody>';
                data += '</table>';
                data += '</div>  ';
                $('.modal-body').html(data);
                //===========
				var images = $('.img1 img').attr('src');
			    var school_name = $('#school_name').val();
			
  				var title = '<div style="font-size:21px;"> ' +'<img src="'+images+'" height="100px">&nbsp;&nbsp;&nbsp;&nbsp;'+ school_name +'('+ response[0].name +')'+ ' </div>';
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
                            text:      '<i class="fas fa-file-csv"></i>',
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
                        customize: function ( win ) {
                            $(win.document.body)
                            .css( 'font-size', '12pt' )
                                
                            $(win.document.body).find( 'table' )
                                .addClass( 'compact' )
                                .css( 'font-size', 'inherit' );
                        },
                        text: '<i class="fa fa-print"></i>',
                        title: title,
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

                $("#scheduleModal").modal('show');
            }
        });
    });

</script>


<div id="scheduleModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title view_exam_model_title">Date Sheet</h4>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?></button>
            </div>
        </div>
    </div>
</div>