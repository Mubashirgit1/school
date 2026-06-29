<style type="text/css">
    .voucher_head {
        font-size: 16px;
        font-weight: bold;
    }

    .padding_lr_0 {
        padding-left: 0px;
        padding-right: 0px;
    }

    .voucher_head_information {
        border-right: 0px !important;
        border-top: 2px solid #ddd !important;
        border-bottom: 2px solid #ddd !important;
        background: #ddd;
        font-size: 16px;
        font-weight: bold !important;
    }

    .voucher_content_information {
        border-right: 0px !important;
        border-top: 0px !important;
        border-bottom: 1px solid #ddd;
        border-left: 0px !important;
    }

    .amount {
        text-align: right;
    }

    .table {
        margin-bottom: 15px;
    }
</style>
<?php

$adminsess = $this->session->userdata('admin');
$this->load->helper('menu_helper');
$permission = admin_permission($adminsess['id']);

?>
<div class="fee_voucher_container">
    <div class="hidden-print text-center">
        <button class="btn btn-default" onclick="location.href = document.referrer; return false;">Back</button>
        <button class="btn btn-primary" onclick="window.print()">Print</button>
    </div>

    <?php if (empty($fee_vouchers)): ?>
        <p class="text-center text-danger">No voucher found with provided IDs.</p>
    <?php else: ?>
        <?php foreach ($fee_vouchers as $fee_voucher): ?>
            <?php if ($fee_voucher['arrears'] > 0 || $fee_voucher['total_fee'] > 0): ?>
                <div class="fee_voucher_part_container page_break_after" style="margin-bottom: 40px;">
                    <?php
                    if ($bankcopy == 0) {
                        $count = 2;
                    } else {
                        $count = 3;
                    }
                    ?>
                    <?php for ($i = 0; $i < $count; $i++): ?>
                        <div class="fee_voucher_part " style="border:1px solid #848383">
                            <div class="row voucher_header" style=" margin-left: -8px; margin-top: 2px;">
                                <table>
                                    <tr>
                                        <td style="width:25%" class="text-center">
                                            <div class="fee_voucher_logo">
                                                <img src="<?= base_url($school_logo) ?>"
                                                     title="<?= $school_name ?>">
                                            </div>
                                        </td>
                                        <td>

                                            <div class="fee_voucher_heading voucher_head"
                                                 style="margin-left: 10px;    margin-right: 22px;">
                                                <?= $school_name."<br>"."<small style='font-weight: normal;'>".$school_address."</small>"; ?>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
<!--                                <div class="col-md-3" style="padding-right: 0px;">-->
<!---->
<!--                                </div>-->
<!--                                <div class="col-md-9">-->
<!---->
<!--                                </div>-->
                            </div>

                            <?php if (!empty($bank_account_top)) { ?>
                                <div class="row " style="margin-top: 10px">
                                    <table>
                                        <tr>
                                            <td style="width:25%" class="text-center">
                                            </td>
                                            <td>
                                                <div class="fee_voucher_heading"
                                                     style="margin-bottom:0px; font-size:14px;     margin-left: -5px;margin-top: -10px;">
                                                    <?= $bank_name ?><br>
                                                    <?= $bank_account_top ?>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>

                            <?php } ?>
                            <div class="fee_voucher_body">
                                <div class="fee_voucher_body_heading">
                                    <div class="voucher_head_information">
                                        <?php
                                        switch ($i) {
                                            case 0:
                                                echo 'Student';
                                                break;
                                            case 1:
                                                echo 'Office';
                                                break;
                                            case 2:
                                                echo 'Bank';
                                                break;
                                        }
                                        echo ' Copy';
                                        ?>
                                    </div>
                                </div>

                                <div class="fee_voucher_student_details">
                                    <table class="table">
                                        <thead>
                                        <?php if (empty($fee_voucher['due_date'])) { ?>
                                            <tr class="voucher_head_information">
                                                <td>Voucher No.</td>
                                                <td><?= $fee_voucher['id'] ?></td>
                                            </tr>
                                        <?php } else { ?>
                                            <tr class="voucher_head_information">
                                                <td width="27%">Voucher No.</td>
                                                <td width="23%"><?= $vrno ?></td>
                                            </tr>
                                            <?php
                                            if ($permission->due_date == 1) { ?>
                                                <tr>
                                                    <td>Due Date</td>
                                                    <td>  <?php

                                                        if (!empty($fee_voucher['due_date_optional']) && substr($fee_voucher['due_date_optional'], 0, 4) !== '0000') {
                                                            ?>
                                                            <?= date('d-M-y', strtotime($fee_voucher['due_date_optional'])); ?>
                                                        <?php } else {
                                                            ?>
                                                            <?= date('d-M-y', strtotime($fee_voucher['due_date'])); ?>
                                                        <?php } ?></td>
                                                </tr>
                                                <?php
                                            }
                                            if ($permission->expiry_date == 1) { ?>
                                                <tr>
                                                    <?php if ($fee_voucher['other'] == 0) {
                                                        $expire = date("Y-m-t", now()); ?>
                                                        <td>Expiry Date</td>
                                                        <td><?= date("t-M-y", strtotime($fee_voucher['expire_date'])) ?></td>
                                                    <?php } ?>
                                                </tr>
                                            <?php } ?>
                                        <?php } ?>
                                        <tr>
                                            <td>Issuance Date</td>
                                            <td><?= date('d-M-Y', strtotime($fee_voucher['created_at'])) ?></td>
                                        </tr>
                                        <?php if (!empty($fee_voucher['month_names']) && $fee_voucher['month_names'] != 'null'): ?>
                                            <tr>
                                                <td>Fee Month(s)</td>
                                                <?php $month_na = implode(', ', json_decode($fee_voucher['month_names'], true));
                                                if ($fee_voucher['advance'] > 0) {
                                                    $month_na = str_replace('May,', '', $month_na);
                                                } ?>
                                                <td><?= $month_na ?></td>
                                            </tr>
                                        <?php endif; ?>

                                        </thead>
                                    </table>
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <td colspan="2" class="voucher_head_information"><b>Student Information</b>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="50%">Student Name</td>
                                            <td width="50%"><?= $fee_voucher['student']['firstname'] . ' ' . $fee_voucher['student']['lastname'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Father's name</td>
                                            <td><?= $fee_voucher['student']['father_name'] ?></td>
                                        </tr>
                                        <!-- <tr>
                                            <td>Father's Phone</td>
                                            <td>< ?= $fee_voucher['student']['father_phone'] ?></td>
                                        </tr> -->
                                        <?php if ($permission->admission_roll == 0) { ?>
                                            <tr>
                                                <td><?= admission_text() ?></td>
                                                <td><?= $fee_voucher['student']['admission_no'] ?></td>
                                            </tr>
                                        <?php } ?>
                                        <tr>
                                            <td>Roll No.</td>
                                            <td><?= $fee_voucher['student']['roll_no'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Class (Section)</td>
                                            <td><?= $fee_voucher['student']['class'] ?>
                                                (<?= $fee_voucher['student']['section'] ?>)
                                            </td>
                                        </tr>


                                        </tbody>
                                    </table>
                                </div>
                                <div class="fee_voucher_fee_details">
                                    <?php $other_total = 0; ?>
                                    <?php if ($permission->voucher_details == 1) { ?>
                                        <table class="table">
                                            <thead>
                                            <tr class="voucher_head_information">
                                                <?php if ($permission->combine_fee == 1 && $fee_voucher['other'] == 1) { ?>
                                                    <td width="50%">Other Fee Detail</td>
                                                <?php } else { ?>
                                                    <td width="50%">Tuition Fee Detail</td>

                                                <?php } ?>
                                                <td width="50%" class="amount">Amount</td>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            <?php


                                            if ($fee_voucher['other'] == 1) {

                                                foreach ($fee_voucher['voucher_fee_types'] as $voucher_fee_type):

                                                    ?>

                                                    <tr>
                                                        <td><?= $voucher_fee_type['name'] ?></td>
                                                        <td class="amount"> <?= number_format($voucher_fee_type['amount'], 0, '', ',') ?></td>
                                                    </tr>
                                                <?php endforeach;
                                            } ?>




                                            <?php if ($fee_voucher['advance'] > 0) { ?>
                                                <tr>

                                                    <?php $dates_name = [];
                                                    $data             = json_decode($fee_voucher['month_names'], TRUE);

                                                    foreach ($data as $dat) {
                                                        $date         = date_parse($dat);
                                                        $dates_name[] = date("M", mktime(0, 0, 0, $date['month'], 10));
                                                    }
                                                    $short_month = implode('/', $dates_name);
                                                    $d           = date('M');

                                                    if (count($data) > 1 && $fee_voucher['monthly_fee'] == 0) {
                                                        $month_na = $short_month;
                                                    } else {
                                                        if ($dates_name[0] != $d) {
                                                            $month_na = str_replace('/' . $d, '', $short_month);
                                                        } else {
                                                            $month_na = str_replace($d . '/', '', $short_month);
                                                        }
                                                    }
                                                    ?>
                                                    <td><?= $month_na ?> Fee</td>
                                                    <td class="amount"> <?= number_format($fee_voucher['advance'], 0, '', ',') ?></td>
                                                </tr>
                                                <?php
                                            }
                                            if ($fee_voucher['monthly_fee'] > 0): ?>
                                                <tr>
                                                    <td><?= date('M') ?> Fee</td>
                                                    <td class="amount"> <?= number_format($fee_voucher['monthly_fee'], 0, '', ',') ?></td>
                                                </tr>
                                            <?php endif ?>

                                            <?php

                                            if ($permission->fine_arrears == 0) { ?>
                                                <?php if ($fee_voucher['arrears'] > 0): ?>
                                                    <tr>
                                                        <td>Fee &nbspArrears</td>
                                                        <td class="amount"> <?= number_format($fee_voucher['arrears'], 0, '', ',') ?></td>
                                                    </tr>


                                                <?php endif ?>


                                                <?php $student_fine = 0; ?>


                                                <?php if ($student_fee_fine_type == 'per_day_fine_after_due_date') {
                                                    $date1                   = date_create($fee_voucher['due_date']);
                                                    $date2                   = date_create(date("Y-m-d"));
                                                    $diff                    = date_diff($date1, $date2);
                                                    $total_per_day_fine_days = $diff->days - 1;
                                                    $fine_days_calculation   = $total_per_day_fine_days * $fine_per_day_for_fee;
                                                    $previous_fine_per_day   = $fee_voucher['student']['late_payment_fee'] - $fine_days_calculation;
                                                    if ($previous_fine_per_day > 0) {
                                                        $student_fine = $previous_fine_per_day;
                                                    }

                                                    ?>


                                                <?php } else {
                                                    if ($fee_voucher['fine'] >= $fine_per_day_for_fee) {
                                                        if (strtotime($fee_voucher['created_at']) > strtotime($fee_voucher['due_date'])) {
                                                            $student_fine = $fee_voucher['fine'] - $fine_per_day_for_fee;
                                                        } else {
                                                            $student_fine = $fee_voucher['fine'];
                                                        }
                                                    }

                                                }
                                                if ($student_fine > 0): ?>
                                                    <tr>
                                                        <td>Fine Arrears</td>
                                                        <td class="amount"> <?= number_format($student_fine, 0, '', ',') ?></td>
                                                    </tr>
                                                <?php endif;
                                            } else {
                                                ?>
                                                <?php
                                                $student_fine = 0;
                                                if ($fee_voucher['fine'] >= $fine_per_day_for_fee) {
                                                    $monthyear = date("Y-m");
                                                    $due_date  = date("Y-m", strtotime($fee_voucher['due_date']));
                                                    if (strtotime($due_date) == strtotime($monthyear)) {
                                                        $student_fine = $fee_voucher['fine'] - $fine_per_day_for_fee;
                                                    } else {
                                                        $student_fine = $fee_voucher['fine'];
                                                    }
                                                }


                                                $arrears = $fee_voucher['arrears'] + $student_fine;

                                                ?>

                                                <?php if ($arrears > 0): ?>
                                                    <tr>
                                                        <td>Fee &nbspArrears</td>
                                                        <td class="amount"> <?= number_format($arrears, 0, '', ',') ?></td>
                                                    </tr>
                                                <?php endif ?>
                                            <?php } ?>
                                            <tr>
                                                <td>Total</td>
                                                <td class="amount"> <?= number_format($fee_voucher['total_fee'] + $fee_voucher['arrears'] + $student_fine) ?></td>
                                            </tr>

                                            <?php if ($permission->combine_fee == 1 && $fee_voucher['other'] == 0 && !empty($fee_voucher['other_voucher'])) { ?>
                                                <tr class="voucher_head_information">
                                                    <td width="50%">Other Fee Detail</td>
                                                    <td width="50%"></td>
                                                </tr>
                                                <?php
                                                $other_total = 0;
                                                if ($permission->combine_fee == 1 && $fee_voucher['other'] == 0) {
                                                    foreach ($fee_voucher['other_voucher'] as $other_voucher): ?>
                                                        </tr>
                                                        <?php foreach ($other_voucher['voucher_fee_types'] as $other_voucher_heads): ?>
                                                            <tr>
                                                                <td><?= date('M', strtotime($other_voucher['due_date'])) ?> <?= $other_voucher_heads['name'] ?></td>
                                                                <td class="amount"> <?= number_format($other_voucher_heads['amount'], 0, '', ',') ?></td>
                                                                <?php $other_total += $other_voucher_heads['amount']; ?>
                                                            </tr>
                                                        <?php
                                                        endforeach;

                                                    endforeach;
                                                } ?>
                                                <tr>
                                                    <td>Total</td>
                                                    <td class="amount"> <?= number_format($other_total) ?></td>
                                                </tr>
                                            <?php } ?>

                                            </tbody>
                                            <tr class="voucher_head_information">
                                                <td width="50%">Grand Total</td>
                                                <td width="50%" class="amount"></td>
                                            </tr>

                                            <?php
                                            $voucher_total_fee = $fee_voucher['total_fee'];
                                            if ($permission->vr_reprint_fee == 1) {
                                                $voucher_total_fee = $fee_voucher['total_fee'] + $reprint_fee;
                                                ?>
                                                <tr>
                                                    <td>Reprint Voucher Fee</td>
                                                    <td class="amount"> <?= $reprint_fee ?> </td>
                                                </tr>
                                            <?php } ?>

                                            <?php if ($voucher_total_fee != 0): ?>
                                                <tfoot>

                                                <tr>
                                                    <td>Total (Before due date)</td>
                                                    <td class="amount"> <?= number_format($voucher_total_fee + $fee_voucher['arrears'] + $student_fine + $other_total) ?></td>
                                                </tr>
                                                <?php if ($permission->vr_due_fine == 1) { ?>
                                                    <?php if ($student_fee_fine_type == 'per_day_fine_after_due_date'): ?>

                                                        <?php
                                                        if ($fee_voucher['other'] == 1) {
                                                            if ($permission->other_voucher_fine == 1) { ?>
                                                                <tr>
                                                                    <td>Fine ( <?= $fine_per_day_for_fee ?> Rs/Day)
                                                                    </td>
                                                                    <td class="amount"></td>
                                                                </tr>
                                                            <?php }

                                                        } else {
                                                            ?>
                                                            <tr>
                                                                <td>Fine ( <?= $fine_per_day_for_fee ?> Rs/Day)
                                                                </td>
                                                                <td class="amount"></td>
                                                            </tr>
                                                        <?php } endif; ?>


                                                    <?php
                                                    if ($fee_voucher['other'] == 1) {
                                                        if ($permission->other_voucher_fine == 1) { ?>

                                                            <tr class="voucher_content_information">
                                                                <td>Total (After due date)</td>
                                                                <?php if ($student_fee_fine_type != 'per_day_fine_after_due_date'): ?>
                                                                    <td class="amount"> <?= number_format($fee_voucher['total_fee'] + $fee_voucher['arrears'] + $student_fine + $fine_per_day_for_fee + $other_total) ?></td>
                                                                <?php else: ?>
                                                                    <td class="amount"></td>
                                                                <?php endif; ?>
                                                            </tr>
                                                        <?php }
                                                    } else { ?>

                                                        <tr class="voucher_content_information">
                                                            <td>Total (After due date)</td>
                                                            <?php if ($student_fee_fine_type != 'per_day_fine_after_due_date'): ?>
                                                                <td class="amount"> <?= number_format($fee_voucher['total_fee'] + $fee_voucher['arrears'] + $student_fine + $fine_per_day_for_fee + $other_total) ?></td>
                                                            <?php else: ?>
                                                                <td class="amount"></td>
                                                            <?php endif; ?>
                                                        </tr>

                                                    <?php } ?>


                                                <?php } ?>
                                                </tfoot>
                                            <?php endif ?>
                                        </table>
                                    <?php } ?>
                                    <?php if ($fee_voucher['total_fee'] != 0): ?>
                                        <?php if (!empty($fee_voucher['due_date'] && $student_fee_fine_type == 'per_day_fine_after_due_date')): ?>
                                            <!-- <div class="small" style="opacity: 0.8; text-align:center">
                                            Fine of  <?= $fine_per_day_for_fee ?><?= ($student_fee_fine_type == 'per_day_fine_after_due_date' ? '/day' : '') ?> will be added to the tuition fee after <?= date('d-M-Y', strtotime($fee_voucher['due_date'])) ?>.
                                        </div> -->
                                        <?php endif; ?>
                                    <?php endif ?>

                                    <div class="text-center small voucher_content_information">
                                        <?php
                                        if ($fee_voucher['other'] == 1) {
                                            echo $bank_account_other;
                                        } else {
                                            echo $bank_account;
                                        }
                                        ?>
                                    </div>
                                    <div class="text-center small">
                                        Powered by School Suite Erp<br>

                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endfor; ?>

                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
