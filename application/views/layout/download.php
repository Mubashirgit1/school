<script src="<?php echo base_url(); ?>backend/ckeditor/ckeditor.js"></script>
<div class="btn-group" role="group" aria-label="#">
    <?php $admind = $this->session->userdata('admin');
    $this->load->helper('menu_helper');
    $permission = admin_permission($admind['id']); ?>
    <?php if ($permission->download == 1) { ?>
        <a href="<?= site_url('admin/content/sylabus') ?>" class="btn btn-default">Syllabus</a>
    <?php }
    if ($permission->download == 1) { ?>
        <a href="<?= site_url('admin/vocations') ?>" class="btn btn-default">Vacation </a>
    <?php }
    if ($permission->download == 1) { ?>
        <a href="<?= site_url('admin/youtube') ?>" class="btn btn-default">Youtube</a>
    <?php }
    if ($permission->download == 1) { ?>
        <a href="<?= site_url('admin/onlineclass') ?>" class="btn btn-default">Online Classes</a>
    <?php }
    if ($permission->download == 1) { ?>
        <a href="<?= site_url('admin/assignment') ?>" class="btn btn-default">Assignment</a>
    <?php }
    if ($permission->download == 1) { ?>
        <a href="<?= site_url('admin/homework') ?>" class="btn btn-default">Homework</a>
    <?php } ?>
</div>
