<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1 class="pull-left">
        <?= $title ?>
        </h1>

        <div class="pull-right">
            <form action="<?= current_url() ?>" method="get" class="form-inline">
                <div class="form-group">
                    <label>Date From</label>
                    <input type="text" class="form-control date" name="date_from" value="<?= ( $date_from !== null ? date( 'm/d/Y', strtotime( $date_from ) ) : ( $date_to === null ? date( 'm/d/Y', strtotime( $date ) ) : "" ) ) ?>" readonly>
                </div>

                <div class="form-group">
                    <label>Date To</label>
                    <input type="text" class="form-control date" name="date_to" value="<?= ( $date_to !== null ? date( 'm/d/Y', strtotime( $date_to ) ) : ( $date_from === null ? date( 'm/d/Y', strtotime( $date ) ) : "" ) ) ?>" readonly>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-sm pull-right">Search</button>
                </div>
            </form>
        </div>

        <div class="clearfix"></div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            Transactions
                            <small>(<?= ( $date_from !== null && $date_to !== null ? date( 'd/M/Y', strtotime( $date_from ) ) . ' - ' . date( 'd/M/Y', strtotime( $date_to ) ) : date( 'd/M/Y', strtotime( $date ) ) ) ?>)</small>
                        </h3>

                        <div class="pull-right">
                            <a href="#" class="btn btn-primary btn-sm back_btn">
                                <i class="fa fa-chevron-left"></i>
                            </a>
                        </div>
                    </div>
                    <div class="box-body no-padding">

                        <?php if ( $transactions !== false ): ?>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="table-responsive">
                                        <table class="table     table-bordered example2">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Revenue</th>
                                                    <th>Payment</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ( $transactions as $transaction ): ?>
                                                    <tr>
                                                        <td>
                                                            <a href="<?= site_url( $transaction['link'] ) ?>" style="color: #333;"><?= $transaction['name'] ?></a>
                                                        </td>
                                                        <td>
                                                            <?= ( $transaction['type'] == 'in' ? 'Rs. ' . number_format( $transaction['amount'], 0, '', ',' ) : '' ) ?>
                                                        </td>
                                                        <td>
                                                            <?= ( $transaction['type'] == 'out' ? 'Rs. ' . number_format( $transaction['amount'], 0, '', ',' ) : '' ) ?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                <?php 
                                                $advance_fee = 0;
                                                foreach ($advance_payments as  $value) {
                                                    $advance_fee += $value['advance_fee'];
                                                }
                                                ?>
                                                <?php if ($advance_fee > 0): ?>
                                                    <tr>
                                                        <td>
                                                            Advance Fee Adjustment
                                                        </td>
                                                        <td>Rs. 
                                                            <?= number_format($advance_fee) ?>
                                                        </td>
                                                        <td>
                                                        </td>
                                                    </tr>
                                                <?php endif ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Total</th>
                                                    <th>Rs. <?php
                                                            $total_payments = $advance_fee + $total->in; 
                                                            echo number_format( $total_payments, 0, '', ',' ) 

                                                        ?></th>
                                                    <th>Rs. <?= number_format( $total->out, 0, '', ',' ) ?></th>
                                                </tr>
                                                <tr>
                                                    <th colspan="2">Net Profit</th>
                                                    <th class="text-right">Rs. <?= number_format( $total_payments - $total->out, 0, '', ',' ) ?></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        <?php else: ?>
                            <h3 class="text-center text-danger">No transaction found!</h3>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script type="text/javascript">
    jQuery( function ( $ ) {
        var date_format = 'mm/dd/yyyy';
        $( '.date' ).datepicker( {
            format: date_format,
            autoclose: true
        } );
    } );
</script>