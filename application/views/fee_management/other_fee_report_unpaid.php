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
    <?php $this->general_library->err_msg() ?>


    <section class="content-header">
        <div class="box box-primary" style="margin-bottom: 0px;">
            <div class="box-header with-border" style="padding: 20px;">

                <form role="form" action="<?php echo site_url( 'fee_management/other_fee_report_unpaid' ) ?>" method="get" class="form-horizontal">
                    <div class="col-md-2 col-sm-12">
                        <h4>
                            Other Fee Collection
                        </h4>
                    </div>
                    <div class="col-md-9 col-sm-12">
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
                    </div>
                    <div class="col-md-1 col-sm-12">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label style="width: 100%;">&nbsp</label>
                                <button type="submit" name="search" value="search_filter" class="btn btn-primary btn-sm ">
                                    <i class="fa fa-search"></i> <?php echo $this->lang->line( 'search' ); ?>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>



            </div>
        </div>
        <?php
        $this->load->view('layout/other_fee_wise');
        ?>

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
            <form action="" method="post" >
                <div class="col-sm-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"> Unpaid Voucher (Other Fee) </h3>


                            <div class="checkbox pull-right">
                                <label>
                                    <input type="checkbox" class="bank_copy check11" id="bank_copy" name="bank_copy" value="1" checked>
                                    <span class="text-danger">
                                            <b>Bank Copy</b>
                                        </span>
                                </label>
                            </div>
                        </div>
            </form>
            <div class="box-body no-padding">
                <?php if ( !empty( $students_processed ) ): ?>
                    <div class="table-responsive">
                        <table class="table     table-bordered table-hover example" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th class="text-center">Vr No</th>

                                <th class="text-center">Ad Date</th>
                                <th class="text-center">Ad No</th>
                                <th class="text-left">Student Name</th>
                                <th class="text-left">Father Name</th>
                                <th class="text-left">class</th>

                                <th>  <?php
                                    if ( $other_fee_types === null ) {
                                        echo "Other Fee Types"."<span class='pull-right'>Amount</span>";
                                    } else {
                                        echo $other_fee_types."<span class='pull-right'>Amount</span>";
                                    }
                                    ?> </th>

                                <?php /*?><?php foreach ( $fee_types as $fee ): ?>
                                            <th class="" ><?= $fee['name'] ?></th>
                                             <?php endforeach; ?>
                                            <?php */?>


                                <th class="text-center">Total Fee.</th>


                                <th class="text-center">Issue Date</th>
                                <th class="text-center">Due Date</th>

                                <th class="text-right">Action</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php /*?><?php
print_r($unpaid_students_other);
exit();

?><?php */?>
                            <?php foreach ( $unpaid_students_other as $unpaid_student_other ): ?>


                                <?php  $date2  = $unpaid_student_other['student']['admission_date']; ?>
                                <?php  $date = $unpaid_student_other['created_voucher'] ?>
                                <tr>
                                    <td class="vertical_align_middle text-center"><?php echo $unpaid_student_other['voucher_id']  ?></td>
                                    <td  class="vertical_align_middle text-center"><?php echo date('d-M-y',strtotime($date2))  ?></td>
                                    <td  class="vertical_align_middle text-center"><?php echo $unpaid_student_other['student']['admission_no']  ?></td>
                                    <td  class="vertical_align_middle text-left">
                                        <a href="<?php echo base_url(); ?>student/view/<?php echo $unpaid_student_other['student']['id']; ?>" <?= $student['struck_off']==1?'style="color:red;"':''?> >
                                            <?php echo $unpaid_student_other['student']['firstname'].$unpaid_student_other['student']['lastname']  ?>
                                        </a>
                                    </td>
                                    <td  class="vertical_align_middle text-left">
                                        <a href="<?= site_url( "family/children/" . $unpaid_student_other['student']['id'] ) ?>" <?= $student['struck_off']==1?'style="color:red;"':''?> >
                                            <?php echo $unpaid_student_other['student']['father_name']  ?>

                                        </a>
                                    </td>
                                    <td  class="vertical_align_middle text-left"><?php echo $unpaid_student_other['student']['class'].'/'.$unpaid_student_other['student']['section']  ?></td>





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

<?php */?>


                                            <tbody>
                                            <?php if ( empty( $unpaid_student_other['voucher_fee_types'] ) ): ?>
                                                N/A
                                            <?php else: ?>
                                                <?php foreach( $unpaid_student_other['voucher_fee_types'] as $other_fee ): ?>
                                                    <?php if ($other_fee['amount'] > 0) {  ?>
                                                        <tr>

                                                            <?php if ( $other_fee_types === null ): ?>
                                                                <td class="text-left"><?= $other_fee['name'] ?></td>                                                         <?php endif; ?>
                                                            <td class="text-right"><?= number_format($other_fee['amount']) ?></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                endforeach;
                                                ?>
                                            <?php endif; ?>

                                            </tbody>
                                        </table>
                                    </td>





                                    <?php $total_other += $unpaid_student_other['total_fee'] ?>
                                    <td class="vertical_align_middle text-center"><?php echo number_format($unpaid_student_other['total_fee'])  ?> </td>

                                    <td class="vertical_align_middle text-center"><?php echo  date('d-M-y',strtotime($date))   ?> </td>

                                    <td class="vertical_align_middle text-center"><?php echo  date( 'd-M-y',strtotime($unpaid_student_other['due_voucher']))  ?> </td>

                                    <td class="vertical_align_middle text-center">
                                        <form action="" method="post" >

                                            <?php $admind = $this->session->userdata( 'admin' );
                                            $this->load->helper('menu_helper');
                                            $permission = admin_permission($admind['id']);
                                            ?>
                                            <?php
                                            if ($permission->delete_fee == 1) {
                                                ?>

                                                <input type="hidden" name="student_ids" value="<?= $unpaid_student_other['student_id'] ?>">
                                                <input type="hidden" class="student_redirect" name="redirect" value="<?= urlencode( current_url() ) ?>">
                                                <button type="submit" class="btn btn-default btn-xs pull-right"
                                                        formaction="<?= site_url( 'fee_management/delete_unpaid/' . $unpaid_student_other['voucher_id'] ) . '?redirect=' . urlencode( current_url() ) ?>" onclick="return confirm('Do you really want to revert this Unpaid Voucher?')" data-toggle="tooltip" title="" data-original-title="Delete" >
                                                    <i class="fa fa-trash-o"></i>
                                                </button>

                                                <?php
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

                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th colspan="6" class="text-right"></th>
                                <th class="text-left">TOTAL</th>

                                <th class="text-center vertical_align_middle "> <?= number_format($total_other) ?></th>
                                <th class="text-center"> </th>
                                <th class="text-center"> </th>

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
</form>
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