<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
        <h1 class="pull-left">
            Staff Account
        </h1>

        <div class="pull-right">
            <a href="<?= site_url( 'admin/staff/salary_report' ) ?>" class="btn btn-primary btn-sm">
                <i class="fa fa-chevron-left"></i> Back To Staff Accounts
            </a>
        </div>

        <div class="clearfix"></div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="col-sm-4">
                    <div class="box box-primary" id="tachelist">
                        <div class="box-header ptbnull">
                            <h3 class="box-title titlefix">Staff List</h3>
                        </div>
                        <div class="box-body">
                            <div class="mailbox-controls">
                            </div>
                            <div class="table-responsive mailbox-messages">
                                <?php
                                if ( $staff_list === false ) {
                                    echo "<h4 class='text-center text-danger' style='padding-top: 15px;'>No staff member found!</h4>";
                                } else {
                                    ?>
                                    <table class="table     table-bordered table-hover example">
                                        <thead>
                                        <tr>
                                            <th>S.ID</th>
                                            <th>Name</th>

                                            <th class="text-right no-print"><?php echo $this->lang->line( 'action' ); ?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php

                                        foreach ( $staff_list as $staff_list_item ) {
                                            ?>
                                            <tr>
                                                <td class="mailbox-name"> <?php echo $staff_list_item['id'] ?></td>
                                                <td class="mailbox-name"> <?php echo $staff_list_item['name'] ?></td>

                                                <td class="mailbox-date pull-right no-print">
                                                    <a href="<?= site_url( "admin/staff/salary_payment/{$staff_list_item['id']}" )  ?>" class="btn btn-default btn-xs" ><i class="fa fa-money"></i></a>
                                                    <a href="<?= site_url( 'admin/staff' ) . "?staff_id={$staff_list_item['id']}" ?>" class="btn btn-default btn-xs" data-toggle="tooptip" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                    </a>
                                                    <!--<a href="<?php echo base_url(); ?>admin/staff/delete/<?php echo $staff_list_item['id'] ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="<?php echo $this->lang->line( 'delete' ); ?>" onclick="return confirm('Are you sure you want to delete this item?')" ;>
                                                        <i class="fa fa-remove"></i>
                                                    </a>-->
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                    <?php  } ?>
                                </div>
                            </div>
                        <div class="">
                            <div class="mailbox-controls">
                            </div>
                        </div>
                    </div>
                    <div class="box box-primary" id="tachelist">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix">Active Teacher List </h3>
                        <div class="pull-right" style="margin-top:10px;" >
                     <a class="btn btn-primary btn-sm" href="<?= site_url( 'admin/teacher/teacher_incentives' ) ?>">
                                    Add Heads
                                </a>
                                </div>
                    </div>
                     <div class="box-body">
                        <div class="mailbox-controls">
                        </div>
                      

                        <div class="table-responsive mailbox-messages">
                            <table class="table     table-bordered table-hover example">
                                <thead>
                                    <tr>
                                        <th>T.ID</th>
                                        <th>Name</th>
                                        <th class="text-right no-print"><?php echo $this->lang->line( 'action' ); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $count = 1;
                                    foreach ( $teacherlist as $teacher ) {
                                        $teacher_type_details = $this->teacher_type_model->get( $teacher['teacher_type_id'] );
                                        ?>
                                        <tr>
                                            <td class="mailbox-name"> <?php echo $teacher['id'] ?></td>
                                            <td class="mailbox-name"> <?php echo $teacher['name'] ?></td>
                                            <td class="mailbox-date pull-right no-print">
                                             <a href="<?= site_url( "admin/teacher/salary_payment/{$teacher['id']}" )  ?>" class="btn btn-default btn-xs" ><i class="fa fa-money"></i></a>
                                            
                                                <a href="<?php echo base_url(); ?>admin/teacher/view/<?php echo $teacher['id'] ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="<?php echo $this->lang->line( 'show' ); ?>">
                                                    <i class="fa fa-reorder"></i>
                                                </a>
                                                <a href="<?php echo base_url(); ?>admin/teacher/edit/<?php echo $teacher['id'] ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="<?php echo $this->lang->line( 'edit' ); ?>">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                              
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    $count++;

                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="">
                        <div class="mailbox-controls">
                        </div>
                    </div>
                </div>

                </div>
                <div class="col-sm-8">

                    <div class="box box-primary" id="tachelist">

                        <div class="box-body">

                            <div class="col-sm-2">
                                <div class="col-xs-12 text-left" style="padding-bottom: 10px;">
                                    <img src="<?= base_url( $staff_details['image'] ) ?>" alt="<?= $staff_details['name'] ?>" class="img-responsive img-inline-block" width="100" height="200">
                                </div>
                            </div>
                            <div class="col-sm-10">


                                <div class="mailbox-messages">

                                    <div class="row">
                                        <div class="col-xs-6 col-sm-3  ">Name</div>
                                        <div class="col-xs-6 col-sm-3"><?= $staff_details['name'] ?></div>
                                        <div class="clearfix visible-xs"></div>
                                        <div class="col-xs-6 col-sm-3  ">Email</div>
                                        <div class="col-xs-6 col-sm-3"><?= $staff_details['email'] ?></div>
                                        <div class="clearfix visible-sm visible-xs"></div>
                                        <div class="col-xs-6 col-sm-3  ">Designation</div>
                                        <div class="col-xs-6 col-sm-3"><?= $staff_details['designation'] ?></div>
                                        <div class="clearfix visible-xs"></div>
                                        <div class="col-xs-6 col-sm-3  ">Gender</div>
                                        <div class="col-xs-6 col-sm-3"><?= $staff_details['sex'] ?></div>
                                        <div class="clearfix visible-sm visible-xs"></div>
                                        <div class="col-xs-6 col-sm-3  ">Salary per month</div>
                                        <div class="col-xs-6 col-sm-3"><?= "Rs. " . number_format($staff_details['salary']) ?></div>
                                        <div class="col-xs-6 col-sm-3  ">Salary Status</div>
                                        <div class="col-xs-6 col-sm-3"><?= "Rs. " . number_format($staff_details['due_salary']) ?></div>
                                        <div class="col-xs-6 col-sm-3  ">Address</div>
                                        <div class="col-xs-6 col-sm-3"><?= $staff_details['address'] ?></div>
                                    </div>

                                </div>

                            </div>


                        </div>

                    </div>




                    <div class="box box-primary active">
        <div class="box-header" style="padding-bottom:0px;">
            <div class="col-sm-4" style="margin-left:0px" align="left">  
                <h3 class="box-title">Salary payment history</h3>
            </div>
            <div class="col-sm-8" style="margin-left:0px" >  
                <div class="box box-primary" style="margin-bottom:0px">
                    <div class="box-body ">
                            <?php $admind = $this->session->userdata( 'admin' );	?> 
                            <form action="<?= site_url( "admin/staff/salary_payment_process/{$staff_details['id']}" )  ?>" method="post">
                            <div class="col-sm-4">
                                <label>Payment amount</label>
                            </div>
                            <div class="col-sm-4 payment">  
                                <input type="hidden" name="admin" value="<?= $admind['username'] ?>">
                                <input type="hidden" id="active" name="Active" value="<?= $staff_details['active'] ?>">
                                <input type="number" min="0" name="paid_amount" class="form-control" value="<?= set_value( 'paid_amount', ( intval( $staff_details['due_salary'] ) <= 0 ? 0 : $staff_details['due_salary'] ) ) ?>">
                                          
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Review & Proceed </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
                   <div class="box-body">
                        <?php
                        if ( $teacher_salary_payments === false ):
                            echo '<h3 class="text-center text-danger">No salary payments found!</h3>';
                        else:
                            ?>
                            <?php
							$salary_total = 0;
							$total_i =0;
							$total_d=0;
                              foreach ( $teacher_salary_payments as $teacher_salary_payment ):
							  
							 	$salary_total += $teacher_salary_payment['paid_salary'];
							   $total_i += $teacher_salary_payment['incentive'];
							    $total_d += $teacher_salary_payment['deduction'];
							   endforeach; ?>
                            <div class="table-responsive">
                                <table class="table table-bordered ">
                                    <thead>
                                  <tr>
                                    <td colspan="2"></td>
                                    <td class="text-center" >(<?= number_format( $total_i) ?>)</td>
                                    <td class="text-center" >(<?= number_format($total_d) ?>)</td>
                                    <td ></td>
                                    <td class="text-center">(<?= number_format($salary_total) ?>)</td>
                                    </tr>
                                        <tr>
                                            <th>Payment date</th>
                                            <th>Admin </th>
                                            <th class="text-center">Incentive</th>
                                            <th class="text-center">Deduction</th>
                                             <th class="text-center">Due salary</th>
                                            <th class="text-center">Payment</th>
                                            <th class="text-center">Balance</th>
                                            
                                           <?php $admind = $this->session->userdata( 'admin' );
                                           $this->load->helper('menu_helper');
                                           $permission = admin_permission($admind['id']); ?>
                                            
                                            <?php if ($permission->delete_fee == 1) {	?>
                                            <th>Actions</th>
                                        <?php }?>
                                        
                                        </tr>
                                    </thead>


                                    <tbody>
                                    
                                    
                                        <?php $staff_salary_payments = array_reverse($staff_salary_payments);
										 foreach ( $staff_salary_payments as $staff_salary_payment ): ?>
                                            <tr>
                                                <td><?= date( 'd/M/Y', strtotime( $staff_salary_payment['teacher_salary_payment_date'] ) ) ?></td>
                                                <td> <?= $staff_salary_payment['user_id'] ?> </td>
                                                <td class="text-center">
                                                <?= number_format($staff_salary_payment['incentive']) ?> 
												
                                                </td>
                                                <td class="text-center"><?= number_format($staff_salary_payment['deduction']) ?> 
												</td>
                                                <td class="text-center"> <?= number_format($staff_salary_payment['due_salary']) ?></td>
                                                <td class="text-center"> <?= number_format($staff_salary_payment['paid_salary']) ?></td>
                                                <td class="text-center"> <?= number_format($staff_salary_payment['due_salary'] - $staff_salary_payment['paid_salary']) ?></td>
                                                
                                                <td>
                                                <?php 
												
									    $current_date = date("Y-m-d", now());
							        	$payment_date = $staff_salary_payment["teacher_salary_payment_date"];
	                                  if(($payment_date == $current_date && $permission->daily_delete==1 ) ||  $permission->delete_fee==1){ ?>
                                                    <a class="btn btn-default btn-xs" href="<?= site_url( 'admin/teacher/salary_payment_delete/' . $staff_salary_payment['teacher_salary_payment_id'] ) . "?redirect_back=" . urlencode( $redirect_back ) ?>" onclick="return confirm('Do you really want to remove this salary payment?');"><i class="far fa-trash-alt"></i></a>
													<?php }?>
                                                </td>
                                            </tr>
                                         
                                  <?php  endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                    <td colspan="5"></td>
                                    <td class="text-center">(<?= number_format($salary_total) ?>)</td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>

                            <?php endif;?>
              </div>
            </div>                    
                    

                    <div class="col-sm-6" style="padding:0px">
                <form action="" method="post">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Incentive</h3>
                            <div class="pull-right">
                                <div class="row"> 
                                    <div class="col-sm-6">
                                    </div>  
                                </div>
                            </div>
                        </div>

                        <div class="box-body">
                            <div class="row">
                            
                                <?php
								
								 if ( $student_fee_types !== false ): ?>
                                    <?php $count = 2; ?>
                                    <?php foreach ( $student_fee_types as $student_fee_type ): ?>
                                        <div class="col-xs-6">
                                            <div class="checkbox">
                                                <label>
                                            <input type="hidden" name="incentive[<?= $count ?>][name]" value="<?= $student_fee_type['name'] ?>">
                                            <input type="hidden" name="incentive[<?= $count ?>][id]" value="<?= $student_fee_type['id'] ?>">
                                            
                          <input type="checkbox" id="other_fee" class="other_fee" name="incentive[<?= $count ?>][check]" value="1"> <?= $student_fee_type['name'] ?>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            <div class="form-group" style="margin-top: 5px; margin-bottom: 0px;">
                                                <input type="number" class="form-control" name="incentive[<?= $count ?>][amount]" value="<?= set_value( "incentive[{$count}][amount]", $student_fee_type['amount'] ) ?>" min="0">
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <hr  style="margin: 0px 5px;">
                                        <?php $count++; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                            
                           
                          <div class="row">                             
                                    <div class="col-xs-6">Date</div>

                                    <div class="col-xs-6">
                                  <div class="form-group">
                                 <input type="text" class="form-control date" id="due_date_h_date_other" name="incentive_date" value="<?= set_value( 'due_date_h_date_other', date( 'm/d/Y', now() ) ) ?>"  >
                                        </div>
                                   </div>
                              <div class="clearfix"></div>                
                          </div>   
                          
                                <div class="">
                            <button type="submit" class="btn btn-primary pull-right"   formaction="<?= site_url( "admin/staff/staff_incentive_deduction/{$staff_details['id']}" ) ?>">Proceed Incentive</button>
                                                    </div>
                        </form>
                      </div>
                    </div>
            </div>     
          <div class="col-sm-6" style="padding-right:0px">
            <form action="" method="post">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Deduction</h3>
                            <div class="pull-right">
                             <div class="row"> 
                          <div class="col-sm-6">
                                
                               </div>  
                            </div>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="row">
                            
                            
                                <?php 
								if ( $student_fee_types !== false ): ?>
                                    <?php $count = 2; ?>
                                    <?php foreach ( $student_fee_types2 as $student_fee_type ): ?>
                                        <div class="col-xs-6">
                                            <div class="checkbox">
                                                <label>
                           <input type="hidden" name="deduction[<?= $count ?>][name]" value="<?= $student_fee_type['name'] ?>">
                          <input type="hidden" name="deduction[<?= $count ?>][id]" value="<?= $student_fee_type['id'] ?>">
                                <input type="checkbox" id="other_fee" class="other_fee" name="deduction[<?= $count ?>][check]" value="1"> <?= $student_fee_type['name'] ?>
                                                </label>
                                            </div>
                                        </div>
                                         <div class="col-xs-6">
                                            <div class="form-group" style="margin-top: 5px; margin-bottom: 0px;">
                                                <input type="number" class="form-control" name="deduction[<?= $count ?>][amount]" value="<?= set_value( "fee[{$count}][amount]", $student_fee_type['amount'] ) ?>" min="0">
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <hr  style="margin: 0px 5px;">
                                        <?php $count++; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                          <div class="row">                             
                                    <div class="col-xs-6">
                                        <div class="checkbox">
                                                Date
                                            
                                        </div>
                                    </div>

                                    <div class="col-xs-6">
                                          
                                                <div class="form-group">
             <input type="text" class="form-control date" id="due_date_h_date_other" name="deduction_date" value="<?= set_value( 'due_date_h_date_other', date( 'm/d/Y', now() ) ) ?>"  >
                                         
                                        </div>
                                    </div>
                              <div class="clearfix"></div>                
                          </div>   
                 

                                <div class="">
                            <button type="submit" class="btn btn-primary pull-right"  formaction="<?= site_url( "admin/staff/staff_incentive_deduction/{$staff_details['id']}") ?>">Proceed Deduction</button>                            
                            
                        </div>
                        
                    
                </form>                     
                              
                                       
                    </div>
                    </div>
                </div>
            
                         
            </div>
            </div>

        </div>
                </div>
            </div>

        </div>
        

    </section>
</div>



<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?= date('M',now())?> Incentive & Deduction</h4>
        </div>
        <div class="modal-body">
     
          <form action="" method="post">
             <div class="row">
                     <div class="col-sm-6">
                        <label>Payment amount</label>
                        </div>
                        <div class="col-sm-6"> 
                            <input type="hidden" name="admin" value="<?= $admind['username'] ?>">
                            <input type="hidden" id="active" name="Active" value="<?= $staff_details['active'] ?>">
                            <input type="number" name="paid_amount" class="form-control" value="<?= set_value( 'paid_amount', ( intval( $staff_details['due_salary'] ) <= 0 ? 0 : $staff_details['due_salary'] ) ) ?>">
                        </div>
                    </div>
                        <br>
                        <div class="table-responsive mailbox-messages">
                            <table class="table     table-bordered table-hover ">
                                <thead>
                                    <tr>
                                        <th>Incentive</th>
                                        <th>Deduction</th>
                                        <th class="text-right no-print"><?php echo $this->lang->line( 'action' ); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    foreach ( $incentive_deductions as $bonus ) {
                                        ?>
                                        <tr>
                                        <td class="mailbox-name">
                                            <?php if($bonus['type'] == 'incentive'){  ?>
                                             <?= $bonus['name'] ?> <?= $bonus['amount'] ?>
                                            <?php }?>
                                            </td>
                                            <td class="mailbox-name">
                                            <?php if($bonus['type'] == 'deduction'){  ?>
                                             <?= $bonus['name'] ?> <?= $bonus['amount'] ?>
                                            <?php }?>
                                            </td>
                                            <td class="mailbox-date pull-right no-print">
                                               <a class="btn btn-default btn-xs" href="<?= site_url( 'admin/teacher/incentive_delete/' . $bonus['id'] ) ?>" onclick="return confirm('Do you really want to remove this salary payment?');"><i class="far fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    $count++; ?>
                                </tbody>
                            </table>
                        </div>   
                    </div>
        
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    
                    <button type="submit" class="btn btn-primary pull-right" formaction="<?= site_url( "admin/staff/salary_payment_process/{$staff_details['id']}" )  ?>">Proceed</button>
                    
            </form>  
        </div>
      </div>
    </div>
  </div>

