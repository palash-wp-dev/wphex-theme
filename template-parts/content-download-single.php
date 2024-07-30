<?php
/**
 * Template part for displaying single post
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package bytesed
 */
$bytesed = Bytesed();
//get current page url
$bytesed_url = urlencode_deep(get_permalink());
//get current page title
$bytesed_title =strip_tags( str_replace(' ','%20',get_the_title()));
//get post thumbnail for pinterest
$bytesed_thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'full');
$bytesed_thumbnail_url = is_array($bytesed_thumbnail) && !empty($bytesed_thumbnail[0]) ? $bytesed_thumbnail[0] : '';
//all social share link generate
$facebook_share_link = 'https://www.facebook.com/sharer/sharer.php?u='.$bytesed_url;
$twitter_share_link = 'https://twitter.com/intent/tweet?text='.$bytesed_title.'&amp;url='.$bytesed_url.'&amp;via=bytesed';
$linkedin_share_link = 'https://www.linkedin.com/shareArticle?mini=true&url='.$bytesed_url.'&amp;title='.$bytesed_title;
$pinterest_share_link = 'https://pinterest.com/pin/create/button/?url='.$bytesed_url.'&amp;media='.$bytesed_thumbnail_url.'&amp;description='.$bytesed_title;

//meta data
$demo_link = get_post_meta(get_the_ID(),'bytesed_demo_url',true);
$_rating = get_post_meta(get_the_ID(),'bytesed_rating',true);
$_rating = $_rating ? $_rating : 5;
$_rating_count = get_post_meta(get_the_ID(),'bytesed_rating_count',true);
$_rating_count = $_rating_count ? $_rating_count : 0;

?>

<div id="post-<?php the_ID(); ?>" <?php post_class('single-download-item'); ?>>
    <meta itemprop="name" content="<?php echo strip_tags(get_the_title());?>" />
      <?php
        if( !empty($bytesed_thumbnail)){
            printf('<link itemprop="image" href="%1$s" />',esc_url($bytesed_thumbnail[0]));
        }
      ?>
      
      <meta itemprop="description" content="<?php bytesed_excerpt(100);?>" />
      <div itemprop="aggregateRating" itemtype="http://schema.org/AggregateRating" itemscope>
        <meta itemprop="reviewCount" content="<?php echo esc_attr($_rating_count);?>" />
        <meta itemprop="ratingValue" content="<?php echo esc_attr($_rating);?>" />
      </div>
      <div itemprop="brand" itemtype="http://schema.org/Brand" itemscope>
        <meta itemprop="name" content="Bytesed" />
      </div>
    <?php
    if (has_post_thumbnail()):?>
        <div class="thumbnail">
		    <?php Bytesed()->post_thumbnail(); ?>
            <div class="bottom-content">
                <div class="live-preview">
                    <a href="<?php echo esc_url($demo_link);?>" target="_blank"><i class="fas fa-desktop"></i> <?php esc_html_e('Live Preview','bytesed');?></a>
                </div>
                <div class="social-share">
                    <ul>
                        <li class="title"><?php esc_html_e('Share:','bytesed');?></li>
                        <li><a href="<?php echo esc_url($facebook_share_link);?>"><i class="fab fa-facebook"></i></a></li>
                        <li><a href="<?php echo esc_url($twitter_share_link);?>"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="<?php echo esc_url($linkedin_share_link);?>"><i class="fab fa-linkedin"></i></a></li>
                        <li><a href="<?php echo esc_url($pinterest_share_link);?>"><i class="fab fa-pinterest"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    <?php endif;?>
    <div class="entry-content">
      <?php the_content(); ?>
    </div>

</div><!-- #post-<?php the_ID(); ?> -->
