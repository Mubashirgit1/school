<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1>
            <i class="fa fa-gears"></i> <?php echo $this->lang->line('system_settings'); ?><small><?php echo $this->lang->line('setting1'); ?></small>        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">             
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo $title; ?></h3>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <div class="box-body no-padding">
                        <div class="mailbox-controls">                         
                            <a href="<?php echo base_url(); ?>smsconfig/create" class="btn btn-primary btn-sm"  data-toggle="tooltip" title="<?php echo $this->lang->line('add_class'); ?>">
                                <i class="fa fa-plus"></i> <?php echo $this->lang->line('add_new_sms_configuration'); ?>
                            </a>
                            <div class="pull-right">
                            </div>
                        </div>
                        <div class="table-responsive mailbox-messages">
                            <table class="table table-hover    ">
                                <tbody>
                                    <tr>
                                        <td><?php echo $this->lang->line('user_name'); ?></td>
                                        <td class="mailbox-name"> <?php echo $sms['username'] ?></td>
                                    </tr><tr>
                                        <td><?php echo $this->lang->line('password'); ?></td>
                                        <td class="mailbox-name">
                                            <?php echo $sms['password'] ?>
                                    <tr>
                                    <tr>
                                        <td><?php echo $this->lang->line('sms_gateway_url'); ?></td>
                                        </td>
                                        <td class="mailbox-name">
                                            <?php echo $sms['url'] ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="mailbox-controls">                        
                            <div class="pull-right">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </section>
</div>