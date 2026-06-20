<style type="text/css">
    @media print {
        .no-print, .no-print * {
            display: none !important;
        }
    }
</style>
<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">

    </section>
    <?php  $admind = $this->session->userdata( 'admin' );
    $this->load->helper('menu_helper');
    $permission = admin_permission($admind['id']);

    ?>
    <!-- Main content -->


    <section class="content-header">
        <div class="box box-primary" style="margin-bottom: 0px;">
            <div class="box-header with-border" style="padding: 20px;">
                <div class="col-md-2">
                    <h3 style="margin-bottom:25px; margin-top:0px">
                        <?php echo $this->lang->line( 'expenses' ); ?>
                    </h3>
                </div>
                <div class="col-md-6">
                    <form role="form" action="<?php echo site_url( 'admin/expense/expenseSearch' ) ?>" method="post" class="form-inline">
                        <?php echo $this->customlib->getCSRF(); ?>
                        <?php if ( !empty( $expense_head_name ) ): ?>
                            <input type="hidden" name="head_name" value="<?= $expense_head_name ?>">
                        <?php endif; ?>
                        <div class="form-group">
                            <label><?php echo $this->lang->line( 'date_from' ); ?></label>
                            <input id="datefrom" name="date_from" placeholder="" type="text" class="form-control date" value="<?php echo set_value( 'date_from', date( $this->customlib->getSchoolDateFormat(), ( !empty( $date_from ) ? strtotime( $date_from ) : now() ) ) ); ?>" readonly/>
                            <span class="text-danger"><?php echo form_error( 'class_id' ); ?></span>
                        </div>
                        <div class="form-group">
                            <label><?php echo $this->lang->line( 'date_to' ); ?></label>
                            <input id="dateto" name="date_to" placeholder="" type="text" class="form-control date" value="<?php echo set_value( 'date_to', date( $this->customlib->getSchoolDateFormat(), ( !empty( $date_to ) ? strtotime( $date_to ) : now() ) ) ); ?>" readonly/>
                        </div>
                        <button type="submit" name="search" value="search_filter" class="btn btn-primary btn-sm checkbox-toggle ">
                            <i class="fa fa-search"></i> <?php echo $this->lang->line( 'search' ); ?>
                        </button>
                    </form>
                </div>
                <div class="col-md-4">
                    <form role="form" action="<?php echo site_url( 'admin/expense/expenseSearch' ) ?>" method="post" class="form-inline">
                        <?php echo $this->customlib->getCSRF(); ?>
                        <div class="form-group">
                            <label><?php echo $this->lang->line( 'search' ); ?></label>
                            <input type="text" value="<?php echo set_value( 'search_text', "" ); ?>" name="search_text" class="form-control" placeholder="Search by Expense">
                        </div>
                        <button type="submit" name="search" value="search_full" class="btn btn-primary btn-sm checkbox-toggle ">
                            <i class="fa fa-search"></i> <?php echo $this->lang->line( 'search' ); ?>
                        </button>
                        <a style="margin-left:15px;" href="<?php echo site_url( 'transactions/daily' ) ?>" class="btn btn-primary back_btn">
                            <i class="fa fa-chevron-left"></i> Back
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="content">



        <div class="row">


            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->






                <?php if ( isset( $resultList ) ) {
                    ?>
                    <div class="box box-primary" id="exp" >

                        <div class="box-header" >
                            <h3 class="box-title titlefix">
                            </h3>
                        </div>
                        <div class="box-body table-responsive">

                            <table class="table     table-bordered table-hover example">
                                <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center"><?php echo $this->lang->line( 'date' ); ?></th>
                                    <th>Admin</th>
                                    <th><?php echo $this->lang->line( 'expense_head' ); ?></th>
                                    <th><?php echo $this->lang->line( 'name' ); ?></th>
                                    <th class="text-right"><?php echo $this->lang->line( 'amount' ); ?></th>

                                    <th class="text-center">Actions</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php
                                if ( empty( $resultList ) ) {
                                ?>
                                <tfoot>
                                <tr>
                                    <td colspan="4" class="text-danger text-center"><?php echo $this->lang->line( 'no_record_found' ); ?></td>

                                </tr>
                                </tfoot>
                                <?php
                                } else {
                                    $count = 1;
                                    $grand_total = 0;
                                    foreach ( $resultList as $key => $value ) {
                                        $grand_total = $grand_total + $value['amount'];
                                        ?>
                                        <tr>

                                            <td id="test" class="text-center"> <?php echo $value['id'] ?></td>
                                            <td class="text-center">         <?php echo date( $this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat( $value['date'] ) ); ?>     </td>
                                            <td> <?php echo $value['user_id'] ?></td>
                                            <td> <?php echo $value['exp_category'] ?></td>
                                            <td>         <?php echo $value['name']; ?>     </td>
                                            <td class="pull-right"><?php echo( number_format( $value['amount'] ) ); ?>  </td>



                                            <?php
                                            $current_date = date("Y-m-d", now());
                                            $date_year =$value['created_at'];
                                            $payment_date = date('Y-m-d', strtotime($date_year));
                                            if(($payment_date == $current_date && $permission->daily_delete==1 ) ||  $permission->delete_fee==1){





                                                ?>
                                                <td class="text-center">
                                                    <a href="<?= site_url( 'admin/expense/delete/' . $value['id'] ) . '?redirect=' . urlencode( current_url() . '?' . $_SERVER['QUERY_STRING'] ) ?>" class="btn btn-default btn-xs" onclick="return confirm('Do you really want to delete this?');"><i class="fas fa-trash-alt"></i></a>

                                                    <a  class="btn btn-default btn-xs" href="<?= site_url( 'admin/expense/edit2/'.$value['id'] ) ?>">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>

                                                </td>
                                                <div id="hello"></div>
                                            <?php }?>
                                        </tr>
                                        <?php
                                        $count++;
                                    }
                                    ?>
                                    <tr >
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>

                                        <td class="text-right">Total  <?php echo(number_format( $grand_total, 0, '', ',' ) ); ?></td>
                                        <td></td>
                                    </tr>
                                    <?php
                                }
                                ?>

                                </tbody>
                            </table>




                        </div>

                    </div>




                    <?php
                }
                ?>




            </div>

        </div>   <!-- /.row -->

    </section><!-- /.content -->
</div>
<script type="text/javascript">
    $( document ).ready( function () {
        var date_format = '<?php echo $result = strtr( $this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',] ) ?>';
        $( ".date" ).datepicker( {
            // format: "dd-mm-yyyy",
            format: date_format,
            autoclose: true,
            todayHighlight: true

        } );
    } );
</script>
<script type="text/javascript">
    $( document ).ready( function () {
        $( '.example' ).dataTable( {
            "bSort": false,
            "paging": false,

        } );

    } );



</script>



<script>






</script>
<script type="text/javascript">

    var base_url = '<?php echo base_url() ?>';

    function printDiv( elem ) {
        Popup( jQuery( elem ).html() );
    }


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
</script>
<script>

    $( document ).on( 'click', '.btn-edit-expense', function () {
        var id = $(this).data('id');
        var base_url = '<?php echo base_url() ?>';

        $.ajax( {
            type: "POST",
            url: base_url + "admin/Expense/edit2",
            data: {'id': id},
            dataType: "json",
            success: function ( data ) {
                if (data.error === 'false') {
                    alert('An internal error occured while saving Group. Please try again.');
                } else {
                    alert('Group saved successfully.');

                }
                $( '#date_edit' ).text( data.date );
                $( '#expense_edit' ).val( data.exp_head_id );
                $( '#name_edit' ).val( data.name );
                $( '#amount_edit' ).val( data.amount );
            }
        } );


    } );

</script>

