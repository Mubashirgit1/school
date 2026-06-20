<style type="text/css">
    @media print {
        .no-print, .no-print * {
            display: none !important;
        }
    }
</style>

<style type="text/css">
    .radio {
        padding-left: 20px;
    }

    .radio label {
        display: inline-block;
        vertical-align: middle;
        position: relative;
        padding-left: 5px;
    }

    .radio label::before {
        content: "";
        display: inline-block;
        position: absolute;
        width: 17px;
        height: 17px;
        left: 0;
        margin-left: -20px;
        border: 1px solid #cccccc;
        border-radius: 50%;
        background-color: #fff;
        -webkit-transition: border 0.15s ease-in-out;
        -o-transition: border 0.15s ease-in-out;
        transition: border 0.15s ease-in-out;
    }

    .radio label::after {
        display: inline-block;
        position: absolute;
        content: " ";
        width: 11px;
        height: 11px;
        left: 3px;
        top: 3px;
        margin-left: -20px;
        border-radius: 50%;
        background-color: #555555;
        -webkit-transform: scale(0, 0);
        -ms-transform: scale(0, 0);
        -o-transform: scale(0, 0);
        transform: scale(0, 0);
        -webkit-transition: -webkit-transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33);
        -moz-transition: -moz-transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33);
        -o-transition: -o-transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33);
        transition: transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33);
    }

    .radio input[type="radio"] {
        opacity: 0;
        z-index: 1;
    }

    .radio input[type="radio"]:focus + label::before {
        outline: thin dotted;
        outline: 5px auto -webkit-focus-ring-color;
        outline-offset: -2px;
    }

    .radio input[type="radio"]:checked + label::after {
        -webkit-transform: scale(1, 1);
        -ms-transform: scale(1, 1);
        -o-transform: scale(1, 1);
        transform: scale(1, 1);
    }

    .radio input[type="radio"]:disabled + label {
        opacity: 0.65;
    }

    .radio input[type="radio"]:disabled + label::before {
        cursor: not-allowed;
    }

    .radio.radio-inline {
        margin-top: 0;
    }

    .radio-primary input[type="radio"] + label::after {
        background-color: #337ab7;
    }

    .radio-primary input[type="radio"]:checked + label::before {
        border-color: #337ab7;
    }

    .radio-primary input[type="radio"]:checked + label::after {
        background-color: #337ab7;
    }

    .radio-danger input[type="radio"] + label::after {
        background-color: #d9534f;
    }

    .radio-danger input[type="radio"]:checked + label::before {
        border-color: #d9534f;
    }

    .radio-danger input[type="radio"]:checked + label::after {
        background-color: #d9534f;
    }

    .radio-info input[type="radio"] + label::after {
        background-color: #5bc0de;
    }

    .radio-info input[type="radio"]:checked + label::before {
        border-color: #5bc0de;
    }

    .radio-info input[type="radio"]:checked + label::after {
        background-color: #5bc0de;
    }
</style>

<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1>
            <i class="fa fa-mortar-board"></i> Staff Attendance
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">

                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> Attendance date</h3>
                    </div>
                    <form action="" method="get">
                        <div class="box-body">

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Attendance marked for</label>
                                        <input id="attendance_for" type="text" name="attendance_for" class="form-control" value="<?= $attendance_date ?>" placeholder="YYYY-MM-DD" readonly>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="box-footer">
                            <div class="row">
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-primary btn-sm pull-right checkbox-toggle">
                                        <i class="fa fa-search"></i> Search
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-md-12">

                <?php
                echo validation_errors( '<div class="alert alert-danger">', '</div>' );
                ?>

                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Staff List</h3>
                    </div>

                    <div class="box-body">

                        <?php
                        if ( $staff_members === false ):
                            echo '<h3 class="text-center text-danger">No staff member found!</h3>';
                        else:
                            ?>
                            <div class="table-responsive">
                                <form action="<?= site_url( 'admin/staff/attendance_process' ) ?>" method="post">
                                    <input type="hidden" name="attendance_date" value="<?= date( 'Y-m-d', strtotime( $attendance_date ) ) ?>">

                                    <table class="table     table-bordered example">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Gender</th>
                                                <th>Attendance</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            $count = 0;
                                            foreach ( $staff_members as $staff_member ):
                                                $staff_attendance = $this->staff_attendance_model->get( null, $staff_member['id'], date( 'Y-m-d', strtotime( $attendance_date ) ) );

                                                $staff_attendance_default = ['present' => false, 'absent' => false];

                                                if ( $staff_attendance === false ) {

                                                    $staff_attendance_default['present'] = true;
                                                    $staff_attendance_default['absent'] = false;

                                                } else {

                                                    if ( $staff_attendance['attendance'] == 'present' ) {
                                                        $staff_attendance_default['present'] = true;
                                                        $staff_attendance_default['absent'] = false;
                                                    } else {
                                                        $staff_attendance_default['present'] = false;
                                                        $staff_attendance_default['absent'] = true;
                                                    }

                                                }

                                                ?>

                                                <tr>
                                                    <td><?= $staff_member['name'] ?></td>
                                                    <td><?= $staff_member['email'] ?></td>
                                                    <td><?= $staff_member['phone'] ?></td>
                                                    <td><?= $staff_member['sex'] ?></td>
                                                    <td>

                                                        <input type="hidden" name="staff[<?= $count ?>][id]" value="<?= $staff_member['id'] ?>">

                                                        <div class="radio radio-info radio-inline">
                                                            <input type="radio" id="staff-present-<?= $staff_member['id'] . '-' . $count ?>" name="staff[<?= $count ?>][attendance]" value="present" <?= set_radio( "staff[{$count}][attendance]", 'present', $staff_attendance_default['present'] ) ?>>
                                                            <label for="staff-present-<?= $staff_member['id'] . '-' . $count ?>">Present</label>
                                                        </div>

                                                        <div class="radio radio-info radio-inline">
                                                            <input type="radio" id="staff-absent-<?= $staff_member['id'] . '-' . $count ?>" name="staff[<?= $count ?>][attendance]" value="absent" <?= set_radio( "staff[{$count}][attendance]", 'absent', $staff_attendance_default['absent'] ) ?>>
                                                            <label for="staff-absent-<?= $staff_member['id'] . '-' . $count ?>">Absent</label>
                                                        </div>

                                                    </td>
                                                </tr>

                                                <?php
                                                $count++;
                                            endforeach;
                                            ?>
                                        </tbody>
                                    </table>

                                    <button type="submit" class="btn btn-primary pull-right">Save</button>
                                </form>
                            </div>
                            <?php
                        endif;
                        ?>

                    </div>
                </div>

            </div>
        </div>
    </section>
</div>

<script type="text/javascript">
    jQuery( function ( $ ) {
        $( "#attendance_for" ).datepicker( {
            format: "mm/dd/yyyy"
        } );
    } );
</script>