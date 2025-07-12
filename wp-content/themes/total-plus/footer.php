<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
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

if (!$hide_footer) {
    $total_plus_footer_layout = get_theme_mod('total_plus_footer_layout', 'footer-style1');
    $total_plus_footer_col = get_theme_mod('total_plus_footer_col', 'col-3-1-1-1');
    $total_plus_footer_copyright = get_theme_mod('total_plus_footer_copyright', '&copy; 2020. All Right Reserved.');
    $total_plus_footer_array = explode('-', $total_plus_footer_col);
    $count = count($total_plus_footer_array);
    $footer_col = $count - 2;
    ?>

    <footer id="ht-colophon" class="ht-site-footer <?php echo esc_attr($total_plus_footer_layout . ' ' . $total_plus_footer_col) ?>">

        <?php if (is_active_sidebar('total-top-footer')): ?>
            <div class="ht-top-footer">
                <div class="ht-container">
                    <?php dynamic_sidebar('total-top-footer'); ?>
                </div>
            </div>
        <?php endif; ?>	

        <?php if (total_plus_check_active_footer()) { ?>
            <div class="ht-main-footer">
                <div class="ht-container">
                    <div class="ht-main-footer-wrap ht-clearfix">
                        <?php for ($i = 1; $i <= $footer_col; $i++) { ?>
                            <div class="ht-footer ht-footer<?php echo absint($i); ?>">
                                <?php
                                if (is_active_sidebar('total-footer' . $i)):
                                    dynamic_sidebar('total-footer' . $i);
                                endif;
                                ?>	
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>

        <?php if (!empty($total_plus_footer_copyright)) { ?>
            <div class="ht-bottom-footer">
                <div class="ht-container">
                    <div class="ht-site-info">
                        <?php echo do_shortcode($total_plus_footer_copyright); ?>
                    </div><!-- #site-info -->
                </div>
            </div>
        <?php } ?>
    </footer><!-- #colophon -->
<?php }
?>
</div><!-- #page -->

<?php
$backtotop = get_theme_mod('total_plus_backtotop', true);
if ($backtotop) {
    ?>
    <div id="ht-back-top" class="ht-hide"><i class="icofont-simple-up"></i></div>
        <?php
    }
    wp_footer();
    ?>
</body>
</html>
