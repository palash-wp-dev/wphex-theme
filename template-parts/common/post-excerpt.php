<?php
$bytesed = Bytesed();
$post_meta = Bytesed_Group_Fields_Value::post_meta('blog_post');
$excerpt_length = !empty($post_meta['excerpt_length']) ? $post_meta['excerpt_length'] : 25;
$readmore_text = !empty($post_meta['readmore_btn_text']) ? $post_meta['readmore_btn_text'] : esc_html__('Read More','bytesed');
bytesed_excerpt($excerpt_length);
if($post_meta['readmore_btn']){
	printf('<a href="%1$s" class="readmore"> %2$s </a>',get_the_permalink(),esc_html($readmore_text));
}
?>