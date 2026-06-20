<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<style type="text/css">
    /*REQUIRED*/
    .carousel-row {
        margin-bottom: 10px;
    }
    
    .nav-tabs-custom > .nav-tabs > li.active {
        border-top-color: #000;
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
        <h4 class="pull-left" style="margin-bottom: 0px;">
 <?php if($fee_status == 'undue'){ ?>
            <?= date('M') ?>  <?= $string = implode('-', array_map('ucfirst', explode('-', $fee_status))); ?>/Adjusted
 <?php }else{ ?>
 
            <?= date('M') ?>  <?= $string = implode('-', array_map('ucfirst', explode('-', $fee_status))); ?>
 <?php }?>
            Fee Status
        </h4>

        <div class="pull-right">
            
            <a href="<?= site_url( 'student/send_sms_to_student_with_due_fee_all' ) . '?redirect=' . urlencode( $redirect_url ) ?>" class="btn btn-primary btn-sm">Send SMS to students with due fee</a>
            
            <!-- <a href="<?= site_url( 'student/send_sms_to_student_with_fee_arrears' ) . '?redirect=' . urlencode( $redirect_url ) ?>" class="btn btn-primary btn-sm">Send sms to students with fee arrears</a> -->
        </div>

        <div class="clearfix"></div>
    </section>
    <!-- Main content -->
    <section class="content" style="padding-top: 7px;">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                             <?php echo $this->lang->line( 'select_criteria' ); ?>
                        </h3>
                        <div class="pull-right">
                            <span>Male (<?= $total->male ?> )</span> + 
                            <span>Female ( <?= $total->female ?> )</span>
                            <span>= <?= $total->male + $total->female ?></span>
                        </div>
                    </div>
                    <div class="box-body">
                        <?php if ( $this->session->flashdata( 'msg' ) ) { ?>
                            <div class="alert alert-success">  <?php echo $this->session->flashdata( 'msg' ) ?> </div> <?php } ?>
                        <div class="">
                            <div class="col-md-8">
                                <form role="form" action="<?php echo site_url( 'student/search' ) ?>" method="post" class="form-horizontal">
                                    <?php echo $this->customlib->getCSRF(); ?>
                                    <div class="form-group">
                                        <div class="col-sm-3">
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
                                        <div class="col-sm-3">
                                            <label><?php echo $this->lang->line( 'section' ); ?></label>
                                            <select id="section_id" name="section_id" class="form-control">
                                                <option value=""><?php echo $this->lang->line( 'select' ); ?></option>
                                            </select>
                                            <span class="text-danger"><?php echo form_error( 'section_id' ); ?></span>
                                        </div>
                                        <div class="col-sm-3">
                                            <label>Gender</label>
                                            <select class="form-control" name="gender">
                                                <option value="" <?= set_select( 'gender', '', ( $gender == '' ) ) ?>>Both</option>
                                                <option value="male" <?= set_select( 'gender', 'male', ( $gender == 'male' ) ) ?>>Male</option>
                                                <option value="female" <?= set_select( 'gender', 'female', ( $gender == 'female' ) ) ?>>Female</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-3">
                                            <label>Fee</label>
                                            <select class="form-control" name="fee_status">
                                                <!-- <option value="" <?= set_select( 'fee_status', '', ( $fee_status == '' ) ) ?>>Both</option> -->
                                                <option value="advance" <?= set_select( 'fee_status', 'advance', ( $fee_status == 'advance' ) ) ?>>Advance</option>
                                                <option value="due" <?= set_select( 'fee_status', 'due', ( $fee_status == 'due' ) ) ?>>Due</option>
                                                 <option value="undue" <?= set_select( 'fee_status', 'undue', ( $fee_status == 'undue' ) ) ?>>Undue/Adjusted</option>
                                            </select>
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
                            <div class="col-md-4">
                                <form role="form" action="<?php echo site_url( 'student/search' ) ?>" method="post" class="form-horizontal">
                                    <?php echo $this->customlib->getCSRF(); ?>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <label><?php echo $this->lang->line( 'search_by_keyword' ); ?></label>
                                            <input type="text" name="search_text" class="form-control" placeholder="<?php echo $this->lang->line( 'search_by_name,_roll_no,_enroll_no,_national_identification_no,_local_identification_no_etc..' ); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button type="submit" name="search" value="search_full" class="btn btn-primary pull-right btn-sm checkbox-toggle">
                                                <i class="fa fa-search"></i> <?php echo $this->lang->line( 'search' ); ?>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                <?php
                if ( isset( $resultlist ) ) {
				if ($fee_status != 'undue'){
                     ?>
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#tab_1" data-toggle="tab" aria-expanded="true"><i class="fa fa-list"></i> <?php echo $this->lang->line( 'list' ); ?>  <?php echo $this->lang->line( 'view' ); ?>
                                </a></li>
                            <li class="">
                                <a href="#tab_2" data-toggle="tab" aria-expanded="false"><i class="fa fa-newspaper-o"></i> <?php echo $this->lang->line( 'details' ); ?> <?php echo $this->lang->line( 'view' ); ?>
                                </a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active table-responsive no-padding" id="tab_1">

                                <table class="table     table-bordered table-hover" id="due_reports" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th class="text-center">S.No</th>
                                            <th class="text-center">Ad Date</th>
                                            <th class="text-center">Ad. No.</th>
                                            <th class="text-center"><?php echo $this->lang->line( 'class' ); ?>(Section)</th>
                                            <th class="text-center">Roll No.</th>
                                            <th><?php echo $this->lang->line( 'student_name' ); ?></th>
                                            <th><?php echo $this->lang->line( 'father_name' ); ?></th>
                                            <th><?php echo $this->lang->line( 'gender' ); ?></th>
                                            <th><?php echo $this->lang->line( 'mobile_no' ); ?></th>

                                            <th class="text-center">Class Fee</th>
                                            <th class="text-center">Discount</th>
                                            <th class="text-center">Fee</th>
                                            <?php if ($fee_status != 'advance'): ?>
                                            <th class="text-center">Fee Paid</th>
                                            <?php endif ?>
                                            <?php if ($fee_status != 'advance'): ?>
                                                <th class="text-center">Fee Due</th>
                                                <th class="text-center">Fine</th>
                                            <?php endif ?>
                                            <?php if ($fee_status == 'advance' ): ?>
                                                <th class="text-center">Advance</th>
                                            <?php endif ?>
                                           
                                            <th class="text-right"><?php echo $this->lang->line( 'action' ); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(empty( $resultlist)) { ?>
                                            <tr>
                                                <td colspan="12" class="text-danger text-center"><?php echo $this->lang->line( 'no_record_found' ); ?></td>
                                            </tr>
                                            <?php 
                                             }else{
                                            $count              = 1;
                                            $class_fees_m       = 0;
                                            $due_fees_m         = 0;
                                            $advance_m          = 0;
                                            $total_current_dues = 0;
                                            $total_paid         = 0;
                                            $total_fine         = 0;
										    foreach ( $resultlist as $student ) {
                                                if($student['struck_off'] == 1){    
                                                    $student['late_payment_fee'] =0;
                                                }
                                                $total_fine            += $student['late_payment_fee'];
                                                $check                  = 0;
                                                $paid_fee               = 0;
                                                $discount_fee           = $student['class_fee'] - $student['discount'];
                                                $arrears                = 0;
                                                $current_month_arrears  = 0;
                                                    if ($student['fee_arrears'] > 0) {

                                                        // calculate current student arrears
                                                    $fee_arrears = $student['fee_arrears'] - $discount_fee - $student['late_payment_fee'];  // 3150 -1200 -150  
                                                        // calculate current student fine
                                                        $late_payment_fee = $student['late_payment_fee'];              // 150
                                                        //  if($late_payment_fee == null){
                                                        //  $student_fee_fine_type = $this->custom_option_model->get( 'fine_per_day_for_fee');
                                                        //  $late_payment_fee =   $student_fee_fine_type['value'];
                                                        //  }
					                                   $current_fee = $student['fee_arrears'] - $late_payment_fee;      // 3150 - 150
                                                        if ($current_fee > $discount_fee) {                             //3000 >1200
                                                            $due_fee     = $discount_fee;                               //  1200
                                                        }else{
                                                            $due_fee     = $current_fee;                                // 500 ok
                                                        }
                                                        if($fee_arrears < 0){
                                                            $fee_arrears = 0;
                                                        }
                                                    }
                                                    
                                                    if ($student['fee_arrears'] < 0) {
                                                        $fee_advance_month += abs($student['fee_arrears']);
                                                    }
											    foreach ($current_month_payments as  $cmp) {
                                                    if ($cmp['student_id'] == $student['id']) {
                                                        // $paid_fee += $cmp['tuition_fee'];
                                                if ($cmp['due_fee'] > 0 ) {
                                                 $current_month_arrears = intval($cmp['due_fee']) -intval($discount_fee) - intval($cmp['late_payment_fee']);   // 3650 - 1200 - 150 = 2350

                                                    if ($cmp['tuition_fee'] <= $current_month_arrears) {   //3000 < 2350
                                                        $arrears = intval($cmp['tuition_fee']);            //1200
                                                        $paid_fee = 0;                                      // 0
                                                    }elseif ($cmp['tuition_fee'] > $current_month_arrears){ //3000 > 2350  ok

                                                        $arrears            = $current_month_arrears;       //2350
                                                        $tuition_fee_left   = $cmp['tuition_fee'];          //3000
                                                        
                                                        if ($tuition_fee_left <= $discount_fee) {           //3000 <= 1200
                                                            $paid_fee        = $tuition_fee_left;          //3000   ok

                                                        }else{

                                                            $paid_fee        = $discount_fee - $due_fee;               //1200
                                                            $tuition_fee_left   = $tuition_fee_left - $discount_fee;  //  3000 -1200
                                                        }

                                                    }
                                                }elseif($cmp['due_fee'] <= 0){
                                                    $paid_fee    = 0;
                                                    $arrears     = 0;
                                                }
                                                // if ($paid_fee >= $discount_fee && $fee_status != 'advance') {
                                                        //     $check = 1;
                                                        // }
                                                    }
                                                }
												
											
                                                    $class_fees_m   += $student['class_fee'];
                                                    $due_fees_m     += $discount_fee;
                                                    $total_paid_fee += $paid_fee;
                                                  

                                                   if ($due_fee > 0 || $fee_status == 'advance' ) {
                                                    
                                                ?>
                                                    <tr <?= $student['struck_off']==1?'style="color:red;"':''?> >
                                                    <td><?php echo $count;$count++; ?></td>
                                                    <td class="text-center"><?php echo date('d-m-Y',strtotime($student['admission_date'])); ?></td>
                                                    <td class="text-center"><?php echo $student['admission_no']; ?></td>
                                                    <td class="text-center"><?php echo $student['class'] . "(" . $student['section'] . ")" ?></td>
                                                    <td class="text-center"><?= $student['roll_no'] ?></td>
                                                    <td>
                                                        <a href="<?php echo base_url(); ?>student/view/<?php echo $student['id']; ?>" <?= $student['struck_off']==1?'style="color:red;"':''?> >
                                                            <?php echo $student['firstname'] . " " . $student['lastname']; ?>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a href="<?= site_url( "family/children_summary/" . $student['id'] ) ?>" <?= $student['struck_off']==1?'style="color:red;"':''?> >
                                                            <?php echo $student['father_name']; ?>
                                                        </a>
                                                    </td>
                                                    <td><?php echo $student['gender']; ?></td>
                                                    <td><?php echo $student['father_phone']; ?></td>
                                                    <td class="text-center"> <?= number_format( $student['class_fee'] ) ?></td>
                                                    <td class="text-center"> <?= number_format( $student['discount'] ) ?></td>
                                                    <td class="text-center"> <?= number_format( $student['class_fee'] - $student['discount'] ) ?></td>
                                                    <?php if ($fee_status != 'advance' ): ?>
                                                    <td class="text-center">
                                                         <?= number_format( $paid_fee ) ?>
                                                    </td>
                                                    <?php endif ?>
                                                    <?php if ($fee_status != 'advance'){ 
                                                        if($student['struck_off'] == 1){
                                                        $due_fee =0;
                                                       
                                                        $student['late_payment_fee']= 0;
                                                    }
                                                        
                                                        $total_current_dues += $due_fee;?>
                                                        <td class="text-center"> <?= number_format( $due_fee )?></td>
                                                        <td class="text-center"><?= $student['late_payment_fee'] ?></td>
                                                    <?php } ?>
                                                    <?php if ($fee_status == 'advance'  ): ?>
                                                        <td class="text-center"> <?= intval( $student['fee_arrears'] ) < 0 ? number_format( abs( $student['fee_arrears'] ), 0, '', ',' ) : 0 ?></td>
                                                    <?php endif ?>

                                                               

                                                    <td >
                                                    
                                                        <a href="<?php echo base_url(); ?>fee_management/receive_fee/<?php echo $student['id'] ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="" data-original-title="Student Account">
                                                            <i class="fa fa-money"></i>
                                                        </a>
                                                        
                                                    </td>
                                                </tr>
                                                
                                                <?php
                                                    }
                                            }
                                        }
                                        ?>
                                        <tr style="display: none;">
                                            <?php
                                                if ($fee_status == 'advance' ) {
                                            ?>
                                                <td style="display: none;"></td>
                                                <td style="display: none;"></td>
                                                <td style="display: none;"></td>
                                                <td style="display: none;"></td>
                                                <td style="display: none;"></td>
                                                <td style="display: none;"></td>
                                                <td style="display: none;"></td>
                                                <td style="display: none;"></td>
                                                <td colspan="9" class="text-center">Total</td>
                                                <td> <?= $total->class_fee ?></td>
                                                <td></td>
                                                <td></td>
                                                <?php if ($fee_status != 'advance' ): ?>
                                                    <td></td>
                                                    <td> <?= $total->dues ?></td>
                                                <?php endif ?>
                                                <?php if ($fee_status == 'advance'  ): ?>
                                                    <td> <?= $total->advance ?></td>
                                                <?php endif ?>
                                                <td></td>
                                            <?php
                                            }else{
                                            ?>
                                                <td style="display: none;"></td>
                                                <td style="display: none;"></td>
                                                <td style="display: none;"></td>
                                                <td style="display: none;"></td>
                                                <td style="display: none;"></td>
                                                <td style="display: none;"></td>
                                                <td style="display: none;"></td>
                                                <td style="display: none;"></td>
                                                <td colspan="9" class="text-center">Total</td>
                                                <td> <?= $class_fees_m ?></td>
                                                
                                                <?php if ($fee_status != 'advance' ): ?>
                                                <td></td>
                                                <?php endif ?>
                                                <?php if ($fee_status != 'advance'): ?>
                                                    <td> <?= $due_fees_m ?></td>
                                                <?php endif ?>
                                                <?php if ($fee_status == 'advance' ): ?>
                                                    <td> <?= $total->advance ?></td>
                                                <?php endif ?>
                                                <td>
                                                    <?php 
                                                        $total_paid = $due_fees_m - $total_current_dues;
                                                        echo $total_paid;
                                                    ?>
                                                </td>
                                                <td><?= $total_current_dues ?></td>
                                                <td><?= $total_fine ?></td>
                                                <td></td>
                                            <?php
                                            }
                                            ?>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <?php
                                                if ($fee_status == 'advance' ) {
                                            ?>
                                                <th colspan="9" class="text-right">Total</th>
                                                <th class="text-center"> <?= $total->class_fee ?></th>
                                                <th></th>
                                                <?php if ($fee_status != 'advance' ): ?>
                                                    <th></th>
                                                    <th class="text-center"> <?= $total->dues ?></th>
                                                <?php endif ?>
                                                <?php if ($fee_status == 'advance'  ): ?>
                                                    <th></th>
                                                    <th class="text-center"> <?= $total->advance ?></th>
                                                <?php endif ?>
                                                <th></th>
                                            <?php
                                            }else{
                                            ?>
                                                <th colspan="9" class="text-right">Total</th>
                                                <th class="text-center"> <?= $class_fees_m ?></th>
                                                <th></th>
                                                <?php if ($fee_status != 'advance'): ?>
                                                    <th class="text-center"> <?= $due_fees_m ?></th>
                                                <?php endif ?>
                                                <?php if ($fee_status == 'advance'):  ?>
                                                    <th class="text-center"> <?= $total->advance ?></th>
                                                <?php endif ?>
                                                <th class="text-center">
                                                    
                                                    <?php 
                                                        $total_paid = $due_fees_m - $total_current_dues;
                                                        echo $total_paid_fee;
                                                    ?>
                                                </th>
                                                <th class="text-center"><?= $total_current_dues ?></th>
                                                <th class="text-center"><?= $total_fine ?></th>
                                            <?php
                                            }
                                            ?>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="tab-pane" id="tab_2">
                                <?php if ( empty( $resultlist ) ) {
                                    ?>
                                    <div class="alert alert-info"><?php echo $this->lang->line( 'no_record_found' ); ?></div>
                                    <?php
                                } else {
                                    $count = 1;
                                    foreach ( $resultlist as $student ) {
                                        ?>
                                        
                                        <div class="carousel-row">
                                            <div class="slide-row">
                                                <div id="carousel-2" class="carousel slide slide-carousel" data-ride="carousel">
                                                    <div class="carousel-inner">
                                                        <div class="item active">
                                                            <a href="<?php echo base_url(); ?>student/view/<?php echo $student['id'] ?>">
                                                                <img class="img-responsive img-thumbnail width150" alt="Cinque Terre" src="<?php echo base_url() . $student['image'] ?>" alt="Image"></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="slide-content">
                                                    <h4>
                                                        <a href="<?php echo base_url(); ?>student/view/<?php echo $student['id'] ?>"> <?php echo $student['firstname'] . " " . $student['lastname'] ?></a>
                                                    </h4>
                                                    <div class="row">
                                                        <div class="col-xs-6 col-md-6">
                                                            <address>
                                                                <strong><b><?php echo $this->lang->line( 'class' ); ?>: </b><?php echo $student['class'] . "(" . $student['section'] . ")" ?>
                                                                </strong><br>
                                                                <b><?php echo $this->lang->line( 'admission_no' ); ?>: </b><?php echo $student['admission_no'] ?>
                                                                <br/>
                                                                <b><?php echo $this->lang->line( 'date_of_birth' ); ?>:
                                                                    <?php echo date( $this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat( $student['dob'] ) ); ?>
                                                                    <br>
                                                                    <b><?php echo $this->lang->line( 'gender' ); ?>:&nbsp;</b><?php echo $student['gender'] ?>
                                                                    <br>
                                                            </address>
                                                        </div>
                                                        <div class="col-xs-6 col-md-6">
                                                            <b><?php echo $this->lang->line( 'local_identification_no' ); ?>:&nbsp;</b><?php echo $student['samagra_id'] ?>
                                                            <br>
                                                            <b><?php echo $this->lang->line( 'guardian_name' ); ?>:&nbsp;</b><?php echo $student['father_name'] ?>
                                                            <br>
                                                            <b><?php echo $this->lang->line( 'guardian_phone' ); ?>: </b>
                                                            <abbr title="Phone"><i class="fa fa-phone-square"></i>&nbsp;</abbr> <?php echo $student['guardian_phone'] ?>
                                                            <br>
                                                            <b><?php echo $this->lang->line( 'current_address' ); ?>:&nbsp;</b><?php echo $student['current_address'] ?> <?php echo $student['city'] ?>
                                                            <br>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="slide-footer">
                                                    <span class="pull-right buttons">
                                                        <a href="<?php echo base_url(); ?>student/view/<?php echo $student['id'] ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="<?php echo $this->lang->line( 'show' ); ?>">
                                                            <i class="fa fa-reorder"></i>
                                                        </a>
                                                        <a href="<?php echo base_url(); ?>student/edit/<?php echo $student['id'] ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="<?php echo $this->lang->line( 'edit' ); ?>">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                        <a href="<?php echo base_url(); ?>fee_management/receive_fee/<?php echo $student['id'] ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="" data-original-title="<?php echo $this->lang->line( 'add_fees' ); ?>">
                                                            <?php echo $currency_symbol; ?>
                                                        </a>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php }
                                    $count++;
                                } ?>
                            </div>
                        </div>
                    </div>  
                    <?php }?>
                    
                    <?php if ( $fee_status == 'undue' ): ?>
                    <div class="box box-primary">
                    <div class="box-header">
                     <h3 class="box-title">
                            Advance Adjusted Students 
                        </h3>
                    </div>

                    <div class="box-body">
                        <?php
                        if ( empty( $student_advance ) ):  ?>
                            <p class="bold text-center text-danger">No Adv Adj students found within this range.</p>
                        <?php else: ?>
                            <div class="table-responsive">
                                <table class="table  table-hover table-bordered " id="adjusted">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th class="text-center">Ad Date</th>
                                            <th class="text-center">Ad. No.</th>
                                            <th class="text-center">Class(Section)</th>
                                            <th class="text-center">Roll No.</th>
                                            <th>Student Name</th>
                                            <th>Father's Name</th>
                                            <th>Gender</th>
                                            <th>Mobile No.</th>
                                            <th>Adjusted Fee</th>
                                            <th>Balance</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                            $total_fee = 0;
                                            $total_fee_arrears = 0;
                                            $total_fee_arrears_plus = 0;
                                            $total_fee_arrears_negative = 0;
                                            
                                            $total_advance_fee = 0;

                                            foreach ( $student_advance as $key => $student ): 
                                            $total_fee += $student['fee'];
                                        ?>
                                            <tr <?= $student['struck_off']==1?'style="color:red;"':''?> >
                                                <td><?= $key+1 ?></td>
                                                   <td class="text-center"><?php echo date('d-M-Y',strtotime($student['admission_date'])); ?></td>
                                                <td class="text-center"><?= $student['admission_no'] ?></td>
                                                <td class="text-center"><?= classes($student['class_id'])."(".sections($student['section_id']).")" ?></td>
                                                <td class="text-center"><?= $student['roll_no'] ?></td>
                                                <td>
                                                <a href="<?php echo base_url(); ?>student/view/<?php echo $student['student_id']; ?>" <?= $student['struck_off']==1?'style="color:red;"':''?> ><?= $student['firstname'] . ' ' . $student['lastname'] ?>
                                                        </a>  
                                                </td>
                                                <td> <a  href="<?= site_url( "family/children_summary/{$student['id']}" ) ?>" <?= $student['struck_off']==1?'style="color:red;"':''?> >
                                                        <?= $student['father_name'] ?>
                                                    </a>
                                                </td>
                                                <td><?= $student['gender'] ?></td>
                                                <td><?= $student['father_phone'] ?></td>
                                                 <td><?= $student['advance_fee'] ?></td>
                                                  
                                                <?php  ?>

                                               <?php
                                              
                                              // echo $total_fee_arrears_plus;
                                              // echo $total_fee_arrears_negative;
                                               
                                               $total_fee_arrears = $student['fee_arrears'];

                                               ?>  
                                               <td><?= $student['fee_arrears'] ?></td>

                                                <?php  $total_advance_fee += $student['advance_fee'];?>
                                                <td>
                                                    <a href="<?= site_url( "fee_management/receive_fee/{$student['student_id']}" ) ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="" data-original-title="Student Account">
                                                        <i class="fa fa-money"></i>
                                                    </a>

                                                        <!-- <a href="< ?php echo base_url(); ?>fee_management/fee_voucher?student_id=< ?php echo $student['student_id'] ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="Fee Voucher">
                                                            <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                                                        </a> -->
  
                                                </td>
                                            </tr>
                                        <?php  endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                         <th colspan="8"  class="text-right"></th>
                                                <th  class="text-left">Total</th>
                                                <th><?= number_format($total_advance_fee) ?></th>
                                                <th>
                                                    <?= number_format($total_fee_arrears) ?>
                                                </th>
                                            </tr>
                                    </tfoot>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                    
                       <?php endif; ?>
                
                       
                    
                    <?php
                }
                ?>
                
             
                
                
                     
                       
                       
            </div>
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
    } );
</script>