<?php
/**
 * ACF gutenberg Block
 */

function theia_wpthchild_register_acf_block_types() {

    // register a post list block.
    acf_register_block_type(array(
        'name'              => 'postlist',
        'title'             => __('Theia Post list block'),
        'description'       => __('List post by categories and choose layout.'),
        'render_template'   => 'template-parts/blocks/theia-post-list/theia-post-list.php',
        'category'          => 'widgets',
        'icon'              => 'grid-view',
        'keywords'          => array( 'post', 'grid', 'categories' ),
    ));

    // register Post block.
    acf_register_block_type(array(
        'name'              => 'theia_relatedBlock',
        'title'             => __('Custom Post Block'),
        'description'       => __('Ajout de contenus en relation.'),
        'render_template'   => 'template-parts/blocks/contentblock/theia-relatedblock.php',
        'category'          => 'widgets',
        'icon'              => 'category',
        'keywords'          => array( 'ces', 'products', 'art' ),
    ));
}

// Check if function exists and hook into setup.
if( function_exists('acf_register_block_type') ) {
    add_action('acf/init', 'theia_wpthchild_register_acf_block_types');
}

?>