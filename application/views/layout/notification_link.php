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
                    <?php if($permission->expense == 1){ ?>
                        <a href="<?= site_url( 'admin/notification/add' ) ?>" class="btn btn-default"  >Create Notification </a>
                    <?php } if($permission->expense == 1){ ?>                    
                        <a href="<?= site_url( 'admin/notification' ) ?>" class="btn btn-default" >Notification History</a>                    
                    <?php } ?>
                </div>
            </div>
        </div>
        
    </section>