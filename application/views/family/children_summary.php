<div class="content-wrapper">
<section class="content-header">

    <form action="" method="post" >
    <div class="box box-primary" style="margin-bottom: 0px;">
                           <div class="box-header with-border" style="text-align: center;">
		<div class="box-header with-border" style="text-align: center;">
          <div class="pull-left" style="padding-right:40px">
                <div class="btn-group" role="group" aria-label="#">
                
                 <?php  $admind = $this->session->userdata( 'admin' ); ?>
                 
                 <?php foreach($children as $child){ 
			
					 if($child['id'] !== $student['id'] ){  ?>
                     <a href="<?php echo base_url(); ?>fee_management/receive_fee/<?php echo $child['id'] ?>" class="btn btn-default" ><?php 
					  echo $child['firstname']." ".$child['lastname']; 
                      ?>
                     </a>                    
                    <?php }else{  ?>
					
					<a href="<?php echo base_url(); ?>fee_management/receive_fee/<?php echo $child['id'] ?>" class="btn btn-default" ><?php 
					  echo '<span class="text-blue" style="font-weight:bold">'.$child['firstname'].' '.$child['lastname'].'</span>';
					  ?>
                     </a>
				<?php	}?>
				<?php } ?>
                </div>
            </div>
            <div class="pull-right">
                    <div class="col-sm-3" style="width: 32%">
                        <button type="submit" class="btn btn-default btn-sm " formaction="<?php echo base_url(); ?>fee_management/fee_voucher_process_all?vrno=&student_id="<?php echo $child['id'] ?>""><i class="fa fa-print "></i></button>
                        <input type="checkbox" class="select_checkbox" data-target=".class_section_checkbox">
                        <span>Select All (Tuition Fee)</span>
                    </div>
                    <div class="col-sm-3" style="width: 30%">
                        <button type="submit" class="btn btn-default btn-sm " formaction="<?php echo base_url(); ?>fee_management/fee_voucher_process_all?vrno=&student_id="<?php echo $child['id'] ?>><i class="fa fa-print "></i></button>
                        <input type="checkbox" class="select_checkbox" data-target=".class_section_other">
                        <span>Select All (Other Fee)</span>
                    </div>
                    <div class="col-sm-3" style="width: 16%; margin-top: 3px;">
                        <input type="checkbox" class="bank_copy" id="bank_copy" name="bank_copy" value="1" checked>
                        <span class="text-danger"><b>Bank Copy</b> </span>
                    </div>
                    <div class="col-sm-3"  style="width: 22%" >
                        <a href="<?php echo base_url(); ?>family/children_summary/<?php echo $child['id'] ?>" class="btn btn-default" ><span class="text-blue" style="font-weight:bold">
                            Sibling Summary</span></a>
                    </div>
            </div>
        </div>
        
        </div>
        </div>
                       
           
        
    </section>
        <section class="content">
        <form class="row">
            <!-- left column -->
            <?php 
			$total_fee_due = 0;
			$total_other_due = 0;
			$total_fine = 0;
			$total_arrears = 0;

			foreach($children as $child){ ?>

                <div class="box box-primary">
                    <div class="box-header">
                        <div class="row">
                            <div class="col-md-4">
                             <h3 class="box-title"><?= $child['firstname']." ".$child['lastname'] ?> information </h3>
                            </div>
                        </div>
                    </div><!--./box-header-->
                    <div class="box-body" style="padding-top:0;">
                        <div class="row">
                            <div class="col-md-12">                                    
                              <div class="table-responsive">
                                <table class="table table-bordered  table-hover">
                                       <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th class="text-center">Gender</th>
                                            <th class="text-center">Adm No</th>
                                            
                                            <th class="text-center">Class</th>
                                            <th class="text-center" >Section</th>
                                            <th class="text-center">Class fee</th>
                                            <th class="text-center">Discount</th>
                                            <th class="text-center">Fee</th>
                                            <th class="text-center">Tuition Fee Due</th>
                                            <th class="text-center">Arrears</th>
                                            <th class="text-center">Fine</th>
                                            
                                            
                                            <th class="">Vr No</th>
                                            <th class="text-center">Other Fee Due</th>
                                            <th class="text-center"></th>
                <!-- < ?php foreach($child['tuition'] as $key=>$annual){
                $monthNum  = $key;
                $dateObj   = DateTime::createFromFormat('!m', $monthNum);
                $monthName = $dateObj->format('M'); ?>
                <th class="text-center" >< ?= $monthName ?> </th>	
                < ?php	} ?> -->
        
                                        </tr>
                                    </thead>
                                    <tbody>
                               	
                                <tr>
                                    <input type="hidden" name="student_ids[]" value="<?= $child['id'] ?>">
                                <td><?= $child['firstname']." ".$child['lastname']?></td>
                                <td class="text-center" ><?= $child['gender'] ?></td>
                                <td class="text-center" ><?= $child['admission_no'] ?></td>
                                
                                <td class="text-center"><?= $child['class_name'] ?></td>
                                <td class="text-center"><?= $child['section_name'] ?></td>
                                <td class="text-center"><?= number_format($child['class_fee']) ?></td>
                                <td class="text-center"><?= number_format($child['discount']) ?></td>
                                <?php  $student_fee = $child['class_fee'] - $child['discount'] ?>
                                <td class="text-center" ><?= number_format($student_fee) ?></td>

							   <td class="text-center" >
							   <?php if($child['fee_arrears'] < $student_fee && $child['fee_arrears'] >= 0 ){
								   $due_fee = $child['fee_arrears'] ?>
							   <?= number_format($due_fee) ?>
                               <?php }else{
							   $due_fee =$student_fee;
							   ?>
                               <?= number_format($due_fee) ?>
                                <?php  } $total_fee_due += $due_fee;?>
                                
                                 </td>
                                 <?php if($child['fee_arrears'] > $student_fee  ){ 
							  $arrears_child = $child['fee_arrears'] - $student_fee - $child['late_payment_fee'] ;
							  $total_arrears +=  $arrears_child;  
							  
							   ?>
                                <td class="text-center"><?= number_format($arrears_child); ?></td>
                                  <?php  }else{  ?>
                                <td class="text-center"><?= 0 ?></td>
                                	<?php  }   
									
									$total_fine += $child['late_payment_fee'];
									 ?>
                                <td class="text-center"><?= $child['late_payment_fee'] ?></td>
                                
                                <?php
									$total_other = 0;
								 if($child['other_fee_due'] !== null){
									foreach($child['other_fee_due'] as $other){
                                        $total_other += $other['total_fee'];
                                	}
									} 
									$total_other_due +=$total_other;
									?>
                                <td>  <?php if(!empty($child['voucher_id'])){?>
                                      <input type="checkbox" class="student_checkbox_<?= $class_id. '_'  .$section_id; ?> select_checkbox class_section_checkbox" name="voucher_ids[]" value="<?= $child['voucher_id'] ?>">
                                      <?= $child['voucher_id'] ?> 
                                <?php }?></td>
                                <td style="width:265px"> 
                                <?php if(!empty($child['other_fee_due'])){?>


<table>
<!-- <thead>
<tr>
<th>check</th>
<th style="padding: 0px 6px;">Vr No</th>
<th class="text-center" >Details</th>
<th>Total</th>
</tr>
</thead> -->
<tbody>

<?php 

foreach($child['other_fee_due'] as $other){  ?>
       <tr>
       <td >
          
       <input type="checkbox" class="student_checkbox_<?= $class_id. '_'  .$section_id; ?> select_checkbox class_section_other" name="voucher_ids[]" value="<?= $child['other_fee_due'][0]['id'] ?>">

       </td>
       <td style="padding:0px 0px"><?= $other['id']; ?></td>
       <td style="padding:0px 17px">

           <?php
           $total_ = 0; 
   foreach($other['voucher_fee_types'] as $type){ ?>
       <?= $type['name']?>
       <?= number_format($type['amount'])?>
      <?php  $total_  +=  $type['amount'] ?>
       <br>
   <?php } ?>
   </td> 
   <td class="text-right">
   <?= number_format($total_) ?>
   </td>         
   </tr>
<?php } ?>
</tbody>
</table>
   <?php } ?>
                                       </td>
                                <td> 
                            
                                
                                </td>
                                <!-- < ?= $total_other  ?> <div class="form-group pull-right" >
                                        <input type="checkbox" class="student_checkbox_< ?= $class_id. '_'  .$section_id; ?> select_checkbox class_section_other" name="voucher_ids[]" value="< ?= $child['other_fee_due'][0]['id'] ?>">
                                    </div> </td> -->
                                
                               
                                </tr>
                                
                                
                                </tbody>
                                <tfoot>
                                <td></td>
                                <?php foreach($child['tuition'] as $key=>$annual){
                                $monthNum  = $key;
                                $dateObj   = DateTime::createFromFormat('!m', $monthNum);
                                $monthName = $dateObj->format('M'); ?>
                                <th class="text-center" ><?= $monthName ?> </th>	
                                <?php } ?>
                                
                                
                                <tr>
                                <td>Tuition</td>
                                <?php foreach($child['tuition'] as $monthly_tuition){ ?>
                                <td class="text-center"><?= number_format($monthly_tuition)  ?></td>
                                <?php } ?>
                                </tr>
                                <tr>
                                <td>Adv.Adj</td>
                                <?php foreach($child['advance'] as $monthly_advance){ ?>
                                    <td class="text-center"><?=  number_format(  $monthly_advance  >= 0 ? $monthly_advance: 0 )
                                  ?></td>
                                <?php }?>
                                </tr>

                                <tr>
                                    <td>Other Fee</td>
                                    <?php foreach($child['other_fee'] as $monthly_other_fee){ ?>
                                    <td class="text-center" ><?= number_format($monthly_other_fee) ?> </td>
                                    <?php } ?>
                                </tr>
                                
                                

                                </tfoot>
                                </table>




                            </div>
                        
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            <!--/.col (left) -->
            <?php } ?>
        </form>
              <div class="box box-primary">
                    <div class="box-header">
                    
                    </div>
                    <div class="box-body" style="padding-top:0;">
            
             <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                       <thead>
                                        <tr>
                                            <th class="text-center">Total Tuition Fee Due</th>
                                            <th class="text-center">Total Arrears</th>
                                            <th class="text-center">Total Fine</th>
                                            <th class="text-center" >Total Other Fee Due</th>                                            

                                        </tr>
                                    </thead>
                                    <tbody>
                                  <tr>
                                <td class="text-center"><?= $total_fee_due?></td>
                                <td class="text-center"><?= $total_arrears?></td>
                                <td class="text-center"><?= $total_fine?></td>
                                <td class="text-center"><?= $total_other_due?></td>
                                </tbody>
                                </table>
                            </div>
                    </div>
                    </div>
            
            
            
</div>
  
</section>
</div>





<script type="text/javascript">
$(document).on('change', '.select_checkbox', function (e) {

var target = $( this ).data( 'target' ),
current_checked = $( this ).prop( 'checked' );

if ( current_checked === true ) {
$( target ).prop( 'checked', true ).change();
} else {
$( target ).prop( 'checked', false ).change();
}
});


</script>