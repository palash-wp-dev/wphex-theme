<?php
/**
 * Template part for displaying single post
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package bytesed
 */
$bytesed = Bytesed();
$post_meta = get_post_meta(get_the_ID(),'bytesed_post_gallery_options',true);
$post_meta_gallery = isset($post_meta['gallery_images']) && !empty($post_meta['gallery_images']) ? $post_meta['gallery_images'] : '';
$post_single_meta = Bytesed_Group_Fields_Value::post_meta('blog_single_post');
$author_name = get_the_author_meta( 'nicename' );
$blog_date = get_the_date("F d, Y");
$blog_time = get_the_time();
$post_url = get_permalink();
?>

<?php if ('post' == get_post_type()):?>
<div class="col-xl-11 col-lg-11">
    <div class="blog_details">
       
        <div class="blog_details__single">
            <div class="blog_details__single__thumb wow zoomIn" data-wow-delay=".1s">
                <?php
                if (has_post_thumbnail() || !empty($post_meta_gallery) ):
                    $get_post_format = get_post_format();
                    if ('video' == $get_post_format || 'gallery' == $get_post_format){
                        get_template_part('template-parts/common/thumbnail',$get_post_format);
                    }else{
                        get_template_part('template-parts/common/thumbnail');
                    }
                endif;
                ?>
            </div>
            <div class="blog_details__flex mt-3">
                <div class="blog_details__author">
                    <div class="blog_author_wrap">
                        <div class="thumb">
                            <?php echo get_avatar(  get_the_author_meta( 'ID' ), 32); ?> 
                        </div>
                        <h4 class="blog_details__author__title"><?php echo esc_html( $author_name ); ?></h4>
                    </div>
                    <ul class="blog_details__author__list">
                        <li class="blog_details__author__list__item date">
                            <?php echo esc_html__("Last Updated:","wphex"); ?><a href="<?php echo esc_html($post_url)?>" class="blog_details__author__list__item__link"> <?php echo esc_html( $blog_date ); ?></a>
                        </li>
                        <li class="blog_details__author__list__item cat">
                            <?php the_category(', ')?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="blog_details__single">
            <p class="blog_details__single__para mt-3"><?php the_content(); ?></p>
        </div>
    </div>
</div>
<?php
endif;

$bytesed->link_pages();
?>

<?php if ( 'post' == get_post_type() && ((has_tag() && $post_single_meta['posted_tag']) || (shortcode_exists('bytesed_post_share') && $post_single_meta['posted_share']) )):?>
<div class="blog-details-footer">
    <?php if(has_tag() && $post_single_meta['posted_tag']): ?>
    <div class="left">
        
    </div>
    <?php endif; ?>
    <div class="right">
        <?php
        if (shortcode_exists('bytesed_post_share') && $post_single_meta['posted_share']){
            echo do_shortcode('[bytesed_post_share]');
        }
        ?>
    </div>
</div>
<?php endif;?>

