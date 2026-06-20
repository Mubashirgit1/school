<div class="content-wrapper" style="min-height: 946px;">
<section class="content-header">
        <div class="box box-primary" style="margin-bottom: 0px;">
            <div class="box-body">
            <div class="col-xs-5 col-sm-3 col-md-2"  > 
            <?php  $url = $student['image'] != null ? $student['image'] : 'uploads/student_images/no_image.png';  ?>
                <img class="student-image profile-user-img img-responsive img-circle" src="<?= base_url().$url ?>" alt="User profile picture">
            </div> 
           
            <div class="col-xs-7 col-sm-9 col-md-10"> 
                <div class="card-body-right">
                    <h4 class="card-title"><?= $student['firstname'].' '.$student['lastname']?></h4>
                    <h5><?= $student['class'].' / '.$student['section']?></h5>
                    <p class="card-text"><?= admission_text() ?> <?= $student['admission_no'] ?>  </p>
                </div>
            </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row">
        
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <!--<h3 class="box-title titlefix">-->
                        <!--    <?php echo 'Teacher | Subject list' ?>-->
                        <!--</h3>-->
                    </div>      
                    <br>             
                    <div class="box-body">
                        <table class="table     table-bordered table-hover ">
                            <thead>
                                <tr>
                                    <th style='background:lightgrey'><?php echo $this->lang->line('teacher_name'); ?></th>
                                    <th style='background:lightgrey'><?php echo $this->lang->line('subject'); ?></th>
                                    <th class="text-right" style='background:lightgrey'><?php echo $this->lang->line('type'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($result_array)) {
                                    ?>
                                    <tr>
                                        <td colspan="12" class="text-danger text-center"><?php echo $this->lang->line('no_record_found'); ?></td>
                                    </tr>
                                    <?php
                                } else {
                                    foreach ($result_array as $key => $value) {
                                        ?>
                                        <tr>
                                            <td><?php echo $value['teacher_name'] ?></td>
                                            <td><?php echo $value['name'] ?></td>
                                            <td class="text-right"><?php echo $value['type'] ?></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
</div>
</section>
</div>