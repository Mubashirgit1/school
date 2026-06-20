<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
     
   
        <h1 align="center">
             Edit Staff Payment </h1>
    
    </section>
<?php


?>


    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-4 col-sm-offset-4">
                <!-- Horizontal Form -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        
                    </div><!-- /.box-header -->
                    <!-- form start -->

                    <form action="<?php echo site_url("admin/staff/salary_payment_update?staff_id=".$salary_payments['staff_id']) ?>"  id="employeeform" name="employeeform" method="post" accept-charset="utf-8">
                        <div class="box-body">

                            <?php if ($this->session->flashdata('msg')) { ?>
                                <?php echo $this->session->flashdata('msg') ?>
                            <?php } ?>
                            <?php
                            if (isset($error_message)) {
                                echo "<div class='alert alert-danger'>" . $error_message . "</div>";
                            }
                            ?>   
                                    <?php echo $this->customlib->getCSRF(); ?>
                                    
                                <div class="form-group">
                         
                         <label><?php echo "ID = ".$salary_payments['id']; ?></label>
                         
                         </div>     
                            <?php 
        $admind = $this->session->userdata( 'admin' );	?>    
             
                    <input type="hidden" name="admin" value="<?= $admind['username'] ?>">                                
                         <div class="form-group">
                 <input id="id" name="staff_id" placeholder="" type="hidden" class="form-control"  value="<?php echo set_value('id', $salary_payments['id']); ?>" />
                         
                         
                                <label for="exampleInputEmail1">Staff Name</label>
                 <input id="name" name="name" disabled placeholder="" type="text" class="form-control"  value="<?php echo set_value('name', $salary_payments['name']); ?>" />
                                <span class="text-danger"><?php echo form_error('name'); ?></span>
                            </div>
                       
                      
                            <div class="form-group">
                                <label for="exampleInputEmail1">Payments</label>
 <input id="name" name="payments" placeholder="" type="text" class="form-control"  value="<?php echo set_value('payment', $salary_payments['staff_salary_payment_paid_salary']); ?>" />
                                <span class="text-danger"><?php echo form_error('name'); ?></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1"><?php echo $this->lang->line('date'); ?></label>
                                <input id="date" name="joining_date" placeholder="" type="text" class="form-control"  value="<?php echo set_value('date', date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($salary_payments['payment_date']))); ?>" readonly />
                                <span class="text-danger"><?php echo form_error('date'); ?></span>
                            </div>
                            
                            
                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line('save'); ?></button>
                        </div>
                    </form>
                </div>

            </div><!--/.col (right) -->
            <!-- left column -->
          
              
        <div class="row">
            <div class="col-md-12">
            </div><!--/.col (right) -->
        </div>   <!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->

<script type="text/javascript">
    $(document).ready(function () {
        var date_format = '<?php echo $result = strtr($this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',]) ?>';
        $('#date').datepicker({
            //  format: "dd-mm-yyyy",
            format: date_format,
            autoclose: true
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('.detail_popover').popover({
            placement: 'right',
            trigger: 'hover',
            container: 'body',
            html: true,
            content: function () {
                return $(this).closest('td').find('.fee_detail_popover').html();
            }
        });

    });
</script>