<?php
/**
 * The template for displaying the footer style two
 *
 * @package bytesed
 */
$copyright_text = !empty(cs_get_option('copyright_text')) ? cs_get_option('copyright_text'): esc_html__('Bytesed Theme Developed by Ir-Tech','bytesed');
$copyright_text = str_replace('{copy}','&copy;',$copyright_text);
$copyright_text = str_replace('{year}',date('Y'),$copyright_text);
?>
<footer class="footer-style-two padding-80">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="footer-two-inner">
                    <div class="logo-wrapper">
                        <?php 
                        $footer_two_logo = cs_get_option('footer_two_logo');
                        if (has_custom_logo() && empty($footer_two_logo['id'])){
                            the_custom_logo();
                        }elseif (!empty($footer_two_logo['id'])){
                            printf('<a class="site-logo" href="%1$s"><img src="%2$s" alt="%3$s"/></a>',get_home_url(),$footer_two_logo['url'],$footer_two_logo['alt']);
                        }
                        else{
                            printf('<a class="site-title" href="%1$s">%2$s</a>',get_home_url(),get_bloginfo('title'));
                        }
                        ?>
                        <p><?php echo wp_kses_post(cs_get_option('footer_two_description'))?></p>
                    </div>
                    <div class="mailchimp-newsletter">
	                    <?php echo do_shortcode(cs_get_option('footer_two_subscriber'))?>
                    </div>
                    <div class="copyright-text-area">
                        <?php echo wp_kses($copyright_text,Bytesed()->kses_allowed_html(array('a'))); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>