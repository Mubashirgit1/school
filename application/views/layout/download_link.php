    <section class="content-header">
                       
        <div class="box box-primary" style="margin-bottom: 0px;">
            <div class="box-header with-border" style="text-align: center;">
                <div class="btn-group" role="group" aria-label="#">
                 <?php  $admind = $this->session->userdata( 'admin' );
                  $this->load->helper('menu_helper');
                  $permission = admin_permission($admind['id']); ?>
                    <?php if($permission->expense == 1){ ?>
                    <a href="<?= site_url( 'admin/content' ) ?>" class="btn btn-default" ><?php echo $this->lang->line( 'upload_content' ); ?></a>                    
                    <?php } if($permission->expense == 1){ ?>
                    <a href="<?= site_url( 'admin/content/assignment' ) ?>" class="btn btn-default"  ><?php echo $this->lang->line( 'assignments' ); ?></a>
                    <?php } if($permission->expense == 1){ ?>
                    <a href="<?= site_url( 'admin/content/studymaterial' ) ?>" class="btn btn-default"  ><?php echo $this->lang->line( 'study_material' ); ?></a>
                    <?php }if($permission->expense == 1){ ?>
                    <a href="<?= site_url( 'admin/content/syllabus' ) ?>" class="btn btn-default"  ><?php echo $this->lang->line( 'syllabus' ); ?></a>
                    <?php }if($permission->expense == 1){ ?>
                    <a href="<?= site_url( 'admin/content/other' ) ?>" class="btn btn-default"  ><?php echo $this->lang->line( 'other_downloads' ); ?></a>
                    <?php }?>
                </div>
            </div>
        </div>
        
    </section>