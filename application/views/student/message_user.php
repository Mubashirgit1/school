<style type="text/css">
    @media print {
        .no-print, .no-print * {
            display: none !important;
        }
    }
</style>
<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
    <div class="box box-primary" >  
      <div class="box-header with-border" >
                    <div class="row">
    <div class="col-sm-6 col-md-3">
    <h4>
           <?= $title ?>
        </h4>
    </div>
    
    <div class="col-sm-6 col-md-1 pull-right" >
    
    
                       <a style="margin-left:15px;" href="<?php echo site_url( 'student/send_message' ) ?>" class="btn btn-primary back_btn">
                        <i class="fa fa-chevron-left"></i> Back
                    </a>
                    
       </div>
        </div>
          </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-5">
            
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Select Administrator</h3>
                    </div>
                    <form id="form1" action="<?php echo site_url( 'student/send_message_username' ) ?>" id="employeeform" name="employeeform" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                    <div class="box-body">
                        <?php $admind = $this->session->userdata( 'admin' );?> 
                        <input type="hidden" name="message_id" value="<?= $messages['id']?>">
                        <?php if ( empty( $admind) ): ?>
                        <p class="text-center text-danger">No teacher has been added yet.</p>
                        <?php else: ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th width="26%" title="Select all classes and students in them">
                                        Select All 
                                    </th>
                                    <th>
                                        Select Admin
                                    </th>
                                    <th>NAME</th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><input type="checkbox" class="select_checkbox_all" data-target=".class_section_checkbox_all"></td>
                                <td><input type="checkbox" class="class_section_checkbox_all" name="admin_id" value="<?= $admind['id'] ?>" ></td>                             <td><?= $admind['username'] ?></td>                 
                            </tr>
                            </tbody>
                        </table>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Select Teachers</h3>
                    </div>
                    
                    <div class="box-body">
                
                        <?php if ( empty( $teachers) ): ?>
                            <p class="text-center text-danger">No teacher has been added yet.</p>
                        <?php else: ?>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th width="26%" title="Select all classes and students in them">
                                            <input type="checkbox" class="select_checkbox_teacher class_section_checkbox_all" data-target=".class_section_checkbox_teacher">
                                            <span>Select All</span>
                                        </th>
                                    
                                        <th>T.ID</th>
                                        <th>NAME</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ( $teachers as $teacher ): ?>
                                        <tr>
                                        <td><input type="checkbox" class="class_section_checkbox_teacher select_checkbox_teacher"  name="teacher_ids[]" value="<?= $teacher['id'] ?>" ></td>
                                            <td title="Select all students in this class" >
                                                <?= $teacher['id'] ?> 
                                            </td>
                                            <td>   <?= $teacher['name'] ?> </td>                 
                                            
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
            <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Select Students</h3>
                    </div>
                    <div class="box-body">
                            
                                    <?php if ( empty( $class_sections ) ): ?>
                                    <p class="text-center text-danger">No class has been added yet.</p>
                                <?php else: ?>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th width="5%" title="Select all classes and students in them">
                                                    <input type="checkbox" class="select_checkbox class_section_checkbox_all" data-target=".class_section_checkbox">
                                                    <span>Select All</span>
                                                </th>

                                                <th><?php echo $this->lang->line('guardian_name'); ?></th>
                                                <th><?php echo $this->lang->line('guardian_phone'); ?></th>
                                                <th>Username</th>
                                                <th>Password</th>
                                                <th>Childs</th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                        <?php
                                    if (!empty($parentList)) {
                                        $count = 1;
                                        foreach ($parentList as $parent) {
                                          
                                            if (!empty($parent->siblings)) {
                                                $sibling = $parent->siblings;
                                                ?>
                                                <tr>
                                                
                                                <td title="Select all students in this class">
                                                        <input type="checkbox" class="class_section_checkbox select_checkbox " name="parent_ids[]" value="<?= $parent->id ?>" data-target="">
                                                        <td><?php echo $sibling[0]['guardian_name']; ?></td>
                                                    </td>
                                                    
                                                    <td><?php echo $sibling[0]['guardian_phone']; ?></td>
                                                    <td><?php echo $parent->username; ?></td>
                                                    <td><?php echo $parent->password; ?></td>
                                                    <td>
                                                    <?php foreach($sibling as $key => $sib){  ?>
                                                        <?php if($key > 0){?>
                                                            <br>
                                                        <?php }?>
                                                    <?php echo  $sib['admission_no'].' ('. $sib['firstname'].' '.$sib['lastname'].')';?>
                                                    <?php }?>
                                                    </td>
                                                    
                                                </tr>
                                                <?php
                                            }


                                            $count++;
                                        }
                                    }
                                    ?>

                                        </tbody>
                                    </table>
                                <?php endif; ?>
                            
                                <div class="box-footer">
                        <button type="submit" class="btn btn-info pull-right">Send</button>
                    </div>                         
                </div>
            </div>
                
            </form>
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


    jQuery( function ( $ ) {
        $( ".select_checkbox" ).on( 'change', function ( e ) {
            var target = $( this ).data( 'target' ),
                current_checked = $( this ).prop( 'checked' );

            if ( current_checked === true ) {
                $( target ).prop( 'checked', true ).change();
            } else {
                $( target ).prop( 'checked', false ).change();
            }
        } );
		

  } );
  
  
    jQuery( function ( $ ) {
        $( ".select_checkbox_teacher" ).on( 'change', function ( e ) {
            var target = $( this ).data( 'target' ),
                current_checked = $( this ).prop( 'checked' );

            if ( current_checked === true ) {
                $( target ).prop( 'checked', true ).change();
            } else {
                $( target ).prop( 'checked', false ).change();
            }
        } );
	} );

  jQuery( function ( $ ) {
        $( ".select_checkbox_staff" ).on( 'change', function ( e ) {
            var target = $( this ).data( 'target' ),
                current_checked = $( this ).prop( 'checked' );

            if ( current_checked === true ) {
                $( target ).prop( 'checked', true ).change();
            } else {
                $( target ).prop( 'checked', false ).change();
            }
        } );
		

  } );
  
    jQuery( function ( $ ) {
        $( ".select_checkbox_all" ).on( 'change', function ( e ) {
            var target = $( this ).data( 'target' ),
                current_checked = $( this ).prop( 'checked' );

            if ( current_checked === true ) {
                $( target ).prop( 'checked', true ).change();
            } else {
                $( target ).prop( 'checked', false ).change();
            }
        } );
		

  } );


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
