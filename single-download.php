<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package bytesed
 */

get_header();
$support_page_url = get_page_by_title('Support Policy');
$envato_product_id = get_post_meta(get_the_ID(),'bytesed_envato_product_id',true);

$_rating = get_post_meta(get_the_ID(),'bytesed_rating',true);
$_rating_count = get_post_meta(get_the_ID(),'bytesed_rating_count',true);
$post_id = get_the_ID();
//if rating not avilable extract it from envato
if($_rating_count == 0 && !empty($envato_product_id)){
    $rating_arrr = Bytesed_Envato::get_product_rating_by_id($envato_product_id,$post_id);
    $_rating = is_array($rating_arrr) && !empty($rating_arrr['rating']) ? $rating_arrr['rating'] : '';
    $_rating_count = is_array($rating_arrr) && !empty($rating_arrr['rating_count']) ? $rating_arrr['rating_count'] : '';
}

//if sales number not avilable extact it form envato
$item_sales = get_post_meta(get_the_ID(),'_edd_download_sales',true);
if($item_sales == 0 && !empty($envato_product_id)){
    $item_price = Bytesed_Envato::get_product_sales_by_id($envato_product_id);
    update_post_meta(get_the_ID(),'_edd_download_sales',$item_price);
}

//if tags not avilable extract it from envato == work on it later 
//comment date 21 Nov 2020

//if item update date it not there extract it from envato by envato product id
$last_update = get_post_meta(get_the_ID(),'bytesed_updated_at',true);
if(empty($last_update) && !empty($envato_product_id)){
    $last_update = Bytesed_Envato::get_product_update_time_by_id($envato_product_id);
    update_post_meta(get_the_ID(),'bytesed_updated_at',$last_update);
}


$item_url = get_post_meta(get_the_ID(),'bytesed_item_url',true);
$comment_url = !empty($item_url) ? $item_url .'/comments' : '';
$support_url = !empty($item_url) ? $item_url .'/support' : 'https://bytesed51.freshdesk.com/';
$review_url = !empty($item_url) ? str_replace($envato_product_id,'reviews/'.$envato_product_id,$item_url) : '';
$product_type = get_post_meta(get_the_ID(),'bytesed_type',true);



$average_rating = !empty($_rating) ? ($_rating * 100 ) / 5 : '';
$first_release = get_post_meta(get_the_ID(),'bytesed_published_at',true);

//
$bytesed_high_resolution = get_post_meta(get_the_ID(),'bytesed_high_resolution',true);
$bytesed_compatible_browsers = get_post_meta(get_the_ID(),'bytesed_compatible_browsers',true);
$bytesed_compatible_software = get_post_meta(get_the_ID(),'bytesed_compatible-software',true);
$bytesed_gutenberg_optimized = get_post_meta(get_the_ID(),'bytesed_gutenberg-optimized',true);
$bytesed_compatible_with = get_post_meta(get_the_ID(),'bytesed_compatible-with',true);
$bytesed_source_files_included = get_post_meta(get_the_ID(),'bytesed_source-files-included',true);
$bytesed_software_framework = get_post_meta(get_the_ID(),'bytesed_software_framework',true);
$bytesed_columns = get_post_meta(get_the_ID(),'bytesed_columns',true);
$bytesed_layout = get_post_meta(get_the_ID(),'bytesed_layout',true);

$bytesed_thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'full');

$thumbnail_url = is_array($bytesed_thumbnail[0]) ? $bytesed_thumbnail[0] : '' ;



?>


<div itemtype="http://schema.org/Product" itemscope>
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
    </div>


	<div id="primary" class="content-area download-single-page">
		<main id="main" class="site-main">
			<div class="container">
				<div class="row">
					<div class="col-lg-8">
						<ul class="nav nav-tabs" id="myTab" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" data-toggle="tab" href="#overview" role="tab" aria-selected="true"><?php esc_html_e('Overview','bytesed');?></a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="<?php echo esc_url($comment_url);?>" target="_blank" ><?php esc_html_e('Comments','bytesed');?></a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="<?php echo esc_url($review_url);?>" target="_blank"><?php esc_html_e('Reviews','bytesed');?></a>
							</li>
                            <li class="nav-item">
								<a class="nav-link" href="<?php echo esc_url($support_url);?>" target="_blank"><?php esc_html_e('Support','bytesed');?></a> 
<!--								<a class="nav-link" data-toggle="tab" href="#support" role="tab" aria-selected="false">--><?php //esc_html_e('Support','bytesed');?><!--</a>-->
							</li>
						</ul>
						<div class="tab-content" id="myTabContent">
							<div class="tab-pane fade show active" id="overview" role="tabpanel" >
								<?php
								while ( have_posts() ) :
									the_post();
									get_template_part( 'template-parts/content', 'download-single' );
								endwhile; // End of the loop.
								?>
                            </div>
							<div class="tab-pane fade" id="support" role="tabpanel" >
                                <div class="download-support-area">
                                    <h4 class="title"><?php esc_html_e('Contact The Author','bytesed');?></h4>
                                    <p><?php esc_html_e('We provides limited support for this item through email contact form.','bytesed');?></p>
                                    <h4 class="title"><?php esc_html_e('Item support includes:','bytesed');?></h4>
                                    <ul class="correct-list">
                                        <li><?php esc_html_e('Availability of the author to answer questions','bytesed');?></li>
                                        <li><?php esc_html_e('Answering technical questions about item’s features','bytesed');?></li>
                                        <li><?php esc_html_e('Assistance with reported bugs and issues','bytesed');?></li>
                                        <li><?php esc_html_e('Help with included 3rd party assets','bytesed');?></li>
                                    </ul>
                                    <h4 class="title"><?php esc_html_e('However, item support does not include:','bytesed');?></h4>
                                    <ul class="close-list">
                                        <li><?php esc_html_e('Customization services','bytesed');?></li>
                                        <li><?php esc_html_e('Installation services','bytesed');?></li>
                                    </ul>
                                    <p class="policy-link"><?php esc_html_e('View the ','bytesed'); ?>
                                        <a href="<?php echo esc_url(get_the_permalink($support_page_url)); ?>"><?php esc_html_e('item support policy','bytesed');?></a>
                                    </p>
                                    <a href="#" class="contact-author-btn" data-toggle="modal" data-target="#support-modal"><?php esc_html_e('Contact Author','bytesed');?></a>
                                </div>
                            </div>
						</div>
					</div>
					<div class="col-lg-4">
                        <div class="download-widget-area">
                            <div class="widget download-widget">
                                <div class="regular-license">
                                    <h4 class="title"><?php esc_html_e('Regular License','xgenous');?></h4>
                                    <div class="price-wrap">
	                                    <?php  edd_price(get_the_ID()); ?>
                                    </div>
                                </div>
                                <div class="envato-quote">
                                    <ul class="check-list">
                                        <li><?php esc_html_e('Free technical support','xgenous');?></li>
                                        <li><?php esc_html_e('Future product updates','xgenous');?></li>
                                        <li><?php esc_html_e('Quality checked by Envato','xgenous');?></li>
                                        <li><?php esc_html_e('Lowest price guarantee','xgenous');?></li>
                                        <li><?php esc_html_e('6 months support from','xgenous');?></li>
                                    </ul>
                                </div>
	                            <?php  if ($product_type == 'envato') printf('<div class="btn-wrapper"><a href="%1$s" target="_blank">%2$s</a></div>',esc_url('https://codecanyon.net/cart/add_items?item_ids='.$envato_product_id),esc_attr('Purchase Now','bytesed')); ?>
                            </div>
                            <?php if (!empty($item_sales)):?>
                            <div class="widget download-widget">
                                <div class="sales-count">
                                    <h4 class="sales"><i class="fa fa-shopping-cart" aria-hidden="true"></i> <?php echo esc_html($item_sales);?> <span><?php esc_html_e(' Sales','bytesed');?></span></h4>
                                </div>
                            </div>
                            <?php endif;?>
	                        <?php if (!empty($_rating_count) && $_rating_count >= 3 ):?>
                            <div class="widget download-widget">
                               <div class="rating-wrap">
                                    <h5 class="rating-title"><?php esc_html_e('Item Rating: ','bytesed');?> </h5>
                                   <div class="ratings">
                                       <span class="hide-rating"></span>
                                       <span class="show-rating" style="width: <?php echo esc_attr($average_rating.'%');?>"></span>
                                   </div>
	                               <span class="count">(<?php echo esc_html($_rating_count);?>)</span>
                               </div>
                            </div>
                            <?php endif;?>
                            <div class="widget download-widget">
                                <?php if(!empty($last_update)):?>
                                <div class="info-block-area">
                                    <h5 class="title"><?php esc_html_e('Last Update','bytesed');?></h5>
                                    <span class="details"><?php echo date('d F Y',strtotime($last_update));?></span>
                                </div>
                                <?php endif;?>
                                <div class="info-block-area">
	                                <h5 class="title"><?php esc_html_e('First Release','bytesed');?></h5>
	                                <span class="details"><?php echo date('d F Y',strtotime($first_release));?></span>
                                </div>
	                            <div class="info-block-area">
	                                <h5 class="title"><?php esc_html_e('Documentation','bytesed');?></h5>
	                                <span class="details"><?php esc_html_e('Yes','bytesed');?></span>
                                </div>
	                            <?php if (!empty($bytesed_high_resolution) && $bytesed_high_resolution == 1):?>
		                            <div class="info-block-area">
			                            <h5 class="title"><?php esc_html_e('High Resolution','bytesed');?></h5>
			                            <span class="details"><?php esc_html_e('Yes','bytesed');?></span>
		                            </div>
	                            <?php endif;?>
	                            <?php if (!empty($bytesed_compatible_browsers)):?>
		                            <div class="info-block-area">
			                            <h5 class="title"><?php esc_html_e('Compatible Browsers','bytesed');?></h5>
			                            <span class="details"><?php echo esc_html($bytesed_compatible_browsers);?></span>
		                            </div>
	                            <?php endif;?>
	                            <?php if (!empty($bytesed_compatible_software)):?>
		                            <div class="info-block-area">
			                            <h5 class="title"><?php esc_html_e('Software Version','bytesed');?></h5>
			                            <span class="details"><?php echo esc_html($bytesed_compatible_software);?></span>
		                            </div>
	                            <?php endif;?>
	                            <?php if (!empty($bytesed_gutenberg_optimized) && $bytesed_gutenberg_optimized == 1):?>
		                            <div class="info-block-area">
			                            <h5 class="title"><?php esc_html_e('Gutenberg Optimized','bytesed');?></h5>
			                            <span class="details"><?php esc_html_e('Yes','bytesed');?></span>
		                            </div>
	                            <?php endif;?>
	                            <?php if (!empty($bytesed_compatible_with) ):?>
		                            <div class="info-block-area">
			                            <h5 class="title"><?php esc_html_e('Compatible With','bytesed');?></h5>
										<span class="details">
										<?php 
											if(is_array($bytesed_compatible_with)){
												echo esc_html(implode(' , ',$bytesed_compatible_with));
											}
										?>
										</span>
		                            </div>
	                            <?php endif;?>
                                <?php if (!empty($bytesed_software_framework) ):?>
		                            <div class="info-block-area">
			                            <h5 class="title"><?php esc_html_e('Software Framework','bytesed');?></h5>
			                            <span class="details"><?php echo esc_html($bytesed_software_framework);?></span>
		                            </div>
	                            <?php endif;?>

	                            <?php if (!empty($bytesed_columns) ):?>
		                            <div class="info-block-area">
			                            <h5 class="title"><?php esc_html_e('Columns','bytesed');?></h5>
			                            <span class="details"><?php echo esc_html($bytesed_columns);?></span>
		                            </div>
	                            <?php endif;?>
	                            <?php if (!empty($bytesed_layout) ):?>
		                            <div class="info-block-area">
			                            <h5 class="title"><?php esc_html_e('Layout','bytesed');?></h5>
			                            <span class="details"><?php echo esc_html($bytesed_layout);?></span>
		                            </div>
	                            <?php endif;?>

	                            <?php if (!empty($bytesed_source_files_included) ):?>
		                            <div class="info-block-area">
			                            <h5 class="title"><?php esc_html_e('Files Included','bytesed');?></h5>
			                            <span class="details"><?php echo esc_html($bytesed_source_files_included);?></span>
		                            </div>
	                            <?php endif;?>
	                            <?php
	                            $tags = wp_get_post_terms(get_the_ID(),'download_tag');
	                            if(!empty($tags)):?>
	                            <div class="info-block-area">
		                            <h5 class="title"><?php esc_html_e('Tags','bytesed');?></h5>
		                            <div class="tags">
										<?php
											foreach ($tags as $terms){
												printf('<a href="%1$s">%2$s</a>',get_term_link($terms->term_id,'download_tag'),$terms->name);
											}
										?>
                                    </div>
	                            </div>
	                            <?php endif;?>
                            </div>
                        </div>
					</div>
				</div>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

    <!-- Modal -->
    <div class="modal fade item-support-modal" id="support-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content download-support-modal">
                <div class="modal-header">
                    <h5 class="modal-title" ><?php esc_html_e('Send an email to the author','bytesed');?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
	            <form action="" class="item-support-mail-form" method="post" enctype="multipart/form-data">
	                <div class="modal-body">

	                        <?php wp_nonce_field('bytesed_item_support');?>
	                        <input type="hidden" name="action" value="bytesed_item_support_mail">
	                        <input type="hidden" name="item_title" value="<?php echo esc_html(strip_tags(get_the_title()))?>">
	                        <input type="hidden" name="subject" value="<?php echo 'Support Message For'. esc_html(strip_tags(get_the_title()))?>">
	                        <div class="form-group">
	                            <input type="text" name="name" class="form-control" placeholder="<?php esc_html_e('Your Name','bytesed');?>">
	                        </div>
	                        <div class="form-group">
	                            <input type="email" name="email" class="form-control" placeholder="<?php esc_html_e('Your Email','bytesed');?>">
	                        </div>
	                        <div class="form-group textarea">
	                            <textarea name="message" id="support_message" class="form-control" cols="30" rows="10" placeholder="<?php esc_html_e('Your Message','xgenous');?>"></textarea>
	                        </div>
	                </div>
	                <div class="modal-footer">
	                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php esc_html_e('Cancel','bytesed');?></button>
	                    <button type="button" class="btn btn-primary item-support-form-submit-btn"><?php esc_html_e('Send Message','xgenoius');?></button>
	                </div>
	            </form>
            </div>
        </div>
    </div>
<?php
get_footer();
