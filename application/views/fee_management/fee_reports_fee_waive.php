<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<style type="text/css">
    /*REQUIRED*/
    .carousel-row {
        margin-bottom: 10px;
    }

    .slide-row {
        padding: 0;
        background-color: #ffffff;
        min-height: 150px;
        border: 1px solid #e7e7e7;
        overflow: hidden;
        height: auto;
        position: relative;
    }

    .slide-carousel {
        width: 20%;
        float: left;
        display: inline-block;
    }

    .slide-carousel .carousel-indicators {
        margin-bottom: 0;
        bottom: 0;
        background: rgba(0, 0, 0, .5);
    }

    .slide-carousel .carousel-indicators li {
        border-radius: 0;
        width: 20px;
        height: 6px;
    }

    .slide-carousel .carousel-indicators .active {
        margin: 1px;
    }

    .slide-content {
        position: absolute;
        top: 0;
        left: 20%;
        display: block;
        float: left;
        width: 80%;
        max-height: 76%;
        padding: 1.5% 2% 2% 2%;
        overflow-y: auto;
    }

    .slide-content h4 {
        margin-bottom: 3px;
        margin-top: 0;
    }

    .slide-footer {
        position: absolute;
        bottom: 0;
        left: 20%;
        width: 78%;
        height: 20%;
        margin: 1%;
    }

    /* Scrollbars */
    .slide-content::-webkit-scrollbar {
        width: 5px;
    }

    .slide-content::-webkit-scrollbar-thumb:vertical {
        margin: 5px;aaa
        background-color: #999;
        -webkit-border-radius: 5px;
    }

    .slide-content::-webkit-scrollbar-button:start:decrement,
    .slide-content::-webkit-scrollbar-button:end:increment {
        height: 5px;
        display: block;
    }
</style>

<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <!-- <div class="col-md-2">
            <h4>
                Fee Collection Report
            </h4>
        </div> -->
       <div class="box box-primary" style="margin-bottom: 0px;">
      <div class="box-header with-border" style="padding: 20px;">
            <form role="form" action="<?php echo site_url( 'fee_management/fee_reports_fee_waive' ) ?>" method="get" class="form-horizontal">


                    <div class="row">

                        <div class="col-sm-6 col-md-2">
                            <label><?php echo $this->lang->line( 'class' ); ?></label>
                            <select id="class_id" name="class_id" class="form-control">
                                <option value=""><?php echo $this->lang->line( 'select' ); ?></option>
                                <?php
                                foreach ( $classlist as $class ) {
                                    ?>
                                    <option value="<?php echo $class['id'] ?>" <?php if ( set_value( 'class_id' ) == $class['id'] ) echo "selected=selected" ?>><?php echo $class['class'] ?></option>
                                    <?php
                                    $count++;
                                }
                                ?>
                            </select>
                            <span class="text-danger"><?php echo form_error( 'class_id' ); ?></span>
                        </div>

                        <div class="col-sm-6 col-md-2">
                            <label><?php echo $this->lang->line( 'section' ); ?></label>
                            <select id="section_id" name="section_id" class="form-control">
                                <option value=""><?php echo $this->lang->line( 'select' ); ?></option>
                            </select>
                            <span class="text-danger"><?php echo form_error( 'section_id' ); ?></span>
                        </div>
                        <div class="col-sm-6 col-md-2">
                            <label>Transaction Status</label>
                           <?php echo $search_type_paid; ?>

                        <select class="form-control" name="search_type_paid" id="search_type_paid" >
                            <option value="student" <?php echo set_select( 'search_type_paid', 'student'), true  ?>>Student wise</option>
                            <option value="voucher" <?php echo set_select( 'search_type_paid', 'voucher' )  ?>>Voucher wise</option>  
                        </select>
                        </div>
                        <div class="col-sm-6 col-md-2">
                            <label>Date from</label>
                            <input type="text" name="date_from"  id="date_from" class="form-control date" value="<?= set_value( 'date_from' ) ?>" readonly>
                        </div>

                        <div class="col-sm-6 col-md-2">
                            <label>Date to</label>
                            <input type="text" name="date_to" id="date_to" class="form-control date" value="<?= set_value( 'date_to' ) ?>" readonly>
                        </div>

                        <div class="col-sm-6 col-sm-1" style="padding: 0px 0px 0px 0px;"> 
                                        <label>Session</label>
                                         <select id="session_id" name="session_id" class="form-control ">
                                        <option value=""><?php echo $this->lang->line( 'select' ); ?></option>
                                        <?php
                                        foreach ( $sessionlist as $session ) {
                                            ?>
                                            <option value="<?php echo $session['id'] ?>" <?php
                                            if ( $current_session == $session['id'] ) {
                                                echo "selected =selected";
                                            }
                                            ?>><?php echo $session['session'] ?></option>
                                            <?php
                                            $count++;
                                        }
                                        ?>
                                    </select></div>
                        <div class="col-sm-1 pull-right" >
                            <label style="display: block;">&nbsp </label>
                            <button type="submit" name="search" value="search_filter" class="btn btn-primary btn-sm">
                                <i class="fa fa-search"></i> <?php echo $this->lang->line( 'search' ); ?>
                            </button>
                        </div>
                    </div>
            </form>
        </div>
          </div>



    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
         
     <?php if($search_type_paid == 'voucher'){ ?>


	        <div class="col-sm-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Voucher Wise Fee Waived Report </h3>
                    </div>

                    <div class="box-body no-padding">
                        <?php
                        if ( $student_fee_payments === false ) {
                            echo "<h3 class='text-center text-danger'>No fee payment records found!</h3>";
                        } else {
                            ?>
                            <table class="table table-bordered table-hover"  id="waive_reports" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">Sr.No</th>
                                        <th class="text-center">Payment Date</th>
                                        <th class="text-center">User ID</th>
                                        <th class="text-center">Vr.No</th>
                                        <th class="text-center">Ad.No</th>
                                        <th class="text-center"><?php echo $this->lang->line( 'class' )."(".$this->lang->line( 'section' ).")"; ?></th>
                                        <th class="text-center">Roll No</th>
                                        <th >Name</th>
                                        <th>Father name</th>
                                        <th class="text-center">Class Fee</th>
                                        <?php if ($search_type == 'paid'): ?>
                                            <?php if ($transaction_type == "all" || $transaction_type == 'arrears'): ?>
                                            <th class="text-center">Arrears Waived</th>
                                            <?php endif ?>

                                            <?php if ($transaction_type == "all" || $transaction_type == 'fee_paid'): ?>
                                            <th class="text-center">Monthly Fee Waived</th>
                                            <?php endif ?>
                                            <?php if ($transaction_type == "all" || $transaction_type == 'others'): ?>
                                            <th class="text-center">Other fees</th>
                                            <?php endif ?>

                                            <?php if ($transaction_type == "all"): ?>
                                            <th class="text-center">Total Waived Fee</th>
                                            <?php endif ?>
                                        <?php endif ?>
                                        <th class="text-center">Balance</th>
                                        <th class="d-print-none">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $total = new stdClass();
                                    $total->other_fee       = 0;
                                    $total->tuition_fee     = 0;
                                    $total->paid            = 0;
                                    $total_discount_fee     = 0;
                                    $total_fee_paid         = 0;
                                    $total_arrears          = 0;
                                    $total_advance          = 0;
                                    $arrears                = 0;
                                    $advance                = 0;
                                    $tuition_fee_left       = 0;
                                    $current_month_arrears  = 0;


									$student_fee_payments = array_reverse($student_fee_payments);
									  foreach ( $student_fee_payments as $key=>$student_fee_payment ) {
                                      
                       
                       
                                        $updated_date_s = date('d-m-Y',strtotime($student_fee_payment['student']['fee_update_date']));
                                        $this_month     = date('d-m-Y',strtotime('first day of this month'));

                                        if ($search_type == 'paid' || ($search_type == 'pending' && $updated_date_s < $this_month ) ) {
                                        $total->tuition_fee += intval( $student_fee_payment['tuition_fee'] );
                                    if($student_fee_payment['voucher_id'] == 1){
                                        $total->paid += intval( $student_fee_payment['total_paid_fee'] );
                                    }else{
                                        $total->paid += $student_fee_payment['fine']  ;
                                    }
                                   

                                        $discount_fee =  intval($student_fee_payment['student']['fee'])- intval($student_fee_payment['student']['discount']);
                                            $total_discount_fee += $discount_fee;

                                        ?>

                                        <tr <?= $student_fee_payment['student']['struck_off']==1?'style="color:red;"':''?> >
                                         
                                         
                                         
                                            <td class="text-center"><?= $key+1 ;?></td>
                                           
                                            <td class="text-center"><?= date( 'd-M-Y', strtotime( $student_fee_payment['payment_date'] ) ) ?></td>                 <td class="text-center"><?php echo $student_fee_payment['user_id'] ?> </td>

                                            <td class="text-center"><?= $student_fee_payment['voucher_id'] ?> </td>

                                            <td class="text-center"><?= $student_fee_payment['student']['admission_no']." ".$student_fee_payment['struck_off'] ?></td>
                                            <td class="text-center"><?= $student_fee_payment['student']['class']."(".$student_fee_payment['student']['section'].")" ?></td>
                                            <td class="text-center"><?= $student_fee_payment['student']['roll_no'] ?></td>
                                          
                                            
                                            <td class="text-left">
                                                <a href="<?php echo base_url(); ?>student/view/<?php echo $student_fee_payment['student']['id']; ?>" <?= $student['struck_off']==1?'style="color:red;"':''?> >
                                                <?= $student_fee_payment['student']['firstname'] . ' ' . $student_fee_payment['student']['lastname'] ?>
                                                </a>
                                            </td>
                                            <td class="text-left">
                                                <a href="<?= site_url( "family/children_summary/" . $student_fee_payment['student']['id'] ) ?>" <?= $student['struck_off']==1?'style="color:red;"':''?> >
                                                    <?= $student_fee_payment['student']['father_name'] ?>
                                                </a>
                                            </td>
                                          
                                            <td class="text-center"> <?= number_format($discount_fee) ?></td>
                                            <?php  if($student_fee_payment['voucher_id']  == 1 ){  ?>
                                            <?php if ($search_type == 'paid'): ?>
                                            <?php //1657
                                            if ($student_fee_payment['due_fee'] > 0 ) {   //50>0
                                                    $current_month_arrears = intval($student_fee_payment['due_fee']) -intval($discount_fee) - intval($student_fee_payment['fine']);    // cur 50
                                            if ($student_fee_payment['tuition_fee'] <= $current_month_arrears) {  // 100<=50
                                                                    $arrears = intval($student_fee_payment['tuition_fee']);
                                                                    $tuition_fee = 0;
                                                                    $advance = 0;
                                            }elseif (intval($student_fee_payment['tuition_fee']) > intval($current_month_arrears)){
										         $arrears = $current_month_arrears;
	                                            $tuition_fee_left   = $student_fee_payment['tuition_fee'] - $arrears;                                   if ($tuition_fee_left < $discount_fee) {
		    						      if($tuition_fee_left<=$current_month_arrears) { //1500 >= -750
			     								if($current_month_arrears < 0 ){
													$tuition_fee =  $current_month_arrears + $discount_fee ;
										        }else{
 												$tuition_fee=  $tuition_fee_left  ;
											    }
										  }else{
												if($current_month_arrears < 0){
									     		$tuition_fee   = $tuition_fee_left + $current_month_arrears  ;
												}else{
												$tuition_fee   = $tuition_fee_left  ;
												}
										 }
												   $advance = 0;
								           }elseif($tuition_fee_left >= $discount_fee){
													if( $current_month_arrears <= 0 ){   //2500
											    	$tuition_fee = $current_month_arrears  + $discount_fee;
													 }else{
													if($tuition_fee_left >=  $current_month_arrears ){
											        $tuition_fee =  $discount_fee ;
													}else{
												    $tuition_fee =  $discount_fee ;
													}
												    }
											 $tuition_fee_left   = $tuition_fee_left - $discount_fee; //50-0
                                				     $advance            = $tuition_fee_left;     // a= 50
                                					 }
					                    			}
                                                    }
                                                    elseif($student_fee_payment['due_fee'] <= 0){
								                    $tuition_fee = 0;
                                                    $arrears     = 0;
                                                    $advance     = $student_fee_payment['tuition_fee'];
		                                               }
								                if ($arrears < 0) {
                                                    $arrears = 0;
                                                }
								                $total_fee_paid += $tuition_fee;
                                                $total_arrears  += $arrears;
                                                $total_advance  += abs($advance);
											?>
                                            <?php if ($transaction_type == "all" || $transaction_type == 'arrears'): ?>
                                            <td class="text-center"> <?= number_format($arrears) ?></td>
                                            <?php endif ?>

                                            <?php if ($transaction_type == "all" || $transaction_type == 'fee_paid'): ?>
                                            <td class="text-center"> <?= number_format($tuition_fee) ?> </td>
                                            <?php endif ?>

                                            <!-- <td> <?= $student_fee_payment['tuition_fee'] ?></td> -->


                                            <?php if ($transaction_type == "all" || $transaction_type == 'others'): ?>
                                            <td class="text-center">
                                                 <?php
                                               $others = $student_fee_payment["total_paid_fee"] - $student_fee_payment["tuition_fee"];
                                                    $total->other_fee += $others;
                                                    echo number_format($others);
                                                ?>
                                            </td>
                                            <?php endif ?>
                                            <?php if ($transaction_type == "all"): ?>
                                            <td class="text-center"> <?= number_format($student_fee_payment['total_paid_fee']) ?></td>
                                            <?php endif ?>
                                            <?php endif ?>
                                            <?php  }else{ 
                                                $total->other_fee += $student_fee_payment['fine'];
                                                ?>
                                            <td class="text-center">0</td>
                                            <td class="text-center"> 0</td>
                                            <td class="text-center"> <?= number_format($student_fee_payment['fine']) ?></td>
                                            <td class="text-center"> <?= number_format($student_fee_payment['fine']) ?></td>
                                         
                                        <?php }?>
                                        <td class="text-center"> <?= number_format($student_fee_payment['student']['fee_arrears']) ?></td>
                                         
                                        <td>
                                            <a href="<?= site_url( 'fee_management/receive_fee/' . $student_fee_payment['student_id'] ) ?>" title="Student fee details" class="btn btn-xs btn-default"><i class="fa fa-user"></i></a>
                                            </td>
                                         
                                        </tr>

                       

                                           
                                       
                                 <?php   
                                           
                                        
                                        }
                                    }
                                    ?>
                                    <tr class="last_row" style="display: none;">
                                        <td style="display: none;"></td>
                                        <td style="display: none;"></td>
                                        <td style="display: none;"></td>
                                        <td style="display: none;"></td>
                                        <td style="display: none;"></td>
                                        <td style="display: none;"></td>
                                        <td style="display: none;"></td>
                                        <td style="display: none;"></td>
                                        <td colspan="7">Total</td>
                                        <td> </td>
                                        <?php if ($search_type == 'paid'): ?>
                                            <?php if ($transaction_type == "all" || $transaction_type == 'arrears'): ?>
                                            <td> <?= number_format($total_arrears) ?></td>
                                            <?php endif ?>

                                            <?php if ($transaction_type == "all" || $transaction_type == 'fee_paid'): ?>
                                            <td> <?= number_format($total_fee_paid) ?></td>
                                            <?php endif ?>

                                            <?php if ($transaction_type == "all" || $transaction_type == 'advance'): ?>
                                            <td> <?= number_format($total_advance) ?></td>
                                            <?php endif ?>

                                            <?php if ($transaction_type == "all" || $transaction_type == 'others'): ?>
                                            <td> <?= number_format($total->other_fee) ?></td>
                                            <?php endif ?>

                                            <?php if ($transaction_type == "all"): ?>
                                            <td> <?= number_format($total->paid) ?></td>
                                            <?php endif ?>
                                        <?php endif ?>
                                        <td style="display: none;"></td>
                                        <td style="display: none;"></td>
                                    </tr>
                                </tbody>

                                <tfoot style="display: table-footer-group;">
                                    <tr>
                                        <th colspan="9" class="text-right">TOTAL</th>
                                        <th class="text-center"> </th>
                                        <?php if ($search_type == 'paid'): ?>
                                            <?php if ($transaction_type == "all" || $transaction_type == 'arrears'): ?>
                                            <th class="text-center"> <?= number_format($total_arrears) ?></th>
                                            <?php endif ?>
                                            <?php if ($transaction_type == "all" || $transaction_type == 'fee_paid'): ?>
                                            <th class="text-center"> <?= number_format($total_fee_paid) ?></th>
                                            <?php endif ?>
                                            <?php if ($transaction_type == "all" || $transaction_type == 'others'): ?>
                                            <th class="text-center"> <?= number_format($total->other_fee) ?></th>
                                            <?php endif ?>
                                            <?php if ($transaction_type == "all"): ?>
                                            <th class="text-center"> <?= number_format($total->paid) ?></th>
                                            <?php endif ?>
                                        <?php endif ?>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                        <?php  } ?>
                    </div>
                </div>
            </div>
        <?php }else{ ?>
          <div class="col-sm-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Student Wise Fee Waived Report</h3>
                    </div>

                    <div class="box-body ">
                        <?php
                        if ( $student_fee_payments === false ) {
                            echo "<h3 class='text-center text-danger'>No fee payment records found!</h3>";
                        } else {
                            ?>
                            <table class="table table-bordered table-hover" id="student_wise_waive" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">S.No</th>
                                        <th class="text-center">Waived date</th>
                                        <th class="text-center">Ad Date</th>
                                        <th class="text-center">Ad.No</th>
                                        <th class="text-center"><?php echo $this->lang->line( 'class' )."(".$this->lang->line( 'section' ).")"; ?></th>
                                        <th class="text-center">Roll No</th>
                                        <th>Name</th>
                                        <th>Father name</th>
                                        <th class="text-center">Class Fee</th>
                                        <?php if ($search_type == 'paid'): ?>
                                          

                                            <?php if ($transaction_type == "all" || $transaction_type == 'fee_paid'): ?>
                                            <th class="text-center">Monthly Fee Waived</th>
                                            <?php endif ?>
                                            <?php if ($transaction_type == "all" || $transaction_type == 'arrears'): ?>
                                            <th class="text-center">Arrears Waived </th>
                                            <?php endif ?>
                                            <th class="text-center">Fine</th>
                                            <?php if ($transaction_type == "all" || $transaction_type == 'others'): ?>
                                            <th class="text-center">Other fees</th>
                                            <?php endif ?>

                                            <?php if ($transaction_type == "all"): ?>
                                            <th class="text-center">Total Waived</th>
                                            <?php endif ?>
                                        <?php endif ?>
                                        <th class="text-center">Balance</th>
                                        <th class="d-print-none">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $total = new stdClass();
                                    $total->other_fee       = 0;
                                    $total->fine            = 0;
                                    $total->tuition_fee     = 0;
                                    $total->paid            = 0;
                                    $total_discount_fee     = 0;
                                    $total_fee_paid         = 0;
                                    $total_arrears          = 0;
                                    $total_advance          = 0;
                                    $arrears                = 0;
                                    $advance                = 0;
                                    $tuition_fee_left       = 0;
                                    $current_month_arrears  = 0;

                                    $student_fee_payments = array_reverse($student_fee_payments);
                                    
                                    foreach ( $student_fee_payments as $key=>$student_fee_payment ) {
                                        $updated_date_s = date('d-m-Y',strtotime($student_fee_payment['student']['fee_update_date']));
                                        $this_month     = date('d-m-Y',strtotime('first day of this month'));

                                        if ($search_type == 'paid' || ($search_type == 'pending' && $updated_date_s < $this_month ) ) {
                                        $total->tuition_fee += intval( $student_fee_payment['tuition_fee'] );
                                        if($student_fee_payment['voucher_id'] == 1){
                                            $total->paid += intval( $student_fee_payment['total_paid_fee'] );
                                        }else{
                                            $total->paid += $student_fee_payment['fine'];
                                        }
                                        $discount_fee =  intval($student_fee_payment['student']['fee'])- intval($student_fee_payment['student']['discount']);
                                        $total_discount_fee += $discount_fee; ?>
                                        <tr <?= $student_fee_payment['student']['struck_off']==1?'style="color:red;"':''?> >
                                            <td class="text-center"><?php echo $key+1 ;?></td>
                                            <td class="text-center"><?= date( 'd-M-Y', strtotime( $student_fee_payment['payment_date'] ) ) ?></td>
                                            <td class="text-center"><?php echo date('d-m-Y',strtotime($student_fee_payment['student']['created_at'])); ?></td>
                                            <td class="text-center"><?= $student_fee_payment['student']['admission_no']." ".$student_fee_payment['struck_off'] ?></td>
                                            <td class="text-center"><?= $student_fee_payment['student']['class']."(".$student_fee_payment['student']['section'].")" ?></td>
                                            <td class="text-center"><?= $student_fee_payment['student']['roll_no'] ?></td>

                                            <td>
                                                <a href="<?php echo base_url(); ?>student/view/<?php echo $student_fee_payment['student']['id']; ?>" <?= $student['struck_off']==1?'style="color:red;"':''?> >
                                                <?= $student_fee_payment['student']['firstname'] . ' ' . $student_fee_payment['student']['lastname'] ?>
                                                </a>
                                            </td>
                                            <td>
                                                <a href="<?= site_url( "family/children/" . $student_fee_payment['student']['id'] ) ?>" <?= $student['struck_off']==1?'style="color:red;"':''?> >
                                                    <?= $student_fee_payment['student']['father_name'] ?>
                                                </a>
                                            </td>
                                            <td class="text-center"> <?= number_format($discount_fee) ?>  </td>
                                            <?php  if($student_fee_payment['voucher_id']  == 1 ){   ?>
                                            <?php
                                            
                                                if ($student_fee_payment['due_fee'] > 0 )
												 {
                                                     $current_month_arrears = intval($student_fee_payment['due_fee']) - intval($discount_fee) - intval($student_fee_payment['fine']) ;

                                                    if ($student_fee_payment['tuition_fee'] <= $current_month_arrears) {
                                                        $arrears = intval($student_fee_payment['tuition_fee']);
                                                        $tuition_fee = 0;
                                                        $advance = 0;
                                                    }elseif ($student_fee_payment['tuition_fee'] > $current_month_arrears){

															 $arrears            = $current_month_arrears;

													    $tuition_fee_left   = $student_fee_payment['tuition_fee'] - $arrears;

                                                        if ($tuition_fee_left <= $discount_fee) {
                                                            $tuition_fee        = $tuition_fee_left;
                                                            $advance = 0;
                                                        }else{
                                                            $tuition_fee        = $discount_fee;
                                                            $tuition_fee_left   = $tuition_fee_left - $discount_fee;
                                                            $advance            = $tuition_fee_left;
                                                        }

                                                    }

                                                }
												elseif($student_fee_payment['due_fee'] <= 0){
                                                    $tuition_fee = 0;
                                                    $arrears     = 0;
                                                    $advance     = $student_fee_payment['tuition_fee'];
                                                }
                                                if ($arrears < 0) {
                                                    $arrears = 0;
                                                }
                                                $total_fee_waive += $tuition_fee;
                                                $total_arrears  += $arrears;
                                                $total_advance  += abs($advance);
											//	$total_fee_waive  += $student_fee_payment['tuition_fee'];

                                            ?>


                                            

                                            <?php if ($transaction_type == "all" || $transaction_type == 'fee_paid'): ?>
                                            <td class="text-center"> <?= number_format($tuition_fee) ?> </td>
                                            <?php endif ?>
                                            <?php if ($transaction_type == "all" || $transaction_type == 'arrears'): ?>
                                            <td class="text-center"> <?= number_format($arrears) ?></td>
                                            <?php endif ?>
                                            <td class="text-center"> <?= number_format($student_fee_payment['fine']) ?> </td>
                                           
                                            <!-- <td> <?= $student_fee_payment['tuition_fee'] ?></td> -->


                                            <?php if ($transaction_type == "all" || $transaction_type == 'others'): ?>
                                            <td class="text-center">
                                                <?php $others = $student_fee_payment["total_paid_fee"] - $student_fee_payment["tuition_fee"];
                                                if($others > $student_fee_payment['fine']){
                                                    $total->other_fee += $others;
                                                    echo number_format($others);
                                                }else{
                                                    echo 0;
                                                }
                                                $total->fine += $student_fee_payment['fine'];
                                                ?>
                                            </td>
                                            <?php endif ?>
                                            <?php if ($transaction_type == "all"): ?>
                                            <td class="text-center"> <?= number_format($student_fee_payment['total_paid_fee']) ?></td>
                                            <?php endif ?>
                                            <?php  }else{ 
                                                $total->fine += $student_fee_payment['fine'];
                                     
                                                ?>
                                            <td class="text-center">0</td>
                                            <td class="text-center"> 0</td>
                                            <td class="text-center"> <?= number_format($student_fee_payment['fine']) ?></td>
                                            <td class="text-center"> 0</td>
                                            <td class="text-center"> <?= number_format($student_fee_payment['fine']) ?></td>

                                    <?php }?>
                                        
                                            <td class="text-center"> <?= number_format($student_fee_payment['student']['fee_arrears']) ?></td>
                                            <td>
                                                <a href="<?= site_url( 'fee_management/receive_fee/' . $student_fee_payment['student_id'] ) ?>" title="Student fee details" class="btn btn-xs btn-default"><i class="fa fa-user"></i></a>
                                            </td>
                                        </tr>

                                    <?php
                                        }
                                    }
                                    ?>
                                    <tr class="last_row" style="display: none;">
                                        <td style="display: none;"></td>
                                        <td style="display: none;"></td>
                                        <td style="display: none;"></td>
                                        <td style="display: none;"></td>
                                        <td style="display: none;"></td>
                                        <td style="display: none;"></td>
                                        <td style="display: none;"></td>
                                        <td colspan="7">Total</td>
                                        <td> <?= number_format($total_discount_fee) ?></td>
                                        <?php if ($search_type == 'paid'): ?>
                                            <?php if ($transaction_type == "all" || $transaction_type == 'arrears'): ?>
                                            <td> <?= number_format($total_arrears) ?></td>
                                            <?php endif ?>

                                            <?php if ($transaction_type == "all" || $transaction_type == 'fee_paid'): ?>
                                            <td> <?= number_format($total_fee_waive) ?></td>
                                            <?php endif ?>

                                            <td> <?= number_format($total->fine) ?></td>

                                            <?php if ($transaction_type == "all" || $transaction_type == 'others'): ?>
                                            <td> <?= number_format($total->other_fee) ?></td>
                                            <?php endif ?>

                                            <?php if ($transaction_type == "all"): ?>
                                            <td> <?= number_format($total->paid) ?></td>
                                            <?php endif ?>
                                        <?php endif ?>
                                  
                                        <td style="display: none;"></td>
                                        <td style="display: none;"></td>
                                    </tr>
                                </tbody>

                                <tfoot style="display: table-footer-group;">
                                    <tr>
                                        <th colspan="8" class="text-right">TOTAL</th>
                                        <th class="text-center"> <?= number_format($total_discount_fee) ?></th>
                                        <?php if ($search_type == 'paid'): ?>
                                            <?php if ($transaction_type == "all" || $transaction_type == 'arrears'): ?>
                                            <th class="text-center"> <?= number_format($total_arrears) ?></th>
                                            <?php endif ?>

                                            <?php if ($transaction_type == "all" || $transaction_type == 'fee_paid'): ?>
                                            <th class="text-center"> <?= number_format($total_fee_waive) ?></th>
                                            <?php endif ?>
                                            <td> <?= number_format($total->fine) ?></td>

                                            <?php if ($transaction_type == "all" || $transaction_type == 'others'): ?>
                                            <th class="text-center"> <?= number_format($total->other_fee) ?></th>
                                            <?php endif ?>

                                            <?php if ($transaction_type == "all"): ?>
                                            <th class="text-center"> <?= number_format($total->paid) ?></th>
                                            <?php endif ?>
                                        <?php endif ?>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>

         <?php }
          ?>
         </div>

    </section>
</div>
<script type="text/javascript">
    function getSectionByClass( class_id, section_id ) {
        if ( class_id != "" && section_id != "" ) {
            $( '#section_id' ).html( "" );
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line( 'select' ); ?></option>';
            $.ajax( {
                type: "GET",
                url: base_url + "sections/getByClass",
                data: {'class_id': class_id},
                dataType: "json",
                success: function ( data ) {
                    $.each( data, function ( i, obj ) {
                        var sel = "";
                        if ( section_id == obj.section_id ) {
                            sel = "selected";
                        }
                        div_data += "<option value=" + obj.section_id + " " + sel + ">" + obj.section + "</option>";
                    } );
                    $( '#section_id' ).append( div_data );
                }
            } );
        }
    }

    $( document ).ready( function () {
        var class_id = $( '#class_id' ).val();
        var section_id = '<?php echo set_value( 'section_id' ) ?>';
        getSectionByClass( class_id, section_id );
        $( document ).on( 'change', '#class_id', function ( e ) {
            $( '#section_id' ).html( "" );
            var class_id = $( this ).val();
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line( 'select' ); ?></option>';
            $.ajax( {
                type: "GET",
                url: base_url + "sections/getByClass",
                data: {'class_id': class_id},
                dataType: "json",
                success: function ( data ) {
                    $.each( data, function ( i, obj ) {
                        div_data += "<option value=" + obj.section_id + ">" + obj.section + "</option>";
                    } );
                    $( '#section_id' ).append( div_data );
                }
            } );
        } );


        $( '.date' ).datepicker( {
            format: 'mm/dd/yyyy',
            autoclose: true

        } );
    } );

</script>
<script type="text/javascript">
  $(document).ready(function() {
      $("#search_type").change(function() {
          if ($(this).val() != 'paid')
              $("#transaction_type").attr("disabled", "disabled");
		 else
              $("#transaction_type").removeAttr("disabled");


      });
  });

  $(document).ready(function() {
      $("#search_type").change(function() {
          if ($(this).val() != 'paid')
     		  $("#date_to").attr("disabled", "disabled");
	      else
			    $("#date_to").removeAttr("disabled");
      });
  });


   $(document).ready(function() {
      $("#search_type").change(function() {
          if ($(this).val() != 'paid')
     		  $("#date_from").attr("disabled", "disabled");
	      else
			    $("#date_from").removeAttr("disabled");
      });
  });





</script>


<script type="text/javascript">

  $(document).ready(function() {
    $("#search_type").change(function() {
          if ($(this).val() != 'paid')
              $("#transaction_type").attr("disabled", "disabled");

		 else
              $("#transaction_type").removeAttr("disabled");


      });
  });

   $(document).ready(function() {
    $("#search_type").change(function() {
          if ($(this).val() != 'paid')
              $("#search_type_paid").attr("disabled", "disabled");

		 else
              $("#search_type_paid").removeAttr("disabled");


      });
  });

  $(document).ready(function() {
      $("#search_type").change(function() {
          if ($(this).val() != 'paid')
     		  $("#date_to").attr("disabled", "disabled");
	      else
			    $("#date_to").removeAttr("disabled");
      });
  });


   $(document).ready(function() {
      $("#search_type").change(function() {
          if ($(this).val() != 'paid')
     		  $("#date_from").attr("disabled", "disabled");
	      else
			    $("#date_from").removeAttr("disabled");
      });
  });


</script>
















