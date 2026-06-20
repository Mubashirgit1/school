<div class="content-wrapper">
    <section class="content-header">
        <h1>Family Details</h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Family List</h3>
                    </div>

                    <div class="box-body">

                        <?php if ( $family_list === false ): ?>
                            <h3 class="text-center text-danger">No Record Found!</h3>
                        <?php else: ?>
                            <div class="table-responsive">
                                <table class="table     table-bordered example">
                                    <thead>
                                        <tr>
                                            <th>Father's name</th>
                                            <th>Father's phone number</th>
                                            <th>Father's occupation</th>
                                            <th>Father's CNIC</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ( $family_list as $value ): ?>
                                            <tr>
                                                <td><?= $value['father_name'] ?></td>
                                                <td><?= $value['father_phone'] ?></td>
                                                <td><?= $value['father_occupation'] ?></td>
                                                <td><?= $value['father_cnic'] ?></td>
                                                <td>
                                                    <?php if ( !empty( $value['father_phone'] ) ): ?>
                                                        <a href="<?= site_url( 'family/children_summary/' . $value['id'] ) ?>">Children Details</a>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>