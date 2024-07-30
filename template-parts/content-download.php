<?php
/**
 * Template part for displaying single post
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package bytesed
 */
$bytesed = Bytesed();
$img_id = get_post_thumbnail_id(get_the_ID()) ? get_post_thumbnail_id(get_the_ID()) : false ;
$img_url_val = $img_id ? wp_get_attachment_image_src($img_id,'full',false) : '';
$img_url = is_array($img_url_val) && !empty($img_url_val) ? $img_url_val[0] : '';
$img_alt =  $img_id ? get_post_meta($img_id,'_wp_attachment_image_alt',true) : '';

//download metabox
$_cut_price = get_post_meta(get_the_ID(),'bytesed_cut_price',true);
$_rating = get_post_meta(get_the_ID(),'bytesed_rating',true);
$_rating = !empty($_rating) ? $_rating : '';
$_rating_count = get_post_meta(get_the_ID(),'bytesed_rating_count',true);
$demo_url = get_post_meta(get_the_ID(),'bytesed_demo_url',true);
$product_type = get_post_meta(get_the_ID(),'bytesed_type',true);
$envato_product_id = get_post_meta(get_the_ID(),'bytesed_envato_product_id',true);
$average_rating = !empty($_rating) ? ($_rating * 100 ) / 5 : 0;
?>
<!-- Products area start -->
<div class="col-lg-4 col-sm-6 wow zoomIn" data-wow-delay=".1s">
    <div class="single_products">
        <div class="single_products__thumb">
            <a href="<?php the_permalink(); ?>">
                <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $img_alt ); ?>">
            </a>
        </div>
        <div class="single_products__contents">
            <h4 class="single_products__title"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h4>
        </div>
    </div>
</div>
<!-- Products area end -->




