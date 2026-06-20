<div class="content-wrapper" style="min-height: 946px;">
<?php  $this->load->view('layout/teacher_link'); ?> 
    <?php  $admind = $this->session->userdata( 'admin' );
    $this->load->helper('menu_helper');
    $permission = admin_permission($admind['id']);
    ?>
    <section class="content-header">


        <div class="box box-primary" style="margin-bottom: 0px;">
            <div class="box-header with-border" style="padding: 20px;">
                <div class="row">
                    <div class="col-sm-2">
                        <h4 class="pull-left">Staff Salary Report</h4>
                    </div>

                    <div class="col-sm-10">
                        <form action="<?= site_url( 'admin/teacher/salary_report' ) ?>" method="get" class="pull-right form-inline">

                            <div class="form-group">
                                <label>Transaction Type</label>
                                <select class="form-control" name="search_type" id="search_type" >
                                    <option value="date" <?= set_select( 'search_type', 'date' ) ?>>Date Wise</option>
                                    <option value="teacher" <?= set_select( 'search_type', 'teacher', true ) ?>>Teacher Wise</option>
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
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>



    </section>

    <section class="content">
        <div class="row">


            <div class="col-sm-12">
                <?php if($search_type !== 'date' ){?>
                    <div class="box box-primary" id="tachelist">
                        <div class="box-header ptbnull">
                            <h3 class="box-title titlefix">Teacher Wise Salary Transactions</h3>
                        </div>
                        <div class="box-body">
                            <div class="mailbox-controls">
                            </div>

                            <div class="table-responsive mailbox-messages">

                                <form method="post" action="<?= site_url( 'admin/teacher/attendance_process' ) ?>">
                                    <table class="table     table-bordered table-hover example">
                                        <thead>
                                        <tr>
                                            <th class="text-center">T.ID</th>
                                            <th><?php echo $this->lang->line( 'teacher_name' ); ?></th>

                                            <th class="text-center">Salary/month</th>
                                            <th class="text-center">Payment</th>
                                            <th class="text-center">Balance</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php

                                        $count = 1;
                                        $total = new stdClass();
                                        $total->teacher_salary = 0;
                                        $total->due_salary = 0;
                                        $total->payment_salary = 0;
                                        
                                        foreach ( $teacherlist as $teacher ) {
                                            if($teacher['current_month_last_payment'] == null){

                                            }else{
                                              
                                                $teacher_type_details = $this->teacher_type_model->get( $teacher['teacher_type_id'] );
                                                $total->teacher_salary += intval( $teacher['teacher_salary'] );
                                                $total->due_salary += intval( $teacher['due_salary'] );
                                                $total->payment_salary += intval(  $teacher['teacher_salary']-$teacher['due_salary'] );
                                                ?>
                                                <tr>
                                                    <?php
                                                    $salary_pay_teacher = 0;
                                                    foreach($teacher['current_month_last_payment'] as $payments2 ){
                                                        $salary_pay_teacher +=  $payments2['paid_salary'];
                                                    }
                                                    $due_salary_pay_teacher = 0;
                                                    foreach($teacher['current_month_last_payment'] as $payments3 ){
                                                        $due_salary_pay_teacher +=  $payments3['due_salary'];
                                                    }

                                                    ?>
                                                    <?php   $total_payment_teacher += $salary_pay_teacher; ?>

                                                    <?php   $total_payment_balance += $balance_teacher; ?>


                                                    <td class="mailbox-name text-center"> <?php echo $teacher['id'] ?></td>
                                                    <td class="mailbox-name"> <?php echo $teacher['name'] ?></td>

                                                    <td class="text-center"><?= number_format( $teacher['teacher_salary']) ?></td>

                                                    <?php $paid_salary =  number_format($teacher['teacher_salary']-$teacher['due_salary']); ?>
                                                    <td class="mailbox-name text-center"> <?=  $salary_pay_teacher ?></td>

                                                    <?php $balance_teacher = $due_salary_pay_teacher- $salary_pay_teacher ?>
                                                    <td class="text-center"><?= number_format( $teacher['due_salary'] ) ?></td>
                                                    <td class="text-center">
                                                        <a class="btn btn-default btn-xs" href="<?= site_url( "admin/teacher/salary_payment/{$teacher['id']}" )  ?>"><i class="fa fa-money"></i></a>
                                                    </td>
                                                </tr>
                                                <?php
                                                $count++;


                                            }

                                        }
                                        ?>




                                        </tbody>

                                        <tfoot>
                                        <tr>
                                            <th colspan="1"></th>
                                            <th class="text-right">Total</th>


                                            <th class="text-center"><?= number_format( $total->teacher_salary ) ?></th>



                                            <th class="text-center"><?= number_format(  $total_payment_teacher ) ?>  </th>
                                            <th class="text-center"><?= number_format( $total_payment_balance ) ?></th>

                                        </tr>
                                        </tfoot>
                                    </table>

                                    <input type="hidden" name="attendance_for" value="<?= $attendance_date ?>">

                                </form>
                            </div>
                        </div>
                        <div class="">
                            <div class="mailbox-controls">
                            </div>
                        </div>
                    </div>

                <?php }else{?>


                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Date Wise Salary Transactions</h3>
                        </div>

                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table     table-bordered table-hover example dataTable">
                                    <thead>
                                    <tr>
                                        <th class="text-center">T.ID</th>
                                        <th class="text-center">Payment date</th>
                                        <th class="text-center">Admin</th>

                                        <th>Name</th>


                                        <th class="text-center">Salary</th>
                                        <th class="text-center">Payment</th>




                                        <th class="text-right">Actions</th>

                                    </tr>
                                    </thead>

                                    <tbody>
                                    <?php
                                    $salary_payment_due_total = 0;
                                    $salary_payment_paid_total = 0;
                                    $salary_payment_have_to_pay = 0;
                                    $salary_teacher = 0;
                                    foreach ( $salary_payments as $salary_payment ):
                                        $salary_payment_due_total += intval( $salary_payment['teacher_salary_payment_due_salary'] );
                                        $salary_payment_paid_total += intval( $salary_payment['teacher_salary_payment_paid_salary'] );
                                        $salary_payment_have_to_pay += intval( $salary_payment['due_salary'] );
                                        $salary_teacher +=intval( $salary_payment['teacher_salary'] );


                                        ?>


                                        <tr>
                                            <td class="text-center"><?= $salary_payment['id'] ?></td>
                                            <td class="text-center">
                                                <?php
                                                if ( $salary_payment['teacher_salary_payment_date'] !== null ) {
                                                    echo date( 'd-M-Y', strtotime( $salary_payment['teacher_salary_payment_date'] ) );
                                                } else {
                                                    echo "N/A";
                                                }
                                                ?>
                                            </td>
                                            <td class="text-center"><?= $salary_payment['admin_id'] ?></td>

                                            <td><?= $salary_payment['name'] ?></td>


                                            <td class="text-center">
                                                <?= ( number_format($salary_payment['teacher_salary']) !== null ? $salary_payment['teacher_salary'] : 'N/A' ) ?>
                                            </td>
                                            <td class="text-center">
                                                <?= ( number_format($salary_payment['teacher_salary_payment_paid_salary']) !== null ? number_format($salary_payment['teacher_salary_payment_paid_salary']) : 'N/A' ) ?>
                                            </td>
                                            <td class="text-right">
                                            <?php if($permission->account_ts == 1){?>
                                                <a class="btn btn-default btn-xs" href="<?= site_url( "admin/teacher/salary_payment/{$salary_payment['id']}" )  ?>"><i class="fa fa-money"></i></a>
                                            <?php } ?>                        
                                                <?php

                                                $current_date = date("Y-m-d", now());

                                                $payment_date = $salary_payment["teacher_salary_payment_date"];

                                                if(($payment_date == $current_date && $permission->daily_delete==1 ) ||  $permission->delete_fee==1){
                                                    ?>
                                                    <a class="btn btn-default btn-xs" href="<?= site_url( 'admin/teacher/salary_payment_delete/' . $salary_payment['teacher_salary_payment_id'] ) . "?redirect=" . urlencode( current_url() ) ?>" onclick="return confirm('Do you really want to remove this salary payment?');" title="Delete salary transaction"><i class="fas fa-trash-alt"></i></a>

                                                    <a class="btn btn-default btn-xs" href="<?= site_url( 'admin/teacher/edit2?payment_id=' . $salary_payment['teacher_salary_payment_id'] ) ?>"  title="Edit salary transaction"><i class="fas fa-pencil-alt"></i></a>                                               
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
                                        <th class="text-center"><?= number_format($salary_payment_paid_total) ?></th>
                                        <th class="text-center">

                                        </th>
                                        <th></th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
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