<div class="content-wrapper" style="min-height: 946px;">
    <!-- <section class="content-header">
        <h1 class="pull-left">
            <i class="fa fa-line-chart"></i> <?= $title ?>
        </h1>
        <div class="clearfix"></div>
    </section> -->
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <?= $title ?>
                        </h3>
                        <div class="pull-right">
                            <form action="<?= current_url() ?>" method="get" class="form-inline">
                                <div class="form-group">
                                    <a href="javascript: history.back()" class="btn btn-primary btn-sm">
                                        <i class="fa fa-chevron-left"></i>
                                    </a>
                                </div>

                                <div class="form-group">
                                    <label>Attendance Date</label>
                                    <input type="text" class="form-control _date" name="attendance_date" value="<?= set_value( 'attendance_date', date( 'm/d/Y', strtotime( $attendance_date ) ) ) ?>" placeholder="Attendance date" readonly="readonly">
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-sm">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="box-body">

                        <?php if ( empty( $absent_students ) ): ?>
                            <p class="text-center text-danger">No students were found!</p>
                        <?php else: ?>
                            <div class="table-responsive">
                                <table class="table table-bordered table-stripped example">
                                    <thead>
                                        <tr>
                                            <th>Sr No</th>
                                            <th>Ad No</th>
                                            <th>Roll No</th>
                                            <th>Name</th>
                                            <th>Father Name</th>
                                            <th>Class</th>
                                            <th>Section</th>
                                            <th>Phone No.</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php foreach ( $absent_students as $key => $absent_student ): ?>
                                            <tr>
                                                <td><?= $key+1 ?></td>
                                                <td><?= $absent_student['admission_no'] ?></td>
                                                <td><?= $absent_student['roll_no'] ?></td>
                                                <td><?= $absent_student['firstname'] . ' ' . $absent_student['lastname'] ?></td>
                                                <td><?= $absent_student['father_name'] ?></td>
                                                <td><?= $absent_student['class']['class'] ?></td>
                                                <td><?= $absent_student['section']['section'] ?></td>
                                                <td><?= $absent_student['father_phone'] ?></td>
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