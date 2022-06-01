<?php
/**
 * The template part for displaying a message that posts cannot be found
 *
 * @package Litho
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div class="alert alert-warning" role="alert">
	<?php if ( is_search() ) : ?>
		<strong><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'litho' ); ?></strong>
	<?php else : ?>
		<strong><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'litho' ); ?></strong>
	<?php endif; ?>
</div>
