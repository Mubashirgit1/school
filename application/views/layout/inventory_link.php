    <section class="content-header">
                       
        <div class="box box-primary" style="margin-bottom: 0px;">
            <div class="box-header with-border" style="text-align: center;">
                <div class="btn-group" role="group" aria-label="#">
                 <?php  $admind = $this->session->userdata( 'admin' );
                  $this->load->helper('menu_helper');
                  $permission = admin_permission($admind['id']); ?>
                    <?php   if($permission->expense == 1){ ?>
                    <a href="<?= site_url( 'admin/InventoryItems' ) ?>" class="btn btn-default"  >Add Inventory Items </a>
                    <?php } if($permission->expense == 1){ ?>
                    <a href="<?= site_url( 'admin/inventory' ) ?>" class="btn btn-default" >Add Inventory Heads</a>                    
                    <?php } if($permission->expense == 1){ ?>
                    <a href="<?= site_url( 'admin/InventoryItemIssue' ) ?>" class="btn btn-default"  >Issue Inventory Items </a>
                    <?php }?>
                </div>
            </div>
        </div>
        
    </section>