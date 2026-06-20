    <section class="content-header">
                       
        <div class="box box-primary" style="margin-bottom: 0px;">
            <div class="box-header with-border" style="text-align: center;">
                <div class="btn-group" role="group" aria-label="#">
                 <?php  $admind = $this->session->userdata( 'admin' );
                  $this->load->helper('menu_helper');
                  $permission = admin_permission($admind['id']); ?>
                    <?php if($permission->expense == 1){ ?>
                    <a href="<?= site_url( 'admin/expense' ) ?>" class="btn btn-default" >Add Expense</a>                    
                    <?php } if($permission->expense == 1){ ?>
                    <a href="<?= site_url( 'admin/expensehead' ) ?>" class="btn btn-default"  >Add Expense Heads</a>
                    <?php } ?>
                </div>
            </div>
        </div>
        
    </section>