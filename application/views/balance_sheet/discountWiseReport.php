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
    <!-- <section class="content-header">
        <h1 class="pull-left">
            <i class="fa fa-user-plus"></i> <?php echo $this->lang->line( 'student_information' ); ?>
            <small><?php echo $this->lang->line( 'student1' ); ?></small>
        </h1>

        <div class="pull-right">
            <a href="< ?= site_url( 'student/send_sms_to_student_with_due_fee' ) . '?redirect=' . urlencode( $redirect_url ) ?>" class="btn btn-primary btn-sm">Send SMS to students with due fee</a>
            <a href="< ?= site_url( 'student/send_sms_to_student_with_fee_arrears' ) . '?redirect=' . urlencode( $redirect_url ) ?>" class="btn btn-primary btn-sm">Send sms to students with fee arrears</a>
        </div>

        <div class="clearfix"></div>
    </section> -->
    <!-- Main content -->
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3>Discount Wise Class Report </h3>
            </div>
            <div class="box-body">
            <?php $basket = array();
            foreach ( $resultlist as $key => $student ) {
                $basket[$student['discount']][$key] = $student;
            }
            foreach($basket as $key => $discount ){

                $student           = 0;
                $total_fee         = 0;
                $discount1         = 0;
                $discount_fee      = 0;
                $paid_arrears      = 0;
                $paid_due          = 0;
                $paid_advance      = 0;
                $fee_arrears_month = 0;
                $fee_advance_month = 0;
                $current_fee       = 0;
                $total_due_fee     = 0; 
                $total_fine        = 0;
                $due_fee_struck    = 0;  
                $adjusted    = 0;  

                foreach($discount as $key1 => $sum ){
                $student++;
             
                $paid_arrears   += $sum['paid_arrears'];
                $paid_due       += $sum['paid_due'];
                $paid_advance   += $sum['paid_advance'];
                $adjusted   += $sum['adjusted'];


                $discount_fee3 = $sum['class_fee'] - $sum['discount'];
                if ($sum['fee_arrears'] > 0) {

                    // calculate current student arrears
                    $fee_arrears = $sum['fee_arrears'] - $discount_fee3 - $sum['late_payment_fee'];
                    
                    // calculate current student fine
                    $late_payment_fee = $sum['late_payment_fee'];

                    $current_fee = $sum['fee_arrears'] - $late_payment_fee;
                    if ($current_fee > $discount_fee3) {
                        $due_fee     = $discount_fee3; 
                    }else{
                        $due_fee     = $current_fee; 
                    }
                    if($fee_arrears < 0){
                        $fee_arrears = 0;
                    }
                }
                if ($sum['fee_arrears'] < 0) {
                    $fee_advance_month += abs($sum['fee_arrears']);
                }
                if($sum['struck_off']==1){

                    $due_fee_struck += $due_fee;
                    
                }else{
                    $total_fee      += $sum['class_fee'];
                
                    $discount1      += $sum['discount'];
    
                    $discount_fee   += $sum['class_fee'] - $sum['discount'];
    
                    // calculate total month fine
                    $total_fine         += $late_payment_fee;
                    // calculate total month arrears
                    $fee_arrears_month  += $fee_arrears;
                    // calculate current student fine
                    
                    $total_due_fee      += $due_fee;

                }

              
                
                }

                ?>
                <div class="box box-primary" >
                    <div class="box-header with-border">
                        <h4 class="pull-left"> Student Discount  <?= $key ?> </h4>
                    </div>
                    <div class="clearfix"></div>
                    <div class="box-body">
                        <table class="table table-bordered"  style="color:#666666;"> 
                            <thead>
                                <tr>
                                <th>Discount <?= $key ?></th>
                                <th>Active</th>
                                <th>Total Fee</th>
                                <th>Discount</th>
                                <th>Disc Fee</th>
                                <th><?= date('M')?> Adv Adj</th>
                                <th><?= date('M')?> Total Due</th>
                                <th><?= date('M')?> Due Paid</th>
                                <th>Fee Waive</th>
                                <th>Fee Withdraw</th>
                                <th><?= date('M')?> Due</th>
                                <th>Fine</th>
                                <th>Arrears</th>
                                <th>Advance</th>
                                <th>Others Paid</th>
                                <th>Grand Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <td></td>
                                <td><?= $student ?></td>
                                <td><?= $total_fee ?></td>
                                <td><?= $discount1 ?></td>
                                <td><?= $discount_fee ?></td>
                                <td><?= $adjusted ?></td>
                                <?php  
                                $total_due1  =  $discount_fee  -$adjusted;
                                ?>
                                <td><?=  $total_due1  ?></td>
                                <td><?= $paid_due ?></td>
                                <td><?= 0  ?></td>
                                <td><?= $due_fee_struck  ?></td>
                                <?php 
                                $due_feemonth = $total_due1  - $paid_due -$due_fee_struck;
                                
                                ?>
                                <td><?= $due_feemonth  ?></td  >
                                <td><?= $total_fine ?></td>
                                <td><?= $fee_arrears_month ?></td>
                                <td><?= $fee_advance_month ?></td>
                                <td><?= 0 ?></td>
                                <td><?= 0?></td>
                            </tbody>
                        </table> 
                    </div>
                </div> 
                <?php   }     ?>
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