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
    <div class="row">
                        <div class="col-md-4">
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    Create Account
                                </div>
                                <form id="form1" action="<?php echo site_url( 'transactions/credit_process' ) ?>" id="employeeform" name="employeeform" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                                    <div class="box-body">
                                        <?php if ( $this->session->flashdata( 'msg' ) ) { ?>
                                            <div class="alert alert-success" style='display: inline-block;'>    <?php echo $this->session->flashdata( 'msg' ) ?>
                                            </div>
                                        <?php } ?>
                                        <?php echo $this->customlib->getCSRF(); ?>


                                        <div class="form-group">
                                            <label>Account Name</label>
                                            <input type="text" id="message_title" class="form-control" required name="account_name">
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputFile">Assets/Liabilties</label>

                                            <select class="form-control" required name="assets">
                                                <option value=""><?php echo $this->lang->line( 'select' ); ?></option>                                                 <option value="assets">Assets</option>                                                            <option value="liabilties">Liabilties</option>
                                                <option value="other">Others</option>

                                            </select>

                                        </div>

                                        <div class="form-group">
                                            <label>Opening Balance</label>
                                            <input class="form-control" type="number" name="opening_balance" required value="" style="padding: 0px 5px 0px 12px;" >
                                        </div>



                                        <div class="form-group">
                                            <label>Date Of Account</label>
                                            <input type="text" id="credit_date" class="form-control _date" name="account_date" value="<?= set_value( 'date', date( 'm/d/Y', now() ) ) ?>" readonly>
                                        </div>


                                        <div class="box-footer">
                                            <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line( 'save' ); ?> Account</button>
                                        </div>

                                    </div>

                                </form>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="box box-primary" id="tachelist">
                                <div class="box-header ptbnull">
                                    <h3 class="box-title titlefix">Account List</h3>
                                </div>


                                <div class="box-body">
                                    <div class="mailbox-controls">
                                    </div>
                                    <div class="table-responsive mailbox-messages">
                                        <table class="table     table-bordered table-hover example2">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Account Name</th>
                                                <th>Opening Balance</th>
                                                <th>Created Date</th>
                                                <th>Action</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $count = 1;
                                            foreach ( $account as $acc ) {
                                                ?>
                                                <tr>
                                                    <td class="mailbox-name"> <?= $acc['id'] ?></td>
                                                    <td class="mailbox-name">
                                                        <a href="<?php echo base_url(); ?>transactions/view_transaction/<?php echo $acc['id']; ?>"  > <?= $acc['name'] ?>
                                                        </a>
                                                    </td>
                                                    <td class="mailbox-name"> <?= number_format($acc['opening_account']) ?></td>
                                                    <td class="mailbox-name"><?= date('d-M-Y',strtotime($acc['date'])) ?> </td>
                                                    <td class="mailbox-date pull-right no-print">
                                                        <?php /*?>  <a href="<?php echo base_url(); ?>student/view_message/<?php echo $message['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line( 'show' ); ?>">
                                                    <i class="fa fa-reorder"></i>
                                                </a><?php */?>

                                                        <a href="<?php echo base_url(); ?>transactions/delete_account/<?php echo $acc['id'] ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="<?php echo $this->lang->line( 'delete' ); ?>" onclick="return confirm('Are you sure you want to delete this item?')" ;>
                                                            <i class="fa fa-remove"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                            $count++;

                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
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



