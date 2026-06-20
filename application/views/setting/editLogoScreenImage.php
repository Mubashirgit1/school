<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-gears"></i> <?php echo $this->lang->line('system_settings'); ?>
            <small><?php echo $this->lang->line('setting1'); ?></small></h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo 'Edit Login Screen Image'; ?></h3>
                        <div class="pull-right box-tools">
                        </div>
                    </div>
                    <form action="<?php echo site_url('schsettings/editLoginScreenImage/' . $id) ?>" id="employeeform"
                          name="employeeform" class="" method="post" accept-charset="utf-8"
                          enctype="multipart/form-data">
                        <div class="box-body">
                            <?php echo $this->customlib->getCSRF(); ?>
                            <div class="form-group">
                                <label for="exampleInputFile"><?php echo 'Select Image'; ?></label>
                                <input type='file' name='file' />
                                <span class="text-danger"><?php echo form_error('file'); ?></span>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit"
                                    class="btn btn-primary"><?php echo $this->lang->line('edit'); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>