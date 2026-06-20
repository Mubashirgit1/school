 
                       
        
            <div class="box-header with-border" style="text-align: center; margin:0px; ">
            <div class="row">
                <div class="btn-group" role="group" aria-label="#">
                
                 <?php  $admind = $this->session->userdata( 'admin' ); ?>
                 
                 <?php
               
			     $month = date('m');
			     $year =  date('Y');
			   
			   ?>
                 
                
                       
                    <a  class="btn btn-default" style="color:#666666; padding:10px 60px 10px 60px;" href="<?= site_url( "fee_management/fee_reports?class_id=&section_id=&date_from=" . urlencode( "$month/01/{$year}" ) . "&date_to=" . urlencode( "{$month}/" . cal_days_in_month( CAL_GREGORIAN, $month, $year ) . "/{$year}" ) . "&search=search_filter" ) ?>" class="table_link">Voucher Wise Transactions</a>                    
                   
                    
                     
                     
              <a class="btn btn-default" style="color:#666666; padding:10px 60px 10px 60px;" href="<?= site_url( "fee_management/fee_reports2?class_id=&section_id=&date_from=" . urlencode( "$month/01/{$year}" ) . "&date_to=" . urlencode( "{$month}/" . cal_days_in_month( CAL_GREGORIAN, $month, $year ) . "/{$year}" ) . "&search=search_filter" ) ?>" class="table_link">Student Wise Transactions</a>
                    
                          
                          
                           
                          
                          
            
                </div>
                
                </div>
            </div>
    
