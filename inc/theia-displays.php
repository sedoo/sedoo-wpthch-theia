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

?>