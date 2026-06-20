<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1>
            <i class="fa fa-user-plus"></i> <?= $title ?>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <i class="fa fa-search"></i> Available Details
                        </h3>
                    </div>
                    <div class="box-body no-padding">
                        <?php if ( !empty( $classes ) ): ?>
                            <div class="table-responsive">
                                <table class="table     table-bordered example">
                                    <thead>
                                        <tr>
                                            <th>Class</th>
                                            <th>Male</th>
                                            <th>Female</th>
                                            <th>Total</th>
                                            <th>New</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ( $classes as $class ): ?>
                                            <tr>
                                                <td><?= $class['class'] ?></td>
                                                <td><?= $class['male'] ?></td>
                                                <td><?= $class['female'] ?></td>
                                                <td><?= $class['total'] ?></td>
                                                <td><?= $class['new_students'] ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Grand Total</th>
                                            <th><?= $total->male ?></th>
                                            <th><?= $total->female ?></th>
                                            <th><?= $total->total ?></th>
                                            <th><?= $total->new ?></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>