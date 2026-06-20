<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1 class="pull-left">
          <?= $title; ?>
        </h1>

        <div class="pull-right">
            <a href="<?= site_url( 'admin/staff/salary_report' ) ?>" class="btn btn-primary">Salary Transactions History</a>
        </div>

        <div class="clearfix"></div>
    </section>

    <section class="content">

        <div class="box box-primary">

            <div class="box-header with-border">
                <h3 class="box-title">Staff List</h3>
            </div>

            <div class="box-body">

                <div class="table-responsive">
                    <table class="table table-bordered     example">
                        <thead>
                            <tr>
                                <th>Name</th>
                              
                          
                     
                                <th class="text-center">Monthly Salary</th>
                                 <?php $currentMonth = date('M'); ?>
                                            <th class="text-center"> <?= Date('M', strtotime($currentMonth . " last month"));?>  Arrears</th>
                                <th class="text-center">Total Salary Due</th>
                                
                                <th class="text-center">Payment</th>
                                <th class="text-center">Balance</th>
                                <th class="text-center">Advance</th>
                                
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            if ( $staff_list !== false ):
							$monthly_salary =0;
							$balance = 0;
							$payment =0;
			                foreach ( $staff_list as $staff_v ):
                            $total_salary= 0;
                                foreach($staff_v['current_month_last_payment'] as $payments){
                                $total_salary += $payments['paid_salary']; 
                                }	
						    $monthly_salary +=$staff_v['salary'];
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
												elseif($teacher['due_salary'] <= 0){
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
                                 
                                     <td><?= $staff_v['name'] ?></td>
                                  
                                     
                                      
                                        <td class="text-center"><?= number_format($staff_v['salary']) ?></td>
                                         <?php   $staff_arrears = abs($staff_v['salary'] -$arrears ); ?> 
                                         <td class="text-center"><?= number_format( $staff_arrears ) ?></td>
                                            <?php   $total_staff_arrears2 = abs($arrears ); ?> 
                                            <td class="text-center"><?= number_format($total_staff_arrears2)  ?></td>
                                            <td class="text-center"> <?= number_format($total_salary) ?></td>
                                           <?php  $staff_balance = $staff_v['due_salary']; ?>  
                                        <td class="text-center">
                                        <?= ( $staff_balance > 0 ? number_format( $staff_balance ) : 0 ) ?>
                                                <?php $total_staff_salary += $total_salary ?>
                                                <?php $total_staff_balance += $staff_balance ?>
                                                  <?php $total_staff_arrears += $staff_arrears ?>
                                                 <?php $total_staff_arrears_salary += $total_staff_arrears2 ?>
                                                 <?php $total_staff_advance += $advance ?>
                                         </td>
                                        
                                        <td class="text-center">
                                        <?= number_format($advance)  ?>
                                        </td>
                                        <td class="text-center">
                                            <a  href="<?= site_url( 'admin/staff/salary_payment/' . $staff_v['id'] ) . '?redirect_back=' . urlencode( $redirect ) ?>"  class="btn btn-default btn-xs"  ><i class="fa fa-money"></i> </a>
                                        </td>
                                    </tr>
                                    <?php
                                endforeach;
                            endif;
                            ?>
                        </tbody>
                        
                        
                        
                        <tfoot>
                                        <tr>
                                    
                                         <th class="text-right">Total</th>
                                      
                                            <th class="text-center"><?= number_format($monthly_salary ) ?></th>
                                            <th class="text-center"><?= number_format($total_staff_arrears) ?></th>
                                            <th class="text-center"><?= number_format($total_staff_arrears_salary) ?></th>
                                           <th class="text-center"><?= number_format( $total_staff_salary) ?></th>
                                           <th class="text-center">
                                           <?php if($total_staff_balance<= 0){?>
											
											<?= 0 ?>
                                            
											<?php }else{?>
											
											<?= number_format( $total_staff_balance ) ?>
                                            
                                            <?php }?>

                                           
                                            </th>
                                            <th class="text-center"><?= number_format( $total_staff_advance	 ) ?>  </th>
                                           
                                          
                                        </tr>
                                    </tfoot>
                    </table>
                </div>

            </div>

        </div>

    </section>
</div>