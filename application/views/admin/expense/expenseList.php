<?php $currency_symbol = $this->customlib->getSchoolCurrencyFormat(); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">


<?php 

$adminsess = $this->session->userdata( 'admin' );
$this->load->helper('menu_helper');
$permission = admin_permission($adminsess['id']);

$this->load->view('layout/expense_link'); ?>
    
<section class="content-header">
        <div class="box box-primary" style="margin-bottom: 0px;">
            <div class="box-header with-border" style="padding: 20px;">
                <div class="col-md-2">
                    <h3 style="margin-bottom:25px; margin-top:0px">
                        <?php echo $this->lang->line( 'expenses' ); ?>
                    </h3>
                </div>
                <div class="col-md-6">
                    <form role="form" action="<?php echo site_url( 'admin/expense' ) ?>" method="post" class="form-inline">
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
                    <form role="form" action="<?php echo site_url( 'admin/expense' ) ?>" method="post" class="form-inline">
                        <?php echo $this->customlib->getCSRF(); ?>
                        <div class="form-group">
                            <label><?php echo $this->lang->line( 'search' ); ?></label>
                            <input type="text" value="<?php echo set_value( 'head_name', "" ); ?>" name="head_name" class="form-control" placeholder="Search by Expense">
                        </div>
                        <button type="submit" name="search" value="search_filter" class="btn btn-primary btn-sm checkbox-toggle ">
                            <i class="fa fa-search"></i> <?php echo $this->lang->line( 'search' ); ?>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-4">
                <!-- Horizontal Form -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php //echo $title;  ?><?php echo $this->lang->line('add_expense'); ?></h3>
                    </div><!-- /.box-header -->
                    <form id="form1" action="<?php echo base_url() ?>admin/expense"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8">
                        <div class="box-body">
                            <?php if ($this->session->flashdata('msg')) { ?>
                                <?php echo $this->session->flashdata('msg') ?>
                            <?php } ?>
                            <?php
                            if (isset($error_message)) {
                                echo "<div class='alert alert-danger'>" . $error_message . "</div>";
                            }
                            ?>
                                    <?php echo $this->customlib->getCSRF(); ?>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('expense_head'); ?></label>
                                <select  id="exp_head_id" name="exp_head_id" class="form-control" >
                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                    <?php
                                    foreach ( $expheadlist as $exphead) {
                                        ?>
                                        <option value="<?php echo $exphead['id'] ?>"<?php
                                        if (set_value('exp_head_id') == $exphead['id']) {
                                            echo "selected =selected";
                                        }
                                        ?>><?php echo $exphead['exp_category'] ?></option>

                                        <?php
                                        $count++;
                                    }
                                    ?>
                                </select>
                                <span class="text-danger"><?php echo form_error('exp_head_id'); ?></span>
                            </div>
                             <?php $admind = $this->session->userdata( 'admin' );?>
                            <div class="form-group">
                                <input type="hidden" name="admin" value="<?= $admind['username'] ?>">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('name'); ?></label>
                                <input id="name" name="name" placeholder="" type="text" class="form-control"  value="<?php echo set_value('name'); ?>" />
                                <span class="text-danger"><?php echo form_error('name'); ?></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('date'); ?></label>
                                <input id="date" name="date" placeholder="" type="text" class="form-control"  value="<?php echo set_value( 'date_to', date( $this->customlib->getSchoolDateFormat(), ( !empty( $date_to ) ? strtotime( $date_to ) : now() ) ) ); ?>" readonly />
                                <span class="text-danger"><?php echo form_error('date'); ?></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('amount'); ?></label>
                                <input id="amount" name="amount_expense" placeholder="" type="text" class="form-control"  value="<?php echo set_value('amount_expense'); ?>" />
                                <span class="text-danger"><?php echo form_error('amount_expense'); ?></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('description'); ?></label>
                                <textarea class="form-control" id="description" name="description" placeholder="" rows="3" placeholder="Enter ..."><?php echo set_value('description'); ?></textarea>
                                <span class="text-danger"></span>
                            </div>
                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                        </div>
                    </form>
                </div>

            </div><!--/.col (right) -->
            <!-- left column -->
            <div class="col-md-8">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"><?php echo $this->lang->line('expense_list'); ?></h3>
                        <br>
                        <div class="box-tools pull-right">
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
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
                                if ( empty( $expenselist ) ) {
                                ?>
                             
                                <?php
                                } else {
                                    $count = 1;
                                    $grand_total = 0;
                                    foreach ( $expenselist as $key => $value ) {
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
                                            <?php }else{ ?>
                                                <td class="text-center">
                                                </td>
                                            <?php } ?>
                                        </tr>
                                        <?php
                                        $count++;
                                    }
                                    ?>
                                     </tbody>
                                    <tfoot>
                                    <tr >
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>Total</td>

                                        <td class="text-right">  <?php echo(number_format( $grand_total, 0, '', ',' ) ); ?></td>
                                        <td></td>
                                    </tr>
                                    </tfoot>
                                    <?php
                                }
                                ?>

                               
                            </table>
                    </div><!-- /.box-body -->
                </div>
            </div><!--/.col (left) -->
            <!-- right column -->

        </div>
        <div class="row">
            <!-- left column -->

            <!-- right column -->
            <div class="col-md-12">
             
            </div><!--/.col (right) -->
        </div>   <!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script type="text/javascript">
    $(document).ready(function () {
        var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';

        $('#date').datepicker({
            //  format: "dd-mm-yyyy",
            format: date_format,
            autoclose: true
        });

        $("#btnreset").click(function () {           
            $("#form1")[0].reset();
        });

    });

    $( document ).ready( function () {
        var date_format = '<?php echo $result = strtr( $this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',] ) ?>';
        $( ".date" ).datepicker( {
            // format: "dd-mm-yyyy",
            format: date_format,
            autoclose: true,
            todayHighlight: true

        } );
    } );

    $(document).ready(function () {
        $('.detail_popover').popover({
            placement: 'right',
            trigger: 'hover',
            container: 'body',
            html: true,
            content: function () {
                return $(this).closest('td').find('.fee_detail_popover').html();
            }
        });
    });
</script>