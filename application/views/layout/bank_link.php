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
                    <a href="<?= site_url( 'transactions/assets_liabilties' ) ?>" class="btn btn-default" >Assets/Liabilties</a>                    
                    <?php } if($permission->register_s == 1){ ?>
                    <!-- <a href="< ?= site_url( 'admin/staff/create?search=search_filter&staff_type=active' ) ?>" class="btn btn-default"  >Register/Staff</a>                     -->
                    <?php } if($permission->active_t == 1){ ?>
                    <a href="<?= site_url( 'transactions/bank' ) ?>" class="btn btn-default"  >Transactions Summary</a>
                    <?php } if($permission->inactive_t == 1){ ?>
                    <a href="<?= site_url( 'transactions/transaction_history' ) ?>" class="btn btn-default" >Transactions Area</a>
                    <?php } if($permission->salary_status == 1){ ?>
                    <a href="<?= site_url( 'transactions/account' ) ?>" class="btn btn-default"  >Create Account</a>
                    <?php } ?>
                      
                </div>
            </div>
        </div>
        
    </section>