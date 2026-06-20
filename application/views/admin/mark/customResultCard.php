<div class="content-wrapper" style="min-height: 946px;">
    <!-- Main content -->
    <style>
        @media print {
            #printPageButton {
                display: none;
            }
        }
        @media print {
            /*@page  {*/
            /*    size: A4 !important;*/
            /*}*/
            .color {
                background-color: darkblue !important;
                -webkit-print-color-adjust: exact;
            }

            .color1 {
                background-color: darkred !important;
                -webkit-print-color-adjust: exact;
            }
        }

        .logo-center {
            margin: 0px 60px;
        }

        .left-result {

        }

        .topbar {
            margin: 10px;
        }

        .exam_name {
            font-size: 22px;
            font-weight: bold !important;
        }

        .student_name {
            font-size: 22px;
            font-weight: bold !important;
        }

        .admission_no {
            font-size: 16px;
            font-weight: bold !important;
        }

        .table-bordered {
            border: 2px solid #000 !important;
        }

        .table {
            margin-bottom: 10px !important;
        }

        .signature {
            margin: 28px 0px;
            border-top: 1px solid black;
        }

        .tbl_border {
            border: solid 1px black !important;
        }

        .table-condensed > tbody > tr > td, .table-condensed > tbody > tr > th, .table-condensed > tfoot > tr > td, .table-condensed > tfoot > tr > th, .table-condensed > thead > tr > td, .table-condensed > thead > tr > th {
            padding: 1px !important;
        }
        .row_padding{
            padding-left: 5px !important;
        }
        #printtable tr td{
            padding-left: 7px !important;
        }
        #printtable tr th{
            padding-left: 7px !important;
        }

        #printtable2 tr td{
            padding-left: 7px !important;
        }
        #printtable2 tr th{
            padding-left: 7px !important;
        }


    </style>
    <section class="content">

        <div class="col-xs-12">

            <button class="pull-right" id="printPageButton" onclick="window.print()"><i class="fa fa-print"></i>
            </button>

        </div>


        <div class="row">
            <div class="col-xs-10 col-sm-offset-3"
                 style="background-color: #fff; border:1px solid #000; width: 8.27in;height: 11.69in">
                <br>
                <div style="float: left;display: inline-block;">
                    <div class="left-result">
                        <b class="exam_name"><?= $exam['name'] ?></b>
                    </div>
                    <div class="left-result">

                        <b class="student_name"> <?php echo $examSchedule['firstname'] . " " . $examSchedule['lastname']; ?></b>
                    </div>
                    <div class="left-result">
                        <b class="admission_no"><?= admission_text(); ?>: <?= $examSchedule['admission_no'] ?></b>
                    </div>
                    <div class="left-result">
                        <b class="admission_no">Grade: <?= $class_sections['class']['class'] ?>
                            / <?= $class_sections['section']['section'] ?></b>
                    </div>
                    <div class="left-result">
                        <b class="admission_no">Faisalabad 2</b>
                    </div>


                </div>
                <div style="float: right;display: inline;">
                        <span>
                            <img src="<?= base_url("uploads/school_content/logo/{$school_logo}") ?>"
                                 title="<?= $school_name ?>" style="height:170px; width:170px;">
                        </span>
                </div>


                <div class="row">
                    <div class="col-xs-7" style="margin-top: 20px">
                        <table id="printtable" class="table table-bordered table-hover table-sm table-condensed">
                            <thead>
                            <tr style="font-size: 16px;">
                                <th class="tbl_border row_padding">Subject</th>
                                <th class="text-center tbl_border">Total</th>
                                <th class="text-center tbl_border">Obtained</th>
                                <th class="text-center tbl_border">%age</th>
                                <th class="text-center tbl_border">Grade</th>
                            </tr>
                            </thead>
                            <tbody style="font-size: 16px;">
                            <?php
                            $total_total = 0;
                            $total_get   = 0;
                            $total_per   = 0;
                            foreach ($examSchedule['exam_array'] as $key => $subjects) {
                                $per             = 0;
                                $subject_array[] = $subjects['exam_name'];
                                $total_total     += $subjects['full_marks'];
                                $total_get       += $subjects['get_marks'];

                                $per                = $subjects['get_marks'] * 100 / $subjects['full_marks'];
                                $percentage_array[] = $per;
                                $per                = number_format($per, 2, '.', '');

                                $total_per = ($total_get * 100) / $total_total;
                                ?>
                                <tr>
                                    <td class="tbl_border row_padding"><?= $subjects['exam_name'] ?></td>
                                    <td class="text-center tbl_border"><?= $subjects['full_marks'] ?></td>
                                    <td class="text-center tbl_border"><?= (float)round($subjects['get_marks']) ?></td>
                                    <td class="text-center tbl_border">
                                        <?= (float)round($per) . " %" ?>
                                    </td>
                                    <td class="text-center tbl_border">
                                        <?php
                                        foreach ($listgrade as $grade) {
                                            ?>
                                            <?php if ($per >= $grade['mark_from'] && $per <= $grade['mark_upto']): ?>
                                                <?php echo $grade['name'] ?>
                                            <?php endif ?>

                                            <?php
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                            <tr style="font-size: 18px;font-weight: 600;">
                                <td class="tbl_border row_padding" style="border-bottom: solid 2px black !important;">
                                    Total
                                </td>
                                <td class="text-center tbl_border" style="border-bottom: solid 2px black !important;">
                                    <?= $total_total ?>
                                </td>
                                <td class="text-center tbl_border" style="border-bottom: solid 2px black !important;">
                                    <?= $total_get ?>
                                </td>
                                <td class="text-center tbl_border" style="border-bottom: solid 2px black !important;">
                                    <?= (float)round($total_per) . " %" ?>
                                </td>
                                <td class="text-center tbl_border" style="border-bottom: solid 2px black !important;">
                                    <?php
                                    foreach ($listgrade as $grade) {
                                        ?>
                                        <?php if ($total_per >= $grade['mark_from'] && $total_per <= $grade['mark_upto']): ?>
                                            <?php echo $grade['name'] ?>
                                        <?php endif ?>

                                        <?php
                                    }
                                    ?>
                                </td>
                            </tr>

                            <tr>
                                <?php
                                $i           = 0;
                                $occurrences = array_count_values($total_get);
                                $total_get   = array_unique($total_get);
                                foreach ($total_get as $grade) {
                                    if ($grade == end($total_get)) $i += $occurrences[$grade] - 1;
                                    echo str_repeat('<tr><td>' . $grade . ': ' . ($i + 1) . '</td></tr>', $occurrences[$grade]);
                                    $i += $occurrences[$grade];
                                }
                                ?>
                            </tr>


                            </tbody>
                        </table>
                        <div class="text-center"><b>EXCELLENT, KEEP IT UP.</b></div>
                    </div>

                    <div class="col-xs-5"></div>
                </div>

                <div class="row" style="margin-top: 40px">
                    <div class="col-xs-7" style="display: inline-block;">
                        <table id="printtable2" class="table table-bordered table-sm table-hover table-condensed"
                               >
                            <thead>
                            <th style="width: 70%" class="tbl_border row_padding">Descripton</th>
                            <th style="width: 30%" class="tbl_border">Rank</th>

                            </thead>
                            <tbody>

                            <?php foreach ($ranking as $rank) { ?>
                                <tr>
                                    <td class="tbl_border row_padding"> <?= $rank['name'] ?></td>
                                    <td class="tbl_border"></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                        <div class="text-center">
                            <div class="signature" style=" width: 250px;display: inline-block;">
                                <h5>Class Teacher</h5>
                            </div>
                        </div>


                    </div>
                    <div class="col-xs-5" style="display: inline-block;">
                        <canvas id="bar-chart-<?= $examSchedule['student_id'] ?>" width="800" height="800"></canvas>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-7 text-center">
                        <div class="signature" style=" width: 250px;display: inline-block;">
                            <h5>Senior Teacher</h5>
                        </div>
                    </div>

                    <div class="col-xs-5 text-center">
                        <div class="signature" style="width: 250px;display: inline-block;">
                            <h5>Principal Signature</h5>
                        </div>
                    </div>
                </div>


                <div style="display: inline-block;     margin-left: 85px;">
                    Grade Key
                </div>


                <div style="margin: 10px 56px;">

                    <?php foreach ($listgrade as $grade) {
                        ?>
                        <h5 style="display: inline-block;margin-left: 10px;"> <?= $grade['name'] ?>
                            <span><?= $grade['mark_from'] ?></span>
                            to <span><?= $grade['mark_upto'] ?></span></h5>
                        <?php

                    } ?>


                </div>

                <div class="row">
                    <div class="col-xs-6">
                        <div style="width:100%; height:40px; display: inline-block;">

                            <div class="color" style=" height:20px; background-color:darkblue;">

                            </div>

                            <div class="color1" style=" height:20px;background-color:darkred;">

                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div>
                            <h5>Headoffice: 58-I/B-I, Peco Road, Township, Lahore
                                <br>
                                Batala Colony Branch 0300-0854854
                            </h5>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12" style="">

                        <?= date('M-d-Y', now()) ?>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- /.content -->
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>


<script>
    $(document).ready(function () {

        <?php
        $js_array = json_encode($subject_array);
        $js_array_per = json_encode($percentage_array);


        ?>
        var subject =   <?=  $js_array ?>;
        var percentage = <?= $js_array_per ?>;

        console.log(subject);

        new Chart(document.getElementById("bar-chart-<?= $examSchedule['student_id']?>"), {
            type: 'bar',
            data: {
                labels: subject,
                datasets: [
                    {
                        label: "Marks Percentage",
                        backgroundColor: ["#3e95cd", "#8e5ea2", "#3cba9f", "#e8c3b9", "#c45850", "#f10000", "#ffe400", "#3c9c69", "#008000", "#000080", "#D84315"],
                        data: percentage
                    }
                ]
            },

            options: {
                legend: {display: false},
                title: {
                    display: true,
                    text: ''
                },
                scales: {
                    yAxes: [{
                        display: true,
                        ticks: {
                            beginAtZero: true,
                            steps: 20,
                            stepValue: 20,
                            max: 100
                        }
                    }],
                    xAxes: [{
                        ticks: {
                            autoSkip: false,
                        }
                    }]

                },
            },

        });
    });
</script>

