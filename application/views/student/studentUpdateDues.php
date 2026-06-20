<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <i class="fa fa-user-plus"></i> <?php echo $this->lang->line( 'student_information' ); ?>
            <small><?php echo $this->lang->line( 'student1' ); ?></small>
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"> <?php echo $this->lang->line( 'edit' ); ?><?php echo $this->lang->line( 'student' ); ?></h3>
                        <div class="pull-right box-tools">
                        </div>
                    </div>
                    <form action="<?php echo site_url( "student/pkupdate/" . $student['id'] ) ?>" id="employeeform" name="employeeform" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                        <div class="box-body">
                            <?php if ( $this->session->flashdata( 'msg' ) ) { ?>
                                <?php echo $this->session->flashdata( 'msg' ) ?>
                            <?php } ?>
                            <?php echo $this->customlib->getCSRF(); ?>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="fee_dues">Fee Dues</label>
                                        <input id="fee_dues" name="fee_dues" placeholder="Fee Dues" type="text" class="form-control" value="<?php echo set_value( 'fee_dues', $student['fee_arrears'] ); ?>">
                                    </div>
                                </div>

                            </div>
                            <div class="box-footer">
                                <button type="button" class="btn btn-default"><?php echo $this->lang->line( 'cancel' ); ?></button>
                                <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line( 'save' ); ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>
</section>
</div>

<script type="text/javascript">
    jQuery( function ( $ ) {
        $( '#father_cnic' ).change( function () {

            var t = this,
                father_cnic = $( this ).val().trim(),
                site_url = "<?= site_url() ?>ajax/student/father_information/",
                dom_father_name = $( '#father_name' ),
                dom_father_phone = $( '#father_phone' ),
                dom_father_occupation = $( '#father_occupation' );

            // if valid cnic
            if ( father_cnic.length != 13 ) {
                alert( "Please provide correct CNIC number or student's father, without dashed, having 13 digits." );
            } else {
                $( t ).val( "Loading..." );
                dom_father_name.val( "Loading..." );
                dom_father_phone.val( "Loading..." );
                dom_father_occupation.val( "Loading..." );

                $.get( site_url + father_cnic, function ( data ) {
                    if ( data.error === false ) {
                        var father_details = data.data;

                        dom_father_name.val( father_details.father_name );
                        dom_father_phone.val( father_details.father_phone );
                        dom_father_occupation.val( father_details.father_occupation );
                    } else {
                        dom_father_name.val( "" );
                        dom_father_phone.val( "" );
                        dom_father_occupation.val( "" );
                    }

                    $( t ).val( father_cnic );
                } );
            }
        } );
    } );
</script>

<script type="text/javascript">
    $( document ).ready( function () {
        var section_id_post = '<?php echo $student['section_id']; ?>';
        var class_id_post = '<?php echo $student['class_id']; ?>';
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
        //var date_format = '<?php echo $result = strtr( $this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',] ) ?>';
        var date_format = 'dd-mm-yyyy';
        $( '#dob,#admission_date' ).datepicker( {
            format: date_format,
            autoclose: true
        } );
    } );

    function auto_fill_guardian_address() {
        if ( $( "#autofill_current_address" ).is( ':checked' ) ) {
            $( '#current_address' ).val( $( '#guardian_address' ).val() );
        }
    }

    function auto_fill_address() {
        if ( $( "#autofill_address" ).is( ':checked' ) ) {
            $( '#permanent_address' ).val( $( '#current_address' ).val() );
        }
    }

    $( 'input:radio[name="guardian_is"]' ).change(
        function () {
            if ( $( this ).is( ':checked' ) ) {
                var value = $( this ).val();
                if ( value == "father" ) {
                    $( '#guardian_name' ).val( $( '#father_name' ).val() );
                    $( '#guardian_phone' ).val( $( '#father_phone' ).val() );
                    $( '#guardian_occupation' ).val( $( '#father_occupation' ).val() );
                    $( '#guardian_relation' ).val( "Father" )
                } else if ( value == "mother" ) {
                    $( '#guardian_name' ).val( $( '#mother_name' ).val() );
                    $( '#guardian_phone' ).val( $( '#mother_phone' ).val() );
                    $( '#guardian_occupation' ).val( $( '#mother_occupation' ).val() );
                    $( '#guardian_relation' ).val( "Mother" )
                } else {
                    $( '#guardian_name' ).val( "" );
                    $( '#guardian_phone' ).val( "" );
                    $( '#guardian_occupation' ).val( "" );
                    $( '#guardian_relation' ).val( "" )
                }
            }
        } );

</script>

<script type="text/javascript">
    jQuery( function ( $ ) {
        $( '.fill_guardian' ).on( 'click change keyup focusin focusout', function ( e ) {
            var guardian_is = $( "input[type='radio'][name='guardian_is']:checked" ).val(),
                target = $( this ).data( 'target' );

            if ( typeof guardian_is != 'undefined' && guardian_is == 'father' ) {
                if ( typeof target !== 'undefined' ) {
                    var current_field_value = $( this ).val();
                    $( target ).val( current_field_value );

                    $( "#guardian_relation" ).val( guardian_is );
                }
            }
        } );

        // adding class fee to the class fee input
        var add_class_fee = function () {
            var class_id = $( "#class_id" ).val(),
                discount = $( "#discount" ).val(),
                path = "<?= site_url( 'api/ClassApi/class_details' ) ?>";

            discount = (typeof discount === 'undefined' || $.trim( discount ) == '' ? 0 : discount);

            if ( typeof class_id !== 'undefined' ) {
                var url = path + '/' + class_id,
                    fee = 0;

                $.get( url, [], function ( data ) {
                    fee = parseInt( data.fee );

                    $( "input[name='class_student_fee']" ).val( fee - parseInt( discount ) );
                }, 'json' );
            }
        };

        add_class_fee();
        $( "#class_id, #discount" ).on( 'change', function () {
            add_class_fee();
        } );
    } );
</script>