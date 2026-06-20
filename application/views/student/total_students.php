<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>

<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1>
            <i class="fa fa-user-plus"></i> Total Students
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
                    </div>
                    <div class="box-body">
                        <?php if ( $this->session->flashdata( 'msg' ) ) { ?>
                            <div class="alert alert-success">  <?php echo $this->session->flashdata( 'msg' ) ?> </div> <?php } ?>
                        <div class="">
                            <div class="col-md-12">
                                <form role="form" action="<?php echo site_url( 'student/total_students' ) ?>" method="post" class="form-horizontal">
                                    <?php echo $this->customlib->getCSRF(); ?>
                                    <div class="form-group">
                                        <div class="col-sm-2">
                                            <label><?php echo $this->lang->line( 'class' ); ?></label>
                                            <select id="class_id" name="class_id" class="form-control">
                                                <option value=""><?php echo $this->lang->line( 'select' ); ?></option>
                                                <?php
                                                foreach ( $classlist as $class ) {
                                                    ?>
                                                    <option value="<?php echo $class['id'] ?>" <?php if ( set_value( 'class_id' ) == $class['id'] ) echo "selected=selected" ?>><?php echo $class['class'] ?></option>
                                                    <?php
                                                    $count++;
                                                }
                                                ?>
                                            </select>
                                            <span class="text-danger"><?php echo form_error( 'class_id' ); ?></span>
                                        </div>
                                        <div class="col-sm-2">
                                            <label><?php echo $this->lang->line( 'section' ); ?></label>
                                            <select id="section_id" name="section_id" class="form-control">
                                                <option value=""><?php echo $this->lang->line( 'select' ); ?></option>
                                            </select>
                                            <span class="text-danger"><?php echo form_error( 'section_id' ); ?></span>
                                        </div>
                                        <div class="col-sm-2">
                                            <label>Gender</label>
                                            <select name="gender" class="form-control">
                                                <option value="" <?= set_select( 'gender', '', true ) ?>>Both</option>
                                                <option value="male" <?= set_select( 'gender', 'male' ) ?>>Male</option>
                                                <option value="female" <?= set_select( 'gender', 'female' ) ?>>Female</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-3">
                                            <label>Date From</label>
                                            <input type="text" class="form-control date" name="date_from" value="<?= set_value( 'date_from' ) ?>" readonly="readonly">
                                        </div>
                                        <div class="col-sm-3">
                                            <label>Date To</label>
                                            <input type="text" class="form-control date" name="date_to" value="<?= set_value( 'date_to' ) ?>" readonly="readonly">
                                        </div>
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
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">New Students</h3>
                    </div>

                    <div class="box-body no-padding">
                        <?php if ( empty( $students ) ): ?>
                            <p class="bold text-center text-danger">No students found within this range.</p>
                        <?php else: ?>
                            <div class="table-responsive">
                                <table class="table     table-bordered example">
                                    <thead>
                                        <tr>
                                            <th><?= admission_text() ?></th>
                                            <th>Roll No.</th>
                                            <th>Student Name</th>
                                            <th>Father's Name</th>
                                            <th>Class</th>
                                            <th>Date Of Birth</th>
                                            <th>Gender</th>
                                            <th>Mobile No.</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php foreach ( $students as $student ): ?>
                                            <tr>
                                                <td><?= $student['admission_no'] ?></td>
                                                <td><?= $student['roll_no'] ?></td>
                                                <td><?= $student['firstname'] . ' ' . $student['lastname'] ?></td>
                                                <td>
                                                    <a class="table_link" href="<?= site_url( "family/children/{$student['id']}" ) ?>">
                                                        <?= $student['father_name'] ?>
                                                    </a>
                                                </td>
                                                <td><?= "{$student['class']}<small>({$student['section']})</small>" ?></td>
                                                <td><?= date( 'd-M-Y', strtotime( $student['dob'] ) ) ?></td>
                                                <td><?= $student['gender'] ?></td>
                                                <td><?= $student['father_phone'] ?></td>
                                                <td>
                                                    <a href="<?= site_url( "student/pkupdate/{$student['id']}" ) ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="" data-original-title="Update Dues">
                                                        <i class="fa fa-refresh"></i>
                                                    </a>

                                                    <a href="<?= site_url( "student/view/{$student['id']}" ) ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="Show">
                                                        <i class="fa fa-reorder"></i>
                                                    </a>

                                                    <a href="<?= site_url( "student/edit/{$student['id']}" ) ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="" data-original-title="Edit">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>

                                                    <a href="<?= site_url( "fee_management/receive_fee/{$student['id']}" ) ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="" data-original-title="Collect Fee">
                                                        <i class="fa fa-money"></i>
                                                    </a>

                                                    <a href="<?= site_url( "student_assessment/add/{$student['id']}" ) ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="" data-original-title="Student assessment">
                                                        <i class="fa fa-connectdevelop"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
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