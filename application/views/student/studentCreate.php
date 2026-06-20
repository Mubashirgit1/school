<style type="text/css" >

.require{

    padding-left: 12px;
    padding-right: 12px;
    width: 58% ;
}

.require_st{

    padding-left: 0px;
    padding-right: 0px;
    width: 0.33%;
    color: red;
}

.select2-container{
    width:163px !important;
}
</style>

<?php  $admind = $this->session->userdata( 'admin' );
                    $this->load->helper('menu_helper');
                    $permission = admin_permission($admind['id']); ?>

<div class="content-wrapper">
    <section class="content-header">
       
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h4><?php echo $this->lang->line( 'student' ); ?><?php echo $this->lang->line( 'admission' ); ?> </h4>
                        <div class="pull-right box-tools">
                            <a href="<?php echo site_url( 'student/import' ) ?>">
                                <button class="btn btn-primary btn-sm">
                                    <i class="fa fa-upload"></i> <?php echo $this->lang->line( 'import_student' ); ?>
                                </button>
                            </a>
                        </div>
                    </div>
                    <form id="form1" action="<?php echo site_url( 'student/create' ) ?>" id="employeeform" name="employeeform" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                        <div class="box-body">

                            <?php if ( $this->session->flashdata( 'msg' ) ) { ?>
                                <?php echo $this->session->flashdata( 'msg' ) ?>
                            <?php } ?>
                            <?php echo $this->customlib->getCSRF(); ?>
                            <input type="hidden" name="sibling_name" value="<?php echo set_value( 'sibling_name' ); ?>" id="sibling_name_next">
                            <input type="hidden" name="sibling_id" value="<?php echo set_value( 'sibling_id' ); ?>" id="sibling_id">
                            <div class="row">
                                <!-- Left Column -->
                                <div class="col-sm-6">
                                    <h4>Required <small class="text-red">Last <?= admission_text() ?> : <?= $ad_id->admission_no ?></small></h4>
                                    <div class="admission_page_border">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-5">
                                                            <label for="exampleInputEmail1"><?php echo $this->lang->line( 'class' ); ?></label>
                                                        </div>
                                                        <div class="col-xs-1 require_st">*</div>
                                                        <div class="col-xs-6 require"  >

                                                            <select id="class_id" name="class_id" class="form-control" required>
                                                                <option value=""><?php echo $this->lang->line( 'select' ); ?></option>
                                                                <?php
                                                                foreach ( $classlist as $class ) {
                                                                    ?>
                                                                    <option value="<?php echo $class['id'] ?>"<?php if ( set_value( 'class_id' ) == $class['id'] ) echo "selected=selected" ?> data-admission="<?= $class['admission'] ?>"><?php echo $class['class'] ?></option>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </select>
                                                            <span class="text-danger"><?php echo form_error( 'class_id' ); ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">

                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-5">
                                                            <label for="exampleInputEmail1"><?php echo $this->lang->line( 'section' ); ?></label>
                                                        </div>
                                                        <div class="col-xs-1 require_st">*</div>
                                                        <div class="col-xs-6 require">
                                                            <select id="section_id" name="section_id" class="form-control" required>
                                                                <option value=""><?php echo $this->lang->line( 'select' ); ?></option>
                                                            </select>
                                                            <span class="text-danger"><?php echo form_error( 'section_id' ); ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            

                                            <div class="clearfix"></div>

                                            
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-5">
                                                            <label for="exampleInputEmail1"><?= admission_text() ?>.
                                                                <?php if($admission_key == 1){ ?>
                                                                    <br> <p id="admission_key"> </p>
                                                                <?php }?>                                   
                                                            </label>
                                                        </div>
                                                        <div class="col-xs-1 require_st">*</div>
                                                        <div class="col-xs-6 require">
                                                            <input id="admission_no" name="admission_no" placeholder="" type="text" class="form-control" value="<?php echo set_value( 'admission_no' ); ?>" required/>
                                                                <?php if($admission_key == 1){ ?>
                                                                    <input id="class_group" name="class_group" placeholder="" type="hidden" />
                                                                <?php }?>                                   
                                                            <span class="text-danger"><?php echo form_error( 'admission_no' ); ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-5">

                                                            <label for="exampleInputEmail1">Roll No.</label>
                                                        </div>
                                                        <div class="col-xs-1 require_st">*</div>
                                                        <div class="col-xs-6 require">
                                                            <input id="roll_no" name="roll_no" placeholder="" type="text" class="form-control" value="" required />
                                                            <span class="text-danger"><?php echo form_error( 'roll_no' ); ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-5">
                                                            <label for="exampleInputEmail1"><?php echo $this->lang->line( 'first_name' ); ?></label>
                                                        </div>
                                                        <div class="col-xs-1 require_st">*</div>
                                                        <div class="col-xs-6 require">
                                                            <input id="firstname" name="firstname" placeholder="" type="text" class="form-control" value="<?php echo set_value( 'firstname' ); ?>" required />
                                                            <span class="text-danger"><?php echo form_error( 'firstname' ); ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-5">
                                                            <label for="exampleInputEmail1"><?php echo $this->lang->line( 'last_name' ); ?></label>
                                                        </div>

                                                        <div class="col-xs-7">
                                                            <input id="lastname" name="lastname" placeholder="" type="text" class="form-control" value="<?php echo set_value( 'lastname' ); ?>"/>
                                                            <span class="text-danger"><?php echo form_error( 'lastname' ); ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="clearfix"></div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-5">
                                                            <label for="exampleInputFile"> <?php echo $this->lang->line( 'gender' ); ?></label>
                                                        </div>
                                                        <div class="col-xs-1 require_st">*</div>
                                                        <div class="col-xs-6 require">
                                                            <select class="form-control" name="gender" required>
                                                                <option value=""><?php echo $this->lang->line( 'select' ); ?></option>
                                                                <?php
                                                                foreach ( $genderList as $key => $value ) {
                                                                    ?>
                                                                    <option value="<?php echo $key; ?>" <?php if ( set_value( 'gender' ) == $key ) echo "selected"; ?>><?php echo $value; ?></option>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </select>
                                                            <span class="text-danger"><?php echo form_error( 'gender' ); ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-5">
                                                            <label for="exampleInputEmail1"><?php echo $this->lang->line( 'date_of_birth' ); ?></label>
                                                        </div>

                                                        <div class="col-xs-7">
                                                            <input id="dob" name="dob" autocomplete="off" placeholder="" type="text" class="form-control" value="<?php echo set_value( 'dob' ); ?>"/>
                                                            <span class="text-danger"><?php echo form_error( 'dob' ); ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="clearfix"></div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-5">
                                                            <label for="exampleInputEmail1"><?php echo $this->lang->line( 'admission_date' ); ?></label>
                                                        </div>

                                                        <div class="col-xs-7">
                                                            <input id="admission_date" autocomplete="off" name="admission_date" placeholder="" type="text" class="form-control" value="<?php echo set_value( 'admission_date', date( 'd-m-Y', now() ) ); ?>"/>
                                                            <span class="text-danger"><?php echo form_error( 'admission_date' ); ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                              <div class="col-md-6">
                                               <div class="row">
                                                        <div class="col-xs-5">
                                                            <label for="exampleInputEmail1">Admission Class</label>
                                                        </div>
                                                   <div class="col-xs-1 require_st">*</div>
                                                             <div class="col-xs-6 require">
                                                            <select id="admission_class_id" name="admission_class_id" class="form-control" >
                                                                <option value=""><?php echo $this->lang->line( 'select' ); ?></option>
                                                                <?php
                                                                foreach ( $classlist as $class ) {
                                                                    ?>
                                                                    <option value="<?php echo $class['id'] ?>"<?php if ( set_value( 'class_id' ) == $class['id'] ) echo "selected=selected" ?>><?php echo $class['class'] ?></option>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </select>
                                   <span class="text-danger"><?php echo form_error( 'class_id' ); ?></span>
                                                        </div>
                                                        
                                                        </div>
                                                         </div> 
                                                        
                                            <div class="col-md-6" style="display:none;">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-5">
                                                            <label for="exampleInputEmail1"><?php echo $this->lang->line( 'fees_discount' ); ?></label>
                                                        </div>
                                                        <div class="col-xs-7">
                                                            <input id="fees_discount" name="fees_discount" placeholder="" type="text" class="form-control" value="<?php echo set_value( 'fees_discount' ); ?>"/>
                                                            <span class="text-danger"><?php echo form_error( 'fees_discount' ); ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="clearfix"></div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-5">
                                                            <label for="exampleInputFile"><?php echo $this->lang->line( 'select_image' ); ?></label>
                                                        </div>
                                                        <div class="col-xs-7">
                                                            <input type='file' name='file' id="file" size='20'/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <span class="text-danger"><?php echo form_error( 'file' ); ?></span>
                                            </div>

                                            <div class="col-md-6 col-xs-12" style="display: none;">
                                                <label><?php echo $this->lang->line( 'rte' ); ?></label>
                                                <div class="radio" style="margin-top: 2px;">
                                                    <label><input class="radio-inline" type="radio" name="rte" value="Yes" <?php
                                                        echo set_value( 'rte' ) == "yes" ? "checked" : "";
                                                        ?> ><?php echo $this->lang->line( 'yes' ); ?></label>
                                                    <label><input class="radio-inline" checked="checked" type="radio" name="rte" value="No" <?php
                                                        echo set_value( 'rte' ) == "no" ? "checked" : "";
                                                        ?> ><?php echo $this->lang->line( 'no' ); ?></label>
                                                </div>
                                                <span class="text-danger"><?php echo form_error( 'rte' ); ?></span>
                                            </div>

                                            <div class="clearfix"></div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-5">
                                                            <label for="exampleInputDiscount">Discount (in Rs)</label>
                                                        </div>
                                                        <div class="col-xs-7">
                                                            <input type="number" id="discount" name="discount" class="form-control" value="<?= set_value( 'discount' ) ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <span class="text-danger"><?php echo form_error( 'discount' ); ?></span>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-5">
                                                            <label for="inputClassFee">Fee</label>
                                                        </div>
                                                        <div class="col-xs-7">
                                                            <input type="number" class="form-control" name="class_student_fee" value="" disabled="disabled">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div> <!-- Left Column Ends -->

                                <!-- Right Column -->
                                <div class="col-sm-6">

                                    <h4>Optional</h4>
                                    <div class="admission_page_border">
                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-5">
                                                            <label for="exampleInputEmail1"><?php echo $this->lang->line( 'religion' ); ?></label>
                                                        </div>
                                                        <div class="col-xs-7">
                                                            <input id="religion" name="religion" placeholder="" type="text" class="form-control" value="<?php echo set_value( 'religion' ); ?>"/>
                                                            <span class="text-danger"><?php echo form_error( 'religion' ); ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-5">
                                                            <label for="exampleInputEmail1"><?php echo $this->lang->line( 'cast' ); ?></label>
                                                        </div>
                                                        <div class="col-xs-7">
                                                            <input id="cast" name="cast" placeholder="" type="text" class="form-control" value="<?php echo set_value( 'cast' ); ?>"/>
                                                            <span class="text-danger"><?php echo form_error( 'cast' ); ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="clearfix"></div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-5">
                                                            <label for="exampleInputEmail1"><?php echo $this->lang->line( 'mobile_no' ); ?></label>
                                                        </div>
                                                        <div class="col-xs-7">
                                                            <input id="mobileno" name="mobileno" placeholder="" type="text" class="form-control" value="<?php echo set_value( 'mobileno' ); ?>"/>
                                                            <span class="text-danger"><?php echo form_error( 'mobileno' ); ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-5">
                                                            <label for="exampleInputEmail1"><?php echo $this->lang->line( 'email' ); ?></label>
                                                        </div>
                                                        <div class="col-xs-7">
                                                            <input id="email" name="email" placeholder="" type="text" class="form-control" value="<?php echo set_value( 'email' ); ?>"/>
                                                            <span class="text-danger"><?php echo form_error( 'email' ); ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="clearfix"></div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-5">
                                                            <label>Arrears</label>
                                                        </div>
                                                        <div class="col-xs-7">
                                                            <input id="arrears" name="arrears" placeholder="" type="number" class="form-control" value="<?php echo set_value( 'arrears', 0 ); ?>" min="0"/>
                                                            <span class="text-danger"><?php echo form_error( 'arrears' ); ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-5">
                                                            <label>Advance</label>
                                                        </div>
                                                        <div class="col-xs-7">
                                                            <input id="advance" name="advance" placeholder="" type="number" class="form-control" value="<?php echo set_value( 'advance', 0 ); ?>" min="0"/>
                                                            <span class="text-danger"><?php echo form_error( 'advance' ); ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="clearfix"></div>

                                            <div class="col-xs-12">Fee starting</div>
                                            <br><br>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-5">
                                                            <label>Year</label>
                                                        </div>
                                                        <div class="col-xs-7">
                                                            <select name="fee_starting_year" class="form-control" id="fee_starting_year">
                                                                <?php foreach ( $fee_starting->year as $fs_year ): ?>
                                                                    <option value="<?= $fs_year ?>" <?= set_select( 'fee_starting_year', $fs_year, ( $fs_year == date( 'Y', now() ) ) ) ?>><?= $fs_year ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                            <span class="text-danger"><?php echo form_error( 'fee_starting_year' ); ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-5">
                                                            <label>Month</label>
                                                        </div>
                                                        <div class="col-xs-7">
                                                            <select name="fee_starting_month" class="form-control" id="fee_starting_month">
                                                                <?php foreach ( $fee_starting->month as $fs_month ): ?>
                                                                    <option value="<?= $fs_month['value'] ?>" <?= set_select( 'fee_starting_month', $fs_month['value'], ( $fs_month['value'] == date( 'm', now() ) ) ) ?>><?= $fs_month['name'] ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                            <span class="text-danger"><?php echo form_error( 'fee_starting_month' ); ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div><!-- Right Column Ends -->
                            </div>

                            <br>
                            <h4><?php echo $this->lang->line( 'parent_guardian_detail' ); ?></h4>
                            <hr>

                            <div class="row">

                                <!-- Left column -->
                                <div class="col-sm-6">
                                    <h4>Required</h4>
                                    <div class="admission_page_border">
                                        <div class="row">
                                        <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-5">
                                                            <label for="exampleInputEmail1"><?php echo $this->lang->line( 'father_phone' ); ?></label>
                                                        </div>
                                                        <div class="col-xs-1 require_st">*</div>
                                                        <div class="col-xs-6 require">
                                                            <input id="father_phone" name="father_phone" placeholder="" type="text" required class="form-control fill_guardian" value="<?php echo set_value( 'father_phone' ); ?>" data-target="#guardian_phone"/>
                                                            <span class="text-danger"><?php echo form_error( 'father_phone' ); ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-5">
                                                            <label for="exampleInputEmail1"><?php echo $this->lang->line( 'father_name' ); ?></label>
                                                        </div>
                                                        <div class="col-xs-1 require_st">*</div>
                                                        <div class="col-xs-6 require">
                                                            <input id="father_name" name="father_name" placeholder="" type="text" class="form-control fill_guardian" value="<?php echo set_value( 'father_name' ); ?>" data-target="#guardian_name" required />
                                                            <span class="text-danger"><?php echo form_error( 'father_name' ); ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="clearfix"></div>
                                            
                                           
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-5">
                                                            <label for="exampleInputEmail1"><?php echo $this->lang->line( 'father_occupation' ); ?></label>
                                                        </div>

                                                        <div class="col-xs-7">
                                                            <input id="father_occupation" name="father_occupation" placeholder="" type="text" class="form-control fill_guardian" value="<?php echo set_value( 'father_occupation' ); ?>" data-target="#guardian_occupation"/>
                                                            <span class="text-danger"><?php echo form_error( 'father_occupation' ); ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="clearfix"></div>

                                            <div class="col-md-12">
                                                <label><?php echo $this->lang->line( 'if_guardian_is' ); ?>&nbsp;&nbsp;&nbsp;</label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="guardian_is" value="father" <?= set_radio( 'guardian_is', 'father', true ) ?> > <?php echo $this->lang->line( 'father' ); ?>
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="guardian_is" value="mother" <?= set_radio( 'guardian_is', 'mother' ) ?> > <?php echo $this->lang->line( 'mother' ); ?>
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="guardian_is" value="other" <?= set_radio( 'guardian_is', 'other' ) ?> > <?php echo $this->lang->line( 'other' ); ?>
                                                </label>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-5">
                                                            <label for="exampleInputEmail1"><?php echo $this->lang->line( 'guardian_name' ); ?></label>
                                                        </div>

                                                        <div class="col-xs-7">
                                                            <input id="guardian_name" name="guardian_name" placeholder="" type="text" class="form-control" value="<?php echo set_value( 'guardian_name' ); ?>" required />
                                                            <span class="text-danger"><?php echo form_error( 'guardian_name' ); ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-5">
                                                            <label for="exampleInputEmail1"><?php echo $this->lang->line( 'guardian_phone' ); ?></label>
                                                        </div>

                                                        <div class="col-xs-7">
                                                            <input id="guardian_phone" name="guardian_phone" placeholder="" type="text" class="form-control" value="<?php echo set_value( 'guardian_phone' ); ?>"/>
                                                            <span class="text-danger"><?php echo form_error( 'guardian_phone' ); ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-5">
                                                            <label for="exampleInputEmail1"><?php echo $this->lang->line( 'guardian_relation' ); ?></label>
                                                        </div>

                                                        <div class="col-xs-7">
                                                            <input id="guardian_relation" name="guardian_relation" placeholder="" type="text" class="form-control" value="<?php echo set_value( 'guardian_relation' ); ?>"/>
                                                            <span class="text-danger"><?php echo form_error( 'guardian_relation' ); ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-5">
                                                            <label for="exampleInputEmail1"><?php echo $this->lang->line( 'guardian_occupation' ); ?></label>
                                                        </div>

                                                        <div class="col-xs-7">
                                                            <input id="guardian_occupation" name="guardian_occupation" placeholder="" type="text" class="form-control" value="<?php echo set_value( 'guardian_occupation' ); ?>"/>
                                                            <span class="text-danger"><?php echo form_error( 'guardian_occupation' ); ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-5">
                                                            <label for="exampleInputEmail1"><?php echo $this->lang->line( 'guardian_address' ); ?></label>
                                                        </div>

                                                        <div class="col-xs-7">
                                                            <textarea id="guardian_address" name="guardian_address" placeholder="" class="form-control" rows="4"></textarea>
                                                            <span class="text-danger"><?php echo form_error( 'guardian_address' ); ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="clearfix"></div>

                                            <div class="col-md-6">
                                       
                                            </div>

                                

                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div><!-- Left column ends -->

                                <!-- Right column -->
                                <div class="col-sm-6">
                                    <h4>Optional</h4>
                                    <div class="admission_page_border">
                                        <div class="row">
                                        <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-5">
                                                            <label for="exampleInputEmail1">Father CNIC</label>
                                                        </div>

                                                        <div class="col-xs-7">
                                                            <input id="father_cnic" name="father_cnic" type="text" class="form-control" value="<?php echo set_value( 'father_cnic' ); ?>" placeholder="CNIC without dashes"  />
                                                            <span class="text-danger"><?php echo form_error( 'father_cnic' ); ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-5">
                                                            <label for="exampleInputEmail1">B-Form</label>
                                                        </div>

                                                        <div class="col-xs-7">
                                                            <input id="b_form" name="b_form" type="text" class="form-control" value="<?php echo set_value( 'b_form' ); ?>" placeholder="B form "  />
                                                            <span class="text-danger"><?php echo form_error( 'b_form' ); ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                            <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-5">
                                                            <label for="exampleInputEmail1"><?php echo $this->lang->line( 'mother_phone' ); ?></label>
                                                        </div>

                                                        <div class="col-xs-7">
                                                            <input id="mother_phone" name="mother_phone" placeholder="" type="text" class="form-control" value="<?php echo set_value( 'mother_phone' ); ?>"/>
                                                            <span class="text-danger"><?php echo form_error( 'mother_phone' ); ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                           
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-5">
                                                            <label for="exampleInputEmail1"><?php echo $this->lang->line( 'mother_name' ); ?></label>
                                                        </div>

                                                        <div class="col-xs-7">
                                                            <input id="mother_name" name="mother_name" placeholder="" type="text" class="form-control" value="<?php echo set_value( 'mother_name' ); ?>"/>
                                                            <span class="text-danger"><?php echo form_error( 'mother_name' ); ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-5">
                                                            <label for="exampleInputEmail1"><?php echo $this->lang->line( 'mother_occupation' ); ?></label>
                                                        </div>

                                                        <div class="col-xs-7">
                                                            <input id="mother_occupation" name="mother_occupation" placeholder="" type="text" class="form-control" value="<?php echo set_value( 'mother_occupation' ); ?>"/>
                                                            <span class="text-danger"><?php echo form_error( 'mother_occupation' ); ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="clearfix"></div>

                                          
                                        </div>
                                    </div>
                                </div><!-- Right column ends -->
                            </div>

                            <div style="display: inline-block; width: 100%;">
                                <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line( 'save' ); ?></button>
                            </div>

                            <div class="box-group" id="accordion">
                                <div class="panel box box-success">
                                    <div class="box-header with-border">
                                        <h4 class="box-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" class="collapsed">
                                                <i class="fa fa-fw fa-plus-square"></i><?php echo $this->lang->line( 'add_more_details' ); ?>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                        <div class="box-body">
                                            <h4><?php echo $this->lang->line( 'student' ); ?><?php echo $this->lang->line( 'address' ); ?><?php echo $this->lang->line( 'details' ); ?></h4>
                                            <hr>
                                            <div class="row">
                                                <div class="">
                                                    <div class="col-md-6">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" id="autofill_current_address" onclick="return auto_fill_guardian_address();">
                                                                <?php echo $this->lang->line( 'if_guardian_address_is_current_address' ); ?>
                                                            </label>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1"><?php echo $this->lang->line( 'current_address' ); ?></label>
                                                            <textarea id="current_address" name="current_address" placeholder="" class="form-control"><?php echo set_value( 'current_address' ); ?></textarea>
                                                            <span class="text-danger"><?php echo form_error( 'current_address' ); ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="checkbox">
                                                            <label>
                                                                <input type="checkbox" id="autofill_address" onclick="return auto_fill_address();">
                                                                <?php echo $this->lang->line( 'if_permanent_address_is_current_address' ); ?>
                                                            </label>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1"><?php echo $this->lang->line( 'permanent_address' ); ?></label>
                                                            <textarea id="permanent_address" name="permanent_address" placeholder="" class="form-control"></textarea>
                                                            <span class="text-danger"><?php echo form_error( 'permanent_address' ); ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <h4>
                                                <?php echo $this->lang->line( 'transport' ) . " " . $this->lang->line( 'details' ); ?>
                                            </h4>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1"><?php echo $this->lang->line( 'route_list' ); ?></label>
                                                        <select class="form-control" id="vehroute_id" name="vehroute_id">

                                                            <option value=""><?php echo $this->lang->line( 'select' ); ?></option>
                                                            <?php
                                                            foreach ( $vehroutelist as $vehroute ) {
                                                                ?>
                                                                <optgroup label=" <?php echo $vehroute->route_title; ?>">
                                                                    <?php
                                                                    $vehicles = $vehroute->vehicles;
                                                                    if ( !empty( $vehicles ) ) {
                                                                        foreach ( $vehicles as $key => $value ) {
                                                                            ?>

                                                                            <option value="<?php echo $value->vec_route_id ?>" <?php echo set_select( 'vehroute_id', $value->vec_route_id ); ?> data-fee="<?php echo $vehroute->fare; ?>">
                                                                                <?php echo $value->vehicle_no ?>
                                                                            </option>
                                                                            <?php
                                                                        }

                                                                    }
                                                                    ?>
                                                                </optgroup>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select>
                                                        <span class="text-danger"><?php echo form_error( 'transport_fees' ); ?></span>
                                                    </div>
                                                </div>

                                            </div>
                                            <h4><?php echo $this->lang->line( 'miscellaneous_details' ); ?>
                                            </h4>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1"><?php echo $this->lang->line( 'bank_account_no' ); ?></label>
                                                        <input id="bank_account_no" name="bank_account_no" placeholder="" type="text" class="form-control" value="<?php echo set_value( 'bank_account_no' ); ?>"/>
                                                        <span class="text-danger"><?php echo form_error( 'bank_account_no' ); ?></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1"><?php echo $this->lang->line( 'bank_name' ); ?></label>
                                                        <input id="bank_name" name="bank_name" placeholder="" type="text" class="form-control" value="<?php echo set_value( 'bank_name' ); ?>"/>
                                                        <span class="text-danger"><?php echo form_error( 'bank_name' ); ?></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1"><?php echo $this->lang->line( 'ifsc_code' ); ?></label>
                                                        <input id="ifsc_code" name="ifsc_code" placeholder="" type="text" class="form-control" value="<?php echo set_value( 'ifsc_code' ); ?>"/>
                                                        <span class="text-danger"><?php echo form_error( 'ifsc_code' ); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">
                                                            <?php echo $this->lang->line( 'national_identification_no' ); ?>
                                                        </label>
                                                        <input id="adhar_no" name="adhar_no" placeholder="" type="text" class="form-control" value="<?php echo set_value( 'adhar_no' ); ?>"/>
                                                        <span class="text-danger"><?php echo form_error( 'adhar_no' ); ?></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">
                                                            <?php echo $this->lang->line( 'local_identification_no' ); ?>
                                                        </label>
                                                        <input id="samagra_id" name="samagra_id" placeholder="" type="text" class="form-control" value="<?php echo set_value( 'samagra_id' ); ?>"/>
                                                        <span class="text-danger"><?php echo form_error( 'samagra_id' ); ?></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1"><?php echo $this->lang->line( 'previous_school_details' ); ?></label>
                                                        <textarea class="form-control" rows="3" placeholder="" name="previous_school"></textarea>
                                                        <span class="text-danger"><?php echo form_error( 'previous_school' ); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id='upload_documents_hide_show'>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h4><?php echo $this->lang->line( 'upload_documents' ); ?></h4>
                                                        <div class="col-md-6">
                                                            <table class="table">
                                                                <tbody>
                                                                    <tr>
                                                                        <th style="width: 10px">#</th>
                                                                        <th><?php echo $this->lang->line( 'title' ); ?></th>
                                                                        <th><?php echo $this->lang->line( 'Documents' ); ?></th>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>1.</td>
                                                                        <td>
                                                                            <input type="text" name='first_title' class="form-control" placeholder="">
                                                                        </td>
                                                                        <td>
                                                                            <input type='file' name='first_doc' id="doc1">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>2.</td>
                                                                        <td>
                                                                            <input type="text" name='second_title' class="form-control" placeholder="">
                                                                        </td>
                                                                        <td>
                                                                            <input type='file' name='second_doc' id="doc1">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>3.</td>
                                                                        <td>
                                                                            <input type="text" name='third_title' class="form-control" placeholder="">
                                                                        </td>
                                                                        <td>
                                                                            <input type='file' name='third_doc' id="doc1">
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <table class="table">
                                                                <tbody>
                                                                    <tr>
                                                                        <th style="width: 10px">#</th>
                                                                        <th><?php echo $this->lang->line( 'title' ); ?></th>
                                                                        <th><?php echo $this->lang->line( 'Documents' ); ?></th>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>4.</td>
                                                                        <td>
                                                                            <input type="text" name='fourth_title' class="form-control" placeholder="">
                                                                        </td>
                                                                        <td>
                                                                            <input type='file' name='fourth_doc' id="doc1">
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>5.</td>
                                                                        <td>
                                                                            <input type="text" name='fifth_title' class="form-control" placeholder="">
                                                                        </td>
                                                                        <td>
                                                                            <input type='file' name='fifth_doc' id="doc1">
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line( 'save' ); ?></button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
</div>
</section>
</div>


<div class="modal fade" id="mySiblingModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title title text-center modal_title"></h4>
            </div>
            <div class="modal-body">
                <div class="form-horizontal">
                    <div class="box-body">
                        <div class="sibling_msg">

                        </div>
                        <input type="hidden" class="form-control" id="transport_student_session_id" value="0" readonly/>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label"><?php echo $this->lang->line( 'class' ); ?></label>
                            <div class="col-sm-10">
                                <select id="sibiling_class_id" name="sibiling_class_id" class="form-control">
                                    <option value=""><?php echo $this->lang->line( 'select' ); ?></option>
                                    <?php
                                    foreach ( $classlist as $class ) {
                                        ?>
                                        <option value="<?php echo $class['id'] ?>"<?php if ( set_value( 'sibiling_class_id' ) == $class['id'] ) echo "selected=selected" ?>><?php echo $class['class'] ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label"><?php echo $this->lang->line( 'section' ); ?></label>
                            <div class="col-sm-10">
                                <select id="sibiling_section_id" name="sibiling_section_id" class="form-control">
                                    <option value=""><?php echo $this->lang->line( 'select' ); ?></option>
                                </select>
                                <span class="text-danger" id="transport_amount_error"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label"><?php echo $this->lang->line( 'student' ); ?>
                            </label>

                            <div class="col-sm-10">
                                <select id="sibiling_student_id" name="sibiling_student_id" class="form-control">
                                    <option value=""><?php echo $this->lang->line( 'select' ); ?></option>
                                </select>
                                <span class="text-danger" id="transport_amount_fine_error"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><?php echo $this->lang->line( 'cancel' ); ?></button>
                <button type="button" class="btn btn-primary add_sibling" id="load" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing">
                    <i class="fa fa-user"></i> <?php echo $this->lang->line( 'add' ); ?></button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    jQuery( function ( $ ) {
        $( '#father_phone' ).change( function () {
            var t = this,
                father_phone = $( this ).val().trim(),
                site_url = "<?= site_url() ?>ajax/student/father_information/",
                dom_father_name = $( '#father_name' ),
                dom_father_cnic = $( '#father_cnic' ),
                dom_father_occupation = $( '#father_occupation' );
            // if valid cnic
            if ( father_phone.length != 12 ) {
        		alert( "Please provide correct phone number or student's father, with dashed, having 12 digits." );
		    } else {
                // $( t ).val( "Loading..." );
                dom_father_name.val( "Loading..." );
                // dom_father_cnic.val( "Loading..." );
                dom_father_occupation.val( "Loading..." );

                $.get( site_url + father_phone, function ( data ) {
                    if ( data.error === false ) {
                        var father_details = data.data;

                        dom_father_name.val( father_details.father_name );
                        // dom_father_cnic.val( father_details.father_cnic );
                        dom_father_occupation.val( father_details.father_occupation );

                        // already focused field
                        var focused = $( ":focus" );

                        // focusing on all of the fill guardian fields
                        $( ".fill_guardian" ).each( function ( i, d ) {
                            $( d ).focus();
                        } );

                        // moving back where the focus was
                        if ( focused.length > 0 ) {
                            $( focused ).focus();
                        }
                    } else {
                        dom_father_name.val( "" );
                        // dom_father_cnic.val( "" );
                        dom_father_occupation.val( "" );
                    }

                    $( t ).val( father_phone );
                } );
            }
        } );
    } );
</script>

<script type="text/javascript">
    function getSectionByClass( class_id, section_id ) {
        if ( class_id != "" && section_id != "" ) {
            $( '#section_id' ).html( "" );
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line( 'select' ); ?></option>';
            $.ajax( {
                type: "GET",
                url: base_url + "sections/getByClass",
                data: {'class_id': class_id},
                dataType: "json",
                success: function ( data ) {
                    $.each( data, function ( i, obj ) {
                        var sel = "";
                        if ( section_id == obj.section_id ) {
                            sel = "selected";
                        }
                        div_data += "<option value=" + obj.section_id + " " + sel + ">" + obj.section + "</option>";
                    } );
                    $( '#section_id' ).append( div_data );
                }
            } );
        }
    }

    $( document ).ready( function () {
        //var date_format = '<?php echo $result = strtr( $this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',] ) ?>';
        var date_format = 'dd-mm-yyyy';
        var class_id = $( '#class_id' ).val();
        var section_id = '<?php echo set_value( 'section_id' ) ?>';
        getSectionByClass( class_id, section_id );

        $( document ).on( 'change', '#class_id', function ( e ) {
            $( '#section_id' ).html( "" );
            var class_id = $( this ).val();
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line( 'select' ); ?></option>';
            $.ajax( {
                type: "GET",
                url: base_url + "sections/getByClassCreate",
                data: {'class_id': class_id},
                dataType: "json",
                success: function ( data ) {
                    if( data.class){
                        $("#admission_key").text("Group Key ( "+data.class.admission_key + ")");
                        $("#class_group").val(data.class.admission_key);
                    }
                   
                    $.each( data.sections, function ( i, obj ) {
                        div_data += "<option value=" + obj.section_id + ">" + obj.section + "</option>";
                    } );
                    $( '#section_id' ).append( div_data );
                }
            } );
        } );


        $( '#dob,#admission_date' ).datepicker( {
            format: date_format,
            autoclose: true
        } );

        $( "#btnreset" ).click( function () {
            $( "#form1" )[0].reset();
        } );

    } );

    function auto_fill_guardian_address() {
        if ( $( "#autofill_current_address" ).is( ':checked' ) ) {
            $( '#current_address' ).val( $( '#guardian_address' ).val() );
        }
    }

    function auto_fill_address() {
        if ( $( "#autofill_address" ).is( ':checked' ) ) {
            $( '#permanent_address' ).val( $( '#current_address' ).val() );
        }
    }
    
    $( 'input:radio[name="guardian_is"]' ).change(
        function () {
            if ( $( this ).is( ':checked' ) ) {
                var value = $( this ).val();
                if ( value == "father" ) {
                    $( '#guardian_name' ).val( $( '#father_name' ).val() );
                    $( '#guardian_phone' ).val( $( '#father_phone' ).val() );
                    $( '#guardian_occupation' ).val( $( '#father_occupation' ).val() );
                    $( '#guardian_relation' ).val( "Father" )

                } else if ( value == "mother" ) {
                    $( '#guardian_name' ).val( $( '#mother_name' ).val() );
                    $( '#guardian_phone' ).val( $( '#mother_phone' ).val() );
                    $( '#guardian_occupation' ).val( $( '#mother_occupation' ).val() );
                    $( '#guardian_relation' ).val( "Mother" )
                } else {
                    $( '#guardian_name' ).val( "" );
                    $( '#guardian_phone' ).val( "" );
                    $( '#guardian_occupation' ).val( "" );
                    $( '#guardian_relation' ).val( "" )
                }
            }
        } );


</script>

<script type="text/javascript">
    $( ".mysiblings" ).click( function () {
        $( '.sibling_msg' ).html( "" );
        $( '.modal_title' ).html( '<b>' + "<?php echo $this->lang->line( 'sibling' ); ?>" + '</b>' );
        $( '#mySiblingModal' ).modal( {
            backdrop: 'static',
            keyboard: false,
            show: true
        } );
    } );
</script>

<script type="text/javascript">

    $( document ).on( 'change', '#sibiling_class_id', function ( e ) {
        $( '#sibiling_section_id' ).html( "" );
        var class_id = $( this ).val();
        var base_url = '<?php echo base_url() ?>';
        var div_data = '<option value=""><?php echo $this->lang->line( 'select' ); ?></option>';
        $.ajax( {
            type: "GET",
            url: base_url + "sections/getByClass",
            data: {'class_id': class_id},
            dataType: "json",
            success: function ( data ) {
                $.each( data, function ( i, obj ) {
                    div_data += "<option value=" + obj.section_id + ">" + obj.section + "</option>";
                } );
                $( '#sibiling_section_id' ).append( div_data );
            }
        } );
    } );


    $( document ).on( 'change', '#sibiling_section_id', function ( e ) {
        getStudentsByClassAndSection();
		
    } );
    function getStudentsByClassAndSection() {
        $( '#sibiling_student_id' ).html( "" );
        var class_id = $( '#sibiling_class_id' ).val();
        var section_id = $( '#sibiling_section_id' ).val();
        var student_id = '<?php echo set_value( 'student_id' ) ?>';
        var base_url = '<?php echo base_url() ?>';
        var div_data = '<option value=""><?php echo $this->lang->line( 'select' ); ?></option>';
        $.ajax( {
            type: "GET",
            url: base_url + "student/getByClassAndSection",
            data: {'class_id': class_id, 'section_id': section_id},
            dataType: "json",
            success: function ( data ) {
                $.each( data, function ( i, obj ) {
                    var sel = "";
                    if ( section_id == obj.section_id ) {
                        sel = "selected=selected";
                    }
                    div_data += "<option value=" + obj.id + ">" + obj.firstname + " " + obj.lastname + "</option>";
                } );
                $( '#sibiling_student_id' ).append( div_data );
            }
        } );
    }

    $( document ).on( 'click', '.add_sibling', function () {
        var student_id = $( '#sibiling_student_id' ).val();
        var base_url = '<?php echo base_url() ?>';
        if ( student_id.length > 0 ) {
            $.ajax( {
                type: "GET",
                url: base_url + "student/getStudentRecordByID",
                data: {'student_id': student_id},
                dataType: "json",
                success: function ( data ) {
                    $( '#sibling_name' ).text( "Sibling: " + data.firstname + " " + data.lastname );
                    $( '#sibling_name_next' ).val( data.firstname + " " + data.lastname );
                    $( '#sibling_id' ).val( student_id );
                    $( '#father_name' ).val( data.father_name );
                    $( '#father_phone' ).val( data.father_phone );
                    $( '#father_occupation' ).val( data.father_occupation );
                    $( '#mother_name' ).val( data.mother_name );
                    $( '#mother_phone' ).val( data.mother_phone );
                    $( '#mother_occupation' ).val( data.mother_occupation );
                    $( '#guardian_name' ).val( data.guardian_name );
                    $( '#guardian_relation' ).val( data.guardian_relation );
                    $( '#guardian_address' ).val( data.guardian_address );
                    $( '#guardian_phone' ).val( data.guardian_phone );
                    $( '#state' ).val( data.state );
                    $( '#city' ).val( data.city );
                    $( '#pincode' ).val( data.pincode );
                    $( '#current_address' ).val( data.current_address );
                    $( '#permanent_address' ).val( data.permanent_address );
                    $( '#guardian_occupation' ).val( data.guardian_occupation );
                    $( "input[name=guardian_is][value='" + data.guardian_is + "']" ).prop( "checked", true );
                    $( '#mySiblingModal' ).modal( 'hide' );
                }
            } );
        } else {
            $( '.sibling_msg' ).html( "<div class='alert alert-danger'>No Student Selected</div>" );
        }

    } );
</script>

<script type="text/javascript">
    jQuery( function ( $ ) {
        // adding father information as guardian information if father is selected.
        $( '.fill_guardian' ).on( 'click change keyup focusin focusout', function ( e ) {
            var guardian_is = $( "input[type='radio'][name='guardian_is']:checked" ).val(),
                target = $( this ).data( 'target' );

            if ( typeof guardian_is != 'undefined' && guardian_is == 'father' ) {
                if ( typeof target !== 'undefined' ) {
                    var current_field_value = $( this ).val();
                    $( target ).val( current_field_value );
                    $( "#guardian_relation" ).val( guardian_is );
                }
            }
        } );

        // adding class fee to the class fee input
        var add_class_fee = function (fee1 = null) {
            var class_id = $( "#class_id" ).val(),
                discount = $( "#discount" ).val(),
				
                path = "<?= site_url( 'api/ClassApi/class_details' ) ?>";

            discount = (typeof discount === 'undefined' || $.trim( discount ) == '' ? 0 : discount);

            if ( typeof class_id !== 'undefined' ) {
                var url = path + '/' + class_id,
                    fee = 0;

                $.get( url, [], function ( data ) {
                    fee = parseInt( data.fee );

                    if(fee - parseInt( discount ) >=  0 ){
                        $( "input[name='class_student_fee']" ).val( fee - parseInt( discount ) );
                    }else{
                        if(fee1){
                            alert("discount will be not greater then fee");
                        }
                        $( "input[name='discount']" ).val( 0 );
                        $( "input[name='class_student_fee']" ).val( fee );
                    }
                }, 'json' );
            }
        };
        var rollPermission  =  <?= $permission->admission_roll ?>;
		   var add_class_roll = function () {
            var class_id = $( "#class_id" ).val(),
                section_id = $( "#section_id" ).val(),
                path = "<?= site_url( 'api/ClassApi/class_roll' ) ?>";

            discount = (typeof discount === 'undefined' || $.trim( discount ) == '' ? 0 : discount);

            if ( typeof class_id !== 'undefined' ) {
                var url = path + '/' + class_id + '/' +section_id ,
                    fee = 1;
                     $.get( url, [], function ( data ) {
					if(data){
                    
                    if(rollPermission == 0){
                        $( "input[name='roll_no']" ).val( parseInt(data.roll_no)+fee );
                    }
                    
                    }else{
                        alert("Add start Roll number");
                    }
                   
                }, 'json' );
            }
        };


        $( '#admission_no' ).keydown(
        function () {
            if(rollPermission == 1){
                $( '#roll_no' ).val($( '#admission_no' ).val( ) );
            }
        });
      
        
        
	
        add_class_fee();
	    
        $( "#class_id, #discount" ).on( 'change', function () {
            add_class_fee(1);
        } );
		$( " #section_id" ).on( 'change', function () {
			add_class_roll();
		 } );
    } );
</script>

<script type="text/javascript">
    jQuery( function ( $ ) {
        $( "#form1" ).submit( function ( e ) {

            var fee_starting_year = $( '#fee_starting_year' ).val(),
                fee_starting_month = $( '#fee_starting_month option:selected' ).text(),
                fee_starting_confirmation = confirm( "You are registering student with fee starting year as " + fee_starting_year + " and month as " + fee_starting_month + ".\nDo you want to continue?" );

            if ( fee_starting_confirmation === false ) {
                e.preventDefault();
            }
        } );
    } );
</script>



<script>
 
 $("#father_phone").keyup(function() {
    zipcode = $(this).val();
    zipcode = zipcode.replace(/-/g, '');      // remove all occurrences of '-'
    if(zipcode.length > 3) {
        $(this).val(zipcode.substring(0, 4) + "-" + zipcode.substring(4));
    }
});

$("#father_cnic").keyup(function() {
    zipcode = $(this).val();
    zipcode = zipcode.replace(/-/g, '');      // remove all occurrences of '-'
    if(zipcode.length > 6  ) {
        $(this).val(zipcode.substring(0, 5) + "-" + zipcode.substring(5));
    }
    if(zipcode.length > 12  ) {
        $(this).val(zipcode.substring(0, 12) + "-" + zipcode.substring(12));
    }
});


// $('#father_cnic').keydown(function(){
//   //allow  backspace, tab, ctrl+A, escape, carriage return
// //   if (event.keyCode == 8 || event.keyCode == 9 
// //                     || event.keyCode == 27 || event.keyCode == 13 
// //                     )
                        
// //   if((event.keyCode < 48 || event.keyCode > 57))
//  //  event.preventDefault();
//   var length = $(this).val().length; 
              
//   if(length == 5 || length == 13)
//    $(this).val($(this).val()+'-');
//  });
//      $('#father_phone').keyup(function(){
//          console.log("hello");
//     var length = $(this).val().length;     
//     if(length == 4)
//     $(this).val($(this).val()+'-');
//  });

</script>