<!-- Bootstrap JavaScript -->
<script src="<?= base_url( 'backend/bootstrap/js/bootstrap.min.js' ) ?>"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>backend/dist/css/ss-main.css">
      

<div class="control-sidebar-bg"></div>
</div>
<script type="text/javascript">
    jQuery( function ( $ ) {
        $( ".menu_toggle" ).click( function ( e ) {
            e.preventDefault();

            $( ".menu_container_inner_right, .menu_container_inner_left" ).slideToggle();
        } );


        // adjusting hero image on home page
        $( '.home_hero_container' ).outerHeight( $( window ).height() - ( $( ".logo_container" ).outerHeight() + $( ".menu_container" ).outerHeight() + $( ".home_footer" ).outerHeight() ) );
    } );
</script>
</body>
</html>