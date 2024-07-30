<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package bytesed
 */
$bytesed = Bytesed();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('blog-classic-item-01 margin-bottom-30'); ?>>

    <div class="quote-post-type">
	    <?php
	    the_title( '<h2 class="title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
	    ?>
    </div>
</article><!-- #post-<?php the_ID(); ?> -->
