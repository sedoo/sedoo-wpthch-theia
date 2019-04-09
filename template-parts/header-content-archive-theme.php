<?php
/**
 * Template part for displaying a title & breadcrumbs on page
 *
 * @package aeris
 */

?>
<div id="breadcrumbs">
	<div class="wrapper">
		<h1 rel="bookmark">
			<?php the_archive_title(); ?>
		</h1>
		<?php 
		// Show breadcrumb if checked in customizer
		if( get_theme_mod( 'theme_aeris_breadcrumb' ) == "true") {
			if (function_exists('the_breadcrumb')) the_breadcrumb(); 
		}
		?>
	</div>
</div>


