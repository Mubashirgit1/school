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
                        <h3 class="box-title"><i class="fa fa-envelope"></i> <?php echo $this->lang->line('email_setting'); ?></h3>
                    </div>   
                    <form id="form1" action="<?php echo base_url() ?>emailconfig/update"   name="employeeform" class="form-horizontal form-label-left" method="post" accept-charset="utf-8">
                        <input id="id"  type="hidden"  name="id" value="<?php echo set_value('id', $emaillist['id']); ?>" />
                        <div class="box-body">
                            <?php if ($this->session->flashdata('msg')) { ?>
                                <?php echo $this->session->flashdata('msg') ?>
                            <?php } ?>   
                            <?php echo $this->customlib->getCSRF(); ?>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="exampleInputEmail1">
                                    <?php echo $this->lang->line('email_engine'); ?>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="name" name="email_type" placeholder="" type="text" class="form-control col-md-7 col-xs-12" value="<?php echo set_value('email_type', $emaillist['email_type']); ?>" disabled />
                                    <span class="text-danger"><?php echo form_error('email_type'); ?></span>
                                </div>
                            </div>                            
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="exampleInputEmail1">
                                    <?php echo $this->lang->line('smtp_username'); ?>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="name" name="smtp_username" placeholder="" type="text" class="form-control col-md-7 col-xs-12" value="<?php echo set_value('smtp_username', $emaillist['smtp_username']); ?>" />
                                    <span class="text-danger"><?php echo form_error('smtp_username'); ?></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="exampleInputEmail1">
                                    <?php echo $this->lang->line('smtp_password'); ?>
                                </label><div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="name" name="smtp_password" placeholder="" type="text" class="form-control col-md-7 col-xs-12"  value="<?php echo set_value('smtp_password', $emaillist['smtp_password']); ?>" />
                                    <span class="text-danger"><?php echo form_error('smtp_password'); ?></span>
                                </div></div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="exampleInputEmail1">
                                    <?php echo $this->lang->line('smtp_server'); ?>
                                </label><div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="name" name="smtp_server" placeholder="" type="text" class="form-control col-md-7 col-xs-12"  value="<?php echo set_value('smtp_server', $emaillist['smtp_server']); ?>" disabled />
                                    <span class="text-danger"><?php echo form_error('smtp_server'); ?></span>
                                </div>  </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="exampleInputEmail1">
                                    <?php echo $this->lang->line('smtp_port'); ?>
                                </label><div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="name" name="smtp_port" placeholder="" type="text" class="form-control col-md-7 col-xs-12"  value="<?php echo set_value('smtp_port', $emaillist['smtp_port']); ?>" disabled />
                                    <span class="text-danger"><?php echo form_error('smtp_port'); ?></span>
                                </div></div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="exampleInputEmail1">
                                    <?php echo $this->lang->line('smtp_security'); ?>
                                </label><div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="name" name="smtp_security" placeholder="" type="text" class="form-control col-md-7 col-xs-12"  value="<?php echo set_value('smtp_security', $emaillist['ssl_tls']); ?>" disabled />
                                    <span class="text-danger"><?php echo form_error('smtp_security'); ?></span>
                                </div></div>                            
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
