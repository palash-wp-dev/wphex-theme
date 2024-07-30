<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package bytesed
 */

get_header();
$archive_page_items = !empty(cs_get_option('download_archive_item')) ? cs_get_option('download_archive_item') : 3;
//custom archive query
$paged = get_query_var('page') ? get_query_var('page') : 1;
$paged       = absint( $paged );
$query_args          = array(
	'post_type'      => 'download',
	'post_status'    => 'publish',
	'posts_per_page' => $archive_page_items,
	'orderby'        => 'ID',
	'order'          => 'DESC',
	'paged' => $paged,
);

$orderby             = isset( $_GET['orderby'] ) && ! empty( $_GET['orderby'] ) ? $_GET['orderby'] : '';
$category            = isset( $_GET['cat'] ) && ! empty( $_GET['cat'] ) ? $_GET['cat'] : '';
if ( ! empty( $orderby ) ) {
	switch ( $orderby ) {
		case( "best_sold" ):
			$query_args['meta_key'] = '_edd_download_sales';
			$query_args['orderby'] = 'meta_value_num';
			break;
		case( "best_ratings" ):
			$query_args['meta_key'] = 'bytesed_rating_count';
			$query_args['orderby'] = 'meta_value_num';
			break;
		case( "high_price" ):
			$query_args['meta_key'] = 'edd_price';
			$query_args['orderby'] = 'meta_value_num';
			break;
		case( "low_price" ):
			$query_args['meta_key'] = 'edd_price';
			$query_args['orderby'] = 'meta_value_num';
			$query_args['order'] = 'ASC';
			break;
		default:
			break;
	}

}
if ( ! empty( $category ) ) {
	$query_args['tax_query'] = array(
		array(
			'taxonomy' => 'download_category',
			'field'    => 'slug',
			'terms'    => $category,
		)
	);
}
$search_query = isset( $_GET['search'] ) && ! empty( $_GET['search'] ) ? $_GET['search'] : '';
if (!empty($search_query)){
	//custom search
	$query_args = array (
		'post_type'      => 'download',
		'post_status'    => 'publish',
		'posts_per_page' => $archive_page_items,
		'orderby'        => 'ID',
		'order'          => 'DESC',
		'paged' => $paged,
		's' => $search_query
	);
}


$all_downloads = new WP_Query( $query_args );

// arguments to show all categories in the select html options section
$args = array(
    'taxonomy' => 'download_category',
    'orderby' => 'name',
    'order'   => 'ASC'
);

$cats = get_categories($args);

?>
<!-- Products area start -->
<section class="products_area pat-100 pab-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="product_search">
                    <div class="product_search__flex">
                        <div class="product_search__left">
                            <div class="product_search_select">
								<?php if ( $cats ) : ?>
                                <select id="mySelect" name="mySelect[]" class="js_nice_select">
                                    <?php foreach ( $cats as $cat ) : ?>
                                        <option data-display="<?php  echo esc_html( $cat->name ); ?>"><?php  echo esc_html( $cat->name ); ?></option>
                                    <?php endforeach; ?>
                                </select>
								<?php endif; ?>
                            </div>
                            <div id="output">
                                <ul class="product_search__list">

                                </ul>
                            </div>

                        </div>
                        <?php

                        add_filter( 'get_search_form', 'bytesed_search' );


                        function bytesed_search ( $form ) {
                            $form = '<div class="product_search__right custom-form">
                                <form method="get" action="' . esc_url(home_url('/')) . '">
                                    <div class="single-input">
                                        <input class="form--control" type="text" placeholder="' . esc_attr__('Product Search', 'bytesed') . '" value="' . get_search_query() . '" name="s">
                                        <input type="hidden" name="download" value="' . get_search_query() . '" />
                                        <a href="' . esc_url(home_url('/')) . '" class="' . esc_attr( 'cmn-btn btn-gradient-1 radius-10 search-submit' ) . '">' . esc_html__( 'Search', 'bytesed' ) . '</a>
                                     </div>   
                                </form>
                             </div>';

                            return $form;
                        }


                        get_search_form();
                        ?>
                    </div>
                </div>
            </div>
        </div>
            <?php

            if ( $all_downloads->have_posts() ) :

                ?>
                <div class="row g-4 mt-3">
                <?php
                /* Start the Loop */
                while ( $all_downloads->have_posts() ) :
                    $all_downloads->the_post();

                    /*
                     * Include the Post-Type-specific template for the content.
                     * If you want to override this in a child theme, then include a file
                     * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                     */
                    get_template_part( 'template-parts/content', 'download' );

                endwhile;
                ?>
                </div>
                <div class="row mt-5">
                    <div class="col-lg-12">
                        <div class="pagination_wrap">
                        <?php
                        $big = 999999999;
                        $pagination_args = array(
                            'base'     => str_replace('%_%', 1 == $paged ? '' : "?page=%#%", "?page=%#%"),
                            'format'   => '?page=%#%',
                            'total'    => $all_downloads->max_num_pages,
                            'current'  => max( 1, $paged ),
                            'show_all' => false,
                            'prev_text' => '<i class="fas fa-angle-double-left"></i>',
                            'type' => 'list',
                            'next_text' => '<i class="fas fa-angle-double-right"></i>',
                            'prev_next' => true,
                        );
                        $paginate = paginate_links( $pagination_args );
                        $paginate = str_replace( 'page-numbers', 'pagination_list', $paginate );
                        $paginate = str_replace( '<a class="pagination_list"', '<a class="pagination_list__item__link"', $paginate );
                        $paginate = str_replace( '</span>', '</a>', $paginate );
                        $paginate = str_replace( '<li>', '<li class="pagination_list__item">', $paginate );
                        $paginate = str_replace( '<li class="pagination_list__item"><a class="next pagination_list"', '<li class="pagination_list__item__prev"><a class="pagination_list__item__link"', $paginate );
                        $paginate = str_replace( '<li class="pagination_list__item"><a class="prev pagination_list"', '<li class="pagination_list__item__prev"><a class="pagination_list__item__link"', $paginate );
                        $paginate = str_replace( '<li class="pagination_list__item"><a class="next pagination_list"', '<li class="pagination_list__item__next"><a class="pagination_list__item__link"', $paginate );
                        $paginate = str_replace( '<li class="pagination_list__item"><span aria-current="page" class="pagination_list current">', '<li class="pagination_list__item active"><a href="javascript:void(0)" class="pagination_list__item__link">', $paginate );
                        $paginate = str_replace( '</span>', '</a>', $paginate );

                        echo $paginate;
                        ?>
                        </div>
                    </div>
                </div>
            <?php
            else :

                get_template_part( 'template-parts/content', 'none' );

            endif;
            ?>

</section>
<!-- Products area end -->
<?php

get_footer();
