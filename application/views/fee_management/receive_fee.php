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
        border: 1px solid #CBCBC9 !important;
        text-align: center;
   
    }
    .removeout{
        border: none !important;       
    }
    .bottomb{
        border-bottom: 1px solid #CBCBC9 !important; 
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
    <section class="content-header" >
    <div class="box box-primary " style="margin-bottom:0px">
 
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
                                echo '<span class="text-blue" style="">'.$child['firstname'].' '.$child['lastname'].'</span>'; ?>
                            </a>
                        
                        <?php } } ?>
                </div>
            </div>
            <div class="pull-right">
                <a href="<?php echo base_url(); ?>family/children_summary/<?php echo $child['id'] ?>" class="btn btn-default" >Sibling Summary
                </a>
            </div>
            </div>
        </div>
    </section>
 
    <section class="content">
    <?php
            if ( $this->session->flashdata( 'Voucher_error' ) ):
                echo "<div><div class='alert alert-danger' style='display: inline-block;'>" . $this->session->flashdata( 'Voucher_error' ) . "</div></div>";
            endif;
            if ( $this->session->flashdata( 'expense_msg' ) ):
                echo "<div><div class='alert alert-success' style='display: inline-block;'>" . $this->session->flashdata( 'Voucher_error' ) . "</div></div>";
            endif;
            ?>
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
            <?php
            if ( $this->session->flashdata( 'msg_err' ) ):
                echo "<div><div class='alert alert-danger' style='display: inline-block;'>" .$this->session->flashdata( 'msg_err' ) . "</div></div>";
             endif;
            if ( $this->session->flashdata( 'msg' ) ):
                echo "<div><div class='alert alert-success' style='display: inline-block;'>" . $this->session->flashdata( 'msg' ) . "</div></div>";
            endif;
            ?>
                <div class="box box-primary">
                    <div class="box-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="box-title"><?= $student['firstname']." ".$student['lastname'] ?> information   
                                <?php if($student['struck_off'] == 1){ ?>
                                  <span style="color:red; font-size :14px">(Student Withdrawn <?= date('m/d/Y',strtotime($student['updated_at']))?>) </span>
                                <?php } ?>
                                   </h3>
                            </div>
                            <div class="col-md-6 ">
                                <div class="btn-group pull-right">
                                <?php if($student['struck_off'] != 1 &&  $permission->voucher_generation == 1){ ?>
                                    <a href="<?php echo base_url(); ?>fee_management/fee_voucher?student_id=<?php echo $student['id'] ?>" type="button" class="btn btn-default btn-sm" data-toggle="tooltip" title="voucher" >
                                        <i class="fa fa-newspaper-o" aria-hidden="true"> </i> <?php echo $this->lang->line( 'back' ); ?>
                                    </a>
                                <?php }?>
                                    <a style="margin-left: 5px;" href="<?php echo base_url(); ?>student/view/<?php echo $student['id'] ?>" class="btn btn-default btn-sm" data-toggle="tooltip" type ="button" title="<?php echo $this->lang->line( 'show' ); ?>">
                                        <i class="fa fa-reorder"></i>
                                    </a>
                                <?php if($student['struck_off'] != 1){ ?>
                              
                                  
                                    <?php if ($permission->student_access == 1) {	?>
                                        <a href="<?= site_url( "student/edit/{$student['id']}" ) ?>" class="btn btn-default btn-sm"  data-toggle="tooltip"  title="Edit"   style="margin-left: 5px;">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>
                                    <?php  }?>
                               
                                    <?php  $unpaid = empty($unpaid_students) ? 0 : 1;
                                    if ($permission->waive == 1 ){ ?>
                                            <button  style="margin-left:5px" type="button" class="btn btn-sm btn-default"  id="free_submit" data-toggle="modal" data-target="#free">
                                                <i class="fa fa-gift"></i>
                                            </button>
                                    <?php }
                                    }
                                    if($student['struck_off'] == 1){
                                    ?>
                                     <a href="<?= base_url(); ?>student/character_certifcate/?student_id=<?= $student['id'] ?>&section=<?= $student['section'] ?>" class="btn btn-default btn-sm"data-toggle="tooltip"  title="Student certificate"  >
                                                            <i class="fab fa-connectdevelop"></i> </a>
                                    <?php   }?>
                                </div>
                            </div>
                        </div>
                    </div><!--./box-header-->
                    <div class="box-body" style="padding-top:0;">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="sfborder">
                                    <div class="col-md-2">

                                        <?php  $url = $student['image'] != null ? $student['image'] : '/uploads/student_images/no_image.png';  ?>
                                        <img width="190" height="260" class="round5" src="<?= base_url().$url ?>" alt="No Image">
                                    </div>
                                    <?php
                                    //calculate fee and arrears
                                    $arrears = 0;
                                    $arrears_check = false;
                                    $monthly_fee = $student_fee - $student['discount'];
                                    if ($voucher_details === null ) {
                                        $_fee_tuition = ( $voucher_tuition_fee !== null ? floatval( $voucher_tuition_fee ) : floatval( $student['fee_arrears'] ) - floatval( $student['late_payment_fee']) );
                                    }else{  
                                        $_fee_tuition  = ( $voucher_details['monthly_fee'] !== null ? floatval( $voucher_details['monthly_fee'] ) : 0 );
                                        if ($voucher_details['arrears'] > 0) {
                                            $arrears_check = true;
                                            if($last_date_for_receiving_fee > date('d')){
                                                $late_payment  = $student['late_payment_fee'];
                                            }else{
                                                $late_payment  = $student['late_payment_fee'] - $fine_per_day_for_fee;
                                            }
                                            $arrears           = $voucher_details['arrears'];
                                       }
                                    }
                                    if($voucher_details == null){
                                        $_fee_tuition = ( $_fee_tuition > 0 ? $_fee_tuition : 0 );
                                        if ($_fee_tuition > $monthly_fee) {
                                            $arrears        = $_fee_tuition - $monthly_fee;
                                            $_fee_tuition   = $monthly_fee;
                                        }
                                        $total_arrears = $arrears;
                                        $arrears_advance  = floatval( $student['fee_arrears'] ) - floatval( $late_payment );
                                        if ($arrears_advance >= 0) {
                                            $arrears_advance = 0;
                                        }else{
                                            $arrears_advance = abs($arrears_advance);
                                        }
                                    }else{
                                        $arrears_advance =  $voucher_details['advance'];
                                    }

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
                                                    <th style="width: 9%;">B Form</th>
                                                    <td style="width: 9%;"><?= $student['b_form']?></td>
                                                    <td style="width: 9%;">&nbsp;</td>
                                                    <td style="width: 9%;">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <th><?php echo $this->lang->line( 'father_name' ); ?></th>
                                                    <td><?php echo $student['father_name']; ?></td>
                                                    <th><?php echo $this->lang->line( 'admission_date' ); ?></th>
                                                    <td><?php echo $student['admission_date']; ?></td>
                                                    <th>&nbsp;</th>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <th><?php echo $this->lang->line( 'father_phone' ); ?></th>
                                                    <td><?php echo $student['father_phone']; ?></td>
                                                    <th><?php echo $this->lang->line( 'admission_no' ); ?></th>
                                                    <td><?php echo $student['admission_no']; ?></td>
                                                    <th>&nbsp;</th>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <th><?php echo $this->lang->line( 'mobile_no' ); ?></th>
                                                    <td><?php echo $student['mobileno']; ?></td>
                                                    <th><?php echo $this->lang->line( 'roll_no' ); ?></th>
                                                    <td> <?php echo $student['roll_no']; ?></td>
                                                    <th>&nbsp;</th>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
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
                                                            <input type="hidden" name="unpaid_student" id="unpaid_student" value="<?= $unpaid ?>">
                                                           
                                                            <span> Monthly Due Fee </span>
                                                            <?= $student['struck_off'] == 1 || $permission->arrears_adjust != 1?'<fieldset disabled>':'' ?>
                                                            <input type="text" class="form-control unpaid_student_input" id="monthly" name="fee_dues" value="<?= set_value( 'tuition_fee', $_fee_tuition ) ?>" placeholder="" style="height:21px;padding: 0px; "  >
                                                            <?= $student['struck_off'] == 1 || $permission->arrears_adjust != 1 ?'</fieldset>':'' ?>
                                                        </td>
                                                        <td>
                                                            Arrears:
                                                            <?= $student['struck_off'] == 1 || $permission->arrears_adjust != 1?'<fieldset disabled>':'' ?>
                                                            <input type="text" class="form-control unpaid_student_input" id="arrears" name="arrears" value="<?= set_value( 'arrears_fee', $arrears ) ?>" placeholder="" style="height:20px;padding: 0px; " >
                                                            <?= $student['struck_off'] == 1 || $permission->arrears_adjust != 1 ?'</fieldset>':'' ?>
                                                        </td>
                                                        <td>Advance:
                                                            <?= $student['struck_off'] == 1 || $permission->arrears_adjust != 1?'<fieldset disabled>':'' ?>
                                                            <input type="text" class="form-control unpaid_student_input" name="advance" id="advance" value="<?= $arrears_advance ?>" placeholder="" style="height:21px; padding: 0px;"  >
                                                            <input type="submit" style="display: none;" />
                                                            <?= $student['struck_off'] == 1 || $permission->arrears_adjust != 1 ?'</fieldset>':'' ?>
                                                        </td>
                                                    </form>
                                                    <th><span>Fine</span>
                                                        <input type="text" class="form-control" name="fee_dues" id="fine"  value="<?= set_value( 'late_payment_fee', $student['late_payment_fee'] ) ?>" placeholder="" disabled style="height:21px;padding: 0px; " >
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
                                                            <tr> <td><a type="button" class="" data-toggle="modal" data-target="#exampleModalLong1">Previous Fee Discount </a> </td> </tr>
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
                                                    <td colspan="5"> 
                                                        <div id="annual_report">
                                                        </div> 
                                                    </td>
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
                                <?php if($permission->vr_search){ ?>
                                    <form action="<?= site_url( 'fee_management/fee_voucher_receive' ) ?>" method="get" class="form-inline">
                                        <input type="hidden" name="redirect" value="<?= current_url() ?>">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="voucher_id" value="" placeholder="Search Voucher ID">
                                        </div>
                                    </form>
                                <?php } ?>
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
                                <table class="table  example  table-bordered " id="transation_history">
                                    <thead>
                          

                                    <tr class="">
                                        <th colspan="3" class="bottomb" > </th>
                                        <th colspan="9"  class="text-center outlined"   >Tuition Fee</th>
                                        <th colspan="4" class="text-center outlined" >Other Fee</th>
                                        <th class="bottomb"></th>
                                        <th class="bottomb"></th>
                                        
                                    </tr>

                                    <tr >
                                        <th class="text-center">Pay Date</th>
                                        <th class="text-center">User ID</th>
                                        <th class="text-center">Vr ID</th>
                                        <th class="text-center" style="background: aliceblue;">Fee Due</th>
                                        <th class="text-center" style="background: aliceblue;">Arrears Due</th>
                                        <th class="text-center" style="background: aliceblue;">Fine Due</th>
                                        <th class="text-center" style="background: aliceblue;">Reprint Due</th>
                                        <th class="text-center" style="background: aliceblue;">Total Due</th>
                                        <th class="text-center">Fee Paid</th>
                                        <th class="text-center">Fee Desc</th>
                                        <th class="text-center">Fee Waived</th>
                                        <th class="text-center">Balance</th>
                                        <th class="text-center">Other Paid Details</th>
                                        <th class="text-center">Other Paid</th>
                                        <th class="text-center">Other Waived Details</th>
                                        <th class="text-center">Other Waived</th>
                                        <th class="text-center">Total</th>
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

<div>


<!-- 
<div style="display: contents;"><div style="display: inline-block">
<img style="width: 90px; height:90px; vertical-align: initial;  "  src="<?= base_url( "uploads/school_content/logo/{$this->setting_model->getCurrentImage()}" ) ?>" alt="American lyceum International School"></div>
   <div style="display: inline-block;margin: 0px 20px;"><h2  ><b> <?= $this->setting_model->getCurrentSchoolName(); ?> </b></h2><h4><?= $this->setting_model->getSchoolAddress()?></h4><h5><?= $this->setting_model->getCurrentSessionName()?> </h5></div></div>
      <div style="display: inline-block; float:right;    text-align: end;"><h3><b>'+title+'</b></h3><h4><b>From</b> <?=date("d/F/Y ") ?> <b>to</b> <?=date("d/F/Y ") ?></h4><h5>Date <?= date("d, F, Y H:i:s")?> </h5><h5>Printed By <?= $this->session->userdata( 'admin' )['username']; ?> </h5></div></div>


<div style="display: contents;">
<div style="display: inline-block">
    <img style="width: 90px; height:90px; vertical-align: initial; " src="https://localhost/smart_school_system/uploads/school_content/logo/american-lyceum-international-school.png" alt="American lyceum International School"> 
    </div>
    <div style="display: inline-block ;margin: 0px 20px;">
    <h2  ><b> American lyceum International School</b></h2>
    <h4>Faisalabad</h4>
    <h5>Session (2020-21) </h5>
    </div>
</div>
<div style="display: inline-block; float:right">
    <h3><b>Admission Information</b></h3>
    <h4>From <?=date("d/F/Y ") ?> <b>to</b> <?=date("d/F/Y ") ?></h4>
    <h5>Date <?= date("d, F, Y H:i:s")?> </h5>

    <h5>Printed By <?= $this->session->userdata( 'admin' )['username']; ?> </h5>
    
</div>
</div> -->

        <!-- <div  style="">




            <div style="text-align: center;border-bottom: 3px solid black;"  >
            <img style="width: 80px; height:80px;float: left; margin-top: -15px; " src="https://localhost/smart_school_system/uploads/school_content/logo/american-lyceum-international-school.png" alt="American lyceum International School"> 
                <h2  ><b> American lyceum International School</b></h2>
              
             </div>
        </div>
        <div style="text-align: center; margin-left:80px" >
            <h3><b>Admission Information</b></h3>
            <?= date('Y F d')?>
        </div> -->

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
                                                <input class="form-control hello_waive" type="number" min="0" data-attr="<?= $student_fee_type['name'] ?>"  name="other_fee_types[<?= $ii ?>][amount]" value="<?= set_value( 'other_fee_types[' . $ii . '][amount]', $student_fee_type['voucher_amount'] ) ?>">
                                            </div>
                                            <?php $ii++;
                                         }?>
                                    </div>
                                    <div class="form-group submission_date" style="display:none">
                                        <label>Submission Date</label>
                                        <?php  $month_start_date = date( 'Y-m-01', now() );
                                         $date = date( "m/{$last_date_for_receiving_fee}/Y", strtotime( $month_start_date ) );?>
                                        <input type="hidden" class="form-control date" name="late_date" id="late_date" value="<?= set_value( 'late_date',  $date ) ?>" readonly >
                                        <?php  $last_month_date =   date("Y-n-j", strtotime("last day of previous month")); ?>
                                        <input type="hidden" class="form-control date" name="month_start" id="month_start" value="<?= set_value( 'month_start',  $last_month_date ) ?>" readonly >
        
                                        <input type="text" class="form-control date" required name="submission_date_waive" id="submission_date" value="<?= set_value( 'submission_date_waive', date('Y-m-d') ) ?>" readonly >
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

    <div class="modal fade" id="exampleModalLong1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle1" aria-hidden="true">
    
    <div class="modal-dialog" role="document">
         <div class="modal-content">
              <div class="modal-header">
                       <button type="button" class="close" data-dismiss="modal">&times;</button>
                       <h4 class="modal-title">Discount History</h4>
              </div>
              <div class="modal-body">
              <div class="table-responsive">
                           <table class="table     table-bordered table-hover ">
                               <thead>
                               <tr>
                                   <th class="text-center">SrNo.</th>
                                   <th class="text-center">Date</th>
                                   <th class="text-center">Class Fee</th >
                                   <th class="text-center">Monthly Fee</th>
                                   <th class="text-center">Update Discount</th>
                                   <th class="text-center">Apply</th>
                                   <th class="text-center">Action</th>
                               </tr>
                               </thead>
                               <div class="row">
                                   <tbody>
                                  <?php
                                    if (empty($discount_history_all)) { ?>
                                        <tr>
                                            <td colspan="6" class="text-danger text-center"><?php echo $this->lang->line('no_record_found'); ?></td>
                                        </tr>
                                    <?php 
                                    } else {
                                        foreach ($discount_history_all as $key=>$value) {
                                           ?>
                                            <tr>
                                                <td class="text-center"><?= $key+1; ?></td>
                                                <td class="text-center"><?=   date('d-M-Y', strtotime($value['date'])); ?></td>                                    
                                                <td class="text-center"><?= $value['class_fee']; ?></td>
                                                <td class="text-center"><?= $value['monthly_fee']; ?></td>
                                                <td class="text-center"><?= $value['latest_discount']; ?></td> 
                                                <td class="text-center"><?= $value['status'] == 1 ? 'Next Month' : 'Apply'; ?></td> 
                                                <td class="mailbox-date text-center">
                                                    <!-- <a href="< ?php echo base_url(); ?>student/discount_delete/< ?php echo $value['id'] . "/" . $value['student_id']; ?> "class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('Are you sure you want to delete this item?');">
                                                      <i class="fas fa-trash-alt"></i>
                                                   </a> -->
                                                </td>
                                            </tr>
                                          <?php
                                        }
                                    }
                                    ?>
                                   </tbody>
                           </table>
                       </div>
              </div>
              <div class="modal-footer">
                       <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                   </div>
            </div>      
        </div>
  </div>
</div>
<div class="modal fade" id="exampleModalLong2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle2" aria-hidden="true">
    
    <div class="modal-dialog" role="document">
         <div class="modal-content">
              <div class="modal-header">
                       <button type="button" class="close" data-dismiss="modal">&times;</button>
                       <h4 class="modal-title">Other Voucher List</h4>
              </div>
              <div class="modal-body">
              <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Unpaid Vouchers(Other Fee)  </h3>
                           
                        </div>
                        <div class="box-body">
                            <table class="table     table-bordered table-hover" id="unpaid_other1"  cellspacing="0" width="100%">
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
              </div>
              <div class="modal-footer">
                       <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                   </div>
            </div>      
        </div>
  </div>
</div>



<div class="modal fade" id="exampleModalLong3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle3" aria-hidden="true">
    
    <div class="modal-dialog" role="document">
         <div class="modal-content">
              <div class="modal-header">
                       <button type="button" class="close" data-dismiss="modal">&times;</button>
                       <h4 class="modal-title"><?= date('M'); ?> Unpaid Vouchers (Tuition Fee)</h4>
                      
              </div>
              <div class="modal-body">
              <div class="box box-primary">
                        <div class="box-body">
                            <table class="table     table-bordered table-hover" id="unpaid_tuition_ad" cellspacing="0" width="100%">
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
              </div>
              <div class="modal-footer">
                       <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                   </div>
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
                                        <!-- <button type="submit" class="btn btn-primary pull-right collect_fee" data-type="< ?=$voucher_details['other']?>" >Collect fee</button> -->
                                
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
                                    //    if($voucher_details['month_names'] == $month){
                                            ?>
                                            <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-2" style="padding-right: 0px;">
                                                <label style="margin-bottom: 7px">Arrears</label>
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
                                                                    $arrears= $arrears - $monthly_fee;
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
                                                            <?php  } ?>
                                                        </tr>
                                                        <tr>
                                                            <?php $t_count = 0;
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
                                        <?php //}else{  ?>
                                    <div class="row">
                                        <div class="col-md-2" style="padding-right: 0px;">
                                            <label>Advance</label>
                                            <input class="form-control" type="number" name="advance1" value="<?= set_value( 'advance1', $voucher_details['advance'] ) ?>" style="padding: 0px 5px 0px 12px;" >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Advance Description</label>
                                        <input class="form-control" type="text" name="arrears_description" id="arrears_description" <?= $total_arrears <= 0 ?'readonly':'required' ?> >
                                    </div>
                                        <?php	//} ?>
                                        <?php if ($voucher_details['other'] != 1) {?>

                                        <?php
                                            $fine_previous=0;
                                            $current_month_fine=0;
                                            $current_fine_days = date('d') -  $last_date_for_receiving_fee - 1; 
                                             if($student['late_payment_fee'] > 0 ){
                                                if($student['late_payment_fee'] >= $fine_per_day_for_fee ){
                                                    if($last_date_for_receiving_fee < date('d')){ //10 <22
                                                        if($student_fee_fine_type == 'per_day_fine_after_due_date'){
                                                            if($current_fine_days > 0 ){
                                                                $current_month_fine =  $fine_per_day_for_fee  * $current_fine_days;
                                                                $fine_previous      =  $student['late_payment_fee'] - $current_month_fine;
                                                            }else{
                                                                $current_month_fine =  0;
                                                                $fine_previous      =  $student['late_payment_fee'] ;
                                                            }
                                                        }else{
                                                            $current_month_fine =  $fine_per_day_for_fee;
                                                            $fine_previous      =  $student['late_payment_fee'] - $fine_per_day_for_fee;
                                                        }
                                                    
                                                    }else{
                                                        $current_month_fine =  0;
                                                        $fine_previous     =  $student['late_payment_fee'];
                                                    }
                                                    
                                                }else{
                                                    $current_month_fine =  $fine_per_day_for_fee; 
                                                    $fine_previous     =  $student['late_payment_fee'] - $fine_per_day_for_fee; 
                                                }
                                            } 
                                        
                                    if($current_month_fine > 0  ){ ?>
                                        <div class="form-group submission_date">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="late_fee_payment_fine_check" id="fine1" value="1" <?= set_checkbox( 'late_fee_payment_fine_check', '1', true ) ?>> Current Month Fine: <?= intval( $current_month_fine ) > 0 ? "+ Rs. {$current_month_fine}" : "" ?>
                                                </label>
                                            </div>
                                        <input type="text" class="form-control" name="late_fee_payment_fine" value="<?= set_value( 'late_fee_payment_fine', $current_month_fine ) ?>" readonly >
                                        </div>
                                    <?php }

                                    if($fine_previous > 0){ ?>
                                                        
                                        <div class="form-group submission_date">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" name="late_fee_payment_fine_check2" id="fine2" value="1" <?= set_checkbox( 'late_fee_payment_fine_check2', '1', true ) ?>> Previous Fee Fine: <?= intval( $fine_previous ) > 0 ? "+ Rs. {$fine_previous}" : "" ?>
                                                </label>
                                            </div>
                                        <input type="text" class="form-control" name="late_fee_payment_fine2" value="<?= set_value( 'late_fee_payment_fine2', $fine_previous ) ?>" readonly >
                                        </div>                                
                                    <?php
                                        }
                                        if($permission->vr_reprint_fee == 1 && !empty($reprint_fee) && $voucher_details["reprint"] == 1){ ?>
                                            <div class="form-group ">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="reprint_fee_check" id="reprint_fee_check" value="1" <?= set_checkbox( 'reprint_fee_check', '1', true ) ?>> Reprint Fee <?= intval( $reprint_fee ) > 0 ? "+ Rs. {$reprint_fee}" : "" ?>
                                                    </label>
                                                </div>
                                            <input type="text" class="form-control" name="reprint_fee" value="<?= set_value( 'reprint_fee', $reprint_fee ) ?>" readonly >
                                            </div>
                                        <?php } 


                                    }?>
                                    <input type="hidden" name="last_date_for_receiving_fee" id="last_date_for_receiving_fee" value="<?= $last_date_for_receiving_fee ?>">
                                    <input type="hidden" name="current_fine_days" id="current_fine_days" value="<?= $current_fine_days ?>">
                                    <input type="hidden" name="fine_per_day_for_fee" id="fine_per_day_for_fee" value="<?= $fine_per_day_for_fee ?>">
                                    <input type="hidden" name="fine_type" id="fine_type" value="<?= $student_fee_fine_type ?>">
                                   
                                    </div>
                                    <?php if ($voucher_details['other'] == 1 && $permission->combine_fee == 0) {?>
                                    <div id="other_fee">
                                        <?php $ii = 0;
                                        foreach ( $student_fee_types as $student_fee_type ) { ?>
                                            <div class="form-group">
                                            <input type="hidden" class="hello1" name="other_fee_types[<?= $ii ?>][name]" value="<?= $student_fee_type['name'] ?>">
                                            <label><?= $student_fee_type['name'] . " <small>( Default: " . $student_fee_type['amount'] . " )</small>" ?></label>
                                                <!-- <input class="form-control" type="number" name="other_fee_types[<?= $ii ?>][amount]" value="<?php //if($receipt->head_name == $student_fee_type['name']) { echo $receipt->head_amount; } else { set_value( 'other_fee_types[' . $ii . '][amount]' ); } ?>"> -->
                                                <input class="form-control hello1" type="number" min="0" data-attr="<?= $student_fee_type['name'] ?>"  name="other_fee_types[<?= $ii ?>][amount]" value="<?= set_value( 'other_fee_types[' . $ii . '][amount]', $student_fee_type['voucher_amount'] ) ?>">
                                        </div>
                                            <?php $ii++;
                                        }?>
                                    </div>
                                    <?php }?>

                                    <?php if ($permission->combine_fee == 1 ) {?>
                                    <div id="other_fee">
                                        <?php $ii = 0;
                                        foreach ( $student_fee_types as $student_fee_type ) { ?>
                                            <div class="form-group">
                                            <input type="hidden" class="hello1" name="other_fee_types[<?= $ii ?>][name]" value="<?= $student_fee_type['name'] ?>">
                                            <label><?= $student_fee_type['name'] . " <small>( Default: " . $student_fee_type['amount'] . " )</small>" ?></label>
                                                <!-- <input class="form-control" type="number" name="other_fee_types[<?= $ii ?>][amount]" value="<?php //if($receipt->head_name == $student_fee_type['name']) { echo $receipt->head_amount; } else { set_value( 'other_fee_types[' . $ii . '][amount]' ); } ?>"> -->
                                                <input class="form-control hello1" type="number" min="0" data-attr="<?= $student_fee_type['name'] ?>"  name="other_fee_types[<?= $ii ?>][amount]" value="<?= set_value( 'other_fee_types[' . $ii . '][amount]', $student_fee_type['voucher_amount'] ) ?>">
                                        </div>
                                            <?php $ii++;
                                        }?>
                                    </div>
                                    <?php }?>
                                    
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


       


    <style>
        /* Start by setting display:none to make this hidden.
   Then we position it in relation to the viewport window
   with position:fixed. Width, height, top and left speak
   for themselves. Background we set to 80% white with
   our animation centered, and no-repeating */

        .show-sweet-alert{
         height: 280px;
         margin-left: -200px !important;
         width: 370px !important;
        }

        .sweet-alert p {
            margin-bottom: 20px !important;
        }

        .sweet-alert{
            max-height: 310px;
            max-width: 385px;

        }
        .sweet-alert h2{
            font-size: 20px !important;
        }
        .sweet-alert p {
            font-size: 14px !important;
        }
        .sweet-alert hr {
            margin-top: 20px !important;
            margin-bottom: 0px !important;
        }
        .sweet-alert button {
            padding: 6px 20px !important;
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

        $( document ).on( 'change', '#submission_date', function ( e ) {
            var date =   $(this).val();
            var last_date = $("#late_date").val();
            var month_start = $("#month_start").val();
            console.log(month_start); 
            function formatDate(date) {
                var d = new Date(),
                    month = '' + (d.getMonth() + 1),
                    day = '' + d.getDate(),
                    year = d.getFullYear();

                if (month.length < 2) month = '0' + month;
                if (day.length < 2) day = '0' + day;

                return [day ,month ,year ].join('/');
            }
           
            if(  new Date(month_start)  >= new Date(date)  ){  
                    sweetAlert( {
                        title:'Select Current Month Date',
                        //   text : response.message,
                        type: 'warning',
                        showConfirmButton: false,
                        timer: 2000,
                    });
                  $(this).val(formatDate(date));
            } 
            if (new Date() < new Date(date)){
                    sweetAlert( {
                        title:'Advance Date is not Allowed',
                        //   text : response.message,
                        type: 'warning',
                        showConfirmButton: false,
                        timer: 2000,
                    });
                    $(this).val(formatDate(date));
            }

            var current_fine_days = $("#current_fine_days").val(); 
            var last_date_for_receiving_fee = $("#last_date_for_receiving_fee").val(); 
            var fine_per_day_for_fee = $("#fine_per_day_for_fee").val(); 
            var fine_type = $("#fine_type").val(); 
    
            if( fine_type == 'per_day_fine_after_due_date'){
                if(current_fine_days > 0 ){
                    var d = new Date(date);
                    day =   d.getDate();
                    var count_fine = day - last_date_for_receiving_fee;
                    if(count_fine > 0){
                        var count_fee_fine  = count_fine * fine_per_day_for_fee;
                        $('input[name="late_fee_payment_fine"]').val(count_fee_fine);        
                    }else{
                        $('#fine1').prop('checked',false);
                        $('input[name="late_fee_payment_fine"]').val(0);        
                    }
                }
            }

            if(new Date(date) <= new Date(last_date))
            {
                $('#fine1').prop('checked',false);
                $('#fine_waive').prop('checked',false);
            }else{
                $('#fine_waive').prop('checked',true);
                $('#fine1').prop('checked',true);
            }   
 
        });
    $( document ).ready( function () {
        transaction_history();
        unpaid_other();
        tution_unpaid();
        annual_report();
        unpaid_other1();
        
        if(getvoucher() == null){

        }else{
            $('#exampleModalLong').modal('show');
            myFunction();
        }
        if(getadmission() == null){

        }else{
            $('#exampleModalLong2').modal('show');
        }
        if(getadmissionT() == null){

        }else{
            tution_unpaid1();
            $('#exampleModalLong3').modal('show');
        }
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
        let searchParams = new URLSearchParams(window.location.search);
        searchParams.has('search_text') ;
        let param = searchParams.get('search_text');
        var thumb_url = [];
        if(param != null){
           $.ajax({ 
            url: '<?php echo site_url( "student/get_id" ) ?>',
            type: 'post',
            data: {
                admission_no: param,
            },
            dataType: 'json',
            async: false,
            success: function ( response ) {
            if ( response != false ) {
                thumb_url.push(response.id);
            }
            }
        }); 
        return thumb_url[0];        
        }else{
            return params[1]
        }

    }

    function getvoucher(){
        var url = window.location.href; //get the current url
        var urlSegment = url.substr(url.indexOf('receive_fee/')); //copy the last part
        var params = urlSegment.split('/'); //get an array
        let searchParams = new URLSearchParams(window.location.search);
        let param = searchParams.get('voucher_id');
        if(param != null){
            return param;
        }else{
            return null
        }
    }


    function getadmission(){
        var url = window.location.href; //get the current url
        var urlSegment = url.substr(url.indexOf('receive_fee/')); //copy the last part
        var params = urlSegment.split('/'); //get an array
        let searchParams = new URLSearchParams(window.location.search);
        let param = searchParams.get('admission_no');
        if(param != null){
            return param;
        }else{
            return null
        }
    }
    function getadmissionT(){
        var url = window.location.href; //get the current url
        var urlSegment = url.substr(url.indexOf('receive_fee/')); //copy the last part
        var params = urlSegment.split('/'); //get an array
        let searchParams = new URLSearchParams(window.location.search);
        let param = searchParams.get('admission_no_t');
        if(param != null){
            return param;
        }else{
            return null
        }
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
    function unpaid_other1() {
        
        var student_id  =  getParameters();
        $('#unpaid_other1').DataTable({
            "orderClasses": false,
            'columnDefs': [
                {
                    "targets": '_all',
                    "className": "text-center",
                }],
            "ajax": {
                url: "<?php echo site_url("fee_management/unpaid_student_other_ajax_collection") ?>",
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
                    "className": "outlined",
                }],
               
            "ajax": {
                url : "<?php echo site_url( "fee_management/transaction_history" ) ?>",
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
    function tution_unpaid1() {
        var student_id  =  getParameters();
        $('#unpaid_tuition_ad').DataTable({
            "orderClasses": false,
            'columnDefs': [
                {
                    "targets": '_all',
                    "className": "text-center",
                }],
            "ajax": {
                url: "<?php echo site_url("fee_management/unpaid_student_tuition_ajax_ad") ?>",
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
        sweetAlert( {
                title: "Delete payment",
                text: "Are you sure you want to delete it",
                //type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Yes',
                cancelButtonText: "No",
                closeOnConfirm: true,
            },
            function ( isConfirm ) {
                if ( isConfirm ) {
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
                                sweetAlert( {
                                    title:response.message,
                                    //   text : response.message,
                                    type: 'success',
                                    showConfirmButton: false,
                                    timer: 2000,
                                });

                                $('#monthly').val(response.data['due']);
                                $('#advance').val(response.data['advance']);
                                $('#arrears').val(response.data['arrears']);
                                $('#fine').val(response.data['fine']);
                                $('#transation_history').DataTable().ajax.reload();
                                $('#unpaid_tuition').DataTable().ajax.reload();
                                $('#unpaid_other').DataTable().ajax.reload();
                            } else if ( response.status == "fail" ) {
                                sweetAlert( {
                                    title:response.message,
                                    //   text : response.message,
                                    type: 'error',
                                    showConfirmButton: false,
                                    timer: 2000,
                                });
                            }
                        }
                    });
                }
            } );
       });
    $( document ).on( 'click', '.collect_fee', function ( e ) {
        e.preventDefault();
        
        submission_date             =  $("input[name=submission_date]").val();
            if(submission_date){
         var $this = $( this );
           $this.button( 'loading' );
           $(".collect_fee").button( 'loading' );
           $body = $("body");
           $body.addClass("loading");
        //
        if ($('#fine1').is(":checked")) { late_fee_payment_fine_check = 1; }else{ late_fee_payment_fine_check = 0; }
            
       var late_fee_payment_fine_check  =   0;
       var late_fee_payment_fine        =   0;
       var current                      =   $("input[name=late_fee_payment_fine]").val();
       var previous                     =   $("input[name=late_fee_payment_fine2]").val();
     
       if(isNaN(current)){ current  = 0 };
       if(isNaN(previous)){ previous  = 0 };

       var fine     =   parseInt(current) + parseInt(previous);
  
            if($('#fine1').is(":checked") && $('#fine2').is(":checked")){
                late_fee_payment_fine = parseInt(current) + parseInt(previous); 
                late_fee_payment_fine_check = 1;
            }else if( $('#fine2').is(":checked") ){
                late_fee_payment_fine =  parseInt(previous); 
                late_fee_payment_fine_check = 1;
            }else if($('#fine1').is(":checked") ){
                late_fee_payment_fine =  parseInt(current); 
                late_fee_payment_fine_check = 1;
            }else{
                late_fee_payment_fine = parseInt(current) + parseInt(previous); 
                late_fee_payment_fine_check = 0;
            }

            reprint_check = 0;
            reprint_fee = parseInt($("input[name=reprint_fee]").val()); 
            if($('#reprint_fee_check').is(":checked")){
                reprint_check = 1;
            }
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
           // if ($('#fine1').is(":checked")) { late_fee_payment_fine_check = 1; }else{ late_fee_payment_fine_check = 0; }

            tution_fee                  =  $("input[name=tution_fee1]").val();
            arrears_fee                 =  $("input[name=arrears_fee1]").val();
            advance                     =  $("input[name=advance1]").val();
         
           // late_fee_payment_fine       =  $("input[name=late_fee_payment_fine]").val();
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
                    fine:fine,
                    reprint_fee:reprint_fee,
                    reprint_check:reprint_check 
                },
                dataType: 'json',
                success: function ( response ) {  
                    if ( response.status == true ) {
                        $('#exampleModalLong').modal('hide');
                        $('#monthly').val(response.data['due']);
                        $('#advance').val(response.data['advance']);
                        $('#arrears').val(response.data['arrears']);
                        $('#fine').val(response.data['fine']);
                        $body.removeClass("loading");
                        sweetAlert( {
                            title: response.message,
                          //  text : response.message,
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
                    } else {
                        $('#exampleModalLong').modal('hide');
                        $body.removeClass("loading");
                        $('.voucher_no').hide();
                        sweetAlert( {
                            title: response.message,
                          //  text : response.message,
                            type: 'error',
                            showConfirmButton: false,
                            timer: 3000,
                        });
                        window.history.pushState('receive_fee', 'Title', '<?= site_url() ?>fee_management/receive_fee/'+student_id+'');
                  
                        $.each( response.error, function ( index, value ) {
                            var errorDiv = '#' + index + '_error';
                            $( errorDiv ).empty().append( value );
                        } );
                    }
                }
            });
    }else{
        sweetAlert( {
          //  title: 'Submission Date Require' ,
            text : 'Submission Date Require',
            type: 'error',
            showConfirmButton: false,
            timer: 30000,
        });
    }
        });

    $( document ).on( 'click', '.waive_fee', function ( e ) {
        var $this = $( this );
        $this.button( 'loading' );
        e.preventDefault();
        voucher_id                  =  $("input[name=voucher_id1]").val();
        waive_voucher               =  $(this).attr('data-voucher');
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
            sweetAlert( {
                    title: "Waive Voucher",
                    text: "Do you want to waive this voucher?",
                    // type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#DD6B55',
                    confirmButtonText: 'Yes',
                    cancelButtonText: "No",
                    closeOnConfirm: true,
                },
                function ( isConfirm ) {
                    if ( isConfirm ) {
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
                        waive_voucher:waive_voucher,
                    },
                    dtatatype:'json',

                    success: function ( response ) {
                        var response = JSON.parse(response);
                        
                        if ( response.status == true ) {
                            $this.button( 'reset' );
                            $('#free').modal('hide');
                            sweetAlert( {
                               // title: response.status,
                                type: 'success',
                                showConfirmButton: false,
                                text: "Fee Waive have been done Successfully",
                                timer: 3000,
                            });
                            $this.button( 'reset' );
                            $('#monthly').val(response.data['due']);
                            $('#advance').val(response.data['advance']);
                            $('#arrears').val(response.data['arrears']);
                            $('#fine').val(response.data['fine']);
                            $('.voucher_no').hide();
                            $('#transation_history').DataTable().ajax.reload();
                            annual_report();
                            if(waive_voucher != null){
                                $('#unpaid_other').DataTable().ajax.reload();
                            }

                        } else if ( response.status == "fail" ) {
                            $.each( response.error, function ( index, value ) {
                                var errordelete_voucherDiv = '#' + index + '_error';
                                $( errorDiv ).empty().append( value );
                            } );
                        }
                    }
                });

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

        $( document ).on( 'click', '.waive_voucher', function ( e ) {
            var voucher = $(this).attr('data-voucher');
            var type = $(this).attr('data-type');
            e.preventDefault();
            sweetAlert( {
                    title: "Waive Voucher",
                    text: "Are You Sure you want to WAive",
                    // type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#DD6B55',
                    confirmButtonText: 'Yes',
                    cancelButtonText: "No",
                    closeOnConfirm: true,
                },
                function ( isConfirm ) {
                    if ( isConfirm ) {
                        $.ajax({
                            url: '<?php echo site_url("fee_management/waive_unpaid_ajax") ?>',
                            type: 'post',
                            dtatatype: 'json',
                            data: {
                                vrno: voucher,
                                student_id:getParameters(),
                            },
                            dataType: 'json',
                            success: function (response) {
                                if (response.status == "success") {
                                    sweetAlert({
                                        title: response.message,
                                        //    text : response.message,
                                        type: 'success',
                                        showConfirmButton: false,
                                        timer: 2000,
                                    });
                                    if (type == 1) {
                                        $('#unpaid_other').DataTable().ajax.reload();
                                    } else {
                                        $('#unpaid_tuition').DataTable().ajax.reload();
                                    }

                                } else if (response.status == "fail") {
                                    sweetAlert({
                                        title: response.message,
                                        //   text : response.message,
                                        type: 'error',
                                        showConfirmButton: false,
                                        timer: 2000,
                                    });
                                }
                            }
                        });
                    }
                } );
        });
        $( document ).on( 'click', '.delete_voucher', function ( e ) {
            var voucher = $(this).attr('data-voucher');
            var type = $(this).attr('data-type');
            e.preventDefault();
            sweetAlert( {
                    title: "Delete Voucher",
                    text: "Are You Sure you want to delete",
                    // type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#DD6B55',
                    confirmButtonText: 'Yes',
                    cancelButtonText: "No",
                    closeOnConfirm: true,
                },
                function ( isConfirm ) {
                    if ( isConfirm ) {  
                        $.ajax({
                            url: '<?php echo site_url("fee_management/delete_unpaid_ajax") ?>',
                            type: 'post',
                            dtatatype: 'json',
                            data: {
                                vrno: voucher,
                            },
                            dataType: 'json',
                            success: function (response) {
                                if (response.status == "success") {
                                    sweetAlert({
                                        title: response.message, 
                                        //    text : response.message,
                                        type: 'success',
                                        showConfirmButton: false,
                                        timer: 4000,
                                    },function(){ 
                                        if (type == 1) {
                                        location.reload();
                                        }
                                    });

                                    if (type == 1) {
                                        $('#unpaid_other').DataTable().ajax.reload();
                                    } else {
                                        $('#unpaid_tuition').DataTable().ajax.reload();
                                    }

                                } else if (response.status == "fail") {
                                    sweetAlert({
                                        title: response.message,
                                        //   text : response.message,
                                        type: 'error',
                                        showConfirmButton: false,
                                        timer: 2000,
                                    });
                                }
                            }
                        });
                    }
                } );
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
            e.preventDefault();
            $.ajax( {
            type: "get",
            url: '<?php echo site_url( "fee_management/check_unpaid_ajax" ) ?>',
            dataType: 'JSON',
            data: {
              student_id:getParameters(),
            },
            success: function ( data ) {
                if(data == 1 ){
                 
                    sweetAlert({
                        title: "Alert",
                        text : "To Proceed fee waive off , delete existing Tuition fee unpaid voucher(s)",
                        type: 'warning',
                        showConfirmButton: false,
                        timer: 3000,
                    });

                    $('#free').modal('toggle').hide();
                    // $("#free_submit").addClass("disabledbutton_tuition_fee");
                }else{
                    
                    $("#free_submit").removeClass("disabledbutton_tuition_fee");
                    var fee_collect_confirmation = confirm( "Do You Want to Proceed To Fee Waive?" );
                    if ( fee_collect_confirmation === false ) {
                        $('#free').modal('toggle').show();
                    }
                }
              
            }
        } );

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
    $(".unpaid_student_input").on('click', function(){
        $.ajax( {
            type: "get",
            url: '<?php echo site_url( "fee_management/check_unpaid_ajax" ) ?>',
            dataType: 'JSON',
            data: {
              student_id:getParameters(),
            },
            success: function ( data ) {
                if(data == 1 ){
                    console.log("sdfdsfdsf");
                    $('.unpaid_student_input').blur(); 

                sweetAlert({
                    title: "Alert",
                    text : "Delete The Monthly Fee Voucher Before Editing The Fee / Arrears.",
                    type: 'warning',
                    showConfirmButton: false,
                    timer: 2000,
                }); 
                $(".unpaid_student_input").addClass("disabledbutton_tuition_fee");
                }else{
                    $(".unpaid_student_input").removeClass("disabledbutton_tuition_fee");
                }
              
            }
        } );
      
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
