<?php
/**
 * Template part for displaying embed page 
 *
 */
$categories = get_the_terms( $post->ID, 'category');
$categoriesSlugRewrite = "category";
$themes = get_the_terms( $post->ID, 'theme');
$themeSlugRewrite = "theme";
$typeProduits = get_the_terms( $post->ID, 'typeproduct');
$typeProduitsSlugRewrite = "typeofproduct";
?>

<article role="embed-post" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header>
        <?php theia_wpthchild_show_categories($categories, $categoriesSlugRewrite);?>
        <?php theia_wpthchild_show_categories($typeProduits, $typeProduitsSlugRewrite);?>
        <?php 
        if (get_the_post_thumbnail()) {
        ?>
        <figure>
            <a href="<?php the_permalink(); ?>" title="<?php the_title();?>">
                <?php the_post_thumbnail( 'illustration-article' ); ?>
            </a>
        </figure>
        <?php 
        }
        ?>       
        <h3>
           <a href="<?php the_permalink(); ?>" title="<?php the_title();?>">
            <?php 
            $title = get_the_title();
            $title = mb_strimwidth($title, 0, 60, '...');
            echo $title;
            ?>
            </a>
        </h3> 

    </header>
    <section>
       
       <?php if($post->post_content != "") : ?>			
       <div class="post-excerpt">	    		            			            	                                                                                            
			<?php the_excerpt(); ?>
        </div>
        <?php endif; ?>
        <?php // theme_aeris_meta(); ?>
    </section>
    <!-- <footer>
	</footer> -->
</article>