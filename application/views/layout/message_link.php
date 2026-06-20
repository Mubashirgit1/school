    <section class="content-header">
                       
        <div class="box box-primary" style="margin-bottom: 0px;">
            <div class="box-header with-border" style="text-align: center;">
                <div class="btn-group" role="group" aria-label="#">
                <?php
                
                $month =  date( 'm', now() );
             $year =  date( 'Y', now() );
                ?>
                 <?php  $admind = $this->session->userdata( 'admin' ); ?>
                 
                    <a href="<?= site_url( 'student/send_message' ) ?>" class="btn btn-default" >Message Template  </a>                    
                  
                    <a href="<?= site_url( 'student/send_message_tuition' ) ?>" class="btn btn-default" >Unpaid Tuition Fee </a>                    
                    
                    <a href="<?= site_url( 'student/send_message_other' ) ?>" class="btn btn-default" >Unpaid Other Fee </a>                    
                    
                    <a href="<?= site_url( 'student/send_message_exam' ) ?>" class="btn btn-default" >Examination center </a>                    
                    
                           
                </div>
            </div>
        </div>
        
    </section>