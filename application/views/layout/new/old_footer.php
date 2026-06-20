<div class="new_footer">
    <div class="pull-right">
        <img src="<?= base_url( 'backend/images/tecnogat-logo-white.png' ) ?>">
    </div>
</div>

<script type="text/javascript">
    jQuery( function ( $ ) {
        var window_height = $( window ).height(),
            body_height = $( 'body' ).height(),
            header_height = $( '.new_header' ).outerHeight(),
            footer_height = $( '.new_footer' ).outerHeight();

        if ( window_height > body_height ) {
            var content_custom_height = window_height - header_height - footer_height;
            $( '.content_with_custom_height' ).height( content_custom_height );

            $('.vertical_center_content').css({
                position: 'relative',
                top: '50%',
                transform: 'translateY(-50%)'
            });
        }
    } );
</script>

<!-- Bootstrap JavaScript -->
<script src="<?= base_url( 'backend/bootstrap/js/bootstrap.min.js' ) ?>"></script>
</body>
</html>