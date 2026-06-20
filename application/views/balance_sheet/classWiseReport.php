<style type="text/css">
    
    .error
    {
        color:red;
        font-family:verdana, Helvetica;
    }
    .tooltip{
    }
    .caret {
        border-left: 6px solid transparent;
        border-right: 6px solid transparent;
        border-top: 6px solid #7C7B7B;
    }
    .width_for_balance_sheet_table {
        width: 90px;
    }

</style>


<?php $admind = $this->session->userdata( 'admin' );
$this->load->helper('menu_helper');

$permission = admin_permission($admind['id']);
?>
<div class="content-wrapper"  style="background-color:#f5f5f5 !important">
  
<section class="content-header">


<div class="box box-primary" style="margin-bottom: 0px;">
    <div class="box-header with-border" style="padding: 20px;">
        <div class="row">
            <div class="col-sm-4">
                <h4 class="pull-left">Group Wise Classes Balance Sheet</h4>
            </div>

           
            <div class="clearfix"></div>
        </div>
    </div>
</div>



</section>
    <!-- Main content balance sheet -->

    <?php if ( $class_sections === false ): ?>
                                <h3 class="text-danger text-center">No data found!</h3>
                            <?php else: ?>
                                        <?php
                                        $active1    =   0; 
                                        $active2    =   0; 
                                        $active3    =   0; 
                                        $active4    =   0; 
                                        $total_fee1 =   0;
                                        $total_fee2 =   0;
                                        $total_fee3 =   0;
                                        $total_fee4 =   0;
                                        $discount1 =    0;
                                        $discount2 =    0;
                                        $discount3 =    0;
                                        $discount4 =    0;
                                        $discount_fee1 = 0;
                                        $discount_fee2 = 0;
                                        $discount_fee3 = 0;
                                        $discount_fee4 = 0;
                                        $adjusted1     = 0;
                                        $adjusted2     = 0;
                                        $adjusted3     = 0;
                                        $adjusted4     = 0;
                                        $total_due1  = 0;
                                        $total_due2  = 0;
                                        $total_due3  = 0;
                                        $total_due4  = 0;
                                        
                                        $total_paid1 = 0;
                                        $total_paid2 = 0;
                                        $total_paid3 = 0;
                                        $total_paid4 = 0;
                                        
                                        $total_waive1 = 0;
                                        $total_waive2 = 0;
                                        $total_waive3 = 0;
                                        $total_waive4 = 0;
                                        
                                        $total_withdraw1 = 0;
                                        $total_withdraw2 = 0;
                                        $total_withdraw3 = 0;
                                        $total_withdraw4 = 0;
                                        
                                        $due_fee1 = 0;
                                        $due_fee2 = 0;
                                        $due_fee3 = 0;
                                        $due_fee4 = 0;
                                        
                                        $advance1 = 0;
                                        $advance2 = 0;
                                        $advance3 = 0;
                                        $advance4 = 0;

                                        $other_fee1 = 0;
                                        $other_fee2 = 0;
                                        $other_fee3 = 0;
                                        $other_fee4 = 0;
                                        
                                        $grand_total1 =0;
                                        $grand_total2 =0;
                                        $grand_total3 =0;
                                        $grand_total4 =0;

                                        $fine1  =0;
                                        $fine2  =0;
                                        $fine3  =0;
                                        $fine4  =0;

                                        $arraers1 = 0;
                                        $arraers2 = 0;
                                        $arraers3 = 0;
                                        $arraers4 = 0;
                                       
                                        $numItems = count($class_sections);
                                        $i = 0;
                                        

                                        foreach ( $class_sections as $key=> $class_section ):
                                        if(++$i === $numItems) {
                                            $class4_to  = $class_section['class']['class'];
                                        }
                                        if($key <= 4  ){ 
                                            if($key == 0  ){ 
                                                $class1  = $class_section['class']['class'];
                                            }
                                            if($key == 4  ){ 
                                                $class1_to  = $class_section['class']['class'];
                                            }
                                            $active1            += $class_section['class_section_monthly_log'][0]['total_students'];
                                            $total_fee1         += $class_section['class_section_monthly_log'][0]['receiveable_total_fee'] + $class_section['class_section_monthly_log'][0]['discount'];
                                            $discount1          += $class_section['class_section_monthly_log'][0]['discount'];
                                            $discount_fee1      += $class_section['class_section_monthly_log'][0]['receiveable_total_fee'];
                                            $adjusted1          += $class_section['class_section_monthly_log'][0]['advance_adjusted_fee'];
                                            $total_due1         += $class_section['class_section_monthly_log'][0]['receiveable_total_fee'] - $class_section['class_section_monthly_log'][0]['advance_adjusted_fee'];
                                            $total_paid1        += $class_section['class_section_monthly_log'][0]['total_paid_fee1'];
                                            $total_waive1       += $class_section['class_section_monthly_log'][0]['total_waive_fee'];
                                            $total_withdraw1    += $class_section['class_section_monthly_log'][0]['student_withdrawl'];
                                            $due_fee1           +=$class_section['class_section_monthly_log'][0]['total_due_fee'];
                                            $advance1           += $class_section['total_advance1'];
                                            $other_fee1         +=  $class_section['class_section_monthly_log'][0]['total_other_fee'];
                                            $grand_total1       += $class_section['class_section_monthly_log'][0]['total_advance1'] + $class_section['class_section_monthly_log'][0]['total_paid_fee1'] + $class_section['class_section_monthly_log'][0]['total_other_fee'] + $class_section['class_section_monthly_log'][0]['total_paid_arrears1'];
                                            $class_fine_var = 0;
                                            foreach ($total_class_students as $tfkey => $tf) {
                                                if (intval($class_section['class_id']) == intval($tf['class_id']) && intval($class_section['section_id']) == intval($tf['section_id'] )) {
                                                    $class_fine_var = $tf['class_fine'];
                                                }
                                            }
                                            $fine1              +=  $class_fine_var;
                                            $arraers1           +=  $class_section['class_section_monthly_log'][0]['class_section_fee_arrears'] - $class_section['class_section_monthly_log'][0]['total_due_fee'] - $class_fine_var;
                                              
                                        }elseif($key <= 9 && $key > 4  ){  
                                            if($key == 5  ){ 
                                                $class2  = $class_section['class']['class'];
                                            }
                                            if($key == 9  ){ 
                                                $class2_to  = $class_section['class']['class'];
                                            }
                                            $active2        += $class_section['class_section_monthly_log'][0]['total_students'];
                                            $total_fee2     += $class_section['class_section_monthly_log'][0]['receiveable_total_fee'] + $class_section['class_section_monthly_log'][0]['discount'];
                                            $discount2      += $class_section['class_section_monthly_log'][0]['discount'];
                                            $discount_fee2  += $class_section['class_section_monthly_log'][0]['receiveable_total_fee'];
                                            $adjusted2      += $class_section['class_section_monthly_log'][0]['advance_adjusted_fee'];
                                            $total_due2     += $class_section['class_section_monthly_log'][0]['receiveable_total_fee'] - $class_section['class_section_monthly_log'][0]['advance_adjusted_fee'];
                                            $total_paid2    += $class_section['class_section_monthly_log'][0]['total_paid_fee1'];
                                            $total_waive2   += $class_section['class_section_monthly_log'][0]['total_waive_fee'];
                                            $total_withdraw2   += $class_section['class_section_monthly_log'][0]['student_withdrawl'];
                                            $due_fee2       +=$class_section['class_section_monthly_log'][0]['total_due_fee'];
                                            $advance2        += $class_section['total_advance1'];
                                            $other_fee2      +=  $class_section['class_section_monthly_log'][0]['total_other_fee'];
                                            $grand_total2  += $class_section['class_section_monthly_log'][0]['total_advance1'] + $class_section['class_section_monthly_log'][0]['total_paid_fee1'] + $class_section['class_section_monthly_log'][0]['total_other_fee'] + $class_section['class_section_monthly_log'][0]['total_paid_arrears1'];

                                            $class_fine_var = 0;
                                            foreach ($total_class_students as $tfkey => $tf) {
                                                if (intval($class_section['class_id']) == intval($tf['class_id']) && intval($class_section['section_id']) == intval($tf['section_id'] )) {
                                                    $class_fine_var = $tf['class_fine'];
                                                }
                                            }
                                             $fine2 +=  $class_fine_var;
                                             $arraers2 +=  $class_section['class_section_monthly_log'][0]['class_section_fee_arrears'] - $class_section['class_section_monthly_log'][0]['total_due_fee'] - $class_fine_var;
                                            
                                        }elseif( $key <= 14 && $key > 9){
                                            if($key == 10  ){ 
                                                $class3  = $class_section['class']['class'];
                                            }
                                            if($key == 14  ){ 
                                                $class3_to  = $class_section['class']['class'];
                                            } 
                                            $active3  += $class_section['class_section_monthly_log'][0]['total_students'];
                                            $total_fee3 += $class_section['class_section_monthly_log'][0]['receiveable_total_fee'] + $class_section['class_section_monthly_log'][0]['discount'];
                                            $discount3 += $class_section['class_section_monthly_log'][0]['discount'];
                                            $discount_fee3  += $class_section['class_section_monthly_log'][0]['receiveable_total_fee'];
                                            $adjusted3      += $class_section['class_section_monthly_log'][0]['advance_adjusted_fee'];
                                            $total_due3     += $class_section['class_section_monthly_log'][0]['receiveable_total_fee'] - $class_section['class_section_monthly_log'][0]['advance_adjusted_fee'];
                                            $total_paid3    += $class_section['class_section_monthly_log'][0]['total_paid_fee1'];
                                            $total_waive3   += $class_section['class_section_monthly_log'][0]['total_waive_fee'];
                                            $total_withdraw3   += $class_section['class_section_monthly_log'][0]['student_withdrawl'];
                                            $due_fee3       +=$class_section['class_section_monthly_log'][0]['total_due_fee'];
                                            $advance3        += $class_section['total_advance1'];
                                            $other_fee3     +=  $class_section['class_section_monthly_log'][0]['total_other_fee'];
                                            $grand_total3  += $class_section['class_section_monthly_log'][0]['total_advance1'] + $class_section['class_section_monthly_log'][0]['total_paid_fee1'] + $class_section['class_section_monthly_log'][0]['total_other_fee'] + $class_section['class_section_monthly_log'][0]['total_paid_arrears1'];
                                            $class_fine_var = 0;
                                            foreach ($total_class_students as $tfkey => $tf) {
                                                if (intval($class_section['class_id']) == intval($tf['class_id']) && intval($class_section['section_id']) == intval($tf['section_id'] )) {
                                                    $class_fine_var = $tf['class_fine'];
                                                }
                                            }
                                             $fine3 +=  $class_fine_var;
                                             $arraers3 +=  $class_section['class_section_monthly_log'][0]['class_section_fee_arrears'] - $class_section['class_section_monthly_log'][0]['total_due_fee'] - $class_fine_var;
                                            
                                        }else{ 
                                            if($key == 15  ){ 
                                                $class4  = $class_section['class']['class'];
                                            }
                                            $active4            += $class_section['class_section_monthly_log'][0]['total_students'];
                                            $total_fee4         += $class_section['class_section_monthly_log'][0]['receiveable_total_fee'] + $class_section['class_section_monthly_log'][0]['discount'];
                                            $discount4          += $class_section['class_section_monthly_log'][0]['discount'];
                                            $discount_fee4      += $class_section['class_section_monthly_log'][0]['receiveable_total_fee'];
                                            $adjusted4          += $class_section['class_section_monthly_log'][0]['advance_adjusted_fee'];
                                            $total_due4         += $class_section['class_section_monthly_log'][0]['receiveable_total_fee'] - $class_section['class_section_monthly_log'][0]['advance_adjusted_fee'];
                                            $total_paid4        += $class_section['class_section_monthly_log'][0]['total_paid_fee1'];
                                            $total_waive4       += $class_section['class_section_monthly_log'][0]['total_waive_fee'];
                                            $total_withdraw4    += $class_section['class_section_monthly_log'][0]['student_withdrawl'];
                                            $due_fee4           += $class_section['class_section_monthly_log'][0]['total_due_fee'];
                                            $advance4           += $class_section['total_advance1'];
                                            $other_fee4         +=  $class_section['class_section_monthly_log'][0]['total_other_fee'];
                                            $grand_total4       += $class_section['class_section_monthly_log'][0]['total_advance1'] + $class_section['class_section_monthly_log'][0]['total_paid_fee1'] + $class_section['class_section_monthly_log'][0]['total_other_fee'] + $class_section['class_section_monthly_log'][0]['total_paid_arrears1'];
                                            $class_fine_var = 0;
                                            foreach ($total_class_students as $tfkey => $tf) {
                                                if (intval($class_section['class_id']) == intval($tf['class_id']) && intval($class_section['section_id']) == intval($tf['section_id'] )) {
                                                    $class_fine_var = $tf['class_fine'];
                                                }
                                            }
                                             $fine4 +=  $class_fine_var;
                                             $arraers4 +=  $class_section['class_section_monthly_log'][0]['class_section_fee_arrears'] - $class_section['class_section_monthly_log'][0]['total_due_fee'] - $class_fine_var;
                                            
                                     
                                            }  
                                 endforeach; ?>
                                      
                     
                     
                            <?php endif; ?>
    <section class="content" style="padding-bottom:0px;     min-height: 190px;" >
    <div class="box box-primary" style="margin-bottom: 0px;">
    <div class="box-header with-border" style="padding: 20px;">
        <div class="row">
            <div class="col-sm-4">
                <h4 class="pull-left"><?= $class1 ?> to <?= $class1_to?></h4>
            </div>
            <div class="col-sm-8"></div>
            <div class="clearfix"></div>
            <table class="table table-bordered"  style="color:#666666;"> 
                <thead>
                    <tr>
                    <th>Early Year 1(Play) to prep</th>
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
                    <th>Others Due Fee</th>
                    <th>Others Paid</th>
                    <th>Grand Total</th>
                    </tr>
                </thead>
                <tbody>
                    <td></td>
                    <td><?= $active1 ?></td>
                    <td><?= $total_fee1 ?></td>
                    <td><?= $discount1 ?></td>
                    <td><?= $discount_fee1 ?></td>
                    <td><?= $adjusted1 ?></td>
                    <td><?= $total_due1 ?></td>
                    <td><?= $total_paid1 ?></td>
                    <td><?= $total_waive1  ?></td>
                    <td><?= $total_withdraw1 ?></td>
                    <td><?= $due_fee1  ?></td  >
                    <td><?= $fine1 ?></td>
                    <td><?= $arraers1 ?></td>
                    <td><?= $advance1 ?></td>
                    <td></td>
                    <td><?= $other_fee1 ?></td>
                    <td><?= $grand_total1?></td>
                </tbody>
            </table> 
        </div>
    </div>
</div>
    </section>
    
    <section class="content" style="padding-bottom:0px;     min-height: 190px;" >
    <div class="box box-primary" style="margin-bottom: 0px;">
    <div class="box-header with-border" style="padding: 20px;">
        <div class="row">
            <div class="col-sm-4">
                <h4 class="pull-left"><?= $class2 ?> to <?= $class2_to?></h4>
            </div>
            <div class="col-sm-8"></div>
            <div class="clearfix"></div>
            <table class="table table-bordered"  style="color:#666666;"> 
                <thead>
                    <tr>
                    <th>Early Year 1(Play) to prep</th>
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
                    <th>Others Due Fee</th>
                    <th>Others Paid</th>
                    <th>Grand Total</th>
                    </tr>
                </thead>
                <tbody>
                <td></td>
                    <td><?= $active2 ?></td>
                    <td><?= $total_fee2 ?></td>
                    <td><?= $discount2 ?></td>
                    <td><?= $discount_fee2 ?></td>
                    <td><?= $adjusted2 ?></td>
                    <td><?= $total_due2 ?></td>
                    <td><?= $total_paid2 ?></td>
                    <td><?= $total_waive2  ?></td>
                    <td><?= $total_withdraw2 ?></td>
                    <td><?=  $due_fee2  ?></td>
                    <td><?= $fine2?></td>
                    <td><?= $arraers2?></td>
                    <td><?= $advance2 ?></td>
                    <td></td>
                    <td><?= $other_fee2 ?></td>
                    <td><?= $grand_total2?></td>
                </tbody>
            </table> 
        </div>
    </div>
</div>

    </section>

    <section class="content" style="padding-bottom:0px;     min-height: 190px;" >
    <div class="box box-primary" style="margin-bottom: 0px;">
    <div class="box-header with-border" style="padding: 20px;">
        <div class="row">
            <div class="col-sm-4">
                <h4 class="pull-left"><?= $class3 ?> to <?= $class3_to?></h4>
            </div>
            <div class="col-sm-8"></div>
            <div class="clearfix"></div>
            <table class="table table-bordered"  style="color:#666666;"> 
                <thead>
                    <tr>
                    <th>Early Year 1(Play) to prep</th>
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
                    <th>Others Due Fee</th>
                    <th>Others Paid</th>
                    <th>Grand Total</th>
                    </tr>
                </thead>
                <tbody>
                <td></td>
                    <td><?= $active3 ?></td>
                    <td><?= $total_fee3 ?></td>
                    <td><?= $discount3 ?></td>
                    <td><?= $discount_fee3 ?></td>
                    <td><?= $adjusted3 ?></td>
                    <td><?= $total_due3 ?></td>
                    <td><?= $total_paid3 ?></td>
                    <td><?= $total_waive3  ?></td>
                    <td><?= $total_withdraw3 ?></td>
                    <td><?=  $due_fee3  ?></td>
                    <td><?= $fine3 ?></td>
                    <td><?= $arraers3 ?></td>
                    <td><?= $advance3 ?></td>
                    <td></td>
                    <td><?= $other_fee3 ?></td>
                    <td><?= $grand_total3?></td>
                </tbody>
            </table> 
        </div>
    </div>
</div>
    </section>

    <section class="content" style="padding-bottom:0px;     min-height: 190px;" >
    <div class="box box-primary" style="margin-bottom: 0px;">
    <div class="box-header with-border" style="padding: 20px;">
        <div class="row">
            <div class="col-sm-4">
            <h4 class="pull-left"><?= $class4 ?> to <?= $class4_to?></h4>
            </div>
            <div class="col-sm-8"></div>
            <div class="clearfix"></div>
            <table class="table table-bordered"  style="color:#666666;"> 
                <thead>
                    <tr>
                    <th>Early Year 1(Play) to prep</th>
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
                    <th>Others Due Fee</th>
                    <th>Others Paid</th>
                    <th>Grand Total</th>
                    </tr>
                </thead>
                <tbody>
                <td></td>
                    <td><?= $active4 ?></td>
                    <td><?= $total_fee4 ?></td>
                    <td><?= $discount4 ?></td>
                    <td><?= $discount_fee4 ?></td>
                    <td><?= $adjusted4 ?></td>
                    <td><?= $total_due4 ?></td>
                    <td><?= $total_paid4 ?></td>
                    <td><?= $total_waive4  ?></td>
                    <td><?= $total_withdraw4 ?></td>
                    <td><?=  $due_fee4  ?></td>
                    <td><?= $fine4 ?></td>
                    <td><?= $arraers4 ?></td>
                    <td><?= $advance4 ?></td>
                    <td></td>
                    <td><?= $other_fee4 ?></td>
                    <td><?= $grand_total4?></td>
                </tbody>
            </table> 
        </div>
    </div>
</div>
    </section>
    <!-- Main content balance sheet close -->


</div>

<script type="text/javascript">


    $(document).ready(function(){
       $.ajax({
            url: "balance_sheet/do_extra_tasks",
            type: "POST",
            data: {},
            success: function (msg) {
                
            }
        }); 
    });

    var date_format = '<?php echo $result = strtr( $this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',] ) ?>';

    $( document ).ready( function () {
        $( ".date" ).datepicker( {
            format: date_format,
            autoclose: true,
            todayHighlight: true
        } );
    } );



    jQuery( function ( $ ) {
        $( '.balance_sheet_input_submit' ).keydown( function ( e ) {

            var url = $( this ).data( 'url' ),
                selectors = $( this ).data( 'values' );

            if ( e.key.toLowerCase() == 'enter' ) {
                e.preventDefault();

                var values = $( selectors ).serialize();

                window.location.href = url + "?" + values;
            }
        } );

        // on pressing enter submit the form
        $( ".on_enter_submit" ).on( 'keydown', function ( e ) {
            var form = $( this ).parents( 'form' );

            if ( e.key.toLowerCase() == 'enter' || e.keyCode == 13 ) {
                e.preventDefault();
                $( form ).submit();
            }
        } );
    } );

    $(function()
    {
        var validator = $('#expence_heads').validate(
            {
                rules:
                    {
                        name: {required:true}
                    },
                messages:
                    {
                        name: {required:"This Is Required Field"}
                    },
                errorPlacement: function(error, element)
                {
                    error.insertAfter( element );
                }
            });
    });




</script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js"></script>
