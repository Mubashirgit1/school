<style type="text/css">
    .voucher_head{
        font-size: 16px;
        font-weight: bold;
    }
    
    .padding_lr_0{
        padding-left: 0px;
        padding-right: 0px;
    }
    .voucher_head_information{
        border-right: 0px !important;
        border-top: 2px solid #ddd !important;
        border-bottom: 2px solid #ddd !important;
        border-left: : 0px;
        font-size: 16px;
        font-weight: bold !important;
    }
    .voucher_content_information{
        border-right: 0px !important;
        border-top: 0px !important;
        border-bottom: 1px solid #ddd;
        border-left: : 0px !important;
    }
</style>
<div class="print_fee_payment_receipt">

    <div class="hidden-print text-center">
        <button class="btn btn-default" onclick="window.close()">Close</button>
        <button class="btn btn-primary" onclick="window.print()">Print</button>
    </div>

    <div class="print_fee_payment_receipt_head">
        <div class="row voucher_header">
            <table>
                <tr>
                    <td width="30%" class="text-center">
                        <div class="fee_voucher_logo">
                            <img src="<?= base_url( "{$school_logo}" ) ?>" title="<?= $school_name ?>" alt="logo">
                        </div>
                    </td>
                    <td>
                        <h3 class="text-center">Fee Payment Receipt</h3>
                    </td>
                </tr>
            </table>
            <div class="col-md-3" style="padding-right: 0px;">
                
            </div>
            <div class="col-md-9">
                
            </div>
        </div>

        <div class="print_fee_payment_receipt_inner">
            <table class="table">
                <thead>
                    <tr class="voucher_head_information">
                        <td width="50%">Date</td>
                        <td width="50%"><?= date('d-M-Y', strtotime($student_fee_payment['payment_date'])) ?></td>
                    </tr>
                </thead>
            </table>
        </div>
        
        <table class="table">
            <tbody>
                <tr>
                    <td colspan="2" class="voucher_head_information"><b>Student Information</b></td>
                </tr>
                <tr>
                    <td width="50%">Student Name</td>
                    <td width="50%"><?= $student_fee_payment['student']['firstname'] . ' ' . $student_fee_payment['student']['lastname'] ?></td>
                </tr>
                <tr>
                    <td>Father's name</td>
                    <td><?= $student_fee_payment['student']['father_name'] ?></td>
                </tr>
                <tr>
                    <td><?= admission_text() ?>.</td>
                    <td><?= $student_fee_payment['student']['admission_no'] ?></td>
                </tr>
                <tr>
                    <td>Roll No.</td>
                    <td><?= $student_fee_payment['student']['roll_no'] ?></td>
                </tr>
                <tr>
                    <td>Class (Section)</td>
                    <td><?= $student_fee_payment['student']['class'] ?> (<?= $student_fee_payment['student']['section'] ?>)</td>
                </tr>

            </tbody>
        </table>
    </div>

    <div class="print_fee_payment_receipt_table">
        <table class="table">
            <thead>
                <tr class="voucher_head_information">
                    <td width="50%">Fee Detail</td>
                    <td width="50%">Amount</td>
                </tr>
            </thead>
            <tbody>
                <?php
                if ( !empty( $student_fee_payment['student_fee_payments_other'] ) ):
                    foreach ( $student_fee_payment['student_fee_payments_other'] as $value ):
                        if ($value['amount'] > 0) {
                        ?>
                        <tr>
                            <td><?= $value['fee_name'] ?></td>
                            <td><?= $value['amount'] ?></td>
                        </tr>
                    <?php
                        }
                    endforeach;
                endif;
                ?>
                <tr>
                    <td>Tuition Fee</td>
                    <td><?= $student_fee_payment['tuition_fee'] ?></td>
                </tr>
            </tbody>
            <tfoot class="voucher_head_information">
                <tr>
                    <th>Total</th>
                    <th><?= $student_fee_payment['total_paid_fee'] ?></th>
                </tr>
                <tr>
                    <th>Left Arrears</th>
                    <th><?= $student_fee_payment['due_fee'] - $student_fee_payment['tuition_fee'] ?></th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
