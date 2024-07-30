<?php
$bytesed = Bytesed();
$post_meta = get_post_meta(get_the_ID(),'bytesed_post_gallery_options',true);
$post_meta_gallery = isset($post_meta['gallery_images']) && !empty($post_meta['gallery_images']) ? $post_meta['gallery_images'] : '';
$gallery_image = explode(',',$post_meta_gallery);
$blog_single_options = Bytesed_Group_Fields_Value::post_meta('blog_single_post');
?>
<?php
if ( isset($post_meta['gallery_images']) && !empty($post_meta['gallery_images']) ):
	?>
	<div id="bytesed_post_gallery" class="carousel slide thumb" data-ride="carousel">
		<ol class="carousel-indicators">
			<?php
			for ($i =0; $i < count($gallery_image); $i++){
				$class = 0 == $i ? 'active' : '';
				printf('<li data-target="#bytesed_post_gallery" data-slide-to="%2$s" class="%1$s"></li>',esc_attr($i),esc_attr($class));
			}
			?>
		</ol>
		<div class="carousel-inner">
			<?php
			for ($i=0; $i < count($gallery_image); $i++):
				$class = 0 == $i ? 'active' : '';
				$img_src = wp_get_attachment_image_src($gallery_image[$i],'bytesed_classic');
				$img_alt = get_post_meta($gallery_image[$i],'wp_attachment_image_alt',true);
				?>
				<div class="carousel-item <?php echo esc_attr($class);?>">
					<img class="d-block w-100" src="<?php echo esc_url($img_src[0]);?>" alt="<?php echo esc_attr($img_alt);?>">
				</div>
			<?php endfor; ?>
		</div>
		<a class="carousel-control-prev" href="#bytesed_post_gallery" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
		</a>
		<a class="carousel-control-next" href="#bytesed_post_gallery" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
		</a>
	</div>
<?php
else:
	if ( has_post_thumbnail() ):
		?>
		<div class="thumb">
			<?php $bytesed->post_thumbnail(); ?>
		</div>
	<?php
	endif;
endif;
?>