<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <div class="box box-primary" style="margin-bottom: 0px;">
            <div class="box-body">
                <div class="col-xs-5 col-sm-3 col-md-2">
                    <?php $url = $student['image'] != null ? $student['image'] : 'uploads/student_images/no_image.png'; ?>
                    <img class="student-image profile-user-img img-responsive img-circle" src="<?= base_url() . $url ?>"
                         alt="User profile picture">
                </div>

                <div class="col-xs-7 col-sm-9 col-md-10">
                    <div class="card-body-right">
                        <h4 class="card-title"><?= $student['firstname'] . ' ' . $student['lastname'] ?></h4>
                        <h5><?= $student['class'] . ' / ' . $student['section'] ?></h5>
                        <p class="card-text"><?= admission_text() ?> <?= $student['admission_no'] ?>  </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="content">


        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#tab_all">ALL</a></li>
            <li class="hidden"><a data-toggle="tab" href="#tab_date">Date Wise</a></li>
        </ul>
        <div class="tab-content">

            <div id="tab_all" class="tab-pane fade in active">
                <div class="box box-primary" style="margin-bottom: 0px;">
                    <div class="box-header">
                        <h4>All Assignment </h4>
                    </div>
                    <div class="box-body">
                        <div>
                            <?php $this->load->view("parent/student/getassignment_table") ?>
                        </div>
<!--                        <ul class="nav nav-tabs" id="tabs">-->
<!--                            --><?php
//                            $i = 0;
//                            foreach ($assignments as $key => $home) {
//                                $i++;
//                                $i == 1 ? $class = "active" : $class = " "; ?>
<!--                                <li class="--><?//= $class ?><!--"><a data-toggle="tab" href="#tab_--><?//= $i ?><!--">--><?//= $key ?><!--</a>-->
<!--                                </li>-->
<!--                            --><?php //} ?>
<!--                        </ul>-->
<!--                        <div class="tab-content">-->
<!--                            --><?php
//                            $i = 0;
//                            foreach ($assignments as $key => $home) {
//                                $i++;
//                                $i == 1 ? $class = "active" : $class = " "; ?>
<!--                                <div id="tab_--><?//= $i ?><!--" class="tab-pane fade in --><?//= $class ?><!--">-->
<!---->
<!--                                    <div class="row">-->
<!--                                        <div class="col-sm-4"><h4> Title: Assignment</h4></div>-->
<!--                                        <div class="col-sm-4"><h4> Class : --><?//= $home[0]["class"] ?>
<!--                                                / --><?//= $home[0]["section"] ?><!--  </h4></div>-->
<!--                                        <div class="col-sm-4"><h4> Teacher : --><?//= $home[0]["teacher"] ?><!--  </h4></div>-->
<!--                                    </div>-->
<!--                                    <div class="table-responsive">-->
<!--                                        <table class="table table-bordered table-hover ">-->
<!--                                            <thead>-->
<!--                                            <tr>-->
<!--                                                <th>Date</th>-->
<!--                                                <th>Title</th>-->
<!--                                                <th>File By Teacher</th>-->
<!--                                                <th>File View</th>-->
<!--                                                <th>File Download</th>-->
<!--                                                <th>Upload</th>-->
<!--                                                <th>Uploaded By Student</th>-->
<!--                                                <th>View Uploaded File</th>-->
<!--                                                <th>File Upload Date</th>-->
<!--                                                <th>Total Marks</th>-->
<!--                                                <th>Reply</th>-->
<!--                                                <th>Obtained Marks</th>-->
<!--                                                <th>%age</th>-->
<!--                                                <th>Status</th>-->
<!--                                            </tr>-->
<!--                                            </thead>-->
<!--                                            <tbody>-->
<!--                                            --><?php //foreach ($home as $key => $home_value) {
////                                                pwodie($home_value);
//                                                ?>
<!--                                                <tr>-->
<!--                                                    <td>--><?//= date('d/m/Y', strtotime($home_value['date'])) ?><!--</td>-->
<!--                                                    <td>--><?//= $home_value['title'] ?><!--</td>-->
<!--                                                    --><?php //$string = $home_value['file'];
//                                                    $pieces       = explode('/', $string);
//                                                    $last_word    = array_pop($pieces); ?>
<!--                                                    <td>--><?//= $last_word ?><!--</td>-->
<!--                                                    <td><a target="blank"-->
<!--                                                           href="--><?//= base_url() ?><!----><?//= $home_value['file'] ?><!--"><i-->
<!--                                                                    class="fa fa-eye" aria-hidden="true"></i></a>-->
<!--                                                    <td><a download-->
<!--                                                           href="--><?//= base_url() ?><!----><?//= $home_value['file'] ?><!--"><i-->
<!--                                                                    class="fa fa-download"-->
<!--                                                                    aria-hidden="true"></i></a>-->
<!--                                                    </td>-->
<!--                                                    <td><a class="btn btn-xs btn-default"-->
<!--                                                           href="--><?//= base_url() ?><!--parent/parents/upload_assignment/--><?php //echo $student['id'] . '/' . $home_value['id']; ?><!--"><i-->
<!--                                                                    class="fa fa-upload" aria-hidden="true"></i></a>-->
<!--                                                    </td>-->
<!---->
<!--                                                    <td>--><?php //echo getLastWord($home_value['std_uploaded_file']) ?><!--</td>-->
<!---->
<!--                                                    <td><a class="btn btn-xs btn-default" target="blank"-->
<!--                                                           href="--><?//= base_url($home_value['std_uploaded_file']); ?><!--"><i-->
<!--                                                                    class="fa fa-eye" aria-hidden="true"></i></a>-->
<!--                                                    </td>-->
<!--                                                    <td>--><?//= date('d/m/Y', strtotime($home_value['std_uploaded_date'])) ?><!--</td>-->
<!--                                                    <td>--><?//= $home_value['marks']; ?><!--</td>-->
<!--                                                    <td>-->
<!--                                                        --><?php //if ($home_value['reply_file']): ?>
<!--                                                            <a target="_blank" class="btn btn-xs btn-default"-->
<!--                                                               href="--><?//= base_url($home_value['reply_file']); ?><!--"><i-->
<!--                                                                        class="fa fa-eye"-->
<!--                                                                        aria-hidden="true"></i></a>-->
<!--                                                            <a target="_blank" class="btn btn-xs btn-default"-->
<!--                                                               download-->
<!--                                                               href="--><?//= base_url($home_value['reply_file']); ?><!--"><i-->
<!--                                                                        class="fa fa-download"-->
<!--                                                                        aria-hidden="true"></i></a>-->
<!--                                                        --><?php //endif; ?>
<!--                                                    </td>-->
<!--                                                    <td>--><?//= $home_value['obtained_marks']; ?><!--</td>-->
<!--                                                    <td>--><?//= $home_value['obtained_marks'] / $home_value['marks'] * 100; ?><!--</td>-->
<!--                                                    <td>-->
<!--                                                        --><?php
//                                                        if ($home_value['obtained_marks'] < $home_value['passing_marks']) {
//                                                            echo "<span style='color: red;'>Fail</span>";
//                                                        } else {
//                                                            echo "<span style='color: green;'>Pass</span>";
//                                                        }
//                                                        ?>
<!--                                                    </td>-->
<!---->
<!---->
<!--                                                </tr>-->
<!--                                                --><?php //$lastword = "" ?>
<!---->
<!--                                            --><?php //} ?>
<!--                                            </tbody>-->
<!--                                        </table>-->
<!---->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            --><?php //} ?>
<!--                        </div>-->
                    </div>
                </div>
            </div>


            <div id="tab_date" class="tab-pane fade in ">
                <div class="box box-primary" style="margin-bottom: 0px;">
                    <div class="box-header">
                        <div class="col-sm-2">
                            <label>Select Date for Assignment</label>
                            <input type="text" name="date_from" class="form-control date"
                                   value="<?php echo date('d/m/Y'); ?>" autocomplete="off">
                        </div>
                    </div>

                    <div class="box-body">
                        <div id="assignment">
                            <?php $this->load->view("parent/student/getassignment_table") ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</div>

<!---->
<!--</section>-->
<!--<section id="tabs">-->
<!---->
<!--</section>-->
<!---->
<!--</div>-->


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

<script type="text/javascript">
    $(document).ready(function () {
        $('.example').dataTable({
            "bSort": false,
            "paging": false,

        });


    });


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
<script>
    $(function () {

        $('.date').datepicker({
            format: 'dd/mm/yyyy',
            autoclose: true
        }).on('changeDate', function (e) {
                getData($(this).val());
            }
        );

        function getData($date) {
            $.ajax({
                url: '<?php echo site_url("parent/parents/studentAssignment") ?>',
                type: 'post',
                data: {
                    date: $date,
                    student_id: <?=$student['id']?>,
                },
                // dataType: 'json',
                success: function (response) {

                    // var div = GetDynamicTextBox(response);
                    // console.log(response);

                    $("#assignment").html(response);
                }
            });
        }

        $(function () {
            getData("<?php echo date('d/m/Y'); ?>");
        })
    });


</script>