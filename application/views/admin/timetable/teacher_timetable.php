<div class="content-wrapper" style="min-height: 946px;">
    <?php
    $this->load->view('layout/academics_link');
    ?>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Timetable for Teachers</h3>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <div class="box-body">

                        <?php foreach ($teachers as $teacher): ?>

                            <?php if (!empty($teacher['teacher_subjects'])): ?>

                                <h3><?= $teacher['name'] ?></h3>

                                <div class="table-responsive">
                                    <table class="table     table-bordered example">
                                        <thead>
                                        <tr>
                                            <th>Subjects</th>
                                            <th>Monday</th>
                                            <th>Tuesday</th>
                                            <th>Wednesday</th>
                                            <th>Thursday</th>
                                            <th>Friday</th>
                                            <th>Saturday</th>
                                        </tr>
                                        </thead>

                                        <tbody>

                                        <?php
                                        foreach ($teacher['teacher_subjects'] as $teacher_subject):
                                            ?>
                                            <?php if ($teacher_subject['timetable']) { ?>
                                            <tr>
                                            <th WIDTH="25%"><?= $teacher_subject['subject_details']['name'] ?>
                                                <small>(<?= $teacher_subject['class_setion_details']['class']['class'] . ' - ' . $teacher_subject['class_setion_details']['section']['section'] ?>
                                                    )</small>
                                            </th>

                                            <?php foreach ($teacher_subject['timetable'] as $time_table): ?>
                                                <?php if (strtolower($time_table['day_name']) != 'sunday'): ?>
                                                    <td>
                                                        <!--<?php //$time_table['day_name'] ?>-->
                                                        <!--<br>-->
                                                        <?= $time_table['start_time'] ?>
                                                    </td>

                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php }  ?>
                                            </tr>
                                        <?php endforeach;
                                        ?>

                                        </tbody>
                                    </table>
                                </div>

                            <?php endif; ?>

                        <?php endforeach; ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>