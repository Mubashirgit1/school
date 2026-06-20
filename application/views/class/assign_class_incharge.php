
<style>

.select2-container{
    width:450px !important;
}
</style>

<div class="content-wrapper" style="min-height: 946px;">
    <?php
        $this->load->view('layout/academics_link');
        $admind = $this->session->userdata( 'admin' ); 
        $this->load->helper('menu_helper');
        $permission = admin_permission($admind['id']);?>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-4">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <i class="fa fa-search"></i> Select Class Incharge</h3>
                    </div>
                    <div class="box-body">

                        <?php $this->general_library->err_msg() ?>

                        <form role="form" action="<?php echo site_url( 'classes/assign_class_incharge_process' ) ?>" method="post">
                            <?php echo $this->customlib->getCSRF(); ?>
                            <div class="form-group">

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

                            <div class="form-group">
                                <label><?php echo $this->lang->line( 'section' ); ?></label>
                                <select id="section_id" name="section_id" class="form-control">
                                    <option value=""><?php echo $this->lang->line( 'select' ); ?></option>
                                </select>
                                <span class="text-danger"><?php echo form_error( 'section_id' ); ?></span>
                            </div>

                            <div class="form-group">
                                <label>Teacher</label>
                                <select id="teacher_id" name="teacher_id" class="form-control">
                                    <option value="">Select</option>
                                    <?php
                                    foreach($teachers as $teacher):
                                        ?>
                                        <option value="<?= $teacher['id'] ?>"><?= $teacher['name'] ?></option>
                                        <?php
                                    endforeach;
                                    ?>
                                </select>
                                <span class="text-danger"><?php echo form_error( 'section_id' ); ?></span>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-12">
                                    <?php if($permission->assign_class_incharge_u == 1){ ?>
                                        <button type="submit" class="btn btn-primary btn-sm checkbox-toggle pull-right">Assign/Update Teacher</button>
                                    <?php } ?>
                                    
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            <div class="col-sm-8">

                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Class Incharge Teachers</h3>
                    </div>

                    <div class="box-body">
                        <?php
                        if ( $class_section_incharge === false ):
                            echo '<h3>No Class, Section and incharge teacher found!</h3>';
                        else:
                            ?>
                            <table class="table     table-bordered table-hover example xyz">
                                <thead>
                                    <tr>
                                        <th>Class</th>
                                        <th>Section</th>
                                        <th>Class Incharge</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    foreach ( $class_section_incharge as $value ):
                                        ?>
                                        <tr>
                                            <td><?= $value['class'] ?></td>
                                            <td><?= $value['section'] ?></td>
                                            <td>
                                                <?php
                                                if ( empty( $value['class_incharge_teacher_id'] ) ):
                                                    echo "N/A";
                                                else:

                                                    if ( empty( $value['teacher'] ) ):
                                                        echo "Teacher's details missing.";
                                                    else:
                                                        echo $value['teacher']['name'];
                                                    endif;

                                                endif;
                                                ?>
                                            </td>
                                        </tr>
                                        <?php
                                    endforeach;
                                    ?>
                                </tbody>
                            </table>
                            <?php
                        endif;
                        ?>
                    </div>
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
    } );
</script>