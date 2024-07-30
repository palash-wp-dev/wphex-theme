<?php
/**
 * this template parts for displaying footer widget area
 * @sicne 1.0.0
 * */
if (!is_active_sidebar('footer-widget')){
	return;
}
?>
<?php dynamic_sidebar('footer-widget');?>

