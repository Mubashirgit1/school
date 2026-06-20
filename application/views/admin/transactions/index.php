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
        <h1><i class="fa fa-credit-card"></i> Transactions</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <i class="fa fa-search"></i> <?php echo $this->lang->line( 'select_criteria' ); ?></h3>
                    </div>
                    <div class="box-body">
                        <div class="">
                            <div class="col-md-6">
                                <form role="form" action="<?php echo site_url( 'admin/transactions' ) ?>" method="get" class="form-horizontal">
                                    <?php echo $this->customlib->getCSRF(); ?>
                                    <div class="form-group">
                                        <div class="col-sm-6">
                                            <label><?php echo $this->lang->line( 'date_from' ); ?></label>
                                            <input id="datefrom" name="date_from" placeholder="" type="text" class="form-control date" value="<?php echo set_value( 'date_from', date( $this->customlib->getSchoolDateFormat(), now() ) ); ?>" readonly="readonly"/>
                                            <span class="text-danger"><?php echo form_error( 'class_id' ); ?></span>
                                        </div>
                                        <div class="col-sm-6">
                                            <label><?php echo $this->lang->line( 'date_to' ); ?></label>
                                            <input id="dateto" name="date_to" placeholder="" type="text" class="form-control date" value="<?php echo set_value( 'date_to', date( $this->customlib->getSchoolDateFormat(), now() ) ); ?>" readonly="readonly"/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button type="submit" name="search" value="search_filter" class="btn btn-primary btn-sm checkbox-toggle pull-right">
                                                <i class="fa fa-search"></i> <?php echo $this->lang->line( 'search' ); ?>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!--                            <div class="col-md-6">-->
                            <!--                                <form role="form" action="--><?php //echo site_url( 'admin/expense/expenseSearch' ) ?><!--" method="post" class="form-horizontal">-->
                            <!--                                    --><?php //echo $this->customlib->getCSRF(); ?>
                            <!--                                    <div class="form-group">-->
                            <!--                                        <div class="col-sm-12">-->
                            <!--                                            <label>--><?php //echo $this->lang->line( 'search' ); ?><!--</label>-->
                            <!--                                            <input type="text" value="--><?php //echo set_value( 'search_text', "" ); ?><!--" name="search_text" class="form-control" placeholder="Search by Expense">-->
                            <!--                                        </div>-->
                            <!--                                    </div>-->
                            <!--                                    <div class="form-group">-->
                            <!--                                        <div class="col-sm-12">-->
                            <!--                                            <button type="submit" name="search" value="search_full" class="btn btn-primary btn-sm checkbox-toggle pull-right">-->
                            <!--                                                <i class="fa fa-search"></i> --><?php //echo $this->lang->line( 'search' ); ?>
                            <!--                                            </button>-->
                            <!---->
                            <!--                                        </div>-->
                            <!--                                    </div>-->
                            <!--                                </form>-->
                            <!--                            </div>-->

                        </div>

                    </div>

                </div>
                <?php if ( isset( $transactions ) ) {
                    $total_collection = 0;
                    $total_expense = 0;
                    ?>
                    <div class="box box-info" id="exp">

                        <div class="box-header ptbnull">
                            <h3 class="box-title titlefix">
                                <i class="fa fa-money"></i> Transaction results</h3>
                        </div>
                        <div class="box-body table-responsive">

                            <table class="table     table-bordered table-hover example">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Transaction</th>
                                        <th>Collection</th>
                                        <th>Expense</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <?php
                                    if ( $transactions === false ) {
                                    ?>
                                <tfoot>
                                    <tr>
                                        <td colspan="4" class="text-danger text-center"><?php echo $this->lang->line( 'no_record_found' ); ?></td>

                                    </tr>
                                </tfoot>
                                <?php
                                } else {
                                    foreach ( $transactions as $transaction ) {
                                        $total_collection += intval( $transaction['transaction_in'] );
                                        $total_expense += intval( $transaction['transaction_out'] );
                                        ?>
                                        <tr>
                                            <td><?= $transaction['transaction_date'] ?></td>
                                            <td><?= $transaction['transaction_name'] ?></td>
                                            <td><?= $transaction['transaction_in'] ?></td>
                                            <td><?= $transaction['transaction_out'] ?></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>

                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td><b>Total:</b> <?= $total_collection ?></td>
                                    <td><b>Total:</b> <?= $total_expense ?></td>
                                </tr>

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

    } )
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
