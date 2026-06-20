<style type="text/css">
    @media print
    {
        .no-print, .no-print *
        {
            display: none !important;
        }
    }
</style>
<div class="content-wrapper" style="min-height: 946px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-gears"></i> <?php echo $this->lang->line('system_settings'); ?></h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-4">
                <!-- Horizontal Form -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo $this->lang->line('add_admin_user'); ?></h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form id="form1" action="<?php echo site_url('admin/adminuser/create') ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8">
                        <div class="box-body">                            
                            <?php if ($this->session->flashdata('msg')) { ?>
                                <?php echo $this->session->flashdata('msg') ?>
                            <?php } ?>
                                    <?php echo $this->customlib->getCSRF(); ?>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('admin_name'); ?></label>
                                <input id="username" name="username" placeholder="" type="text" class="form-control"  value="<?php echo set_value('username'); ?>" />
                                <span class="text-danger"><?php echo form_error('username'); ?></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('admin_email'); ?></label>
                                <input id="email" name="email" placeholder="" type="text" class="form-control"  value="<?php echo set_value('email'); ?>" />
                                <span class="text-danger"><?php echo form_error('email'); ?></span>
                            </div>
                            <div class="form-group">
                                <label for="role">Select Role</label>
                                <select class="form-control" name="role">
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>
                                    <option value="main_admin">Main Admin</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('admin_password'); ?></label>
                                <input id="password" name="password" placeholder="" type="password" class="form-control"  value="<?php echo set_value('username'); ?>" />
                                <span class="text-danger"><?php echo form_error('password'); ?></span>
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
                <div class="box box-primary" id="exphead">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"><?php echo $this->lang->line('admin_users'); ?></h3>
                    </div><!-- /.box-header -->
                    <div class="box-body  ">
                        <div class="table-responsive mailbox-messages">
                            <table class="table     table-bordered table-hover example">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('admin_name'); ?></th>
										<th><?php echo $this->lang->line('admin_email'); ?></th>
                                        <th>Role</th>
                                        <?php if ($this->customlib->getAdminSessionUserRole() == 'admin_main') {
                                                ?>
                                                <th>Permission</th>
                                        <?php }  ?>
                                        <th class="text-right no-print"><?php echo $this->lang->line('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (empty($adminlist)) {
                                        ?>
                                        
                                        <?php
                                    } else {
                                        $count = 1;
                                        foreach ($adminlist as $admin) {
                                            ?>
                                            <tr>                                               
                                                <td class="mailbox-name">
                                                    <?php echo $admin['username'] ?>
                                                </td>
												<td class="mailbox-name">
                                                    <?php echo $admin['email'] ?>
                                                </td>
                                                <td class="mailbox-name">
                                                    <?php echo $admin['role'] ?>
                                                </td>

                                                <td>


                                                    <?php if ($this->customlib->getAdminSessionUserRole() == 'admin_main') { ?>

                                                    <a href="<?php echo base_url(); ?>admin/adminuser/userpermission/<?php echo $admin['admin_id'] ?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="Permission" >
                                                        <i class="fa fa-user"></i>
                                                    </a>
                                                        <?php
                                                    }
                                                    ?>

                                                </td>
                                                <td class="mailbox-date pull-right no-print">
												    <a href="<?php echo base_url(); ?>admin/adminuser/delete/<?php echo $admin['id'] ?>"class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('Are you sure you want to delete this item?');">
                                                        <i class="fa fa-remove"></i>
                                                    </a>
												</td>
                                            </tr>
                                            <?php
                                        }
                                        $count++;
                                    }
                                    ?>

                                </tbody>
                            </table><!-- /.table -->
                        </div><!-- /.mail-box-messages -->
                    </div><!-- /.box-body -->
                </div>
            </div>

            <!-- right column -->

        </div>   <!-- /.row -->
    </section><!-- /.content -->
</div>