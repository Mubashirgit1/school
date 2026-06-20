
<div class="content-wrapper" style="min-height: 946px;">
    <!-- Content Header (Page header) -->
    <!-- <section class="content-header">
        <div style="display: inline-block; float: right;">
            <form action="<?php echo site_url( 'admin/timetable/create' ) ?>" method="post" accept-charset="utf-8" class="form-inline">

                <div class="form-group">
                    <label for="exampleInputEmail1"><?php echo $this->lang->line( 'class' ); ?></label>
                    <select id="class_id" name="class_id" class="form-control">
                        <option value=""><?php echo $this->lang->line( 'select' ); ?></option>
                        <?php
                        foreach ( $classlist as $class ) {
                            ?>
                            <option value="<?php echo $class['id'] ?>" <?php if ( set_value( 'class_id' ) == $class['id'] ) echo "selected=selected"; ?>><?php echo $class['class'] ?></option>
                            <?php
                            $count++;
                        }
                        ?>
                    </select>
                    <span class="text-danger"><?php echo form_error( 'class_id' ); ?></span>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1"><?php echo $this->lang->line( 'section' ); ?></label>
                    <select id="section_id" name="section_id" class="form-control">
                        <option value=""><?php echo $this->lang->line( 'select' ); ?></option>
                    </select>
                    <span class="text-danger"><?php echo form_error( 'section_id' ); ?></span>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1"><?php echo $this->lang->line( 'subject' ); ?></label>
                    <select id="subject_id" name="subject_id" class="form-control">
                        <option value=""><?php echo $this->lang->line( 'select' ); ?></option>
                    </select>
                    <span class="text-danger"><?php echo form_error( 'subject_id' ); ?></span>
                </div>

                <button type="submit" class="btn btn-primary btn-sm">Search</button>
            </form>
        </div>
    </section> -->
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <?php
                if ( !empty( $timetableSchedule ) ) {
                ?>
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <?= $class_name ?> / <?= $section_name ?> / <?= $subject_name ?> Timetable Schedule
                        </h3>
                    </div>
                    <div class="box-body">
                        <?php
                        if ( !empty( $timetableSchedule ) ) {
                            ?>
                            <form role="form" id="" class="addmarks-form" method="post" action="<?php echo site_url( 'admin/timetable/create' ) . ( $this->input->get( 'redirect' ) !== null ? "?redirect=" . urlencode( $this->input->get( 'redirect' ) ) : "" ) ?>">
                                <?php echo $this->customlib->getCSRF(); ?>
                                <div class="table-responsive">
                                    <table class="table     table-hover">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <?php echo $this->lang->line( 'day' ); ?>
                                                </th>
                                                <th>
                                                    <?php echo $this->lang->line( 'start_time' ); ?>
                                                </th>
                                                <th class="hidden">
                                                    <?php echo $this->lang->line( 'end_time' ); ?>
                                                </th>
                                                <th>
                                                    <?php echo $this->lang->line( 'room_no' ); ?>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if ( !empty( $timetableSchedule ) ) {
                                                $count = 0;
                                                foreach ( $timetableSchedule as $key => $value ) {
                                                    ?>

                                                    <input type="hidden" value="<?php echo $key; ?>" name="i[]">
                                                    <input type="hidden" value="<?php echo $value->post_id; ?>" name="edit_<?php echo $key; ?>">
                                                    <input type="hidden" name="class_id" value="<?php echo $class_id; ?>">
                                                    <input type="hidden" name="section_id" value="<?php echo $section_id; ?>">
                                                    <input type="hidden" name="subject_id" value="<?php echo $subject_id; ?>">
                                                    <tr class="<?= strtolower( $key ) == 'sunday' ? 'hidden' : '' ?>">
                                                        <th>
                                                            <?php echo $key; ?>
                                                        </th>
                                                        <th style="width:300px;">
                                                            <div class="bootstrap-timepicker">
                                                                <div class="form-group">
                                                                    <div class="input-group">
                                                                        <input type="text" name="stime_<?php echo $key; ?>" class="form-control timepicker tt_start_time tt_start_time_<?= $count ?>" data-tt-start-time-count="<?= $count ?>" id="stime_" value="<?php echo $value->starting_time; ?>">
                                                                        <div class="input-group-addon">
                                                                            <i class="fa fa-clock-o"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </th>
                                                        <th style="width:300px;" class="hidden">
                                                            <div class="bootstrap-timepicker">
                                                                <div class="form-group">
                                                                    <div class="input-group">
                                                                        <input type="text" name="etime_<?php echo $key; ?>" class="form-control timepicker tt_end_time tt_end_time_<?= $count ?>" data-tt-end-time-count="<?= $count ?>" id="etime_" value="<?php echo $value->ending_time; ?>">
                                                                        <div class="input-group-addon">
                                                                            <i class="fa fa-clock-o"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </th>
                                                        <th style="width:300px;">
                                                            <div class="form-group">
                                                                <input type="text" name="room_<?php echo $key; ?>" class="form-control" id="room_" value="<?php echo $value->room_no; ?>" placeholder="<?php echo $this->lang->line( 'enter_room_no' ); ?>">
                                                            </div>
                                                        </th>
                                                    </tr>

                                                    <?php
                                                    $count++;
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <button type="submit" class="btn btn-primary pull-right" name="save_exam" value="save_exam"><?php echo $this->lang->line( 'save' ); ?></button>
                            </form>
                            <?php
                        } else {
                            ?>
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
        $( document ).on( 'change', '#section_id', function ( e ) {
            $( '#subject_id' ).html( "" );
            var section_id = $( this ).val();
            var class_id = $( '#class_id' ).val();
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line( 'select' ); ?></option>';
            $.ajax( {
                type: "POST",
                url: base_url + "admin/teacher/getSubjctByClassandSection",
                data: {'class_id': class_id, 'section_id': section_id},
                dataType: "json",
                success: function ( data ) {
                    $.each( data, function ( i, obj ) {
                        div_data += "<option value=" + obj.id + ">" + obj.name + " (" + obj.type + ")" + "</option>";
                    } );

                    $( '#subject_id' ).append( div_data );
                }
            } );
        } );
    } );
</script>

<link rel="stylesheet" href="<?php echo base_url() ?>backend/plugins/timepicker/bootstrap-timepicker.min.css">
<script src="<?php echo base_url() ?>backend/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script>
    $( function () {

        $( ".timepicker" ).timepicker( {
            showInputs: false,
            defaultTime: false,
            explicitMode: false,
            minuteStep: 1
        } );
    } );

    $( document ).ready( function () {
        var class_id = $( '#class_id' ).val();
        var section_id = '<?php echo set_value( 'section_id' ) ?>';
        var subject_id = '<?php echo set_value( 'subject_id' ) ?>';
        getSectionByClass( class_id, section_id );
        getSubjectByClassandSection( class_id, section_id, subject_id );
    } );

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

    function getSubjectByClassandSection( class_id, section_id, subject_id ) {
        console.log( "rrrr" );
        if ( class_id != "" && section_id != "" && subject_id != "" ) {
            $( '#subject_id' ).html( "" );
            var class_id = $( '#class_id' ).val();
            var base_url = '<?php echo base_url() ?>';
            var div_data = '<option value=""><?php echo $this->lang->line( 'select' ); ?></option>';
            $.ajax( {
                type: "POST",
                url: base_url + "admin/teacher/getSubjctByClassandSection",
                data: {'class_id': class_id, 'section_id': section_id},
                dataType: "json",
                success: function ( data ) {
                    $.each( data, function ( i, obj ) {
                        var sel = "";
                        if ( subject_id == obj.id ) {
                            sel = "selected";
                        }
                        div_data += "<option value=" + obj.id + " " + sel + ">" + obj.name + " (" + obj.type + ")" + "</option>";
                    } );

                    $( '#subject_id' ).append( div_data );
                }
            } );
        }
    }
</script>