<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package bytesed
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content">
		<?php
		the_content();

		Bytesed()->link_pages();
		?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
