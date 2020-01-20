<?php
/**
 * Template part for displaying posts - simple list
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package labs_by_Sedoo
 */


?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php //the_permalink(); ?>
	<header class="entry-header">
        <?php     
        // $categories = get_the_category();
        // if ( ! empty( $categories ) ) {
        // echo esc_html( $categories[0]->name );   
        // }; 
        ?>
        <h2><?php the_title(); ?></h2>
	</header><!-- .entry-header -->
    <div class="group-content">
        <div class="entry-content">
            
            <?php the_content(); ?>
            <p class="date"><?php the_date('M / d / Y') ?></p>
        </div><!-- .entry-content -->
        <?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Edit <span class="screen-reader-text">%s</span>', 'labs-by-sedoo' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				),
				'<span class="edit-link">',
				'</span>'
			);
			?>
    </div>
</article><!-- #post-->
