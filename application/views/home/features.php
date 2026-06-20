<?php $this->load->view('home/partial/hero') ?>

<div class="features_container">
    <div class="container">

        <?php
        $i = 1;
        foreach ( $features as $feature ): ?>
            <div class="col-xs-6 col-sm-3 col-md-2">
                <div class="feature_img">
                    <img src="<?= site_url( $feature['img'] ) ?>" alt="<?= $feature['name'] ?>">
                </div>

                <div class="feature_name"><?= $feature['name'] ?></div>
            </div>

            <?php
            if ( $i % 2 == 0 ):
                echo '<div class="clearfix visible-xs"></div>';
            endif;

            if($i % 4 == 0):
                echo '<div class="clearfix visible-sm"></div>';
            endif;

            if($i % 6 == 0):
                echo '<div class="clearfix hidden-xs hidden-sm"></div>';
            endif;

            $i++;
        endforeach; ?>
    </div>
</div>