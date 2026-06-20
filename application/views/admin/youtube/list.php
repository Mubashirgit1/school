<div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix">Youtube List</h3>
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
                                        <th>Description</th>
                                        <th>Teacher</th>
                                        <th>Class / Section</th>
                                        <th>Subject</th>
                                        <th>Video</th>
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
                                                <td class="mailbox-name"><?php echo $data['title'] ?></td>
                                                <td class="mailbox-name"><?php echo $data['teacher'] ?></td>
                                                <td class="mailbox-name"><?php echo $data['class'].'/'.$data['section_name'];?></td>
                                                <td class="mailbox-name"><?php echo $data['subject'];?></td>
                                                <td>  <a href="#<?php echo $data['id'] ?>" data-backdrop="static" data-keyboard="false" class="btn btn-sm btn-primary" data-toggle="modal">Watch Video</a></td>

                                                <div id="<?php echo $data['id'] ?>" class="modal fade">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button data-modal-id="<?php echo $data['id'] ?>" type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                <h4 class="modal-title">YouTube Video</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                            <?php 

                                                            $parts = parse_url($data['link']);
                                                            parse_str($parts['query'], $query);
                                                            $last_word =  $query['v'];

                                                            if(empty($last_word)){
                                                                $string = $data['link'];
                                                                $pieces = explode('/', $string);
                                                                $last_word = array_pop($pieces);
                                                            }

                                                           ?>
                                                           
                                                                <div class="video_container">
                                                                    <iframe id="cartoonVideo" class="youtube_video" src="//www.youtube.com/embed/<?= $last_word?>" frameborder="0" allowfullscreen></iframe>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                    
                                                <td class="mailbox-date pull-right">
                                                <a href="<?php echo base_url(); ?>admin/youtube/edit/<?php echo $data['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>                                                  
                                                    <a href="<?php echo base_url(); ?>admin/youtube/delete/<?php echo $data['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('delete'); ?>" onclick="return confirm('Are you sure you want to delete this item?');">
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
//     $('#list_table').DataTable( {
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
    $('#list_table').DataTable( {
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