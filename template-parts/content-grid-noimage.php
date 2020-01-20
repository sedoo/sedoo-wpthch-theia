<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Data-Terra
 */


?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <a href="<?php the_permalink(); ?>"></a>
    <?php
    //if (!is_front_page()) {
    ?>
	<header class="entry-header">
        <p>
        <?php     
            $categories = get_the_category();
            if ( ! empty( $categories ) ) {
            echo esc_html( $categories[0]->name );   
        }; 
        ?>
        </p>
    </header><!-- .entry-header -->
    <?php    
    //}
    ?>
    <div class="group-content">
        <div class="entry-content">
            <h2><?php the_title(); ?></h2>
            <?php the_excerpt(); ?>
        </div><!-- .entry-content -->
        <footer class="entry-footer">
            <?php
            if ( 'post' === get_post_type() ) :
                ?>
                <p><?php the_date('M / d / Y') ?></p>
            <?php endif; ?>
            <a href="<?php the_permalink(); ?>"><?php echo __('Lire plus', 'sedoo-wpth-labs'); ?> →</a>
        </footer><!-- .entry-footer -->
    </div>
</article><!-- #post-->
