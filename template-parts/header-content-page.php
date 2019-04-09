<?php
/**
 * Template part for displaying a title & breadcrumbs on page
 *
 * @package aeris
 */

?>
<div id="breadcrumbs">
	<div class="wrapper">
		<?php 
		// Show breadcrumb if checked in customizer
		if ( get_theme_mod( 'theme_aeris_breadcrumb' ) == "true") {
			if (function_exists('the_breadcrumb')) the_breadcrumb(); 
		}
		?>		
	</div>
</div>
<div class="site-branding" 
    <?php 
    if (get_the_post_thumbnail_url()) {
    ?>
    style="background-image:url(
    <?php the_post_thumbnail_url( 'full' ); ?>
    );">
    <?php 
    }
    ?>
    <div>    
        <h1 class="site-title" rel="bookmark" style="<?php ?>"><span><?php the_title(); ?></span></h1>
    </div>
</div><!-- .site-branding -->


