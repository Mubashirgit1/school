<div class="content-wrapper">
    <section class="content-header">
        <h1>Family Details</h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Family Children</h3>
                    </div>

                    <div class="box-body">

                        <?php if ( $children === false ): ?>
                            <h3 class="text-center text-danger">No Records Found!</h3>
                        <?php else: ?>
                            <table class="table     table-bordered example">
                                <thead>
                                    <tr> 
                                        <th>S.No</th>
                                        <th>Ad Date</th>
                                        <th>Ad. No</th>
                                        <th>Class(Section)</th>
                                        <th>Roll No.</th>
                                        <th>Student Name</th>
                                        <th>Father Name</th>
                                        <th>Gender</th>
                                        <th>Father's Mobile</th>
                                        <th>Class Fee</th>
                                        <th>Discount</th>
                                        <th>Fee</th>
                                        <th>Due Fee</th>
                                        <th>Arrears</th>
                                        <th>Fine</th>
                                        <th>Advance</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $class_discount    = 0;
                                    $fee_arrears_month = 0;
                                    $fee_advance_month = 0;
                                    $discount_fee      = 0;
                                    $current_fee       = 0;
                                    $total_due_fee     = 0;
                                    $total_fine        = 0;
                                    foreach ( $children as $key => $child ): 
                                        $fee_arrears        = 0;
                                        $due_fee            = 0; 
                                        $late_payment_fee   = 0;
                                        
                                        // calculate total students discount
                                        $class_discount += intval( $child['discount']);
                                        $discount_fee = $child['class_fee'] - $child['discount'];
                                        
                                        if ($child['fee_arrears'] > 0) {

                                            // calculate current student arrears
                                            $fee_arrears = $child['fee_arrears'] - $discount_fee - $child['late_payment_fee'];
                                            
                                            // calculate current student fine
                                            $late_payment_fee = $child['late_payment_fee'];

                                            $current_fee = $child['fee_arrears'] - $late_payment_fee;
                                            if ($current_fee > $discount_fee) {
                                                $due_fee     = $discount_fee; 
                                            }else{
                                                $due_fee     = $current_fee; 
                                            }
                                            if($fee_arrears < 0){
                                                $fee_arrears = 0;
                                            }
                                        }
                                        if ($child['fee_arrears'] < 0) {
                                            $fee_advance_month += abs($child['fee_arrears']);
                                        }

                                        // calculate total month fine
                                        $total_fine         += $late_payment_fee;
                                        // calculate total month arrears
                                        $fee_arrears_month  += $fee_arrears;
                                        // calculate current student fine
                                        $total_due_fee      += $due_fee;
                                    ?>
                                        <tr>
                                            <td><?= $key+1 ?></td>
                                            <td><?php echo date('d-m-Y', strtotime($child['created_at'])); ?></td>
                                            <td><?= $child['admission_no'] ?></td>
                                               <td><?= $child['class_name']."(".$child['section_name'].")" ?></td>
                                            <td><?= $child['roll_no'] ?></td>
                                         
                                            <td>
                                                <a href="<?= site_url("student/view/{$child['id']}") ?>" >
                                                    <?= $child['firstname'] . ' ' . $child['lastname'] ?></td>
                                                </a>
                                            <td><?= $child['father_name'] ?></td>
                                            <td><?= $child['gender'] ?></td>
                                            <td><?= $child['father_phone'] ?></td>
                                            <td><?= $child['class_fee'] ?></td>
                                            <td><?= $child['discount'] ?></td>
                                            <td><?= $discount_fee ?></td>
                                            <td><?= $due_fee ?></td>
                                            <td><?= $fee_arrears ?></td>
                                            <td><?= $late_payment_fee ?></td>

                                            <td><?= intval( $child['fee_arrears'] ) < 0 ? number_format( abs( $child['fee_arrears'] ), 0, '', ',' ) : 0 ?></td>
                                            <td class="pull-right">
                                                <a href='<?= site_url("fee_management/receive_fee/{$child['id']}") ?>' class="btn btn-default btn-xs" data-toggle="tooltip" title="" data-original-title="Add Fees">
                                                    <i class="fa fa-money"></i>
                                                </a>

                                                <a href='<?= site_url("student_assessment/add/{$child['id']}") ?>' class="btn btn-default btn-xs" data-toggle="tooltip" title="" data-original-title="Student assessment">
                                                    <i class="fab fa-connectdevelop"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>