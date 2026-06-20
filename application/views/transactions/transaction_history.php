<style type="text/css">
    @media print {
        .no-print, .no-print * {
            display: none !important;
        }
    }
</style>


<div class="content-wrapper" style="min-height: 946px;">
<?php  $this->load->view('layout/bank_link'); ?>
    <section class="content-header">
        <div class="box box-primary" >
            <div class="box-header with-border" style="">

                <h4 class="pull-left">
                    <?= $title ?>
                </h4>

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
            </div>
        </div>
    </section>
    <div class="col-md-12">
    <div class="tab-content">
    <div class="row">
                    <div class="col-md-12">
                        <div class="box box-primary">
                            <div class="box-header ptbnull">
                                <h3 class="box-title titlefix">Account Wise Transactions Summary</h3>
                            </div>

                            <div class="box-header ptbnull">
                                <h3 class="box-title titlefix"></h3>
                            </div>
                            <div class="box-body">
                                <div class="table-responsive mailbox-messages">
                                    <table class="table     table-bordered table-hover example3">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Debit Balance</th>
                                            <th>Credit Balance</th>
                                            <th>Balance</th>


                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $count = 1;
                                        
                                        foreach ( $debit_transfer as $debit ) {
                                            ?>
                                            <tr>
                                                <td class="mailbox-name"> <?= $debit['id'] ?></td>
                                                <td class="mailbox-name">


                                                    <a href="<?php echo base_url(); ?>transactions/view_transaction/<?php echo $debit['id']; ?>"  > <?= $debit['name'] ?>
                                                    </a>

                                                </td>
                                                <?php  $total_debit = 0;
                                                foreach($debit['debit'] as $debit2){

                                                    $total_debit   += $debit2['amount'];

                                                }?>
                                                <?php
                                                $total_credit = 0;
                                                foreach($debit['credit'] as $credit){

                                                    $total_credit    += $credit['amount'];

                                                }?>

                                                <td class="mailbox-name"> <?= number_format($total_debit) ?></td>

                                                <td class="mailbox-name"> <?= number_format($total_credit) ?></td>


                                                <td class="mailbox-name"> <?= number_format($debit['opening_account']) ?></td>

                                            </tr>
                                            <?php
                                        }
                                        $count++;

                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mailbox-controls">
                                </div>

                            </div>
                        </div>
                    </div>

                </div>      
          
          
        </div>
        <div class="nav-tabs-custom">
          
           
        </div>

        <!-- Main content -->
        <section class="content">

        </section>
    </div>
</div>
<script type="text/javascript">
    $( document ).ready( function () {
        var date_format = '<?php echo $result = strtr( $this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',] ) ?>';
        $( '#transfer_date, #account_date' ).datepicker( {
            format: date_format,
            autoclose: true
        } );
        $( "#btnreset" ).click( function () {
            $( "#form1" )[0].reset();
        } );
        $( '.date' ).datepicker( {
            format: 'mm/dd/yyyy',
            autoclose: true
        } );
        $( "#submit" ).on('click', function () {
            var  debit  = $( "#debit" ).val();
            var credit  = $( "#credit" ).val();
            var amount  = $( "#amount" ).val();
            if(debit == credit){
                alert("Please Change Debit and Credit are same");
                return false;
            }
            var x = [];
            $.ajax( {
                type: "post",
                url: '<?php echo site_url( "transactions/check_account" ) ?>',
                dataType: 'JSON',
                data: { 'debit_id': debit,  },
                async: false,
                success: function ( data ) {
                    x.push(data)
                }
            });

            console.log(x);
            console.log(x[0]['opening_account']);

            if(parseInt(x[0]['opening_account']) <= parseInt(amount)  ){
                alert("your Account value Less then amount");
                return false;
            }else{

                return true;

            }

        } );

    } );



</script>

<script type="text/javascript">
    $( document ).ready( function () {


    });
</script>



