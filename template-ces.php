<?php
/*
Template Name: page CES
*/
/**
 * template pour les pages des CES (affiche actus / thématiques / produits liés)
*/

get_header(); 

while ( have_posts() ) : the_post();

   get_template_part( 'template-parts/header-content', 'page' );
?>

	<div id="content-area" class="wrapper sidebar toc-left">
      <?php
      get_template_part( 'template-parts/content', 'tpl-page' );
      ?>
		
      <aside>
         <!-- NEWS -->
         <?php
            $parameters = array(
               'sectionTitle'    => "Regional Animation Networks",
            );            
            $args = array(
              'post_type'             => 'post',
              'post_status'           => array( 'publish' ),
              'posts_per_page'        => '7',            // -1 pour liste sans limite
              'post__not_in'          => array(get_the_id()),    //exclu le post courant
              'orderby'               => 'date',
              'order'                 => 'DESC',
              'lang'                  => pll_current_language(),    // use language slug in the query
            //   'tax_query'             => array(
            //                           array(
            //                              'taxonomy' => 'theme',
            //                              'field'    => 'slug',
            //                              'terms'    => $cesTerms,
            //                           ),
            //                        ),
               'meta_key'              => '_wp_page_template',
               'meta_value'            => 'template-ces.php',
           );            
           theia_wpthchild_get_associate_content($parameters, $args);
         
            ?>
      </aside>


	</div><!-- #content-area -->


<?php
endwhile; // End of the loop.
// get_sidebar();
get_footer();
