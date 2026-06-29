<style>

.select2-container{
    width:700px !important;
}
</style>

<div class="content-wrapper" style="min-height: 946px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fa fa-user-plus"></i> <?php echo $this->lang->line( 'student_information' ); ?>
            <small><?php echo $this->lang->line( 'student_fees1' ); ?></small>
        </h1>

    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <i class="fa fa-search"></i> <?php echo $this->lang->line( 'select_criteria' ); ?></h3>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <form id='form1' action="<?php echo site_url( 'admin/stdtransfer/index' ) ?>" method="post" accept-charset="utf-8">
                        <div class="box-body">
                            <?php echo $this->customlib->getCSRF(); ?>
                            <div class="row">
                                <div class="col-md-6">
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
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line( 'section' ); ?></label>
                                        <select id="section_id" name="section_id" class="form-control">
                                            <option value=""><?php echo $this->lang->line( 'select' ); ?></option>
                                        </select>
                                        <span class="text-danger"><?php echo form_error( 'section_id' ); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary pull-right"><?php echo $this->lang->line( 'array_search(needle, haystack)' ); ?><?php echo $this->lang->line( 'search' ); ?></
                        </div>
                    </form>
                </div>
            </div>
            <?php
            if ( isset( $resultlist ) ) {
                ?>
                <input type="hidden" class="class_post" value="<?php echo $class_post; ?>">
                <input type="hidden" class="section_post" value="<?php echo $section_post; ?>">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <i class="fa fa-list"></i> <?php echo $this->lang->line( 'promote_students_in_next_session' ); ?>
                        </h3>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <div class="box-body table-responsive">
                        <form action="#" method="post" accept-charset="utf-8" class="promote_form">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line( 'promote_in_session' ); ?> </label>
                                        <select id="session_id" name="session_id" class="form-control">
                                            <option value=""><?php echo $this->lang->line( 'select' ); ?></option>
                                            <?php
                                            foreach ( $sessionlist as $session ) {
                                                ?>
                                                <option value="<?php echo $session['id'] ?>"><?php echo $session['session'] ?></option>
                                                <?php
                                                $count++;
                                            }
                                            ?>
                                        </select>
                                        <span class="text-danger" id="session_id_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line( 'class' ); ?></label>
                                        <select id="class_promote_id" name="class_promote_id" class="form-control">
                                            <option value=""><?php echo $this->lang->line( 'select' ); ?></option>
                                            <?php
                                            foreach ( $classlist as $class ) {
                                                ?>
                                                <option value="<?php echo $class['id'] ?>"><?php echo $class['class'] ?></option>
                                                <?php
                                                $count++;
                                            }
                                            ?>
                                        </select>
                                        <span class="text-danger" id="class_promote_id_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"><?php echo $this->lang->line( 'section' ); ?></label>
                                        <select id="section_promote_id" name="section_promote_id" class="form-control">
                                            <option value=""><?php echo $this->lang->line( 'select' ); ?></option>
                                        </select>
                                        <span class="text-danger" id="section_promote_id_error"></span>
                                    </div>
                                </div>
                            </div>
                            <table class="table    ">
                                <tbody>
                                    <tr>
                                        <th><?php echo $this->lang->line( 'admission_no' ); ?></th>
                                        <th><?php echo $this->lang->line( 'student' ); ?><?php echo $this->lang->line( 'name' ); ?></th>
                                        <th><?php echo $this->lang->line( 'father_name' ); ?></th>
                                        <th><?php echo $this->lang->line( 'date_of_birth' ); ?></th>
                                        <th class=""><?php echo $this->lang->line( 'current' ); ?><?php echo $this->lang->line( 'result' ); ?></th>
                                        <th class=""><?php echo $this->lang->line( 'next_session_status' ); ?></th>
                                    <th>    <input type="checkbox" class="class_section_checkbox select_checkbox" data-target=".student_checkbox_<?= ( $class_post ?? '' ) . '_' . ( $section_post ?? '' ) ?>"></th>
                                    </tr>
                                    <?php if ( empty( $resultlist ) ) {
                                        ?>
                                        <tr>
                                            <td colspan="12" class="text-danger text-center"><?php echo $this->lang->line( 'no_record_found' ); ?></td>
                                        </tr>
                                        <?php
                                    } else {
                                        $count = 1;
                                        foreach ( $resultlist as $student ) {
                                            ?>
                                            <input type="hidden" value="<?php echo $student['id']; ?>">
                                     
                                            <tr>
                                                <td><?php echo $student['admission_no']; ?></td>
                                                <td><?php echo $student['firstname'] . " " . $student['lastname']; ?></td>
                                                <td><?php echo $student['father_name']; ?></td>
                                                <td><?php echo date( $this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat( $student['dob'] ) ); ?></td>
                                                <td>
                                                    <div class="radio-inline">
                                                        <label>
                                                            <input type="radio" name="result_<?php echo $student['id']; ?>" checked="checked" value="pass">
                                                            <?php echo $this->lang->line( 'pass' ); ?>
                                                        </label>
                                                    </div>
                                                    <div class="radio-inline">
                                                        <label>
                                                            <input type="radio" name="result_<?php echo $student['id']; ?>" value="fail">
                                                            <?php echo $this->lang->line( 'fail' ); ?>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="radio-inline">
                                                        <label>
                                                            <input type="radio" name="next_working_<?php echo $student['id']; ?>" checked="checked" value="countinue">
                                                            <?php echo $this->lang->line( 'continue' ); ?>
                                                        </label>
                                                    </div>
                                                    <div class="radio-inline">
                                                        <label>
                                                            <input type="radio" name="next_working_<?php echo $student['id']; ?>" value="leave">
                                                            <?php echo $this->lang->line( 'leave' ); ?>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td>
                                                
                                               
                                                <input type="checkbox" class="student_checkbox_<?= $class_post. '_'  .$section_post; ?> select_checkbox" name="student_list[]" value="<?php echo $student['id']; ?>">
                                                
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        $count++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                    </div>
                    </form>
                    <div class="box-footer clearfix">
                        <?php
                        if ( !empty( $resultlist ) ) {
                            ?>
                            <a class="btn btn-sm btn-primary pull-right promote_save"><?php echo $this->lang->line( 'promote' ); ?></a>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <?php
            } else {
            }
            ?>
    </section>
</div>
<script type="text/javascript">

 
$(document).on('change', '.select_checkbox', function (e) {
        
	var target = $( this ).data( 'target' ),
                current_checked = $( this ).prop( 'checked' );

            if ( current_checked === true ) {
                $( target ).prop( 'checked', true ).change();
            } else {
                $( target ).prop( 'checked', false ).change();
            }
    });

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

    $( document ).on( 'change', '#class_promote_id', function ( e ) {
        $( '#section_promote_id' ).html( "" );
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
                $( '#section_promote_id' ).append( div_data );
            }
        } );
    } );
</script>

<script type="text/javascript">
    $( document ).ready( function () {
        $( document ).on( 'click', '.promote_save', function ( e ) {
            var datastring = $( ".promote_form" ).serialize();
            var class_promote = $( ".class_promote_id" ).val();
            var section_promote = $( ".section_promote_id" ).val();
            var class_post = $( ".class_post" ).val();
            var section_post = $( ".section_post" ).val();
            swal( {
                    title: "Message",
                    text: "Are you sure want to promote students?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#DD6B55',
                    confirmButtonText: 'Yes, I am sure!',
                    cancelButtonText: "No, cancel it!",
                    closeOnConfirm: true,
                    closeOnCancel: false
                },
                function ( isConfirm ) {
                    if ( isConfirm ) {
                        $.ajax(
                            {
                                type: "post",

                                url: '<?php echo site_url( "admin/stdtransfer/promote" ) ?>',
                                data: datastring + '&class_post=' + class_post + '&section_post=' + section_post,
                                success: function ( data ) {
                                }
                            }
                        )
                            .done( function ( data ) {
                                var data = (JSON.parse( data ));
                                if ( data.status == "fail" ) {
                                    $.each( data.msg, function ( index, value ) {
                                        var errorDiv = '#' + index + '_error';
                                        console.log( errorDiv );
                                        $( errorDiv ).addClass( 'required' );
                                        $( errorDiv ).empty().append( value );
                                    } );
                                    $( '#successMessage' ).empty();
                                } else {

                                    swal( {
                                        title: 'Success!',
                                        text: 'Students are successfully promoted!',
                                        type: 'success',

                                    }, function () {
                                        location.reload( true );
                                    } );
                                }
                            } )
                            .error( function ( data ) {
                                swal( "Oops", "We couldn't connect to the server!", "error" );
                            } );

                    } else {
                        swal( "Cancelled", "Student promotion cancelled", "error" );
                    }
                } );
        } );
        $( "#btnreset" ).click( function () {
            $( "#form1" )[0].reset();
        } );
    } );
</script>