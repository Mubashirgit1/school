
<style type="text/css">
    .disabledbutton {
        pointer-events: none;
        opacity: 0.4;
    }
    .disabledbutton2 {
        pointer-events: none;
        opacity: 0.8;
    }
    .modal {
        display:    none;
        position:   fixed;
        z-index:    1000;
        top:        0;
        left:       0;
        height:     100%;
        width:      100%;
        background: rgba( 255, 255, 255, .8 )
        url('http://i.stack.imgur.com/FhHRx.gif')
        50% 50%
        no-repeat;
    }

    /* When the body has the loading class, we turn
       the scrollbar off with overflow:hidden */
    body.loading .modal {
        overflow: hidden;
    }

    /* Anytime the body has the loading class, our
       modal element will be visible */
    body.loading .modal {
        display: block;
    }
    .loading-image {
        position: absolute;
        top: 50%;
        left: 50%;
        z-index: 10;
    }
</style>

<div class="content-wrapper" style="min-height: 946px;">
    <?php if ( $this->session->flashdata( 'expense_err' ) ):
        echo "<div><div class='alert alert-danger' style='display: inline-block;'>" . $this->session->flashdata( 'expense_err' ) . "</div></div>";
    endif;
    if ( $this->session->flashdata( 'expense_msg' ) ):
        echo "<div><div class='alert alert-success' style='display: inline-block;'>" . $this->session->flashdata( 'expense_msg' ) . "</div></div>";
    endif; ?>
    <div id="voucher_pre"></div>
    <?php  $admind = $this->session->userdata( 'admin' );
    $this->load->helper('menu_helper');
    $permission = admin_permission($admind['id']);?>
    <section class="content-header">
        <div class="box box-primary" style="margin-bottom: 0px;">
            <div class="box-header with-border" >
                <div class="row">
                    <h4 class="pull-left col-sm-2"> Generate <?= $title ?></h4>
                    <div class="col-sm-2"><h5></h5></div>
                    <div class="col-sm-3 pull-right">
                    <?php if($permission->vr_search){ ?>
                        <form action="<?= site_url( 'fee_management/fee_voucher_receive' ) ?>" method="get">
                            <div class="input-group" style="padding-top:3px;">
                                <input type="text" name="voucher_id" class="form-control search-form search-form3"  value="" placeholder="Voucher ID" >
                                <span class="input-group-btn">
                                    <button type="submit" style="padding: 3px 7px !important; background: #fff;" class="btn btn-flat"><i class="fa fa-search"></i></button>
                                </span>
                            </div>
                        </form>
                    <?php }?> 
                    </div><div class="clearfix"></div>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="modal"><!-- Place at bottom of page --></div>
        <div class="text-center">
            <?php $this->general_library->err_msg(); ?>
        </div>
        <div class="row">
            <form action="<?= site_url( 'fee_management/fee_voucher_process' ) ?>" method="post" id="submit_voucher" >
                <div class="col-xs-12 col-sm-6">
                    <div class="box box-primary">
                        <div class="other_fee2" >
                            <div class="box-header with-border">
                                <h3 class="box-title">Tuition Fee</h3>
                                <div class="pull-right">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" class="bank_copy check11" id="bank_copy" name="bank_copy" value="1" checked>
                                                     <span class="text-danger">
                                                     <b>Bank Copy</b>
                                                     </span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <button type="submit" class="btn btn-primary pull-right message voucher_button all" id="voucher_button" >Generate Vouchers</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="other_fee2" >
                                <label>Fee (Select only one option from below)</label>
                                <div class="row">
                                    <div class="col-xs-6">
                                        <div class="checkbox check_a check_b">
                                            <label>
                                                <input type="hidden" name="fee[1][name]" value="Due Fee">
                                                <input type="checkbox" class="due_fee tuition_fee" id="due_fee" onChange="" name="fee[1][check]" value="1">  Tuition Fee <br> ( <?= date('M')?> Due + Arrears(Upto <?= date('M', strtotime(date('Y-m')." -1 month"));?>)) 
                                            </label>
                                            <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Note: Expired on end of <?= date('M')?></p>
                                        </div>

                                        <div class="checkbox check_b summer_box">
                                            <label>
                                                <input type="hidden" name="fee[0][name]" value="Tuition Fee">

                                                <input type="checkbox" class="advance_fee1 check_advance1" id="advance_fee1" name="advance_fee1" value="1" style="visibility:hidden">
                                                <input type="checkbox" class="advance_fee check_advance" data-toggle="collapse" data-target="#multi_months" id="advance_fee" name="fee[0][check]" value="1"> Tuition Fee Advance <br>  (Combine month(s) + Arrears(Upto <?= date('M')?>)) 
                                            </label>
                                            <p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspNote: Expired on end of <?=  date('M', strtotime('+1 month')); ?>.</p>

                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="checkbox check_a check_b arrears_check">
                                            <label>
                                                <input type="checkbox" class="fee_arrears" id="arrears_fee" name="arrears" value="1"> Arrears (Optional)<br><br>
                                            
                                            </label>
                                            
                                        </div>
                                        <div class="checkbox summer_box">
                                                <input type="checkbox" class="summer" id="" name="summer" value="1" style="visibility:hidden">
                                          
                                            <label>
                                         <input type="checkbox" class="" data-toggle="collapse" data-target="#multi_months" id="summer_fee" name="fee[0][check]" value="1">Tuition Fee Advance <br> (Seperate Month(s) only)
                                            </label>
                                            <p>Note: Expired on end of month as selected month</p>
                                        </div>
                                        <!--<div class="form-group">
                                            <input type="text" class="form-control" name="fee[0][amount]" value="">
                                        </div>-->
                                    </div>


                                    <div class="clearfix"></div>
                                    <div class="col-xs-6">
                                        <div class="checkbox">
                                            <label>
                                                <input type="hidden" name="due_date_check" value="1"> Due Date
                                            </label>
                                        </div>
                                        <div class="checkbox">
                                            <label style="margin-top: 14px;">
                                                <input type="hidden" name="due_date_check" value="1">Extend Tuition fee voucher Due Date
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <div class="form-group">
                                                    <input type="number" class="form-control" id="due_date_h_date" name="due_date_h_date" value="<?= set_value( 'due_date_h_date', date( 'd', strtotime( $last_date_for_receiving_fee ) ) ) ?>" disabled>
                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                <div class="form-group">
                                                    <select class="form-control" id="due_date_h_month" name="due_date_h_month" disabled>
                                                        <?php for ( $i = 0; $i < count( $month_names ); $i++ ):   ?>
                                                            <option class="other_fee2"   value="<?= $i + 1 ?>" <?= set_select( 'due_date_h_month', ( $i + 1 ), ( $current_date->format( "F" ) == $month_names[$i] ) ) ?>>
                                                                <?= $month_names[$i] ?>
                                                            </option>
                                                        <?php  endfor; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                            <div class="form-group">
                                                    <input type="date" class="form-control" id="due_date_tuition" name="due_date_tuition" value="<?= set_value( 'due_date_tuition', date( 'd', now() ) ) ?>"  >
                                                </div>
                                            </div>
                                            <div class="col-xs-12">
                                                <p class="help-block small">   Due date can be changed from
                                                    <a href="<?= site_url( 'options' ) ?>">options</a>.
                                                </p>
                                            </div>
                                        </div>
                                        <div class="form-group hidden">
                                            <input type="text" class="form-control" id="due_date" name="due_date" value="<?= set_value( 'due_date[date]', date( 'm/d/Y', strtotime( $last_date_for_receiving_fee ) ) ) ?>" readonly>
                                            <input type="hidden" id="next_month" name="next_month" value="<?= date('F',strtotime('first day of +1 month')) ?>">
                                   
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="form-group">
                                    <label>
                                        <span data-toggle="collapse" data-target="#multi_months" style="cursor: pointer;">
                                            Option For advance/multiple Months only
                                            <i class="fa fa-angle-down"  style="font-size:20px; font-weight: bold; padding: 0px 0px 0px 4px; vertical-align: middle;"></i>
                                        </span>
                                    </label>
                                </div>
                                <div id="multi_months" class="collapse">
                                    <div class="row">
                                        <div class="col-xs-4 month_number">
                                            <input type="number" class="form-control" name="voucher_months" value="" min="1"  placeholder="Vouchers for number of months..." style="text-align: center;" >
                                        </div>
                                        <div class="col-xs-8">
                                            <div class="checkbox" style="margin-top: -4px;">
                                            
                                                <?php
                                                $curr_month = date('F');

                                                foreach ( $month_names as $month_name ):
                                                    if($month_name == $curr_month){ ?>
                                                     <div class="current_month">
                                                        <?php } ?>

                                                    <label class="col-sm-3">
                                                        <input type="checkbox"  class="month" name="month_names[]" value="<?= $month_name ?>" <?= $month_name == $curr_month?'checked':'' ?> > <?= $month_name ?>
                                                    </label>

                                                <?php   if($month_name == $curr_month){ ?>
                                                </div>
                                                <?php } endforeach; ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box box-primary">
                                <?php if ( $student_details !== null ): ?>
                                    <input type="hidden" id="student_id" name="student_ids[]" value="<?= $student_details['id'] ?>">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>Ad. No.</th>
                                            <th>Name</th>
                                            <th>Father's Name</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td><?= $student_details['admission_no'] ?></td>
                                            <td><?= $student_details['firstname'] . ' ' . $student_details['lastname'] ?></td>
                                            <td><?= $student_details['father_name'] ?></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                <?php else: ?>
                                    <?php if ( empty( $class_sections ) ): ?>
                                        <p class="text-center text-danger">No class has been added yet.</p>
                                    <?php else: ?>
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th width="26%" title="Select all classes and students in them">
                                                    <input type="checkbox" class="select_checkbox" data-target=".class_section_checkbox">
                                                    <span>Select All</span>
                                                </th>
                                                <th>
                                                    <div>Class / Section / Student Wise</div>
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach ( $class_sections as $class_section ): ?>
                                                <tr>
                                                    <td title="Select all students in this class">
                                                        <input type="checkbox" class="class_section_checkbox select_checkbox" data-target=".student_checkbox_<?= $class_section['class_id'] . '_' . $class_section['section_id']; ?>">
                                                        <?= $class_section['class']['class'] ?> / <?= $class_section['section']['section'] ?>
                                                    </td>
                                                    <td>
                                                        <?php if ( empty( $class_section['students'] ) ): ?>
                                                            <table class="table student_info_table"  style="margin-bottom: 0px;">
                                                                <thead>
                                                                <tr>
                                                                    <th width="8%"></th>
                                                                    <th class="text-danger">No student found in this class</th>
                                                                </tr>
                                                                </thead>
                                                            </table>
                                                        <?php else: ?>
                                                            <table class="table student_info_table"  style="margin-bottom: 0px;">
                                                                <thead>
                                                                <tr>
                                                                    <th width="8%"></th>
                                                                    <th onclick="jQuery(this).parents('.student_info_table').children('tbody').fadeToggle()" style="cursor: pointer;" title="Click to show students">Students</th>
                                                                </tr>
                                                                </thead>

                                                                <tbody style="display: none;">
                                                                <?php foreach ( $class_section['students'] as $student ): ?>
                                                                    <tr>
                                                                        <td>
                                                                            <input type="checkbox" class="student_checkbox_<?= $class_section['class_id'] . '_' . $class_section['section_id']; ?> select_checkbox all_student_voucher"  name="student_ids[]" value="<?= $student['id'] ?>">
                                                                        </td>
                                                                        <td>
                                                                            <?= $student['firstname'] . ' ' . $student['lastname'] ?>
                                                                        </td>
                                                                    </tr>
                                                                <?php endforeach; ?>
                                                                </tbody>
                                                            </table>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <div class="other_fee2">
                                    <button type="submit" class="btn btn-primary pull-right message voucher_button all" id="" >Generate Vouchers</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="mydiv" id="tuition_fee">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Other Fee</h3>
                                <div class="pull-right">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox" class="bank_copy check21" id="bank_copy" name="bank_copy" value="1" checked>
                                                    <span class="text-danger">
                                                       <b>Bank Copy</b>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <a class="btn btn-primary btn-sm" href="<?= site_url( 'fee_management/student_fee_types' ) ?>">
                                                Other Fee Types
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <?php if ( $student_fee_types !== false ): ?>
                                        <?php $count = 2; ?>
                                        <?php foreach ( $student_fee_types as $student_fee_type ): ?>
                                            <div class="col-xs-6">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="hidden" name="fee[<?= $count ?>][name]" value="<?= $student_fee_type['name'] ?>">
                                                        <input type="checkbox" id="other_fee" class="other_fee" name="fee[<?= $count ?>][check]" value="1"> <?= $student_fee_type['name'] ?>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-xs-6">
                                                <div class="form-group" style="margin-top: 5px; margin-bottom: 0px;">
                                                    <input type="number" class="form-control" name="fee[<?= $count ?>][amount]" value="<?= set_value( "fee[{$count}][amount]", $student_fee_type['amount'] ) ?>" min="0">
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <hr style="margin: 0px 5px;">
                                            <?php $count++; ?>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6">
                                        <div class="checkbox">
                                            <label>
                                                <input type="hidden" name="due_date_check" value="1"> Due Date
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="row">
                                            <div class="col-xs-7">
                                                <div class="form-group">
                                                    <input type="date" class="form-control" id="due_date_h_date_other" name="due_date_h_date_other" value="<?= set_value( 'due_date_h_date_other', date( 'd', now() ) ) ?>"  >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <?php if ( $student_details !== null ): ?>
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>Ad. No.</th>
                                            <th>Name</th>
                                            <th>Father's Name</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td><?= $student_details['admission_no'] ?></td>
                                            <td><?= $student_details['firstname'] . ' ' . $student_details['lastname'] ?></td>
                                            <td><?= $student_details['father_name'] ?></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                <?php endif; ?>
                                <div class="">
                                    <button type="submit" class="btn btn-primary pull-right all" id="message1" onClick="return validation()" formaction="<?= site_url( 'fee_management/fee_voucher_process' ) ?>">Generate Vouchers</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <form action="" method="post">
                    <?php if($student_id!==null){  ?>

                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Unpaid Vouchers (Tuition Fee)</h3>
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

                                <table class="table     table-bordered table-hover " id="unpaid_tuition"  cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th class="text-center">Vr No</th>
                                        <th class="text-center">Due Fee</th>
                                        <th class="text-center">arrears</th>
                                        <th class="text-center">Total Fee.</th>
                                        <th class="text-center">Issue Date</th>
                                        <th class="text-center">Due Date</th>
                                        <th class="text-center">action</th>
                                    </tr>
                                    </thead>
                                </table>

                            </div>

                        </div>

                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Unpaid Vouchers(Other Fee)</h3>
                                <div class="checkbox pull-right">
                                </div>
                            </div>
                            <div class="box-body">
                                <table class="table     table-bordered table-hover " id="unpaid_other"  cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th class="text-center">Vr No</th>
                                        <th class="text-center">Description</th>
                                        <th class="text-center">Total Fee.</th>
                                        <th class="text-center">Issue Date</th>
                                        <th class="text-center">Due Date</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    <?php    }  ?>
                </form>

             </div>
        </section>
    </div>
<?php $unpaid = empty($unpaid_students) ? 0 : 1; ?>

<style type="text/css">
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
</style>

<script type="text/javascript">



    // $("#summer_fee").on('change', function(){
      
    //   var unpaid_student = < ?= $unpaid?>;
    //     $.ajax( {
    //         type: "get",
    //         url: '< ?php echo site_url( "fee_management/check_unpaid_ajax" ) ?>',
    //         dataType: 'JSON',
    //         data: {
    //           student_id:getUrlVars()["student_id"],
    //         },
    //         success: function ( data ) {
                
    //         if(data == 1 ){
    //             $("#summer_fee"). prop("checked", false);
    //             //$(".summer_box").addClass("disabledbutton");
    //             $("#tuition_fee").addClass("disabledbutton");
    //             $(".check_b").addClass("disabledbutton");
    //             $("#multi_months").collapse('hide');
    //             sweetAlert({
    //                 title: "Alert",
    //                 text : " Delete Monthly Voucher to generate advance",
    //                 type: 'warning',
    //                 showConfirmButton: false,
    //                 timer: 2000,
    //             });
    //         }else{
    //             $(this). prop("checked", true);
    //             $("#tuition_fee").removeClass("disabledbutton");
    //             $(".check_b").addClass("disabledbutton");
              
    //         }
              
    //         }
    //     } );
    // });

    // $('#summer_fee').click(function () {
	//         if ($(this).is(':checked')) {
    //                 $("#tuition_fee").addClass("disabledbutton");
    //                 $(".check_b").addClass("disabledbutton");
    //             } else {
    //                 $("#tuition_fee").removeClass("disabledbutton");
    //                 $(".check_b").removeClass("disabledbutton");
                    
    //             }
    //       $('input.summer').prop('checked',this.checked)
    //       $('input.check_advance1').prop('checked',this.checked)
        
    //     });
   


    // $('#due_fee').click(function () {
    //     if ($(this).is(":checked")) {
    //         $('.fee_arrears').prop('checked', true);
    //     } else {
    //         $('.fee_arrears').prop('checked', false);
    //     }
    // });

  
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
        function update_due_date() {
            var due_date_h_month = $( "#due_date_h_month" ).val(),
                due_date = $( "#due_date" ).val();

            if ( due_date_h_month.length == 1 ) {
                due_date_h_month = "0" + due_date_h_month;
            }

            due_date = due_date.replace( /(\d*)(\/\d*\/\d*)/g, (due_date_h_month + "$2") );
            $( "#due_date" ).val( due_date )

        }
        update_due_date();
        $( "#due_date_h_month" ).change( function () {
            update_due_date();
        } );
    } );
</script>



<script type="text/javascript">

            $('#summer_fee').click(function () {
                var student_id  =  getUrlVars()["student_id"];
                if(student_id != null){
                    $.ajax( {
                        type: "get",
                        url: '<?php echo site_url( "fee_management/check_unpaid_ajax" ) ?>',
                        dataType: 'JSON',
                        data: {
                        student_id:getUrlVars()["student_id"],
                        },
                        success: function ( data ) {
                        if(data == 1 ){
                            $('#summer_fee').prop("checked", false);
                            sweetAlert({
                                title: "Alert",
                                text : " Delete Monthly Voucher to generate advance",
                                type: 'warning',
                                showConfirmButton: false,
                                timer: 3000,
                            });
                        }else{
                            if ($('#summer_fee').is(":checked")) {
                                $('#summer_fee').prop("checked", true);
                                $('.summer').prop("checked", true);
                                $("#tuition_fee").addClass("disabledbutton");
                                $(".check_b").addClass("disabledbutton");
                                $('#advance_fee1').prop('checked',true);
                             
                            } else {
                                $('#summer_fee').prop("checked", false);
                                $("#tuition_fee").removeClass("disabledbutton");
                                $(".check_b").removeClass("disabledbutton");
                                $('#advance_fee1').prop('checked',false);
                                $('.summer').prop("checked", false);
                               
                             
                            }
                        }
                        
                        }
                    } );

                }







	        // if ($(this).is(':checked')) {
            //     $("#tuition_fee").addClass("disabledbutton");
            //     $(".check_b").addClass("disabledbutton");
            //     $(".summer_box").addClass("disabledbutton");
            // } else {
            //     $("#tuition_fee").removeClass("disabledbutton");
            //     $(".check_b").removeClass("disabledbutton");
            // }
        //   $('input.summer').prop('checked',this.checked)
        //   $('input.check_advance1').prop('checked',this.checked)
        
        });


    $('input.check_advance').click(function(){
        $('input.check_advance1').prop('checked',this.checked)
    });

    $('input.check11').click(function(){
        $('input.check21').prop('checked',this.checked)
    })
    $('input.check21').click(function(){
        $('input.check11').prop('checked',this.checked)
    })

    jQuery( function ( $ ) {

        $(document).ready(function() {
            $('.month_number').addClass("disabledbutton2");
            
            $('#due_date_tuition').addClass("disabledbutton");

            $('.other_fee').click(function() {
                if ($(this).is(':checked')) {


                    $(".other_fee2").addClass("disabledbutton");

                } else {

                    $(".other_fee2").removeClass("disabledbutton");

                }
            });
        });


    } );


    function getUrlVars()
    {
        var vars = [], hash;
        var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
        for(var i = 0; i < hashes.length; i++)
        {
            hash = hashes[i].split('=');
            vars.push(hash[0]);
            vars[hash[0]] = hash[1];
        }
        return vars;
    }

    function tution_unpaid() {
        var student_id  =  getUrlVars()["student_id"];
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
    function unpaid_other() {
        var student_id  =  getUrlVars()["student_id"];
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

    $( document ).ready( function () {
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
                                        timer: 2000,
                                    });
                                    $(".check_a").removeClass("disabledbutton");
                                    $("#tuition_fee").removeClass("disabledbutton");
                                    $(".current_month").removeClass("disabledbutton");
                                    $(".summer_box").removeClass("disabledbutton");
                                    $('.month_number').removeClass("disabledbutton2");
                                    $(".other_fee2").removeClass("disabledbutton");

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


    jQuery( function ( $ ) {
        $(document).ready(function() {
            tution_unpaid();
            unpaid_other();
            $('.tuition_fee').click(function() {
            var student_id  =  getUrlVars()["student_id"];
                if(student_id != null){
                    $.ajax( {
                        type: "get",
                        url: '<?php echo site_url( "fee_management/check_unpaid_ajax" ) ?>',
                        dataType: 'JSON',
                        data: {
                        student_id:getUrlVars()["student_id"],
                        },
                        success: function ( data ) {
                        if(data == 1 ){
                            $('#due_fee').prop('checked',false);
                            $('.fee_arrears').prop('checked', false);
                            $(this).prop("checked", false);
                            sweetAlert({
                                title: "Alert",
                                text : " Delete Monthly Voucher to generate advance",
                                type: 'warning',
                                showConfirmButton: false,
                                timer: 3000,
                            });   
                        }else{
                            if ($('#due_fee').is(":checked")) {
                                $('#due_fee').prop('checked',true);
                                $('.fee_arrears').prop('checked', true);
                                $(".summer_box").addClass("disabledbutton");
                                $("#tuition_fee").addClass("disabledbutton");
                                $("#due_date_tuition").removeClass("disabledbutton");
                                $(".arrears_check").addClass("disabledbutton");
                            } else {
                                $(".arrears_check").removeClass("disabledbutton");
                                $('.fee_arrears').prop('checked', false);
                                $('#due_fee').prop('checked',false);
                                $("#tuition_fee").removeClass("disabledbutton");
                                $("#due_date_tuition").addClass("disabledbutton");
                                
                                $(".summer_box").removeClass("disabledbutton");
                            }
                        }
                    }
                    } );

                }
                if(student_id == null){
                if ($(this).is(':checked')) {
                    $('#due_fee').prop('checked',true);
                    $("#tuition_fee").addClass("disabledbutton");
                    $(".summer_box").addClass("disabledbutton");
                    $('.fee_arrears').prop('checked', true);
                    $(".arrears_check").addClass("disabledbutton");
                } else {
                    $('#due_fee').prop('checked',false);
                    $('.fee_arrears').prop('checked', false);
                    $("#tuition_fee").removeClass("disabledbutton");
                    $(".summer_box").removeClass("disabledbutton");
                    $(".arrears_check").removeClass("disabledbutton");
                }
            }
            
            });
        });
    });
    $('#arrears_fee').click(function () {


    var student_id  =  getUrlVars()["student_id"];
    if(student_id != null){
        $.ajax( {
            type: "get",
            url: '<?php echo site_url( "fee_management/check_unpaid_ajax" ) ?>',
            dataType: 'JSON',
            data: {
            student_id:getUrlVars()["student_id"],
            },
            success: function ( data ) {
            if(data == 1 ){
                $('#due_fee').prop('checked',false);
                $('.fee_arrears').prop('checked', false);
                $(this).prop("checked", false);
                sweetAlert({
                    title: "Alert",
                    text : " Delete Monthly Voucher to generate advance",
                    type: 'warning',
                    showConfirmButton: false,
                    timer: 3000,
                });   
            }else{
                if ($('#arrears_fee').is(":checked")) {
                    $('.fee_arrears').prop('checked', true);
                    $(".summer_box").addClass("disabledbutton");
                    $("#tuition_fee").addClass("disabledbutton");
            
                } else {
                    $('.fee_arrears').prop('checked', false);
                    $('#due_fee').prop('checked',false);
                    $("#tuition_fee").removeClass("disabledbutton");
                    $(".summer_box").removeClass("disabledbutton");
                }
            }
        }
        } );

    }
    if(student_id == null){
        if ($(this).is(":checked")) {
            $(".summer_box").addClass("disabledbutton");
            $('.fee_arrears').prop('checked', true);
            $("#tuition_fee").addClass("disabledbutton");
        } else {
            $(".summer_box").removeClass("disabledbutton");
            $('.fee_arrears').prop('checked', false);
            $("#tuition_fee").removeClass("disabledbutton");
        }
    }
    });

    $( document ).on( 'click', '.voucher_button', function () {

        
        var student_id  =  getUrlVars()["student_id"];
        if( typeof(student_id) === "undefined" ){
            var student_id_vrno = [];
            $('.all_student_voucher:checked').each(function(i){
                student_id_vrno[i] = $(this).val();
            });
        }else{
            var student_id_vrno = [];
            student_id_vrno[0] =  $("#student_id").val();
        }
       


        var month_ids = [];
 		$('input[name="month_names[]"]:checked').each(function() {
		   month_ids.push(this.value); 
		});

            var base_url = '<?php echo base_url() ?>';
            var student_details = [];
            var advance_fee= 0;
            if($("#advance_fee").is(':checked')){
              advance_fee = 1;
            }    
        
            if (student_id_vrno.length > 0) {
                $.ajax({
                    type: "POST",
                    url: base_url + "fee_management/check_voucher",
                    data: {'student_id': student_id_vrno,'month' : month_ids,'advance_fee' : advance_fee },
                    dataType: "json",
                    async: false,
                    success: function (data) {
                        student_details.push(data);
                    },
                });
                if(student_details[0]['unpaid'].length > 1 ){
                    unpaid = student_details[0]['unpaid'].length;
                    var vrno = [];
                    vrno =   student_details[0]['unpaid'];

                    sweetAlert( {
                            title: "Dear Admin",
                            text: unpaid +" students have been already issued fee vouchers. Click Yes to delete previous and generate new advance vouchers.Click NO to cancel it",
                            //type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: '#DD6B55',
                            confirmButtonText: 'Yes',
                            cancelButtonText: "No",
                            closeOnConfirm: true,
                            closeOnCancel: false
                        },
                        function ( isConfirm ) {
                            if ( isConfirm ) {
                                $.ajax(
                                    {
                                        type: "post",
                                        url: '<?php echo site_url( "fee_management/delete_voucher_unpaid" ) ?>',
                                        data: 'vrno=' + vrno,
                                        success: function ( data ) {
                                        }
                                    }
                                )
                                    .done( function ( data ) {
                                        if ( data.status == "fail" ) {
                                            $.each( data.msg, function ( index, value ) {
                                                var errorDiv = '#' + index + '_error';
                                                 $( errorDiv ).addClass( 'required' );
                                                $( errorDiv ).empty().append( value );
                                            } );
                                            $( '#successMessage' ).empty();
                                        } else {
                                            swal( {
                                                title: 'Success!',
                                                text: 'Students Unpaid Voucher Delete Succesfully',
                                                type: 'success',
                                            }, function () {
                                                document.getElementById("submit_voucher").submit();
                                            } );
                                        }
                                    } )
                                    .error( function ( data ) {
                                        sweetAlert( "Oops", "We couldn't connect to the server!", "error" );
                                    } );

                            } else {
                                  sweetAlert( "Cancelled", "Student Voucher Delete", "error" );
                           if(unpaid > 0 ){
                           //    document.getElementById("submit_voucher").submit();
                           }

                            }
                        } );
                    return false;
                }else if(student_details[0]['unpaid'].length == 1){
                    sweetAlert( {
                        title: "Student Already Have a Voucher",
                        text: "Please For generate New Voucher Delete previous one",
                        });
                    return false;
                    }
            } else {
               $('#voucher_pre').html("<div class='alert alert-danger'>No Student Selected</div>");
            }
        });
    jQuery( function ( $ ) {
        $(document).ready(function() {
            $('.advance_fee').click(function() {
                var student_id  =  getUrlVars()["student_id"];
                if(student_id != null){
                    $.ajax( {
                        type: "get",
                        url: '<?php echo site_url( "fee_management/check_unpaid_ajax" ) ?>',
                        dataType: 'JSON',
                        data: {
                        student_id:getUrlVars()["student_id"],
                        },
                        success: function ( data ) {
                        if(data == 1 ){
                            $('#due_fee').prop('checked',false);
                            $('.fee_arrears').prop('checked', false);
                            $('.advance_fee').prop('checked', false);
                            $("#multi_months").collapse('hide');
                            sweetAlert({
                                title: "Alert",
                                text : " Delete Monthly Voucher to generate advance",
                                type: 'warning',
                                showConfirmButton: false,
                                timer: 3000,
                            });   
                        }else{
                            if ($('.advance_fee').is(":checked")) {
                                $('#due_fee').prop('checked',true);
                                $('.fee_arrears').prop('checked', true);
                                $('#advance_fee1').prop('checked',true);
                                $("#tuition_fee").addClass("disabledbutton");
                                $(".check_a").addClass("disabledbutton");
                                
                                $(".current_month").addClass("disabledbutton");

                                $(".arrears_check").addClass("disabledbutton");
                                var next = $("#next_month").val();
                                $('.month').each(function (index, obj) {
                                if(this.value ==  next){
                                    $(this).prop('checked', true);
                                }
                                });
                                arrayValues = $('input[name="month_names[]"]:checked').length;
                                $("input[name='voucher_months']").val(arrayValues);

                            } else {
                                $(".arrears_check").removeClass("disabledbutton");
                                $('.fee_arrears').prop('checked', false);
                                $('#due_fee').prop('checked',false);
                                $(".check_a").removeClass("disabledbutton");
                                $('#advance_fee1').prop('checked',false);
                                $("#tuition_fee").removeClass("disabledbutton");
                                $(".summer_box").removeClass("disabledbutton");
                                $(".current_month").removeClass("disabledbutton");
                   
                                var next = $("#next_month").val();
                                $('.month').each(function (index, obj) {
                                if(this.value ==  next){
                                    $(this).prop('checked', false);
                                }
                                });
                                arrayValues = $('input[name="month_names[]"]:checked').length;
                                $("input[name='voucher_months']").val(arrayValues);
                            }
                        }
                    }
                    } );

                }
                if(student_id == null){
                if ($(this).is(':checked')) {
                    $(".check_a").addClass("disabledbutton");
                    
                    $("#tuition_fee").addClass("disabledbutton");
                    $(".current_month").addClass("disabledbutton");
                    $('.tuition_fee').prop('checked', true);
                    $('.fee_arrears').prop('checked', true);
                    var next = $("#next_month").val();
                    $('.month').each(function (index, obj) {
                    if(this.value ==  next){
                        $(this).prop('checked', true);
                    }
                    });
                    arrayValues = $('input[name="month_names[]"]:checked').length;
                                $("input[name='voucher_months']").val(arrayValues);
                } else {
                    
                    $(".check_a").removeClass("disabledbutton");
                    $('#advance_fee1').prop('checked',false);
                    $("#tuition_fee").removeClass("disabledbutton");
                    $(".current_month").removeClass("disabledbutton");
                    
                    $('.fee_arrears').prop('checked', false);
                    $('.tuition_fee').prop('checked', false);

                    var next = $("#next_month").val();
                    $('.month').each(function (index, obj) {
                    if(this.value ==  next){
                        $(this).prop('checked', false);
                    }
                    });
                    arrayValues = $('input[name="month_names[]"]:checked').length;
                                $("input[name='voucher_months']").val(arrayValues);
                }
            }
            });
        });
    });

</script>

<script type="text/javascript">

    var month  = <?= date('m');?>;
      max = 12 - month + 1;
    // $("input[name='voucher_months']").attr({
    //     "max" : max
    // });
    $( document ).on( 'click', '.month', function () {
       arrayValues = $('input[name="month_names[]"]:checked').length;
       console.log(arrayValues);
     $("input[name='voucher_months']").val(arrayValues);
    });

   
    


//     $( document ).on( 'click', '.all', function () {
//         var value_input = $("input[name='fee']").val();
// console.log(value_input);
//         alert(value_input);
//     sweetAlert( {
//         title: "Student Already Have a Voucher",
//         text: "Please For generate New Voucher Delete previous one",
//     });
//
//     return false;
//     });


    function validation(){
        var invalid = 0
        var y = document.getElementById("other_fee").value;
        if( y == "" ){
            confirm('Due Date not provide ');
            invalid += 1;
        }
        var x = document.getElementById("due_date_h_date_other").value;
        if( x == "" ){
            confirm('Due Date not provide ');
            invalid += 1;
        }
        if(invalid!=0){
            return false;
        }
        else{
            return true;
        }
    }


</script>

