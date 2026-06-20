<?php $currency_symbol = $this->customlib->getSchoolCurrencyFormat(); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<?php
    $admind = $this->session->userdata( 'admin' );
    $this->load->helper('menu_helper');
    $permission = admin_permission($admind['id']);
    $this->load->view('layout/expense_link'); ?>
    <section class="content-header">
    <div class="box box-primary" style="margin-bottom: 0px;">  
      <div class="box-header with-border" style="padding: 20px;">
            <form role="form" action="<?php echo site_url( 'admin/teacher/create' ) ?>" method="get" class="form-horizontal">
                <div class="row">                        
                    <div class="col-sm-6 col-md-3"><h3> <?php echo $this->lang->line('expenses'); ?> <small><?php echo $this->lang->line('student_fee'); ?></small>  </h3></div>
                    <div class="col-sm-1 pull-right" > </div>
                            
                </div>
            </form>    
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
                                <input id="date" name="date" placeholder="" type="text" class="form-control"  value="<?php echo set_value('date'); ?>" readonly />
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
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive mailbox-messages">
                            <table class="table table-hover     table-bordered example">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('name'); ?></th>
                                        <th><?php echo $this->lang->line('date'); ?></th>
                                        <th><?php echo $this->lang->line('expense_head'); ?></th>
                                        <th><?php echo $this->lang->line('amount'); ?></th>
                                        <th class="text-right"><?php echo $this->lang->line('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if (empty($expenselist)) {
                                    } else {                                    
                                        foreach ($expenselist as $expense) { ?>
                                            <tr>
                                                <td class="mailbox-name">
                                                    <a href="#" data-toggle="popover" class="detail_popover"><?php echo $expense['name'] ?></a>
                                                    <div class="fee_detail_popover" style="display: none">
                                                        <?php if ($expense['note'] == "") { ?>
                                                            <p class="text text-danger"><?php echo $this->lang->line('no_description'); ?></p>
                                                        <?php } else { ?>
                                                            <p class="text text-info"><?php echo $expense['note']; ?></p>
                                                        <?php } ?>
                                                    </div>
                                                </td>
                                                <td class="mailbox-name"><?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($expense['date'])) ?></td>
                                                <td class="mailbox-name"><?php echo $expense['exp_category'] ?></td>
                                                <td class="mailbox-name"><?php echo ($currency_symbol . $expense['amount']); ?></td>
                                                <td class="mailbox-date pull-right">
                                                    <?php 
                                                    $current_date = date("Y-m-d", now());
                                                    $date_year =$expense['created_at'];
                                                    $payment_date = date('Y-m-d', strtotime($date_year));
                                                    if(($payment_date == $current_date &&  $permission->daily_delete  == 1 ) ||  $permission->payment_delete == 1){ ?>
                                                        <a href="<?php echo base_url(); ?>admin/expense/delete/<?php echo $expense['id'] ?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('Are you sure you want to delete this item?');">
                                                            <i class="fa fa-remove"></i>
                                                        </a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <?php                                         
                                        }
                                    } ?>
                                </tbody>
                            </table><!-- /.table -->
                        </div><!-- /.mail-box-messages -->
                    </div><!-- /.box-body -->
                </div>
            </div><!--/.col (left) -->
        </div>
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