<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<div class="content-wrapper" style="min-height: 1126px;">
    <section class="content-header">
        <h1>
          <i class="fa fa-cc-paypal"></i> Payment
        </h1>
    </section>
    <!-- Main content -->
    <section class="invoice">
       
        <div class="row">
            <div class="alert alert-success alert-dismissible">
               
                <h4><i class="icon fa fa-check"></i> Success:</h4>
               Thank you for your payment.
              </div>
            <div class="col-xs-12 table-responsive">             
                <table class="table     table-bordered table-hover example">
                    <thead>
                        <tr>
                           
                            <th><?php echo $this->lang->line('payment_id'); ?> </th>
                            <th><?php echo $this->lang->line('date'); ?> </th>
                            <th><?php echo $this->lang->line('category'); ?></th>
                            <th><?php echo $this->lang->line('type'); ?></th>
                            <th><?php echo $this->lang->line('status'); ?></th>
                            <th><?php echo $this->lang->line('amount'); ?></th>
                            <th><?php echo $this->lang->line('fine'); ?></th>
                            <th><?php echo $this->lang->line('discount'); ?></th>
                            <th><?php echo $this->lang->line('total'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $target_amount = "0";
                        $deposite_amount = "0";
                        $row_count = 1;
                        foreach ($studentfee as $key => $fee) {
                            $target_amount = $target_amount + $fee['amount'];
                            $cls = "";
                            $total_row = "xxx";
                            $payment_status =  "<span class='label label-success'><?php echo $this->lang->line('paid'); ?></span>";
                            if ($fee['date'] == "xxx") {
                                $cls = "text-red";
                                $payment_status = '<span class="label label-danger">Pending</span>';
                            } else {
                                $deposite_amount = $deposite_amount + $fee['amount'];
                                $total_row = number_format(($fee['amount'] + $fee['amount_discount']) - $fee['amount_fine'], 2, '.', '');
                            }
                            ?>
                            <tr>
                                <td><?php echo $fee['student_fee_id']; ?></td>
                                <td><?php echo date('d-m-Y', $this->customlib->dateyyyymmddTodateformat($fee['date'])); ?></td>
                                <td><?php echo $fee['category']; ?></td>
                                <td><?php echo $fee['type']; ?></td>
                                <td><?php echo $payment_status ?></td>
                                <td><?php echo $currency_symbol.$fee['amount']; ?></td>
                                <td><?php echo $currency_symbol.$fee['amount_fine']; ?></td>
                                <td><?php echo $currency_symbol.$fee['amount_discount']; ?></td>
                                <td><?php echo $currency_symbol.$total_row; ?></td>
                            </tr>
                            <?php
                            $row_count++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>         
        </div>      
    </section>    
    <div class="clearfix"></div>
</div>