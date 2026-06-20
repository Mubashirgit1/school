<?php $this->load->view( 'home/partial/hero' ) ?>

<div class="features_container contacts_container">
    <div class="container">

        <?php foreach ( $contacts as $contact ): ?>

            <div class="col-sm-3">
                <div class="feature_img">
                    <img src="<?= site_url( $contact['img'] ) ?>" alt="<?= $contact['name'] ?>">
                </div>

                <div class="feature_name"><?= $contact['name'] ?></div>
            </div>

        <?php endforeach; ?>
    </div>
</div>