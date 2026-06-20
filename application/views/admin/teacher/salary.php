<div class="content-wrapper" style="min-height: 946px;">
    <?php $this->load->view('layout/teacher_link');
    $admind = $this->session->userdata('admin');
    $this->load->helper('menu_helper');
    $permission = admin_permission($admind['id']);
    ?>

    <section class="content-header">

        <div class="box box-primary" style="margin-bottom: 0px;">
            <div class="box-header with-border" style="padding: 20px;">
                <form role="form" action="<?php echo site_url('admin/teacher/salary') ?>" method="get"
                      class="form-horizontal">
                    <div class="row">
                        <div class="col-sm-6 col-md-3"><h3><?= $title; ?></h3></div>

                        <div class="col-sm-6">
                        </div>

                        <form style=" float: right;" action="<?= current_url() ?>" method="get" class="form-inline">

                            <div class="col-sm-1">
                                <div class="form-group">
                                    <select name="month" style="color:#666666;" class="form-control">
                                        <?php for ($i = 1; $i <= 12; $i++): ?>
                                            <option value="<?= $i ?>" <?= set_select('month', $i, ($month == $i)) ?>><?= date('F', mktime(0, 0, 0, $i, 1)) ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <div class="form-group">
                                    <select name="year" class="form-control">
                                        <?php for ($y = intval(date('Y', now())); $y >= intval(date('Y', now())) - 10; $y--): ?>
                                            <option value="<?= $y ?>" <?php set_select('year', $y, ($y == $year)) ?>><?= $y ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <button type="submit" class="btn btn-primary btn-sm">Filter</button>
                            </div>

                        </form>
                    </div>

            </div>
            </form>


        </div>


        <div class="pull-right">
            <?php

            $month                 = date('m', now());
            $year                  = date('Y', now());
            $count                 = 1;
            $total                 = new stdClass();
            $total->teacher_salary = 0;
            $total->due_salary     = 0;
            $total->payment_salary = 0;
            $total->incentive      = 0;
            $total->deduction      = 0;
            $total->incentive_due  = 0;
            $total->deduction_due  = 0;

            foreach ($teacherlist as $teacher) {
                $teacher_type_details  = $this->teacher_type_model->get($teacher['teacher_type_id']);
                $total->teacher_salary += intval($teacher['teacher_salary']);
                $total->due_salary     += intval($teacher['due_salary']);
                $total->payment_salary += intval($teacher['teacher_salary'] - $teacher['due_salary']);
                $total_salary          = 0;
                $total_incentive       = 0;
                $total_deduction       = 0;
                foreach ($teacher['current_month_last_payment'] as $payment) {
                    $total_salary    += $payment['paid_salary'];
                    $total_incentive += $payment['incentive'];
                    $total_deduction += $payment['deduction'];
                }

                $total_incentive_due1 = 0;
                $total_deduction_due1 = 0;
                // echo "<pre>";
                // print_r($teacher['due_incentive']);
                // echo "<pre>";

                foreach ($teacher['due_incentive'] as $payment1) {
                    if ($payment1['type'] == "incentive") {
                        $total_incentive_due1 += $payment1['amount'];
                    }
                    if ($payment1['type'] == "deduction") {
                        $total_deduction_due1 += $payment1['amount'];
                    }
                }


                $total->incentive_due += $total_incentive_due1;
                $total->deduction_due += $total_deduction_due1;
                $total->incentive     += $total_incentive;
                $total->deduction     += $total_deduction;
                if ($teacher['due_salary'] > 0) {
                    $current_month_arrears = intval($teacher['due_salary']);
                    if ($teacher['teacher_salary'] <= $current_month_arrears) {
                        $arrears     = intval($teacher['due_salary'] + $total_salary);
                        $tuition_fee = 0;
                        $advance     = 0;
                    } elseif ($teacher['teacher_salary'] > $current_month_arrears) {
                        $arrears          = $current_month_arrears + $total_salary;
                        $tuition_fee_left = $teacher['teacher_salary'] - $arrears;
                        if ($tuition_fee_left <= $teacher['teacher_salary']) {
                            $tuition_fee = $tuition_fee_left;
                            $advance     = 0;
                        } else {
                            $tuition_fee      = $teacher['teacher_salary'];
                            $tuition_fee_left = $tuition_fee_left - $teacher['teacher_salary'];
                            $advance          = $tuition_fee_left;
                        }
                    }
                } elseif ($teacher['due_salary'] <= 0) {
                    $tuition_fee = 0;
                    $arrears     = $teacher['teacher_salary'];
                    $advance     = $teacher['due_salary'];
                }
                if ($arrears < 0) {
                    $arrears = 0;
                }
                $total_teacher_arrears_salary += $arrears;
                $total_fee_paid               += $tuition_fee;
                $total_arrears                += $arrears;
                $total_advance                += abs($advance);

                $teacher_arrears = abs($teacher['teacher_salary'] - $arrears);

                $total_teacher_arrears += $teacher_arrears;

                $total_teacher_salary  += $total_salary;
                $teacher_balance       = $$teacher['due_salary'];
                $total_teacher_balance += $teacher['due_salary'];
                $total_teacher_advance += $advance;

            }

            ////////////////////////////////////////////staff////////////////////////////////////////////

            //  if ( $staff_list !== false ):
            //  $monthly_salary =0;
            //  $balance = 0;
            //  $payment =0;
            //  $total_incentive_f = 0;
            //  $total_deduction_f = 0;

            //  foreach ( $staff_list as $staff_v ):

            //      $total_salary_staff = 0;
            //      $total_incentive_staff = 0;
            //      $total_deduction_staff = 0;
            //      foreach($staff_v['current_month_last_payment'] as $payments){
            //      $total_salary_staff += $payments['paid_salary'];
            //      $total_incentive_staff += $payments['incentive'];
            //      $total_deduction_staff += $payments['deduction'];
            //      }	
            //      $total_deduction_f +=  $total_deduction_staff;
            //      $total_incentive_f +=  $total_incentive_staff;
            //      if ($staff_v['due_salary'] > 0 )
            //      {
            //      $current_month_arrears = intval($staff_v['due_salary'])  ;

            //         if ($staff_v['salary'] <= $current_month_arrears) {
            //             $arrears = intval($staff_v['due_salary']+ $total_salary_staff );
            //             $tuition_fee = 0;
            //             $advance = 0;
            //         }elseif ($staff_v['salary'] > $current_month_arrears){

            //              $arrears            =  $current_month_arrears+ $total_salary_staff ;

            //             $tuition_fee_left   = $staff_v['salary'] - $arrears; 

            //             if ($tuition_fee_left <= $staff_v['salary']) {
            //                 $tuition_fee        = $tuition_fee_left;
            //                 $advance = 0;
            //             }else{
            //                 $tuition_fee        = $staff_v['salary'];
            //                $tuition_fee_left   = $tuition_fee_left - $staff_v['salary'];
            //                 $advance            = $tuition_fee_left;
            //             }
            //         }
            //     }
            //     elseif($staff_v['due_salary'] <= 0){
            //         $tuition_fee = 0;
            //         $arrears     = $staff_v['salary'];
            //         $advance     = $staff_v['due_salary'];
            //     }
            //     if ($arrears < 0) {
            //         $arrears = 0;
            //     }

            //     $staff_arrears = abs($staff_v['salary'] -$arrears) ;
            //     $total_staff_arrears += $staff_arrears;
            //     $total_staff_arrears2 = abs($arrears);

            //     $total_staff_arrears_salary += $total_staff_arrears2;
            //     $total_staff_salary += $total_salary_staff;
            //     $monthly_salary +=$staff_v['salary'];
            //      $balance += $staff_v['due_salary'];
            //      $payment +=$staff_v['salary'] -$staff_v['due_salary'];
            //      $total_staff_balance += $staff_v['due_salary'];
            //      $total_staff_advance += $advance;
            //     endforeach;
            // endif;
            ?>


        </div>


        <div class="clearfix"></div>
    </section>
    <?php if ($permission->salary_status == 1) { ?>
        <section class="content">

            <div class="row">

                <div class="col-md-12">

                    <?php
                    $this->general_library->err_msg();
                    ?>

                    <div class="box box-primary" id="tachelist">
                        <div class="box-header ptbnull">
                            <h3 class="box-title titlefix"></h3>
                        </div>
                        <div class="box-body">
                            <div class="mailbox-controls">
                            </div>

                            <div class="table-responsive mailbox-messages">

                                <form method="post" action="<?= site_url('admin/teacher/attendance_process') ?>">
                                    <table id="salary_table" class="table     table-bordered table-hover example">
                                        <thead>
                                        <tr>

                                            <th></th>
                                            <th></th>

                                            <th class="text-center"><?= number_format($total->teacher_salary) ?></th>
                                            <th class="text-center"><?= number_format(abs($total_teacher_arrears)) ?> </th>
                                            <th class="text-center"><?= number_format($total->incentive_due) ?></th>
                                            <th class="text-center"><?= number_format($total->deduction_due) ?></th>
                                            <th class="text-center"><?= number_format($total_teacher_arrears_salary) ?></th>

                                            <th class="text-center"><?= number_format($total->incentive + $total_incentive_f) ?></th>
                                            <th class="text-center"><?= number_format($total->deduction + $total_deduction_f) ?></th>


                                            <th class="text-center"><?= number_format($total_teacher_salary) ?></th>
                                            <th class="text-center"><?= number_format($total_teacher_balance) ?></th>
                                            <th class="text-center"><?= number_format($total_teacher_advance) ?></th>
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <th>Staff Name</th>
                                            <th>Designation</th>

                                            <th class="text-center">Salary/month</th>
                                            <?php $currentMonth = date('M'); ?>
                                            <th class="text-center"> <?= Date('M', strtotime($currentMonth . " last month")); ?>
                                                Arrears
                                            </th>
                                            <th class="text-center">Incentive Due</th>
                                            <th class="text-center">Deduction Due</th>
                                            <th class="text-center">Total Salary Due</th>
                                            <th class="text-center">Incentive Paid</th>
                                            <th class="text-center">Deduction Paid</th>
                                            <th class="text-center">Payment</th>
                                            <th class="text-center">Balance</th>
                                            <th class="text-center">Advance</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $count = 1;
                                        foreach ($teacherlist as $teacher) {

                                            $total_salary    = 0;
                                            $total_incentive = 0;
                                            $total_deduction = 0;
                                            foreach ($teacher['current_month_last_payment'] as $payment) {
                                                $total_salary    += $payment['paid_salary'];
                                                $total_incentive += $payment['incentive'];
                                                $total_deduction += $payment['deduction'];
                                            }
                                            $total_incentive_due = 0;
                                            $total_deduction_due = 0;
                                            foreach ($teacher['due_incentive'] as $payment1) {
                                                if ($payment1['type'] == "incentive") {
                                                    $total_incentive_due += $payment1['amount'];
                                                }
                                                if ($payment1['type'] == "deduction") {
                                                    $total_deduction_due += $payment1['amount'];
                                                }
                                            }
                                            ?>
                                            <?php $paid_salary = number_format($teacher['teacher_salary'] - $teacher['due_salary']); ?>
                                            <?php
                                            if ($teacher['due_salary'] > 0) {
                                                $current_month_arrears = intval($teacher['due_salary']);

                                                if ($teacher['teacher_salary'] <= $current_month_arrears) {
                                                    $arrears     = intval($teacher['due_salary'] + $total_salary);
                                                    $tuition_fee = 0;
                                                    $advance     = 0;
                                                } elseif ($teacher['teacher_salary'] > $current_month_arrears) {
                                                    $arrears          = $current_month_arrears + $total_salary;
                                                    $tuition_fee_left = $teacher['teacher_salary'] - $arrears;
                                                    if ($tuition_fee_left <= $teacher['teacher_salary']) {
                                                        $tuition_fee = $tuition_fee_left;
                                                        $advance     = 0;
                                                    } else {
                                                        $tuition_fee      = $teacher['teacher_salary'];
                                                        $tuition_fee_left = $tuition_fee_left - $teacher['teacher_salary'];
                                                        $advance          = $tuition_fee_left;
                                                    }
                                                }

                                            } elseif ($teacher['due_salary'] <= 0) {
                                                $tuition_fee = 0;
                                                $arrears     = $teacher['teacher_salary'];
                                                $advance     = $teacher['due_salary'];
                                            }
                                            if ($arrears < 0) {
                                                $arrears = 0;
                                            }
                                            $total_fee_paid += $tuition_fee;
                                            $total_arrears  += $arrears;
                                            $total_advance  += abs($advance);


                                            ?>

                                            <tr>

                                                <td class="mailbox-name"> <?php echo $teacher['name'] ?></td>
                                                <td class="mailbox-name"> <?php echo $teacher['designation'] ?></td>

                                                <td class="text-center"><?= number_format($teacher['teacher_salary']) ?></td>
                                                <?php $paid_salary = number_format($teacher['teacher_salary'] - $teacher['due_salary']); ?>

                                                <?php $teacher_due = $teacher['due_salary'] ?>


                                                <?php $teacher_arrears = abs($teacher['teacher_salary'] - $arrears + $total_incentive_due - $total_deduction_due); ?>
                                                <td class="text-center"><?= number_format($teacher_arrears) ?></td>

                                                <td class="text-center"><?= $total_incentive_due ?></td>
                                                <td class="text-center"><?= $total_deduction_due ?></td>


                                                <td class="text-center"><?= number_format($arrears) ?></td>
                                                <td class="text-center"><?= $total_incentive ?></td>
                                                <td class="text-center"><?= $total_deduction ?></td>
                                                <td class="text-center"><?= number_format($total_salary) ?></td>

                                                <?php ?>
                                                <td class="text-center">
                                                    <?= ($teacher['due_salary'] > 0 ? number_format($teacher['due_salary']) : 0) ?>
                                                </td>
                                                <td class="text-center">
                                                    <?= number_format($advance) ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php if ($permission->account_ts == 1) { ?>
                                                        <a href="<?= site_url("admin/teacher/salary_payment/{$teacher['id']}") . "?redirect_back=" . urlencode($redirect) ?>"
                                                           class="btn btn-default btn-xs"><i
                                                                    class="fa fa-money"></i></a>
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

                                            <th class="text-right">Total</th>
                                            <th class="text-right"></th>
                                            <th class="text-center"><?= number_format($total->teacher_salary) ?></th>

                                            <th class="text-center"><?= number_format($total_teacher_arrears) ?>  </th>


                                            <th class="text-center"><?= $total->incentive_due ?></th>
                                            <th class="text-center"><?= $total->deduction_due ?></th>
                                            <th class="text-center"><?= number_format($total_teacher_arrears_salary) ?>  </th>
                                            <th class="text-center"><?= $total->incentive ?></th>
                                            <th class="text-center"><?= $total->deduction ?></th>
                                            <th class="text-center"><?= number_format($total_teacher_salary) ?></th>


                                            <th class="text-center">

                                                <?php if ($total_teacher_balance <= 0) { ?>
                                                    <?= 0 ?>
                                                <?php } else { ?>

                                                    <?= number_format($total_teacher_balance) ?>

                                                <?php } ?>
                                            </th>


                                            <th class="text-center"><?= number_format($total_teacher_advance) ?></th>
                                        </tr>
                                        </tfoot>
                                    </table>

                                    <input type="hidden" name="attendance_for" value="<?= $attendance_date ?>">

                                </form>
                            </div>
                        </div>
                        <!-- <div class="">
                        <div class="mailbox-controls">
                        </div>
                        <div class="box box-primary" id="tachelist">
                        <div class="box-header ptbnull">
                        <h3 class="box-title titlefix">Staff List</h3>
                    </div>
                        <div class="box-body">

        <div class="table-responsive">
        <table class="table table-bordered     example2">
        <thead>
            <tr>
                <th>Name</th>
                <th>Designation</th>
                
                <th class="text-center">Monthly Salary</th>
                 <?php $currentMonth = date('M'); ?>
                            <th class="text-center"> <?= Date('M', strtotime($currentMonth . " last month")); ?>  Arrears</th>
                            <th class="text-center">Incentive</th>
                            <th class="text-center">Deduction</th>
                
                
                <th class="text-center">Total Salary Due</th>
                
                <th class="text-center">Payment</th>
                <th class="text-center">Balance</th>
                <th class="text-center">Advance</th>
                
                <th class="text-center">Action</th>
            </tr>
        </thead>

        <tbody>
            < ?php
            if ( $staff_list !== false ):
        
            $balance = 0;
            $payment =0;
            $total_incentive_f = 0;
            $total_deduction_f = 0;
            foreach ( $staff_list as $staff_v ):
            $total_salary= 0;
            $total_incentive = 0;
            $total_deduction = 0;
                foreach($staff_v['current_month_last_payment'] as $payments){
                $total_salary += $payments['paid_salary']; 
                    $total_incentive += $payments['incentive'];
                    $total_deduction += $payments['deduction'];
                 
                }	
                $total_deduction_f +=  $total_deduction;
                $total_incentive_f +=  $total_incentive;

            $balance += $staff_v['due_salary'];
            $payment +=$staff_v['salary'] -$staff_v['due_salary'];
            



                                if ($staff_v['due_salary'] > 0 )
                                 {
                                 $current_month_arrears = intval($staff_v['due_salary'])  ;

                                    if ($staff_v['salary'] <= $current_month_arrears) {
                                        $arrears = intval($staff_v['due_salary']+ $total_salary );
                                        $tuition_fee = 0;
                                        $advance = 0;
                                    }elseif ($staff_v['salary'] > $current_month_arrears){
                                        
                                         $arrears            =  $current_month_arrears+ $total_salary ;
                                        
                                        $tuition_fee_left   = $staff_v['salary'] - $arrears; 
                                        
                                        if ($tuition_fee_left <= $staff_v['salary']) {
                                            $tuition_fee        = $tuition_fee_left;
                                            $advance = 0;
                                        }else{
                                            $tuition_fee        = $staff_v['salary'];
                                           $tuition_fee_left   = $tuition_fee_left - $staff_v['salary'];
                                            $advance            = $tuition_fee_left;
                                        }

                                    }
                                    
                                }
                                elseif($staff_v['due_salary'] <= 0){
                                    $tuition_fee = 0;
                                    $arrears     = $staff_v['salary'];
                                    $advance     = $staff_v['due_salary'];
                                }
                                if ($arrears < 0) {
                                    $arrears = 0;
                                }
                                $total_fee_paid += $tuition_fee;
                                $total_arrears  += $arrears;
                                $total_advance  += abs($advance);
                            ?>
                    
                    <tr>
                 
                     <td>< ?= $staff_v['name'] ?></td>
                     <td></td>
                  
                     
                      
                        <td class="text-center">< ?= number_format($staff_v['salary']) ?></td>
                        
                        
                         < ?php   $staff_arrears = abs($staff_v['salary'] -$arrears ); ?> 
                         
                         <td class="text-center">< ?= number_format( $staff_arrears ) ?></td>
                         <td class="text-center">< ?= number_format( $total_incentive ) ?></td>
                         <td class="text-center">< ?= number_format( $total_deduction ) ?></td>
                                
                         < ?php   $total_staff_arrears2 = abs($arrears ); ?> 
                            <td class="text-center"><?= number_format($total_staff_arrears2) ?></td>
  
                              <td class="text-center"> <?= number_format($total_salary) ?></td>
                              
                             < ?php  $staff_balance = $staff_v['due_salary']; ?>  
                              
                        <td class="text-center">
                        
                  
                         < ?php if($staff_balance < 0){
                                    
                                     echo 0;
                                }
                                else{
                                    echo number_format($staff_balance);	
                                    
                                    }
                                    ?>
                                   
                                  <?php ?>
                                 <?php ?>
                    
                         </td>
                        
                  <td class="text-center">
                                < ?= number_format($advance)  ?>
                                  </td>
                        <td class="text-center">
                        < ?php if($permission->account_ts == 1){?>
                                               
                            <a  href="< ?= site_url( 'admin/staff/salary_payment/' . $staff_v['id'] ) . '?redirect_back=' . urlencode( $redirect ) ?>"  class="btn btn-default btn-xs"  ><i class="fa fa-money"></i> </a>
                        < ?php } ?>
                        </td>

                    </tr>
                    < ?php
                endforeach;
            endif;
            ?>
        </tbody>
        <tfoot>
                        <tr>
                        <th class="text-right"></th>
                            
                            <th class="text-right">Total</th>

                            <th class="text-center"><?= number_format($monthly_salary) ?></th>
                            <th class="text-center"><?= number_format($total_staff_arrears) ?></th>
                            <th class="text-center"><?= number_format($total_incentive_f) ?></th>
                            <th class="text-center"><?= number_format($total_deduction_f) ?></th>
                            <th class="text-center"><?= number_format($total_staff_arrears_salary) ?></th>
                            <th class="text-center"><?= number_format($total_staff_salary) ?></th>
                            <th class="text-center">
                            <?= ($total_staff_balance >= 0 ? number_format($total_staff_balance) : 0) ?>
                            </th>
                            <th class="text-center"><?= number_format($total_staff_advance) ?>  </th>
                           
                          
                                </tr>
                            </tfoot>
                        </table>
                        </div>

                        </div>
                    </div>
                </div>
            </div>

        </div> -->

        </section>

    <?php } ?>
</div>


<script>
    $(document).ready(function () {
        $('#salary_table').DataTable({
            destroy: true,
            order: [[0, 'asc']],
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