<div class="content-wrapper"> 
    <section class="content-header">
        <h1>
            <i class="fa fa-gears"></i>
            System Setting <small>
            </small>        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo $title; ?></h3>
                    </div>
                    <form action="<?php echo site_url("smsconfig/edit/" . $id) ?>"  id="employeeform" name="employeeform" method="post" class="form-horizontal form-label-left" accept-charset="utf-8">
                        <div class="box-body">
                             <?php echo $this->customlib->getCSRF(); ?>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="exampleInputEmail1"><?php echo $this->lang->line('user_name'); ?></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="username" name="username" placeholder="" type="text" class="form-control col-md-7 col-xs-12"  value="<?php echo set_value('username', $sms['username']); ?>" />
                                    <span class="text-danger"><?php echo form_error('username'); ?></span>
                                </div></div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="exampleInputEmail1"><?php echo $this->lang->line('password'); ?></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="password" name="password" placeholder="" type="password" class="form-control col-md-7 col-xs-12"  value="<?php echo set_value('password', $sms['password']); ?>" />
                                    <span class="text-danger"><?php echo form_error('password'); ?></span>
                                </div> </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="exampleInputEmail1"><?php echo $this->lang->line('sms_gateway_url'); ?></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="url" name="url" placeholder="" type="text" class="form-control col-md-7 col-xs-12"  value="<?php echo set_value('url', $sms['url']); ?>" />
                                    <span class="text-danger"><?php echo form_error('url'); ?></span>
                                </div></div>
                        </div>
                        <div class="box-footer">
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                    <button type="submit" col class="btn btn-info pull-left"><?php echo $this->lang->line('save'); ?></button>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div> 
    </section>
</div>