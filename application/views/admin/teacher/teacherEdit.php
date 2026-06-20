<div class="content-wrapper">
    <section class="content-header">
        <h1>
         Teacher Management
            <small><?php echo $this->lang->line( 'student_fees1' ); ?></small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
    
    
    <?php 
	
	
	
	?>
        <div class="row">
            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo $this->lang->line( 'edit_teacher' ); ?></h3>
                    </div>
                    <form action="<?php echo site_url( 'admin/teacher/edit/' . $id ) ?>" id="employeeform" name="employeeform" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                        <div class="box-body">
                            <?php if ( $this->session->flashdata( 'msg' ) ) { ?>
                                <?php echo $this->session->flashdata( 'msg' ) ?>
                            <?php } ?>
                            <?php echo $this->customlib->getCSRF(); ?>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line( 'teacher_name' ); ?></label>
                                <input id="category" name="name" placeholder="" type="text" class="form-control" value="<?php echo set_value( 'name', $teacher['name'] ); ?>"/>
                                <span class="text-danger"><?php echo form_error( 'name' ); ?></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line( 'email' ); ?></label>
                                <input id="category" name="email" placeholder="" type="text" class="form-control" value="<?php echo set_value( 'email', $teacher['email'] ); ?>"/>
                                <span class="text-danger"><?php echo form_error( 'email' ); ?></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile"> <?php echo $this->lang->line( 'gender' ); ?> &nbsp;&nbsp;</label>
                                <select class="form-control" name="gender">
                                    <option value=""><?php echo $this->lang->line( 'select' ); ?></option>
                                    <?php
                                    foreach ( $genderList as $key => $value ) {
                                        ?>
                                        <option value="<?php echo $key; ?>" <?php if ( set_value( 'gender', $teacher['sex'] ) == $key ) echo "selected"; ?>><?php echo $value; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <span class="text-danger"><?php echo form_error( 'gender' ); ?></span>
                            </div>

                            <div class="form-group">
                                <label for="inputTeacherType">Teacher type</label>
                                <select class="form-control" name="teacher_type_id" id="inputTeacherType">
                                    <?php
                                    if ( $teacher_types !== null ):
                                        foreach ( $teacher_types as $teacher_type ):
                                            ?>
                                            <option value="<?= $teacher_type['teacher_type_id'] ?>" <?= set_select( 'teacher_type_id', $teacher_type['teacher_type_id'], ( $teacher_type['teacher_type_id'] == $teacher['teacher_type_id'] ) ) ?>><?= ucwords( $teacher_type['teacher_type_name'] ) . " (" . ( $teacher_type['teacher_type_name'] == 'permanent' ? "Full month salary" : "Lecture based payment" ) . ")" ?></option>
                                            <?php
                                        endforeach;
                                    endif;
                                    ?>
                                </select>
                                <span class="text-danger"><?php echo form_error( 'teacher_type_id' ); ?></span>
                            </div>

                            <div class="form-group">
                                <label for="inputTeacherSalary" id="inputTeacherSalaryLabel">Monthly salary</label>
                                <input id="inputTeacherSalary" name="teacher_salary" placeholder="" type="text" class="form-control" value="<?php echo set_value( 'teacher_salary', $teacher['teacher_salary'] ); ?>"/>
                                <span class="text-danger"><?php echo form_error( 'teacher_salary' ); ?></span>
                            </div>
                            <div class="form-group">
                                <label for="inputTeacherSalary" id="inputTeacherSalaryLabel">Security </label>
                                <input id="inputTeacherSalary" name="teacher_security" placeholder="" type="text" class="form-control" value="<?php echo set_value( 'teacher_security', $teacher['teacher_security'] ); ?>"/>
                                <span class="text-danger"><?php echo form_error( 'teacher_salary' ); ?></span>
                            </div>
                            <div class="form-group">
                                <label for="inputTeacherSalary" id="inputTeacherSalaryLabel">Advance</label>
                                <input id="inputTeacherSalary" name="teacher_advance" placeholder="" type="text" class="form-control" value="<?php echo set_value( 'teacher_advance', $teacher['teacher_advance'] ); ?>"/>
                                <span class="text-danger"><?php echo form_error( 'teacher_salary' ); ?></span>
                            </div>
                            <div class="form-group">
                                <label for="inputTeacherSalary" id="inputTeacherSalaryLabel">EOBI</label>
                                <input id="inputTeacherSalary" name="teacher_eobi" placeholder="" type="text" class="form-control" value="<?php echo set_value( 'teacher_eobi', $teacher['teacher_eobi'] ); ?>"/>
                                <span class="text-danger"><?php echo form_error( 'teacher_salary' ); ?></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line( 'date_of_birth' ); ?></label>
                                <input id="dob" name="dob" placeholder="" type="text" class="form-control" value="<?php echo set_value( 'dob', date( $this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat( $teacher['dob'] ) ) ); ?>" readonly/>
                                <span class="text-danger"><?php echo form_error( 'dob' ); ?></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line( 'address' ); ?></label>
                                <textarea id="address" name="address" placeholder="" class="form-control"><?php echo set_value( 'address', $teacher['address'] ); ?></textarea>
                                <span class="text-danger"><?php echo form_error( 'address' ); ?></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line( 'phone' ); ?></label>
                                <input id="phone" name="phone" placeholder="" type="text" class="form-control" value="<?php echo set_value( 'phone', $teacher['phone'] ); ?>"/>
                                <span class="text-danger"><?php echo form_error( 'phone' ); ?></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile"><?php echo $this->lang->line( 'teacher_photo' ); ?> (150px X 150px)</label>
                                <input type='file' name='file' id="file" size='20'/>
                            </div>

                            <div class="form-group">
                                <label>Date Of Joining</label>
                                <input type="text" id="joining_date" class="form-control _date" name="joining_date" value="<?= set_value( 'joining_date', date( 'm/d/Y', strtotime( $teacher['joining_date'] ) ) ) ?>" readonly>
                                <span class="text-danger"><?php echo form_error( 'joining_date' ); ?></span>
                            </div>
                            <div class="form-group">
                                <label>Teacher Qualification</label>
                                <input type="text" class="form-control" name="teacher_qualification" value="<?= set_value( 'teacher_qualification', $teacher['qualification'] ) ?>" maxlength="255">
                                <span class="text-danger"><?php echo form_error( 'teacher_qualification' ); ?></span>
                            </div>
                            <div class="form-group">
                                <label>Qualification Details</label>
                                <textarea class="form-control" name="qualification_details" rows="4"><?= set_value( 'qualification_details', $teacher['qualification_details'] ) ?></textarea>
                                <span class="text-danger"><?php echo form_error( 'qualification_details' ); ?></span>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line( 'save' ); ?></button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"><?php echo $this->lang->line( 'teacher_list' ); ?></h3>
                    </div>
                    <div class="box-body">
                        <div class="mailbox-controls">
                        </div>
                        <div class="table-responsive mailbox-messages">
                            <table class="table     table-bordered table-hover example">
                                <thead>
                                    <tr>
                                        <th><?php echo $this->lang->line( 'teacher_name' ); ?></th>
                                        <th><?php echo $this->lang->line( 'email' ); ?></th>
                                        <th><?php echo $this->lang->line( 'date_of_birth' ); ?></th>
                                        <th><?php echo $this->lang->line( 'phone' ); ?></th>
                                        <th class="text-right"><?php echo $this->lang->line( 'action' ); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $count = 1;
                                    foreach ( $teacherlist as $teacher ) {
                                        ?>
                                        <tr>
                                            <td class="mailbox-name"> <?php echo $teacher['name'] ?></td>
                                            <td class="mailbox-name"> <?php echo $teacher['email'] ?></td>
                                            <td class="mailbox-name"> <?php echo $teacher['dob'] ?></td>
                                            <td class="mailbox-name"> <?php echo $teacher['phone'] ?></td>
                                            <td class="mailbox-date pull-right"
                                            ">
                                            <a href="<?php echo base_url(); ?>admin/teacher/view/<?php echo $teacher['id'] ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="<?php echo $this->lang->line( 'show' ); ?>">
                                                <i class="fa fa-reorder"></i>
                                            </a>
                                            <a href="<?php echo base_url(); ?>admin/teacher/edit/<?php echo $teacher['id'] ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="<?php echo $this->lang->line( 'edit' ); ?>">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="<?php echo base_url(); ?>admin/teacher/delete/<?php echo $teacher['id'] ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="<?php echo $this->lang->line( 'delete' ); ?>" onclick="return confirm('Are you sure you want to delete this item?')" ;>
                                                <i class="fa fa-remove"></i>
                                            </a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    $count++;

                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="">
                        <div class="mailbox-controls">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script type="text/javascript">
    $( document ).ready( function () {
        var date_format = '<?php echo $result = strtr( $this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',] ) ?>';
        $( '#dob,#admission_date' ).datepicker( {
            format: date_format,
            autoclose: true
        } );
    } );
</script>