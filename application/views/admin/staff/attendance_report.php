<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1>
            <i class="fa fa-mortar-board"></i> Staff Attendance Report
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">

                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-filter"></i> Filter Attendance</h3>
                    </div>

                    <div class="box-body">

                        <form action="<?= site_url( 'admin/staff/attendance_report' ) ?>" method="get">

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Year</label>
                                        <select class="form-control" name="year">
                                            <?php
                                            $date = new DateTime( date( 'Y-m-d', now() ) );
                                            $date->sub( new DateInterval( 'P6Y' ) );
                                            for ( $i = 0; $i <= 6; $i++ ):
                                                ?>
                                                <option value="<?= $date->format( 'Y' ) ?>" <?= ( $year == $date->format( 'Y' ) ? "selected" : "" ) ?>><?= $date->format( 'Y' ) ?></option>
                                                <?php
                                                $date->add( new DateInterval( 'P1Y' ) );
                                            endfor;
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Month</label>
                                        <select name="month" class="form-control">
                                            <?php
                                            $date = new DateTime( date( 'Y-01-d', now() ) );
                                            for ( $i = 0; $i < 12; $i++ ):
                                                ?>
                                                <option value="<?= $date->format( 'm' ) ?>" <?= $month == $date->format( 'm' ) ? "selected" : "" ?>><?= $date->format( 'F' ) ?></option>
                                                <?php
                                                $date->add( new DateInterval( 'P1M' ) );
                                            endfor;
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary pull-right">Filter</button>
                                </div>
                            </div>

                        </form>

                    </div>

                </div>
            </div>

            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Staff Attendance Report</h3>
                        <div class="pull-right">
                            <h4><?php  $total_working = 365 - $total ?>
                            Today Working Day No: <?= $total_working ?></h4>
                        </div>                    
                    </div>
                    <div class="box-body">
                        <?php
                        if ( $staff_members === false ):
                            echo '<h3 class="text-center text-danger">No staff member was found!</h3>';
                        else:
                            ?>

                            <div class="table-responsive">
                                <table class="table table-bordered     example">
                                    <thead>
                                        <tr>
                                            <th>Staff/Date</th>
                                            <?php
                                            foreach ( $month_dates as $month_date_v ):
                                                ?>
                                                <th class="<?= ( strtolower( date( "D", strtotime( $month_date_v ) ) ) == 'sun' ? 'bg-danger' : '' ) ?>"><?= mdate( '%d<br>%D', strtotime( $month_date_v ) ) ?></th>
                                                <?php
                                            endforeach;
                                            ?>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        foreach ( $staff_members as $staff_member ):
                                            ?>
                                            <tr>
                                                <td><?= $staff_member['name'] ?></td>

                                                <?php
                                                foreach ( $staff_member['attendance'] as $staff_member_attendance ):

                                                    echo "<td>";
                                                    if ( $staff_member_attendance !== false ):
                                                        echo ucfirst( $staff_member_attendance['attendance'] );
                                                    endif;
                                                    echo "</td>";

                                                endforeach;
                                                ?>
                                            </tr>
                                            <?php
                                        endforeach;
                                        ?>
                                    </tbody>
                                </table>
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