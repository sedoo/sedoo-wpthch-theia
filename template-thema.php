<?php
/*
Template Name: page Thématiques
*/
/**
 * template pour les pages des thématiques (affiche actus / CES / produits liés)
 */

get_header(); 

while ( have_posts() ) : the_post();
   $postID=get_the_id();
   $categories = get_the_terms( get_the_id(), 'theme');  // recup des terms de la taxonomie $parameters['category']
   $terms=array();
   foreach ($categories as $term_slug) {        
       array_push($terms, $term_slug->slug);
   }

   get_template_part( 'template-parts/header-content', 'theia-page' );
?>

	<div id="content-area" class="wrapper sidebar toc-left">
      <?php
      get_template_part( 'template-parts/content', 'tpl-page' );
      ?>
		
      <aside>
        <!-- NEWS --> 
        <?php
            $parameters = array(
               'sectionTitle'    => "News",
            );            
            $args = array(
              'post_type'             => 'post',
              'post_status'           => array( 'publish' ),
              'posts_per_page'        => '7',            // -1 pour liste sans limite
              'post__not_in'          => array(get_the_id()),    //exclu le post courant
              'orderby'               => 'date',
              'order'                 => 'DESC',
              'lang'                  => pll_current_language(),    // use language slug in the query
              'tax_query'             => array(
                                      array(
                                         'taxonomy' => 'theme',
                                         'field'    => 'slug',
                                         'terms'    => $terms,
                                      ),
                                   ),
              // 'meta_key'              => '_wp_page_template',
              // 'meta_value'            => '', // template-name.php
           );            
           theia_wpthchild_get_associate_content($parameters, $args);
          
            ?>
         <!-- SEC --> 
            <?php
            $parameters = array(
               'sectionTitle'    => "SEC",
            );
            
            $args = array(
              'post_type'             => 'ces',
              'post_status'           => array( 'publish' ),
              'posts_per_page'        => '-1',            // -1 pour liste sans limite
              'post__not_in'          => array(get_the_id()),    //exclu le post courant
              'orderby'               => 'title',
              'order'                 => 'ASC',
              'lang'                  => pll_current_language(),    // use language slug in the query
              'tax_query'             => array(
                                      array(
                                         'taxonomy' => 'theme',
                                         'field'    => 'slug',
                                         'terms'    => $terms,
                                      ),
                                   ),
              // 'meta_key'              => '_wp_page_template',
              // 'meta_value'            => '', // template-name.php
           );
            
           theia_wpthchild_get_associate_content($parameters, $args);

            ?>
         <!-- Products --> 
            <?php
            // faire double taxo query
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
                                       'relation' => 'AND',
                                       array(
                                          'taxonomy' => 'theme',
                                          'field'    => 'slug',
                                          'terms'    => $terms,
                                       ),
                                       array(
                                          'taxonomy' => 'typeproduct',
                                          'field'    => 'slug',
                                          'terms'    => array('donnees-satellitaires',),
                                          'operator' => 'NOT IN',
                                       ),
                                    ),
               // 'meta_key'              => '_wp_page_template',
               // 'meta_value'            => '', // template-name.php
            );
    
             theia_wpthchild_get_associate_content($parameters, $args);
            ?>
      </aside>


	</div><!-- #content-area -->


<?php
endwhile; // End of the loop.
// get_sidebar();
get_footer();
