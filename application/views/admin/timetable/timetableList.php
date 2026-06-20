<style type="text/css">
    @media print {
        .no-print, .no-print * {
            display: none !important;
        }
    }

    .print, .print * {
        display: none;
    }
</style>

<div class="content-wrapper" style="min-height: 946px;">
    <?php
        $this->load->view('layout/academics_link');
        $admind = $this->session->userdata( 'admin' ); 
        $this->load->helper('menu_helper');
        $permission = admin_permission($admind['id']);
    ?>
            
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-3">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Class Wise Timetable</h3>
                        <div style="clear: both;"></div>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive mailbox-messages">
                            <table class="table     table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Class / Section</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($class_sections as $key => $class_section): ?>
                                        <tr>
                                            <td class="mailbox-name">
                                                <a href="<?php echo base_url(); ?>admin/timetable/index?section_id=<?php echo $class_section['section_id'] ?>&class_id=<?php echo $class_section['class_id'] ?>" >
                                                    <?= $class_section['class']['class'] . '/' . $class_section['section']['section'] ?>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>                             
                                </tbody>
                            </table><!-- /.table -->
                        </div><!-- /.mail-box-messages -->
                    </div><!-- /.box-body -->
                </div>
            </div>
            <!--/.col (left) -->
            <div class="col-md-9">
 
                <?php
                if ( isset( $result_array ) ) {
                ?>
                <div class="box box-primary" id="timetable">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <?php  
                                echo $class_sections_name['class']['class']."(".$class_sections_name['section']['section'].")"; 
                            ?>
                            <?php echo $this->lang->line( 'class_timetable' ); ?>
                        </h3>
                        <!-- <div class="box-tools pull-right">
                            <a href="<?php echo base_url(); ?>admin/timetable/create" class="btn btn-primary btn-sm" data-toggle="tooltip" title="<?php echo $this->lang->line( 'add_timetable' ); ?>">
                                <i class="fa fa-plus"></i> <?php echo $this->lang->line( 'add' ); ?>
                            </a>
                        </div> -->
                    </div>
                    <div class="box-body">
                        <div class="row print">
                            <div class="col-md-12">
                                <div class="col-md-offset-4 col-md-4">
                                    <center><b><?php echo $this->lang->line( 'class' ); ?>: </b>
                                        <span class="cls"></span></center>
                                </div>
                            </div>
                        </div>
                        <?php
                        if ( !empty( $result_array ) ) {
                            ?>
                            <div class="table-responsive">
                                <table class="table     table-bordered table-hover example">
                                    <thead>
                                        <tr>
                                            <th>
                                                <?php echo $this->lang->line( 'subject' ); ?>
                                            </th>
                                            <?php foreach ( $getDaysnameList as $key => $value ) {
                                                ?>
                                                <th class="text text-center <?= strtolower( $key ) == 'sunday' ? 'hidden' : '' ?>">
                                                    <?php echo $value; ?>
                                                </th>
                                            <?php }
                                            ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ( $result_array as $key => $timetable ) {
                                            ?>
                                            <tr>
                                                <th>
                                                <?php if($permission->assign_subject_u == 1){  ?>
                                                    <a class="table_link" href="<?= site_url( "admin/teacher/assignteacher?class_id={$class_id}&section_id={$section_id}&subject_id={$subject_details[$key]['id']}&redirect=" . urlencode( current_url() . '?' . $_SERVER['QUERY_STRING'] ) ) ?>" title="Edit timetable">
                                                    <?php }else{  ?>
                                                         <a  href="#" >
                                                    <?php }?> 
                                                        <?= $key ?>
                                                    </a>
                                                    
                                                    <br><span style="font-weight: 400; font-size: 12px;">(<?= $subject_class_teacher[$key]['teacher_details']['name'] ?>)</span>
                                                </th>
                                                <?php
                                                foreach ( $timetable as $key1 => $value ) {
                                                    $status = $value->status;
                                                    if ( $status == "Yes" ) {
                                                        ?>
                                                        <td class="text text-center <?= strtolower( $key1 ) == 'sunday' ? 'hidden' : '' ?>">
                                                            <?php if($permission->class_wise_timtable_u == 1){  ?>
                                                            <a  href="<?= site_url( "admin/timetable/create?class_id={$class_id}&section_id={$section_id}&subject_id={$subject_details[$key]['id']}&redirect=" . urlencode( current_url() . '?' . $_SERVER['QUERY_STRING'] ) ) ?>" title="Edit timetable">
                                                            <?php }else{  ?>
                                                            <a  href="#" >
                                                            <?php }?>

                                                            <div class="attachment-block clearfix">
                                                                <?php if ( $value->start_time != "" ) { ?>
                                                                    <span><?php echo $value->start_time; ?></span>
                                                                    <?php }else{ ?>
                                                                    <span class="text text-center">
                                                                        <!--<?php echo $this->lang->line( 'not' ); ?>-->
                                                                        <!--<br/><?php echo $this->lang->line( 'scheduled' ); ?>-->
                                                                    </span><br/>
                                                                    <strong class="text-green"></strong>
                                                                    <?php } ?>
                                                            </div>
                                                            </a>
                                                        </td>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <td class="text text-center <?= strtolower( $key1 ) == 'sunday' ? 'hidden' : '' ?>">
                                                        <?php if($permission->class_wise_timtable_u == 1){  ?>
                                                            <a class="table_link" href="<?= site_url( "admin/timetable/create?class_id={$class_id}&section_id={$section_id}&subject_id={$subject_details[$key]['id']}&redirect=" . urlencode( current_url() . '?' . $_SERVER['QUERY_STRING'] ) ) ?>" title="Edit timetable">
                                                            <?php }else{  ?>
                                                            <a  href="#" >
                                                            <?php }?>
                                                                <div class="attachment-block clearfix">
                                                                    <strong class="text-red"><?php echo $value->start_time; ?></strong>
                                                                </div>
                                                            </a>
                                                        </td>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php
                        } else {
                            ?>
                            <div class="alert alert-info"><?php echo $this->lang->line( 'no_record_found' ); ?></div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
        } else {
        }
        ?>
    </section>
</div>

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
        var class_id = $( '#class_id' ).val();
        var section_id = '<?php echo set_value( 'section_id' ) ?>';
        getSectionByClass( class_id, section_id );
        $( document ).on( 'change', '#feecategory_id', function ( e ) {
            $( '#feetype_id' ).html( "" );
            var feecategory_id = $( this ).val();
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line( 'select' ); ?></option>';
            $.ajax( {
                type: "GET",
                url: base_url + "feemaster/getByFeecategory",
                data: {'feecategory_id': feecategory_id},
                dataType: "json",
                success: function ( data ) {
                    $.each( data, function ( i, obj ) {
                        div_data += "<option value=" + obj.id + ">" + obj.type + "</option>";
                    } );

                    $( '#feetype_id' ).append( div_data );
                }
            } );
        } );
    } );

    $( document ).on( 'change', '#section_id', function ( e ) {
        $( "form#schedule-form" ).submit();
    } );
</script>

<script type="text/javascript">
    var base_url = '<?php echo base_url() ?>';

    function printDiv( elem ) {
        var cls = $( "#class_id option:selected" ).text();
        var sec = $( "#section_id option:selected" ).text();
        $( '.cls' ).html( cls + '(' + sec + ')' );
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