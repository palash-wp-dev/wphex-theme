<?php
/**
 * The template for displaying the footer style one
 *
 * @package bytesed
 */
$copyright_text = !empty(cs_get_option('copyright_text')) ? cs_get_option('copyright_text'): esc_html__('Bytesed Theme Developed by Ir-Tech','bytesed');
$copyright_text = str_replace('{copy}','&copy;',$copyright_text);
$copyright_text = str_replace('{year}',date('Y'),$copyright_text);

$csf_options = get_option( 'wphex_framework' ); // unique id of the framework
$copyright = ! empty( $csf_options['copyright-text'] ) ? $csf_options['copyright-text'] : 'Copyright All Right Reserved by';
$copyright_link_text = ! empty( $csf_options['copyright-link-text'] ) ? $csf_options['copyright-link-text'] : '';
?>
<!-- Contact area Starts -->
<section class="wphex_newsletter_footer gradientBg_section padding-bottom-100 padding-top-100">
    <!-- <div class="gradient_section">
        <div class="blur_item"></div>
        <div class="blur_item"></div>
        <div class="blur_item"></div>
        <div class="blur_item"></div>
        <div class="blur_item"></div>
    </div> -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xxl-10 col-lg-12">
                <div class="wphex_newsletter bg_two radius-10">
                    <div class="wphex_newsletter__flex">
                        <div class="wphex_newsletter__left">
                            <div class="wphex_section__title text-left white">
                                <h2 class="title"><?php if( ! empty( $csf_options['newsletter-title'] ) ) { printf( esc_html__( '%s', 'wphex' ), $csf_options['newsletter-title'] ); }?></h2>
                                <p class="section_para mt-4"><?php if( ! empty( $csf_options['newsletter-description'] ) ) { printf( esc_html__( '%s', 'wphex' ), $csf_options['newsletter-description'] ) ; }?> </p>
                            </div>
							<div class="wphex_newsletter__subscribe mt-4">
								<?php if( ! empty( $csf_options['fluent-form-shortcode'] ) ) { echo do_shortcode( $csf_options['fluent-form-shortcode'] ); }?>
							</div>
                        </div>
                        <div class="wphex_newsletter__right">
                            <div class="wphex_newsletter__right__envelope">
                                <div class="wphex_newsletter__right__envelope__icon">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/newsletter/subscribe_envelope.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Contact area end -->
</main>
<!-- footer area start -->
<footer class="wpHex_footer_area gradientBg_section">
    <div class="footer-middler footer-top-border padding-top-70 padding-bottom-70">
        <!-- <div class="gradient_section">
            <div class="blur_item"></div>
            <div class="blur_item"></div>
            <div class="blur_item"></div>
            <div class="blur_item"></div>
            <div class="blur_item"></div>
        </div> -->
        <div class="container">
            <div class="row g-4 justify-content-between">
                <?php get_template_part('template-parts/common/footer-widget'); ?>
            </div>
        </div>
    </div>
    <div class="wphex_copyright_area copyright-border">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="copyright-contents center-text">
						<?php if ( $copyright ) :  ?>
                        <span> &copy; <span class="getYear">2022</span> <?php printf( esc_html__( '%s', 'wphex' ), $copyright ); ?> <?php printf( esc_html__( '%s', 'wphex' ), $copyright_link_text ); ?> </span>
						<?php else : ?>
						<span> &copy; <span class="getYear">2022</span> Copyright All Right Reserved by wpHex </span>
						<?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<div class="progressParent">
    <svg class="backCircle svg-inner" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 307.919;"></path>
    </svg>
</div>