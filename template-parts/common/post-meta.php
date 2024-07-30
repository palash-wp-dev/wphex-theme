<?php
$bytesed = Bytesed();
$post_meta = Bytesed_Group_Fields_Value::post_meta('blog_post');
?>
<div class="single_blog__tag">
    <div class="single_blog__tag__item">
        <?php the_category(', ');?>
<!--        <a href="javascript:void(0)" class="single_blog__tag__link">Topic</a>-->
<!--        <a href="javascript:void(0)" class="single_blog__tag__link">Topic</a>-->
    </div>
    <?php if ($post_meta['posted_by']):?>
        <div class="single_blog__tag__list">
            <?php $bytesed->posted_on();?>
<!--            <a href="javascript:void(0)" class="single_blog__tag__list__item">24 Aug 2022</a>-->
        </div>

    <?php endif;?>

</div>
