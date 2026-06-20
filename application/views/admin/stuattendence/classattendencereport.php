<style type="text/css">
    @media print {
        .no-print, .no-print * {
            display: none !important;
        }
    }
</style>
<div class="content-wrapper" style="min-height: 946px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="box box-primary" style="margin-bottom: 0px;">
            <div class="box-header with-border">
                <h4 class="pull-left" style="margin-top: 0px;">
                    Student Attendance Report
                </h4>
            
                <div class="pull-right">
                    <form id='form1' class="form-inline" action="<?php echo site_url( 'admin/stuattendence/classattendencereport' ) ?>" method="post" accept-charset="utf-8">
                        <?php echo $this->customlib->getCSRF(); ?>

                        <!-- <div class="form-group">
                            <label for="exampleInputEmail1"><?php echo $this->lang->line( 'class' ); ?></label>
                            <select id="class_id" name="class_id" class="form-control">
                                <option value=""><?php echo $this->lang->line( 'select' ); ?></option>
                                <?php
                                foreach ( $classlist as $class ) {
                                    ?>
                                    <option value="<?php echo $class['id'] ?>" <?php
                                    if ( $class_id == $class['id'] ) {
                                        echo "selected =selected";
                                    }
                                    ?>><?php echo $class['class'] ?></option>
                                    <?php
                                    $count++;
                                }
                                ?>
                            </select>
                            <span class="text-danger"><?php echo form_error( 'class_id' ); ?></span>
                        </div> -->
                        <!-- <div class="form-group">
                            <label for="exampleInputEmail1"><?php echo $this->lang->line( 'section' ); ?></label>
                            <select id="section_id" name="section_id" class="form-control">
                                <option value=""><?php echo $this->lang->line( 'select' ); ?></option>
                            </select>
                            <span class="text-danger"><?php echo form_error( 'section_id' ); ?></span>
                        </div> -->

                        <div class="form-group">
                            <label for="exampleInputEmail1"><?php echo $this->lang->line( 'month' ); ?></label>
                            <select id="month" name="month" class="form-control">
                                <option value=""><?php echo $this->lang->line( 'select' ); ?></option>
                                <?php
                                foreach ( $monthlist as $m_key => $month ) {
                                    ?>
                                    <option value="<?php echo $m_key ?>" <?php
                                    if ( $month_selected == $m_key ) {
                                        echo "selected =selected";
                                    }
                                    ?>><?php echo $month; ?></option>
                                    <?php
                                    $count++;
                                }
                                ?>
                            </select>
                            <span class="text-danger"><?php echo form_error( 'month' ); ?></span>
                        </div>

                        <div class="form-group">
                            <button type="submit" name="search" value="search" class="btn btn-primary btn-sm pull-right checkbox-toggle">
                                <i class="fa fa-search"></i> <?php echo $this->lang->line( 'search' ); ?>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-sm-2 col-md-2">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            Class(Section)
                        </h3>
                        <br><br>

<?php  $total_working = 365 - $total  ?>

Today Working Day No: <?= $total_working ?>


                    </div>
                    
                    
                    <div class="box-body">
                        <?php if ( $class_sections === false ): ?>
                            <p class="text-center text-danger">No Class Sections found.</p>
                        <?php else: ?>
                            <table class="table">
                                <?php 
                                    $total_p = 0;
                                    $total_l = 0;
                                    $total_a = 0;
                                    foreach ( $class_sections as $class_section ):
                                        $total_p  += $class_section['attendance_cus']['p'];
                                        $total_l  += $class_section['attendance_cus']['l'];
                                        $total_a  += $class_section['attendance_cus']['a'];
                                    endforeach;
                                ?>
                                <thead>
                                    <tr>
                                        <th>Total</th>
                                        <th width="14%"  class="text-success">
                                            <a href="<?= site_url( 'admin/stuattendence/classattendencereport' ) ?>" class="text-success">
                                                <?= $total_p ?>
                                            </a>
                                        </th>
                                        <th width="14%"  class="text-danger">
                                            <a href="<?= site_url( 'student/total_absent_report' ) ?>" class="text-danger">
                                                <?= $total_a ?>
                                            </a>
                                        </th>
                                        <th width="14%"  class="text-blue">
                                            <a href="<?= site_url( 'student/total_leave_report' ) ?>" class="text-blue" >
                                                <?= $total_l ?>
                                            </a>
                                        </th>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        <th>Classes</th>
                                        <th class="text-success">P</th>
                                        <th class="text-danger">A</th>
                                        <th class="text-blue">L</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
									
									
									
                                    foreach ( $class_sections as $class_section ): ?>
                                        <tr>
                                            <td>
                                                <a href="<?= site_url( 'admin/stuattendence/classattendencereport' ) . "?class_id={$class_section['class_id']}&section_id={$class_section['section_id']}&month=" . $month_selected ?>" class="class_section_name"><?= $class_section['class']['class'] ?> / <?= $class_section['section']['section'] ?></a>
                                            </td>
                                            <td class="text-success"><?= $class_section['attendance_cus']['p'] ?></td>
                                            <td class="text-danger"><?= $class_section['attendance_cus']['a'] ?></td>
                                            <td class="text-blue"><?= $class_section['attendance_cus']['l'] ?></td>
                                            <td>
                                                <span style="<?= intval( $class_section['attendance']['total_attendance'] ) > 0 ? "color: green;" : "color: #ccc;" ?>"><i class="fa fa-check"></i></span>
                                            </td>
                                        </tr>
                                    <?php
                                    endforeach; ?>
                                </tbody>
                            </table>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="col-sm-10 col-md-10">
                <?php
			
				
                if ( isset( $resultlist ) ) {
                    ?>
                    <div class="box box-primary" id="attendencelist">
                        <div class="box-header with-border">
                            <div class="row">


                                <div class="col-md-4 col-sm-4">
                                    <h3 class="box-title attendance_report_title">
                                        <?= $class_name ?> ( <?= $section_name ?> ) Attendance Report
                                    </h3>
                                </div>
                                <div class="col-md-8 col-sm-8">
                                    <div class="pull-right">
                                        <?php

                                        foreach ( $attendencetypeslist as $key_type => $value_type ) {
                                            ?>
                                            &nbsp;&nbsp;
                                            <b>
                                                <?php
                                                $att_type = str_replace( " ", "_", strtolower( $value_type['type'] ) );
                                                echo $this->lang->line( $att_type ) . ": " . $value_type['key_value'] . "";
                                                ?>
                                            </b>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-body table-responsive">


                            <?php
                            if ( !empty( $resultlist ) ) {
                                ?>
                                <div class="mailbox-controls">
                                    <div class="pull-right">
                                    </div>
                                </div>
                                <table class="table     table-bordered table-hover example xyz">
                                    <thead>
                                        <tr>
                                            <th>
                                                <?php echo $this->lang->line( 'student' ); ?> / <?php echo $this->lang->line( 'date' ); ?>
                                            </th>
                                            <th>
                                            Ad No
                                            </th>
                                            <?php
											
										
                                            foreach ( $attendence_array as $at_key => $at_value ) {
                                                if ( date( 'D', $this->customlib->dateyyyymmddTodateformat( $at_value ) ) == "Sun" ) {
                                        
                                                  ?>
                                                    <th class="tdcls text text-center bg-danger ">
                                                        <?php
                                                        echo date( 'd', $this->customlib->dateyyyymmddTodateformat( $at_value ) ) . "<br/>" .
                                                            date( 'D', $this->customlib->dateyyyymmddTodateformat( $at_value ) );
                                                        ?>
                                                    </th>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <th class="tdcls text text-center">
                                                        <?php
                                                        echo date( 'd', $this->customlib->dateyyyymmddTodateformat( $at_value ) ) . "<br/>" .
                                                            date( 'D', $this->customlib->dateyyyymmddTodateformat( $at_value ) );
                                                        ?>
                                                    </th>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                        <?php 
									
										
										if ( empty( $student_array ) ) {
                                            ?>
                                            <tr>
                                                <td colspan="32" class="text-danger text-center"><?php echo $this->lang->line( 'no_record_found' ); ?></td>
                                            </tr>
                                            <?php
                                        } else {
                                            $row_count = 1;
											
											
											 foreach ( $student_array as $student_key => $student_value ) {
                                                ?>
                                                <tr <?= $student_value['struck_off']==1?'style="color:red;"':''?>>
                                                    <th class="tdclsname" >

 <a <?= $student_value['struck_off']==1?'style="color:red !important;"':''?> href="<?= site_url( 'admin/stuattendence/attendance_report_student'."?student_id={$student_value['student_id']}" ) ?>">
													
													<?php echo $student_value['firstname'] . " " . $student_value['lastname']; ?></a>

                                                    </th>
                                                    <th>
                                                    <?= $student_value['admission_no']  ?>
                                                    </th>

                                                    <?php
                                    foreach ( $attendence_array as $at_key => $at_value ) {
                                    if ( date( 'D', $this->customlib->dateyyyymmddTodateformat( $at_value ) ) == "Sun" ) {	 ?>
							           <th class="tdcls text text-center">Holiday</th>
                                    <?php  }else{
                                          
                                            
                                        if($saturday == 1 && date( 'D', $this->customlib->dateyyyymmddTodateformat( $at_value ) ) == "Sat" ){
                                       
?>

<th class="tdcls text text-center">Holiday</th>

 <?php                                       }else{

                                      
                                        ?>    

                                          
                                      <th class="tdcls text text-center">
                                      <?php echo $resultlist[$at_value][$student_value['student_session_id']]['key']; ?>
                                                        </th>



                                                        <?php
                                                      }    
                                                    
                                                    } 
                                                     } ?>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <?php
                            } else {
                                ?>
                                <div class="alert alert-info">
                                    <?php echo $this->lang->line( 'no_attendance_prepare' ); ?>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                }
                ?>
    </section>
</div>
<script type="text/javascript">
    $( document ).ready( function () {

        $(document).on('click', '.class_section_name', function (e) {
            $('.attendance_report_title').html("");
            var class_title  = $(this).html();
            $('.attendance_report_title').html(class_title+' Attendance Report');
            
        });


        var section_id_post = '<?php echo $section_id; ?>';
        var class_id_post = '<?php echo $class_id; ?>';
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
        var date_format = '<?php echo $result = strtr( $this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',] ) ?>';
        $( '#date' ).datepicker( {
            format: date_format,
            autoclose: true
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