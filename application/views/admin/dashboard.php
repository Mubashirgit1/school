<div class="content-wrapper" style="min-height: 946px;">
    <section class="content">

        <!-- Custom gadgets -->
        <div class="row">

            <div class="col-sm-4 custom_gadget">
                <div class="custom_gadget_container">
                    <div class="row">
                        <div class="col-xs-5 custom_gadget_left_container">
                            <?php
                            $_from_date = date( "m/01/Y", now() );
                            $_month_days = cal_days_in_month( CAL_GREGORIAN, date( 'm', strtotime( $_from_date ) ), date( 'Y', strtotime( $_from_date ) ) );
                            ?>
                            <div class="custom_gadget_left_inner" style="background-image: url(<?= base_url( 'backend/images/ico/monthly_fee.png' ) ?>);" onclick="window.location.href = '<?= site_url( "fee_management/fee_reports" ) . "?date_from=" . urlencode( $_from_date ) . "&date_to=" . urlencode( date( 'm/' . $_month_days . '/Y', strtotime( $_from_date ) ) ) ?>'"></div>
                        </div>

                        <div class="col-xs-7 custom_gadget_right_container">
                            <div class="custom_gadget_right_inner">
                                <div class="custom_gadget_heading">Monthly Fee</div>

                                <table class="table no-border table_no_padding">
                                    <tbody>
                                        <tr>
                                            <td>Receivable:</td>
                                            <td>Rs. <?= number_format( $total_receiveable_fee, 0, '', ',' ) ?></td>
                                        </tr>
                                        <tr>
                                            <td>Received:</td>
                                            <td>Rs. <?= number_format( $total_fee_received_fee, 0, '', ',' ) ?></td>
                                        </tr>
                                        <tr>
                                            <td>Received + Others:</td>
                                            <td>Rs. <?= number_format( $total_fee_including_other_fee, 0, '', ',' ) ?></td>
                                        </tr>
                                        <tr>
                                            <td>Arrears:</td>
                                            <td>Rs. <?= number_format( $sum_total_due_fee, 0, '', ',' ) ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-4 custom_gadget">
                <div class="custom_gadget_container">
                    <div class="row">
                        <div class="col-xs-5 custom_gadget_left_container">
                            <?php
                            $_date = date( 'm/01/Y', now() );
                            $_month_days = cal_days_in_month( CAL_GREGORIAN, date( 'm', strtotime( $_date ) ), date( 'Y', strtotime( $_date ) ) );
                            ?>
                            <div class="custom_gadget_left_inner" style="background-image: url(<?= base_url( 'backend/images/ico/monthly_expenses.png' ) ?>);" onclick="window.location.href = '<?= site_url( "admin/expense/expensesearch" ) . "?date_from=" . urlencode( $_date ) . "&date_to=" . urlencode( date( 'm/' . $_month_days . '/Y', strtotime( $_date ) ) ) . "&search=search_filter" ?>'"></div>
                        </div>

                        <div class="col-xs-7 custom_gadget_right_container">
                            <div class="custom_gadget_right_inner">
                                <div class="custom_gadget_heading">Monthly Expenses</div>
                                <table class="table no-border table_no_padding">
                                    <tr>
                                        <td>Total Expenses:</td>
                                        <td>Rs. <?= $month_expense ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-4 custom_gadget">
                <div class="custom_gadget_container">
                    <div class="row">
                        <div class="col-xs-5 custom_gadget_left_container">
                            <div class="custom_gadget_left_inner" style="background-image: url(<?= base_url( 'backend/images/ico/students.png' ) ?>);" onclick="window.location.href = '<?= site_url( "admin/stuattendence" ) ?>'"></div>
                        </div>

                        <div class="col-xs-7 custom_gadget_right_container">
                            <div class="custom_gadget_right_inner">
                                <div class="custom_gadget_heading">Students</div>
                                <table class="table no-border table_no_padding">
                                    <tbody>
                                        <tr>
                                            <td>Total Enrolled In Current Session:</td>
                                            <td><?= $total_students ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <?php
                                if ( count( $calculate_attendance_by_date ) != 0 ):

                                    foreach ( $calculate_attendance_by_date as $cabd_value ):
                                        ?>
                                        <div><?= $cabd_value['name'] ?> (today): <b><?= $cabd_value['cnt'] ?></b></div>
                                        <?php
                                    endforeach;
                                else:
                                    echo '<div class="text-danger">Attendance not marked for today.</div>';
                                endif;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="col-sm-4 custom_gadget">
                <div class="custom_gadget_container">
                    <div class="row">
                        <div class="col-xs-5 custom_gadget_left_container">
                            <?php
                            $_date = date( 'm/01/Y', now() );
                            $_month_days = cal_days_in_month( CAL_GREGORIAN, date( 'm', strtotime( $_date ) ), date( 'Y', strtotime( $_date ) ) );
                            ?>
                            <div class="custom_gadget_left_inner" style="background-image: url(<?= base_url( 'backend/images/ico/teachers.png' ) ?>);" onclick="window.location.href = '<?= site_url( "admin/teacher/attendance_report" ) ?>'"></div>
                        </div>

                        <div class="col-xs-7 custom_gadget_right_container">
                            <div class="custom_gadget_right_inner">
                                <div class="custom_gadget_heading">Teachers</div>
                                <table class="table no-border table_no_padding">
                                    <tbody>
                                        <tr>
                                            <td>Total:</td>
                                            <td><?= $total_teachers ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <?php
                                if ( count( $sum_teacher_attendance ) == 0 ):
                                    echo '<div class="text-danger">Today\'s attendance for teacher is not marked yet!</div>';
                                else:
                                    foreach ( $sum_teacher_attendance as $sta_item ):
                                        ?>
                                        <div><?= ucwords( $sta_item['name'] ) ?> (today): <?= $sta_item['cnt'] ?></div>
                                        <?php
                                    endforeach;
                                endif;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-4 custom_gadget">
                <div class="custom_gadget_container">
                    <div class="row">
                        <div class="col-xs-5 custom_gadget_left_container">
                            <?php
                            $_date = date( 'm/01/Y', now() );
                            $_month_days = cal_days_in_month( CAL_GREGORIAN, date( 'm', strtotime( $_date ) ), date( 'Y', strtotime( $_date ) ) );
                            ?>
                            <div class="custom_gadget_left_inner" style="background-image: url(<?= base_url( 'backend/images/ico/teacher_salaries.png' ) ?>);" onclick="window.location.href = '<?= site_url( "admin/teacher/salary" ) ?>'"></div>
                        </div>

                        <div class="col-xs-7 custom_gadget_right_container">
                            <div class="custom_gadget_right_inner">
                                <div class="custom_gadget_heading">Monthly Teacher's Salaries</div>

                                <table class="table no-border table_no_padding">
                                    <tbody>
                                        <tr>
                                            <td>Salaries:</td>
                                            <td>RS. <?= $sum_payable_teacher_salaries ?></td>
                                        </tr>
                                        <tr>
                                            <td>Paid:</td>
                                            <td>Rs. <?= $sum_paid_teacher_salaries ?></td>
                                        </tr>
                                        <tr>
                                            <td>Due:</td>
                                            <td>Rs. <?= $sum_due_teacher_salaries ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-4 custom_gadget">
                <div class="custom_gadget_container">
                    <div class="row">
                        <div class="col-xs-5 custom_gadget_left_container">
                            <?php
                            $_date = date( 'm/01/Y', now() );
                            $_month_days = cal_days_in_month( CAL_GREGORIAN, date( 'm', strtotime( $_date ) ), date( 'Y', strtotime( $_date ) ) );
                            ?>
                            <div class="custom_gadget_left_inner" style="background-image: url(<?= base_url( 'backend/images/ico/staff_salaries.png' ) ?>);" onclick="window.location.href = '<?= site_url( "admin/staff/salary" ) ?>'"></div>
                        </div>

                        <div class="col-xs-7 custom_gadget_right_container">
                            <div class="custom_gadget_right_inner">
                                <div class="custom_gadget_heading">Staff Salaries</div>

                                <table class="table no-border table_no_padding">
                                    <tbody>
                                        <tr>
                                            <td>Salaries:</td>
                                            <td>Rs. <?= $sum_staff_salary['salary_sum'] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Paid:</td>
                                            <td>Rs. <?= $sum_staff_salary_paid ?></td>
                                        </tr>
                                        <tr>
                                            <td>Due:</td>
                                            <td>Rs. <?= $sum_staff_salary['due_salary_sum'] ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-4 custom_gadget">
                <div class="custom_gadget_container">
                    <div class="row">
                        <div class="col-xs-5 custom_gadget_left_container">
                            <div class="custom_gadget_left_inner" style="background-image: url(<?= base_url( 'backend/images/ico/library.png' ) ?>);" onclick="window.location.href = '<?= site_url( "admin/book/getall" ) ?>'"></div>
                        </div>

                        <div class="col-xs-7 custom_gadget_right_container">
                            <div class="custom_gadget_right_inner">
                                <div class="custom_gadget_heading">Library</div>
                                <table class="table no-border table_no_padding">
                                    <tbody>
                                        <tr>
                                            <td>Total Books:</td>
                                            <td><?= $total_books ?></td>
                                        </tr>
                                        <tr>
                                            <td>Total Issued:</td>
                                            <td><?= $books_issued ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-4 custom_gadget">
                <div class="custom_gadget_container">
                    <div class="row">
                        <div class="col-xs-5 custom_gadget_left_container">
                            <div class="custom_gadget_left_inner" style="background-image: url(<?= base_url( 'backend/images/ico/hotel_rooms.png' ) ?>);" onclick="window.location.href = '<?= site_url( "admin/hostelroom" ) ?>'"></div>
                        </div>

                        <div class="col-xs-7 custom_gadget_right_container">
                            <div class="custom_gadget_right_inner">
                                <div class="custom_gadget_heading">Hostel Rooms</div>
                                <table class="table no-border table_no_padding">
                                    <tbody>
                                        <tr>
                                            <td>Total Rooms:</td>
                                            <td><?= $total_hostel_rooms ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
</div>

<!--<script src="--><?php //echo base_url(); ?><!--backend/plugins/fastclick/fastclick.js"></script>-->
<!--<script src="--><?php //echo base_url(); ?><!--backend/dist/js/app.min.js"></script>-->

<!-- .custom_gadget JS -->
<script type="text/javascript">
    jQuery( function ( $ ) {

        var max_custom_gadget_row_height = 0;

        // getting max height
        $( ".custom_gadget_container .row" ).each( function ( i, d ) {
            var h = $( d ).height();

            // if this row has more height than the last one
            if ( h > max_custom_gadget_row_height ) {
                max_custom_gadget_row_height = h;
            }
        } );

        $( ".custom_gadget_container .custom_gadget_left_container" ).height( max_custom_gadget_row_height );

    } );
</script>