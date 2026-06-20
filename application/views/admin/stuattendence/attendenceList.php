<style type="text/css">
    .radio {
        padding-left: 20px;
    }

    .radio label {
        display: inline-block;
        vertical-align: middle;
        position: relative;
        padding-left: 5px;
    }

    .radio label::before {
        content: "";
        display: inline-block;
        position: absolute;
        width: 17px;
        height: 17px;
        left: 0;
        margin-left: -20px;
        border: 1px solid #cccccc;
        border-radius: 50%;
        background-color: #fff;
        -webkit-transition: border 0.15s ease-in-out;
        -o-transition: border 0.15s ease-in-out;
        transition: border 0.15s ease-in-out;
    }

    .radio label::after {
        display: inline-block;
        position: absolute;
        content: " ";
        width: 11px;
        height: 11px;
        left: 3px;
        top: 3px;
        margin-left: -20px;
        border-radius: 50%;
        background-color: #555555;
        -webkit-transform: scale(0, 0);
        -ms-transform: scale(0, 0);
        -o-transform: scale(0, 0);
        transform: scale(0, 0);
        -webkit-transition: -webkit-transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33);
        -moz-transition: -moz-transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33);
        -o-transition: -o-transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33);
        transition: transform 0.1s cubic-bezier(0.8, -0.33, 0.2, 1.33);
    }

    .radio input[type="radio"] {
        opacity: 0;
        z-index: 1;
    }

    .radio input[type="radio"]:focus + label::before {
        outline: thin dotted;
        outline: 5px auto -webkit-focus-ring-color;
        outline-offset: -2px;
    }

    .radio input[type="radio"]:checked + label::after {
        -webkit-transform: scale(1, 1);
        -ms-transform: scale(1, 1);
        -o-transform: scale(1, 1);
        transform: scale(1, 1);
    }

    .radio input[type="radio"]:disabled + label {
        opacity: 0.65;
    }

    .radio input[type="radio"]:disabled + label::before {
        cursor: not-allowed;
    }

    .radio.radio-inline {
        margin-top: 0;
    }

    .radio-primary input[type="radio"] + label::after {
        background-color: #337ab7;
    }

    .radio-primary input[type="radio"]:checked + label::before {
        border-color: #337ab7;
    }

    .radio-primary input[type="radio"]:checked + label::after {
        background-color: #337ab7;
    }

    .radio-danger input[type="radio"] + label::after {
        background-color: #d9534f;
    }

    .radio-danger input[type="radio"]:checked + label::before {
        border-color: #d9534f;
    }

    .radio-danger input[type="radio"]:checked + label::after {
        background-color: #d9534f;
    }

    .radio-info input[type="radio"] + label::after {
        background-color: #5bc0de;
    }

    .radio-info input[type="radio"]:checked + label::before {
        border-color: #5bc0de;
    }

    .radio-info input[type="radio"]:checked + label::after {
        background-color: #5bc0de;
    }
</style>

<div class="content-wrapper" style="min-height: 946px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="box box-primary" style="margin-bottom: 0px;">
            <div class="box-header with-border">
                <h4 class="pull-left" style="margin-top: 0px;">
                    Student Attendance Mark
                    <!-- <small><?php echo $this->lang->line( 'by_date1' ); ?></small> -->
                </h4>
                <form id='form1' class="form-inline pull-right" action="<?php echo site_url( 'admin/stuattendence/index' ) ?>" method="post" accept-charset="utf-8">
                    <?php
                    if ( $this->session->flashdata( 'msg' ) ) {
                        echo $this->session->flashdata( 'msg' );
                    }
                    ?>

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
                        <label for="exampleInputEmail1">
                            <?php echo $this->lang->line( 'attendance' ); ?>
                            <?php echo $this->lang->line( 'date' ); ?>
                        </label>
                        <input id="date" name="date" placeholder="" type="text" class="form-control" value="<?php echo set_value( 'date', date( $this->customlib->getSchoolDateFormat() ) ); ?>" readonly/>
                        <span class="text-danger"><?php echo form_error( 'date' ); ?></span>
                    </div>

                    <div class="form-group">
                        <button type="submit" name="search" value="search" class="btn btn-primary btn-sm pull-right">
                            <i class="fa fa-search"></i> <?php echo $this->lang->line( 'search' ); ?></button>
                    </div>
                    <div class="form-group">
                              <a href="<?= site_url( 'admin/stuattendence/holiday' ) ?>" class="btn btn-primary">Mark Holiday</a>
                    </div>
                </form>
                
                
                
            </div>
        </div>
        <div class="clearfix"></div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-5 col-md-5">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            Classes
                        </h3>
                        
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
                                        <th width="12%" class="text-success">
                                            <a href="<?= site_url( 'admin/stuattendence/classattendencereport' ) ?>" class="text-success">
                                                <?= $total_p ?>
                                            </a>
                                        </th>
                                        <th width="12%" class="text-danger">
                                            <a href="<?= site_url( 'student/total_absent_report' ) ?>" class="text-danger">
                                                <?= $total_a ?>
                                            </a>
                                        </th>
                                        <th width="12%" class="text-blue">
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
                                    <?php foreach ( $class_sections as $class_section ): ?>
                                        <tr>
                                            <td>
                                                <a href="<?= site_url( 'admin/stuattendence/index' ) . "?class_id={$class_section['class_id']}&section_id={$class_section['section_id']}&date=" . date( 'm/d/Y', strtotime( $date ) ) ?>"><?= $class_section['class']['class'] ?> / <?= $class_section['section']['section'] ?></a>
                                            </td>
                                            <td class="text-success"><?= $class_section['attendance_cus']['p'] ?></td>
                                            <td class="text-danger"><?= $class_section['attendance_cus']['a'] ?></td>
                                            <td class="text-blue"><?= $class_section['attendance_cus']['l'] ?></td>
                                            <td>
                                                <span style="<?= intval( $class_section['attendance']['total_attendance'] ) > 0 ? "color: green;" : "color: #ccc;" ?>"><i class="fa fa-check"></i></span>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="col-sm-7 col-md-7">

                <?php
                if ( isset( $resultlist ) ) {
                    ?>
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                <?= $class_name ?> ( <?= $section_name ?> ) Attendance Mark
                            </h3>
                            <div class="box-tools pull-right">
                            </div>
                        </div>
                        <div class="box-body">
                            <?php
                            if ( !empty( $resultlist ) ) {
                                $checked = "";
                                if ( !isset( $msg ) ) {
                                    if ( $resultlist[0]['attendence_type_id'] != "" ) {
                                        if ( $resultlist[0]['attendence_type_id'] != 5 ) {
                                            ?>
                                            <div class="alert alert-success"><?php echo $this->lang->line( 'attendance_already_submitted_you_can_edit_record' ); ?></div>
                                            <?php
                                        } else {
                                            $checked = "checked='checked'";
                                            ?>
                                            <div class="alert alert-warning"><?php echo $this->lang->line( 'attendance_already_submitted_as_holiday' ); ?>. <?php echo $this->lang->line( 'you_can_edit_record' ); ?></div>
                                            <?php
                                        }
                                    }
                                } else {
                                    ?>
                                    <div class="alert alert-success"><?php echo $this->lang->line( 'attendance_saved_successfully' ); ?></div>
                                    <?php
                                }
                                ?>
                                <form action="<?php echo site_url( 'admin/stuattendence/index' ) ?>" method="post">
                                    <?php echo $this->customlib->getCSRF(); ?>
                                    <div class="mailbox-controls">
                                        <span class="button-checkbox">
                                            <button type="button" class="btn btn-sm btn-primary" data-color="primary"><?php echo $this->lang->line( 'mark_as_holiday' ); ?></button>
                                            <input type="checkbox" class="hidden" name="holiday" value="checked" <?php echo $checked; ?>/>
                                        </span>
                                        <div class="pull-right">
                                            <button type="submit" name="search" value="saveattendence" class="btn btn-primary btn-sm pull-right checkbox-toggle">
                                                <i class="fa fa-save"></i> <?php echo $this->lang->line( 'save_attendance' ); ?>
                                            </button>
                                        </div>
                                    </div>
                                    <input type="hidden" name="class_id" value="<?php echo $class_id; ?>">
                                    <input type="hidden" name="section_id" value="<?php echo $section_id; ?>">
                                    <input type="hidden" name="date" value="<?php echo $date; ?>">
                                    <table class="table table-hover    ">
                                        <thead>
                                            <tr>
                                                <th>Sr No</th>
                                                <th>Ad No</th>
                                                <th>Roll No</th>
                                                <th><?php echo $this->lang->line( 'name' ); ?></th>
                                                <th class="">Attendance Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $row_count = 1;
                                            foreach ( $resultlist as $key => $value ) {
                                            if($value['struck_off'] == 0){

                                           
                                            ?>
                                                <tr>
                                                    <td>
                                                        <input type="hidden" name="student_session[]" value="<?php echo $value['student_session_id']; ?>">
                                                        <input type="hidden" value="<?php echo $value['attendence_id']; ?>" name="attendendence_id<?php echo $value['student_session_id']; ?>">
                                                        <?php echo $row_count; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $value['admission_no']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $value['roll_no']; ?>
                                                    </td>

                                                    <td>
                                                    <!-- <a href="< ?= site_url( 'admin/stuattendence/attendance_report_student'."?student_id={$value['student_id']}" ) ?>"> -->
                                                    
                                                    <a href="<?php echo base_url(); ?>student/view/<?php echo $value['student_id']; ?>"  >
                                                        <?php echo $value['firstname'] . " " . $value['lastname']; ?>
                                                      </a>
                                                    
                                                    </td>
                                                    <td>
                                                        <?php
                                                        $c = 1;
                                                        $count = 0;
                                                        foreach ( $attendencetypeslist as $key => $type ) {
                                                            if ( $type['key_value'] != "H" ) {
                                                                $att_type = str_replace( " ", "_", strtolower( $type['type'] ) );
                                                                if ( $value['date'] != "xxx" ) {
                                                                    ?>
                                                                    <div class="radio radio-info radio-inline">
                                                                        <input <?php if ( $value['attendence_type_id'] == $type['id'] ) echo "checked"; ?> type="radio" id="attendencetype<?php echo $value['student_session_id'] . "-" . $count; ?>" value="<?php echo $type['id'] ?>" name="attendencetype<?php echo $value['student_session_id']; ?>">
                                                                        <label for="attendencetype<?php echo $value['student_session_id'] . "-" . $count; ?>">
                                                                            <?php echo $this->lang->line( $att_type ); ?>
                                                                        </label>
                                                                    </div>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <div class="radio radio-info radio-inline">
                                                                        <input <?php if ( $c == 1 ) echo "checked"; ?> type="radio" id="attendencetype<?php echo $value['student_session_id'] . "-" . $count; ?>" value="<?php echo $type['id'] ?>" name="attendencetype<?php echo $value['student_session_id']; ?>">
                                                                        <label for="attendencetype<?php echo $value['student_session_id'] . "-" . $count; ?>">
                                                                            <?php echo $this->lang->line( $att_type ); ?>
                                                                        </label>
                                                                    </div>
                                                                    <?php
                                                                }
                                                                $c++;
                                                                $count++;
                                                            }
                                                        }
                                                        ?>

                                                    </td>
                                                </tr>
                                                <?php
                                                $row_count++;
                                                    }  //struckoff
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </form>
                                <?php
                            } else {
                                ?>
                                <div class="alert alert-info">No student admitted in this Class-Section</div>
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
    $( function () {
        $( '.button-checkbox' ).each( function () {
            var $widget = $( this ),
                $button = $widget.find( 'button' ),
                $checkbox = $widget.find( 'input:checkbox' ),
                color = $button.data( 'color' ),
                settings = {
                    on: {
                        icon: 'glyphicon glyphicon-check'
                    },
                    off: {
                        icon: 'glyphicon glyphicon-unchecked'
                    }
                };
            $button.on( 'click', function () {
                $checkbox.prop( 'checked', !$checkbox.is( ':checked' ) );
                $checkbox.triggerHandler( 'change' );
                updateDisplay();
            } );
            $checkbox.on( 'change', function () {
                updateDisplay();
            } );

            function updateDisplay() {
                var isChecked = $checkbox.is( ':checked' );
                $button.data( 'state', (isChecked) ? "on" : "off" );
                $button.find( '.state-icon' )
                    .removeClass()
                    .addClass( 'state-icon ' + settings[$button.data( 'state' )].icon );
                if ( isChecked ) {
                    $button
                        .removeClass( 'btn-success' )
                        .addClass( 'btn-' + color + ' active' );
                } else {
                    $button
                        .removeClass( 'btn-' + color + ' active' )
                        .addClass( 'btn-primary' );
                }
            }

            function init() {
                updateDisplay();
                if ( $button.find( '.state-icon' ).length == 0 ) {
                    $button.prepend( '<i class="state-icon ' + settings[$button.data( 'state' )].icon + '"></i> ' );
                }
            }

            init();
        } );
    } );
</script>