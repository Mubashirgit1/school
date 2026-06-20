<?php $admind = $this->session->userdata( 'admin' );
$this->load->helper('menu_helper');

$permission = admin_permission($admind['id']);
?>

<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
    <div class="box box-primary" style="margin-bottom: 0px;">
    <div class="box-header with-border" >
     
        <h4 class="pull-left">
            <?= $title ?>
        </h4>

        <div class="pull-right">
        <?php if($permission->daily_filter == 1){?>
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
            <?php }?>
        </div>

        <div class="clearfix"></div>
</div>
</div>

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
                        <a href="<?= site_url( 'admin/expense/expenseSearch' ) ?>" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-th-list"></i></a>
                        
                        
                            <a href="<?= site_url( 'transactions/daily_net' ) . '?date_from=' . ( $date_from !== null ? date( 'm/d/Y', strtotime( $date_from ) ) : date( 'm/d/Y', now() ) ) . '&date_to=' . ( $date_to !== null ? date( 'm/d/Y', strtotime( $date_to ) ) : date( 'm/d/Y', now() ) ) ?>" class="btn btn-primary btn-sm">Net Profit</a>
                        </div>
                    </div>
                    <div class="box-body no-padding">

                        <?php if ( $transactions !== false ): ?>

                            <div class="row">
                                <?php if($permission->daily_left == 1){?>
                                <div class="col-sm-6">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover  example2">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Revenue</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ( $transactions as $transaction ): ?>
                                                    <?php if ( $transaction['type'] == 'in' ): ?>
                                                        <tr>
                                                            <td>
                                                     <a href="<?= site_url( $transaction['link'] ) ?>" style="color: #333;"><?= $transaction['name'] ?></a>
                                                            </td>
                                                            <td>
                                                                Rs. <?= number_format( $transaction['amount'], 0, '', ',' ) ?>
                                                            </td>
                                                        </tr>
                                                    <?php endif; ?>
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
                                                          <a style="color:#666666;" href="<?= site_url( 'student/search?fee_status=undue' ) ?>">  Advance Fee Adjustment </a>
                                                        </td>
                                                        <td>Rs. 
                                                            <?= number_format($advance_fee) ?>
                                                        </td>
                                                    </tr>
                                                <?php endif ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Total</th>
                                                    <th>Rs. 
                                                        <?php
                                                            $total_payments = $advance_fee + $total->in;
                                                            echo number_format($total_payments , 0, '', ',' );
															
                                                        ?>
                                                    </th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                                <?php }?>
                                <?php 
                                    if($permission->daily_right == 1){?>
                                <div class="col-sm-6">

                                    <div class="table-responsive">
                                        <table class="table   table-hover   table-bordered example">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Payments</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ( $transactions as $transaction ): ?>
                                                    <?php if ( $transaction['type'] == 'out' ): ?>
                                                        <tr>
                                                            <td class="text-left">
                                                            <div class="dropdown">
                                                                <a href="<?= site_url( $transaction['link'] ) ?>" style="color: #333;"><?= $transaction['name'] ?></a>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                Rs. <?= number_format( $transaction['amount'], 0, '', ',' ) ?>
                                                            </td>
                                                        </tr>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>Total</th>
                                                    <th>Rs. <?= number_format( $total->out, 0, '', ',' ); ?></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>

                                </div>
                                <?php }?>
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