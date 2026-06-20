<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<div class="content-wrapper" style="min-height: 946px;">
<section class="content-header">
        <div class="box box-primary" style="margin-bottom: 0px;">
            <div class="box-body">
            <div class="col-xs-5 col-sm-3 col-md-2"  > 
            <?php  $url = $student['image'] != null ? $student['image'] : 'uploads/student_images/no_image.png';  ?>
                <img class="student-image profile-user-img img-responsive img-circle" src="<?= base_url().$url ?>" alt="User profile picture">
            </div> 
           
            <div class="col-xs-7 col-sm-9 col-md-10"> 
                <div class="card-body-right">
                    <h4 class="card-title"><?= $student['firstname'].' '.$student['lastname']?></h4>
                    <h5><?= $student['class'].' / '.$student['section']?></h5>
                    <p class="card-text"><?= admission_text() ?> <?= $student['admission_no'] ?>  </p>
                </div>
            </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
       
            <div class="col-md-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#activity" data-toggle="tab" aria-expanded="true">Graphs</a></li>
                     </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="activity">  
                        <div class="box box-primary" >
                                <div class="box-header with-border">

                                    <h4 class="pull-left" style="margin-top: 0px;">
                                        <?= $student_monthly ?>
                                    </h4>
                                    <div class="pull-right">
                                        <form action="" method="post" class="form-inline">
                                            <div class="form-group">
                                                <label>Year</label>
                                                <select class="form-control" name="year" id="year_student_monthly">
                                                    <?php
                                                    $date = new DateTime( date( 'Y-m-d', now() ) );
                                                    $date->sub( new DateInterval( 'P6Y' ) );
                                                    for ( $i = 0; $i <= 6; $i++ ):
                                                        ?>
                                                        <option value="<?= $date->format( 'Y' ) ?>" <?= ( $year == $date->format( 'Y' ) ? "selected" : "" ) ?>><?= $date->format( 'Y' ) ?></option>
                                                        <?php
                                                        $date->add( new DateInterval( 'P1Y' ) );
                                                    endfor;
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="form-group">

                                                <input type="button" id="fetch_student_monthly" class="btn btn-primary" value="Get Graph">

                                            </div>
                                        </form>
                                    </div>

                                </div>
                                <div class="box-body">

                                    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
                                    <canvas id="Chart_student_monthly" width="200" height="70" class=""></canvas>

                                </div>
                            </div>
                        </div>
                                       
                    </div>
                </div>
            </div>
    </section>  


</div>
   

<script type="text/javascript">
    $(".myTransportFeeBtn").click(function () {
        $("span[id$='_error']").html("");
        $('#transport_amount').val("");
        $('#transport_amount_discount').val("0");
        $('#transport_amount_fine').val("0");
        var student_session_id = $(this).data("student-session-id");
        $('.transport_fees_title').html("<b>Upload Document</b>");
        $('#transport_student_session_id').val(student_session_id);
        $('#myTransportFeesModal').modal({
            backdrop: 'static',
            keyboard: false,
            show: true
        });
    });
</script>

<div class="modal fade" id="myTransportFeesModal" role="dialog">
    <div class="modal-dialog">       
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title title text-center transport_fees_title"></h4>
            </div>
            <div class="">
                <div class="form-horizontal">
                    <div class="">
                        <input  type="hidden" class="form-control" id="transport_student_session_id"  value="0" readonly="readonly"/>
                        <form id="form1" action="<?php echo site_url('teacher/student/create_doc') ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                            <div id='upload_documents_hide_show'>
                                <?php echo $this->customlib->getCSRF(); ?>
                                <input type="hidden" name="student_id" value="<?php echo $student_doc_id; ?>" id="student_id">
                                <h4><?php echo $this->lang->line('upload_documents1'); ?></h4>
                                <div class="col-md-12">
                                    <div class="">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo $this->lang->line('title'); ?></label>
                                                <input id="first_title" name="first_title" placeholder="" type="text" class="form-control"  value="<?php echo set_value('first_title'); ?>" />
                                                <span class="text-danger"><?php echo form_error('first_title'); ?></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1"><?php echo $this->lang->line('Documents'); ?></label>
                                                <input id="first_doc_id" name="first_doc" placeholder="" type="file" class="form-control"  value="<?php echo set_value('first_doc'); ?>" />
                                                <span class="text-danger"><?php echo form_error('first_doc'); ?></span>
                                            </div>
                                        </div>
                                    </div></div>
                            </div>
                            <div class="modal-footer" style="clear:both">
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?></button>
                                <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                            </div>
                        </form>
                    </div>                   
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

var student_monthly = [];
    var student_monthly1 = [];
    var student_monthly2 = [];
    var student_monthly3 = [];
    var student_monthly4 = [];
    var dates_student_monthly = [];
    var total1_student_monthly = [];

    $("#fetch_student_monthly").on('click', function(){
        $(this).prop('disabled', true);
        var year =  $("#year_student_monthly").val();
        var id = $("#student_id").val();
        $.ajax({
            method: 'POST',
            url: '<?php echo base_url() ?>parent/parents/student_all_specific',
            data: { 'year': year, 'student_id': id },
            success: function(data){
                obj  = JSON.parse(data);
                console.log(obj);

                $.each(obj,function(i,item){

                    dates_student_monthly.push(i)
                    var count_month = 0
                    var count_month_absent = 0
                    var count_month_leave = 0
                    var count_month_late = 0
                    var count_month_holiday = 0
                    var total = 0;
                    var total_teacher = 0;

                    $.each(item,function(j,item){
                        var count = 0;
                        var count_absent = 0;
                        var count_leave = 0;
                        var count_late = 0;
                        var count_holiday = 0;

                        total = j++;
                        $.each(item,function(k,item){
                            total_teacher = k++;
                            if(item != false){
                                if(item.attendence_type_id == 1  ){
                                    count++;
                                }
                                if(item.attendence_type_id == 2  ){
                                    count_absent++;
                                }
                                if(item.attendence_type_id == 3  ){

                                    count_leave++;
                                }
                                if(item.attendence_type_id == 4  ){

                                    count_late++;
                                }
                                if(item.attendence_type_id == 5  ){

                                    count_holiday++;
                                }


                            }

                        })

                        count_month = count_month + count;
                        count_month_absent = count_month_absent + count_absent;
                        count_month_leave = count_month_leave  + count_leave;
                        count_month_late = count_month_late + count_late;
                        count_month_holiday = count_month_late + count_holiday;

                    })

                    var count_percent = parseInt(count_month) * 100 / parseInt(total);
                    var count_percent_absent = parseInt(count_month_absent) * 100 / parseInt(total);
                    var count_percent_leave = parseInt(count_month_leave) * 100 / parseInt(total);
                    var count_percent_late = parseInt(count_month_late) * 100 / parseInt(total);
                    var count_percent_holiday = parseInt(count_month_holiday) * 100 / parseInt(total);



                    total_teacher_to =total_teacher+1


                    total_percent =count_percent/total_teacher_to;
                    total_percent_absent =count_percent_absent/total_teacher_to;
                    total_percent_leave =count_percent_leave/total_teacher_to;
                    total_percent_late =count_percent_late/total_teacher_to;
                    total_percent_holiday =count_percent_holiday/total_teacher_to;



                    student_monthly.push(total_percent);
                    student_monthly1.push(total_percent_absent);
                    student_monthly2.push(total_percent_leave);
                    student_monthly3.push(total_percent_late);
                    student_monthly4.push(total_percent_holiday);



                })


                var ctx = $("#Chart_student_monthly");


                var color = dates_student_monthly;

                var vertical = student_monthly;
                var vertical1 = student_monthly1;
                var vertical2 = student_monthly2;
                var vertical3 = student_monthly3;
                var vertical4 = student_monthly4;


                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: color,
                        datasets: [{
                            label: "Absent",
                            backgroundColor: "red",
                            data: vertical1,
                        }, {
                            label: "Present",
                            backgroundColor: "green",
                            data: vertical,
                        },{
                            label: "Late",
                            backgroundColor: "purple",
                            data: vertical3,
                        },{
                            label: "Leave",
                            backgroundColor: "blue",
                            data: vertical2
                        }, {
                            label: "Holiday",
                            backgroundColor: "Black",
                            data: vertical4,

                        }]

                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    min: 0,
                                    max: 100,
                                    callback: function(value) {
                                        return value + "%"
                                    }
                                },
                                scaleLabel: {
                                    display: true,
                                    labelString: "Percentage"
                                }
                            }]

                        }
                    }
                });

            },

        });

    });
    $(document).ready(function () {
        $('.example').dataTable({
            "bSort": false,
            "paging": false,

        });

    })

    $(document).ready(function () {
        $('.detail_popover').popover({
            placement: 'right',
            title: '',
            trigger: 'hover',
            container: 'body',
            html: true,
            content: function () {
                return $(this).closest('td').find('.fee_detail_popover').html();
            }
        });
    });
</script>