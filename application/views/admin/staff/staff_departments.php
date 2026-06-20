<div class="content-wrapper" style="min-height: 946px;">

    <section class="content-header">
        <h1>
            <i class="fa fa-mortar-board"></i> Staff Management
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12 col-sm-4">

                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add staff details</h3>
                    </div>

                    <div class="box-body">

                        <?php $this->general_library->err_msg(); ?>

                        <form action="<?= site_url( 'admin/staff/staff_departments_process' ) ?>" method="post">

                            <div class="form-group">
                                <label>Deparment Name</label>
                                <input type="text" class="form-control" name="dep_name" value="<?= set_value( 'dep_name' ) ?>">
                            </div>

                            <button type="submit" class="btn btn-primary pull-right">Add</button>

                        </form>

                    </div>
                </div>

            </div>

            <div class="col-xs-12 col-sm-8">

                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Department List</h3>
                    </div>

                    <div class="box-body">

                        <div class="table-responsive">
                            <table class="table table-bordered     example">
                                <thead>
                                    <tr>
                                        <th>Department Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    if ( $staff_deps !== false ):
                                        foreach ( $staff_deps as $staff_dep ):
                                            ?>
                                            <tr>
                                                <td><?= ucwords( strtolower( $staff_dep['name'] ) ) ?></td>
                                                <td><a href="<?= site_url('admin/staff/staff_departments_delete/' . $staff_dep['id']) ?>" style="color: #333;" onclick="return confirm('Do you really want to delete this?')"><i class="fa fa-trash"></i></a></td>
                                            </tr>
                                            <?php
                                        endforeach;
                                    endif;
                                    ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

</div>