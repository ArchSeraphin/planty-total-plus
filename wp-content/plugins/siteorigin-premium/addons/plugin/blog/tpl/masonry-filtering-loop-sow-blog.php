<?php
$types = null;

if ( $settings['categories'] || $template_settings['filter_categories'] ) {
	if ( method_exists( 'SiteOrigin_Widget_Blog_Widget', 'get_query_terms' ) ) {
		$terms = SiteOrigin_Widget_Blog_Widget::get_query_terms( $instance, $query, get_the_ID() );
	} else {
		$terms = SiteOrigin_Widget_Blog_Widget::portfolio_get_terms( $instance, get_the_ID() );
	}

	if ( ! is_wp_error( $terms ) && ! empty( $terms ) ) {
		$filtering_links = array();

		foreach ( $terms as $term ) {
			$filtering_links[] = sanitize_html_class(
				is_object( $term ) ? $term->slug : $term
			);
		}
		$filtering = join( ', ', $filtering_links );
		$types = $filtering ? join( ' ', $filtering_links ) : ' ';
	}
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'sow-masonry-filtering-item ' . $types ); ?>>
	<?php SiteOrigin_Widget_Blog_Widget::post_featured_image( $settings ); ?>
	<?php
	SiteOrigin_Widget_Blog_Widget::content_wrapper(
		$settings,
		array(
			'padding' => '25px 30px 33px',
		)
	);
	?>
		<header class="sow-entry-header">
			<?php SiteOrigin_Widget_Blog_Widget::generate_post_title( $settings ); ?>
			<div class="sow-entry-meta">
				<?php SiteOrigin_Widget_Blog_Widget::post_meta( $settings ); ?>
			</div>
		</header>

		<?php SiteOrigin_Widget_Blog_Widget::output_content( $settings ); ?>
	</div>
</article>
