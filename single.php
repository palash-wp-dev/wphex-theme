<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package bytesed
 */

get_header();
$page_layout_meta = Bytesed_Group_Fields_Value::page_layout_options('blog_single');

?>
    <div id="primary" class="content-area blog-details-page padding-120 primary-custom">
        <main id="main" class="site-main">
            <div class="container">
                <div class="row">
                    <div class="<?php echo esc_attr($page_layout_meta['content_column_class']);?>">
						<?php
						while ( have_posts() ) :
							the_post();
							get_template_part( 'template-parts/content', 'single' );
							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() || get_option( 'thread_comments' )) :
								comments_template();
							endif;
						endwhile; // End of the loop.
						?>
                    </div>
					<?php if ($page_layout_meta['sidebar_enable']): ?>
                        <div class="<?php echo esc_attr($page_layout_meta['sidebar_column_class']);?>">
							<div class="wphex__stickyBar">
								
                        <?php $checkkss = get_post_meta( get_the_ID(), 'wphex_framework-metabox-field', true ); if( isset($checkkss['search-box-show-hide'] ) && $checkkss['search-box-show-hide'] === '1' ) : ?>
                        <div class="blog_details__sidebar__item">
                        <div class="blog_details__sidebar__tableContent__head">
                            <h4 class="blog_details__sidebar__tableContent__title"><?php echo esc_html( $checkkss['search-section-title'] ); ?></h4>
                        </div>
                            <div class="blog_details__sidebar__search">
                                <form method="get" action="<?php esc_url(home_url('/'))?>">
                                    <input class="form--control" type="text" placeholder="<?php esc_attr__('Search...', 'text-domain') ?>" value="<?php get_search_query() ?>" name="s">
                                    <span class="blog_details__sidebar__search__icon"><i class="fa-solid fa-search"></i></span>
                                </form>
                            </div>
                        </div>
                        <?php endif; ?>
						<?php $meta_csf = get_post_meta( get_the_ID(), 'wphex_framework-metabox-field', true ); ?>
								<?php if( isset($meta_csf['tba-meta-field']) && !empty($meta_csf['tba-meta-field']) ) : ?>
                                <div class="blog_details__sidebar__item tba">
                                    <div class="blog_details__sidebar__tableContent">
                                        <div class="blog_details__sidebar__tableContent__head">
                                            <h4 class="blog_details__sidebar__tableContent__title"><?php echo esc_html( $checkkss['tba-section-title'] ); ?></h4>
                                        </div>
                                        <div class="blog_details__sidebar__tableContent__list">
                                        <?php
                                        if( !empty( $meta_csf['tba-meta-field'] ) ) {
                                         foreach ($meta_csf['tba-meta-field'] as $repeater_value) {
                                            $meta_field_title = $repeater_value['meta-field-title'];
                                            $meta_field_id = strtolower($repeater_value['meta-field-id']);
                                            $meta_field_id = str_replace(' ','-',$meta_field_id);
                                        ?>
                                             <h3 class="blog_details__sidebar__tableContent__list__item"><a href="#<?php echo esc_attr( $meta_field_id );?>"><?php echo esc_html( $meta_field_title ); ?></a></h3>
                                        <?php } } ?>
                                        </div>
                                    </div>
                                </div>
								<?php endif; ?>


                                <!-- Pricing section -->
                                <?php if( isset( $checkkss['pricing-box-show-hide'] ) && $checkkss['pricing-box-show-hide'] === '1' ) : ?>
                                    <div class="discount-rules-woocommerce">
                                        <div class="discount-parent-wraper">
                                            <h3 class="head3"><?php echo esc_html__( $checkkss['pricing-section-title'] ); ?></h3>
                                            <div class="reviews">
                                                <?php if ( $checkkss['pricing-section-rating'] ) : ?>
                                                <span class="icon"><i class="las la-star"></i></span>
                                                <span class="text"><?php echo esc_html__( $checkkss['pricing-section-rating'] ); ?> (<span class="review-number"><?php echo esc_html__( $checkkss['pricing-section-reviews'] ); ?></span>)</span>
                                                <?php endif; ?>
                                            </div>


                                            <div class="price">
                                                <span class="money"><?php echo esc_html__( $checkkss['pricing-section-pricing'] ); ?></span>
                                                <span><?php echo esc_html__( $checkkss['pricing-section-year'] ); ?></span>
                                            </div>
                                            <div class="subscription-option">
                                                <div class="head4"><?php echo esc_html__( $checkkss['pricing-subscription-text'] ); ?></div>
                                                <form action="#" method="get" class="subscription-option-form">
                                                    <div class="options mb-3">
                                                        <input type="radio" id="opt1" name="subscription-option" value="SINGLE SITE" data-price="<?php echo esc_html__( $checkkss['pricing-section-pricing'] ); ?>" checked>
                                                        <label for="opt1">SINGLE SITE</label>
                                                    </div>
                                                    <div class="options mb-3">
                                                        <input type="radio" id="opt2" name="subscription-option" value="5 SITE" data-price="<?php echo esc_html__( $checkkss['pricing-section-pricing2'] ); ?>">
                                                        <label for="opt2">5 SITE</label>
                                                    </div>
                                                    <div class="options">
                                                        <input type="radio" id="opt3" name="subscription-option" value="25 SITE" data-price="<?php echo esc_html__( $checkkss['pricing-section-pricing3'] ); ?>">
                                                        <label for="opt3">25 SITE</label>
                                                    </div>
                                                    <button class="add-to-cart-btn"><i class="las la-shopping-cart"></i> <?php echo esc_html__( $checkkss['add-to-cart-text'] ); ?></button>
                                                </form>
                                            </div>

                                            <script>
                                                jQuery(document).ready(function($) {
                                                    // Function to update the price based on the selected radio button
                                                    function updatePrice() {
                                                        var selectedPrice = $('input[name="subscription-option"]:checked').data('price');
                                                        $('.money').text(selectedPrice);
                                                    }

                                                    // Initial price update based on the default checked radio button
                                                    updatePrice();

                                                    // Update price when a radio button is changed
                                                    $('input[name="subscription-option"]').change(function() {
                                                        updatePrice();
                                                    });
                                                });

                                            </script>




                                            <div class="additional-link">
                                                <?php if( $checkkss['free-version-link-text'] ) : ?>
                                                <a href="<?php echo esc_url( $checkkss['free-version-link']['url'] ); ?>"><span><?php echo esc_html__( $checkkss['free-version-link-text'] ); ?></span><span><i class="las la-arrow-right"></i></span></a>
                                                <?php endif; ?>

                                                <?php if( $checkkss['paid-version-link-text'] ) : ?>
                                                <a href="<?php echo esc_url( $checkkss['paid-version-link']['url'] ); ?>"><span><?php echo esc_html__( $checkkss['paid-version-link-text'] ); ?></span><span><i class="las la-arrow-right"></i></span></a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <?php if( $checkkss['money-back-guarantee-text'] ) : ?>
                                        <div class="money-back-gurrenty">
                                            <div class="img">
                                                <svg width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <rect width="48" height="48" rx="24" fill="#4FC467"/>
                                                    <path d="M30.2668 18.6667C30.0014 17.9137 29.5168 17.2573 28.8752 16.782C28.2336 16.3068 27.4645 16.0344 26.6668 16H21.3335C20.2726 16 19.2552 16.4214 18.5051 17.1716C17.7549 17.9217 17.3335 18.9391 17.3335 20C17.3335 21.0609 17.7549 22.0783 18.5051 22.8284C19.2552 23.5786 20.2726 24 21.3335 24H26.6668C27.7277 24 28.7451 24.4214 29.4953 25.1716C30.2454 25.9217 30.6668 26.9391 30.6668 28C30.6668 29.0609 30.2454 30.0783 29.4953 30.8284C28.7451 31.5786 27.7277 32 26.6668 32H21.3335C20.5358 31.9656 19.7667 31.6932 19.1251 31.218C18.4836 30.7427 17.9989 30.0863 17.7335 29.3333M24.0002 12V16M24.0002 32V36" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            </div>
                                            <div class="text">
                                                <?php echo esc_html__( $checkkss['money-back-guarantee-text'], 'wphex-master' ); ?>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
							<?php get_sidebar();?>
                        </div>							
					</div>
					<?php endif; ?>
                </div>
            </div>
        </main><!-- #main -->
    </div><!-- #primary -->
<?php
get_footer();
