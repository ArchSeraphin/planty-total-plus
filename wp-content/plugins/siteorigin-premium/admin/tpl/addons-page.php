<?php
/**
 * @var string $filter
 * @var string $action_url
 * @var array  $addons
 */
?>

<div class="wrap siteorigin-premium-wrap" id="siteorigin-premium-addons">

	<div class="page-header">
		<div class="so-premium-icon-wrapper">
			<img src="<?php echo SiteOrigin_Premium::dir_url( __FILE__ ); ?>../img/page-icon.png" class="so-premium-icon" />
		</div>
		<h1><?php esc_html_e( 'SiteOrigin Premium Addons', 'siteorigin-premium' ); ?></h1>

		<input type="search" class="addons-search" name="search" placeholder="<?php esc_html_e( 'Search Addons', 'siteorigin-premium' ); ?>" />

		<ul class="page-sections">
			<?php
			$sections = array(
				'' => __( 'All Addons', 'siteorigin-premium' ),
				'plugin' => __( 'Plugin Addons', 'siteorigin-premium' ),
				'theme' => __( 'Theme Addons', 'siteorigin-premium' ),
			);

			foreach ( $sections as $section_id => $section_title ) {
				?>
				<li
				<?php
				if ( $filter == $section_id ) {
					echo 'class="active-section"';
				}
				?>
				>
					<a href="#" data-section="<?php echo esc_attr( $section_id ); ?>">
						<?php echo esc_html( $section_title ); ?>
					</a>
				</li>
				<?php
			}
			?>
		</ul>

	</div>

	<div id="addons-list" data-action-url="<?php echo esc_url( $action_url ); ?>">

		<?php
		foreach ( $addons as $section_id => $section_addons ) {
			foreach ( $section_addons as $addon ) {
				$section_details = apply_filters( 'siteorigin_premium_addon_section_link-' . $addon['ID'], array() );
				?>
				<div class="so-addon-wrap">
					<div
						class="so-addon so-addon-is-<?php echo $addon['Active'] ? 'active' : 'inactive'; ?>"
						data-id="<?php echo esc_attr( $addon['ID'] ); ?>"
						data-section="<?php echo esc_attr( $section_id ); ?>"
						<?php if ( ! empty( $section_details ) && ! empty( $section_details['show_settings_on_activation'] ) ) { ?>
							data-show-settings-on-activate="true"
						<?php } ?>
					>

						<?php
						$banner = '';
						if ( file_exists( SiteOrigin_Premium::dir_path( $addon['File'] ) . 'assets/banner.png' ) ) {
							$banner = SiteOrigin_Premium::dir_url( $addon['File'] ) . 'assets/banner.png';
						} elseif ( file_exists( SiteOrigin_Premium::dir_path( $addon['File'] ) . 'assets/banner.svg' ) ) {
							$banner = SiteOrigin_Premium::dir_url( $addon['File'] ) . 'assets/banner.svg';
						}
						$banner = apply_filters( 'siteorigin_premium_addon_banner', $banner, $addon );
						?>

						<?php if ( ! empty( $addon['Video'] ) ) { ?>
							<div class="js-modal-video" data-video-id="<?php echo esc_attr( $addon['Video'] ); ?>" style="display:inline-block; white-space:nowrap;">
						<?php } ?>
							<div class="so-addon-banner" data-seed="<?php echo esc_attr( substr( md5( $addon['ID'] ), 0, 6 ) ); ?>">
								<?php if ( ! empty( $banner ) ) { ?>
									<img src="<?php echo esc_url( $banner ); ?>" />
								<?php } ?>
							</div>
						<?php if ( ! empty( $addon['Video'] ) ) { ?>
								<div class="so-play-icon"></div>
							</div>
						<?php } ?>

						<div class="so-addon-text">

							<div class="so-addon-active-indicator"><?php esc_html_e( 'Active', 'siteorigin-premium' ); ?></div>

							<h3 class="so-addon-name"><?php echo esc_html( $addon['Name'] ); ?></h3>

							<?php
							$addon_links = apply_filters( 'siteorigin_premium_addon_action_links-' . $addon['ID'], array() );

							if ( ! empty( $addon_links ) ) {
								echo '<div class="so-addon-links">';
								echo implode( ' | ', $addon_links );
								echo '</div>';
							}
							?>

							<div class="so-addon-description">
								<?php echo wp_kses_post( $addon['Description'] ); ?>
							</div>

							<?php
							if ( ! empty( $addon['Tags'] ) ) {
								$tags = array_map( 'trim', explode( ',', $addon['Tags'] ) );
								?>
								<ul class="so-addon-tags">
								<?php
								foreach ( $tags as $tag ) {
									?>
									<li>
										<a href="#" data-tag="<?php echo esc_attr( strtolower( $tag ) ); ?>">
											<?php echo esc_html( $tag ); ?>
										</a>
									</li>
									<?php
								}
								?>
								</ul>
								<?php
							}
							?>

							<div class="so-addon-action-links">
								<?php if ( ! empty( $addon['CanEnable'] ) ) { ?>
									<div class="so-addon-toggle-active">
										<button class="button-secondary so-addon-activate" data-status="1"><?php esc_html_e( 'Activate', 'siteorigin-premium' ); ?></button>
										<button class="button-secondary so-addon-deactivate" data-status="0"><?php esc_html_e( 'Deactivate', 'siteorigin-premium' ); ?></button>
									</div>
								<?php } ?>

								<?php if ( ! empty( $addon['has_settings'] ) ) { ?>
									<button class="button-secondary so-addon-settings" data-form-url="<?php echo esc_url( $addon['form_url'] ); ?>"
									<?php
									if ( empty( $addon['Active'] ) ) {
										echo ' style="display: none;"';
									}
									?>
									>
										<?php esc_html_e( 'Settings', 'siteorigin-premium' ); ?>
									</button>
								<?php } ?>

								<?php
								if (
									! empty( $section_details ) &&
									! empty( $section_details['url'] ) &&
									! empty( $section_details['label'] )
								) {
									?>
									<a href="<?php echo esc_url( $section_details['url'] ); ?>" class="so-section-link button-secondary">
										<?php echo esc_html( $section_details['label'], 'siteorigin-premium' ); ?>
									</a>
									<?php
								}
								?>
								<?php do_action( 'siteorigin_premium_addons_action_links', $addon ); ?>

								<?php if ( ! empty( $addon['Documentation'] ) ) { ?>
									<a href="<?php echo esc_url( $addon['Documentation'] ); ?>" target="_blank" rel="noopener noreferrer" class="so-section-documentation-link">
										<?php esc_html_e( 'Documentation', 'siteorigin-premium' ); ?>
									</a>
								<?php } ?>
							</div>

						</div>

					</div>
				</div>
			<?php } ?>
		<?php } ?>

		<div class="clear"></div>

	</div>

	<?php if ( ! class_exists( 'SiteOrigin_Panels' ) ) { ?>
		<div class="installer">
			<a href="#" class="installer-link">
				<?php esc_html_e( 'General Premium Settings', 'siteorigin-premium' ); ?>
			</a>

			<div class="installer-container" style="display: none;">
				<label>
					<?php esc_html_e( 'Enable SiteOrigin Installer: ', 'siteorigin-premium' ); ?>
					<input
						type="checkbox"
						name="installer_status"
						class="installer_status"
						<?php checked( get_option( 'siteorigin_installer', true ), 1 ); ?>
						data-nonce="<?php echo wp_create_nonce( 'siteorigin_installer_status' ); ?>"
					>
				</label>
			</div>
		</div>
	<?php } ?>

	<div class="siteorigin-logo">
		<p>
			<?php esc_html_e( 'Proudly Created By', 'siteorigin-premium' ); ?>
		</p>
		<a href="https://siteorigin.com/" target="_blank" rel="noopener noreferrer">
			<img src="<?php echo SiteOrigin_Premium::dir_url( __FILE__ ); ?>../img/siteorigin.png" />
		</a>
	</div>

	<div id="siteorigin-premium-settings-dialog">
		<div class="so-overlay"></div>

		<div class="so-title-bar">
			<h3 class="so-title"><?php esc_html_e( 'Addon Settings', 'siteorigin-premium' ); ?></h3>
			<a class="so-close">
				<span class="so-dialog-icon"></span>
			</a>
		</div>

		<div class="so-content so-loading">
		</div>

		<div class="so-toolbar">
			<div class="so-buttons">
				<button type="button" class="button-primary so-save">
					<?php
					if ( class_exists( 'SiteOrigin_Widgets_Bundle' ) ) {
						esc_html_e( 'Save', 'siteorigin-premium' );
					} else {
						esc_html_e( 'Close', 'siteorigin-premium' );
					}
					?>
				</button>
			</div>
		</div>
	</div>

	<iframe id="so-premium-addon-settings-save" name="so-premium-addon-settings-save"></iframe>

	<div class="modal-video" tabindex="-1" role="dialog" style="display: none;">
		<div class="modal-video-body">
			<div class="modal-video-inner">
				<div class="modal-video-movie-wrap" style="padding-bottom:56.25%">
					<button class="modal-video-close-btn js-modal-video-dismiss-btn" aria-label="Close the modal by clicking here"></button>
				</div>
			</div>
		</div>
	</div>

</div>
