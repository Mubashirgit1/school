<style type="text/css">
    @media print {
        .no-print, .no-print * {
            display: none !important;
        }
    }
</style>


<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <div class="box box-primary">
            <div class="box-header with-border" style="">
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <h4>
                            <?= $title ?>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div class="col-md-12">

        <div class="row">

            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        Mark Holiday(s)
                    </div>
                    <div class="box-body">
                        <form action="<?php echo site_url('admin/stuattendence/holiday_process') ?>"
                              id="employeeform" name="employeeform" method="post" accept-charset="utf-8"
                              enctype="multipart/form-data">
                            <div class="box-body">
                                <?php if ($this->session->flashdata('msg')) { ?>
                                    <?php echo $this->session->flashdata('msg') ?>
                                <?php } ?>
                                <?php echo $this->customlib->getCSRF(); ?>
                                <div class="form-group">
                                    <label>Title Of Holiday</label>
                                    <input type="text" id="message_title" class="form-control"
                                           name="message_title">
                                </div>
                                <div class="form-group">
                                    <label>Date From</label>
                                    <input type="text" id="message_date" class="form-control _date"
                                           name="date_from"
                                           value="<?= set_value('date', date('m/d/Y', now())) ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Date To</label>
                                    <input type="text" id="message_date" class="form-control _date"
                                           name="date_to" value="<?= set_value('date', date('m/d/Y', now())) ?>"
                                           readonly>
                                </div>
                                <div class="box-footer">
                                    <button type="submit"
                                            class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?>
                                        Holiday(s)
                                    </button>
                                </div>
                        </form>
                        <form action="<?php echo site_url('admin/stuattendence/holiday_process_saturday') ?>"
                              id="employeeform" name="employeeform" method="post" accept-charset="utf-8"
                              enctype="multipart/form-data">

                            <div class="form-group">
                                <label for="saturday">Saturday ON/OFF </label>
                                <select id="saturday" name="saturday" class="form-control col-md-7 col-xs-12">
                                    <option value="0">OFF</option>
                                    <option value="1">ON</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="box-footer">
                                    <br>
                                    <button type="submit" class="btn btn-info pull-right">Saturday Holiday(s)
                                    </button>

                                </div>
                            </div>
                        </form>
                        <div class="table-responsive mailbox-messages">

                            <table class="table     table-bordered table-hover ">
                                <thead>
                                <tr>
                                    <th class="mailbox-name text-center">Total days</th>
                                    <th class="mailbox-name text-center">Working Days</th>
                                    <th class="mailbox-name text-center">Holiday(s)</th>
                                </tr>
                                </thead>
                                <tbody>

                                <tr>
                                    <td class="mailbox-name text-center">365</td>
                                    <?php
                                    $total_holidays = 0;
                                    foreach ($messages as $message) {
                                        $total_holidays += $message['days'];
                                    }
                                    $year        = date('Y', now());
                                    $start_month = $this->setting_model->getStartMonth();
                                    $counting    = getSundays(date('Y'), $start_month);
                                    $saturday    = $this->setting_model->getSaturday();
                                    if ($saturday == 1) {
                                        $counting = $counting + $counting;
                                    }
                                    $holi    = $total_holidays + $counting;
                                    $working = 365 - $holi;
                                    ?>


                                    <td class="mailbox-name text-center"><?= $working ?></td>


                                    <td class="mailbox-name text-center"><?= $holi ?></td>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="box box-primary" id="tachelist">
                <div class="box-header ptbnull">
                    <h3 class="box-title titlefix">Marked Holiday(s)</h3>

                </div>
                <br>
                <br>
                <div class="box-body">
                    <div class="mailbox-controls">
                    </div>
                    <div class="table-responsive mailbox-messages">
                        <table class="table     table-bordered table-hover example">
                            <thead>
                            <tr>

                                <th>Title</th>
                                <th>Date From</th>
                                <th>Date To</th>
                                <th>Holiday(s)</th>

                                <th class="text-center">Action</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php

                            $count = 1;
                            foreach ($messages as $message) {


                                ?>
                                <tr>
                                    <td class="mailbox-name">

                                        <?= $message['title'] ?>

                                    </td>
                                    <td class="mailbox-name"> <?= date('Y-M-d', strtotime($message['date_from'])) ?></td>
                                    <td class="mailbox-name"> <?= date('Y-M-d', strtotime($message['date_to'])) ?></td>

                                    <td class="mailbox-name"> <?php echo $message['days'] ?></td>


                                    <td class="mailbox-date  no-print text-center">


                                        <?php /*?>  <a href="<?php echo base_url(); ?>student/view_message/<?php echo $message['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line( 'show' ); ?>">
                                                    <i class="fa fa-reorder"></i>
                                                </a><?php */ ?>

                                        <a href="<?php echo base_url(); ?>admin/stuattendence/delete_holiday/<?php echo $message['id'] ?>"
                                           class="btn btn-default btn-xs" data-toggle="tooltip"
                                           title="<?php echo $this->lang->line('delete'); ?>"
                                           onclick="return confirm('Are you sure you want to delete this item?')"
                                           ;>
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
                <div class="">
                    <div class="mailbox-controls">
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<script type="text/javascript">


    $(document).on('click', '.exams_all', function (e) {

        var id = $(this).attr('id');
        $(".exam_id").val(id);

    });
</script>
<script type="text/javascript">


    var examm_id = <?php echo $exam_id ?>;
    $(document).ready(function () {

        if (examm_id != -1) {
            $(".schedule_modal_edit").each(function () {
                var href = $(this).attr('href');
                $(this).attr('href', href.replace(/&?exam_id=\d+/, ''));
            });

            $(".schedule_modal_edit").each(function () {
                var $this = $(this);
                var _href = $this.attr("href");
                $this.attr("href", _href + '&exam_id=' + examm_id);
            });

            $(".mark_register_view").each(function () {
                var href = $(this).attr('href');
                $(this).attr('href', href.replace(/&?exam_id=\d+/, ''));
            });

            $(".mark_register_view").each(function () {
                var $this = $(this);
                var _href = $this.attr("href");
                $this.attr("href", _href + '&exam_id=' + examm_id);
            });

            $(".mark_register_edit").each(function () {
                var href = $(this).attr('href');
                $(this).attr('href', href.replace(/&?exam_id=\d+/, ''));
            });

            $(".mark_register_edit").each(function () {
                var $this = $(this);
                var _href = $this.attr("href");
                $this.attr("href", _href + '&exam_id=' + examm_id);
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
            var exam_title = $(this).html();

            $('.view_exam_model_title').html(exam_title);
            $('.view_mark_model_title').html(exam_title);
            $('.classes_title').html(exam_title);
            $('.exams_all').css({'color': '#000', 'font-size': '12px'});
            var id = $(this).attr('id');
            $(".schedule_modal").attr('data-examid', id);
            $(".mark_register_view").attr('data-examid', id);
            $(".mark_register_edit").attr('data-examid', id);
            $(this).css({'color': '#0084B4', 'font-size': '15px'});

            $(".schedule_modal_edit").each(function () {
                var href = $(this).attr('href');
                $(this).attr('href', href.replace(/&?exam_id=\d+/, ''));
            });

            $(".schedule_modal_edit").each(function () {
                var $this = $(this);
                var _href = $this.attr("href");
                $this.attr("href", _href + '&exam_id=' + id);
            });

            $(".mark_register_view").each(function () {
                var href = $(this).attr('href');
                $(this).attr('href', href.replace(/&?exam_id=\d+/, ''));
            });

            $(".mark_register_view").each(function () {
                var $this = $(this);
                var _href = $this.attr("href");
                $this.attr("href", _href + '&exam_id=' + id);
            });

            $(".mark_register_edit").each(function () {
                var href = $(this).attr('href');
                $(this).attr('href', href.replace(/&?exam_id=\d+/, ''));
            });

            $(".mark_register_edit").each(function () {
                var $this = $(this);
                var _href = $this.attr("href");
                $this.attr("href", _href + '&exam_id=' + id);
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


    jQuery(function ($) {
        $(".select_checkbox_unpaid").on('change', function (e) {
            var target = $(this).data('target'),
                current_checked = $(this).prop('checked');

            if (current_checked === true) {
                $(target).prop('checked', true).change();
            } else {
                $(target).prop('checked', false).change();
            }
        });
    });
    jQuery(function ($) {
        $(".select_checkbox_unpaid_other").on('change', function (e) {
            var target = $(this).data('target'),
                current_checked = $(this).prop('checked');

            if (current_checked === true) {
                $(target).prop('checked', true).change();
            } else {
                $(target).prop('checked', false).change();
            }
        });
    });

</script>

<script type="text/javascript">


    $(document).on('click', '.schedule_modal', function () {

        var exam_id = $(this).attr('data-examid')
        $(".exam_id").val("1")

    });


    $(document).on('click', '.schedule_modal', function () {
        // var exam_id     = $('.schedule_modal').data('examid');

        var exam_id = $(this).attr('data-examid')
        var section_id = $(this).data('sectionid');
        var class_id = $(this).data('classid');
        var classname = $(this).data('classname');
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
                $.each(response, function (i, obj) {

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
                new $.fn.dataTable.Buttons(dtable, {
                    buttons: [

                        {
                            extend: 'copyHtml5',
                            text: '<i class="fa fa-files-o"></i>',
                            titleAttr: 'Copy',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },

                        {
                            extend: 'excelHtml5',
                            text: '<i class="fa fa-file-excel-o"></i>',
                            titleAttr: 'Excel',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },

                        {
                            extend: 'csvHtml5',
                            text: '<i class="fa fa-file-text-o"></i>',
                            titleAttr: 'CSV',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },

                        {
                            extend: 'pdfHtml5',
                            text: '<i class="fa fa-file-pdf-o"></i>',
                            titleAttr: 'PDF',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },

                        {
                            extend: 'print',
                            text: '<i class="fa fa-print"></i>',
                            titleAttr: 'Print',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },


                        {
                            extend: 'colvis',
                            text: '<i class="fa fa-columns"></i>',
                            titleAttr: 'Columns',
                            postfixButtons: ['colvisRestore']
                        },


                    ]
                });

                dtable.buttons(0, null).container().prependTo(
                    dtable.table().container()
                );


            }
        });
    });

</script>


<script type="text/javascript">
    $(document).ready(function () {
        var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';
        $('#dob, #admission_date').datepicker({
            format: date_format,
            autoclose: true
        });
        $("#btnreset").click(function () {
            $("#form1")[0].reset();
        });
    });
</script>

<script type="text/javascript">
    var base_url = '<?php echo base_url() ?>';

    function printDiv(elem) {
        Popup(jQuery(elem).html());
    }

    function Popup(data) {

        var frame1 = $('<iframe />');
        frame1[0].name = "frame1";
        frame1.css({"position": "absolute", "top": "-1000000px"});
        $("body").append(frame1);
        var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
        frameDoc.document.open();
        //Create a new HTML document.
        frameDoc.document.write('<html>');
        frameDoc.document.write('<head>');
        frameDoc.document.write('<title></title>');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/bootstrap/css/bootstrap.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/font-awesome.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/ionicons.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/AdminLTE.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/dist/css/skins/_all-skins.min.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/iCheck/flat/blue.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/morris/morris.css">');


        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/jvectormap/jquery-jvectormap-1.2.2.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/datepicker/datepicker3.css">');
        frameDoc.document.write('<link rel="stylesheet" href="' + base_url + 'backend/plugins/daterangepicker/daterangepicker-bs3.css">');
        frameDoc.document.write('</head>');
        frameDoc.document.write('<body>');
        frameDoc.document.write(data);
        frameDoc.document.write('</body>');
        frameDoc.document.write('</html>');
        frameDoc.document.close();
        setTimeout(function () {
            window.frames["frame1"].focus();
            window.frames["frame1"].print();
            frame1.remove();
        }, 500);


        return true;
    }


    jQuery(function ($) {
        $(".select_checkbox").on('change', function (e) {
            var target = $(this).data('target'),
                current_checked = $(this).prop('checked');

            if (current_checked === true) {
                $(target).prop('checked', true).change();
            } else {
                $(target).prop('checked', false).change();
            }
        });


    });

    $(function ($) {
        $("#inputTeacherType").change(function () {
            var selectedValue = $(this).find('option:selected').text();
            selectedValue = selectedValue.toLowerCase();
            var teacherSalaryLabel = $("#inputTeacherSalaryLabel");

            // if permanent is selected
            if (selectedValue.search("permanent") >= 0) {
                teacherSalaryLabel.text("Monthly Salary");
            } else {
                teacherSalaryLabel.text("Per Lecture Payment");
            }

            $("#inputTeacherSalary").val("");
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
                <button type="button" class="btn btn-default"
                        data-dismiss="modal"><?php echo $this->lang->line('cancel'); ?></button>
            </div>
        </div>
    </div>
</div>