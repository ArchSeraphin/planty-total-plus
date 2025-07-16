<?php
/**
 * The template for displaying the footer.
 *
 * @package Total Plus
 */
?>

</div><!-- #content -->

<?php
if (is_singular(array('post', 'page', 'product', 'portfolio'))) {
    $hide_footer = rwmb_meta('hide_footer');
} else {
    $hide_footer = '';
}

if (!$hide_footer) :
?>

<footer id="footer-new" class="ht-site-footer custom-footer">

    <!-- Mentions légales -->
    <div class="footer-mentions">
        <p><a href="<?php echo esc_url(home_url('/mentions-legales')); ?>">Mentions légales</a></p>
    </div>

</footer><!-- #colophon -->

<?php endif; ?>

</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
