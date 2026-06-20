<div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix">Online Class List</h3>
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
                            <table class="table     table-bordered table-hover example" id="onlineclasses_table">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line('date'); ?></th>

                                        <th>Title</th>
                                        <th>Teacher</th>
                                        <th>Class / Section</th>
                                        <th>Subject</th>
                                        <th>Time</th>
                                        <th>Password</th>
                                        <th>Class Link</th>
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
                                                <td class="mailbox-name"><?php echo date("jS M Y", strtotime($data['date'])) ?></td>
                                            <td class="mailbox-name">
                                            <?php echo $data['title'] ?>
                                                </td>
                                                <td class="mailbox-name">
                                            <?php echo $data['teacher'] ?>
                                                </td>
                                                
                                                <td class="mailbox-name"><?php echo $data['class'].'/'.$data['section_name'];?></td>
                                                <td class="mailbox-name"><?php echo $data['subject'];?></td>
                                                <td><?= $data['class_time'] ?></td>
                                                <td><?= $data['password'] ?></td>
                                                <td><a target="_blank" href="<?= $data['link']; ?>" class="btn btn-sm btn-primary">Join Now</a></td>


                                                <td class="mailbox-date pull-right">
                                                <a href="<?php echo base_url(); ?>admin/onlineclass/edit/<?php echo $data['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>                                                  
                                                    <a href="<?php echo base_url(); ?>admin/onlineclass/delete/<?php echo $data['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('Are you sure you want to delete this item?');">
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
//                     $(document).ready(function() {
//     $('#onlineclasses_table').DataTable( {
//         order: [[2, 'asc'], [3, 'asc']],
//         rowGroup: {
//             dataSrc: [ 2, 3 ]
//         },
//         columnDefs: [ {
//             targets: [ 3, 2 ],
//             visible: false
//         } ]
//     } );
// } );
$(document).ready(function() {
    $('#onlineclasses_table').DataTable( {
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