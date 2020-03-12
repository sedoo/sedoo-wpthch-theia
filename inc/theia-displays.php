<?php

function theia_wpthchild_postlist_by_term($title, $term, $layout, $limit, $offset, $buttonLabel, $button) {
    global $post;
    
    $argsListPost = array(
        'posts_per_page'   => $limit,
        'offset'           => $offset,
        'orderby'          => 'date',
        'order'            => 'DESC',
        'include'          => '',
        'exclude'          => '',
        'meta_key'         => '',
        'meta_value'       => '',
        'post_type'        => 'post',
        'post_status'      => 'publish',
        'suppress_filters' => true 
    );

    if ($term !== "all") {
        $argsListPost['tax_query'] = array(
                        array(
                            "taxonomy" => "category",
                            "field"    => "slug",
                            "terms"    => $term,
                        )
                        );
        $url = get_term_link($term, 'category');
        } else {
        $url = get_permalink( get_option( 'page_for_posts' ) );
        }

    switch ($layout) {
        case "grid" :
            $listingClass = "post-wrapper";
            break;

        case "grid-noimage" :
            $listingClass = "post-wrapper noimage";
            break;

        default:
            $listingClass = "content-list";
    }    

    $postsList = get_posts ($argsListPost);
    
    if ($postsList){       
    ?>
    <h2><?php echo __($title, 'sedoo-wpth-labs') ?></h2>
    <section role="listNews" class="<?php echo $listingClass;?>">
        
        <?php

        foreach ($postsList as $post) :
          setup_postdata( $post );
            ?>
            <?php
            get_template_part( 'template-parts/content', $layout );
            ?>
            <?php
        endforeach;
        ?>	
    </section>
    <?php if ($button == 1) { ?>    
    <a href="<?php echo $url; ?>" class="Aeris-seeAllButton"><?php echo $buttonLabel; ?></a>
    <?php
        }
    ?>
    
    <?php 
    the_posts_navigation();
    wp_reset_postdata();
    }
}


/**
 * Prepare WP_Query for related content 
 * 
 */
function theia_get_associate_content_arguments($title, $type_of_content, $taxonomy, $post_number, $post_offset, $layout) {
<<<<<<< HEAD
     
=======
    global $post; 
>>>>>>> release/0.6.1
    $categories_field = get_the_terms( get_the_id(), $taxonomy);  // recup des terms de la taxonomie $parameters['category']
    $terms_fields=array();
    if (is_array($categories_field) || is_object($categories_field))
    {
        foreach ($categories_field as $term_slug) {        
            array_push($terms_fields, $term_slug->slug);
        }
    }

    $parameters = array(
    'sectionTitle'    => $title,
    );
    if (function_exists('pll_current_language')) {
        $lang = pll_current_language();
    }

    if ($type_of_content== 'post') {
        $orderby = 'date';
        $order = 'DESC';
    } else {
        $orderby = 'title';
        $order = 'ASC';
    }

    $args = array(
    'post_type'             => $type_of_content,
    'post_status'           => array( 'publish' ),
    'posts_per_page'        => $post_number,            // -1 no limit
    'orderby'               => $orderby,
    'order'                 => $order,
    'lang'			        => $lang,
    'tax_query'             => array(
                            array(
                                'taxonomy' => $taxonomy,
                                'field'    => 'slug',
                                'terms'    => $terms_fields,
                            ),
                            ),
    );
    //exclude current post if not archive template
    if (!is_archive()) {
        $args['post__not_in']=array(get_the_id());
    }

    theia_get_associate_content($parameters, $args, $type_of_content, $layout);
}

/**
 * Show related content
 * 
 */
function theia_get_associate_content($parameters, $args, $type_of_content, $layout) {
    $the_query = new WP_Query( $args );

    // Check layout
    switch ($layout) {
        case "grid" :
            $listingClass = "post-wrapper";
            break;

        case "grid-noimage" :
            $listingClass = "post-wrapper noimage";
            break;

        default:
            $listingClass = "content-list";
    }

    // The Loop
    if ( $the_query->have_posts() ) {
		echo '<h2>'.__( $parameters['sectionTitle'], 'sedoo-wppl-labtools' ).'</h2>';
		echo '<section role="listNews" class="'.$listingClass.'">';
        while ( $the_query->have_posts() ) {
			$the_query->the_post();

			$titleItem=mb_strimwidth(get_the_title(), 0, 65, '...');  
            // include ( get_template_directory() . '/template-parts/content.php'. get_post_type());
            get_template_part( 'template-parts/content', $layout );
        }
		echo '</section>';
        /* Restore original Post Data */
        wp_reset_postdata();
    } else {
        // no posts found
    }
}

?>