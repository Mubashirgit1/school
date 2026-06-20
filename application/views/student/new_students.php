<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>

<div class="content-wrapper" style="min-height: 946px;">
    <!-- <section class="content-header">
        <h1>
            <i class="fa fa-user-plus"></i> New Students
        </h1>
    </section> -->
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <!-- <i class="fa fa-search"></i> --> New Students</h3>
                    </div>
                    <div class="box-body">
                        <?php if ( $this->session->flashdata( 'msg' ) ) { ?>
                            <div class="alert alert-success">  <?php echo $this->session->flashdata( 'msg' ) ?> </div> <?php } ?>
                        <div class="">
                            <div class="col-md-12">
                                <form role="form" action="<?php echo site_url( 'student/new_students' ) ?>" method="post" class="form-horizontal">
                                    <?php echo $this->customlib->getCSRF(); ?>
                                    <div class="form-group">
                                        <div class="col-sm-2 " >
                                            <label class="class-select"><?php echo $this->lang->line( 'class' ); ?></label>
                                            <select id="class_id" name="class_id"  >
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
                                            <select name="gender" class="form-control">
                                                <option value="" <?= set_select( 'gender', '', true ) ?>>Both</option>
                                                <option value="male" <?= set_select( 'gender', 'male' ) ?>>Male</option>
                                                <option value="female" <?= set_select( 'gender', 'female' ) ?>>Female</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-3">
                                            <label>Date From</label>
                                            <input type="text" class="form-control date" name="date_from" value="<?= set_value( 'date_from' ) ?>" readonly>
                                        </div>
                                        <div class="col-sm-3">
                                            <label>Date To</label>
                                            <input type="text" class="form-control date" name="date_to" value="<?= set_value( 'date_to' ) ?>" readonly>
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
            </div>

            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <!-- <h3 class="box-title">New Students</h3> -->
                    </div>

                    <div class="box-body no-padding">
                        <?php if ( empty( $students ) ): ?>
                            <p class="bold text-center text-danger">No new students found within this range.</p>
                        <?php else: ?>
                            <div class="table-responsive">
                                <table class="table     table-bordered" id="new_students">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th class="text-center">Ad Date</th>
                                            <th class="text-center">Ad. No.</th>
                                            <th class="text-center">Ad Class</th>
                                            <th class="text-center">Class(Section)</th>
                                            <th class="text-center">Roll No.</th>
                                            <th>Student Name</th>
                                            <th>Father's Name</th>
                                            <th class="text-center">Gender</th>
                                            <th class="text-center">Mobile No.</th>
                                            <th class="text-center">CNIC</th>
                                            <th>Class Fee</th>
                                            <th>Discount</th>
                                            <th>Fee</th>
                                            <th>Due Fee</th>
                                            <th>Arrears</th>
                                            <th>Fine</th>
                                            <th>Advance</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $class_discount    = 0;
                                        $fee_arrears_month = 0;
                                        $fee_advance_month = 0;
                                        $discount_fee      = 0;
                                        $current_fee       = 0;
                                        $total_due_fee     = 0;
                                        $total_fine        = 0;
                                        foreach ( $students  as $key => $student ): 
                                            $fee_arrears        = 0;
                                            $due_fee            = 0; 
                                            $late_payment_fee   = 0;
                                            // calculate total students discount
                                            $class_discount += intval( $student['discount']);
                                            $discount_fee = intval($student['class_fee']) - intval($student['discount']);
                                            if ($student['fee_arrears'] > 0) {

                                                // calculate current student arrears
                                                $fee_arrears = $student['fee_arrears'] - $discount_fee - $student['late_payment_fee'];
                                                
                                                // calculate current student fine
                                                $late_payment_fee = $student['late_payment_fee'];

                                                $current_fee = $student['fee_arrears'] - $late_payment_fee;
                                                if ($current_fee > $discount_fee) {
                                                    $due_fee     = $discount_fee; 
                                                }else{
                                                    $due_fee     = $current_fee; 
                                                }
                                                if($fee_arrears < 0){
                                                    $fee_arrears = 0;
                                                }
                                            }
                                            if ($student['fee_arrears'] < 0) {
                                                $fee_advance_month += abs($student['fee_arrears']);
                                            }

                                            // calculate total month fine
                                            $total_fine         += $late_payment_fee;
                                            // calculate total month arrears
                                            $fee_arrears_month  += $fee_arrears;
                                            // calculate current student fine
                                            $total_due_fee      += $due_fee;
                                        ?>
                                            <tr <?= $student['struck_off']==1?'style="color:red;"':''?> >
                                                <td class="text-center"><?= $key+1 ?></td>
                                                <td class="text-center"><?php echo date('d-M-Y',strtotime($student['admission_date'])); ?></td>
                                                <td class="text-center"><?= $student['admission_no'] ?></td>
                                                <?php $class = $this->class_model->get( $student['admission_class']); ?>
                                                <td class="text-center"><?= $class['class']    ?> </td>
                                                <td class="text-center"><?= $student['class']['class']."(".$student['class']['section'].")" ?></td>
                                                <td class="text-center"><?= $student['roll_no'] ?></td>
                                                <td>
                                                    <a href="<?php echo base_url(); ?>student/view/<?php echo $student['id']; ?>" <?= $student['struck_off']==1?'style="color:red;"':''?>  >
                                                        <?= $student['firstname'] . ' ' . $student['lastname'] ?></td>
                                                    </a>
                                                <td>
                                                    <a  href="<?= site_url( "family/children_summary/{$student['id']}" ) ?>" <?= $student['struck_off']==1?'style="color:red;"':''?> >
                                                        <?= $student['father_name'] ?>
                                                    </a>
                                                </td>
                                                <td class="text-center"><?= $student['gender'] ?></td>
                                                <td class="text-center"><?= $student['father_phone'] ?></td>
                                                <td class="text-center"><?= $student['father_cnic'] ?></td>
                                                <td class="text-center"> <?= number_format( $student['class_fee'] ) ?></td>
                                                <td class="text-center"> <?= number_format( $student['discount'] ) ?></td>
                                                <td class="text-center"> <?= $discount_fee ?></td>
                                                <td class="text-center"> <?= $due_fee ?></td>
                                                <td class="text-center"> <?= $fee_arrears ?></td>
                                                <td class="text-center"> <?= $late_payment_fee ?></td>
                                                <td class="text-center"> <?= ( intval( $student['fee_arrears'] ) < 0 ? abs( $student['fee_arrears'] ) : 0 ) ?></td>
                                                <td>
                                                    <!-- <a href="< ?= site_url( "student/pkupdate/{$student['id']}" ) ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="" data-original-title="Update Dues">
                                                        <i class="fa fa-refresh"></i>
                                                    </a> -->
 
                                                    <!-- <a href="< ?= site_url( "student/view/{$student['id']}" ) ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="Show">
                                                        <i class="fa fa-reorder"></i>
                                                    </a>

                                                    <a href="< ?= site_url( "student/edit/{$student['id']}" ) ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="" data-original-title="Edit">
                                                        <i class="fa fa-pencil"></i>
                                                    </a> -->

                                                    <a href="<?= site_url( "fee_management/receive_fee/{$student['id']}" ) ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="" data-original-title="student Account">
                                                        <i class="fa fa-money"></i>
                                                    </a>

                                                    <!-- <a href="< ?= site_url( "student_assessment/add/{$student['id']}" ) ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="" data-original-title="Student assessment">
                                                        <i class="fab fa-connectdevelop"></i>
                                                    </a> -->
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
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