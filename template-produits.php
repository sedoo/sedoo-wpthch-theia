<?php
/*
Template Name: page produits
*/
/**
 * template pour les pages des Produits (affiche thématiques et produits liés)
 * 
 */

get_header(); 

while ( have_posts() ) : the_post();

   get_template_part( 'template-parts/header-content', 'page' );
?>

	<div id="content-area" class="wrapper sidebar toc-left">
      <?php
      get_template_part( 'template-parts/content', 'tpl-page' );
      ?>
		
      <!-- <aside> -->

         <!-- Products --> 
         <?php
            $parameters = array(
                'sectionTitle'    => "Products",
             );
             
             $args = array(
               'post_type'             => 'products',
               'post_status'           => array( 'publish' ),
               'posts_per_page'        => '-1',            // -1 pour liste sans limite
               'post__not_in'          => array(get_the_id()),    //exclu le post courant
               'orderby'               => 'title',
               'order'                 => 'ASC',
               'lang'                  => pll_current_language(),    // use language slug in the query
               'tax_query'             => array(
                                       array(
                                          'taxonomy' => 'typeproduct',
                                          'field'    => 'slug',
                                          'terms'    => array('donnees-satellitaires-fr',),
                                          'operator' => 'NOT IN',
                                       ),
                                    ),
            );
    
             //theia_wpthchild_get_associate_content($parameters, $args);
            ?>

      <!-- </aside> -->


	</div><!-- #content-area -->


<?php
endwhile; // End of the loop.
// get_sidebar();
get_footer();
