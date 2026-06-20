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
                    Student Annual Attendance Report
                </h4>
                <h4 class="pull-right" style="margin-top: 0px;">
                   <a href="<?= site_url('admin/stuattendence/advanceAttendance?id='.$student_details['id'])?>">Advance Attendence</a>
                </h4>
               
            </div>
        </div>
        <div class="clearfix"></div>
    </section>
    <section class="content">
        <div class="row">
            

            <div class="col-sm-12 col-md-12">
                <?php
			
				
                if ( isset( $resultlist ) ) {
                    ?>
                    <div class="box box-primary" id="attendencelist">
                        <div class="box-header with-border">
                            <div class="row">


                                <div class="col-md-4 col-sm-4">
                                    <h3 class="box-title attendance_report_title">
                                  
                                      <?= $student_details['firstname']." ".$student_details['lastname'] ?>   (<?= $student_details['class']."/".$student_details['section'] ?>)
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
                            
                            <div class="pull-right">
                
                            <h4><?php  $total_working = 365 - $total ?>

Today Working Day No: <?= $total_working ?></h4>
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
                                <table class="table     table-bordered table-hover  xyz">
                                    <thead>
                                        <tr>
                                            <th>
                                     
                                            </th>
                                         <th class="text-success text-center">P</th>
                                        <th class="text-danger text-center">A</th>
                                        <th class="text-blue text-center">L</th>
                                     
                                            
                                            <?php
											
							
							
                                            foreach ( $attendence_array as $at_key => $at_value ) {
                                                if ( date( 'D', $this->customlib->dateyyyymmddTodateformat( $at_value ) ) == "Sun" ) {
                                                    ?>
                                                    <th class="tdcls text text-center bg-danger">
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

										  for ( $m = 1; $m < 13; $m++ ):
								    
                                            $total_present =0;
                                            $total_absent = 0;
                                            $total_leave = 0;
									
                                        foreach ( $resultlist[$m]['day_attendance'] as $at_key => $at_value):
                                            $attLetter = $at_value['0'];
                                            
                                            if($attLetter['key'] != ''){
                                            if ( $attLetter['attendence_type_id'] == 1) {
                                                $total_present += 1;
                                            }
                                            if ($attLetter['attendence_type_id'] == 4) {
                                                $total_absent += 1;
                                            }
                                            if ( $attLetter['attendence_type_id'] == 3 ) {
                                                $total_leave += 1;
                                            }
                                        }
                                        endforeach;

							   		    $annual = str_pad($m,2,0,STR_PAD_LEFT);
										$monthNum  = $annual;
                                        $dateObj   = DateTime::createFromFormat('!m', $monthNum);
                                        $monthName = $dateObj->format('F'); ?>
                                          <tr>
										  <th><?= $monthName ?></th>
                                            <td  class="text-success text-center"><?= $total_present ?></td>
                                            <td class="text-danger text-center"><?= $total_absent ?></td>
                                            <td class="text-blue text-center"><?= $total_leave ?></td>

                                            <?php
                                            
                                            foreach ( $resultlist[$m]['day_attendance'] as $at_key => $at_value){ ?>
                                            <?php 

                                            // if($at_value['0']['date'] != 'xxx'){
                                            //     echo "<pre>";
                                            //     print_r(date('F',strtotime($at_value['0']['date'])));
                                            //     echo "</pre>";

                                            // }
                                            ?>
                                            
                                                <th><?php print_r($at_value['0']['key']); ?></th>  

                                            <?php
                                        
                                    
                                        }?>

										  </tr>
										  <?php  endfor;  ?>
                                          
                                         <?php  } ?>
                                    </tbody>
                                </table>
                                <?php } else {  ?>
                                <div class="alert alert-info">
                                    <?php echo $this->lang->line( 'no_attendance_prepare' ); ?>
                                </div>
                                <?php  } ?>
                        </div>
                    </div>
                   
    </section>
</div>
</div>
</section>
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