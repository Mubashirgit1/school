<?php $currency_symbol = $this->customlib->getSchoolCurrencyFormat(); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <?php $this->load->view('layout/academics_link');
    $admind = $this->session->userdata( 'admin' ); 
    $this->load->helper('menu_helper');
    $permission = admin_permission($admind['id']);?>
    
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-4">
                <!-- Horizontal Form -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php //echo $title;   ?><?php echo $this->lang->line( 'add_class' ); ?></h3>
                    </div><!-- /.box-header -->
                    <form id="form1" action="<?php echo base_url() ?>classes" method="post" accept-charset="utf-8">
                        <div class="box-body">
                            <?php if ( $this->session->flashdata( 'msg' ) ) { ?>
                                <?php echo $this->session->flashdata( 'msg' ) ?>
                            <?php } ?>
                            <?php
                            if ( isset( $error_message ) ) {
                                echo "<div class='alert alert-danger'>" . $error_message . "</div>";
                            }
                            ?>
                            <?php echo $this->customlib->getCSRF(); ?>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line( 'class' ); ?></label>
                                <input id="class" name="class" placeholder="" type="text" class="form-control" value="<?php echo set_value( 'class' ); ?>"/>
                                <span class="text-danger"><?php echo form_error( 'class' ); ?></span>
                            </div>

                            <div class="form-group">
                                <label>Fee</label>
                                <input type="number" class="form-control" name="fee" value="<?= set_value( 'fee', 0 ) ?>" required>
                                <span class="text-danger"><?php echo form_error( 'fee' ); ?></span>
                            </div>
                            <?php if( $admission_key ==1 ){?>
                                        
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Class Group</label>
                                                <select id="class_group" name="class_group" class="form-control" required>
                                                    <option value=""><?php echo $this->lang->line( 'select' ); ?></option>
                                                    <?php
                                                    foreach ( $classgrouplist as $class ) {
                                                        ?>
                                                        <option value="<?php echo $class['id'] ?>"<?php if ( set_value( 'class_id' ) == $class['id'] ) echo "selected=selected" ?> ><?php echo $class['name'] ?></option>
                                                        <?php
                                                    } ?>
                                                </select>
                                        </div>
                                        <?php } ?>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line( 'sections' ); ?></label>

                                <?php
                                foreach ( $vehiclelist as $vehicle ) {
                                    ?>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="sections[]" value="<?php echo $vehicle['id'] ?>" <?php echo set_checkbox( 'sections[]', $vehicle['id'] ); ?> ><?php echo $vehicle['section'] ?>
                                        </label>
                                    </div>
                                    <?php
                                }
                                ?>

                                <span class="text-danger"><?php echo form_error( 'sections[]' ); ?></span>
                            </div>

                        </div><!-- /.box-body -->

                        <div class="box-footer">
                        <?php if($permission->class_u == 1){ ?>
                            <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line( 'save' ); ?></button>
                        <?php } ?>
                        </div>
                    </form>
                </div>

            </div><!--/.col (right) -->
            <!-- left column -->
            <div class="col-md-8">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"><?php echo $this->lang->line( 'class_list' ); ?></h3>
                        <div class="box-tools pull-right">
                        </div><!-- /.box-tools -->
                    </div><!-- /.box-header -->
                    <br>
                    <div class="box-body">
                        <div class="table-responsive mailbox-messages">
                            <table class="table     table-bordered table-hover example">
                                <thead>
                                    <tr>
                                    <th>SR No</th>
                                        <th><?php echo $this->lang->line( 'class' ); ?></th>

                                        <th><?php echo $this->lang->line( 'sections' ); ?></th>
                                        <th>Order</th>
                                        <?php if( $admission_key ==1 ){?>
                                        <th>Class Group</th>
                                        <?Php } ?>
                                        

                                        <th>Fee</th>

                                        <th class="text-right"><?php echo $this->lang->line( 'action' ); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ( $vehroutelist as $key => $vehroute ) {
                                        ?>
                                        <tr>
                                            <td class="mailbox-name">
                                            <form action="<?php echo base_url('classes/set_serial') ?>" method="post" ></form>
                                             <?= $key+1 ?>
                                            </td>
                                            <td class="mailbox-name">
                                                <?php echo $vehroute->class; ?>
                                            </td>
                                            <td>
                                                <?php
                                                $vehicles = $vehroute->vehicles;
                                                if ( !empty( $vehicles ) ) {

                                                    foreach ( $vehicles as $key => $value ) {

                                                        echo "<div>" . $value->section . "</div>";
                                                    }
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                $vehicles = $vehroute->vehicles;
                                                if ( !empty( $vehicles ) ) {
                                                    foreach ( $vehicles as $key => $value ) {
                                                        
                                                    ?>

                                                        <input type="number"  name="order" data-class="<?php echo $value->class_section_id; ?>" class="form-control order" value="<?php echo $value->order_by; ?>" ><br>
                                                        
                                                <?php
                                                      }
                                                         }  ?>
                                            </td>
                                            <?php if( $admission_key ==1 ){
                                                $group = '';
                                                if($vehroute->class_group != 0){
                                                    $group =  $this->class_group_model->get( $vehroute->class_group);
                                                }
                                                
                                                ?>
                                            
                                                <td><?= $group['name'] ?></td>
                                            <?Php } ?>
                                        
                                            <td><?= $vehroute->fee ?></td>

                                            <td class="mailbox-date pull-right">
                                            <?php if($permission->class_u == 1){ ?>
                                                <a href="<?php echo base_url(); ?>classes/edit/<?php echo $vehroute->id; ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="<?php echo $this->lang->line( 'edit' ); ?>">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                            <?php }?>
                                            <!--<a href="<?php echo base_url(); ?>classes/delete/<?php echo $vehroute->id; ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="<?php echo $this->lang->line( 'delete' ); ?>" onclick="return confirm('Are you sure you want to delete this item?');">
                                                <i class="fa fa-remove"></i>
                                            </a>-->
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>

                                </tbody>
                            </table><!-- /.table -->


                        </div><!-- /.mail-box-messages -->
                    </div><!-- /.box-body -->
                </div>
            </div><!--/.col (left) -->
            <!-- right column -->

        </div>
        <div class="row">
            <!-- left column -->

            <!-- right column -->
            <div class="col-md-12">

            </div><!--/.col (right) -->
        </div>   <!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->


<script>

    $( document ).on( 'change', '.order', function ( e ) {
    var value  =  $(this).val();
    var class_section = $(this).data('class');
    $.ajax( {
            type: "get",
            url: '<?php echo site_url( "classes/updateOrder" ) ?>',
            dataType: 'JSON',
            data: {
              class_section:class_section,
              order:value,
            },
            success: function ( data ) {
            if(data == true ){
                sweetAlert({
                    title: "Alert",
                    text : "class order Update",
                    type: 'success',
                    timer: 2000,
                });
            }else{
                sweetAlert({
                    title: "Alert",
                    text : "class order already exist",
                    type: 'error',
                    timer: 2000,
                });
            }
              
            }
        });
    });
    



</script>

