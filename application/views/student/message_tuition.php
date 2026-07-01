<style type="text/css">
    @media print {
        .no-print, .no-print * {
            display: none !important;
        }
    }
</style>


<div class="content-wrapper" style="min-height: 946px;">

<?php  $this->load->view('layout/message_link'); ?>

    <section class="content-header">
        
         <div class="box box-primary" >  
            <div class="box-header with-border" style="">
                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <h4><?= $title ?></h4>
                    </div>
                    <div class="col-sm-6 col-sm-offset-1 col-md-7 ">
                    <form role="form" action="<?php echo site_url( 'student/send_message_tuition' ) ?>" method="get" class="form-horizontal">
                        <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6 col-md-3">
                                <label><?php echo $this->lang->line( 'class' ); ?></label>
                                <select id="class_id" name="class_id" class="form-control">
                                    <option value=""><?php echo $this->lang->line( 'select' ); ?></option>
                                    <?php
                                    foreach ( $classlist as $class ) { ?>
                                        <option value="<?php echo $class['id'] ?>" <?php if ( set_value( 'class_id' ) == $class['id'] ) echo "selected=selected" ?>><?php echo $class['class'] ?></option>
                                        <?php
                                        $count++;
                                    } ?>
                                </select>
                                <span class="text-danger"><?php echo form_error( 'class_id' ); ?></span>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <label><?php echo $this->lang->line( 'section' ); ?></label>
                                <select id="section_id" name="section_id" class="form-control">
                                    <option value=""><?php echo $this->lang->line( 'select' ); ?></option>
                                </select>
                                <span class="text-danger"><?php echo form_error( 'section_id' ); ?></span>
                            </div>
                            
                            <div class="col-sm-6 col-md-3">
                                <label>Month Wise</label>
                                <select class="form-control" id="month" name="month">
                                <?php   $month_check = $month == null ? $current_date->format( "F" ) : date('F', mktime(0, 0, 0, $month, 10));  ?>
                                    <?php for ( $i = 0; $i < count( $month_names1 ); $i++ ):   ?>
                                        <option class="other_fee2"   value="<?= $i + 1 ?>" <?= set_select( 'month', ( $i + 1 ), ( $month_check  == $month_names1[$i] ) ) ?>>
                                            <?= $month_names1[$i] ?>
                                        </option>
                                    <?php  endfor; ?>
                                </select>
                            </div>
                            <div class="col-sm-6 col-md-3" >
                                <label style="width: 100%;">&nbsp;</label>
                                <button type="submit" name="search" value="search_filter" class="btn btn-primary btn-sm ">
                                    <i class="fa fa-search"></i> <?php echo $this->lang->line( 'search' ); ?>
                                </button>
                            </div>
                            </div>
                       </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    
    <div class="col-sm-12">
                            <form action="" method="post" >
                            <div class="box box-primary">
                            <div class="box-header with-border">
                            <h3 class="box-title"><?= date('M'); ?> Unpaid Vouchers (Monthly Fee)</h3>
                                    <?php if( !empty($class_id) ){?>
                           <div class="form-group pull-right" style="margin:5px;">
                                    <button type="submit" class="btn btn-default btn-sm pull-right" formaction="<?php echo base_url(); ?>fee_management/fee_voucher_process_all?vrno=&student_id="<?php echo $unpaid_student['student_id'] ?>""><i class="fa fa-print "></i></button>
                                </div>
                            <?php }?>

                               <div class="checkbox pull-right">
                                   <button type="submit" class="btn btn-primary btn-sm pull-right" formaction="<?= site_url( 'student/send_sms_to_student_with_due_fee' ) . '?redirect=' . urlencode( $redirect_url ) ?>">Send Message</button>
                                </div>

                                <div class="box-body">
                            <table class="table     table-bordered table-hover  " id="message_tuition" cellspacing="0" width="100%">
                                <thead>
                                        <tr>
                                            <th class="text-center">Sr No</th>
                                            <th class="text-center">Vr No</th>
                                           
                                            <th class="text-center">Ad No</th>
                                            <th class="text-center">Class (Section)</th> 
                                            <th class="text-center">Roll No</th> 
                                            <th class="text-left">Student Name</th> 
                                            <th class="text-left">Father Name</th> 
                                            <th class="text-center">Father Phone</th>
                                            <th>Class Fee </th>
                                            <th>Advance Fee</th>
                                            <th class="text-center"><?= date('M', now())?> Fee</th> 
                                            
                                            <th class="text-center">Arrears</th>
                                            <th class="text-center">Total Fee.</th> 
                                            
                                            <th class="text-center">Issue Date</th>
                                            <th class="text-center">Due Date</th>
                                            
                                            <th class="text-right"> <input type="checkbox" class="select_checkbox_unpaid class_section_checkbox_all" data-target=".class_section_checkbox_teacher"> </th>
                                           
                                        </tr>
                                    </thead>
                                <tbody>
                              <?php $count = 0; ?>
                              <?php
                              $total_class = 0;
                              $total_advance_fee = 0;
                              $total_monthly_fee = 0;
                              $total_fee_description = 0;
                              $total_arrears = 0;
                              $total_fee_due = 0;
                              ?>
                              <?php foreach ( $unpaid_students as $unpaid_student ): ?>
                             
                              <?php $count++; ?>
                                          <?php   $date = $unpaid_student['created_voucher'] ?>
                                                    <tr>
                                        <?php     $date2  =   $unpaid_student['admission_date'];?>      
                                                 <td class="text-center"><?php echo $count  ?></td>
                                                 <td class="text-center"><?php echo $unpaid_student['voucher_id']  ?></td>
                                                 <td class="text-center"><?php echo $unpaid_student['admission_no']  ?></td>                                             <td align="center"><?php echo $unpaid_student['class'].'/'.$unpaid_student['section']  ?></td>
                                                   <td class="text-center"><?php echo $unpaid_student['roll_no'] ?></td>
                                                       
                                                    <td align="left">
													<a href="<?php echo base_url(); ?>student/view/<?php echo $unpaid_student['student_id']; ?>" <?= ( $unpaid_student['struck_off'] ?? null )==1?'style="color:red;"':''?> >
													<?php echo $unpaid_student['firstname'].$unpaid_student['lastname']  ?>
                                                    </a></td> 
                                                    <td align="left">
                                               <a href="<?= site_url( "family/children/" . $unpaid_student['id'] ) ?>" <?= ( $unpaid_student['struck_off'] ?? null )==1?'style="color:red;"':''?> >
                                                <?php echo $unpaid_student['father_name']  ?></a>  
                                              </td>
                                              <td class="text-center"><?= $unpaid_student['father_phone']  ?></td>
                                               
                                              <td class="text-center">
											  <?php  $class_fee = $unpaid_student['fee'] - $unpaid_student['discount'];
											         $total_class += $class_fee; ?>
                                              
											  <?= number_format($class_fee) ?></td>
                                              <td class="text-center">
                                                        
											    <?php 
												 $advance_fee =0;
												 $monthly_fee=0;
												 foreach( $unpaid_student['voucher_fee_types'] as $other_fee ){ ?>
                                               <?php $discount_fee =  $unpaid_student['fee'] - $unpaid_student['discount'];
											   
											   
                                    if( $other_fee['amount'] > $discount_fee){
                                     $advance_fee     =   $other_fee['amount'] - $discount_fee;
                                     $monthly_fee = $discount_fee;
                                    }elseif($other_fee['amount'] <= $discount_fee   ){
                                        if( $other_fee['amount'] > 0 ){
                                            $advance_fee     =0;
                                            $monthly_fee = $other_fee['amount'];
                                        }
                                    }
                                    $total_advance_fee += $advance_fee;
                                    $total_monthly_fee += $monthly_fee;	?>
                                                
                                                <?= number_format( $advance_fee) ?>
                                                
                                                <?php  $total = $other_fee['amount']; ?>
                                                <?php  $total_fee_description += $other_fee['amount']; ?>
                                                <?php }?>
                                                    </td>
                                              <td class="text-center">
                                              <?= number_format($monthly_fee);?>
                                              </td>
                                 <td align="center"><?php echo number_format($unpaid_student['voucher_arrears'])  ?> </td>
                                                 <?php $total_arrears +=$unpaid_student['voucher_arrears'] ?>   
                                                 <?php $total_fee = $unpaid_student['voucher_arrears'] + $total  ?>
                                                 <?php $total_fee_due += $total_fee ?>   
                                                 <td align="center"> <?php echo  number_format($total_fee) ?></td>
                                                 <td align="center"><?php echo  date('d-M-y',strtotime($date))   ?> </td>
                                                    
                                <td align="center"><?php echo  date( 'd-M-y',strtotime($unpaid_student['due_voucher']))  ?> </td>
                                                        
                                                            <td align="center">
                                    <input type="hidden" name="student_ids[]" value="<?= $unpaid_student['student_id'] ?>">                           <?php
                                    
                                    $admind = $this->session->userdata( 'admin' );?> 
                                    
                                                <input type="checkbox" class="class_section_checkbox_teacher select_checkbox_unpaid"  name="unpaid_voucher_ids[]" value="<?= $unpaid_student['voucher_id'] ?>" >              
                                                            </td>
                                                  
                                                  
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>

                                <tfoot style="display: table-footer-group;">
                                    <tr>
                                           <th colspan="7" class="text-right"></th>
                                           <th  class="text-center">TOTAL</th>
                                           <th class="text-center"> <?= number_format($total_class) ?></th>
                                           <th class="text-center"> <?= number_format($total_advance_fee) ?></th>
                                           <th class="text-center"> <?= number_format($total_monthly_fee) ?></th>
                                           <th class="text-center"> <?= number_format($total_arrears) ?></th>        
                                           <th class="text-center"><?= number_format($total_fee_due) ?> </th>
                                           <th class="text-center"> </th>
                                           <th class="text-center"> </th>
                                           <th class="text-center"> </th>
                                    </tr>
                                 </tfoot>
                                </table>
                            </form>
                        </div>
                    </div>
   
</div>
</div>

<script type="text/javascript">

    $(document).ready(function () {
        


        $('#date').datepicker({
            format: "dd-mm-yyyy",
            autoclose: true
        });
        $("#btnreset").click(function () {           
            $("#form1")[0].reset();
        });

    

    });

</script>
<script>
    $(document).ready(function () {
           
        $('.detail_popover').popover({
			placement: 'right',
            trigger: 'hover',
            container: 'body',
            html: true,
            content: function () {
                return $(this).closest('td').find('.fee_detail_popover').html();
            }
        });

    });
	
	
	 
    jQuery( function ( $ ) {
        $( ".select_checkbox_unpaid" ).on( 'change', function ( e ) {
            var target = $( this ).data( 'target' ),
                current_checked = $( this ).prop( 'checked' );

            if ( current_checked === true ) {
                $( target ).prop( 'checked', true ).change();
            } else {
                $( target ).prop( 'checked', false ).change();
            }
        } );
	} );
	

</script>

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
    $( document ).ready( function () {
        var date_format = '<?php echo $result = strtr( $this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',] ) ?>';
        $( '#dob, #admission_date' ).datepicker( {
            format: date_format,
            autoclose: true
        } );
        $( "#btnreset" ).click( function () {
            $( "#form1" )[0].reset();
        } );
    } );
</script>

<script type="text/javascript">
  
    jQuery( function ( $ ) {
        $( ".select_checkbox" ).on( 'change', function ( e ) {
            var target = $( this ).data( 'target' ),
                current_checked = $( this ).prop( 'checked' );

            if ( current_checked === true ) {
                $( target ).prop( 'checked', true ).change();
            } else {
                $( target ).prop( 'checked', false ).change();
            }
        } );
		

  } );

  
</script>




