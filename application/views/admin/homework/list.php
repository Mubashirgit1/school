<div class="box box-primary">
    <div class="box-header ptbnull">
        <h3 class="box-title titlefix">Dailywork List</h3>
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
            <table class="table     table-bordered table-hover example" id="list_table">
                <thead>
                    <tr>                 
                    <th><?php echo $this->lang->line('date'); ?></th>
                        <th>Title</th>
                        <th>Homework</th>
                        <th>Classwork</th>
                        <th>Teacher</th>
                        <th>Class / Section</th>
                        <th>Subject</th>
                        <th>File Name</th>
                        <th>File View</th>
                        <th>File Downlaod</th>
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
                            <td class="mailbox-name" style="width: 100px;"><?php echo date("jS M Y", strtotime($data['date'])) ?></td>

                            <td class="mailbox-name">
                            <?php echo $data['title'] ?>
                                </td>
                                <td class="mailbox-name" style="width: 150px;">
                                      <?php
                                        if ($data['classwork'] == "") {
                                            ?>
                                            <p class="text text-danger">No Classwork </p>
                                            <?php
                                        } else {
                                            ?>
                                            <p class="text text-info"><p><?php echo $data['classwork'] ; ?></p></p>
                                            <?php
                                        }
                                        ?>
                                </td>

                                <td class="mailbox-name" style="width: 150px;">
                                    <?php
                                    if ($data['homework'] == "") {
                                        ?>
                                        <p class="text text-danger">No Homework </p>
                                        <?php
                                    } else {
                                        ?>
                                        <p class="text text-info"><p><?php echo $data['homework']; ?></p></p>
                                        <?php
                                    }
                                    ?>
                                </td>

                                <td class="mailbox-name"><?php echo $data['teacher'];?></td>
                                <td class="mailbox-name"><?php echo $data['class'].'/'.$data['section_name'];?></td>
                                <td class="mailbox-name"><?php echo $data['subject'];?></td>
                                <?php  $string = $data['file'];
                                $pieces = explode('/', $string);
                                $last_word = array_pop($pieces); ?>
                                <td class="mailbox-name"><?php echo $last_word;?></td>
                                <td class="mailbox-name">  
                                     <a  target="blank"     href="<?php echo base_url(); ?><?php echo $data['file'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('view'); ?>">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </td>
                                
                                <td class="mailbox-name">  
                                    <a  download     href="<?php echo base_url(); ?><?php echo $data['file'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('download'); ?>">
                                        <i class="fa fa-download"></i>
                                    </a>
                                </td>
                                
                                
                                <td class="mailbox-date pull-right">
                                <a href="<?php echo base_url(); ?>admin/homework/edit/<?php echo $data['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>                                                  
                                    <a href="<?php echo base_url(); ?>admin/homework/delete/<?php echo $data['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('Are you sure you want to delete this item?');">
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
// $(document).ready(function() {
//     $('#list_table').DataTable( {
//         order: [[4, 'asc'], [5, 'asc']],
//         rowGroup: {
//             dataSrc: [ 4, 5 ]
//         },
//         columnDefs: [ {
//             targets: [ 5, 4 ],
//             visible: false
//         } ]
//     } );
// } );

$(document).ready(function() {
    $('#list_table').DataTable( {
        destroy: true,
        order: [[4, 'asc'], [5, 'asc'], [6, 'asc']],
        rowGroup: {
            dataSrc: [ 4, 5, 6 ]
        },
        columnDefs: [ {
            targets: [ 4, 5, 6 ],
            visible: false
        } ]
    } );
} );
</script>