<link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
<script src="<?php echo base_url(); ?>backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-gears"></i> <?php echo $this->lang->line('system_settings'); ?>
        </h1>
    </section>   
    <section class="content">
        <div class="row">
            <div class="col-md-12">             
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-paypal"></i> <?php echo $this->lang->line('paypal_setting'); ?></h3>
                    </div>   
                    <form id="form1" action="<?php echo base_url() ?>admin/paymentsettings" name="employeeform" class="form-horizontal form-label-left" method="post" accept-charset="utf-8">
                        <input id="id"  type="hidden"  name="id" value="<?php echo set_value('id', $payment_setting->id); ?>" />
                        <div class="box-body">
                            <?php if ($this->session->flashdata('msg')) { ?>
                                <?php echo $this->session->flashdata('msg') ?>
                            <?php } ?>   
                            <?php echo $this->customlib->getCSRF(); ?>                        
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="exampleInputEmail1">
                                    <?php echo $this->lang->line('paypal_username'); ?>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="name" name="paypal_username" placeholder="" type="text" class="form-control col-md-7 col-xs-12" value="<?php echo set_value('paypal_username', $payment_setting->api_username); ?>" />
                                    <span class="text-danger"><?php echo form_error('paypal_username'); ?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="exampleInputEmail1">
                                    <?php echo $this->lang->line('paypal_password'); ?>
                                </label><div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="name" name="paypal_password" placeholder="" type="text" class="form-control col-md-7 col-xs-12"  value="<?php echo set_value('paypal_password', $payment_setting->api_password); ?>" />
                                    <span class="text-danger"><?php echo form_error('paypal_password'); ?></span>
                                </div></div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="exampleInputEmail1">
                                    <?php echo $this->lang->line('paypal_signature'); ?>
                                </label><div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="name" name="paypal_signature" placeholder="" type="text" class="form-control col-md-7 col-xs-12"  value="<?php echo set_value('paypal_signature', $payment_setting->api_signature); ?>" />
                                    <span class="text-danger"><?php echo form_error('paypal_signature'); ?></span>
                                </div>  </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="exampleInputEmail1">
                                    <?php echo $this->lang->line('paypal_email'); ?>
                                </label><div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="name" name="paypal_email" placeholder="" type="text" class="form-control col-md-7 col-xs-12"  value="<?php echo set_value('paypal_email', $payment_setting->api_email); ?>" />
                                    <span class="text-danger"><?php echo form_error('paypal_email'); ?></span>
                                </div></div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="exampleInputEmail1">
                                    <?php echo $this->lang->line('paypal_sandbox'); ?>
                                </label>&nbsp;&nbsp;<div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="btn-group" id="toggle_event_editing">
                                        <?php
                                        $cls_one = "";
                                        $cls_two = "";
                                        if (set_value('is_active', $payment_setting->is_active) == 'no') {
                                            $cls_one = "btn-info locked_active";
                                            $cls_two = "btn-default unlocked_inactive";
                                        } else {
                                            $cls_one = "btn-default unlocked_inactive";
                                            $cls_two = "btn-info unlocked_active";
                                        }
                                        ?>
                                        <button type="button" class="btn <?php echo $cls_one; ?>"><?php echo $this->lang->line('off'); ?></button>
                                        <button type="button" class="btn <?php echo $cls_two; ?>"><?php echo $this->lang->line('on'); ?></button>
                                    </div>
                                    <input type="hidden" id="is_active" name="is_active" value="<?php echo set_value('is_active', $payment_setting->is_active); ?>">
                                    <span class="text-danger"><?php echo form_error('is_active'); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button type="submit" class="btn btn-info pull-left"><?php echo $this->lang->line('save'); ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>           
        </div></section>
<div class="row">   
    <div class="col-md-12">
    </div>
</div>  

</div>
<script type="text/javascript">
    $(document).ready(function () {

        $('#toggle_event_editing button').click(function () {
            if ($('#is_active').val() == "no") {
                $('#is_active').val('yes');
            } else {
                $('#is_active').val('no');
            }
            $('#toggle_event_editing button').eq(0).toggleClass('locked_inactive locked_active btn-default btn-info');
            $('#toggle_event_editing button').eq(1).toggleClass('unlocked_inactive unlocked_active btn-info btn-default');
        });
    });

</script>
<script>
    $(function () {
        $("#compose-textarea").wysihtml5();
    });
</script>