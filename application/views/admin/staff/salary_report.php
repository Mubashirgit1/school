<div class="content-wrapper" style="min-height: 946px;">

<?php  $this->load->view('layout/teacher_link'); ?> 
    <?php
    $admind = $this->session->userdata( 'admin' );
    $this->load->helper('menu_helper');
    $permission = admin_permission($admind['id']);
    ?>


    <section class="content-header">

        <div class="box box-primary" style="margin-bottom: 0px;">
            <div class="box-header with-border" style="padding: 20px;">
                <div class="row">
                    <div class="col-sm-3">
                        <h4 class="pull-left"><?= $print_title; ?></h4>
                    </div>
                    <div class="col-sm-9">
                        <div class="pull-right">
                            <form action="<?= site_url( 'admin/staff/salary_report' ) ?>" method="get" class="form-inline">


                                <div class="form-group">
                                    <label>Transaction Type</label>
                                    <select class="form-control" name="search_type" id="search_type" >
                                        <option value="staff" <?= set_select( 'search_type', 'staff', true ) ?>>Staff Wise</option>
                                        <option value="date" <?= set_select( 'search_type', 'date' ) ?>>Date Wise</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Date from</label>
                                    <input type="text" class="form-control date" name="date_from" value="<?= set_value( 'date_from', date( 'm/d/Y', strtotime( $date_from ) ) ) ?>" readonly>
                                </div>

                                <div class="form-group">
                                    <label>Date to</label>
                                    <input type="text" class="form-control date" name="date_to" value="<?= set_value( 'date_to', date( 'm/d/Y', strtotime( $date_to ) ) ) ?>" readonly>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </div>
                    


                            </form>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </section>

    <section class="content">

        <div class="row">

            <div class="col-xs-12">




                <?php if($search_type !== 'date' ){?>


                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Staff Wise Salary Transactions</h3>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover example">
                                    <thead>
                                    <tr>
                                        <th class="text-center">S.ID</th>
                                        <th>Name</th>
                                        <th>Gender</th>
                                        <th>Monthly Salary</th>
                                        <th>Payments</th>
                                        <th>Balance</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if ( $staff_list !== false ):

                                        $monthly_salary =0;
                                        $balance = 0;
                                        $payment =0;
                                        foreach ( $staff_list as $staff_v ):
                                            if($staff_v['current_month_last_payment'] == null){
                                            }else{
                                                $monthly_salary +=$staff_v['salary'];
                                                $balance += $staff_v['due_salary'];
                                                $payment +=$staff_v['salary'] -$staff_v['due_salary'];
                                                $salary_pay_staff = 0;
                                                foreach($staff_v['current_month_last_payment'] as $payments2 ){
                                                    $salary_pay_staff +=  $payments2['paid_salary'];
                                                }
                                                $due_salary_pay_staff = 0;
                                                foreach($staff_v['current_month_last_payment'] as $payments5 ){
                                                    $due_salary_pay_staff +=  $payments5['due_salary'];
                                                } ?>
                                                <tr>
                                                    <td class="text-center"><?= $staff_v['id'] ?></td>
                                                    <td><?= $staff_v['name'] ?></td>
                                                    <td><?= $staff_v['sex'] ?></td>
                                                    <td><?= number_format($staff_v['salary']) ?></td>
                                                    <td><?= number_format($salary_pay_staff);?></td>
                                                    <?php $balance_staff =  $due_salary_pay_staff  - $salary_pay_staff ?>
                                                    <td> <?= number_format($staff_v['due_salary'] ) ?></td>
                                                    <?php   $total_payment_staff += $salary_pay_staff; ?>
                                                    <?php   $total_payment_staff_balance += $balance_staff; ?>
                                                    <td>
                                                    <?php if($permission->account_ts == 1){?>
                                                        <a  class="btn btn-default btn-xs" href="<?= site_url( 'admin/staff/salary_payment/' . $staff_v['id'] ) . '?redirect_back=' . urlencode( $redirect ) ?>"><i class="fa fa-money"></i> </a>
                                                    <?php }?>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        endforeach;
                                    endif;?>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th colspan="2" ></th>
                                        <th class="text-right">Total</th>
                                        <th ><?= number_format(    $monthly_salary ) ?></th>
                                        <th ><?= number_format( $total_payment_staff) ?>  </th>
                                        <th ><?= number_format($total_payment_staff_balance ) ?></th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php }else{?>
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Date Wise Salary Transactions</h3>
                        </div>
                        <div class="box-body">
                            <?php
                            if ( $staff_salary_payments === false ):
                                echo '<h3 class="text-center text-danger">No staff salary details found!</h3>';
                            else:
                                ?>
                                <div class="table-responsive">
                                    <table class="table table-bordered     example2">
                                        <thead>
                                        <tr>
                                            <th class="text-center">S.ID</th>
                                            <th class="text-center">Payment Date</th>
                                            <th>Admin</th>
                                            <th>Name</th>
                                            <th class="text-center"> Salary</th>
                                            <th class="text-center">Payment</th>
                                            <th class="text-right">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php

                                        $salary_payment_due_total = 0;
                                        $salary_payment_paid_total = 0;


                                        foreach ( $staff_salary_payments as $staff_salary_payment ):
                                            $salary_payment_due_total += intval($staff_details['due_salary']  );
                                            $salary_payment_paid_total += intval( $staff_salary_payment['paid_salary'] );


                                            $staff_details = $this->staff_model->get( $staff_salary_payment['staff_id'] );
                                            ?>
                                            <tr>
                                                <td class="text-center"><?= $staff_details['id'] ?></td>
                                                <td class="text-center"><?= date( 'd-M-Y', strtotime( $staff_salary_payment['payment_date'] ) ) ?></td>
                                                <td><?= $staff_salary_payment['user_id'] ?></td>
                                                <td><?= $staff_details['name'] ?></td>

                                                <td class="text-center"><?= $staff_details['salary'] ?></td>
                                                <td class="text-center"><?= $staff_salary_payment['paid_salary'] ?></td>




                                                <td class="text-right">
                                                    <a  class="btn btn-default btn-xs text-right" href="<?= site_url( 'admin/staff/salary_payment/' . $staff_details['id'] ) . '?redirect_back=' . urlencode( $redirect ) ?>"><i class="fa fa-money"></i> </a>

                                                    <?php
                                                    $current_date = date("Y-m-d", now());
                                                    $payment_date = $staff_salary_payment["payment_date"];

                                                    if(($payment_date == $current_date && $permission->daily_delete==1 ) ||  $permission->delete_fee==1){   ?>

                                                        <a href="<?= site_url( "admin/staff/salary_payment_delete/{$staff_salary_payment['id']}" ) ?>" class="btn btn-default btn-xs" title="Delete payment transaction" onclick="return confirm('Do you really want to delete this transaction?');">
                                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                        </a>

                                                        <a class="btn btn-default btn-xs" href="<?= site_url( "admin/staff/edit2?staff_id=" . $staff_details['id']  ) ?>"  title="Edit salary transaction"><i class="fa fa-pencil"></i></a>

                                                    <?php }?>

                                                </td>

                                            </tr>
                                        <?php
                                        endforeach;
                                        ?>
                                        </tbody>
                                        <tfoot style="display: table-footer-group;">
                                        <tr>
                                            <th colspan="4" class="text-right">Total:</th>


                                            <th></th>
                                            <th class="text-center"><?=$salary_payment_paid_total ?></th>


                                            <th class="text-center">

                                            </th>
                                            <th></th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            <?php
                            endif;
                            ?>
                        </div>
                    </div>
                <?php }?>

            </div>

        </div>

    </section>

</div>

<script type="text/javascript">
    jQuery( function ( $ ) {
        $( '.date' ).datepicker( {
            format: 'mm/dd/yyyy',
            autoclose: true
        } );

    } );
</script>