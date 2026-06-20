<div class="content-wrapper">
    <section class="content-header">
        <h1>Student Assessment</h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-4">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Weekly Student Assessment</h3>
                    </div>

                    <div class="box-body">

                        <?php $this->general_library->err_msg(); ?>

                        <?php
                        if($assessment_details !== false):
                            echo '<div class="alert alert-success">Assessment of this student is already saved for current week!<br>You can update the entries.</div>';
                        endif;
                        ?>

                        <form action="<?= site_url( 'student_assessment/add_process/' . $student_id ) ?>" method="post">

                            <div class="form-group">
                                <label for="assessment_for">Assessment for</label>
                                <div class="help-block">Week will be calculated automatically</div>
                                <input type="text" id="assessment_for" class="form-control date" name="assessment_date" value="<?= set_value( 'assessment_date', date( 'm/d/Y', now() ) ) ?>" readonly>
                            </div>

                            <div class="help-block">Following fields can have 1 as minimum and 5 as maximum value.</div>

                            <div class="form-group">
                                <label>General Cleanliness</label>
                                <input type="number" class="form-control" name="cleanliness" value="<?= set_value( 'cleanliness' ) ?>" placeholder="General cleanliness" min="1" max="5">
                            </div>

                            <div class="form-group">
                                <label>Classroom Behaviour</label>
                                <input type="number" class="form-control" name="classroom_behaviour" value="<?= set_value( 'classroom_behaviour' ) ?>" placeholder="Classroom Behaviour" min="1" max="5">
                            </div>

                            <div class="form-group">
                                <label>Homework</label>
                                <input type="number" class="form-control" name="homework" value="<?= set_value( 'homework' ) ?>" placeholder="Homework" min="1" max="5">
                            </div>

                            <div class="form-group">
                                <label>Urdu Reading</label>
                                <input type="number" class="form-control" name="urdu_reading" value="<?= set_value( 'urdu_reading' ) ?>" placeholder="Urdu Reading" min="1" max="5">
                            </div>

                            <div class="form-group">
                                <label>English Reading</label>
                                <input type="number" class="form-control" name="english_reading" value="<?= set_value( 'english_reading' ) ?>" placeholder="English Reading" min="1" max="5">
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary pull-right">Save</button>
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
        $( '#assessment_for' ).datepicker( {
            format: 'mm/dd/yyyy',
            autoclose: true
        } );
    } );
</script>