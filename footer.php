<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package aeris
 */

?>

	<footer>
		<div class="wrapper">
		<?php if ( is_active_sidebar( 'footer-widget-area' ) ) : ?>
			<div id="footer-widget-area" role="complementary">
				<?php dynamic_sidebar( 'footer-widget-area' ); ?>
			</div>
		<?php endif; ?>

		<?php if ( is_active_sidebar( 'partners' ) ) : ?>
			<ul id="partners-sidebar" class="primary-sidebar widget-area" role="complementary">
				<?php dynamic_sidebar( 'partners' ); ?>
			</ul>
		<?php endif; ?>
		    <p class="copyright">© Copyright <?php echo get_theme_mod('theme_aeris_copyright');?></p>

	    </div>
	</footer>
</div><!-- #page -->
<?php include('svg/ces_icn.svg');?>

<?php wp_footer(); ?>

</body>
</html>
