<div class="content-wrapper" style="min-height: 946px;">
<?php  $this->load->view('layout/teacher_link'); ?> 
 <?php $this->general_library->err_msg(); ?>
    <section class="content-header">
        <h1 class="pull-left">
        </h1>

        <div class="pull-right">
          
        </div>

        <div class="clearfix"></div>
    </section>

    <section class="content">
        <div class="row">

            <div class="col-sm-4">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-plus"></i> Add New Incentives Heads</h3>
                    </div>

                    <div class="box-body">

                        <form action="<?= site_url( 'admin/teacher/teacher_incentives_add' ) ?>" method="post">
                        
                            <div class="form-group">
                                <label>Incentive name</label>
                                <input class="form-control" type="text" name="incentive" value="<?= set_value( 'incentive' ) ?>" placeholder="i.e. Bonus" required>
                            </div>

                            <div class="form-group">
                                <label>Incentive amount</label>
                                <input type="number" class="form-control" name="incentive_amount" value="<?= set_value( 'incentive_amount', 0 ) ?>" required>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary pull-right">Add</button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>

            <div class="col-sm-8">

                <div class="box box-primary">

                    <div class="box-header with-border">
                        <h3 class="box-title">All Incentive Heads</h3>
                    </div>

                    <div class="box-body">
                            <?php $admind = $this->session->userdata( 'admin' );
                            $this->load->helper('menu_helper');
                            $permission = admin_permission($admind['id']);

                            ?>
                        <?php
                        if ( $student_fee_types === false ) {
                            echo '<h3 class="text-center text-danger"></h3>';
                        } else {
                            ?>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover ">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Amount</th>
                                               <?php if ($permission->delete_fee == 1) {	?>
                                            <th>Action</th>
                                               <?php }?>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        foreach ($incentives as $incentive){
                                            ?>
                                            <tr>
                                                <td><?= $incentive['name'] ?></td>
                                                <td><?= $incentive['amount'] ?></td>
                                                
                                                 
                                                  <?php if ($permission->delete_fee == 1) {	?>
                                                <td><a href="<?= site_url('admin/teacher/teacher_incentive_delete/' . $incentive['id']) ?>" onclick="return confirm('Are you sure you want to delete this fee type?');"><i class="fa fa-trash"></i> Delete</a></td>
                                                <?php }?>
                                                
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php
                        }
                        ?>

                    </div>

                </div>

            </div>

        </div>
    </section>


    

    <section class="content">
        <div class="row">

            <div class="col-sm-4">

             

                <div class="box box-primary">

                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-minus"></i> Add New Deductions Heads</h3>
                    </div>

                    <div class="box-body">

                        <form action="<?= site_url( 'admin/teacher/teacher_deduction_add' ) ?>" method="post">
                        
                            <div class="form-group">
                                <label>Deduction name</label>
                                <input class="form-control" type="text" name="deduction" value="<?= set_value( 'deduction' ) ?>" placeholder="i.e. Absent" required>
                            </div>

                            <div class="form-group">
                                <label>Deduction amount</label>
                                <input type="number" class="form-control" name="deduction_amount" value="<?= set_value( 'deduction_amount', 0 ) ?>" required>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary pull-right">Add</button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>

            <div class="col-sm-8">

                <div class="box box-primary">

                    <div class="box-header with-border">
                        <h3 class="box-title"> All Deduction Heads</h3>
                    </div>

                    <div class="box-body">
                        <?php
                        if ( $student_fee_types === false ) {
                            echo '<h3 class="text-center text-danger"></h3>';
                        } else {
                            ?>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Amount</th>
                                               <?php if ($permission->delete_fee == 1) {	?>
                                            <th>Action</th>
                                               <?php }?>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        foreach ($deductions as $deduction){
                                            ?>
                                            <tr>
                                                <td><?= $deduction['name'] ?></td>
                                                <td><?= $deduction['amount'] ?></td>
                                                
                                                 
                                                  <?php if ($permission->delete_fee == 1) {	?>
                                                <td><a href="<?= site_url('admin/teacher/teacher_incentive_delete/' . $deduction['id']) ?>" onclick="return confirm('Are you sure you want to delete this fee type?');"><i class="fa fa-trash"></i> Delete</a></td>
                                                <?php }?>
                                                
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php
                        }
                        ?>

                    </div>

                </div>

            </div>

        </div>
    </section>


</div>