<?php $currency_symbol = $this->customlib->getSchoolCurrencyFormat(); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<?php  $this->load->view('layout/inventory_link'); ?>
    <section class="content-header">
        <h1>
            <!-- <i class="fa fa-credit-card"></i>Issue Inventory Items</h1> -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-4">
                <!-- Horizontal Form -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Issue Inventory Item</h3>
                    </div><!-- /.box-header -->
                    <form id="form1" action="<?php echo base_url() ?>admin/inventoryItemIssue"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8">
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
                                <label for="exampleInputEmail1">Inventory Head</label>

                                <select  id="inv_head_id" name="inv_head_id" class="form-control" >
                                    <option value=""><?php echo $this->lang->line('select'); ?></option>
                                    <?php
                                    foreach ( $invheadlist as $invhead) {
                                        ?>
                                        <option value="<?php echo $invhead['id'] ?>"<?php
                                        if (set_value('inv_head_id') == $invhead['id']) {
                                            echo "selected =selected";
                                        }
                                        ?>><?php echo $invhead['inventory_title'] ?></option>

                                        <?php
                                        $count++;
                                    }
                                    ?>
                                </select>
                                <span class="text-danger"><?php echo form_error('inv_head_id'); ?></span>
                            </div>

                           <div class="form-group">
                                <label for="exampleInputEmail1">Quantity</label>
                                <input id="quantity" name="quantity" placeholder="" type="number" class="form-control"  value="<?php echo set_value('quantity'); ?>" />
                                <span class="text-danger"><?php echo form_error('quantity'); ?></span>
                            </div>

                            <!-- <div class="form-group">
                                <label for="exampleInputEmail1"><?php //echo $this->lang->line('amount'); ?></label>
                                <input id="amount" name="amount" placeholder="" type="text" class="form-control"  value="<?php //echo set_value('amount'); ?>" />
                                <span class="text-danger"><?php //echo form_error('amount'); ?></span>
                            </div> -->

                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-info pull-right">Issue Item</button>
                        </div>
                    </form>
                </div>

            </div><!--/.col (right) -->
            <!-- left column -->
            <div class="col-md-8">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix">Inventory Items List</h3>
                        <div class="box-tools pull-right">
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive mailbox-messages">
                            <table class="table table-hover     table-bordered example">
                                <thead>
                                    <tr>
                                        <th>Inventory Head</th>
                                        <th>Quantity</th>
                                        <th><?php echo $this->lang->line('amount'); ?></th>
                                        <th class="text-right"><?php echo $this->lang->line('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (empty($inventoryitemslist)) {
                                        ?>
                                       
                                        <?php
                                    } else {                                    
                                        foreach ($inventoryitemslist as $inventory) {                                       
                                            ?>
                                            <tr>
                                                <td class="mailbox-name">
                                                    <?php echo $inventory['inventory_title'] ?>
                                                </td>
                                                <td class="mailbox-name">
                                                    <?php echo $inventory['quantity'] ?>
                                                </td>
                                                <td class="mailbox-name"><?php echo ($currency_symbol . $inventory['amount']); ?>
                                                    
                                                </td>
                                          
                                                <td class="mailbox-date pull-right"">                                                 
                                                    <a href="<?php echo base_url(); ?>admin/inventoryItems/delete/<?php echo $inventory['id'] ?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('Are you sure you want to delete this item?');">
                                                        <i class="fa fa-remove"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php                                         
                                        }
                                    }
                                    ?>

                                </tbody>
                            </table><!-- /.table -->



                        </div><!-- /.mail-box-messages -->
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
</script>
<script>
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