<?php
$bytesed = Bytesed();
$post_meta = get_post_meta(get_the_ID(),'bytesed_post_video_options',true);
$video_url = isset($post_meta['video_url']) && $post_meta['video_url'] ? $post_meta['video_url'] : '';
$blog_single_options = Bytesed_Group_Fields_Value::post_meta('blog_single_post');
if(!empty($video_url)):
	?>
	<div class="thumbnail">
		<?php $bytesed->post_thumbnail(); ?>
		<?php if(!empty($video_url)): ?>
			<div class="hover">
				<a href="<?php echo esc_url($video_url);?>" class="video-play-btn mfp-iframe"><i class="fas fa-play"></i></a>
			</div>
		<?php endif; ?>
	</div>
<?php endif; ?>
