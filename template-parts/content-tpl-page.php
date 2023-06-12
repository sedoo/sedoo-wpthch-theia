
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<?php 
			if ( (function_exists('sedoo_labtools_show_categories')) && ($themes)){
			?>
			<div>
				<?php
					sedoo_labtools_show_categories($themes, $themeSlugRewrite);				
				?>
			</div>
			<?php
			}
			?>
		</header><!-- .entry-header -->
		
		<div class="entry-content">
			
			
			<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'labs-by-sedoo' ),
				'after'  => '</div>',
			) );
			?>
		</div><!-- .entry-content -->
    </article>	