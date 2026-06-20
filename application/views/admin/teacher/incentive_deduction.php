<style type="text/css">
    .outlined {
        border: 1px solid #CBCBC9;
    }
</style>
<?php
$admind = $this->session->userdata('admin');
$this->load->helper('menu_helper');
$permission = admin_permission($admind['id']);
?>
<div class="content-wrapper" style="min-height: 946px;">
    <?php $this->load->view('layout/teacher_link'); ?>
    <div class="box box-primary" style="margin-bottom: 0px;">
        <div class="box-header with-border" style="padding: 20px;">
            <section class="content-header">
                <div class="row">
                    <div class="col-md-3">
                        <h4 class="pull-left">
                            <?= $title; ?>

                        </h4>
                    </div>


                    <form method="get" role="form" action="<?= site_url('admin/teacher/incentive') ?>">
                        <div class="col-md-2 col-sm-offset-4">
                            <label>Date from</label>
                            <input type="text" name="date_from" id="date_from" class="form-control date"
                                   value="<?= $date_from ?>" readonly>
                        </div>

                        <div class="col-md-2">
                            <label>Date to</label>
                            <input type="text" name="date_to" id="date_to" class="form-control date"
                                   value="<?= $date_to ?>" readonly>
                        </div>

                        <div class="col-sm-1">
                            <label style="display: block;">&nbsp </label>
                            <button type="submit" name="search" value="search_filter" class="btn btn-primary btn-sm">
                                <i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?>
                            </button>
                        </div>

                    </form>

                </div>
                <div class="clearfix"></div>
            </section>
        </div>
    </div>
    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <?php
                $this->general_library->err_msg();
                ?>

                <div class="box box-primary" id="tachelist">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix">Incentive Heads Paid</h3>
                    </div>
                    <br>

                    <div class="box-body">
                        <div class="mailbox-controls">
                        </div>

                        <div class="table-responsive mailbox-messages">

                            <form method="post" action="<?= site_url('admin/teacher/attendance_process') ?>">
                                <table class="table group_table    table-bordered table-hover example">


                                    <thead>
                                    <tr>
                                        <th><?php echo 'Staff Name'; ?></th>
                                        <th><?php echo 'Designation'; ?></th>


                                        <?php foreach ($incentives as $inc) { ?>

                                            <th class="text-center"><?= $inc['name'] ?></th>

                                        <?php } ?>
                                        <th class="text-center">Total</th>

                                        <th class="text-center">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $total_incen = 0;
                                    foreach ($teacherlist as $teacher) {

                                        ?>
                                        <tr>

                                            <td class="mailbox-name"> <?php echo $teacher['name'] ?></td>
                                            <td class="mailbox-name"> <?php echo $teacher['designation'] ?></td>


                                            <?php


                                            $total_incentive = 0;
                                            foreach ($teacher['current_month_last_payment'] as $payment) {


                                                ?>
                                                <?php $total1 = 0;
                                                foreach ($payment as $inc) {
                                                    $total1 += $inc['amount']; ?>
                                                <?php } ?>
                                                <?php $total_incentive += $total1 ?>
                                                <td class="mailbox-name text-center">
                                                    <?= number_format($total1) ?>
                                                </td>
                                            <?php } ?>

                                            <td class="text-center">
                                                <?php $total_incen += $total_incentive ?>
                                                <?= number_format($total_incentive) ?></td>
                                            <td class="text-center">
                                                <?php if ($permission->account_ts == 1) { ?>

                                                    <a href="<?= site_url("admin/teacher/salary_payment/{$teacher['id']}") . "?redirect_back=" . urlencode($redirect) ?>"
                                                       class="btn btn-default btn-xs"><i class="fa fa-money"></i></a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php
                                        $count++;
                                    }

                                    ?>
                                    </tbody>

                                    <tfoot>
                                    <tr>


                                        <?php foreach ($incentives as $inc) { ?>

                                            <td class="text-center"></td>

                                        <?php } ?>

                                        <td></td>
                                        <td class="text-center"><span style="float:left">Total</span><span
                                                    style="margin-left:-30px"><?= number_format($total_incen) ?></span>
                                        </td>

                                    </tr>


                                    </tfoot>
                                </table>


                            </form>
                        </div>
                    </div>
                </div>
                <div class="box box-primary" id="tachelist">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"> Deduction Heads Paid</h3>
                    </div>
                    <br>

                    <div class="box-body">
                        <div class="mailbox-controls">
                        </div>

                        <div class="table-responsive mailbox-messages">

                            <form method="post" action="<?= site_url('admin/teacher/attendance_process') ?>">
                                <table class="table  group_table   table-bordered table-hover example2">


                                    <thead>
                                    <tr>
                                        <th><?php echo 'Staff Name'; ?></th>
                                        <th><?php echo 'Designation'; ?></th>


                                        <?php foreach ($deductions as $deduc) { ?>
                                            <th class="text-center"><?= $deduc['name'] ?></th>

                                        <?php } ?>
                                        <th class="text-center">Total</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php


                                    //
                                    // 	echo "<pre>";
                                    // print_r($teacherlist);
                                    //   echo "</pre>";
                                    //			exit;
                                    $total_deduct = 0;
                                    foreach ($teacherlist2 as $teacher) {

                                        ?>
                                        <tr>

                                            <td class="mailbox-name "> <?php echo $teacher['name'] ?></td>
                                            <td class="mailbox-name "> <?php echo $teacher['designation'] ?></td>


                                            <?php

                                            $total_deduction = 0;
                                            foreach ($teacher['current_month_last_payment'] as $payment) {

                                                ?>
                                                <?php
                                                $total1 = 0;

                                                foreach ($payment as $inc) {

                                                    $total1 += $inc['amount'];

                                                    ?>
                                                <?php }
                                                $total_deduction += $total1;

                                                ?>

                                                <td class="mailbox-name text-center">
                                                    <?= number_format($total1) ?>
                                                </td>
                                            <?php } ?>

                                            <td class="text-center">
                                                <?php $total_deduct += $total_deduction ?>

                                                <?= number_format($total_deduction) ?></td>
                                            <td class="text-center">
                                                <?php if ($permission->account_ts == 1) { ?>

                                                    <a href="<?= site_url("admin/teacher/salary_payment/{$teacher['id']}") . "?redirect_back=" . urlencode($redirect) ?>"
                                                       class="btn btn-default btn-xs"><i class="fa fa-money"></i></a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <?php
                                        $count++;
                                    }

                                    ?>
                                    </tbody>

                                    <tfoot>
                                    <tr align="right">
                                        <td></td>

                                        <?php foreach ($deductions as $inc) { ?>

                                            <td class="text-center"></td>

                                        <?php } ?>


                                        <td class="text-center"><span style="float:left">Total</span><span
                                                    style="margin-left:-30px"><?= number_format($total_deduct) ?></span>
                                        </td>


                                    </tr>
                                    </tfoot>
                                </table>

                                <input type="hidden" name="attendance_for" value="<?= $attendance_date ?>">

                            </form>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </section>
</div>

<script type="text/javascript">
    var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';

    $(document).ready(function () {
        $(".date").datepicker({
            format: date_format,
            autoclose: true,
            todayHighlight: true
        });
    });


</script>

<script>
    $(document).ready(function () {
        $('.group_table').DataTable({
            destroy: true,
            order: [[1, 'asc']],
            rowGroup: {
                dataSrc: [1]
            },
            columnDefs: [{
                targets: [1],
                visible: false
            }]
        });
    });
</script>