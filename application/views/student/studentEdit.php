



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
        width:161px !important;
    }
    .disabledbutton_tuition_fee {
        pointer-events: none;
        opacity: 0.8;
    }
</style>

<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-user-plus"></i> <?php echo $this->lang->line( 'student_information' ); ?>
            <small><?php echo $this->lang->line( 'student1' ); ?></small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"> <?php echo $this->lang->line( 'edit' ); ?><?php echo $this->lang->line( 'student' ); ?></h3>
                        <div class="pull-right box-tools">
                        </div>
                    </div>
                    <form action="<?php echo site_url( "student/edit/" . $id ) ?>?redirect=<?= urlencode( $redirect ) ?>" id="employeeform" name="employeeform" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                        <div class="box-body">
                            <?php if ( $this->session->flashdata( 'msg' ) ) { ?>
                                <?php echo $this->session->flashdata( 'msg' ) ?>
                            <?php } ?>
                            <?php echo $this->customlib->getCSRF(); ?>

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
                                                            <label for="exampleInputEmail1"><?php echo $this->lang->line( 'admission_no' ); ?></label>
                                                        </div>
                                                        <div class="col-xs-1 require_st">*</div>
                                                        <div class="col-xs-6 require">
                                                            <input id="admission_no" name="admission_no" placeholder="" type="text" class="form-control" value="<?php echo set_value( 'admission_no', $student['admission_no'] ); ?>"/>
                                                            <span class="text-danger"><?php echo form_error( 'admission_no' ); ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-5">
                                                            <label for="exampleInputEmail1"><?php echo $this->lang->line( 'roll_no' ); ?></label>
                                                        </div>
                                                        <div class="col-xs-1 require_st">*</div>
                                                        <div class="col-xs-6 require">
                                                            <input id="roll_no" name="roll_no" placeholder="" type="text" class="form-control" value="<?php echo set_value( 'roll_no', $student['roll_no'] ); ?>"/>
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
                                                            <label for="exampleInputEmail1"><?php echo $this->lang->line( 'class' ); ?></label>
                                                        </div>
                                                        <div class="col-xs-1 require_st">*</div>
                                                        <div class="col-xs-6 require">
                                                            <select id="class_id" name="class_id" class="form-control">
                                                                <option value=""><?php echo $this->lang->line( 'select' ); ?></option>
                                                                <?php
                                                                foreach ( $classlist as $class ) {
                                                                    ?>
                                                                    <option value="<?php echo $class['id'] ?>" <?php
                                                                    if ( $student['class_id'] == $class['id'] ) {
                                                                        echo "selected =selected";
                                                                    }
                                                                    ?>><?php echo $class['class'] ?></option>
                                                                    <?php
                                                                    $count++;
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
                                                            <select id="section_id" name="section_id" class="form-control">
                                                                <option value="<?php echo $student['section_id'] ?>" <?php
                                                                    ?>><?php echo $student['section'] ?></option>
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
                                                            <label for="exampleInputEmail1"><?php echo $this->lang->line( 'first_name' ); ?></label>
                                                        </div>
                                                        <div class="col-xs-1 require_st">*</div>

                                                        <div class="col-xs-6 require">
                                                            <input id="firstname" name="firstname" placeholder="" type="text" class="form-control" value="<?php echo set_value( 'firstname', $student['firstname'] ); ?>"/>
                                                            <span class="text-danger"><?php echo form_error( 'first_name' ); ?></span>
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
                                                            <input id="lastname" name="lastname" placeholder="" type="text" class="form-control" value="<?php echo set_value( 'lastname', $student['lastname'] ); ?>"/>
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
                                                            <label for="exampleInputFile"> <?php echo $this->lang->line( 'gender' ); ?> &nbsp;&nbsp;</label>
                                                        </div>
                                                        <div class="col-xs-1 require_st">*</div>
                                                        <div class="col-xs-6 require">
                                                            <select class="form-control" name="gender">
                                                                <option value=""><?php echo $this->lang->line( 'select' ); ?></option>
                                                                <?php
                                                                foreach ( $genderList as $key => $value ) {
                                                                    ?>
                                                                    <option value="<?php echo $key; ?>" <?php if ( $student['gender'] == $value ) echo "selected"; ?>><?php echo $value; ?></option>
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
                                                            <input id="dob" name="dob" placeholder="" autocomplete="off" type="text" class="form-control" value="<?php echo set_value( 'dob', date( "d-m-Y", $this->customlib->dateyyyymmddTodateformat( $student['dob'] ) ) ); ?>"/>
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
                                                            <input id="admission_date" name="admission_date" placeholder="" type="text" autocomplete="off" class="form-control" value="<?php echo set_value( 'admission_date', date( "d-m-Y", $this->customlib->dateyyyymmddTodateformat( $student['admission_date'] ) ) ); ?>"/>
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
                                                            <select id="admission_class_id"  name="admission_class_id" class="form-control" >
                                                                <option value=""><?php echo $this->lang->line( 'select' ); ?></option>
                                                                <?php
                                                                foreach ( $classlist as $class ) {
                                                                    ?>
                                                                    <option value="<?php echo $class['id'] ?>" <?php
                                                                    if ( $student['admission_class'] == $class['id'] ) {
                                                                        echo "selected =selected";
                                                                    }
                                                                    ?>><?php echo $class['class'] ?></option>
                                                                    <?php
                                                                    $count++;
                                                                }
                                                                ?>

                                                            </select>
                                                            <span class="text-danger"><?php echo form_error( 'class_id' ); ?></span>
                                                        </div>
                                                        
                                                        </div>
                                                         </div> 

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-5">
                                                            <label for="exampleInputFile"><?php echo $this->lang->line( 'select_image' ); ?></label>
                                                        </div>

                                                        <div class="col-xs-7">
                                                            <input type='file' name='file' id="file" size='20'/>
                                                            <span class="text-danger"><?php echo form_error( 'file' ); ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="clearfix"></div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-5">
                                                            <label for="exampleInputDiscount">Discount (in Rs)</label>
                                                        </div>

                                                        <div class="col-xs-7">
                                                            <input type="number" id="discount" name="discount" class="form-control unpaid_student_input" value="<?= set_value( 'discount', $student['discount'] ) ?>">
                                                            <span class="text-danger"><?php echo form_error( 'file' ); ?></span>
                                                        </div>
                                                    </div>
                                                </div>
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
                                        </div>
                                    </div>
                                </div><!-- Left column ends -->

                                <!-- right column -->
                                <div class="col-sm-6">
                                    <h4>Optional</h4>
                                    <div class="admission_page_border">
                                        <div class="row">
                                            <div class="col-md-6 hidden">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-5">
                                                            <label for="exampleInputEmail1"><?php echo $this->lang->line( 'category' ); ?></label>
                                                        </div>

                                                        <div class="col-xs-7">
                                                            <select id="category_id" name="category_id" class="form-control">
                                                                <option value=""><?php echo $this->lang->line( 'select' ); ?></option>
                                                                <?php
                                                                foreach ( $categorylist as $category ) {
                                                                    ?>
                                                                    <option value="<?php echo $category['id'] ?>" <?php if ( $student['category_id'] == $category['id'] ) echo "selected =selected" ?>><?php echo $category['category']; ?></option>
                                                                    <?php
                                                                    $count++;
                                                                }
                                                                ?>
                                                            </select>
                                                            <span class="text-danger"><?php echo form_error( 'category_id' ); ?></span>
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
                                                            <input id="cast" name="cast" placeholder="" type="text" class="form-control" value="<?php echo set_value( 'cast', $student['cast'] ); ?>"/>
                                                            <span class="text-danger"><?php echo form_error( 'cast' ); ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-5">
                                                            <label for="exampleInputEmail1"><?php echo $this->lang->line( 'religion' ); ?></label>
                                                        </div>

                                                        <div class="col-xs-7">
                                                            <input id="religion" name="religion" placeholder="" type="text" class="form-control" value="<?php echo set_value( 'religion', $student['religion'] ); ?>"/>
                                                            <span class="text-danger"><?php echo form_error( 'religion' ); ?></span>
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
                                                            <input id="mobileno" name="mobileno" placeholder="" type="text" class="form-control" value="<?php echo set_value( 'mobileno', $student['mobileno'] ); ?>"/>
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
                                                            <input id="email" name="email" placeholder="" type="text" class="form-control" value="<?php echo set_value( 'email', $student['email'] ); ?>"/>
                                                            <span class="text-danger"><?php echo form_error( 'email' ); ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="clearfix"></div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <!-- <div class="row">
                                                        <div class="col-xs-5">
                                                            <label for="exampleInputEmail1">Arrears</label>
                                                        </div>

                                                        <div class="col-xs-7">
                                                            <input id="arrears" name="arrears" placeholder="" type="number" class="form-control unpaid_student_input" value="<?php echo set_value( 'arrears', ( intval( $student['fee_arrears'] ) > 0 ? $student['fee_arrears'] : 0 ) ); ?>"/>
                                                            <span class="text-danger"><?php echo form_error( 'email' ); ?></span>
                                                        </div>
                                                    </div> -->
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <!-- <div class="row">
                                                        <div class="col-xs-5">
                                                            <label for="exampleInputEmail1">Advance</label>
                                                        </div>

                                                        <div class="col-xs-7">
                                                            <input id="advance" name="advance" placeholder="" type="number" class="form-control unpaid_student_input" value="<?php echo set_value( 'advance', ( intval( $student['fee_arrears'] ) < 0 ? abs( $student['fee_arrears'] ) : 0 ) ); ?>"/>
                                                            <span class="text-danger"><?php echo form_error( 'advance' ); ?></span>
                                                        </div>
                                                    </div> -->
                                                </div>
                                            </div>

                                            <div class="clearfix"></div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <!-- <div class="row">
                                                        <div class="col-xs-5">
                                                            <label>Year</label>
                                                        </div>
                                                        <div class="col-xs-7">
                                                            <select name="fee_starting_year" class="form-control">
                                                                <?php foreach ( $fee_starting->year as $fs_year ): ?>
                                                                    <option value="<?= $fs_year ?>" <?= set_select( 'fee_starting_year', $fs_year, ( $fs_year == ( $student['fee_starting_date'] == null ? null : date( 'Y', strtotime( $student['fee_starting_date'] ) ) ) ) ) ?>><?= $fs_year ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                            <span class="text-danger"><?php echo form_error( 'fee_starting_year' ); ?></span>
                                                        </div>
                                                    </div> -->
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <!-- <div class="row">
                                                        <div class="col-xs-5">
                                                            <label>Month</label>
                                                        </div>
                                                        <div class="col-xs-7">
                                                            <select name="fee_starting_month" class="form-control">
                                                                <?php foreach ( $fee_starting->month as $fs_month ): ?>
                                                                    <option value="<?= $fs_month['value'] ?>" <?= set_select( 'fee_starting_month', $fs_month['value'], ( $fs_month['value'] == ( $student['fee_starting_date'] == null ? null : date( 'd', strtotime( $student['fee_starting_date'] ) ) ) ) ) ?>><?= $fs_month['name'] ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                            <span class="text-danger"><?php echo form_error( 'fee_starting_month' ); ?></span>
                                                        </div>
                                                    </div> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- right column -->
                            </div>

                            <div class="row">
                                <div class="col-md-3 col-xs-12" style="display: none;">
                                    <label><?php echo $this->lang->line( 'rte' ); ?></label>
                                    <div class="radio" style="margin-top: 2px;">
                                        <label><input class="radio-inline" type="radio" name="rte" value="Yes" <?php
                                            echo set_value( 'rte', $student['rte'] ) == "Yes" ? "checked" : "";
                                            ?> ><?php echo $this->lang->line( 'yes' ); ?></label>
                                        <label><input class="radio-inline" type="radio" name="rte" value="No" <?php
                                            echo set_value( 'rte', $student['rte'] ) == "No" ? "checked" : "";
                                            ?> ><?php echo $this->lang->line( 'no' ); ?></label>
                                    </div>
                                    <span class="text-danger"><?php echo form_error( 'rte' ); ?></span>
                                </div>
                            </div>
                            <div class="box-header">
                                <h3 class="box-title">
                                    <?php echo $this->lang->line( 'transport' ) . " " . $this->lang->line( 'details' ); ?>
                                </h3>
                                <hr>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">
                                            <?php echo $this->lang->line( 'route_list' ); ?>
                                        </label>
                                        <select class="form-control" name="vehroute_id" id="vehroute_id">


                                            <option value=""><?php echo $this->lang->line( 'select' ); ?></option>
                                            <?php
                                            foreach ( $vehroutelist as $vehroute ) {
                                                ?>
                                                <optgroup label=" <?php echo $vehroute->route_title; ?>">
                                                    <?php
                                                    $vehicles = $vehroute->vehicles;
                                                    if ( !empty( $vehicles ) ) {
                                                        foreach ( $vehicles as $key => $value ) {

                                                            $st = set_value( 'vehroute_id', $student['vehroute_id'] ) == $value->vec_route_id ? TRUE : FALSE;
                                                            ?>

                                                            <option value="<?php echo $value->vec_route_id ?>" <?php echo set_select( 'vehroute_id', $value->vec_route_id, $st ); ?> data-fee="<?php echo $vehroute->fare; ?>">
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
                            <h4><?php echo $this->lang->line( 'parent_guardian_detail' ); ?></h4>
                            <h3 class="box-title"><?php echo form_error( 'parent_guardian_detail' ); ?></h3>
                            <hr>

                            <div class="row">
                                <!-- 2nd Left column -->
                                <div class="col-sm-6">
                                    <h4>Required</h4>
                                    <div class="admission_page_border">
                                        <div class="row">
                                        <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-5">
                                                            <label for="exampleInputEmail1"> Father <?php echo $this->lang->line( 'phone' ); ?> <?php echo $this->lang->line( 'no' ); ?></label>
                                                        </div>
                                                        <div class="col-xs-1 require_st">*</div>
                                                        <div class="col-xs-7 require">
                                                            <input id="father_phone" name="father_phone" placeholder="" type="text" required class="form-control fill_guardian" value="<?php echo set_value( 'father_phone', $student['father_phone'] ); ?>" data-target="#guardian_phone"/>
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
                                                            <input id="father_name" name="father_name" placeholder="" type="text" class="form-control fill_guardian" value="<?php echo set_value( 'father_name', $student['father_name'] ); ?>" data-target="#guardian_name"/>
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
                                                            <input id="father_occupation" name="father_occupation" placeholder="" type="text" class="form-control fill_guardian" value="<?php echo set_value( 'father_occupation', $student['father_occupation'] ); ?>" data-target="#guardian_occupation"/>
                                                            <span class="text-danger"><?php echo form_error( 'father_occupation' ); ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="clearfix"></div>

                                            <div class="col-md-12">
                                                <label><?php echo $this->lang->line( 'if_guardian_is' ); ?>&nbsp;&nbsp;&nbsp;</label>
                                                <label class="radio-inline">
                                                
                                                    <input type="radio" name="guardian_is" <?php if ( $student['guardian_is'] == "father" || " " ) echo "checked";  ?> value="father"> <?php echo $this->lang->line( 'father' ); ?>
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="guardian_is" <?php if ( $student['guardian_is'] == "mother" ) echo "checked"; ?> value="mother"> <?php echo $this->lang->line( 'mother' ); ?>
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="guardian_is" <?php if ( $student['guardian_is'] == "other" ) echo "checked"; ?> value="other"> <?php echo $this->lang->line( 'other' ); ?>
                                                </label>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-5">
                                                            <label for="exampleInputEmail1"><?php echo $this->lang->line( 'guardian_name' ); ?></label>
                                                        </div>

                                                        <div class="col-xs-7">
                                                            <input id="guardian_name" name="guardian_name" placeholder="" type="text" class="form-control" value="<?php echo set_value( 'guardian_name', $student['guardian_name'] ); ?>"/>
                                                            <span class="text-danger"><?php echo form_error( 'guardian_name' ); ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-5">
                                                            <label for="exampleInputEmail1"><?php echo $this->lang->line( 'guardian_relation' ); ?></label>
                                                        </div>

                                                        <div class="col-xs-7">
                                                            <input id="guardian_relation" name="guardian_relation" placeholder="" type="text" class="form-control" value="<?php echo set_value( 'guardian_relation', $student['guardian_relation'] ); ?>"/>
                                                            <span class="text-danger"><?php echo form_error( 'guardian_relation' ); ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="clearfix"></div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-5">
                                                            <label for="exampleInputEmail1"><?php echo $this->lang->line( 'guardian_phone' ); ?></label>
                                                        </div>

                                                        <div class="col-xs-7">
                                                            <input id="guardian_phone" name="guardian_phone" placeholder="" type="text" class="form-control" value="<?php echo set_value( 'guardian_phone', $student['guardian_phone'] ); ?>"/>
                                                            <span class="text-danger"><?php echo form_error( 'guardian_phone' ); ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-5">
                                                            <label for="exampleInputEmail1"><?php echo $this->lang->line( 'guardian_occupation' ); ?></label>
                                                        </div>

                                                        <div class="col-xs-7">
                                                            <input id="guardian_occupation" name="guardian_occupation" placeholder="" type="text" class="form-control" value="<?php echo set_value( 'guardian_occupation', $student['guardian_occupation'] ); ?>"/>
                                                            <span class="text-danger"><?php echo form_error( 'guardian_occupation' ); ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="clearfix"></div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-5">
                                                            <label for="exampleInputEmail1"><?php echo $this->lang->line( 'guardian_address' ); ?></label>
                                                        </div>

                                                        <div class="col-xs-7">
                                                            <textarea id="guardian_address" name="guardian_address" placeholder="" class="form-control" rows="4"><?php echo set_value( 'guardian_address', $student['guardian_address'] ); ?></textarea>
                                                            <span class="text-danger"><?php echo form_error( 'guardian_address' ); ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- 2nd Left column ends -->

                                <!-- 2nd right column -->
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
                                                            <input id="father_cnic" name="father_cnic" type="text" class="form-control" value="<?php echo set_value( 'father_cnic', $student['father_cnic'] ); ?>" placeholder="CNIC without dashes."/>
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
                                                            <input id="b_form" name="b_form" type="text" class="form-control" value="<?php echo set_value( 'b_form', $student['b_form'] ); ?>" placeholder="B form "  />
                                                            <span class="text-danger"><?php echo form_error( 'b_form' ); ?></span>
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
                                                            <input id="mother_name" name="mother_name" placeholder="" type="text" class="form-control" value="<?php echo set_value( 'mother_name', $student['mother_name'] ); ?>"/>
                                                            <span class="text-danger"><?php echo form_error( 'mother_name' ); ?></span>
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
                                                        <input id="mother_phone" name="mother_phone" placeholder="" type="text" class="form-control" value="<?php echo set_value( 'mother_phone', $student['mother_phone'] ); ?>"/>
                                                        <span class="text-danger"><?php echo form_error( 'mother_phone' ); ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                              
                                           </div>

                                           <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-xs-5">
                                                            <label for="exampleInputEmail1"><?php echo $this->lang->line( 'mother_occupation' ); ?></label>
                                                        </div>

                                                        <div class="col-xs-7">
                                                            <input id="mother_occupation" name="mother_occupation" placeholder="" type="text" class="form-control" value="<?php echo set_value( 'mother_occupation', $student['mother_occupation'] ); ?>"/>
                                                            <span class="text-danger"><?php echo form_error( 'mother_occupation' ); ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                

                                        </div>

                                    </div>
                                </div><!-- 2nd right column ends -->
                            </div>

                            <div class="box-header">
                                <h3 class="box-title"><?php echo $this->lang->line( 'address_details' ); ?></h3>
                                <hr>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label>
                                        <input type="checkbox" id="autofill_current_address" onclick="return auto_fill_guardian_address();">
                                        <?php echo $this->lang->line( 'if_guardian_address_is_current_address' ); ?>
                                    </label>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line( 'current_address' ); ?></label>
                                        <textarea id="current_address" name="current_address" placeholder="" class="form-control"><?php echo set_value( 'current_address', $student['current_address'] ); ?></textarea>
                                        <span class="text-danger"><?php echo form_error( 'current_address' ); ?></span>
                                    </div>
                                    <div class="checkbox">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>
                                        <input type="checkbox" id="autofill_address" onclick="return auto_fill_address();">
                                        <?php echo $this->lang->line( 'if_permanent_address_is_current_address' ); ?>
                                    </label>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line( 'permanent_address' ); ?></label>
                                        <textarea id="permanent_address" name="permanent_address" placeholder="" class="form-control"><?php echo set_value( 'permanent_address', $student['permanent_address'] ) ?></textarea>
                                        <span class="text-danger"><?php echo form_error( 'permanent_address', $student['permanent_address'] ); ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="box-header with-border">
                                <h3 class="box-title"><?php echo $this->lang->line( 'miscellaneous_details' ); ?></h3>
                                <hr>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line( 'bank_account_no' ); ?></label>
                                        <input id="bank_account_no" name="bank_account_no" placeholder="" type="text" class="form-control" value="<?php echo set_value( 'bank_account_no', $student['bank_account_no'] ); ?>"/>
                                        <span class="text-danger"><?php echo form_error( 'bank_account_no' ); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line( 'bank_name' ); ?></label>
                                        <input id="bank_name" name="bank_name" placeholder="" type="text" class="form-control" value="<?php echo set_value( 'bank_name', $student['bank_name'] ); ?>"/>
                                        <span class="text-danger"><?php echo form_error( 'bank_name' ); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line( 'ifsc_code' ); ?></label>
                                        <input id="ifsc_code" name="ifsc_code" placeholder="" type="text" class="form-control" value="<?php echo set_value( 'ifsc_code', $student['ifsc_code'] ); ?>"/>
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
                                        <input id="adhar_no" name="adhar_no" placeholder="" type="text" class="form-control" value="<?php echo set_value( 'adhar_no', $student['adhar_no'] ); ?>"/>
                                        <span class="text-danger"><?php echo form_error( 'adhar_no' ); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">
                                            <?php echo $this->lang->line( 'local_identification_no' ); ?>
                                        </label>
                                        <input id="samagra_id" name="samagra_id" placeholder="" type="text" class="form-control" value="<?php echo set_value( 'samagra_id', $student['samagra_id'] ); ?>"/>
                                        <span class="text-danger"><?php echo form_error( 'samagra_id' ); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line( 'previous_school_details' ); ?></label>
                                        <textarea class="form-control" rows="3" placeholder="" name="previous_school"><?php echo set_value( 'previous_school', $student['previous_school'] ); ?></textarea>
                                        <span class="text-danger"><?php echo form_error( 'previous_school' ); ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <button type="button" class="btn btn-default"><?php echo $this->lang->line( 'cancel' ); ?></button>
                                <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line( 'save' ); ?></button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
</div>
</section>
</div>
<?php

$admind = $this->session->userdata( 'admin' );
                                            $this->load->helper('menu_helper');
                                            $permission = admin_permission($admind['id']);
                                            ?>
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
                alert( "Please provide correct phone number , with dashed, having 12 digits." );
            } else {
            //    $( t ).val( "Loading..." );
                dom_father_name.val( "Loading..." );

                dom_father_occupation.val( "Loading..." );

                $.get( site_url + father_phone, function ( data ) {
                    if ( data.error === false ) {
                        var father_details = data.data;
                        dom_father_name.val( father_details.father_name );

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

                        dom_father_occupation.val( "" );
                    }

                    $( t ).val( father_phone );
                } );
            }
        } );
    } );
</script>

<script type="text/javascript">
    $( document ).ready( function () {


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
      

        $( " #section_id" ).on( 'change', function () {
			add_class_roll();
		 } );
        var section_id_post = '<?php echo $student['section_id']; ?>';
        var class_id_post = '<?php echo $student['class_id']; ?>';
        populateSection( section_id_post, class_id_post );

        function populateSection( section_id_post, class_id_post ) {
            $( '#section_id' ).html( "" );
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line( 'select' ); ?></option>';
            $.ajax( {
                type: "GET",
                url: base_url + "sections/getByClass",
                data: {'class_id': class_id_post},
                dataType: "json",
                success: function ( data ) {
                    $.each( data, function ( i, obj ) {
                        var select = "";
                        if ( section_id_post == obj.section_id ) {
                            var select = "selected=selected";
                        }
                        div_data += "<option value=" + obj.section_id + " " + select + ">" + obj.section + "</option>";
                    } );

                    $( '#section_id' ).append( div_data );
                }
            } );
        }

        $( document ).on( 'change', '#class_id', function ( e ) {
            $( '#section_id' ).html( "" );
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
                    $( '#section_id' ).append( div_data );
                }
            } );
        } );
        //var date_format = '<?php echo $result = strtr( $this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',] ) ?>';
        var date_format = 'dd-mm-yyyy';
        $( '#dob,#admission_date' ).datepicker( {
            format: date_format,
            autoclose: true
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
    jQuery( function ( $ ) {
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

        add_class_fee();
        $( "#class_id, #discount" ).on( 'change', function () {
            add_class_fee(1);
        } );
    } );

//     $('#father_cnic').keydown(function(){
//   //allow  backspace, tab, ctrl+A, escape, carriage return
//   if (event.keyCode == 8 || event.keyCode == 9 
//                     || event.keyCode == 27 || event.keyCode == 13 
//                     || (event.keyCode == 65 && event.ctrlKey === true) )
//                         return;
//   if((event.keyCode < 48 || event.keyCode > 57))
//    event.preventDefault();
//   var length = $(this).val().length; 
              
//   if(length == 5 || length == 13)
//    $(this).val($(this).val()+'-');

//  });
 

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
 

    $(".unpaid_student_input").on('click', function(){
        $.ajax( {
            type: "get",
            url: '<?php echo site_url( "fee_management/check_unpaid_ajax" ) ?>',
            dataType: 'JSON',
            data: {
              student_id:<?= $student['id']?>,
            },
            success: function ( data ) {
                if(data == 1 ){
                    console.log("sdfdsfdsf");
                    $('.unpaid_student_input').blur(); 

                sweetAlert({
                    title: "Alert",
                    text : "Delete The Monthly Fee Voucher Before Editing The Fee / Arrears.",
                    type: 'warning',
                    showConfirmButton: false,
                    timer: 2000,
                }); 
                $(".unpaid_student_input").addClass("disabledbutton_tuition_fee");
                }else{
                    $(".unpaid_student_input").removeClass("disabledbutton_tuition_fee");
                }
              
            }
        } );
      
    });


  //   $('#father_phone').keydown(function(){
  //allow  backspace, tab, ctrl+A, escape, carriage return
//   if (event.keyCode == 8 || event.keyCode == 9 
//                     || event.keyCode == 27 || event.keyCode == 13 
//                     || (event.keyCode == 65 && event.ctrlKey === true) )
//                         return;
//   if((event.keyCode < 48 || event.keyCode > 57))
//    event.preventDefault();
//   var length = $(this).val().length; 
          
//   if(length == 4)
//    $(this).val($(this).val()+'-');

//  });

</script>