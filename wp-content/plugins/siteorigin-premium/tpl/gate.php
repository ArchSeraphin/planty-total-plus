<?php
if ( empty( $this->settings ) ) {
	die();
}
?>
<!DOCTYPE html>
<html lang="<?php echo esc_attr( get_bloginfo( 'language' ) ); ?>">
	<head>
		<title>
			<?php echo esc_html( apply_filters( 'siteorigin_premium_gate_title', $this->gate_setting( 'title' ) ) ); ?>
		</title>
		<?php do_action( 'siteorigin_premium_gate_head' ); ?>
		<?php
		if ( $force_gate ) {
			wp_head();
		}
		?>
		<style>
			body {
				align-items: flex-start !important;
				<?php if ( $this->gate_setting( 'background_color', 'body' ) ) { ?>
					background-color: <?php echo esc_html( $this->gate_setting( 'background_color', 'body' ) ); ?> !important;
				<?php } ?>


				display: flex !important;
				height: 100% !important;
				margin: 0 !important;

				<?php
				$alignment = $this->gate_setting( 'alignment', 'container' );
				if ( $alignment == 'center' ) {
					?>
					justify-content: center !important;
					<?php } elseif ( $alignment == 'right' ) { ?>
						justify-content: flex-end !important;
						<?php
				}
				?>


				&,
				.gate-content,
				.gate-content p,
				.gate-content strong {
					<?php if ( $this->gate_setting( 'color', 'text' ) ) { ?>
						color: <?php echo esc_html( $this->gate_setting( 'color', 'text' ) ); ?>;
						<?php
					}
					if ( $this->gate_setting( 'font', 'text' ) ) {
						$font = siteorigin_widget_get_font( $this->gate_setting( 'font', 'text' ) );
						if ( empty( $font['weight_raw'] ) ) {
							$font['weight_raw'] = 400;
						}

						if ( empty( $font['style'] ) ) {
							$font['style'] = 'normal';
						}

						echo $this->output_font_family( $font );
						?>
						font-style: <?php echo esc_html( $font['style'] ); ?>;
						font-weight: <?php echo esc_html( $font['weight_raw'] ); ?>;
						<?php
					}

					if ( $this->gate_setting( 'size', 'text' ) ) {
						?>
						font-size: <?php echo esc_html( $this->gate_setting( 'size', 'text' ) ); ?>;
					<?php } ?>
					line-height: 1.6;

				}

			}


			<?php
			if ( $this->gate_setting( 'background_image', 'body' ) ) {
				$src = siteorigin_widgets_get_attachment_image_src(
					$this->gate_setting( 'background_image', 'body' ),
					'full'
				);

				if ( ! empty( $src ) ) {
					$add_background = true;
					?>
					.gate-background {
						background-image: url( <?php echo esc_url( $src[0] ); ?> );
						background-repeat: no-repeat;
						background-size: cover;
						bottom: 0;
						left: 0;
						position: absolute;
						right: 0;
						top: 0;
						<?php if ( $this->gate_setting( 'background_image_opacity', 'body' ) ) { ?>
							opacity: 0.<?php echo esc_html( $this->gate_setting( 'background_image_opacity', 'body' ) ); ?> !important;
						<?php } ?>
					}
					<?php
				}
			}
			?>

			<?php if ( $this->gate_setting( 'link', 'text' ) ) { ?>
				a {
					color: <?php echo esc_html( $this->gate_setting( 'link', 'text' ) ); ?> !important !important;
				}
			<?php } ?>

			<?php if ( $this->gate_setting( 'link_hover', 'text' ) ) { ?>
				a:hover,
				a:focus {
					color: <?php echo esc_html( $this->gate_setting( 'link_hover', 'text' ) ); ?> !important;
				}
			<?php } ?>

			.gate-content {
				<?php
				if ( $this->gate_setting( 'background_color', 'container' ) ) {
					?>
					background-color: <?php echo esc_html( $this->gate_setting( 'background_color', 'container' ) ); ?> !important;
				<?php } ?>

				<?php
				if ( $this->gate_setting( 'border_radius', 'container' ) ) {
					?>
					border-radius: <?php echo esc_html( $this->gate_setting( 'border_radius', 'container' ) ); ?> !important;
				<?php } ?>

				<?php if ( ! empty( $box_shadow ) ) { ?>
					box-shadow: <?php echo esc_html( $box_shadow ); ?> !important;
				<?php } ?>

				<?php if ( $this->gate_setting( 'margin', 'container' ) ) { ?>
					margin: <?php echo esc_html( $this->gate_setting( 'margin', 'container' ) ); ?> !important;
				<?php } ?>

				<?php if ( $this->gate_setting( 'padding', 'container' ) ) { ?>
					padding: <?php echo esc_html( $this->gate_setting( 'padding', 'container' ) ); ?> !important;
				<?php } ?>

				<?php $width = $this->gate_setting( 'width', 'container' ); ?>
				width: min(100%, <?php echo esc_html( apply_filters(
					'siteorigin_gate_max_width',
					! empty( $max_width ) ? $max_width : '820px'
				) ); ?>) !important;

				z-index: 1;

				h1 {
					font-size: 32px !important;
					margin-block-start: 0 !important;
				}

				h1,
				h2,
				h3,
				h4,
				h5,
				h6 {
					<?php if ( $this->gate_setting( 'color', 'heading' ) ) { ?>
						color: <?php echo esc_html( $this->gate_setting( 'color', 'heading' ) ); ?>;
					<?php } ?>

					<?php
					if ( $this->gate_setting( 'font', 'heading' ) ) {
						$font = siteorigin_widget_get_font( $this->gate_setting( 'font', 'heading' ) );
						if ( empty( $font['weight_raw'] ) ) {
							$font['weight_raw'] = 400;
						}

						if ( empty( $font['style'] ) ) {
							$font['style'] = 'normal';
						}

						echo $this->output_font_family( $font );
						?>
						font-style: <?php echo esc_html( $font['style'] ); ?>;
						font-weight: <?php echo esc_html( $font['weight_raw'] ); ?>;
						<?php
					}
					?>

					<?php if ( $this->gate_setting( 'size', 'heading' ) ) { ?>
						font-size: <?php echo esc_html( $this->gate_setting( 'size', 'heading' ) ); ?>;
					<?php } ?>
				}
			}
			<?php do_action( 'siteorigin_premium_gate_css' ); ?>
		</style>
	</head>
	<body>
		<div class="gate-content">
			<?php
			do_action( 'siteorigin_premium_gate_content' )
			?>
		</div>
		<?php
		if ( class_exists( 'SiteOrigin_Panels_Styles' ) ) {
			$force_gate = SiteOrigin_Panels_Styles::register_scripts();
		}
		wp_print_scripts();
		wp_print_styles();
		if ( $force_gate ) {
			wp_footer();
		}
		do_action( 'siteorigin_premium_gate_footer' );

		if ( isset( $add_background ) ) {
			?>
			<div class="gate-background">&nbsp;</div>
			<?php
		}
		?>
	</body>
</html>
<?php
die();
