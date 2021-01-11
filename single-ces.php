<?php
/**
 * template pour les pages des CES (affiche actus / thématiques / produits liés)
*/

get_header(); 

while ( have_posts() ) : the_post();

   $categories = get_the_terms( get_the_id(), 'theme');  // recup des terms de la taxonomie $parameters['category']
   $terms=array();
   if (is_array($categories) || is_object($categories))
   {
      foreach ($categories as $term_slug) {        
         array_push($terms, $term_slug->slug);
      }
   }

   $cestags = get_the_terms( get_the_id(), 'cestag');  // recup des terms de la taxonomie $parameters['category']
   $cesTerms=array();
   if (is_array($cestags) || is_object($cestags))
   {
     foreach ($cestags as $cesTerm_slug) {        
        array_push($cesTerms, $cesTerm_slug->slug);
     }
   }
?>


<div id="primary" class="content-area <?php echo esc_html( $categories[0]->slug );?>">
        <?php
            if ( has_post_thumbnail() ) {
        ?>
            <header id="cover">
                <?php the_post_thumbnail('cover'); ?>
            </header>
        <?php 
        }
        ?>
            <main id="main" class="site-main">
                <article id="post-<?php the_ID();?>">	
                    <header class="ces_header wrapper">
                        <div>
                           <h1><?php the_title(); ?></h1>
                           <?php 
                              $taxonomy = 'category';
                              $themes = get_the_terms( $post->ID, $taxonomy);
                              ?>
                              <div class="tag">
                                 <?php 
                                 foreach($themes as $category) {
                                    echo '<a href="'.esc_url(get_term_link( $category )).'" class="non-classe-fr">'.$category->name.'</a>';   
                                 }
                                 ?>
                              </div>    
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
                            if(has_category('prototyping-sec')) {
                               echo'<a href="'.get_category_link(702).'"><figure><img src="'.get_stylesheet_directory_uri().$image_url_fr['prototyping'].'"></figure></a>'; 
                            }

                            // if prototyping (en)
                            if(has_category('ces-en-prototypage')) { 
                               echo '<a href="'.get_category_link(708).'"><figure><img src="'.get_stylesheet_directory_uri().$image_url_en['prototyping'].'"></figure></a>';
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
                    </header>
                     <div id="content-area" class="cestoc wrapper sidebar toc-left">
                        <?php
                        get_template_part( 'template-parts/content', 'tpl-page' );
                        ?>
                        
                        <aside>
                            <!-- NEWS --> 
                           <?php
                              $parameters = array(
                                 'sectionTitle'    => 'News',
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
                                                         'taxonomy' => 'cestag',
                                                         'field'    => 'slug',
                                                         'terms'    => $cesTerms,
                                                      ),
                                                   ),
                              // 'meta_key'              => '_wp_page_template',
                              // 'meta_value'            => '', // template-name.php
                           );            
                           theia_wpthchild_get_associate_content($parameters, $args);
                           ?>

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
                                                            'taxonomy' => 'cestag',
                                                            'field'    => 'slug',
                                                            'terms'    => $cesTerms,
                                                         ),
                                                      ),
                                 // 'meta_key'              => '_wp_page_template',
                                 // 'meta_value'            => '', // template-name.php
                              );
                     
                              theia_wpthchild_get_associate_content($parameters, $args);
                              ?>
                        </aside>
                     </div><!-- #content-area -->
                  </article>              
            </main>

<?php
endwhile; // End of the loop.
// get_sidebar();
get_footer();
