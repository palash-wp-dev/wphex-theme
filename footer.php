<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package bytesed
 */
$default_footer_type = cs_get_option('default_footer_type');
?>
    </div><!-- #content -->
    <?php get_template_part('template-parts/footer/footer',$default_footer_type);?>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
