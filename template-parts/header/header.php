<header class="header-style-01">
    <!-- Menu area Starts -->
    <nav class="navbar nav-absolute wphex_nav navbar-area navbar-padding navbar-expand-lg">
        <div class="container nav-container">
            <div class="responsive-mobile-menu">
                <div class="logo-wrapper">
                    <?php
                    $header_one_logo = cs_get_option('header_one_logo');
                    $white_logo = get_theme_mod('white_logo', '');
                    if (!empty($white_logo) && is_page('hexcoupon') ) {
                        echo ' <a href="' . get_home_url() . '" class="custom-logo-link" rel="home" aria-current="page">';
                        echo '<img width="144" height="40" src="' . esc_url($white_logo) . '" class="custom-logo" alt="WPHex" decoding="async">';
                        echo '</a>';
                    } elseif (has_custom_logo() && empty($header_one_logo['id'])){
                        the_custom_logo();
                    }elseif (!empty($header_one_logo['id'])){
                        printf('<a class="logo" href="%1$s"><img src="%2$s" alt="%3$s"/></a>',get_home_url(),$header_one_logo['url'],$header_one_logo['alt']);
                    } else{
                        printf('<a class="site-title" href="%1$s">%2$s</a>',get_home_url(),get_bloginfo('title'));
                    }
                    ?>
                </div>
                <a href="javascript:void(0)" class="click-nav-right-icon">
                    <i class="las la-ellipsis-v"></i>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#wpHex_menu">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'main-menu',
                    'menu_class' => 'navbar-nav',
                    'container' => 'div',
                    'container_class' => 'collapse navbar-collapse',
                    'container_id' => 'wpHex_menu'
                ));
                ?>
            <div class="navbar-right-content show-nav-content">
                <div class="single-right-content">
                    <div class="navbar-right-btn">
                        <?php if( is_user_logged_in() ) : $my_account_page = 'https://wphex.com/checkout-2/order-history/'; ?>
                            <a href="<?php echo esc_url( $my_account_page ); ?>" class="wphex_cmn_btn btn_outline_border hover_gradient_two btn_small radius-5"> <span><?php esc_html_e('Order History','wphex');?></span> </a>

                        <?php else : $register_page = 'https://wphex.com/register/'; ?>
                            <a href="<?php echo esc_url( $register_page ); ?>" class="wphex_cmn_btn btn_outline_border hover_gradient_two btn_small radius-5"> <span><?php esc_html_e('My Account','wphex');?></span> </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!-- Menu area end -->
    <div class="search-suggestion-overlay"></div>
</header>
<main>