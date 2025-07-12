<?php
$tag = SiteOrigin_Premium_Utility::single()->validate_tag( $settings['item_title_tag'], 'h3' );

while ( $settings['posts']->have_posts() ) {
	$settings['posts']->the_post();
	?>
	<div class="sow-carousel-item<?php
		if ( $settings['link_overlay'] ) {
			echo ' sow-carousel-item-link-overlay';
		}
	?>">
		<?php SiteOrigin_Premium_Plugin_Carousel::post_featured_image( $settings ); ?>

		<div class="sow-carousel-item-inner">
			<<?php echo esc_attr( $tag ); ?>
				class="sow-carousel-item-title"
				id="sow-carousel-id-<?php echo the_ID(); ?>"
			>
				<a href="<?php echo esc_url( get_the_permalink() ); ?>">
					<?php echo esc_html( get_the_title() ); ?>
				</a>
			</<?php echo esc_attr( $tag ); ?>>

			<?php
			if ( $settings['post_meta_placement'] === 'below_title' ) {
				SiteOrigin_Premium_Plugin_Carousel::post_meta( $settings );
			}
			SiteOrigin_Premium_Plugin_Carousel::output_content( $settings );
			SiteOrigin_Premium_Plugin_Carousel::generate_readmore( $settings );
			?>
		</div>

		<?php if ( $settings['link_overlay'] ) { ?>
			<a
				href="<?php the_permalink(); ?>"
				<?php echo $settings['link_target'] == 'new' ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>
				tabindex="-1"
				aria-labelledby="sow-carousel-id-<?php echo the_ID(); ?>"
				class="sow-carousel-overlay"
			>
				&nbsp;
			</a>
		<?php } ?>
	</div>
<?php
}
wp_reset_postdata();
