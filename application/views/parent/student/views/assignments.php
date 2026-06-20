<?php 
function getLastOf($url){
    return substr($url, strrpos($url, '/') + 1);
}
?>
<ul class="nav nav-tabs" id="tabs">
        <?php 
        $i=0;
        foreach ($assignments as $key => $item){
            if(count($item)>0){
                ?>
                <li class="<?php if($i==0) echo 'active'; ?>"><a data-toggle="tab" href="#<?php echo $i; ?>"><?php echo $key; ?></a></li>
                <?php 
                $i++;
            }
        }
        ?>
</ul>

<div classs="tab-content">
    <?php 
        $i=0;
        foreach ($assignments as $key => $item){ 
            if(count($item)>0){
                ?>
                
                <div id="<?php echo $i; ?>" class="tab-pane fade<?php if($i==0) echo ' in active '; ?>">
                    
                    <div class="row">
                        <div class="col-sm-4"><h4> Title: Assignment</h4>  </div> 
                        <div class="col-sm-4"><h4 > Class : <?php echo $item[0]['class']."/".$item[0]['section'] ?> </h4></div> 
                        <div class="col-sm-4"><h4 > Teacher : <?php echo $item[0]['teacher']; ?></h4></div>
                    </div>
                    
                    <div class="table-responsive"> 
                        <table class="table table-bordered table-hover ">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Title</th>
                                    <th>File By Teacher</th>
                                    <th>File View</th>
                                    <th>File Download</th>
                                    <th>Upload</th>
                                    <th>Uploaded By Student</th>
                                    <th>View Uploaded File</th>
                                    <th>Upload Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                foreach ($item as $chItem){
                                    
                                    $teacherFile = getLastOf($chItem['file']);
                
                                    $studentFile = getLastOf($chItem['std_uploaded_file']);
                
                                    ?>
                                    
                                    <tr>
                                        <td><?php echo date("jS M Y", strtotime($chItem['date'])); ?></td>
                                        <td><?php echo $chItem['title']; ?></td>
                                        <td><?php echo $teacherFile; ?></td>
                                        <td><a target="blank" href="<?= base_url() ?><?php echo $chItem['file']; ?>"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                                        <td><a download target="blank" href="<?= base_url() ?><?php echo $chItem['file']; ?>"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                                        <td><a href="<?= base_url() ?>parent/parents/upload_assignment/<?php echo $student['id'].'/'.$chItem['id']; ?>"><i class="fa fa-upload" aria-hidden="true"></i></a></td>
                                        <td><?php echo $studentFile ?></td>
                                        <td><a target="blank" href="<?= base_url() ?><?php echo $chItem['std_uploaded_file']; ?>" ><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                                        <td><?php echo date("jS M Y", strtotime($chItem['std_uploaded_date'])); ?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php 
            }
            $i++;
        }
    ?>
</div>