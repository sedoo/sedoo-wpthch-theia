<aside id="stickyMenu"> <!--sidebar droite-->
    <nav role="sommaire">
        <ul id="tocList">
        </ul>
    </nav>    
</aside>
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