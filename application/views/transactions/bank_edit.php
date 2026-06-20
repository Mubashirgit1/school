<style type="text/css">
    @media print {
        .no-print, .no-print * {
            display: none !important;
        }
    }
</style>


<div class="content-wrapper" style="min-height: 946px;">
    <section class="content-header">
    <div class="box box-primary" >  
      <div class="box-header with-border" style="">
  
           <h4 class="pull-left">
           <?= $title ?>
        </h4>
                 
           <div class="pull-right">
            <form action="<?= current_url() ?>" method="get" class="form-inline">
                <div class="form-group">
                    <label>Date From</label>
                    <input type="text" class="form-control date" name="date_from" value="<?= ( $date_from !== null ? date( 'm/d/Y', strtotime( $date_from ) ) : ( $date_to === null ? date( 'm/d/Y', strtotime( $date ) ) : "" ) ) ?>" readonly>
                </div>

                <div class="form-group">
                    <label>Date To</label>
                    <input type="text" class="form-control date" name="date_to" value="<?= ( $date_to !== null ? date( 'm/d/Y', strtotime( $date_to ) ) : ( $date_from === null ? date( 'm/d/Y', strtotime( $date ) ) : "" ) ) ?>" readonly>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-sm pull-right">Search</button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </section>
    
    
       <div class="col-md-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                    <li class="active"><a href="#assets" data-toggle="tab" aria-expanded="true" style="color:#666666">Assets/Liabilties </a></li>
                    
                     <li class=""><a href="#account_history" data-toggle="tab" aria-expanded="true" style="color:#666666">Transactions Summary</a></li>
                        <li ><a href="#activity" data-toggle="tab" aria-expanded="true" style="color:#666666;" >Transactions Area</a></li>
                     
                 <li class=""><a href="#hello" data-toggle="tab" aria-expanded="true" style="color:#666666">Create Account</a></li>
                    </ul>
                    <div class="tab-content">
                     <div class="tab-pane " id="activity">
                         <div class="row">
               <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-header with-border">
                    Transfer Cash
                    </div>
                    <form id="form1" action="<?php echo site_url( 'transactions/credit_process' ) ?>" id="employeeform" name="employeeform" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                        <div class="box-body">
                            <?php if ( $this->session->flashdata( 'msg' ) ) { ?>
                            <div class="alert alert-success" style='display: inline-block;'>    <?php echo $this->session->flashdata( 'msg' ) ?>
                            </div><?php } ?>
                            
                            <?php echo $this->customlib->getCSRF(); ?>
                            <input type="hidden" value="<?= $bank['id'] ?>"  name="id" >
                                            <div class="form-group">
                                        <label>Amount</label>
                                        <input class="form-control" type="number" id="amount" required name="amount" value="<?php echo set_value('amount', $bank['amount']); ?>" style="padding: 0px 5px 0px 12px;" >
                                       </div>
 
                                            <div class="form-group">
                                                        <label for="exampleInputFile">Credit</label>
                                                         <select class="form-control" required id="credit" name="transfer_credit">
                                                          <option value=""><?php echo $this->lang->line( 'select' ); ?></option>
                                                                <?php
                                                                foreach ( $account as $key => $value ) {
                                                                    ?>
                                                                    <option value="<?php echo $value['id']; ?>"  <?php if ( set_value( 'credit', $bank['credit'] ) == $value['id'] ) echo "selected"; ?> ><?php echo $value['name']; ?></option>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </select>
                                                      </div>
                                                      
                                            <div class="form-group">
                                                     <label for="exampleInputFile">Debit</label>
                                                        <select class="form-control" required id="debit" name="transfer_debit">
                                                          <option value=""><?php echo $this->lang->line( 'select' ); ?></option>
                                                                <?php
                                                                foreach ( $account as $key => $value ) {
                                                                    ?>
                                                                    <option value="<?php echo $value['id']; ?>" <?php if ( set_value( 'debit', $bank['debit'] ) == $value['id'] ) echo "selected"; ?>  ><?php echo $value['name']; ?></option>
                                                                    <?php
                                                                }
                                                                ?>
                                                        </select>
                                                      </div>
                                                      
                                            <div class="form-group">
                                                     <label for="exampleInputFile">Cash/Cheque</label>
                                                        <select class="form-control" required id="debit" name="cheque">
                                                          <option value=""><?php echo $this->lang->line( 'select' ); ?></option>
                                                                <?php
                                                                
                                                                foreach ( $payment_type as $key => $value ) {
                                                                    ?>
                                                                    <option value="<?php echo $value['id']; ?>" <?php if ( set_value( 'cheque', $bank['type'] ) == $value['id'] ) echo "selected"; ?> ><?php echo $value['name']; ?></option>
                                                                    <?php
                                                                }
                                                                ?>
                                                        </select>
                                                      </div>
                                                      
                                                  
                                          
                            <div class="form-group">
                                <label>Description</label>
                                <input type="text" required value="<?php echo set_value('description', $bank['description']); ?>"  class="form-control" name="description" required>
                             </div>
                       
                               <div class="form-group">
                                <label>Date Of Transfer</label>
                                <input type="text" id="transfer_date" class="form-control _date" name="transfer_date" value="<?= set_value( 'date', date( 'm/d/Y', strtotime($bank['date']) ) ) ?>" readonly>
                                <span class="text-danger"><?php echo form_error( 'joining_date' ); ?></span>
                            </div>
                                 <div class="box-footer">
                            <button type="submit" id="submit" class="btn btn-info pull-right"><?php echo $this->lang->line( 'save' ); ?>  Transfer</button>
                        </div>
                                   
                        </div>
                       
                    </form>
                </div>
            </div>
               <div class="col-md-8">
                <div class="box box-primary" id="tachelist">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix">Transactions History</h3>
                    </div>
                    

                    <div class="box-body">
                        <div class="mailbox-controls">
                        </div>
                        <div class="table-responsive mailbox-messages">
                            <table class="table     table-bordered table-hover example">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Date</th>
                                        <th>Debit</th>
                                        
                                        <th>Credit</th>
                                        <th>Type</th>
                                        <th>Description</th>
                                        <th>Amount</th>
                                        <th>Action</th>
                                        
                                        
                                           </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $count = 1;
                                    foreach ( $bank_transfer as $trans ) {
                                       
									   
                                        ?>
                                        <tr>
                                            <td class="mailbox-name"> <?= $trans['id'] ?></td>
                                            
                                            <td class="mailbox-name"> <?= date('d-M-Y', strtotime($trans['date'])) ?></td>
          <td class="mailbox-name">
                                                     <a href="<?php echo base_url(); ?>transactions/view_transaction/<?php echo $trans['debit']['id']; ?>"  > <?= $trans['debit']['name'] ?>
                                                        </a>
                                         </td>
                                                                               
                                             <td class="mailbox-name">
                                                <a href="<?php echo base_url(); ?>transactions/view_transaction/<?php echo $trans['credit']['id']; ?>"  > <?= $trans['credit']['name'] ?>
                                                        </a>
                                              </td>
                                              
                                            <td class="mailbox-name"> 
                        <?php $payment_type     = $this->transactions_model->get_payment_type($trans['type']); ?>         								<?php echo $payment_type['name'] ?>
                                            </td>
                                            
                                            <td class="mailbox-name"> <?php echo $trans['description'] ?></td>
                                            <td class="mailbox-name"> <?php echo number_format($trans['amount']) ?></td>
                                            
                                            
                                              <td class="mailbox-date pull-right no-print">

<a href="<?= site_url( 'transactions/edit_bank/' )."/".$trans['id']."?&date_from=" . urlencode( "$date_from" ) . "&date_to=" . urlencode( "$date_to" ) ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">                                       <i class="fas fa-pencil-alt"></i>
                                                </a>  
                                                                                              
                                                <a href="<?php echo base_url(); ?>transactions/delete_bank_transfer/<?php echo $trans['id'] ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="<?php echo $this->lang->line( 'delete' ); ?>" onclick="return confirm('Are you sure you want to delete this item?')" ;>
                                                    <i class="fa fa-remove"></i>
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
        
                        </div>
                        </div>
                       
              <div class="tab-pane" id="hello">
             <div class="row">
               <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-header with-border">
                     Create Account
                    </div>
                    <form id="form1" action="<?php echo site_url( 'transactions/credit_process' ) ?>" id="employeeform" name="employeeform" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                        <div class="box-body">
                            <?php if ( $this->session->flashdata( 'msg' ) ) { ?>
                             <div class="alert alert-success" style='display: inline-block;'>    <?php echo $this->session->flashdata( 'msg' ) ?>
                            </div>
                            <?php } ?>
                            <?php echo $this->customlib->getCSRF(); ?>
                            
           
                               <div class="form-group">
                                <label>Account Name</label>
                                <input type="text" id="message_title" class="form-control" required name="account_name">
                             </div>

           <div class="form-group">
                                                            <label for="exampleInputFile">Assets/Liabilties</label>
                                          
                                                            <select class="form-control" required name="assets">
                                                           <option value=""><?php echo $this->lang->line( 'select' ); ?></option>                                                 <option value="assets">Assets</option>                                                            <option value="liabilties">Liabilties</option>    
                                                            <option value="other">Others</option>    
                                                              
                                                            </select>
                                                       
                                                      </div>
                                                                      
                                     <div class="form-group">
                               <label>Opening Balance</label>
                              <input class="form-control" type="number" name="opening_balance" required value="" style="padding: 0px 5px 0px 12px;" >
                                       </div>

                                          
                       
                               <div class="form-group">
                                <label>Date Of Account</label>
                                <input type="text" id="credit_date" class="form-control _date" name="account_date" value="<?= set_value( 'date', date( 'm/d/Y', now() ) ) ?>" readonly>
                            </div>
                                
                                
                                 <div class="box-footer">
                            <button type="submit" class="btn btn-info pull-right"><?php echo $this->lang->line( 'save' ); ?> Account</button>
                        </div>
                                   
                        </div>
                       
                    </form>
                </div>
            </div>
               <div class="col-md-8">
                <div class="box box-primary" id="tachelist">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix">Account List</h3>
                    </div>
                

                    <div class="box-body">
                        <div class="mailbox-controls">
                        </div>
                        <div class="table-responsive mailbox-messages">
                            <table class="table     table-bordered table-hover example2">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Account Name</th>
                                        <th>Opening Balance</th>
                                        <th>Created Date</th>
                                        <th>Action</th>
                                        
                                           </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    foreach ( $account as $acc ) {
                                        ?>
                                        <tr>
                                            <td class="mailbox-name"> <?= $acc['id'] ?></td>
                                             <td class="mailbox-name">
                                                <a href="<?php echo base_url(); ?>transactions/view_transaction/<?php echo $acc['id']; ?>"  > <?= $acc['name'] ?>
                                                        </a>
                                              </td>
                                            <td class="mailbox-name"> <?= number_format($acc['opening_account']) ?></td>
                                            <td class="mailbox-name"><?= date('d-M-Y',strtotime($acc['date'])) ?> </td>
                                              <td class="mailbox-date pull-right no-print">
                                              <?php /*?>  <a href="<?php echo base_url(); ?>student/view_message/<?php echo $message['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line( 'show' ); ?>">
                                                    <i class="fa fa-reorder"></i>
                                                </a><?php */?>
                                               
                                                <a href="<?php echo base_url(); ?>transactions/delete_account/<?php echo $acc['id'] ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="<?php echo $this->lang->line( 'delete' ); ?>" onclick="return confirm('Are you sure you want to delete this item?')" ;>
                                                    <i class="fa fa-remove"></i>
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
                   
                </div>
            </div>              
             </div>
           </div>
            <div class="tab-pane" id="account_history">
            <div class="row">
              <div class="col-md-12">
                <div class="box box-primary">
                 <div class="box-header ptbnull">
                        <h3 class="box-title titlefix">Account Wise Transactions Summary</h3>
                    </div>
                   
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"></h3>
                    </div>
                    <div class="box-body">
                    <div class="table-responsive mailbox-messages">
                            <table class="table     table-bordered table-hover example3">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Debit Balance</th>
                                        <th>Credit Balance</th>
                                        <th>Balance</th>
                                 
                                        
                                           </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
									//echo "<pre>";
								//	print_r($debit2);
								//	echo "</pre>";
								    foreach ( $debit_transfer as $debit ) {
							            ?>
                                        <tr>
                                            <td class="mailbox-name"> <?= $debit['id'] ?></td>
                                             <td class="mailbox-name">
                                             
                                             
                                                <a href="<?php echo base_url(); ?>transactions/view_transaction/<?php echo $debit['id']; ?>"  > <?= $debit['name'] ?>
                                                        </a>
                                            
                                              </td>
                                        <?php  $total_debit = 0;
											 foreach($debit['debit'] as $debit2){
												
						                  $total_debit   += $debit2['amount'];
											
												}?>
                                             <?php
											$total_credit = 0;
											 foreach($debit['credit'] as $credit){
												
						                  $total_credit    += $credit['amount'];
											
												}?>
                                            
                                            <td class="mailbox-name"> <?= number_format($total_debit) ?></td>
                                            
                                            <td class="mailbox-name"> <?= number_format($total_credit) ?></td>
                                            
                                            
                                            <td class="mailbox-name"> <?= number_format($debit['opening_account']) ?></td>
                                            
                                        </tr>
                                        <?php
                                    }
                                    $count++;

                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="mailbox-controls">
                        </div>
                   
                    </div>
                </div>
            </div>
               
             </div>
           </div>
            <div class="tab-pane active" id="assets">
            <div class="row">
              <div class="col-md-6">
                <div class="box box-primary">
                 <div class="box-header ptbnull">
                        <h3 class="box-title titlefix">Assets</h3>
                    </div>
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"></h3>
                    </div>
                    <div class="box-body">
                    <div class="table-responsive mailbox-messages">
                    <table class="table     table-bordered table-hover example3">
                                <thead>
                                    <tr>
                                        <th class="text-center">Account</th>
                                        <th class="text-center">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                  $total_assets = 0;
  							    foreach ( $assets as $asset ) {
							         $total_assets += $asset['opening_account']; ?>
                                        <tr>
                                             <td class="text-center">
                                                <a href="<?php echo base_url(); ?>transactions/view_transaction/<?php echo $asset['id']; ?>"  > <?= $asset['name'] ?></a>
                                              </td>
                                            <td class="text-center"> <?= number_format($asset['opening_account']) ?></td>
                                        </tr>
                                        <?php
                                    }
                                    $count++;

                                    ?>
                                </tbody>
                                   <tfoot>
                                        <tr>
                                            <th class="text-center">Total </th>
                                            <th class="text-center"><?= number_format($total_assets) ?> </th>
                                       
                                        </tr>
                                    </tfoot>
                          
                            </table>

                        </div>
                     
                    </div>
                </div>
            </div>
               <div class="col-md-6">
                <div class="box box-primary">
                 <div class="box-header ptbnull">
                        <h3 class="box-title titlefix">Liabilities</h3>
                    </div>
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"></h3>
                    </div>
                    <div class="box-body">
                    <div class="table-responsive mailbox-messages">
                        </div>
                  <table class="table     table-bordered table-hover example3">
                                <thead>
                                    <tr>
                                        <th class="text-center">Account</th>
                                        <th class="text-center">Amount</th>
                                   </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
									$total_liabilties = 0;
								    foreach ( $liabilties as $liab ) {
							         $total_liabilties += $liab['opening_account'];
									    ?>
                                        <tr>
                                             <td class="text-center">
                                                <a href="<?php echo base_url(); ?>transactions/view_transaction/<?php echo $liab['id']; ?>"  > <?= $liab['name'] ?>           </a>
                                              </td>
                                            <td class="text-center"> <?= number_format($liab['opening_account']) ?></td>
                                        </tr>
                                        <?php
                                    }
                                    $count++;                                  ?>
                                </tbody>
                                       <tfoot>
                                        <tr>
                                            <th class="text-center">Total </th>
                                            <th class="text-center"><?= number_format($total_liabilties) ?> </th>
                                        </tr>
                                    </tfoot>
                            </table>
                  </div>
                </div>
              </div>
           </div>
         </div>
       </div>
     </div>
    
    <!-- Main content -->
    <section class="content">
        
    </section>
</div>
</div>
<script type="text/javascript">
    $( document ).ready( function () {
        var date_format = '<?php echo $result = strtr( $this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',] ) ?>';
        $( '#transfer_date, #account_date' ).datepicker( {
            format: date_format,
            autoclose: true
        } );
        $( "#btnreset" ).click( function () {
            $( "#form1" )[0].reset();
        } );
        $( '.date' ).datepicker( {
            format: 'mm/dd/yyyy',
            autoclose: true
        } );	
		 $( "#submit" ).on('click', function () {
          var  debit  = $( "#debit" ).val();
		  var credit  = $( "#credit" ).val();
		  var amount  = $( "#amount" ).val();
			     if(debit == credit){
				  alert("Please Change Debit and Credit are same");
                  return false;   
				  }
   		 var x = [];
		  $.ajax( {
            type: "post",
            url: '<?php echo site_url( "transactions/check_account" ) ?>',
            dataType: 'JSON',
            data: { 'debit_id': debit,  },
			async: false,
            success: function ( data ) {
         	  x.push(data) 	  
	     	}
	  	   });
	
	console.log(x);	
	  
	  if(parseInt(x[0]['opening_account']) <= parseInt(amount)  ){
	
		  alert("your Account value Less then amount");
	
	    return false;		  
		  }else{
		
		 return true;
		  
			  }
	  
	  } );
			
    } );
	
	
	
</script>

<script type="text/javascript">
    $( document ).ready( function () {
  
  
    });
</script>



