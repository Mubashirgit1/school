<style type="text/css">
    .disabledbutton {
        pointer-events: none;
        opacity: 0.4;
    }

    .disabledbutton_tuition_fee {
        pointer-events: none;
        opacity: 0.8;
    }
    .outlined {
        border: 1px solid #CBCBC9;
    }


    .date {
        z-index: 9999;
        top: 0;
        left: 0;
        padding: 4px;
        margin-top: 1px;
        -webkit-border-radius: 4px;
        -moz-border-radius: 4px;
        border-radius: 4px;
    }

</style>



<?php $currency_symbol = $this->customlib->getSchoolCurrencyFormat();?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="box-header with-border" style="text-align: center;">
            <div class="pull-left" style="padding-right:40px">
                <div class="btn-group" role="group" aria-label="#">
                    <?php  $admind = $this->session->userdata( 'admin' );
                    $this->load->helper('menu_helper');
                    $permission = admin_permission($admind['id']); ?>
                    <?php foreach($children as $child){
                        if($child['id'] !== $student['id'] ){  ?>
                            <a href="<?php echo base_url(); ?>fee_management/receive_fee/<?php echo $child['id'] ?>" class="btn btn-default" ><?php
                                echo $child['firstname']." ".$child['lastname']; ?>
                            </a>
                        <?php }else{  ?>
                            <a href="<?php echo base_url(); ?>fee_management/receive_fee/<?php echo $child['id'] ?>" class="btn btn-default" ><?php
                                echo '<span class="text-blue" style="font-weight:bold">'.$child['firstname'].' '.$child['lastname'].'</span>'; ?>
                            </a>
                        <?php } } ?>
                </div>
            </div>
            <div class="pull-right">
                <a href="<?php echo base_url(); ?>family/children_summary/<?php echo $child['id'] ?>" class="btn btn-default" >Sibling Summary
                </a>
            </div>
        </div>
    </section>
   
    <section class="content">
      

            <div class="row">
      
            <!-- left column -->
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <div class="row">
                            <div class="col-md-4">
                                <h3 class="box-title"><?= $student['firstname']." ".$student['lastname'] ?> information</h3>
                            </div>
                            <div class="col-md-8 ">
                                <div class="btn-group pull-right">
                                    <a href="<?php echo base_url(); ?>fee_management/fee_voucher?student_id=<?php echo $student['id'] ?>" type="button" class="btn btn-default btn-sm" data-toggle="tooltip" title="voucher" >
                                        <i class="fa fa-newspaper-o" aria-hidden="true"> </i> <?php echo $this->lang->line( 'back' ); ?>
                                    </a>
                                    <a style="margin-left: 5px;" href="<?php echo base_url(); ?>student/view/<?php echo $student['id'] ?>" class="btn btn-default btn-sm" data-toggle="tooltip" type ="button" title="<?php echo $this->lang->line( 'show' ); ?>">
                                        <i class="fa fa-reorder"></i>
                                    </a>
                                    <?php
                                    $admind = $this->session->userdata( 'admin' );?>
                                    <?php if ($permission->student_access == 1) {	?>
                                        <a href="<?= site_url( "student/edit/{$student['id']}" ) ?>" class="btn btn-default btn-sm"  data-toggle="tooltip"  title="Edit"   style="margin-left: 5px;">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                    <?php } ?>
                                    <?php if ($permission->arrears_adjust == 1 ){
                                        if ( $voucher_details === null  ) {	?>
                                            <button  style="margin-left:5px" type="button" class="btn btn-sm btn-default"  id="free_submit" data-toggle="modal" data-target="#free">
                                                <i class="fa fa-gift"></i>
                                            </button>
                                        <?php } }?>
                                </div>
                            </div>
                        </div>
                    </div><!--./box-header-->
                    <div class="box-body" style="padding-top:0;">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="sfborder">
                                    <div class="col-md-2">

                                        <?php   if($student['image'] == null){
                                            $url = base_url() .'/uploads/student_images/no_image.png';
                                        }else{
                                            $url = base_url() .$student['image'];
                                        }
                                        ?>
                                        <img width="115" height="115" class="round5" src="<?php echo $url ?>" alt="No Image">
                                    </div>
                                    <?php
                                    //calculate fee and arrears
                                    $arrears = 0;
                                    $arrears_check = false;
                                    $monthly_fee = $student_fee - $student['discount'];
                                    if ($voucher_details === null ) {
                                        $_fee_tuition = ( $voucher_tuition_fee !== null ? floatval( $voucher_tuition_fee ) : floatval( $student['fee_arrears'] ) - floatval( $student['late_payment_fee'] ) );
                                    }else{
                                        $_fee_tuition  = ( $voucher_tuition_fee !== null ? floatval( $voucher_tuition_fee ) : 0 );
                                        if ($voucher_details['arrears'] > 0) {
                                            $arrears_check = true;
                                            if($late_payment_fee == null){
                                                $student_fee_fine_type = $this->custom_option_model->get( 'fine_per_day_for_fee');
                                                $system_fine =   $student_fee_fine_type['value'];
                                            }
                                        if($student['late_payment_fee'] > $system_fine){
                                            $fine =$student['late_payment_fee'] - $system_fine;
                                        }else{
                                            $fine = $student['late_payment_fee'] ;
                                        }
                                            $arrears       = floatval($voucher_details['arrears']) - floatval( $fine );
                                        }
                                    }
                                    $_fee_tuition = ( $_fee_tuition > 0 ? $_fee_tuition : 0 );
                                    if ($_fee_tuition > $monthly_fee) {
                                        $arrears        = $_fee_tuition - $monthly_fee;
                                        $_fee_tuition   = $monthly_fee;
                                    }
                                    $total_arrears = $arrears;
                                    $arrears_advance  = floatval( $student['fee_arrears'] ) - floatval( $student['late_payment_fee'] );
                                    if ($arrears_advance >= 0) {
                                        $arrears_advance = 0;
                                    }else{
                                        $arrears_advance = abs($arrears_advance);
                                    }
                                    // if ($_fee_tuition < $monthly_fee) {
                                    //     $readonly_check = "disabled";
                                    // }
                                    ?>
                                    <div class="col-md-10">
                                        <div class="row">
                                            <table class="table     mb0 font13">
                                                <tbody>
                                                <tr>
                                                    <th class="bozero"><?php echo $this->lang->line( 'name' ); ?></th>
                                                    <td class="bozero"><?php echo $student['firstname'] . " " . $student['lastname'] ?></td>
                                                    <th class="bozero"><?php echo $this->lang->line( 'class_section' ); ?></th>
                                                    <td class="bozero" style="width: 11%;"><?php echo $student['class'] . " (" . $student['section'] . ")" ?> </td>
                                                    <th style="width: 9%;">&nbsp;</th>
                                                    <td style="width: 9%;">&nbsp;</td>
                                                    <td style="width: 9%;">&nbsp;</td>
                                                    <td style="width: 9%;">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <th><?php echo $this->lang->line( 'father_name' ); ?></th>
                                                    <td><?php echo $student['father_name']; ?></td>
                                                    <th><?php echo $this->lang->line( 'admission_no' ); ?></th>
                                                    <td><?php echo $student['admission_no']; ?></td>
                                                    <th>&nbsp;</th>
                                                    <td>&nbsp;</td>
                                                    <td >&nbsp;</td>
                                                    <td >&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <th><?php echo $this->lang->line( 'mobile_no' ); ?></th>
                                                    <td><?php echo $student['mobileno']; ?></td>
                                                    <th><?php echo $this->lang->line( 'roll_no' ); ?></th>
                                                    <td> <?php echo $student['roll_no']; ?></td>
                                                    <th>&nbsp;</th>
                                                    <td>&nbsp; </td>
                                                    <td>&nbsp; </td>
                                                    <td>&nbsp; </td>
                                                </tr>
                                                <tr>
                                                    <th><span> Student monthly fee </span><br> Current Discount </th>
                                                    <td><span>Rs. <b><?= $student_fee ?>  </span><br> Rs. <?= $student['discount'] ?> </b></td>
                                                    <form action="<?= site_url( "student/pkupdate/{$student['id']}" ) . "?redirect=" . urlencode( current_url() ) ?>" method="post">
                                                        <th>Tuition Fee Status <span  style="float: right; margin-right: 10px;" >Discount</span>
                                                            <br>
                                                            <input type="text" class="form-control unpaid_student_input" name="discount" value="<?= set_value( 'discount', $student['discount'] ) ?>" style="height:21px;padding: 0px; width: 60px; float: right; " >
                                                        </th>
                                                        <td >
                                                            <input type="hidden" name="monthly_fee"   value="<?= $monthly_fee ?>">
                                                            <input type="hidden" name="other" id="other" value="<?= $voucher_details['other'] ?>">
                                                            <span> Monthly Due Fee </span>
                                                            <?= $student['struck_off'] == 1 || $permission->arrears_adjust != 1?'<fieldset disabled>':'' ?>
                                                            <input type="text" class="form-control unpaid_student_input" name="fee_dues" value="<?= set_value( 'tuition_fee', $_fee_tuition ) ?>" placeholder="" style="height:21px;padding: 0px; "  >
                                                            <?= $student['struck_off'] == 1 || $permission->arrears_adjust != 1 ?'</fieldset>':'' ?>
                                                        </td>
                                                        <td>
                                                            Arrears:
                                                            <?= $student['struck_off'] == 1 || $permission->arrears_adjust != 1?'<fieldset disabled>':'' ?>
                                                            <input type="text" class="form-control unpaid_student_input" name="arrears" value="<?= set_value( 'arrears_fee', $arrears ) ?>" placeholder="" style="height:20px;padding: 0px; " >
                                                            <?= $student['struck_off'] == 1 || $permission->arrears_adjust != 1 ?'</fieldset>':'' ?>
                                                        </td>
                                                        <td>Advance:
                                                            <?= $student['struck_off'] == 1 || $permission->arrears_adjust != 1?'<fieldset disabled>':'' ?>
                                                            <input type="text" class="form-control" name="advance" value="<?= $arrears_advance ?>" placeholder="" style="height:21px; padding: 0px;"  >
                                                            <input type="submit" style="display: none;" />
                                                            <?= $student['struck_off'] == 1 || $permission->arrears_adjust != 1 ?'</fieldset>':'' ?>
                                                        </td>
                                                    </form>
                                                    <th><span>Fine</span>
                                                        <input type="text" class="form-control" name="fee_dues" value="<?= set_value( 'late_payment_fee', $student['late_payment_fee'] ) ?>" placeholder="" disabled style="height:21px;padding: 0px; " >
                                                    </th>
                                                    <th> <span>Other Fee</span> <?php
                                                        $total_other_fee  = 0;
                                                        foreach ( $unpaid_students_other as $unpaid_student_other ):
                                                            $total_other_fee +=  $unpaid_student_other['total_fee']; ?>
                                                        <?php endforeach; ?>
                                                     <input type="text" class="form-control" name="fee_dues" value="<?= $total_other_fee  ?>" placeholder="" disabled style="height:21px;padding: 0px; " ></th>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <table class="table     mb0 font13">
                                                            <tbody>
                                                            <tr> <td>Discounted Fee</td> </tr>
                                                            <tr> <td><a type="button" class="" data-toggle="modal" data-target="#Mymodal">Previous Fee Discount </a> </td> </tr>
                                                            <tr> <td>Discount Date</td> </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                    <td>
                                                        <table class="table     mb0 font13">
                                                            <tbody>
                                                            <tr> <td> Rs. <?= $student_fee -  $student['discount'] ?> </td> </tr>
                                                            <tr><td> <?= $discount_history['previous_discount'] ?> </td> </tr>
                                                            <tr><td> <?php if($discount_history != null){
                                                                echo date('d-M-Y', strtotime($discount_history['date']));
                                                                    } ?> </td></tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                    <td></td>
                                                    <td colspan="5"> <div id="annual_report">

                                                        </div> </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <!--/.col (left) -->
        </div>

        <div class="row">
            <div class="col-sm-12" style="float:right">
                <div class="box box-primary" >
                    <div class="box-header with-border">
                        <h3 class="box-title">Fee transactions History
                            <?php if( !empty($voucher_id)){   ?>
                                <button type="button" class="btn btn-sm btn-primary voucher_no" onClick="myFunction()"  data-toggle="modal" data-target="#exampleModalLong"> Proceed To Vr No <?= $voucher_id ?></button>
                            <?php }?>
                        </h3>
                        <div class="pull-right">
                            <div class="row">
                                <div class="col-sm-6">
                                    <form action="<?= site_url( 'fee_management/fee_voucher_receive' ) ?>" method="get" class="form-inline">
                                        <input type="hidden" name="redirect" value="<?= current_url() ?>">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="voucher_id" value="" placeholder="Search Voucher ID">
                                        </div>
                                    </form>
                                </div>
                                <div class="col-sm-6">
                                    <form action="<?= site_url( 'fee_management/receive_fee' ) ?>" method="get" class="form-inline">
                                        <div class="form-group">
                                            <input type="text" style="border-radius:4px;" class="form-control search_text balance_sheet_input_submit" name="search_text" value="" placeholder="Search Student A/c"  data-values=".search_text">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                       <div class="box-body">
                            <div class="table-responsive">
                                <table class="table     table-bordered " id="transation_history">
                                    <thead>
                                    <tr>
                                        <th>Payment Date</th>
                                        <th> User ID</th>
                                        <th>Vr ID</th>
                                        <th class="text-center" >Fee Arrears/Fee Waived</th>
                                        <th class="text-center">Fee Waived </th>
                                        <th class="text-center">Monthly fee Paid<br>
                                        <th class="text-center">Prev Balance</th>
                                        <th class="text-center">Balance</th>
                                        <th class="text-center">Other Fees Details</th>
                                        <th class="text-center">Total Other Fee Paid <br></th>
                                        <th class="text-center">Total Fee Paid<br></th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                         </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form action="" method="post" >
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?= date('M'); ?> Unpaid Vouchers (Tuition Fee)  </h3>
                            <div class="checkbox pull-right">
                                <label> </label>
                            </div>
                        </div>
                        <div class="box-body">
                            <table class="table     table-bordered table-hover" id="unpaid_tuition" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th class="text-center">Vr No</th>
                                    <th class="text-center">Due Fee</th>
                                    <th class="text-center">Arrears</th>
                                    <th class="text-center">Total Fee.</th>
                                    <th class="text-center">Issue Date</th>
                                    <th class="text-center">Due Date</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Unpaid Vouchers(Other Fee)  </h3>
                            <div class="checkbox pull-right">
                                <label>
                                    <input type="checkbox" class="bank_copy check21" id="bank_copy" name="bank_copy" value="1" checked>
                                    <span class="text-danger"><b>Bank Copy</b> </span>
                                </label>
                            </div>
                        </div>
                        <div class="box-body">
                            <table class="table     table-bordered table-hover" id="unpaid_other"  cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th class="text-center">Vr No</th>
                                    <th style="width: 240px !important;" ><span class="pull-left">Fee Description</span> <span class="pull-right">Amount</span></th>
                                    <th class="text-center">Total Fee.</th>
                                    <th class="text-center">Issue Date</th>
                                    <th class="text-center">Due Date</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <div class="modal fade" id="free" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">   Fee Waiving Details
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button></h5>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12">
                        <?php $this->general_library->err_msg();
                        echo validation_errors( '<div class="alert alert-danger">', '</div>' ); ?>

                        <div class="box box-primary">
                            <form action="" method="post" id="fee_waive">
                                <?= $student['struck_off'] == 1?'<fieldset disabled>':'' ?>
                                <input type="hidden" name="user_id" value="<?= $admind['username'] ?>" />
                                <input type="hidden" name="admin_access" id="admin_access" value="<?= $permission->delete_fee ?>" />
                                <input type="hidden" name="student_id" value="<?= $student['id']?>">
                                <div class="box-header with-border">
                                    <h3 class="box-title" style="display: block;">
                                        Fee Waiving Details
                                        <?php if ( $voucher_details !== null ): ?>
                                            <small>(Voucher ID: <?= $voucher_details['id'] ?>)</small>
                                        <?php endif; ?>
                                        <button type="submit"  class="btn btn-primary pull-right waive_fee">Proceed to Fee Waive</button>
                                    </h3>
                                </div>
                                <div class="box-body">
                                    <div>
                                        <div class="form-group">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="tution_fee_check_waive" id="tution_fee_check_waive" value="1" <?= $arrears <= 0 || $voucher_details['id'] != null ?' checked="checked"':'' ?>>
                                                    <?= date('M',now()) ?> Tuition fee
                                                    <small>( Monthly fee: <?= $monthly_fee ?> )</small>
                                                </label>
                                            </div>
                                            <input class="form-control" type="number" name="tuition_fee_waive" value="<?= set_value( 'tuition_fee_waive', $_fee_tuition ) ?>"  <?= $arrears > 0 && $voucher_details['id'] == null ?'readonly':'' ?> >
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-md-2" style="padding-right: 0px;">
                                                    <label>Arrears</label>
                                                    <input class="form-control" type="number" name="arrears_waive" value="<?= set_value( 'arrears_waive', $arrears ) ?>" style="padding: 0px 5px 0px 12px;" >
                                                </div>

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label> Description </label>
                                            <input class="form-control" type="text" name="arrears_description_waive" id="arrears_description"    value="Fee Waived"  <?= $total_arrears <= 0 ?'readonly':'required' ?> >
                                        </div>
                                        <?php if ($voucher_details['other'] != 1) { ?>
                                            <div class="form-group submission_date" >
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="late_fee_payment_fine_check_waive" id="fine_waive" value="1" <?= set_checkbox( 'late_fee_payment_fine_check_waive', '1', true ) ?>> Late Fee Fine: <?= intval( $student['late_payment_fee'] ) > 0 ? "+ Rs. {$student['late_payment_fee']}" : "" ?>
                                                    </label>
                                                </div>
                                                <input type="text" class="form-control" name="late_fee_payment_fine_waive" value="<?= set_value( 'late_fee_payment_fine_waive', $student['late_payment_fee'] ) ?>" readonly >
                                            </div>

                                            <?php }?>
                                    </div>
                                    <div  style="display: none">
                                        <?php $ii = 0;
                                        foreach ( $student_fee_types as $student_fee_type ) { ?>
                                            <div class="form-group">
                                                <input type="hidden" class="hello_waive" name="other_fee_types[<?= $ii ?>][name]" value="<?= $student_fee_type['name'] ?>">
                                                <label><?= $student_fee_type['name'] . " <small>( Default: " . $student_fee_type['amount'] . " )</small>" ?></label>
                                                <!-- <input class="form-control" type="number" name="other_fee_types[<?= $ii ?>][amount]" value="<?php //if($receipt->head_name == $student_fee_type['name']) { echo $receipt->head_amount; } else { set_value( 'other_fee_types[' . $ii . '][amount]' ); } ?>"> -->
                                                <input class="form-control hello_waive" type="number" min="0" data-attr="<?= $student_fee_type['name'] ?>"  name="other_fee_types[<?= $ii ?>][amount]" value="<?= set_value( 'other_fee_types[' . $ii . '][amount]', $student_fee_type['voucher_amount'] ) ?>">
                                            </div>
                                            <?php $ii++; }?>
                                    </div>
                                    <div class="form-group submission_date" style="display:none">
                                        <label>Submission Date</label>
                                        <input type="text" class="form-control date" name="submission_date_waive" id="submission_date" value="<?= set_value( 'submission_date_waive', date('Y-m-d') ) ?>" readonly >
                                    </div>
                                </div>
                                <?= $student['struck_off'] == 1?'</fieldset>':'' ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary pull-right waive_fee">Proceed to Fee Waive</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
<span class="hello">
    <div class="modal-dialog" role="document">
         <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">   Fee collection details
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span> </button></h5>
              </div>
             <div class="modal-body">
                <div class="col-sm-12">
                        <?php
                        // if ( $this->session->flashdata( 'msg' ) ) {
                        //      echo $this->session->flashdata( 'msg' );
                        // }else{
                        $this->general_library->err_msg();
                        echo validation_errors( '<div class="alert alert-danger">', '</div>' );
                        // }
                        ?>
                   <div class="box box-primary">
                        <form action="" method="post" id="collect_fee">
                         <?= $student['struck_off'] == 1?'<fieldset disabled>':'' ?>
                         <input type="hidden" name="user_id" value="<?= $admind['username'] ?>">
                         <input type="hidden" name="admin_access" id="admin_access" value="<?= $permission->delete_fee ?>">
                         <input type="hidden" name="student_id" value="<?= $student['id'] ?>">
                        <div class="box-header with-border">
                            <h3 class="box-title" style="display: block;">
                                Fee collection details
                                <?php if ( $voucher_details !== null ): ?>
                                    <small>(Voucher ID: <?= $voucher_details['id'] ?>)</small>
                                <?php endif; ?>
                                <button type="submit" class="btn btn-primary pull-right collect_fee" data-type="<?=$voucher_details['other']?>" >Collect fee</button>
                            </h3>
                        </div>
                        <div class="box-body">
                            <?php if ( $voucher_details !== null ): ?>
                                <input type="hidden" name="voucher_id1" value="<?= $voucher_details['id'] ?>">
                            <?php endif; ?>
                            <div id="tuition_fee">
                             <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="tution_fee_check" id="tution_fee_check" value="1" <?= $arrears <= 0 || $voucher_details['id'] != null ?' checked="checked"':'' ?>>
                                        <?= date('M',now()) ?> Tuition fee
                                        <small>( Monthly fee: <?= $monthly_fee ?> )</small>
                                    </label>
                                </div>
                                <input class="form-control" type="number" name="tution_fee1" value="<?= set_value( 'tution_fee1', $_fee_tuition ) ?>" id="tuition_fee" <?= $arrears > 0 && $voucher_details['id'] == null ?'readonly':'' ?> >
                             </div>
                                <?php $date = date('n');
                                $monthName = date('F', mktime(0, 0, 0, $date, 10));
                                $month = '["'.$monthName.'"]';
                                if($voucher_details['month_names'] == $month){
                                    ?>
                                    <div class="form-group">
                                <div class="row">
                                    <div class="col-md-2" style="padding-right: 0px;">
                                        <label>Arrears</label>
                                        <input class="form-control" type="number" name="arrears_fee1" value="<?= set_value( 'arrears_fee1', $arrears ) ?>" style="padding: 0px 5px 0px 12px;" >
                                    </div>
                                    <div class="col-md-10" style="padding-left: 6px;">
                                                <?php  if ($arrears > 0) { ?>
                                                    <table class="table text-right" style="margin-bottom: 0px;">
                                            <?php
                                            $n_months = round($arrears/$monthly_fee)+1;
                                            $months = array();
                                            $months = array(1 => 'Jan.', 2 => 'Feb.', 3 => 'Mar.', 4 => 'Apr.', 5 => 'May', 6 => 'Jun.', 7 => 'Jul.', 8 => 'Aug.', 9 => 'Sep.', 10 => 'Oct.', 11 => 'Nov.', 12 => 'Dec.');
                                            $transposed = array_slice($months, date('n')-1, 12, true) + array_slice($months, 0, date('n'), true);
                                            $t_month = array_slice($transposed, -$n_months, 12, true);
                                            $month_fee = array();
                                            foreach ($t_month as $key => $tm) {
                                                if ($arrears >= $monthly_fee) {
                                                    $month_fee[$key] = $monthly_fee;
                                                    $arrears = $arrears - $monthly_fee;
                                                }elseif($arrears < $monthly_fee && $arrears > 0){
                                                    $month_fee[$key] = $arrears;
                                                    $arrears = $arrears - $monthly_fee;
                                                }elseif($arrears < 0){
                                                    $month_fee[$key] = 0;
                                                }
                                            }
                                            if (count($month_fee) < count($t_month)) {
                                                array_push($month_fee, 0);
                                            }
                                            $month_fee = array_reverse($month_fee); ?>
                                                        <tr>
                                                <?php  foreach ($t_month as $key => $tm) { ?>
                                                    <th class="text-right" style="padding-top: 0px; border-top: 0px;"><?= $tm ?></th>
                                                    <?php
                                                }
                                                ?>
                                                    </tr>
                                                    <tr>
                                                    <?php
                                                    $t_count = 0;
                                                    foreach ($t_month as $tkey => $tm) {
                                                        ?>
                                                        <td style="border: 1px solid #ddd;"><?= $month_fee[$t_count] ?></td>
                                                        <?php
                                                        $t_count++;
                                                    } ?>
                                                    </tr>
                                        </table>
                                                <?php } ?>
                                    </div>
                                </div>
                            </div>
                               <div class="form-group">
                                  <label>Arrears Description</label>
                                  <input class="form-control" type="text" name="arrears_description" id="arrears_description" <?= $total_arrears <= 0 ?'readonly':'required' ?> >
                               </div>
                                <?php }else{  ?>
                               <div class="row">
							     <div class="col-md-2" style="padding-right: 0px;">
                                    <label>Advance</label>
                                    <input class="form-control" type="number" name="advance1" value="<?= set_value( 'advance', $arrears ) ?>" style="padding: 0px 5px 0px 12px;" >
                                 </div>
                               </div>
                               <div class="form-group">
                                  <label>Advance Description</label>
                                  <input class="form-control" type="text" name="advance_description" id="arrears_description" <?= $total_arrears <= 0 ?'readonly':'required' ?> >
                               </div>
                                <?php	} ?>
                                <?php if ($voucher_details['other'] != 1) {?>
                                    <div class="form-group submission_date">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="late_fee_payment_fine_check" id="fine" value="1" <?= set_checkbox( 'late_fee_payment_fine_check', '1', true ) ?>> Late Fee Fine: <?= intval( $student['late_payment_fee'] ) > 0 ? "+ Rs. {$student['late_payment_fee']}" : "" ?>
                                        </label>
                                    </div>
                                   <input type="text" class="form-control" name="late_fee_payment_fine" value="<?= set_value( 'late_fee_payment_fine', $student['late_payment_fee'] ) ?>" readonly >
                                 </div>
                                <?php }?>
                             </div>
                            <div id="other_fee">
                                <?php $ii = 0;
                                foreach ( $student_fee_types as $student_fee_type ) { ?>
                                    <div class="form-group">
                                     <input type="hidden" class="hello1" name="other_fee_types[<?= $ii ?>][name]" value="<?= $student_fee_type['name'] ?>">
                                       <label><?= $student_fee_type['name'] . " <small>( Default: " . $student_fee_type['amount'] . " )</small>" ?></label>
                                        <!-- <input class="form-control" type="number" name="other_fee_types[<?= $ii ?>][amount]" value="<?php //if($receipt->head_name == $student_fee_type['name']) { echo $receipt->head_amount; } else { set_value( 'other_fee_types[' . $ii . '][amount]' ); } ?>"> -->
                                         <input class="form-control hello1" type="number" min="0" data-attr="<?= $student_fee_type['name'] ?>"  name="other_fee_types[<?= $ii ?>][amount]" value="<?= set_value( 'other_fee_types[' . $ii . '][amount]', $student_fee_type['voucher_amount'] ) ?>">
                                   </div>
                                    <?php $ii++; }?>
                            </div>

                             <div class="form-group submission_date2">
                                <label> Submission Date </label>
                                <input type="text" class="form-control date" name="submission_date" id="submission_date" value="<?= set_value( 'submission_date', date('m/d/Y H:i:s', now()) ) ?>"  >
                            </div>
                            <?= $student['struck_off'] == 1?'</fieldset>':'' ?>
                        </div>
                    </div>
                </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                 <button type="submit" class="btn btn-primary collect_fee pull-right" data-type="<?=$voucher_details['other']?> ">Collect fee</button>
                  </form>
              </div>
        </div>
  </div>
   </span>

    </div>


    <!--    <div class="modal fade" id="myModal" role="dialog">-->
    <!--        <div class="modal-dialog">-->
    <!--            <!-- Modal content-->-->
    <!--            <div class="modal-content">-->
    <!--                <div class="modal-header">-->
    <!--                    <button type="button" class="close" data-dismiss="modal">&times;</button>-->
    <!--                    <h4 class="modal-title">Discount History</h4>-->
    <!--                </div>-->
    <!--                <div class="modal-body">-->
    <!--                    <div class="table-responsive">-->
    <!--                        <table class="table     table-bordered table-hover example">-->
    <!--                            <thead>-->
    <!--                            <tr>-->
    <!--                                <th class="text-center">SrNo.</th>-->
    <!--                                <th class="text-center">Date</th>-->
    <!--                                <th class="text-center">Class Fee</th >-->
    <!--                                <th class="text-center">Monthly Fee</th>-->
    <!--                                <th class="text-center">Update Discount</th>-->
    <!--                                <th class="text-center">Action</th>-->
    <!--                            </tr>-->
    <!--                            </thead>-->
    <!--                            <div class="row">-->
    <!--                                <tbody>-->
    <!--                                --><?php
    //                                if (empty($discount_history_all)) {
    //                                    ?>
    <!--                                    <tr>-->
    <!--                                        <td colspan="6" class="text-danger text-center">--><?php //echo $this->lang->line('no_record_found'); ?><!--</td>-->
    <!--                                    </tr>-->
    <!--                                    --><?php
    //                                } else {
    //                                    foreach ($discount_history_all as $key=>$value) {
    //                                        ?>
    <!--                                        <tr>-->
    <!--                                            <td class="text-center">--><?//= $key+1; ?><!--</td>-->
    <!--                                            <td class="text-center">--><?//=   date('d-M-Y', strtotime($value['date'])); ?><!--</td>                                      <td class="text-center">--><?//= $value['class_fee']; ?><!--</td>-->
    <!--                                            <td class="text-center">--><?//= $value['monthly_fee']; ?><!--</td>-->
    <!--                                            <td class="text-center">--><?//= $value['latest_discount']; ?><!--</td>                                                       <td class="mailbox-date text-center">-->
    <!--<!--                                                <a href="-->--><?php ////echo base_url(); ?><!--<!--student/discount_delete/-->--><?php ////echo $value['id'] . "/" . $value['student_id']; ?><!--<!--"class="btn btn-default btn-xs"  data-toggle="tooltip" title="-->--><?php ////echo $this->lang->line('delete'); ?><!--<!--" onclick="return confirm('Are you sure you want to delete this item?');">-->-->
    <!--<!--                                                    <i class="fas fa-trash-alt"></i>-->-->
    <!--<!--                                                </a>-->-->
    <!--                                            </td>-->
    <!--                                        </tr>-->
    <!--                                        --><?php
    //                                    }
    //                                }
    //                                ?>
    <!--                                </tbody>-->
    <!--                        </table>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--                <div class="modal-footer">-->
    <!--                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>-->
    <!--                </div>-->
    <!--            </div>-->
    <!---->
    <!--        </div>-->
    <!--    </div>-->
    <div class="modal1"><!-- Place at bottom of page --></div>

    <style>
        /* Start by setting display:none to make this hidden.
   Then we position it in relation to the viewport window
   with position:fixed. Width, height, top and left speak
   for themselves. Background we set to 80% white with
   our animation centered, and no-repeating */

        .show-sweet-alert{
         height: 250px;
         margin-left: -200px !important;
         width: 370px !important;
        }
        .modal1 {
            display:    none;
            position:   fixed;
            z-index:    1000;
            top:        0;
            left:       0;
            height:     100%;
            width:      100%;
            background: rgba( 255,255,255,.5 )
            url('http://i.stack.imgur.com/FhHRx.gif')
            50% 50%
            no-repeat;
        }

        /* When the body has the loading class, we turn
           the scrollbar off with overflow:hidden */
        body.loading .modal1 {
            overflow: hidden;
        }

        /* Anytime the body has the loading class, our
           modal element will be visible */
        body.loading .modal1 {
            display: block;
        }


    </style>
</div>
<script type="text/javascript">


</script>
<script type="text/javascript">

    $( document ).ready( function () {
        transaction_history();
        unpaid_other();
        tution_unpaid();
        annual_report();
    });
    function annual_report(){
        var student_id  =  getParameters();
        $.ajax( {
            url: '<?php echo site_url( "fee_management/annual_report" ) ?>',
            type: 'GET',
            data: {
                'student_id': student_id,
            },
            dataType: 'json',
            success: function ( response ) {
                $('#annual_report').html(response);
            }
        });
    }
    function getParameters(){
        var url = window.location.href; //get the current url
        var urlSegment = url.substr(url.indexOf('receive_fee/')); //copy the last part
        var params = urlSegment.split('/'); //get an array
        return params[1] //return an object with registro and solicitud
    }

    function unpaid_other() {
        var student_id  =  getParameters();
        $('#unpaid_other').DataTable({
            "orderClasses": false,
            'columnDefs': [
                {
                    "targets": '_all',
                    "className": "text-center",
                }],
            "ajax": {
                url: "<?php echo site_url("fee_management/unpaid_student_other_ajax") ?>",
                type: 'GET',
                dataType: 'JSON',
                data: {
                    'student_id': student_id,
                },

            },
        });
    }
    function transaction_history(){
        var student_id  =  getParameters();
        $('#transation_history').DataTable({
            "orderClasses": false,
            "bSort": false,
            "paging": false,
            'columnDefs': [
                {
                    "targets": '_all',
                    "className": "text-center",
                }],
            "ajax": {
                url : "<?php echo site_url( "fee_management/transation_history" ) ?>",
                type : 'GET',
                dataType: 'JSON',
                data: {
                    'student_id': student_id,
                },
            },
        });
    }
    function tution_unpaid() {
        var student_id  =  getParameters();
        $('#unpaid_tuition').DataTable({
            "orderClasses": false,
            'columnDefs': [
                {
                    "targets": '_all',
                    "className": "text-center",
                }],
            "ajax": {
                url: "<?php echo site_url("fee_management/unpaid_student_tuition_ajax") ?>",
                type: 'GET',
                dataType: 'JSON',
                data: {
                    'student_id': student_id,
                },
            },
        });
    }
    $( document ).on( 'click', '.delete_payment', function ( e ) {
        var payment = $(this).attr('data-payment');
        e.preventDefault();
        $.ajax( {
            url: '<?php echo site_url( "fee_management/delete_payment_ajax" ) ?>',
            type: 'post',
            dtatatype:'json',
            data: {
                payment :payment,
            },
            dataType: 'json',
            success: function ( response ) {
                if ( response.status == "success" ) {
                    alert(response.message);
                    $('#transation_history').DataTable().ajax.reload();
                    $('#unpaid_tuition').DataTable().ajax.reload();
                    $('#unpaid_other').DataTable().ajax.reload();
                } else if ( response.status == "fail" ) {
                    alert(response.message);
                }
            }
        });
    });
    $( document ).on( 'click', '.collect_fee', function ( e ) {
        var $this = $( this );

        // $this.button( 'loading' );
        // $body = $("body");
        // $body.addClass("loading");
        //
        e.preventDefault();
        voucher_id                  =  $("input[name=voucher_id1]").val();
        user_id                     =  $("input[name=user_id]").val();
        student_id                  =  $("input[name=student_id]").val();
        var type = $( this ).attr('data-type');
        var other_fee_types = new Array();
        $( '.hello1' ).each(function()  {
            other_fee_types.push($(this).val());
        });
        var other = JSON.stringify(other_fee_types);
            if ($('#tution_fee_check').is(":checked")) {   tution_fee_check = 1; }else{ tution_fee_check = 0; }
            if ($('#fine').is(":checked")) { late_fee_payment_fine_check = 1; }else{ late_fee_payment_fine_check = 0; }
            tution_fee                  =  $("input[name=tution_fee1]").val();
            arrears_fee                 =  $("input[name=arrears_fee1]").val();
            advance                     =  $("input[name=advance1]").val();
            submission_date             =  $("input[name=submission_date]").val();
            late_fee_payment_fine       =  $("input[name=late_fee_payment_fine]").val();
            arrears_description         =  $("input[name=arrears_description]").val();
            $.ajax( {
                url: '<?php echo site_url( "studentfee/addstudentfee3" ) ?>',
                type: 'post',
                dtatatype:'json',
                data: {
                    tution_fee_check:tution_fee_check,
                    tution_fee:tution_fee,
                    arrears_fee:arrears_fee,
                    advance:advance,
                    submission_date:submission_date,
                    late_fee_payment_fine:late_fee_payment_fine,
                    late_fee_payment_fine_check:late_fee_payment_fine_check,
                    voucher_id:voucher_id,
                    arrears_description:arrears_description,
                    user_id:user_id,
                    student_id:student_id,
                    other_fee_types:other,
                },
                dataType: 'json',
                success: function ( response ) {
                    if ( response.status == "success" ) {
                        $('#exampleModalLong').modal('hide');
                        sweetAlert( {
                       //     title: response.status,
                            text : response.message,
                            type: 'success',
                            showConfirmButton: false,
                            timer: 3000,
                        });
                        $this.button( 'reset' );
                        $('.voucher_no').hide();
                        $('#transation_history').DataTable().ajax.reload();
                        annual_report();
                        if(type == 1){
                            $('#unpaid_other').DataTable().ajax.reload();
                        }else{
                            $('#unpaid_tuition').DataTable().ajax.reload();
                        }
                        window.history.pushState('receive_fee', 'Title', '<?= site_url() ?>fee_management/receive_fee/'+student_id+'');
                    } else if ( response.status == "fail" ) {
                        $.each( response.error, function ( index, value ) {
                            var errorDiv = '#' + index + '_error';
                            $( errorDiv ).empty().append( value );
                        } );
                    }
                }
            });
        });

    $( document ).on( 'click', '.waive_fee', function ( e ) {
        var $this = $( this );
        $this.button( 'loading' );
        e.preventDefault();
        voucher_id                  =  $("input[name=voucher_id1]").val();
        user_id                     =  $("input[name=user_id]").val();
        student_id                  =  getParameters();
        var other_fee_types = new Array();
        $( '.hello_waive' ).each(function(){
            other_fee_types.push($(this).val());
        });
        var other = JSON.stringify(other_fee_types);
            if ($('#tution_fee_check_waive').is(":checked")) { tution_fee_check = 1; }else{ tution_fee_check = 0; }
            if ($('#fine_waive').is(":checked")) { late_fee_payment_fine_check = 1;}else{  late_fee_payment_fine_check = 0; }
            tution_fee                  =  $("input[name=tuition_fee_waive]").val();
            arrears_fee                 =  $("input[name=arrears_waive]").val();
            advance                     =  0;
            submission_date             =  $("input[name=submission_date_waive]").val();
            late_fee_payment_fine       =  $("input[name=late_fee_payment_fine_waive]").val();
            arrears_description         =  $("input[name=arrears_description_waive]").val();
        $.ajax( {
            url: '<?php echo site_url( "studentfee/addstudentfee3" ) ?>',
            type: 'post',
            dtatatype:'json',
            data: {
                tution_fee_check:tution_fee_check,
                tution_fee:tution_fee,
                arrears_fee:arrears_fee,
                advance:advance,
                submission_date:submission_date,
                late_fee_payment_fine:late_fee_payment_fine,
                late_fee_payment_fine_check:late_fee_payment_fine_check,
                voucher_id:voucher_id,
                arrears_description:arrears_description,
                user_id:user_id,
                student_id:student_id,
                other_fee_types:other,
            },
            success: function ( response ) {
                if ( response.status == "success" ) {
                    $this.button( 'reset' );
                    $('#free').modal('hide');
                    sweetAlert( {
                        title: response.status,
                        text: response.message,
                            timer: 3000,
                    });
                    $this.button( 'reset' );
                    $('.voucher_no').hide();
                    $('#transation_history').DataTable().ajax.reload();
                    annual_report();
                    if(type == 1){
                        $('#unpaid_other').DataTable().ajax.reload();
                    }else{
                        $('#unpaid_tuition').DataTable().ajax.reload();
                    }

                } else if ( response.status == "fail" ) {
                    $.each( response.error, function ( index, value ) {
                        var errorDiv = '#' + index + '_error';
                        $( errorDiv ).empty().append( value );
                    } );
                }
            }
        });
    });

</script>
<script>
    var base_url = '<?php echo base_url() ?>';
    function Popup( data ) {
        var frame1 = $( '<iframe />' );
        frame1[0].name = "frame1";
        frame1.css( {"position": "absolute", "top": "-1000000px"} );
        $( "body" ).append( frame1 );
        var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
        frameDoc.document.open();
        //Create a new HTML document.
        frameDoc.document.write( '<html>' );
        frameDoc.document.write( '<head>' );
        frameDoc.document.write( '<title></title>' );
        frameDoc.document.write( '<link rel="stylesheet" href="' + base_url + 'backend/bootstrap/css/bootstrap.min.css">' );
        frameDoc.document.write( '<link rel="stylesheet" href="' + base_url + 'backend/dist/css/font-awesome.min.css">' );
        frameDoc.document.write( '<link rel="stylesheet" href="' + base_url + 'backend/dist/css/ionicons.min.css">' );
        frameDoc.document.write( '<link rel="stylesheet" href="' + base_url + 'backend/dist/css/AdminLTE.min.css">' );
        frameDoc.document.write( '<link rel="stylesheet" href="' + base_url + 'backend/dist/css/skins/_all-skins.min.css">' );
        frameDoc.document.write( '<link rel="stylesheet" href="' + base_url + 'backend/plugins/iCheck/flat/blue.css">' );
        frameDoc.document.write( '<link rel="stylesheet" href="' + base_url + 'backend/plugins/morris/morris.css">' );
        frameDoc.document.write( '<link rel="stylesheet" href="' + base_url + 'backend/plugins/jvectormap/jquery-jvectormap-1.2.2.css">' );
        frameDoc.document.write( '<link rel="stylesheet" href="' + base_url + 'backend/plugins/datepicker/datepicker3.css">' );
        frameDoc.document.write( '<link rel="stylesheet" href="' + base_url + 'backend/plugins/daterangepicker/daterangepicker-bs3.css">' );
        frameDoc.document.write( '</head>' );
        frameDoc.document.write( '<body>' );
        frameDoc.document.write( data );
        frameDoc.document.write( '</body>' );
        frameDoc.document.write( '</html>' );
        frameDoc.document.close();
        setTimeout( function () {
            window.frames["frame1"].focus();
            window.frames["frame1"].print();
            frame1.remove();
        }, 500 );


        return true;
    }
    $( document ).ready( function () {
        $( '.delmodal' ).modal( {
            backdrop: 'static',
            keyboard: false,
            show: false
        } )
        $( '#confirm-delete' ).on( 'show.bs.modal', function ( e ) {
            $( '.invoice_no', this ).text( "" );
            $( '#main_invoice', this ).val( "" );
            $( '#sub_invoice', this ).val( "" );
            $( '.invoice_no', this ).text( $( e.relatedTarget ).data( 'invoiceno' ) );
            $( '#main_invoice', this ).val( $( e.relatedTarget ).data( 'main_invoice' ) );
            $( '#sub_invoice', this ).val( $( e.relatedTarget ).data( 'sub_invoice' ) );


        } );
        $( '#confirm-delete' ).on( 'click', '.btn-ok', function ( e ) {
            var $modalDiv = $( e.delegateTarget );
            var main_invoice = $( '#main_invoice' ).val();
            var sub_invoice = $( '#sub_invoice' ).val();
            $modalDiv.addClass( 'modalloading' );
            $.ajax( {
                type: "post",
                url: '<?php echo site_url( "studentfee/deleteFee" ) ?>',
                dataType: 'JSON',
                data: {'main_invoice': main_invoice, 'sub_invoice': sub_invoice},
                success: function ( data ) {
                    $modalDiv.modal( 'hide' ).removeClass( 'modalloading' );
                    location.reload( true );
                }
            } );


        } );

        $( '.detail_popover' ).popover( {
            placement: 'right',
            title: '',
            trigger: 'hover',
            container: 'body',
            html: true,
            content: function () {
                return $( this ).closest( 'td' ).find( '.fee_detail_popover' ).html();

            }
        } );
    } );
</script>
<script type="text/javascript">

    var date_format = '<?php echo $result = strtr( $this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',] ) ?>';

    $( document ).ready( function () {
        $( ".date" ).datepicker( {
            format: date_format,
            autoclose: true,
            todayHighlight: true
        } );
    });

    $( document ).ready( function () {
        $( document ).on( 'click', '.delete_voucher', function ( e ) {
            var voucher = $(this).attr('data-voucher');
            var type = $(this).attr('data-type');
            e.preventDefault();
            $.ajax( {
                url: '<?php echo site_url( "fee_management/delete_unpaid_ajax" ) ?>',
                type: 'post',
                dtatatype:'json',
                data: {
                    vrno:voucher,
                },
                dataType: 'json',
                success: function ( response ) {
                    if ( response.status == "success" ) {
                        alert(response.message);
                        if(type == 1){
                            $('#unpaid_other').DataTable().ajax.reload();
                        }else{
                            $('#unpaid_tuition').DataTable().ajax.reload();
                        }

                    } else if ( response.status == "fail" ) {
                       alert(response.message);
                    }
                }
            });
        });
    });
</script>
<script type="text/javascript">
    $('input[name="tution_fee_check"]').click(function () {
        if ($(this).is(":checked")) {
            $('#tuition_fee').removeAttr('readonly');
        } else {
            $('#tuition_fee').attr('readonly', true);
        }
    });

    $( ".myCollectFeeBtn" ).click( function () {
        $( "span[id$='_error']" ).html( "" );
        $( '.fees_title' ).html( "" );
        $( '#amount' ).val( "" );
        $( '#amount_discount' ).val( "0" );
        $( '#amount_fine' ).val( "0" );
        var type = $( this ).data( "type" );
        var amount = $( this ).data( "amount" );
        var group = $( this ).data( "group" );
        var fee_groups_feetype_id = $( this ).data( "fee_groups_feetype_id" );
        var student_fees_master_id = $( this ).data( "student_fees_master_id" );
        $( '.fees_title' ).html( "<b>" + group + ":</b> " + type );
        $( '#fee_groups_feetype_id' ).val( fee_groups_feetype_id );
        $( '#student_fees_master_id' ).val( student_fees_master_id );

        $.ajax( {
            type: "post",
            url: '<?php echo site_url( "studentfee/geBalanceFee" ) ?>',
            dataType: 'JSON',
            data: {
                'fee_groups_feetype_id': fee_groups_feetype_id,
                'student_fees_master_id': student_fees_master_id
            },
            success: function ( data ) {
                if ( data.status == "success" ) {
                    $( '#amount' ).val( data.balance );
                    $( '#myFeesModal' ).modal( {
                        backdrop: 'static',
                        keyboard: false,
                        show: true
                    } );
                }
            }
        } );


    } );
</script>
<script type="text/javascript">

    $( document ).ready( function () {
        $( '.table-fixed-header' ).fixedHeader();
    } );




    //  $(window).on('resize', function () {
    //    $('.header-copy').width($('.table-fixed-header').width())
    //});

    (function ( $ ) {

        $.fn.fixedHeader = function ( options ) {
            var config = {
                topOffset: 50
                //bgColor: 'white'
            };
            if ( options ) {
                $.extend( config, options );
            }

            return this.each( function () {
                var o = $( this );

                var $win = $( window );
                var $head = $( 'thead.header', o );
                var isFixed = 0;
                var headTop = $head.length && $head.offset().top - config.topOffset;

                function processScroll() {
                    if ( !o.is( ':visible' ) ) {
                        return;
                    }
                    if ( $( 'thead.header-copy' ).size() ) {
                        $( 'thead.header-copy' ).width( $( 'thead.header' ).width() );
                    }
                    var i;
                    var scrollTop = $win.scrollTop();
                    var t = $head.length && $head.offset().top - config.topOffset;
                    if ( !isFixed && headTop !== t ) {
                        headTop = t;
                    }
                    if ( scrollTop >= headTop && !isFixed ) {
                        isFixed = 1;
                    } else if ( scrollTop <= headTop && isFixed ) {
                        isFixed = 0;
                    }
                    isFixed ? $( 'thead.header-copy', o ).offset( {
                        left: $head.offset().left
                    } ).removeClass( 'hide' ) : $( 'thead.header-copy', o ).addClass( 'hide' );
                }

                $win.on( 'scroll', processScroll );

                // hack sad times - holdover until rewrite for 2.1
                $head.on( 'click', function () {
                    if ( !isFixed ) {
                        setTimeout( function () {
                            $win.scrollTop( $win.scrollTop() - 47 );
                        }, 10 );
                    }
                } );

                $head.clone().removeClass( 'header' ).addClass( 'header-copy header-fixed' ).appendTo( o );
                var header_width = $head.width();
                o.find( 'thead.header-copy' ).width( header_width );
                o.find( 'thead.header > tr:first > th' ).each( function ( i, h ) {
                    var w = $( h ).width();
                    o.find( 'thead.header-copy> tr > th:eq(' + i + ')' ).width( w );
                } );
                $head.css( {
                    margin: '0 auto',
                    width: o.width(),
                    'background-color': config.bgColor
                } );
                processScroll();
            } );
        };

    })( jQuery );

</script>
<script type="text/javascript">

    $( ".applydiscount" ).click( function () {
        $( "span[id$='_error']" ).html( "" );
        $( '.discount_title' ).html( "" );
        $( '#student_fees_discount_id' ).val( "" );
        var student_fees_discount_id = $( this ).data( "student_fees_discount_id" );
        var modal_title = $( this ).data( "modal_title" );
        student_fees_discount_id

        $( '.discount_title' ).html( "<b>" + modal_title + "</b>" );

        $( '#student_fees_discount_id' ).val( student_fees_discount_id );
        $( '#myDisApplyModal' ).modal( {
            backdrop: 'static',
            keyboard: false,
            show: true
        } );
    } );


    $( document ).on( 'click', '.dis_apply_button', function ( e ) {
        var $this = $( this );
        $this.button( 'loading' );
        var discount_payment_id = $( '#discount_payment_id' ).val();
        var student_fees_discount_id = $( '#student_fees_discount_id' ).val();
        var dis_description = $( '#dis_description' ).val();

        $.ajax( {
            url: '<?php echo site_url( "admin/feediscount/applydiscount" ) ?>',
            type: 'post',
            data: {
                discount_payment_id: discount_payment_id,
                student_fees_discount_id: student_fees_discount_id,
                dis_description: dis_description
            },
            dataType: 'json',
            success: function ( response ) {
                $this.button( 'reset' );
                if ( response.status == "success" ) {
                    location.reload( true );
                } else if ( response.status == "fail" ) {
                    $.each( response.error, function ( index, value ) {
                        var errorDiv = '#' + index + '_error';
                        $( errorDiv ).empty().append( value );
                    } );
                }
            }
        } );
    } );

</script>
<script type="text/javascript">

    /*$(document).ready(function() {


var hasParam = url.indexOf('voucher_id');

console.log(hasParam);
if(hasParam  == -1) {
  $('#exampleModalCenter').show();



} else {
  $('#exampleModalCenter').hide();
}


});
*/
    $('input.check11').click(function(){
        $('input.check21').prop('checked',this.checked)
    })
    $('input.check21').click(function(){
        $('input.check11').prop('checked',this.checked)
    })

</script>
<script type="text/javascript">
    jQuery( function ( $ ) {
        $( "#fee_waive" ).submit( function ( e ) {

            var fee_collect_confirmation = confirm( "Do You Want to Proceed To Fee Waive?" );

            if ( fee_collect_confirmation === false ) {
                e.preventDefault();
            }
        } );

    } );
    jQuery( function ( $ ) {
        $( "#collect_fee" ).submit( function ( e ) {

            var fee_collect_confirmation = confirm( "Do You Want to Proceed To Fee Collection?" );

            if ( fee_collect_confirmation === false ) {
                e.preventDefault();
            }
        });
    });

    jQuery( function ( $ ) {
        $( "#free_submit" ).click( function ( e ) {

            var fee_collect_confirmation = confirm( "Do You Want to Proceed To Fee Waive?" );

            if ( fee_collect_confirmation === false ) {

                $('#free').modal('toggle');
                e.preventDefault();
            }
        } );
    } );
</script>
<script type="text/javascript">
    //   jQuery( function ( $ ) {
    //        $( "#free" ).on( 'click',function ( e ) {
    //alert('shello7');
    //            var fee_collect_confirmation = confirm( "Do You Want to Proceed To Fee Collection?" );
    //
    //            if ( fee_collect_confirmation === false ) {
    //                e.preventDefault();
    //            }
    //        } );
    //    } );
</script>
<script type="text/javascript">



</script>



<script type="text/javascript">
     
    $(".unpaid_student_input").on('mouseover', function(){
        var unpaid_student = $( '#unpaid_student' ).val();

        console.log(unpaid_student);
      
        if(unpaid_student == null ){
            $(".unpaid_student_input").removeClass("disabledbutton_tuition_fee");
        }else{
            $(".unpaid_student_input").addClass("disabledbutton_tuition_fee");
            alert(' Delete The Monthly Fee Voucher Before Editing The Fee / Arrears.');
        }

    });
    function myFunction() {
        var other = $('#other').val();
        if(other == 1){
            $("#tuition_fee").addClass("disabledbutton");
            $("#other_fee").removeClass("disabledbutton");
        }else{
            $("#tuition_fee").removeClass("disabledbutton");
            $("#other_fee").addClass("disabledbutton");
        }
        var admin_fine= <?= $permission->fine ?>;
        var submission = <?= $permission->submission ?>;
        if(admin_fine == 1){
            $(".submission_date").removeClass("disabledbutton");
        }else{
            $(".submission_date").addClass("disabledbutton");
        }
        if(submission == 1){
            $(".submission_date2").removeClass("disabledbutton");
        }else{
            $(".submission_date2").addClass("disabledbutton");
        }
    }

</script>
