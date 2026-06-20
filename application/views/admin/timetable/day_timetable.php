<?php $currency_symbol = $this->customlib->getSchoolCurrencyFormat(); ?>
    <!-- Main content -->

<div class="content-wrapper" style="min-height: 946px;">
    <?php $this->load->view('layout/academics_link');
     $admind = $this->session->userdata( 'admin' ); 
     $this->load->helper('menu_helper');
     $permission = admin_permission($admind['id']);
    ?>
    <section class="content">
        <div class="row">
            <?php if ( empty( $class_sections ) ): ?>
                <p class="text-center text-danger">No Timetable available for this query!</p>
            <?php else: ?>
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                Daily Timetable
                            </h3>
                            <div class="" style="float: right;">
                                <form role="form" action="<?php echo current_url() ?>" method="get" class="form-inline">
                                    <?php echo $this->customlib->getCSRF(); ?>
                                    <div class="form-group">
                                        <label>Date</label>
                                        <input type="text" class="form-control date" name="timetable_date" value="<?= set_value( 'timetable_date' ) ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button type="submit" name="search" value="search_filter" class="btn btn-primary btn-sm pull-right checkbox-toggle">
                                                <i class="fa fa-search"></i> <?php echo $this->lang->line( 'search' ); ?>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                      
                            <?php if ($permission->daily_timetable == 1) {	?>
                                <div class="box-body no-padding">
                                    <div class="btn-group btn-group-sm" role="group" aria-label=''>
                                        <a href="<?= site_url( $previous_link ) ?>" class="btn btn-default">
                                            <i class="fa fa-chevron-left"></i> Previous
                                        </a>
                                        <button type="button" class="btn btn-default" disabled><?= ucwords( $day_name ) ?></button>
                                        <a href="<?= site_url( $next_link ) ?>" class="btn btn-default">
                                            Next <i class="fa fa-chevron-right"></i>
                                        </a>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover example">
                                            <thead>
                                                <tr>
                                                    <?php for ( $i = 0; $i <= $max_day_timetables; $i++ ): ?>
                                                        <th>
                                                            <?= ( $i != 0 ? "Period {$i}" : "Class/Sections" ) ?>
                                                        </th>
                                                    <?php endfor; ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ( $class_sections as $class_section ): ?>
                                                    <?php if ( !empty( $class_section['day_timetable'] ) ): ?>
                                                        <tr>
                                                            <td>
                                                                <?= $class_section['class'] ?>/<?= $class_section['section'] ?>
                                                            </td>

                                                            <?php foreach ( $class_section['day_timetable'] as $d_tt ): ?>
                                                            <?php if($d_tt['start_time']){?>
                                                                <td>
                                                                <?php if($permission->assign_subject_u   == 1){  ?>
                                                                    <a href="<?= site_url( "admin/teacher/assignteacher?class_id={$class_section['class_id']}&section_id={$class_section['section_id']}" ) ?>" >
                                                                      <?php }else{  ?>
                                                                    <a  href="#" >
                                                                    <?php }?>
                                                                    
                                                                        <?= $d_tt['subject_name'] ?>
                                                                    </a>

                                                                    <br>
                                                                    <?= $d_tt['teacher_name'] ?>
                                                                    <br>
                                                                    <?php if($permission->class_wise_timtable_u   == 1){  ?>
                                                                    <a href="<?= site_url( "admin/timetable/create?class_id={$class_section['class_id']}&section_id={$class_section['section_id']}&subject_id={$d_tt['teacher_subject_id']}&redirect=" . urlencode( current_url() ) ) ?>" class="table_link">
                                                                    <?php }else{  ?>
                                                                    <a  href="#" >
                                                                    <?php }?>
                                                                    <small><?= $d_tt['start_time'] ?></small>
                                                                    </a>
                                                                </td>
                                                                <?php }?>
                                                            <?php endforeach; ?>

                                                            <?php for ( $i = 0; $i < ( $max_day_timetables - count( $class_section['day_timetable'] ) ); $i++ ): ?>
                                                                <td></td>
                                                            <?php endfor; ?>
                                                        </tr>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            <?php } ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
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

        $( '.date' ).datepicker( {
            format: 'mm/dd/yyyy',
            autoclose: true
        } );

    } );
</script>