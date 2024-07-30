<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package bytesed
 */
get_header();
$paged = get_query_var('paged') ? get_query_var('paged') : 1;
$paged = absint( $paged );
?>
    <div id="primary" class="content-area archive-page-content-area download-archive-page padding-120">
        <main id="main" class="site-main">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
						<?php
						if ( have_posts() ) :
							?>
							<div class="row">
							<?php
							/* Start the Loop */
							while (have_posts() ) :
								the_post();
								/*
								 * Include the Post-Type-specific template for the content.
								 * If you want to override this in a child theme, then include a file
								 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
								 */
								get_template_part( 'template-parts/content', 'download' );
							endwhile;
							?>
	                        </div>
                            <div class="bytesed-downloads-pagination">
								<?php
                                global  $wp_query;
								$big = 999999999;
								$pagination_args = array(
									'base'     => str_replace('%_%', 1 == $paged ? '' : "?paged=%#%", "?paged=%#%"),
									'format'   => '?paged=%#%',
									'total'    => $wp_query->max_num_pages,
									'current'  => max( 1, $paged ),
									'show_all' => false,
									'prev_text' => '<i class="fa fa-angle-double-left"></i>',
									'next_text' => '<i class="fa fa-angle-double-right"></i>',
									'prev_next' => true,
								);
								echo paginate_links( $pagination_args );
                                ?>
                            </div>
						<?php
						else :
							get_template_part( 'template-parts/content', 'none' );
						endif;
						?>
                    </div>
                </div>
            </div>
        </main><!-- #main -->
    </div><!-- #primary -->
<?php
get_footer();
