<link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
<script src="<?php echo base_url(); ?>backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-bullhorn"></i></i> <?php echo $this->lang->line('communicate'); ?> <small><?php echo $this->lang->line('student_fee1'); ?></small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo $this->lang->line('notice_board'); ?></h3>
                        <div class="box-tools pull-right">
                            <a href="<?php echo base_url() ?>admin/notification/add" class="btn btn-primary btn-sm" data-toggle="tooltip" title="" data-original-title="<?php echo $this->lang->line('add'); ?>">
                                <i class="fa fa-plus"> <?php echo $this->lang->line('add'); ?></i>
                            </a>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="box-group" id="accordion">                        
                            <?php
                            foreach ($notificationlist as $key => $notification) {
                                ?>
                                <div class="panel box box-primary">
                                    <div class="box-header with-border">
                                        <h4 class="box-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $notification['id']; ?>" aria-expanded="false" class="collapsed">
                                                <?php echo $notification['title']; ?>
                                            </a>
                                        </h4>
                                        <div class="pull-right">
                                            <a href="<?php echo base_url() ?>admin/notification/edit/<?php echo $notification['id'] ?>" class="" data-toggle="tooltip" title="edit" data-original-title="<?php echo $this->lang->line('add'); ?>">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div id="collapse<?php echo $notification['id']; ?>" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                        <div class="box-body">
                                            <div class="row">
                                                <div class="col-md-9">
                                                    <?php echo $notification['message']; ?>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="box box-solid">
                                                        <div class="box-body no-padding">
                                                            <ul class="nav nav-pills nav-stacked">
                                                                <li><a href="#"><i class="fa fa-calendar-check-o"></i> <?php echo $this->lang->line('publish_date'); ?>: <?php echo $notification['publish_date']; ?></a> </li>
                                                                <li><a href="#"><i class="fa fa-calendar"></i><?php echo $this->lang->line('notice_date'); ?>: <?php echo $notification['date']; ?> </a></li>

                                                            </ul>
                                                            <h4 class="text text-primary"> <?php echo $this->lang->line('message_to'); ?></h4>
                                                            <ul class="nav nav-pills nav-stacked">
                                                                <li><a href="#"><i class="fa fa-user" aria-hidden="true"></i><?php echo $this->lang->line('student'); ?>: <?php echo $notification['visible_student']; ?></a> </li>
                                                                <li>
                                                                    <a href="#">
                                                                        <i class="fa fa-user" aria-hidden="true"></i>
                                                                        <?php echo $this->lang->line('parent'); ?>: <?php echo $notification['visible_parent']; ?> </a>
                                                                </li>
                                                                <li>
                                                                    <a href="#">
                                                                        <i class="fa fa-user" aria-hidden="true"></i>
                                                                        <?php echo $this->lang->line('teacher'); ?>: <?php echo $notification['visible_teacher']; ?> </a>
                                                                </li>

                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>


                        </div>
                    </div>                   
                </div>
            </div>         
        </div>
</div>
</section>
</div>
<script type="text/javascript">
    $(document).ready(function () {

        $('.date').datepicker({
            format: "dd-mm-yyyy",
            autoclose: true
        });
        $("#btnreset").click(function () {         
            $("#form1")[0].reset();
        });

    });
</script>
<script>
    $(function () {     
        $("#compose-textarea").wysihtml5();
    });
</script>