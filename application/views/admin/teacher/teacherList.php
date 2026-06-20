<style type="text/css">
    @media print {
        .no-print, .no-print * {
            display: none !important;
        }
    }
</style>

<?php  


?>


<div class="content-wrapper" style="min-height: 946px;">
<?php  $this->load->view('layout/teacher_link'); ?>
    <section class="content-header">
    <div class="box box-primary" style="margin-bottom: 0px;">  
        <div class="box-header with-border" style="padding: 20px;">
            <div class="row">                        
                    <div class="col-sm-6 col-md-3"><h3>Teacher Management</h3></div>
                    <div class="col-sm-1 pull-right" > </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add Teacher</h3>
                    </div>
                    <form id="form1" action="<?php echo site_url( 'admin/teacher/create' ) ?>" id="employeeform" name="employeeform" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                        <div class="box-body">
                            <?php if ( $this->session->flashdata( 'msg' ) ) { ?>
                                <?php echo $this->session->flashdata( 'msg' ) ?>
                            <?php } ?>
                            <?php echo $this->customlib->getCSRF(); ?>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input id="category" name="name" placeholder="" type="text" class="form-control" value="<?php echo set_value( 'name' ); ?>"/>
                                <span class="text-danger"><?php echo form_error( 'name' ); ?></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line( 'email' ); ?></label>
                                <input id="category" name="email" placeholder="" type="text" class="form-control" value="<?php echo set_value( 'email' ); ?>"/>
                                <span class="text-danger"><?php echo form_error( 'email' ); ?></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile"> <?php echo $this->lang->line( 'gender' ); ?> &nbsp;&nbsp;</label>
                                <select class="form-control" name="gender">
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
                            <div class="form-group">
                                <label for="inputTeacherType">Teacher Salary Type</label>
                                <select class="form-control" name="teacher_type_id" id="inputTeacherType">
                                    
									
									<?php
						            if ( $teacher_types !== null ):
                                        foreach ( $teacher_types as $teacher_type ):
                                            ?>
                                            <option value="<?= $teacher_type['teacher_type_id'] ?>" <?= set_select( 'teacher_type_id', $teacher_type['teacher_type_id'] ) ?>><?= ucwords( $teacher_type['teacher_type_name'] ) . " (" . ( $teacher_type['teacher_type_name'] == 'permanent' ? "Full month salary" : "Lecture based payment" ) . ")" ?></option>
                                            <?php
                                        endforeach;
                                    endif;
                                    ?>
                                </select>
                                <span class="text-danger"><?php echo form_error( 'teacher_type_id' ); ?></span>
                            </div>
                            <div class="form-group">
                                <label for="inputTeacherSalary" id="inputTeacherSalaryLabel">Monthly salary</label>
                                <input id="inputTeacherSalary" name="teacher_salary" placeholder="" type="text" class="form-control" value="<?php echo set_value( 'teacher_salary' ); ?>"/>
                                <span class="text-danger"><?php echo form_error( 'teacher_salary' ); ?></span>
                            </div>
                            <div class="form-group">
                                <label for="inputTeacherSalary" id="inputTeacherSalaryLabel">Security </label>
                                <input id="inputTeacherSalary" name="teacher_security" placeholder="" type="text" class="form-control" value="<?php echo set_value( 'teacher_security' ); ?>"/>
                                <span class="text-danger"><?php echo form_error( 'teacher_salary' ); ?></span>
                            </div>
                            <div class="form-group">
                                <label for="inputTeacherSalary" id="inputTeacherSalaryLabel">Advance</label>
                                <input id="inputTeacherSalary" name="teacher_advance" placeholder="" type="text" class="form-control" value="<?php echo set_value( 'teacher_advance' ); ?>"/>
                                <span class="text-danger"><?php echo form_error( 'teacher_salary' ); ?></span>
                            </div>
                            <div class="form-group">
                                <label for="inputTeacherSalary" id="inputTeacherSalaryLabel">EOBI</label>
                                <input id="inputTeacherSalary" name="teacher_eobi" placeholder="" type="text" class="form-control" value="<?php echo set_value( 'teacher_eobi' ); ?>"/>
                                <span class="text-danger"><?php echo form_error( 'teacher_salary' ); ?></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line( 'date_of_birth' ); ?></label>
                                <input id="dob" name="dob" placeholder="" type="text" class="form-control" value="<?php echo set_value( 'dob' ); ?>" readonly/>
                                <span class="text-danger"><?php echo form_error( 'dob' ); ?></span>
                            </div>
                            <div class="form-group">
                                <label>Designation</label>
                                <input type="text" required class="form-control" name="designation" value="<?= set_value( 'designation' ) ?>" maxlength="255">
                                <span class="text-danger"><?php echo form_error( 'designation' ); ?></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line( 'address' ); ?></label>
                                <textarea id="address" name="address" placeholder="" class="form-control"><?php echo set_value( 'address' ); ?></textarea>
                                <span class="text-danger"><?php echo form_error( 'address' ); ?></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line( 'phone' ); ?></label>
                                <input id="phone" name="phone" placeholder="" type="text" class="form-control" value="<?php echo set_value( 'phone' ); ?>"/>
                                <span class="text-danger"><?php echo form_error( 'phone' ); ?></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Photo (150px X 150px)</label>
                                <input type='file' name='file' id="file" size='20'/>
                            </div>
                            <div class="form-group">
                                <label>Date Of Joining</label>
                                <input type="text" id="joining_date" class="form-control _date" name="joining_date" value="<?= set_value( 'joining_date', date( 'm/d/Y', now() ) ) ?>" readonly>
                                <span class="text-danger"><?php echo form_error( 'joining_date' ); ?></span>
                            </div>
                            <div class="form-group">
                                <label>Teacher Qualification</label>
                                <input type="text" class="form-control" name="teacher_qualification" value="<?= set_value( 'teacher_qualification' ) ?>" maxlength="255">
                                <span class="text-danger"><?php echo form_error( 'teacher_qualification' ); ?></span>
                            </div>
                            <div class="form-group">
                                <label>Qualification Details</label>
                                <textarea class="form-control" name="qualification_details" rows="4"><?= set_value( 'qualification_details' ) ?></textarea>
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
                <div class="box box-primary" id="tachelist">
                    <div class="box-header ptbnull">
                     <?php  if($teacher_type_search == 'all'){ ?>
                       <h3 class="box-title titlefix">All Registered Teachers List</h3>
                    <?php }elseif($teacher_type_search == 'in-active'){?>
                        <h3 class="box-title titlefix">In-Active Teachers List</h3>
                    <?php }else{?>
                     <h3 class="box-title titlefix">Active Teachers List</h3>
                    <?php }?>
                    </div>
                    <div class="box-body">
                        <div class="mailbox-controls">
                        </div>
                        <div class="table-responsive mailbox-messages">
                            <table id="active_teacher_table" class="table     table-bordered table-hover example">
                                <thead>
                                    <tr>
                                        <th>Sr.</th>
                                        <th>Name</th>
                                        <th>Designation</th>
                                        <th><?php echo $this->lang->line( 'email' ); ?></th>
                                        <th><?php echo $this->lang->line( 'date_of_birth' ); ?></th>
                                        <th><?php echo $this->lang->line( 'phone' ); ?></th>
                                        <th>Joining Date</th>
                                        <th>Teacher Qualification</th>
                                        <th class="text-right no-print"><?php echo $this->lang->line( 'action' ); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $row=0;

                                    $count = 1;
                                    foreach ( $teacherlist as $teacher ) {
                                        $row++;
                                        $teacher_type_details = $this->teacher_type_model->get( $teacher['teacher_type_id'] );
                                        ?>
                                        <tr>
                                            <td class="mailbox-name"> <?php echo $row; ?></td>
                                            <td class="mailbox-name"> <?php echo $teacher['name'] ?></td>
                                            <td class="mailbox-name"> <?php echo $teacher['designation'] ?></td>
                                            <td class="mailbox-name"> <?php echo $teacher['email'] ?></td>
                                            <td class="mailbox-name"> <?php echo date( $this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat( $teacher['dob'] ) ); ?></td>
                                            <td class="mailbox-name"> <?php echo $teacher['phone'] ?></td>
                                            <td class="mailbox-name"> <?= ( $teacher['joining_date'] !== null ? date( 'd-M-Y', strtotime( $teacher['joining_date'] ) ) : "N/A" ) ?></td>
                                            <td class="mailbox-name"> <?= $teacher['qualification'] ?></td>
                                            <td class="mailbox-date pull-right no-print">
                                             
                                            <?php  $admind = $this->session->userdata( 'admin' );
                                            $this->load->helper('menu_helper');
                                            $permission = admin_permission($admind['id']); ?>

                                             <?php
                                             if($permission->teacher_access == 1){ 
                                             if($teacher_type_search == 'active'){ ?>
                                                <a href="<?php echo base_url(); ?>admin/teacher/resign/<?php echo $teacher['id'] ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="Resign" onclick="return confirm('Are you sure you want to Resign?')" ;>
                                                    <i class="fas fa-sign-out-alt"></i>
                                                </a>
                                                <?php }?>

                                                
                                                
                                                <a href="<?php echo base_url(); ?>admin/teacher/view/<?php echo $teacher['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line( 'show' ); ?>">
                                                    <i class="fa fa-reorder"></i>
                                                </a>
                                                <a href="<?php echo base_url(); ?>admin/teacher/edit/<?php echo $teacher['id'] ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="<?php echo $this->lang->line( 'edit' ); ?>">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                 <?php  if($teacher_type_search == 'in-active'){ ?>
                                                     <a href="<?php echo base_url(); ?>admin/teacher/rejoin/<?php echo $teacher['id'] ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="Rejoin" onClick="return confirm('Are you sure you want to Rejoin?')";>                                        <i class="fas fa-sign-in-alt"></i>
                                                     </a>
                                                 <?php }?>
                                                <a style="display: none" href="<?php echo base_url(); ?>admin/teacher/delete/<?php echo $teacher['id'] ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="<?php echo $this->lang->line( 'delete' ); ?>" onclick="return confirm('Are you sure you want to delete this item?')" ;>
                                                    <i class="fa fa-remove"></i>
                                                </a>
                                                 <?php } ?>
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
        $( '#dob, #admission_date' ).datepicker( {
            format: date_format,
            autoclose: true
        } );
        $( "#btnreset" ).click( function () {
            $( "#form1" )[0].reset();
        } );
    } );
</script>

<script type="text/javascript">
    var base_url = '<?php echo base_url() ?>';

    function printDiv( elem ) {
        Popup( jQuery( elem ).html() );
    }

    function Popup( data ) {

        var frame1 = $( '<iframe />' );
        frame1[0].name = "frame1";
        frame1.css( {"position": "absolute", "top": "-1000000px"} );
        $( "body" ).append( frame1 );
        var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
        frameDoc.document.open();
        //Create a new HTML document.
        frameDoc.document.write( '<html>' );
        frameDoc.document.write( '<head>' );
        frameDoc.document.write( '<title></title>' );
        frameDoc.document.write( '<link rel="stylesheet" href="' + base_url + 'backend/bootstrap/css/bootstrap.min.css">' );
        frameDoc.document.write( '<link rel="stylesheet" href="' + base_url + 'backend/dist/css/font-awesome.min.css">' );
        frameDoc.document.write( '<link rel="stylesheet" href="' + base_url + 'backend/dist/css/ionicons.min.css">' );
        frameDoc.document.write( '<link rel="stylesheet" href="' + base_url + 'backend/dist/css/AdminLTE.min.css">' );
        frameDoc.document.write( '<link rel="stylesheet" href="' + base_url + 'backend/dist/css/skins/_all-skins.min.css">' );
        frameDoc.document.write( '<link rel="stylesheet" href="' + base_url + 'backend/plugins/iCheck/flat/blue.css">' );
        frameDoc.document.write( '<link rel="stylesheet" href="' + base_url + 'backend/plugins/morris/morris.css">' );


        frameDoc.document.write( '<link rel="stylesheet" href="' + base_url + 'backend/plugins/jvectormap/jquery-jvectormap-1.2.2.css">' );
        frameDoc.document.write( '<link rel="stylesheet" href="' + base_url + 'backend/plugins/datepicker/datepicker3.css">' );
        frameDoc.document.write( '<link rel="stylesheet" href="' + base_url + 'backend/plugins/daterangepicker/daterangepicker-bs3.css">' );
        frameDoc.document.write( '</head>' );
        frameDoc.document.write( '<body>' );
        frameDoc.document.write( data );
        frameDoc.document.write( '</body>' );
        frameDoc.document.write( '</html>' );
        frameDoc.document.close();
        setTimeout( function () {
            window.frames["frame1"].focus();
            window.frames["frame1"].print();
            frame1.remove();
        }, 500 );


        return true;
    }


    $( function ( $ ) {
        $( "#inputTeacherType" ).change( function () {
            var selectedValue = $( this ).find( 'option:selected' ).text();
            selectedValue = selectedValue.toLowerCase();
            var teacherSalaryLabel = $( "#inputTeacherSalaryLabel" );

            // if permanent is selected
            if ( selectedValue.search( "permanent" ) >= 0 ) {
                teacherSalaryLabel.text( "Monthly Salary" );
            } else {
                teacherSalaryLabel.text( "Per Lecture Payment" );
            }

            $( "#inputTeacherSalary" ).val( "" );
        } );
    } );
</script>

<script>
    $(document).ready(function () {
        $('#active_teacher_table').DataTable({
            destroy: true,
            order: [[0, 'asc']],
            rowGroup: {
                dataSrc: [2]
            },
            columnDefs: [{
                targets: [2],
                visible: false
            }]
        });
    });
</script>
