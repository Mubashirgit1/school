<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>

<div class="content-wrapper" style="min-height: 946px;">
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            Struck Off Students
                        </h3>
                    </div>
                    <div class="box-body">
                        <?php if ( $this->session->flashdata( 'msg' ) ) { ?>
                            <div class="alert alert-success">  <?php echo $this->session->flashdata( 'msg' ) ?> </div> <?php } ?>
                        <div class="">
                            <div class="col-md-12">
                                <form role="form" action="<?php echo site_url( 'student/struck_off' ) ?>" method="post" class="form-horizontal">
                                    <?php echo $this->customlib->getCSRF(); ?>
                                    <div class="form-group">
                                        <div class="col-sm-2">
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
                                        <div class="col-sm-2">
                                            <label><?php echo $this->lang->line( 'section' ); ?></label>
                                            <select id="section_id" name="section_id" class="form-control">
                                                <option value=""><?php echo $this->lang->line( 'select' ); ?></option>
                                            </select>
                                            <span class="text-danger"><?php echo form_error( 'section_id' ); ?></span>
                                        </div>
                                        <div class="col-sm-2">
                                            <label>Gender</label>
                                            <select class="form-control" name="gender">
                                                <option value="" <?= set_select( 'gender', '', true ) ?>>Both</option>
                                                <option value="male" <?= set_select( 'gender', 'male' ) ?>>Male</option>
                                                <option value="female" <?= set_select( 'gender', 'female' ) ?>>Female</option>
                                            </select>
                                        </div> 
                                        <div class="col-sm-2">
                                            <label>Date From</label>
                                            <input type="text" class="form-control date" name="date_from" value="<?= $date_from ?>" readonly>
                                        </div>
                                        <div class="col-sm-2">
                                            <label>Date To</label>
                                            <input type="text" class="form-control date" name="date_to" value="<?= $date_to ?>" readonly>
                                        </div>
                                        <div class="col-sm-2"> 
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
            </div>

            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Struck Off Students</h3>
                    </div>

                    <div class="box-body">
                        <?php
                        
                        if ( empty( $students ) ): ?>
                            <p class="bold text-center text-danger">Withdraw Student Not Found.</p>
                        <?php else: ?>
                            <div class="table-responsive">
                                <table class="table     table-bordered" id="withdraw_students">
                                    <thead>
                                        <tr>
                                            <th class="text-center">S.No</th>
                                            <th class="text-center">Ad Date</th>
                                            <th class="text-center">Struck Off Date</th>
                                            <th class="text-center">Ad. No.</th>
                                            <th class="text-center">Class(Section)</th>
                                            <th class="text-center">Roll No.</th>
                                            <th>Student Name</th>
                                            <th>Father's Name</th>
                                            <th>Gender</th>
                                            <th>Mobile No.</th>
                                            <th>Class Fee</th>
                                            <th>Discount</th>
                                            <th>Fee</th>
                                            <th>Due Fee</th>
                                            
                                            <th>Fine</th>
                                            <th>Arrears</th>
                                            <th>Advance</th>
                                            <th>Other Fee</th>
                                            
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                            $total_fee      = 0;
                                            $discount       = 0;
                                            $total_discount_fee   = 0;
                                            $total_arrears  = 0;
                                            $total_advance  = 0;
                                            $total_due      = 0;
                                            
                                            $other_total = 0;
                                            $fine  = 0;               
                                            foreach ( $students as $key => $student ): 
                                                $student_fee = $student['fee'] -   $student['discount'];
                                                if($student['fee_arrears'] < 0){
                                                    $advance = abs($student['fee_arrears']);
                                                    $arrears = 0;
                                                    $due_fee     = 0;
                                                }else{
                                                    $arrears =    $student['fee_arrears'] - $student_fee;
                                                    if($arrears > 0){
                                                        $arrears = $student['fee_arrears'] - $student_fee;
                                                        $due_fee = $student_fee;
                                                        $advance = 0;
                                                    }else{
                                                        if($arrears == $student_fee){
                                                            $due_fee = $student_fee;
                                                            $arrears = 0;
                                                            $advance = 0;
                                                        }else{
                                                            $arrears = 0;
                                                            $advance = 0;
                                                            $due_fee = $student['fee_arrears'];
                                                        }
                                                    }
                                                }

                                                    $total_fee      += $student['fee'];
                                                    $discount       += $student['discount'];
                                                    $total_discount_fee +=  $discount_fee;
                                                    $fine  += $student['late_payment_fee'];

                                                    $total_due += $due_fee;
                                                    $total_advance +=$advance;
                                                    $total_arrears += $arrears;
                                           
                                                    
                                                    ?>
                                            <tr>
                                                <td class="text-center"><?= $key+1 ?></td>
                                                <td class="text-center"><?php echo date('d-m-Y',strtotime($student['admission_date'])); ?></td>
                                                <td class="text-center"><?php echo date('d-m-Y',strtotime($student['updated_at'])); ?></td>
                                                <td class="text-center"><?= $student['admission_no'] ?></td>
                                                <td class="text-center"><?= $student['class']."(".$student['section'].")" ?></td>
                                                <td class="text-center"><?= $student['roll_no'] ?></td>
                                                <td>
                                                    <a href="<?php echo base_url(); ?>student/view/<?php echo $student['id'] ?>">
                                                        <?= $student['firstname'] . ' ' . $student['lastname'] ?>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a class="" href="<?= site_url( "family/children_summary/{$student['id']}" ) ?>">
                                                        <?= $student['father_name'] ?>
                                                    </a>
                                                </td>
                                                <td><?= $student['gender'] ?></td>
                                                <td><?= $student['father_phone'] ?></td>
                                                <td><?= $student['fee'] ?></td>
                                                <td><?= $student['discount'] ?></td>
                                          
                                                <td class="text-center"><?=   number_format(  $discount_fee  != null ? $discount_fee: 0 ) ?></td>
                                                <td class="text-center"><?= $due_fee ?></td>
                                                <td class="text-center"><?= $student['late_payment_fee'] ?></td>                         
                                                <td class="text-center"><?= $arrears ?></td>
                                                <td class="text-center"><?= number_format($advance != null ? $advance : 0) ?></td>
                                                <td>

                                                <?php if($student['other_fee'] == null ){
                                            echo 0;    
                                            }else{ 
                                                   ?> 
                                                
                                                <table class="  " style="margin-bottom: 0px;">                                                      <tbody>
                                                <tbody><?php
                                                  
                                                foreach($student['other_fee'] as $other){
                                                    $other_total  +=  $other['total_fee'];
                                                    foreach($other['voucher_fee_types'] as $other_type){
                                                    ?>
                                                <tr>
                                                <td class="text-left"><?= $other_type['name'] ?></td>  
                                                  <td> <?= number_format($other_type['amount']) ?> </td>
                                                </tr>
                                                <?php } }?>
                                                </tbody>  
                                                </table>   
                                            <?php  }?>
                                                </td>   
                                             
                                                <td class="pull-right">
                                                    <a href="<?php echo base_url(); ?>fee_management/receive_fee/<?php echo $student['id'] ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="" data-original-title="Collect Fee">
                                                        <i class="fa fa-money"></i>
                                                    </a>
                                                    <a href="<?php echo base_url(); ?>student/character_certifcate/?student_id=<?php echo $student['id'] ?>&section=<?php echo $student['section'] ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="" data-original-title="Student certificate">
                                                            <i class="fab fa-connectdevelop"></i>
                                                        </a>
                                                </td>

                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="10" class="text-right">Total</th>
                                            <th><?= $total_fee ?></th>
                                            <th><?= $discount ?></th>
                                            <th class="text-center"><?= $total_discount_fee ?></th>
                                            <th class="text-center"><?= $total_due ?></th>
                                            <th class="text-center"><?= $fine ?></th>
                                            
                    
                                            <th class="text-center"><?= $total_arrears ?></th>
                                            <th class="text-center"><?= $advance ?></th>
                                      
                                            <th class="text-center"><?=   $other_total ?></th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
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

        $( '.date' ).datepicker( {
            format: 'mm/dd/yyyy',
            autoclose: true
        } );

    } );
</script>