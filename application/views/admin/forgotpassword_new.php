<div class="new_layout_form">

    <div class="container" style="height: 100%;">

        <div class="row" style="height: 100%;">

            <div class="col-sm-4 col-sm-offset-4" style="height: 100%;">

                <div class="new_form_container vertical_center_content">

                    <h3>Forgot Password</h3>

                    <?php
                    if (isset($error_message)) {
                        echo "<div class='alert alert-danger'>" . $error_message . "</div>";
                    }
                    ?>
                    <form action="<?php echo site_url('site/forgotpassword') ?>" method="post">
                        <?php echo $this->customlib->getCSRF(); ?>
                        <div class="form-group">
                            <label class="sr-only" for="form-username">Username</label>
                            <input type="text" name="username" placeholder="<?php echo $this->lang->line('username'); ?>" class="form-username form-control" id="form-username">
                            <span class="text-danger"><?php echo form_error('username'); ?></span>
                        </div>
                        <button type="submit" class="btn btn-block btn-default"><?php echo $this->lang->line('submit'); ?></button>
                    </form>
                    <a href="<?php echo site_url('site/login') ?>" class="forgot pull-right"><i class="fa fa-key"></i> <?php echo $this->lang->line('admin_login'); ?></a>

                </div>

            </div>

        </div>

    </div>

</div>