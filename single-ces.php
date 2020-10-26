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
        <div class="wrapper-layout">
            <main id="main" class="site-main">
                <article id="post-<?php the_ID();?>">	
                    <header class="ces_header">
                        <?php
                           $image_url_en = array('incubating' => '/Logo-CES-EN_incubating-SEC.svg', 'prototyping' => '/Logo-CES-EN_CES-en-proto-Orange-copie-3.svg', 'producing' => '/Logo-CES-EN_CES-en-production-COULEUR-copie.svg');
                           $image_url_fr = array('incubating' => '/logo_misva.png', 'prototyping' => '/Logo-CES_CES-en-prototypage.svg', 'producing' => '/Logo-CES_CES-en-production.svg');
                        ?>
                        <h1><?php the_title(); ?></h1>
                        <?php 
                            // if incubating (fr)
                            if(has_category(18)) {
                               echo '<figure><img src="'.wp_upload_dir()['url'].$image_url_fr['incubating'].'"></figure';
                            }

                            // if incubating (en)
                            if(has_category(706)) {
                               echo '<figure><img src="'.wp_upload_dir()['url'].$image_url_en['incubating'].'"></figure';
                            }



                            // if prototyping (fr)
                            if(has_category(702)) {
                               echo'<figure><img src="'.wp_upload_dir()['url'].$image_url_fr['prototyping'].'"></figure'; 
                            }

                            // if prototyping (en)
                            if(has_category(708)) { 
                               echo '<figure><img src="'.wp_upload_dir()['url'].$image_url_en['prototyping'].'"></figure';
                            }



                            // if producing (fr)
                            if(has_category(700)) {
                               echo '<figure><img src="'.wp_upload_dir()['url'].$image_url_fr['producing'].'"></figure';
                            }

                            // if producing (en)
                            if(has_category(710)) {
                               echo '<figure><img src="'.wp_upload_dir()['url'].$image_url_en['producing'].'"></figure';
                            }


                            ?>
                        <div>
                            <?php 
                            if( function_exists('sedoo_show_categories') ){
                                sedoo_show_categories($themes, $themeSlugRewrite);
                            }
                            ?>
                        </div>
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
                        </div>

<?php
endwhile; // End of the loop.
// get_sidebar();
get_footer();
