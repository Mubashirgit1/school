<div class="content-wrapper" style="min-height: 946px;">   
  <section class="content-header">
    <h1>
      <i class="fa fa-user-secret"></i>  <?php echo $this->lang->line('profile'); ?>
    </h1>
  </section>  
  <section class="content">
    <div class="row">         
      <div class="col-md-4">

        <div class="box box-primary">
          <div class="box-body box-profile">                 
           <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url().$accountant['image']?>" alt="User profile picture">
           <h3 class="profile-username text-center"><?php echo $accountant['name'] ?></h3> 
           <ul class="list-group list-group-unbordered">
             <li class="list-group-item">
              <b><?php echo $this->lang->line('gender'); ?></b> <a class="pull-right text-aqua"><?php echo $accountant['sex'] ?></a>
            </li>
            <li class="list-group-item">
              <b><?php echo $this->lang->line('date_of_birth'); ?></b> <a class="pull-right text-aqua">                    
              <?php echo date($this->customlib->getSchoolDateFormat(),$this->customlib->dateyyyymmddTodateformat($accountant['dob']));?>
            </a>
          </li>
          <li class="list-group-item">
            <b><?php echo $this->lang->line('phone'); ?></b> <a class="pull-right text-aqua"><?php echo $accountant['phone'] ?></a>
          </li> 
          <li class="list-group-item">
            <b><?php echo $this->lang->line('email'); ?></b> <a class="pull-right text-aqua"><?php echo $accountant['email'] ?></a>
          </li>
          <li class="list-group-item">
            <b><?php echo $this->lang->line('address'); ?></b> <a class="pull-right text-aqua"><?php echo $accountant['address'] ?></a>
          </li>                    
        </ul> 
      </div>
    </div>
  </div>

</div>
</section>
</div>