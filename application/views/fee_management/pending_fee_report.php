<style type="text/css" >

    @media print {
        .table .table  {
            font-weight: bold;
            font-size: 10px;
        }
    }
    @media print {
    a[href]:after{
        content :none !important;
    }
    
    } 

</style>
<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
    <div class="box box-primary">
        <div class="box-header with-border" style="padding:20px 20px">
            <h3 style="display: inline; " > Fee Arrears Report</h3>
            <div class="pull-right">
            <button class="pull-right" id="printPageButton" onclick="window.print()"><i class="fa fa-print"></i></button>
        </div>
        </div>
        
    </div>
    
        
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">

                    <!-- <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> Details List</h3>
                    </div> -->
                    <div class="box-body">
                        <?php if ( $students_pending_fee === false ): ?>
                            <h3 class="text-center text-danger">No Student Found With Pending Fee!</h3>
                        <?php else: ?>
                            <table class="table table-bordered" >
                                <thead>
                                    <tr>
                                        <th >S.No</th>
                                        <th class="text-center">Ad Date</th>
                                        <th class="text-center">Ad No.</th>
                                        <th class="text-center">Class(Section)</th>
                                        <th class="text-center">Roll No.</th>
                                        <th >Student Name</th>
                                        <th>Father Name</th>
                                        <th>Gender</th>
                                        <th>Father's No.</th>
                                        <th class="text-center">Fee</th>
                                        <th class="text-center" >Fine</th>
                                        <th class="text-center" >Fee</th>
                                        <th class="text-center">
                                         Arrears<br>
                                            Month Wise
                                        </th>
                                        <th  class="no-print">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $total = new stdClass();
                                    $total->remaining_fee = 0;
                                    $total->fee           = 0;
                                    $total->fee_paid      = 0;
                                    $total->fine          = 0;
                                    $total_arrears_       = 0;
                                    foreach ( $students_pending_fee as $key=>$value ):
                                        $total->fee             += intval( $value['student_class_fee_after_discount'] );
                                       // $total->remaining_fee   += intval( $value['fee_arrears'] ) - intval( $value['student_class_fee_after_discount'] );
                                      //  $total->fee_paid        += (!empty( $value['last_payment_record'] ? intval( $value['last_payment_record']['total_paid_fee'] ) : 0 ) );
                                        $total->fine            +=  $value['late_payment_fee'];
                                      //  $total->arrears         +=  $value['fee_arrears'] - $value['student_class_fee_after_discount']- $value['late_payment_fee'];
		
		                                if ($value['fee_arrears']-$value['student_class_fee_after_discount'] -$value['late_payment_fee'] > 0) {
                                        ?>
                                        <tr <?= $value['struck_off']==1?'style="color:red;"':''?> >
                                            <td><?php echo $key+1; ?></td>
                                            <td class="text-center"><?php echo date('d-m-Y',strtotime($value['admission_date'])); ?></td>
                                            <td class="text-center"><?= $value['admission_no'] ?></td>
                                            <td class="text-center"><?= $value['class_name'] . '(' . $value['section_name'].")" ?></td>
                                            <td class="text-center"><?= $value['roll_no'] ?></td>
                                            <td><a href="<?php echo base_url(); ?>student/view/<?php echo $value['id']; ?>" <?= $value['struck_off']==1?'style="color:red;"':''?> ><?php echo $value['firstname'] . " " . $value['lastname']; ?></a></td>
                                            <td > <a  href="<?= site_url( "family/children_summary/{$value['id']}" ) ?>" <?= $value['struck_off']==1?'style="color:red;"':''?> > <?php echo $value['father_name'] ?> </a></td>                 
                                           <td><?= $value['gender'] ?></td>
                                           <td><?= $value['father_phone'] ?></td>
                                           <td class="text-center"><?= $value['class_fee'] - $value['discount'] ?></td>
                                           <td class="text-center"><?= $value['late_payment_fee'] ?></td>

                                           <?php  $arrears_ = $value['fee_arrears'] - $value['student_class_fee_after_discount']- $value['late_payment_fee'];
                                           $total_arrears_  +=  $arrears_;
                                           
                                           ?>
                                           <td class="text-center" ><?= $arrears_ ?></td>
                                                     <td>
                                                          <table class="table text-right"  style="margin-bottom: 0px;">
                                                                <?php $arrears =  $value['fee_arrears'] - $value['student_class_fee_after_discount']- $value['late_payment_fee']; 
                                                                    $n_months = round($arrears/$value['student_class_fee_after_discount'])+1;
                                                                    if ($n_months < 6) {
                                                                        $n_months = 6;
                                                                    }   
                                                                    $months = array();
                                                                    // for ($i = 0; $i < $n_months; $i++) {
                                                                    //     $timestamp = mktime(0, 0, 0, date('n') - $i, 1);
                                                                    //     $months[date('n', $timestamp)] = date('F', $timestamp);
                                                                    // }
                                                                    // foreach ($months as $key => $value) {
                                                                    //      echo date('M', strtotime($month . '01'));
                                                                    // }
                                                                    $months = array(1 => 'Jan.', 2 => 'Feb.', 3 => 'Mar.', 4 => 'Apr.', 5 => 'May', 6 => 'Jun.', 7 => 'Jul.', 8 => 'Aug.', 9 => 'Sep.', 10 => 'Oct.', 11 => 'Nov.', 12 => 'Dec.');
                                                                    $transposed = array_slice($months, date('n')-1, 12, true) + array_slice($months, 0, date('n'), true);
                                                                    $t_month = array_slice($transposed, -$n_months, 12, true);
                                                                    $month_fee = array();
                                                                    foreach ($t_month as $key => $tm) {
                                                                        if ($arrears >= $value['student_class_fee_after_discount']) {
                                                                            $month_fee[$key] = $value['student_class_fee_after_discount'];
                                                                            $arrears = $arrears - $value['student_class_fee_after_discount'];
                                                                        }elseif($arrears < $value['student_class_fee_after_discount'] && $arrears > 0){
                                                                            $month_fee[$key] = $arrears;
                                                                            $arrears = $arrears - $value['student_class_fee_after_discount'];
                                                                        }elseif($arrears < 0){
                                                                            $month_fee[$key] = 0;
                                                                        }
                                                                    }
                                                                    if (count($month_fee) < count($t_month)) {
                                                                        array_push($month_fee, 0);
                                                                    } ?>
                                                                    <tr>
                                                                        <?php foreach ($t_month as $key => $tm) { ?>
                                                                             <th class="text-center" style="padding-top: 0px;"> <?= $tm ?></th>

                                                                         <?php }
                                                                            $left_months = 0;
                                                                            if (count($month_fee) < 6) {
                                                                                $left_months = 6 - intval(count($month_fee));
                                                                            }
                                                                            for ($i=1; $i <= $left_months; $i++) { 
                                                                                array_push($month_fee, 0);
                                                                            }
                                                                            $month_fee = array_reverse($month_fee); ?>
                                                                        </tr>
                                                                        <tr>
                                                                        <?php $t_count = 0;
                                                                        foreach ($t_month as $tkey => $tm) { ?>
                                                                         
                                                                            <td class="text-center">
                                                                                <?php echo $month_fee[$t_count]; ?>        
                                                                            </td>
                                                                        <?php   $t_count++; } ?>
                                                                        </tr>
                                                            </table>
                                                      </td>
                                             <td class="no-print">
                                                <a href="<?= site_url( 'fee_management/receive_fee/' . $value['id'] ) ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="" data-original-title="Add Fees">
                                                    <i class="fa fa-money"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php  }
                                    endforeach; ?>
                                    
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="9" class="text-right"></th>
                                        <th>Total</th>
                                        <th> <span style="margin-right: 20px; margin-left: 20px;"> <?= $total->fine ?></span> </th>
                                        <th><?= $total_arrears_ ?></th>
                                    </tr>
                                </tfoot>
                            </table>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>