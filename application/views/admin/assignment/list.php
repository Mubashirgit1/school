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
                    <th>Teacher</th>

                    <th>Class / Section</th>
                    <th>Subject</th>
                    <th>Total Marks</th>
                    <th>Passing Marks</th>

                    <th>File Name</th>
                    <th> View</th>
                    <th> Download</th>
                    <th> Submitted </th>
                    <th> Pending </th>

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
                            <td class="mailbox-name">
                                <?php echo $data['teacher'] ?>
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
                                <span style="<?php if($data['total_pending']> 0) echo 'color: red;'; ?>"><?php echo $data['total_pending']; ?></span>
                            </td>

                            <td>
                                <button data-href="<?php echo base_url(); ?>admin/assignment/view_results/<?php echo $data['id'] ?>"
                                        class="btn btn-default btn-xs view_results" data-toggle="tooltip"
                                        title="<?php echo $this->lang->line('view'); ?>">
                                    <i class="fa fa-eye"></i>
                                    </button>
                            </td>

                            <td class="mailbox-date pull-right">
                                <a href="<?php echo base_url(); ?>admin/assignment/edit/<?php echo $data['id'] ?>"
                                   class="btn btn-default btn-xs" data-toggle="tooltip"
                                   title="<?php echo $this->lang->line('edit'); ?>">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <a href="<?php echo base_url(); ?>admin/assignment/delete/<?php echo $data['id'] ?>"
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
    // $(document).ready(function () {
    //     $('#assignments_table').DataTable({
    //         order: [[2, 'asc'], [3, 'asc']],
    //         rowGroup: {
    //             dataSrc: [2, 3]
    //         },
    //         columnDefs: [{
    //             targets: [3, 2],
    //             visible: false
    //         }]
    //     });
    // });
    $(document).ready(function() {
        $('#assignments_table').DataTable( {
            destroy: true,
            order: [[2, 'asc'], [3, 'asc'], [4, 'asc']],
            rowGroup: {
                dataSrc: [ 2, 3, 4 ]
            },
            columnDefs: [ {
                targets: [ 2, 3, 4 ],
                visible: false
            } ]
        } );
    } );
</script>