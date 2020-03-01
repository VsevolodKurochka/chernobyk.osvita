<?php
add_action( 'wp_footer', 'mycustom_wp_footer' );
function mycustom_wp_footer() {
?>
<script type="text/javascript">
    document.addEventListener( 'wpcf7mailsent', function( event ) {
        $('#modal-form').removeClass('modal_showing_in');
        $('#modal-thx').addClass('modal_showing_in');
    }, false );
</script>
<?php } ?>