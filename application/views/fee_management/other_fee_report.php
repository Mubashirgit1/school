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
    .select2-container{
    width:100px !important;
    }
    .type{
        width:115px !important;
    }
</style>

<div class="content-wrapper" style="min-height: 946px;">
    <?php $this->general_library->err_msg() ?>

    
    <section class="content-header">
     <div class="box box-primary" style="margin-bottom: 0px;">  
      <div class="box-header with-border" style="padding: 20px;">
    
        <form role="form" action="<?php   echo site_url( 'fee_management/other_fee_report' ) ?>" method="get" class="form-horizontal">
        <div class="col-md-12 col-sm-12">
            <h4>
                Other Fee Collection
            </h4>
        </div>
        <div class="col-md-12 col-sm-12">
            <div class="form-group">

                <div class="col-sm-3 col-md-1">
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
                <div class="col-sm-3 col-md-1">
         
                    <label><?php echo $this->lang->line( 'section' ); ?></label>
                    <select id="section_id" name="section_id" class="form-control">
                        <option value=""><?php echo $this->lang->line( 'select' ); ?></option>
                    </select>
                    <span class="text-danger"><?php echo form_error( 'section_id' ); ?></span>
                </div>
                <div class="col-sm-6 col-md-1">

                    <label>Type</label>

                  
                    <select class="form-control type" name="search_type_" id="search_type_">
                    <option value="student_wise" <?php if (  $search_type_ == 'student_wise' ) echo "selected=selected" ?>  >Student Wise</option>
                        <option value="class_wise" <?php if (  $search_type_ == 'class_wise' ) echo "selected=selected" ?>>Class Wise</option>
                        
                    </select>
                </div>
                <div class="col-sm-6 col-md-2">
                    <label style="margin-left: 20px;">Transaction Type</label>
                    <select style="margin-left: 20px;" class="form-control" name="search_type" id="search_type">
                        <option value="paid" <?= set_select( 'search_type', 'paid', true ) ?>>Paid (other Fee)</option>
                        <option value="pending" <?= set_select( 'search_type', 'pending' ) ?>>Unpaid (other Fee)</option>
                    </select>
                </div>
                
                <div class="col-sm-6 col-md-2">
                    <label>Fee Types</label>
                    <select class="form-control" id="other_fee_types" name="other_fee_types">
                        <option value="">All</option>
                        <?php
                        if ( $fee_types !== false ):
                            foreach ( $fee_types as $fee_type ):
                                ?>
                                <option value="<?= $fee_type['name'] ?>" <?= set_select( 'other_fee_types', $fee_type['name'], set_value( 'other_fee_types' ) == $fee_type['name'] ) ?>><?= $fee_type['name'] ?></option>
                                <?php
                            endforeach;
                        endif;
                        ?>
                    </select>
                </div>
                <?php if($search_type !=  "paid"  ){?>
                <div class="col-sm-6 col-md-1" >
                    <label>Month Wise  </label>
                    <select class="form-control" id="month" name="month">
                        <?php  $select = ' ';  if($month == null){  $select = 'selected'; } ?>
                        <option class="other_fee2"   value=" " <?= $select ?>>ALL</option>
                        <?php for ( $i = 0; $i < count( $month_names1 ); $i++ ):   ?>
                            <option class="other_fee2"   value="<?= $i + 1 ?>" <?= set_select( 'month', ( $i + 1 ), ( $month == $month_names1[$i] ) ) ?>> <?= $month_names1[$i] ?> </option>
                        <?php  endfor; ?>
                    </select>
                </div>
                <?php } ?>
                <div class="col-sm-6 col-md-2">
                    <label>Date from</label>
                    <input type="text" name="date_from" class="form-control date" value="<?= set_value( 'date_from' ) ?>" readonly>
                </div>

                <div class="col-sm-6 col-md-2">
                    <label>Date to</label>
                    <input type="text" name="date_to" class="form-control date" value="<?= set_value( 'date_to' ) ?>" readonly>
                </div>
             
               
            </div>
        </div>
        
        <div class="col-md-12 col-sm-12">
            <div class="form-group pull-right">
      
                    <label style="width: 100%;">&nbsp;</label>
                    <button type="submit" name="search" value="search_filter" class="btn btn-primary btn-sm ">
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
            <!-- <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <i class="fa fa-search"></i> <?php echo $this->lang->line( 'select_criteria' ); ?></h3>
                    </div>
                    <div class="box-body">


                        <div class="">
                            <div class="col-md-12">
                                <form role="form" action="<?php echo site_url( 'fee_management/other_fee_report' ) ?>" method="get" class="form-horizontal">

                                    <div class="form-group">

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
                                            <label>Fee Types</label>
                                            <select class="form-control" id="other_fee_types" name="other_fee_types">
                                                <option value="">Select</option>
                                                <?php
                                                if ( $fee_types !== false ):
                                                    foreach ( $fee_types as $fee_type ):
                                                        ?>
                                                        <option value="<?= $fee_type['name'] ?>" <?= set_select( 'other_fee_types', $fee_type['name'], set_value( 'other_fee_types' ) == $fee_type['name'] ) ?>><?= $fee_type['name'] ?></option>
                                                        <?php
                                                    endforeach;
                                                endif;
                                                ?>
                                            </select>
                                        </div>

                                        <div class="col-sm-6 col-md-2">
                                            <label>Search Type</label>
                                            <select class="form-control" name="search_type">
                                                <option value="paid" <?= set_select( 'search_type', 'paid', true ) ?>>Paid</option>
                                                <option value="pending" <?= set_select( 'search_type', 'pending' ) ?>>Unpaid</option>
                                            </select>
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
                            <?php
                            if($search_type_ == 'student_wise'){

                           
                            
                            if($search_type == 'pending'){   ?>
                              <form action="" method="post" > 
                <div class="col-sm-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                   <h3 class="box-title"> Unpaid Voucher (Other Fee) </h3>
                   
                   
                    <?php if( !empty($class_id) ){
                        ?>
                        <div class="form-group pull-right" style="margin:5px;">
                                    <button type="submit" class="btn btn-default btn-sm pull-right delete_voucher_all" > <i class="fas fa-trash-alt"></i></button>
                                </div>
                           <div class="form-group pull-right" style="margin:5px;">
                                    <button type="submit" class="btn btn-default btn-sm pull-right" formaction="<?php echo base_url(); ?>fee_management/fee_voucher_process_all?vrno=&student_id="<?php echo $unpaid_student['student_id'] ?>""><i class="fa fa-print "></i></button>
                             
                                </div>
                                
                            <?php }?>
                            
                   
                     <div class="checkbox pull-right">
                                    <label>
                         <input type="checkbox" class="bank_copy check11" id="bank_copy" name="bank_copy" value="1" checked>
                                        <span class="text-danger">
                                            <b>Bank Copy</b>
                                        </span>
                                    </label>
                                </div>
                                
                                
                                
                    </div>

                            <div class="box-body  ">
                       
                            <div class="table-responsive">
                                <table class="table     table-bordered table-hover" id="student_wise_unpaid" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th class="text-center">S. No.</th>
                                            <th class="text-center">Vr No</th>
                                            <th class="text-center">Ad Date</th>
                                            <th class="text-center">Ad No</th>
                                            <th class="text-center">Class(Section)</th>
                                            <th class="text-center">Roll No</th>
                                            <th class="text-left">Student Name</th> 
                                            <th class="text-left">Father Name</th> 
                                            <th class="text-left">Father Phone</th> 
                                            <?php  if ( $other_fee_types === null ) { ?>
									        <th class="text-left" ><?=  "Other Fee Types"."<span class='pull-right'>Amount</span>"; ?></th>
                                            <?php  } else { ?>
                                            <th class="text-center"><?= $other_fee_types;  ?></th>
										    <?php  } ?> 
                                            <th class="text-center">Total Fee.</th> 
                                            <th class="text-center">Issue Date</th>
                                            <th class="text-center">Due Date</th>
                                            <th class="text-right">Action</th>
                                            <?php if( !empty($class_id) ){?>
                                            <th class="text-right"><div class="form-group pull-right" ><input type="checkbox" class="class_section_checkbox select_checkbox" data-target=".student_checkbox_<?= $class_id.'_'. $section_id ?>"></div></th>
                                            <?php }?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $count = 0;
                                    $total_other = 0;
                                    $total_other_security = 0;
                                    foreach ( $unpaid_students_other as $unpaid_student_other ):
                                        if($unpaid_student_other['student']['struck_off'] == 0  && $unpaid_student_other['student'] != null){  
                                        $count++; ?>
                                        <tr class="voucher_<?= $unpaid_student_other['voucher_id']  ?>">
                                                    
             <td class="vertical_align_middle text-center"><?= $count ?></td>      
             <td class="vertical_align_middle text-center"><?= $unpaid_student_other['voucher_id']  ?></td>
             <td  class="vertical_align_middle text-center"><?= date('d-M-y',strtotime($unpaid_student_other['student']['admission_date']))  ?></td>
             <td  class="vertical_align_middle text-center"><?= $unpaid_student_other['student']['admission_no']  ?></td>
             <td  class="vertical_align_middle text-center"><?= $unpaid_student_other['student']['class']."(" .$unpaid_student_other['student']['section'].")"  ?></td>
             <td  class="vertical_align_middle text-center"><?= $unpaid_student_other['student']['roll_no']  ?></td>
             <td  class="vertical_align_middle text-left">
			 <a href="<?php echo base_url(); ?>student/view/<?= $unpaid_student_other['student']['id']; ?>" <?= $unpaid_student_other['student']['struck_off']==1?'style="color:red;"':''?> >
			 <?php echo $unpaid_student_other['student']['firstname'].$unpaid_student_other['student']['lastname']  ?>
             </a>
             </td>
             <td  class="vertical_align_middle text-left">
			 <a href="<?= site_url( "family/children_summary/" . $unpaid_student_other['student']['id'] ) ?>" <?= $unpaid_student_other['student']['struck_off']==1?'style="color:red;"':''?> >
			 <?php echo $unpaid_student_other['student']['father_name']  ?>
             
             </a>
             </td>   
             <td  class="vertical_align_middle text-left">
             <?=$unpaid_student_other['student']['father_phone'] ?>
             </td>   


						                <?php /*?> <?php foreach( $unpaid_student_other['voucher_fee_types'] as $other_fee ){ ?>
                                                    
                                                     <?php if($other_fee['amount'] !== null){?>
                                                    <td class="text-center"><?= number_format($other_fee['amount']) ?></td>
                                                     
													 <? }else{ ?>
                                                     
                                                     
                                                     <?php }?>
                                                    
                                                    <?php }?><?php */?>
                                        
                                                    
                                                   <td>
                                                   <table class="table table-bordered    " style="margin-bottom: 0px;"><?php /*?>                                                      <tbody>
                                                <?php foreach( $unpaid_student_other['voucher_fee_types'] as $other_fee ){ ?>
                                                   
                                                                       <tr>
                                               <td class="text-left"><?= $other_fee['name'] ?></td>
                                               <td class="text-right"><?= $other_fee['amount'] ?></td> 
                                                                        </tr>
                                                 <?php }?> 
                                                   
<?php */?>                                        <tbody>
                                                  <?php if ( empty( $unpaid_student_other['voucher_fee_types'] ) ): ?>
                                                                N/A
                                                   <?php else: ?>
                                               <?php foreach( $unpaid_student_other['voucher_fee_types'] as $other_fee ): ?>
                                               
                                               <?php if ($other_fee['name'] !== null) {  ?>
                                               
								              <?php if ($other_fee['amount'] > 0) {  ?>
                                               <tr>
                                                
                                                         <?php if ( $other_fee_types === null ): ?>
                                                <td class="text-left"><?= $other_fee['name'] ?></td>                                                         <?php endif; ?>
                                                
                                                 <td 
                                                 <?php if ( $other_fee_types === null ){ ?> 
                                                 
                                                 class="text-right" 
                                                  <?php }else{ ?>
                                                 class="text-center" 
												 <?php }?>
                                                 	
                                                 ><?= number_format($other_fee['amount']) ?> </td>
                                                 
                                            <?php $total_others_fee =  $other_fee['amount'];?>
                                                    <?php    }?>
                                                                        </tr>
                                                                <?php }
                                                                 endforeach;?>
                                                            <?php endif; ?>
                                                 
                                                   </tbody>
                                                    </table>
                                                   </td>
                                <?php $total_other += $unpaid_student_other['total_fee'] ?> 
                                  <?php $total_other_security += $total_others_fee ?> 
                                
                                <?php if($other_fee_types === null){ ?>
                                
          <td class="vertical_align_middle text-center"><?php echo number_format($unpaid_student_other['total_fee'])  ?> </td>
                                <?php }
								else{ ?>
                 <td class="vertical_align_middle text-center"><?php echo number_format($total_others_fee)  ?> </td>
                               
                               
                                <?php } ?>
                                
                                        <td class="vertical_align_middle text-center"><?php echo  date('d-M-y',strtotime($unpaid_student_other['created_voucher']))   ?> </td>
   
           <td class="vertical_align_middle text-center"><?php echo  date( 'd-M-y',strtotime($unpaid_student_other['due_voucher']))  ?> </td>
                                            
                                                  <td class="vertical_align_middle text-center">
                          <?php $admind = $this->session->userdata( 'admin' );?>
                                                      <?php
                                                      $this->load->helper('menu_helper');
                                                      $permission = admin_permission($admind['id']); ?>

                          <?php                if ($permission->delete_fee == 1) {
                                                    ?>
                                                    
                    <input type="hidden" name="student_ids" value="<?= $unpaid_student_other['student_id'] ?>">
             <input type="hidden" class="student_redirect" name="redirect" value="<?= urlencode( current_url() ) ?>">             
      <button type="submit" class="btn btn-default btn-xs pull-right delete delete_voucher"
      data-toggle="tooltip" title="" value="<?= $unpaid_student_other['voucher_id'] ?>"  data-original-title="Delete" >
     <i class="fas fa-trash-alt"></i>
        </button>                  <?php 
													}
													   ?>                           
     <button type="submit" class="btn btn-default btn-xs pull-right"
      formaction="<?php echo base_url(); ?>fee_management/fee_voucher_process2?vrno=<?php echo $unpaid_student_other['voucher_id'] ?>&student_id="<?php echo $unpaid_student_other['student_id'] ?>" ">
     <i class="fa fa-newspaper-o" aria-hidden="true"> </i>
                                                       </button>
                                                       
                                                         <button type="submit" class="btn btn-default btn-xs pull-right"
      formaction="<?= site_url( 'fee_management/receive_fee/' . $unpaid_student_other['student_id'] )   ?>" data-toggle="tooltip" title="" data-original-title="Student Account"  >
        <i class="fa fa-money"></i>
        </button>       
                                                     
                                              </td>
                                              
                                                 <?php if(!empty($class_id)){ ?>       
                                                 <td class="text-right"><input type="checkbox" class="student_checkbox_<?= $unpaid_student_other['student']['class_id']. '_'  .$unpaid_student_other['student']['section_id']; ?> select_checkbox" name="voucher_ids[]" value="<?= $unpaid_student_other['voucher_id'] ?>"></td>
                                                    <?php }?>
                                                 
                                                  
                                        </tr>
                                        <?php } endforeach;
										
										 ?>
                                   
                                      
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                        <th colspan="9" class="text-right"></th>
                                        <th class="text-center">TOTAL</th>
                                        <?php if($other_fee_types === null){ ?>
                                        <th class="text-center vertical_align_middle "> <?= number_format($total_other) ?></th>
                                        <?php }else{ ?>
                                        <th class="text-center vertical_align_middle "> <?= number_format($total_other_security) ?></th>
                                        <?php } ?>
                                        
                                        <th class="text-center"> </th>
                                        <th class="text-center"> </th>
                                       
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                      
                            
                       
                    </div>
                </div>
            </div>
                               </form>
 
 
<?php }else{
	
	
	 ?>
            <div class="col-sm-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= date('M')?> Paid Voucher (Other Fee) </h3>
                    </div>

                    <div class="box-body no-padding">
                        <?php if ( !empty( $students_processed ) ): ?>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover " id="paid_other_fee">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Sr. No.</th>
                                            <th class="text-center">Vr. No.</th>
                                            
                                            <th class="text-center">Ad. No.</th>
                                            <th class="text-center">Class(Section)</th>
                                            <th class="text-center">Roll No.</th>
                                            <th class="text-left" style="width: 120px;" >Name</th>
                                            <th class="text-lefts" style="width: 120px;">Father's Name</th>
                                            <th class="text-center">Gender</th>
                                            <th class="text-center">Mobile</th>
                                           
                                            
                                            <th class="text-left">
                                                <?php
                                                if ( $other_fee_types === null ) {
                                                    echo "Other Fee Types"."<span class='pull-right'>Amount</span>";
                                                } else {
                                                    echo $other_fee_types."<span class='pull-right'>Amount</span>";
                                                }
                                                ?>
                                            </th>
                                            <th class="text-center">Total Fee</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                        
                                        
                                    </thead>

                                    <tbody>
                                        <?php
                                        $count = 0;
                                       foreach ( $students_processed as $student ): 
                                        $other  =0;
									   foreach ( $student['other_fee_records'] as $other_fee_record ){
									      $other  = $other_fee_record['total_paid_fee'] - $other_fee_record['tuition_fee']; 
                                          $voucher_id = $other_fee_record['voucher_id'];
                                        }
                                      
                                       if( $voucher_id != 1){ 
									        $otheramount = 0;
                                                $count++; ?>
                                        
                                            <tr>
                                                <td  class="vertical_align_middle text-center"><?= $count ?></td>
                                    
                                            <td  class="vertical_align_middle text-center"><?=  $voucher_id ?></td>
                                                <td  class="vertical_align_middle text-center"><?= $student['admission_no'] ?></td>
                                                <td  class="vertical_align_middle text-center"><?= "{$student['class']}({$student['section']})" ?></td>
                                                <td  class="vertical_align_middle text-center"><?= $student['roll_no'] ?></td>
                                                <td  class="vertical_align_middle text-left">
                                                    <a  href="<?= site_url( "student/view/{$student['id']}" ) ?>">
                                                        <?= $student['firstname'] . ' ' . $student['lastname'] ?>
                                                    </a>
                                                </td>
                                                <td  class="vertical_align_middle text-left">
											<a href="<?= site_url( "family/children_summary/" . $student['id'] ) ?>" <?= $student['struck_off']==1?'style="color:red;"':''?> >	
												<?= $student['father_name'] ?>
                                                </a>
                                                </td>
                                                <td  class="vertical_align_middle text-center"><?= $student['gender'] ?></td>
                                                <td  class="vertical_align_middle text-center"><?= $student['father_phone'] ?></td>
                                                <td class="" >
                                                  <table class="table table-bordered    " style="margin-top:20px;" >                                                      <tbody>
                                                            <?php if ( empty( $student['other_fee_records'] ) ): ?>
                                                                N/A
                                                            <?php else: ?>
                                            <?php
                                            $total_others_fee_paid = 0;
                                            foreach ( $student['other_fee_records'] as $other_fee_record ): 
								                      if ($other_fee_record['amount'] > 0) {  ?>
                                                        <tr>
                                                            <td><?= date( 'd-M-y', strtotime( $other_fee_record['payment_date'] ) ) ?></td>
                                                            <?php if ( $other_fee_types === null ): ?>
                                                            <td class="text-left"><?= $other_fee_record['fee_name'] ?></td>                                                         <?php endif; ?>
                                                            <td class="text-right"><?= number_format($other_fee_record['amount']) ?></td>
                                                                <!-- < ?php $other_paid_total += $other_fee_record['amount']; ?> -->
                                                                <?php $total_others_fee_paid += $other_fee_record['amount']; ?>
                                                        </tr>
                                                        <?php } 
                                                    endforeach; ?>
                                                                
                                                            <?php endif; ?>
                                                        </tbody>
                                                    </table>
                                                 </td>
                                                
                                          <!-- < ?php 
                                              $total_other_stu  = $other_fee_record['total_paid_fee'] - $other_fee_record['tuition_fee'];
                                              
                                              ?>     -->
                                        <!-- <td  class="vertical_align_middle text-center">< ?= number_format($total_other_stu); ?></td> -->
                                       
                                        <td  class="vertical_align_middle text-center"><?= number_format($total_others_fee_paid)  ?></td>
                                           <?php   $other_paid_total += $total_others_fee_paid;  ?> 
                                        
                                                <td  class="vertical_align_middle text-center">
                                                    <a href="<?= site_url( "fee_management/receive_fee/{$student['id']}" ) ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="" data-original-title="Collect Fee">
                                                        <i class="fa fa-money"></i>
                                                    </a>

                                                  
                                                </td>
                                            </tr>


                                        <?php
                                            }
                                        endforeach; 
                                        ?>
                                    </tbody>
                                       <tfoot>
                                        <tr>
                                         <th colspan="9"  class="text-right"></th>
                                                <th  class="text-left">Total</th>
                                               
                                                
                                                <th class="text-center"><?= number_format($other_paid_total) ?></th>
                                                <th>
                                                    
                                                </th>
                                                
                                            </tr>
                                    </tfoot>
                                </table>
                            </div>
                        <?php else: ?>
                            <p class="text-center bold text-danger">No records found for current search!</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
<?php } 

}else{
    if($search_type == 'pending'){ 
    ?>

<div class="col-sm-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"> UnPaid Voucher Class Wise (Other Fee) </h3>
                    </div>

                    <div class="box-body  ">
                        <?php if ( !empty( $class_sections ) ): ?>
                            <div class="table-responsive">
                            <table class="table table-bordered table-hover example">
                                <thead>
                                    <tr>
                                        <th  >Class/Fee Types</th>
                                        <?php foreach($fee_types1 as $type){?>
                                        <th class="text-right" ><?= $type['name']?></th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                 <tbody>
                                    <?php foreach ($class_sections as $key => $class_section): ?>
                                            <tr>
                                                <td class="mailbox-name">
                                                    <?= $key     ?>
                                                </td>
                                                <?php foreach($class_section as $type): ?>
                                                    <td class="mailbox-name text-right">
                                                <?php 
                                                
                                            
                                                if($type[0]){
                                                    $amount1 =  0;
                                                    foreach($type as $amount):
                                                    $amount1 +=  $amount['id'];
                                                    endforeach;
                                                        echo number_format($amount1);
                                                    }else{ 
                                                    echo     0; 
                                                    }
                                                    ?>
                                                </td>
                                                <?php  endforeach?>
                                            </tr>
                                        
                                    <?php  endforeach?>
                                </tbody>
                            </table>
                            </div>
                        <?php else: ?>
                            <p class="text-center bold text-danger">No records found for current search!</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php 
}else{ ?>



            <div class="col-sm-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">  Paid Voucher Class Wise (Other Fee) </h3>
                    </div>

                    <div class="box-body  ">
                        <?php if ( !empty( $class_sections ) ): ?>
                            <div class="table-responsive">
                            <table class="table table-bordered table-hover example">
                                <thead>
                                    <tr>
                                        <th  >Class/Fee Types</th>
                                        <?php foreach($fee_types1 as $type){?>
                                        <th class="text-right" ><?= $type['name']?></th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                 <tbody>
                                    <?php foreach ($class_sections as $key => $class_section): ?>
                                            <tr>
                                                <td class="mailbox-name">
                                                    <?= $key     ?>
                                                </td>
                                                <?php foreach($class_section as $type): ?>
                                                    <td class="mailbox-name text-right">
                                                <?= $type['id']; ?>
                                                </td>
                                                <?php  endforeach?>
                                            </tr>
                                        
                                    <?php  endforeach?>
                                </tbody>
                            </table>
                            </div>
                        <?php else: ?>
                            <p class="text-center bold text-danger">No records found for current search!</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php }
} ?>
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

 $(document).on('change', '.select_checkbox', function (e) {
        
	var target = $( this ).data( 'target' ),
                current_checked = $( this ).prop( 'checked' );

            if ( current_checked === true ) {
                $( target ).prop( 'checked', true ).change();
            } else {
                $( target ).prop( 'checked', false ).change();
            }
    });
</script>


<script type="text/javascript">




    $( document ).ready( function () {
        $( document ).on( 'click', '.delete_voucher', function ( e ) {
            var voucher = $(this).val();
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
                                        type: 'success',
                                        showConfirmButton: false,
                                        timer: 2000,
                                    });
                             $('.voucher_'+voucher).closest('tr').remove();
                      
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
    $( document ).ready( function () {
        $( document ).on( 'click', '.delete_voucher_all', function ( e ) {
            var voucher = [];
 		$('input[name="voucher_ids[]"]:checked').each(function() {
            voucher.push(this.value); 
		});
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
                            url: '<?php echo site_url("fee_management/delete_unpaid_ajax_all") ?>',
                            type: 'post',
                            dtatatype: 'json',
                            data: {
                                vrno: voucher,
                            },
                            dataType: 'json',
                            success: function (response) {

                                console.log(response);

                                if (response.status == "success") {
                                    sweetAlert({
                                        title: response.message,
                                        type: 'success',
                                        showConfirmButton: false,
                                        timer: 2000,
                                    });
                           
                                    $(voucher).each(function(i,item) {
                                        $('.voucher_'+item).closest('tr').remove(); 
                                    });
                                 
                      
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
//  $(document).ready(function() {
//      $("#search_type").change(function() {
//          if ($(this).val() != 'paid')
//              $("#other_fee_types").attr("disabled", "disabled");
//			
//		 else
//              $("#other_fee_types").removeAttr("disabled");
//			 
//			 
//      });
//  });
//  
//  $(document).ready(function() {
//      $("#search_type").change(function() {
//          if ($(this).val() != 'paid')
//     		  $("#date_to").attr("disabled", "disabled");
//	      else
//			    $("#date_to").removeAttr("disabled");
//      });
//  });
//  
//  
//   $(document).ready(function() {
//      $("#search_type").change(function() {
//          if ($(this).val() != 'paid')
//     		  $("#date_from").attr("disabled", "disabled");
//	      else
//			    $("#date_from").removeAttr("disabled");
//      });
//  });
  

</script>



