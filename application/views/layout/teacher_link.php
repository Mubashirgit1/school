    <section class="content-header">
                       
        <div class="box box-primary" style="margin-bottom: 0px;">
            <div class="box-header with-border" style="text-align: center;">
                <div class="btn-group" role="group" aria-label="#">
                <?php
                $month =  date( 'm', now() );
                $year  =  date( 'Y', now() );
                ?>
                 <?php  $admind = $this->session->userdata( 'admin' );
                  $this->load->helper('menu_helper');
                  $permission = admin_permission($admind['id']); ?>
                    <?php if($permission->register_t == 1){ ?>
                    <a href="<?= site_url( 'admin/teacher/create' ) ?>" class="btn btn-default" >Register Staff</a>                    
                    <?php } if($permission->register_s == 1){ ?>
                    <!-- <a href="< ?= site_url( 'admin/staff/create?search=search_filter&staff_type=active' ) ?>" class="btn btn-default"  >Register/Staff</a>                     -->
                    <?php } if($permission->active_t == 1){ ?>
                    <a href="<?= site_url( 'admin/teacher/create?search=search_filter&teacher_type=active' ) ?>" class="btn btn-default"  >Active Staff</a>
                    <?php } if($permission->inactive_t == 1){ ?>
                    <a href="<?= site_url( 'admin/teacher/create?search=search_filter&teacher_type=in-active' ) ?>" class="btn btn-default" >In-Active Staff</a>
                    <?php } if($permission->salary_status == 1){ ?>
                    <a href="<?= site_url( 'admin/teacher/salary' ) ?>" class="btn btn-default"  >Payroll Monthly Status</a>
                    <?php } if($permission->transaction_t == 1){ ?>
                    <a href="<?= site_url( 'admin/teacher/salary_report' ) ?>" class="btn btn-default"  >Transaction History</a>
                    <?php } if($permission->transaction_s == 1){ ?>
                    <!-- <a href="<?= site_url( 'admin/staff/salary_report' ) ?>" class="btn btn-default"  >Staff Trans History</a> -->
                    <?php } if($permission->heads_due == 1){ ?>
                    <a href="<?= site_url( 'admin/teacher/review_heads'. "?date_from=" . urlencode( "$month/01/{$year}" ) . "&date_to=" . urlencode( "{$month}/" . cal_days_in_month( CAL_GREGORIAN, $month, $year ) . "/{$year}" ) . "&search=search_filter" ) ?>" class="btn btn-default"  >Heads Due</a>
                    <?php } if($permission->heads_history == 1){ ?>
                    <a href="<?= site_url( 'admin/teacher/incentive'. "?date_from=" . urlencode( "$month/01/{$year}" ) . "&date_to=" . urlencode( "{$month}/" . cal_days_in_month( CAL_GREGORIAN, $month, $year ) . "/{$year}" ) . "&search=search_filter") ?>" class="btn btn-default" >Heads History</a>
                    <?php } if($permission->add_heads == 1){ ?>                 
                    <a href="<?= site_url( 'admin/teacher/teacher_incentives' ) ?>" class="btn btn-default"  >Add heads</a>
                    <?php }?>
                      
                </div>
            </div>
        </div>
        
    </section>