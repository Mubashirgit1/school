<style type="text/css">
    @media print {
        .no-print, .no-print * {
            display: none !important;
        }
    }
</style>

<div class="content-wrapper" style="min-height: 946px;">
<?php  $this->load->view('layout/teacher_link'); ?>
    <section class="content-header">
    
       <div class="box box-primary" style="margin-bottom: 0px;">  
      <div class="box-header with-border" style="padding: 20px;">
            <form role="form" action="<?php echo site_url( 'admin/staff/create' ) ?>" method="get" class="form-horizontal">

        
                    <div class="row">
                    
                        
                        <div class="col-sm-6 col-md-3">
                            <h3>  Staff Management </h3>
                        </div>
             
                    <div class="col-sm-1 pull-right" >
                            <label style="display: block;">&nbsp </label>
                            <button type="submit" name="search" value="search_filter" class="btn btn-primary btn-sm">
                                <i class="fa fa-search"></i> <?php echo $this->lang->line( 'search' ); ?>
                            </button>
                        </div>
                        
                            <div class="col-md-2 pull-right">
                            <label>Staff Status</label>
                            
                            <select id="teacher_type" name="staff_type" class="form-control">
                                
                                <option value="active" <?php if ( $staff_type_search == "active" ) echo "selected=selected" ?>>Active Staff List</option>
                               
                                
                                <option value="in-active" <?php if ( $staff_type_search == "in-active" ) echo "selected=selected" ?> >In-Active Staff List</option>
                                
                                  <option value="all" <?php if ( $staff_type_search == "all" ) echo "selected=selected" ?> >All</option>
                            </select>
                            <span class="text-danger"><?php echo form_error( 'staff_type' ); ?></span>
                        </div>
                        
                    </div>
            </form>
            
            
        </div>
          </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add Staff</h3>
                    </div>
                    <form id="form1 employeeform" action="<?php echo site_url( 'admin/staff/create' ) ?>" name="employeeform" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                        <div class="box-body">
                            <?php $this->general_library->err_msg() ?>

                            <?php if ( $staff_member !== null ): ?>
                                <input type="hidden" name="staff_id" value="<?= $staff_member['id'] ?>">
                            <?php endif; ?>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input id="category" name="name" placeholder="" type="text" class="form-control" value="<?php echo set_value( 'name', ( $staff_member !== null ? $staff_member['name'] : "" ) ); ?>"/>
                                <span class="text-danger"><?php echo form_error( 'name' ); ?></span>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line( 'email' ); ?></label>
                                <input id="category" name="email" placeholder="" type="text" class="form-control" value="<?php echo set_value( 'email', ( $staff_member !== null ? $staff_member['email'] : "" ) ); ?>"/>
                                <span class="text-danger"><?php echo form_error( 'email' ); ?></span>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputFile"> <?php echo $this->lang->line( 'gender' ); ?> &nbsp;&nbsp;</label>
                                <select class="form-control" name="gender">
                                    <option value=""><?php echo $this->lang->line( 'select' ); ?></option>
                                    <?php foreach ( $genderList as $key => $value ) { ?>
                                        <option value="<?php echo $key; ?>" <?= set_select( 'gender', $key, ( $staff_member !== null ? ( strtolower( $staff_member['sex'] ) == strtolower( $key ) ) : false ) ) ?>><?php echo $value; ?></option>
                                        <?php } ?>
                                </select>
                                <span class="text-danger"><?php echo form_error( 'gender' ); ?></span>
                            </div>

                            <div class="form-group">
                                <label>Staff Departments</label>
                                <select class="form-control" name="staff_departments" required>
                                    <?php
                                    if ( $staff_departments !== false ):
                                        foreach ( $staff_departments as $staff_department ):
                                            echo "<option value='{$staff_department['id']}' " . set_select( 'staff_departments', $staff_department['id'], ( ( $staff_member !== null ? $staff_member['staff_department_id'] : null ) == $staff_department['id'] ) ) . ">{$staff_department['name']}</option>";
                                        endforeach;
                                    endif; ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="inputTeacherSalary" id="inputTeacherSalaryLabel">Monthly salary</label>
                                <input id="inputTeacherSalary" name="salary" placeholder="" type="number" min="0" class="form-control" value="<?php echo set_value( 'salary', ( $staff_member !== null ? $staff_member['salary'] : "" ) ); ?>"/>
                                <span class="text-danger"><?php echo form_error( 'salary' ); ?></span>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line( 'date_of_birth' ); ?></label>
                                <input id="dob" name="dob" placeholder="" type="text" class="form-control" value="<?php echo set_value( 'dob', ( $staff_member !== null ? date( 'm/d/Y', strtotime( $staff_member['dob'] ) ) : "" ) ); ?>" readonly/>
                                <span class="text-danger"><?php echo form_error( 'dob' ); ?></span>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line( 'address' ); ?></label>
                                <textarea id="address" name="address" placeholder="" class="form-control"><?php echo set_value( 'address', ( $staff_member !== null ? $staff_member['address'] : "" ) ); ?></textarea>
                                <span class="text-danger"><?php echo form_error( 'address' ); ?></span>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line( 'phone' ); ?></label>
                                <input id="phone" name="phone" placeholder="" type="text" class="form-control" value="<?php echo set_value( 'phone', ( $staff_member !== null ? $staff_member['phone'] : "" ) ); ?>"/>
                                <span class="text-danger"><?php echo form_error( 'phone' ); ?></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Photo (150px X 150px)</label>
                                <input type='file' name='file' id="file" size='20'/>
                            </div>

                            <div class="form-group">
                                <label>Date Of Joining</label>
                                <input type="text" id="date_of_joining" class="form-control" name="joining_date" value="<?= set_value( 'joining_date', date( 'm/d/Y', ( $staff_member !== null ? strtotime( $staff_member['joining_date'] ) : now() ) ) ) ?>" readonly>
                                <span class="text-danger"><?php echo form_error( 'joining_date' ); ?></span>
                            </div>

                            <div class="form-group">
                                <label>Qualification</label>
                                <input type="text" class="form-control" name="qualification" value="<?= set_value( 'qualification', ( $staff_member !== null ? $staff_member['qualification'] : "" ) ) ?>" maxlength="255">
                                <span class="text-danger"><?php echo form_error( 'qualification' ); ?></span>
                            </div>

                            <div class="form-group">
                                <label>Qualification Details</label>
                                <textarea class="form-control" name="qualification_details"><?= set_value( 'qualification_details', ( $staff_member !== null ? $staff_member['qualification_details'] : "" ) ) ?></textarea>
                                <span class="text-danger"><?php echo form_error( 'qualification' ); ?></span>
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
                    <?php  if($staff_type_search == 'all'){ ?>
                       <h3 class="box-title titlefix">All Registered Staff List</h3>
                    <?php }elseif($staff_type_search == 'in-active'){?>
                       <h3 class="box-title titlefix">In-Active Staff List</h3>
                    <?php }else{?>
                       <h3 class="box-title titlefix">Active Staff List</h3>
                    <?php }?>
                    
                    </div>
                    <div class="box-body">
                        <div class="mailbox-controls">
                        </div>
                        <div class="table-responsive mailbox-messages">
                            <?php
                            if ( $staff_list === false ) {
                                echo "<h4 class='text-center text-danger' style='padding-top: 15px;'>No staff member found!</h4>";                          } else {
                                ?>
                                <table class="table     table-bordered table-hover example">
                                    <thead>
                                        <tr>

                                            <th>Name</th>
                                            <th><?php echo $this->lang->line( 'email' ); ?></th>
                                            <th><?php echo $this->lang->line( 'date_of_birth' ); ?></th>
                                            <th><?php echo $this->lang->line( 'phone' ); ?></th>
                                            <th>Department</th>
                                            <th class="text-right no-print"><?php echo $this->lang->line( 'action' ); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        foreach ( $staff_list as $staff_list_item ) {
                                            ?>
                                            <tr>
                                                <td class="mailbox-name"> <?php echo $staff_list_item['name'] ?></td>
                                                <td class="mailbox-name"> <?php echo $staff_list_item['email'] ?></td>
                                                <td class="mailbox-name"> <?php echo date( $this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat( $staff_list_item['dob'] ) ); ?></td>
                                                <td class="mailbox-name"> <?php echo $staff_list_item['phone'] ?></td>
                                                <td class="mailbox-name">
                                                    <?php
                                                    $_staff_depart = $this->staff_departments_model->get( $staff_list_item['staff_department_id'] );
                                                    echo $_staff_depart['name'];
                                                    ?>
                                                </td>
                                                <td class="mailbox-date pull-right no-print">
                                                    <a href="<?= site_url( 'admin/staff' ) . "?staff_id={$staff_list_item['id']}" ?>" class="btn btn-default btn-xs" data-toggle="tooptip" title="Edit">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                      <?php  if($staff_type_search == 'active'){ ?>
                                                     <a href="<?= site_url( 'admin/staff/resign' ) . "?staff_id={$staff_list_item['id']}" ?>" class="btn btn-default btn-xs" data-toggle="tooptip" title="Resign">
                                                     <i class="fas fa-sign-out-alt"></i>
                                                    </a>
                                                      <?php }?>
                                                 <?php  if($staff_type_search == 'in-active'){ ?>
                                                  <a href="<?= site_url( 'admin/staff/rejoin' ) . "?staff_id={$staff_list_item['id']}" ?>" class="btn btn-default btn-xs" data-toggle="tooptip" title="Rejoin">
                                                             <i class="fas fa-sign-in-alt"></i>
                                                             
                                                    </a>
                                                 
                                                  <?php }?>

                                                    <!--<a href="<?php echo base_url(); ?>admin/staff/delete/<?php echo $staff_list_item['id'] ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="<?php echo $this->lang->line( 'delete' ); ?>" onclick="return confirm('Are you sure you want to delete this item?')" ;>
                                                        <i class="fa fa-remove"></i>
                                                    </a>-->
                                                </td>
                                            </tr>
                                            <?php
                                        }

                                        ?>
                                    </tbody>
                                </table>
                                <?php
                            }
                            ?>
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
        $( '#dob, #admission_date, #date_of_joining' ).datepicker( {
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

</script>
