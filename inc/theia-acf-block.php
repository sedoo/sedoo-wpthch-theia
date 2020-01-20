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
}

// Check if function exists and hook into setup.
if( function_exists('acf_register_block_type') ) {
    add_action('acf/init', 'theia_wpthchild_register_acf_block_types');
}

?>