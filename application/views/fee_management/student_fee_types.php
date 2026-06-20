<div class="content-wrapper" style="min-height: 946px;">

    <section class="content-header">
        <h1 class="pull-left">
            <i class="fa fa-money"></i> Addition fee types
        </h1>

        <div class="pull-right">
            <a href="<?php echo site_url( 'fee_management/fee_voucher' ) ?>" class="btn btn-primary btn-sm">
                <i class="fa fa-chevron-left"></i>
            </a>
        </div>

        <div class="clearfix"></div>
    </section>

    <section class="content">
        <div class="row">

            <div class="col-sm-4">

                <?php $this->general_library->err_msg(); ?>

                <div class="box box-primary">

                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-plus"></i> Fee type</h3>
                    </div>

                    <div class="box-body">

                        <form action="<?= site_url( 'fee_management/student_fee_types_add' ) ?>" method="post">
                            <div class="form-group">
                                <label>Fee name</label>
                                <input class="form-control" type="text" name="fee_name" value="<?= set_value( 'fee_name' ) ?>" placeholder="i.e. Admission fee" required>
                            </div>

                            <div class="form-group">
                                <label>Fee amount</label>
                                <input type="number" class="form-control" name="fee_amount" value="<?= set_value( 'fee_amount', 0 ) ?>" required>
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
                        <h3 class="box-title"><i class="fa fa-money"></i> Fee types</h3>
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
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Fee name</th>
                                            <th>Fee amount</th>
                                               <?php if ($permission->delete_fee == 1) {	?>
                                            <th>Action</th>
                                               <?php }?>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        foreach ($student_fee_types as $student_fee_type){
                                            ?>
                                            <tr>
                                                <td><?= $student_fee_type['name'] ?></td>
                                                <td><?= $student_fee_type['amount'] ?></td>
                                                
                                                 
                                                  <?php if ($permission->delete_fee == 1) {	?>
                                                <td><a href="<?= site_url('fee_management/student_fee_types_delete/' . $student_fee_type['id']) ?>" onclick="return confirm('Are you sure you want to delete this fee type?');"><i class="fa fa-trash"></i> Delete</a></td>
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