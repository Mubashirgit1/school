<div class="box box-primary">
    <div class="box-header ptbnull">
        <h3 class="box-title titlefix">Assignment List</h3>
        <br>
        <div class="box-tools pull-right">
        </div>
    </div>
    <div class="box-body">
        <div class="mailbox-controls">
            <div class="pull-right">
            </div>
        </div>
        <div class="table-responsive mailbox-messages">
            <table class="table  table-bordered table-hover example" id="assignments_table">
                <thead>
                <tr>
                    <th><?php echo $this->lang->line('date'); ?></th>
                    <th>Title</th>

                    <th>Class / Section</th>
                    <th>Subject</th>
                    <th>Total Marks</th>
                    <th>Passing Marks</th>

                    <th>File Name</th>
                    <th> View</th>
                    <th> Download</th>
                    <th> Submitted</th>
                    <th> Pending</th>
                    <th> Status</th>

                    <th class="text-right"><?php echo $this->lang->line('action'); ?>
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php if (empty($list)) {
                    ?>

                    <?php
                } else {
                    $count = 1;
                    foreach ($list as $data) {

                        ?>
                        <tr>
                            <td><?php echo date("jS M Y", strtotime($data['date'])); ?></td>

                            <td class="mailbox-name">
                                <?php echo $data['title'] ?>
                            </td>
                            <!--<td class="mailbox-name"><?php echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($data['date'])) ?></td>-->
                            <td class="mailbox-name"><?php echo $data['class'] . '/' . $data['section_name']; ?></td>
                            <td class="mailbox-name"><?php echo $data['subject']; ?></td>
                            <td class="mailbox-name"><?php echo $data['marks']; ?></td>
                            <td class="mailbox-name"><?php echo $data['passing_marks']; ?></td>
                            <?php $string = $data['file'];
                            $pieces       = explode('/', $string);
                            $last_word    = array_pop($pieces); ?>
                            <td><?= $last_word ?></td>
                            <td><?php if ($data['file']) { ?>
                                    <a target="blank" href="<?php echo base_url(); ?><?php echo $data['file'] ?>"
                                       class="btn btn-default btn-xs" data-toggle="tooltip"
                                       title="<?php echo $this->lang->line('view'); ?>">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                <?php } else {
                                    echo "No File";
                                } ?></td>
                            <td class="mailbox-name">
                                <?php if ($data['file']) { ?>

                                    <a download href="<?php echo base_url(); ?><?php echo $data['file'] ?>"
                                       class="btn btn-default btn-xs" data-toggle="tooltip"
                                       title="<?php echo $this->lang->line('download'); ?>">
                                        <i class="fa fa-download"></i>
                                    </a>
                                <?php } else {
                                    echo "No File";
                                } ?></td>
                            <td>
                                <?php echo $data['total_submit']; ?>
                            </td>

                            <td>
                                <span style="<?php if ($data['total_pending'] > 0) echo 'color: red;'; ?>"><?php echo $data['total_pending']; ?></span>
                            </td>

                            <td>
                                <button data-href="<?php echo base_url(); ?>teacher/assignment/view_results/<?php echo $data['id'] ?>"
                                        class="btn btn-default btn-xs view_results" data-toggle="tooltip"
                                        title="<?php echo $this->lang->line('view'); ?>">
                                    <i class="fa fa-eye"></i>
                            </td>


                            <td class="mailbox-date pull-right">
                                <a href="<?php echo base_url(); ?>teacher/assignment/edit/<?php echo $data['id'] ?>"
                                   class="btn btn-default btn-xs" data-toggle="tooltip"
                                   title="<?php echo $this->lang->line('edit'); ?>">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a href="<?php echo base_url(); ?>teacher/assignment/delete/<?php echo $data['id'] ?>"
                                   class="btn btn-default btn-xs" data-toggle="tooltip"
                                   title="<?php echo $this->lang->line('delete'); ?>"
                                   onclick="return confirm('Are you sure you want to delete this item?');">
                                    <i class="fa fa-remove"></i>
                                </a>
                            </td>

                        </tr>
                        <?php
                    }
                    $count++;
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#assignments_table').DataTable({
            order: [[2, 'asc'], [3, 'asc']],
            rowGroup: {
                dataSrc: [2, 3]
            },
            columnDefs: [{
                targets: [3, 2],
                visible: false
            }]
        });
    });
</script>

<script type="text/javascript">
    $(function () {
        // $(document).on("click", ".uploadAndSaveBtn", function (e) {
        //     e.preventDefault();
        //
        //     // console.log($(this).data());
        //
        //     console.log($("#form_" + $(this).data("result_id")).serialize());
        //     alert('clicked at result id ' + $(this).data('result_id'));
        //
        // });


        var delay = 500;
        var search_timer = null;

        $(document).on("change keypress keyup", ".marksInput", function (e) {
            let $this = $(this);
            let id = $this.data("marks_input");

            if (search_timer) {
                clearTimeout(search_timer);
            }

            search_timer = setTimeout(function () {

                $.ajax({
                    url: "<?php echo base_url('teacher/assignment/saveMarksSingle'); ?>",
                    type: "post",
                    dataType: "json",
                    data: {
                        result_id: id,
                        marks: $this.val(),
                    },
                    beforeSend: function () {
                        $("#marks_result_" + id).html("Saving...");
                    },
                    success: function (result) {
                        $("#marks_result_" + id).html("<span class='text-success'>Saved!</span>");
                        $("#status_" + id).html(result.status);
                        $("#percentage_" + id).html(result.percentage);
                    }
                })
            }, delay);
        });

        $(document).on("change keypress keyup", ".remarksInput", function (e) {
            let $textarea = $(this);
            let id = $textarea.data("remarks_input");

            if (search_timer) {
                clearTimeout(search_timer);
            }

            search_timer = setTimeout(function () {
                $.ajax({
                    url: "<?php echo base_url('teacher/assignment/saveRemarksSingle'); ?>",
                    type: "post",
                    dataType: "json",
                    data: {
                        result_id: id,
                        remarks: $textarea.val(),
                    },
                    beforeSend: function () {
                        $("#marks_result_" + id).html("Saving...");
                    },
                    success: function (result) {
                        $("#marks_result_" + id).html("<span class='text-success'>Remarks Saved!</span>");
                    }
                })
            }, delay);
        });


        $(document).on("change", ".myFileInput", function (e) {
            e.preventDefault();
            let id = $(this).data("result_id");

            let reply_file = document.getElementById("my_assignment_" + id).files[0];
            // let file = $(this).file();
            // console.log(file);
            let file_name = reply_file.name;
            let file_extension = file_name.split(".").pop().toLowerCase();
            console.log(reply_file);

            if (jQuery.inArray(file_extension, ["png", "jpg", "jpeg", "doc", "docx", "pdf"]) === -1) {
                alert("Invalid File");
                return;
            }


            let image_size = reply_file.size;
            if (image_size > 10000000) {
                alert('File size is very big ');
            } else {
                let form_data = new FormData();
                form_data.append("file", reply_file);
                form_data.append("result_id", id);

                $.ajax({
                    url: "<?php echo base_url('teacher/assignment/upload_ajax'); ?>",
                    method: "post",
                    data: form_data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function () {
                        $("#uploading_span_" + id).html("Uploading...");
                    },
                    // uploadProgress: function (event, position, total, percentageComplete) {
                    //     alert("position: " + position + " total " + total + " percent  " + percentageComplete);
                    //     $("#my_progress_bar_" + id).animate({
                    //         width: percentageComplete + "%"
                    //     }, {
                    //         duration: 1000
                    //     });
                    //
                    //     $("#my_progress_bar_" + id).html(percentageComplete + "%");
                    // },
                    success: function (result) {
                        // $("#my_assignment_" + id).val("");
                        $("#uploading_span_" + id).html('<span class="text-success">File is uploaded!</span>');
                    }, error: function(e){
                        $("#uploading_span_" + id).html('<span class="text-danger">Error! Please Try again</span>');
                    }
                })
            }

        });
    });
</script>
