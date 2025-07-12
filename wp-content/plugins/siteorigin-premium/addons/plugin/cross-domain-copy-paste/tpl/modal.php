<?php
return sprintf(
	'<strong>%s</strong>',
	esc_html__( 'Update to Cross-Domain Copy Paste', 'siteorigin-premium' )
) . "\n" .
// Intro.
sprintf(
	'<p>%s</p>',
	esc_html__( "We've recently updated how the Cross-Domain Copy Paste feature works.", 'siteorigin-premium' )
) . "\n" .
// Reason for change.
sprintf(
	'<p>%s</p>',
	esc_html__( "The 'Browser Storage' method has been removed. Unfortunately, this method had become increasingly unreliable due to ongoing browser efforts to enhance user privacy by restricting third-party data access.", 'siteorigin-premium' )
) . "\n" .
sprintf(
	'<p>%s</p>',
	esc_html__( "Going forward, the 'Clipboard' method will be the sole option for copying and pasting content between domains using this add-on. This change ensures more consistent functionality within the evolving browser landscape.", 'siteorigin-premium' )
) . "\n" .
// How-to headline.
sprintf(
	'<strong>%s</strong>',
	esc_html__( 'How the Clipboard Method Works:', 'siteorigin-premium' )
) . "\n" .
// How-to list items (building the list inline).
sprintf(
	'<ol><li>%s</li><li>%s</li><li>%s</li></ol>',
	esc_html__( "On your source site, right-click the Page Builder row or widget you want to copy and select 'Copy Row' or 'Copy Widget'.", 'siteorigin-premium' ),
	esc_html__( "On your destination site, scroll down below the main content editor to the 'SiteOrigin Premium' meta box and find the 'Cross Domain Copy Paste' tab. Paste your copied data into the field provided there.", 'siteorigin-premium' ),
	esc_html__( 'You can then return to the Page Builder editor above and right-click to paste the row or widget into your layout.', 'siteorigin-premium' )
) . "\n" .
// Documentation link.
sprintf(
	'<p>%s</p>',
	sprintf(
		esc_html__( 'For more detailed instructions and visuals, please refer to the %sCross Domain Copy Paste addon documentation%s.', 'siteorigin-premium' ),
		'<a href="' . esc_url( 'https://siteorigin.com/premium-documentation/plugin-addons/cross-domain-copy-paste/' ) . '" target="_blank" rel="noopener noreferrer">',
		'</a>'
	)
) . "\n" .
// Support email.
sprintf(
	'<p>%s</p>',
	sprintf(
		/* translators: %s: Mailto link for support email address. */
		esc_html__( 'If you have any questions, please email us at %s.', 'siteorigin-premium' ),
		sprintf( '<a href="mailto:%1$s">%1$s</a>', esc_attr( 'support@siteorigin.com' ) )
	)
);
