
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
        margin: 5px;
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
            <form role="form" action="<?php echo site_url( 'fee_management/fee_reports2' ) ?>" method="get" class="form-horizontal">


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
                          <div class="col-sm-6 col-md-1">
                            <label>Search Type</label>
                            <select class="form-control" name="search_type" id="search_type">
                                <option value="paid" <?= set_select( 'search_type', 'paid', true ) ?>>Paid</option>
                                <option value="pending" <?= set_select( 'search_type', 'pending' ) ?>>Unpaid</option>
                            </select>
                        </div>








                        <div class="col-sm-6 col-md-2">
                            <label>Transaction Types</label>
  <select id="transaction_type" name="transaction_type" class="form-control" >
                                <option value="all" >All</option>
                                <option value="fee_paid" <?php if ( $transaction_type == "fee_paid" ) echo "selected=selected" ?>>Tution Fee Paid</option>
                                <option value="arrears" <?php if ( $transaction_type == "arrears" ) echo "selected=selected" ?> >Arrears</option>
                                <option value="advance" <?php if ( $transaction_type == "advance" ) echo "selected=selected" ?> >Advance</option>
                                <option value="others" <?php if ( $transaction_type == "others" ) echo "selected=selected" ?> >Others</option>
                            </select>
                            <span class="text-danger"><?php echo form_error( 'transaction_type' ); ?></span>
                        </div>








                        <div class="col-sm-6 col-md-2">
                            <label>Date from</label>
                            <input type="text" name="date_from" class="form-control date" id="date_to" value="<?= set_value( 'date_from' ) ?>" readonly >
                        </div>

                        <div class="col-sm-6 col-md-2">
                            <label>Date to</label>
                            <input type="text" name="date_to" class="form-control date" id="date_from" value="<?= set_value( 'date_to' ) ?>" readonly >
                        </div>


                        <div class="col-sm-1">
                            <label style="display: block;">&nbsp</label>
                            <button type="submit" name="search" value="search_filter" class="btn btn-primary btn-sm">
                                <i class="fa fa-search"></i> <?php echo $this->lang->line( 'search' ); ?>
                            </button>
                        </div>
                    </div>

            </form>

                     <?php
	    if($search_type === 'paid'){

        $this->load->view('layout/student_wise');

		}

    ?>
    </div>
    </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <i class="fa fa-search"></i> <?php echo $this->lang->line( 'select_criteria' ); ?></h3>
                    </div>
                    <div class="box-body">

                        <?php $this->general_library->err_msg() ?>

                        <div class="">
                            <div class="col-md-12">
                                <form role="form" action="<?php echo site_url( 'fee_management/fee_reports' ) ?>" method="get" class="form-horizontal">

                                    <div class="form-group">
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
                                            <label>Transaction Types</label>
                                            <select id="transaction_type" name="transaction_type" class="form-control">
                                                <option value="all" >All</option>
                                                <option value="fee_paid" <?php if ( $transaction_type == "fee_paid" ) echo "selected=selected" ?>>Tution Fee Paid</option>
                                                <option value="arrears" <?php if ( $transaction_type == "arrears" ) echo "selected=selected" ?> >Arrears</option>
                                                <option value="advance" <?php if ( $transaction_type == "advance" ) echo "selected=selected" ?> >Advance</option>
                                                <option value="others" <?php if ( $transaction_type == "others" ) echo "selected=selected" ?> >Others</option>
                                            </select>
                                            <span class="text-danger"><?php echo form_error( 'transaction_type' ); ?></span>
                                        </div>

                                        <div class="col-sm-6 col-md-2">
                                            <label>Date from</label>
                                            <input type="text" name="date_from" class="form-control date" value="<?= set_value( 'date_from' ) ?>" readonly>
                                        </div>

                                        <div class="col-sm-6 col-md-2">
                                            <label>Date to</label>
                                            <input type="text" name="date_to" class="form-control date" value="<?= set_value( 'date_to' ) ?>" readonly>
                                        </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12 col-md-12">
                                                <?php if ( $student_fee_payment_types !== false ): ?>
                                                    <b>Other Fee Types</b>
                                                    <br>
                                                    <div class="row">
                                                        <?php $count = 0; ?>
                                                        <?php foreach ( $student_fee_payment_types as $fee_payment_type ): ?>
                                                                <?php if ($count != 0 && $count%5 == 0): ?>
                                                                    </div>
                                                                    <div class="row">
                                                                <?php endif ?>
                                                                <label class="col-md-2">
                                                                    <input type="checkbox" name="fee_payment_type[<?= $count ?>]" value="<?= $fee_payment_type['name'] ?>" <?= set_checkbox( "fee_payment_type[{$count}]" ) ?>>
                                                                    <?= $fee_payment_type['name'] ?>
                                                                </label>
                                                            <?php $count++; ?>
                                                        <?php endforeach; ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button type="submit" name="search" value="search_filter" class="btn btn-primary btn-sm pull-right checkbox-toggle">
                                                <i class="fa fa-search"></i> <?php echo $this->lang->line( 'search' ); ?>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->

<?php if($search_type == 'pending'){ ?>

  <div class="col-sm-12">


           <form action="" method="post" >

                 <div class="box box-primary">
                 <div class="box-header with-border">


                            <h3 class="box-title"><?= date('M'); ?> Unpaid Vouchers (Tuition Fee)</h3>
                            <div class="checkbox pull-right">
                                    <label>
                                        <input type="checkbox" class="bank_copy" id="bank_copy" name="bank_copy" value="1" checked>
                                        <span class="text-danger">
                                            <b>Bank Copy</b>
                                        </span>
                                    </label>
                                </div>
                        </div>

                        <div class="box-body">

                            <table class="table     table-bordered table-hover example" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Vr No</th>
                                             <th class="text-center">Ad Date</th>
                                            <th class="text-center">Ad No</th>

                                            <th class="text-left">Student Name</th>
                                            <th class="text-left">Father Name</th>
                                            <th class="text-left">Class</th>

                                            <th class="text-center"> Due Fee</th>

                                            <th class="text-center">Arrears</th>
                                            <th class="text-center">Total Fee.</th>

                                            <th class="text-center">Issue Date</th>
                                            <th class="text-center">Due Date</th>

                                            <th class="text-right">Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>

<?php /*?> <?php

 print_r($unpaid_students);
 exit();
 ?><?php */?>
                              <?php foreach ( $unpaid_students as $unpaid_student ): ?>
                                          <?php   $date = $unpaid_student['created_voucher'] ?>
                                                    <tr>
                                        <?php     $date2  =   $unpaid_student['student']['admission_date'];
                                              ?>
                                                 <td align="center"><?php echo $unpaid_student['voucher_id']  ?></td>
                                                 <td align="center"><?php echo date('d-M-y',strtotime($date2))  ?></td>
                                                 <td align="center"><?php echo $unpaid_student['student']['admission_no']  ?></td>


                                                    <td align="left">
													<a href="<?php echo base_url(); ?>student/view/<?php echo $unpaid_student['student']['id']; ?>" <?= $student['struck_off']==1?'style="color:red;"':''?> >
													<?php echo $unpaid_student['student']['firstname'].$unpaid_student['student']['lastname']  ?>
                                                    </a>

                                                    </td> <td align="left">
                              <a href="<?= site_url( "family/children/" . $unpaid_student['student']['id'] ) ?>" <?= $student['struck_off']==1?'style="color:red;"':''?> >


                                                <?php echo $unpaid_student['student']['father_name']  ?>

                                              </a>
                                              </td>
                                                <td align="left"><?php echo $unpaid_student['student']['class'].'/'.$unpaid_student['student']['section']  ?></td>

                                                    <td align="left">
                                                  <table class="table table-bordered    " style="margin-bottom: 0px;">
                                                        <tbody>
													<?php foreach( $unpaid_student['voucher_fee_types'] as $other_fee ){ ?>
                                                <tr>
                                                <td class="text-center"><?= number_format($other_fee['amount']) ?></td>
                                                <?php  $total = $other_fee['amount']; ?>
                                                <?php  $total_fee_description += $other_fee['amount']; ?>
                                                                        </tr>

                                                    <?php }?>


                                                    </tbody>
                                                    </table>
                                                    </td>

                                                 <td align="center"><?php echo number_format($unpaid_student['voucher_arrears'])  ?> </td>
                                                 <?php $total_arrears +=$unpaid_student['voucher_arrears'] ?>

                                                 <?php $total_fee = $unpaid_student['voucher_arrears'] + $total  ?>
                                                 <?php $total_fee_due += $total_fee ?>


                                                <td align="center"> <?php echo  number_format($total_fee) ?></td>



                                             <td align="center"><?php echo  date('d-m-y',strtotime($date))   ?> </td>

                       <td align="center"><?php echo  date( 'd-m-y',strtotime($unpaid_student['due_voucher']))  ?> </td>

                                                  <td align="center">







                         <input type="hidden" name="student_ids[]" value="<?= $unpaid_student['student_id'] ?>">

                                            <?php $admind = $this->session->userdata( 'admin' );
                                            $this->load->helper('menu_helper');
                                            $permission = admin_permission($admind['id']);
                                            ?>


						 <?php
                                                    if ($permission->delete_fee == 1) {
                                                    ?>
                                  <input type="hidden" class="student_redirect" name="redirect" value="<?= urlencode( current_url() ) ?>">
      <button type="submit" class="btn btn-default btn-xs pull-right"
      formaction="<?= site_url( 'fee_management/delete_unpaid/' . $unpaid_student['voucher_id'] ) . '?redirect=' . urlencode( current_url() ) ?>" onclick="return confirm('Do you really want to revert this Unpaid Voucher?')" data-toggle="tooltip" title="" data-original-title="Delete" >
     <i class="fa fa-trash-o"></i>
        </button>
              <?php
				}
			   ?>


     <button type="submit" class="btn btn-default btn-xs pull-right"
      formaction="<?php echo base_url(); ?>fee_management/fee_voucher_process2?vrno=<?php echo $unpaid_student['voucher_id'] ?>&student_id="<?php echo $unpaid_student['student_id'] ?>" " data-toggle="tooltip" title="" data-original-title="Voucher">

     <i class="fa fa-newspaper-o" aria-hidden="true"> </i>
                                                       </button>


            <button type="submit" class="btn btn-default btn-xs pull-right"
      formaction="<?= site_url( 'fee_management/receive_fee/' . $unpaid_student['student_id'] )   ?>" data-toggle="tooltip" title="" data-original-title="Student Account"  >
        <i class="fa fa-money"></i>
        </button>
                                                            </td>

                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>


                                         <tfoot style="display: table-footer-group;">
                                    <tr>
                                        <th colspan="5" class="text-right"></th>
                                                   <th  class="text-center">TOTAL</th>
                                           <th class="text-center"> <?= number_format($total_fee_description) ?></th>
                                            <th class="text-center"> <?= number_format($total_arrears) ?></th>
                                            <th class="text-center"><?= number_format($total_fee_due) ?> </th>
                                            <th class="text-center"> </th>



                                            <th class="text-center"> </th>

                                            <th class="text-center"> </th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </tfoot>


                                </table>
</form>
                        </div>

                    </div>
            </div>

<?php }else{ ?>
  <div class="col-sm-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Student Wise Fee Collection Report</h3>
                    </div>

                    <div class="box-body no-padding">
                        <?php
                        if ( $student_fee_payments === false ) {
                            echo "<h3 class='text-center text-danger'>No fee payment records found!</h3>";
                        } else {
                            ?>
                            <table class="table     table-bordered table-hover example" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">S.No</th>
                                        <th class="text-center">Last Payment date</th>
                                        <th class="text-center">Ad Date</th>
                                        <th class="text-center">Ad.No</th>
                                        <th class="text-center"><?php echo $this->lang->line( 'class' )."(".$this->lang->line( 'section' ).")"; ?></th>
                                        <th class="text-center">Roll No</th>
                                        <th>Name</th>
                                        <th>Father name</th>
                                        <th class="text-center">Class Fee</th>
                                        <?php if ($search_type == 'paid'): ?>
                                            <?php if ($transaction_type == "all" || $transaction_type == 'arrears'): ?>
                                            <th class="text-center">Arrears Paid</th>
                                            <?php endif ?>

                                            <?php if ($transaction_type == "all" || $transaction_type == 'fee_paid'): ?>
                                            <th class="text-center">Due Fee Paid</th>
                                            <?php endif ?>

                                            <?php if ($transaction_type == "all" || $transaction_type == 'advance'): ?>
                                            <th class="text-center">New Advance</th>
                                            <?php endif ?>

                                            <?php if ($transaction_type == "all" || $transaction_type == 'others'): ?>
                                            <th class="text-center">Other fees</th>
                                            <?php endif ?>

                                            <?php if ($transaction_type == "all"): ?>
                                            <th class="text-center">Total Paid</th>
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
                                        $total->paid += intval( $student_fee_payment['total_paid_fee'] );
                                        $discount_fee =  intval($student_fee_payment['student']['fee'])- intval($student_fee_payment['student']['discount']);
                                        $total_discount_fee += $discount_fee;



                                        ?>
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
                                            <td class="text-center"> <?= number_format($discount_fee) ?></td>
                                            <?php if ($search_type == 'paid'): ?>

                                            <?php
                                                if ($student_fee_payment['due_fee'] > 0 )
												 {


       $current_month_arrears = intval($student_fee_payment['due_fee']) - intval($discount_fee) - intval($student_fee_payment['late_payment_fee']) ;

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

                                            <?php if ($transaction_type == "all" || $transaction_type == 'advance'): ?>
                                            <td class="text-center"> <?= number_format(abs($advance)) ?></td>
                                            <?php endif ?>
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
                                        <th colspan="8" class="text-right">TOTAL</th>
                                        <th class="text-center"> <?= number_format($total_discount_fee) ?></th>
                                        <?php if ($search_type == 'paid'): ?>
                                            <?php if ($transaction_type == "all" || $transaction_type == 'arrears'): ?>
                                            <th class="text-center"> <?= number_format($total_arrears) ?></th>
                                            <?php endif ?>

                                            <?php if ($transaction_type == "all" || $transaction_type == 'fee_paid'): ?>
                                            <th class="text-center"> <?= number_format($total_fee_paid) ?></th>
                                            <?php endif ?>

                                            <?php if ($transaction_type == "all" || $transaction_type == 'advance'): ?>
                                            <th class="text-center"> <?= number_format($total_advance) ?></th>
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
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>


<?php }?>





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