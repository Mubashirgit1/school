<div class="" id="assignment___">
    <ul class="nav nav-tabs" id="tabs">
        <?php
        $i = 0;
        foreach ($assignments as $key => $home) {
            $i++;
            $i == 1 ? $class = "active" : $class = " "; ?>
            <li class="<?= $class ?>"><a data-toggle="tab" href="#tab_<?= $i ?>"><?= $key ?></a>
            </li>
        <?php } ?>
    </ul>
    <div class="tab-content">
        <?php
        //        pwodie($assignments);
        //        pwodie($query);
        $i = 0;
        foreach ($assignments as $key => $home) {
            $i++;
            $i == 1 ? $class = "active" : $class = " "; ?>
            <div id="tab_<?= $i ?>" class="tab-pane fade in <?= $class ?>">

                <div class="row">
                    <div class="col-sm-4"><h4> Title: Assignment</h4></div>
                    <div class="col-sm-4"><h4> Class : <?= $home[0]->class ?>
                            / <?= $home[0]->section ?>  </h4></div>
                    <div class="col-sm-4"><h4> Teacher : <?= $home[0]->teacher ?>  </h4></div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover ">
                        <thead>
                        <tr>
                            <th style="background: #d6d6d6;" colspan="5" class="text-center">Assignment by Teacher</th>
                            <th style="background: #d6d6d6;" colspan="4" class="text-center">Upload Assignment</th>
                            <th style="background: #d6d6d6;" colspan="1" class="text-center">Checked Assignment</th>
                            <th style="background: #d6d6d6;" colspan="4" class="text-center">Marks / Status</th>
                        </tr>
                        <tr>
                            <th>Date</th>
                            <th>Title</th>
                            <th>File</th>
                            <th class="text-center">View</th>
                            <th class="text-center">Download</th>
                            <th class="text-center">Upload</th>
                            <th>File Name</th>
                            <th class="text-center">View</th>
                            <th class="text-center">Upload Date</th>
                            <th class="text-center">View/Download/Remarks</th>
                            <th class="text-center">Total Marks</th>
                            <th class="text-center">Obtained Marks</th>
                            <th class="text-center">%age</th>
                            <th class="text-center">Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($home as $key => $home_value) { ?>
                            <tr>
                                <td><?= date('d/m/Y', strtotime($home_value->date)) ?></td>
                                <td><?= $home_value->title ?></td>
                                <?php $string = $home_value->file;
                                $pieces       = explode('/', $string);
                                $last_word    = array_pop($pieces); ?>
                                <td><?= $last_word ?></td>
                                <td class="text-center"><a target="blank" class="btn btn-xs btn-default"
                                                           href="<?= base_url() ?><?= $home_value->file ?>"><i
                                                class="fa fa-eye" aria-hidden="true"></i></a>
                                <td class="text-center"><a download class="btn btn-xs btn-default"
                                                           href="<?= base_url() ?><?= $home_value->file ?>"><i
                                                class="fa fa-download"
                                                aria-hidden="true"></i></a>
                                </td>
                                <td class="text-center"><a class="btn btn-xs btn-default"
                                                           href="<?= base_url() ?>parent/parents/upload_assignment/<?php echo $student['id'] . '/' . $home_value->id; ?>"><i
                                                class="fa fa-upload" aria-hidden="true"></i></a>
                                </td>


                                <td><?php

                                    //                                    pwodie($home_value);

                                    if (!empty($home_value->by_student))
                                        echo getLastWord($home_value->by_student->file)
                                    ?></td>

                                <td class="text-center">
                                    <?php if (!empty($home_value->by_student)) { ?>
                                        <a class="btn btn-xs btn-default" target="blank"
                                           href="<?= base_url($home_value->by_student->file); ?>"><i
                                                    class="fa fa-eye" aria-hidden="true"></i></a>
                                    <?php } ?>
                                </td>
                                <td class="text-center">
                                    <?php
                                    if (!empty($home_value->by_student))
                                        echo date('d/m/Y', strtotime($home_value->by_student->date))
                                    ?></td>

                                <td class="text-left">
                                    <?php if (!empty($home_value->by_student) && $home_value->by_student->reply_file): ?>
                                        <a target="_blank" class="btn btn-xs btn-default"
                                           href="<?= base_url($home_value->by_student->reply_file); ?>"><i
                                                    class="fa fa-eye"
                                                    aria-hidden="true"></i></a>
                                        <a target="_blank" class="btn btn-xs btn-default"
                                           download
                                           href="<?= base_url($home_value->by_student->reply_file); ?>"><i
                                                    class="fa fa-download"
                                                    aria-hidden="true"></i></a>
                                    <?php endif; ?>

                                    <?php if (!empty($home_value->by_student) && $home_value->by_student->reply_comments): ?>
                                        <br>
                                        <?php echo "Remarks: " . $home_value->by_student->reply_comments; ?>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center"><?php
                                    echo $home_value->marks;
                                    ?></td>
                                <td class="text-center"><?php
                                    if (!empty($home_value->by_student))
                                        echo $home_value->by_student->marks; ?></td>
                                <td><?php if (!empty($home_value->by_student))
                                        echo $home_value->by_student->marks / $home_value->marks * 100; ?></td>
                                <td class="text-center">
                                    <?php
                                    if (!empty($home_value->by_student)) {
                                        if ($home_value->by_student->marks < $home_value->passing_marks) {
                                            echo "<span style='color: red;'>Fail</span>";
                                        } else {
                                            echo "<span style='color: green;'>Pass</span>";
                                        }
                                    }
                                    ?>
                                </td>


                            </tr>
                            <?php $lastword = "" ?>

                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php } ?>
    </div>


</div>