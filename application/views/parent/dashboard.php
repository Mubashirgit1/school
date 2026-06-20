<style type="text/css">
    @media print
    {
        .no-print, .no-print *
        {
            display: none !important;
        }
    }
</style>
<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>

<div class="content-wrapper" style="min-height: 946px;">  
    <section class="content-header">
        <!--<h1><i class="fa fa-users"></i> <?php echo $this->lang->line('my_children'); ?> <small><?php echo $this->lang->line('student1'); ?></small>        </h1>-->
    </section>
    
    
    
     <?php
            foreach ($student_list as $key => $student) {
                ?>
    
    
    <section class="content-header">
        <div class="box box-primary" style="margin-bottom: 0px;">
            <div class="box-body">
            <div class="col-xs-5 col-sm-3 col-md-2"  > 
            <?php  $url = $student['image'] != null ? $student['image'] : 'uploads/student_images/no_image.png';  ?>
                <img style='height:100px;width:100px' class="student-image profile-user-img img-responsive img-circle" src="<?= base_url().$url ?>" alt="User profile picture">
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
    
    
    <?php } ?>
    
    
    
    
    
    
    
    
    
    
    
    
    <section class="content" style='visibility:hidden'>
        <div class="row">
            <?php
            foreach ($student_list as $key => $student) {
                ?>
                <div class="col-md-3">     
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                            <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url() . $student['image'] ?>" alt="User profile picture">
                            <h3 class="profile-username text-center">
                                <a href="<?php echo site_url('parent/parents/getStudent/' . $student['id']); ?>"> <?php echo $student['firstname'] . " " . $student['lastname']; ?></a>
                            </h3>
                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b><?= admission_text() ?></b> <a class="pull-right text-aqua"><?php echo $student['admission_no']; ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b><?php echo $this->lang->line('roll_no'); ?></b> <a class="pull-right text-aqua"><?php echo $student['roll_no']; ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b><?php echo $this->lang->line('class'); ?></b> <a class="pull-right text-aqua"><?php echo $student['class']; ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b><?php echo $this->lang->line('section'); ?></b> <a class="pull-right text-aqua"><?php echo $student['section']; ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b><?php echo $this->lang->line('rte'); ?></b> <a class="pull-right text-aqua"><?php echo $student['rte']; ?></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </section>
</div>
