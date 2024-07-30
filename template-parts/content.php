<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package bytesed
 */
$bytesed = Bytesed();

$blog_date = get_the_date('d M y');
$blog_time = get_the_time();
$post_tags = get_the_tags();
$author = get_the_author_meta('nicename');
$post_tags_1 = ! empty( $post_tags[0]->name ) ? $post_tags[0]->name : '';
$post_tags_2 = ! empty( $post_tags[1]->name ) ? $post_tags[1]->name : '';
?>


<div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay=".1s">
    <div class="single_blog">
        <div class="single_blog__thumb">
            <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
        </div>
        <div class="single_blog__contents mt-3">
            <div class="single_blog__tag">
                <div class="single_blog__tag__item">
                    <?php if ( $post_tags ) : ?>
                        <a href="<?php echo the_permalink(); ?>" class="single_blog__tag__link"><?php echo esc_html( $post_tags_1 ); ?></a>
                        <a href="<?php echo the_permalink(); ?>" class="single_blog__tag__link"><?php echo esc_html( $post_tags_2 ); ?></a>
                    <?php endif; ?>
                </div>
                <div class="single_blog__tag__list">
                    <a href="<?php echo the_permalink(); ?>" class="single_blog__tag__list__item"><?php echo esc_html( $author ); ?></a>
                    <a href="<?php echo the_permalink(); ?>" class="single_blog__tag__list__item"><?php echo esc_html( $blog_date ); ?></a>
                </div>
            </div>
            <h4 class="single_blog__title mt-3"><a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a></h4>
        </div>
    </div>
</div>



