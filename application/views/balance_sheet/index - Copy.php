<style type="text/css">
    
    .error
    {
        color:red;
        font-family:verdana, Helvetica;
    }
    .tooltip{
    }
    .caret {
        border-left: 6px solid transparent;
        border-right: 6px solid transparent;
        border-top: 6px solid #7C7B7B;
    }
    .width_for_balance_sheet_table {
        width: 90px;
    }

</style>


<?php $admind = $this->session->userdata( 'admin' );
$this->load->helper('menu_helper');

$permission = admin_permission($admind['id']);
?>
<div class="content-wrapper"  style="background-color:#f5f5f5 !important">
    <?php if ( !empty( $expense_head ) ): ?>
        <section class="content" style="min-height: 0px;">
            <?php
            if ( $this->session->flashdata( 'expense_err' ) ):
                echo "<div><div class='alert alert-danger' style='display: inline-block;'>" . $this->session->flashdata( 'expense_err' ) . "</div></div>";
            endif;
            if ( $this->session->flashdata( 'expense_msg' ) ):
                echo "<div><div class='alert alert-success' style='display: inline-block;'>" . $this->session->flashdata( 'expense_msg' ) . "</div></div>";
            endif;
            ?>
            <div class="table-responsive" style=" border-radius:4px; background-color:#ffffff !important; box-shadow: 0px 2px 0px 0px #d6d6d6; font-size:11px; color:#666666">
                <table class="table table-bordered" style="margin-bottom: 0; border-top: 0px solid #484848;">
                    <tbody>
                    <tr>
                        <td>
                            <div class="input-group">
                                <span class="input-group-addon" class="btn btn-primary" data-toggle="tooltip"  style="background-color:white; padding:0px 9px">
                                <?php if($permission->voucher_generation == 1){?>
                                <a href="<?= site_url( 'fee_management/fee_voucher' ) ?>">
                                <?php }else{?>
                                <a href="<?= site_url( 'fee_management/fee_voucher' ) ?>">
                                <?php }?>
                                
                                <i style="color:#666666" class="glyphicon glyphicon-qrcode"></i> </a></span>
                                <input type="hidden" class="student_search" name="search"  value="search_full">
                                <input type="hidden" class="student_redirect" name="redirect" value="<?= urlencode( current_url() ) ?>">
                                <input type="hidden" class="voucher_redirect" name="redirect" value="<?= urlencode( current_url() ) ?>">
                                <?php if($permission->vr_search == 1){?>
                                <input type="text" style="border-radius:4px;" class="form-control voucher_id balance_sheet_input_submit" name="voucher_id" value="" placeholder="Type voucher ID" data-url="<?= site_url( 'fee_management/fee_voucher_receive' ) ?>" data-values=".voucher_redirect, .voucher_id">
                                <?php }else{?>
                                <input type="text" style="border-radius:4px;" class="form-control voucher_id balance_sheet_input_submit" name="voucher_id" value="" placeholder="Type voucher ID" data-url="" data-values=".voucher_redirect, .voucher_id">
                                <?php }?>
                                
                            </div>
                        </td>
                        
                        <td>
                            <div class="input-group">
                                <span class="input-group-addon" class="btn btn-primary" style="background-color:white; padding:0px 9px"><i style="color:#666666; font-size:18px" class="fa fa-list-alt"></i> </span>
                                <input type="text" style="border-radius:4px;" id="student_account"  class="form-control search_text balance_sheet_input_submit" name="search_text" value="" placeholder="Search Student A/c" data-url="<?= site_url( 'fee_management/student_account' ) ?>" data-values=".search_text">
                            </div>
                        </td>
                        <?php if ( !empty( $expense_head ) ): ?>
                            <td>
                                    <form action="<?= site_url( 'admin/expense' ) ?>" method="get" id="expence_heads">
                                        <input type="hidden" name="redirect" value="<?= current_url() ?>">
                                        <input type="hidden" name="admin" value="<?= $admind['username'] ?>">
                                        <div class="input-group" style="margin-bottom: 3px; ">
                                            <span class="input-group-addon" class="btn btn-primary" name="add" style="background-color:white; padding:0px 9px">
                                            <?php if($permission->expense == 1){   ?>
                                            <a href="<?= site_url( 'admin/expensehead' ) ?>">
                                            <?php }?>
                                            <i style="color:#666666; font-size:18px" class="fa fa-list-alt"></i> </a></span>
                                            <select class="form-control" name="exp_head_id" style="color:#666666; border-radius:4px; " >
                                                <?php foreach ( $expense_head as $ex_head ): ?>
                                                    <option value="<?= $ex_head['id'] ?>"><?= $ex_head['exp_category'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <?php if($permission->expense_u == 1){   ?>
                                        <div class="form-group">
                                        <div class="col-sm-6" style="padding:0px">
                                        <input type="number"  class="form-control on_enter_submit" style=" border-radius:4px;" name="amount_expense" placeholder="Amount">
                                        </div>

                                        <div class="col-sm-6" style="padding:0px"   >
                                            <input type="text" class="form-control on_enter_submit" style=" border-radius:4px; " name="name" placeholder="Details">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="date" class="form-control on_enter_submit date" value="<?= date('m/d/Y', now())?>" >
                                        </div>
                                        <?php }?>
                            </td>
                        <?php endif; ?>

                        <?php if ( !empty( $inventory_heads ) ): ?>
                            <td >
                                <div class="input-group" >
                                    <span class="input-group-addon" class="btn btn-primary" style="background-color:ffffff; padding:0px 9px"><a href="<?= site_url( 'admin/inventory' ) ?>"><i style="color:#666666; font-size:18px" class="fa fa-list-alt"></i> </a></span>
                                    <form action="<?= site_url( 'admin/inventoryItems/index' ) ?>" method="get" id="inventoryInputForm">
                                        <input type="hidden" name="redirect" value="<?= current_url() ?>">

                                        <div class="form-group" style="margin-bottom: 0px; ">
                                            <select class="form-control" name="inv_head_id" data-target-form="#inventoryInputForm" style="border-radius:4px;">
                                                <?php foreach ( $inventory_heads as $inventory_head ): ?>
                                                    <option style="color:#666666" value="<?= $inventory_head['id'] ?>"><?= $inventory_head['inventory_title'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                </div>
                                <div class="form-group">
                                <div class="col-sm-4" style="padding:0px">
                                    <input type="text"  class="form-control on_enter_submit" style=" border-radius:3px; float: left;" name="description" placeholder="Details">
                                    </div>
                                    <div class="col-sm-4" style="padding:0px">
                                    <input type="number"  class="form-control on_enter_submit" style=" float: left; border-radius:3px;" name="amount" data-target-form="#inventoryInputForm" placeholder="Amount" required>
                                    </div>
                                    <div class="col-sm-4" style="padding:0px">
                                    <input type="number"  class="form-control on_enter_submit" style=" float: left; border-radius:3px;" name="quantity" data-target-form="#inventoryInputForm" placeholder="Quantity..." required>
                                    </div>
                                    <div class="clearfix"></div>
                                    </form>
                                </div>
                            </td>
                        <?php endif; ?>

                        <td>
                            <div class="input-group">

                                <span class="input-group-addon" class="btn btn-primary" style="background-color:#ffffff; padding:0px 9px"><i style="color:#666666" class="glyphicon glyphicon-check"></i> </span>
                                <input type="hidden" class="bulk_student_attendance_redirect" name="redirect" value="<?= urlencode( current_url() ) ?>">
                                <input style="border-radius:4px;" type="text" class="form-control bulk_student_admission_numbers balance_sheet_input_submit" name="bulk_student_admission_numbers" value="" placeholder="Multi Attendance" data-url="<?= site_url( 'admin/stuattendence/bulk_student_attendance' ) ?>" data-values=".bulk_student_attendance_redirect, .bulk_student_admission_numbers">
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </section>
    <?php else: ?>
        <h4 class="text-center text-danger">No expense heads added!</h4>
    <?php endif; ?>
    <!--header close-->
<?php if($permission->attendance_balance_sheet == 1){ ?>
    <section class="content-header" style="padding-top: 0px;">
        <div class="box box-primary" style="margin-bottom: 0px; background-color:#ffffff; border-top-width: 0px; font-size:13px;color:#666666;">
            <div class="row">


                <div class="col-xs-4 text-left">
                    <h3 class="box-title" style="margin-top: 10px;padding-left: 10px;">
                        <div class="dropdown">
                            <h4 class="box-title text-left" style="cursor:pointer;font-size: 13px;  color:#666666;">
                                <!-- <img style="max-width: 56px" src="<?php echo base_url(); ?>backend/images/student2.png" alt="view"/> -->
                                <a href="<?= site_url( 'admin/stuattendence' ) ?>" style="color:#666666;"><i class="fas fa-user-graduate" style="font-size:17px"></i> &nbsp; </a>
                                <?php
                                $total_p = 0;
                                $total_l = 0;
                                $total_a = 0;
                                foreach ( $class_sections as $class_section ):
                                    $total_p  += $class_section['attendance_cus']['p'];
                                    $total_l  += $class_section['attendance_cus']['l'];
                                    $total_a  += $class_section['attendance_cus']['a'];
                                endforeach;
                                ?>
                                <span style="font-size: 13px;">
                                    (

                                    <span>

                                            <a href="<?= site_url( 'admin/stuattendence/classattendencereport' ) ?>" class="" style="color:#666666">             </a>
                                        </span>
                                       <span>

                                            <a href="<?= site_url( 'admin/stuattendence/classattendencereport' ) ?>" class="" style="color:#666666">
                                            <?php $total_student =  $total_p +$total_a + $total_l;  ?>
                                               Total : <?= $total_student ?>
                                            </a>
                                        </span> /
                                        <span>
                                            <a href="<?= site_url( 'admin/stuattendence/classattendencereport' ) ?>" class="text-success">
                                               Present : <?= $total_p ?>
                                            </a>
                                        </span> /
                                        <span>
                                            <a href="<?= site_url( 'student/total_absent_report' ) ?>" class="" style="color:#DD0003">
                                             Absent : <?= $total_a  ?>
                                            </a>
                                        </span> /
                                        <span>
                                            <a href="<?= site_url( 'student/total_leave_report' ) ?>" class="text-blue">
                                              Leave : <?= $total_l ?>
                                            </a>
                                        </span>
                                    )
                                </span>
                            </h4>
                        </div>
                    </h3>
                </div>
                <div class="col-xs-4">
                    <h3 class="box-title" style="margin-top: 10px;">
                        <div class="dropdown">
                            <h4 class="box-title text-left" style="cursor:pointer;">

                                &nbsp;&nbsp;
                                <a href="<?= site_url( 'admin/teacher/attendance' ) ?>" style="color:#666666;">
                                    <i class="fas fa-user-tie" style="font-size:16px"></i>
                                </a>
                                &nbsp;
                                <a href="<?= site_url( 'admin/teacher/attendance_report' ) ?>" style="color:#666666;">
                                <span style="font-size: 13px;">
                                (
                                   Total : <?= $total_teachers?>
                                    <?php
                                    $total_leave = 0;
                                    $total_present = 0;
                                    $total_absent = 0;
                                    $total_late = 0;
                                    foreach ( $sum_teacher_attendance as $key=>$sta_item ):
                                        if($sta_item['name'] == 'leave'){

                                            $total_leave = $sta_item['cnt'];

                                        }
                                        if($sta_item['name'] == 'present'){

                                            $total_present = $sta_item['cnt'];

                                        }
                                        if($sta_item['name'] == 'absent'){

                                            $total_absent = $sta_item['cnt'];

                                        }
                                        if($sta_item['name'] == 'half'){

                                            $total_late = $sta_item['cnt'];

                                        }
                                        ?>

                                        <?php /*?><span <?= $sta_item['name'] == 'absent'?'class="text-danger"':'class="text-success"' ?> ><?= $sta_item['cnt'] ?></span> <?php */?>

                                    <?php endforeach; ?>
                                      / <span class="text-success">Present : <?= $total_present ?> </span>/ <span style="color:#DD0003;"> Absent : <?= $total_absent ?> </span> /  <span class="text-blue">Leave : <?= $total_leave ?></span> /<span class="text-blue"> Late : <?= $total_late ?> </span>

                                )
                                </span>
                                </a>
                            </h4>
                        </div>
                        <div class="clearfix"></div>
                </div>

                <div class="col-xs-4 text-right">
                    <h3 class="box-title" style="padding-right: 25px;margin-top: 10px;">
                        <div class="dropdown">
                            <h4 class="box-title text-right" style="cursor:pointer;">
                                &nbsp; &nbsp
                                <a href="<?= site_url( 'admin/staff/attendance' ) ?>" style="color:#666666;">
                                    <i class="fas fa-user-tag " style="font-size:16px"></i>
                                </a>
                                &nbsp;
                                <a href="<?= site_url( 'admin/staff/attendance_report' ) ?>" style="color:#666666;">
                                <span style="font-size: 13px;">
                                (  Total : <?= $total_staff ?> /
                                <?php
                                $present_s = 'present';
                                $leave_s = 'leave';
                                $absent_s = 'absent';
                                $late_s = 'half';
                                $satff_present =  array_count_values(array_column($sum_staff_attendance, 'attendance'))[$present_s]; // outputs: 2
                                if($satff_present==null){$satff_present =0;}else{$satff_present=$satff_present;}
                                $satff_leave = array_count_values(array_column($sum_staff_attendance, 'attendance'))[$leave_s];
                                if($satff_leave==null){$satff_leave =0;}else{$satff_leave=$satff_leave;}
                                $satff_absent = array_count_values(array_column($sum_staff_attendance, 'attendance'))[$absent_s];
                                if($satff_absent==null){$satff_absent =0;}else{$satff_absent=$satff_absent;}
                                $satff_late = array_count_values(array_column($sum_staff_attendance, 'attendance'))[$late_s];
                                if($satff_late==null){$satff_late =0;}else{$satff_late=$satff_late;}
                                ?>
                   <span class="text-success">Present :   <?=$satff_present ?> </span>/ <span style="color:#DD0003;"> Absent : <?=$satff_absent ?> </span> /  <span class="text-blue">Leave : <?=$satff_leave?> </span> /<span class="text-blue"> Late :  <?=$satff_late ?>  </span>  )
                                </span>
                                </a>
                        </div>
                        <div class="clearfix"></div>
                </div>
                <?php
                $total1 = new stdClass();
               // $total1->remaining_fee = 0;
              ///  $total1->fee           = 0;
               // $total1->fee_paid      = 0;
                $total1->fine          = 0;
                $total1->arrears       = 0;
                $a = 0;
                foreach ( $students_pending_fee as $key=>$value ):
                   // $total1->fee += intval( $value['student_class_fee_after_discount'] );
                   // $total1->remaining_fee +=   intval( $value['student_class_fee_after_discount'] ) -  intval( $value['fee_arrears'] ) ;
                   // $total1->fee_paid += ( !empty( $value['last_payment_record'] ? intval( $value['last_payment_record']['total_paid_fee'] ) : 0 ) );
                    $total1->fine    +=  $value['late_payment_fee'];
                    $a =   $value['fee_arrears'] -$value['student_class_fee_after_discount']  - $value['late_payment_fee'];
                    if($a > 0){
                        $total1->arrears +=  $value['fee_arrears'] -$value['student_class_fee_after_discount']  - $value['late_payment_fee'];
                    }
                    endforeach;
                  
                    ?>
               

            </div>
    </section>
<?php } ?>

    <!-- Main content balance sheet -->
    <section class="content" style="padding-bottom:0px;">
        <div class="row">
            <div class="col-md-12">
                <!-- Horizontal Form -->
                <div class="box box-primary" style="border-top-width: 0px; background-color:#ffffff; margin-bottom:0px;">
                    <div class="box-header with-border">
                        <div class="row">
                            <div class="col-sm-2">
                                <h4   style="display: inline-block; margin-top: 0px;font-size: 13px;  color:#666666;">Balance Sheet </h4>
                            </div>
                            <div class="col-sm-4">
                                <div class="caret" data-toggle="collapse" data-target="#demo" style="font-size:20px; float:right" ></div>
                            </div>
                            <div class="col-sm-6">
                                <form style="display: inline-block; float: right;" action="<?= current_url() ?>" method="get" class="form-inline">
                                    <div class="form-group">
                                        <select name="month" style="color:#666666;"  class="form-control">
                                            <?php for ( $i = 1; $i <= 12; $i++ ): ?>
                                                <option value="<?= $i ?>" <?= set_select( 'month', $i, ( $month == $i ) ) ?>><?= date( 'F', mktime( 0, 0, 0, $i, 1 ) ) ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select name="year" class="form-control">
                                            <?php for ( $y = intval( date( 'Y', now() ) ); $y >= intval( date( 'Y', now() ) ) - 10; $y-- ): ?>
                                                <option value="<?= $y ?>" <?php set_select( 'year', $y, ( $y == $year ) ) ?>><?= $y ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm">Filter</button>
                                </form>
                            </div>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <?php if ( $class_sections === false ): ?>
                                <h3 class="text-danger text-center">No data found!</h3>
                            <?php else: ?>
                                <div class="table-responsive">
                                    <table class="table     table-bordered example balance_sheet_table"  style="color:#666666;">                    <thead>
                                        <tr>

                                                <th></th>
                                            <?php
                                            if ($permission->student_balance_sheet == 1) {
                                                ?>
                                                <th class="text-center">
                                                    <a style="color:#666666;" class="table_link"
                                                       href="<?= site_url('student/new_students') . "?date_from=" . urlencode("$month/01/{$year}") . "&date_to=" . urlencode("{$month}/" . cal_days_in_month(CAL_GREGORIAN, $month, $year) . "/{$year}") ?>">
                                                        <?= $total['new_admission']."<span style='color:red'>/".$total['struck_off']."</span>" ?>
                                                    </a>
                                                </th>

                                                <th class="text-center">
                                                    <a style="color:#666666;" class="table_link"
                                                       href="<?= site_url('student/free_students') . "?date_from=" . urlencode("$month/01/{$year}") . "&date_to=" . urlencode("{$month}/" . cal_days_in_month(CAL_GREGORIAN, $month, $year) . "/{$year}") ?>">
                                                        <?= $total['free'] . "/" . $student_logs_total['free'] ?>
                                                    </a>
                                                </th>
                                                <th class="text-center"><?= $total['without_fee'] ?></th>
                                                <!--                                            <th class="text-center"  >-->
                                                <!--                                                <a style="color:#666666;" class="table_link" href="--><?//= site_url( 'student/struck_off' ). "?date_from=" . urlencode( "$month/01/{$year}" ) . "&date_to=" . urlencode( "{$month}/" . cal_days_in_month( CAL_GREGORIAN, $month, $year ) . "/{$year}" ) ?><!--">--><?//= $total_struckoff ?><!--</a></th>-->

                                                <th class="text-center"> <a style="color:#666666; class=" class="table_link"  href="<?= site_url('student/all_students') . "?gender=" ?>">
                                                <?= $total['total_students']  ?> </a>
                                                </th>

                                                <?php } ?>
                                            <?php if ($permission->balancesheet_figures == 1) {  ?>
<!--    /////////////////////////total FEE/////////////////-->
                                                <th class="width_for_balance_sheet_table text-center"><?= number_format( $total['discount'] + $total['receiveable_total_fee'] ) ?></th>
<!--       ////////////////////// discount/////////////-->
                                                <th class="width_for_balance_sheet_table text-center"><?= number_format( $total['discount'] ) ?></th>
<!--   ////////////////////////  After Discount////////////////////-->
                                                <th class="text-center"> <?= number_format($total['receiveable_total_fee'])?></th>
<!--        //////////////////advance Adjusted //////////////////////-->
                                                <th class="width_for_balance_sheet_table text-center">    <a style="color:#666666;" class="table_link" href="<?= site_url( 'student/search?fee_status=undue' ) ?>"> <?= number_format($total['advance_adjusted_fee']) ?> </a> </th>
<!--     //////////////////////Total monthly DUE /////////////////////////////-->
                                                <?php $total_monthly_due = $total['receiveable_total_fee'] - $total['advance_adjusted_fee'] ?>
                                                <th class="width_for_balance_sheet_table text-center"> <?=  number_format( $total_monthly_due   ) ?></th>
<!--     //////////////////////Total monthly Paid /////////////////////////////-->
                                                <th class="width_for_balance_sheet_table text-center">
                                                    <a style="color:#666666;" href="<?= site_url( "fee_management/fee_reports?class_id=&section_id=&date_from=" . urlencode( "$month/01/{$year}" ) . "&date_to=" . urlencode( "{$month}/" . cal_days_in_month( CAL_GREGORIAN, $month, $year ) . "/{$year}" ) . "&search=search_filter" ) ?>" class="table_link">
                                                        <?php echo number_format( $total['total_paid_fee1'] ); ?>
                                                    </a>
                                                </th>
 <!--     //////////////////////Total monthly Waive /////////////////////////////-->
                                                <th class="text-center">
                                                     <a style="color:#666666;" href="<?= site_url( "fee_management/fee_reports_fee_waive?class_id=&section_id=&date_from=" . urlencode( "$month/01/{$year}" ) . "&date_to=" . urlencode( "{$month}/" . cal_days_in_month( CAL_GREGORIAN, $month, $year ) . "/{$year}" ) . "&search=search_filter" ) ?>" class="table_link">
                                                        <?= number_format( intval($total['total_waive_fee']) ); ?>
                                                    </a>
                                                </th>
<!--     //////////////////////Total monthly Withdrawl /////////////////////////////-->
                                                <th class="text-center">
                                                    <a style="color:#666666;" href="<?= site_url( 'student/struck_off' ). "?date_from=" . urlencode( "$month/01/{$year}" ) . "&date_to=" . urlencode( "{$month}/" . cal_days_in_month( CAL_GREGORIAN, $month, $year ) . "/{$year}" ) ?>" class="table_link">
                                                        <?= number_format( intval($total['student_withdrawl']) ); ?>
                                                    </a>
                                                </th>
 <!--     //////////////////////left monthly Due /////////////////////////////-->
                                                <th class="width_for_balance_sheet_table text-center">
                                                    <a style="color:#666666;" class="table_link" href="<?= site_url( 'student/search?fee_status=due' ) ?>">
                                                        <?php $due_current = $total_monthly_due - $total['total_paid_fee1'] - $total['student_withdrawl'] -$total['total_waive_fee'];
                                                        echo number_format(  $total['total_due_fee'] ); ?>
                                                    </a>
                                                </th>
 <!--     //////////////////////Total Fine /////////////////////////////-->
                                                <th class="text-center">
                                                    <?= number_format($total1->fine) ?>
                                                </th>
 <!--     //////////////////////Total Arrears /////////////////////////////-->
                                                <th class="width_for_balance_sheet_table text-center">
                                                    <a style="color:#666666;" class="table_link" href="<?= site_url( 'fee_management/pending_fee_report' ) ?>">
                                                        <?php  echo(  $total1->arrears  >= 0 ? number_format(  $total1->arrears ) : 0 ); ?>
                                                    </a>
                                                </th>
 <!--     //////////////////////Total Advance FEE /////////////////////////////-->
                                                <th class="width_for_balance_sheet_table text-center">
                                                    <a  style="color:#666666;" class="table_link" href="<?= site_url( 'student/search?fee_status=advance' ) ?>">
                                                        <?= number_format($total['class_section_advance_fee']) ?>
                                                    </a>
                                                </th>
 <!--     //////////////////////Total Other Due Fee /////////////////////////////-->
                                                <th class="width_for_balance_sheet_table text-center">
                                                    <a style="color:#666666;" class="table_link" href="<?= site_url( "fee_management/other_fee_report?date_from=" . urlencode( "$month/01/{$year}" ) . "&date_to=" . urlencode( "{$month}/" . cal_days_in_month( CAL_GREGORIAN, $month, $year ) . "/{$year}" ) . "&search_type=pending&search=search_filter" ) ?>>">
                                                        <?= number_format(  $unpaid_students_other ) ?>
                                                    </a>
                                                </th>   
 <!--     //////////////////////Total Other Paid Fee /////////////////////////////-->
                                                <th class="width_for_balance_sheet_table text-center">
                                                    <a style="color:#666666;" class="table_link" href="<?= site_url( "fee_management/other_fee_report?date_from=" . urlencode( "$month/01/{$year}" ) . "&date_to=" . urlencode( "{$month}/" . cal_days_in_month( CAL_GREGORIAN, $month, $year ) . "/{$year}" ) . "&search_type=paid&search=search_filter" ) ?>">
                                                        <?= number_format( $total['total_other_fee'] ) ?>
                                                    </a>
                                                </th>
 <!--     ////////////////////// Grand  Total /////////////////////////////-->
                                                <th class="width_for_balance_sheet_table text-center">
                                                    <a style="color:#666666;" href="<?= site_url( "fee_management/fee_reports?class_id=&section_id=&date_from=" . urlencode( "$month/01/{$year}" ) . "&date_to=" . urlencode( "{$month}/" . cal_days_in_month( CAL_GREGORIAN, $month, $year ) . "/{$year}" ) . "&search=search_filter" ) ?>" class="table_link">
                                                       <?php   $grand_total = floatval( $total['total_other_fee'] ) + floatval( $total['total_paid_arrears11']) + floatval( $total['total_paid_fee1'] + floatval($total['total_advance11'] )    )?>
                                                            <?= number_format(  $grand_total  != null ? $grand_total: 0 ) ?>
                                                    </a>
                                                </th>
                                                <?php } ?>
                                        </tr>
                                        <tr>
                                            <th class="text-left">Class/Section</th>
                                            <?php  if ($permission->student_balance_sheet == 1) { ?>
                                            <th class="text-center"><?= date('M',now()) ?> New/All</th>
                                            <th class="text-center"> <?= date('M',now()) ?> Free/All</th>
                                            <th class="text-center"> <?= date('M',now()) ?> W/O Fee</th>
                                            <th class="text-center">Active Students</th>
                                            <?php }
                                            if ($permission->balancesheet_figures == 1){ ?>
                                                <th class="width_for_balance_sheet_table text-center">Total Fee</th>
                                                <th class="width_for_balance_sheet_table text-center">Discount</th>
                                                <th class="width_for_balance_sheet_table text-center">Disc Fee</th>
                                                <th class="width_for_balance_sheet_table text-center"><?= date('M',now()) ?> Adv/Adj Fee</th>
                                                <th class="width_for_balance_sheet_table text-center"><?= date('M',now()) ?> Total Due</th>
                                                <th class="width_for_balance_sheet_table text-center"> <?= date('M',now()) ?> Due Paid</th>
                                                <th class="text-center">Fee Waived</th>
                                                <th class="text-center">Fee Withdrawn</th>
                                                <th class="width_for_balance_sheet_table text-center"><?= date('M',now()) ?> Due</th>
                                                <th class="width_for_balance_sheet_table text-center">Fine</th>
                                                <th class="width_for_balance_sheet_table text-center">Arrears</th>
                                                <th class="width_for_balance_sheet_table text-center">Advance</th>
                                                <th class="width_for_balance_sheet_table text-center">Others Due Fee</th>
                                                <th class="width_for_balance_sheet_table text-center">Others Paid</th>
                                                <th class="width_for_balance_sheet_table text-center">Grand Total</th>
                                            <?php } ?>
                                        </tr>
                                        </thead>
                                        <tbody  id="demo" class="collapse">

                                        <?php foreach ( $class_sections as $class_section ): ?>
                                            <tr>
                                                <td class="text-left">
                                                    <div class="dropdown">
                                                        <?= $class_section['class']['class'] . '/' . $class_section['section']['section'] ?>
                                                    </div>
                                                </td>
                                                <?php   if ($permission->student_balance_sheet == 1) { ?>
                                                <td class="text-center">
                                                    <a style="color:#666666;" class="table_link" href="<?= site_url( 'student/new_students' ) . "?date_from=" . urlencode( "{$month}/01/{$year}" ) . "&date_to=" . urlencode( "{$month}/" . cal_days_in_month( CAL_GREGORIAN, $month, $year ) . "/{$year}" ) . "&class_id={$class_section['class_id']}&section_id={$class_section['section_id']}" ?>">
                                                        <?= $class_section['student_logs']['new_admission'] ?>
                                                    </a>
                                                </td>

                                                <td class="text-center">
                                                    <a style="color:#666666;" class="table_link" href="<?= site_url( 'student/free_students' ) . "?date_from=" . urlencode( "{$month}/01/{$year}" ) . "&date_to=" . urlencode( "{$month}/" . cal_days_in_month( CAL_GREGORIAN, $month, $year ) . "/{$year}" ) . "&class_id={$class_section['class_id']}&section_id={$class_section['section_id']}" ?>">
                                                        <?= $class_section['student_logs']['free'] ?>
                                                    </a>
                                                </td>

                                                <td class="text-center"><?= $class_section['student_logs']['without_fee'] ?></td>
<!--                                                <td class="text-center">-->
<!--                                                    --><?php
//                                                    $stds_struck_of = 0;
//                                                    foreach ($total_struckoff_s as $tsoff) {
//                                                        if (intval($class_section['class_id']) == intval($tsoff['class_id']) && intval($class_section['section_id']) == intval($tsoff['section_id'] )) {
//                                                            $stds_struck_of = $tsoff['class_stds'];
//                                                        }
//                                                    }
//                                                    ?>
<!--                                                    <a style="color:#666666;"  class="table_link" href="--><?//= site_url( 'student/struck_off' ) . "?date_from=" . urlencode( "{$month}/01/{$year}" ) . "&date_to=" . urlencode( "{$month}/" . cal_days_in_month( CAL_GREGORIAN, $month, $year ) . "/{$year}" ) . "&class_id={$class_section['class_id']}&section_id={$class_section['section_id']}" ?><!--">-->
<!--                                                        --><?//= $stds_struck_of ?>
<!--                                                    </a>-->
<!--                                                </td>-->
                                                <td class="text-center">
                                                    <a style="color:#666666;" class="table_link" href="<?= site_url( 'student/all_students' ) . "?class_id={$class_section['class_id']}&section_id={$class_section['section_id']}" ?>">
                                                        <?= ( $class_section['class_section_monthly_log'] !== false ? $class_section['class_section_monthly_log'][0]['total_students'] : 0 ) ?>
                                                    </a>
                                                </td>
                                                <?php }
                                                if ($permission->balancesheet_figures == 1) { ?>
 <!--  //////////////////////Total FEE///////////////////////////   -->
                                                    
                                                    <td class="text-center">
                                                        <?php $total_fee_class  = $class_section['class_section_monthly_log'][0]['receiveable_total_fee'] + $class_section['class_section_monthly_log'][0]['discount'];
                                                        echo ( $total_fee_class !== false ? number_format( $total_fee_class ) : 0 ) ; ?>
                                                    </td>

 <!-- ////////////////////// Discount///////////////////////////////-->
                                                    
                                                    <td class="width_for_balance_sheet_table text-center" >
                                                        <?= ( $class_section['class_section_monthly_log'] !== false ? number_format( $class_section['class_section_monthly_log'][0]['discount'] ) : 0 ) ?>
                                                    </td>

 <!--   //////////////////// After Discount////////////////////-->
                                                    
                                                    <td class="text-center">
                                                        <?php echo $class_section['class_section_monthly_log'][0]['receiveable_total_fee']  ?>
                                                    </td>

 <!--      //////////////////Advance Adjusted //////////////////////-->
                                                    
                                                    <td class="text-center">
                                                        <?= ( $class_section['class_section_monthly_log'] !== false ? number_format( $class_section['class_section_monthly_log'][0]['advance_adjusted_fee'] ) : 0 ) ?>
                                                    </td>

<!--      //////////////////Monthly Due Fee//////////////////////-->

                                                    <td class="width_for_balance_sheet_table text-center" >
                                                        <?php $total_monthly_due_class  =  $class_section['class_section_monthly_log'][0]['receiveable_total_fee'] - $class_section['class_section_monthly_log'][0]['advance_adjusted_fee'];
                                                        echo  ( $total_monthly_due_class !== false ? number_format( $total_monthly_due_class ) : 0 ); ?>
                                                    </td>

 <!--      //////////////////Monthly Paid Fee//////////////////////-->
                                                    
                                                    <td class="width_for_balance_sheet_table text-center" >
                                                        <?= $class_section['class_section_monthly_log'][0]['total_paid_fee1']  ?>
                                                    </td>

<!--      //////////////////Monthly waive Fee//////////////////////-->
                                                    
                                                    <td class="width_for_balance_sheet_table text-center" >
                                                        <?= $class_section['class_section_monthly_log'][0]['total_waive_fee']?>
                                                    </td>

 <!--      //////////////////Monthly withdrawl Fee//////////////////////-->
                                                    
                                                    <td class="width_for_balance_sheet_table text-center" >
                                                        <?= $class_section['class_section_monthly_log'][0]['student_withdrawl']?>
                                                    </td>

  <!--      //////////////////Monthly Due Fee//////////////////////-->

                                                    <td class="width_for_balance_sheet_table text-center" >
                                                        <a style="color:#666666;" href="<?= site_url( 'student/search' ) . "?class_id={$class_section['class_id']}&section_id={$class_section['section_id']}&fee_status=due" ?>" class="table_link">
                                                         <?php $total_monthly_due_class = $total_monthly_due_class - $class_section['class_section_monthly_log'][0]['total_paid_fee1']- $class_section['class_section_monthly_log'][0]['total_waive_fee'] - $class_section['class_section_monthly_log'][0]['student_withdrawl']?>
                                                            <?= $class_section['class_section_monthly_log'][0]['total_due_fee'] ?>
                                                        </a>
                                                    </td>

<!--      //////////////////Monthly Fine Fee//////////////////////-->

                                                    <td class="text-center">
                                                        <?php $class_fine_var = 0;
                                                        foreach ($total_class_students as $tfkey => $tf) {
                                                            if (intval($class_section['class_id']) == intval($tf['class_id']) && intval($class_section['section_id']) == intval($tf['section_id'] )) {
                                                                $class_fine_var = $tf['class_fine'];
                                                            }
                                                        }
                                                        echo $class_fine_var; ?>
                                                    </td>

  <!--      //////////////////Monthly arrears Fee//////////////////////-->
                                                    <td class="width_for_balance_sheet_table text-center" >
                                                        <a style="color:#666666;" class="table_link" href="<?= site_url( 'fee_management/pending_fee_report?class_id=' . $class_section['class_id'] . '&section_id=' . $class_section['section_id'] ) ?>">
                                                            <?php $monthly_section_arrears = number_format( $class_section['class_section_monthly_log'][0]['class_section_fee_arrears'] - $class_section['class_section_monthly_log'][0]['total_due_fee'] - $class_fine_var );
                                                            echo $monthly_section_arrears; ?>
                                                        </a>
                                                    </td>
<!--      //////////////////Monthly advance Fee//////////////////////-->
                                                    <td class="width_for_balance_sheet_table text-center" >
                                                        <a style="color:#666666;" href="<?= site_url( 'student/search' ) . "?class_id={$class_section['class_id']}&section_id={$class_section['section_id']}&fee_status=advance" ?>" class="table_link">
                                                            <?= ( $class_section['total_advance1'] !== false ? number_format( $class_section['class_section_monthly_log'][0]['total_advance1'] ) : 0 ) ?>
                                                        </a>
                                                    </td>
 <!--      //////////////////others due Fee//////////////////////-->
                                                    <td class="width_for_balance_sheet_table text-center" >
                                                        0
                                                    </td>
 <!--      //////////////////others due Fee Paid//////////////////////-->
                                                    <td class="width_for_balance_sheet_table text-center">
                                                        <a style="color:#666666;" class="table_link" href="<?= site_url( "fee_management/other_fee_report?class_id={$class_section['class_id']}&section_id={$class_section['section_id']}&other_fee_types=&date_from=" . urlencode( "$month/01/{$year}" ) . "&date_to=" . urlencode( "{$month}/" . cal_days_in_month( CAL_GREGORIAN, $month, $year ) . "/{$year}" ) . "&search_type=paid&search=search_filter" ) ?>">
                                                            <?= ( $class_section['class_section_monthly_log'] !== false ? number_format( $class_section['class_section_monthly_log'][0]['total_other_fee'] ) : 0 ) ?>
                                                        </a>
                                                    </td>
  <!--      ////////////////// Grand Total//////////////////////-->
                                                    <td class="width_for_balance_sheet_table text-center">

                                                    <?php $grand_total  = $class_section['class_section_monthly_log'][0]['total_advance1'] + $class_section['class_section_monthly_log'][0]['total_paid_fee1'] + $class_section['class_section_monthly_log'][0]['total_other_fee'] + $class_section['class_section_monthly_log'][0]['total_paid_arrears1']  ?>
                                                       <?= $grand_total ?>
                                                        <!-- < ?= number_format( ( $class_section['class_section_monthly_log'] !== false ? floatval( $class_section['class_section_monthly_log'][0]['total_other_fee'] ) : 0 ) +
                                                            ( $class_section['class_section_monthly_log'] !== false ? floatval( $class_section['class_section_monthly_log'][0]['total_paid_fee1'] ) : 0 )
                                                            +( $class_section['class_section_monthly_log'] !== false ? floatval( $class_section['class_section_monthly_log'][0]['total_advance1'] ) : 0 )
                                                        +  $total['total_paid_arrears1'] ) ?> -->
                                                    </td>
                                                    <?php
                                                }
                                                ?>

                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>

                                    </table>
                                </div>
                            <?php endif; ?>

                        </div>

                    </div>
                </div>
            </div>
    </section>
    <!-- Main content balance sheet close -->

    <?php if ($permission->delete_fee == 1) {	?>

        <section class="content" >
            <div class="row">

                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="box box-primary" style="border-top-width: 0px; background-color:#ffffff">
                        <div class="box-header with-border">


                            <div class="col-sm-4">
                                <h4   style="display: inline-block; margin-top: 0px;font-size: 13px;  color:#666666;">    Balance Sheet Summary</h4>
                            </div>
                            <div class="col-sm-2">

                                <div class="caret" data-toggle="collapse" data-target="#demo2" style="font-size:20px; float:right" ></div>

                            </div>
                            <div class="col-sm-4 col-sm-offset-2">
                                <form style="display: inline-block; float: right;" action="<?= current_url() ?>" method="get" class="form-inline">

                                    <div class="form-group">
                                        <select name="month" style="color:#666666;"  class="form-control">

                                            <?php for ( $i = 1; $i <= 12; $i++ ): ?>

                                                <option value="<?= $i ?>" <?= set_select( 'month', $i, ( $month == $i ) ) ?>><?= date( 'F', mktime( 0, 0, 0, $i, 1 ) ) ?></option>
                                            <?php endfor; ?>

                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <select name="year" class="form-control">
                                            <?php for ( $y = intval( date( 'Y', now() ) ); $y >= intval( date( 'Y', now() ) ) - 10; $y-- ): ?>
                                                <option value="<?= $y ?>" <?php set_select( 'year', $y, ( $y == $year ) ) ?>><?= $y ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm">Filter</button>
                                </form>
                            </div>

                        </div>
                        <div id="demo2" >
                            <div class="row">
                                <div class="col-xs-12 col-sm-5" style="width: 47%">
                                    <div class="box box-primary" style="margin:0px 0px 0px 7px">
                                        <h4 class="text-center" style="font-size:14px;">Revenue</h4>
                                        <div class="box-body">
                                            <div class="row">
                                                <div class="col-sm-3" style="margin-top:13px; padding:9px 10px 0px 10px; width: 19%">
                                                    <h4 class="text-center" style="font-size:12px;"> </h4>
                                                    <div class="table-responsive">
                                                        <table class="table     table-bordered table-hover " cellspacing="0" width="100%">                          <thead>
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <td colspan="2" class="text-left"><?= date('M')?> Fee</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2" class="text-left">Arrears </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2" class="text-left">Fine </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2" class="text-left">Other fee </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2" class="text-left">New Advance</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2" class="text-left" > Total </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2" style="width:14%; padding:0px; ">
                                                    <h4 class="text-center" style="font-size:12px; ">Fee Receivable</h4>
                                                    <div class="table-responsive">
                                                    <?php  $total_withdrawlarrears = $total['withdrawl_arrears']  ?>
                                                    <?php   $total_others_paid = $total['total_other_fee'] - $total['total_fine1']; ?>
                                                        <table class="table     table-bordered table-hover " cellspacing="0" width="100%">
                                                            <thead>
                                                            
                                                            </thead>
                                                            <tbody style="border:1px solid #C7C6C6">
                                                            <tr>
                                                                <?php  $total_paid_show = $total['receiveable_total_fee'] - $total['advance_adjusted_fee'];  ?>
                                                                <td class="text-center"><?= number_format( $total_paid_show ) ?></td>
                                                            </tr>
                                                            <tr>
                                                                <?php  $total_arrears_show = $total1->arrears + $total['total_paid_arrears11']  + $total['waive_arrears'] + $total_withdrawlarrears;  ?>
                                                                <td class="text-center"><?= number_format($total_arrears_show); ?></td>
                                                            </tr>
                                                            <tr>
                                                                <?php  $total_fine_show = $total1->fine + $total['total_fine1'] ;  ?>
                                                                <td class="text-center"><?= number_format($total_fine_show) ?></td>
                                                            </tr>
                                                            <tr>
                                                                <?php  $total_other_show = $unpaid_students_other + $total['total_other_fee'] +$struck_other + $total_others_paid +$total['other_waive'] - $total['total_fine1'];  ?>
                                                                <td class="text-center"><?= number_format(  $total_other_show  ) ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-center"><?= number_format(0) ?></td>
                                                            </tr>
                                                            <tr>
                                                                <?php  $total_show = $total_paid_show + $total_arrears_show + $total_fine_show + $total_other_show;  ?>
                                                                <td class="text-center" style="border:1px solid #BFBFBF"><?=  number_format($total_show )?></td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2" style="width:19%;  " >
                                                    <h4 class="text-center" style="font-size:12px;">Fee Collections</h4>
                                                    <div class="table-responsive">
                                                    
                                                        <table class="table     table-bordered table-hover" cellspacing="0" width="100%">                          <thead>

                                                            </thead>
                                                            <tbody style="border:1px solid #C7C6C6">
                                                            <tr>
                                                                <td colspan="2" class="text-center"><?=  number_format($total['total_paid_fee1']) ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2" class="text-center"><?=  number_format($total['total_paid_arrears11']) ?></td>
                                                            </tr>
                                                            <tr>

                                                                <td colspan="2" class="text-center"><?=  number_format($total['total_fine1']) ?></td>
                                                            </tr>
                                                            <tr>
                                                        
                                                                <td colspan="2" class="text-center"><?=  number_format( $total_others_paid) ?></td>
                                                            </tr>
                                                            <tr>

                                                                <td colspan="2" class="text-center"><?=  number_format($total['total_advance11']) ?></td>
                                                            </tr>

                                                            <tr>
                                                                <?php $total_collection = $total['total_paid_fee1']+$total['total_paid_arrears11'] + $total['total_fine1'] + $total_others_paid + $total['total_advance11'] ?>

                                                                <td colspan="2" class="text-center" style="border:1px solid #BFBFBF"><?= number_format($total_collection) ?></td>
                                                            </tr>


                                                            </tbody>

                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2" style="width:15%; padding: 0px 9px 0px 0px;">
                                                    <h4 class="text-center" style="font-size:12px;">Fee Waived</h4>
                                                    <div class="table-responsive">
                                                        <table class="table     table-bordered table-hover " cellspacing="0" width="100%">                          <thead>
                                                            </thead>
                                                            <tbody style="border:1px solid #C7C6C6">
                                                            <tr>
                                                                <?php  $total_waive_balance = $total['total_waive_fee'] + $total['waive_arrears'] +$total['other_waive']  + $waive_fine[0]->fine; ?>
                                                                <td colspan="2" class="text-center"><?= number_format($total['total_waive_fee']) ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2" class="text-center" ><?= number_format($total['waive_arrears']) ?></td>
                                                            </tr>
                                                            <tr>
                                                           
                                                                <td colspan="2" class="text-center" ><?= number_format($waive_fine[0]->fine) ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2" class="text-center" height="55px"><?= number_format($total['other_waive']) ?></td>
                                                            </tr>
                                                            <tr>
                                                                <?php  $total_balance = $total_other_balance+$total_fine_balance+  $total_arrears_balance+ $total_fee_balance;  ?>
                                                                <td colspan="2" class="text-center" style="border:1px solid #BFBFBF"><?= number_format($total_waive_balance) ?></td>
                                                            </tr>
                                                            </tbody>

                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2" style="width:14%; padding:0px">
                                                    <h4 class="text-center" style="font-size:12px;">Fee Withdrawl</h4>
                                                    <div class="table-responsive">
                                                        <table class="table     table-bordered table-hover " cellspacing="0" width="100%">
                                                            <tbody style="border:1px solid #C7C6C6">
                                                            <tr>
                                                                <td colspan="2" class="text-center"><?= number_format($total['student_withdrawl']) ?></td>
                                                            </tr>
                                                            <tr>
                                                            
                                                                <td colspan="2" class="text-center" ><?= number_format($total_withdrawlarrears) ?></td>
                                                            </tr>
                                                            <tr>
                                                            <td colspan="2" class="text-center" ><?= number_format($struck_fine) ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2" class="text-center" height="55px"><?= number_format($struck_other) ?></td>
                                                        </tr>
                                                            <tr>
                                                            <?php $total_withdrawl  = $total['student_withdrawl'] + $total_withdrawlarrears +$struck_other?>
                                                                <td colspan="2" class="text-center" style="border:1px solid #BFBFBF"><?= number_format($total_withdrawl) ?></td>
                                                            </tr>

                                                            </tbody>

                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2" style="width:19%; padding: 0px 8px 0px 10px; ">
                                                    <h4 class="text-center" style="font-size:12px;">Balance Fee</h4>
                                                    <div class="table-responsive">
                                                        <table class="table     table-bordered table-hover " cellspacing="0" width="100%">                          <thead>

                                                            </thead>
                                                            <tbody style="border:1px solid #C7C6C6">
                                                            <tr>
                                                                <?php  $total_fee_balance =    $total_paid_show -$total['total_paid_fee1'] - $total['total_waive_fee'] -$total['student_withdrawl'] ;  ?>
                                                                <td colspan="2" class="text-center"><?= number_format($total_fee_balance) ?></td>
                                                            </tr>

                                                            <tr>
                                                                <?php  $total_arrears_balance =  $total_arrears_show- $total['total_paid_arrears11'] - $total['withdrawl_arrears'] - $total['waive_arrears']   ;  ?>
                                                                <td colspan="2" class="text-center"><?= number_format($total_arrears_balance   ) ?></td>
                                                            </tr>
                                                            <tr>
                                                                <?php  $total_fine_balance =  $total_fine_show- $total['total_fine1'] - $struck_fine - $waive_fine[0]->fine ;  ?>
                                                                <td colspan="2" class="text-center"><?= number_format(  $total_fine_balance ) ?></td>
                                                            </tr>
                                                            <tr>
                                                                <?php  $total_other_balance = $total_other_show - $total['total_other_fee'] - $struck_other-$total['other_waive'] + $total['total_fine1'] ;  ?>
                                                                <td colspan="2" class="text-center"><?= number_format($total_other_balance ) ?></td>
                                                            </tr>
                                                            <tr>
                                                                <!-- < ?php  $total_other_balance = $total_other_show - $total['total_other_fee'] ;  ?> -->
                                                                <td colspan="2" class="text-center"><?= number_format( 0) ?></td>
                                                            </tr>
                                                            <tr>
                                                                <?php  $total_balance = $total_other_balance+$total_fine_balance+  $total_arrears_balance+ $total_fee_balance  ;  ?>
                                                                <td colspan="2" class="text-center" style="border:1px solid #BFBFBF"><?= number_format($total_balance) ?></td>
                                                            </tr>


                                                            </tbody>

                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-7" style="width: 53%;     padding: 0px 25px 0px 15px; " >
                                    <div class="box box-primary" >
                                        <h4 class="text-center" style="font-size:14px;">Payments</h4>
                                        <div class="box-body">
                                            <div class="row">
                                                <div class="col-sm-2"  style="margin-top:22px; width: 20%; padding: 0px 7px 0px 8px; ">
                                                    <h4 class="text-center" style="font-size:12px;"> </h4>
                                                    <div class="table-responsive">
                                                        <table class="table     table-bordered table-hover" cellspacing="0" width="100%">                          <thead>
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <td colspan="2" class="text-left">Teachers Salaries</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2" class="text-left">Staff Salaries </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2" class="text-left">Expenses</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2" class="text-left" height="60px"></td>
                                                            </tr>

                                                            <tr>
                                                                <td colspan="2" class="text-left" > Total </td>

                                                            </tr>


                                                            </tbody>

                                                        </table>
                                                    </div>
                                                </div>

                                                <div class="col-sm-1" style="width:12%; padding:0px" >


                                                    <?php $total2 = 0 ?>
                                                    <?php foreach ( $transactions2 as $transaction ){ ?>
                                                        <?php if ( $transaction['type'] == 'out' ){ ?>

                                                            <?php    $revenue1  = $transaction['amount'] ?>
                                                            <?php   $total2 += $revenue1  ?>

                                                        <?php } ?>
                                                    <?php } ?>



                                                    <h4 class="text-center" style="font-size:12px;"><?= date('M')?> Salary </h4>
                                                    <div class="table-responsive">
                                                        <table class="table     table-bordered table-hover" cellspacing="0" width="100%">
                                                            <thead>

                                                            </thead>
                                                            <tbody style="border:1px solid #C7C6C6">
                                                            <tr>
                                                                <td class="text-center"><?= number_format($teacher_salary) ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-center"><?= number_format( $staff_salary_month); ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-center" height="88px"></td>
                                                            </tr>
                                                            <tr>
                                                                <?php  $total_monthly_salary =   $teacher_salary + $staff_salary_month ;  ?>
                                                                <td class="text-center" style="border:1px solid #BFBFBF"><?=  number_format($total_monthly_salary  )?></td>
                                                            </tr>
                                                            </tbody>

                                                        </table>
                                                    </div>



                                                </div>

                                                <div class="col-sm-1" style="width:14%;   padding: 0px 10px;"  >
                                                    <?php $currentMonth = date('M'); ?>

                                                    <h4 class="text-center" style="font-size:12px;"><?= Date('M', strtotime($currentMonth . " last month"));?> Arrears</h4>
                                                    <div class="table-responsive">
                                                        <table class="table     table-bordered table-hover" cellspacing="0" width="100%">                          <thead>

                                                            </thead>
                                                            <tbody style="border:1px solid #C7C6C6">
                                                            <tr>
                                                                <?php $total_last_arrears_teacher = $teacher_salary - $teacher_salary_arrears ?>
                                                                <td class="text-center"><?= number_format( abs($total_last_arrears_teacher  )  ) ?></td>
                                                            </tr>

                                                            <tr>
                                                                <?php $total_last_arrears_staff = $staff_salary_month - $staff_salary_arrears ?>
                                                                <td class="text-center"><?= number_format( abs($total_last_arrears_staff) ); ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-center" height="88px"></td>
                                                            </tr>

                                                            <tr>
                                                                <?php  $total_monthly_salary_due2 =   $total_last_arrears_teacher + $total_last_arrears_staff ;  ?>
                                                                <td class="text-center" style="border:1px solid #BFBFBF"><?=  number_format($total_monthly_salary_due2  )?></td>
                                                            </tr>
                                                            </tbody>

                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="col-sm-1" style="width:13%; padding:0px">
                                                    <h4 class="text-center" style="font-size:12px;">Total Salary Due </h4>
                                                    <div class="table-responsive">
                                                        <table class="table     table-bordered table-hover" cellspacing="0" width="100%">                        
                                                            <tbody style="border:1px solid #C7C6C6">
                                                            <tr>
                                                                <td class="text-center"><?= number_format($teacher_salary_arrears ) ?></td>
                                                            </tr>
                                                            <tr>
                                                                <?php $total_due_staff =  $total_salary_due_staff  + $staff_salary_payment_paid_total?>
                                                                <td class="text-center"><?= number_format( $staff_salary_arrears); ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-center" height="88px"></td>
                                                            </tr>
                                                            <tr>
                                                                <?php  $total_monthly_salary_due =   $teacher_salary_arrears + $staff_salary_arrears;  ?>
                                                                <td class="text-center" style="border:1px solid #BFBFBF"><?=  number_format($total_monthly_salary_due  )?></td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                                <div class="col-sm-1" style="width:15%; padding: 0px 10px;" >
                                                    <h4 class="text-center" style="font-size:12px;">Payments</h4>
                                                    <div class="table-responsive">
                                                        <table class="table     table-bordered table-hover" cellspacing="0" width="100%">
                                                            <tbody style="border:1px solid #C7C6C6">
                                                            <tr>
                                                                <td colspan="2" class="text-center"><?=  number_format($total_salary_teacher_paid) ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2" class="text-center"><?=  number_format($total_salary_staff_paid) ?></td>
                                                            </tr>
                                                            <tr>
                                                                <?php $expense_total = $total2 - $total_salary_teacher_paid - $total_salary_staff_paid ?>
                                                                <td colspan="2" class="text-center"><?=  number_format( $expense_total ) ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2" class="text-center" height="60px" ></td>
                                                            </tr>
                                                            <tr>
                                                                <?php $total_payment_salary = $total_salary_teacher_paid+$total_salary_staff_paid + $expense_total  ?>
                                                                <td colspan="2" class="text-center" style="border:1px solid #BFBFBF"><?= number_format($total_payment_salary) ?></td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="col-sm-1" style="width:12%; padding:0px" >
                                                    <h4 class="text-center" style="font-size:12px;"> Balance</h4>
                                                    <div class="table-responsive">
                                                        <table class="table     table-bordered table-hover" cellspacing="0" width="100%">
                                                            <tbody style="border:1px solid #C7C6C6">
                                                            <tr>
                                                                <?php $total_balance_teacher = $total_salary_due_teacher  ?>
                                                                <td colspan="2" class="text-center">
                                                                    <?php  if($total_salary_teacher_balance < 0){
                                                                        $total_salary_teacher_balance= 0;
                                                                    }else{
                                                                        $total_salary_teacher_balance= $total_salary_teacher_balance;
                                                                    }?>
                                                                    <?= number_format( $total_salary_teacher_balance ) ?>
                                                                </td>
                                                            </tr>
                                                            <tr><?php
                                                                if($total_salary_staff_balance < 0){
                                                                    $total_salary_staff_balance= 0;
                                                                }else{
                                                                    $total_salary_staff_balance= $total_salary_staff_balance;
                                                                } ?>
                                                                <td colspan="2" class="text-center"><?= number_format($total_salary_staff_balance  ) ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2" class="text-center" height="88px"></td>
                                                            </tr>
                                                            <tr>
                                                                <?php  $total_balance_salary = $total_salary_teacher_balance+ $total_salary_staff_balance ;  ?>
                                                                <td colspan="2" class="text-center" style="border:1px solid #BFBFBF"><?= number_format($total_balance_salary) ?></td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="col-sm-1" style="width:14%; padding: 0px 10px;" >
                                                    <h4 class="text-center" style="font-size:12px;"> Advance</h4>
                                                    <div class="table-responsive">
                                                        <table class="table     table-bordered table-hover" cellspacing="0" width="100%">                          <thead>

                                                            </thead>
                                                            <tbody style="border:1px solid #C7C6C6">
                                                            <tr>


                                                                <td colspan="2" class="text-center">
                                                                    <?= number_format($total_salary_teacher_advance ) ?>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <?php $total_balance_staff = $total_salary_due_staff ?>
                                                                <td colspan="2" class="text-center"><?= number_format($total_salary_staff_advance ) ?></td>
                                                            </tr>

                                                            <tr>

                                                                <td colspan="2" class="text-center" height="88px"></td>
                                                            </tr>

                                                            <tr>
                                                                <?php  $total_advance_salary =$total_salary_teacher_advance + $total_salary_staff_advance  ;  ?>
                                                                <td colspan="2" class="text-center" style="border:1px solid #BFBFBF"><?= number_format($total_advance_salary) ?></td>
                                                            </tr>


                                                            </tbody>

                                                        </table>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="row">

                                <div class="col-xs-12 col-sm-3">
                                    <div class="box box-primary">

                                        <h4 class="text-center" style="font-size:14px;">Today Profit & loss</h4>

                                        <div class="box-body">
                                            <div class="row">

                                                <div class="col-sm-6" >
                                                    <h4 class="text-center" style="font-size:12px;"> </h4>
                                                    <div class="table-responsive">
                                                        <table class="table     table-bordered table-hover " cellspacing="0" width="100%">                         <thead>
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <td colspan="2" class="text-left">Total Revenue </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2" class="text-left">Total Expenses </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2" class="text-left">Net Income (CIH) </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <h4 class="text-center" style="font-size:12px;"></h4>
                                                    <div class="table-responsive">
                                                        <table class="table     table-bordered table-hover " cellspacing="0" width="100%">                          <thead>
                                                            <?php $total_daily = 0; ?>
                                                            <?php foreach ( $transactions3 as $transaction3 ){ ?>
                                                                <?php if ( $transaction3['type'] == 'out' ){
                                                                    $revenue_daily  = $transaction3['amount'];
                                                                    $total_daily += $revenue_daily;

                                                                } ?>
                                                            <?php } ?>

                                                            <?php    $total_daily_fee = 0 ?>
                                                            <?php foreach ( $transactions3 as $transaction3 ){ ?>
                                                                <?php if ( $transaction3['type'] == 'in' ){

                                                                    $revenue_daily_fee  = $transaction3['amount'];
                                                                    $total_daily_fee += $revenue_daily_fee;

                                                                } ?>
                                                            <?php } ?>



                                                            </thead>
                                                            <tbody style="border:1px solid #C7C6C6">
                                                            <tr>

                                                                <td colspan="2" class="text-center"><?= number_format($total_daily_fee ) ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2" class="text-center"><?= number_format($total_daily  ) ?></td>
                                                            </tr>
                                                            <tr>
                                                                <?php  $total_today= $total_daily_fee  -  $total_daily ;  ?>
                                                                <td colspan="2" class="text-center" style="border:1px solid #BFBFBF"><?= number_format($total_today) ?></td>
                                                            </tr>
                                                            </tbody>

                                                        </table>
                                                    </div>
                                                </div>
                                            </div>




                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-3 col-sm-offset-2">
                                    <div class="box box-primary">

                                        <h4 class="text-center" style="font-size:14px;"><?= date('M')?> Profit & loss</h4>

                                        <div class="box-body">
                                            <div class="row">

                                                <div class="col-sm-6" >
                                                    <h4 class="text-center" style="font-size:12px;"> </h4>
                                                    <div class="table-responsive">
                                                        <table class="table      " cellspacing="0" width="100%">                          <thead>

                                                            </thead>
                                                            <tbody>


                                                            <tr>
                                                                <td colspan="2" class="text-left">Total Revenue </td>

                                                            </tr>
                                                            <tr>
                                                                <td colspan="2" class="text-left">Total Expenses </td>


                                                            </tr>
                                                            <tr>
                                                                <td colspan="2" class="text-left">Net Income (CIH) </td>

                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>


                                                <div class="col-sm-6">
                                                    <h4 class="text-center" style="font-size:12px;"></h4>
                                                    <div class="table-responsive">
                                                        <table class="table" cellspacing="0" width="100%">
                                                            <tbody style="border:1px solid #C7C6C6">
                                                            <tr>
                                                                <td colspan="2" class="text-center"><?= number_format($total_collection) ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2" class="text-center"><?= number_format($total_payment_salary) ?></td>                             </tr>
                                                            <tr>
                                                                <?php  $total_month_collection= $total_collection  -  $total_payment_salary;  ?>
                                                                <td colspan="2" class="text-center" style="border:1px solid #BFBFBF"><?= number_format($total_month_collection) ?></td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php


                                $dt2=date("H");

                                if($dt2 >= '16' && $dt2 <= '17' ){
                                    
                                    $admin_phone = $this->custom_option_model->get( 'admin_phone' );
                                    $date_now = date('M-Y');
                                    $school_name = $this->setting_model->getCurrentSchoolName();
                                    $total_show = number_format($total_show);
                                    $total_collection = number_format($total_collection);
                                    $total['total_waive_fee'] = number_format($total['total_waive_fee']);
                                    $expense_total = number_format($expense_total);
                                    $total_balance = number_format($total_balance);
                                    $this->sms_library->send_sms( $admin_phone['value'], $this->sms_messages->admin_fee_message( $date_now,$total_show, $total_collection, $total['total_waive_fee'], $total_balance, $expense_total,$school_name  ) );

                                }  ?>

                                <div class="col-xs-12 col-sm-3 col-sm-offset-1">
                                    <div class="box box-primary">

                                        <h4 class="text-center" style="font-size:14px;"><?= date('Y')?> Profit & loss</h4>

                                        <div class="box-body">
                                            <div class="row">

                                                <div class="col-sm-6" >
                                                    <h4 class="text-center" style="font-size:12px;"> </h4>
                                                    <div class="table-responsive">
                                                        <table class="table     table-bordered table-hover " cellspacing="0" width="100%">                          <thead>
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <td colspan="2" class="text-left">Total Revenue </td>

                                                            </tr>
                                                            <tr>
                                                                <td colspan="2" class="text-left">Total Expenses </td>


                                                            </tr>
                                                            <tr>
                                                                <td colspan="2" class="text-left">Net Income (CIH) </td>

                                                            </tr>

                                                            </tbody>

                                                        </table>
                                                    </div>



                                                </div>
                                                <div class="col-sm-6">
                                                    <?php
                                                    $total_year = 0 ?>
                                                    <?php foreach ( $transactions_year as $transaction_year ){ ?>
                                                        <?php if ( $transaction_year['type'] == 'out' ){

                                                            $revenue_year  = $transaction_year['amount'];
                                                            $total_year += $revenue_year;

                                                        } ?>
                                                    <?php } ?>

                                                    <?php    $total_year_fee = 0 ?>
                                                    <?php foreach ( $transactions_year as $transaction_year ){ ?>
                                                        <?php if ( $transaction_year['type'] == 'in' ){

                                                            $revenue_year_fee  = $transaction_year['amount'];
                                                            $total_year_fee += $revenue_year_fee;

                                                        } ?>
                                                    <?php } ?>



                                                    <h4 class="text-center" style="font-size:12px;"></h4>
                                                    <div class="table-responsive">
                                                        <table class="table     table-bordered table-hover " cellspacing="0" width="100%">                          <thead>

                                                            </thead>
                                                            <tbody style="border:1px solid #C7C6C6">
                                                            <tr>

                                                                <td colspan="2" class="text-center"><?= number_format($total_year_fee ) ?></td>
                                                            </tr>

                                                            <tr>

                                                                <td colspan="2" class="text-center"><?= number_format( $total_year ) ?></td>
                                                            </tr>



                                                            <tr>
                                                                <?php  $total_year_collection= $total_year_fee -  $total_year;  ?>
                                                                <td colspan="2" class="text-center" style="border:1px solid #BFBFBF"><?= number_format($total_year_collection) ?></td>
                                                            </tr>


                                                            </tbody>

                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php } ?>

</div>

<script type="text/javascript">


    $(document).ready(function(){
       $.ajax({
            url: "balance_sheet/do_extra_tasks",
            type: "POST",
            data: {},
            success: function (msg) {
                
            }
        }); 
    });

    var date_format = '<?php echo $result = strtr( $this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',] ) ?>';

    $( document ).ready( function () {
        $( ".date" ).datepicker( {
            format: date_format,
            autoclose: true,
            todayHighlight: true
        } );
    } );



    jQuery( function ( $ ) {
        $( '.balance_sheet_input_submit' ).keydown( function ( e ) {

            var url = $( this ).data( 'url' ),
                selectors = $( this ).data( 'values' );

            if ( e.key.toLowerCase() == 'enter' ) {
                e.preventDefault();

                var values = $( selectors ).serialize();

                window.location.href = url + "?" + values;
            }
        } );

        // on pressing enter submit the form
        $( ".on_enter_submit" ).on( 'keydown', function ( e ) {
            var form = $( this ).parents( 'form' );

            if ( e.key.toLowerCase() == 'enter' || e.keyCode == 13 ) {
                e.preventDefault();
                $( form ).submit();
            }
        } );
    } );

    $(function()
    {
        var validator = $('#expence_heads').validate(
            {
                rules:
                    {
                        name: {required:true}
                    },
                messages:
                    {
                        name: {required:"This Is Required Field"}
                    },
                errorPlacement: function(error, element)
                {
                    error.insertAfter( element );
                }
            });
    });




</script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js"></script>
