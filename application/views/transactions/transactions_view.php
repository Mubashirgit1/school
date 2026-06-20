<style type="text/css">
    @media print {
        .no-print, .no-print * {
            display: none !important;
        }
    }
	.outlined {
  border: 1px solid #CBCBC9;
     }
</style>

<div class="content-wrapper" style="min-height: 946px;">
<?php  $this->load->view('layout/bank_link'); ?>
    <section class="content-header">
    <div class="box box-primary" >  
      <div class="box-header with-border" style="">
    <h4 class="pull-left"><?= $title ?></h4>
    <div class="pull-right">
            <form action="<?= current_url() ?>" method="get" class="form-inline">
                                                 <div class="form-group">
                                                        <label for="exampleInputFile">Search Account</label>
                                                         <select class="form-control" required id="search" name="search" readonly>
                                                          <option value=""><?php echo $this->lang->line( 'select' ); ?></option>                                               <?php foreach ( $account as $key => $value ) { ?>
                                                          <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>   
                                                                     <?php }?>
                         
                                                            </select>
                                                      </div>
          
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
                    <?php /*?>   <a style="margin-left:15px;" href="<?php echo site_url( 'student/send_message' ) ?>" class="btn btn-primary back_btn">
                        <i class="fa fa-chevron-left"></i> Back
                    </a>
                    <?php */?>
        </div>
          </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header ptbnull">
                        <h3 class="box-title titlefix"><?= $transfer['name'];   ?></h3>
                    </div>
                    <br>
                              <?php  $total_debit  = 0;
								     $total_credit = 0;
									  foreach ( $transfer['debit'] as $account_transfer ) {
							           if($account_transfer['debit'] == $transfer['id']){
											 $total_debit += $account_transfer['amount']; 
											  }
											  if($account_transfer['credit'] == $transfer['id']){
											  $total_credit += $account_transfer['amount']; 
											 	 }
									 	 }
									$opening    =	floatval($transfer['opening_account']) + floatval($total_debit) - floatval($total_credit);							?>
                  <div class="box-body">
                    <div class="table-responsive mailbox-messages">
                            <table class="table     table-bordered table-hover example3">
                                               <colgroup>
    <col><col span="1">
    <col class="outlined">
    <col class="outlined">
    <col class="outlined">
    <col>
    <col class="outlined">
    <col class="outlined">
    <col class="outlined">
    </colgroup>
                                 <thead>
                                    <tr>
                                        <th class="text-center" >ID</th>
                                        <th class="text-center">Date</th>
                                        <th class="text-center">Desc</th>
                                        <th class="text-center">Credited A/C </th>
                                        <th class="text-center">Debit </th>
                                        <th></th>
                                        <th class="text-center">Desc</th>
                                        <th class="text-center">Debited A/C</th>
                                        <th class="text-center">Credit</th>
                                        <th class="text-center">Balance</th>
                                           </tr>
                                </thead>
                                 <tbody>
                                    <?php $total_balance = $opening;
									
									foreach ( $transfer['debit'] as $account_transfer ) { ?>
                                        <tr>
                                             <td class="text-center"> <?= $account_transfer['id'] ?></td>
                                             <td class="text-center"> <?= date('d-M-Y',strtotime($account_transfer['date'])) ?></td>                            
                <?php $transfer_from = $this->transactions_model->get_account( $account_transfer['credit']); ?>                                        <?php if($transfer_from['id'] == $transfer['id']){ ?>  
                                          <td class="text-center"> </td>
                                          <td class="text-center"> </td>
                                         <?php }else{ ?>
                                          <td class="text-center"> <?= $account_transfer['description'] ?></td>
                                          <td class="text-center"><?= $transfer_from['name'] ?></td>
                                         <?php } ?>
                                             <?php if($account_transfer['debit'] == $transfer['id']){
												 $debit = $account_transfer['amount']; ?>
                                             <td class="text-center"><?= number_format($debit) ?></td>
                                             <?php  }else{
												 $debit = 0;
												  ?>	 
											 <td class="text-center"></td>
                                            <?php } ?>
                                            <td></td>
                                             <?php
                                   $transfer_to = $this->transactions_model->get_account( $account_transfer['debit']);
							      		 if($transfer_to['id'] == $transfer['id']){ ?>  
                                          <td class="text-center"></td>
                                          <td class="text-center"></td>
                                         <?php }else{ ?>
                                           <td class="text-center"> <?= $account_transfer['description'] ?></td>
                                           <td class="text-center"> <?= $transfer_to['name'] ?></td>
										 <?php } ?>
                                         <?php if($account_transfer['credit'] == $transfer['id']){
										      $credit = $account_transfer['amount'];?>
                                             <td class="text-center"><?= number_format($credit) ?></td>
                                    		 <?php }else{ 
											  $credit = 0;
											 ?>
                                         	 <td class="text-center"></td>
                                            <?php }
										$total_balance = $total_balance;
											 /*?>if($debit > 0 && $debit != null ){
										$total_balance = floatval($total_balance)  - floatval($debit);
											}elseif($credit > 0 && $credit != null){
										$total_balance = floatval($total_balance)  + floatval($credit);
											}<?php */?>
                                    
                                         <?php if($account_transfer['credit'] == $transfer['id']){ ?>        
                                             <td class="text-center">
                                             
                                             <?= $account_transfer['credit_balance']  ?>
                                             
                                             </td>
                                    <?php }else{ ?>
                                             <td class="text-center">
                                             
                                             <?= $account_transfer['debit_balance']  ?>
                                             
                                             </td>
                               
                                    
                                        <?php } ?>
                                    
                                    
                                        </tr>
                                        <?php } ?>
                                </tbody>
                                 <tfoot>
                                        <tr>
                                            <th class="text-right" colspan="2"> </th>
                                            <th class="text-center">Total </th>
                                            <th class="text-center"> </th>
                                            <th class="text-center"><?= number_format($total_debit) ?> </th>
                                            <th></th>
                                            <th class="text-center">Total </th>
                                            <th class="text-center"> </th>
                                            <th class="text-center"><?= number_format($total_credit) ?> </th>
                                            <th class="text-center"><?= number_format($transfer['opening_account']) ?> </th>
                                       
                                        </tr>
                                    </tfoot>
                            </table>
                        </div>        
                      </div>
                    </div>
                 </div>
              </div>
           </section>
        </div>

<script type="text/javascript">
    $( document ).ready( function () {
        var date_format = '<?php echo $result = strtr( $this->customlib->getSchoolDateFormat(), ['d' => 'dd', 'm' => 'mm', 'Y' => 'yyyy',] ) ?>';
        $( '#dob, #admission_date' ).datepicker( {
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

		
    } );
</script>



<script type="text/javascript">
    var base_url = '<?php echo base_url() ?>';

    function printDiv( elem ) {
        Popup( jQuery( elem ).html() );
    }

    function Popup( data ) {

        var frame1 = $( '<iframe />' );
        frame1[0].name = "frame1";
        frame1.css( {"position": "absolute", "top": "-1000000px"} );
        $( "body" ).append( frame1 );
        var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
        frameDoc.document.open();
        //Create a new HTML document.
        frameDoc.document.write( '<html>' );
        frameDoc.document.write( '<head>' );
        frameDoc.document.write( '<title></title>' );
        frameDoc.document.write( '<link rel="stylesheet" href="' + base_url + 'backend/bootstrap/css/bootstrap.min.css">' );
        frameDoc.document.write( '<link rel="stylesheet" href="' + base_url + 'backend/dist/css/font-awesome.min.css">' );
        frameDoc.document.write( '<link rel="stylesheet" href="' + base_url + 'backend/dist/css/ionicons.min.css">' );
        frameDoc.document.write( '<link rel="stylesheet" href="' + base_url + 'backend/dist/css/AdminLTE.min.css">' );
        frameDoc.document.write( '<link rel="stylesheet" href="' + base_url + 'backend/dist/css/skins/_all-skins.min.css">' );
        frameDoc.document.write( '<link rel="stylesheet" href="' + base_url + 'backend/plugins/iCheck/flat/blue.css">' );
        frameDoc.document.write( '<link rel="stylesheet" href="' + base_url + 'backend/plugins/morris/morris.css">' );


        frameDoc.document.write( '<link rel="stylesheet" href="' + base_url + 'backend/plugins/jvectormap/jquery-jvectormap-1.2.2.css">' );
        frameDoc.document.write( '<link rel="stylesheet" href="' + base_url + 'backend/plugins/datepicker/datepicker3.css">' );
        frameDoc.document.write( '<link rel="stylesheet" href="' + base_url + 'backend/plugins/daterangepicker/daterangepicker-bs3.css">' );
        frameDoc.document.write( '</head>' );
        frameDoc.document.write( '<body>' );
        frameDoc.document.write( data );
        frameDoc.document.write( '</body>' );
        frameDoc.document.write( '</html>' );
        frameDoc.document.close();
        setTimeout( function () {
            window.frames["frame1"].focus();
            window.frames["frame1"].print();
            frame1.remove();
        }, 500 );


        return true;
    }


    jQuery( function ( $ ) {
        $( ".select_checkbox" ).on( 'change', function ( e ) {
            var target = $( this ).data( 'target' ),
                current_checked = $( this ).prop( 'checked' );

            if ( current_checked === true ) {
                $( target ).prop( 'checked', true ).change();
            } else {
                $( target ).prop( 'checked', false ).change();
            }
        } );
		

  } );
  
  
    jQuery( function ( $ ) {
        $( ".select_checkbox_teacher" ).on( 'change', function ( e ) {
            var target = $( this ).data( 'target' ),
                current_checked = $( this ).prop( 'checked' );

            if ( current_checked === true ) {
                $( target ).prop( 'checked', true ).change();
            } else {
                $( target ).prop( 'checked', false ).change();
            }
        } );
	} );

  jQuery( function ( $ ) {
        $( ".select_checkbox_staff" ).on( 'change', function ( e ) {
            var target = $( this ).data( 'target' ),
                current_checked = $( this ).prop( 'checked' );

            if ( current_checked === true ) {
                $( target ).prop( 'checked', true ).change();
            } else {
                $( target ).prop( 'checked', false ).change();
            }
        } );
		

  } );
  
    jQuery( function ( $ ) {
        $( ".select_checkbox_all" ).on( 'change', function ( e ) {
            var target = $( this ).data( 'target' ),
                current_checked = $( this ).prop( 'checked' );

            if ( current_checked === true ) {
                $( target ).prop( 'checked', true ).change();
            } else {
                $( target ).prop( 'checked', false ).change();
            }
        } );
		

  } );


    $( function ( $ ) {
        $( "#inputTeacherType" ).change( function () {
            var selectedValue = $( this ).find( 'option:selected' ).text();
            selectedValue = selectedValue.toLowerCase();
            var teacherSalaryLabel = $( "#inputTeacherSalaryLabel" );

            // if permanent is selected
            if ( selectedValue.search( "permanent" ) >= 0 ) {
                teacherSalaryLabel.text( "Monthly Salary" );
            } else {
                teacherSalaryLabel.text( "Per Lecture Payment" );
            }

            $( "#inputTeacherSalary" ).val( "" );
        } );
    } );
</script>
