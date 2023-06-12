
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<div>
                <h1 class="entry-title">
                    <?php the_title(); ?>
                </h1>

                <?php 
                if ( get_post_type( get_the_ID() ) == 'ces' ) {
                    $themes = get_the_terms( $post->ID, 'category');  
                    $themeSlugRewrite = "category";
                    if ( (function_exists('sedoo_labtools_show_categories')) && ($themes)){
                    ?>
                    <div>
                        <?php
                            sedoo_labtools_show_categories($themes, $themeSlugRewrite);				
                        ?>
                    </div>
                    <?php
                    }
                }
                ?>
            </div>
            <?php 
            $image_url_en = array('incubating' => '/svgces/en/incubating-sec.svg', 'prototyping' => '/svgces/en/prototyping-sec.svg', 'producing' => '/svgces/en/producing-sec.svg');
            $image_url_fr = array('incubating' => '/svgces/fr/ces-en-incubation.svg', 'prototyping' => '/svgces/fr/ces-en-prototypage.svg', 'producing' => '/svgces/fr/ces-en-production.svg');

            // if incubating (fr) 
            if(has_category('ces-en-incubation')) {
            echo '<a href="'.get_category_link(704).'"><figure><img src="'.get_stylesheet_directory_uri().$image_url_fr['incubating'].'"></figure></a>';
            }

            // if incubating (en)
            if(has_category('incubating-sec')) {
            echo '<a href="'.get_category_link(706).'"><figure><img src="'.get_stylesheet_directory_uri().$image_url_en['incubating'].'"></figure></a>';
            }

            // if prototyping (fr)
            if(has_category('ces-en-prototypage')) { 
            echo '<a href="'.get_category_link(708).'"><figure><img src="'.get_stylesheet_directory_uri().$image_url_fr['prototyping'].'"></figure></a>';
            }

            // if prototyping (en)
            if(has_category('prototyping-sec')) {
            echo'<a href="'.get_category_link(702).'"><figure><img src="'.get_stylesheet_directory_uri().$image_url_en['prototyping'].'"></figure></a>'; 
            }

            // if producing (fr)
            if(has_category('ces-en-production')) {
            echo '<a href="'.get_category_link(700).'"><figure><img src="'.get_stylesheet_directory_uri().$image_url_fr['producing'].'"></figure></a>';
            }

            // if producing (en)
            if(has_category('producing-sec')) {
            echo '<a href="'.get_category_link(710).'"><figure><img src="'.get_stylesheet_directory_uri().$image_url_en['producing'].'"></figure></a>';
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