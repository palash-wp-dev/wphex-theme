<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package bytesed
 */
$bytesed = Bytesed();
$post_meta = get_post_meta(get_the_ID(),'bytesed_post_video_options',true);
$video_url = isset($post_meta['video_url']) && $post_meta['video_url'] ? $post_meta['video_url'] : '';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('blog-classic-item-01 margin-bottom-30'); ?>>
	<?php
	if (has_post_thumbnail()):
		?>
        <div class="thumbnail">
			<?php $bytesed->post_thumbnail(); ?>
			<?php if(!empty($video_url)): ?>
                <div class="hover">
                    <a href="<?php echo esc_url($video_url);?>" class="video-play-btn mfp-iframe"><i class="fas fa-play"></i></a>
                </div>
			<?php endif; ?>
        </div>
	<?php endif;?>
    <div class="content">
      <?php
        get_template_part('template-parts/common/post-meta');
        the_title( '<h2 class="title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
        get_template_part('template-parts/common/post-excerpt');
        ?>
    </div>
</article><!-- #post-<?php the_ID(); ?> -->
