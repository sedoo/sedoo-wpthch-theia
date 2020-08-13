<div id="primary" class="content-area wrapper <?php if (get_field( 'table_content' )) {echo " tocActive";}?>">
        <?php // table_content ( value ) 
        if (get_field( 'table_content' )) {
            sedoo_wpth_labs_display_sommaire('Sommaire');
        } ?>
    <main id="main" class="site-main" role="main">
        <?php
        $themes = get_the_terms( $post->ID, 'theme');  
        $themeSlugRewrite = "theme";
        
        $products = get_the_terms( $post->ID, 'typeproduct');  
        $productsSlugRewrite = "typeofproduct";
        
        $cestags = get_the_terms( $post->ID, 'cestag');  
        $cestagsSlugRewrite = "ces";
        
        ?>
        
        <article id="post-<?php the_ID(); ?>">
            <div class="wrapper-content">
            <?php //theia_wpthchild_show_categories($themes, $themeSlugRewrite);?>
            <?php //theia_wpthchild_show_categories($cestags, $cestagsSlugRewrite);?>
            <?php //theia_wpthchild_show_categories($products, $productsSlugRewrite);?>
            <?php
                the_content();
        
                wp_link_pages( array(
                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'theme-aeris' ),
                    'after'  => '</div>',
                ) );
            ?>
        
            </div>
        </article>	
    </main>
	</div><!-- #primary -->