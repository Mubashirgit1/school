<div class="new_layout_form content_with_custom_height">

    <div class="container" style="height: 100%;">

        <div class="row" style="height: 100%;">

            <div class="col-xs-12" style="height: 100%;">

                <div class="new_form_container vertical_center_content">

                    <h3 class="text-center"><?= $heading ?></h3>

                    <div class="row">

                        <?php
                        $count = 1;
                        foreach ( $benefits as $benefit ):
                            ?>

                            <div class="col-xs-12 col-sm-6">
                                <div class="feature_panel">

                                    <div class="feature_panel_head">
                                        <div class="text-center" style="margin-bottom: 15px;">
                                            <img src="<?= base_url( $benefit['img'] ) ?>" alt="<?= $benefit['name'] ?>">
                                        </div>

                                        <h2 class="text-center"><?= $benefit['name'] ?></h2>
                                    </div>

                                    <div class="feature_panel_body">

                                        <div class="feature_panel_body_text"><?= $benefit['text'] ?></div>

                                    </div>

                                </div>
                            </div>

                            <?php
                            if ( $count % 2 == 0 ):
                                echo '<div class="clearfix"></div>';
                            endif;

                            $count++;
                        endforeach;
                        ?>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<script type="text/javascript">

    $( window ).on( 'load', function () {
        var feature_panels = $( ".feature_panel" ),
            max_height = 0;

        feature_panels.each( function ( i, d ) {
            var height = $( d ).outerHeight();

            if ( height > max_height ) {
                max_height = height;
            }
        } );

        feature_panels.outerHeight( max_height );
    } );

</script>